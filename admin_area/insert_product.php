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
					<i class = "fa fa-dashboard"></i> <a href = "index.php?dashboard">Dasbor</a> > Masukkan Produk
				</li><!-- active Finish -->
			</ol><!-- breadcrumb Finish -->
		</div><!-- col-lg-12 Finish -->
	</div><!-- row Finish -->
	<div class = "row"><!-- row Begin -->
		<div class = "col-lg-12"><!-- col-lg-12 Begin -->
			<div class = "panel panel-primary"><!-- panel panel-primary Begin -->
				<div class = "panel-heading"><!-- panel-heading Begin -->
					<h3 class = "panel-title"><!-- panel-title Begin -->
						<i class = "fa fa-money fa-fw"></i> Masukkan Produk
					</h3><!-- panel-title Finish -->
				</div><!-- panel-heading Finish -->
				<div class = "panel-body"><!-- panel-body Begin -->
					<form method = "post" class = "form-horizontal" enctype = "multipart/form-data"><!-- form-horizontal Begin -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Judul Produk </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "product_title" type = "text" class = "form-control" required>
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Kategori Produk </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<select name = "product_cat" class = "form-control"><!-- form-control Begin -->
									<?php
										$get_p_cats = "SELECT * FROM product_categories";
										$run_p_cats = mysqli_query($con,$get_p_cats);
										
										while($row_p_cats = mysqli_fetch_array($run_p_cats)){
											$p_cat_id = $row_p_cats["p_cat_id"];
											$p_cat_title = $row_p_cats["p_cat_title"];
											
											echo "<option value = '$p_cat_id'> $p_cat_title </option>";
										}
									?>
								</select><!-- form-control Finish -->
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Kategori </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<select name = "cat" class = "form-control"><!-- form-control Begin -->
									<?php
										$get_cat = "SELECT * FROM categories";
										$run_cat = mysqli_query($con,$get_cat);
										
										while($row_cat = mysqli_fetch_array($run_cat)){
											$cat_id = $row_cat["cat_id"];
											$cat_title = $row_cat["cat_title"];
											
											echo "<option value = '$cat_id'> $cat_title </option>";
										}
									?>
								</select><!-- form-control Finish -->
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Gambar Produk 1 </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "product_img1" type = "file" class = "form-control" accept = "image/*" required>
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Gambar Produk 2 </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "product_img2" type = "file" class = "form-control" accept = "image/*" required>
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Gambar Produk 3 </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "product_img3" type = "file" class = "form-control" accept = "image/*" required>
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Harga Produk </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "product_price" type = "text" class = "form-control" required>
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Kata Kunci Produk </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "product_keywords" type = "text" class = "form-control" required>
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Deskripsi Produk </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<textarea name = "product_desc" cols = "19" rows = "6" class = "form-control" required></textarea>
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"></label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "submit" value = "Masukkan Produk" type = "submit" class = "btn btn-primary form-control">
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
					</form><!-- form-horizontal Finish -->
				</div><!-- panel-body Finish -->
			</div><!-- panel panel-primary Finish -->
		</div><!-- col-lg-12 Finish -->
	</div><!-- row Finish -->
<script src = "js/tinymce/tinymce.min.js"></script>
<script> tinymce.init({ selector: 'textarea' }); </script>
</body>
</html>
<?php
	if(isset($_POST["submit"])){
		$product_title = $_POST["product_title"];
		$product_cat = $_POST["product_cat"];
		$cat = $_POST["cat"];
		$product_price = $_POST["product_price"];
		$product_keywords = $_POST["product_keywords"];
		$product_desc = $_POST["product_desc"];
		
		$product_img1 = $_FILES["product_img1"]["name"];
		$product_img2 = $_FILES["product_img2"]["name"];
		$product_img3 = $_FILES["product_img3"]["name"];
		
		$temp_name1 = $_FILES["product_img1"]["tmp_name"];
		$temp_name2 = $_FILES["product_img2"]["tmp_name"];
		$temp_name3 = $_FILES["product_img3"]["tmp_name"];
		
		move_uploaded_file($temp_name1,"product_images/$product_img1");
		move_uploaded_file($temp_name2,"product_images/$product_img2");
		move_uploaded_file($temp_name3,"product_images/$product_img3");
		
		$insert_product = "INSERT INTO products(p_cat_id,cat_id,date,product_title,product_img1,product_img2,product_img3,product_price, ";
		$insert_product .= "product_keywords,product_desc) VALUES ('$product_cat','$cat',NOW(),'$product_title','$product_img1','$product_img2', ";
		$insert_product .= "'$product_img3','$product_price','$product_keywords','$product_desc')";
		
		$run_product = mysqli_query($con,$insert_product);
		
		if($run_product){
			echo "<script>alert('Produk Telah Dimasukkan Dengan Sukses.')</script>";
			echo "<script>window.open('index.php?view_products','_self')</script>";
		}
		else{
			die("Query Error: ".mysqli_errno($con)." - ".mysqli_error($con));
		}
	}
}
?>