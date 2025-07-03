@extends('admin.index')

@section('page_title', 'Danh sách Bài Đăng')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Danh sách Bài Đăng</li>
@endsection

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-9">
                                <form action="{{ route('admin.posts.index') }}" method="GET">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <input type="text" name="name" class="form-control" placeholder="Tìm theo tiêu đề"
                                                       value="{{ request('name') }}">
                                                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                                <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Reset</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-3 d-flex">
                                @canany(['manage_declarations', 'create_declarations'])
                                    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary ms-auto">Thêm Bài Đăng</a>
                                @endcanany
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                <tr>
                                    <th width="5%">ID</th>
                                    <th width="10%">Hình Ảnh</th>
                                    <th width="25%">Tiêu Đề</th>
                                    <th width="30%">Mô Tả</th>
                                    <th width="10%">Trạng Thái</th>
                                    <th width="10%">Đăng Nhập</th>
                                    <th width="10%">Hành Động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $index => $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>
                                            @if($post->image)
                                                <img src="{{ asset($post->image) }}" width="80" height="50" class="img-thumbnail" style="object-fit: cover">
                                            @else
                                                <span class="text-muted">Không có ảnh</span>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $post->name }}</strong>
                                            <div class="text-muted small">
                                                <i class="far fa-user me-1"></i> {{ $post->user->name ?? 'N/A' }}
                                            </div>
                                            <div class="text-muted small">
                                                <i class="far fa-calendar-alt me-1"></i> {{ $post->created_at->format('d/m/Y H:i') }}
                                            </div>
                                        </td>
                                        <td>{{ Str::limit($post->description ?? strip_tags($post->content), 100) }}</td>
                                        <td>
                                            @if($post->status === 'active')
                                                <span class="badge bg-success">Hiển thị</span>
                                            @else
                                                <span class="badge bg-secondary">Ẩn</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($post->require_login)
                                                <span class="badge bg-warning text-dark">Yêu cầu</span>
                                            @else
                                                <span class="badge bg-info">Không yêu cầu</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.posts.edit', $post->id) }}"
                                                   class="btn btn-sm btn-warning" title="Sửa"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('admin.posts.delete', $post->id) }}"
                                                      method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Xóa"
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                
                                @if($posts->isEmpty())
                                    <tr>
                                        <td colspan="7" class="text-center">Không có bài đăng nào</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>

                        <!-- Hiển thị phân trang -->
                        <div class="mt-4">
                            {{ $posts->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
