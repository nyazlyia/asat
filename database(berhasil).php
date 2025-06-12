<?php
include "lat_conn.php";
$query_produk = "SELECT nama FROM produk";
$result_produk = mysqli_query($link, $query_produk);

while ($row_produk = mysqli_fetch_array($result_produk)) {
    $nama = urlencode($row_produk['nama']);
    echo "<li><a href='shop-single.php?nama=$nama'>" . htmlspecialchars($row_produk['nama']) . "</a></li>";
}
mysqli_close($link);
?>
