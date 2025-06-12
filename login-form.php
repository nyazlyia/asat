<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #8E7DBE 0%, #F7CFD8 100%);
            min-height: 100vh;
        }
        .login-card {
            border-radius: 20px;
            background: #fff;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.2);
            padding: 2.5rem 2rem;
        }
        .form-control:focus {
            border-color: #8E7DBE;
            box-shadow: 0 0 0 0.2rem #8E7DBE;
        }
        .btn-primary {
            background: linear-gradient(90deg, #8E7DBE 0%, #F7CFD8 100%);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(90deg, #F7CFD8 0%, #8E7DBE 100%);
        }
    </style>
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="login-card w-100" style="max-width:400px;">
            <div class="text-center">
                <h2 class="mb-2 fw-bold" style="color:#8E7DBE;">Selamat Datang</h2>
                <p class="mb-4 text-muted">Masuk ke Akun Anda</p>
            </div>
            <form method="post" action="proses-login.php">
                <div class="mb-3">
                    <label for="name" class="form-label">Username</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2">Login</button>
                <p class="mt-3 text-center">Belum punya akun? <a href="sign-form.php">Daftar</a></p>
            </form>
        </div>
    </div>
</body>
</html>
