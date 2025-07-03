@extends('stone.layouts.main')

@section('page_title', 'Ứng dụng đá')

@section('styles')
<style>
    .application-card {
        height: 100%;
        transition: transform 0.2s;
    }
    .application-card:hover {
        transform: translateY(-5px);
    }
    .application-card .card-img-wrapper {
        position: relative;
        padding-top: 75%; /* Tỷ lệ 4:3 */
        overflow: hidden;
    }
    .application-card .card-img-top {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .application-card .card-body {
        padding: 1.25rem;
    }
    .application-card .card-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
    }
    .application-card .card-text {
        color: #6c757d;
        margin-bottom: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 4.5rem;
    }
</style>
@endsection

@section('content')
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="text-center mb-2">Ứng dụng đá tự nhiên</h1>
                <p class="text-center text-muted">Khám phá các ứng dụng đa dạng của đá tự nhiên trong kiến trúc và xây dựng</p>
            </div>
        </div>

        <div class="row g-4">
            @if (count($applications) > 0)
                @foreach ($applications as $application)
                    <div class="col-lg-4 col-md-6">
                        <div class="card application-card shadow-sm">
                            <div class="card-img-wrapper">
                                <img src="{{ get_image_url($application->image) }}" 
                                     class="card-img-top"
                                     alt="{{ $application->name }}">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $application->name }}</h5>
                                <p class="card-text">{{ \Illuminate\Support\Str::limit($application->description, 100) }}</p>
                                <a href="{{ route('stone.applications.show', $application->slug) }}"
                                   class="btn btn-primary w-100">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle me-2"></i>
                        Không có ứng dụng nào.
                    </div>
                </div>
            @endif
        </div>

        @if (isset($applications) && method_exists($applications, 'links'))
            <div class="mt-5 d-flex justify-content-center">
                {{ $applications->links('vendor.pagination.bootstrap-4') }}
            </div>
        @endif
    </div>
@endsection
