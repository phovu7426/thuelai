<?php

namespace App\Http\Controllers\Admin\Driver;

use App\Http\Controllers\Controller;
use App\Models\DriverService;
use App\Models\DriverOrder;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class DriverDashboardController extends Controller
{
    /**
     * Display the driver service dashboard.
     */
    public function index()
    {
        // Thống kê tổng quan
        $stats = [
            'total_services' => DriverService::count(),
            'active_services' => DriverService::where('status', true)->count(),
            'featured_services' => DriverService::where('is_featured', true)->count(),
            'total_orders' => DriverOrder::count(),
            'pending_orders' => DriverOrder::where('status', 'pending')->count(),
            'confirmed_orders' => DriverOrder::where('status', 'confirmed')->count(),
            'in_progress_orders' => DriverOrder::where('status', 'in_progress')->count(),
            'completed_orders' => DriverOrder::where('status', 'completed')->count(),
            'cancelled_orders' => DriverOrder::where('status', 'cancelled')->count(),
            'total_testimonials' => Testimonial::count(),
            'active_testimonials' => Testimonial::where('status', true)->count(),
            'featured_testimonials' => Testimonial::where('is_featured', true)->count(),
        ];

        // Đơn hàng gần đây
        $recent_orders = DriverOrder::with(['user', 'service'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Dịch vụ nổi bật
        $featured_services = DriverService::where('is_featured', true)
            ->where('status', true)
            ->orderBy('sort_order', 'asc')
            ->take(5)
            ->get();

        // Đánh giá gần đây
        $recent_testimonials = Testimonial::where('status', true)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Thống kê theo tháng (6 tháng gần nhất)
        $monthly_stats = $this->getMonthlyStats();

        return view('admin.driver.dashboard', compact(
            'stats',
            'recent_orders',
            'featured_services',
            'recent_testimonials',
            'monthly_stats'
        ));
    }

    /**
     * Lấy thống kê theo tháng
     */
    private function getMonthlyStats()
    {
        $months = [];
        $order_counts = [];
        $revenue_data = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $month_name = $date->format('M Y');
            $months[] = $month_name;

            // Đếm đơn hàng theo tháng
            $order_count = DriverOrder::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            $order_counts[] = $order_count;

            // Tính doanh thu theo tháng
            $revenue = DriverOrder::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->where('status', 'completed')
                ->sum('total_amount');
            $revenue_data[] = $revenue;
        }

        return [
            'months' => $months,
            'order_counts' => $order_counts,
            'revenue_data' => $revenue_data
        ];
    }

    /**
     * Lấy dữ liệu cho biểu đồ
     */
    public function getChartData(Request $request)
    {
        $type = $request->get('type', 'orders');

        switch ($type) {
            case 'orders':
                $data = $this->getOrderChartData();
                break;
            case 'revenue':
                $data = $this->getRevenueChartData();
                break;
            case 'services':
                $data = $this->getServiceChartData();
                break;
            default:
                $data = $this->getOrderChartData();
        }

        return response()->json($data);
    }

    /**
     * Dữ liệu biểu đồ đơn hàng
     */
    private function getOrderChartData()
    {
        $statuses = ['pending', 'confirmed', 'in_progress', 'completed', 'cancelled'];
        $data = [];

        foreach ($statuses as $status) {
            $count = DriverOrder::where('status', $status)->count();
            $data[] = [
                'status' => $status,
                'count' => $count
            ];
        }

        return $data;
    }

    /**
     * Dữ liệu biểu đồ doanh thu
     */
    private function getRevenueChartData()
    {
        $months = [];
        $revenue = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->format('M');
            
            $monthly_revenue = DriverOrder::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->where('status', 'completed')
                ->sum('total_amount');
            $revenue[] = $monthly_revenue;
        }

        return [
            'labels' => $months,
            'data' => $revenue
        ];
    }

    /**
     * Dữ liệu biểu đồ dịch vụ
     */
    private function getServiceChartData()
    {
        $services = DriverService::withCount('orders')
            ->orderBy('orders_count', 'desc')
            ->take(10)
            ->get();

        return [
            'labels' => $services->pluck('name')->toArray(),
            'data' => $services->pluck('orders_count')->toArray()
        ];
    }

    /**
     * Lấy thống kê real-time
     */
    public function getRealTimeStats()
    {
        $stats = [
            'today_orders' => DriverOrder::whereDate('created_at', today())->count(),
            'today_revenue' => DriverOrder::whereDate('created_at', today())
                ->where('status', 'completed')
                ->sum('total_amount'),
            'pending_orders' => DriverOrder::where('status', 'pending')->count(),
            'unread_contacts' => 0, // Sẽ cập nhật khi có model Contact
        ];

        return response()->json($stats);
    }
}
