@extends('admin.index')

@section('title', 'Chỉnh sửa tài khoản')

@section('content')
    <h2>Chỉnh sửa tài khoản</h2>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Tên</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
@endsection
