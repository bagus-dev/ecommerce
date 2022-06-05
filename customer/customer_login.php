<div class = "box"><!-- box Begin -->
	<div class = "box-header"><!-- box-header Begin -->
		<center>
			<h1> MASUK AKUN </h1>
		</center>
	</div><!-- box-header Finish -->
	<form action = "checkout.php" method = "post"><!-- form Begin -->
		<div class = "form-group"><!-- form-group Begin -->
			<label> Email </label>
			<input name = "c_email" type = "text" class = "form-control" required>
		</div><!-- form-group Finish -->
		<div class = "form-group"><!-- form-group Begin -->
			<label> Kata Sandi </label>
			<input name = "c_pass" type = "password" class = "form-control" required>
		</div><!-- form-group Finish -->
		<div class = "text-center"><!-- text-center Begin -->
			<button name = "login" value = "Login" class = "btn btn-primary">
				<i class = "fa fa-sign-in"></i> Masuk
			</button>
		</div><!-- text-center Finish -->
	</form><!-- form Finish -->
	<center><!-- center Begin -->
		<a href = "customer_register.php">
			<h3> Belum punya akun..? Daftar disini </h3>
		</a>
	</center><!-- center Finish -->
</div><!-- box Finish -->
<?php
	if(isset($_POST["login"])){
		$customer_email = htmlentities(strip_tags(trim($_POST["c_email"])));
		$customer_pass = htmlentities(strip_tags(trim($_POST["c_pass"])));
		
		$customer_email = mysqli_real_escape_string($con,$customer_email);
		$customer_pass = mysqli_real_escape_string($con,$customer_pass);
		$password_sha1 = sha1($customer_pass);
		$select_customer = "SELECT * FROM customers where customer_email = '$customer_email' AND customer_pass = '$password_sha1'";
		$run_customer = mysqli_query($con,$select_customer);
		
		$get_ip = getRealIpUser();
		$check_customer = mysqli_num_rows($run_customer);
		$select_cart = "SELECT * FROM cart WHERE ip_add = '$get_ip'";
		$run_cart = mysqli_query($con,$select_cart);
		$check_cart = mysqli_num_rows($run_cart);
		
		if($check_customer == 0){
			echo "<script>alert('Email atau Kata Sandi anda salah')</script>";
			exit();
		}
		else{
			$_SESSION["customer_email"] = $customer_email;
			echo "<script>alert('Anda berhasil Masuk')</script>";
			echo "<script>window.open('customer/my_account.php?my_orders','_self')</script>";
		}
	}
?>