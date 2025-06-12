<?php
session_start();
include 'lat_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = mysqli_real_escape_string($link, $_POST['name']);
    $password = $_POST['password'];

    $result = mysqli_query($link, "SELECT * FROM users WHERE name = '$name'");

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['status'] = $row['status'];

            if ($row['status'] === 'admin') {
                header("Location: startbootstrap-sb-admin-2-gh-pages/index.php");
            } else {
                header("Location: index.php");
            }
            exit;
        } else {
            echo "<script>alert('❌ Password salah'); window.location.href='login-form.php';</script>";
        }
    } else {
        echo "<script>alert('❌ Username tidak ditemukan'); window.location.href='login-form.php';</script>";
    }
}
?>
