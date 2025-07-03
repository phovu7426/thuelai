@extends('admin.layouts.main')

@section('page_title', 'Cấu hình thông tin liên hệ')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-bottom-0">
                        <h5 class="mb-0 fw-bold"><i class="bi bi-telephone me-2"></i> Cấu hình thông tin liên hệ</h5>
                    </div>
                    <div class="card-body bg-white p-4">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <form action="{{ route('admin.contact-info.update') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="bi bi-geo-alt me-1"></i> Địa chỉ</label>
                                    <input type="text" name="address" class="form-control"
                                        value="{{ old('address', $contact->address ?? '') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="bi bi-telephone me-1"></i> Số điện thoại</label>
                                    <input type="text" name="phone" class="form-control"
                                        value="{{ old('phone', $contact->phone ?? '') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="bi bi-envelope me-1"></i> Email</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ old('email', $contact->email ?? '') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="bi bi-clock me-1"></i> Giờ làm việc</label>
                                    <input type="text" name="working_time" class="form-control"
                                        value="{{ old('working_time', $contact->working_time ?? '') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="bi bi-facebook me-1"></i> Facebook</label>
                                    <input type="text" name="facebook" class="form-control"
                                        value="{{ old('facebook', $contact->facebook ?? '') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="bi bi-instagram me-1"></i> Instagram</label>
                                    <input type="text" name="instagram" class="form-control"
                                        value="{{ old('instagram', $contact->instagram ?? '') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="bi bi-youtube me-1"></i> Youtube</label>
                                    <input type="text" name="youtube" class="form-control"
                                        value="{{ old('youtube', $contact->youtube ?? '') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="bi bi-linkedin me-1"></i> LinkedIn</label>
                                    <input type="text" name="linkedin" class="form-control"
                                        value="{{ old('linkedin', $contact->linkedin ?? '') }}">
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label"><i class="bi bi-map me-1"></i> Mã nhúng bản đồ
                                        (iframe)</label>
                                    <textarea name="map_embed" class="form-control" rows="3">{{ old('map_embed', $contact->map_embed ?? '') }}</textarea>
                                    <small class="text-muted">Dán mã iframe nhúng bản đồ Google Maps tại đây.</small>
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg"><i class="bi bi-save me-1"></i> Lưu
                                    thông tin</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
