<?php
    include("includes/db.php");
    include("json_customer.php");
?>
    <div class = "row"><!-- row Begin -->
        <div class = "col-lg-12"><!-- col-lg-12 Begin -->
            <h1 class = "page-header"> Dasbor </h1>
			<ol class = "breadcrumb"><!-- breadcrumb Begin -->
				<li class = "active"><!-- active Begin -->
					<i class = "fa fa-dashboard"></i> <a href = "index.php?dashboard">Dasbor</a> > Tampilkan Pelanggan
				</li><!-- active Finish -->
			</ol><!-- breadcrumb Finish -->
		</div><!-- col-lg-12 Finish -->
	</div><!-- row Finish -->
        <div class = "row"><!-- row Begin -->
            <div class = "col-lg-12"><!-- col-lg-12 Begin -->
                <div class = "panel panel-green"><!-- panel panel-green Begin -->
                    <div class = "panel-heading"><!-- panel-heading Begin -->
                        <h3 class = "panel-title"><!-- panel-title Begin -->
                            <i class = "fa fa-list-ul"></i> Tampilkan Pelanggan
                        </h3><!-- panel-title Finish -->
                    </div><!-- panel-heading Finish -->
                    <div class = "panel-body"><!-- panel-body Begin -->
                        <table id = "customers_table" class = "display"><!-- table table-bordered table-hover Begin -->
                            <thead><!-- thead Begin -->
                                <tr><!-- tr Begin -->
                                    <th></th>
                                    <th>Nama Pelanggan</th>
                                    <th>Email Pelanggan</th>
                                    <th>Negara</th>
                                    <th>Kota</th>
                                    <th>Nomor HP</th>
                                    <th>Alamat</th>
                                </tr><!-- tr Finish -->
                            </thead><!-- thead Finish -->
                            <tfoot>
                                <tr><!-- tr Begin -->
                                    <th></th>
                                    <th>Nama Pelanggan</th>
                                    <th>Email Pelanggan</th>
                                    <th>Negara</th>
                                    <th>Kota</th>
                                    <th>Nomor HP</th>
                                    <th>Alamat</th>
                                </tr><!-- tr Finish -->
                            </tfoot>
                        </table><!-- table table-bordered table-hover Finish -->
                    </div><!-- panel-body Finish -->
                </div><!-- panel panel-green Finish -->
            </div><!-- col-lg-12 Finish -->
        </div><!-- row Finish -->