<?php
	$active = "Shop";
	include("includes/header.php");
?>
	<div id = "content"><!-- content Begin -->
		<div class = "container"><!-- container Begin -->
			<div class = "col-md-12"><!-- col-md-12 Begin -->
				<ul class = "breadcrumb"><!-- breadcrumb Begin -->
					<li>
						<a href = "index.php"> Beranda </a>
					</li>
					<li>
						<a href = "shop.php"> Berbelanja </a>
					</li>
					<li>
						<a href = "shop.php?p_cat=<?php echo $p_cat_id; ?>"><?php echo $p_cat_title; ?></a>
					</li>
					<li><?php echo $pro_title; ?></li>
				</ul><!-- breadcrumb Finish -->
			</div><!-- col-md-12 Finish -->
			<div class = "col-md-3"><!-- col-md-3 Begin -->
				<?php
					include("includes/sidebar.php");
				?>
			</div><!-- col-md-3 Finish -->
			<div class = "col-md-9"><!-- col-md-9 Begin -->
				<div id = "productMain" class = "row"><!-- row Begin -->
					<div class = "col-sm-6"><!-- col-sm-6 Begin -->
						<div id = "mainImage"><!-- #mainImage Begin -->
							<div id = "myCarousel" class = "carousel slide" data-ride = "carousel"><!-- carousel slide Begin -->
								<ol class = "carousel-indicators"><!-- carousel-indicators Begin -->
									<li data-target = "#myCarousel" data-slide-to = "0" class = "active"></li>
									<li data-target = "#myCarousel" data-slide-to = "1"></li>
									<li data-target = "#myCarousel" data-slide-to = "2"></li>
								</ol><!-- carousel-indicators Finish -->
								<div class = "carousel-inner">
									<div class = "item active">
										<center><img class = "img-responsive" src = "admin_area/product_images/<?php echo $pro_img1; ?>" alt = "Product 3-a"></center>
									</div>
									<div class = "item">
										<center><img class = "img-responsive" src = "admin_area/product_images/<?php echo $pro_img2; ?>" alt = "Product 3-b"></center>
									</div>
									<div class = "item">
										<center><img class = "img-responsive" src = "admin_area/product_images/<?php echo $pro_img3; ?>" alt = "Product 3-c"></center>
									</div>
								</div>
								<a href = "#myCarousel" class = "left carousel-control" data-slide = "prev">
									<span class = "glyphicon glyphicon-chevron-left"></span>
									<span class = "sr-only"> Previous </span>
								</a>
								<a href = "#myCarousel" class = "right carousel-control" data-slide = "next">
									<span class = "glyphicon glyphicon-chevron-right"></span>
									<span class = "sr-only"> Next </span>
								</a>
							</div><!-- carousel slide Finish -->
						</div><!-- #mainImage Finish -->
					</div><!-- col-sm-6 Finish -->
					<div class = "col-sm-6"><!-- col-sm-6 Begin -->0
						<div class = "box"><!-- box Begin -->
							<h1 class = "text-center"><?php echo $pro_title; ?></h1>
							<?php add_cart(); ?>
							<form name = "order" action = "details.php?add_cart=<?php echo $product_id; ?>" class = "form-horizontal" method = "post"><!-- form-horizontal Begin -->
								<div class = "form-group"><!-- form-group Begin -->
									<label for = "" class = "col-md-5 control-label"> Jumlah Produk </label>
									<div class = "col-md-7"><!-- col-md-7 Begin -->
										<select name = "product_qty" id = "" class = "form-control"><!-- select Begin -->
											<option> 1 </option>
											<option> 2 </option>
											<option> 3 </option>
											<option> 4 </option>
											<option> 5 </option>
										</select><!-- select Finish -->
									</div><!-- col-md-7 Finish -->
								</div><!-- form-group Finish -->
								<div class = "form-group"><!-- form-group Begin -->
									<label class = "col-md-5 control-label"> Ukuran Produk </label>
									<div class = "col-md-7"><!-- col-md-7 Begin -->
										<select name = "product_size" class = "form-control" required><!-- form-control Begin -->
											<option> Kecil </option>
											<option> Sedang </option>
											<option> Besar </option>
										</select><!-- form-control Finish -->
									</div><!-- col-md-7 Finish -->
								</div><!-- form-group Finish -->
								<p class = "price">
								<?php
									if($pro_price < 1000000){
										$pro_price1 = substr($pro_price,0,3);
										$pro_price2 = substr($pro_price,-3);
										echo "Rp.".$pro_price1.".".$pro_price2.",00";
									}
									else if($pro_price >= 1000000){
										$pro_price1 = substr($pro_price,0,1);
										$pro_price2 = substr($pro_price,1,3);
										$pro_price3 = substr($pro_price,-3);
										echo "Rp.".$pro_price1.".".$pro_price2.".".$pro_price3.",00";
									}
								?>
								</p>
								<p class = "text-center buttons"><button class = "btn btn-primary i fa fa-shopping-cart"> Tambah ke Troli </button></p>
							</form><!-- form-horizontal Finish -->
						</div><!-- box Finish -->
						<div class = "row" id = "thumbs"><!-- row Begin -->
							<div class = "col-xs-4"><!-- col-xs-4 Begin -->
								<a data-target = "#myCarousel" data-slide-to = "0" href = "#" class = "thumb"><!-- thumb Begin -->
									<img src = "admin_area/product_images/<?php echo $pro_img1; ?>" alt = "Product 1" class = "img-responsive">
								</a><!-- thumb Finish -->
							</div><!-- col-xs-4 Finish -->
							<div class = "col-xs-4"><!-- col-xs-4 Begin -->
								<a data-target = "#myCarousel" data-slide-to = "1" href = "#" class = "thumb"><!-- thumb Begin -->
									<img src = "admin_area/product_images/<?php echo $pro_img2; ?>" alt = "Product 2" class = "img-responsive">
								</a><!-- thumb Finish -->
							</div><!-- col-xs-4 Finish -->
							<div class = "col-xs-4"><!-- col-xs-4 Begin -->
								<a data-target = "#myCarousel" data-slide-to = "2" href = "#" class = "thumb"><!-- thumb Begin -->
									<img src = "admin_area/product_images/<?php echo $pro_img3; ?>" alt = "Product 4" class = "img-responsive">
								</a><!-- thumb Finish -->
							</div><!-- col-xs-4 Finish -->
						</div><!-- row Finish -->
					</div><!-- col-sm-6 Finish -->
				</div><!-- row Finish -->
				<div class = "box" id = "details"><!-- box Begin -->
					<h4> Rincian Produk </h4>
					<p>
						<?php echo $pro_desc; ?>
					</p>
						<h4> Ukuran </h4>
						<ul>
							<li> Kecil </li>
							<li> Sedang </li>
							<li> Besar </li>
						</ul>
						<hr>
				</div><!-- box Finish -->
				<div class = "row">
					<div class = "col-md-6">
						<ul class = "breadcrumb text-center">
							<li>
								<b>Kategori Produk</b>: <a href = "shop.php?p_cat=<?php echo $p_cat_id; ?>"><?php echo $p_cat_title; ?></a>
							</li>
						</ul>
					</div>
					<div class = "col-md-6">
						<ul class="breadcrumb text-center">
							<li>
								<b> Kategori</b>: <a href = "shop.php?cat=<?php echo $cat_id; ?>"><?php echo $cat_title; ?></a>
							</li>
						</ul>
					</div>
				</div>
				<div class = "row">
					<div class = "col-md-12">
						<div class = "box" id = "details">
							<h1 class = "text-center"> Produk Yang Mungkin Anda Suka </h1>
						</div>
					</div>
				</div>
				<div id = "row same-heigh-row"><!-- #row same-heigh-row Begin -->
					<?php
						$get_products = "SELECT * FROM products ORDER BY RAND() LIMIT 0,4";
						$run_products = mysqli_query($con,$get_products);
						
						while($row_products = mysqli_fetch_array($run_products)){
							$pro_id = $row_products["product_id"];
							$pro_title = $row_products["product_title"];
							$pro_img1 = $row_products["product_img1"];
							$pro_price = $row_products["product_price"];
							
							echo "
								<div class = 'col-md-3 col-sm-6 center-responsive'>
									<div class = 'product same-height'>
										<a href = 'details.php?pro_id=$pro_id'>
											<img class = 'img-responsive' src = 'admin_area/product_images/$pro_img1'>
										</a>
										<div class = 'text'>
											<h3> <a href = 'details.php?pro_id=$pro_id'> $pro_title </a> </h3>
											<p class = 'price'>
								";
							if($pro_price < 1000000){
								$pro_price1 = substr($pro_price,0,3);
								$pro_price2 = substr($pro_price,-3);
								echo "Rp.".$pro_price1.".".$pro_price2.",00";
							}
							else if($pro_price >= 1000000){
								$pro_price1 = substr($pro_price,0,1);
								$pro_price2 = substr($pro_price,1,3);
								$pro_price3 = substr($pro_price,-3);
								echo "Rp.".$pro_price1.".".$pro_price2.".".$pro_price3.",00";
							}
							echo "			</p>
										</div>
									</div>
								</div>
							";
						}
					?>
				</div><!-- #row same-heigh-row Finish -->
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