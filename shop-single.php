<style>
body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: linear-gradient(135deg, #8E7DBE 0%, #F7CFD8 100%);
    margin: 0;
}
.shop-item {
    border-radius: 10px;
    border: 1px solid #ddd;
    background: #fff;
    padding: 8px;
    max-width: 300px;
    width: 100%;
    text-align: center;
}
.shop-item .thumbnail img {
    max-width: 100%;
    border-radius: 8px;
}
.shop-item-summary h2 {
    margin-top: 16px;
    font-size: 1.5rem;
}
.shop-item-price {
    font-size: 1.2rem;
}
.shop-item-price .line-through {
    color: #bbb;
    margin-right: 8px;
    text-decoration: line-through;
}
.shop-item-buttons button {
    width: 100%;
}
h2 a {
    color: #333;
    text-decoration: none;
    align-items: center;
}
button {
    background-color: #8E7DBE;
    color: white;
    border: none;
    padding: 15px;
    border-radius: 5px;
    cursor: pointer;
}
</style>


<?php
include "lat_conn.php";

if (isset($_GET['nama'])) {
    $nama = mysqli_real_escape_string($link, $_GET['nama']);
    $query_id = "SELECT id FROM produk WHERE nama = '$nama' LIMIT 1";
    $result_id = mysqli_query($link, $query_id);
    if ($row_id = mysqli_fetch_assoc($result_id)) {
        $id = intval($row_id['id']);
    } else {
        $id = 2;
    }
} else {
    $id = isset($_GET['id']) ? intval($_GET['id']) : 2;
}

$query = "SELECT * FROM produk WHERE id = $id";
$result = mysqli_query($link, $query);
if ($row = mysqli_fetch_assoc($result)) {
    $image = htmlspecialchars($row['foto']);
    $nama = htmlspecialchars($row['nama']);
    $harga_normal = htmlspecialchars($row['harga-normal']);
    $harga_diskon = htmlspecialchars($row['harga-diskon']);
} else {
    $image = 'noimg.jpg';
    $nama = 'Produk tidak ditemukan';
    $harga_normal = '0.00';
    $harga_diskon = '0.00';
}
?>

<div class="shop-item nomargin">
    <div class="thumbnail">
        <!-- product image(s) -->
        <a class="shop-item-image" href="shop-single.php?id=<?php echo $id; ?>">
            <img src="assets/images/produk/<?php echo $image; ?>" alt="<?php echo $nama; ?>">
        </a>
    </div>
    <div class="shop-item-summary text-center">
        <h2>
            <a href="shop-single.php?id=<?php echo $id; ?>">
                <?php echo $nama; ?>
            </a>
        </h2>
        <!-- rating -->
        <div class="shop-item-rating-line">
            <div class="rating rating-4 size-13"></div>
        </div>
        <!-- /rating -->
        <!-- price -->
        <div class="shop-item-price">
            <span class="line-through"><?php echo $harga_normal; ?></span>
            <h2><?php echo $harga_diskon; ?></h2>
        </div>
        <!-- /price -->
    </div>
    <!-- buttons -->
    <div class="shop-item-buttons text-center">
        <form method="post" action="shop-cart.php" style="display:inline;">
            <input type="hidden" name="product_id" value="<?php echo $id; ?>">
            <input type="hidden" name="product_name" value="<?php echo $nama; ?>">
            <input type="hidden" name="product_price" value="<?php echo $harga_diskon; ?>">
            <button type="submit" class="btn btn-default">
                <i class="fa fa-cart-plus"></i> Tambahkan ke Keranjang
            </button>
        </form>
    </div>
    <!-- /buttons -->
</div>
