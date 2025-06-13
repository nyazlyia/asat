<?php
include 'lat_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $harga_normal = $_POST['harga_normal'];
    $harga_diskon = $_POST['harga_diskon'] ?? 0;

    // Upload foto
    $foto = '';
    if ($_FILES['foto']['name']) {
        $folder = 'uploads/';
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $file_name = time() . '_' . basename($_FILES['foto']['name']);
        $target = $folder . $file_name;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
            $foto = $target;
        }
    }

    // Simpan ke database
    $query = "INSERT INTO produk (nama, foto, `harga_normal`, `harga_diskon`) VALUES (?, ?, ?, ?)";
    $stmt = $link->prepare($query);
    $stmt->bind_param("ssii", $nama, $foto, $harga_normal, $harga_diskon);

    if ($stmt->execute()) {
        echo "Produk berhasil disimpan. <a href='input_barang.php'>Input lagi</a>";
    } else {
        echo "Gagal menyimpan produk: " . $conn->error;
    }
}
?>
