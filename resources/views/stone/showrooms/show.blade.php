@extends('stone.layouts.main')

@section('title', $showroom->name)

@section('styles')
<style>
    .other-showroom {
        transition: all 0.3s ease;
    }
    .other-showroom:hover {
        background-color: #f8f9fa;
    }
    .other-showroom .showroom-name {
        color: #333;
        font-weight: 500;
        margin-bottom: 0.25rem;
    }
    .other-showroom .showroom-address {
        color: #6c757d;
        font-size: 0.875rem;
        margin-bottom: 0;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection

@section('content')
    <div class="container py-5">
        <h1>{{ $showroom->name }}</h1>

        <div class="row mt-4">
            <div class="col-md-8">
                @if($showroom->image)
                    <img src="{{ asset('storage/' . $showroom->image) }}" class="img-fluid rounded mb-4" alt="{{ $showroom->name }}">
                @else
                    <div class="rounded bg-light mb-4 text-center py-5">
                        <i class="fas fa-store fa-4x text-muted"></i>
                    </div>
                @endif

                <div class="content">
                    {!! $showroom->description !!}
                </div>

                @if ($showroom->google_map)
                    <div class="mt-4">
                        <h4>Vị trí</h4>
                        <div class="ratio ratio-16x9">
                            <iframe src="{{ $showroom->google_map }}" allowfullscreen></iframe>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0"><i class="fas fa-info-circle me-2"></i>Thông tin liên hệ</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-map-marker-alt mt-1 me-3 text-primary"></i>
                            <div>
                                <strong>Địa chỉ:</strong><br>
                                {{ $showroom->address }}
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-phone mt-1 me-3 text-primary"></i>
                            <div>
                                <strong>Điện thoại:</strong><br>
                                {{ $showroom->phone }}
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-clock mt-1 me-3 text-primary"></i>
                            <div>
                                <strong>Giờ làm việc:</strong><br>
                                {{ $showroom->working_hours }}
                            </div>
                        </div>

                        @if ($showroom->email)
                            <div class="d-flex align-items-start mb-3">
                                <i class="fas fa-envelope mt-1 me-3 text-primary"></i>
                                <div>
                                    <strong>Email:</strong><br>
                                    {{ $showroom->email }}
                                </div>
                            </div>
                        @endif

                        @if ($showroom->google_map)
                            <a href="{{ $showroom->google_map }}" target="_blank" class="btn btn-primary w-100">
                                <i class="fas fa-map-marker-alt me-2"></i> Chỉ đường
                            </a>
                        @endif
                    </div>
                </div>

                @if (count($otherShowrooms) > 0)
                    <div class="card shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-store me-2"></i>Showroom khác
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                @foreach ($otherShowrooms as $other)
                                    <a href="{{ route('stone.showrooms.show', $other->slug) }}" 
                                       class="list-group-item list-group-item-action other-showroom">
                                        <h6 class="showroom-name">{{ $other->name }}</h6>
                                        <p class="showroom-address">
                                            <i class="fas fa-map-marker-alt me-1 small"></i>
                                            {{ $other->address }}
                                        </p>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
