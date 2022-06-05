<?php
    $query_admins = "SELECT * FROM admins";
    $run_query = mysqli_query($con,$query_admins);

    $responsistem = array();
    $responsistem["data"] = array();
    while($row = mysqli_fetch_assoc($run_query)){
        $data["admin_id"] = $row["admin_id"];
        $data["admin_name"] = $row["admin_name"];
        $data["admin_email"] = $row["admin_email"];
        $data["admin_image"] = $row["admin_image"];
        $data["admin_country"] = $row["admin_country"];
        $row["admin_about"];
        $aboutlength = strlen($row["admin_about"]);
        if($aboutlength >= 100){
            $row["admin_about"] = substr($row["admin_about"],0,100)."...";
        }
        $data["admin_about"] = $row["admin_about"];
        $data["admin_contact"] = $row["admin_contact"];
        $data["admin_job"] = $row["admin_job"];
        array_push($responsistem["data"], $data);
    }
    $json = json_encode($responsistem);

    file_put_contents("data_users.json", $json);
?>