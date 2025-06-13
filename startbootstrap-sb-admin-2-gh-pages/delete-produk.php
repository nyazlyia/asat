<?php
include 'lat_conn.php'; // Pastikan file koneksi database sudah benar

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Query hapus produk
    $query = "DELETE FROM produk WHERE id = $id";
    $result = mysqli_query($link, $query);

    if ($result) {
        // Refresh halaman daftar-produk tanpa pindah page
        echo "<script>
            alert('Produk berhasil dihapus.');
            window.location.href = 'tabel-barang.php';
        </script>";
        exit();
    } else {
        echo "Gagal menghapus produk: " . mysqli_error($link);
    }
} else {
    echo "ID produk tidak ditemukan.";
}
?>