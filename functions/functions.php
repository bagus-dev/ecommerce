<?php
	$db = mysqli_connect("localhost","root","","ecom_store");
	
	function getRealIpUser(){
		switch(true){
			case(!empty($_SERVER["HTTP_X_REAL_IP"])) : return $_SERVER["HTTP_X_REAL_IP"];
			case(!empty($_SERVER["HTTP_CLIENT_IP"])) : return $_SERVER["HTTP_CLIENT_IP"];
			case(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) : return $_SERVER["HTTP_X_FORWARDED_FOR"];
			default : return $_SERVER["REMOTE_ADDR"];
		}
	}
	
	function add_cart(){
		global $db;
		
		if(isset($_GET["add_cart"])){
			$ip_add = getRealIpUser();
			$p_id = $_GET["add_cart"];
			$product_qty = $_POST["product_qty"];
			$product_size = $_POST["product_size"];
			$date = date("Y-m-d");
			$check_product = "SELECT * FROM cart WHERE ip_add = '$ip_add' AND p_id = '$p_id'";
			$run_check = mysqli_query($db,$check_product);
			
			if(mysqli_num_rows($run_check) > 0){
				echo "<script>alert('Produk ini sudah ditambahkan di Troli')</script>";
				echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";
			}
			else{
				$check_cart = "SELECT * FROM cart WHERE ip_add = '$ip_add'";
				$run_check_cart = mysqli_query($db,$check_cart);
				$num_cart = mysqli_num_rows($run_check_cart);
				if($num_cart >= 5){
					echo "<script>alert('Harap lakukan Checkout terlebih dahulu, maksimal 5 produk di dalam Troli Belanja')</script>";
					echo "<script>window.open('cart.php','_self')</script>";
				}
				else{
					$query = "INSERT INTO cart (p_id,ip_add,qty,size,date) values ('$p_id','$ip_add','$product_qty','$product_size','$date')";
					$run_query = mysqli_query($db,$query);
					echo "<script>window.open('cart.php','_self')</script>";
				}
			}
		}
	}
	
	function getPro(){
		global $db;
		
		$get_products = "SELECT * FROM products ORDER BY 1 DESC LIMIT 0,8";
		$run_products = mysqli_query($db,$get_products);
		
		while($row_products = mysqli_fetch_array($run_products)){
			$pro_id = $row_products["product_id"];
			$pro_title = $row_products["product_title"];
			$pro_price = $row_products["product_price"];
			$pro_img1 = $row_products["product_img1"];
			
			echo "
				<div class = 'col-md-4 col-sm-6 single'>
					<div class = 'product'>
						<a href = 'details.php?pro_id=$pro_id' title = '$pro_title'>
							<img class = 'img-responsive' src = 'admin_area/product_images/$pro_img1'>
						</a>
						<div class = 'text'>
							<h3>
								<a href = 'details.php?pro_id=$pro_id'>
									$pro_title
								</a>
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
		}
	}
	
	function getPCats(){
		global $db;
		$get_p_cats = "SELECT * FROM product_categories";
		$run_p_cats = mysqli_query($db,$get_p_cats);
		
		while($row_p_cats = mysqli_fetch_array($run_p_cats)){
			$p_cat_id = $row_p_cats["p_cat_id"];
			$p_cat_title = $row_p_cats["p_cat_title"];
?>
				<li>
					<a href = 'shop.php?p_cat=<?php echo $p_cat_id; ?>' class = '<?php if($_GET["p_cat"] == $p_cat_id) echo "active"; ?>'><?php echo $p_cat_title; ?></a>
				</li>
<?php
		}
	}
	
	function getCats(){
		global $db;
		$get_cats = "SELECT * FROM categories";
		$run_cats = mysqli_query($db,$get_cats);
		
		while($row_cats = mysqli_fetch_array($run_cats)){
			$cat_id = $row_cats["cat_id"];
			$cat_title = $row_cats["cat_title"];
?>
				<li>
					<a href = 'shop.php?cat=<?php echo $cat_id; ?>' class = '<?php if($_GET["cat"] == $cat_id) echo "active"; ?>'><?php echo $cat_title; ?></a>
				</li>
<?php
		}
	}

	function getsearchpro(){
		global $db;
		if(isset($_GET["search"])){
			$pro_search = htmlentities(strip_tags(trim($_GET["user_query"])));
			$pro_search = mysqli_real_escape_string($db,$pro_search);
			$page_search = (isset($_GET["page"])) ? $_GET["page"] : 1;
			$limit_search = 6;
			$limit_start_search = ($page_search - 1) * $limit_search;
			$query_search = mysqli_query($db, "SELECT * FROM products WHERE product_title LIKE '%$pro_search%' OR product_keywords LIKE '%$pro_search%' ORDER BY product_title ASC LIMIT ".$limit_start_search.",".$limit_search);
			$no_search = $limit_start_search + 1;
			$count_search = mysqli_num_rows($query_search);

			if(!$query_search){
				die("Query Error: ".mysqli_errno($db)." - ".mysqli_error($db));
			}

			if($count_search == 0){
				echo "
					<div class = 'box'>
						<h1> Tidak Ada Produk Ditemukan Untuk \"$pro_search\" </h1>
					</div>
				";
			}
			else{
				echo "
					<div class = 'box'>
						<h1> Berikut Produk Ditemukan Untuk \"$pro_search\" </h1>
					</div>
				";
			}

			while($row_products_search = mysqli_fetch_array($query_search)){
				$pro_id_search = $row_products_search["product_id"];
				$pro_title_search = $row_products_search["product_title"];
				$pro_price_search = $row_products_search["product_price"];
				$pro_img1_search = $row_products_search["product_img1"];
				$no_search;

				echo "
					<div class = 'col-md-4 col-sm-6 center-responsive'>
						<div class = 'product'>
							<a href = 'details.php?pro_id=$pro_id_search' title = '$pro_title_search'>
								<img class = 'img-responsive' src = 'admin_area/product_images/$pro_img1_search'>
							</a>
							<div class = 'text'>
								<h3>
									<a href = 'details.php?pro_id=$pro_id_search'> $pro_title_search </a>
								</h3>
								<p class = 'price'>
					";
				if($pro_price_search < 1000000){
					$pro_price1_search = substr($pro_price_search,0,3);
					$pro_price2_search = substr($pro_price_search,-3);
					echo "Rp.".$pro_price1_search.".".$pro_price2_search.",00";
				}
				else if($pro_price_search >= 1000000){
					$pro_price1_search = substr($pro_price_search,0,1);
					$pro_price2_search = substr($pro_price_search,1,3);
					$pro_price3_search = substr($pro_price_search,-3);
					echo "Rp.".$pro_price1_search.".".$pro_price2_search.".".$pro_price3_search.",00";
				}
				echo "
								</p>
								<p class = 'button'>
									<a class = 'btn btn-primary' href = 'details.php?pro_id=$pro_id_search'>
										Tampilkan Rincian
									</a>
								</p>
							</div>
						</div>
					</div>
				";
				$no_search++;
			}
			if($count_search > 0){
			echo "<center><ul class = 'pagination'>";
				if($page_search == 1){
					echo "<li class = 'disabled'><a href = '#' title = 'Halaman Pertama'> Halaman Pertama </a></li>";
					echo "<li class = 'disabled'><a href = '#'>&laquo;</a></li>";
				}
				else{
					$link_prev_search = ($page_search > 1)? $page_search - 1 : 1;
					echo "<li><a href = 'shop.php?user_query=$pro_search&search=Search&page=1'> Halaman Pertama </a><li>";
					echo "<li><a href = 'shop.php?user_query=$pro_search&search=Search&page=$link_prev_search'>&laquo;</a></li>";
				}

				$sql_search = mysqli_query($db, "SELECT COUNT(*) AS jumlah_search FROM products WHERE product_title LIKE '%$pro_search%' OR product_keywords LIKE '%$pro_search%'");
				$get_jumlah_search = mysqli_fetch_array($sql_search);

				$jumlah_page_search = ceil($get_jumlah_search["jumlah_search"] / $limit_search);
				$jumlah_number_search = 3;
				$start_number_search = ($page_search > $jumlah_number_search)? $page_search - $jumlah_number_search : 1;
				$end_number_search = ($page_search < ($jumlah_page_search - $jumlah_number_search))? $page_search + $jumlah_number_search : $jumlah_page_search;

				for($i = $start_number_search; $i <= $end_number_search; $i++){
					$link_active_search = ($page_search == $i)? ' class = "active"' : '';
					echo "<li $link_active_search><a href = 'shop.php?user_query=$pro_search&search=Search&page=$i' title = '$i'> $i </a></li>";
				}

				if($page_search == $jumlah_page_search){
					echo "<li class = 'disabled'><a href = '#'>&raquo;</a></li>";
					echo "<li class = 'disabled'><a href = '#' title = 'Halaman Terakhir'> Halaman Terakhir </a></li>";
				}
				else{
					$link_next_search = ($page_search < $jumlah_page_search)? $page_search + 1 : $jumlah_page_search;
					echo "<li><a href = 'shop.php?user_query=$pro_search&search=Search&page=$link_next_search'>&raquo;</a></li>";
					echo "<li><a href = 'shop.php?user_query=$pro_search&search=Search&page=$jumlah_page_search' title = 'Halaman Terakhir'> Halaman Terakhir </a></li>";
				}
				echo "</ul></center>";
			}
		}
	}
	
	function getpcatpro(){
		global $db;
		if(isset($_GET["p_cat"])){
			$p_cat_id = $_GET["p_cat"];
			$get_p_cat = "SELECT * FROM product_categories WHERE p_cat_id = '$p_cat_id'";
			$run_p_cat = mysqli_query($db,$get_p_cat);
			$row_p_cat = mysqli_fetch_array($run_p_cat);
			$page_sidebar_pcat = (isset($_GET["page"])) ? $_GET["page"] : 1;
			$limit_sidebar_pcat = 6;
			$limit_start_sidebar_pcat = ($page_sidebar_pcat - 1) * $limit_sidebar_pcat;
			$p_cat_title = $row_p_cat["p_cat_title"];
			$p_cat_desc = $row_p_cat["p_cat_desc"];
			$get_products = "SELECT * FROM products WHERE p_cat_id = '$p_cat_id' LIMIT ".$limit_start_sidebar_pcat.",".$limit_sidebar_pcat;
			$no_sidebar_pcat = $limit_start_sidebar_pcat + 1;
			$run_products = mysqli_query($db,$get_products);
			$count = mysqli_num_rows($run_products);
			
			if($count==0){
				echo "
					<div class = 'box'>
						<h1> Produk Tidak Ditemukan Di Dalam Kategori Produk Ini </h1>
					</div>
				";
			}
			else{
				echo "
					<div class = 'box'>
						<h1> $p_cat_title </h1>
						<p> $p_cat_desc </p>
					</div>
				";
			}
			
			while($row_products = mysqli_fetch_array($run_products)){
				$pro_id = $row_products["product_id"];
				$pro_title = $row_products["product_title"];
				$pro_price = $row_products["product_price"];
				$pro_img1 = $row_products["product_img1"];
				$no_sidebar_pcat;
				
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
				$no_sidebar_pcat++;
			}
			echo "<center><ul class = 'pagination'>";
				if($page_sidebar_pcat == 1){
					echo "<li class = 'disabled'><a href = '#' title = 'Halaman Pertama'> Halaman Pertama </a></li>";
					echo "<li class = 'disabled'><a href = '#'>&laquo;</a></li>";
				}
				else{
					$link_prev_sidebar_pcat = ($page_sidebar_pcat > 1)? $page_sidebar_pcat - 1 : 1;
					echo "<li><a href = 'shop.php?p_cat=$p_cat_id&page=1'> Halaman Pertama </a><li>";
					echo "<li><a href = 'shop.php?p_cat=$p_cat_id&page=$link_prev_sidebar_pcat'>&laquo;</a></li>";
				}

				$sql_sidebar_pcat = mysqli_query($db, "SELECT COUNT(*) AS jumlah_sidebar FROM products WHERE p_cat_id = '$p_cat_id'");
				$get_jumlah_sidebar_pcat = mysqli_fetch_array($sql_sidebar_pcat);

				$jumlah_page_sidebar_pcat = ceil($get_jumlah_sidebar_pcat["jumlah_sidebar"] / $limit_sidebar_pcat);
				$jumlah_number_sidebar_pcat = 3;
				$start_number_sidebar_pcat = ($page_sidebar_pcat > $jumlah_number_sidebar_pcat)? $page_sidebar_pcat - $jumlah_number_sidebar_pcat : 1;
				$end_number_sidebar_pcat = ($page_sidebar_pcat < ($jumlah_page_sidebar_pcat - $jumlah_number_sidebar_pcat))? $page_sidebar_pcat + $jumlah_number_sidebar_pcat : $jumlah_page_sidebar_pcat;

				for($i = $start_number_sidebar_pcat; $i <= $end_number_sidebar_pcat; $i++){
					$link_active_sidebar_pcat = ($page_sidebar_pcat == $i)? ' class = "active"' : '';
					echo "<li $link_active_sidebar_pcat><a href = 'shop.php?p_cat=$p_cat_id&page=$i' title = '$i'> $i </a></li>";
				}

				if($page_sidebar_pcat == $jumlah_page_sidebar_pcat){
					echo "<li class = 'disabled'><a href = '#'>&raquo;</a></li>";
					echo "<li class = 'disabled'><a href = '#' title = 'Halaman Terakhir'> Halaman Terakhir </a></li>";
				}
				else{
					$link_next_sidebar_pcat = ($page_sidebar_pcat < $jumlah_page_sidebar_pcat)? $page_sidebar_pcat + 1 : $jumlah_page_sidebar_pcat;
					echo "<li><a href = 'shop.php?p_cat=$p_cat_id&page=$link_next_sidebar_pcat'>&raquo;</a></li>";
					echo "<li><a href = 'shop.php?p_cat=$p_cat_id&page=$jumlah_page_sidebar_pcat'> Halaman Terakhir </a></li>";
				}
				echo "</ul></center>";
			}
		}
	
	function getcatpro(){
		global $db;
		
		if(isset($_GET["cat"])){
			$cat_id = $_GET["cat"];
			$get_cat = "SELECT * FROM categories WHERE cat_id = '$cat_id'";
			$run_cat = mysqli_query($db,$get_cat);
			$row_cat = mysqli_fetch_array($run_cat);
			$page_sidebar_cat = (isset($_GET["page"])) ? $_GET["page"] : 1;
			$limit_sidebar_cat = 6;
			$limit_start_sidebar_cat = ($page_sidebar_cat - 1) * $limit_sidebar_cat;
			$cat_title = $row_cat["cat_title"];
			$cat_desc = $row_cat["cat_desc"];
			$get_cat = "SELECT * FROM products WHERE cat_id = '$cat_id' ORDER BY product_title ASC LIMIT ".$limit_start_sidebar_cat.",".$limit_sidebar_cat;
			$run_products = mysqli_query($db,$get_cat);
			$count = mysqli_num_rows($run_products);
			$no_sidebar_cat = $limit_start_sidebar_cat + 1;
			
			if($count==0){
				echo "
					<div class = 'box'>
						<h1> Tidak Ada Produk Yang Ditemukan Di Kategori Ini </h1>
					</div>
				";
			}
			else{
				echo "
					<div class = 'box'>
						<h1> $cat_title </h1>
						<p> $cat_desc </p>
					</div>
				";
			}
			
			while($row_products = mysqli_fetch_array($run_products)){
				$pro_id = $row_products["product_id"];
				$pro_title = $row_products["product_title"];
				$pro_price = $row_products["product_price"];
				$pro_desc = $row_products["product_desc"];
				$pro_img1 = $row_products["product_img1"];
				$no_sidebar_cat;
				
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
				$no_sidebar_cat++;
			}
			echo "<center><ul class = 'pagination'>";
				if($page_sidebar_cat == 1){
					echo "<li class = 'disabled'><a href = '#'> Halaman Pertama </a></li>";
					echo "<li class = 'disabled'><a href = '#'>&laquo;</a></li>";
				}
				else{
					$link_prev_sidebar_cat = ($page_sidebar_cat > 1)? $page_sidebar_cat - 1 : 1;
					echo "<li><a href = 'shop.php?cat=$cat_id&page=1'> Halaman Pertama </a><li>";
					echo "<li><a href = 'shop.php?cat=$cat_id&page=$link_prev_sidebar_cat'>&laquo;</a></li>";
				}

				$sql_sidebar_cat = mysqli_query($db, "SELECT COUNT(*) AS jumlah_sidebar FROM products WHERE cat_id = '$cat_id'");
				$get_jumlah_sidebar_cat = mysqli_fetch_array($sql_sidebar_cat);

				$jumlah_page_sidebar_cat = ceil($get_jumlah_sidebar_cat["jumlah_sidebar"] / $limit_sidebar_cat);
				$jumlah_number_sidebar_cat = 3;
				$start_number_sidebar_cat = ($page_sidebar_cat > $jumlah_number_sidebar_cat)? $page_sidebar_cat - $jumlah_number_sidebar_cat : 1;
				$end_number_sidebar_cat = ($page_sidebar_cat < ($jumlah_page_sidebar_cat - $jumlah_number_sidebar_cat))? $page_sidebar_cat + $jumlah_number_sidebar_cat : $jumlah_page_sidebar_cat;

				for($i = $start_number_sidebar_cat; $i <= $end_number_sidebar_cat; $i++){
					$link_active_sidebar_cat = ($page_sidebar_cat == $i)? ' class = "active"' : '';
					echo "<li $link_active_sidebar_cat><a href = 'shop.php?cat=$cat_id&page=$i'> $i </a></li>";
				}

				if($page_sidebar_cat == $jumlah_page_sidebar_cat){
					echo "<li class = 'disabled'><a href = '#'>&raquo;</a></li>";
					echo "<li class = 'disabled'><a href = '#'> Halaman Terakhir </a></li>";
				}
				else{
					$link_next_sidebar_cat = ($page_sidebar_cat < $jumlah_page_sidebar_cat)? $page_sidebar_cat + 1 : $jumlah_page_sidebar_cat;
					echo "<li><a href = 'shop.php?cat=$cat_id&page=$link_next_sidebar_cat'>&raquo;</a></li>";
					echo "<li><a href = 'shop.php?cat=$cat_id&page=$jumlah_page_sidebar_cat'> Halaman Terakhir </a></li>";
				}
				echo "</ul></center>";
		}
	}
?>