<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DriverPricingRule;
use App\Models\DriverDistanceTier;
use App\Models\DriverPricingRuleDistance;

class MigratePricingDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pricingRules = DriverPricingRule::all();
        $distanceTiers = DriverDistanceTier::all();

        foreach($pricingRules as $rule) {
            // Tạo dữ liệu cho 5km đầu
            $tier1 = $distanceTiers->where('display_text', '5km đầu')->first();
            if($tier1) {
                DriverPricingRuleDistance::create([
                    'pricing_rule_id' => $rule->id,
                    'distance_tier_id' => $tier1->id,
                    'price' => $rule->base_price,
                    'price_text' => null
                ]);
            }
            
            // Tạo dữ liệu cho 6-10km
            $tier2 = $distanceTiers->where('display_text', '6-10km')->first();
            if($tier2) {
                DriverPricingRuleDistance::create([
                    'pricing_rule_id' => $rule->id,
                    'distance_tier_id' => $tier2->id,
                    'price' => $rule->price_6_10km,
                    'price_text' => null
                ]);
            }
            
            // Tạo dữ liệu cho >10km
            $tier3 = $distanceTiers->where('display_text', '>10km')->first();
            if($tier3) {
                DriverPricingRuleDistance::create([
                    'pricing_rule_id' => $rule->id,
                    'distance_tier_id' => $tier3->id,
                    'price' => $rule->price_over_10km,
                    'price_text' => null
                ]);
            }
            
            // Tạo dữ liệu cho >30km
            $tier4 = $distanceTiers->where('display_text', '>30km')->first();
            if($tier4) {
                DriverPricingRuleDistance::create([
                    'pricing_rule_id' => $rule->id,
                    'distance_tier_id' => $tier4->id,
                    'price' => null,
                    'price_text' => $rule->price_over_30km
                ]);
            }
        }

        echo "Migration completed! Migrated " . $pricingRules->count() . " pricing rules.\n";
    }
}
