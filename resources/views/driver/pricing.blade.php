@extends('driver.layouts.main')

@section('page_title', 'Bảng giá dịch vụ lái xe thuê - ThuêLai.vn')

@section('content')
    <!-- Page Header -->
    <section class="page-header bg-primary text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4 fw-bold mb-3">Bảng giá dịch vụ</h1>
                    <p class="lead">Giá cả minh bạch, không phát sinh chi phí ẩn</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Table -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow">
                        <div class="card-header bg-primary text-white text-center py-3">
                            <h3 class="mb-0">Bảng giá chi tiết</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center" style="width: 30%;">Loại dịch vụ</th>
                                            <th class="text-center" style="width: 20%;">Giá theo giờ</th>
                                            <th class="text-center" style="width: 20%;">Giá theo chuyến</th>
                                            <th class="text-center" style="width: 20%;">Ghi chú</th>
                                            <th class="text-center" style="width: 10%;">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($services) > 0)
                                            @foreach($services as $service)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            @if($service->icon)
                                                                <img src="{{ $service->icon_url }}" alt="{{ $service->name }}" class="me-3" style="width: 40px; height: 40px;">
                                                            @else
                                                                <i class="fas fa-car fa-2x text-primary me-3"></i>
                                                            @endif
                                                            <div>
                                                                <h6 class="mb-1">{{ $service->name }}</h6>
                                                                <small class="text-muted">{{ $service->short_description }}</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        @if($service->price_per_hour)
                                                            <span class="text-primary fw-bold">{{ number_format($service->price_per_hour) }}đ</span>
                                                            <br><small class="text-muted">/giờ</small>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if($service->price_per_trip)
                                                            <span class="text-primary fw-bold">{{ number_format($service->price_per_trip) }}đ</span>
                                                            <br><small class="text-muted">/chuyến</small>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <small class="text-muted">
                                                            @if($service->is_featured)
                                                                <span class="badge bg-success">Nổi bật</span><br>
                                                            @endif
                                                            {{ $service->description ? Str::limit($service->description, 50) : 'Không có mô tả' }}
                                                        </small>
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-sm btn-primary book-service-btn" data-service-id="{{ $service->id }}" data-service-name="{{ $service->name }}">
                                                            Đặt ngay
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-center py-5">
                                                    <i class="fas fa-car fa-3x text-muted mb-3"></i>
                                                    <h5 class="text-muted">Chưa có dịch vụ nào</h5>
                                                    <p class="text-muted">Vui lòng quay lại sau hoặc liên hệ với chúng tôi.</p>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Cards -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2>Gói dịch vụ nổi bật</h2>
                <p class="text-muted">Những gói dịch vụ được khách hàng lựa chọn nhiều nhất</p>
            </div>

            <div class="row">
                @if(count($services) > 0)
                    @foreach($services->where('is_featured', true)->take(3) as $service)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="pricing-card card h-100 border-0 shadow">
                                <div class="card-body text-center p-4">
                                    @if($service->icon)
                                        <div class="service-icon mb-3">
                                            <img src="{{ $service->icon_url }}" alt="{{ $service->name }}" class="img-fluid" style="width: 64px; height: 64px;">
                                        </div>
                                    @else
                                        <div class="service-icon mb-3">
                                            <i class="fas fa-car fa-3x text-white"></i>
                                        </div>
                                    @endif
                                    
                                    <h5 class="card-title">{{ $service->name }}</h5>
                                    <p class="card-text text-muted">{{ $service->short_description }}</p>
                                    
                                    <div class="pricing-highlight mb-4">
                                        @if($service->price_per_hour)
                                            <div class="price mb-2">
                                                <span class="display-6 text-primary fw-bold">{{ number_format($service->price_per_hour) }}đ</span>
                                                <span class="text-muted">/giờ</span>
                                            </div>
                                        @endif
                                        
                                        @if($service->price_per_trip)
                                            <div class="price">
                                                <span class="display-6 text-primary fw-bold">{{ number_format($service->price_per_trip) }}đ</span>
                                                <span class="text-muted">/chuyến</span>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <button class="btn btn-primary book-service-btn" data-service-id="{{ $service->id }}" data-service-name="{{ $service->name }}">
                                        Đặt ngay
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <!-- Additional Information -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card border-0 shadow">
                        <div class="card-header bg-info text-white text-center py-3">
                            <h4 class="mb-0"><i class="fas fa-info-circle me-2"></i>Thông tin bổ sung</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6><i class="fas fa-clock text-primary me-2"></i>Giờ làm việc</h6>
                                    <p class="text-muted">Dịch vụ 24/7, hỗ trợ mọi lúc mọi nơi</p>
                                    
                                    <h6><i class="fas fa-map-marker-alt text-primary me-2"></i>Khu vực phục vụ</h6>
                                    <p class="text-muted">Toàn bộ Hà Nội và các tỉnh lân cận</p>
                                </div>
                                <div class="col-md-6">
                                    <h6><i class="fas fa-credit-card text-primary me-2"></i>Hình thức thanh toán</h6>
                                    <p class="text-muted">Tiền mặt, chuyển khoản, ví điện tử</p>
                                    
                                    <h6><i class="fas fa-shield-alt text-primary me-2"></i>Bảo hiểm</h6>
                                    <p class="text-muted">Bảo hiểm đầy đủ cho khách hàng và phương tiện</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="mb-4">Bạn cần tư vấn về giá?</h2>
                    <p class="lead mb-4">Hãy liên hệ ngay với chúng tôi để được tư vấn chi tiết và báo giá tốt nhất.</p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="{{ route('driver.contact') }}" class="btn btn-light btn-lg">Liên hệ ngay</a>
                        <a href="{{ route('driver.home') }}#booking-form" class="btn btn-outline-light btn-lg">Đặt dịch vụ</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Xử lý nút đặt dịch vụ
    const bookButtons = document.querySelectorAll('.book-service-btn');
    bookButtons.forEach(button => {
        button.addEventListener('click', function() {
            const serviceId = this.getAttribute('data-service-id');
            const serviceName = this.getAttribute('data-service-name');
            
            // Chuyển đến trang chủ với form đặt dịch vụ
            window.location.href = '{{ route("driver.home") }}#booking-form';
            
            // Lưu thông tin dịch vụ vào localStorage
            localStorage.setItem('selectedService', JSON.stringify({
                id: serviceId,
                name: serviceName
            }));
        });
    });
});
</script>
@endsection
