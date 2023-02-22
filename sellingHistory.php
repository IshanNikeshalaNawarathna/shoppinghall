<?php

session_start();
require "connection.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="icon" href="resocess/webLogo/logo.jpg">
    <title>Shopping Hall | Selling Hstory</title>
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php include "adminHeader.php"; ?>

            <hr class="d-block d-lg-none">
            <div class="col-12">
                <div class="row g-4">

                    <div class="col-12 ">
                        <div class="row">

                            <div class="col-12 shadow-sm bg-white rounded-4 mt-4">
                                <div class="row">
                                    <div class="col-6 col-lg-4 offset-2 offset-lg-3 mb-3">
                                        <input type="text" class="form-control" placeholder="Search her..." id="basicSearchText">
                                    </div>
                                    <div class="col-3 col-lg-2 d-grid mb-3">
                                        <button class="btn btn-primary shadow" onclick="sellingHistorySearch(0);">Search</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>




            <div class="col-10 col-lg-10 offset-1 offset-lg-1 shadow rounded-4 mt-3 mb-3">
                <div class="row">

                    <div class="col-12 col-lg-3 border border-2   border-start-0 border-top-0 border-bottom-0 ">
                        <div class="row">

                            <div class="col-12 align-items-center vh-100 d-none d-lg-block">
                                <div class="row  g-1">

                                    <div class="col-6 col-lg-12 mt-5">
                                        <div class="row">
                                            <div class="col-1 ">
                                                <?php
                                                $admin_img_rs = Database::search("SELECT * FROM `admin_profile` WHERE `admin_email`='" . $_SESSION["admin"]["email"] . "'");
                                                $admin_img_data = $admin_img_rs->fetch_assoc();

                                                if ($_SESSION["admin"]) {
                                                ?>
                                                    <img src="<?php echo $admin_img_data["path"]; ?>" class="rounded-circle shadow" style="height: 65px;width: auto;background-repeat: no-repeat;">
                                                <?php
                                                } else {
                                                ?>
                                                    <img src="resocess/profile-im.png" class="rounded-circle shadow" style="height: 65px;width: auto;background-repeat: no-repeat;">
                                                <?php
                                                }

                                                ?>

                                            </div>
                                            <div class="col-12 offset-lg-2 offset-0 col-lg-9">
                                                <?php
                                                $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $_SESSION["admin"]["email"] . "'");
                                                $admin_data = $admin_rs->fetch_assoc();
                                                ?>
                                                <label class="form-label fs-5"><?php echo $admin_data["fname"] . " " . $admin_data["lname"]; ?></label><br>
                                                <button class="btn btn-outline-info shadow" onclick="adminProfileUpdate();">Account Update</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="nav flex-column nav-pills me-3 mt-3">
                                        <nav class="nav flex-column">
                                            <a class="nav-link text-dark fs-5 mb-3" href="#">Dashboard</a>
                                            <a class="nav-link text-dark fs-5 mb-3" href="manageUser.php">Manage Users</a>
                                            <a class="nav-link text-dark fs-5 mb-3" href="manageProduct.php">Manage Products</a>
                                            <a class="nav-link text-dark fs-5 mb-3" href="productAdd.php">Add Product</a>
                                            <a class="nav-link text-dark fs-5 mb-3" href="sellingHistory.php">Selling History</a>
                                            <?php

                                            if (isset($_SESSION["admin"])) {

                                                $data = $_SESSION["admin"];

                                            ?>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <?php
                                                            // $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $data . "'");
                                                            // $user_data = $user_rs->fetch_assoc();
                                                            ?>
                                                            <a class="nav-link text-danger fs-5 mb-3" onclick="adminSignOut();">Sign Out</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php

                                            } else {

                                            ?>
                                                <a href="adminLogin.php" class="text-decoration-none fw-bold">Sign In or Register</a>
                                            <?php

                                            }

                                            ?>
                                        </nav>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-12 col-lg-9" id="viewArea">
                        <div class="row">

                            <div class="col-12 mt-3 ">
                                <label class="form-label fs-4 fw-bold">Selling History</label>
                                <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                                    <ol class="breadcrumb bg-white">
                                        <li class="breadcrumb-item"><a href="adminPenal.php">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Selling History</li>
                                    </ol>
                                </nav>
                            </div>


                            <div class="col-12">
                                <hr style="width: 90%;" class="border border-2 border-info rounded-4">
                            </div>



                            <div class="col-12 offset-0 mt-2 mb-3 shadow rounded-4">
                                <div class="row g-5">

                                    <div class="col-12 ">
                                        <div class="row g-5">

                                            <div class="col-11 offset-0 col-lg-10 offset-lg-1">
                                                <div class="row g-1">

                                                    <table class="table text-start align-middle  table-hover mb-0 ">
                                                        <thead>
                                                            <tr class="text-dark">
                                                                <th scope="col" class="fs-6">Invoice ID</th>
                                                                <th scope="col" class="fs-6">Product Name</th>
                                                                <th scope="col" class="fs-6">Buyer</th>
                                                                <th scope="col" class="fs-6">Amount</th>
                                                                <th scope="col" class="fs-6">Quantity</th>
                                                                <th scope="col"></th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <div class="col-12 mt2 ">

                                                                <?php



                                                                $query = "SELECT * FROM `invoice`";
                                                                $pageno;

                                                                if (isset($_GET["page"])) {
                                                                    $pageno = $_GET["page"];
                                                                } else {
                                                                    $pageno = 1;
                                                                }

                                                                $invoice_rs = Database::search($query);
                                                                $invoice_num = $invoice_rs->num_rows;

                                                                $results_per_page = 20;
                                                                $number_of_pages = ceil($invoice_num / $results_per_page);

                                                                $page_results = ($pageno - 1) * $results_per_page;
                                                                $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                                                                $selected_num = $selected_rs->num_rows;

                                                                for ($x = 0; $x < $selected_num; $x++) {
                                                                    $selected_data = $selected_rs->fetch_assoc();


                                                                ?>

                                                                    <tr class="mb-3" id="viewArea">
                                                                        <td class="fs-6"><?php echo $selected_data["id"]; ?></td>
                                                                        <?php

                                                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $selected_data["product_id"] . "'");
                                                                        $product_data = $product_rs->fetch_assoc();

                                                                        ?>
                                                                        <td class="fs-6"><?php echo $product_data["title"]; ?></td>
                                                                        <?php
                                                                        $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $selected_data["user_email"] . "'");
                                                                        $user_data = $user_rs->fetch_assoc();
                                                                        ?>
                                                                        <td class="fs-6"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></td>
                                                                        <td class="fs-6"><?php echo $selected_data["total"] ?></td>
                                                                        <td class="fs-6"><?php echo $selected_data["qty"] ?></td>
                                                                        <td>
                                                                            <div class="col-12 d-grid">

                                                                                <?php

                                                                                if ($selected_data["status"] == 0) {
                                                                                ?>
                                                                                    <button class="btn btn-info shadow" onclick="changeInvoice('<?php echo $selected_data['id']; ?>');" id="changeBtn<?php echo $selected_data['id']; ?>">Confirm&nbsp;Order</button>
                                                                                <?php
                                                                                } else if ($selected_data["status"] == 1) {
                                                                                ?>
                                                                                    <button class="btn btn-info shadow" onclick="changeInvoice('<?php echo $selected_data['id']; ?>');" id="changeBtn<?php echo $selected_data['id']; ?>">Packing</button>
                                                                                <?php
                                                                                } else if ($selected_data["status"] == 2) {
                                                                                ?>
                                                                                    <button class="btn btn-info shadow" onclick="changeInvoice('<?php echo $selected_data['id']; ?>');" id="changeBtn<?php echo $selected_data['id']; ?>">Dispatch</button>
                                                                                <?php
                                                                                } else if ($selected_data["status"] == 3) {
                                                                                ?>
                                                                                    <button class="btn btn-info shadow" onclick="changeInvoice('<?php echo $selected_data['id']; ?>');" id="changeBtn<?php echo $selected_data['id']; ?>">Shipping</button>
                                                                                <?php
                                                                                } else if ($selected_data["status"] == 4) {
                                                                                ?>
                                                                                    <button class="btn btn-success  shadow" onclick="changeInvoice('<?php echo $selected_data['id']; ?>');" id="changeBtn<?php echo $selected_data['id']; ?>">Delivered</button>
                                                                                <?php
                                                                                }




                                                                                ?>


                                                                            </div>
                                                                        </td>
                                                                    </tr>

                                                                <?php
                                                                }
                                                                ?>

                                                            </div>

                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>



                                        </div>
                                    </div>

                                    <!-- profileUpdate model -->
                                    <div class="modal fade" id="adminProfileUpdate" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5 fw-bold" id="exampleModalToggleLabel">Admin Profile </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body ">

                                                    <div class="col-12 d-flex justify-content-center">
                                                        <div class="row align-items-center">
                                                            <?php
                                                            $admin_img_rs = Database::search("SELECT * FROM `admin_profile` WHERE `admin_email`='" . $_SESSION["admin"]["email"] . "'");
                                                            $admin_img_data = $admin_img_rs->fetch_assoc();

                                                            if ($_SESSION["admin"]) {
                                                            ?>
                                                                <img src="<?php echo $admin_img_data["path"]; ?>" style="height: 65px;width: auto;background-repeat: no-repeat;" id="img">
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <img src="resocess/projectUser.png" class="rounded-circle shadow" style="height: 65px;width: auto;background-repeat: no-repeat;">
                                                            <?php
                                                            }

                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-lg-5 offset-4 mt-2 mb-4">
                                                        <input type="file" class="d-none" id="profileimg" accept="image/**">
                                                        <label for="profileimg" class="btn btn-primary shadow" onclick="changeImage();">Upload Profile Image</label>
                                                    </div>


                                                    <div class="col-12">
                                                        <div class="row">

                                                            <?php

                                                            $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $_SESSION["admin"]["email"] . "'");
                                                            $admin_data = $admin_rs->fetch_assoc();

                                                            ?>

                                                            <div class="col-6">
                                                                <label class="form-label fs-5 fw-bold">Frist Name</label>
                                                                <input type="text" class="form-control" placeholder="Frist Name" id="fname" value="<?php echo $admin_data["fname"] ?>">
                                                            </div>
                                                            <div class="col-6">
                                                                <label class="form-label fs-5 fw-bold">Last Name</label>
                                                                <input type="text" class="form-control" placeholder="Last Name" id="lname" value="<?php echo $admin_data["lname"] ?>">
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer ">
                                                    <button class="btn btn-primary shadow" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" onclick="updateAdminProfile();">Save Profile</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- profileupdate model -->


                                    <div class="col-8 col-lg-6 text-center mt-5 mb-4 offset-3 offset-lg-5">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination">
                                                <li class="page-item"><a class="page-link" href="<?php if ($pageno <= 1) {
                                                                                                        echo "#";
                                                                                                    } else {
                                                                                                        echo "?page=" . ($pageno - 1);
                                                                                                    } ?>">Previous</a></li>
                                                <?php

                                                for ($x = 1; $x <= $number_of_pages; $x++) {
                                                    if ($x == $pageno) {
                                                ?>
                                                        <li class="page-item"><a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a></li>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <li class="page-item"><a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a></li>
                                                <?php
                                                    }
                                                }

                                                ?>

                                                <li class="page-item"><a class="page-link" href="<?php if ($pageno >= $number_of_pages) {
                                                                                                        echo "#";
                                                                                                    } else {
                                                                                                        echo "?page=" . ($pageno + 1);
                                                                                                    } ?>">Next</a></li>
                                            </ul>
                                        </nav>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>

    <script src="bootstrap.js"></script>
    <script src="script.js"></script>
</body>

</html>