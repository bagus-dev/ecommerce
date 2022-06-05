<?php
	if(!isset($_SESSION["admin_email"])){
        echo "<script>window.open('login.php','_self')</script>";
    }
    else{
        if(isset($_GET["edit_product"])){
            $edit_id = $_GET["edit_product"];
            $get_p = "SELECT * FROM products WHERE product_id = '$edit_id'";
            $run_edit = mysqli_query($con,$get_p);
            $row_edit = mysqli_fetch_array($run_edit);

            $p_id = $row_edit["product_id"];
            $p_title = $row_edit["product_title"];
            $p_cat = $row_edit["p_cat_id"];
            $cat = $row_edit["cat_id"];
            $p_image1 = $row_edit["product_img1"];
            $p_image2 = $row_edit["product_img2"];
            $p_image3 = $row_edit["product_img3"];
            $p_price = $row_edit["product_price"];
            $p_keywords = $row_edit["product_keywords"];
            $p_desc = $row_edit["product_desc"];
        }

        $get_p_cat = "SELECT * FROM product_categories WHERE p_cat_id = '$p_cat'";
        $run_p_cat = mysqli_query($con,$get_p_cat);
        $row_p_cat = mysqli_fetch_array($run_p_cat);
        $p_cat_title = $row_p_cat["p_cat_title"];
        $get_cat = "SELECT * FROM categories WHERE cat_id = '$cat'";
        $run_cat = mysqli_query($con,$get_cat);
        $row_cat = mysqli_fetch_array($run_cat);
        $cat_title = $row_cat["cat_title"];
?>
	<div class = "row"><!-- row Begin -->
		<div class = "col-lg-12"><!-- col-lg-12 Begin -->
			<h1 class = "page-header"> Dasbor </h1>
			<ol class = "breadcrumb"><!-- breadcrumb Begin -->
				<li class = "active"><!-- active Begin -->
					<i class = "fa fa-dashboard"></i> <a href = "index.php?dashboard">Dasbor</a> > Perbarui Produk
				</li><!-- active Finish -->
			</ol><!-- breadcrumb Finish -->
		</div><!-- col-lg-12 Finish -->
	</div><!-- row Finish -->
	<div class = "row"><!-- row Begin -->
		<div class = "col-lg-12"><!-- col-lg-12 Begin -->
			<div class = "panel panel-primary"><!-- panel panel-primary Begin -->
				<div class = "panel-heading"><!-- panel-heading Begin -->
					<h3 class = "panel-title"><!-- panel-title Begin -->
						<i class = "fa fa-money fa-fw"></i> Perbarui Produk
					</h3><!-- panel-title Finish -->
				</div><!-- panel-heading Finish -->
				<div class = "panel-body"><!-- panel-body Begin -->
					<form method = "post" class = "form-horizontal" enctype = "multipart/form-data"><!-- form-horizontal Begin -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Judul Produk </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "product_title" type = "text" class = "form-control" value = "<?php echo $p_title; ?>" required>
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Kategori Produk </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
                                <select name = "product_cat" class = "form-control"><!-- form-control Begin -->
                                    <option value = "<?php echo $p_cat; ?>"><?php echo $p_cat_title; ?></option>
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
                                    <option value = "<?php echo $cat; ?>"><?php echo $cat_title; ?></option>
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
                                <input name = "product_img1" type = "file" class = "form-control">
                                <br>
                                <a class = "example-image-link" href = "product_images/<?php echo $p_image1; ?>" data-lightbox = "example-set" data-title = "<?php echo $p_title; ?> Image 1">
                                    <img class = "thumbnail img-responsive" width = "70" height = "70" src = "product_images/<?php echo $p_image1; ?>" alt = "<?php echo $p_title; ?> Image 1">
                                </a>
                            </div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Gambar Produk 2 </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
                                <input name = "product_img2" type = "file" class = "form-control">
                                <br>
                                <a class = "example-image-link" href = "product_images/<?php echo $p_image2; ?>" data-lightbox = "example-set" data-title = "<?php echo $p_title; ?> Image 2">
                                    <img class = "thumbnail img-responsive" width = "70" height = "70" src = "product_images/<?php echo $p_image2; ?>" alt = "<?php echo $p_title; ?> Image 2">
                                </a>
                            </div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Gambar Produk 3 </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
                                <input name = "product_img3" type = "file" class = "form-control">
                                <br>
                                <a class = "example-image-link" href = "product_images/<?php echo $p_image3; ?>" data-lightbox = "example-set" data-title = "<?php echo $p_title; ?> Image 3">
                                    <img class = "thumbnail img-responsive" width = "70" height = "70" src = "product_images/<?php echo $p_image3; ?>" alt = "<?php echo $p_title; ?> Image 3">
                                </a>
                                </div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Harga Produk </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "product_price" type = "text" class = "form-control" value = "<?php echo $p_price; ?>" required>
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Kata Kunci Produk </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "product_keywords" type = "text" class = "form-control" value = "<?php echo $p_keywords; ?>" required>
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Deskripsi Produk </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<textarea name = "product_desc" cols = "19" rows = "6" class = "form-control"><?php echo $p_desc; ?></textarea>
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"></label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "update" value = "Perbarui Produk" type = "submit" class = "btn btn-primary form-control">
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
	if(isset($_POST["update"])){
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
        
        $update_product = "UPDATE products SET p_cat_id = '$product_cat', cat_id = '$cat', date = NOW(), product_title = '$product_title', product_img1 = '$product_img1', product_img2 = '$product_img2', product_img3 = '$product_img3', ";
        $update_product .= "product_price = '$product_price', product_keywords = '$product_keywords', product_desc = '$product_desc' WHERE product_id = '$p_id'";
        $run_product = mysqli_query($con,$update_product);

        if($run_product){
            echo "<script>alert('Produk Berhasil di Perbarui Dengan Sukses.')</script>";
            echo "<script>window.open('index.php?view_products','_self')</script>";
        }
    }
}
?>