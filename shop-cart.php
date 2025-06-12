<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login-form.php");
    exit;
}

include 'lat_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
	if (!isset($_SESSION['user_id'])) {
		return;
	}

	$id_user       = $_SESSION['user_id'];
	$id_produk     = mysqli_real_escape_string($link, $_POST['id_produk']);
	$harga_normal  = mysqli_real_escape_string($link, $_POST['harga_normal']);
	$harga_diskon  = mysqli_real_escape_string($link, $_POST['harga_diskon']);
	$jumlah        = mysqli_real_escape_string($link, $_POST['jumlah']);

	$sql = "INSERT INTO keranjang (id_produk, id_user, `harga-normal`, `harga-diskon`, jumlah)
			VALUES ('$id_produk', '$id_user', '$harga_normal', '$harga_diskon', '$jumlah')";

	mysqli_query($link, $sql);
}
?>


<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->
	<head>
		<meta charset="utf-8" />
		<title>Smarty - Multipurpose + Admin</title>
		<meta name="keywords" content="HTML5,CSS3,Template" />
		<meta name="description" content="" />
		<meta name="Author" content="Dorin Grigoras [www.stepofweb.com]" />

		<!-- mobile settings -->
		<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

		<!-- WEB FONTS : use %7C instead of | (pipe) -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700" rel="stylesheet" type="text/css" />

		<!-- CORE CSS -->
		<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		
		<!-- THEME CSS -->
		<link href="assets/css/essentials.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/layout.css" rel="stylesheet" type="text/css" />

		<!-- PAGE LEVEL SCRIPTS -->
		<link href="assets/css/header-1.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/layout-shop.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/color_scheme/green.css" rel="stylesheet" type="text/css" id="color_scheme" />
	</head>

	<!--
		AVAILABLE BODY CLASSES:
		
		smoothscroll 			= create a browser smooth scroll
		enable-animation		= enable WOW animations

		bg-grey					= grey background
		grain-grey				= grey grain background
		grain-blue				= blue grain background
		grain-green				= green grain background
		grain-blue				= blue grain background
		grain-orange			= orange grain background
		grain-yellow			= yellow grain background
		
		boxed 					= boxed layout
		pattern1 ... patern11	= pattern background
		menu-vertical-hide		= hidden, open on click
		
		BACKGROUND IMAGE [together with .boxed class]
		data-background="assets/images/boxed_background/1.jpg"
	-->
	<body class="smoothscroll enable-animation">

		<!-- Top Bar -->
			<?php
			$pink_color = '#F7CFD8';

			$scss_file = __DIR__ . '/assets/css/_variables.scss';
			if (file_exists($scss_file)) {
				$content = file_get_contents($scss_file);
				if (preg_match('/\$pink\s*:\s*(#[0-9a-fA-F]{3,6});/', $content, $matches)) {
					$pink_color = $matches[1];
				}
			}
			?>
			<div id="topBar" style="background-color: <?php echo $pink_color; ?>;">
				<div class="container">

					<ul class="top-links list-inline pull-right">
						<?php
						if (isset($_SESSION['name'])) {
							echo '<li class="text-welcome hidden-xs">Selamat Datang di Si Imut Merajut, ' . htmlspecialchars($_SESSION['name']) . '</li>';
						} else {
							echo '<li class="text-welcome hidden-xs">Selamat Datang di Si Imut Merajut, Guest</li>';
						}
						?>
						<li>
							<a class="dropdown-toggle no-text-underline" data-toggle="dropdown" href="#"><i class="fa fa-user hidden-xs"></i> MY ACCOUNT</a>
							<ul class="dropdown-menu pull-right">
								<li><a tabindex="-1" href="#"><i class="fa fa-history"></i> ORDER HISTORY</a></li>
								<li class="divider"></li>
								<li><a tabindex="-1" href="#"><i class="fa fa-bookmark"></i> MY WISHLIST</a></li>
								<li><a tabindex="-1" href="#"><i class="fa fa-edit"></i> MY REVIEWS</a></li>
								<li><a tabindex="-1" href="#"><i class="fa fa-cog"></i> MY SETTINGS</a></li>
								<li class="divider"></li>
								<?php if (isset($_SESSION['name'])): ?>
									<li>
										<a tabindex="-1" href="logout.php"><i class="glyphicon glyphicon-off"></i> LOGOUT</a>
									</li>
								<?php endif; ?>
							</ul>
						</li>
						<li class="hidden-xs"><a href="login-form.php">LOGIN</a></li>
						<li class="hidden-xs"><a href="sign-form.php">REGISTER</a></li>
					</ul>

				</div>
			</div>
			<!-- /Top Bar -->

			<div id="header" class="sticky clearfix">

				<!-- SEARCH HEADER -->
				<?php
				$search_results = [];
				$search_query = '';
				if (isset($_GET['search']) && trim($_GET['search']) !== '') {
					include "lat_conn.php";
					$search_query = trim($_GET['search']);
					$keyword = mysqli_real_escape_string($link, $search_query);
					$query = "SELECT * FROM produk WHERE nama LIKE '%$keyword%'";
					$result = mysqli_query($link, $query);
					while ($row = mysqli_fetch_assoc($result)) {
						$search_results[] = $row;
					}
				}
				?>
				<div class="search-box over-header" style="position:relative;">
					<a id="closeSearch" href="#" class="glyphicon glyphicon-remove"></a>
					<form action="" method="get" autocomplete="off">
						<input 
							type="text" 
							name="search" 
							class="form-control" 
							placeholder="SEARCH" 
							value="<?php echo htmlspecialchars($search_query); ?>" 
						/>
					</form>
					<?php if ($search_query !== ''): ?>
						<div class="search-result-box" style="
							background: #fff; 
							padding: 10px; 
							border-radius: 5px; 
							margin-top:30px; 
							position:absolute; 
							width:100%; 
							z-index:1000; 
							box-shadow:0 2px 8px rgba(0,0,0,0.1);
						">
							<?php if (count($search_results) > 0): ?>
								<ul style="list-style:none; padding-left:0; margin:0;">
									<?php foreach ($search_results as $item): ?>
										<li style="padding:6px 0; border-bottom:1px solid #eee;">
											<a 
												href="shop-single.php?id=<?php echo $item['id']; ?>" 
												style="color:#333; text-decoration:none;"
											>
												<?php echo htmlspecialchars($item['nama']); ?>
											</a>
										</li>
									<?php endforeach; ?>
								</ul>
							<?php else: ?>
								<div>Tidak ada produk ditemukan.</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
				<!-- /SEARCH HEADER -->


				<!-- TOP NAV -->
				<header id="topNav">
					<div class="container">

						<!-- Mobile Menu Button -->
						<button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
							<i class="fa fa-bars"></i>
						</button>

						<!-- BUTTONS -->
						<ul class="pull-right nav nav-pills nav-second-main">

							<!-- SEARCH -->
							<li class="search">
								<a href="javascript:;">
									<i class="fa fa-search"></i>
								</a>
							</li>
							<!-- /SEARCH -->


							<!-- QUICK SHOP CART -->
							<li class="quick-cart">
								<form action="shop-cart.php" method="get" style="display:inline;">
									<button type="submit" style="background:none;border:none;padding:0;cursor:pointer;">
										<?php
										$cart_count = 0;
										if (isset($_SESSION['user_id'])) {
											include 'lat_conn.php';
											$id_user = mysqli_real_escape_string($link, $_SESSION['user_id']);
											$result = mysqli_query($link, "SELECT SUM(jumlah) as total FROM keranjang WHERE id_user='$id_user'");
											if ($row = mysqli_fetch_assoc($result)) {
												$cart_count = (int)$row['total'];
											}
										}
										?>
										<span class="badge badge-aqua btn-xs badge-corner"><?php echo $cart_count; ?></span>
										<i class="fa fa-shopping-cart"></i>
									</button>
								</form>
							</li>
							<!-- /QUICK SHOP CART -->

						</ul>
						<!-- /BUTTONS -->

						<!-- Logo -->
						<a class="logo pull-left" href="index.php">
							<div style="display: flex; align-items: center; height: 100%;">
								<h2 style="margin: 0 auto;">Si Imut Merajut</h2>
							</div>
						</a>

						<!-- 
							Top Nav 
							
							AVAILABLE CLASSES:
							submenu-dark = dark sub menu
						-->
						<div class="navbar-collapse pull-right nav-main-collapse collapse">
							<nav class="nav-main">

								<!--
									NOTE
									
									For a regular link, remove "dropdown" class from LI tag and "dropdown-toggle" class from the href.
									Direct Link Example: 

									<li>
										<a href="#">HOME</a>
									</li>
								-->
								<ul id="topMain" class="nav nav-pills nav-main">
									<li class="dropdown active"><!-- HOME -->
										<a href="index.php">
											HOME
										</a>
									</li>
									<li class="dropdown"><!-- SHOP -->
										<a class="dropdown-toggle" href="#">
											SHOP
										</a>
										<ul class="dropdown-menu pull-right">
