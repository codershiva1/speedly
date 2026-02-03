<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::withTrashed(); // Soft deleted users bhi dikhenge

        // Search Logic
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        // Role Filter
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

   public function create()
    {
        // Naya user banane ka page dikhayega
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,vendor,customer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];

        // Image upload logic
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('uploads/users'), $imageName);
            $userData['image_url'] = 'uploads/users/'.$imageName;
        }

        User::create($userData);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully!');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('name', 'email', 'role');

        // Update image logic
        if ($request->hasFile('image')) {
            // Purani image delete karna (Optional but good practice)
            if ($user->image_url && file_exists(public_path($user->image_url))) {
                unlink(public_path($user->image_url));
            }

            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('uploads/users'), $imageName);
            $data['image_url'] = 'uploads/users/'.$imageName;
        }

        $user->update($data);
        
        return back()->with('success', 'User updated successfully!');
    }

    // Toggle Active/Inactive
   public function disableUser(User $user)
    {
        $user->delete(); // Ye deleted_at ko fill kar dega
        return back()->with('success', 'User has been deactivated (Soft Deleted).');
    }

    // User ko Active karne ke liye (Restore)
    public function enableUser($id)
    {
        User::withTrashed()->findOrFail($id)->restore(); // Ye deleted_at ko null kar dega
        return back()->with('success', 'User has been activated (Restored).');
    }

    // Soft Delete
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User moved to trash!');
    }

    // Restore Soft Deleted User
    public function restore($id)
    {
        User::withTrashed()->find($id)->restore();
        return back()->with('success', 'User restored!');
    }

    // Permanent Delete
    public function forceDelete($id)
    {
        User::withTrashed()->find($id)->forceDelete();
        return back()->with('success', 'User permanently deleted!');
    }
}