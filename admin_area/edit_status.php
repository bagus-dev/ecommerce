<?php
	if(!isset($_SESSION["admin_email"])){
        echo "<script>window.open('login.php','_self')</script>";
    }
    else{
        if(isset($_GET["edit_status"])){
            $edit_id = $_GET["edit_status"];
            $get_payment = "SELECT * FROM payments WHERE payment_id = '$edit_id'";
            $run_edit = mysqli_query($con,$get_payment);
            $row_edit = mysqli_fetch_array($run_edit);

            $payment_id = $row_edit["payment_id"];
            $invoice_no = $row_edit["invoice_no"];
            $amount = $row_edit["amount"];
            $payment_mode = $row_edit["payment_mode"];
            $ref_no = $row_edit["ref_no"];
            $code = $row_edit["code"];
            $payment_date = $row_edit["payment_date"];
            $payment_image = $row_edit["payment_image"];
            $payment_status = $row_edit["payment_status"];
        }

        $get_p_orders = "SELECT order_status FROM pending_orders WHERE invoice_no = '$invoice_no' AND order_status = '$payment_status'";
        $run_p_orders = mysqli_query($con,$get_p_orders);
        $row_p_orders = mysqli_fetch_array($run_p_orders);
        $p_orders_status = $row_p_orders["order_status"];
        $get_c_orders = "SELECT order_status FROM customer_orders WHERE invoice_no = '$invoice_no' AND order_status = '$payment_status'";
        $run_c_orders = mysqli_query($con,$get_c_orders);
        $row_c_orders = mysqli_fetch_array($run_c_orders);
        $c_orders_status = $row_c_orders["order_status"];

        $checked_accepted = ""; $checked_delivery = ""; $checked_invalid = ""; $checked_packing = ""; $checked_complete = "";
        switch($payment_status){
            case "Tidak Valid": $checked_invalid = "checked"; break;
            case "Complete": $checked_complete = "checked"; break;
            case "Dalam Proses Pengepakan": $checked_packing = "checked"; break;
            case "Dalam Pengiriman": $checked_delivery = "checked"; break;
            case "Telah Diterima": $checked_accepted = "checked"; break;
        }
?>
	<div class = "row"><!-- row Begin -->
		<div class = "col-lg-12"><!-- col-lg-12 Begin -->
			<h1 class = "page-header"> Dasbor </h1>
			<ol class = "breadcrumb"><!-- breadcrumb Begin -->
				<li class = "active"><!-- active Begin -->
					<i class = "fa fa-dashboard"></i> <a href = "index.php?dashboard">Dasbor</a> > Perbarui Status Pembayaran dan Pesanan
				</li><!-- active Finish -->
			</ol><!-- breadcrumb Finish -->
		</div><!-- col-lg-12 Finish -->
	</div><!-- row Finish -->
	<div class = "row"><!-- row Begin -->
		<div class = "col-lg-12"><!-- col-lg-12 Begin -->
			<div class = "panel panel-red"><!-- panel panel-red Begin -->
				<div class = "panel-heading"><!-- panel-heading Begin -->
					<h3 class = "panel-title"><!-- panel-title Begin -->
						<i class = "fa fa-money fa-fw"></i> Perbarui Status Pembayaran dan Pesanan
					</h3><!-- panel-title Finish -->
				</div><!-- panel-heading Finish -->
				<div class = "panel-body"><!-- panel-body Begin -->
					<form method = "post" class = "form-horizontal" enctype = "multipart/form-data"><!-- form-horizontal Begin -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> No. Pembayaran </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "payment_id" type = "text" class = "form-control" value = "<?php echo $payment_id; ?>" readonly>
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> No. Faktur </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "invoice_no" type = "text" class = "form-control" value = "<?php echo $invoice_no; ?>" readonly>
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Jumlah Pembayaran </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "amount" type = "text" class = "form-control" value = "<?php echo $amount; ?>" readonly>
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Mode Pembayaran </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "payment_mode" type = "text" class = "form-control" value = "<?php echo $payment_mode; ?>" readonly>
							</div><!-- col-md-6 Finish -->
                        </div><!-- form-group Finish -->
                        <div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Transaksi / Referensi ID </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "ref_no" type = "text" class = "form-control" value = "<?php echo $ref_no; ?>" readonly>
							</div><!-- col-md-6 Finish -->
                        </div><!-- form-group Finish -->
                        <div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Paypal / Payoneer / Western Union </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "code" type = "text" class = "form-control" value = "<?php echo $code; ?>" readonly>
							</div><!-- col-md-6 Finish -->
                        </div><!-- form-group Finish -->
                        <div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Waktu Pembayaran </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "payment_date" type = "text" class = "form-control" value = "<?php echo $payment_date; ?>" readonly>
							</div><!-- col-md-6 Finish -->
                        </div><!-- form-group Finish -->
                        <div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Bukti Pembayaran </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
                                <a class = "example-image-link" href = "../customer/payment_images/<?php echo $payment_image; ?>" data-lightbox = "example-set" data-title = "Pembayaran <?php echo $invoice_no; ?>"><img class = "thumbnail img-responsive" width = "200" height = "200" src = "../customer/payment_images/<?php echo $payment_image; ?>"></a>
							</div><!-- col-md-6 Finish -->
                        </div><!-- form-group Finish -->
                        <div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"> Status Pemesanan </label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
                                <input name = "status_order" type = "radio" class = "form-check-input" value = "Tidak Valid" <?php echo $checked_invalid ?>> Tidak Valid
                                <br><input name = "status_order" type = "radio" class = "form-check-input" value = "Complete" <?php echo $checked_complete ?>> Complete
                                <br><input name = "status_order" type = "radio" class = "form-check-input" value = "Dalam Proses Pengepakan" <?php echo $checked_packing ?>> Dalam Proses Pengepakan
                                <br><input name = "status_order" type = "radio" class = "form-check-input" value = "Dalam Pengiriman" <?php echo $checked_delivery ?>> Dalam Pengiriman
                                <br><input name = "status_order" type = "radio" class = "form-check-input" value = "Telah Diterima" <?php echo $checked_accepted ?>> Telah Diterima
							</div><!-- col-md-6 Finish -->
                        </div><!-- form-group Finish -->
						<div class = "form-group"><!-- form-group Begin -->
							<label class = "col-md-3 control-label"></label>
							<div class = "col-md-6"><!-- col-md-6 Begin -->
								<input name = "update_status" value = "Perbarui Status" type = "submit" class = "btn btn-primary form-control">
							</div><!-- col-md-6 Finish -->
						</div><!-- form-group Finish -->
					</form><!-- form-horizontal Finish -->
				</div><!-- panel-body Finish -->
			</div><!-- panel panel-red Finish -->
		</div><!-- col-lg-12 Finish -->
	</div><!-- row Finish -->
<script src = "js/tinymce/tinymce.min.js"></script>
<script> tinymce.init({ selector: 'textarea' }); </script>
</body>
</html>
<?php
	if(isset($_POST["update_status"])){
        $payment_status = $_POST["status_order"];

        $update_payment = "UPDATE payments SET payment_status = '$payment_status' WHERE payment_id = '$payment_id'";
        $run_payment = mysqli_query($con,$update_payment);

        $update_p_orders = "UPDATE pending_orders SET order_status = '$payment_status' WHERE invoice_no = '$invoice_no' AND order_status = '$p_orders_status'";
        $run_p_orders = mysqli_query($con,$update_p_orders);

        $update_c_orders = "UPDATE customer_orders SET order_status = '$payment_status' WHERE invoice_no = '$invoice_no' AND due_amount = '$amount'";
        $run_c_orders = mysqli_query($con,$update_c_orders);

        if($run_c_orders){
            echo "<script>alert('Status Pesanan di Perbarui Dengan Sukses.')</script>";
            echo "<script>window.open('index.php?view_payments','_self')</script>";
        }
    }
}
?>