@extends('admin.index')

@section('page_title', 'Thêm Series')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.series.index') }}">Series</a></li>
    <li class="breadcrumb-item active">Thêm</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Thêm Series</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.series.store') }}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Tên Series</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Mã Series</label>
                        <div class="col-sm-10">
                            <input type="text" name="code" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Mô Tả</label>
                        <div class="col-sm-10">
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label">Trạng Thái</label>
                        <div class="col-sm-10">
                            <select name="status" class="form-control">
                                <option value="active" selected>Hoạt Động</option>
                                <option value="inactive">Không Hoạt Động</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Thêm Series</button>
                        <a href="{{ route('admin.series.index') }}" class="btn btn-secondary">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
