<?php
    include("includes/db.php");

    if(!isset($_SESSION["admin_email"])){
        echo "<script>window.open('login.php','_self')</script>";
    }
    else{
        
?>
<div class="row"><!-- row no:1 Begin -->
    <div class="col-lg-12"><!-- col-lg-12 Begin -->
        <h1 class="page-header"> Dasbor </h1>
        <ol class="breadcrumb"><!-- breadcrumb Begin -->
            <li class="active"><!-- active Begin -->
                <i class="fa fa-dashboard"></i> Dasbor
            </li><!-- active Finish -->
        </ol><!-- breadcrumb Finish -->
    </div><!-- col-lg-12 Finish -->
</div><!-- row no:1 Finish -->
<div class="row"><!-- row no:2 Begin -->
    <div class="col-lg-3 col-md-6"><!-- col-lg3 col-md-6 Begin -->
        <div class="panel panel-primary"><!-- panel panel-primary Begin -->
            <div class="panel-heading"><!-- panel-heading Begin -->
                <div class="row"><!-- panel-heading row Begin -->
                    <div class="col-xs-3"><!-- col-xs-3 Begin -->
                        <i class="fa fa-tasks fa-5x"></i>
                    </div><!-- col-xs-3 Finish -->
                    <div class="col-xs-9 text-right"><!-- col-xs-9 text-right Begin -->
                        <div class="huge"><?php echo $count_products; ?></div>
                        <div> Produk </div>
                    </div><!-- col-xs-9 text-right Finish -->
                </div><!-- panel-heading row Finish -->
            </div><!-- panel-heading Finish -->
            <a href = "index.php?view_products"><!-- a href Begin -->
                <div class="panel-footer"><!-- panel-footer Begin -->
                    <span class="pull-left"><!-- pull-left Begin -->
                        Tampilkan Rincian
                    </span><!-- pull-left Finish -->
                    <span class="pull-right"><!-- pull-right Begin -->
                        <i class="fa fa-arrow-circle-right"></i>
                    </span><!-- pull-right Finish -->
                    <div class="clearfix"></div>
                </div><!-- panel-footer Finish -->
            </a><!-- a href Finish -->
        </div><!-- panel panel-primary Finish -->
    </div><!-- col-lg-3 col-md-6 Finish -->
    <div class="col-lg-3 col-md-6"><!-- col-lg3 col-md-6 Begin -->
        <div class="panel panel-green"><!-- panel panel-green Begin -->
            <div class="panel-heading"><!-- panel-heading Begin -->
                <div class="row"><!-- panel-heading row Begin -->
                    <div class="col-xs-3"><!-- col-xs-3 Begin -->
                        <i class="fa fa-users fa-5x"></i>
                    </div><!-- col-xs-3 Finish -->
                    <div class="col-xs-9 text-right"><!-- col-xs-9 text-right Begin -->
                        <div class="huge"><?php echo $count_customers; ?></div>
                        <div> Pelanggan </div>
                    </div><!-- col-xs-9 text-right Finish -->
                </div><!-- panel-heading row Finish -->
            </div><!-- panel-heading Finish -->
            <a href = "index.php?view_customers"><!-- a href Begin -->
                <div class="panel-footer"><!-- panel-footer Begin -->
                    <span class="pull-left"><!-- pull-left Begin -->
                        Tampilkan Rincian
                    </span><!-- pull-left Finish -->
                    <span class="pull-right"><!-- pull-right Begin -->
                        <i class="fa fa-arrow-circle-right"></i>
                    </span><!-- pull-right Finish -->
                    <div class="clearfix"></div>
                </div><!-- panel-footer Finish -->
            </a><!-- a href Finish -->
        </div><!-- panel panel-green Finish -->
    </div><!-- col-lg-3 col-md-6 Finish -->
    <div class="col-lg-3 col-md-6"><!-- col-lg3 col-md-6 Begin -->
        <div class="panel panel-orange"><!-- panel panel-orange Begin -->
            <div class="panel-heading"><!-- panel-heading Begin -->
                <div class="row"><!-- panel-heading row Begin -->
                    <div class="col-xs-3"><!-- col-xs-3 Begin -->
                        <i class="fa fa-tags fa-5x"></i>
                    </div><!-- col-xs-3 Finish -->
                    <div class="col-xs-9 text-right"><!-- col-xs-9 text-right Begin -->
                        <div class="huge"><?php echo $count_p_categories; ?></div>
                        <div> Kategori Produk </div>
                    </div><!-- col-xs-9 text-right Finish -->
                </div><!-- panel-heading row Finish -->
            </div><!-- panel-heading Finish -->
            <a href = "index.php?view_p_cats"><!-- a href Begin -->
                <div class="panel-footer"><!-- panel-footer Begin -->
                    <span class="pull-left"><!-- pull-left Begin -->
                        Tampilkan Rincian
                    </span><!-- pull-left Finish -->
                    <span class="pull-right"><!-- pull-right Begin -->
                        <i class="fa fa-arrow-circle-right"></i>
                    </span><!-- pull-right Finish -->
                    <div class="clearfix"></div>
                </div><!-- panel-footer Finish -->
            </a><!-- a href Finish -->
        </div><!-- panel panel-orange Finish -->
    </div><!-- col-lg-3 col-md-6 Finish -->
    <div class="col-lg-3 col-md-6"><!-- col-lg3 col-md-6 Begin -->
        <div class="panel panel-red"><!-- panel panel-red Begin -->
            <div class="panel-heading"><!-- panel-heading Begin -->
                <div class="row"><!-- panel-heading row Begin -->
                    <div class="col-xs-3"><!-- col-xs-3 Begin -->
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div><!-- col-xs-3 Finish -->
                    <div class="col-xs-9 text-right"><!-- col-xs-9 text-right Begin -->
                        <div class="huge"><?php echo $count_pending_orders; ?></div>
                        <div> Pesanan </div>
                    </div><!-- col-xs-9 text-right Finish -->
                </div><!-- panel-heading row Finish -->
            </div><!-- panel-heading Finish -->
            <a href = "index.php?view_orders"><!-- a href Begin -->
                <div class="panel-footer"><!-- panel-footer Begin -->
                    <span class="pull-left"><!-- pull-left Begin -->
                        Tampilkan Rincian
                    </span><!-- pull-left Finish -->
                    <span class="pull-right"><!-- pull-right Begin -->
                        <i class="fa fa-arrow-circle-right"></i>
                    </span><!-- pull-right Finish -->
                    <div class="clearfix"></div>
                </div><!-- panel-footer Finish -->
            </a><!-- a href Finish -->
        </div><!-- panel panel-red Finish -->
    </div><!-- col-lg-3 col-md-6 Finish -->
</div><!-- row no:2 Finish -->
<div class="row"><!-- row no:3 Begin -->
    <div class="col-lg-8"><!-- col-lg-8 Begin -->
        <div class="panel panel-primary"><!-- panel panel-primary Begin -->
            <div class="panel-heading"><!-- panel-heading Begin -->
                <div class="panel-title"><!-- panel-title Begin -->
                    <i class="fa fa-money fa-fw"></i> Pesanan Baru
                </div><!-- panel-title Finish -->
            </div><!-- panel-heading Finish -->
            <div class="panel-body"><!-- panel-body Begin -->
                <div class="table-responsive"><!-- table-responsive Begin -->
                    <table class="table table-hover table-striped table-bordered"><!-- table table-hover table-striped table-bordered Begin -->
                        <thead><!-- thead Begin -->
                            <tr><!-- th Begin -->
                                <th> No. Pesanan: </th>
                                <th> Email Pelanggan: </th>
                                <th> No. Faktur: </th>
                                <th> ID Produk: </th>
                                <th> Jumlah Produk: </th>
                                <th> Ukuran Produk: </th>
                                <th> Status: </th>
                            </tr><!-- th Finish -->
                        </thead><!-- thead Finish -->
                        <tbody><!-- tbody Begin -->
                            <?php
                                $i = 0;
                                $get_order = "SELECT * FROM pending_orders ORDER BY 1 DESC LIMIT 0,5";
                                $run_order = mysqli_query($con,$get_order);

                                while($row_order = mysqli_fetch_array($run_order)){
                                    $order_id = $row_order["order_id"];
                                    $c_id = $row_order["customer_id"];
                                    $invoice_no = $row_order["invoice_no"];
                                    $product_id = $row_order["product_id"];
                                    $qty = $row_order["qty"];
                                    $size = $row_order["size"];
                                    $order_status = $row_order["order_status"];
                                    $i++;
                            ?>
                            <tr><!-- tr Begin -->
                                <td><?php echo $order_id; ?></td>
                                <td>
                                    <?php
                                        $get_customer = "SELECT * FROM customers WHERE customer_id = '$c_id'";
                                        $run_customer = mysqli_query($con,$get_customer);
                                        $row_customer = mysqli_fetch_array($run_customer);
                                        $customer_email = $row_customer["customer_email"];
                                        echo $customer_email;
                                    ?>
                                </td>
                                <td><?php echo $invoice_no; ?></td>
                                <td><?php echo $product_id; ?></td>
                                <td><?php echo $qty; ?></td>
                                <td><?php echo $size; ?></td>
                                <td><?php echo $order_status; ?></td>
							</tr>
                            <?php } ?>
                        </tbody><!-- tbody Finish -->
                    </table><!-- table table-hover table-striped table-bordered Finish -->
                </div><!-- table-responsive Finish -->
                <div class="text-right"><!-- text-right Begin -->
                    <a href="index.php?view_orders"><!-- a href Begin -->
                        Tampilkan Semua Pesanan <i class="fa fa-arrow-circle-right"></i>
                    </a><!-- a href Finish -->
                </div><!-- text-right Finish -->
            </div><!-- panel-body Finish -->
        </div><!-- panel panel-primary Finish -->
    </div><!-- col-lg-8 Finish -->
    <div class="col-md-4"><!-- col-md-4 Begin -->
        <div class="panel"><!-- panel Begin -->
            <div class="panel-body"><!-- panel-body Begin -->
                <div class="thumb-info"><!-- mb-md thumb-info Begin -->
                    <a class = "example-image-link" href = "admin_images/<?php echo $admin_image; ?>" data-lightbox = "example-set" data-title = "<?php echo $admin_name; ?>"><img src="admin_images/<?php echo $admin_image; ?>" alt="<?php echo $admin_image; ?>" class="rounded img-responsive"></a>
                    <div class="thumb-info-title"><!-- thumb-info-title Begin -->
                        <span class="thumb-info-inner"> <?php echo $admin_name; ?> </span>
                        <span class="thumb-info-type"> <?php echo $admin_job; ?> </span>
                    </div><!-- thumb-info-title Finish -->
                </div><!-- mb-md thumb-info Finish -->
                <div class="mb-md"><!-- mb-md Begin -->
                    <div class="widget-content-expanded"><!-- widget-content-expanded Begin -->
                        <i class="fa fa-user"></i><span>Email:</span> <?php echo $admin_email; ?> <br>
                        <i class="fa fa-flag"></i><span>Negara: </span> <?php echo $admin_country; ?> <br>
                        <i class="fa fa-envelope"></i><span>Nomor HP: </span> <?php echo $admin_contact; ?> <br>
                    </div><!-- widget-content-expanded Finish -->
                    <hr class="dotted short">
                    <h5 class="text-muted"> Tentang Saya </h5>
                    <p><!-- p Begin -->
                        <?php echo $admin_about; ?>
                    </p><!-- p Finish -->
                </div><!-- mb-md Finish -->
            </div><!-- panel-body Finish -->
        </div><!-- panel Finish -->
    </div><!-- col-md-4 Finish -->
</div><!-- row no:3 Finish -->
<?php } ?>