<?php
	$active = "Account";
	include("includes/header.php");
?>
	<div id = "content"><!-- content Begin -->
		<div class = "container"><!-- container Begin -->
			<div class = "col-md-12"><!-- col-md-12 Begin -->
				<ul class = "breadcrumb"><!-- breadcrumb Begin -->
					<li>
						<a href = "index.php"> Beranda </a>
					</li>
					<li> Daftar Akun </li>
				</ul><!-- breadcrumb Finish -->
			</div><!-- col-md-12 Finish -->
			<div class = "col-md-3"><!-- col-md-3 Begin -->
				<?php
					include("includes/sidebar.php");
				?>
			</div><!-- col-md-3 Finish -->
			<div class = "col-md-9"><!-- col-md-9 Begin -->
				<div class = "box"><!-- box Begin -->
					<div class = "box-header"><!-- box-header Begin -->
						<center><!-- center Begin -->
							<h2> Daftar akun baru </h2>
						</center><!-- center Finish -->
						<form action = "customer_register.php" method = "post" enctype = "multipart/form-data"><!-- form Begin -->
							<div class = "form-group"><!-- form-group Begin -->
								<label> Nama Anda </label>
								<input type = "text" minlength = "5" class = "form-control" name = "c_name" required>
							</div><!-- form-group Finish -->
							<div class = "form-group"><!-- form-group Begin -->
								<label> Email Anda </label>
								<input type = "email" class = "form-control" name = "c_email" required>
							</div><!-- form-group Finish -->
							<div class = "form-group"><!-- form-group Begin -->
								<label> Kata Sandi Anda </label>
								<input type = "password" minlength = "5" class = "form-control" name = "c_pass" required>
							</div><!-- form-group Finish -->
							<div class = "form-group"><!-- form-group Begin -->
								<label> Ulang Kata Sandi Anda </label>
								<input type = "password" minlength = "5" class = "form-control" name = "re_c_pass" required>
							</div><!-- form-group Finish -->
							<div class = "form-group"><!-- form-group Begin -->
								<label> Negara Anda </label>
								<input type = "text" class = "form-control" name = "c_country" required>
							</div><!-- form-group Finish -->
							<div class = "form-group"><!-- form-group Begin -->
								<label> Kota Anda </label>
								<input type = "text" class = "form-control" name = "c_city" required>
							</div><!-- form-group Finish -->
							<div class = "form-group"><!-- form-group Begin -->
								<label> Nomor HP Anda </label>
								<input type = "text" minlength = "11" maxlength = "13" class = "form-control" name = "c_contact" required>
							</div><!-- form-group Finish -->
							<div class = "form-group"><!-- form-group Begin -->
								<label> Alamat Anda </label>
								<textarea name = "c_address" minlength = "5" rows = "3	" cols = "15" class = "form-control" required></textarea>
							</div><!-- form-group Finish -->
							<div class = "form-group"><!-- form-group Begin -->
								<label> Foto Profil Anda </label>
								<input type = "file" class = "form-control form-height-custom" name = "c_image" accept = "image/*" required>
							</div><!-- form-group Finish -->
							<div class = "text-center"><!-- text-center Begin -->
								<button type = "submit" name = "register" class = "btn btn-primary">
									<i class = "fa fa-user-md"></i> Daftar
								</button>
							</div><!-- text-center Finish -->
						</form><!-- form Finish -->
					</div><!-- box-header Finish -->
				</div><!-- box Finish -->
			</div><!-- col-md-9 Finish -->
		</div><!-- container Finish -->
	</div><!-- content Finish -->
	<?php
		include("includes/footer.php");
	?>
	<script src = "js/jquery-331.min.js"></script>
	<script src = "js/bootstrap-337.min.js"></script>
