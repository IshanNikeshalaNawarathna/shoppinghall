<?php

session_start();

require "connection.php";

$user = $_SESSION["u"];

$search = $_POST["search"];
$time = $_POST["time"];
$qty = $_POST["qty"];
$condition = $_POST["condition"];

$query =  "SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "'";

if (!empty($search)) {
 $query .= " AND `title` LIKE '%" . $search . "%'";
}

if (!empty($condition) ) {
 $query .= " AND `condition_id`='" . $condition . "'";
}

if ($time != "0") {
 if ($time == "1") {
  $query .= " ORDER BY `datetime_added` DESC";
 } else if ($time == "2") {
  $query .= " ORDER BY `datetime_added` ASC";
 }
}

if ($time != "0" && $qty != "0") {
 if ($qty == "1") {
  $query .= " ,`qty`ASC";
 } else if ($qty == 2) {
  $qury .= " ,`qty` ASC";
 }
} else if ($time != "0" && $qty != "0") {
 if ($qty == "1") {
  $qury .= " ORDER BY `qty` DSEC";
 } else if ($qty == 2) {
  $qury .= " ORDER BY `qty` ASC";
 }
}
?>
<div class="offset-1 col-10 text-center">
 <div class="row justify-content-center">

  <?php

  if ("0" !=($_POST["page"])) {
   $pageno = $_POST["page"];
  } else {
   $pageno = 1;
  }

  $product_rs = Database::search($query);
  $product_num = $product_rs->num_rows;

  $results_per_page = 6;
  $number_of_pages = ceil($product_num / $results_per_page);

  $page_results = ($pageno - 1) * $results_per_page;
  $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

  $selected_num = $selected_rs->num_rows;

  for ($x = 0; $x < $selected_num; $x++) {
   $selected_data = $selected_rs->fetch_assoc();

  ?>

   <!-- card -->
   <div class="card mb-3 col-12 col-lg-6 mt-3 bg-light">
    <div class="row g-0">
     <div class="col-md-4">

      <?php

      $product_img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $selected_data["id"] . "'");
      $product_img_data = $product_img_rs->fetch_assoc();

      ?>

      <img src="<?php echo $product_img_data["code"]; ?>" class="img-fluid rounded-start">
     </div>
     <div class="col-md-8">
      <div class="card-body">
       <h5 class="card-title fw-bold fs-4"><?php echo $selected_data["title"]; ?></h5>
       <span class="card-text fw-bold text-danger">Rs.<?php echo $selected_data["price"]; ?>.00</span><br>
       <span class="card-text fw-bold text-success"><?php echo $selected_data["qty"]; ?> Items</span>
       <div class="form-check form-switch">
        <input type="checkbox" class="form-check-input" role="switch" id="fd<?php echo $selected_data["id"]; ?>" <?php if ($selected_data["status_id"] == 2) {

                                                                                                                 ?> checked<?php
                                                                                                                          }
                                                                                                                           ?> onclick="changeStatus(<?php echo $selected_data['id']; ?>);">

        <label class="form-check-label fw-bold text-black-50 " for="fd<?php echo $selected_data["id"]; ?>">
         <?php if ($selected_data["status_id"] == 2) { ?>
          Make Your Product Active
         <?php } else { ?>
          Make Your Product Deactive
         <?php
         }
         ?>
        </label>
       </div>
       <div class="row">
        <div class="col-12">
         <div class="row g-1">
          <div class="col-12 col-lg-6 d-grid">
           <button class="btn btn-secondary"><i class="bi bi-arrow-repeat" onclick="sendId(<?php echo $selected_data['id']; ?>);"></i>Update</button>
          </div>
          <div class="col-12 col-lg-6 d-grid">
           <button class="btn btn-danger"><i class="bi bi-trash"></i>Delete</button>
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
   <!-- card -->
  <?php

  }
  ?>

 </div>
</div>
<!-- pagination -->
<div class="col-8 col-lg-6 text-center mb-3 offset-4 offset-lg-5">
 <nav aria-label="Page navigation example">
  <ul class="pagination">
   <li class="page-item">
    <a class="page-link" <?php if ($pageno <= 1) {
                                echo "#";
                               } else {
                              ?>
                              onclick="sort1('<?php echo ($pageno - 1)?>');"
                              <?php
                               } ?> aria-label="Previous">
     <span aria-hidden="true">&laquo;</span>
    </a>
   </li>

    <?php

    for ($x = 1; $x <= $number_of_pages; $x++) {
     if ($x == $pageno) {

    ?>

   <li class="page-item active"><a class="page-link" onclick="sort1('<?php echo $x; ?>');" ><?php echo $x; ?></a></li>

  <?php

     } else {

  ?>

   <li class="page-item"><a class="page-link" onclick="sort1(' <?php echo  $x; ?>');"><?php echo $x; ?></a></li>

 <?php

     }
    }

 ?>
  <li class="page-item">
 <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                             echo "#";
                            } else {
                       ?>
                       onclick="sort1('<?php echo ($pageno +1);?>');"
                       <?php
                            } ?> aria-label="Next">
  <span aria-hidden="true">&raquo;</span>
 </a>
 </li>
  </ul>
 </nav>
</div>
<!-- pagination -->