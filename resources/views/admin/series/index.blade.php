@extends('admin.index')

@section('page_title', 'Danh sách Series')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Danh sách Series</li>
@endsection

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-9">
                                <form action="{{ route('admin.series.index') }}" method="GET">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" name="name" class="form-control" placeholder="Nhập tên series"
                                                   value="{{ request('name') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" name="code" class="form-control" placeholder="Nhập mã series"
                                                   value="{{ request('code') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary">Lọc</button>
                                            <a href="{{ route('admin.series.index') }}" class="btn btn-secondary">Reset</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-3 d-flex">
                                <a href="{{ route('admin.series.create') }}" class="btn btn-primary ms-auto">Thêm Series</a>
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
                                    <th>STT</th>
                                    <th>Tên Series</th>
                                    <th>Mã Series</th>
                                    <th>Trạng Thái</th>
                                    <th>Nổi Bật</th>
                                    <th>Hành Động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($series as $index => $each)
                                    <tr>
                                        <td>{{ $series->firstItem() + $index }}</td>
                                        <td>{{ $each->name ?? '' }}</td>
                                        <td>{{ $each->code ?? '' }}</td>
                                        <td>
                                            <select class="form-select form-select-sm status-select" 
                                                    data-series-id="{{ $each->id }}" 
                                                    data-current-status="{{ $each->status === 'active' ? 'active' : 'inactive' }}"
                                                    data-status-type="series">
                                                <option value="inactive" {{ $each->status !== 'active' ? 'selected' : '' }}>
                                                    Không hoạt động
                                                </option>
                                                <option value="active" {{ $each->status === 'active' ? 'selected' : '' }}>
                                                    Hoạt động
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-select form-select-sm featured-select" 
                                                    data-series-id="{{ $each->id }}" 
                                                    data-current-featured="{{ $each->is_featured ? '1' : '0' }}"
                                                    data-featured-type="series">
                                                <option value="0" {{ !$each->is_featured ? 'selected' : '' }}>
                                                    Không nổi bật
                                                </option>
                                                <option value="1" {{ $each->is_featured ? 'selected' : '' }}>
                                                    Nổi bật
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="{{ route('admin.series.edit', $each->id) }}"
                                                   class="btn-action btn-edit" title="Sửa"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('admin.series.delete', $each->id) }}"
                                                      method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-action btn-delete" title="Xóa"
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Hiển thị phân trang -->
                        @include('vendor.pagination.pagination', ['paginator' => $series])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Status select change
    $('.status-select').change(function() {
        const seriesId = $(this).data('series-id');
        const newStatus = $(this).val();
        const currentStatus = $(this).data('current-status');
        
        if (newStatus === currentStatus) return;
        
        $.ajax({
            url: `/admin/series/${seriesId}/toggle-status`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: newStatus
            },
            success: function(response) {
                if (response.success) {
                    // Cập nhật current status
                    $(this).data('current-status', newStatus);
                    showAlert('success', response.message);
                } else {
                    showAlert('danger', response.message);
                    // Revert select
                    $(this).val(currentStatus);
                }
            }.bind(this),
            error: function() {
                showAlert('danger', 'Có lỗi xảy ra khi cập nhật trạng thái');
                // Revert select
                $(this).val(currentStatus);
            }.bind(this)
        });
    });

    // Featured select change
    $('.featured-select').change(function() {
        const seriesId = $(this).data('series-id');
        const newFeatured = $(this).val();
        const currentFeatured = $(this).data('current-featured');
        
        if (newFeatured === currentFeatured) return;
        
        $.ajax({
            url: `/admin/series/${seriesId}/toggle-featured`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                is_featured: newFeatured
            },
            success: function(response) {
                if (response.success) {
                    // Cập nhật current featured
                    $(this).data('current-featured', newFeatured);
                    showAlert('success', response.message);
                } else {
                    showAlert('danger', response.message);
                    // Revert select
                    $(this).val(currentFeatured);
                }
            }.bind(this),
            error: function() {
                showAlert('danger', 'Có lỗi xảy ra khi cập nhật nổi bật');
                // Revert select
                $(this).val(currentFeatured);
            }.bind(this)
        });
    });
});

function showAlert(type, message) {
    const alertHtml = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    // Tạo container nếu chưa có
    if ($('#alert-container').length === 0) {
        $('.card-body').prepend('<div id="alert-container"></div>');
    }
    
    $('#alert-container').html(alertHtml);
    
    // Auto hide after 5 seconds
    setTimeout(function() {
        $('#alert-container .alert').fadeOut();
    }, 5000);
}
</script>
@endsection
