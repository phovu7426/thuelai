@extends('admin.index')

@section('page_title', 'Danh sách tin tức')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Danh sách tin tức</li>
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
                        <div class="row align-items-center">
                            <div class="col-sm-9">
                                <!-- Form lọc -->
                                <form action="{{ route('admin.posts.index') }}" method="GET" class="mb-0">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <input type="text" name="title" class="form-control" placeholder="🔍 Nhập tiêu đề tin tức"
                                                   value="{{ request('title') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-search"></i> Lọc
                                            </button>
                                            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
                                                <i class="bi bi-arrow-clockwise"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-3 d-flex justify-content-end">
                                @can('access_users')
                                    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-circle"></i> Thêm tin tức
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tiêu đề</th>
                                    <th>Danh mục</th>
                                    <th>Tác giả</th>
                                    <th>Trạng thái</th>
                                    <th>Nổi bật</th>
                                    <th>Ngày tạo</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $index => $post)
                                <tr>
                                    <td>{{ $posts->firstItem() + $index }}</td>
                                    <td>
                                        <strong>{{ Str::limit($post->title ?? '', 50) }}</strong>
                                        @if($post->excerpt)
                                            <br><small class="text-muted">{{ Str::limit($post->excerpt, 80) }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $post->category->name ?? 'Không có' }}</span>
                                    </td>
                                    <td>
                                        <strong>{{ $post->author->name ?? 'Không có' }}</strong>
                                    </td>
                                    <td>
                                                <select class="form-select form-select-sm status-select" 
                                                        data-post-id="{{ $post->id }}" 
                                                        data-current-status="{{ $post->status }}"
                                                        data-status-type="posts">
                                                    <option value="draft" {{ $post->status == 'draft' ? 'selected' : '' }}>
                                                        Nháp
                                                    </option>
                                                    <option value="published" {{ $post->status == 'published' ? 'selected' : '' }}>
                                                        Xuất bản
                                                    </option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select form-select-sm featured-select" 
                                                        data-post-id="{{ $post->id }}" 
                                                        data-current-featured="{{ $post->featured ? '1' : '0' }}"
                                                        data-featured-type="posts">
                                                    <option value="0" {{ !$post->featured ? 'selected' : '' }}>
                                                        Bình thường
                                                    </option>
                                                    <option value="1" {{ $post->featured ? 'selected' : '' }}>
                                                        Nổi bật
                                                    </option>
                                                </select>
                                            </td>
                                    <td>{{ $post->created_at ? $post->created_at->format('d/m/Y') : 'N/A' }}</td>
                                    <td>
                                        @can('access_users')
                                            <a href="{{ route('admin.posts.show', $post->id) }}" 
                                               class="btn btn-sm btn-info" title="Xem chi tiết">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.posts.edit', $post->id) }}" 
                                               class="btn btn-sm btn-warning" title="Chỉnh sửa">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST"
                                                  style="display:inline;"
                                                  onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Xóa" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        
                        <!-- Phân trang -->
                        @if($posts->hasPages())
                            <div class="d-flex justify-content-center mt-3">
                                {{ $posts->links() }}
                            </div>
                        @endif
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
@endsection

@section('scripts')
<!-- Sử dụng component chung admin-dropdowns.js -->
@endsection
