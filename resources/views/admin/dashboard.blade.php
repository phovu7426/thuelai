@extends('admin.layouts.main')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Dashboard</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tổng quan</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon text-primary">
                            <i class="fas fa-users"></i>
                        </span>
                        <div class="dash-count">
                            <h3>{{ number_format($totalUsers) }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">
                        <h6 class="text-muted">Tổng người dùng</h6>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary w-{{ min(100, ($newUsers / max(1, $totalUsers)) * 100) }}"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon text-success">
                            <i class="fas fa-car"></i>
                        </span>
                        <div class="dash-count">
                            <h3>{{ number_format($totalServices) }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">
                        <h6 class="text-muted">Dịch vụ lái xe</h6>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-success w-{{ min(100, ($activeServices / max(1, $totalServices)) * 100) }}"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon text-warning">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <div class="dash-count">
                            <h3>{{ number_format($totalContacts) }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">
                        <h6 class="text-muted">Liên hệ</h6>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-warning w-{{ min(100, ($unreadContacts / max(1, $totalContacts)) * 100) }}"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon text-info">
                            <i class="fas fa-star"></i>
                        </span>
                        <div class="dash-count">
                            <h3>{{ number_format($totalTestimonials) }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">
                        <h6 class="text-muted">Đánh giá</h6>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-info w-{{ min(100, ($featuredTestimonials / max(1, $totalTestimonials)) * 100) }}"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Statistics Cards -->

    <!-- Charts Row -->
    <div class="row">
        <!-- Monthly Stats Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Thống kê theo tháng (6 tháng gần nhất)</h4>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="monthlyChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Monthly Stats Chart -->

        <!-- Services Status Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Trạng thái dịch vụ</h4>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="servicesChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Services Status Chart -->
    </div>
    <!-- /Charts Row -->

    <!-- Contacts Status Chart -->
    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Trạng thái liên hệ</h4>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="contactsChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Thống kê nhanh</h4>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <h4 class="text-primary">{{ number_format($newServices) }}</h4>
                                <p class="text-muted mb-0">Dịch vụ mới (7 ngày)</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <h4 class="text-warning">{{ number_format($newContacts) }}</h4>
                            <p class="text-muted mb-0">Liên hệ mới (7 ngày)</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <h4 class="text-success">{{ number_format($newUsers) }}</h4>
                                <p class="text-muted mb-0">Người dùng mới (7 ngày)</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <h4 class="text-info">{{ number_format($newTestimonials) }}</h4>
                            <p class="text-muted mb-0">Đánh giá mới (7 ngày)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Contacts Status Chart -->

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-xl-4 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Dịch vụ gần đây</h4>
                </div>
                <div class="card-body">
                    @if($recentServices->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tên dịch vụ</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentServices->take(5) as $service)
                                    <tr>
                                        <td>{{ $service->name ?? 'N/A' }}</td>
                                        <td>
                                            <span class="badge badge-{{ $service->status == 1 ? 'success' : 'warning' }}">
                                                {{ $service->status == 1 ? 'Hoạt động' : 'Không hoạt động' }}
                                            </span>
                                        </td>
                                        <td>{{ $service->created_at ? $service->created_at->format('d/m/Y') : 'N/A' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-car text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-2">Chưa có dịch vụ nào</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Liên hệ gần đây</h4>
                </div>
                <div class="card-body">
                    @if($recentContacts->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tên khách hàng</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày gửi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentContacts->take(5) as $contact)
                                    <tr>
                                        <td>{{ $contact->customer_name ?? 'N/A' }}</td>
                                        <td>
                                            <span class="badge badge-{{ $contact->status == 1 ? 'success' : 'warning' }}">
                                                {{ $contact->status == 1 ? 'Đã đọc' : 'Chưa đọc' }}
                                            </span>
                                        </td>
                                        <td>{{ $contact->created_at ? $contact->created_at->format('d/m/Y') : 'N/A' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-envelope text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-2">Chưa có liên hệ nào</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Đánh giá gần đây</h4>
                </div>
                <div class="card-body">
                    @if($recentTestimonials->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Khách hàng</th>
                                        <th>Đánh giá</th>
                                        <th>Ngày đánh giá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentTestimonials->take(5) as $testimonial)
                                    <tr>
                                        <td>{{ $testimonial->customer_name ?? 'N/A' }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= ($testimonial->rating ?? 0) ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                            </div>
                                        </td>
                                        <td>{{ $testimonial->created_at ? $testimonial->created_at->format('d/m/Y') : 'N/A' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-star text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-2">Chưa có đánh giá nào</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /Recent Activity -->
</div>

<!-- Data payload for charts (kept outside <script> to avoid linter issues) -->
<div id="dashboard-data"
     data-monthly-months='@json($monthlyStats["months"])'
     data-monthly-services='@json($monthlyStats["services"])'
     data-monthly-contacts='@json($monthlyStats["contacts"])'
     data-services-labels='@json($servicesByStatus["labels"])'
     data-services-data='@json($servicesByStatus["data"])'
     data-contacts-labels='@json($contactsByStatus["labels"])'
     data-contacts-data='@json($contactsByStatus["data"])'></div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dataEl = document.getElementById('dashboard-data');
    const monthlyMonths = JSON.parse(dataEl.getAttribute('data-monthly-months') || '[]');
    const monthlyServices = JSON.parse(dataEl.getAttribute('data-monthly-services') || '[]');
    const monthlyContacts = JSON.parse(dataEl.getAttribute('data-monthly-contacts') || '[]');
    const servicesLabels = JSON.parse(dataEl.getAttribute('data-services-labels') || '[]');
    const servicesData = JSON.parse(dataEl.getAttribute('data-services-data') || '[]');
    const contactsLabels = JSON.parse(dataEl.getAttribute('data-contacts-labels') || '[]');
    const contactsData = JSON.parse(dataEl.getAttribute('data-contacts-data') || '[]');

    // Monthly Stats Chart
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'line',
        data: {
            labels: monthlyMonths,
            datasets: [{
                label: 'Dịch vụ mới',
                data: monthlyServices,
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.1
            }, {
                label: 'Liên hệ mới',
                data: monthlyContacts,
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Services Status Chart
    const servicesCtx = document.getElementById('servicesChart').getContext('2d');
    new Chart(servicesCtx, {
        type: 'doughnut',
        data: {
            labels: servicesLabels,
            datasets: [{
                data: servicesData,
                backgroundColor: [
                    'rgba(40, 167, 69, 0.8)',
                    'rgba(255, 193, 7, 0.8)'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Contacts Status Chart
    const contactsCtx = document.getElementById('contactsChart').getContext('2d');
    new Chart(contactsCtx, {
        type: 'doughnut',
        data: {
            labels: contactsLabels,
            datasets: [{
                data: contactsData,
                backgroundColor: [
                    'rgba(40, 167, 69, 0.8)',
                    'rgba(255, 193, 7, 0.8)'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
});
</script>
@endsection
