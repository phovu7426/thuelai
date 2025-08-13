@extends('admin.layouts.main')

@section('title', 'Tổng quan hệ thống')

@section('styles')
<style>
    .stat-card {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
    }
    
    .stat-icon {
        font-size: 2.5rem;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .recent-item {
        border-left: 3px solid #3498db;
        padding-left: 15px;
        margin-bottom: 15px;
    }
    
    .recent-item:hover {
        background-color: #f8f9fa;
    }
    
    .chart-container {
        height: 350px;
    }
    
    .activity-timeline .timeline-item {
        position: relative;
        padding-left: 30px;
        margin-bottom: 15px;
    }
    
    .activity-timeline .timeline-item:before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 2px;
        background-color: #e9ecef;
    }
    
    .activity-timeline .timeline-item:after {
        content: '';
        position: absolute;
        left: -5px;
        top: 0;
        height: 12px;
        width: 12px;
        border-radius: 50%;
        background-color: #3498db;
    }
    
    .quick-action-btn {
        border-radius: 10px;
        padding: 15px;
        text-align: center;
        transition: all 0.3s ease;
    }
    
    .quick-action-btn:hover {
        transform: scale(1.05);
    }
    
    .quick-action-icon {
        font-size: 2rem;
        margin-bottom: 10px;
    }
</style>
@endsection

@section('content')
@php
    // Đặt giá trị mặc định cho các biến nếu chúng không tồn tại
    $totalUsers = $totalUsers ?? \App\Models\User::count() ?? 0;
    $newUsers = $newUsers ?? \App\Models\User::where('created_at', '>=', now()->subDays(7))->count() ?? 0;
    
            $totalProducts = $totalProducts ?? 0;
        $newProducts = $newProducts ?? 0;
        
        $totalProjects = $totalProjects ?? 0;
        $newProjects = $newProjects ?? 0;
    
    // Chỉ đếm đơn hàng thành công
    $totalOrders = $totalOrders ?? \App\Models\Order::where('status', 'completed')->count() ?? 0;
    $newOrders = $newOrders ?? \App\Models\Order::where('status', 'completed')->where('created_at', '>=', now()->subDays(7))->count() ?? 0;
    $pendingOrders = $pendingOrders ?? \App\Models\Order::where('status', 'pending')->count() ?? 0;
    $completedOrders = $completedOrders ?? \App\Models\Order::where('status', 'completed')->count() ?? 0;
    
    // Dữ liệu mẫu cho biểu đồ doanh thu - chỉ tính đơn hàng thành công
    try {
        $months = [];
        $revenues = [];
        
        // Lấy dữ liệu 6 tháng gần nhất
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthName = $date->format('m/Y');
            
            $months[] = $monthName;
            
            // Tính tổng doanh thu trong tháng từ đơn hàng đã hoàn thành
            $monthlyRevenue = \App\Models\Order::where('status', 'completed')
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->sum('total_amount');
            
            $revenues[] = $monthlyRevenue;
        }
        
        $revenueData = $revenueData ?? [
            'months' => $months,
            'revenue' => $revenues
        ];
    } catch (\Exception $e) {
        $revenueData = $revenueData ?? [
            'months' => ['01/2023', '02/2023', '03/2023', '04/2023', '05/2023', '06/2023'],
            'revenue' => [30000000, 40000000, 35000000, 50000000, 49000000, 60000000]
        ];
    }
    
    // Dữ liệu mẫu cho biểu đồ sản phẩm theo danh mục
    $productsByCategory = $productsByCategory ?? [
        'labels' => ['Đá Marble', 'Đá Granite', 'Đá Onyx', 'Đá Terrazzo', 'Khác'],
        'data' => [44, 55, 13, 43, 22]
    ];
    
    // Dữ liệu mẫu cho biểu đồ lượt truy cập
    $visitsData = $visitsData ?? [
        'days' => ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'],
        'visits' => [31, 40, 28, 51, 42, 109, 100]
    ];
    
    // Hoạt động gần đây
    $recentOrders = $recentOrders ?? \App\Models\Order::latest()->take(3)->get() ?? collect([]);
            $recentProducts = $recentProducts ?? collect([]);
        $recentProjects = $recentProjects ?? collect([]);
        
        $unreadContacts = $unreadContacts ?? 0;
@endphp

