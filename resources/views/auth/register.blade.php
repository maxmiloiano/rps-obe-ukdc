<!DOCTYPE html>
<html>
<head>
    <title>Registrasi — OBE System</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background: #f4f6fb;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        .register-wrapper{
            max-width: 500px;
            margin: 60px auto;
        }

        .register-card{
            background: #ffffff;
            padding: 35px;
            border-radius: 14px;
            box-shadow: 0 15px 35px rgba(0,0,0,.08);
        }

        .register-title{
            font-size: 22px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 25px;
        }

        .btn-register{
            width: 100%;
            background: #2563eb;
            color: white;
            padding: 10px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
        }

        .btn-register:hover{
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

<div class="register-wrapper">
    <div class="register-card">

        <div class="register-title">
            Daftar Akun <span style="color:#2563eb;">OBE System</span>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ url('/register') }}">
        @csrf

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama_lengkap" placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input class="form-control" type="email" name="email" placeholder="nama@contoh.com" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input class="form-control" type="password" name="password" placeholder="Masukkan kata sandi" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <select class="form-select" name="role" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="admin">Admin</option>
                    <option value="kaprodi">Kaprodi</option>
                    <option value="dosen">Dosen</option>
                </select>
            </div>

            

            <div class="mb-3">
                <label class="form-label">Status Akun</label>
                <select class="form-select" name="status" required>
                    <option value="Aktif">Aktif</option>
                    <option value="Nonaktif">Nonaktif</option>
                </select>
            </div>

            <button type="submit" class="btn-register">
                Daftar Sekarang
            </button>

        </form>

        <p class="text-center mt-3">
            Sudah punya akun?
            <a href="/login" class="text-primary">Masuk di sini</a>
        </p>

    </div>
</div>

</body>
</html>
