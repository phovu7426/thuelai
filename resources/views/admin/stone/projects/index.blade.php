@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Dự án đá</h3>
            <div class="card-tools">
                <a href="{{ route('admin.stone.projects.create') }}" class="btn btn-primary btn-sm">
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
                            <th>Tên dự án</th>
                            <th>Địa điểm</th>
                            <th>Hình ảnh</th>
                            <th>Mô tả</th>
                            <th>Trạng thái</th>
                            <th width="150">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects ?? [] as $project)
                        <tr>
                            <td>{{ $project->id }}</td>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->location }}</td>
                            <td>
                                @if($project->main_image)
                                    <img src="{{ get_image_url($project->main_image) }}" alt="{{ $project->name }}" width="50" class="img-thumbnail">
                                @else
                                    <span class="text-muted">Không có hình</span>
                                @endif
                            </td>
                            <td>{{ Str::limit($project->description, 100) }}</td>
                            <td>
                                @if($project->status == 1)
                                    <span class="badge bg-success">Hiển thị</span>
                                @else
                                    <span class="badge bg-danger">Ẩn</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.stone.projects.edit', $project->id) }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.stone.projects.destroy', $project->id) }}" method="POST" class="d-inline">
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
            
            @if(isset($projects) && method_exists($projects, 'links'))
            <div class="mt-4">
                {{ $projects->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection 