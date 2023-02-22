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
</head>

<body>
    <div class="container-fluid">
        <div class="row">

            <nav class="navbar navbar-expand-lg bg-body navbar-body py-3 py-lg-0 px-0">
                <div class="col-12  ">
                    <div class="row">

                        <div class="col-6 mt-2">
                            <span class="text-decoration-none d-block d-lg-none ">
                                <h1 class="ms-3">Shopping Hall</h1>
                                <span class="text-muted fs-5 ms-3">Admin Penal.</span>
                            </span>
                        </div>
                        <div class="col-6">
                            <nav class="navbar  offset-9 offset-lg-0 mt-0 ">
                                <div class="container-fluid">
                                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="collapse" id="navbarToggleExternalContent">
                    <div class="nav flex-column nav-pills me-3 mt-3">
                        <nav class="nav flex-column">
                            <a class="nav-link text-dark fs-5 mb-3" href="adminPenal.php">Dashboard</a>
                            <a class="nav-link text-dark fs-5 mb-3" href="manageUser.php">Manage Users</a>
                            <a class="nav-link text-dark fs-5 mb-3" href="manageProduct.php">Manage Products</a>
                            <a class="nav-link text-dark fs-5 mb-3" href="productAdd.php">Add Product</a>
                            <a class="nav-link text-dark fs-5 mb-3" href="sellingHistory.php">Selling History</a>
                            <!-- <a class="nav-link text-dark fs-5 mb-3" href="manageProduct.php">Sgin Out</a> -->

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
                                            <span class="text-lg-start fw-bold fs-5">&nbsp;&nbsp;<a class="nav-item text-danger text-decoration-none ms-3 fs-5" onclick="adminSignOut();">Sign Out</a></span>
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



            </nav>



        </div>
    </div>

<script src="script.js"></script>
</body>

</html>