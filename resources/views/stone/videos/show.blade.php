@extends('stone.layouts.main')

@section('page_title', $video->title)

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h1 class="mb-4">{{ $video->title }}</h1>

                        <div class="embed-responsive embed-responsive-16by9 mb-4">
                            {!! $video->embed_code !!}
                        </div>

                        <div class="video-info mb-4">
                            <p>{!! $video->description !!}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Videos khác</h5>
                    </div>
                    <div class="card-body">
                        @if (count($relatedVideos) > 0)
                            <div class="list-group">
                                @foreach ($relatedVideos as $relatedVideo)
                                    <a href="{{ route('stone.videos.show', $relatedVideo->slug) }}"
                                        class="list-group-item list-group-item-action">
                                        <div class="row g-0">
                                            <div class="col-4">
                                                <div class="position-relative">
                                                    <img src="{{ get_image_url($relatedVideo->thumbnail) }}"
                                                        class="img-fluid" alt="{{ $relatedVideo->title }}">
                                                    <div
                                                        class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                                                        <i class="fas fa-play-circle text-white"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-8 ps-3">
                                                <h6 class="mb-0">{{ Str::limit($relatedVideo->title, 50) }}</h6>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">Không có video liên quan.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