<?php include "database(berhasil).php"; ?>
										</ul>
										
									</li>
								</ul>
							</nav>
					</div>
				</header>
				<!-- /Top Nav -->

			</div>


			<!-- 
				PAGE HEADER 
				
				CLASSES:
					.page-header-xs	= 20px margins
					.page-header-md	= 50px margins
					.page-header-lg	= 80px margins
					.page-header-xlg= 130px margins
					.dark			= dark page header

					.shadow-before-1 	= shadow 1 header top
					.shadow-after-1 	= shadow 1 header bottom
					.shadow-before-2 	= shadow 2 header top
					.shadow-after-2 	= shadow 2 header bottom
					.shadow-before-3 	= shadow 3 header top
					.shadow-after-3 	= shadow 3 header bottom
			-->
			<section class="page-header page-header-xs">
				<div class="container">

					<h1>SHOP CART</h1>

					<!-- breadcrumbs -->
					<ol class="breadcrumb">
						<li><a href="#">Home</a></li>
						<li class="active">Shop Cart</li>
					</ol><!-- /breadcrumbs -->

				</div>
			</section>
			<!-- /PAGE HEADER -->




			<!-- CART -->
			 <?php
include 'lat_conn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login-form.php");
    exit;
}

$id_user = mysqli_real_escape_string($link, $_SESSION['user_id']);

