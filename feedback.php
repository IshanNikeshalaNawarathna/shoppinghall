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
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="icon" href="resocess/webLogo/logo.jpg">
    <title>Shopping Hall | Feedback</title>
</head>

<body style="overflow-x: hidden;">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 shadow-sm ">
                <div class="row">
                    <?php include "header.php"; ?>
                </div>
            </div>
            <div class="col-12 mt-3 mb-0 bg-white shadow-sm  rounded-4">
                <div class="row">
                    <div class="col-12  mt-1 ">
                        <span class="fs-2  fw-bold"><b class="mt-5">&nbsp;<i class="bi bi-star-fill text-warning submit_star fs-2"></i><i class="bi bi-star-fill text-warning submit_star fs-2"></i><i class="bi bi-star-fill text-warning submit_star fs-2"></i></b>&nbsp;|&nbsp;Feedback</span>

                        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                            <ol class="breadcrumb bg-white">
                                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Feedback</li>
                            </ol>
                        </nav>

                    </div>

                    <div class="col-6 col-lg-7">
                        <hr class="border border-4 border-warning rounded-4">
                    </div>
                </div>
            </div>

            <div class="col-12 mt-3 shadow ">
                <div class="row g-4">

                    <div class="col-10 offset-1 col-lg-10 offset-lg-1 shadow mt-5 mb-3 rounded-4">
                        <div class="row g-3">

                            <div class="col-10 offset-1 col-lg-6 mt-5 mb-4 rounded-4 shadow ">
                                <div class="row g-2">

                                    <?php
                                    $feedback_product_images_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $_GET["id"] . "'");
                                    $feedback_product_images_data = $feedback_product_images_rs->fetch_assoc();
                                    $title_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $_GET["id"] . "'");
                                    $title_data = $title_rs->fetch_assoc();

                                    ?>
                                    <div class="col-12 mt-5">
                                        <div class="row">

                                            <div class="col-9 offset-2 col-lg-9 offset-lg-3  mb-4">
                                                <div class="row">
                                                    <div class="col-12 col-lg-7 mt-3 ms-3">
                                                        <img src="<?php echo $feedback_product_images_data["code"]; ?>" class="imgView mb-3 " style="height: 300px;width: auto;background-repeat: no-repeat;">
                                                        <h3 class="card-title mt-2 ms-lg-4 ms-4"><?php echo $title_data["title"]; ?></h3>
                                                    </div>

                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-5 col-12 ">
                                <div class="row">

                                    <div class="col-10 offset-1 col-lg-10 offset-lg-1 shadow-lg  rounded-4 mt-3 mb-4">
                                        <div class="row">
                                            <div class="col-12 mt-lg-5 mt-4 mb-3 mb-lg-0">
                                                <div class="row">
                                                <label class="form-label fs-2 fw-bold">Reviews & Ratings</label>
                                                </div>
                                            </div>
                                        
                                            <div class="col-md-5 text-center ">
                                                <span class="badge pt-lg-5 mt-4 mt-lg-0" style="cursor: pointer;">
                                                    <input class="d-none" type="text" value="<?php echo $_GET["id"]; ?>" id="pid" />

                                                    <?php

                                                    $star_rs = Database::search("SELECT * FROM `rating` WHERE `user_email`='" . $_SESSION["u"]["email"] . "' AND `product_id`='" . $_GET["id"] . "'");
                                                    $star_num = $star_rs->num_rows;

                                                    if ($star_num != 0) {
                                                        $star_data = $star_rs->fetch_assoc();
                                                        $rate = $star_data["rate_count"];

                                                        if ($rate == 1) {

                                                    ?>

                                                            <i class="bi bi-star-fill text-warning submit_star fs-1" id="submit_star_1" data-rating="1"></i>
                                                            <i class="bi bi-star-fill text-secondary submit_star fs-1" id="submit_star_2" data-rating="2"></i>
                                                            <i class="bi bi-star-fill text-secondary submit_star fs-1" id="submit_star_3" data-rating="3"></i>
                                                            <i class="bi bi-star-fill text-secondary submit_star fs-1" id="submit_star_4" data-rating="4"></i>
                                                            <i class="bi bi-star-fill text-secondary submit_star fs-1" id="submit_star_5" data-rating="5"></i>

                                                        <?php

                                                        } else if ($rate == 2) {

                                                        ?>

                                                            <i class="bi bi-star-fill text-warning submit_star fs-1" id="submit_star_1" data-rating="1"></i>
                                                            <i class="bi bi-star-fill text-warning submit_star fs-1" id="submit_star_2" data-rating="2"></i>
                                                            <i class="bi bi-star-fill text-secondary submit_star fs-1" id="submit_star_3" data-rating="3"></i>
                                                            <i class="bi bi-star-fill text-secondary submit_star fs-1" id="submit_star_4" data-rating="4"></i>
                                                            <i class="bi bi-star-fill text-secondary submit_star fs-1" id="submit_star_5" data-rating="5"></i>

                                                        <?php

                                                        } else if ($rate == 3) {

                                                        ?>

                                                            <i class="bi bi-star-fill text-warning submit_star fs-1" id="submit_star_1" data-rating="1"></i>
                                                            <i class="bi bi-star-fill text-warning submit_star fs-1" id="submit_star_2" data-rating="2"></i>
                                                            <i class="bi bi-star-fill text-warning submit_star fs-1" id="submit_star_3" data-rating="3"></i>
                                                            <i class="bi bi-star-fill text-secondary submit_star fs-1" id="submit_star_4" data-rating="4"></i>
                                                            <i class="bi bi-star-fill text-secondary submit_star fs-1" id="submit_star_5" data-rating="5"></i>

                                                        <?php

                                                        } else if ($rate == 4) {

                                                        ?>

                                                            <i class="bi bi-star-fill text-warning submit_star fs-1" id="submit_star_1" data-rating="1"></i>
                                                            <i class="bi bi-star-fill text-warning submit_star fs-1" id="submit_star_2" data-rating="2"></i>
                                                            <i class="bi bi-star-fill text-warning submit_star fs-1" id="submit_star_3" data-rating="3"></i>
                                                            <i class="bi bi-star-fill text-warning submit_star fs-1" id="submit_star_4" data-rating="4"></i>
                                                            <i class="bi bi-star-fill text-secondary submit_star fs-1" id="submit_star_5" data-rating="5"></i>

                                                        <?php

                                                        } else if ($rate == 5) {

                                                        ?>

                                                            <i class="bi bi-star-fill text-warning submit_star fs-1" id="submit_star_1" data-rating="1"></i>
                                                            <i class="bi bi-star-fill text-warning submit_star fs-1" id="submit_star_2" data-rating="2"></i>
                                                            <i class="bi bi-star-fill text-warning submit_star fs-1" id="submit_star_3" data-rating="3"></i>
                                                            <i class="bi bi-star-fill text-warning submit_star fs-1" id="submit_star_4" data-rating="4"></i>
                                                            <i class="bi bi-star-fill text-warning submit_star fs-1" id="submit_star_5" data-rating="5"></i>

                                                        <?php

                                                        } else {

                                                        ?>

                                                            <i class="bi bi-star-fill text-secondary submit_star fs-1" id="submit_star_1" data-rating="1"></i>
                                                            <i class="bi bi-star-fill text-secondary submit_star fs-1" id="submit_star_2" data-rating="2"></i>
                                                            <i class="bi bi-star-fill text-secondary submit_star fs-1" id="submit_star_3" data-rating="3"></i>
                                                            <i class="bi bi-star-fill text-secondary submit_star fs-1" id="submit_star_4" data-rating="4"></i>
                                                            <i class="bi bi-star-fill text-secondary submit_star fs-1" id="submit_star_5" data-rating="5"></i>

                                                        <?php

                                                        }
                                                    } else {

                                                        ?>

                                                        <i class="bi bi-star-fill text-secondary submit_star fs-1" id="submit_star_1" data-rating="1"></i>
                                                        <i class="bi bi-star-fill text-secondary submit_star fs-1" id="submit_star_2" data-rating="2"></i>
                                                        <i class="bi bi-star-fill text-secondary submit_star fs-1" id="submit_star_3" data-rating="3"></i>
                                                        <i class="bi bi-star-fill text-secondary submit_star fs-1" id="submit_star_4" data-rating="4"></i>
                                                        <i class="bi bi-star-fill text-secondary submit_star fs-1" id="submit_star_5" data-rating="5"></i>

                                                    <?php

                                                    }

                                                    ?>

                                                </span>
                                            </div>

                                            <hr class="offset-1 col-10 border border-3 border-primary mt-5" />

                                            <div class="col-12 mt-3">
                                                <div class="row">
                                                    <label class="form-label fs-4 fw-bold">Feedback Message</label>
                                                </div>
                                            </div>

                                            <div class="offset-1 col-10 mt-3">
                                                <textarea class="form-control border-end-0 border-start-0 border-start-0 border-top-0" id="user_review" placeholder="Enter Feedback Message..." cols="30" rows="10"></textarea>
                                            </div>

                                            <div class="offset-1 offset-lg-4 col-10 col-lg-4 d-grid mt-3 mb-4 ">
                                                <button class="btn btn-warning rounded-5 shadow" id="save_review">Send Feedback <i class="bi bi-send-fill"></i></button>

                                            </div>

                                        </div>
                                    </div>


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

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script>
        var fm;

        $(document).ready(function() {

            var rating_data = 0;

            $(document).on('mouseenter', '.submit_star', function() {

                var rating = $(this).data('rating');

                reset_background();

                for (var count = 1; count <= rating; count++) {

                    $('#submit_star_' + count).addClass('text-warning');

                }

            });

            function reset_background() {
                for (var count = 1; count <= 5; count++) {

                    $('#submit_star_' + count).addClass('text-secondary');

                    $('#submit_star_' + count).removeClass('text-warning');

                }
            }

            $(document).on('mouseleave', '.submit_star', function() {

                reset_background();

                for (var count = 1; count <= rating_data; count++) {

                    $('#submit_star_' + count).removeClass('text-secondary');

                    $('#submit_star_' + count).addClass('text-warning');
                }

            });

            $(document).on('click', '.submit_star', function() {

                rating_data = $(this).data('rating');

            });

            $('#save_review').click(function() {

                var user_review = $('#user_review').val();
                var pid = $('#pid').val();

                $.ajax({
                    url: "saveRate.php",
                    method: "POST",
                    data: {
                        rating_data: rating_data,
                        user_review: user_review,
                        pid: pid
                    },
                    success: function(text) {



                        if (text == "1" || text == "2" || text == "3" || text == "13" || text == "23") {
                            alert("Feedback Send");
                            window.location = "purchasingHistory.php";
                        } else {
                            alert(text);
                        }

                    }
                })

            });
        });
    </script>

</body>

</html>