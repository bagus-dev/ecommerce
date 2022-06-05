<?php
	if(!isset($_SESSION["admin_email"])){
        echo "<script>window.open('login.php','_self')</script>";
    }
    else{
        if(isset($_GET["edit_cat"])){
            $edit_id = $_GET["edit_cat"];
            $get_p = "SELECT * FROM categories WHERE cat_id = '$edit_id'";
            $run_edit = mysqli_query($con,$get_p);
            $row_edit = mysqli_fetch_array($run_edit);

            $cat_id = $row_edit["cat_id"];
            $cat_title = $row_edit["cat_title"];
            $cat_desc = $row_edit["cat_desc"];
        }
?>
	<div class = "row"><!-- row Begin -->
		<div class = "col-lg-12"><!-- col-lg-12 Begin -->
			<h1 class = "page-header"> Dasbor </h1>
			<ol class = "breadcrumb"><!-- breadcrumb Begin -->
				<li class = "active"><!-- active Begin -->
					<i class = "fa fa-dashboard"></i> <a href = "index.php?dashboard">Dasbor</a> > Perbarui Kategori
				</li><!-- active Finish -->
			</ol><!-- breadcrumb Finish -->
		</div><!-- col-lg-12 Finish -->
	</div><!-- row Finish -->
	<div class = "row"><!-- row Begin -->
		<div class = "col-lg-12"><!-- col-lg-12 Begin -->
			<div class = "panel panel-orange"><!-- panel panel-orange Begin -->
				<div class = "panel-heading"><!-- panel-heading Begin -->
					<h3 class = "panel-title"><!-- panel-title Begin -->
						<i class = "fa fa-money fa-fw"></i> Perbarui Kategori
					</h3><!-- panel-title Finish -->
				</div><!-- panel-heading Finish -->
				<div class = "panel-body"><!-- panel-body Begin -->
					<form method = "post" class = "form-horizontal" enctype = "multipart/form-data"><!-- form-horizontal Begin -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Judul Kategori </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "cat_title" type = "text" class = "form-control" value = "<?php echo $cat_title; ?>" required>
							</div><!-- col-md-6 Finish -->
                        </div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Deskripsi Kategori </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<textarea name = "cat_desc" cols = "19" rows = "6" class = "form-control"><?php echo $cat_desc; ?></textarea>
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"></label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "update_cat" value = "Perbarui Kategori" type = "submit" class = "btn btn-warning form-control">
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
					</form><!-- form-horizontal Finish -->
				</div><!-- panel-body Finish -->
			</div><!-- panel panel-orange Finish -->
		</div><!-- col-lg-12 Finish -->
	</div><!-- row Finish -->
<script src = "js/tinymce/tinymce.min.js"></script>
<script> tinymce.init({ selector: 'textarea' }); </script>
</body>
</html>
<?php
	if(isset($_POST["update_cat"])){
		$cat_title = $_POST["cat_title"];
		$cat_desc = $_POST["cat_desc"];
        
        $update_cat = "UPDATE categories SET cat_title = '$cat_title', cat_desc = '$cat_desc' WHERE cat_id = '$cat_id'";
        $run_cat = mysqli_query($con,$update_cat);

        if($run_cat){
            echo "<script>alert('Kategori Berhasil di Perbarui Dengan Sukses.')</script>";
            echo "<script>window.open('index.php?view_cats','_self')</script>";
        }
    }
}
?>