<?php

require "connection.php";

if(isset($_GET["id"])){
    $delete_model = $_GET["id"];

    $model_rs = Database::search("SELECT * FROM `model` WHERE `id`='".$delete_model."'");
    $model_num = $model_rs->num_rows;

    if($model_num == 1){
        $model_data = $model_rs->fetch_assoc();
        // Database::iud("DELETE FROM `brand_has_model` WHERE  `id`='".$model_data["id"]."'");
        Database::iud("DELETE FROM `model` WHERE `id`='".$model_data["id"]."'");
       
        echo("1");
    }
}else{
    echo("Somthing Want Worn.");
}



?>