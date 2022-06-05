<?php
	if(!isset($_SESSION["admin_email"])){
        echo "<script>window.open('login.php','_self')</script>";
    }
    else{
?>
	<div class = "row"><!-- row Begin -->
		<div class = "col-lg-12"><!-- col-lg-12 Begin -->
			<h1 class = "page-header"> Dasbor </h1>
			<ol class = "breadcrumb"><!-- breadcrumb Begin -->
				<li class = "active"><!-- active Begin -->
					<i class = "fa fa-dashboard"></i> <a href = "index.php?dashboard">Dasbor</a> > Masukkan Pengguna
				</li><!-- active Finish -->
			</ol><!-- breadcrumb Finish -->
		</div><!-- col-lg-12 Finish -->
	</div><!-- row Finish -->
	<div class = "row"><!-- row Begin -->
		<div class = "col-lg-12"><!-- col-lg-12 Begin -->
			<div class = "panel panel-black"><!-- panel panel-black Begin -->
				<div class = "panel-heading"><!-- panel-heading Begin -->
					<h3 class = "panel-title"><!-- panel-title Begin -->
						<i class = "fa fa-money fa-fw"></i> Masukkan Pengguna
					</h3><!-- panel-title Finish -->
				</div><!-- panel-heading Finish -->
				<div class = "panel-body"><!-- panel-body Begin -->
					<form method = "post" class = "form-horizontal" enctype = "multipart/form-data"><!-- form-horizontal Begin -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Nama Pengguna </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "admin_name" type = "text" class = "form-control" required>
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Email Pengguna </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "admin_email" type = "text" class = "form-control" required>
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Kata Sandi </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "admin_pass" type = "password" class = "form-control" required>
							</div><!-- col-md-6 Finish -->
                        </div><!-- form-group Finish -->
                        <div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Gambar Pengguna </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "admin_image" type = "file" class = "form-control" accept = "image/*" required>
							</div><!-- col-md-6 Finish -->
                        </div><!-- form-group Finish -->
                        <div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Negara </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "admin_country" type = "text" class = "form-control" required>
							</div><!-- col-md-6 Finish -->
                        </div><!-- form-group Finish -->
                        <div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Tentang Saya </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
                                <textarea name = "admin_about" cols = "19" rows = "6" class = "form-control"></textarea>
							</div><!-- col-md-6 Finish -->
                        </div><!-- form-group Finish -->
                        <div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Nomor HP </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "admin_contact" type = "text" class = "form-control" required>
							</div><!-- col-md-6 Finish -->
                        </div><!-- form-group Finish -->
                        <div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Pekerjaan </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "admin_job" type = "text" class = "form-control" required>
							</div><!-- col-md-6 Finish -->
                        </div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"></label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "submit_admin" value = "Masukkan Pengguna" type = "submit" class = "btn btn-black form-control">
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
					</form><!-- form-horizontal Finish -->
				</div><!-- panel-body Finish -->
			</div><!-- panel panel-black Finish -->
		</div><!-- col-lg-12 Finish -->
	</div><!-- row Finish -->
<script src = "js/tinymce/tinymce.min.js"></script>
<script> tinymce.init({ selector: 'textarea' }); </script>
</body>
</html>
<?php
	if(isset($_POST["submit_admin"])){
        $admin_name = $_POST["admin_name"];
        $admin_email = $_POST["admin_email"];
        $admin_pass = $_POST["admin_pass"];
        $pass_sha1 = sha1($admin_pass);
        $admin_country = $_POST["admin_country"];
        $admin_about = $_POST["admin_about"];
        $admin_contact = $_POST["admin_contact"];
        $admin_job = $_POST["admin_job"];

        $admin_image = $_FILES["admin_image"]["name"];
        $admin_image_tmp = $_FILES["admin_image"]["tmp_name"];
        $admin_image_new = date('dmYHis').$admin_image;
        $path = "C:/xampp/htdocs/ecommerce/admin_area/admin_images/".$admin_image_new;
        move_uploaded_file($admin_image_tmp, $path);
        if(is_file("images/".$data["admin_image"]))
            unlink("images/".$data["admin_image"]);
		
		$insert_admin = "INSERT INTO admins(admin_name,admin_email,admin_pass,admin_image,admin_country,admin_about,admin_contact,admin_job) ";
		$insert_admin .= "VALUES ('$admin_name','$admin_email','$pass_sha1','$admin_image_new','$admin_country','$admin_about', ";
		$insert_admin .= "'$admin_contact','$admin_job')";
		
		$run_admin = mysqli_query($con,$insert_admin);
		
		if($run_admin){
			echo "<script>alert('Pengguna Telah Dimasukkan Dengan Sukses.')</script>";
			echo "<script>window.open('index.php?view_users','_self')</script>";
		}
		else{
			die("Query Error: ".mysqli_errno($con)." - ".mysqli_error($con));
		}
	}
}
?>