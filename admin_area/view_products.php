<?php
    include("includes/db.php");
    include("json.php");
?>
    <div class = "row"><!-- row Begin -->
        <div class = "col-lg-12"><!-- col-lg-12 Begin -->
            <h1 class = "page-header"> Dasbor </h1>
			<ol class = "breadcrumb"><!-- breadcrumb Begin -->
				<li class = "active"><!-- active Begin -->
					<i class = "fa fa-dashboard"></i> <a href = "index.php?dashboard">Dasbor</a> > Tampilkan Produk
				</li><!-- active Finish -->
			</ol><!-- breadcrumb Finish -->
		</div><!-- col-lg-12 Finish -->
	</div><!-- row Finish -->
        <div class = "row"><!-- row Begin -->
            <div class = "col-lg-12"><!-- col-lg-12 Begin -->
                <div class = "panel panel-primary"><!-- panel panel-primary Begin -->
                    <div class = "panel-heading"><!-- panel-heading Begin -->
                        <h3 class = "panel-title"><!-- panel-title Begin -->
                            <i class = "fa fa-list-ul"></i> Tampilkan Produk
                        </h3><!-- panel-title Finish -->
                    </div><!-- panel-heading Finish -->
                    <div class = "panel-body"><!-- panel-body Begin -->
                        <table id = "example" class = "display"><!-- table table-bordered table-hover Begin -->
                            <thead><!-- thead Begin -->
                                <tr><!-- tr Begin -->
                                    <th></th>
                                    <th>Nama Produk</th>
                                    <th>Kategori Produk</th>
                                    <th>Kategori</th>
                                    <th>Waktu</th>
                                </tr><!-- tr Finish -->
                            </thead><!-- thead Finish -->
                            <tfoot>
                                <tr><!-- tr Begin -->
                                    <th></th>
                                    <th>Nama Produk</th>
                                    <th>Kategori Produk</th>
                                    <th>Kategori</th>
                                    <th>Waktu</th>
                                </tr><!-- tr Finish -->
                            </tfoot>
                        </table><!-- table table-bordered table-hover Finish -->
                    </div><!-- panel-body Finish -->
                </div><!-- panel panel-primary Finish -->
            </div><!-- col-lg-12 Finish -->
        </div><!-- row Finish -->