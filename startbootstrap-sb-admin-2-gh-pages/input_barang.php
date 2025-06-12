<!DOCTYPE html>
<html>
<head>
    <title>Input Produk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Input Produk Baru</h2>
    <form action="simpan-produk.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Harga Normal (Rp)</label>
            <input type="text" name="harga_normal" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Harga Diskon (Rp)</label>
            <input type="text" name="harga_diskon" class="form-control">
        </div>
        <div class="form-group">
            <label>Upload Foto Produk</label>
            <input type="file" name="foto" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary">Simpan Produk</button>
    </form>
</body>
</html>
