<?php
	session_start();
	include("includes/db.php");
	include("functions/functions.php");
	
	if(isset($_GET["pro_id"])){
		$product_id = $_GET["pro_id"];
		$get_product = "SELECT * FROM products WHERE product_id = '$product_id'";
		$run_product = mysqli_query($con,$get_product);
		$row_product = mysqli_fetch_array($run_product);
		
		$p_cat_id = $row_product["p_cat_id"];
		$cat_id = $row_product["cat_id"];
		$pro_title = $row_product["product_title"];
		$pro_price = $row_product["product_price"];
		$pro_desc = $row_product["product_desc"];
		$pro_img1 = $row_product["product_img1"];
		$pro_img2 = $row_product["product_img2"];
		$pro_img3 = $row_product["product_img3"];
		
		$get_p_cat = "SELECT * FROM product_categories WHERE p_cat_id = '$p_cat_id'";
		$run_p_cat = mysqli_query($con,$get_p_cat);
		$row_p_cat = mysqli_fetch_array($run_p_cat);
		
		$p_cat_title = $row_p_cat["p_cat_title"];

		$get_cat = "SELECT * FROM categories WHERE cat_id = '$cat_id'";
		$run_cat = mysqli_query($con,$get_cat);
		$row_cat = mysqli_fetch_array($run_cat);

		$cat_title = $row_cat["cat_title"];
	}
	$hasil = 0;
?>
<!DOCTYPE html>
<html lang = "id">
<head>
	<meta charset = "UTF-8">
	<meta name = "viewport" content = "width=device-width, initial-scale=1">
	<title> E-Commerce Store </title>
	<link rel = "stylesheet" href = "styles/bootstrap-337.min.css">
	<link rel = "stylesheet" href = "font-awesome/css/font-awesome.min.css">
	<link rel = "stylesheet" href = "styles/style.css">
	<link rel = "icon" type = "image/png" href = "images/ecom-store-logo.png">
