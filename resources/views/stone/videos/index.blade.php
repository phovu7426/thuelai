@extends('stone.layouts.main')

@section('page_title', 'Videos')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Videos</h1>

        @if (count($featuredVideos) > 0)
            <div class="featured-videos mb-5">
                <h2 class="h4 mb-4">Videos nổi bật</h2>
                <div class="row">
                    @foreach ($featuredVideos as $video)
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="position-relative">
                                    <img src="{{ get_image_url($video->thumbnail) }}" class="card-img-top"
                                        alt="{{ $video->title }}">
                                    <a href="{{ route('stone.videos.show', $video->slug) }}"
                                        class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-play-circle fa-3x text-white"></i>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $video->title }}</h5>
                                    <p class="card-text">{{ Str::limit($video->description, 100) }}</p>
                                    <a href="{{ route('stone.videos.show', $video->slug) }}" class="btn btn-primary">Xem
                                        video</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="all-videos">
            <h2 class="h4 mb-4">Tất cả videos</h2>
            <div class="row">
                @if (count($videos) > 0)
                    @foreach ($videos as $video)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="position-relative">
                                    <img src="{{ get_image_url($video->thumbnail) }}" class="card-img-top"
                                        alt="{{ $video->title }}">
                                    <a href="{{ route('stone.videos.show', $video->slug) }}"
                                        class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-play-circle fa-3x text-white"></i>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $video->title }}</h5>
                                    <p class="card-text">{{ Str::limit($video->description, 100) }}</p>
                                    <a href="{{ route('stone.videos.show', $video->slug) }}" class="btn btn-primary">Xem
                                        video</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="alert alert-info">
                            Không có video nào.
                        </div>
                    </div>
                @endif
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {!! $videos->links('vendor.pagination.bootstrap-4') !!}
            </div>
        </div>
    </div>
@endsection
