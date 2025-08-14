<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\DriverOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = DriverOrder::with(['service'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('driver.orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'driver_service_id' => 'required|exists:driver_services,id',
            'service_type' => 'required|in:hourly,trip,custom',
            'pickup_datetime' => 'required|date',
            'pickup_location' => 'required|string|max:500',
            'destination' => 'nullable|string|max:500',
            'hours' => 'nullable|integer|min:1',
            'special_requirements' => 'nullable|string|max:1000',
        ]);

        // Calculate total amount
        $service = \App\Models\DriverService::findOrFail($request->driver_service_id);
        $totalAmount = 0;
        
        if ($request->service_type === 'hourly' && $request->hours) {
            $totalAmount = $service->price_per_hour * $request->hours;
        } elseif ($request->service_type === 'trip') {
            $totalAmount = $service->price_per_trip;
        } else {
            $totalAmount = $service->price_per_hour * 4; // Default 4 hours
        }

        // Generate order number
        $orderNumber = 'DRV-' . date('Ymd') . '-' . str_pad(DriverOrder::count() + 1, 4, '0', STR_PAD_LEFT);

        $order = DriverOrder::create([
            'order_number' => $orderNumber,
            'user_id' => Auth::id(),
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_email' => $request->customer_email,
            'driver_service_id' => $request->driver_service_id,
            'service_type' => $request->service_type,
            'pickup_datetime' => $request->pickup_datetime,
            'pickup_location' => $request->pickup_location,
            'destination' => $request->destination,
            'hours' => $request->hours,
            'total_amount' => $totalAmount,
            'special_requirements' => $request->special_requirements,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Đặt dịch vụ thành công! Mã đơn hàng: ' . $order->order_number,
            'order_id' => $order->id
        ]);
    }

    public function show($id)
    {
        $order = DriverOrder::with(['service', 'user'])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('driver.order-detail', compact('order'));
    }
}
