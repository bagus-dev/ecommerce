<?php
	if(!isset($_SESSION["admin_email"])){
        echo "<script>window.open('login.php','_self')</script>";
    }
    else{
        if(isset($_GET["edit_slide"])){
            $edit_id = $_GET["edit_slide"];
            $get_slide = "SELECT * FROM slider WHERE slide_id = '$edit_id'";
            $run_edit = mysqli_query($con,$get_slide);
            $row_edit = mysqli_fetch_array($run_edit);

            $slide_id = $row_edit["slide_id"];
            $slide_name = $row_edit["slide_name"];
            $slide_image = $row_edit["slide_image"];
            $slide_status = $row_edit["slide_status"];
        }

        $checked_active = ""; $checked_non = "";
        switch($slide_status){
            case "active": $checked_active = "checked"; break;
            case "Non-active": $checked_non = "checked"; break;
        }
?>
	<div class = "row"><!-- row Begin -->
		<div class = "col-lg-12"><!-- col-lg-12 Begin -->
			<h1 class = "page-header"> Dasbor </h1>
			<ol class = "breadcrumb"><!-- breadcrumb Begin -->
				<li class = "active"><!-- active Begin -->
					<i class = "fa fa-dashboard"></i> <a href = "index.php?dashboard">Dasbor</a> > Perbarui Status Slide
				</li><!-- active Finish -->
			</ol><!-- breadcrumb Finish -->
		</div><!-- col-lg-12 Finish -->
	</div><!-- row Finish -->
	<div class = "row"><!-- row Begin -->
		<div class = "col-lg-12"><!-- col-lg-12 Begin -->
			<div class = "panel panel-primary"><!-- panel panel-primary Begin -->
				<div class = "panel-heading"><!-- panel-heading Begin -->
					<h3 class = "panel-title"><!-- panel-title Begin -->
						<i class = "fa fa-money fa-fw"></i> Perbarui Status Slide
					</h3><!-- panel-title Finish -->
				</div><!-- panel-heading Finish -->
				<div class = "panel-body"><!-- panel-body Begin -->
					<form method = "post" class = "form-horizontal" enctype = "multipart/form-data"><!-- form-horizontal Begin -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> ID Slide </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "slide_id" type = "text" class = "form-control" value = "<?php echo $slide_id; ?>" readonly>
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Nama Slide </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "slide_name" type = "text" class = "form-control" value = "<?php echo $slide_name; ?>" readonly>
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Gambar Slide </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
                                <a class = "example-image-link" href = "slides_images/<?php echo $slide_image; ?>" data-lightbox = "example-set" data-title = "<?php echo $slide_name; ?>"><img class = "thumbnail img-responsive" width = "200" height = "200" src = "slides_images/<?php echo $slide_image; ?>"></a>
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Status Slide </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
                                <input name = "status_slide" type = "radio" class = "form-check-input" value = "active" <?php echo $checked_active ?>> Aktif
                                <br><input name = "status_slide" type = "radio" class = "form-check-input" value = "Non-active" <?php echo $checked_non ?>> Tidak Aktif
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"></label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "update_slide" value = "Perbarui Status Slide" type = "submit" class = "btn btn-primary form-control">
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
	if(isset($_POST["update_slide"])){
        $slide_status = $_POST["status_slide"];
        
        $active = "active";
        $slide_query = "SELECT slide_status FROM slider WHERE slide_status = '$active'";
        $run_slide_query = mysqli_query($con,$slide_query);
        $active_query = mysqli_num_rows($run_slide_query);

        if(($slide_status == "Non-active") AND ($active_query <= 1)){
            echo "<script>alert('Minimal Slide yang Aktif adalah 1')</script>";
        }
        elseif(($slide_status == "active") AND ($active_query >= 4)){
            echo "<script>alert('Maksimal Slide yang Aktif adalah 4')</script>";
        }
        else{
            $update_slide = "UPDATE slider SET slide_status = '$slide_status' WHERE slide_id = '$edit_id'";
            $run_slide = mysqli_query($con,$update_slide);

            if($run_slide){
                echo "<script>alert('Status Slide Berhasil di Perbarui Dengan Sukses.')</script>";
                echo "<script>window.open('index.php?view_slides','_self')</script>";
            }
        }
    }
}
?>