<?php

namespace App\Http\Controllers\Admin\Driver;

use App\Http\Controllers\Controller;
use App\Models\DriverOrder;
use App\Models\DriverService;
use Illuminate\Http\Request;

class DriverOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = DriverOrder::with(['user', 'service'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $statuses = [
            'pending' => 'Chờ xác nhận',
            'confirmed' => 'Đã xác nhận',
            'in_progress' => 'Đang thực hiện',
            'completed' => 'Hoàn thành',
            'cancelled' => 'Đã hủy'
        ];

        return view('admin.driver.orders.index', compact('orders', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = DriverService::where('status', true)->get();
        return view('admin.driver.orders.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
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
            'total_amount' => 'required|numeric|min:0',
            'special_requirements' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,in_progress,completed,cancelled',
        ], [
            'customer_name.required' => 'Tên khách hàng là bắt buộc',
            'customer_phone.required' => 'Số điện thoại là bắt buộc',
            'customer_email.email' => 'Email không hợp lệ',
            'driver_service_id.required' => 'Vui lòng chọn dịch vụ',
            'driver_service_id.exists' => 'Dịch vụ không tồn tại',
            'service_type.required' => 'Vui lòng chọn loại dịch vụ',
            'service_type.in' => 'Loại dịch vụ không hợp lệ',
            'pickup_datetime.required' => 'Thời gian đón là bắt buộc',
            'pickup_datetime.date' => 'Thời gian đón không hợp lệ',
            'pickup_location.required' => 'Địa điểm đón là bắt buộc',
            'hours.integer' => 'Số giờ phải là số nguyên',
            'hours.min' => 'Số giờ phải lớn hơn 0',
            'total_amount.required' => 'Tổng tiền là bắt buộc',
            'total_amount.numeric' => 'Tổng tiền phải là số',
            'total_amount.min' => 'Tổng tiền không được âm',
            'status.required' => 'Trạng thái là bắt buộc',
            'status.in' => 'Trạng thái không hợp lệ',
        ]);

        try {
            $data = $request->all();
            $data['order_number'] = 'DRV-' . date('Ymd') . '-' . strtoupper(uniqid());
            
            DriverOrder::create($data);

            return redirect()->route('admin.driver.orders.index')
                ->with('success', 'Đơn hàng đã được tạo thành công!');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Có lỗi xảy ra khi tạo đơn hàng: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DriverOrder $driverOrder)
    {
        $driverOrder->load(['user', 'service']);
        return view('admin.driver.orders.show', compact('driverOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DriverOrder $driverOrder)
    {
        $services = DriverService::where('status', true)->get();
        return view('admin.driver.orders.edit', compact('driverOrder', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DriverOrder $driverOrder)
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
            'total_amount' => 'required|numeric|min:0',
            'special_requirements' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,in_progress,completed,cancelled',
            'admin_notes' => 'nullable|string',
        ], [
            'customer_name.required' => 'Tên khách hàng là bắt buộc',
            'customer_phone.required' => 'Số điện thoại là bắt buộc',
            'customer_email.email' => 'Email không hợp lệ',
            'driver_service_id.required' => 'Vui lòng chọn dịch vụ',
            'driver_service_id.exists' => 'Dịch vụ không tồn tại',
            'service_type.required' => 'Vui lòng chọn loại dịch vụ',
            'service_type.in' => 'Loại dịch vụ không hợp lệ',
            'pickup_datetime.required' => 'Thời gian đón là bắt buộc',
            'pickup_datetime.date' => 'Thời gian đón không hợp lệ',
            'pickup_location.required' => 'Địa điểm đón là bắt buộc',
            'hours.integer' => 'Số giờ phải là số nguyên',
            'hours.min' => 'Số giờ phải lớn hơn 0',
            'total_amount.required' => 'Tổng tiền là bắt buộc',
            'total_amount.numeric' => 'Tổng tiền phải là số',
            'total_amount.min' => 'Tổng tiền không được âm',
            'status.required' => 'Trạng thái là bắt buộc',
            'status.in' => 'Trạng thái không hợp lệ',
        ]);

        try {
            $driverOrder->update($request->all());

            return redirect()->route('admin.driver.orders.index')
                ->with('success', 'Đơn hàng đã được cập nhật thành công!');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Có lỗi xảy ra khi cập nhật đơn hàng: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DriverOrder $driverOrder)
    {
        try {
            $driverOrder->delete();

            return redirect()->route('admin.driver.orders.index')
                ->with('success', 'Đơn hàng đã được xóa thành công!');

        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra khi xóa đơn hàng: ' . $e->getMessage());
        }
    }

    /**
     * Cập nhật trạng thái đơn hàng
     */
    public function updateStatus(Request $request, DriverOrder $driverOrder)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,in_progress,completed,cancelled',
            'admin_notes' => 'nullable|string'
        ], [
            'status.required' => 'Trạng thái là bắt buộc',
            'status.in' => 'Trạng thái không hợp lệ'
        ]);

        try {
            $driverOrder->update([
                'status' => $request->status,
                'admin_notes' => $request->admin_notes
            ]);

            $statusLabels = [
                'pending' => 'Chờ xác nhận',
                'confirmed' => 'Đã xác nhận',
                'in_progress' => 'Đang thực hiện',
                'completed' => 'Hoàn thành',
                'cancelled' => 'Đã hủy'
            ];

            return response()->json([
                'success' => true,
                'message' => "Đơn hàng đã được cập nhật trạng thái thành: {$statusLabels[$request->status]}",
                'status' => $request->status
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Lọc đơn hàng theo trạng thái
     */
    public function filterByStatus(Request $request)
    {
        $status = $request->get('status');
        $query = DriverOrder::with(['user', 'service']);

        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(15);

        if ($request->ajax()) {
            return view('admin.driver.orders.partials.orders-table', compact('orders'))->render();
        }

        return view('admin.driver.orders.index', compact('orders'));
    }

    /**
     * Tìm kiếm đơn hàng
     */
    public function search(Request $request)
    {
        $search = $request->get('search');
        $query = DriverOrder::with(['user', 'service']);

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%")
                  ->orWhere('pickup_location', 'like', "%{$search}%");
            });
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(15);

        if ($request->ajax()) {
            return view('admin.driver.orders.partials.orders-table', compact('orders'))->render();
        }

        return view('admin.driver.orders.index', compact('orders'));
    }

    /**
     * Xuất dữ liệu đơn hàng
     */
    public function export(Request $request)
    {
        $status = $request->get('status');
        $query = DriverOrder::with(['user', 'service']);

        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        $orders = $query->orderBy('created_at', 'desc')->get();

        // Tạo file CSV
        $filename = 'driver_orders_' . date('Y-m-d_H-i-s') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($orders) {
            $file = fopen('php://output', 'w');
            
            // Header
            fputcsv($file, [
                'Mã đơn hàng',
                'Tên khách hàng',
                'Số điện thoại',
                'Email',
                'Dịch vụ',
                'Loại dịch vụ',
                'Thời gian đón',
                'Địa điểm đón',
                'Điểm đến',
                'Số giờ',
                'Tổng tiền',
                'Trạng thái',
                'Ngày tạo'
            ]);

            // Data
            foreach ($orders as $order) {
                fputcsv($file, [
                    $order->order_number,
                    $order->customer_name,
                    $order->customer_phone,
                    $order->customer_email,
                    $order->service->name ?? 'N/A',
                    $order->service_type,
                    $order->pickup_datetime->format('d/m/Y H:i'),
                    $order->pickup_location,
                    $order->destination,
                    $order->hours,
                    number_format($order->total_amount) . ' VNĐ',
                    $order->status,
                    $order->created_at->format('d/m/Y H:i')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
