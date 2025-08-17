@extends('admin.index')

@section('page_title', 'Chỉnh sửa Series')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.series.index') }}">Danh sách Series</a></li>
    <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa Series</li>
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
                            <i class="bi bi-collection-gear"></i> Chỉnh sửa Series: {{ $series->name }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.series.update', $series->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">
                                                    <i class="bi bi-collection"></i> Tên Series <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                                       placeholder="📚 Nhập tên series..." 
                                                       value="{{ old('name', $series->name) }}" required>
                                                @error('name') 
                                                    <span class="text-danger">{{ $message }}</span> 
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="code" class="form-label">
                                                    <i class="bi bi-code"></i> Mã Series <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                                                       placeholder="🔢 Nhập mã series..." 
                                                       value="{{ old('code', $series->code) }}" required>
                                                @error('code') 
                                                    <span class="text-danger">{{ $message }}</span> 
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">
                                            <i class="bi bi-text-paragraph"></i> Mô tả
                                        </label>
                                        <textarea name="description" class="form-control" rows="3" 
                                                  placeholder="📄 Nhập mô tả...">{{ old('description', $series->description) }}</textarea>
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
                                                <label for="status" class="form-label">
                                                    <i class="bi bi-toggle-on"></i> Trạng thái
                                                </label>
                                                <select name="status" class="form-select @error('status') is-invalid @enderror">
                                                    <option value="active" {{ old('status', $series->status) == 'active' ? 'selected' : '' }}>✅ Hoạt động</option>
                                                    <option value="inactive" {{ old('status', $series->status) == 'inactive' ? 'selected' : '' }}>❌ Không hoạt động</option>
                                                </select>
                                                @error('status') 
                                                    <span class="text-danger">{{ $message }}</span> 
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="sort_order" class="form-label">
                                                    <i class="bi bi-sort-numeric-down"></i> Thứ tự hiển thị
                                                </label>
                                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                                       id="sort_order" name="sort_order" placeholder="0" 
                                                       value="{{ old('sort_order', $series->sort_order ?? 0) }}" min="0">
                                                @error('sort_order')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <small class="form-text text-muted">Số càng nhỏ càng hiển thị trước</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.series.index') }}" class="btn btn-secondary">
                                            <i class="bi bi-arrow-left"></i> Quay lại
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle"></i> Cập nhật Series
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
