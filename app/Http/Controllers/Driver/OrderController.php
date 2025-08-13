<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\DriverOrder;
use App\Models\DriverService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'driver_service_id' => 'required|exists:driver_services,id',
            'service_type' => 'required|in:hourly,trip,custom',
            'pickup_datetime' => 'required|date|after:now',
            'pickup_location' => 'required|string|max:500',
            'destination' => 'nullable|string|max:500',
            'hours' => 'nullable|integer|min:1',
            'special_requirements' => 'nullable|string|max:1000',
        ]);

        $service = DriverService::findOrFail($request->driver_service_id);
        
        // Tính toán giá
        $totalAmount = 0;
        if ($request->service_type === 'hourly' && $request->hours) {
            $totalAmount = $service->price_per_hour * $request->hours;
        } elseif ($request->service_type === 'trip') {
            $totalAmount = $service->price_per_trip;
        } else {
            // Giá tùy chỉnh
            $totalAmount = $service->price_per_hour * 4; // Mặc định 4 giờ
        }

        $order = DriverOrder::create([
            'order_number' => 'DRV-' . date('Ymd') . '-' . Str::random(6),
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
            'status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Đặt dịch vụ thành công! Chúng tôi sẽ liên hệ với bạn sớm nhất.',
            'order_number' => $order->order_number
        ]);
    }

    public function show($id)
    {
        $order = DriverOrder::with(['service', 'user'])->findOrFail($id);
        
        // Kiểm tra quyền xem đơn hàng
        if (Auth::check() && Auth::id() === $order->user_id) {
            return view('driver.order-detail', compact('order'));
        }
        
        return abort(403, 'Bạn không có quyền xem đơn hàng này.');
    }
}
