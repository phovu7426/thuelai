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
                        <div class="row align-items-center">
                            <div class="col-sm-9">
                                <h5 class="mb-0">Danh sách dịch vụ lái xe</h5>
                            </div>
                            <div class="col-sm-3 d-flex justify-content-end">
                                <a href="{{ route('admin.driver.services.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle"></i> Thêm dịch vụ
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- Services Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="services-table">
                                <thead class="table-light">
                                    <tr>
                                        <th width="50">ID</th>
                                        <th width="80">Ảnh</th>
                                        <th width="80">Icon</th>
                                        <th>Tên dịch vụ</th>
                                        <th width="120">Trạng thái</th>
                                        <th width="100">Nổi bật</th>
                                        <th width="120">Ngày tạo</th>
                                        <th width="150">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($services as $service)
                                        <tr>
                                            <td>{{ $service->id }}</td>
                                            <td>
                                                @if($service->image)
                                                    <img src="/storage/{{ $service->image }}" class="img-thumbnail" width="60" height="60">
                                                @else
                                                    <span class="text-muted">Không có ảnh</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($service->icon)
                                                    <img src="/storage/{{ $service->icon }}" width="40" height="40">
                                                @else
                                                    <i class="fas fa-image text-muted" style="font-size: 20px;"></i>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $service->name }}</strong>
                                                @if($service->short_description)
                                                    <br><small class="text-muted">{{ $service->short_description }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <select class="form-select form-select-sm status-select" 
                                                        data-service-id="{{ $service->id }}" 
                                                        data-current-status="{{ $service->status ? '1' : '0' }}"
                                                        data-status-type="services">
                                                    <option value="0" {{ !$service->status ? 'selected' : '' }}>
                                                        Vô hiệu hóa
                                                    </option>
                                                    <option value="1" {{ $service->status ? 'selected' : '' }}>
                                                        Kích hoạt
                                                    </option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select form-select-sm featured-select" 
                                                        data-service-id="{{ $service->id }}" 
                                                        data-current-featured="{{ $service->is_featured ? '1' : '0' }}"
                                                        data-featured-type="services">
                                                    <option value="0" {{ !$service->is_featured ? 'selected' : '' }}>
                                                        Bình thường
                                                    </option>
                                                    <option value="1" {{ $service->is_featured ? 'selected' : '' }}>
                                                        Nổi bật
                                                    </option>
                                                </select>
                                            </td>
                                            <td>{{ $service->created_at ? $service->created_at->format('d/m/Y') : 'N/A' }}</td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="{{ route('admin.driver.services.edit', $service->id) }}"
                                                       class="btn-action btn-edit" title="Sửa"><i class="fas fa-edit"></i></a>
                                                    <button type="button" class="btn-action btn-delete" title="Xóa"
                                                            onclick="deleteService({{ $service->id }})">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">Không có dịch vụ nào</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $services->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Bind event handlers
    bindEventHandlers();
});

// Bind event handlers
function bindEventHandlers() {
    // Status toggle
    $('.status-select').change(function() {
        const serviceId = $(this).data('service-id');
        const newStatus = $(this).val();
        toggleStatus(serviceId, newStatus);
    });

    // Featured toggle
    $('.featured-select').change(function() {
        const serviceId = $(this).data('service-id');
        const newFeatured = $(this).val();
        toggleFeatured(serviceId, newFeatured);
    });

    // Delete service
    $('.delete-service').click(function() {
        const serviceId = $(this).data('id');
        if (confirm('Bạn có chắc chắn muốn xóa dịch vụ này không?')) {
            deleteService(serviceId);
        }
    });
}

// Toggle status
function toggleStatus(serviceId, newStatus) {
    $.ajax({
        url: `/admin/driver/services/${serviceId}/toggle-status`,
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            status: newStatus
        },
        success: function(response) {
            if (response.success) {
                showAlert(response.message, 'success');
                // Update current status
                $(`select[data-service-id="${serviceId}"]`).data('current-status', newStatus);
            } else {
                showAlert(response.message, 'error');
                // Revert select
                const select = $(`select[data-service-id="${serviceId}"]`);
                select.val(select.data('current-status'));
            }
        },
        error: function(xhr) {
            showAlert('Có lỗi xảy ra', 'error');
            // Revert select
            const select = $(`select[data-service-id="${serviceId}"]`);
            select.val(select.data('current-status'));
        }
    });
}

// Toggle featured
function toggleFeatured(serviceId, newFeatured) {
    $.ajax({
        url: `/admin/driver/services/${serviceId}/toggle-featured`,
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            is_featured: newFeatured
        },
        success: function(response) {
            if (response.success) {
                showAlert(response.message, 'success');
                // Update current featured
                $(`select[data-service-id="${serviceId}"]`).data('current-featured', newFeatured);
            } else {
                showAlert(response.message, 'error');
                // Revert select
                const select = $(`select[data-service-id="${serviceId}"]`);
                select.val(select.data('current-featured'));
            }
        },
        error: function(xhr) {
            showAlert('Có lỗi xảy ra', 'error');
            // Revert select
            const select = $(`select[data-service-id="${serviceId}"]`);
            select.val(select.data('current-featured'));
        }
    });
}

// Delete service
function deleteService(serviceId) {
    $.ajax({
        url: `/admin/driver/services/${serviceId}`,
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                showAlert(response.message, 'success');
                // Remove row from table
                $(`tr:has(button[data-id="${serviceId}"])`).remove();
            } else {
                showAlert(response.message, 'error');
            }
        },
        error: function(xhr) {
            showAlert('Có lỗi xảy ra', 'error');
        }
    });
}

// Helper functions
function showAlert(message, type) {
    // Tạo alert container nếu chưa có
    if (!$('#alert-container').length) {
        $('.card-body').prepend('<div id="alert-container"></div>');
    }

    const alertHtml = `
        <div class="alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;

    $('#alert-container').html(alertHtml);

    // Auto hide after 5 seconds
    setTimeout(function() {
        $('#alert-container .alert').fadeOut();
    }, 5000);
}
</script>
@endpush
