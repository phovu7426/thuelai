@extends('admin.layouts.main')

@section('title', 'Quản lý dịch vụ lái xe')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Quản lý dịch vụ lái xe</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.driver.dashboard') }}">Dịch vụ lái xe</a></li>
                    <li class="breadcrumb-item active">Quản lý dịch vụ</li>
                </ul>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.driver.services.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus"></i> Thêm dịch vụ mới
                </a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <!-- Services List -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Danh sách dịch vụ</h5>
                </div>
                <div class="card-body">
                    @if($services->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Hình ảnh</th>
                                        <th>Tên dịch vụ</th>
                                        <th>Mô tả ngắn</th>
                                        <th>Giá</th>
                                        <th>Trạng thái</th>
                                        <th>Nổi bật</th>
                                        <th>Thứ tự</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($services as $service)
                                    <tr>
                                        <td>{{ $service->id }}</td>
                                        <td>
                                            @if($service->image)
                                                <img src="{{ asset('storage/' . $service->image) }}" 
                                                     alt="{{ $service->name }}" 
                                                     class="rounded" 
                                                     width="50" height="50">
                                            @else
                                                <div class="bg-secondary rounded d-flex align-items-center justify-content-center" 
                                                     style="width: 50px; height: 50px;">
                                                    <i class="bi bi-image text-white"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $service->name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $service->slug }}</small>
                                        </td>
                                        <td>{{ Str::limit($service->short_description, 100) }}</td>
                                        <td>
                                            @if($service->price_per_hour)
                                                <span class="badge bg-info">{{ number_format($service->price_per_hour) }}đ/giờ</span><br>
                                            @endif
                                            @if($service->price_per_trip)
                                                <span class="badge bg-success">{{ number_format($service->price_per_trip) }}đ/chuyến</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input toggle-status" 
                                                       type="checkbox" 
                                                       data-id="{{ $service->id }}"
                                                       {{ $service->status ? 'checked' : '' }}>
                                                <label class="form-check-label">
                                                    {{ $service->status ? 'Kích hoạt' : 'Vô hiệu' }}
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input toggle-featured" 
                                                       type="checkbox" 
                                                       data-id="{{ $service->id }}"
                                                       {{ $service->is_featured ? 'checked' : '' }}>
                                                <label class="form-check-label">
                                                    {{ $service->is_featured ? 'Nổi bật' : 'Bình thường' }}
                                                </label>
                                            </div>
                                        </td>
                                        <td>{{ $service->sort_order }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.driver.services.show', $service->id) }}" 
                                                   class="btn btn-sm btn-info" title="Xem">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.driver.services.edit', $service->id) }}" 
                                                   class="btn btn-sm btn-warning" title="Sửa">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.driver.services.destroy', $service->id) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Bạn có chắc chắn muốn xóa dịch vụ này?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Xóa">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-3">
                            {{ $services->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-gear text-muted" style="font-size: 3rem;"></i>
                            <h5 class="mt-3 text-muted">Chưa có dịch vụ nào</h5>
                            <p class="text-muted">Hãy tạo dịch vụ đầu tiên để bắt đầu</p>
                            <a href="{{ route('admin.driver.services.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus"></i> Thêm dịch vụ mới
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /Services List -->
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle trạng thái dịch vụ
    document.querySelectorAll('.toggle-status').forEach(function(toggle) {
        toggle.addEventListener('change', function() {
            const serviceId = this.getAttribute('data-id');
            const isChecked = this.checked;
            
            fetch(`/admin/driver/services/${serviceId}/toggle-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Cập nhật label
                    const label = this.nextElementSibling;
                    label.textContent = isChecked ? 'Kích hoạt' : 'Vô hiệu';
                    
                    // Hiển thị thông báo
                    alert(data.message);
                } else {
                    // Khôi phục trạng thái cũ
                    this.checked = !isChecked;
                    alert('Có lỗi xảy ra: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.checked = !isChecked;
                alert('Có lỗi xảy ra khi cập nhật trạng thái');
            });
        });
    });

    // Toggle trạng thái featured
    document.querySelectorAll('.toggle-featured').forEach(function(toggle) {
        toggle.addEventListener('change', function() {
            const serviceId = this.getAttribute('data-id');
            const isChecked = this.checked;
            
            fetch(`/admin/driver/services/${serviceId}/toggle-featured`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Cập nhật label
                    const label = this.nextElementSibling;
                    label.textContent = isChecked ? 'Nổi bật' : 'Bình thường';
                    
                    // Hiển thị thông báo
                    alert(data.message);
                } else {
                    // Khôi phục trạng thái cũ
                    this.checked = !isChecked;
                    alert('Có lỗi xảy ra: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.checked = !isChecked;
                alert('Có lỗi xảy ra khi cập nhật trạng thái nổi bật');
            });
        });
    });
});
</script>
@endsection
