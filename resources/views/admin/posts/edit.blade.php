@extends('admin.index')

@section('page_title', 'Chỉnh sửa bài viết')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">Danh sách bài viết</a></li>
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
                        <h3 class="card-title">
                            <i class="bi bi-pencil-square"></i> Chỉnh sửa bài viết: {{ $post->title }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <!-- Basic Information -->
                                    <div class="mb-3">
                                        <label for="title" class="form-label">
                                            <i class="bi bi-type-bold"></i> Tiêu đề <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                               id="title" name="title" placeholder="📝 Nhập tiêu đề bài viết..." 
                                               value="{{ old('title', $post->title) }}" required>
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="excerpt" class="form-label">
                                            <i class="bi bi-text-paragraph"></i> Tóm tắt
                                        </label>
                                        <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                                  id="excerpt" name="excerpt" rows="3" 
                                                  placeholder="📄 Nhập tóm tắt bài viết...">{{ old('excerpt', $post->excerpt) }}</textarea>
                                        @error('excerpt')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <small class="form-text text-muted">Tóm tắt ngắn gọn về bài viết (tối đa 500 ký tự)</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="content" class="form-label">
                                            <i class="bi bi-file-text"></i> Nội dung <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                                  id="content" name="content" rows="15" 
                                                  placeholder="📝 Nhập nội dung bài viết..." required>{{ old('content', $post->content) }}</textarea>
                                        @error('content')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <!-- Sidebar Settings -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">
                                                <i class="bi bi-gear"></i> Cài đặt
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="category_id" class="form-label">
                                                    <i class="bi bi-folder"></i> Danh mục <span class="text-danger">*</span>
                                                </label>
                                                <select class="form-select @error('category_id') is-invalid @enderror" 
                                                        id="category_id" name="category_id" required>
                                                    <option value="">📁 Chọn danh mục</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}" 
                                                                {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="status" class="form-label">
                                                    <i class="bi bi-toggle-on"></i> Trạng thái
                                                </label>
                                                <select class="form-select @error('status') is-invalid @enderror" 
                                                        id="status" name="status">
                                                    <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>📝 Bản nháp</option>
                                                    <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>✅ Xuất bản</option>
                                                    <option value="archived" {{ old('status', $post->status) == 'archived' ? 'selected' : '' }}>📦 Lưu trữ</option>
                                                </select>
                                                @error('status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="published_at" class="form-label">
                                                    <i class="bi bi-calendar"></i> Ngày xuất bản
                                                </label>
                                                <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror" 
                                                       id="published_at" name="published_at" 
                                                       value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}">
                                                @error('published_at')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <small class="form-text text-muted">Để trống để xuất bản ngay lập tức</small>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="featured" name="featured" 
                                                           value="1" {{ old('featured', $post->featured) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="featured">
                                                        <i class="bi bi-star"></i> Đánh dấu nổi bật
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="image" class="form-label">
                                                    <i class="bi bi-image"></i> Hình ảnh
                                                </label>
                                                <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                                       id="image" name="image" accept="image/*">
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <small class="form-text text-muted">Định dạng: JPG, PNG, GIF. Kích thước tối đa: 2MB</small>
                                            </div>

                                            <div class="mb-3">
                                                <label for="tags" class="form-label">
                                                    <i class="bi bi-tags"></i> Tags
                                                </label>
                                                <select class="form-select" id="tags" name="tags[]" multiple>
                                                    @foreach($tags as $tag)
                                                        <option value="{{ $tag->id }}" 
                                                                {{ in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                            {{ $tag->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <small class="form-text text-muted">Giữ Ctrl (Cmd trên Mac) để chọn nhiều tags</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- SEO Settings -->
                                    <div class="card mt-3">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">
                                                <i class="bi bi-search"></i> SEO
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="meta_title" class="form-label">
                                                    <i class="bi bi-type"></i> Meta Title
                                                </label>
                                                <input type="text" class="form-control @error('meta_title') is-invalid @enderror" 
                                                       id="meta_title" name="meta_title" 
                                                       placeholder="🔍 Nhập meta title..." 
                                                       value="{{ old('meta_title', $post->meta_title) }}">
                                                @error('meta_title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="meta_description" class="form-label">
                                                    <i class="bi bi-text-paragraph"></i> Meta Description
                                                </label>
                                                <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                                                          id="meta_description" name="meta_description" rows="3" 
                                                          placeholder="📄 Nhập meta description...">{{ old('meta_description', $post->meta_description) }}</textarea>
                                                @error('meta_description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="meta_keywords" class="form-label">
                                                    <i class="bi bi-tags"></i> Meta Keywords
                                                </label>
                                                <textarea class="form-control @error('meta_keywords') is-invalid @enderror" 
                                                          id="meta_keywords" name="meta_keywords" rows="2" 
                                                          placeholder="🏷️ Nhập meta keywords...">{{ old('meta_keywords', $post->meta_keywords) }}</textarea>
                                                @error('meta_keywords')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <small class="form-text text-muted">Phân cách bằng dấu phẩy</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
                                            <i class="bi bi-arrow-left"></i> Quay lại
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle"></i> Cập nhật bài viết
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

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize Summernote editor
    $('#content').summernote({
        height: 400,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ],
        callbacks: {
            onImageUpload: function(files) {
                // Handle image upload if needed
                console.log('Image upload:', files);
            }
        }
    });

    // Auto-generate meta title from title
    $('#title').on('input', function() {
        if (!$('#meta_title').val()) {
            $('#meta_title').val($(this).val());
        }
    });

    // Auto-generate meta description from excerpt
    $('#excerpt').on('input', function() {
        if (!$('#meta_description').val()) {
            $('#meta_description').val($(this).val());
        }
    });
});
</script>
@endpush
