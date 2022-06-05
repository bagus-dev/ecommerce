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
					<i class = "fa fa-dashboard"></i> <a href = "index.php?dashboard">Dasbor</a> > Masukkan Slide
				</li><!-- active Finish -->
			</ol><!-- breadcrumb Finish -->
		</div><!-- col-lg-12 Finish -->
	</div><!-- row Finish -->
	<div class = "row"><!-- row Begin -->
		<div class = "col-lg-12"><!-- col-lg-12 Begin -->
			<div class = "panel panel-primary"><!-- panel panel-primary Begin -->
				<div class = "panel-heading"><!-- panel-heading Begin -->
					<h3 class = "panel-title"><!-- panel-title Begin -->
						<i class = "fa fa-money fa-fw"></i> Masukkan Slide
					</h3><!-- panel-title Finish -->
				</div><!-- panel-heading Finish -->
				<div class = "panel-body"><!-- panel-body Begin -->
					<form method = "post" class = "form-horizontal" enctype = "multipart/form-data"><!-- form-horizontal Begin -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Gambar Slide </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "slide_image" type = "file" class = "form-control" accept = "image/*" required>
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"></label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "submit_slide" value = "Masukkan Slide" type = "submit" class = "btn btn-primary form-control">
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
					</form><!-- form-horizontal Finish -->
				</div><!-- panel-body Finish -->
			</div><!-- panel panel-primary Finish -->
		</div><!-- col-lg-12 Finish -->
	</div><!-- row Finish -->
</body>
</html>
<?php
	if(isset($_POST["submit_slide"])){
		$slide_image = $_FILES["slide_image"]["name"];
		$slide_image_tmp = $_FILES["slide_image"]["tmp_name"];
		$slide_image_ext = pathinfo($slide_image, PATHINFO_EXTENSION);

		$slide_id_query = mysqli_query($con, "SELECT slide_id FROM slider");
		$slide_id = mysqli_num_rows($slide_id_query);
		$slide_tambah = $slide_id + 1;

		$slide_name = "Slide Number ".$slide_tambah;
		$slide_image_new = "slide-".$slide_tambah.".".$slide_image_ext;

		$path = "C:/xampp/htdocs/ecommerce/admin_area/slides_images/".$slide_image_new;
		move_uploaded_file($slide_image_tmp, $path);
		if(is_file("images/".$data["slide_image"]))
			unlink("images/".$data["slide_image"]);
		
		$non_active = "Non-active";
		$insert_slide = "INSERT INTO slider(slide_name,slide_image,slide_status) ";
		$insert_slide .= "VALUES ('$slide_name','$slide_image_new','$non_active')";
		
		$run_slide = mysqli_query($con,$insert_slide);
		
		if($run_slide){
			echo "<script>alert('Slide Telah Dimasukkan Dengan Sukses.')</script>";
			echo "<script>window.open('index.php?view_slides','_self')</script>";
		}
		else{
			die("Query Error: ".mysqli_errno($con)." - ".mysqli_error($con));
		}
	}
}
?>