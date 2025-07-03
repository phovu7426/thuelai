@extends('stone.layouts.main')

@section('title', 'Danh sách showroom')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Hệ thống showroom</h1>

        <div class="row mt-4">
            @if($showrooms->count() > 0)
                @foreach($showrooms as $showroom)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="{{ $showroom->image ? asset('storage/' . $showroom->image) : asset('images/default/default_image.png') }}" class="card-img-top" alt="{{ $showroom->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $showroom->name }}</h5>
                                <p class="card-text"><i class="fas fa-map-marker-alt me-2"></i> {{ $showroom->address }}</p>
                                <p class="card-text"><i class="fas fa-phone me-2"></i> {{ $showroom->phone }}</p>
                                <a href="{{ route('stone.showrooms.show', $showroom->slug) }}" class="btn btn-primary">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="alert alert-info">
                        Không có showroom nào.
                    </div>
                </div>
            @endif
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $showrooms->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection
