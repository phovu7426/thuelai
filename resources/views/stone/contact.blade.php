@extends('stone.layouts.main')

@section('page_title', 'Liên hệ')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mb-4">Liên hệ với chúng tôi</h1>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="mb-3">Gửi tin nhắn cho chúng tôi</h4>

                        <form action="{{ route('stone.contact.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Họ và tên <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="subject" class="form-label">Tiêu đề</label>
                                <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                    id="subject" name="subject" value="{{ old('subject') }}">
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Nội dung <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5"
                                    required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Gửi tin nhắn</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="mb-3">Thông tin liên hệ</h4>

                        <p><i class="fas fa-map-marker-alt me-2"></i> {{ $contactInfo->address ?? '' }}</p>
                        <p><i class="fas fa-phone me-2"></i> {{ $contactInfo->phone ?? '' }}</p>
                        <p><i class="fas fa-envelope me-2"></i> {{ $contactInfo->email ?? '' }}</p>
                        @if (!empty($contactInfo->working_time))
                            <p><i class="fas fa-clock me-2"></i> {{ $contactInfo->working_time }}</p>
                        @elseif(!empty($contactInfo->working_hours))
                            <p><i class="fas fa-clock me-2"></i> {{ $contactInfo->working_hours }}</p>
                        @endif

                        <div class="mt-4">
                            <h5>Theo dõi chúng tôi</h5>
                            <div class="d-flex mt-2">
                                @if (!empty($contactInfo->facebook))
                                    <a href="{{ $contactInfo->facebook }}" class="me-3 text-dark" target="_blank"><i
                                            class="fab fa-facebook fa-2x"></i></a>
                                @endif
                                @if (!empty($contactInfo->instagram))
                                    <a href="{{ $contactInfo->instagram }}" class="me-3 text-dark" target="_blank"><i
                                            class="fab fa-instagram fa-2x"></i></a>
                                @endif
                                @if (!empty($contactInfo->youtube))
                                    <a href="{{ $contactInfo->youtube }}" class="me-3 text-dark" target="_blank"><i
                                            class="fab fa-youtube fa-2x"></i></a>
                                @endif
                                @if (!empty($contactInfo->linkedin))
                                    <a href="{{ $contactInfo->linkedin }}" class="text-dark" target="_blank"><i
                                            class="fab fa-linkedin fa-2x"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3">Bản đồ</h4>
                        @if (!empty($contactInfo->map_embed))
                            <div class="ratio ratio-16x9">
                                {!! $contactInfo->map_embed !!}
                            </div>
                        @else
                            <div class="ratio ratio-16x9 bg-light d-flex align-items-center justify-content-center"
                                style="min-height:200px;">
                                <span class="text-muted">Chưa cấu hình bản đồ</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
