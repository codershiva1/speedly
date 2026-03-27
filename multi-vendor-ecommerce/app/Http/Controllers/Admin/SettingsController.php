<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = SystemSetting::all()->groupBy('group');
        
        // Ensure default settings exist if table is empty
        if ($settings->isEmpty()) {
            $this->seedDefaults();
            $settings = SystemSetting::all()->groupBy('group');
        }

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            $setting = SystemSetting::where('key', $key)->first();
            
            if (!$setting) continue;

            if ($setting->type === 'image' && $request->hasFile($key)) {
                $path = $request->file($key)->store('uploads/settings', 'public_uploads');
                $value = $path;
            }

            $setting->update(['value' => $value]);
        }

        return back()->with('success', 'Settings updated successfully.');
    }

    private function seedDefaults()
    {
        $defaults = [
            ['key' => 'app_name', 'value' => 'Speedly', 'group' => 'general', 'type' => 'text'],
            ['key' => 'app_logo', 'value' => 'uploads/logo/speedly_logo3.png', 'group' => 'general', 'type' => 'image'],
            ['key' => 'contact_email', 'value' => 'admin@speedly.com', 'group' => 'contact', 'type' => 'text'],
            ['key' => 'currency_symbol', 'value' => '₹', 'group' => 'finance', 'type' => 'text'],
            ['key' => 'commission_rate', 'value' => '10', 'group' => 'finance', 'type' => 'number'],
            ['key' => 'delivery_fee_base', 'value' => '40', 'group' => 'finance', 'type' => 'number'],
        ];

        foreach ($defaults as $d) {
            SystemSetting::create($d);
        }
    }
}
