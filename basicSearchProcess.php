<?php

require "connection.php";

$txt = $_POST["t"];
$select = $_POST["s"];

$query = "SELECT * FROM `product`";

if (!empty($txt) && $select == 0) {
  $query .= " WHERE `title` LIKE '%" . $txt . "%'";
} else if (empty($txt) && $select != 0) {
  $query .= " WHERE `category_id` LIKE '" . $select . "'";
} else if (!empty($txt) && $select != 0) {
  $query .= " WHERE `title` LIKE '%" . $txt . "%' AND `category_id`='" . $select . "'";
}

?>
<div class="row">
  <div class="offset-lg-2 col-12 col-lg-10 text-center">
    <div class="row">
      <?php

      if ("0" != ($_POST["page"])) {
        $pageno = $_POST["page"];
      } else {
        $pageno = 1;
      }

      $product_rs = Database::search($query);
      $product_num = $product_rs->num_rows;

      $results_per_page = 10;
      $number_of_pages = ceil($product_num / $results_per_page);

      $page_results = ($pageno - 1) * $results_per_page;
      $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

      $selected_num = $selected_rs->num_rows;

      for ($x = 0; $x < $selected_num; $x++) {
        $selected_data = $selected_rs->fetch_assoc();

        if($selected_data["type"] == 1 && $selected_data["qty"] > 0){

      ?>
        <div class="card col-6 offset-2 offset-lg-0 col-lg-2 mt-4 mb-2 bg-body shadow rounded-4 text-center" style="width: 25rem;">
          <div class="col-1 col-lg-1 mt-1 mb-1">
            <span class="badge bg-danger text-start">New</span>
          </div>
          <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo $product_data["description"]; ?>" title="Product Details">

            <?php

            $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id` ='" . $selected_data["id"] . "'");
            $image_data = $image_rs->fetch_assoc();

            ?>

            <img src="<?php echo $image_data["code"]; ?>" class="img-fluid rounded-start imgView " style="height: 150px;">
          </span>
          <div class="card-body ms-0 m-0 text-center ">
            <h5 class="card-title fs-6 fw-bold"><?php echo $selected_data["title"]; ?></h5>
            <span class="card-text text-primary">Rs.<?php echo $selected_data["price"]; ?>.00</span> <br />

            <?php

            if ($selected_data["qty"] > 0) {


            ?>

              <span class="card-text text-warning fw-bold">In Stock</span> <br />
              <span class="card-text text-success fw-bold"><?php echo $selected_data["qty"]; ?> Items Available</span><br /><br />
              <div class="row ">
                <div class="col-12 col-lg-12  py-2 ">
                  <a href='<?php echo "singleProductView.php?id=" . $selected_data["id"]; ?>' class="btn btn-primary fs-5 mt-4">Buy Now</a>

                  <button class="btn btn-outline-white mt-4  border border-info" onclick="addToCart(<?php echo $selected_data['id']; ?>);"><i class="bi bi-cart-fill fs-5"></i></button>


                <?php


              } else {

                ?>


                  <span class="card-text text-warning fw-bold">Out Of Stock</span> <br />
                  <span class="card-text text-success fw-bold">00 Items Available</span><br /><br />

                  <button class="btn btn-outline-info ">Buy Now</button>

                  <button class="btn btn-outline-white mt-2 border border-info"></button>

                  <button class=" btn btn-outline-white mt-2 border border-info"></button>

                <?php

              }

              $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id` = '" . $selected_data["id"] . "' ");
              $watchlist_num = $watchlist_rs->num_rows;

              if ($watchlist_num == 1) {
                ?>

                  <button class=" btn btn-outline-white mt-4 border border-info" onclick="addToWatchlist(<?php echo $selected_data['id']; ?>);">
                    <i class="bi bi-plus-lg text-black fw-bold fs-5" id="plus<?php echo $selected_data['id']; ?>"></i></button>

                <?php
              } else {
                ?>

                  <button class=" btn btn-outline-white mt-4 border border-info" onclick="addToWatchlist(<?php echo $selected_data['id']; ?>);">
                    <i class="bi bi-plus-lg text-black fw-bold fs-5" id="plus<?php echo $selected_data['id']; ?>"></i></button>

                <?php

              }


                ?>





                </div>
              </div>

          </div>
        </div>&nbsp;&nbsp;&nbsp;
        <?php
        }
        ?>
      <?php
      }
      ?>
    </div>
  </div>
  <!-- pagination -->
  <div class="col-8 col-lg-6 text-center mb-3 offset-5 offset-lg-6 ">
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li class="page-item">
        <li class="page-item">
          <a class="page-link" <?php if ($pageno <= 1) {
                                  echo ("#");
                                } else {
                                ?> onclick="basicSearch(<?php echo ($pageno - 1) ?>);" <?php

                                                                                } ?> aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <?php

        for ($x = 1; $x <= $number_of_pages; $x++) {
          if ($x == $pageno) {
        ?>
            <li class="page-item active">
              <a class="page-link" onclick="basicSearch(<?php echo ($x); ?>);"><?php echo $x; ?></a>
            </li>
          <?php
          } else {
          ?>
            <li class="page-item">
              <a class="page-link" onclick="basicSearch(<?php echo ($x); ?>);"><?php echo $x; ?></a>
            </li>
        <?php
          }
        }

        ?>

        <li class="page-item">
          <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                  echo ("#");
                                } else {
                                ?> onclick="basicSearch(<?php echo ($pageno + 1) ?>);" <?php

                                                                                } ?> aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
  <!-- pagination -->
</div>