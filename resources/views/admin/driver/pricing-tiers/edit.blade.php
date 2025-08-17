@extends('admin.index')

@section('page_title', 'Chỉnh sửa mức giá')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.driver.pricing-tiers.index') }}">Danh sách mức giá</a></li>
    <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa mức giá</li>
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
                            <i class="bi bi-currency-dollar-gear"></i> Chỉnh sửa mức giá: {{ $pricingTier->distance_description }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.driver.pricing-tiers.update', $pricingTier->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="distance_tier_id" class="form-label">
                                                    <i class="bi bi-route"></i> Khoảng cách <span class="text-danger">*</span>
                                                </label>
                                                <select class="form-select @error('distance_tier_id') is-invalid @enderror" 
                                                        id="distance_tier_id" name="distance_tier_id" required>
                                                    <option value="">📏 Chọn khoảng cách</option>
                                                    @foreach($distanceTiers as $tier)
                                                        <option value="{{ $tier->id }}" 
                                                                {{ old('distance_tier_id', $pricingTier->distance_tier_id) == $tier->id ? 'selected' : '' }}>
                                                            {{ $tier->display_text }} ({{ $tier->distance_range }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('distance_tier_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="pricing_rule_id" class="form-label">
                                                    <i class="bi bi-clock"></i> Thời gian <span class="text-danger">*</span>
                                                </label>
                                                <select class="form-select @error('pricing_rule_id') is-invalid @enderror" 
                                                        id="pricing_rule_id" name="pricing_rule_id" required>
                                                    <option value="">⏰ Chọn thời gian</option>
                                                    @foreach($pricingRules as $rule)
                                                        <option value="{{ $rule->id }}" 
                                                                {{ old('pricing_rule_id', $pricingTier->pricing_rule_id) == $rule->id ? 'selected' : '' }}>
                                                            {{ $rule->time_slot }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('pricing_rule_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="price_type" class="form-label">
                                                    <i class="bi bi-graph-up"></i> Loại giá <span class="text-danger">*</span>
                                                </label>
                                                <select class="form-select @error('price_type') is-invalid @enderror" 
                                                        id="price_type" name="price_type" required>
                                                    <option value="">💰 Chọn loại giá</option>
                                                    <option value="fixed" {{ old('price_type', $pricingTier->price_type) == 'fixed' ? 'selected' : '' }}>💵 Giá cố định</option>
                                                    <option value="per_km" {{ old('price_type', $pricingTier->price_type) == 'per_km' ? 'selected' : '' }}>📊 Giá theo km</option>
                                                </select>
                                                @error('price_type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="price" class="form-label">
                                                    <i class="bi bi-currency-dollar"></i> Giá <span class="text-danger">*</span>
                                                </label>
                                                <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                                       id="price" name="price" placeholder="0" 
                                                       value="{{ old('price', $pricingTier->price) }}" min="0" step="0.01" required>
                                                @error('price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <small class="form-text text-muted">Giá theo VND</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">
                                            <i class="bi bi-text-paragraph"></i> Mô tả
                                        </label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                                  id="description" name="description" rows="3" 
                                                  placeholder="📝 Nhập mô tả...">{{ old('description', $pricingTier->description) }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" 
                                                           value="1" {{ old('is_active', $pricingTier->is_active) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_active">
                                                        <i class="bi bi-toggle-on"></i> Kích hoạt mức giá
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="sort_order" class="form-label">
                                                    <i class="bi bi-sort-numeric-down"></i> Thứ tự hiển thị
                                                </label>
                                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                                       id="sort_order" name="sort_order" placeholder="0" 
                                                       value="{{ old('sort_order', $pricingTier->sort_order) }}" min="0">
                                                @error('sort_order')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <small class="form-text text-muted">Số càng nhỏ càng hiển thị trước</small>
                                            </div>

                                            <div class="mb-3">
                                                <label for="min_distance" class="form-label">
                                                    <i class="bi bi-arrow-right"></i> Khoảng cách tối thiểu (km)
                                                </label>
                                                <input type="number" class="form-control @error('min_distance') is-invalid @enderror" 
                                                       id="min_distance" name="min_distance" placeholder="0" 
                                                       value="{{ old('min_distance', $pricingTier->min_distance) }}" min="0" step="0.1">
                                                @error('min_distance')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="max_distance" class="form-label">
                                                    <i class="bi bi-arrow-left"></i> Khoảng cách tối đa (km)
                                                </label>
                                                <input type="number" class="form-control @error('max_distance') is-invalid @enderror" 
                                                       id="max_distance" name="max_distance" placeholder="0" 
                                                       value="{{ old('max_distance', $pricingTier->max_distance) }}" min="0" step="0.1">
                                                @error('max_distance')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <small class="form-text text-muted">Để trống nếu không giới hạn</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.driver.pricing-tiers.index') }}" class="btn btn-secondary">
                                            <i class="bi bi-arrow-left"></i> Quay lại
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle"></i> Cập nhật mức giá
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
