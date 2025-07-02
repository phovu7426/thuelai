<!doctype html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập - StoneShop</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1500&q=80') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            font-family: 'Montserrat', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(40, 40, 40, 0.55);
            z-index: 1;
        }

        .login-container {
            position: relative;
            z-index: 2;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
            padding: 36px 32px 28px 32px;
            width: 100%;
            max-width: 410px;
            margin: 0 auto;
        }

        .login-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 18px;
        }

        .login-logo img {
            width: 60px;
            height: 60px;
            object-fit: contain;
            margin-bottom: 8px;
        }

        .login-logo span {
            font-size: 22px;
            font-weight: 700;
            color: #3a3a3a;
            letter-spacing: 1px;
        }

        .login-container h2 {
            margin-bottom: 18px;
            font-size: 22px;
            color: #2d2d2d;
            text-align: center;
            font-weight: 600;
        }

        .login-container .form-group label {
            font-weight: 600;
            color: #444;
        }

        .login-container .form-control {
            border-radius: 8px;
            border: 1px solid #d1d5db;
        }

        .login-container .btn-primary {
            background: linear-gradient(90deg, #5a5a5a 0%, #bca177 100%);
            border: none;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
            padding: 10px;
            margin-top: 10px;
            box-shadow: 0 2px 8px rgba(188, 161, 119, 0.12);
            transition: background 0.3s;
        }

        .login-container .btn-primary:hover {
            background: linear-gradient(90deg, #bca177 0%, #5a5a5a 100%);
        }

        .form-check {
            margin-top: 10px;
        }

        .login-container .btn-google {
            background: #eaeaea;
            color: #333;
            border: 1px solid #bca177;
            font-weight: 600;
            border-radius: 8px;
            margin-top: 12px;
            transition: background 0.2s;
        }

        .login-container .btn-google:hover {
            background: #bca177;
            color: #fff;
        }

        .login-container .stone-icon {
            color: #bca177;
            margin-right: 7px;
        }

        .login-container .links {
            margin-top: 16px;
            text-align: center;
        }

        .login-container .links a {
            color: #bca177;
            font-weight: 500;
            margin: 0 4px;
            text-decoration: none;
        }

        .login-container .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="overlay"></div>
    <div class="login-container">
        <div class="login-logo">
            <img src="https://cdn-icons-png.flaticon.com/512/2935/2935358.png" alt="StoneShop Logo">
            <span>StoneShop</span>
        </div>
        <h2>Đăng nhập tài khoản</h2>
        <form id="login_form">
            @csrf
            <div class="form-group">
                <label for="email"><i class="fas fa-envelope stone-icon"></i>Email:</label>
                <input type="text" name="email" id="email" class="form-control" required
                    placeholder="Nhập email...">
            </div>
            <div class="form-group">
                <label for="password"><i class="fas fa-lock stone-icon"></i>Mật khẩu:</label>
                <input type="password" name="password" id="password" class="form-control" required
                    placeholder="Nhập mật khẩu...">
            </div>
            <div class="form-check">
                <input type="checkbox" id="show-password" class="form-check-input">
                <label for="show-password" class="form-check-label">Hiển thị mật khẩu</label>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
            <button type="button" onclick="window.location.href='{{ route('google.login') }}'"
                class="btn btn-google btn-block">
                <i class="fab fa-google stone-icon"></i>Đăng nhập với Google
            </button>
            <div class="links">
                <a href="{{ route('forgot.password.index') }}" id="forgot-password">Quên mật khẩu?</a> |
                <a href="{{ route('register.index') }}" id="register">Đăng ký</a>
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
                        if (response.success === true) {
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
            @if (session('error'))
                toastr.error("{{ session('error') }}");
            @endif
            @if (session('success'))
                toastr.success("{{ session('success') }}");
            @endif
        });
    </script>
</body>

</html>
