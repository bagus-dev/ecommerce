<?php
	$page = (isset($_GET["page"])) ? $_GET["page"] : 1;
	$limit = 10;
	$limit_start = ($page - 1) * $limit;
	$customer_session = $_SESSION["customer_email"];
	$get_customer = "SELECT * FROM customers WHERE customer_email = '$customer_session'";
	$run_customer = mysqli_query($con,$get_customer);
	$row_customer = mysqli_fetch_array($run_customer);
	$customer_id = $row_customer["customer_id"];
	$query = mysqli_query($con, "SELECT * FROM customer_orders WHERE customer_id = '$customer_id' LIMIT ".$limit_start.",".$limit);
	$no = $limit_start + 1;

	if(!$query){
		die("Query Error: ".mysqli_errno($con)." - ".mysqli_error($con));
	}
?>
<center><!-- center Begin -->
	<h1> Pesanan Saya </h1>
	<p class = "lead"> Pesanan anda dalam satu tempat </p>
	<p class = "text-muted">
		Jika anda memiliki pertanyaan, jangan ragu untuk <a href = "../contact.php"> Menghubungi Kami</a>. Layanan Pelanggan Kami bekerja <strong> 24/7 </strong>
	</p>
</center><!-- center Finish -->
<hr>
<div class = "table-responsive"><!-- table-responsive Begin -->
	<table class = "table table-bordered table-hover"><!-- table table-bordered table-hover Begin -->
		<thead><!-- thead Begin -->
			<tr><!-- tr Begin -->
				<th> NO: </th>
				<th> Jumlah Total: </th>
				<th> No Faktur: </th>
				<th> Kuantitas: </th>
				<th> Ukuran: </th>
				<th> Tanggal Pesanan: </th>
				<th> Dibayar / Tidak: </th>
				<th> Status: </th>
			</tr><!-- tr Finish -->
		</thead><!-- thead Finish -->
		<tbody><!-- tbody Begin -->
		<?php

			while($row_orders = mysqli_fetch_array($query)){
				$order_id = $row_orders["order_id"];
				$due_amount = $row_orders["due_amount"];
				$invoice_no = $row_orders["invoice_no"];
				$qty = $row_orders["qty"];
				$size = $row_orders["size"];
				$date = substr($row_orders["order_date"],8,2);
				$month = substr($row_orders["order_date"],5,2);
				$year = substr($row_orders["order_date"],0,4);
				$order_date = $date." - ".$month." - ".$year;
				$order_status = $row_orders["order_status"];
				if($order_status == "pending"){
					$paid = "Tidak";
				}
				elseif($order_status == "Tidak Valid"){
					$paid = "Pembayaran Tidak Valid";
				}
				else{
					$paid = "Dibayar";
				}
		?>
			<tr><!-- tr Begin -->
				<th><?php echo $no; ?></th>
				<td><?php
					if($due_amount < 1000000 AND $due_amount >= 500000){
						$due_amount1 = substr($due_amount,0,3);
						$due_amount2 = substr($due_amount,-3);
						echo "Rp.".$due_amount1.".".$due_amount2;
					}
					else if($due_amount >= 1000000 AND $due_amount < 10000000){
						$due_amount1 = substr($due_amount,0,1);
						$due_amount2 = substr($due_amount,1,3);
						$due_amount3 = substr($due_amount,-3);
						echo "Rp.".$due_amount1.".".$due_amount2.".".$due_amount3;
					}
					else if($due_amount >= 10000000){
						$due_amount1 = substr($due_amount,0,2);
						$due_amount2 = substr($due_amount,2,3);
						$due_amount3 = substr($due_amount,-3);
						echo "Rp.".$due_amount1.".".$due_amount2.".".$due_amount3.",00";
					}
					else{
						echo "Rp.".$due_amount;
					}
				?></td>
				<td><?php echo $invoice_no; ?></td>
				<td><?php echo $qty; ?></td>
				<td><?php echo $size; ?></td>
				<td><?php echo $order_date; ?></td>
				<td><?php echo $paid; ?></td>
				<td>
					<?php
						if($order_status == "pending"){
					?>
					<a href = "confirm.php?order_id=<?php echo $order_id; ?>" target = "_blank" class = "btn btn-primary btn-sm"> Konfirmasi Pembayaran </a>
					<?php
						}
						elseif($order_status == "Telah Diterima"){
							echo $order_status.", terima kasih telah berbelanja di <a href = '../index.php'>E-Commerce Store</a>";
						}
						elseif($order_status == "Tidak Valid"){
							$payment_query = "SELECT payment_id FROM payments WHERE payment_status = '$order_status'";
							$run_payment = mysqli_query($con,$payment_query);
							$payment = mysqli_fetch_array($run_payment);
							$payment_id = $payment["payment_id"];
							echo "<a href = 're_confirm.php?payment_id=$payment_id' target = '_blank' class = 'btn btn-primary btn-sm'> Konfirmasi Ulang </a>";
						}
						else{
							echo $order_status;
						}
						$no++;
					?>
				</td>
			</tr><!-- tr Finish -->
			<?php } ?>
		</tbody><!-- tbody Finish -->
	</table><!-- table table-bordered table-hover Finish -->
	<center>
			<ul class ="pagination">
			<!-- LINK FIRST AND PREV -->
			<?php
				if($page == 1){
			?>
				<li class = "disabled"><a href = "#"> Halaman Pertama </a></li>
				<li class = "disabled"><a href = "#">&laquo;</a></li>
			<?php
				}
				else{
					$link_prev = ($page > 1)? $page - 1 : 1;
			?>
				<li><a href = "my_account.php?my_orders&page=1"> Halaman Pertama </a></li>
				<li><a href = "my_account.php?my_orders&page=<?php echo $link_prev; ?>">&laquo;</a></li>
			<?php
				}
			?>
			
			<!-- LINK NUMBER -->
			<?php
				// Buat query untuk menghitung semua jumlah data
				$sql2 = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM customer_orders WHERE customer_id = '$customer_id'");
				$get_jumlah = mysqli_fetch_array($sql2);
				
				$jumlah_page = ceil($get_jumlah['jumlah'] / $limit);
				$jumlah_number = 3;
				$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
				$end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page;
				
				for($i = $start_number; $i <= $end_number; $i++){
					$link_active = ($page == $i)? ' class="active"' : '';
			?>
				<li <?php echo $link_active; ?>><a href = "my_account.php?my_orders&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			<?php
				}
			?>
			
			<!-- LINK NEXT AND LAST -->
			<?php
				// Jika page sama dengan jumlah page, maka disable link NEXT
				if($page == $jumlah_page){ // jika page terakhir
			?>
				<li class = "disabled"><a href = "#">&raquo;</a></li>
				<li class = "disabled"><a href = "#"> Halaman Terakhir </a></li>
			<?php
				}
				else{
					$link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
			?>
				<li><a href = "my_account.php?my_orders&page=<?php echo $link_next; ?>">&raquo;</a></li>
				<li><a href = "my_account.php?my_orders&page=<?php echo $jumlah_page; ?>"> Halaman Terakhir </a></li>
			<?php
				}
			?>
			</ul>
	</center>
</div><!-- table-responsive Finish -->