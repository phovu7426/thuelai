@extends('admin.index')

@section('page_title', 'Chỉnh sửa bài viết')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">Quản lý bài viết</a></li>
    <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa bài viết</li>
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
                        <h3 class="card-title">Chỉnh sửa bài viết: {{ $post->title ?? 'N/A' }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.posts.update', $post->id ?? '') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                               id="title" name="title" value="{{ old('title', $post->title ?? '') }}" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="content" class="form-label">Nội dung <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                                  id="content" name="content" rows="10" required>{{ old('content', $post->content ?? '') }}</textarea>
                                        @error('content')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="excerpt" class="form-label">Tóm tắt</label>
                                        <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                                  id="excerpt" name="excerpt" rows="3">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
                                        @error('excerpt')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Danh mục <span class="text-danger">*</span></label>
                                        <select class="form-select @error('category_id') is-invalid @enderror" 
                                                id="category_id" name="category_id" required>
                                            <option value="">Chọn danh mục</option>
                                            @foreach($categories ?? [] as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id', $post->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="status" class="form-label">Trạng thái</label>
                                        <select class="form-select @error('status') is-invalid @enderror" 
                                                id="status" name="status">
                                            <option value="draft" {{ old('status', $post->status ?? '') == 'draft' ? 'selected' : '' }}>Bản nháp</option>
                                            <option value="published" {{ old('status', $post->status ?? '') == 'published' ? 'selected' : '' }}>Xuất bản</option>
                                            <option value="archived" {{ old('status', $post->status ?? '') == 'archived' ? 'selected' : '' }}>Lưu trữ</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" 
                                                   {{ old('is_featured', $post->is_featured ?? false) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_featured">
                                                Bài viết nổi bật
                                            </label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="featured_image" class="form-label">Ảnh đại diện</label>
                                        @if($post->featured_image ?? false)
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="Ảnh hiện tại" class="img-thumbnail" style="max-width: 200px;">
                                            </div>
                                        @endif
                                        <x-uploads.file-upload name="featured_image" label="Ảnh đại diện" :value="$post->featured_image" />
                                        @error('featured_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="meta_title" class="form-label">Meta Title</label>
                                        <input type="text" class="form-control @error('meta_title') is-invalid @enderror" 
                                               id="meta_title" name="meta_title" value="{{ old('meta_title', $post->meta_title ?? '') }}">
                                        @error('meta_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="meta_description" class="form-label">Meta Description</label>
                                        <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                                                  id="meta_description" name="meta_description" rows="3">{{ old('meta_description', $post->meta_description ?? '') }}</textarea>
                                        @error('meta_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-circle"></i> Cập nhật bài viết
                                    </button>
                                    <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
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