<div class="app-content">
    <div class="container-fluid">
        <!-- Thống kê tổng quan -->
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="mb-4">Tổng quan hệ thống</h2>
            </div>
            
            <!-- Thống kê người dùng -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card bg-primary bg-gradient text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-white-50">Người dùng</div>
                                <div class="fs-3 fw-bold">{{ $totalUsers }}</div>
                                <div class="small text-white-50">
                                    <i class="bi bi-arrow-up"></i> 
                                    {{ $newUsers }} mới trong tuần
                                </div>
                            </div>
                            <div class="stat-icon bg-white text-primary">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">
                        <a href="{{ route('admin.users.index') }}" class="text-white stretched-link">Xem chi tiết</a>
                        <div class="text-white"><i class="bi bi-chevron-right"></i></div>
                    </div>
                </div>
            </div>
            
            <!-- Thống kê sản phẩm -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card bg-success bg-gradient text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-white-50">Dịch vụ lái xe</div>
                                <div class="fs-3 fw-bold">{{ $totalProducts }}</div>
                                <div class="small text-white-50">
                                    <i class="bi bi-arrow-up"></i> 
                                    {{ $newProducts }} mới trong tháng
                                </div>
                            </div>
                            <div class="stat-icon bg-white text-success">
                                <i class="bi bi-car-front"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">
                        <a href="{{ route('admin.driver.services.index') }}" class="text-white stretched-link">Xem chi tiết</a>
                        <div class="text-white"><i class="bi bi-chevron-right"></i></div>
                    </div>
                </div>
            </div>
            
            <!-- Thống kê dự án -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card bg-warning bg-gradient text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-white-50">Đơn hàng lái xe</div>
                                <div class="fs-3 fw-bold">{{ $totalProjects }}</div>
                                <div class="small text-white-50">
                                    <i class="bi bi-arrow-up"></i> 
                                    {{ $newProjects }} mới trong tháng
                                </div>
                            </div>
                            <div class="stat-icon bg-white text-warning">
                                <i class="bi bi-building"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">
                        <a href="{{ route('admin.driver.services.index') }}" class="text-white stretched-link">Xem chi tiết</a>
                        <div class="text-white"><i class="bi bi-chevron-right"></i></div>
                    </div>
                </div>
            </div>
            
            <!-- Thống kê đơn hàng -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card bg-danger bg-gradient text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-white-50">Liên hệ</div>
                                <div class="fs-3 fw-bold">{{ $totalOrders }}</div>
                                <div class="small text-white-50">
                                    <i class="bi bi-arrow-up"></i> 
                                    {{ $newOrders }} mới trong tuần
                                </div>
                            </div>
                            <div class="stat-icon bg-white text-danger">
                                <i class="bi bi-cart-check"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">
                        <a href="{{ route('admin.driver.orders.index') }}" class="text-white stretched-link">Xem chi tiết</a>
                        <div class="text-white"><i class="bi bi-chevron-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Biểu đồ và hoạt động gần đây -->
        <div class="row mb-4">
            <!-- Biểu đồ doanh thu -->
            <div class="col-xl-8 col-lg-7">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Thống kê doanh thu</h5>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="revenueTimeRange" data-bs-toggle="dropdown" aria-expanded="false">
                                6 tháng gần nhất
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="revenueTimeRange">
                                <li><a class="dropdown-item" href="#">6 tháng gần nhất</a></li>
                                <li><a class="dropdown-item" href="#">Quý này</a></li>
                                <li><a class="dropdown-item" href="#">Năm nay</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="revenueChart" class="chart-container"></div>
                    </div>
                </div>
            </div>
            
            <!-- Hoạt động gần đây -->
            <div class="col-xl-4 col-lg-5">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Hoạt động gần đây</h5>
                    </div>
                    <div class="card-body">
                        <div class="activity-timeline">
                            @forelse($recentOrders as $order)
                            <div class="timeline-item">
                                <div class="d-flex justify-content-between">
                                    <span class="fw-bold">Đơn hàng mới #{{ $order->id }}</span>
                                    <small class="text-muted">{{ $order->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-0">{{ $order->customer_name ?? 'Khách hàng' }} - {{ number_format($order->total_amount) }}đ</p>
                            </div>
                            @empty
                            <div class="text-center py-3">
                                <p class="text-muted">Không có đơn hàng mới</p>
                            </div>
                            @endforelse
                            
                            @forelse($recentProducts as $product)
                            <div class="timeline-item">
                                <div class="d-flex justify-content-between">
                                    <span class="fw-bold">Sản phẩm mới</span>
                                    <small class="text-muted">{{ $product->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-0">{{ $product->name }}</p>
                            </div>
                            @empty
                            @endforelse
                            
                            @forelse($recentProjects as $project)
                            <div class="timeline-item">
                                <div class="d-flex justify-content-between">
                                    <span class="fw-bold">Dự án mới</span>
                                    <small class="text-muted">{{ $project->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-0">{{ $project->name }}</p>
                            </div>
                            @empty
                            @endforelse
                            
                            <div class="text-center mt-3">
                                <a href="{{ route('admin.driver.orders.index') }}" class="btn btn-sm btn-outline-primary">Xem tất cả</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Thống kê chi tiết và truy cập -->
        <div class="row mb-4">
            <!-- Thống kê sản phẩm theo danh mục -->
            <div class="col-xl-6 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Sản phẩm theo danh mục</h5>
                    </div>
                    <div class="card-body">
                        <div id="categoryChart" class="chart-container"></div>
                    </div>
                </div>
            </div>
            
            <!-- Thống kê truy cập -->
            <div class="col-xl-6 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Lượt truy cập</h5>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="visitsTimeRange" data-bs-toggle="dropdown" aria-expanded="false">
                                7 ngày qua
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="visitsTimeRange">
                                <li><a class="dropdown-item" href="#">7 ngày qua</a></li>
                                <li><a class="dropdown-item" href="#">30 ngày qua</a></li>
                                <li><a class="dropdown-item" href="#">90 ngày qua</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="visitsChart" class="chart-container"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Truy cập nhanh -->
        <div class="row mb-4">
            <div class="col-12">
                <h5 class="mb-3">Truy cập nhanh</h5>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card quick-action-btn bg-light h-100">
                    <div class="card-body text-center">
                        <div class="quick-action-icon text-primary">
                            <i class="bi bi-plus-circle"></i>
                        </div>
                        <h5>Thêm dịch vụ lái xe</h5>
                        <a href="{{ route('admin.driver.services.create') }}" class="btn btn-sm btn-primary mt-2">Truy cập</a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card quick-action-btn bg-light h-100">
                    <div class="card-body text-center">
                        <div class="quick-action-icon text-success">
                            <i class="bi bi-file-earmark-plus"></i>
                        </div>
                        <h5>Thêm đơn hàng</h5>
                        <a href="{{ route('admin.driver.orders.create') }}" class="btn btn-sm btn-success mt-2">Truy cập</a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card quick-action-btn bg-light h-100">
                    <div class="card-body text-center">
                        <div class="quick-action-icon text-warning">
                            <i class="bi bi-people"></i>
                        </div>
                        <h5>Quản lý người dùng</h5>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-warning mt-2">Truy cập</a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card quick-action-btn bg-light h-100">
                    <div class="card-body text-center">
                        <div class="quick-action-icon text-danger">
                            <i class="bi bi-gear"></i>
                        </div>
                        <h5>Cài đặt hệ thống</h5>
                        <a href="{{ route('admin.contact-info.edit') }}" class="btn btn-sm btn-danger mt-2">Truy cập</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Biểu đồ doanh thu
        var revenueOptions = {
            series: [{
                name: 'Doanh thu',
                data: @json($revenueData['revenue'])
            }],
            chart: {
                type: 'area',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                categories: @json($revenueData['months']),
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' đ';
                    }
                }
            },
            colors: ['#0d6efd']
        };
        
        var revenueChart = new ApexCharts(document.querySelector("#revenueChart"), revenueOptions);
        revenueChart.render();
        
        // Biểu đồ sản phẩm theo danh mục
        var categoryOptions = {
            series: @json($productsByCategory['data']),
            chart: {
                type: 'pie',
                height: 350
            },
            labels: @json($productsByCategory['labels']),
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }],
            colors: ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#6c757d', '#0dcaf0', '#6610f2', '#fd7e14']
        };
        
        var categoryChart = new ApexCharts(document.querySelector("#categoryChart"), categoryOptions);
        categoryChart.render();
        
        // Biểu đồ lượt truy cập
        var visitsOptions = {
            series: [{
                name: 'Lượt truy cập',
                data: @json($visitsData['visits'])
            }],
            chart: {
                height: 350,
                type: 'line',
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: @json($visitsData['days']),
            },
            colors: ['#dc3545']
        };
        
        var visitsChart = new ApexCharts(document.querySelector("#visitsChart"), visitsOptions);
        visitsChart.render();
    });
</script>
@endsection
