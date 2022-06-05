<?php
    if(!isset($_SESSION["admin_email"])){
        echo "<script>window.open('login.php','_self')</script>";
    }
    else{
        if(isset($_GET["delete_p_cat"])){
            $delete_id = $_GET["delete_p_cat"];
            $delete_p_cat = "DELETE FROM product_categories WHERE p_cat_id='$delete_id'";
            $run_delete_p_cat = mysqli_query($con,$delete_p_cat);
            if($run_delete_p_cat){
                echo "<script>alert('Satu dari Kategori Produk telah di Hapus')</script>";
                echo "<script>window.open('index.php?view_p_cats','_self')</script>";
            }
        }
    }
?>