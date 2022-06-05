<?php
    $query_orders = "SELECT * FROM pending_orders";
    $run_query = mysqli_query($con,$query_orders);

    $responsistem = array();
    $responsistem["data"] = array();
    while($row = mysqli_fetch_assoc($run_query)){
        $data["order_id"] = $row["order_id"];
        $row["customer_id"];
        $query_customer = "SELECT customer_email FROM customers WHERE customer_id = '$row[customer_id]'";
        $run_customer = mysqli_query($con,$query_customer);
        $customer = mysqli_fetch_assoc($run_customer);
        $data["customer_email"] = $customer["customer_email"];
        $data["invoice_no"] = $row["invoice_no"];
        $data["product_id"] = $row["product_id"];
        $data["qty"] = $row["qty"];
        $data["size"] = $row["size"];
        $data["order_status"] = $row["order_status"];
        $query_img1 = "SELECT product_title,product_img1 FROM products WHERE product_id = '$row[product_id]'";
        $run_img1 = mysqli_query($con,$query_img1);
        $img1 = mysqli_fetch_assoc($run_img1);
        $data["product_title"] = $img1["product_title"];
        $data["product_img1"] = $img1["product_img1"];
        array_push($responsistem["data"], $data);
    }
    $json = json_encode($responsistem);

    file_put_contents("data_orders.json", $json);
?>