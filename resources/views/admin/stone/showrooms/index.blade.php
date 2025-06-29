@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Showroom</h3>
            <div class="card-tools">
                <a href="{{ route('admin.stone.showrooms.create') }}" class="btn btn-primary btn-sm">
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
                            <th>Tên showroom</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Hình ảnh</th>
                            <th>Trạng thái</th>
                            <th width="150">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($showrooms ?? [] as $showroom)
                        <tr>
                            <td>{{ $showroom->id }}</td>
                            <td>{{ $showroom->name }}</td>
                            <td>{{ $showroom->address }}</td>
                            <td>{{ $showroom->phone }}</td>
                            <td>
                                @if($showroom->image)
                                    <img src="{{ get_image_url($showroom->image) }}" alt="{{ $showroom->name }}" width="50" class="img-thumbnail">
                                @else
                                    <span class="text-muted">Không có hình</span>
                                @endif
                            </td>
                            <td>
                                @if($showroom->status == 1)
                                    <span class="badge bg-success">Hiển thị</span>
                                @else
                                    <span class="badge bg-danger">Ẩn</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.stone.showrooms.edit', $showroom->id) }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.stone.showrooms.destroy', $showroom->id) }}" method="POST" class="d-inline">
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
            
            @if(isset($showrooms) && method_exists($showrooms, 'links'))
            <div class="mt-4">
                {{ $showrooms->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection 