<?php
@include('db.php');

if(isset($_POST['submit'])) {
    $lokasi_file=$_FILES['file']['tmp_name']; 
    $nama_file=$_FILES['file']['name'];
    $file = "../../assets/images/" . $nama_file;
    move_uploaded_file($lokasi_file, $file);

    $sql= "INSERT INTO produk (kode, namalink, isi, harga, stock, `file`) 
            VALUES ('$_POST[kode]', '$_POST[namalink]', '$_POST[isi]', '$_POST[harga]', '$_POST[stock]', '$nama_file')";
    $B= mysqli_query($conn,$sql);
    
    echo "<script> alert('data berhasil di tambahkan') </script>";
    echo "<script> window.location.href='tables_barang.php' </script>";
    } else {
        echo "
        <script>
            alert('data gagal ditambahkan')
        </script>";
    }
?>