if (isset($_GET['remove'])) {
    $id_keranjang = mysqli_real_escape_string($link, $_GET['remove']);
    mysqli_query($link, "DELETE FROM keranjang WHERE id = '$id_keranjang' AND id_user = '$id_user'");
    exit;
}

$query = "
    SELECT 
        keranjang.id AS id_keranjang,
        produk.nama,
        produk.foto,
        produk.`harga-normal`,
        produk.`harga-diskon`,
        keranjang.jumlah
    FROM keranjang
    JOIN produk ON keranjang.id_produk = produk.id
    WHERE keranjang.id_user = '$id_user'
";

$result = mysqli_query($link, $query);
$total_semua = 0;
?>
			<div class="container">
    <h2 class="text-center text-primary">Keranjang Belanja Anda</h2>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered cart-table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Produk</th>
                        <th>Gambar</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)):
                        $harga_diskon = (int)preg_replace('/[^\d]/', '', $row['harga-diskon']);
                        $harga_normal = (int)preg_replace('/[^\d]/', '', $row['harga-normal']);
                        $harga = $harga_diskon > 0 ? $harga_diskon : $harga_normal;
                        $jumlah = (int)$row['jumlah'];
                        $total = $harga * $jumlah;
                        $total_semua += $total;
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><img src="assets/images/produk/<?= htmlspecialchars($row['foto']) ?>" alt="Gambar Produk"></td>
                        <td>Rp<?= number_format($harga, 0, ',', '.') ?></td>
                        <td><?= $jumlah ?></td>
                        <td>Rp<?= number_format($total, 0, ',', '.') ?></td>
                        <td>
                            <a href="shop-cart.php?remove=<?= $row['id_keranjang'] ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Hapus item ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <tr>
                        <td colspan="4" class="text-end fw-bold">Total Belanja:</td>
                        <td colspan="2" class="fw-bold text-success">Rp<?= number_format($total_semua, 0, ',', '.') ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center">
            Keranjang Anda masih kosong.
        </div>
    <?php endif; ?>
</div>
<?php if ($total_semua > 0): ?>
    <form action="shop-checkout-final.php" method="POST" style="text-align: center; margin-top: 30px;">
        <input type="hidden" name="total" value="<?= $total_semua ?>">
        <button type="submit" class="checkout-btn btn btn-success btn-lg">
            <i class="fa fa-check"></i> Checkout Sekarang
        </button>
    </form>
<?php else: ?>
    <div style="text-align: center; margin-top: 20px; color: #a94442; background: #f2dede; padding: 10px; border-radius: 6px;">
        Keranjang kosong. Tidak bisa checkout.
    </div>
