<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $now = Carbon::now();

        /* =====================
           PARENT CATEGORIES
        ===================== */
        DB::table('categories')->insert([
            [
                'id' => 1,
                'parent_id' => null,
                'name' => 'Vegetables & Fruits',
                'slug' => 'vegetables-fruits',
                'description' => 'Fresh vegetables and fruits',
                'image' => null,
                'meta_title' => 'Fresh Vegetables & Fruits',
                'meta_description' => 'Buy fresh vegetables and fruits online',
                'meta_keywords' => 'vegetables, fruits, fresh produce',
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'parent_id' => null,
                'name' => 'Dairy & Breakfast',
                'slug' => 'dairy-breakfast',
                'description' => 'Milk, bread, eggs and breakfast items',
                'image' => null,
                'meta_title' => 'Dairy & Breakfast',
                'meta_description' => 'Milk, curd, bread and breakfast essentials',
                'meta_keywords' => 'milk, bread, eggs, dairy',
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'parent_id' => null,
                'name' => 'Atta, Rice & Dal',
                'slug' => 'atta-rice-dal',
                'description' => 'Daily grains and pulses',
                'image' => null,
                'meta_title' => 'Atta Rice & Dal',
                'meta_description' => 'Buy atta, rice and dal online',
                'meta_keywords' => 'atta, rice, dal, grains',
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'parent_id' => null,
                'name' => 'Snacks & Beverages',
                'slug' => 'snacks-beverages',
                'description' => 'Snacks, cold drinks and beverages',
                'image' => null,
                'meta_title' => 'Snacks & Beverages',
                'meta_description' => 'Snacks, juices and cold drinks',
                'meta_keywords' => 'snacks, beverages, drinks',
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 5,
                'parent_id' => null,
                'name' => 'Personal Care',
                'slug' => 'personal-care',
                'description' => 'Daily personal hygiene products',
                'image' => null,
                'meta_title' => 'Personal Care',
                'meta_description' => 'Personal care and hygiene essentials',
                'meta_keywords' => 'personal care, hygiene, grooming',
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 6,
                'parent_id' => null,
                'name' => 'Household Essentials',
                'slug' => 'household-essentials',
                'description' => 'Cleaning and household items',
                'image' => null,
                'meta_title' => 'Household Essentials',
                'meta_description' => 'Cleaning and home care products',
                'meta_keywords' => 'household, cleaning, home',
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 7,
                'parent_id' => null,
                'name' => 'Baby Care',
                'slug' => 'baby-care',
                'description' => 'Baby food and care products',
                'image' => null,
                'meta_title' => 'Baby Care',
                'meta_description' => 'Baby food, diapers and care products',
                'meta_keywords' => 'baby care, diapers, baby food',
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        /* =====================
           CHILD CATEGORIES
        ===================== */
        DB::table('categories')->insert([
            // Vegetables & Fruits
            [
                'parent_id' => 1,
                'name' => 'Fresh Vegetables',
                'slug' => 'fresh-vegetables',
                'description' => 'Daily fresh vegetables',
                'image' => null,
                'meta_title' => 'Fresh Vegetables',
                'meta_description' => 'Buy fresh vegetables online',
                'meta_keywords' => 'vegetables, fresh',
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'parent_id' => 1,
                'name' => 'Fresh Fruits',
                'slug' => 'fresh-fruits',
                'description' => 'Seasonal fresh fruits',
                'image' => null,
                'meta_title' => 'Fresh Fruits',
                'meta_description' => 'Buy fresh fruits online',
                'meta_keywords' => 'fruits, fresh',
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Dairy & Breakfast
            [
                'parent_id' => 2,
                'name' => 'Milk & Curd',
                'slug' => 'milk-curd',
                'description' => 'Milk and curd products',
                'image' => null,
                'meta_title' => 'Milk & Curd',
                'meta_description' => 'Fresh milk and curd',
                'meta_keywords' => 'milk, curd, dairy',
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Atta Rice Dal
            [
                'parent_id' => 3,
                'name' => 'Dal & Pulses',
                'slug' => 'dal-pulses',
                'description' => 'All types of dal and pulses',
                'image' => null,
                'meta_title' => 'Dal & Pulses',
                'meta_description' => 'Buy dal and pulses online',
                'meta_keywords' => 'dal, pulses',
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Baby Care
            [
                'parent_id' => 7,
                'name' => 'Diapers & Wipes',
                'slug' => 'diapers-wipes',
                'description' => 'Baby diapers and wipes',
                'image' => null,
                'meta_title' => 'Diapers & Wipes',
                'meta_description' => 'Baby diapers and wipes online',
                'meta_keywords' => 'diapers, wipes, baby',
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
