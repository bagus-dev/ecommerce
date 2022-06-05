<?php
	session_start();

	if(!isset($_SESSION["customer_email"])){
		echo "<script>window.open('../checkout.php','_self')</script>";
	}
	else{

	include("includes/db.php");
	include("functions/functions.php");
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
	<link rel = "icon" type = "image/png" href = "../images/ecom-store-logo.png">
	<link href = "styles/lightbox.css" rel="stylesheet"/>
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
							$query_name = "SELECT customer_name FROM customers WHERE customer_email = '$_SESSION[customer_email]'";
							$result_name = mysqli_query($con,$query_name);
							$nama = mysqli_fetch_array($result_name);
							echo "Selamat Datang: ".$nama["customer_name"] . "";
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
				<a href = "../checkout.php"><?php echo $count; ?> Barang di Troli anda | Total Harga: <?php
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
			</div><!-- col-md-7 offer finish -->
			<div class = "col-md-5"><!-- col-md-5 begin -->
				<ul class = "menu"><!-- menu begin -->
					<li><a href = "../customer_register.php"> Buat Akun </a></li>
					<li><a href = "my_account.php?my_orders"> Akun Saya </a></li>
					<li><a href = "../cart.php"> Troli Belanja </a></li>
					<li>
						<?php
							if(!isset($_SESSION["customer_email"])){
								echo "<a href = '../checkout.php'><i class='fa fa-sign-in'></i> Masuk </a>";
							}
							else{
								echo "<a href = 'logout.php'><i class='fa fa-sign-out'></i> Keluar </a>";
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
							<input type = "text" size = "25" class = "form-control" placeholder = "Cari nama Produk / Kata Kunci" name = "user_query" required>
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
	<div id = "content"><!-- content Begin -->
		<div class = "container"><!-- container Begin -->
			<div class = "col-md-12"><!-- col-md-12 Begin -->
				<ul class = "breadcrumb"><!-- breadcrumb Begin -->
					<li>
						<a href = "../index.php"> Beranda </a>
					</li>
					<li> Akun Saya </li>
				</ul><!-- breadcrumb Finish -->
			</div><!-- col-md-12 Finish -->
			<div class = "col-md-3"><!-- col-md-3 Begin -->
				<?php
					include("includes/sidebar.php");
				?>
			</div><!-- col-md-3 Finish -->
			<div class = "col-md-9"><!-- col-md-9 Begin -->
				<div class = "box"><!-- box Begin -->
					<?php
						if(isset($_GET["my_orders"])){
							include("my_orders.php");
						}
					?>
					<?php
						if(isset($_GET["change_pass"])){
							include("change_pass.php");
						}
					?>
					<?php
						if(isset($_GET["edit_account"])){
							include("edit_account.php");
						}
					?>
					<?php
						if(isset($_GET["delete_account"])){
							include("delete_account.php");
						}
					?>
				</div><!-- box Finish -->
			</div><!-- col-md-9 Finish -->
		</div><!-- container Finish -->
	</div><!-- content Finish -->
	<?php
		include("includes/footer.php");
	?>
	<script src = "js/jquery-331.min.js"></script>
	<script src = "js/bootstrap-337.min.js"></script>
	<script src="js/lightbox-plus-jquery.min.js"></script>
</body>
</html>
<?php } ?>