@extends('stone.layouts.main')

@section('title', $showroom->name)

@section('content')
<div class="container py-5">
    <h1>{{ $showroom->name }}</h1>
    
    <div class="row mt-4">
        <div class="col-md-8">
            <img src="{{ asset('images/default/default_image.png') }}" class="img-fluid mb-4" alt="{{ $showroom->name }}">
            
            <div class="content">
                {!! $showroom->description !!}
            </div>
            
            @if($showroom->google_map)
                <div class="mt-4">
                    <h4>Vị trí</h4>
                    <div class="ratio ratio-16x9">
                        <iframe src="{{ $showroom->google_map }}" allowfullscreen></iframe>
                    </div>
                </div>
            @endif
        </div>
        
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Thông tin liên hệ</h5>
                </div>
                <div class="card-body">
                    <p><i class="fas fa-map-marker-alt"></i> <strong>Địa chỉ:</strong> {{ $showroom->address }}</p>
                    <p><i class="fas fa-phone"></i> <strong>Điện thoại:</strong> {{ $showroom->phone }}</p>
                    <p><i class="fas fa-clock"></i> <strong>Giờ làm việc:</strong> {{ $showroom->working_hours }}</p>
                    
                    @if($showroom->email)
                        <p><i class="fas fa-envelope"></i> <strong>Email:</strong> {{ $showroom->email }}</p>
                    @endif
                    
                    @if($showroom->google_map)
                        <a href="{{ $showroom->google_map }}" target="_blank" class="btn btn-primary mt-3">
                            <i class="fas fa-map-marker-alt"></i> Chỉ đường
                        </a>
                    @endif
                </div>
            </div>
            
            @if(count($otherShowrooms) > 0)
                <div class="card">
                    <div class="card-header">
                        <h5>Showroom khác</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach($otherShowrooms as $other)
                                <li class="list-group-item">
                                    <a href="{{ route('stone.showrooms.show', $other->slug) }}">
                                        {{ $other->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 