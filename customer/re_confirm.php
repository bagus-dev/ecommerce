<?php
	session_start();

	if(!isset($_SESSION["customer_email"])){
		echo "<script>window.open('../checkout.php','_self')</script>";
	}
	else{

	include("includes/db.php");
	include("functions/functions.php");

		if(isset($_GET["payment_id"])){
			$payment_id = $_GET["payment_id"];
		}
		else if(isset($_GET["update_id"])){
			$payment_id = $_GET["update_id"];
		}
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
						<li class = "active"><a href = "my_account.php"> Akun Saya </a></li>
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
					<form method = "get" action = "results.php" class = "navbar-form"><!-- navbar form Begin -->
						<div class = "input-group"><!-- input-group Begin -->
							<input type = "text" class = "form-control" placeholder = "Search" name = "user_query" required>
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
					<li> My Account </li>
				</ul><!-- breadcrumb Finish -->
			</div><!-- col-md-12 Finish -->
			<div class = "col-md-3"><!-- col-md-3 Begin -->
				<?php
					include("includes/sidebar.php");
				?>
			</div><!-- col-md-3 Finish -->
			<div class = "col-md-9"><!-- col-md-9 Begin -->
				<div class = "box"><!-- box Begin -->
					<h1 align = "center"> Mohon konfirmasi ulang pembayaran anda </h1>
					<form action = "confirm.php?update_id=<?php echo $order_id; ?>" method = "post" enctype = "multipart/form-data"><!-- form Begin -->
						<div class = "form-group"><!-- form-group Begin -->
							<label> No Faktur: </label>
							<input type = "text" minlength = "5" class = "form-control" name = "invoice_no" required>
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label> Jumlah Terkirim: </label>
							<div class = "input-group"><!-- input-group Begin -->
								<div class = "input-group-prepend">
									<span class = "input-group-text"> Rp. </span>
								</div>
								<input type = "text" minlength = "5" class = "form-control" name = "amount_sent" required>
								<div class = "input-group-append">
									<span class = "input-group-text"> ,00 </span>
								</div>
							</div><!-- input-group Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label> Pilih Mode Pembayaran: </label>
							<select name = "payment_mode" class = "form-control"><!-- form-control Begin -->
								<option> Back Code </option>
								<option> Paypal </option>
								<option> Payoneer </option>
								<option> Western Union </option>
							</select><!-- form-control Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label> Transaksi / Referensi ID: </label>
							<input type = "text" class = "form-control" name = "ref_no" required>
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label> Paypal / Payoneer / Western Union: </label>
							<input type = "text" class = "form-control" name = "code" required>
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label> Tanggal Pembayaran: </label>
							<input type = "date" class = "form-control" name = "date" required>
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label> Unggah Bukti Pembayaran: </label>
							<input type = "file" class = "form-control form-height-custom" name = "c_payment" accept = "image/*" required>
						</div><!-- form-group Finish -->
						<div class = "text-center"><!-- text-center Begin -->
							<button class = "btn btn-primary btn-lg" name = "re_confirm_payment"><!-- btn btn-primary btn-lg Begin -->
								<i class = "fa fa-user-md"></i> Konfirmasi Pembayaran
							</button><!-- btn btn-primary btn-lg Finish -->
						</div><!-- text-center Finish -->
					</form><!-- form Finish -->
					<?php
						if(isset($_POST["re_confirm_payment"])){
							$pesan_error = "";
                            $update_id = $payment_id;
                            $no_valid = "Tidak Valid";
							$invoice_no = htmlentities(strip_tags(trim($_POST["invoice_no"])));
							$invoice_no = mysqli_real_escape_string($con,$invoice_no);
							$invoice_query = "SELECT invoice_no FROM payments WHERE payment_id = '$payment_id'";
							$invoice_result = mysqli_query($con,$invoice_query);
							$invoice_db = mysqli_fetch_assoc($invoice_result);
							if($invoice_no !== $invoice_db["invoice_no"]){
								$pesan_error .= "No Faktur tidak cocok";
								echo "<script>alert('$pesan_error')</script>";
								exit();
							}
							$amount = htmlentities(strip_tags(trim($_POST["amount_sent"])));
							$amount = mysqli_real_escape_string($con,$amount);
							$amount_query = "SELECT amount FROM payments WHERE payment_id = '$payment_id'";
							$amount_result = mysqli_query($con,$amount_query);
							$amount_db = mysqli_fetch_assoc($amount_result);
							if($amount !== $amount_db["due_amount"]){
								$pesan_error .= "Jumlah Terkirim tidak sesuai jumlah";
								echo "<script>alert('$pesan_error')</script>";
								exit();
							}
							if(!is_numeric($amount)){
								$pesan_error .= "Jumlah Terkirim tidak sesuai format.";
								echo "<script>alert('$pesan_error')</script>";
								exit();
							}
							$payment_mode = htmlentities(strip_tags(trim($_POST["payment_mode"])));
							$ref_no = htmlentities(strip_tags(trim($_POST["ref_no"])));
							$code = htmlentities(strip_tags(trim($_POST["code"])));
							$payment_date = htmlentities(strip_tags(trim($_POST["date"])));
							$complete = "Complete";

							if($pesan_error == ""){
								$c_payment = $_FILES["c_payment"]["name"];
								$c_payment_tmp = $_FILES["c_payment"]["tmp_name"];
								$c_payment_new = date('dmYHis').$c_payment;
								$path = "C:/xampp/htdocs/ecommerce/customer/payment_images/".$c_payment_new;

								$invoice_no = mysqli_real_escape_string($con,$invoice_no);
								$amount = mysqli_real_escape_string($con,$amount);
								$ref_no = mysqli_real_escape_string($con,$ref_no);
								$code = mysqli_real_escape_string($con,$code);
								move_uploaded_file($c_payment_tmp,$path);

								$update_payment = "UPDATE payments SET invoice_no = '$invoice_no',amount = '$amount',payment_mode = '$payment_mode',ref_no = '$ref_no',code = '$code',payment_date = '$payment_date',payment_image = '$c_payment_new',payment_status = '$complete' WHERE payment_id = '$payment_id'";
								$run_payment = mysqli_query($con,$update_payment);

								$update_customer_order = "UPDATE customer_orders SET order_status = '$complete' WHERE invoice_no = '$invoice_no' AND due_amount = '$amount' AND order_status = '$no_valid'";
								$run_customer_order = mysqli_query($con,$update_customer_order);

								$update_pending_order = "UPDATE pending_orders SET order_status = '$complete' WHERE invoice_no = '$invoice_no' AND order_status = '$no_valid'";
								$run_pending_order = mysqli_query($con,$update_pending_order);

								if($run_pending_order){
									echo "<script>alert('Terimakasih sudah membeli, pesanan anda akan selesai dalam 24 jam waktu kerja.')</script>";
									echo "<script>window.open('my_account.php?my_orders','_self')</script>";
								}
							}
						}
					?>
				</div><!-- box Finish -->
			</div><!-- col-md-9 Finish -->
		</div><!-- container Finish -->
	</div><!-- content Finish -->
	<?php
		include("includes/footer.php");
	?>
	<script src = "js/jquery-3.3.1.js"></script>
	<script src = "js/popper.js"></script>
	<script src = "js/bootstrap.js"></script>
</body>
</html>
<?php } ?>