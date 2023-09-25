<?php

require "connection.php";

$txt = $_POST["t"];
$category = $_POST["ca"];
$model = $_POST["m"];
$brand = $_POST["b"];
$color = $_POST["c"];
$priceform = $_POST["pf"];
$priceto = $_POST["pt"];
$sort = $_POST["s"];
$condition = $_POST["co"];


$query = "SELECT * FROM `product`";
$status = 0;

if ($sort == 0) {

  if (!empty($txt)) {
    $query .= " WHERE `title` LIKE '%" . $txt . "%'";
    $status = 1;
  }

  if ($status == 0 && $category != 0) {
    $query .= " WHERE `category_id` = '" . $category . "'";
    $status = 1;
  } else if ($status != 0 && $category != 0) {
    $query .= " AND `category_id` = '" . $category . "'";
  }

  $pid = 0;
  if ($brand != 0 && $model == 0) {

    $brand_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `brand_id` = '" . $brand . "'");
    $brand_num = $brand_rs->num_rows;

    for ($x = 0; $x < $brand_num; $x++) {
      $brand_data = $brand_rs->fetch_assoc();
      $pid = $brand_data["id"];
    }

    if ($status == 0) {
      $query .= " WHERE `brand_has_modle_id` = '" . $pid . "'";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `brand_has_modle_id` = '" . $pid . "'";
    }
  }

  if ($brand == 0 && $model != 0) {

    $model_rs = Database::search("SELECT * FROM `brand_has_modle` WHERE `model_id` = '" . $model . "'");
    $model_num = $model_rs->num_rows;

    for ($x = 0; $x < $model_num; $x++) {
      $model_data = $model_rs->fetch_assoc();
      $pid = $model_data["id"];
    }

    if ($status == 0) {
      $query .= " WHERE `brand_has_modle_id` = '" . $pid . "'";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `brand_has_modle_id` = '" . $pid . "'";
    }
  }

  if ($brand != 0 && $model != 0) {

    $model_has_brand_rs = Database::search("SELECT * FROM `brand_has_modle` WHERE `brand_id` = '" . $brand . "'
      AND `modle_id` = '" . $model . "'");
    $model_has_brand_num = $model_has_brand_rs->num_rows;

    for ($x = 0; $x < $model_has_brand_num; $x++) {
      $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
      $pid = $model_has_brand_data["id"];
    }

    if ($status == 0) {
      $query .= " WHERE `brand_has_modle_id` = '" . $pid . "'";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `brand_has_modle_id` = '" . $pid . "'";
    }
  }

  if ($status == 0 && $condition != 0) {
    $query .= " WHERE `condition_id`= '" . $condition . "'";
    $status = 1;
  } else if ($status != 0 && $condition != 0) {
    $query .= " AND `condition_id`= '" . $condition . "'";
  }

  if ($status == 0 && $color != 0) {
    $query .= " WHERE `colour_id`= '" . $color . "'";
    $status = 1;
  } else if ($status != 0 && $color != 0) {
    $query .= " AND `colour_id`= '" . $color . "'";
  }

  if (!empty($price_from) && empty($price_to)) {
    if ($status == 0) {
      $query .= " WHERE `price` >= '" . $price_from . "'";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `price` >= '" . $price_from . "'";
    }
  } else if (empty($price_from) && !empty($price_to)) {
    if ($status == 0) {
      $query .= " WHERE `price` <= '" . $price_to . "'";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `price` <= '" . $price_to . "'";
    }
  } else if (!empty($price_from) && !empty($price_to)) {
    if ($status == 0) {
      $query .= " WHERE `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
    }
  }
} else if ($sort == 1) {

  if (!empty($txt)) {
    $query .= " WHERE `title` LIKE '%" . $txt . "%' ORDER BY `price` DESC";
    $status = 1;
  }

  if ($status == 0 && $category != 0) {
    $query .= " WHERE `category_id` = '" . $category . "' ORDER BY `price` DESC";
    $status = 1;
  } else if ($status != 0 && $category != 0) {
    $query .= " AND `category_id` = '" . $category . "' ORDER BY `price` DESC";
  }

  $pid = 0;
  if ($brand != 0 && $model == 0) {

    $brand_rs = Database::search("SELECT * FROM `brand_has_modle` WHERE `brand_id` = '" . $brand . "'");
    $brand_num = $brand_rs->num_rows;

    for ($x = 0; $x < $brand_num; $x++) {
      $brand_data = $brand_rs->fetch_assoc();
      $pid = $brand_data["id"];
    }

    if ($status == 0) {
      $query .= " WHERE `brand_has_modle_id` = '" . $pid . "' ORDER BY `price` DESC";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `brand_has_modle_id` = '" . $pid . "' ORDER BY `price` DESC";
    }
  }

  if ($brand == 0 && $model != 0) {

    $model_rs = Database::search("SELECT * FROM `brand_has_modle` WHERE `modle_id` = '" . $model . "'");
    $model_num = $model_rs->num_rows;

    for ($x = 0; $x < $model_num; $x++) {
      $model_data = $model_rs->fetch_assoc();
      $pid = $model_data["id"];
    }

    if ($status == 0) {
      $query .= " WHERE `brand_has_modle_id` = '" . $pid . "' ORDER BY `price` DESC";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `brand_has_modle_id` = '" . $pid . "' ORDER BY `price` DESC";
    }
  }

  if ($brand != 0 && $model != 0) {

    $model_has_brand_rs = Database::search("SELECT * FROM `brand_has_modle` WHERE `brand_id` = '" . $brand . "'
      AND `modle_id` = '" . $model . "'");
    $model_has_brand_num = $model_has_brand_rs->num_rows;

    for ($x = 0; $x < $model_has_brand_num; $x++) {
      $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
      $pid = $model_has_brand_data["id"];
    }

    if ($status == 0) {
      $query .= " WHERE `brand_has_modle_id` = '" . $pid . "' ORDER BY `price` DESC";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `brand_has_modle_id` = '" . $pid . "' ORDER BY `price` DESC";
    }
  }

  if ($status == 0 && $condition != 0) {
    $query .= " WHERE `condition_id`= '" . $condition . "' ORDER BY `price` DESC";
    $status = 1;
  } else if ($status != 0 && $condition != 0) {
    $query .= " AND `condition_id`= '" . $condition . "' ORDER BY `price` DESC";
  }

  if ($status == 0 && $color != 0) {
    $query .= " WHERE `colour_id`= '" . $color . "' ORDER BY `price` DESC";
    $status = 1;
  } else if ($status != 0 && $color != 0) {
    $query .= " AND `colour_id`= '" . $color . "' ORDER BY `price` DESC";
  }

  if (!empty($price_from) && empty($price_to)) {
    if ($status == 0) {
      $query .= " WHERE `price` >= '" . $price_from . "' ORDER BY `price` DESC";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `price` >= '" . $price_from . "' ORDER BY `price` DESC";
    }
  } else if (empty($price_from) && !empty($price_to)) {
    if ($status == 0) {
      $query .= " WHERE `price` <= '" . $price_to . "' ORDER BY `price` DESC";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `price` <= '" . $price_to . "' ORDER BY `price` DESC";
    }
  } else if (!empty($price_from) && !empty($price_to)) {
    if ($status == 0) {
      $query .= " WHERE `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "' ORDER BY `price` DESC";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "' ORDER BY `price` DESC";
    }
  }
} else if ($sort == 2) {

  if (!empty($txt)) {
    $query .= " WHERE `title` LIKE '%" . $txt . "%' ORDER BY `price` ASC";
    $status = 1;
  }

  if ($status == 0 && $category != 0) {
    $query .= " WHERE `category_id` = '" . $category . "' ORDER BY `price` ASC";
    $status = 1;
  } else if ($status != 0 && $category != 0) {
    $query .= " AND `category_id` = '" . $category . "' ORDER BY `price` ASC";
  }

  $pid = 0;
  if ($brand != 0 && $model == 0) {

    $brand_rs = Database::search("SELECT * FROM `brand_has_modle` WHERE `brand_id` = '" . $brand . "'");
    $brand_num = $brand_rs->num_rows;

    for ($x = 0; $x < $brand_num; $x++) {
      $brand_data = $brand_rs->fetch_assoc();
      $pid = $brand_data["id"];
    }

    if ($status == 0) {
      $query .= " WHERE `brand_has_modle_id` = '" . $pid . "' ORDER BY `price` ASC";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `brand_has_modle_id` = '" . $pid . "' ORDER BY `price` ASC";
    }
  }

  if ($brand == 0 && $model != 0) {

    $model_rs = Database::search("SELECT * FROM `brand_has_modle` WHERE `modle_id` = '" . $model . "'");
    $model_num = $model_rs->num_rows;

    for ($x = 0; $x < $model_num; $x++) {
      $model_data = $model_rs->fetch_assoc();
      $pid = $model_data["id"];
    }

    if ($status == 0) {
      $query .= " WHERE `brand_has_modle_id` = '" . $pid . "' ORDER BY `price` ASC";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `brand_has_modle_id` = '" . $pid . "' ORDER BY `price` ASC";
    }
  }

  if ($brand != 0 && $model != 0) {

    $model_has_brand_rs = Database::search("SELECT * FROM `brand_has_modle` WHERE `brand_id` = '" . $brand . "'
      AND `modle_id` = '" . $model . "'");
    $model_has_brand_num = $model_has_brand_rs->num_rows;

    for ($x = 0; $x < $model_has_brand_num; $x++) {
      $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
      $pid = $model_has_brand_data["id"];
    }

    if ($status == 0) {
      $query .= " WHERE `brand_has_modle_id` = '" . $pid . "' ORDER BY `price` ASC";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `brand_has_modle_id` = '" . $pid . "' ORDER BY `price` ASC";
    }
  }

  if ($status == 0 && $condition != 0) {
    $query .= " WHERE `condition_id`= '" . $condition . "' ORDER BY `price` ASC";
    $status = 1;
  } else if ($status != 0 && $condition != 0) {
    $query .= " AND `condition_id`= '" . $condition . "' ORDER BY `price` ASC";
  }

  if ($status == 0 && $color != 0) {
    $query .= " WHERE `colour_id`= '" . $color . "' ORDER BY `price` ASC";
    $status = 1;
  } else if ($status != 0 && $color != 0) {
    $query .= " AND `colour_id`= '" . $color . "' ORDER BY `price` ASC";
  }

  if (!empty($price_from) && empty($price_to)) {
    if ($status == 0) {
      $query .= " WHERE `price` >= '" . $price_from . "' ORDER BY `price` ASC";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `price` >= '" . $price_from . "' ORDER BY `price` ASC";
    }
  } else if (empty($price_from) && !empty($price_to)) {
    if ($status == 0) {
      $query .= " WHERE `price` <= '" . $price_to . "' ORDER BY `price` ASC";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `price` <= '" . $price_to . "' ORDER BY `price` ASC";
    }
  } else if (!empty($price_from) && !empty($price_to)) {
    if ($status == 0) {
      $query .= " WHERE `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "' ORDER BY `price` ASC";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "' ORDER BY `price` ASC";
    }
  }
} else if ($sort == 3) {

  if (!empty($txt)) {
    $query .= " WHERE `title` LIKE '%" . $txt . "%' ORDER BY `qty` DESC";
    $status = 1;
  }

  if ($status == 0 && $category != 0) {
    $query .= " WHERE `category_id` = '" . $category . "' ORDER BY `qty` DESC";
    $status = 1;
  } else if ($status != 0 && $category != 0) {
    $query .= " AND `category_id` = '" . $category . "' ORDER BY `qty` DESC";
  }

  $pid = 0;
  if ($brand != 0 && $model == 0) {

    $brand_rs = Database::search("SELECT * FROM `brand_has_modle` WHERE `brand_id` = '" . $brand . "'");
    $brand_num = $brand_rs->num_rows;

    for ($x = 0; $x < $brand_num; $x++) {
      $brand_data = $brand_rs->fetch_assoc();
      $pid = $brand_data["id"];
    }

    if ($status == 0) {
      $query .= " WHERE `brand_has_modle_id` = '" . $pid . "' ORDER BY `qty` DESC";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `brand_has_modle_id` = '" . $pid . "' ORDER BY `qty` DESC";
    }
  }

  if ($brand == 0 && $model != 0) {

    $model_rs = Database::search("SELECT * FROM `brand_has_modle` WHERE `modle_id` = '" . $model . "'");
    $model_num = $model_rs->num_rows;

    for ($x = 0; $x < $model_num; $x++) {
      $model_data = $model_rs->fetch_assoc();
      $pid = $model_data["id"];
    }

    if ($status == 0) {
      $query .= " WHERE `brand_has_modle_id` = '" . $pid . "' ORDER BY `qty` DESC";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `brand_has_modle_id` = '" . $pid . "' ORDER BY `qty` DESC";
    }
  }

  if ($brand != 0 && $model != 0) {

    $model_has_brand_rs = Database::search("SELECT * FROM `brand_has_modle` WHERE `brand_id` = '" . $brand . "'
      AND `modle_id` = '" . $model . "'");
    $model_has_brand_num = $model_has_brand_rs->num_rows;

    for ($x = 0; $x < $model_has_brand_num; $x++) {
      $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
      $pid = $model_has_brand_data["id"];
    }

    if ($status == 0) {
      $query .= " WHERE `brand_has_modle_id` = '" . $pid . "' ORDER BY `qty` DESC";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `brand_has_modle_id` = '" . $pid . "' ORDER BY `qty` DESC";
    }
  }

  if ($status == 0 && $condition != 0) {
    $query .= " WHERE `condition_id`= '" . $condition . "' ORDER BY `qty` DESC";
    $status = 1;
  } else if ($status != 0 && $condition != 0) {
    $query .= " AND `condition_id`= '" . $condition . "' ORDER BY `qty` DESC";
  }

  if ($status == 0 && $color != 0) {
    $query .= " WHERE `colour_id`= '" . $color . "' ORDER BY `qty` DESC";
    $status = 1;
  } else if ($status != 0 && $color != 0) {
    $query .= " AND `colour_id`= '" . $color . "' ORDER BY `qty` DESC";
  }

  if (!empty($price_from) && empty($price_to)) {
    if ($status == 0) {
      $query .= " WHERE `price` >= '" . $price_from . "' ORDER BY `qty` DESC";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `price` >= '" . $price_from . "' ORDER BY `qty` DESC";
    }
  } else if (empty($price_from) && !empty($price_to)) {
    if ($status == 0) {
      $query .= " WHERE `price` <= '" . $price_to . "' ORDER BY `qty` DESC";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `price` <= '" . $price_to . "' ORDER BY `qty` DESC";
    }
  } else if (!empty($price_from) && !empty($price_to)) {
    if ($status == 0) {
      $query .= " WHERE `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "' ORDER BY `qty` DESC";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "' ORDER BY `qty` DESC";
    }
  }
} else if ($sort == 4) {

  if (!empty($txt)) {
    $query .= " WHERE `title` LIKE '%" . $txt . "%' ORDER BY `qty` ASC";
    $status = 1;
  }

  if ($status == 0 && $category != 0) {
    $query .= " WHERE `category_id` = '" . $category . "' ORDER BY `qty` ASC";
    $status = 1;
  } else if ($status != 0 && $category != 0) {
    $query .= " AND `category_id` = '" . $category . "' ORDER BY `qty` ASC";
  }

  $pid = 0;
  if ($brand != 0 && $model == 0) {

    $brand_rs = Database::search("SELECT * FROM `brand_has_modle` WHERE `brand_id` = '" . $brand . "'");
    $brand_num = $brand_rs->num_rows;

    for ($x = 0; $x < $brand_num; $x++) {
      $brand_data = $brand_rs->fetch_assoc();
      $pid = $brand_data["id"];
    }

    if ($status == 0) {
      $query .= " WHERE `brand_has_modle_id` = '" . $pid . "' ORDER BY `qty` ASC";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `brand_has_modle_id` = '" . $pid . "' ORDER BY `qty` ASC";
    }
  }

  if ($brand == 0 && $model != 0) {

    $model_rs = Database::search("SELECT * FROM `brand_has_modle` WHERE `modle_id` = '" . $model . "'");
    $model_num = $model_rs->num_rows;

    for ($x = 0; $x < $model_num; $x++) {
      $model_data = $model_rs->fetch_assoc();
      $pid = $model_data["id"];
    }

    if ($status == 0) {
      $query .= " WHERE `brand_has_modle_id` = '" . $pid . "' ORDER BY `qty` ASC";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `brand_has_modle_id` = '" . $pid . "' ORDER BY `qty` ASC";
    }
  }

  if ($brand != 0 && $model != 0) {

    $model_has_brand_rs = Database::search("SELECT * FROM `brand_has_modle` WHERE `brand_id` = '" . $brand . "'
      AND `modle_id` = '" . $model . "'");
    $model_has_brand_num = $model_has_brand_rs->num_rows;

    for ($x = 0; $x < $model_has_brand_num; $x++) {
      $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
      $pid = $model_has_brand_data["id"];
    }

    if ($status == 0) {
      $query .= " WHERE `brand_has_modle_id` = '" . $pid . "' ORDER BY `qty` ASC";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `brand_has_modle_id` = '" . $pid . "' ORDER BY `qty` ASC";
    }
  }

  if ($status == 0 && $condition != 0) {
    $query .= " WHERE `condition_id`= '" . $condition . "' ORDER BY `qty` ASC";
    $status = 1;
  } else if ($status != 0 && $condition != 0) {
    $query .= " AND `condition_id`= '" . $condition . "' ORDER BY `qty` ASC";
  }

  if ($status == 0 && $color != 0) {
    $query .= " WHERE `colour_id`= '" . $color . "' ORDER BY `qty` ASC";
    $status = 1;
  } else if ($status != 0 && $color != 0) {
    $query .= " AND `colour_id`= '" . $color . "' ORDER BY `qty` ASC";
  }

  if (!empty($price_from) && empty($price_to)) {
    if ($status == 0) {
      $query .= " WHERE `price` >= '" . $price_from . "' ORDER BY `qty` ASC";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `price` >= '" . $price_from . "' ORDER BY `qty` ASC";
    }
  } else if (empty($price_from) && !empty($price_to)) {
    if ($status == 0) {
      $query .= " WHERE `price` <= '" . $price_to . "' ORDER BY `qty` ASC";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `price` <= '" . $price_to . "' ORDER BY `qty` ASC";
    }
  } else if (!empty($price_from) && !empty($price_to)) {
    if ($status == 0) {
      $query .= " WHERE `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "' ORDER BY `qty` ASC";
      $status = 1;
    } else if ($status != 0) {
      $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "' ORDER BY `qty` ASC";
    }
  }
}

?>

<?php
if ("0" != $_POST["page"]) {
  $pageno = $_POST["page"];
} else {
  $pageno = 1;
}

$product_rs = Database::search($query);
$product_num = $product_rs->num_rows;

$results_per_page = 1;
$number_of_pages = ceil($product_num / $results_per_page);

$page_results = ((int)$pageno - 1) * $results_per_page;

$query .= " LIMIT " . $results_per_page . " OFFSET " . $page_results . "";
$results_rs = Database::search($query);
$results_num = $results_rs->num_rows;

while ($results_data = $results_rs->fetch_assoc()) {

?>
  <div class="card mb-3 col-10 offset-1 offset-lg-0 col-lg-5 mt-3">
    <div class="row ">
      <div class="col-1 col-lg-1 mt-1 mb-1">
        <span class="badge bg-danger text-start">New</span>
      </div>
      <div class="col-md-3 mt-4">

        <?php

        $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $results_data["id"] . "'");
        $image_data = $image_rs->fetch_assoc();

        ?>
        <img src="<?php echo $image_data["code"]; ?>" class="img-fluid rounded-start" alt="...">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title text-black fw-bold"><?php echo $results_data["title"]; ?></h5>
          <span class="card-text">Rs. <b class="text-primary fs-6"><?php echo $results_data["price"]; ?></b>.00</span><br>
          <span class="card-text"> <b class="text-danger"><?php echo $results_data["qty"]; ?> </b>Items Left</span><br />

          <?php

          if ($results_data["qty"] > 0) {

          ?>

            <span class="card-text text-warning fw-bold">In Stock</span> <br />

            <div class="row">
              <div class="col-12">

                <div class="row ">

                  <div class="col-12 col-lg-12  py-2 mt-5">
                    <a href='<?php echo "singleProductView.php?id=" . $results_data["id"]; ?>' class="btn btn-primary  mt-0 mt-lg-0 fs-5 ">Buy Now</a>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-outline-white  border border-info" onclick="addToCart(<?php echo $results_data['id']; ?>);"><i class="bi bi-cart-fill fs-5"></i></button>&nbsp;&nbsp;
                    <button class=" btn btn-outline-white  border border-info" onclick="addToWatchlist(<?php echo $results_data['id']; ?>);">
                      <i class="bi bi-plus-lg text-black fw-bold fs-5 " id="plus<?php echo $results_data['id']; ?>"></i></button>
                  </div>
                </div>

              </div>
            </div>

          <?php

          } else {
          ?>

            <span class="card-text text-warning fw-bold">Out Of Stock</span> <br />

            <div class="row">
              <div class="col-12">

                <div class="row ">

                  <div class="col-12 col-lg-12  py-2 mt-5">
                    <a href='<?php echo "singleProductView.php?id=" . $results_data["id"]; ?>' class="btn btn-primary  mt-0 mt-lg-0 fs-5 ">Buy Now</a>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-outline-white  border border-info" onclick="addToCart(<?php echo $results_data['id']; ?>);"><i class="bi bi-cart-fill fs-5"></i></button>&nbsp;&nbsp;
                    <button class=" btn btn-outline-white  border border-info" onclick="addToWatchlist(<?php echo $results_data['id']; ?>);">
                      <i class="bi bi-plus-lg text-black fw-bold fs-5 " id="plus<?php echo $results_data['id']; ?>"></i></button>
                  </div>
                </div>

              </div>
            </div>

          <?php
          }

          ?>



        </div>
      </div>
    </div>
  </div>&nbsp;
<?php
}
?>
<!-- pagination -->
<div class="col-8 col-lg-6 text-center mb-3 offset-2 offset-lg-2">
  <nav aria-label="Page navigation example">
    <ul class="pagination pagination-lg justify-content-center">
      <li class="page-item">
        <a class="page-link" <?php if ($pageno <= 1) {
                                echo ("#");
                              } else {
                              ?> onclick="advancedSearch('<?php echo ($pageno - 1) ?>');" <?php

                                                                                        } ?> aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      <?php

      for ($x = 1; $x <= $number_of_pages; $x++) {
        if ($x == $pageno) {
      ?>
          <li class="page-item active">
            <a class="page-link" onclick="advancedSearch('<?php echo ($x) ?>');"><?php echo $x; ?></a>
          </li>
        <?php
        } else {
        ?>
          <li class="page-item">
            <a class="page-link" onclick="advancedSearch('<?php echo ($x) ?>');"><?php echo $x; ?></a>
          </li>
      <?php
        }
      }

      ?>

      <li class="page-item">
        <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                echo ("#");
                              } else {
                              ?>onclick="advancedSearch('<?php echo ($pageno + 1); ?>');" <?php

                                                                                        } ?> aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
  </nav>
</div>
<!-- pagination -->