<?php endif; ?>



			<!-- /CART -->




			<!-- RECOMMENDED -->
			<section>
				<div class="container">

					<div class="heading-title heading-dotted">
						<h2 class="size-20">RECOMMENDED FOR YOU</h2>
					</div>

					<ul class="shop-item-list row list-inline nomargin">

						<!-- ITEM -->
						<?php
							include 'lat_conn.php';

							$query = "SELECT id, nama, foto, `harga-normal`, `harga-diskon` FROM produk";
							$result = mysqli_query($link, $query);

							while ($row = mysqli_fetch_assoc($result)):
								$id = htmlspecialchars($row['id']);
								$nama = htmlspecialchars($row['nama']);
								$foto = htmlspecialchars($row['foto']);
								$hargaNormal = htmlspecialchars($row['harga-normal']);
								$hargaDiskon = htmlspecialchars($row['harga-diskon']);
							?>
							<li class="col-lg-2 col-sm-4">
								<div class="shop-item">
									<div class="thumbnail noborder nopadding">
										<!-- product image(s) -->
										<a class="shop-item-image" href="shop-single.php?id=<?= $id ?>">
											<?php if (!empty($foto)): ?>
												<img src="assets/images/produk/<?= $foto ?>" alt="<?= $nama ?>">
											<?php else: ?>
												<img class="img-responsive" src="assets/images/produk/noimg.jpg" alt="no image">
											<?php endif; ?>
										</a>
										<!-- /product image(s) -->

										<!-- hover buttons -->
										<div class="shop-option-over">
											<form method="post" style="display: inline;">
										<input type="hidden" name="id_produk" value="<?php echo $row['id']; ?>">
										<input type="hidden" name="harga_normal" value="<?php echo $row['harga-normal']; ?>">
										<input type="hidden" name="harga_diskon" value="<?php echo $row['harga-diskon']; ?>">
										<input type="hidden" name="jumlah" value="1">
										<button type="submit" name="add_to_cart" class="btn btn-default"><i class="fa fa-cart-plus size-18"></i></button>
									</form>
										</div>
										<!-- /hover buttons -->
									</div>

									<div class="shop-item-summary text-center">
										<h2 class="size-14"><?= $nama ?></h2>

										<!-- rating -->
										<div class="shop-item-rating-line">
											<div class="rating rating-4 size-11"></div>
										</div>
										<!-- /rating -->

										<!-- price -->
										<div class="shop-item-price">
											<span class="line-through"><?= $hargaNormal ?></span><br>
											<?= $hargaDiskon ?>
										</div>
										<!-- /price -->
									</div>
								</div>
							</li>
							<?php endwhile; ?>
						<!-- /ITEM -->

					</ul>

				</div>
			</section>
			<!-- /RECOMMENDED -->




			<!-- FOOTER -->
			<footer id="footer">
				<div class="container">

					<div class="row margin-top-60 margin-bottom-40 size-13">

						<!-- col #1 -->
						<div class="col-md-4 col-sm-4">

							<!-- Footer Logo -->
							<h1 style="margin: 0 auto; font-weight: bold">Si Imut Merajut</h1>

							<p>
								E-Commerce yang menyediakan berbagai macam produk kerajinan tangan yang lucu dan unik. Kami berkomitmen untuk memberikan produk berkualitas tinggi dengan harga terjangkau. Temukan koleksi kami dan jadikan hari Anda lebih ceria dengan produk-produk kami!
							</p>

							<h2>(+62) 857-1414-0136</h2>

							<!-- Social Icons -->
							<div class="clearfix">

								<a href="#" class="social-icon social-icon-sm social-icon-border social-facebook pull-left" data-toggle="tooltip" data-placement="top" title="Facebook">
									<i class="icon-instagram"></i>
									<i class="icon-instagram"></i>
								</a>

							</div>
							<!-- /Social Icons -->

						</div>
						<!-- /col #1 -->

					</div>

				</div>

				<div class="copyright">
					<div class="container">
						<ul class="pull-right nomargin list-inline mobile-block">
							<li><a href="#">Terms &amp; Conditions</a></li>
							<li>&bull;</li>
							<li><a href="#">Privacy</a></li>
						</ul>

						&copy; All Rights Reserved, Company LTD
					</div>
				</div>

			</footer>
			<!-- /FOOTER -->

		</div>
		<!-- /wrapper -->


		<!-- SCROLL TO TOP -->
		<a href="#" id="toTop"></a>


		<!-- PRELOADER -->
		<div id="preloader">
			<div class="inner">
				<span class="loader"></span>
			</div>
		</div><!-- /PRELOADER -->


		<!-- JAVASCRIPT FILES -->
		<script type="text/javascript">var plugin_path = 'assets/plugins/';</script>
		<script type="text/javascript" src="assets/plugins/jquery/jquery-2.1.4.min.js"></script>

		<script type="text/javascript" src="assets/js/scripts.js"></script>
		
		<!-- STYLESWITCHER - REMOVE -->
		<script async type="text/javascript" src="assets/plugins/styleswitcher/styleswitcher.js"></script>

		<!-- PAGE LEVEL SCRIPTS -->
		<script type="text/javascript" src="assets/js/view/demo.shop.js"></script>
	</body>
</html>