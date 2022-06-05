<?php
    session_start();
    include("includes/db.php");

    if(!isset($_SESSION["admin_email"])){
        echo "<script>window.open('login.php','_self')</script>";
    }
    else{
        $admin_session = $_SESSION["admin_email"];
        $get_admin = "SELECT * FROM admins where admin_email = '$admin_session'";
        $run_admin = mysqli_query($con,$get_admin);
        $row_admin = mysqli_fetch_array($run_admin);
        $admin_id = $row_admin["admin_id"];
        $admin_name = $row_admin["admin_name"];
        $admin_email = $row_admin["admin_email"];
        $admin_image = $row_admin["admin_image"];
        $admin_country = $row_admin["admin_country"];
        $admin_about = $row_admin["admin_about"];
        $admin_contact = $row_admin["admin_contact"];
        $admin_job = $row_admin["admin_job"];
        $get_products = "SELECT * FROM products";
        $run_products = mysqli_query($con,$get_products);
        $count_products = mysqli_num_rows($run_products);
        $get_customers = "SELECT * FROM customers";
        $run_customers = mysqli_query($con,$get_customers);
        $count_customers = mysqli_num_rows($run_customers);
        $get_p_categories = "SELECT * FROM product_categories";
        $run_p_categories = mysqli_query($con,$get_p_categories);
        $count_p_categories = mysqli_num_rows($run_p_categories);
        $get_pending_orders = "SELECT * FROM pending_orders";
        $run_pending_orders = mysqli_query($con,$get_pending_orders);
        $count_pending_orders = mysqli_num_rows($run_pending_orders);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Store Admin Area</title>
    <link rel = "stylesheet" href = "css/bootstrap-337.min.css">
    <link rel = "stylesheet" href = "font-awesome/css/font-awesome.min.css">
    <link rel = "stylesheet" href = "css/style.css">
    <link rel = "icon" type = "image/png" href = "../images/ecom-store-logo.png">
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <link href="css/lightbox.css" rel="stylesheet"/>
    <style>
        td.details-control {
            background: url('images/details_open.png') no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url('images/details_close.png') no-repeat center center;
        }
    </style>
</head>
<body>
    <div id="wrapper"><!-- wrapper Begin -->
    <?php include("includes/sidebar.php"); ?>
        <div id="page-wrapper"><!-- page-wrapper Begin -->
            <div class="container-fluid"><!-- container-fluid Begin -->
                <?php
                    if(isset($_GET["dashboard"])){
                        include("dashboard.php");
                    }
                    elseif(isset($_GET["insert_product"])){
                        include("insert_product.php");
                    }
					elseif(isset($_GET["view_products"])){
						include("view_products.php");
                    }
                    elseif(isset($_GET["edit_product"])){
                        include("edit_product.php");
                    }
                    elseif(isset($_GET["delete_product"])){
                        include("delete_product.php");
                    }
                    elseif(isset($_GET["insert_p_cat"])){
                        include("insert_p_cat.php");
                    }
                    elseif(isset($_GET["view_p_cats"])){
                        include("view_p_cats.php");
                    }
                    elseif(isset($_GET["edit_p_cat"])){
                        include("edit_p_cat.php");
                    }
                    elseif(isset($_GET["delete_p_cat"])){
                        include("delete_p_cat.php");
                    }
                    elseif(isset($_GET["insert_cat"])){
                        include("insert_cat.php");
                    }
                    elseif(isset($_GET["view_cats"])){
                        include("view_cats.php");
                    }
                    elseif(isset($_GET["edit_cat"])){
                        include("edit_cat.php");
                    }
                    elseif(isset($_GET["delete_cat"])){
                        include("delete_cat.php");
                    }
                    elseif(isset($_GET["view_customers"])){
                        include("view_customers.php");
                    }
                    elseif(isset($_GET["view_orders"])){
                        include("view_orders.php");
                    }
                    elseif(isset($_GET["view_payments"])){
                        include("view_payments.php");
                    }
                    elseif(isset($_GET["edit_status"])){
                        include("edit_status.php");
                    }
                    elseif(isset($_GET["insert_user"])){
                        include("insert_user.php");
                    }
                    elseif(isset($_GET["view_users"])){
                        include("view_users.php");
                    }
                    elseif(isset($_GET["user_profile"])){
                        include("user_profile.php");
                    }
                    elseif(isset($_GET["view_slides"])){
                        include("view_slides.php");
                    }
                    elseif(isset($_GET["insert_slide"])){
                        include("insert_slide.php");
                    }
                    elseif(isset($_GET["edit_slide"])){
                        include("edit_slide.php");
                    }
                    else{
                        include("dashboard.php");
                    }
                ?>
            </div><!-- container-fluid Finish -->
        </div><!-- page-wrapper Finish -->
    </div><!-- wrapper Finish -->
    <script type = "text/javascript" src = "js/jquery-331.min.js"></script>
    <script type = "text/javascript" src = "js/bootstrap-337.min.js"></script>
    <script src="js/lightbox-plus-jquery.min.js"></script>
    <script type = "text/javascript" src="js/jquery.dataTables.min.js"></script>
    <?php
        if(isset($_GET["view_p_cats"])){
            echo "<script src='app_ajax_p_cat.js'></script>";
            echo "
                <script type = 'text/javascript'>
                    $(document).ready( function () {
                        $('#p_cat_table').DataTable();
                    } );
                </script>
            ";
        }
        if(isset($_GET["view_products"])){
            echo "<script type = 'text/javascript' src = 'app_ajax.js'></script>";
            echo "
                <script type = 'text/javascript'>
                    $(document).ready( function () {
                        $('#example').DataTable();
                    } );
                </script>
            ";
        }
        if(isset($_GET["view_cats"])){
            echo "<script src = 'app_ajax_cat.js'></script>";
            echo "
                <script type = 'text/javascript'>
                    $(document).ready( function () {
                        $('#cat_table').DataTable();
                    } );
                </script>
            ";
        }
        if(isset($_GET["view_customers"])){
            echo "<script src = 'app_ajax_customer.js'></script>";
            echo "
                <script type = 'text/javascript'>
                    $(document).ready( function () {
                        $('#customers_table').DataTable();
                    } );
                </script>
            ";
        }
        if(isset($_GET["view_orders"])){
            echo "<script src = 'app_ajax_orders.js'></script>";
            echo "
                <script type = 'text/javascript'>
                    $(document).ready( function () {
                        $('#orders_table').DataTable();
                    } );
                </script>
            ";
        }
        if(isset($_GET["view_payments"])){
            echo "<script src = 'app_ajax_payments.js'></script>";
            echo "
                <script type = 'text/javascript'>
                    $(document).ready( function () {
                        $('#payments_table').DataTable();
                    } );
                </script>
            ";
        }
        if(isset($_GET["view_users"])){
            echo "<script src = 'app_ajax_users.js'></script>";
            echo "
                <script type = 'text/javascript'>
                    $(document).ready( function () {
                        $('#users_table').DataTable();
                    } );
                </script>
            ";
        }
        if(isset($_GET["view_slides"])){
            echo "<script src = 'app_ajax_slides.js'></script>";
            echo "
                <script type = 'text/javascript'>
                    $(document).ready( function () {
                        $('#slides_table').DataTable();
                    } );
                </script>
            ";
        }
    ?>
</body>
</html>
<?php } ?>