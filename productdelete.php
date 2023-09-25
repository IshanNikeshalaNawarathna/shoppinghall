<?php

session_start();
require "connection.php";

if ($_SESSION["u"]["email"]) {
    $email = $_SESSION["u"]["email"];
    $pageno;
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="resocess/webLogo/logo.jpg">
        <title>Shopping Hall | Recycle Bin</title>
    </head>

    <body style="overflow-x: hidden;">

        <div class="container-fluid">
            <div class="row">

                <div class="col-12 shadow-sm">
                    <div class="row">
                        <?php include "header.php"; ?>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <div class="row">

                        <div class="col-12 mb-2  shadow-sm  rounded-4 mt-3">
                            <div class="row  bg-body ">
                                <div class="col-12 mt-2">
                                    <label class="form-label fs-1 fw-bold"><i class="bi bi-trash-fill fs-1"></i>&nbsp;| Recycle Bin</label>
                                </div>
                                <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                                    <ol class="breadcrumb bg-white">
                                        <li class="breadcrumb-item"><a href="myProducts.php">My Product</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Recycle Bin</li>
                                    </ol>
                                </nav>
                                <div class="col-7 col-lg-6">
                                    <hr class="border border-5 bg-warning border-warning rounded-3">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <?php

                $product_type = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $email . "' AND `type`='0'");
                if ($product_type->num_rows == 0) {

                ?>

                    <div class="col-12 d-flex mt-3 mb-2 justify-content-center align-items-center mb-3 bg-white rounded-4 " style="height:400px;">
                        <span class="fs-1 text-black-50 d-block">You Have Not Delete Any Product Yet...</span>
                    </div>

                <?php

                } else {

                    for ($type = 0; $type < $product_type->num_rows; $type++) {
                        $product_type_data = $product_type->fetch_assoc();
                    }


                ?>

                    <div class="col-12 shadow">
                        <div class="row g-5">

                            <div class="col-12 ">
                                <div class="row g-4">
                                    <!-- product -->
                                    <div class=" col-10 offset-1 offset-lg-0  col-lg-12 mt-3 mb-3 bg-white rounded-4 shadow p-3 mb-5 bg-body mt-5">
                                        <div class="row ">
                                            <div class="offset-1 col-10 text-center">
                                                <div class="row justify-content-center ">

                                                    <?php

                                                    if (isset($_GET["page"])) {
                                                        $pageno = $_GET["page"];
                                                    } else {
                                                        $pageno = 1;
                                                    }

                                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $email . "'");
                                                    $product_num = $product_rs->num_rows;


                                                    $results_per_page = 6;
                                                    $number_of_pages = ceil($product_num / $results_per_page);

                                                    $page_results = ($pageno - 1) * $results_per_page;
                                                    $selected_rs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $email . "' LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                                                    $selected_num = $selected_rs->num_rows;

                                                    for ($x = 0; $x < $selected_num; $x++) {
                                                        $selected_data = $selected_rs->fetch_assoc();
                                                        if ($selected_data["type"] == 0) {



                                                    ?>

                                                            <!-- card -->
                                                            <div class="card mb-3 col-12 col-lg-6 mt-3 ">
                                                                <div class="row ">
                                                                    <div class="col-12 d-none  mt-3" id="msgdiv-1">
                                                                        <div class="alert alert-info p-2 text-center" role="alert" id="alertdiv-1">
                                                                            <div class="row">
                                                                                <div class="col-11 text-start">
                                                                                    <i class="bi bi-exclamation-triangle-fill fs-6 text-center" id="msg-1"></i>
                                                                                </div>
                                                                                <div class="col-1 p-0 text-center">
                                                                                    <i class="bi bi-x" style="cursor: pointer;" onclick="hideAlert();"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2 mt-3 ">

                                                                        <?php

                                                                        $product_img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $selected_data["id"] . "'");
                                                                        $product_img_data = $product_img_rs->fetch_assoc();

                                                                        ?>

                                                                        <img src="<?php echo $product_img_data["code"]; ?>" class="img-fluid rounded-start h-auto w-auto mb-3">
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title fw-bold fs-4"><?php echo $selected_data["title"]; ?></h5>
                                                                            <span class="card-text fw-bold text-info">Rs.<?php echo $selected_data["price"]; ?>.00</span><br>
                                                                            <span class="card-text fw-bold text-success"><?php echo $selected_data["qty"]; ?> Items</span><br>
                                                                            <?php

                                                                            if ($selected_data["qty"] > 0) {
                                                                            ?>
                                                                                <span class="card-text text-warning fw-bold">In Stock</span> <br />
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <span class="card-text text-warning fw-bold ">Out Of Stock</span> <br />
                                                                            <?php
                                                                            }
                                                                            ?>



                                                                            <div class="row">
                                                                                <div class="col-12 col-lg-10 offset-lg-2 mt-2">
                                                                                    <div class="row g-1">
                                                                                        <div class="col-12 col-lg-6 offset-lg-2 d-grid ">
                                                                                            <button class="btn btn-info text-white fs-5" onclick="uploadProduct(<?php echo $selected_data['id']; ?>);"><i class="bi bi-skip-backward-circle fs-5"></i>&nbsp;&nbsp;Upload</button>
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
                                                    }
                                                    ?>

                                                </div>
                                            </div>




                                            <!-- pagination -->
                                            <div class="col-8 col-lg-7 text-center mb-3 offset-4 offset-lg-6">
                                                <nav aria-label="Page navigation example">
                                                    <ul class="pagination">
                                                        <li class="page-item">
                                                        <li class="page-item">
                                                            <a class="page-link" href="
                                                <?php if ($pageno <= 1) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno - 1);
                                                } ?>
                                                " aria-label="Previous">
                                                                <span aria-hidden="true">&laquo;</span>
                                                            </a>
                                                        </li>
                                                        <?php

                                                        for ($x = 1; $x <= $number_of_pages; $x++) {
                                                            if ($x == $pageno) {
                                                        ?>
                                                                <li class="page-item active">
                                                                    <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                                                </li>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <li class="page-item">
                                                                    <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                                                </li>
                                                        <?php
                                                            }
                                                        }

                                                        ?>

                                                        <li class="page-item">
                                                            <a class="page-link" href="
                                                <?php if ($pageno >= $number_of_pages) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno + 1);
                                                } ?>
                                                " aria-label="Next">
                                                                <span aria-hidden="true">&raquo;</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>

                                            <!-- pagination -->
                                        </div>
                                    </div>
                                    <!-- product -->
                                </div>
                            </div>

                        </div>
                    </div>
                <?php

                }

                ?>

                <?php include "fooler.php"; ?>

            </div>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>


    </body>

    </html>

<?php
}

?>