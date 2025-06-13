<?php
include 'lat_conn.php'; // file koneksi ke database

// Ambil data produk berdasarkan ID
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = mysqli_query($link, "SELECT * FROM produk WHERE id=$id");
    $produk = mysqli_fetch_assoc($query);
    if (!$produk) {
        echo "Produk tidak ditemukan!";
        exit;
    }
} else {
    echo "ID produk tidak ditemukan!";
    exit;
}

// Proses update data
if (isset($_POST['submit'])) {
    $nama = mysqli_real_escape_string($link, $_POST['nama']);
    $harga = floatval($_POST['harga_normal']);

    $update = mysqli_query($link, "UPDATE produk SET nama='$nama', harga_normal='$harga' WHERE id=$id");
    if ($update) {
        echo "<script>alert('Produk berhasil diupdate!');window.location='tabel-barang.php';</script>";
    } else {
        echo "Gagal mengupdate produk!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fc;
            margin: 0;
            padding: 0;
        }
        .container {
            background: #fff;
            max-width: 400px;
            margin: 50px auto;
            padding: 32px 24px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        h2 {
            text-align: center;
            color: #4e73df;
            margin-bottom: 24px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            color: #333;
            font-weight: 500;
        }
        input[type="text"], input[type="number"], textarea {
            width: 100%;
            padding: 8px 10px;
            margin-bottom: 16px;
            border: 1px solid #d1d3e2;
            border-radius: 4px;
            font-size: 15px;
            background: #f8f9fc;
            transition: border-color 0.2s;
        }
        input[type="text"]:focus, input[type="number"]:focus, textarea:focus {
            border-color: #4e73df;
            outline: none;
        }
        textarea {
            min-height: 80px;
            resize: vertical;
        }
        button[type="submit"] {
            width: 100%;
            background: #4e73df;
            color: #fff;
            border: none;
            padding: 10px 0;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }
        button[type="submit"]:hover {
            background: #2e59d9;
        }
        /* Tambahan style */
        .container {
            box-shadow: 0 4px 24px rgba(78,115,223,0.10);
            border: 1px solid #e3e6f0;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        input[type="text"], input[type="number"], textarea {
            box-sizing: border-box;
        }
        input[type="text"]:disabled, input[type="number"]:disabled, textarea:disabled {
            background: #e9ecef;
            color: #6c757d;
        }
        @media (max-width: 500px) {
            .container {
                max-width: 95%;
                padding: 16px 8px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Produk</h2>
        <form method="post">
            <label>Nama Produk:</label>
            <input type="text" name="nama" value="<?php echo htmlspecialchars($produk['nama']); ?>" required>
            <label>Harga:</label>
            <input type="number" name="harga" value="<?php echo htmlspecialchars($produk['harga_normal']); ?>" required>
            <button type="submit" name="submit">Update</button>
        </form>
    </div>
</body>
</html>