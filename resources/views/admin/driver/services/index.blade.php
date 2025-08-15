@extends('admin.index')

@section('page_title', 'Quản lý dịch vụ lái xe')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Quản lý dịch vụ lái xe</li>
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
                        <div class="row">
                            <div class="col-sm-9">
                                <!-- Form lọc -->
                                <form action="{{ route('admin.driver.services.index') }}" method="GET">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" name="name" class="form-control" placeholder="Nhập tên dịch vụ"
                                                   value="{{ request('name') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <select name="status" class="form-control">
                                                <option value="">Tất cả trạng thái</option>
                                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Kích hoạt</option>
                                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Vô hiệu</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary">Lọc</button>
                                            <a href="{{ route('admin.driver.services.index') }}" class="btn btn-secondary">Reset</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-3 d-flex">
                                <a href="{{ route('admin.driver.services.create') }}" class="btn btn-primary ms-auto">
                                    <i class="bi bi-plus"></i> Thêm dịch vụ
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    @if($services->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Hình ảnh</th>
                                        <th>Tên dịch vụ</th>
                                        <th>Mô tả ngắn</th>
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
                        @include('vendor.pagination.pagination', ['paginator' => $services])
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
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
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
