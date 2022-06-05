<?php
    $query_slides = "SELECT * FROM slider";
    $run_query = mysqli_query($con,$query_slides);

    $responsistem = array();
    $responsistem["data"] = array();
    while($row = mysqli_fetch_assoc($run_query)){
        $data["slide_id"] = $row["slide_id"];
        $data["slide_name"] = $row["slide_name"];
        $data["slide_image"] = $row["slide_image"];
        $data["slide_status"] = $row["slide_status"];
        array_push($responsistem["data"], $data);
    }
    $json = json_encode($responsistem);

    file_put_contents("data_slides.json", $json);
?>