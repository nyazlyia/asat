<?php
session_start();
include 'lat_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = mysqli_real_escape_string($link, $_POST['name']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $status = mysqli_real_escape_string($link, $_POST['status']);

    $check = mysqli_query($link, "SELECT * FROM users WHERE name = '$name'");
    if (mysqli_num_rows($check) > 0) {
        echo "Username sudah digunakan.";
    } else {
        $insert = "INSERT INTO users (name, password, status) VALUES ('$name', '$password', '$status')";
        if (mysqli_query($link, $insert)) {
            $user_id = mysqli_insert_id($link);
            $_SESSION['user_id'] = $user_id;
            $_SESSION['name'] = $name;
            header("Location: index.php");
            exit;
        } else {
            echo "Gagal daftar: " . mysqli_error($link);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Form</title>
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
        .brand-logo {
            width: 60px;
            height: 60px;
            object-fit: contain;
            margin-bottom: 1rem;
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
                <p class="mb-4 text-muted">Daftarkan Akun Anda</p>
            </div>
            <form method="post" action="">
                <div class="mb-3">
                    <label for="name" class="form-label">Username</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-control" required>
            <option value="">-- Pilih Status --</option>
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>
    </div>
                <button type="submit" class="btn btn-primary w-100 py-2">Daftar</button>
            </form>
        </div>
    </div>
</body>
</html>