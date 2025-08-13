@extends('driver.layouts.main')

@section('page_title', 'Dịch vụ lái xe thuê - ThuêLai.vn')

@section('content')
    <!-- Page Header -->
    <section class="page-header bg-primary text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4 fw-bold mb-3">Dịch vụ của chúng tôi</h1>
                    <p class="lead">Đa dạng các gói dịch vụ lái xe thuê phù hợp với mọi nhu cầu của bạn</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                @if(count($services) > 0)
                    @foreach($services as $service)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="service-card card h-100 border-0 shadow-sm">
                                @if($service->image)
                                    <img src="{{ $service->image_url }}" class="card-img-top" alt="{{ $service->name }}" style="height: 200px; object-fit: cover;">
                                @endif
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
                                    <p class="card-text text-muted">{{ $service->description }}</p>
                                    
                                    <div class="pricing-info mb-3">
                                        @if($service->price_per_hour)
                                            <div class="price-item">
                                                <span class="text-primary fw-bold">{{ number_format($service->price_per_hour) }}đ</span>
                                                <small class="text-muted">/giờ</small>
                                            </div>
                                        @endif
                                        
                                        @if($service->price_per_trip)
                                            <div class="price-item">
                                                <span class="text-primary fw-bold">{{ number_format($service->price_per_trip) }}đ</span>
                                                <small class="text-muted">/chuyến</small>
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
                @else
                    <div class="col-12 text-center">
                        <div class="py-5">
                            <i class="fas fa-car fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">Chưa có dịch vụ nào</h4>
                            <p class="text-muted">Vui lòng quay lại sau hoặc liên hệ với chúng tôi để được tư vấn.</p>
                        </div>
                    </div>
                @endif
            </div>
            
            <!-- Pagination -->
            @if($services->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $services->links() }}
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="mb-4">Bạn cần tư vấn về dịch vụ?</h2>
                    <p class="lead mb-4">Hãy liên hệ ngay với chúng tôi để được tư vấn chi tiết và báo giá tốt nhất.</p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="{{ route('driver.contact') }}" class="btn btn-primary btn-lg">Liên hệ ngay</a>
                        <a href="{{ route('driver.pricing') }}" class="btn btn-outline-primary btn-lg">Xem bảng giá</a>
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
            
            // Lưu thông tin dịch vụ vào localStorage để form có thể sử dụng
            localStorage.setItem('selectedService', JSON.stringify({
                id: serviceId,
                name: serviceName
            }));
        });
    });
});
</script>
@endsection
