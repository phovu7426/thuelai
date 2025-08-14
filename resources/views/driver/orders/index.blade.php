@extends('driver.layouts.main')

@section('page_title', 'Danh sách đơn hàng - ThuêLai.vn')

@section('content')
<div class="orders-page">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <div class="hero-content">
                        <h1 class="hero-title">
                            <span class="gradient-text">Danh sách đơn hàng</span>
                        </h1>
                        <p class="hero-subtitle">Quản lý tất cả dịch vụ lái xe của bạn một cách dễ dàng</p>
                        <div class="hero-stats">
                            <div class="stat-item">
                                <div class="stat-number">{{ $orders->count() }}</div>
                                <div class="stat-label">Tổng đơn hàng</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">{{ $orders->where('status', 'completed')->count() }}</div>
                                <div class="stat-label">Đã hoàn thành</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">{{ $orders->where('status', 'pending')->count() }}</div>
                                <div class="stat-label">Đang chờ</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders Content -->
    <div class="orders-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    @if($orders->count() > 0)
                        <div class="orders-grid">
                            @foreach($orders as $order)
                            <div class="order-card-wrapper">
                                <div class="order-card">
                                    <div class="order-card-header">
                                        <div class="order-number">
                                            <i class="fas fa-receipt"></i>
                                            <span>{{ $order->order_number }}</span>
                                        </div>
                                        <div class="order-status">
                                            @php
                                                $statusConfig = [
                                                    'pending' => ['color' => 'warning', 'label' => 'Chờ xác nhận', 'icon' => 'clock'],
                                                    'confirmed' => ['color' => 'info', 'label' => 'Đã xác nhận', 'icon' => 'check-circle'],
                                                    'in_progress' => ['color' => 'primary', 'label' => 'Đang thực hiện', 'icon' => 'car'],
                                                    'completed' => ['color' => 'success', 'label' => 'Hoàn thành', 'icon' => 'flag-checkered'],
                                                    'cancelled' => ['color' => 'danger', 'label' => 'Đã hủy', 'icon' => 'times-circle']
                                                ];
                                                $status = $statusConfig[$order->status];
                                            @endphp
                                            <span class="status-badge status-{{ $status['color'] }}">
                                                <i class="fas fa-{{ $status['icon'] }}"></i>
                                                {{ $status['label'] }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="order-card-body">
                                        <div class="service-info">
                                            <div class="service-name">
                                                <i class="fas fa-car-side"></i>
                                                {{ $order->service->name }}
                                            </div>
                                            <div class="service-type">
                                                @switch($order->service_type)
                                                    @case('hourly')
                                                        <i class="fas fa-clock"></i> Theo giờ
                                                        @if($order->hours) - {{ $order->hours }} giờ @endif
                                                        @break
                                                    @case('trip')
                                                        <i class="fas fa-route"></i> Theo chuyến
                                                        @break
                                                    @case('custom')
                                                        <i class="fas fa-cog"></i> Tùy chỉnh
                                                        @break
                                                @endswitch
                                            </div>
                                        </div>
                                        
                                        <div class="order-details">
                                            <div class="detail-row">
                                                <div class="detail-item">
                                                    <i class="fas fa-calendar-alt"></i>
                                                    <span class="detail-label">Thời gian:</span>
                                                    <span class="detail-value">{{ $order->pickup_datetime->format('H:i - d/m/Y') }}</span>
                                                </div>
                                                <div class="detail-item">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    <span class="detail-label">Địa điểm:</span>
                                                    <span class="detail-value">{{ Str::limit($order->pickup_location, 35) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="order-footer">
                                            <div class="total-amount">
                                                <span class="amount-label">Tổng tiền</span>
                                                <span class="amount-value">{{ number_format($order->total_amount) }}đ</span>
                                            </div>
                                            <div class="order-actions">
                                                <a href="{{ route('driver.order.show', $order->id) }}" class="btn-view-detail">
                                                    <i class="fas fa-eye"></i>
                                                    <span>Xem chi tiết</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if($orders->hasPages())
                        <div class="pagination-wrapper">
                            {{ $orders->links() }}
                        </div>
                        @endif
                    @else
                        <div class="empty-state">
                            <div class="empty-illustration">
                                <div class="empty-icon">
                                    <i class="fas fa-inbox"></i>
                                </div>
                                <div class="empty-ripple"></div>
                            </div>
                            <h3 class="empty-title">Chưa có đơn hàng nào</h3>
                            <p class="empty-description">
                                Bạn chưa đặt dịch vụ lái xe nào. Hãy bắt đầu trải nghiệm dịch vụ chất lượng của chúng tôi ngay hôm nay!
                            </p>
                            <div class="empty-actions">
                                <a href="{{ route('driver.booking') }}" class="btn-primary-gradient">
                                    <i class="fas fa-plus"></i>
                                    Đặt dịch vụ ngay
                                </a>
                            </div>
                        </div>
                    @endif

                    <!-- Quick Actions -->
                    <div class="quick-actions">
                        <div class="action-cards">
                            <a href="{{ route('driver.booking') }}" class="action-card">
                                <div class="action-icon">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="action-content">
                                    <h4>Đặt dịch vụ mới</h4>
                                    <p>Đặt dịch vụ lái xe mới</p>
                                </div>
                            </a>
                            <a href="{{ route('driver.home') }}" class="action-card">
                                <div class="action-icon">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="action-content">
                                    <h4>Về trang chủ</h4>
                                    <p>Quay lại trang chủ</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Hero Section - Giảm chiều cao và cải thiện contrast */
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 2.5rem 0; /* Giảm từ 4rem xuống 2.5rem */
    position: relative;
    overflow: hidden;
    margin-top: 80px; /* Thêm margin-top để tránh bị menu che */
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.hero-content {
    position: relative;
    z-index: 2;
}

.hero-title {
    font-size: 2.5rem; /* Giảm từ 3.5rem xuống 2.5rem */
    font-weight: 800;
    margin-bottom: 1rem;
    color: #ffffff; /* Đảm bảo màu trắng thuần */
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3); /* Thêm text shadow */
}

.gradient-text {
    background: linear-gradient(45deg, #ffffff, #f0f8ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-subtitle {
    font-size: 1.1rem; /* Giảm từ 1.2rem xuống 1.1rem */
    color: rgba(255, 255, 255, 0.95); /* Tăng opacity */
    margin-bottom: 2rem; /* Giảm từ 3rem xuống 2rem */
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
}

.hero-stats {
    display: flex;
    justify-content: center;
    gap: 2rem; /* Giảm từ 3rem xuống 2rem */
    margin-top: 1.5rem; /* Giảm từ 2rem xuống 1.5rem */
}

.stat-item {
    text-align: center;
    color: white;
}

.stat-number {
    font-size: 2rem; /* Giảm từ 2.5rem xuống 2rem */
    font-weight: 700;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.stat-label {
    font-size: 0.85rem; /* Giảm từ 0.9rem xuống 0.85rem */
    opacity: 0.9; /* Tăng opacity */
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
}

/* Orders Content - Giảm padding */
.orders-content {
    padding: 2.5rem 0; /* Giảm từ 4rem xuống 2.5rem */
    background: #f8fafc;
    min-height: 50vh; /* Giảm từ 60vh xuống 50vh */
}

.orders-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); /* Giảm từ 400px xuống 350px */
    gap: 1.5rem; /* Giảm từ 2rem xuống 1.5rem */
    margin-bottom: 2rem; /* Giảm từ 3rem xuống 2rem */
}

.order-card-wrapper {
    perspective: 1000px;
}

.order-card {
    background: white;
    border-radius: 15px; /* Giảm từ 20px xuống 15px */
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
}

.order-card:hover {
    transform: translateY(-5px) rotateX(1deg); /* Giảm từ -8px xuống -5px */
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
}

.order-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px; /* Giảm từ 4px xuống 3px */
    background: linear-gradient(90deg, #667eea, #764ba2);
}

.order-card-header {
    padding: 1rem; /* Giảm từ 1.5rem xuống 1rem */
    background: linear-gradient(135deg, #f8fafc, #e2e8f0);
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.order-number {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: #4a5568;
}

.order-number i {
    color: #667eea;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.4rem 0.8rem; /* Giảm padding */
    border-radius: 20px; /* Giảm từ 25px xuống 20px */
    font-size: 0.8rem; /* Giảm từ 0.85rem xuống 0.8rem */
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.3px; /* Giảm từ 0.5px xuống 0.3px */
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15); /* Thêm shadow */
}

.status-warning {
    background: linear-gradient(135deg, #fbbf24, #f59e0b);
    color: white;
}

.status-info {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: white;
}

.status-primary {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
}

.status-success {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
}

.status-danger {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
}

.order-card-body {
    padding: 1rem; /* Giảm từ 1.5rem xuống 1rem */
}

.service-info {
    margin-bottom: 1rem; /* Giảm từ 1.5rem xuống 1rem */
}

.service-name {
    font-size: 1.1rem; /* Giảm từ 1.2rem xuống 1.1rem */
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 0.4rem; /* Giảm từ 0.5rem xuống 0.4rem */
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.service-name i {
    color: #667eea;
}

.service-type {
    color: #718096;
    font-size: 0.85rem; /* Giảm từ 0.9rem xuống 0.85rem */
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.service-type i {
    color: #a0aec0;
}

.order-details {
    margin-bottom: 1rem; /* Giảm từ 1.5rem xuống 1rem */
}

.detail-row {
    display: flex;
    flex-direction: column;
    gap: 0.6rem; /* Giảm từ 0.75rem xuống 0.6rem */
}

.detail-item {
    display: flex;
    align-items: center;
    gap: 0.6rem; /* Giảm từ 0.75rem xuống 0.6rem */
    padding: 0.6rem; /* Giảm từ 0.75rem xuống 0.6rem */
    background: #f7fafc;
    border-radius: 8px; /* Giảm từ 10px xuống 8px */
    border-left: 3px solid #667eea; /* Giảm từ 3px xuống 3px */
}

.detail-item i {
    color: #667eea;
    width: 14px; /* Giảm từ 16px xuống 14px */
}

.detail-label {
    font-weight: 500;
    color: #4a5568;
    min-width: 70px; /* Giảm từ 80px xuống 70px */
    font-size: 0.85rem; /* Giảm từ 0.9rem xuống 0.85rem */
}

.detail-value {
    color: #2d3748;
    font-weight: 500;
    font-size: 0.9rem; /* Giảm từ 1rem xuống 0.9rem */
}

.order-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 0.8rem; /* Giảm từ 1rem xuống 0.8rem */
    border-top: 1px solid #e2e8f0;
}

.total-amount {
    text-align: center;
}

.amount-label {
    display: block;
    font-size: 0.75rem; /* Giảm từ 0.8rem xuống 0.75rem */
    color: #718096;
    margin-bottom: 0.2rem; /* Giảm từ 0.25rem xuống 0.2rem */
}

.amount-value {
    font-size: 1.2rem; /* Giảm từ 1.4rem xuống 1.2rem */
    font-weight: 700;
    color: #10b981;
}

.btn-view-detail {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem; /* Giảm từ 0.5rem xuống 0.4rem */
    padding: 0.6rem 1.2rem; /* Giảm từ 0.75rem 1.5rem xuống 0.6rem 1.2rem */
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    text-decoration: none;
    border-radius: 10px; /* Giảm từ 12px xuống 10px */
    font-weight: 500;
    transition: all 0.3s ease;
    box-shadow: 0 3px 12px rgba(102, 126, 234, 0.3);
    font-size: 0.85rem; /* Giảm từ 0.9rem xuống 0.85rem */
}

.btn-view-detail:hover {
    transform: translateY(-1px); /* Giảm từ -2px xuống -1px */
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    color: white;
    text-decoration: none;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 3rem 2rem; /* Giảm từ 4rem xuống 3rem */
}

.empty-illustration {
    position: relative;
    display: inline-block;
    margin-bottom: 1.5rem; /* Giảm từ 2rem xuống 1.5rem */
}

.empty-icon {
    width: 100px; /* Giảm từ 120px xuống 100px */
    height: 100px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem; /* Giảm từ 3rem xuống 2.5rem */
    color: white;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}

.empty-ripple {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 130px; /* Giảm từ 160px xuống 130px */
    height: 130px;
    border: 2px solid rgba(102, 126, 234, 0.2);
    border-radius: 50%;
    animation: ripple 2s infinite;
}

@keyframes ripple {
    0% {
        transform: translate(-50%, -50%) scale(0.8);
        opacity: 1;
    }
    100% {
        transform: translate(-50%, -50%) scale(1.1); /* Giảm từ 1.2 xuống 1.1 */
        opacity: 0;
    }
}

.empty-title {
    font-size: 1.8rem; /* Giảm từ 2rem xuống 1.8rem */
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 0.8rem; /* Giảm từ 1rem xuống 0.8rem */
}

.empty-description {
    font-size: 1rem; /* Giảm từ 1.1rem xuống 1rem */
    color: #718096;
    margin-bottom: 1.5rem; /* Giảm từ 2rem xuống 1.5rem */
    max-width: 450px; /* Giảm từ 500px xuống 450px */
    margin-left: auto;
    margin-right: auto;
}

.btn-primary-gradient {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.8rem 1.8rem; /* Giảm từ 1rem 2rem xuống 0.8rem 1.8rem */
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    text-decoration: none;
    border-radius: 12px; /* Giảm từ 15px xuống 12px */
    font-weight: 600;
    font-size: 1rem; /* Giảm từ 1.1rem xuống 1rem */
    transition: all 0.3s ease;
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3);
}

.btn-primary-gradient:hover {
    transform: translateY(-2px); /* Giảm từ -3px xuống -2px */
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    color: white;
    text-decoration: none;
}

/* Quick Actions */
.quick-actions {
    margin-top: 2.5rem; /* Giảm từ 4rem xuống 2.5rem */
}

.action-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); /* Giảm từ 250px xuống 220px */
    gap: 1.2rem; /* Giảm từ 1.5rem xuống 1.2rem */
}

.action-card {
    background: white;
    padding: 1.5rem; /* Giảm từ 2rem xuống 1.5rem */
    border-radius: 15px; /* Giảm từ 20px xuống 15px */
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    border: 2px solid transparent;
}

.action-card:hover {
    transform: translateY(-3px); /* Giảm từ -5px xuống -3px */
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    border-color: #667eea;
    color: inherit;
    text-decoration: none;
}

.action-icon {
    width: 50px; /* Giảm từ 60px xuống 50px */
    height: 50px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 12px; /* Giảm từ 15px xuống 12px */
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem; /* Giảm từ 1.5rem xuống 1.3rem */
    color: white;
    margin-bottom: 0.8rem; /* Giảm từ 1rem xuống 0.8rem */
}

.action-content h4 {
    font-size: 1.1rem; /* Giảm từ 1.2rem xuống 1.1rem */
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 0.4rem; /* Giảm từ 0.5rem xuống 0.4rem */
}

.action-content p {
    color: #718096;
    margin: 0;
    font-size: 0.9rem; /* Giảm từ 1rem xuống 0.9rem */
}

/* Pagination */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 2rem; /* Giảm từ 3rem xuống 2rem */
}

.pagination-wrapper .pagination {
    gap: 0.4rem; /* Giảm từ 0.5rem xuống 0.4rem */
}

.pagination-wrapper .page-link {
    border-radius: 8px; /* Giảm từ 10px xuống 8px */
    border: none;
    padding: 0.6rem 0.8rem; /* Giảm từ 0.75rem 1rem xuống 0.6rem 0.8rem */
    color: #4a5568;
    font-weight: 500;
    transition: all 0.3s ease;
    font-size: 0.9rem; /* Giảm từ 1rem xuống 0.9rem */
}

.pagination-wrapper .page-link:hover {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    transform: translateY(-1px); /* Giảm từ -2px xuống -1px */
}

.pagination-wrapper .page-item.active .page-link {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-section {
        padding: 2rem 0; /* Giảm thêm cho mobile */
        margin-top: 70px; /* Giảm margin-top cho mobile */
    }
    
    .hero-title {
        font-size: 2rem; /* Giảm từ 2.5rem xuống 2rem */
    }
    
    .hero-stats {
        flex-direction: column;
        gap: 1rem; /* Giảm từ 1.5rem xuống 1rem */
    }
    
    .orders-grid {
        grid-template-columns: 1fr;
        gap: 1rem; /* Giảm từ 1.5rem xuống 1rem */
    }
    
    .order-card-header {
        flex-direction: column;
        gap: 0.8rem; /* Giảm từ 1rem xuống 0.8rem */
        text-align: center;
    }
    
    .order-footer {
        flex-direction: column;
        gap: 0.8rem; /* Giảm từ 1rem xuống 0.8rem */
        text-align: center;
    }
    
    .action-cards {
        grid-template-columns: 1fr;
    }
    
    .orders-content {
        padding: 1.5rem 0; /* Giảm padding cho mobile */
    }
}
</style>
@endpush

