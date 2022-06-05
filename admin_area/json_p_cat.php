<?php
    $query_p_cats = "SELECT * FROM product_categories";
    $run_query = mysqli_query($con,$query_p_cats);

    $responsistem = array();
    $responsistem["data"] = array();
    while($row = mysqli_fetch_assoc($run_query)){
        $data["p_cat_id"] = $row["p_cat_id"];
        $data["p_cat_title"] = $row["p_cat_title"];
        $row["p_cat_desc"];
        $desclength = strlen($row["p_cat_desc"]);
        if($desclength >= 100){
            $row["p_cat_desc"] = substr($row["p_cat_desc"],0,120)."...";
        }
        $data["p_cat_desc"] = $row["p_cat_desc"];
        array_push($responsistem["data"], $data);
    }
    $json = json_encode($responsistem);

    file_put_contents("data_p_cat.json", $json);
?>