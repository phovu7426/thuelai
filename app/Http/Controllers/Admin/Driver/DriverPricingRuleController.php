<?php

namespace App\Http\Controllers\Admin\Driver;

use App\Http\Controllers\Controller;
use App\Models\DriverPricingRule;
use App\Models\DriverDistanceTier;
use App\Models\DriverPricingRuleDistance;
use Illuminate\Http\Request;

class DriverPricingRuleController extends Controller
{
    public function index()
    {
        $pricingRules = DriverPricingRule::with('pricingDistances.distanceTier')->active()->ordered()->get();
        $distanceTiers = DriverDistanceTier::active()->ordered()->get();
        return view('admin.driver.pricing-rules.index', compact('pricingRules', 'distanceTiers'));
    }

    public function create()
    {
        $distanceTiers = DriverDistanceTier::active()->ordered()->get();
        return view('admin.driver.pricing-rules.create', compact('distanceTiers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'time_slot' => 'required|string|max:255',
            'time_icon' => 'required|string|max:255',
            'time_color' => 'required|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        // Tạo quy tắc giá
        $pricingRule = DriverPricingRule::create([
            'time_slot' => $request->time_slot,
            'time_icon' => $request->time_icon,
            'time_color' => $request->time_color,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        // Lưu giá cho từng khoảng cách
        $distanceTiers = DriverDistanceTier::active()->ordered()->get();
        foreach ($distanceTiers as $tier) {
            $priceField = 'price_' . $tier->id;
            if ($request->has($priceField)) {
                $price = $request->input($priceField);
                
                // Xác định loại giá (số hay text)
                if (is_numeric($price)) {
                    DriverPricingRuleDistance::create([
                        'pricing_rule_id' => $pricingRule->id,
                        'distance_tier_id' => $tier->id,
                        'price' => $price,
                        'price_text' => null,
                    ]);
                } else {
                    DriverPricingRuleDistance::create([
                        'pricing_rule_id' => $pricingRule->id,
                        'distance_tier_id' => $tier->id,
                        'price' => null,
                        'price_text' => $price,
                    ]);
                }
            }
        }

        return redirect()->route('admin.driver.pricing-rules.index')
            ->with('success', 'Quy tắc giá đã được tạo thành công!');
    }

    public function edit(string $id)
    {
        $pricingRule = DriverPricingRule::findOrFail($id);
        $distanceTiers = DriverDistanceTier::active()->ordered()->get();
        return view('admin.driver.pricing-rules.edit', compact('pricingRule', 'distanceTiers'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'time_slot' => 'required|string|max:255',
            'time_icon' => 'required|string|max:255',
            'time_color' => 'required|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $pricingRule = DriverPricingRule::findOrFail($id);
        $pricingRule->update([
            'time_slot' => $request->time_slot,
            'time_icon' => $request->time_icon,
            'time_color' => $request->time_color,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        // Xóa tất cả giá cũ
        $pricingRule->pricingDistances()->delete();

        // Cập nhật giá cho từng khoảng cách
        $distanceTiers = DriverDistanceTier::active()->ordered()->get();
        foreach ($distanceTiers as $tier) {
            $priceField = 'price_' . $tier->id;
            if ($request->has($priceField)) {
                $price = $request->input($priceField);
                
                // Xác định loại giá (số hay text)
                if (is_numeric($price)) {
                    DriverPricingRuleDistance::create([
                        'pricing_rule_id' => $pricingRule->id,
                        'distance_tier_id' => $tier->id,
                        'price' => $price,
                        'price_text' => null,
                    ]);
                } else {
                    DriverPricingRuleDistance::create([
                        'pricing_rule_id' => $pricingRule->id,
                        'distance_tier_id' => $tier->id,
                        'price' => null,
                        'price_text' => $price,
                    ]);
                }
            }
        }

        return redirect()->route('admin.driver.pricing-rules.index')
            ->with('success', 'Quy tắc giá đã được cập nhật thành công!');
    }

    public function destroy(string $id)
    {
        $pricingRule = DriverPricingRule::findOrFail($id);
        $pricingRule->delete();

        return redirect()->route('admin.driver.pricing-rules.index')
            ->with('success', 'Quy tắc giá đã được xóa thành công!');
    }
}
