<h1 align = "center"> Ubah Kata Sandi </h1>
<form action = "" method = "post"><!-- form Begin -->
	<div class = "form-group"><!-- form-group Begin -->
		<label> Kata Sandi Lama Anda: </label>
		<input type = "password" minlength = "5" name = "old_pass" class = "form-control" required>
	</div><!-- form-group Finish -->
	<div class = "form-group"><!-- form-group Begin -->
		<label> Kata Sandi Baru Anda: </label>
		<input type = "password" minlength = "5" name = "new_pass" class = "form-control" required>
	</div><!-- form-group Finish -->
	<div class = "form-group"><!-- form-group Begin -->
		<label> Ulangi Kata Sandi Baru Anda: </label>
		<input type = "password" minlength = "5" name = "new_pass_again" class = "form-control" required>
	</div><!-- form-group Finish -->
	<div class = "text-center"><!-- text-center Begin -->
		<button type = "submit" name = "submit" class = "btn btn-primary"><!-- btn btn-primary Begin -->
			<i class = "fa fa-user-md"></i> Perbarui Sekarang
		</button><!-- btn btn-primary Finish -->
	</div><!-- text-center Finish -->
</form><!-- form Finish -->
<?php
	if(isset($_POST["submit"])){
		$c_email = $_SESSION["customer_email"];
		$c_old_pass = htmlentities(strip_tags(trim($_POST["old_pass"])));
		$c_new_pass = htmlentities(strip_tags(trim($_POST["new_pass"])));
		$c_new_pass_again = htmlentities(strip_tags(trim($_POST["new_pass_again"])));
		$c_old_pass = mysqli_real_escape_string($con,$c_old_pass);
		$sha1_old = sha1($c_old_pass);
		$sel_c_old_pass = "SELECT * FROM customers WHERE customer_pass = '$sha1_old'";
		$run_c_old_pass = mysqli_query($con,$sel_c_old_pass);
		$check_c_old_pass = mysqli_fetch_array($run_c_old_pass);
		$c_new_pass = mysqli_real_escape_string($con,$c_new_pass);
		$c_new_pass_again = mysqli_real_escape_string($con,$c_new_pass_again);
		$sha1_new = sha1($c_new_pass);
		$sha1_again = sha1($c_new_pass_again);

		if($check_c_old_pass == 0){
			echo "<script>alert('Maaf, kata sandi anda saat ini tidak valid. Mohon coba lagi')</script>";
			echo "<script>window.open('my_account.php?change_pass','_self')</script>";
		}
		elseif($sha1_new !== $sha1_again){
			echo "<script>alert('Maaf, kata sandi baru anda tidak cocok')</script>";
			echo "<script>window.open('my_account.php?change_pass','_self')</script>";
		}
		else{
			$update_c_pass = "UPDATE customers SET customer_pass = '$sha1_new' WHERE customer_email = '$c_email'";
			$run_c_pass = mysqli_query($con,$update_c_pass);

			if($run_c_pass){
				echo "<script>alert('Kata Sandi anda telah di perbarui. Silakan Masuk Akun kembali.')</script>";
				echo "<script>window.open('logout.php','_self')</script>";
			}
		}
	}
?>