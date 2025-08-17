<?php

namespace App\Http\Controllers\Admin\Driver;

use App\Http\Controllers\Controller;
use App\Models\DriverPricingTier;
use Illuminate\Http\Request;

class DriverPricingTierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pricingTiers = DriverPricingTier::ordered()->get()->groupBy('time_slot');
        return view('admin.driver.pricing-tiers.index', compact('pricingTiers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.driver.pricing-tiers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'time_slot' => 'required|string|max:255',
            'time_icon' => 'required|string|max:255',
            'time_color' => 'required|string|max:255',
            'from_distance' => 'required|numeric|min:0',
            'to_distance' => 'nullable|numeric|min:0|gt:from_distance',
            'price' => 'required|numeric|min:0',
            'price_type' => 'required|in:fixed,per_km',
            'description' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        DriverPricingTier::create($request->all());

        return redirect()->route('admin.driver.pricing-tiers.index')
            ->with('success', 'Mức giá mới đã được tạo thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pricingTier = DriverPricingTier::findOrFail($id);
        return view('admin.driver.pricing-tiers.edit', compact('pricingTier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'time_slot' => 'required|string|max:255',
            'time_icon' => 'required|string|max:255',
            'time_color' => 'required|string|max:255',
            'from_distance' => 'required|numeric|min:0',
            'to_distance' => 'nullable|numeric|min:0|gt:from_distance',
            'price' => 'required|numeric|min:0',
            'price_type' => 'required|in:fixed,per_km',
            'description' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $pricingTier = DriverPricingTier::findOrFail($id);
        $pricingTier->update($request->all());

        return redirect()->route('admin.driver.pricing-tiers.index')
            ->with('success', 'Mức giá đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pricingTier = DriverPricingTier::findOrFail($id);
        $pricingTier->delete();

        return redirect()->route('admin.driver.pricing-tiers.index')
            ->with('success', 'Mức giá đã được xóa thành công!');
    }
}
