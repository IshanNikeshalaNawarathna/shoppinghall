<?php

session_start();
require "connection.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Shoppin Hall | Manage Product</title>
    <link rel="icon" href="resocess/webLogo/logo.jpg">
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php include "adminHeader.php"; ?>

            <hr class="d-block d-lg-none">

            <div class="col-12 ">
                <div class="row">

                    <div class="col-12 shadow-sm bg-white rounded-4 mt-4">
                        <div class="row">
                            <div class="col-6 col-lg-4 offset-2 offset-lg-3 mb-3">
                                <!-- </?php
                                $user_rs = Database::search("SELECT * FROM `user`");
                                // $user_data = $user_rs->fetch_assoc();
                                $newProduct_rs = Database::search("SELECT * FROM `product`");
                                // $newProduct_data = $newProduct_rs->fetch_assoc();

                                if ($user_rs->num_rows > 0) {
                                ?> -->
                                    <input type="text" class="form-control" placeholder="Search her..." id="basicSearchText">
                                <!-- </?php

                                } else if ($newProduct_rs->num_rows > 0) {
                                ?>
                                    <input type="text" class="form-control" placeholder="Search her..." id="productText">
                                </?php
                                }

                                ?> -->

                            </div>
                            <div class="col-3 col-lg-2 d-grid mb-3">
                                <button class="btn btn-primary shadow" onclick="basicSearchAdminProduct(0);">Search</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12 mt-4">
                <div class="row g-5">

                    <div class="col-10 col-lg-10 offset-1 offset-lg-1 rounded-4 shadow bg-white mt-5">
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
                                                            <img src="resocess/projectUser.png" class="rounded-circle shadow" style="height: 65px;width: auto;background-repeat: no-repeat;">
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
                                                    <a class="nav-link text-dark fs-5 mb-4" href="adminPenal.php">Dashboard</a>
                                                    <a class="nav-link text-dark fs-5 mb-4" href="manageUser.php">Manage Users</a>
                                                    <a class="nav-link text-dark fs-5 mb-4" href="manageProduct.php">Manage Products</a>
                                                    <a class="nav-link text-dark fs-5 mb-4" href="productAdd.php">Add Product</a>
                                                    <a class="nav-link text-dark fs-5 mb-4" href="sellingHistory.php">Selling History</a>
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

                            <div class="col-12 col-lg-9" id="basicRsesult">
                                <div class="row g-1">

                                    <div class="col-12 mt-3 ">
                                        <label class="form-label fs-4 fw-bold">Add Product</label>
                                        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                                            <ol class="breadcrumb bg-white">
                                                <li class="breadcrumb-item"><a href="adminPenal.php">Home</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                                            </ol>
                                        </nav>
                                    </div>

                                    <div class="col-12">
                                        <hr style="width: 90%;" class="border border-2 border-info rounded-4">
                                    </div>

                                    <div class="col-11 col-lg-11 offset-1 offset-lg-1">
                                        <div class="row ">

                                            <div class="col-11 mt-3 mb-4">
                                                <div class="row">

                                                    <div class="col-12 d-none" id="msgdiv-1">
                                                        <div class="alert alert-info p-2 text-center" role="alert" id="alertdiv-1">
                                                            <div class="row">
                                                                <div class="col-11 text-start">
                                                                    <i class="bi bi-exclamation-triangle-fill fs-6" id="msg-1"></i>
                                                                </div>
                                                                <div class="col-1 p-0 text-center">
                                                                    <i class="bi bi-x" style="cursor: pointer;" onclick="hideAlert();"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row g-1">

                                                    <div class="col-12">
                                                        <div class="row g-1">
                                                            <div class="col-6  shadow bg-body rounded-4 ">


                                                                <div class="col-12 mt-3 ">
                                                                    <label class="form-label fs-6 fw-bold">&nbsp;Select Product Category</label>
                                                                </div>
                                                                <div class="col-7 col-lg-7 offset-lg-2 mb-3">
                                                                    <select class="form-select text-center border-top-0 border-start-0 border-end-0" id="category">
                                                                        <option value="0">Select Category</option>

                                                                        <?php

                                                                        $catedory_rs = Database::search("SELECT * FROM `category`");
                                                                        $catedory_num = $catedory_rs->num_rows;

                                                                        for ($x = 0; $x < $catedory_num; $x++) {
                                                                            $catedory_data  = $catedory_rs->fetch_assoc();

                                                                        ?>
                                                                            <option value="<?php echo $catedory_data["id"]; ?>"><?php echo $catedory_data["name"]; ?></option>
                                                                        <?php


                                                                        }

                                                                        ?>

                                                                    </select>
                                                                </div>

                                                                <div class="col-12">
                                                                    <label class="form-label fs-6 fw-bold">&nbsp;Select Product Brand</label>
                                                                </div>
                                                                <div class="col-7 col-lg-7 offset-lg-2 mb-3">
                                                                    <select class="form-select text-center border-top-0 border-start-0 border-end-0" id="brand">
                                                                        <option value="0">Select Brand</option>
                                                                        <?php

                                                                        $brand_rs = Database::search("SELECT * FROM `brand`");
                                                                        $brand_num = $brand_rs->num_rows;

                                                                        for ($x = 0; $x < $brand_num; $x++) {
                                                                            $brand_data = $brand_rs->fetch_assoc();

                                                                        ?>
                                                                            <option value="<?php echo $brand_data["id"]; ?>"><?php echo $brand_data["name"]; ?></option>
                                                                        <?php

                                                                        }

                                                                        ?>
                                                                    </select>
                                                                </div>

                                                                <div class="col-12">
                                                                    <label class="form-label fs-6 fw-bold">&nbsp;Select Product Model</label>
                                                                </div>
                                                                <div class="col-7 col-lg-7 offset-lg-2 mb-3">
                                                                    <select class="form-select text-center border-top-0 border-start-0 border-end-0" id="model">
                                                                        <option value="0">Select Model</option>
                                                                        <?php

                                                                        $model_rs = Database::search("SELECT * FROM `model`");
                                                                        $model_num = $model_rs->num_rows;

                                                                        for ($s = 0; $s < $model_num; $s++) {
                                                                            $model_data = $model_rs->fetch_assoc();

                                                                        ?>
                                                                            <option value="<?php echo $model_data["id"]; ?>"><?php echo $model_data["name"]; ?></option>
                                                                        <?php


                                                                        }

                                                                        ?>
                                                                    </select>
                                                                </div>

                                                                <div class="col-12">
                                                                    <label class="form-label fs-6 fw-bold">&nbsp;Seller Email</label>
                                                                </div>
                                                                <div class="col-7 col-lg-7 offset-lg-2 mb-3">
                                                                    <input type="email" class="form-control border-top-0 border-start-0 border-end-0" placeholder="Email" id="sellerEmail">
                                                                </div>


                                                            </div>

                                                            <div class="col-5 offset-1 shadow bg-white rounded-4">

                                                                <div class="col-12 mt-5">
                                                                    <div class="row g-1">

                                                                        <div class="col-12 mt-5">
                                                                            <label class="form-label fw-bold fs-6">&nbsp;Add&nbsp;Title&nbsp;to&nbsp;your&nbsp;Product</label>
                                                                        </div>

                                                                        <div class="col-10 col-lg-10 offset-1 offset-lg-1">
                                                                            <input type="text" class="form-control border-top-0 border-start-0 border-end-0" placeholder="Title to your Product..." id="title">
                                                                        </div>

                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="col-12">
                                                        <div class="row g-0">

                                                            <div class="col-11 col-lg-3 offset-lg-0  shadow bg-white rounded-4 mt-3 ">
                                                                <div class="row ">
                                                                    <div class="col-12 mt-2 mb-3">
                                                                        <label class="form-label fw-bold fs-6">&nbsp;Select Product Condition</label>
                                                                    </div>

                                                                    <!-- radio button -->
                                                                    <div class="col-10 mb-3">
                                                                        <div class="form-check form-check-inline mx-2">
                                                                            <input class="form-check-input" type="radio" name="c" id="b" checked>
                                                                            <label class="form-check-label" for="b">Brandnew</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="c" id="u">
                                                                            <label class="form-check-label" for="u">Used</label>
                                                                        </div>
                                                                    </div>
                                                                    <!-- radio button -->

                                                                </div>
                                                            </div>
                                                            <div class="col-11 col-lg-3 offset-lg-1 shadow bg-white rounded-4 mt-3">
                                                                <div class="row gap-2">
                                                                    <div class="col-12 mt-2 mb-3">
                                                                        <label class="form-label fw-bold fs-6">&nbsp;Select Product Colour</label>
                                                                    </div>

                                                                    <div class="col-10 offset-1">
                                                                        <select class="form-select text-center border-top-0 border-start-0 border-end-0" id="color">
                                                                            <option value="0">Select Colour</option>
                                                                            <?php

                                                                            $colour_rs = Database::search("SELECT * FROM `color`");
                                                                            $colour_num = $colour_rs->num_rows;

                                                                            for ($x = 0; $x < $colour_num; $x++) {
                                                                                $colour_data = $colour_rs->fetch_assoc();

                                                                            ?>
                                                                                <option value="<?php echo $colour_data["id"]; ?>"><?php echo $colour_data["name"]; ?></option>
                                                                            <?php

                                                                            }


                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-10 offset-1">
                                                                        <div class="input-group mt-2 mb-3">
                                                                            <input type="text" class="form-control border-top-0 border-start-0 border-end-0" placeholder="Add New Colour..." id="color_in">
                                                                            <button class="btn btn-outline-warning border-top-0 border-start-0 border-end-0" type="button" id="button-addon2">+ Add</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-11 col-lg-3 offset-lg-1 shadow bg-white rounded-4 mt-3 ">
                                                                <div class="row">
                                                                    <div class="col-12 mt-2 mb-3">
                                                                        <label class="form-label fw-bold fs-6">&nbsp;Select Product Quantity</label>
                                                                    </div>

                                                                    <div class="col-10 offset-1 mb-3">
                                                                        <input type="number" class="form-control border-top-0 border-start-0 border-end-0" value="0" min="0" id="qty">
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-11 col-lg-12 mt-3">
                                                <div class="row g-1">

                                                    <div class="col-lg-5 offset-lg-0 shadow bg-white rounded-4">
                                                        <div class="row">
                                                            <div class="col-12 mt-3">
                                                                <label class="form-label fs-6 fw-bold">&nbsp;Cost Per Items</label>
                                                            </div>
                                                            <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                                <div class="input-group mb-3 mt-2">
                                                                    <span class="input-group-text border-top-0 border-start-0 border-end-0 bg-white">Rs.</span>
                                                                    <input type="text" class="form-control border-top-0 border-start-0 border-end-0" id="cost" placeholder="Add to Price............">
                                                                    <span class="input-group-text border-top-0 border-start-0 border-end-0 bg-white">.00</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-5 offset-lg-1 col-12 shadow bg-white rounded-4">
                                                        <div class="row">
                                                            <div class="col-12 mt-3">
                                                                <label class="form-label fs-6 fw-bold">&nbsp;Delivery Cost</label>
                                                            </div>
                                                            <div class="col-12 ">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <label class="form-label fs-6">&nbsp;Delivery cost within Colombo</label>
                                                                    </div>
                                                                    <div class=" col-12 col-lg-8 offset-lg-1">
                                                                        <div class="input-group mb-2 mt-2">
                                                                            <span class="input-group-text border-top-0 border-start-0 border-end-0 bg-white">Rs.</span>
                                                                            <input type="text" class="form-control border-top-0 border-start-0 border-end-0 bg-white" id="dcwc" placeholder="Add to price within Colombo...">
                                                                            <span class="input-group-text border-top-0 border-start-0 border-end-0 bg-white">.00</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 ">
                                                                <div class="row">
                                                                    <div class="col-12 ">
                                                                        <label class="form-label fs-6">&nbsp;Delivery cost out of Colombo</label>
                                                                    </div>
                                                                    <div class=" col-12 col-lg-8 mb-2 offset-lg-1">
                                                                        <div class="input-group mb-2 mt-2">
                                                                            <span class="input-group-text border-top-0 border-start-0 border-end-0 bg-white">Rs.</span>
                                                                            <input type="text" class="form-control border-top-0 border-start-0 border-end-0 bg-white" id="dcoc" placeholder="Add to Price Out of Colombo...">
                                                                            <span class="input-group-text border-top-0 border-start-0 border-end-0 bg-white">.00</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row g-1">

                                                    <div class="col-11 col-lg-11 shadow bg-white rounded-4  mt-3">
                                                        <div class="row g-1">

                                                            <div class="col-12 col-lg-12 mt-2 ">
                                                                <div class="row ">
                                                                    <div class="col-12 mt-2">
                                                                        <label class="form-label fs-6 fw-bold">&nbsp;Product Description</label>
                                                                    </div>
                                                                    <div class="col-12 mb-3">
                                                                        <textarea id="text" cols="35" rows="15" class="form-control border-top-0 border-start-0 border-end-0 " placeholder="Please Type Product Description.........."></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-11  shadow bg-white rounded-4  mt-3 mb-3">
                                                        <div class="row g-1">
                                                            <div class="col-12 mt-2">
                                                                <label class="form-label fw-bold fs-6">&nbsp;Add Product Images</label>
                                                            </div>
                                                            <div class="offset-lg-3 col-12 col-lg-6">
                                                                <div class="row g-2">
                                                                    <div class="col-4 border border-ligh ">
                                                                        <img src="resocess/addproductimg.svg" class="img-fluid shadow" style="height:200px  ;" id="i0">
                                                                    </div>
                                                                    <div class="col-4 border border-ligh ">
                                                                        <img src="resocess/addproductimg.svg" class="img-fluid shadow" style="height:200px ;" id="i1">
                                                                    </div>
                                                                    <div class="col-4 border border-ligh ">
                                                                        <img src="resocess/addproductimg.svg" class="img-fluid shadow" style="height:200px ;" id="i2">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                                                                <input type="file" class="d-none" id="imageUploader" multiple>
                                                                <label for="imageUploader" class="col-12 btn btn-info shadow" onclick="changeProductImage();">Upload Images</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-11 shadow bg-white rounded-4  mt-4 mb-3">
                                                        <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-4 mb-4">
                                                            <button class="btn btn-success shadow" onclick="productAdd();">Save Product</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>


                                        </div>
                                    </div>




                                </div>

                            </div>
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


            <script src="bootstrap.js"></script>
            <script src="script.js"></script>
        </div>
    </div>

</body>

</html>