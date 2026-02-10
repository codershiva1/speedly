<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ad;
use App\Models\AdPlacement;

class AdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Setup Placements
        $hero = AdPlacement::updateOrCreate(['key' => 'off_hero'], ['name' => 'Offers Main Hero']);
        $grid = AdPlacement::updateOrCreate(['key' => 'off_grid'], ['name' => 'Offers Daily Deals']);
        $bank = AdPlacement::updateOrCreate(['key' => 'off_bank'], ['name' => 'Offers Bank Coupons']);
        $slim = AdPlacement::updateOrCreate(['key' => 'off_slim'], ['name' => 'Offers Slim Strips']);

        // 2. Insert Hero Ads (Big Sliders)
        for($i=1; $i<=3; $i++) {
            Ad::create([
                'ad_placement_id' => $hero->id,
                'target_type' => 'category',
                'title' => "Summer Grocery Carnival Part $i",
                'banner_image' => "ads/hero_$i.jpg",
                'priority' => 10,
                'is_active' => true,
            ]);
        }

        // 3. Insert Grid Ads (Square Tiles)
        for($i=1; $i<=6; $i++) {
            Ad::create([
                'ad_placement_id' => $grid->id,
                'target_type' => 'product',
                'title' => "Flash Deal $i: 40% OFF",
                'banner_image' => "ads/grid_$i.jpg",
                'is_active' => true,
            ]);
        }

        // 4. Insert Bank/Slim Ads
        Ad::create([
            'ad_placement_id' => $bank->id,
            'target_type' => 'url',
            'title' => "HDFC Bank 10% Instant Discount",
            'is_active' => true,
        ]);
    }
}
