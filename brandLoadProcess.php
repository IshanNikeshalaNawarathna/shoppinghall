<?php

require "connection.php";

if(isset($_GET["category"])){
    $category_id = $_GET["category"];

    $brand_rs = Database::search("SELECT * FROM `brand` WHERE `category_id`='".$category_id."'");
    $brand_num = $brand_rs->num_rows;
    if ($brand_num > 0) {

        ?>
        
                <option value="0">Select Brand</option>
        
        
                <?php
        
                for ($x = 0; $x < $brand_num; $x++) {
        
                    $brand_data = $brand_rs->fetch_assoc();
        
                ?>
        
                    <option value="<?php echo $brand_data["id"]; ?>"><?php echo $brand_data["name"]; ?></option>
        
                <?php
        
                }
            } else {
        
                ?>
        
                <option value="0">Select Brand</option>
        
        
                <?php
        
                $all_brand = Database::search("SELECT * FROM `brand`");
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