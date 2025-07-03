@extends('stone.layouts.main')

@section('page_title', $application->name)

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mb-4">{{ $application->name }}</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <img src="{{ get_image_url($application->image) }}" class="img-fluid mb-4"
                            alt="{{ $application->name }}">

                        <div class="content">
                            @if ($application->content)
                                {!! $application->content !!}
                            @else
                                <p>{!! $application->description !!}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Thông tin</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Loại:</strong> {{ $application->type_text }}</p>
                    </div>
                </div>

                @if (count($relatedApplications) > 0)
                    <div class="card">
                        <div class="card-header">
                            <h5>Ứng dụng liên quan</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @foreach ($relatedApplications as $relatedApp)
                                    <li class="list-group-item">
                                        <a href="{{ route('stone.applications.show', $relatedApp->slug) }}">
                                            {{ $relatedApp->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        @if (count($products) > 0)
            <div class="row mt-5">
                <div class="col-md-12">
                    <h3 class="mb-3">Sản phẩm sử dụng cho ứng dụng này</h3>
                </div>
            </div>

            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            <img src="{{ asset('images/default/default_image.png') }}" class="card-img-top"
                                alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ number_format($product->price) }}đ</p>
                            </div>
                            <div class="card-footer bg-white border-top-0">
                                <a href="{{ route('stone.products.show', $product->slug) }}"
                                    class="btn btn-primary w-100">Chi tiết</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($products->hasPages())
                <div class="row mt-4">
                    <div class="col-md-12">
                        {{ $products->links() }}
                    </div>
                </div>
            @endif
        @endif
    </div>
@endsection
