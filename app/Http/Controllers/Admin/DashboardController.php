<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\StoneProduct;
use App\Models\StoneProject;
use App\Models\User;
use App\Models\StoneCategory;
use App\Models\StoneContact;
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
            
            // Thống kê sản phẩm
            $totalProducts = StoneProduct::count();
            $newProducts = StoneProduct::where('created_at', '>=', now()->subDays(30))->count();
            
            // Thống kê dự án
            $totalProjects = StoneProject::count();
            $newProjects = StoneProject::where('created_at', '>=', now()->subDays(30))->count();
            
            // Thống kê đơn hàng - chỉ đếm đơn hàng thành công
            $totalOrders = Order::where('status', 'completed')->count();
            $newOrders = Order::where('status', 'completed')->where('created_at', '>=', now()->subDays(7))->count();
            $pendingOrders = Order::where('status', 'pending')->count();
            $completedOrders = Order::where('status', 'completed')->count();
            
            // Doanh thu theo tháng (6 tháng gần nhất) - chỉ tính đơn hàng đã hoàn thành
            $revenueData = $this->getMonthlyRevenue();
            
            // Thống kê sản phẩm theo danh mục
            $productsByCategory = $this->getProductsByCategory();
            
            // Thống kê truy cập theo ngày (7 ngày gần nhất)
            $visitsData = $this->getDailyVisits();
            
            // Hoạt động gần đây
            $recentOrders = Order::latest()->take(3)->get();
            $recentProducts = StoneProduct::latest()->take(3)->get();
            $recentProjects = StoneProject::latest()->take(2)->get();
            
            // Thống kê liên hệ
            $unreadContacts = StoneContact::where('is_read', 0)->count();
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
                
                // Tính tổng doanh thu trong tháng - CHỈ từ đơn hàng đã hoàn thành
                $monthlyRevenue = Order::where('status', 'completed')
                    ->whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->sum('total_amount');
                
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
        try {
            // Lấy tất cả danh mục (bao gồm cả danh mục con)
            $categories = StoneCategory::all();
            
            $labels = collect([]);
            $data = collect([]);
            
            foreach ($categories as $category) {
                // Đếm số lượng sản phẩm trong category
                $productCount = StoneProduct::where('stone_category_id', $category->id)
                    ->where('status', true) // Chỉ đếm sản phẩm đang hoạt động
                    ->count();
                
                // Chỉ thêm vào biểu đồ nếu có sản phẩm
                if ($productCount > 0) {
                    // Thêm tên danh mục cha vào nếu có
                    $categoryName = $category->parent 
                        ? $category->parent->name . ' - ' . $category->name 
                        : $category->name;
                        
                    $labels->push($categoryName);
                    $data->push($productCount);
                }
            }
            
            // Nếu không có dữ liệu
            if ($labels->isEmpty()) {
                return [
                    'labels' => ['Không có dữ liệu'],
                    'data' => [0]
                ];
            }
            
            return [
                'labels' => $labels,
                'data' => $data
            ];
        } catch (\Exception $e) {
            return [
                'labels' => ['Không có dữ liệu'],
                'data' => [0]
            ];
        }
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