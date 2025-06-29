@extends('stone.layouts.main')

@section('title', 'Showroom đá')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Hệ thống showroom</h1>
    
    <div class="row mt-4">
    @if(count($showrooms) > 0)
        @foreach($showrooms as $showroom)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="{{ get_image_url($showroom->image) }}" class="card-img-top" alt="{{ $showroom->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $showroom->name }}</h5>
                    <p class="card-text">{{ $showroom->address }}</p>
                    <p class="card-text">{{ $showroom->phone }}</p>
                    <a href="{{ route('stone.showrooms.show', $showroom->slug) }}" class="btn btn-primary">Xem chi tiết</a>
                </div>
            </div>
        </div>
        @endforeach
    @else
        <div class="col-12">
            <div class="alert alert-info">Không có showroom nào.</div>
        </div>
    @endif
    </div>
    
    <div class="mt-4 d-flex justify-content-center">
        {!! $showrooms->links('vendor.pagination.bootstrap-4') !!}
    </div>
</div>
@endsection 