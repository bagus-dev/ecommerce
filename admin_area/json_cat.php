<?php
    $query_cats = "SELECT * FROM categories";
    $run_query = mysqli_query($con,$query_cats);

    $responsistem = array();
    $responsistem["data"] = array();
    while($row = mysqli_fetch_assoc($run_query)){
        $data["cat_id"] = $row["cat_id"];
        $data["cat_title"] = $row["cat_title"];
        $row["cat_desc"];
        $desclength = strlen($row["cat_desc"]);
        if($desclength >= 100){
            $row["cat_desc"] = substr($row["cat_desc"],0,120)."...";
        }
        $data["cat_desc"] = $row["cat_desc"];
        array_push($responsistem["data"], $data);
    }
    $json = json_encode($responsistem);

    file_put_contents("data_cat.json", $json);
?>