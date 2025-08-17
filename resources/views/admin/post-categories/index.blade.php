@extends('admin.index')

@section('page_title', 'Danh sách danh mục tin tức')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Danh sách danh mục tin tức</li>
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
                                <!-- Form tìm kiếm -->
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <input type="text" id="search-name" class="form-control" placeholder="🔍 Nhập tên danh mục">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" id="btn-search" class="btn btn-primary">
                                            <i class="bi bi-search"></i> Tìm kiếm
                                        </button>
                                        <button type="button" id="btn-reset" class="btn btn-secondary">
                                            <i class="bi bi-arrow-clockwise"></i> Reset
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 d-flex justify-content-end">
                                @can('access_users')
                                    <a href="{{ route('admin.post-categories.create') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-circle"></i> Thêm danh mục
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- Alert messages -->
                        <div id="alert-container"></div>

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên danh mục</th>
                                <th>Mô tả</th>
                                <th>Màu sắc</th>
                                <th>Trạng thái</th>
                                <th>Nổi bật</th>
                                <th>Hành Động</th>
                            </tr>
                            </thead>
                            <tbody id="categories-table-body">
                            @foreach($categories as $index => $category)
                                <tr data-id="{{ $category->id }}">
                                    <td>{{ $categories->firstItem() + $index }}</td>
                                    <td>
                                        <strong>{{ $category->name ?? '' }}</strong>
                                        <br><small class="text-muted">Slug: {{ $category->slug ?? '' }}</small>
                                    </td>
                                    <td>{{ Str::limit($category->description ?? '', 80) }}</td>
                                    <td>
                                        @if($category->color)
                                            <div class="d-flex align-items-center">
                                                <div class="color-preview me-2" style="width: 20px; height: 20px; background-color: {{ $category->color }}; border-radius: 4px;"></div>
                                                <span>{{ $category->color }}</span>
                                            </div>
                                        @else
                                            <span class="text-muted">Không có</span>
                                        @endif
                                    </td>
                                    <td>
                                        <select class="form-select form-select-sm status-select" 
                                                data-category-id="{{ $category->id }}" 
                                                data-current-status="{{ $category->is_active ? '1' : '0' }}"
                                                data-status-type="post-categories">
                                            <option value="0" {{ !$category->is_active ? 'selected' : '' }}>
                                                Vô hiệu
                                            </option>
                                            <option value="1" {{ $category->is_active ? 'selected' : '' }}>
                                                Kích hoạt
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-select form-select-sm featured-select" 
                                                data-category-id="{{ $category->id }}" 
                                                data-current-featured="{{ $category->is_featured ? '1' : '0' }}"
                                                data-featured-type="post-categories">
                                            <option value="0" {{ !$category->is_featured ? 'selected' : '' }}>
                                                Không nổi bật
                                            </option>
                                            <option value="1" {{ $category->is_featured ? 'selected' : '' }}>
                                                Nổi bật
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            @can('access_users')
                                                <a href="{{ route('admin.post-categories.edit', $category->id ?? '') }}"
                                                   class="btn-action btn-edit" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
                                                <button type="button" class="btn-action btn-delete" title="Xóa" onclick="deleteCategory({{ $category->id }})">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        
                        <!-- Phân trang -->
                        <div id="pagination-container">
                            @if($categories->hasPages())
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $categories->links() }}
                                </div>
                            @endif
                        </div>
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

@push('scripts')
<script>
$(document).ready(function() {
    // Status select change
    $('.status-select').change(function() {
        const categoryId = $(this).data('category-id');
        const newStatus = $(this).val();
        const currentStatus = $(this).data('current-status');
        
        if (newStatus === currentStatus) return;
        
        $.ajax({
            url: `/admin/post-categories/${categoryId}/toggle-status`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: newStatus
            },
            success: function(response) {
                if (response.success) {
                    showAlert('success', response.message);
                    // Cập nhật current status
                    $(this).data('current-status', newStatus);
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

    // Toggle featured
    $('.toggle-featured').change(function() {
        const categoryId = $(this).data('id');
        const isChecked = $(this).is(':checked');
        
        $.ajax({
            url: `/admin/post-categories/${categoryId}/toggle-featured`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    showAlert('success', response.message);
                    // Cập nhật label
                    $(`.featured-label-${categoryId}`).text(isChecked ? 'Có' : 'Không');
                } else {
                    showAlert('danger', response.message);
                    // Revert checkbox
                    $(this).prop('checked', !isChecked);
                }
            },
            error: function() {
                showAlert('danger', 'Có lỗi xảy ra khi cập nhật nổi bật');
                // Revert checkbox
                $(this).prop('checked', !isChecked);
            }
        });
    });

    // Search
    $('#btn-search').click(function() {
        searchCategories();
    });

    // Reset search
    $('#btn-reset').click(function() {
        $('#search-name').val('');
        searchCategories();
    });

    // Enter key search
    $('#search-name').keypress(function(e) {
        if (e.which == 13) {
            searchCategories();
        }
    });
});

function searchCategories(page = 1) {
    const name = $('#search-name').val();
    
    $.ajax({
        url: '{{ route("admin.post-categories.index") }}',
        method: 'GET',
        data: {
            name: name,
            page: page
        },
        success: function(response) {
            $('#categories-table-body').html(response.html);
            $('#pagination-container').html(response.pagination);
            
            // Rebind events
            bindEvents();
        },
        error: function() {
            showAlert('danger', 'Có lỗi xảy ra khi tìm kiếm');
        }
    });
}

function deleteCategory(categoryId) {
    if (confirm('Bạn có chắc chắn muốn xóa danh mục này không?')) {
        $.ajax({
            url: `/admin/post-categories/${categoryId}`,
            method: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    showAlert('success', response.message);
                    // Remove row from table
                    $(`tr[data-id="${categoryId}"]`).remove();
                } else {
                    showAlert('danger', response.message);
                }
            },
            error: function() {
                showAlert('danger', 'Có lỗi xảy ra khi xóa danh mục');
            }
        });
    }
}

function bindEvents() {
    // Rebind status select events
    $('.status-select').off('change').on('change', function() {
        const categoryId = $(this).data('category-id');
        const newStatus = $(this).val();
        const currentStatus = $(this).data('current-status');
        
        if (newStatus === currentStatus) return;
        
        $.ajax({
            url: `/admin/post-categories/${categoryId}/toggle-status`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: newStatus
            },
            success: function(response) {
                if (response.success) {
                    showAlert('success', response.message);
                    // Cập nhật current status
                    $(this).data('current-status', newStatus);
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

    // Rebind featured select events
    $('.featured-select').off('change').on('change', function() {
        const categoryId = $(this).data('category-id');
        const newFeatured = $(this).val();
        const currentFeatured = $(this).data('current-featured');
        
        if (newFeatured === currentFeatured) return;
        
        $.ajax({
            url: `/admin/post-categories/${categoryId}/toggle-featured`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                is_featured: newFeatured
            },
            success: function(response) {
                if (response.success) {
                    showAlert('success', response.message);
                    // Cập nhật current featured
                    $(this).data('current-featured', newFeatured);
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
}

function showAlert(type, message) {
    const alertHtml = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
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
