<?php

session_start();

if (isset($_GET["email"])) {
    $userName = $_GET["email"];
    $adminEmail = $_SESSION["admin"]["email"];


?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="style.css">
        <title>Shopping Hall | Contact</title>
        <link rel="icon" href="resocess/webLogo/logo.jpg">
    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

                <div class="col-12 shadow-sm mt-3 mb-3">
                    <div class="row">
                        <?php
                        require "connection.php";
                        include "adminHeader.php"; ?>
                    </div>
                </div>

                <div class="col-12 ">
                    <div class="row">

                        <div class="col-12 shadow-sm bg-white rounded-4 mt-4">
                            <div class="row">
                                <div class="col-6 col-lg-4 offset-2 offset-lg-3 mb-3">
                                    <input type="text" class="form-control" placeholder="Search her..." id="basicSearchText">
                                </div>
                                <div class="col-3 col-lg-2 d-grid mb-3">
                                    <button class="btn btn-primary shadow rounded-3" onclick="basicSearchAdmin(0);">Search</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-12">
                    <div class="row">

                        <div class="col-12 col-lg-3 border border-2   border-start-0 border-top-0 border-bottom-0 ">
                            <div class="row">

                                <div class="col-10 col-lg-10 offset-1 offset-lg-1 rounded-4 shadow bg-white mt-5">
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
                                                                <img src="<?php echo $admin_img_data["path"]; ?>" style="height: 65px;width: auto;background-repeat: no-repeat;">
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <img src="resocess/profile-im.png" style="height: 65px;width: auto;background-repeat: no-repeat;">
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
                                                        <a class="nav-link text-dark fs-5 mb-3" href="adminPenal.php">Dashboard</a>
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
                            </div>
                        </div>


                        <div class="col-12 col-lg-9" id="basicRsesult">
                            <div class="row">

                                <div class="col-12 mt-3 ">
                                    <label class="form-label fs-4 fw-bold">Contact</label>
                                    <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                                        <ol class="breadcrumb bg-white">
                                            <li class="breadcrumb-item"><a href="adminPenal.php">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Contact</li>
                                        </ol>
                                    </nav>
                                </div>

                                <div class="col-12">
                                    <hr style="width: 90%;" class="border border-2 border-info rounded-4">
                                </div>

                                <div class="col-12 ">
                                    <div class="row">

                                        <div class="col-lg-6 col-6 mt-5 mb-5">

                                            <div class="col-12 shadow bg-white rounded-4 ">
                                                <div class="row">

                                                    <div class="col-11 ms-2 ms-lg-0 col-lg-9 mt-4">
                                                        <div class="row">


                                                            <div class="col-12">
                                                                <div class="row">

                                                                    <div class="col-12 text-center mb-3 ms-o ms-lg-5">
                                                                        <?php

                                                                        $admin_profile_img_rs = Database::search("SELECT * FROM `admin_profile` WHERE `admin_email`='" . $_SESSION["admin"]["email"] . "'");
                                                                        $admin_profile_img_data = $admin_profile_img_rs->fetch_assoc();

                                                                        if (empty($admin_profile_img_data["path"])) {

                                                                        ?>
                                                                            <img src="resocess/projectUser.png" style="height: 100px;width: auto;" class="rounded-circle">
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                            <img src="<?php echo $admin_profile_img_data["path"]; ?>" style="height: 100px;width: auto;" class="rounded-circle">
                                                                        <?php
                                                                        }

                                                                        ?>

                                                                    </div>

                                                                    <div class="col-12 mb-3 ms-0 ms-lg-5 ">
                                                                        <label class="form-label fw-bold fs-5 ms-1">Email</label>
                                                                        <input type="text" class="form-control ms-1" value="<?php echo $_SESSION["admin"]["email"]; ?> " readonly>

                                                                        <?php

                                                                        $senderUser = Database::search("SELECT * FROM `user` WHERE `email`='" . $userName . "'");
                                                                        $senderData = $senderUser->fetch_assoc();

                                                                        ?>


                                                                        <input type="text" class="form-control d-none" value="<?php echo $senderData["email"]; ?> " readonly id="email">
                                                                    </div>

                                                                    <div class="col-12 mb-3 ms-0 ms-lg-5">
                                                                        <textarea class="form-control ms-1" cols="5" rows="2" placeholder="Message" id="typeMsg"></textarea>
                                                                    </div>


                                                                    <div class="col-8 ms-0 ms-lg-5  d-grid mb-3">
                                                                        <button class="btn btn-warning text-white rounded-4 shadow ms-1" onclick="adminSendMsg();">Send
                                                                            Message<i class="bi bi-send-fill"></i></button>
                                                                    </div>


                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-6">

                                            <div class="col-12">
                                                <div class="row">


                                                    <div class="col-10 rounded-3 shadow ms-4 bg-light">
                                                        <div class=" row " style="overflow-y: scroll;height: 55vh;">

                                                            <!-- <div class="modal-body" style="overflow-y: scroll; height: 40vh;"> -->

                                                            <?php
                                                            $sender_mail = $_SESSION["admin"]["email"];

                                                            $msg_rs = Database::search("SELECT * FROM `admin_chat` WHERE `user_email`='" . $userName . "'");
                                                            // $msg_rs = Database::search("SELECT * FROM `admin_chat` WHERE `user_email`='".$_SESSION["u"]["email"]."'");
                                                            $msg_num = $msg_rs->num_rows;

                                                            if ($msg_num == 0) {

                                                            ?>
                                                                <div class="col-12 text-cente d-flex justify-content-center">
                                                                    <div class="row align-content-center">
                                                                        <span class="text-black fs-3 text-center">Not Message Yet..</span>
                                                                    </div>
                                                                </div>
                                                                <?php

                                                            } else {

                                                                $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $userName . "'");
                                                                $user_data = $user_rs->fetch_assoc();


                                                                $recever_mail = $_SESSION["admin"]["email"];


                                                                $admin_msg_rs = Database::search("SELECT * FROM `admin_chat` WHERE `user_email`='" . $user_data["email"] . "'");
                                                                $admin_msg_num = $admin_msg_rs->num_rows;

                                                                for ($y = 0; $y < $admin_msg_num; $y++) {
                                                                    $admin_msg_data = $admin_msg_rs->fetch_assoc();

                                                                    if ($admin_msg_data["status"] == "2" && $admin_msg_data["admin_email"]) {

                                                                ?>

                                                                        <!-- send -->
                                                                        <div class="col-12 mt-1">
                                                                            <div class="row">
                                                                                <div class="offset-3 col-8 rounded-5 shadow bg-white">
                                                                                    <div class="row">
                                                                                        <div class="col-12 pt-1 mt-2 ms-2">
                                                                                            <span class="text-dark fw-bold "><?php echo $admin_msg_data["content"]; ?></span>
                                                                                        </div>
                                                                                        <div class="col-12 text-end ">
                                                                                            <span class="text-dark fs-6"><?php echo $admin_msg_data["date_time"]; ?></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- send -->

                                                                    <?php

                                                                    } else if ($admin_msg_data["status"] == "1" && $admin_msg_data["user_email"]) {
                                                                    ?>

                                                                        <!-- received -->
                                                                        <div class="col-12 mt-2">
                                                                            <div class="row">
                                                                                <div class="col-8 rounded-5 shadow bg-dark ms-3">
                                                                                    <div class="row">
                                                                                        <div class="col-12 pt-1 mt-2 ms-2">
                                                                                            <span class="text-white fw-bold "><?php echo $admin_msg_data["content"]; ?></span>
                                                                                        </div>
                                                                                        <div class="col-12 text-end">
                                                                                            <span class="text-white fs-6"><?php echo $admin_msg_data["date_time"]; ?></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- received -->

                                                            <?php

                                                                    }
                                                                }
                                                            }
                                                            ?>

                                                            <!-- </div> -->
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-12 col-lg-12 mt-5">

                                            <div class="col-12 mt-3">
                                                <div class="row">

                                                    <label class="form-label fw-bold fs-4 text-center ">Contact Us</label>
                                                    <p class="text-center fs-5"><i class="bi bi-house-fill"></i> Colombo, Colombo 10, Sri
                                                        Lanka</p>
                                                    <p class="text-center fs-5"><i class="bi bi-at"></i> shoppinghall@gmail.com</p>
                                                    <p class="text-center fs-5"><i class="bi bi-telephone-fill"></i> +94112 4445558</p>
                                                    <p class="text-center fs-5"><i class="bi bi-printer-fill"></i> +94112 4445558</p>

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





        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>

    </body>

    </html>
<?php
}else{
    ?>
    <script>
        window.location = "adminLogin.php";
    </script>
    <?php
}
?>