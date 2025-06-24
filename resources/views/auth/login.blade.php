<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 100%;
            max-width: 400px;
        }
        .login-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .login-container .form-group label {
            font-weight: bold;
        }
        .login-container .btn {
            background-color: #007bff;
            border: none;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            border-radius: 4px;
            padding: 10px;
            transition: background-color 0.3s ease;
        }
        .login-container .btn:hover {
            background-color: #0056b3;
        }
        .form-check {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="login-container">
    <h2 class="text-center">Login</h2>
    <form id="login_form">
        @csrf
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-check">
            <input type="checkbox" id="show-password" class="form-check-input">
            <label for="show-password" class="form-check-label">Hiển thị mật khẩu</label>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
        <div class="text-center mt-3">
            <a href="{{ route('forgot.password.index') }}" id="forgot-password">Quên mật khẩu?</a> | <a href="{{ route('register.index') }}" id="register">Đăng ký</a>
            <a href="{{ route('google.login') }}" class="btn btn-danger">
                <i class="fab fa-google"></i> Đăng nhập với Google
            </a>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('#login_form').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: '{{ route('login.post') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if(response.success === true) {
                        toastr.success(response.message || 'Đăng nhập thành công');
                        setTimeout(function() {
                            window.location.href = "{{ url('/dashboard') }}";
                        }, 1000);
                    } else {
                        toastr.error(response.message || 'Đăng nhập thất bại');
                    }
                },
                error: function(xhr) {
                    let message = xhr.responseJSON.message || 'Đăng nhập thất bại';
                    toastr.error(message);
                }
            });
        });

        $('#show-password').on('change', function() {
            if ($(this).is(':checked')) {
                $('#password').attr('type', 'text');
            } else {
                $('#password').attr('type', 'password');
            }
        });
        @if(session('error'))
        toastr.error("{{ session('error') }}");
        @endif

        @if(session('success'))
        toastr.success("{{ session('success') }}");
        @endif
    });
</script>
</body>
</html>