</body>
</html>
<?php
	if(isset($_POST["register"])){
		$pesan_error = "";
		$c_name = htmlentities(strip_tags(trim($_POST["c_name"])));
		if(empty($c_name)){
			$pesan_error = "Nama Anda Belum Diisi.";
			echo "<script>alert('$pesan_error')</script>";
		}
		$c_email = htmlentities(strip_tags(trim($_POST["c_email"])));
		if(empty($c_email)){
			$pesan_error = "Email Anda Belum Diisi.";
			echo "<script>alert('$pesan_error')</script>";
		}
		if(!preg_match("/.+@.+\..+/",$c_email)){
			$pesan_error .= "Format email tidak sesuai";
			echo "<script>alert('$pesan_error')</script>";
		}
		$c_email = mysqli_real_escape_string($con,$c_email);
		$query_email = "SELECT * FROM customers WHERE customer_email = '$c_email'";
		$result_email = mysqli_query($con,$query_email);
		$jumlah_email = mysqli_num_rows($result_email);
		if($jumlah_email >= 1){
			$pesan_error .= "Alamat email yang sama sudah digunakan.";
			echo "<script>alert('$pesan_error')</script>";
		}
		$c_pass = htmlentities(strip_tags(trim($_POST["c_pass"])));
		if(empty($c_pass)){
			$pesan_error = "Kata Sandi Anda Belum Diisi.";
			echo "<script>alert('$pesan_error')</script>";
		}
		$re_c_pass = htmlentities(strip_tags(trim($_POST["re_c_pass"])));
		if(empty($re_c_pass)){
			$pesan_error = "Ulang Kata Sandi Anda Belum Diisi.";
			echo "<script>alert('$pesan_error')</script>";
		}
		if($c_pass !== $re_c_pass){
			$pesan_error .= "Kata Sandi dengan Ulang Kata Sandi tidak cocok";
			echo "<script>alert('$pesan_error')</script>";
		}
		$c_country = htmlentities(strip_tags(trim($_POST["c_country"])));
		if(empty($c_country)){
			$pesan_error = "Negara Anda Belum Diisi.";
			echo "<script>alert('$pesan_error')</script>";
		}
		$c_city = htmlentities(strip_tags(trim($_POST["c_city"])));
		if(empty($c_city)){
			$pesan_error = "Kota Anda Belum Diisi.";
			echo "<script>alert('$pesan_error')</script>";
		}
		$c_contact = htmlentities(strip_tags(trim($_POST["c_contact"])));
		if(empty($c_contact)){
			$pesan_error = "Nomor HP Anda Belum Diisi.";
			echo "<script>alert('$pesan_error')</script>";
		}
		if(!is_numeric($c_contact)){
			$pesan_error .= "Nomor HP tidak sesuai format";
			echo "<script>alert('$pesan_error')</script>";
		}
		$c_contact = mysqli_real_escape_string($con,$c_contact);
		$query_contact = "SELECT * FROM customers WHERE customer_contact = '$c_contact'";
		$result_contact = mysqli_query($con,$query_contact);
		$jumlah_contact = mysqli_num_rows($result_contact);
		if($jumlah_contact >= 1){
			$pesan_error .= "Nomor HP yang sama sudah digunakan.";
			echo "<script>alert('$pesan_error')</script>";
		}
		$c_address = htmlentities(strip_tags(trim($_POST["c_address"])));
		if(empty($c_address)){
			$pesan_error = "Alamat Anda Belum Diisi.";
			echo "<script>alert('$pesan_error')</script>";
		}
		
		if($pesan_error == ""){
			$c_image = $_FILES["c_image"]["name"];
			$c_image_tmp = $_FILES["c_image"]["tmp_name"];
			$c_image_new = date('dmYHis').$c_image;
			$path = "C:/xampp/htdocs/ecommerce/customer/customer_images/".$c_image_new;

			$c_name = mysqli_real_escape_string($con,$c_name);
			$c_email = mysqli_real_escape_string($con,$c_email);
			$c_pass = mysqli_real_escape_string($con,$c_pass);
			$pass_sha1 = sha1($c_pass);
			$c_country = mysqli_real_escape_string($con,$c_country);
			$c_city = mysqli_real_escape_string($con,$c_city);
			$c_contact = mysqli_real_escape_string($con,$c_contact);
			$c_address = mysqli_real_escape_string($con,$c_address);

			$c_ip = getRealIpUser();
			move_uploaded_file($c_image_tmp, $path);
			if(is_file("images/".$data["c_image"]))
				unlink("images/".$data["c_image"]);
			$insert_customer = "INSERT INTO customers (customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,";
			$insert_customer .= "customer_address,customer_image,customer_ip) VALUES ('$c_name','$c_email','$pass_sha1','$c_country','$c_city',";
			$insert_customer .= "'$c_contact','$c_address','$c_image_new','$c_ip')";
		
			$run_customer = mysqli_query($con,$insert_customer);
		
			if($run_customer){
				echo "<script>alert('Akun Berhasil Ditambah')</script>";
				echo "<script>window.open('checkout.php','_self')</script>";
		}
	}
}
?>