<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đặt Lại Mật Khẩu</title>
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
        .reset-password-container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 100%;
            max-width: 400px;
        }
        .reset-password-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .reset-password-container .form-group label {
            font-weight: bold;
        }
        .reset-password-container .btn {
            background-color: #007bff;
            border: none;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            border-radius: 4px;
            padding: 10px;
            transition: background-color 0.3s ease;
        }
        .reset-password-container .btn:hover {
            background-color: #0056b3;
        }
        .reset-password-container .send-otp {
            margin-bottom: 15px;
            display: block;
            color: #007bff;
            cursor: pointer;
        }
        .reset-password-container .send-otp:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="reset-password-container">
    <h2 class="text-center">Đặt Lại Mật Khẩu</h2>
    <form id="reset_password_form">
        @csrf
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <a id="send_otp" class="send-otp">Gửi OTP đến Email</a>
        <div class="form-group">
            <label for="otp">Nhập OTP:</label>
            <input type="text" name="otp" id="otp" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Mật Khẩu Mới:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Nhập Lại Mật Khẩu:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Đặt Lại Mật Khẩu</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('#send_otp').on('click', function(event) {
            event.preventDefault();
            const email = $('#email').val();
            if (!email) {
                toastr.error('Vui lòng nhập email trước khi gửi OTP.');
                return;
            }

            $.ajax({
                url: '{{ route('send.forgot.password') }}',
                method: 'POST',
                data: { email: email, _token: '{{ csrf_token() }}' },
                success: function(response) {
                    if(response.success === true) {
                        toastr.success(response.message || 'OTP đã được gửi đến email của bạn.');
                    } else {
                        toastr.error(response.message || 'Gửi OTP thất bại.');
                    }
                },
                error: function(xhr) {
                    let message = xhr.responseJSON.message || 'Gửi OTP thất bại';
                    toastr.error(message);
                }
            });
        });

        $('#reset_password_form').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: '{{ route('reset.password') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if(response.success === true) {
                        toastr.success(response.message || 'Đặt lại mật khẩu thành công');
                        $('#reset_password_form')[0].reset();
                        setTimeout(function() {
                            window.location.href = "{{ route('login.index') }}";
                        }, 3000);
                    } else {
                        toastr.error(response.message || 'Đặt lại mật khẩu thất bại');
                    }
                },
                error: function(xhr) {
                    let message = xhr.responseJSON.message || 'Đặt lại mật khẩu thất bại';
                    toastr.error(message);
                }
            });
        });
    });
</script>
</body>
</html>
