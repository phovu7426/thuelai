@extends('admin.index')

@section('page_title', 'Chỉnh sửa Danh Mục')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Danh Mục</a></li>
    <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Chỉnh sửa Danh Mục</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Tên Danh Mục</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $category->name) }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="code" class="col-sm-2 col-form-label">Mã Danh Mục</label>
                        <div class="col-sm-10">
                            <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                                   value="{{ old('code', $category->code) }}" required>
                            @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="slug" class="col-sm-2 col-form-label">Slug</label>
                        <div class="col-sm-10">
                            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                                   value="{{ old('slug', $category->slug) }}" required>
                            @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="parent_id" class="col-sm-2 col-form-label">Danh Mục Cha</label>
                        <div class="col-sm-10">
                            <select name="parent_id" class="form-select">
                                <option value="">Không có</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('parent_id', $category->parent_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="description" class="col-sm-2 col-form-label">Mô Tả</label>
                        <div class="col-sm-10">
                            <textarea name="description" class="form-control" rows="3">{{ old('description', $category->description) }}</textarea>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="status" class="col-sm-2 col-form-label">Trạng Thái</label>
                        <div class="col-sm-10">
                            <select name="status" class="form-select">
                                <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>Hiển Thị</option>
                                <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>Ẩn</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Cập Nhật</button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
