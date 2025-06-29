@extends('stone.layouts.main')

@section('title', 'Ứng dụng đá')

@section('content')
<div class="container py-5">
    <h1>Ứng dụng đá tự nhiên</h1>
    
    <div class="row mt-4">
        @if(count($applications) > 0)
            @foreach($applications as $application)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ get_image_url($application->image) }}" class="card-img-top" alt="{{ $application->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $application->name }}</h5>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($application->description, 100) }}</p>
                            <a href="{{ route('stone.applications.show', $application->slug) }}" class="btn btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-info">
                    Không có ứng dụng nào.
                </div>
            </div>
        @endif
    </div>
    
    @if(isset($applications) && method_exists($applications, 'links'))
        <div class="mt-4 d-flex justify-content-center">
            {{ $applications->links('vendor.pagination.bootstrap-4') }}
        </div>
    @endif
</div>
@endsection 