</head>
<body>
	<div id = "top"><!-- Top Begin -->
		<div class = "container"><!-- Container Begin -->
			<div class = "col-md-7 offer"><!-- col-md-6 offer begin -->
				<a href = "#" class = "btn btn-success btn-sm">
					<?php
						if(!isset($_SESSION["customer_email"])){
							echo "Selamat Datang: Pengunjung";
						}
						else{
							$query_name = "SELECT customer_name FROM customers WHERE customer_email = '$_SESSION[customer_email]'";
							$result_name = mysqli_query($con,$query_name);
							$nama = mysqli_fetch_array($result_name);
							echo "Selamat Datang: ".$nama["customer_name"]. "";
						}
					?>
				</a>
				<?php
					$ip_add = getRealIpUser();
					$select_cart = "SELECT * FROM cart where ip_add = '$ip_add'";
					$run_cart = mysqli_query($con,$select_cart);
					$count = mysqli_num_rows($run_cart);
					
					$total = 0;
					while($row_cart = mysqli_fetch_array($run_cart)){
						$pro_id = $row_cart["p_id"];
						$pro_qty = $row_cart["qty"];
						$get_products = "SELECT * FROM products WHERE product_id = '$pro_id'";
						$run_products = mysqli_query($con,$get_products);
						
						while($row_products = mysqli_fetch_array($run_products)){
							$only_price = $row_products["product_price"];
							$sub_total = $row_products["product_price"] * $pro_qty;
							
							$total += $sub_total;
							if($total > 0){
								$hasil = $total + 7000;
							}
						}
					}
				?>
				<a href = "cart.php"><?php echo $count; ?> Barang di Troli anda | Total Harga: <?php
					if($hasil < 1000000 AND $hasil >= 500000){
						$hasil1 = substr($hasil,0,3);
						$hasil2 = substr($hasil,-3);
						echo "Rp.".$hasil1.".".$hasil2;
					}
					else if($hasil >= 1000000 AND $hasil < 10000000){
						$hasil1 = substr($hasil,0,1);
						$hasil2 = substr($hasil,1,3);
						$hasil3 = substr($hasil,-3);
						echo "Rp.".$hasil1.".".$hasil2.".".$hasil3;
					}
					else if($hasil >= 10000000){
						$hasil1 = substr($hasil,0,2);
						$hasil2 = substr($hasil,2,3);
						$hasil3 = substr($hasil,-3);
						echo "Rp.".$hasil1.".".$hasil2.".".$hasil3;
					}
					else{
						echo "Rp.".$hasil;
					}
					?></a>
			</div><!-- col-md-6 offer finish -->
			<div class = "col-md-5"><!-- col-md-6 begin -->
				<ul class = "menu"><!-- menu begin -->
					<li><a href = "customer_register.php"> Buat Akun </a></li>
					<li><a href = "customer/my_account.php?my_orders"> Akun Saya </a></li>
					<li><a href = "cart.php"> Troli Belanja </a></li>
					<li>
						<?php
							if(!isset($_SESSION["customer_email"])){
								echo "<a href = 'checkout.php'><i class='fa fa-sign-in'></i> Masuk </a>";
							}
							else{
								echo "<a href = 'logout.php'><i class='fa fa-sign-out'></i> Keluar </a>";
							}
						?>
					</li>
				</ul><!-- menu finish -->
			</div><!-- col-md-6 finish -->
		</div><!-- Container Finish -->
	</div><!-- Top Finish -->
	<div id = "navbar" class = "navbar navbar-default"><!-- navbar navbar-default Begin -->
		<div class = "container"><!-- container Begin -->
			<div class = "navbar-header"><!-- navbar header Begin -->
				<a href = "index.php" class = "navbar-brand home"><!-- navbar-brand home Begin -->
					<img src = "images/ecom-store-logo.png" alt = "E-Commerce Store Logo" class = "hidden-xs">
					<img src = "images/ecom-store-logo-mobile.png" alt = "E-Commerce Store Logo Mobile" class = "visible-xs">
				</a><!-- navbar-brand home Finish -->
				<button class = "navbar-toggle" data-toggle = "collapse" data-target = "#navigation">
					<span class = "sr-only"> Toggle Navigation </span>
					<i class = "fa fa-align-justify"></i>
				</button>
				<button class = "navbar-toggle" data-toggle = "collapse" data-target = "#search">
					<span class = "sr-only"> Toggle Search </span>
					<i class = "fa fa-search"></i>
				</button>
			</div><!-- navbar header Finish -->
			<div class = "navbar-collapse collapse" id = "navigation"><!-- navbar-collapse collapse Begin -->
				<div class = "padding-nav"><!-- padding-nav Begin -->
					<ul class = "nav navbar-nav left"><!-- nav navbar-nav left Begin -->
						<li class = "<?php if($active=='Home') echo'active'; ?>"><a href = "index.php"> Beranda </a></li>
						<li class = "<?php if($active=='Shop') echo'active'; ?>"><a href = "shop.php"> Berbelanja </a></li>
						<li class = "<?php if($active=='Account') echo'active'; ?>">
							<?php
								if(!isset($_SESSION["customer_email"])){
									echo "<a href = 'checkout.php'> Akun Saya </a>";
								}
								else{
									echo "<a href = 'customer/my_account.php?my_orders'> Akun Saya </a>";
								}
							?>
						</li>
						<li class = "<?php if($active=='Cart') echo'active'; ?>"><a href = "cart.php"> Troli Belanja </a></li>
						<li class = "<?php if($active=='Contact') echo'active'; ?>"><a href = "contact.php"> Hubungi Kami </a></li>
					</ul><!-- nav navbar-nav left Finish -->
				</div><!-- padding-nav Finish -->
				<a href = "cart.php" class = "btn navbar-btn btn-primary right"><!-- btn navbar-btn btn-primary Begin -->
					<i class = "fa fa-shopping-cart"></i>
					<span><?php echo $count; ?> Barang di Troli anda </span>
				</a><!-- btn navbar-btn btn-primary Finish -->
				<div class = "navbar-collapse collapse right"><!-- navbar-collapse collapse right Begin -->
					<button class = "btn btn-primary navbar-btn" type = "button" data-toggle = "collapse" data-target = "#search"><!-- btn btn-primary navbar-btn Begin -->
						<span class = "sr-only"> Toggle Search </span>
						<i class = "fa fa-search"></i>
					</button><!-- btn btn-primary navbar-btn Finish -->
				</div><!-- navbar-collapse collapse right Finish -->
				<div class = "collapse clearfix" id = "search"><!-- collapse clearfix Begin -->
					<form method = "get" action = "shop.php" class = "navbar-form"><!-- navbar form Begin -->
						<div class = "input-group"><!-- input-group Begin -->
							<input type = "search" size = "25" class = "form-control" placeholder = "Cari nama Produk / Kata Kunci" name = "user_query" required>
							<span class = "input-group-btn"><!-- input-group-btn Begin -->
							<button type = "submit" name = "search" value = "Search" class = "btn btn-primary"><!-- btn btn-primary Begin -->
								<i class = "fa fa-search"></i>
							</button><!-- btn btn-primary Finish -->
							</span><!-- input-group-btn Finish -->
						</div><!-- input-group Finish -->
					</form><!-- navbar form Finish -->
				</div><!-- collapse clearfix Finish -->
			</div><!-- navbar-collapse collapse Finish -->
		</div><!-- container Finish -->
	</div><!-- navbar navbar-default Finish -->