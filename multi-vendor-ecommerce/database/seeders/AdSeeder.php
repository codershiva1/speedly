<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ad;
use App\Models\AdPlacement;

class AdSeeder extends Seeder
{
    public function run(): void
    {
        // --- 1. SETUP HOME PAGE PLACEMENTS ---
        
        $homeHero = AdPlacement::updateOrCreate(['key' => 'home_slider'], ['name' => 'Home Main Hero Slider']);
        $tripleBanner = AdPlacement::updateOrCreate(['key' => 'home_triple_banner'], ['name' => 'Home Triple Color Banners']);
        $budgetSidebar = AdPlacement::updateOrCreate(['key' => 'home_budget_sidebar'], ['name' => 'Home Budget Store Sidebar']);

        // --- 2. INSERT HERO SLIDER ADS (Placement: home_slider) ---
        // These would go into your <x-homeslider /> component later
        for($i=1; $i<=2; $i++) {
            Ad::create([
                'ad_placement_id' => $homeHero->id,
                'target_type' => 'url',
                'title' => "Mega Home Sale Part $i",
                'banner_image' => "https://i.pinimg.com/1200x/62/0b/6e/620b6eaa3fbc897871fff2b6f6d3efe1.jpg", // Using one of your Pinterest links as dummy
                'priority' => 10,
                'is_active' => true,
            ]);
        }

        // --- 3. INSERT TRIPLE BANNERS (Placement: home_triple_banner) ---
        // We insert exactly 3 ads for this section
        $tripleImages = [
            'https://i.pinimg.com/1200x/fa/cc/de/faccde06184e838e68cbe361149ece9d.jpg',
            'https://i.pinimg.com/1200x/62/0b/6e/620b6eaa3fbc897871fff2b6f6d3efe1.jpg',
            'https://i.pinimg.com/736x/c0/4c/89/c04c89ef90ce8c726b0b483823e79b93.jpg'
        ];

        foreach($tripleImages as $index => $url) {
            Ad::create([
                'ad_placement_id' => $tripleBanner->id,
                'target_type' => 'category',
                'target_id' => 1, // Assuming a category ID
                'title' => "Promo Banner " . ($index + 1),
                'banner_image' => $url,
                'is_active' => true,
            ]);
        }

        // --- 4. INSERT SIDEBAR AD (Placement: home_budget_sidebar) ---
        Ad::create([
            'ad_placement_id' => $budgetSidebar->id,
            'target_type' => 'product',
            'target_id' => 1, // Assuming a product ID
            'title' => "Budget Deals You Can't Miss",
            'banner_image' => "https://i.pinimg.com/736x/35/95/9e/35959e77f6237aaec2c673e772c73e08.jpg",
            'is_active' => true,
        ]);

        $this->command->info('Home Page Ads Seeded Successfully!');
    }
}