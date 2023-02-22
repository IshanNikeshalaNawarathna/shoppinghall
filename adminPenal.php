<?php

session_start();

require "connection.php";

if (isset($_SESSION["admin"])) {

?>



    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="icon" href="resocess/webLogo/logo.jpg">
        <title>Shoppin Hall | Admin Panel</title>
    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

                <?php include "adminHeader.php"; ?>

                <div class="col-12">
                    <div class="row">

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
                                                                <img src="resocess/projectUser.png" class="img-fluid rounded-start" style="background-repeat: no-repeat;height: 65px;width: auto;">
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

                                                <div class="nav flex-column nav-pills me-3 mt-4">
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

                                <div class="col-12 col-lg-9">
                                    <div class="row g-1">

                                        <div class="mt-3 mb-1 ">
                                            <label class="form-label fs-4">Dashboard</label>
                                        </div>

                                        <div style="width: 100%;">
                                            <hr class="border border-2 rounded-4 border-info">
                                        </div>

                                        <div class="col-12">
                                            <div class="row g-1">

                                                <div class="col-5 col-lg-3 offset-1 offset-lg-1 px-2 mb-2">
                                                    <div class="row g-1">
                                                        <div class="col-12 text-center text-white border-primary  border-5 border-start  rounded-2" style="height: 100px;background-color:  #aed6f1 ;color: #7f8c8d  ;"><br>
                                                            <span class="fs-4 ">Earnings<span class="fs-6 text-primary">(Daily)</span></span><br>
                                                            <?php

                                                            $today = date("Y-m-d");
                                                            $thisMonth = date("m");
                                                            $thisYear = date("Y");

                                                            $ab = "0";
                                                            $dc = "0";
                                                            $ef = "0"; //total qty
                                                            $gh = "0";
                                                            $ij = "0";

                                                            $invoice_rs = Database::search("SELECT * FROM `invoice`");
                                                            $invoice_num = $invoice_rs->num_rows;

                                                            for ($x = 0; $x < $invoice_num; $x++) {
                                                                $invoice_data = $invoice_rs->fetch_assoc();

                                                                $ef = $ef + $invoice_data["qty"]; // total qty

                                                                $date = $invoice_data["date"];
                                                                $splitDate = explode(" ", $date); //separate date from time
                                                                $pdate = $splitDate[0]; //sold date

                                                                if ($pdate == $today) {
                                                                    $ab = $ab + $invoice_data["total"];
                                                                    $dc = $dc + $invoice_data["qty"];
                                                                }

                                                                $splitMonth = explode("-", $pdate); //separte date as year , month ,date
                                                                $pyear = $splitMonth[0]; //year
                                                                $pmonth = $splitMonth[1]; //month

                                                                if ($pyear == $thisMonth) {

                                                                    if ($pmonth == $thisMonth) {
                                                                        $gh = $gh + $invoice_data["total"];
                                                                        $ij = $ij + $invoice_data["qty"];
                                                                    }
                                                                }
                                                            }

                                                            ?>
                                                            <span class="fs-4 fw-bold">Rs.<?php echo $ab; ?>.00</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-5 col-lg-3 offset-1 offset-lg-1 px-2 mb-2">
                                                    <div class="row g-1">
                                                        <div class="col-12 text-center border-warning text-white border-5 border-start  rounded-2" style="height: 100px;background-color:  #fcf3cf  ;color: #7f8c8d  ;"><br>
                                                            <span class="fs-4">Earnings<span class="fs-6 text-primary">(Monthly)</span></span><br>
                                                            <span class="fs-4 fw-bold">Rs.<?php echo $dc; ?>.00</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-5 col-lg-3 offset-1 offset-lg-1 px-2 mb-2">
                                                    <div class="row g-1">
                                                        <div class="col-12 text-center border-secondary  text-white border-5 border-start  rounded-2" style="height: 100px;background-color: #d5d8dc  ;color: #7f8c8d  ;"><br>
                                                            <span class="fs-4 ">Today<span class="fs-6 text-primary">(Selling)</span></span><br>
                                                            <span class="fs-4 fw-bold"><?php echo $ef; ?>Items</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-5 col-lg-3 offset-1 offset-lg-1 px-2 mb-2">
                                                    <div class="row g-1">
                                                        <div class="col-12 text-center border-dark text-white border-5 border-start   rounded-2" style="height: 100px;background-color: #eaecee  ;color: #7f8c8d  ;"><br>
                                                            <span class="fs-4">Monthly<span class="fs-6 text-primary">(Selling)</span></span><br>
                                                            <span class="fs-4 fw-bold"><?php echo $gh; ?>Items</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-5 col-lg-3 offset-1 offset-lg-1 px-2 mb-2">
                                                    <div class="row g-1">
                                                        <div class="col-12 text-center border-success  text-white border-5 border-start  rounded-2" style="height: 100px;background-color: #d5f5e3  ;color: #7f8c8d  ;"><br>
                                                            <span class="fs-4">Today<span class="fs-6 text-primary">(Selling)</span></span><br>
                                                            <span class="fs-4 fw-bold"><?php echo $ij; ?>Items</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-5 col-lg-3 offset-1 offset-lg-1 px-2 mb-2">
                                                    <div class="row g-1">
                                                        <div class="col-12 text-center border-danger  text-white border-5 border-start rounded-2" style="height: 100px;background-color: #f2d7d5  ;color: #7f8c8d  ;"><br>
                                                            <span class="fs-4">Total<span class="fs-6 text-primary">(Engagements)</span></span><br>
                                                            <?php

                                                            $user_rs = Database::search("SELECT * FROM `user`");
                                                            $user_num = $user_rs->num_rows;

                                                            ?>

                                                            <span class="fs-4 fw-bold"><?php echo $user_num; ?>Members</span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div style="width:80%;">
                                            <hr>
                                        </div>

                                        <div class="col-12">
                                            <div class="row">


                                                <div class="col-10 offset-1 col-lg-10 offset-lg-1  rounded-4 bg-white">
                                                    <div class="row g-1">

                                                        <div class="col-12 col-lg-5 ">

                                                            <div class="card mb-3" style="max-width: 640px;">
                                                                <div class="row">

                                                                    <?php

                                                                    $mostSaldItmes_rs = Database::search("SELECT `product_id`,COUNT(`product_id`) AS `value_occurence` FROM `invoice` WHERE `date` LIKE '%" . $today . "%' GROUP BY `product_id` ORDER BY `value_occurence` DESC LIMIT 1");
                                                                    $mostSaldItmes_num = $mostSaldItmes_rs->num_rows;

                                                                    if ($mostSaldItmes_num > 0) {
                                                                        $mostSaldItmes_data = $mostSaldItmes_rs->fetch_assoc();

                                                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $mostSaldItmes_data["product_id"] . "'");
                                                                        $product_data = $product_rs->fetch_assoc();

                                                                        $img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $mostSaldItmes_data["product_id"] . "'");
                                                                        $img_data = $img_rs->fetch_assoc();

                                                                        $qty_rs = Database::search("SELECT SUM(`qty`) AS `total_qty` FROM `invoice` WHERE `product_id`='" . $mostSaldItmes_data["product_id"] . "' AND `date` LIKE '%" . $today . "%'");
                                                                        $qty_data = $qty_rs->fetch_assoc();

                                                                    ?>


                                                                        <div class="col-md-4  mt-4 mb-2">
                                                                            <img src="<?php echo $img_data["code"]; ?>" class="img-fluid rounded-start offset-1" style="background-repeat: no-repeat; height: 150px; width: auto; ">
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <div class="card-body">
                                                                                <div class="col-12 mt-3 mb-1">
                                                                                    <div class="row">
                                                                                        <div class="col-3">
                                                                                            <div class="first-place"></div>
                                                                                        </div>
                                                                                        <div class="col-8 px-1">
                                                                                            <h5 class="card-title fs-3 text-info fw-bold">Most Sold Itme</h5>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <p class="fw-bold fs-5"><?php echo $product_data["title"]; ?></p>
                                                                                <p class="fs-5 text-primary"><?php echo $qty_data["total_qty"]; ?>&nbsp;Items</p>
                                                                                <p class="fs-5 text-primary">Rs.<?php echo $qty_data["total_qty"] * $product_data["price"]; ?>.00</p>
                                                                            </div>
                                                                        </div>

                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <div class="col-md-4 mt-4 mb-4">
                                                                            <img src="resocess/gift.png" class="img-fluid rounded-start offset-1" style="background-repeat: no-repeat; height:100px; width: auto;">
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <div class="card-body">
                                                                                <h5 class="card-title fs-3 text-info fw-bold">Most Sold Itme</h5>
                                                                                <p class="fw-bold fs-5">*******************</p>
                                                                                <p class="fs-6">******Items</p>
                                                                                <p class="col-6">Rs.***********.00</p>
                                                                            </div>
                                                                        </div>

                                                                    <?php

                                                                    }

                                                                    ?>



                                                                </div>
                                                            </div>

                                                        </div>





                                                        <div class="col-12 col-lg-7 ">

                                                            <div class="card mb-3" style="max-width: 640px;">
                                                                <div class="row g-1">
                                                                    <?php

                                                                    if ($mostSaldItmes_num > 0) {

                                                                        $profileProcess_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $product_data["user_email"] . "'");
                                                                        $profileProcess_data = $profileProcess_rs->fetch_assoc();

                                                                        $productUser_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                                                        $productUser_data = $productUser_rs->fetch_assoc();
                                                                    ?>
                                                                        <div class="col-md-4  mt-4">
                                                                            <img src="<?php echo $profileProcess_data["path"]; ?>" class="img-fluid rounded-start offset-1" style="background-repeat: no-repeat;height: 150px;width: auto;">
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <div class="card-body">
                                                                                <div class="col-12 mt-3 mb-3">
                                                                                    <div class="row">
                                                                                        <div class="col-3">
                                                                                            <div class="first-place"></div>
                                                                                        </div>
                                                                                        <div class="col-8 ">
                                                                                            <h5 class="card-title fs-3 text-info fw-bold">Most Famouse Seller</h5>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <p class="fw-bold fs-5"><?php echo $productUser_data["fname"] . " " . $productUser_data["lname"]; ?></p>
                                                                                <p class="fs-6"><?php echo $productUser_data["email"]; ?></p>
                                                                                <p class="col-6"><?php echo $productUser_data["mobile"]; ?></p>
                                                                            </div>
                                                                        </div>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <div class="col-md-4">
                                                                            <img src="resocess/projectUser.png" class="img-fluid rounded-start" style="background-repeat: no-repeat;height: 150px;width: auto;">
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <div class="card-body">
                                                                                <h5 class="card-title fs-3 text-info fw-bold">Most Famouse Seller</h5>
                                                                                <p class="fw-bold fs-5">********************</p>
                                                                                <p class="fs-6">***********@gmil.com</p>
                                                                                <p class="col-6">07******</p>
                                                                            </div>
                                                                        </div>
                                                                    <?php
                                                                    }
                                                                    ?>
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

                                <div class="col-6">
                                    <label class="form-label fs-5 fw-bold">Frist Name</label>
                                    <input type="text" class="form-control" placeholder="Frist Name" id="fname">
                                </div>
                                <div class="col-6">
                                    <label class="form-label fs-5 fw-bold">Last Name</label>
                                    <input type="text" class="form-control" placeholder="Last Name" id="lname">
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
    </body>

    </html>

<?php

} else {
?>
    <script>
        window.location = "adminLogin.php";
    </script>
<?php
}

?>