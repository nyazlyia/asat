<?php
@include ('db.php');
$sql="DELETE FROM produk WHERE no='$_GET[pilno]' ";
$DEL=mysqli_query($conn,$sql);

if($DEL) {
    echo "<script> alert('Barang Berhasil di Delete') </script>";
    echo "<script> window.location.href='tables_barang.php' </script>";
} 

?>