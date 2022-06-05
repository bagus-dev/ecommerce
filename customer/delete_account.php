<center><!-- center Begin -->
	<h1> Apakah Anda Benar-benar Ingin Menghapus Akun Anda ? </h1>
	<form action = "" method = "post"><!-- form Begin -->
		<input type = "submit" name = "Yes" value = "Ya, Saya Ingin Menghapusnya" class = "btn btn-danger">
		<input type = "submit" name = "No" value = "Tidak, Saya Tidak Ingin Menghapusnya" class = "btn btn-primary">
	</form><!-- form Finish -->
</center><!-- center Finish -->
<?php
	$c_email = $_SESSION["customer_email"];
	if(isset($_POST["Yes"])){
		$delete_customer = "DELETE FROM customers WHERE customer_email = '$c_email'";
		$run_delete_customer = mysqli_query($con,$delete_customer);
		if($run_delete_customer){
			session_destroy();
			echo "<script>alert('Berhasil menghapus akun anda, menyesal tentang hal ini. Sampai Jumpa.')</script>";
			echo "<script>window.open('../index.php','_self')</script>";
		}
	}
	if(isset($_POST["No"])){
		echo "<script>window.open('my_account.php?my_orders','_self')</script>";
	}
?>