<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    public function exportOrders()
    {
        $orders = Order::latest()->get();
        $filename = "orders_export_" . date('Y-m-d') . ".csv";

        return new StreamedResponse(function() use ($orders) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Order Number', 'Customer', 'Total Amount', 'Status', 'Date']);

            foreach ($orders as $order) {
                fputcsv($handle, [
                    $order->order_number,
                    $order->shipping_name,
                    $order->total_amount,
                    $order->status,
                    $order->created_at->format('Y-m-d H:i:s'),
                ]);
            }
            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
    }

    public function exportVendors()
    {
        $vendors = User::where('role', 'vendor')->with('vendorProfile')->get();
        $filename = "vendors_export_" . date('Y-m-d') . ".csv";

        return new StreamedResponse(function() use ($vendors) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Name', 'Email', 'Store Name', 'Phone', 'Status', 'Joined At']);

            foreach ($vendors as $vendor) {
                fputcsv($handle, [
                    $vendor->name,
                    $vendor->email,
                    $vendor->vendorProfile->store_name ?? 'N/A',
                    $vendor->phone ?? 'N/A',
                    $vendor->vendorProfile->status ?? 'pending',
                    $vendor->created_at->format('Y-m-d'),
                ]);
            }
            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
    }
}
