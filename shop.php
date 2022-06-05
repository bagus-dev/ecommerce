<?php
	$active = "Shop";
	include("includes/header.php");

	if(!isset($_GET["p_cat"])){
		if(!isset($_GET["cat"])){
			if(!isset($_GET["search"])){
		$page = (isset($_GET["page"])) ? $_GET["page"] : 1;
		$limit = 6;
		$limit_start = ($page - 1) * $limit;
		$query = mysqli_query($con, "SELECT * FROM products ORDER BY product_title ASC LIMIT ".$limit_start.",".$limit);
		$no = $limit_start + 1;

		if(!$query){
			die("Query Error: ".mysqli_errno($con)." - ".mysqli_error($con));
		}
	}
	}
	}
?>
	<div id = "content"><!-- content Begin -->
		<div class = "container"><!-- container Begin -->
			<div class = "col-md-12"><!-- col-md-12 Begin -->
				<ul class = "breadcrumb"><!-- breadcrumb Begin -->
					<li>
						<a href = "index.php"> Beranda </a>
					</li>
					<?php
						if(isset($_GET["p_cat"])){
							global $db;
							$get_p_cats = "SELECT * FROM product_categories WHERE p_cat_id = '$_GET[p_cat]'";
							$run_p_cats = mysqli_query($db,$get_p_cats);
		
							$row_p_cats = mysqli_fetch_array($run_p_cats);
								$p_cat_id = $row_p_cats["p_cat_id"];
								$p_cat_title = $row_p_cats["p_cat_title"];
								echo "
									<li>
										<a href = 'shop.php'> Berbelanja </a>
									</li>
									<li> Produk Kategori: <b> $p_cat_title </b></li>
								";
						}
						else if(isset($_GET["cat"])){
							global $db;
							$get_cats = "SELECT * FROM categories WHERE cat_id = '$_GET[cat]'";
							$run_cats = mysqli_query($db,$get_cats);
		
							$row_cats = mysqli_fetch_array($run_cats);
								$cat_id = $row_cats["cat_id"];
								$cat_title = $row_cats["cat_title"];
								echo "
									<li>
										<a href = 'shop.php'> Berbelanja </a>
									</li>
									<li> Kategori: <b> $cat_title </b></li>
								";
						}
						else if(isset($_GET["search"])){
							echo "
								<li>
									<a href = 'shop.php'> Berbelanja </a>
								</li>
								<li> Cari: <b> $_GET[user_query] </b></li>
							";
						}
						else{
							echo "<li> Berbelanja </li>";
						}
					?>
				</ul><!-- breadcrumb Finish -->
			</div><!-- col-md-12 Finish -->
			<div class = "col-md-3"><!-- col-md-3 Begin -->
				<?php
					include("includes/sidebar.php");
				?>
			</div><!-- col-md-3 Finish -->
			<div class = "col-md-9"><!-- col-md-9 Begin -->
			<?php
				if(!isset($_GET["p_cat"])){
					if(!isset($_GET["cat"])){
						if(!isset($_GET["search"])){
					echo "
						<div class = 'box'><!-- box Begin -->
							<h1> Berbelanja </h1>
							<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo deleniti accusamus, consequuntur illum quasi ut. Voluptate
								a, ipsam repellendus ut fugiat minima? Id facilis itaque autem, officiis veritatis perferendis, quaerat!
							</p>
						</div><!-- box Finish -->
					";
						}
					}
				}
			?>
				<div class = "row"><!-- row Begin -->
					<?php
						if(!isset($_GET["p_cat"])){
							if(!isset($_GET["cat"])){
								if(!isset($_GET["search"])){
								while($row_products = mysqli_fetch_array($query)){
										$pro_id = $row_products["product_id"];
										$pro_title = $row_products["product_title"];
										$pro_price = $row_products["product_price"];
										$pro_img1 = $row_products["product_img1"];
										$no;

										echo "
											<div class = 'col-md-4 col-sm-6 center-responsive'>
												<div class = 'product'>
													<a href = 'details.php?pro_id=$pro_id' title = '$pro_title'>
														<img class = 'img-responsive' src = 'admin_area/product_images/$pro_img1'>
													</a>
													<div class = 'text'>
														<h3>
															<a href = 'details.php?pro_id=$pro_id'> $pro_title </a>
														</h3>
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
										echo "
														</p>
														<p class = 'button'>
															<a class = 'btn btn-primary' href = 'details.php?pro_id=$pro_id'>
																Tampilkan Rincian
															</a>
														</p>
													</div>
												</div>
											</div>
											";
										$no++;
									}
								}
							}
						}
					?>
				</div><!-- row Finish -->
				<?php
						getsearchpro();
						getcatpro();
						getpcatpro();
				?>
				<center>
					<ul class = "pagination"><!-- pagination Begin -->
						<?php
							if(!isset($_GET["p_cat"])){
								if(!isset($_GET["cat"])){
									if(!isset($_GET["search"])){
							if($page == 1){
						?>
							<li class = "disabled"><a href = "#"> Halaman Pertama </a></li>
							<li class = "disabled"><a href = "#">&laquo;</a></li>
						<?php
							}
							else{
								$link_prev = ($page > 1)? $page - 1 : 1;
						?>
							<li><a href = "shop.php?page=1"> Halaman Pertama </a></li>
							<li><a href = "shop.php?page=<?php echo $link_prev; ?>">&laquo;</a></li>
						<?php
							}
							$sql2 = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM products");
							$get_jumlah = mysqli_fetch_array($sql2);

							$jumlah_page = ceil($get_jumlah["jumlah"] / $limit);
							$jumlah_number = 3;
							$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
							$end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page;

							for($i = $start_number; $i <= $end_number; $i++){
								$link_active = ($page == $i)? ' class="active"' : '';
						?>
							<li <?php echo $link_active; ?>><a href = "shop.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
						<?php
							}

							if($page == $jumlah_page){
						?>
							<li class = "disabled"><a href = "#">&raquo;</a></li>
							<li class = "disabled"><a href = "#"> Halaman Terakhir </a></li>
						<?php
							}
							else{
								$link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
						?>
							<li><a href = "shop.php?page=<?php echo $link_next; ?>">&raquo;</a></li>
							<li><a href = "shop.php?page=<?php echo $jumlah_page; ?>"> Halaman Terakhir </a></li>
						<?php
							}
							}
							}
							}
						?>
					</ul><!-- pagination Finish -->
				</center>
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