@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ứng dụng đá</h3>
            <div class="card-tools">
                <a href="{{ route('admin.stone.applications.create') }}" class="btn btn-primary btn-sm">
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
                            <th>Tên ứng dụng</th>
                            <th>Slug</th>
                            <th>Hình ảnh</th>
                            <th>Mô tả</th>
                            <th>Trạng thái</th>
                            <th width="150">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applications ?? [] as $application)
                        <tr>
                            <td>{{ $application->id }}</td>
                            <td>{{ $application->name }}</td>
                            <td>{{ $application->slug }}</td>
                            <td>
                                @if($application->image)
                                    <img src="{{ get_image_url($application->image) }}" alt="{{ $application->name }}" width="50" class="img-thumbnail">
                                @else
                                    <span class="text-muted">Không có hình</span>
                                @endif
                            </td>
                            <td>{{ Str::limit($application->description, 100) }}</td>
                            <td>
                                @if($application->status == 1)
                                    <span class="badge bg-success">Hiển thị</span>
                                @else
                                    <span class="badge bg-danger">Ẩn</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.stone.applications.edit', $application->id) }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.stone.applications.destroy', $application->id) }}" method="POST" class="d-inline">
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
            
            @if(isset($applications) && method_exists($applications, 'links'))
            <div class="mt-4">
                {{ $applications->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection 