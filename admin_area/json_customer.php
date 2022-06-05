<?php
    $query_customers = "SELECT * FROM customers";
    $run_query = mysqli_query($con,$query_customers);

    $responsistem = array();
    $responsistem["data"] = array();
    while($row = mysqli_fetch_assoc($run_query)){
        $data["customer_id"] = $row["customer_id"];
        $data["customer_name"] = $row["customer_name"];
        $data["customer_email"] = $row["customer_email"];
        $data["customer_country"] = $row["customer_country"];
        $data["customer_city"] = $row["customer_city"];
        $data["customer_contact"] = $row["customer_contact"];
        $data["customer_address"] = $row["customer_address"];
        $data["customer_image"] = $row["customer_image"];
        array_push($responsistem["data"], $data);
    }
    $json = json_encode($responsistem);

    file_put_contents("data_customer.json", $json);
?>