<?php
	$active = "Cart";
	include("includes/header.php");
	
	$lama = 1;

	$query_delete = "DELETE FROM cart WHERE DATEDIFF(CURDATE(), date) >= $lama";
	$result_delete = mysqli_query($con,$query_delete);
?>
	<div id = "content"><!-- content Begin -->
		<div class = "container"><!-- container Begin -->
			<div class = "col-md-12"><!-- col-md-12 Begin -->
				<ul class = "breadcrumb"><!-- breadcrumb Begin -->
					<li>
						<a href = "index.php"> Beranda </a>
					</li>
					<li> Troli </li>
				</ul><!-- breadcrumb Finish -->
			</div><!-- col-md-12 Finish -->
			<div id = "cart" class = "col-md-9"><!-- col-md-9 Begin -->
				<div class = "box"><!-- box Begin -->
					<form action = "cart.php" method = "post" enctype = "multipart/form-data"><!-- form Begin -->
						<h1> Troli Belanja </h1>
						<?php
							$ip_add = getRealIpUser();
							$select_cart = "SELECT * FROM cart where ip_add = '$ip_add'";
							$run_cart = mysqli_query($con,$select_cart);
							$count = mysqli_num_rows($run_cart);
						?>
						<p class = "text-muted"> Saat ini anda memiliki <?php echo $count; ?> barang di Troli </p>
						<div class = "table-responsive"><!-- table-responsive Begin -->
							<table class = "table"><!-- table Begin -->
								<thead><!-- thead Begin -->
									<tr><!-- tr Begin -->
										<th colspan = "2"> Produk </th>
										<th> Jumlah </th>
										<th> Harga Per Unit </th>
										<th> Ukuran </th>
										<th colspan = "1"> Hapus </th>
										<th colspan = "2"> Sub-Total </th>
									</tr><!-- tr Finish -->
								</thead><!-- thead Finish -->								
								<tbody><!-- tbody Begin -->
									<?php
										$total = 0;
										while($row_cart = mysqli_fetch_array($run_cart)){
											$pro_id = $row_cart["p_id"];
											$pro_size = $row_cart["size"];
											$pro_qty = $row_cart["qty"];
											$get_products = "SELECT * FROM products WHERE product_id = '$pro_id'";
											$run_products = mysqli_query($con,$get_products);
											
											while($row_products = mysqli_fetch_array($run_products)){
												$product_title = $row_products["product_title"];
												$product_img1 = $row_products["product_img1"];
												$only_price = $row_products["product_price"];
												$sub_total = $row_products["product_price"] * $pro_qty;
												
												$total += $sub_total;
									?>
									<tr><!-- tr Begin -->
										<td>
											<img class = "img-responsive" src = "admin_area/product_images/<?php echo $product_img1; ?>" alt = "Product Image 1">
										</td>
										<td>
											<a href = "details.php?pro_id=<?php echo $pro_id; ?>"><?php echo $product_title; ?></a>
										</td>
										<td>
											<?php echo $pro_qty; ?>
										</td>
										<td>
											<?php
												if($only_price < 1000000 AND $only_price >= 500000){
													$only_price1 = substr($only_price,0,3);
													$only_price2 = substr($only_price,-3);
													echo "Rp.".$only_price1.".".$only_price2.",00";
												}
												else if($only_price >= 1000000 AND $only_price < 10000000){
													$only_price1 = substr($only_price,0,1);
													$only_price2 = substr($only_price,1,3);
													$only_price3 = substr($only_price,-3);
													echo "Rp.".$only_price1.".".$only_price2.".".$only_price3.",00";
												}
												else if($only_price >= 10000000){
													$only_price1 = substr($only_price,0,2);
													$only_price2 = substr($only_price,2,3);
													$only_price3 = substr($only_price,-3);
													echo "Rp.".$only_price1.".".$only_price2.".".$only_price3.",00";
												}
												else{
													echo "Rp.".$only_price;
												}
											?>
										</td>
										<td>
											<?php echo $pro_size; ?>
										</td>
										<td>
											<input type = "checkbox" name = "remove[]" value = "<?php echo $pro_id; ?>">
										</td>
										<td>
											<?php
												if($sub_total < 1000000 AND $sub_total >= 500000){
													$sub_total1 = substr($sub_total,0,3);
													$sub_total2 = substr($sub_total,-3);
													echo "Rp.".$sub_total1.".".$sub_total2.",00";
												}
												else if($sub_total >= 1000000 AND $sub_total < 10000000){
													$sub_total1 = substr($sub_total,0,1);
													$sub_total2 = substr($sub_total,1,3);
													$sub_total3 = substr($sub_total,-3);
													echo "Rp.".$sub_total1.".".$sub_total2.".".$sub_total3.",00";
												}
												else if($sub_total >= 10000000){
													$sub_total1 = substr($sub_total,0,2);
													$sub_total2 = substr($sub_total,2,3);
													$sub_total3 = substr($sub_total,-3);
													echo "Rp.".$sub_total1.".".$sub_total2.".".$sub_total3.",00";
												}
												else{
													echo "Rp.".$sub_total;
												}
											?>
										</td>
									</tr><!-- tr Finish -->
									<?php
											}
										}
									?>
								</tbody><!-- tbody Finish -->
								<tfoot><!-- tfoot Begin -->
									<tr><!-- tr Begin -->
										<th colspan = "5"> Total </th>
										<th colspan = "2"><?php
											if($total < 1000000 AND $total >= 500000){
												$total1 = substr($total,0,3);
												$total2 = substr($total,-3);
												echo "Rp.".$total1.".".$total2.",00";
											}
											else if($total >= 1000000 AND $total < 10000000){
												$total1 = substr($total,0,1);
												$total2 = substr($total,1,3);
												$total3 = substr($total,-3);
												echo "Rp.".$total1.".".$total2.".".$total3.",00";
											}
											else if($total >= 10000000){
												$total1 = substr($total,0,2);
												$total2 = substr($total,2,3);
												$total3 = substr($total,-3);
												echo "Rp.".$total1.".".$total2.".".$total3.",00";
											}
											else{
												echo "Rp.".$total;
											}
										?></th>
									</tr><!-- tr Finish -->
								</tfoot><!-- tfoot Finish -->
							</table><!-- table Finish -->
						</div><!-- table-responsive Finish -->
						<div class = "box-footer"><!-- box-footer Begin -->
							<div class = "pull-left"><!-- pull-left Begin -->
								<a href = "index.php" class = "btn btn-default"><!-- btn btn-default Begin -->
									<i class = "fa fa-chevron-left"></i> Lanjutkan Belanja
								</a><!-- btn btn-default Finish -->
							</div><!-- pull-left Finish -->
							<div class = "pull-right"><!-- pull-right Begin -->
								<button type = "submit" name = "update" value = "Update Cart" class = "btn btn-default"><!-- btn btn-default Begin -->
									<i class = "fa fa-refresh"></i> Perbarui Troli
								</button><!-- btn btn-default Finish -->
								<?php
									if(isset($_SESSION["customer_email"])){
       						 		$session_email = $_SESSION["customer_email"];
        							$select_customer = "SELECT * FROM customers WHERE customer_email = '$session_email'";
        							$run_customer = mysqli_query($con,$select_customer);
        							$row_customer = mysqli_fetch_array($run_customer);
        							$customer_id = $row_customer["customer_id"];
    							?>
								<a href = "order.php?c_id=<?php echo $customer_id ?>" class = "btn btn-primary">
									Lakukan Checkout <i class = "fa fa-chevron-right"></i>
								</a>
								<?php
									}
									else{
								?>
								<a href = "checkout.php" class = "btn btn-primary">
									Lakukan Checkout <i class = "fa fa-chevron-right"></i>
								</a>
								<?php
									}
								?>
							</div><!-- pull-right Finish -->
						</div><!-- box-footer Finish -->
					</form><!-- form Finish -->
				</div><!-- box Finish -->
				<?php
						if(isset($_POST["update"])){
							foreach($_POST["remove"] as $remove_id){
								$delete_product = "DELETE FROM cart WHERE p_id='$remove_id'";
								$run_delete = mysqli_query($con,$delete_product);
								
								if($run_delete){
									echo "<script>window.open('cart.php','_self')</script>";
								}
							}
						}
				?>
				<div id = "row same-heigh-row"><!-- #row same-heigh-row Begin -->
					<div class = "col-md-3 col-sm-6"><!-- col-md-3 col-sm-6 Begin -->
						<div class = "box same-height headline"><!-- box same-height headline Begin -->
							<h3 class = "text-center"> Produk Yang Mungkin Anda Sukai </h3>
						</div><!-- box same-height headline Finish -->
					</div><!-- col-md-3 col-sm-6 Finish -->
					<?php
						$get_products = "SELECT * FROM products ORDER BY RAND() LIMIT 0,3";
						$run_products = mysqli_query($con,$get_products);
						
						while($row_products = mysqli_fetch_array($run_products)){
							$pro_id = $row_products["product_id"];
							$pro_title = $row_products["product_title"];
							$pro_price = $row_products["product_price"];
							$pro_img1 = $row_products["product_img1"];
							
							echo "
					<div class = 'col-md-3 col-sm-6 center-responsive'><!-- col-md-3 col-sm-6 center-responsive Begin -->
						<div class = 'product same-height'><!-- product same-height Begin -->
							<a href = 'details.php?pro_id=$pro_id'>
								<img class = 'img-responsive' src = 'admin_area/product_images/$pro_img1' alt = 'Product Image 1'>
							</a>
							<div class = 'text'><!-- text Begin -->
								<h3><a href = 'details.php?pro_id=$pro_id'> $pro_title </a></h3>
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
							else{
								echo "Rp.".$pro_price;
							}
							echo "
								</p>
							</div><!-- text Finish -->
						</div><!-- product same-height Finish -->
					</div><!-- col-md-3 col-sm-6 center-responsive Finish -->
					
							";
						}
					?>
				</div><!-- #row same-heigh-row Finish -->
			</div><!-- col-md-9 Finish -->
			<div class = "col-md-3"><!-- col-md-3 Begin -->
				<div id = "order-summary" class = "box"><!-- box Begin -->
					<div class = "box-header"><!-- box-header Begin -->
						<h3> Ringkasan Pesanan </h3>
					</div><!-- box-header Finish -->
					<p class = "text-muted"><!-- text-muted Begin -->
						Pengiriman dan biaya tambahan dihitung berdasarkan nilai yang Anda masukkan
					</p><!-- text-muted Finish -->
					<div class = "table-responsive"><!-- table-responsive Begin -->
						<table class = "table"><!-- table Begin -->
							<tbody><!-- tbody Begin -->
								<tr><!-- tr Begin -->
									<td>Pesanan Semua Sub-Total </td>
									<th><?php
											if($total < 1000000 AND $total >= 500000){
												$total1 = substr($total,0,3);
												$total2 = substr($total,-3);
												echo "Rp.".$total1.".".$total2.",00";
											}
											else if($total >= 1000000 AND $total < 10000000){
												$total1 = substr($total,0,1);
												$total2 = substr($total,1,3);
												$total3 = substr($total,-3);
												echo "Rp.".$total1.".".$total2.".".$total3.",00";
											}
											else if($total >= 10000000){
												$total1 = substr($total,0,2);
												$total2 = substr($total,2,3);
												$total3 = substr($total,-3);
												echo "Rp.".$total1.".".$total2.".".$total3.",00";
											}
											else{
												echo "Rp.".$total;
											}
										?></th>
								</tr><!-- tr Finish -->
								<tr><!-- tr Begin -->
									<td> Pengiriman dan Penanganan </td>
									<td>
										<?php
											if($total > 0){
												$ongkir = 7000;
												if($ongkir > 999){
													$ongkir_1 = substr($ongkir,0,1);
													$ongkir_2 = substr($ongkir,-3);
													echo "Rp.$ongkir_1".".".$ongkir_2;
												}
											}
											else{
												$ongkir = 0;
												echo "Rp.".$ongkir;
											}
										?>
									</td>
								</tr><!-- tr Finish -->
								<tr><!-- tr Begin -->
									<td> Pajak </td>
									<th> Rp.0 </th>
								</tr><!-- tr Finish -->
								<tr class = "total"><!--tr Begin -->
									<td> Total </td>
									<th><?php
											$hasil = $total + $ongkir;
											if($hasil < 1000000 AND $hasil >= 500000){
												$hasil1 = substr($hasil,0,3);
												$hasil2 = substr($hasil,-3);
												echo "Rp.".$hasil1.".".$hasil2.",00";
											}
											else if($hasil >= 1000000 AND $hasil < 10000000){
												$hasil1 = substr($hasil,0,1);
												$hasil2 = substr($hasil,1,3);
												$hasil3 = substr($hasil,-3);
												echo "Rp.".$hasil1.".".$hasil2.".".$hasil3.",00";
											}
											else if($hasil >= 10000000){
												$hasil1 = substr($hasil,0,2);
												$hasil2 = substr($hasil,2,3);
												$hasil3 = substr($hasil,-3);
												echo "Rp.".$hasil1.".".$hasil2.".".$hasil3.",00";
											}
											else{
												echo "Rp.".$hasil;
											}
										?></th>
								</tr><!-- tr Finish -->
							</tbody><!-- tbody Finish -->
						</table><!-- table Finish -->
					</div><!-- table-responsive Finish -->
				</div><!-- box Finish -->
			</div><!-- col-md-3 Finish -->
		</div><!-- container Finish -->
	</div><!-- content Finish -->
	<?php
		include("includes/footer.php");
	?>
	<script src = "js/jquery-331.min.js"></script>
	<script src = "js/bootstrap-337.min.js"></script>
</body>
</html>