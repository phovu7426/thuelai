@extends('admin.index')

@section('page_title', 'Danh sách Danh Mục')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Danh sách Danh Mục</li>
@endsection

@section('content')
    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-9">
                                <form action="{{ route('admin.categories.index') }}" method="GET">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" name="name" class="form-control" placeholder="Nhập tên"
                                                   value="{{ request('name') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" name="code" class="form-control" placeholder="Nhập mã"
                                                   value="{{ request('code') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary">Lọc</button>
                                            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Reset</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-3 d-flex">
                                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary ms-auto">Thêm Danh Mục</a>
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
                                    <th>Tên Danh Mục</th>
                                    <th>Mã</th>
                                    <th>Slug</th>
                                    <th>Danh Mục Cha</th>
                                    <th>Trạng Thái</th>
                                    <th>Hành Động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $index => $category)
                                    <tr>
                                        <td>{{ $categories->firstItem() + $index }}</td>
                                        <td>{{ $category->name ?? '' }}</td>
                                        <td>{{ $category->code ?? '' }}</td>
                                        <td>{{ $category->slug ?? '' }}</td>
                                        <td>{{ $category->parent->name ?? 'N/A' }}</td>
                                        <td>
                                            @if($category->status)
                                                <span class="badge bg-success">Hiển thị</span>
                                            @else
                                                <span class="badge bg-secondary">Ẩn</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                               class="btn btn-sm btn-warning" title="Sửa"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('admin.categories.delete', $category->id) }}"
                                                  method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Xóa"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Hiển thị phân trang -->
                        @include('vendor.pagination.pagination', ['paginator' => $categories])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
