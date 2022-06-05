<?php
	$customer_session = $_SESSION["customer_email"];
	$get_customer = "SELECT * FROM customers WHERE customer_email = '$customer_session'";
	$run_customer = mysqli_query($con,$get_customer);
	$row_customer = mysqli_fetch_array($run_customer);
	$customer_id = $row_customer["customer_id"];
	$customer_name = $row_customer["customer_name"];
	$customer_email = $row_customer["customer_email"];
	$customer_country = $row_customer["customer_country"];
	$customer_city = $row_customer["customer_city"];
	$customer_contact = $row_customer["customer_contact"];
	$customer_address = $row_customer["customer_address"];
	$customer_image = $row_customer["customer_image"];
?>

<h1 align = "center"> Edit Akun Anda </h1>
<form action = "" method = "post" enctype = "multipart/form-data"><!-- form Begin -->
	<div class = "form-group"><!-- form-group Begin -->
		<label> Nama Pelanggan: </label>
		<input type = "text" name = "c_name" class = "form-control" value = "<?php echo $customer_name; ?>" required>
	</div><!-- form-group Finish -->
	<div class = "form-group"><!-- form-group Begin -->
		<label> Email: </label>
		<input type = "text" name = "c_email" class = "form-control" value = "<?php echo $customer_email; ?>" required>
	</div><!-- form-group Finish -->
	<div class = "form-group"><!-- form-group Begin -->
		<label> Negara: </label>
		<input type = "text" name = "c_country" class = "form-control" value = "<?php echo $customer_country; ?>" required>
	</div><!-- form-group Finish -->
	<div class = "form-group"><!-- form-group Begin -->
		<label> Kota: </label>
		<input type = "text" name = "c_city" class = "form-control" value = "<?php echo $customer_city; ?>" required>
	</div><!-- form-group Finish -->
	<div class = "form-group"><!-- form-group Begin -->
		<label> Nomor HP: </label>
		<input type = "number" name = "c_contact" class = "form-control" value = "<?php echo $customer_contact; ?>" required>
	</div><!-- form-group Finish -->
	<div class = "form-group"><!-- form-group Begin -->
		<label> Alamat Lengkap: </label>
		<textarea name = "c_address" rows = "3" cols = "15" class = "form-control" required><?php echo $customer_address; ?></textarea>
	</div><!-- form-group Finish -->
	<div class = "form-group"><!-- form-group Begin -->
		<label> Foto Profil: </label>
		<input type = "file" name = "c_image" class = "form-control form-height-custom" required>
		<img class = "img-responsive" src = "customer_images/<?php echo $customer_image; ?>" alt = "Customer Image">
	</div><!-- form-group Finish -->
	<div class = "text-center"><!-- text-center Begin -->
		<button name = "update" class = "btn btn-primary"><!-- btn btn-primary Begin -->
			<i class = "fa fa-user-md"></i> Perbarui Sekarang
		</button><!-- btn btn-primary Finish -->
	</div><!-- text-center Finish -->
</form><!-- form Finish -->
<?php
	if(isset($_POST["update"])){
		$update_id = $customer_id;
		$c_name = $_POST["c_name"];
		$c_email = $_POST["c_email"];
		$c_country = $_POST["c_country"];
		$c_city = $_POST["c_city"];
		$c_address = $_POST["c_address"];
		$c_contact = $_POST["c_contact"];
		$c_image = $_FILES["c_image"]["name"];
		$c_image_tmp = $_FILES["c_image"]["tmp_name"];
		move_uploaded_file($c_image_tmp,"customer_images/$c_image");

		$update_customer = "UPDATE customers SET customer_name = '$c_name',customer_email = '$c_email',customer_country = '$c_country',customer_city = '$c_city',customer_address = '$c_address',customer_contact = '$customer_contact',customer_image = '$c_image' WHERE customer_id = '$update_id'";
		$run_customer = mysqli_query($con,$update_customer);

		if($run_customer){
			echo "<script>alert('Akun anda telah di edit, untuk melengkapi proses, dimohon melakukan Masuk Akun kembali')</script>";
			echo "<script>window.open('logout.php','_self')</script>";
		}
	}
?>