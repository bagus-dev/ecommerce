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
					<i class = "fa fa-dashboard"></i> <a href = "index.php?dashboard">Dasbor</a> > Masukkan Kategori Produk
				</li><!-- active Finish -->
			</ol><!-- breadcrumb Finish -->
		</div><!-- col-lg-12 Finish -->
	</div><!-- row Finish -->
	<div class = "row"><!-- row Begin -->
		<div class = "col-lg-12"><!-- col-lg-12 Begin -->
			<div class = "panel panel-orange"><!-- panel panel-orange Begin -->
				<div class = "panel-heading"><!-- panel-heading Begin -->
					<h3 class = "panel-title"><!-- panel-title Begin -->
						<i class = "fa fa-money fa-fw"></i> Masukkan Kategori Produk
					</h3><!-- panel-title Finish -->
				</div><!-- panel-heading Finish -->
				<div class = "panel-body"><!-- panel-body Begin -->
					<form action = "" method = "post" class = "form-horizontal"><!-- form-horizontal Begin -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Judul Kategori Produk </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "p_cat_title" type = "text" class = "form-control" required>
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Deskripsi Kategori Produk </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<textarea name = "p_cat_desc" minlength = "5" cols = "19" rows = "6" class = "form-control"></textarea>
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"></label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "submit" value = "Masukkan Kategori Produk" type = "submit" class = "btn btn-warning form-control">
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
	if(isset($_POST["submit"])){
		$p_cat_title = $_POST["p_cat_title"];
		$p_cat_desc = $_POST["p_cat_desc"];
		
		$insert_p_cat = "INSERT INTO product_categories(p_cat_title,p_cat_desc) VALUES ('$p_cat_title','$p_cat_desc')";
		$run_p_cat = mysqli_query($con,$insert_p_cat);
		
		if($run_p_cat){
			echo "<script>alert('Kategori Produk Telah Dimasukkan Dengan Sukses.')</script>";
			echo "<script>window.open('index.php?view_p_cats','_self')</script>";
		}
		else{
			die("Query Error: ".mysqli_errno($con)." - ".mysqli_error($con));
		}
	}
}
?>