<?php

require "connection.php";

if (isset($_GET["brand"])) {

    $brand = $_GET["brand"];

    $model_rs = Database::search("SELECT * FROM `brand_has_model` INNER JOIN `model` ON brand_has_model.model_id=model.id WHERE `brand_id`='" . $brand . "'");
    $model_num = $model_rs->num_rows;

    if ($model_num > 0) {
?>
        <option value="0">Select Brand</option>


        <?php

        for ($x = 0; $x < $model_num; $x++) {

            $model_data = $model_rs->fetch_assoc();

        ?>

            <option value="<?php echo $model_data["id"]; ?>"><?php echo $model_data["name"]; ?></option>

        <?php

        }
    } else {
        ?>

        <option value="0">Select Brand</option>


        <?php

        $all_brand = Database::search("SELECT * FROM `model`");
        $all_num = $all_brand->num_rows;

        for ($y = 0; $y < $all_num; $y++) {

            $all_data = $all_brand->fetch_assoc();

        ?>

            <option value="<?php echo $all_data["id"]; ?>"><?php echo $all_data["name"]; ?></option>

<?php

        }
    }
}


?>