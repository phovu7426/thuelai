@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Videos</h3>
            <div class="card-tools">
                <a href="{{ route('admin.stone.videos.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus"></i> Thêm mới
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="50">ID</th>
                            <th>Tiêu đề</th>
                            <th>Mã nhúng</th>
                            <th>Hình thumbnail</th>
                            <th>Mô tả</th>
                            <th>Trạng thái</th>
                            <th width="150">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($videos ?? [] as $video)
                        <tr>
                            <td>{{ $video->id }}</td>
                            <td>{{ $video->title }}</td>
                            <td>{{ Str::limit($video->embed_code, 50) }}</td>
                            <td>
                                @if($video->thumbnail)
                                    <img src="{{ asset($video->thumbnail) }}" alt="{{ $video->title }}" width="50">
                                @else
                                    <span class="text-muted">Không có hình</span>
                                @endif
                            </td>
                            <td>{{ Str::limit($video->description, 100) }}</td>
                            <td>
                                @if($video->status == 1)
                                    <span class="badge bg-success">Hiển thị</span>
                                @else
                                    <span class="badge bg-danger">Ẩn</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.stone.videos.edit', $video->id) }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.stone.videos.destroy', $video->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Không có dữ liệu</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if(isset($videos) && method_exists($videos, 'links'))
            <div class="mt-4">
                {{ $videos->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection 