<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Kiểm tra và đặt giá trị mặc định để tránh lỗi
        try {
            // Thống kê người dùng
            $totalUsers = User::count();
            $newUsers = User::where('created_at', '>=', now()->subDays(7))->count();
            
            // Thống kê dịch vụ lái xe (thay thế cho sản phẩm đá)
            $totalProducts = 0; // Sẽ được cập nhật khi có model DriverService
            $newProducts = 0;
            
            // Thống kê đơn hàng lái xe (thay thế cho dự án đá)
            $totalProjects = 0; // Sẽ được cập nhật khi có model DriverOrder
            $newProjects = 0;
            
            // Thống kê đơn hàng - đã loại bỏ
            $totalOrders = 0;
            $newOrders = 0;
            $pendingOrders = 0;
            $completedOrders = 0;
            
            // Doanh thu theo tháng (6 tháng gần nhất) - chỉ tính đơn hàng đã hoàn thành
            $revenueData = $this->getMonthlyRevenue();
            
            // Thống kê sản phẩm theo danh mục
            $productsByCategory = $this->getProductsByCategory();
            
            // Thống kê truy cập theo ngày (7 ngày gần nhất)
            $visitsData = $this->getDailyVisits();
            
            // Hoạt động gần đây
            $recentOrders = collect([]);
            $recentProducts = collect([]); // Sẽ được cập nhật khi có model DriverService
            $recentProjects = collect([]); // Sẽ được cập nhật khi có model DriverOrder
            
            // Thống kê liên hệ
            $unreadContacts = 0; // Sẽ được cập nhật khi có model DriverContact
        } catch (\Exception $e) {
            // Nếu có lỗi, đặt giá trị mặc định
            $totalUsers = 0;
            $newUsers = 0;
            $totalProducts = 0;
            $newProducts = 0;
            $totalProjects = 0;
            $newProjects = 0;
            $totalOrders = 0;
            $newOrders = 0;
            $pendingOrders = 0;
            $completedOrders = 0;
            $revenueData = ['months' => [], 'revenue' => []];
            $productsByCategory = ['labels' => [], 'data' => []];
            $visitsData = ['days' => ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'], 'visits' => [0, 0, 0, 0, 0, 0, 0]];
            $recentOrders = collect([]);
            $recentProducts = collect([]);
            $recentProjects = collect([]);
            $unreadContacts = 0;
        }
        
        return view('admin.dashboard', compact(
            'totalUsers', 'newUsers',
            'totalProducts', 'newProducts',
            'totalProjects', 'newProjects',
            'totalOrders', 'newOrders', 'pendingOrders', 'completedOrders',
            'revenueData', 'productsByCategory', 'visitsData',
            'recentOrders', 'recentProducts', 'recentProjects',
            'unreadContacts'
        ));
    }
    
    /**
     * Lấy doanh thu theo tháng (6 tháng gần nhất)
     */
    private function getMonthlyRevenue()
    {
        try {
            $months = collect([]);
            $revenue = collect([]);
            
            // Lấy dữ liệu 6 tháng gần nhất
            for ($i = 5; $i >= 0; $i--) {
                $date = Carbon::now()->subMonths($i);
                $monthName = $date->format('m/Y'); // Định dạng tháng/năm
                
                $months->push($monthName);
                
                // Tính tổng doanh thu trong tháng - đã loại bỏ
                $monthlyRevenue = 0;
                
                $revenue->push($monthlyRevenue);
            }
            
            return [
                'months' => $months,
                'revenue' => $revenue
            ];
        } catch (\Exception $e) {
            return [
                'months' => ['01/2023', '02/2023', '03/2023', '04/2023', '05/2023', '06/2023'],
                'revenue' => [0, 0, 0, 0, 0, 0]
            ];
        }
    }
    
    /**
     * Lấy thống kê sản phẩm theo danh mục
     */
    private function getProductsByCategory()
    {
        // Stone functionality removed - return default data
        return [
            'labels' => ['Dịch vụ lái xe', 'Đơn hàng', 'Liên hệ'],
            'data' => [0, 0, 0]
        ];
    }
    
    /**
     * Lấy thống kê truy cập theo ngày (7 ngày gần nhất)
     */
    private function getDailyVisits()
    {
        try {
            $days = collect([]);
            $visits = collect([]);
            
            // Lấy dữ liệu 7 ngày gần nhất
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);
                $dayName = $date->translatedFormat('l'); // Tên thứ
                $shortDay = substr($dayName, 0, 2); // Lấy 2 ký tự đầu
                
                $days->push($shortDay);
                
                // Đếm số lượt truy cập trong ngày
                $dailyVisits = \App\Models\PageVisit::whereDate('created_at', $date)
                    ->distinct('ip_address')
                    ->count('ip_address');
                
                $visits->push($dailyVisits);
            }
            
            return [
                'days' => $days,
                'visits' => $visits
            ];
        } catch (\Exception $e) {
            return [
                'days' => ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'],
                'visits' => [0, 0, 0, 0, 0, 0, 0]
            ];
        }
    }
} 