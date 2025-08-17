@extends('admin.index')

@section('page_title', 'Chỉnh sửa quy tắc giá')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.driver.pricing-rules.index') }}">Danh sách quy tắc giá</a></li>
    <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa quy tắc giá</li>
@endsection

@section('content')
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-currency-exchange"></i> Chỉnh sửa quy tắc giá: {{ $pricingRule->time_slot }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.driver.pricing-rules.update', $pricingRule->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="time_slot" class="form-label">
                                                    <i class="bi bi-clock"></i> Thời gian <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" 
                                                       class="form-control @error('time_slot') is-invalid @enderror" 
                                                       id="time_slot" 
                                                       name="time_slot" 
                                                       value="{{ old('time_slot', $pricingRule->time_slot) }}" 
                                                       placeholder="⏰ Ví dụ: Trước 22h, 22h - 24h, Sau 24h"
                                                       required>
                                                @error('time_slot')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <small class="form-text text-muted">Nhập thời gian tùy ý</small>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="time_icon" class="form-label">
                                                    <i class="bi bi-emoji-smile"></i> Icon <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" 
                                                       class="form-control @error('time_icon') is-invalid @enderror" 
                                                       id="time_icon" 
                                                       name="time_icon" 
                                                       value="{{ old('time_icon', $pricingRule->time_icon) }}" 
                                                       placeholder="🎨 Ví dụ: fas fa-sun, fas fa-moon, fas fa-star"
                                                       required>
                                                @error('time_icon')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <small class="form-text text-muted">Sử dụng FontAwesome icons</small>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="time_color" class="form-label">
                                                    <i class="bi bi-palette"></i> Màu sắc <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" 
                                                       class="form-control @error('time_color') is-invalid @enderror" 
                                                       id="time_color" 
                                                       name="time_color" 
                                                       value="{{ old('time_color', $pricingRule->time_color) }}" 
                                                       placeholder="🎨 Ví dụ: #ffc107, #17a2b8, #dc3545"
                                                       required>
                                                @error('time_color')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <small class="form-text text-muted">Hex code hoặc tên màu CSS</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <h5 class="mb-3">
                                                <i class="bi bi-currency-dollar"></i> Cấu hình giá theo khoảng cách
                                            </h5>
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        @foreach($distanceTiers as $tier)
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                @php
                                                    $currentPrice = $pricingRule->pricingDistances->where('distance_tier_id', $tier->id)->first();
                                                    $priceValue = $currentPrice ? ($currentPrice->price_text ?: $currentPrice->price) : '';
                                                @endphp
                                                <label for="price_{{ $tier->id }}" class="form-label">
                                                    <i class="bi bi-graph-up"></i> Giá {{ $tier->display_text }} <span class="text-danger">*</span>
                                                </label>
                                                <input type="{{ $tier->to_distance === null ? 'text' : 'number' }}" 
                                                       class="form-control @error('price_' . $tier->id) is-invalid @enderror" 
                                                       id="price_{{ $tier->id }}" 
                                                       name="price_{{ $tier->id }}" 
                                                       value="{{ old('price_' . $tier->id, $priceValue) }}" 
                                                       placeholder="💰 Nhập giá..." 
                                                       {{ $tier->to_distance === null ? '' : 'min="0" step="0.01"' }}
                                                       required>
                                                @error('price_' . $tier->id)
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <small class="form-text text-muted">{{ $tier->description }}</small>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">
                                                <i class="bi bi-gear"></i> Cài đặt
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="description" class="form-label">
                                                    <i class="bi bi-text-paragraph"></i> Mô tả
                                                </label>
                                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                                          id="description" name="description" rows="3" 
                                                          placeholder="📝 Nhập mô tả...">{{ old('description', $pricingRule->description) }}</textarea>
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" 
                                                           value="1" {{ old('is_active', $pricingRule->is_active) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_active">
                                                        <i class="bi bi-toggle-on"></i> Kích hoạt quy tắc
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="sort_order" class="form-label">
                                                    <i class="bi bi-sort-numeric-down"></i> Thứ tự ưu tiên
                                                </label>
                                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                                       id="sort_order" name="sort_order" placeholder="0" 
                                                       value="{{ old('sort_order', $pricingRule->sort_order) }}" min="0">
                                                @error('sort_order')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <small class="form-text text-muted">Số càng nhỏ càng ưu tiên cao</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.driver.pricing-rules.index') }}" class="btn btn-secondary">
                                            <i class="bi bi-arrow-left"></i> Quay lại
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle"></i> Cập nhật quy tắc giá
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
@endsection
