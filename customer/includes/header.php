<?php
	session_start();
	include("includes/db.php");
	include("functions/functions.php");
?>
<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<meta name = "viewport" content = "width=device-width, initial-scale=1">
	<title> E-Commerce Store </title>
	<link rel = "stylesheet" href = "styles/bootstrap-337.min.css">
	<link rel = "stylesheet" href = "font-awesome/css/font-awesome.min.css">
	<link rel = "stylesheet" href = "styles/style.css">
</head>
<body>
	<div id = "top"><!-- Top Begin -->
		<div class = "container"><!-- Container Begin -->
			<div class = "col-md-7 offer"><!-- col-md-7 offer begin -->
				<a href = "#" class = "btn btn-success btn-sm">
					<?php
						if(!isset($_SESSION["customer_email"])){
							echo "Selamat Datang: Pengunjung";
						}
						else{
							echo "Selamat Datang: ".$_SESSION["customer_email"] . "";
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
						}
					}
				?>
				<a href = "checkout.php"><?php echo $count; ?> Barang di Troli anda | Total Harga: <?php
					if($total < 1000000 AND $total >= 500000){
						$total1 = substr($total,0,3);
						$total2 = substr($total,-3);
						echo "Rp.".$total1.".".$total2;
					}
					else if($total >= 1000000 AND $total < 10000000){
						$total1 = substr($total,0,1);
						$total2 = substr($total,1,3);
						$total3 = substr($total,-3);
						echo "Rp.".$total1.".".$total2.".".$total3;
					}
					else if($total >= 10000000){
						$total1 = substr($total,0,2);
						$total2 = substr($total,2,3);
						$total3 = substr($total,-3);
						echo "Rp.".$total1.".".$total2.".".$total3.",00";
					}
					else{
						echo "Rp.".$total;
					}
				?></a>
			</div><!-- col-md-7 offer finish -->
			<div class = "col-md-5"><!-- col-md-5 begin -->
				<ul class = "menu"><!-- menu begin -->
					<li><a href = "../customer_register.php"> Buat Akun </a></li>
					<li><a href = "my_account.php?my_orders"> Akun Saya </a></li>
					<li><a href = "../cart.php"> Troli Belanja </a></li>
					<li>
						<?php
							if(!isset($_SESSION["customer_email"])){
								echo "<a href = '../checkout.php'> Masuk </a>";
							}
							else{
								echo "<a href = 'logout.php'> Keluar </a>";
							}
						?>
					</li>
				</ul><!-- menu finish -->
			</div><!-- col-md-5 finish -->
		</div><!-- Container Finish -->
	</div><!-- Top Finish -->
	<div id = "navbar" class = "navbar navbar-default"><!-- navbar navbar-default Begin -->
		<div class = "container"><!-- container Begin -->
			<div class = "navbar-header"><!-- navbar header Begin -->
				<a href = "../index.php" class = "navbar-brand home"><!-- navbar-brand home Begin -->
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
						<li><a href = "../index.php"> Beranda </a></li>
						<li><a href = "../shop.php"> Berbelanja </a></li>
						<li class = "active"><a href = "my_account.php?my_orders"> Akun Saya </a></li>
						<li><a href = "../cart.php"> Troli Belanja </a></li>
						<li><a href = "../contact.php"> Hubungi Kami </a></li>
					</ul><!-- nav navbar-nav left Finish -->
				</div><!-- padding-nav Finish -->
				<a href = "../cart.php" class = "btn navbar-btn btn-primary right"><!-- btn navbar-btn btn-primary Begin -->
					<i class = "fa fa-shopping-cart"></i>
					<span><?php echo $count; ?> Barang Di Troli Anda </span>
				</a><!-- btn navbar-btn btn-primary Finish -->
				<div class = "navbar-collapse collapse right"><!-- navbar-collapse collapse right Begin -->
					<button class = "btn btn-primary navbar-btn" type = "button" data-toggle = "collapse" data-target = "#search"><!-- btn btn-primary navbar-btn Begin -->
						<span class = "sr-only"> Toggle Search </span>
						<i class = "fa fa-search"></i>
					</button><!-- btn btn-primary navbar-btn Finish -->
				</div><!-- navbar-collapse collapse right Finish -->
				<div class = "collapse clearfix" id = "search"><!-- collapse-clearfix Begin -->
					<form method = "get" action = "../shop.php" class = "navbar-form"><!-- navbar form Begin -->
						<div class = "input-group"><!-- input-group Begin -->
							<input type = "text" class = "form-control" placeholder = "Cari nama Produk / Kata Kunci" name = "user_query" required>
							<span class = "input-group-btn"><!-- input-group-btn Begin -->
							<button type = "submit" name = "search" value = "Search " class = "btn btn-primary"><!-- btn btn-primary Begin -->
								<i class = "fa fa-search"></i>
							</button><!-- btn btn-primary Finish -->
							</span><!-- input-group-btn Finish -->
						</div><!-- input-group Finish -->
					</form><!-- navbar form Finish -->
				</div><!-- collapse-clearfix Finish -->
			</div><!-- navbar-collapse collapse Finish -->
		</div><!-- container Finish -->
	</div><!-- navbar navbar-default Finish -->