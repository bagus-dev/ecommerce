<?php
    $query_products = "SELECT * FROM products";
    $run_query = mysqli_query($con,$query_products);

    $responsistem = array();
    $responsistem["data"] = array();
    while($row = mysqli_fetch_assoc($run_query)){
        $data["product_id"] = $row["product_id"];
        $row["p_cat_id"];
        $query_p_cat = "SELECT p_cat_title FROM product_categories WHERE p_cat_id = '$row[p_cat_id]'";
        $run_query_p_cat = mysqli_query($con,$query_p_cat);
        $p_cat = mysqli_fetch_assoc($run_query_p_cat);
        $data["p_cat_id"] = $p_cat["p_cat_title"];
        $row["cat_id"];
        $query_cat = "SELECT cat_title FROM categories WHERE cat_id = '$row[cat_id]'";
        $run_query_cat = mysqli_query($con,$query_cat);
        $cat = mysqli_fetch_assoc($run_query_cat);
        $data["cat_id"] = $cat["cat_title"];
        $data["date"] = $row["date"];
        $data["product_title"] = $row["product_title"];
        $row["product_price"];
        if($row["product_price"] < 1000000 AND $row["product_price"] >= 500000){
            $row1["product_price"] = substr($row["product_price"],0,3);
            $row2["product_price"] = substr($row["product_price"],-3);
            $row["product_price"] = "Rp.".$row1["product_price"].".".$row2["product_price"].",00";
        }
        else if($row["product_price"] >= 1000000 AND $row["product_price"] < 10000000){
            $row1["product_price"] = substr($row["product_price"],0,1);
            $row2["product_price"] = substr($row["product_price"],1,3);
            $row3["product_price"] = substr($row["product_price"],-3);
            $row["product_price"] = "Rp.".$row1["product_price"].".".$row2["product_price"].".".$row3["product_price"].",00";
        }
        else if($row["product_price"] >= 10000000){
            $row1["product_price"] = substr($row["product_price"],0,2);
            $row2["product_price"] = substr($row["product_price"],2,3);
            $row3["product_price"] = substr($row["product_price"],-3);
            $row["product_price"] = "Rp.".$row1["product_price"].".".$row2["product_price"].".".$row3["product_price"].",00";
        }
        else{
            $row["product_price"] = "Rp.".$row["product_price"].",00";
        }
        $data["product_price"] = $row["product_price"];
        $data["product_keywords"] = $row["product_keywords"];
        $data["product_img1"] = $row["product_img1"];
        $row["product_desc"];
        $desclength = strlen($row["product_desc"]);
        if($desclength >= 100){
            $row["product_desc"] = substr($row["product_desc"],0,100)."...";
        }
        $data["product_desc"] = $row["product_desc"];
        array_push($responsistem["data"], $data);
    }
    $json = json_encode($responsistem);

    file_put_contents("data.json", $json);
?>