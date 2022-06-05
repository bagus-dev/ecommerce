<?php
    $query_payments = "SELECT * FROM payments";
    $run_query = mysqli_query($con,$query_payments);

    $responsistem = array();
    $responsistem["data"] = array();
    while($row = mysqli_fetch_assoc($run_query)){
        $data["payment_id"] = $row["payment_id"];
        $data["invoice_no"] = $row["invoice_no"];
        $row["amount"];
        if($row["amount"] < 1000000 AND $row["amount"] >= 500000){
            $row1["amount"] = substr($row["amount"],0,3);
            $row2["amount"] = substr($row["amount"],-3);
            $row["amount"] = "Rp.".$row1["amount"].".".$row2["amount"].",00";
        }
        else if($row["amount"] >= 1000000 AND $row["amount"] < 10000000){
            $row1["amount"] = substr($row["amount"],0,1);
            $row2["amount"] = substr($row["amount"],1,3);
            $row3["amount"] = substr($row["amount"],-3);
            $row["amount"] = "Rp.".$row1["amount"].".".$row2["amount"].".".$row3["amount"].",00";
        }
        else if($row["amount"] >= 10000000){
            $row1["amount"] = substr($row["amount"],0,2);
            $row2["amount"] = substr($row["amount"],2,3);
            $row3["amount"] = substr($row["amount"],-3);
            $row["amount"] = "Rp.".$row1["amount"].".".$row2["amount"].".".$row3["amount"].",00";
        }
        else{
            $row["amount"] = "Rp.".$row["amount"].",00";
        }
        $data["amount"] = $row["amount"];
        $data["payment_mode"] = $row["payment_mode"];
        $data["ref_no"] = $row["ref_no"];
        $data["code"] = $row["code"];
        $data["payment_date"] = $row["payment_date"];
        $data["payment_image"] = $row["payment_image"];
        $data["payment_status"] = $row["payment_status"];
        $query_orders = "SELECT product_id FROM pending_orders WHERE invoice_no = '$row[invoice_no]' AND order_status = '$row[payment_status]'";
        $run_orders = mysqli_query($con,$query_orders);
        $pro_id = mysqli_fetch_assoc($run_orders);
        $query_pro = "SELECT product_title FROM products WHERE product_id = '$pro_id[product_id]'";
        $run_pro = mysqli_query($con,$query_pro);
        $pro = mysqli_fetch_assoc($run_pro);
        $data["product_title"] = $pro["product_title"];
        array_push($responsistem["data"], $data);
    }
    $json = json_encode($responsistem);

    file_put_contents("data_payments.json", $json);
?>