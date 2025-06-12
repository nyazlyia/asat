<?php
include 'lat_conn.php';

$query = "SELECT * FROM produk";
$result = mysqli_query($link, $query);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Daftar Produk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Daftar Produk</h2>
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Foto</th>
                <th>Harga Normal</th>
                <th>Harga Diskon</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): 
                $no = 1;
                while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td>
                        <?php if ($row['foto']): ?>
                            <img src="assets/images/produk/<?= htmlspecialchars($row['foto']) ?>" width="80">
                        <?php else: ?>
                            Tidak ada
                        <?php endif; ?>
                    </td>
                    <td>Rp <?= number_format($row['harga-normal'], 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($row['harga-diskon'], 0, ',', '.') ?></td>
                </tr>
            <?php endwhile; else: ?>
                <tr>
                    <td colspan="5" class="text-center">Tidak ada produk</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
