<?php
session_start();
require "connection.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="resocess/webLogo/logo.jpg">

    <title>Shopping Hall | <?php echo $_GET["title"]; ?></title>
</head>

<body>

    <?php
    $mobile_rs = Database::search("SELECT SUBSTRING(`mobile`,2,10) FROM `user` WHERE `email`='" . $_SESSION["u"]["email"] . "'");
    $mobile_data = $mobile_rs->fetch_assoc();
    ?>

    <div class="container-fluid">
        <div class="row">


            <div class="col-12 shadow-sm p-3 mb-3 bg-body rounded-2">
                <?php include "header.php"; ?>
            </div>

            <div class="col-12  ">
                <div class="row">

                    <div class="col-lg-10 col-10 bg-white offset-1 offset-lg-1 rounded-4 shadow-sm  bg-body" style="margin-top: 20px;">
                        <div class="row">
                            <div class="col-12 justify-content-center rounded-4">
                                <div class="row mb-3">

                                    <div class="offset-4 offset-lg-1 col-3 col-lg-1 newLogo " style="height: 60px;"></div>

                                    <div class="col-12 col-lg-6 ">
                                        <div class="input-group mt-4 ">
                                            <input type="text" class="form-control" placeholder="Search here.." aria-label="Text input with dropdown botton" id="basicSearchText" onkeyup="basicSearch(0);">

                                            <select class="form-select text-center" style="max-width:200px ;" id="basicSearchSelect">
                                                <option value="0">All Categories</option>

                                                <?php



                                                $categroy_rs = Database::search("SELECT * FROM `category` ");
                                                $category_num = $categroy_rs->num_rows;

                                                for ($x = 0; $x < $category_num; $x++) {
                                                    $category_data = $categroy_rs->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></option>


                                                <?php


                                                }


                                                ?>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-2 d-grid">
                                        <button class="btn btn-primary mt-4 mb-2 shadow rounded-4" onclick="basicSearch(0);">Search</button>
                                    </div>

                                    <div class="col-12 col-lg-2  text-center text-lg-start " style="margin-top:26px ;">
                                        <a href="advancedSearch.php" class="link-secondary text-decoration-none fw-bold">Advanced</a>
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-12 mb-2  shadow-sm  rounded-4 mt-1">
                        <div class="row  bg-body ">
                            <div class="col-12 mt-2">
                                <label class="form-label fs-1 fw-bold"><i class="bi bi-paypal fs-1"></i>&nbsp;| Transaction</label>
                            </div>
                            <div class="col-7 col-lg-6">
                                <hr class="border border-5 bg-warning border-warning rounded-3">
                            </div>
                            <div class="row">
                                <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                                    <ol class="breadcrumb bg-white">
                                        <li class="breadcrumb-item"><a href="singleProductView.php">Single Product</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Transaction</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>



                    <div class="col-lg-12 col-12 bg-white offset-0 offset-lg-0 mt-4 rounded-4  bg-body" id="basicRsesult">
                        <div class="row">

                            <div class="col-6 offset-3 mt-4 mb-4 ">
                                <div class="row ">

                                    <div class="col-12 rounded-3 shadow ">
                                        <div class="row">

                                            <div class="col-12 mt-3 mb-3">
                                                <div class="row">
                                                    <div id="card_container"></div>
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
            <?php include "fooler.php"; ?>
        </div>
    </div>

</body>

<script src="script.js"></script>
<script src="bootstrap.js"></script>
<script src="https://cdn.directpay.lk/dev/v1/directpayCardPayment.js?v=1"></script>

<script>
    DirectPayCardPayment.init({
        container: 'card_container', //<div id="card_container"></div>
        merchantId: 'ES15243', //your merchant_id
        amount: <?php echo $_GET["amount"]; ?> + ".00",
        refCode: "DP12345", //unique referance code form merchant
        currency: 'LKR',
        type: 'ONE_TIME_PAYMENT',
        customerEmail: '<?php echo $_SESSION["u"]["email"]; ?>',
        customerMobile: '+94<?php echo implode(" ", $mobile_data); ?>',
        description: '<?php echo $_GET["title"]; ?>', //product or service description
        debug: true,
        responseCallback: responseCallback,
        errorCallback: errorCallback,
        logo: 'https://test.com/directpay_logo.png',
        apiKey: '7509d3045cae3f15e690949762d5085a7633069c157b54e1aaeedd1f88d3aed1'
    });

    //response callback.
    function responseCallback(result) {
        console.log("successCallback-Client", result);
        // alert(JSON.stringify(result));

        var id = <?php echo $_GET["id"]; ?>;
        var qty = <?php echo $_GET["qty"]; ?>;

        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if (request.readyState == 4) {
                var text = request.responseText;
                // alert(text);
                var obj = JSON.parse(text);
                if (obj["status"] == 1) {
                    var x = setTimeout(function() {
                        window.location = "invoice.php?id=" + obj["id"];
                    }, 4000);

                } else {
                    alert(text);
                }
            }
        };
        request.open("GET", "buyNowProcess.php?id=" + id + "&qty=" + qty, true);
        request.send();

    }

    //error callback
    function errorCallback(result) {
        console.log("successCallback-Client", result);
        alert(JSON.stringify(result));
    }
</script>


</html>
<?php

// } else {
//     echo ("Something Went Wrong..");
// }
?>