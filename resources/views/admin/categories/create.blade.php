@extends('admin.index')

@section('page_title', 'Thêm Danh Mục')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Danh Mục</a></li>
    <li class="breadcrumb-item active">Thêm</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Thêm Danh Mục</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Tên danh mục</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Mã danh mục</label>
                        <div class="col-sm-10">
                            <input type="text" name="code" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Slug</label>
                        <div class="col-sm-10">
                            <input type="text" name="slug" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Danh mục cha</label>
                        <div class="col-sm-10">
                            <select name="parent_id" class="form-control">
                                <option value="">Chọn danh mục cha (nếu có)</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Mô tả</label>
                        <div class="col-sm-10">
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Trạng thái</label>
                        <div class="col-sm-10">
                            <select name="status" class="form-control">
                                <option value="1" selected>Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Thêm Danh Mục</button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
