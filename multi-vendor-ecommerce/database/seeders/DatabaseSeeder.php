<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Models\VendorProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        // Vendor user
        $vendor = User::factory()->create([
            'name' => 'Demo Vendor',
            'email' => 'vendor@example.com',
            'role' => 'vendor',
        ]);

        VendorProfile::create([
            'user_id' => $vendor->id,
            'store_name' => 'Demo Vendor Store',
            'slug' => 'demo-vendor-store',
            'status' => 'approved',
        ]);

        // Customer user
        $customer = User::factory()->create([
            'name' => 'Demo Customer',
            'email' => 'customer@example.com',
            'role' => 'customer',
        ]);

        // Demo categories
        $categoriesData = [
            ['name' => 'Electronics'],
            ['name' => 'Fashion'],
            ['name' => 'Home & Kitchen'],
        ];

        $categories = collect($categoriesData)->map(function (array $data) {
            return Category::create([
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'status' => true,
            ]);
        });

        // Demo brands
        $brandsData = ['Acme', 'Zentech', 'Urban Style'];
        $brands = collect($brandsData)->map(function (string $name) {
            return Brand::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'status' => true,
            ]);
        });

        // Demo products for vendor
        $products = [
            [
                'name' => 'Acme Noise Cancelling Headphones',
                'category' => 'Electronics',
                'brand' => 'Acme',
                'price' => 4999,
                'discount_price' => 3999,
            ],
            [
                'name' => 'Zentech Smartwatch Series X',
                'category' => 'Electronics',
                'brand' => 'Zentech',
                'price' => 6999,
                'discount_price' => 5499,
            ],
            [
                'name' => 'Urban Style Running Shoes',
                'category' => 'Fashion',
                'brand' => 'Urban Style',
                'price' => 2999,
                'discount_price' => 2499,
            ],
            [
                'name' => 'Premium Cotton Bedsheet Set',
                'category' => 'Home & Kitchen',
                'brand' => 'Acme',
                'price' => 1999,
                'discount_price' => 1599,
            ],
        ];

        $createdProducts = [];

        foreach ($products as $index => $data) {
            $category = $categories->firstWhere('name', $data['category']);
            $brand = $brands->firstWhere('name', $data['brand']);

            $createdProducts[] = Product::create([
                'vendor_id' => $vendor->id,
                'category_id' => $category?->id,
                'brand_id' => $brand?->id,
                'name' => $data['name'],
                'slug' => Str::slug($data['name']) . '-' . ($index + 1),
                'sku' => 'SKU-' . strtoupper(Str::random(6)),
                'short_description' => 'Demo product: ' . $data['name'],
                'description' => 'This is a demo product created for the sample catalog in the multi-vendor store.',
                'price' => $data['price'],
                'discount_price' => $data['discount_price'],
                'stock_quantity' => 50,
                'status' => 'active',
                'is_featured' => $index < 2,
                'is_trending' => $data['category'] === 'Electronics',
                'is_new' => true,
            ]);
        }

        // Optional: a couple of demo orders so dashboards are not empty
        if (! empty($createdProducts)) {
            $order1 = Order::create([
                'user_id' => $customer->id,
                'order_number' => 'DEMO-' . now()->format('YmdHis') . '-1',
                'status' => 'confirmed',
                'payment_status' => 'paid',
                'payment_method' => 'cod',
                'subtotal_amount' => 0,
                'discount_amount' => 0,
                'shipping_amount' => 0,
                'total_amount' => 0,
                'currency' => 'INR',
                'shipping_name' => $customer->name,
                'shipping_email' => $customer->email,
                'shipping_phone' => '9999999999',
                'shipping_address_line1' => '123 Demo Street',
                'shipping_city' => 'Demo City',
                'shipping_state' => 'Demo State',
                'shipping_postal_code' => '123456',
                'shipping_country' => 'India',
            ]);

            $subtotal = 0;

            foreach (array_slice($createdProducts, 0, 2) as $product) {
                $qty = 1;
                $unit = $product->discount_price ?? $product->price;
                $lineTotal = $unit * $qty;
                $subtotal += $lineTotal;

                OrderItem::create([
                    'order_id' => $order1->id,
                    'product_id' => $product->id,
                    'vendor_id' => $vendor->id,
                    'product_name' => $product->name,
                    'quantity' => $qty,
                    'unit_price' => $unit,
                    'total_price' => $lineTotal,
                ]);
            }

            $order1->update([
                'subtotal_amount' => $subtotal,
                'total_amount' => $subtotal,
            ]);
        }
    }
}
