@extends('stone.layouts.main')

@section('title', 'Dự án đá')

@section('content')
<div class="container py-5">
    <h1>Dự án đá tự nhiên</h1>
    
    <div class="row mt-4">
        @if(count($projects) > 0)
            @foreach($projects as $project)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ $project->image ? asset($project->image) : asset('images/default/default_image.png') }}" class="card-img-top" alt="{{ $project->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $project->name }}</h5>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($project->description, 100) }}</p>
                            <a href="{{ route('stone.projects.show', $project->slug) }}" class="btn btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-info">
                    Không có dự án nào.
                </div>
            </div>
        @endif
    </div>
    
    @if(isset($projects) && method_exists($projects, 'links'))
        <div class="mt-4 d-flex justify-content-center">
            {{ $projects->links('vendor.pagination.bootstrap-4') }}
        </div>
    @endif
</div>
@endsection
