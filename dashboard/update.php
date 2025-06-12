<?php
    $lokasi_file=$_FILES['file']['tmp_name']; 
    $nama_file=$_FILES['file']['name']; 
    move_uploaded_file($lokasi_file, "../../assets/images/$nama_file");

    @include ('db.php');
    $upda="UPDATE produk SET kode='$_POST[kode]', namalink='$_POST[namalink]', isi='$_POST[isi]', harga='$_POST[harga]', stock='$_POST[stock]', file='$nama_file' WHERE no='$_POST[no]'";
    $up_ok=mysqli_query($conn, $upda);

    if($up_ok) {
        echo "<script> alert('Barang Berhasil di Edit') </script>";
        echo "<script> window.location.href='tables_barang.php' </script>";
    } 
?>