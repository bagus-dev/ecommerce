<?php
    if(!isset($_SESSION["admin_email"])){
        echo "<script>window.open('login.php','_self')</script>";
    }
    else{
        if(isset($_GET["delete_cat"])){
            $delete_id = $_GET["delete_cat"];
            $delete_cat = "DELETE FROM categories WHERE cat_id='$delete_id'";
            $run_delete_cat = mysqli_query($con,$delete_cat);
            if($run_delete_cat){
                echo "<script>alert('Satu dari Kategori telah di Hapus')</script>";
                echo "<script>window.open('index.php?view_cats','_self')</script>";
            }
        }
    }
?>