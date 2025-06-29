@extends('stone.layouts.main')

@section('title', 'Liên hệ')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Liên hệ với chúng tôi</h1>
        </div>
    </div>

    @if(session('success'))
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
                            <label for="name" class="form-label">Họ và tên <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="subject" class="form-label">Tiêu đề</label>
                            <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject') }}">
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="message" class="form-label">Nội dung <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
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
                    
                    <p><i class="fas fa-map-marker-alt me-2"></i> 123 Đường ABC, Quận XYZ, TP. Hồ Chí Minh</p>
                    <p><i class="fas fa-phone me-2"></i> (028) 1234 5678</p>
                    <p><i class="fas fa-envelope me-2"></i> info@thanhtungstone.com</p>
                    <p><i class="fas fa-clock me-2"></i> Thứ 2 - Thứ 6: 8:00 - 17:00</p>
                    
                    <div class="mt-4">
                        <h5>Theo dõi chúng tôi</h5>
                        <div class="d-flex mt-2">
                            <a href="#" class="me-3 text-dark"><i class="fab fa-facebook fa-2x"></i></a>
                            <a href="#" class="me-3 text-dark"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="#" class="me-3 text-dark"><i class="fab fa-youtube fa-2x"></i></a>
                            <a href="#" class="text-dark"><i class="fab fa-linkedin fa-2x"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3">Bản đồ</h4>
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.4241674197667!2d106.68800707486842!3d10.778486389318513!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f3a9d8d1bb3%3A0x44a78623cd569b3!2zMTIzIMSQxrDhu51uZyBOZ3V54buFbiBUcsOjaSwgUGjGsOG7nW5nIELhur9uIFRow6BuaCwgUXXhuq1uIDEsIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1688181234567!5m2!1svi!2s" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 