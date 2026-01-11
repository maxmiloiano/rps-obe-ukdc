<!DOCTYPE html>
<html>
<head>
    <title>Login — OBE System</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background: #f4f6fb;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        .login-wrapper{
            max-width: 450px;
            margin: 80px auto;
        }

        .login-card{
            background: #ffffff;
            padding: 35px;
            border-radius: 14px;
            box-shadow: 0 15px 35px rgba(0,0,0,.08);
        }

        .login-title{
            font-size: 22px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 25px;
        }

        .btn-login{
            width: 100%;
            background: #2563eb;
            color: white;
            padding: 10px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
        }

        .btn-login:hover{
            background: #1e4fd3;
        }

        a{
            text-decoration: none;
        }

        a:hover{
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="login-wrapper">
    <div class="login-card">

        <div class="login-title">
            Masuk ke <span style="color:#2563eb;">OBE System</span>
        </div>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input class="form-control" type="email" name="email" placeholder="nama@contoh.com" required>
            </div>

            <div class="mb-2">
                <label class="form-label">Kata sandi</label>
                <input class="form-control" type="password" name="password" placeholder="Masukkan kata sandi" required>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <input type="checkbox"> Ingat saya
                </div>

                <a href="#" class="text-primary">Lupa kata sandi?</a>
            </div>

            <button type="submit" class="btn-login">
                Masuk
            </button>
        </form>

        <p class="text-center mt-3">
            Belum punya akun?
            <a href="/register" class="text-primary">Daftar di sini</a>
        </p>

    </div>
</div>

</body>
</html>
