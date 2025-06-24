@extends('admin.index')

@section('page_title', 'Chỉnh sửa Series')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.series.index') }}">Series</a></li>
    <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Chỉnh sửa Series</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.series.update', $series->id) }}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Tên Series</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $series->name) }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="code" class="col-sm-2 col-form-label">Mã Series</label>
                        <div class="col-sm-10">
                            <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                                   value="{{ old('code', $series->code) }}" required>
                            @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="description" class="col-sm-2 col-form-label">Mô tả</label>
                        <div class="col-sm-10">
                            <textarea name="description" class="form-control" rows="3">{{ old('description', $series->description) }}</textarea>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="status" class="col-sm-2 col-form-label">Trạng thái</label>
                        <div class="col-sm-10">
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="active" {{ old('status', $series->status) == 'active' ? 'selected' : '' }}>Hoạt động</option>
                                <option value="inactive" {{ old('status', $series->status) == 'inactive' ? 'selected' : '' }}>Không hoạt động</option>
                            </select>
                            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="{{ route('admin.series.index') }}" class="btn btn-secondary">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
