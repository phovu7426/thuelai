@extends('stone.layouts.main')

@section('title', $project->name)

@section('content')
<div class="container py-5">
    <h1>{{ $project->name }}</h1>
    
    <div class="row mt-4">
        <div class="col-md-8">
            <img src="{{ asset('images/default/default_image.png') }}" class="img-fluid mb-4" alt="{{ $project->name }}">
            
            <div class="content">
                {!! $project->content !!}
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Thông tin dự án</h5>
                </div>
                <div class="card-body">
                    <p><strong>Khu vực:</strong> 
                        @if($project->region == 'north')
                            Miền Bắc
                        @elseif($project->region == 'central')
                            Miền Trung
                        @elseif($project->region == 'south')
                            Miền Nam
                        @endif
                    </p>
                    <p><strong>Tỉnh/Thành phố:</strong> {{ $project->province }}</p>
                    @if($project->completed_date)
                        <p><strong>Ngày hoàn thành:</strong> {{ \Carbon\Carbon::parse($project->completed_date)->format('d/m/Y') }}</p>
                    @endif
                </div>
            </div>
            
            @if(count($relatedProjects) > 0)
                <div class="card">
                    <div class="card-header">
                        <h5>Dự án liên quan</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach($relatedProjects as $relatedProject)
                                <li class="list-group-item">
                                    <a href="{{ route('stone.projects.show', $relatedProject->slug) }}">
                                        {{ $relatedProject->name }}
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