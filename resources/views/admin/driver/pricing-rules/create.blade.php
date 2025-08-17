@extends('admin.index')

@section('page_title', 'Thêm quy tắc giá mới')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.driver.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.driver.pricing-rules.index') }}">Quy tắc giá</a>
    </li>
    <li class="breadcrumb-item active">Thêm mới</li>
@endsection

@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Thêm quy tắc giá mới</h3>
                            <a href="{{ route('admin.driver.pricing-rules.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Quay lại
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.driver.pricing-rules.store') }}" method="POST">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="time_slot">Thời gian <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control @error('time_slot') is-invalid @enderror" 
                                               id="time_slot" 
                                               name="time_slot" 
                                               value="{{ old('time_slot') }}" 
                                               placeholder="Ví dụ: Trước 22h, 22h - 24h, Sau 24h"
                                               required>
                                        @error('time_slot')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Nhập thời gian tùy ý</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="time_icon">Icon <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control @error('time_icon') is-invalid @enderror" 
                                               id="time_icon" 
                                               name="time_icon" 
                                               value="{{ old('time_icon') }}" 
                                               placeholder="Ví dụ: fas fa-sun, fas fa-moon, fas fa-star"
                                               required>
                                        @error('time_icon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Sử dụng FontAwesome icons</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="time_color">Màu sắc <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control @error('time_color') is-invalid @enderror" 
                                               id="time_color" 
                                               name="time_color" 
                                               value="{{ old('time_color') }}" 
                                               placeholder="Ví dụ: #ffc107, #17a2b8, #dc3545"
                                               required>
                                        @error('time_color')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Hex code hoặc tên màu CSS</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                @foreach($distanceTiers as $tier)
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="price_{{ $tier->id }}">Giá {{ $tier->display_text }} <span class="text-danger">*</span></label>
                                        <input type="{{ $tier->to_distance === null ? 'text' : 'number' }}" 
                                               class="form-control @error('price_' . $tier->id) is-invalid @enderror" 
                                               id="price_{{ $tier->id }}" 
                                               name="price_{{ $tier->id }}" 
                                               value="{{ old('price_' . $tier->id, $tier->to_distance === null ? 'Thỏa thuận' : '') }}" 
                                               @if($tier->to_distance !== null) min="0" step="1000" @endif
                                               placeholder="{{ $tier->to_distance === null ? 'Thỏa thuận' : '0' }}"
                                               required>
                                        @error('price_' . $tier->id)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">
                                            @if($tier->to_distance === null)
                                                Thường là "Thỏa thuận" hoặc giá cụ thể
                                            @else
                                                {{ $tier->description ?: 'Giá cho khoảng cách này' }}
                                            @endif
                                        </small>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sort_order">Thứ tự sắp xếp</label>
                                        <input type="number" 
                                               class="form-control @error('sort_order') is-invalid @enderror" 
                                               id="sort_order" 
                                               name="sort_order" 
                                               value="{{ old('sort_order', 0) }}" 
                                               min="0"
                                               step="1">
                                        @error('sort_order')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Số càng nhỏ càng hiển thị trước</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="is_active">Trạng thái</label>
                                        <div class="form-check">
                                            <input type="checkbox" 
                                                   class="form-check-input" 
                                                   id="is_active" 
                                                   name="is_active" 
                                                   value="1" 
                                                   {{ old('is_active', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">
                                                Kích hoạt quy tắc này
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Tạo quy tắc
                                </button>
                                <a href="{{ route('admin.driver.pricing-rules.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Hủy
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
