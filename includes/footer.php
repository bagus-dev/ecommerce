<div id = "footer"><!-- footer Begin -->
	<div class = "container"><!-- container Begin -->
		<div class = "row"><!-- row Begin -->
			<div class = "col-sm-6 col-md-3"><!-- col-sm-6 col-md-3 Begin -->
				<h4> Halaman </h4>
				<ul><!-- ul Begin -->
					<li><a href = "cart.php"> Troli Belanja </a></li>
					<li><a href = "contact.php"> Hubungi Kami </a></li>
					<li><a href = "shop.php"> Berbelanja </a></li>
					<li><a href = "customer/my_account.php"> Akun Saya </a></li>
				</ul><!-- ul Finish -->
				<hr>
				<h4> Bagian Pengguna </h4>
				<ul><!-- ul Begin -->
					<?php
						if(!isset($_SESSION["customer_email"])){
							echo "<a href = 'checkout.php'> Masuk </a>";
						}
						else{
							echo "<a href = 'customer/my_account.php?my_orders'> Akun Saya </a>";
						}
					?>
					<li>
						<?php
							if(!isset($_SESSION["customer_email"])){
								echo "<a href = 'checkout.php'> Masuk </a>";
							}
							else{
								echo "<a href = 'customer/my_account.php?edit_account'> Edit Akun </a>";
							}
						?>
					</li>
				</ul><!-- ul Finish -->
				<hr class = "hidden-md hidden-lg hidden-sm">
			</div><!-- col-sm-6 col-md-3 Finish -->
			<div class = "com-sm-6 col-md-3"><!-- com-sm-6 col-md-3 Begin -->
				<h4> Kategori Produk Teratas </h4>
				<ul><!-- ul Begin -->
					<?php
						$get_p_cats = "SELECT * FROM product_categories";
						$run_p_cats = mysqli_query($con,$get_p_cats);
						while($row_p_cats = mysqli_fetch_array($run_p_cats)){
							$p_cat_id = $row_p_cats["p_cat_id"];
							$p_cat_title = $row_p_cats["p_cat_title"];
							
							echo "
								<li>
									<a href = 'shop.php?p_cat=$p_cat_id'>
										$p_cat_title
									</a>
								</li>
								";
						}
					?>
				</ul><!-- ul Finish -->
				<hr class = "hidden-md hidden-lg">
			</div><!-- com-sm-6 col-md-3 Finish -->
			<div class = "col-sm-6 col-md-3"><!-- col-sm-6 col-md-3 Begin -->
				<h4> Cari Kami </h4>
				<p><!-- p Start -->
					<strong> E-Commerce Store </strong>
					<br> Serang
					<br> 0895-0745-6916
					<br> bagus.rahardjo6@gmail.com
					<br><strong> Bagus Puji Rahardjo </strong>
				</p><!-- p Finish -->
				<a href = "contact.php"> Periksa Halaman Kontak Kami </a>
				<hr class = "hidden-md hidden-lg">
			</div><!-- col-sm-6 col-md-3 Finish -->
			<div class = "col-sm-6 col-md-3"><!-- col-sm-6 col-md-3 Begin -->
				<h4> Dapatkan Berita </h4>
				<p class = "text-muted"> Jangan lewatkan produk terbaru kami. </p>
				<form action="https://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('https://feedburner.google.com/fb/a/mailverify?uri=PembelajaranPemrograman', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true"><!-- form Begin -->
					<div class = "input-group"><!-- input-group Begin -->
						<input type = "email" placeholder = "Alamat Email" class = "form-control" name = "email" required>
						<input type="hidden" value="PembelajaranPemrograman" name="uri"/><input type="hidden" name="loc" value="en_US"/>
						<span class = "input-group-btn"><!-- input-group-btn Begin -->
							<input type = "submit" value = "Berlangganan" class = "btn btn-default">
						</span><!-- input-group-btn Finish -->
					</div><!-- input-group Finish -->
				</form><!-- form Finish -->
				<hr>
				<h4> Sosial Media Kami </h4>
				<p class = "social">
					<a href = "#" class = "fa fa-facebook"></a>
					<a href = "#" class = "fa fa-twitter"></a>
					<a href = "#" class = "fa fa-instagram"></a>
					<a href = "#" class = "fa fa-google-plus"></a>
					<a href = "#" class = "fa fa-envelope"></a>
				</p>
			</div><!-- col-sm-6 col-md-3 Finish -->
		</div><!-- row Finish -->
	</div><!-- container Finish -->
</div><!-- footer Finish -->
<div id = "copyright"><!-- #copyright Begin -->
	<div class = "container"><!-- container Begin -->
		<div class = "col-md-6"><!-- col-md-6 Begin -->
			<p class = "pull-left">&copy; 2018 E-Commerce Store All Rights Reserved </p>
		</div><!-- col-md-6 Finish -->
		<div class = "col-md-6"><!-- col-md-6 Begin -->
			<p class = "pull-right"> Theme by: <a href = "#"> E-Commerce Store </a></p>
		</div><!-- col-md-6 Finish -->
	</div><!-- container Finish -->
</div><!-- #copyright Finish -->