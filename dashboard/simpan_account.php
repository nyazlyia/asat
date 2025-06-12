<?php 
@include "db.php";
$email= $_POST['email'];
$password= $_POST['password'];
$username= $_POST['username'];
$status= $_POST['status'];
$hashubah=  password_hash($password, PASSWORD_DEFAULT);

simpan('login_user',$email,$hashubah,$username,$status,$conn);

function simpan($table,$email,$hashubah,$username,$status,$conn) {
$log="INSERT INTO $table (email, password, username, status) values ('$email', '$hashubah', '$username', '$status') " ;
$logry=mysqli_query($conn, $log) ; 

if($logry) {
    echo "<script> alert('Akun Admin Berhasil di Tambahkan') </script>";
    echo "<script> window.location.href='index.php' </script>";
} else {
    echo "<script> alert('Akun Gagal di Tambahkan') </script>";
}
}
?>