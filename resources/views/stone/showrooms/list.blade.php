@extends('stone.layouts.main')

@section('title', 'Danh sách showroom')

@section('styles')
<style>
    .showroom-card {
        height: 100%;
        transition: transform 0.2s;
        background: #fff;
    }
    .showroom-card:hover {
        transform: translateY(-5px);
    }
    .showroom-card .card-img-wrapper {
        position: relative;
        padding-top: 75%; /* Tỷ lệ 4:3 */
        overflow: hidden;
        background: #f8f9fa;
    }
    .showroom-card .card-img-wrapper::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, #f8f9fa 0%, #e9ecef 100%);
        opacity: 0.8;
    }
    .showroom-card .card-img-top {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .showroom-card .no-image {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 3rem;
        color: #adb5bd;
    }
    .showroom-card .card-body {
        padding: 1.25rem;
    }
    .showroom-card .card-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: #333;
    }
    .showroom-card .info-item {
        display: flex;
        align-items: start;
        margin-bottom: 0.75rem;
        color: #666;
        font-size: 0.95rem;
    }
    .showroom-card .info-item i {
        width: 20px;
        margin-top: 4px;
        color: #999;
    }
    .showroom-card .info-item span {
        flex: 1;
        margin-left: 0.5rem;
    }
</style>
@endsection

@section('content')
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="text-center mb-2">Hệ thống showroom</h1>
                <p class="text-center text-muted">Khám phá các showroom trưng bày đá tự nhiên cao cấp của chúng tôi</p>
            </div>
        </div>

        <div class="row g-4">
            @if($showrooms->count() > 0)
                @foreach($showrooms as $showroom)
                    <div class="col-lg-4 col-md-6">
                        <div class="card showroom-card shadow-sm">
                            <div class="card-img-wrapper">
                                @if($showroom->image)
                                    <img src="{{ asset('storage/' . $showroom->image) }}" 
                                         class="card-img-top"
                                         alt="{{ $showroom->name }}">
                                @else
                                    <i class="fas fa-store no-image"></i>
                                @endif
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $showroom->name }}</h5>
                                <div class="info-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $showroom->address }}</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-phone"></i>
                                    <span>{{ $showroom->phone }}</span>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('stone.showrooms.show', $showroom->slug) }}" 
                                       class="btn btn-primary w-100">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle me-2"></i>
                        Không có showroom nào.
                    </div>
                </div>
            @endif
        </div>

        @if($showrooms->hasPages())
            <div class="mt-5 d-flex justify-content-center">
                {{ $showrooms->links('vendor.pagination.bootstrap-4') }}
            </div>
        @endif
    </div>
@endsection
