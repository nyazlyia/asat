<?php
@include "db.php";
$email= $_POST['email'];
$password= $_POST['password'];

$log="SELECT * FROM login_user where email='$email'" ;
$logry=mysqli_query($conn, $log) ; 
$datalog= mysqli_fetch_array($logry);

if (mysqli_num_rows($logry) > 0) {
    if (password_verify($password, $datalog['password'])) {
        @session_start();
        $_SESSION['usr'] = $datalog['email'];
        $_SESSION['status'] = $datalog['status']; // simpan role user

        if ($datalog['status'] === 'admin') {
            echo "<script> window.location.href='index.php' </script>";
        } else {
            echo "<script> window.location.href='../../index.php'</script>";
        }
    } else {
        echo "<script> alert('Gagal Login') </script>";
        echo "<script> window.location.href='login.html' </script>";
    }
}
else {
      echo "user dan password tidak ditemukan ";
}
?>