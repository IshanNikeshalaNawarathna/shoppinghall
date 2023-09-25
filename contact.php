<?php
session_start();

if (isset($_SESSION["u"])) {



?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="bootstrap.css" />
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" /> -->
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
                        include "header.php"; ?>
                    </div>
                </div>

                <div class="col-12">
                    <div class="row">

                        <div class="col-12 mb-2  shadow-sm  rounded-4 mt-3">
                            <div class="row  bg-body ">
                                <div class="col-12 mt-2">
                                    <label class="form-label fs-1 fw-bold"><i class="bi bi-cart-plus-fill fs-1"></i>&nbsp;|
                                        Contact</label>
                                </div>
                                <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                                    <ol class="breadcrumb bg-white">
                                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Contact</li>
                                    </ol>
                                </nav>
                                <div class="col-7 col-lg-6">
                                    <hr class="border border-5 bg-warning border-warning rounded-3">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-12 ">
                    <div class="row">

                        <div class="col-lg-7 col-12 mt-5 mb-5">

                            <div class="col-12 shadow bg-white rounded-4 ">
                                <div class="row">

                                    <div class="col-6 mt-4">



                                        <div class="col-12">
                                            <div class="row">

                                                <div class="col-12 text-center mb-3 ">
                                                    <?php

                                                    $user_profile_img_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
                                                    $user_profile_img_data = $user_profile_img_rs->fetch_assoc();

                                                    if (empty($user_profile_img_data["path"])) {

                                                    ?>
                                                        <img src="resocess/projectUser.png" style="height: 100px;width: auto;" class="rounded-circle">
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <img src="<?php echo $user_profile_img_data["path"]; ?>" style="height: 100px;width: auto;" class="rounded-circle">
                                                    <?php
                                                    }

                                                    ?>

                                                </div>

                                                <div class="col-12 mb-3 ms-3">
                                                    <label class="form-label fw-bold fs-5">Email</label>
                                                    <input type="text" class="form-control" value="<?php echo $_SESSION["u"]["email"]; ?> " readonly>

                                                    <?php

                                                    $admin_email = Database::search("SELECT * FROM `admin`");
                                                    $admin_email_data = $admin_email->fetch_assoc();


                                                    ?>

                                                    <input type="text" class="form-control d-none" value="<?php echo $admin_email_data["email"]; ?> " readonly id="email">
                                                </div>

                                                <div class="col-12 mb-3 ms-3">
                                                    <textarea class="form-control" cols="5" rows="2" placeholder="Message" id="typeMsg"></textarea>
                                                </div>


                                                <div class="col-5 ms-3  d-grid mb-3">
                                                    <button class="btn btn-warning text-white rounded-4 shadow" onclick="adminSendMsg();">Send
                                                        Message<i class="bi bi-send-fill"></i></button>
                                                </div>


                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-6 mt-4">

                                        <div class="col-12">
                                            <div class="row">


                                                <div class="col-10 rounded-3 shadow ms-4 bg-light">
                                                    <div class=" row " style="overflow-y: scroll;height: 40vh;">

                                                        <!-- <div class="modal-body" style="overflow-y: scroll; height: 40vh;"> -->

                                                        <?php
                                                        $sender_mail = $_SESSION["u"]["email"];

                                                        $msg_rs = Database::search("SELECT * FROM `admin_chat` WHERE `user_email`='" . $sender_mail . "'");
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



                                                            for ($y = 0; $y < $msg_num; $y++) {
                                                                $msg_data = $msg_rs->fetch_assoc();

                                                                if ($msg_data["status"] == "1") {

                                                                    $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $msg_data["user_email"] . "'");
                                                                    $user_data = $user_rs->fetch_assoc();

                                                            ?>

                                                                    <!-- send -->
                                                                    <div class="col-12 mt-2">
                                                                        <div class="row">
                                                                            <div class="offset-3 col-8 rounded-5 shadow bg-dark">
                                                                                <div class="row">
                                                                                    <div class="col-12 pt-1 mt-2 ms-2">
                                                                                        <span class="text-white fw-bold "><?php echo $msg_data["content"]; ?></span>
                                                                                    </div>
                                                                                    <div class="col-12 text-end ">
                                                                                        <span class="text-white fs-6"><?php echo $msg_data["date_time"]; ?></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- send -->

                                                                <?php

                                                                } else if ($msg_data["status"] == "2") {
                                                                ?>

                                                                    <!-- received -->
                                                                    <div class="col-12 mt-2">
                                                                        <div class="row">
                                                                            <div class="col-8 rounded-5 shadow bg-white ms-3">
                                                                                <div class="row">
                                                                                    <div class="col-12 pt-1 mt-2 ms-2">
                                                                                        <span class="text-dark fw-bold "><?php echo $msg_data["content"]; ?></span>
                                                                                    </div>
                                                                                    <div class="col-12 text-end mb-2">
                                                                                        <span class="text-dark fs-6"><?php echo $msg_data["date_time"]; ?></span>
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

                                </div>

                            </div>
                        </div>



                        <div class="col-12 col-lg-5 mt-5">

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

            <?php include "fooler.php"; ?>

        </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>

    </body>

    </html>
<?php
} else {
?>
    <script>
        window.location = "home.php";
    </script>
<?php
}
