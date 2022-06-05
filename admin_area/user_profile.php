<?php
	if(!isset($_SESSION["admin_email"])){
        echo "<script>window.open('login.php','_self')</script>";
    }
    else{
        if(isset($_GET["user_profile"])){
            $edit_id = $_GET["user_profile"];
            $get_admin = "SELECT * FROM admins WHERE admin_id = '$edit_id'";
            $run_edit = mysqli_query($con,$get_admin);
            $row_edit = mysqli_fetch_array($run_edit);

            $admin_id = $row_edit["admin_id"];
            $admin_name = $row_edit["admin_name"];
            $admin_email = $row_edit["admin_email"];
            $admin_image = $row_edit["admin_image"];
            $admin_country = $row_edit["admin_country"];
            $admin_about = $row_edit["admin_about"];
            $admin_contact = $row_edit["admin_contact"];
            $admin_job = $row_edit["admin_job"];
        }
?>
	<div class = "row"><!-- row Begin -->
		<div class = "col-lg-12"><!-- col-lg-12 Begin -->
			<h1 class = "page-header"> Dasbor </h1>
			<ol class = "breadcrumb"><!-- breadcrumb Begin -->
				<li class = "active"><!-- active Begin -->
					<i class = "fa fa-dashboard"></i> <a href = "index.php?dashboard">Dasbor</a> > Ubah Profil
				</li><!-- active Finish -->
			</ol><!-- breadcrumb Finish -->
		</div><!-- col-lg-12 Finish -->
	</div><!-- row Finish -->
	<div class = "row"><!-- row Begin -->
		<div class = "col-lg-12"><!-- col-lg-12 Begin -->
			<div class = "panel panel-black"><!-- panel panel-black Begin -->
				<div class = "panel-heading"><!-- panel-heading Begin -->
					<h3 class = "panel-title"><!-- panel-title Begin -->
						<i class = "fa fa-money fa-fw"></i> Ubah Profil
					</h3><!-- panel-title Finish -->
				</div><!-- panel-heading Finish -->
				<div class = "panel-body"><!-- panel-body Begin -->
					<form method = "post" class = "form-horizontal" enctype = "multipart/form-data"><!-- form-horizontal Begin -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Nama Pengguna </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "admin_name" type = "text" class = "form-control" value = "<?php echo $admin_name; ?>" required>
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Email Pengguna </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "admin_email" type = "text" class = "form-control" value = "<?php echo $admin_email; ?>" required>
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Gambar Pengguna </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
                                <input name = "admin_image" type = "file" class = "form-control" accept = "image/*" required>
                                <br>
                                <a class = "example-image-link" href = "admin_images/<?php echo $admin_image; ?>" data-lightbox = "example-set" data-title = "<?php echo $admin_name; ?>">
                                    <img class = "thumbnail img-responsive" width = "200" height = "200" src = "admin_images/<?php echo $admin_image; ?>" alt = "<?php echo $admin_name; ?>">
                                </a>
                            </div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Negara </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
                                <input name = "admin_country" type = "text" class = "form-control" value = "<?php echo $admin_country; ?>" required>
							</div><!-- col-md-6 Finish -->
                        </div><!-- form-group Finish -->
                        <div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Tentang Saya </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
                                <textarea name = "admin_about" cols = "19" rows = "6" class = "form-control"><?php echo $admin_about; ?></textarea>
							</div><!-- col-md-6 Finish -->
                        </div><!-- form-group Finish -->
                        <div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Nomor HP </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
                                <input name = "admin_contact" type = "text" class = "form-control" value = "<?php echo $admin_contact; ?>" required>
							</div><!-- col-md-6 Finish -->
                        </div><!-- form-group Finish -->
                        <div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Pekerjaan </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
                                <input name = "admin_job" type = "text" class = "form-control" value = "<?php echo $admin_job; ?>" required>
							</div><!-- col-md-6 Finish -->
                        </div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"></label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "update_user" value = "Perbarui Pengguna" type = "submit" class = "btn btn-black form-control">
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
	if(isset($_POST["update_user"])){
        $admin_name = $_POST["admin_name"];
        $admin_email = $_POST["admin_email"];
        $admin_country = $_POST["admin_country"];
        $admin_about = $_POST["admin_about"];
        $admin_contact = $_POST["admin_contact"];
        $admin_job = $_POST["admin_job"];

        $admin_image = $_FILES["admin_image"]["name"];
        $admin_image_tmp = $_FILES["admin_image"]["tmp_name"];
        $admin_image_new = date("dmYHis").$admin_image;
        $path = "C:/xampp/htdocs/ecommerce/admin_area/admin_images/".$admin_image_new;
        move_uploaded_file($admin_image_tmp, $path);
        if(is_file("images/".$data["admin_image"]))
            unlink("images/".$data["admin_image"]);
        
        $update_user = "UPDATE admins SET admin_name = '$admin_name', admin_email = '$admin_email', admin_image = '$admin_image_new', admin_country = '$admin_country', admin_about = '$admin_about', admin_contact = '$admin_contact', admin_job = '$admin_job' WHERE admin_id = '$admin_id'";
        $run_user = mysqli_query($con,$update_user);

        if($run_user){
            echo "<script>alert('Pengguna Berhasil di Perbarui Dengan Sukses.')</script>";
            echo "<script>window.open('index.php?view_users','_self')</script>";
        }
    }
}
?>