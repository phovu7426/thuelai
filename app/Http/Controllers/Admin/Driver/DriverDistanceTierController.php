<?php

namespace App\Http\Controllers\Admin\Driver;

use App\Http\Controllers\Controller;
use App\Models\DriverDistanceTier;
use Illuminate\Http\Request;

class DriverDistanceTierController extends Controller
{
    public function index()
    {
        $distanceTiers = DriverDistanceTier::active()->ordered()->get();
        return view('admin.driver.distance-tiers.index', compact('distanceTiers'));
    }

    public function create()
    {
        return view('admin.driver.distance-tiers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'from_distance' => 'required|numeric|min:0',
            'to_distance' => 'nullable|numeric|min:0|gt:from_distance',
            'display_text' => 'required|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        DriverDistanceTier::create([
            'name' => $request->name,
            'description' => $request->description,
            'from_distance' => $request->from_distance,
            'to_distance' => $request->to_distance,
            'display_text' => $request->display_text,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.driver.distance-tiers.index')
            ->with('success', 'Khoảng cách đã được tạo thành công!');
    }

    public function edit(string $id)
    {
        $distanceTier = DriverDistanceTier::findOrFail($id);
        return view('admin.driver.distance-tiers.edit', compact('distanceTier'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'from_distance' => 'required|numeric|min:0',
            'to_distance' => 'nullable|numeric|min:0|gt:from_distance',
            'display_text' => 'required|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $distanceTier = DriverDistanceTier::findOrFail($id);
        $distanceTier->update([
            'name' => $request->name,
            'description' => $request->description,
            'from_distance' => $request->from_distance,
            'to_distance' => $request->to_distance,
            'display_text' => $request->display_text,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.driver.distance-tiers.index')
            ->with('success', 'Khoảng cách đã được cập nhật thành công!');
    }

    public function destroy(string $id)
    {
        $distanceTier = DriverDistanceTier::findOrFail($id);
        $distanceTier->delete();

        return redirect()->route('admin.driver.distance-tiers.index')
            ->with('success', 'Khoảng cách đã được xóa thành công!');
    }
}

