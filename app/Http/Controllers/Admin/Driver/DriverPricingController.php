<?php

namespace App\Http\Controllers\Admin\Driver;

use App\Http\Controllers\Controller;
use App\Models\DriverService;
use Illuminate\Http\Request;

class DriverPricingController extends Controller
{
    /**
     * Display a listing of the pricing.
     */
    public function index()
    {
        $services = DriverService::where('status', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('admin.driver.pricing.index', compact('services'));
    }

    /**
     * Show the form for editing pricing.
     */
    public function edit($id)
    {
        $service = DriverService::findOrFail($id);
        return view('admin.driver.pricing.edit', compact('service'));
    }

    /**
     * Update the pricing.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'price_per_hour' => 'required|numeric|min:0',
            'price_per_trip' => 'required|numeric|min:0',
        ]);

        $service = DriverService::findOrFail($id);
        $service->update([
            'price_per_hour' => $request->price_per_hour,
            'price_per_trip' => $request->price_per_trip,
        ]);

        return redirect()->route('admin.driver.pricing.index')
            ->with('success', 'Cập nhật bảng giá thành công!');
    }
}
