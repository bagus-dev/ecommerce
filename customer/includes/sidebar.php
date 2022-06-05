<div class = "panel panel-default sidebar-menu"><!-- panel panel-default sidebar-menu Begin -->
	<div class = "panel-heading"><!-- panel-heading Begin -->
		<?php
			$customer_session = $_SESSION["customer_email"];
			$get_customer = "SELECT * FROM customers WHERE customer_email = '$customer_session'";
			$run_customer = mysqli_query($con,$get_customer);
			$row_customer = mysqli_fetch_array($run_customer);
			$customer_image = $row_customer["customer_image"];
			$customer_name = $row_customer["customer_name"];

			if(!isset($_SESSION["customer_email"])){

			}
			else{
				echo "
					<center>
						<a class = 'example-image-link' href = 'customer_images/$customer_image' data-lightbox = 'example-set' data-title = '$nama[customer_name]'>
							<img src = 'customer_images/$customer_image' class = 'img-responsive'>
						</a>
					</center>
					<br>
					<h3 class = 'panel-title' align = 'center'>
						Nama: $customer_name
					</h3>
				";
			}
		?>
	</div><!-- panel-heading Finish -->
	<div class = "panel-body"><!-- panel-body Begin -->
		<ul class = "nav-pills nav-stacked nav"><!-- nav-pills nav-stacked nav -->
			<li class = "<?php if(isset($_GET["my_orders"])){echo"active"; } ?>">
				<a href = "my_account.php?my_orders">
					<i class = "fa fa-list"></i> Pesanan Saya
				</a>
			</li>
			<li class = "<?php if(isset($_GET["edit_account"])){echo"active"; } ?>">
				<a href = "my_account.php?edit_account">
					<i class = "fa fa-pencil"></i> Edit Akun
				</a>
			</li>
			<li class = "<?php if(isset($_GET["change_pass"])){echo"active"; } ?>">
				<a href = "my_account.php?change_pass">
					<i class = "fa fa-user"></i> Ubah Kata Sandi
				</a>
			</li>
			<li class = "<?php if(isset($_GET["delete_account"])){echo"active"; } ?>">
				<a href = "my_account.php?delete_account">
					<i class = "fa fa-trash"></i> Hapus Akun
				</a>
			</li>
			<li>
				<a href = "logout.php">
					<i class = "fa fa-sign-out"></i> Keluar
				</a>
			</li>
		</ul>
	</div><!-- panel-body Finish -->
</div><!-- panel panel-default sidebar-menu Finish -->