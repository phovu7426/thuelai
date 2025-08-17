@extends('admin.index')

@section('page_title', 'Chỉnh sửa dịch vụ lái xe')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.driver.services.index') }}">Quản lý dịch vụ lái xe</a></li>
    <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa dịch vụ</li>
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
                        <h3 class="card-title">Chỉnh sửa dịch vụ: {{ $service->name ?? 'N/A' }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.driver.services.update', $service->id ?? '') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Tên dịch vụ <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" value="{{ old('name', $service->name ?? '') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Mô tả</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                                  id="description" name="description" rows="5">{{ old('description', $service->description ?? '') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="content" class="form-label">Nội dung chi tiết</label>
                                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                                  id="content" name="content" rows="10">{{ old('content', $service->content ?? '') }}</textarea>
                                        @error('content')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Trạng thái</label>
                                        <select class="form-select @error('status') is-invalid @enderror" 
                                                id="status" name="status">
                                            <option value="1" {{ old('status', $service->status ?? '1') == '1' ? 'selected' : '' }}>Kích hoạt</option>
                                            <option value="0" {{ old('status', $service->status ?? '1') == '0' ? 'selected' : '' }}>Vô hiệu hóa</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" 
                                                   {{ old('is_featured', $service->is_featured ?? false) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_featured">
                                                Dịch vụ nổi bật
                                            </label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="sort_order" class="form-label">Thứ tự hiển thị</label>
                                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                               id="sort_order" name="sort_order" value="{{ old('sort_order', $service->sort_order ?? 0) }}" min="0">
                                        @error('sort_order')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="image" class="form-label">Ảnh dịch vụ</label>
                                        @if($service->image ?? false)
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $service->image) }}" alt="Ảnh hiện tại" class="img-thumbnail" style="max-width: 200px;">
                                            </div>
                                        @endif
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                               id="image" name="image" accept="image/*">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="icon" class="form-label">Icon</label>
                                        <input type="text" class="form-control @error('icon') is-invalid @enderror" 
                                               id="icon" name="icon" value="{{ old('icon', $service->icon ?? '') }}" placeholder="fas fa-car">
                                        @error('icon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Sử dụng Font Awesome icons (ví dụ: fas fa-car)</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-circle"></i> Cập nhật dịch vụ
                                    </button>
                                    <a href="{{ route('admin.driver.services.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left"></i> Quay lại
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    CKEDITOR.replace('content', {
        height: 400,
        filebrowserUploadUrl: '{{ route("admin.upload.ckeditor") }}',
        filebrowserUploadMethod: 'form',
        // Thêm CSRF token
        filebrowserUploadParams: {
            _token: '{{ csrf_token() }}',
            ckCsrfToken: '{{ csrf_token() }}'
        }
    });
</script>
@endpush
