<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AdPlacement;

class AdPlacementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $placements = [
            ['key' => 'home_top', 'name' => 'Home Top Banner'],
            ['key' => 'home_inline', 'name' => 'Home Inline Sponsored'],
            ['key' => 'category_inline', 'name' => 'Category Inline Sponsored'],
            ['key' => 'search_top', 'name' => 'Search Top Sponsored'],
            ['key' => 'store_inline', 'name' => 'Store Inline Sponsored'],
        ];

        foreach ($placements as $place) {
            AdPlacement::firstOrCreate(['key' => $place['key']], $place);
        }
    }
}
