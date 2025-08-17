@extends('admin.index')

@section('page_title', 'Danh sách tags')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Danh sách tags</li>
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
                                <!-- Form lọc -->
                                <form action="{{ route('admin.post-tags.index') }}" method="GET" class="mb-0">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <input type="text" name="name" class="form-control" placeholder="🔍 Nhập tên tag"
                                                   value="{{ request('name') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-search"></i> Lọc
                                            </button>
                                            <a href="{{ route('admin.post-tags.index') }}" class="btn btn-secondary">
                                                <i class="bi bi-arrow-clockwise"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-3 d-flex justify-content-end">
                                @can('access_users')
                                    <a href="{{ route('admin.post-tags.create') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-circle"></i> Thêm tag
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên tag</th>
                                <th>Mô tả</th>
                                <th>Màu sắc</th>
                                <th>Trạng thái</th>
                                <th>Hành Động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tags as $index => $tag)
                                <tr>
                                    <td>{{ $tags->firstItem() + $index }}</td>
                                    <td>
                                        <strong>{{ $tag->name ?? '' }}</strong>
                                        <br><small class="text-muted">Slug: {{ $tag->slug ?? '' }}</small>
                                    </td>
                                    <td>{{ Str::limit($tag->description ?? '', 80) }}</td>
                                    <td>
                                        @if($tag->color)
                                            <div class="d-flex align-items-center">
                                                <div class="color-preview me-2" style="width: 20px; height: 20px; background-color: {{ $tag->color }}; border-radius: 4px;"></div>
                                                <span>{{ $tag->color }}</span>
                                            </div>
                                        @else
                                            <span class="text-muted">Không có</span>
                                        @endif
                                    </td>
                                    <td>
                                                <select class="form-select form-select-sm status-select" 
                                                        data-tag-id="{{ $tag->id }}" 
                                                        data-current-status="{{ $tag->is_active ? '1' : '0' }}"
                                                        data-status-type="default">
                                                    <option value="0" {{ !$tag->is_active ? 'selected' : '' }}>
                                                        Vô hiệu
                                                    </option>
                                                    <option value="1" {{ $tag->is_active ? 'selected' : '' }}>
                                                        Kích hoạt
                                                    </option>
                                                </select>
                                            </td>
                                    <td>
                                        @can('access_users')
                                            <a href="{{ route('admin.post-tags.edit', $tag->id ?? '') }}"
                                               class="btn btn-sm btn-warning" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
                                            
                                            <form action="{{ route('admin.post-tags.destroy', $tag->id ?? '') }}" method="POST"
                                                  style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Xóa" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa tag này?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        
                        <!-- Phân trang -->
                        @if($tags->hasPages())
                            <div class="d-flex justify-content-center mt-3">
                                {{ $tags->links() }}
                            </div>
                        @endif
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

@section('scripts')
<!-- Sử dụng component chung admin-dropdowns.js -->
@endsection


