<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Get all products that currently have a category_id
        $products = DB::table('products')
            ->whereNotNull('category_id')
            ->select('id', 'category_id')
            ->get();

        // 2. Map them into the pivot table
        foreach ($products as $product) {
            // Check if this relationship already exists to prevent errors
            $exists = DB::table('category_product')
                ->where('product_id', $product->id)
                ->where('category_id', $product->category_id)
                ->exists();

            if (!$exists) {
                DB::table('category_product')->insert([
                    'product_id'  => $product->id,
                    'category_id' => $product->category_id,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Usually, we don't clear the pivot table on rollback 
        // unless you specifically want to undo the data move.
    }
};