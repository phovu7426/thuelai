@extends('driver.layouts.main')

@section('page_title', 'Chi tiết đơn hàng - ThuêLai.vn')

@section('content')
<div class="order-detail-page">
    <!-- Hero Header -->
    <div class="hero-header">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="hero-content">
                        <div class="order-header-info">
                            <div class="order-title-section">
                                <h1 class="page-title">
                                    <i class="fas fa-receipt"></i>
                                    Chi tiết đơn hàng
                                </h1>
                                <div class="order-number-badge">
                                    <span class="order-number-label">Mã đơn hàng:</span>
                                    <span class="order-number-value">{{ $order->order_number }}</span>
                                </div>
                            </div>
                            <div class="order-status-section">
                                @php
                                    $statusConfig = [
                                        'pending' => ['color' => 'warning', 'label' => 'Chờ xác nhận', 'icon' => 'clock', 'bg' => 'linear-gradient(135deg, #fbbf24, #f59e0b)'],
                                        'confirmed' => ['color' => 'info', 'label' => 'Đã xác nhận', 'icon' => 'check-circle', 'bg' => 'linear-gradient(135deg, #3b82f6, #1d4ed8)'],
                                        'in_progress' => ['color' => 'primary', 'label' => 'Đang thực hiện', 'icon' => 'car', 'bg' => 'linear-gradient(135deg, #667eea, #764ba2)'],
                                        'completed' => ['color' => 'success', 'label' => 'Hoàn thành', 'icon' => 'flag-checkered', 'bg' => 'linear-gradient(135deg, #10b981, #059669)'],
                                        'cancelled' => ['color' => 'danger', 'label' => 'Đã hủy', 'icon' => 'times-circle', 'bg' => 'linear-gradient(135deg, #ef4444, #dc2626)']
                                    ];
                                    $status = $statusConfig[$order->status];
                                @endphp
                                <div class="status-card" style="background: {{ $status['bg'] }}">
                                    <div class="status-icon">
                                        <i class="fas fa-{{ $status['icon'] }}"></i>
                                    </div>
                                    <div class="status-info">
                                        <div class="status-label">Trạng thái</div>
                                        <div class="status-value">{{ $status['label'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Content -->
    <div class="order-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="order-sections">
                        <!-- Order Information -->
                        <div class="info-section">
                            <div class="section-card">
                                <div class="section-header">
                                    <div class="section-icon">
                                        <i class="fas fa-info-circle"></i>
                                    </div>
                                    <h3 class="section-title">Thông tin đơn hàng</h3>
                                </div>
                                <div class="section-body">
                                    <div class="info-grid">
                                        <div class="info-item">
                                            <div class="info-icon">
                                                <i class="fas fa-car-side"></i>
                                            </div>
                                            <div class="info-content">
                                                <div class="info-label">Dịch vụ</div>
                                                <div class="info-value">{{ $order->service->name }}</div>
                                            </div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-icon">
                                                <i class="fas fa-cog"></i>
                                            </div>
                                            <div class="info-content">
                                                <div class="info-label">Loại dịch vụ</div>
                                                <div class="info-value">
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
                                        </div>
                                        <div class="info-item">
                                            <div class="info-icon">
                                                <i class="fas fa-calendar-alt"></i>
                                            </div>
                                            <div class="info-content">
                                                <div class="info-label">Thời gian đón</div>
                                                <div class="info-value">{{ $order->pickup_datetime->format('H:i - d/m/Y') }}</div>
                                            </div>
                                        </div>
                                        @if($order->hours)
                                        <div class="info-item">
                                            <div class="info-icon">
                                                <i class="fas fa-clock"></i>
                                            </div>
                                            <div class="info-content">
                                                <div class="info-label">Số giờ</div>
                                                <div class="info-value">{{ $order->hours }} giờ</div>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="info-item">
                                            <div class="info-icon">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                            <div class="info-content">
                                                <div class="info-label">Địa điểm đón</div>
                                                <div class="info-value">{{ $order->pickup_location }}</div>
                                            </div>
                                        </div>
                                        @if($order->destination)
                                        <div class="info-item">
                                            <div class="info-icon">
                                                <i class="fas fa-flag-checkered"></i>
                                            </div>
                                            <div class="info-content">
                                                <div class="info-label">Điểm đến</div>
                                                <div class="info-value">{{ $order->destination }}</div>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="info-item highlight">
                                            <div class="info-icon">
                                                <i class="fas fa-money-bill-wave"></i>
                                            </div>
                                            <div class="info-content">
                                                <div class="info-label">Tổng tiền</div>
                                                <div class="info-value total-amount">{{ number_format($order->total_amount) }}đ</div>
                                            </div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-icon">
                                                <i class="fas fa-calendar-plus"></i>
                                            </div>
                                            <div class="info-content">
                                                <div class="info-label">Ngày đặt</div>
                                                <div class="info-value">{{ $order->created_at->format('d/m/Y H:i') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Information -->
                        <div class="info-section">
                            <div class="section-card">
                                <div class="section-header">
                                    <div class="section-icon">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <h3 class="section-title">Thông tin khách hàng</h3>
                                </div>
                                <div class="section-body">
                                    <div class="customer-info">
                                        <div class="customer-avatar">
                                            <i class="fas fa-user-circle"></i>
                                        </div>
                                        <div class="customer-details">
                                            <div class="customer-name">{{ $order->customer_name }}</div>
                                            <div class="customer-contact">
                                                <div class="contact-item">
                                                    <i class="fas fa-phone"></i>
                                                    <span>{{ $order->customer_phone }}</span>
                                                </div>
                                                @if($order->customer_email)
                                                <div class="contact-item">
                                                    <i class="fas fa-envelope"></i>
                                                    <span>{{ $order->customer_email }}</span>
                                                </div>
                                                @endif
                                                @if($order->user)
                                                <div class="contact-item">
                                                    <i class="fas fa-user-tag"></i>
                                                    <span>Tài khoản: {{ $order->user->name }}</span>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Special Requirements -->
                        @if($order->special_requirements)
                        <div class="info-section">
                            <div class="section-card">
                                <div class="section-header">
                                    <div class="section-icon">
                                        <i class="fas fa-clipboard-list"></i>
                                    </div>
                                    <h3 class="section-title">Yêu cầu đặc biệt</h3>
                                </div>
                                <div class="section-body">
                                    <div class="requirements-content">
                                        <i class="fas fa-quote-left quote-icon"></i>
                                        <p class="requirements-text">{{ $order->special_requirements }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Admin Notes -->
                        @if($order->admin_notes)
                        <div class="info-section">
                            <div class="section-card admin-notes">
                                <div class="section-header">
                                    <div class="section-icon">
                                        <i class="fas fa-comment"></i>
                                    </div>
                                    <h3 class="section-title">Ghi chú từ admin</h3>
                                </div>
                                <div class="section-body">
                                    <div class="notes-content">
                                        <i class="fas fa-info-circle note-icon"></i>
                                        <p class="notes-text">{{ $order->admin_notes }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Order Timeline -->
                        <div class="info-section">
                            <div class="section-card">
                                <div class="section-header">
                                    <div class="section-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <h3 class="section-title">Lịch sử đơn hàng</h3>
                                </div>
                                <div class="section-body">
                                    <div class="timeline">
                                        <div class="timeline-item active">
                                            <div class="timeline-marker">
                                                <i class="fas fa-check"></i>
                                            </div>
                                            <div class="timeline-content">
                                                <div class="timeline-title">Đơn hàng được tạo</div>
                                                <div class="timeline-time">{{ $order->created_at->format('d/m/Y H:i') }}</div>
                                                <div class="timeline-description">Đơn hàng đã được tạo thành công</div>
                                            </div>
                                        </div>
                                        
                                        @if($order->status !== 'pending')
                                        <div class="timeline-item active">
                                            <div class="timeline-marker">
                                                <i class="fas fa-check-double"></i>
                                            </div>
                                            <div class="timeline-content">
                                                <div class="timeline-title">Đơn hàng được xác nhận</div>
                                                <div class="timeline-time">{{ $order->updated_at->format('d/m/Y H:i') }}</div>
                                                <div class="timeline-description">Admin đã xác nhận đơn hàng</div>
                                            </div>
                                        </div>
                                        @endif
                                        
                                        @if($order->status === 'in_progress')
                                        <div class="timeline-item active">
                                            <div class="timeline-marker">
                                                <i class="fas fa-car"></i>
                                            </div>
                                            <div class="timeline-content">
                                                <div class="timeline-title">Đang thực hiện</div>
                                                <div class="timeline-time">Hiện tại</div>
                                                <div class="timeline-description">Lái xe đang trên đường đến địa điểm đón</div>
                                            </div>
                                        </div>
                                        @endif
                                        
                                        @if($order->status === 'completed')
                                        <div class="timeline-item active">
                                            <div class="timeline-marker">
                                                <i class="fas fa-flag-checkered"></i>
                                            </div>
                                            <div class="timeline-content">
                                                <div class="timeline-title">Hoàn thành</div>
                                                <div class="timeline-time">Đã hoàn thành</div>
                                                <div class="timeline-description">Dịch vụ đã hoàn thành thành công</div>
                                            </div>
                                        </div>
                                        @endif
                                        
                                        @if($order->status === 'cancelled')
                                        <div class="timeline-item cancelled">
                                            <div class="timeline-marker">
                                                <i class="fas fa-ban"></i>
                                            </div>
                                            <div class="timeline-content">
                                                <div class="timeline-title">Đã hủy</div>
                                                <div class="timeline-time">Đã hủy</div>
                                                <div class="timeline-description">Đơn hàng đã bị hủy</div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Actions -->
                        <div class="actions-section">
                            <div class="action-buttons">
                                <a href="{{ route('driver.booking') }}" class="btn-action btn-primary">
                                    <i class="fas fa-plus"></i>
                                    <span>Đặt dịch vụ mới</span>
                                </a>
                                <a href="{{ route('driver.home') }}" class="btn-action btn-secondary">
                                    <i class="fas fa-home"></i>
                                    <span>Về trang chủ</span>
                                </a>
                                @if($order->status === 'pending')
                                <button type="button" class="btn-action btn-danger" onclick="cancelOrder()">
                                    <i class="fas fa-times"></i>
                                    <span>Hủy đơn hàng</span>
                                </button>
                                @endif
                            </div>
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
/* Hero Header - Giảm chiều cao và cải thiện contrast */
.hero-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 2rem 0; /* Giảm từ 3rem xuống 2rem */
    position: relative;
    overflow: hidden;
    margin-top: 80px; /* Thêm margin-top để tránh bị menu che */
}

.hero-header::before {
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

.order-header-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1.5rem; /* Giảm gap */
}

.order-title-section {
    flex: 1;
}

.page-title {
    font-size: 2rem; /* Giảm từ 2.5rem xuống 2rem */
    font-weight: 700;
    color: #ffffff; /* Đảm bảo màu trắng thuần */
    margin-bottom: 0.75rem; /* Giảm margin */
    display: flex;
    align-items: center;
    gap: 0.75rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3); /* Thêm text shadow để tăng contrast */
}

.page-title i {
    font-size: 1.5rem; /* Giảm từ 2rem xuống 1.5rem */
    opacity: 1; /* Tăng opacity */
}

.order-number-badge {
    background: rgba(255, 255, 255, 0.25); /* Tăng opacity */
    backdrop-filter: blur(10px);
    padding: 0.5rem 1rem; /* Giảm padding */
    border-radius: 20px;
    border: 2px solid rgba(255, 255, 255, 0.4); /* Tăng độ dày border */
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); /* Thêm shadow */
}

.order-number-label {
    color: #ffffff; /* Đổi thành trắng thuần */
    font-size: 0.85rem;
    font-weight: 500;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
}

.order-number-value {
    color: #ffffff;
    font-weight: 700;
    font-size: 1rem;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
}

.order-status-section {
    flex-shrink: 0;
}

.status-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 1.5rem; /* Giảm padding */
    border-radius: 15px;
    color: white;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3); /* Tăng shadow */
    min-width: 180px; /* Giảm min-width */
    border: 2px solid rgba(255, 255, 255, 0.2); /* Thêm border */
}

.status-icon {
    width: 40px; /* Giảm từ 50px xuống 40px */
    height: 40px;
    background: rgba(255, 255, 255, 0.3); /* Tăng opacity */
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem; /* Giảm từ 1.5rem xuống 1.2rem */
    border: 2px solid rgba(255, 255, 255, 0.4);
}

.status-info {
    flex: 1;
}

.status-label {
    font-size: 0.75rem;
    opacity: 0.9; /* Tăng opacity */
    margin-bottom: 0.25rem;
    font-weight: 500;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
}

.status-value {
    font-size: 1rem; /* Giảm từ 1.1rem xuống 1rem */
    font-weight: 600;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
}

/* Order Content - Giảm padding */
.order-content {
    padding: 2rem 0; /* Giảm từ 4rem xuống 2rem */
    background: #f8fafc;
    min-height: 50vh; /* Giảm từ 60vh xuống 50vh */
}

.order-sections {
    display: flex;
    flex-direction: column;
    gap: 1.5rem; /* Giảm từ 2rem xuống 1.5rem */
}

.info-section {
    animation: fadeInUp 0.6s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.section-card {
    background: white;
    border-radius: 15px; /* Giảm từ 20px xuống 15px */
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: all 0.3s ease;
}

.section-card:hover {
    transform: translateY(-3px); /* Giảm từ -5px xuống -3px */
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
}

/* Cải thiện section header - Đổi background và text color */
.section-header {
    background: #ffffff; /* Đổi từ gradient sang trắng */
    color: #1e293b; /* Đổi từ trắng sang màu tối */
    padding: 1rem 1.5rem; /* Giảm padding */
    display: flex;
    align-items: center;
    gap: 0.75rem;
    border-bottom: 2px solid #e2e8f0; /* Thêm border bottom */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); /* Thêm shadow nhẹ */
    margin-bottom: 0rem;
}

.section-icon {
    width: 40px; /* Giảm từ 50px xuống 40px */
    height: 40px;
    background: linear-gradient(135deg, #667eea, #764ba2); /* Giữ gradient cho icon */
    border-radius: 12px; /* Giảm từ 15px xuống 12px */
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem; /* Giảm từ 1.5rem xuống 1.2rem */
    color: white; /* Icon vẫn trắng */
    border: 2px solid rgba(102, 126, 234, 0.2);
}

.section-title {
    font-size: 1.1rem; /* Giảm từ 1.3rem xuống 1.1rem */
    font-weight: 600;
    margin: 0;
    color: #1e293b; /* Màu tối cho text */
    text-shadow: none; /* Bỏ text shadow */
}

.section-body {
    padding: 1.5rem; /* Giảm từ 2rem xuống 1.5rem */
}

/* Info Grid */
.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); /* Giảm minmax */
    gap: 1rem; /* Giảm từ 1.5rem xuống 1rem */
}

.info-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem; /* Giảm từ 1.5rem xuống 1rem */
    background: #f8fafc;
    border-radius: 12px; /* Giảm từ 15px xuống 12px */
    border-left: 4px solid #667eea;
    transition: all 0.3s ease;
}

.info-item:hover {
    background: #f1f5f9;
    transform: translateX(3px); /* Giảm từ 5px xuống 3px */
}

.info-item.highlight {
    background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
    border-left-color: #0ea5e9;
}

.info-icon {
    width: 40px; /* Giảm từ 50px xuống 40px */
    height: 40px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 10px; /* Giảm từ 12px xuống 10px */
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem; /* Giảm từ 1.2rem xuống 1rem */
    color: white;
    flex-shrink: 0;
}

.info-content {
    flex: 1;
}

.info-label {
    font-size: 0.85rem; /* Giảm từ 0.9rem xuống 0.85rem */
    color: #64748b;
    margin-bottom: 0.25rem;
    font-weight: 500;
}

.info-value {
    font-size: 1rem; /* Giảm từ 1.1rem xuống 1rem */
    color: #1e293b;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.info-value i {
    color: #667eea;
    font-size: 0.85rem; /* Giảm từ 0.9rem xuống 0.85rem */
}

.total-amount {
    color: #10b981;
    font-size: 1.2rem; /* Giảm từ 1.3rem xuống 1.2rem */
}

/* Customer Info */
.customer-info {
    display: flex;
    align-items: center;
    gap: 1.5rem; /* Giảm từ 2rem xuống 1.5rem */
    padding: 1.5rem; /* Giảm từ 2rem xuống 1.5rem */
    background: linear-gradient(135deg, #f8fafc, #f1f5f9);
    border-radius: 15px; /* Giảm từ 20px xuống 15px */
}

.customer-avatar {
    width: 60px; /* Giảm từ 80px xuống 60px */
    height: 60px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem; /* Giảm từ 2.5rem xuống 2rem */
    color: white;
    flex-shrink: 0;
}

.customer-details {
    flex: 1;
}

.customer-name {
    font-size: 1.3rem; /* Giảm từ 1.5rem xuống 1.3rem */
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 0.75rem; /* Giảm từ 1rem xuống 0.75rem */
}

.customer-contact {
    display: flex;
    flex-direction: column;
    gap: 0.5rem; /* Giảm từ 0.75rem xuống 0.5rem */
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 0.5rem; /* Giảm từ 0.75rem xuống 0.5rem */
    color: #64748b;
}

.contact-item i {
    color: #667eea;
    width: 16px;
}

/* Requirements & Notes */
.requirements-content,
.notes-content {
    position: relative;
    padding: 1.5rem; /* Giảm từ 2rem xuống 1.5rem */
    background: linear-gradient(135deg, #fef3c7, #fde68a);
    border-radius: 12px; /* Giảm từ 15px xuống 12px */
    border-left: 4px solid #f59e0b;
}

.admin-notes .requirements-content,
.admin-notes .notes-content {
    background: linear-gradient(135deg, #dbeafe, #bfdbfe);
    border-left-color: #3b82f6;
}

.quote-icon,
.note-icon {
    position: absolute;
    top: 0.75rem; /* Giảm từ 1rem xuống 0.75rem */
    left: 0.75rem;
    font-size: 1.2rem; /* Giảm từ 1.5rem xuống 1.2rem */
    color: #f59e0b;
    opacity: 0.6; /* Tăng từ 0.5 lên 0.6 */
}

.admin-notes .quote-icon,
.admin-notes .note-icon {
    color: #3b82f6;
}

.requirements-text,
.notes-text {
    margin: 0;
    padding-left: 1.5rem; /* Giảm từ 2rem xuống 1.5rem */
    font-size: 1rem; /* Giảm từ 1.1rem xuống 1rem */
    line-height: 1.6;
    color: #1e293b;
}

/* Timeline */
.timeline {
    position: relative;
    padding-left: 2.5rem; /* Giảm từ 3rem xuống 2.5rem */
}

.timeline::before {
    content: '';
    position: absolute;
    left: 1.25rem; /* Giảm từ 1.5rem xuống 1.25rem */
    top: 0;
    bottom: 0;
    width: 2px;
    background: linear-gradient(to bottom, #667eea, #764ba2);
}

.timeline-item {
    position: relative;
    margin-bottom: 2rem; /* Giảm từ 2.5rem xuống 2rem */
    opacity: 0.5;
    transition: all 0.3s ease;
}

.timeline-item.active {
    opacity: 1;
}

.timeline-item.cancelled {
    opacity: 1;
}

.timeline-marker {
    position: absolute;
    left: -1.75rem; /* Điều chỉnh vị trí */
    top: 0.5rem;
    width: 1.5rem; /* Giảm từ 2rem xuống 1.5rem */
    height: 1.5rem;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.7rem; /* Giảm từ 0.8rem xuống 0.7rem */
    box-shadow: 0 3px 12px rgba(102, 126, 234, 0.3);
}

.timeline-item.cancelled .timeline-marker {
    background: linear-gradient(135deg, #ef4444, #dc2626);
}

.timeline-content {
    background: white;
    padding: 1rem; /* Giảm từ 1.5rem xuống 1rem */
    border-radius: 12px; /* Giảm từ 15px xuống 12px */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    border-left: 4px solid #667eea;
}

.timeline-item.cancelled .timeline-content {
    border-left-color: #ef4444;
}

.timeline-title {
    font-size: 1rem; /* Giảm từ 1.1rem xuống 1rem */
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.5rem;
}

.timeline-time {
    font-size: 0.85rem; /* Giảm từ 0.9rem xuống 0.85rem */
    color: #667eea;
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.timeline-description {
    color: #64748b;
    font-size: 0.85rem; /* Giảm từ 0.9rem xuống 0.85rem */
    line-height: 1.5;
}

/* Actions */
.actions-section {
    text-align: center;
    padding: 1.5rem 0; /* Giảm từ 2rem xuống 1.5rem */
}

.action-buttons {
    display: flex;
    justify-content: center;
    gap: 0.75rem; /* Giảm từ 1rem xuống 0.75rem */
    flex-wrap: wrap;
}

.btn-action {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem; /* Giảm từ 0.75rem xuống 0.5rem */
    padding: 0.75rem 1.5rem; /* Giảm từ 1rem 2rem xuống 0.75rem 1.5rem */
    border-radius: 12px; /* Giảm từ 15px xuống 12px */
    font-weight: 600;
    font-size: 0.9rem; /* Giảm từ 1rem xuống 0.9rem */
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px); /* Giảm từ -3px xuống -2px */
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    color: white;
    text-decoration: none;
}

.btn-secondary {
    background: linear-gradient(135deg, #64748b, #475569);
    color: white;
}

.btn-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(100, 116, 139, 0.3);
    color: white;
    text-decoration: none;
}

.btn-danger {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
}

.btn-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(239, 68, 68, 0.3);
    color: white;
    text-decoration: none;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-header {
        padding: 1.5rem 0; /* Giảm thêm cho mobile */
        margin-top: 70px; /* Giảm margin-top cho mobile */
    }
    
    .order-header-info {
        flex-direction: column;
        text-align: center;
        gap: 1rem; /* Giảm gap cho mobile */
    }
    
    .page-title {
        font-size: 1.5rem; /* Giảm thêm cho mobile */
        justify-content: center;
    }
    
    .status-card {
        min-width: auto;
        width: 100%;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
    }
    
    .customer-info {
        flex-direction: column;
        text-align: center;
    }
    
    .action-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .btn-action {
        width: 100%;
        max-width: 280px; /* Giảm max-width */
        justify-content: center;
    }
    
    .order-content {
        padding: 1rem 0; /* Giảm padding cho mobile */
    }
}
</style>
@endpush

@push('scripts')
<script>
function cancelOrder() {
    if (confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')) {
        // Here you would typically make an AJAX call to cancel the order
        alert('Chức năng hủy đơn hàng sẽ được cập nhật sau.');
    }
}

// Add animation delay for sections
document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('.info-section');
    sections.forEach((section, index) => {
        section.style.animationDelay = index * 0.1 + 's';
    });
});
</script>
@endpush

