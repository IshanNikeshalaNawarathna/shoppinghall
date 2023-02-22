<?php

require "connection.php";

$text = $_POST["t"];

$query = "SELECT * FROM `invoice`";

if (!empty($text)) {
    $query .= " WHERE `id` LIKE '%" . $text . "%'";
}

?>
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

    <div class="col-12">
        <div class="row">

            <div class="col-11 offset-0 col-lg-10 offset-lg-1">
                <div class="row">

                    <table class="table text-start align-middle  table-hover mb-0">
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

                            <?php



                            if ("0" != ($_POST["page"])) {
                                $pageno = $_POST["page"];
                            } else {
                                $pageno = 1;
                            }

                            $user_rs = Database::search($query);
                            $user_num = $user_rs->num_rows;

                            $results_per_page = 10;
                            $number_of_pages = ceil($user_num / $results_per_page);

                            $page_results = ($pageno - 1) * $results_per_page;
                            $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                            $selected_num = $selected_rs->num_rows;

                            for ($x = 0; $x < $selected_num; $x++) {
                                $selected_data = $selected_rs->fetch_assoc();


                            ?>

                                <tr>
                                    <!-- <td></?php echo $x + 1; ?></td> -->

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

                        </tbody>
                    </table>

                </div>
            </div>



        </div>
    </div>

    <div class="col-8 col-lg-6 text-center mt-5 mb-4 offset-3 offset-lg-5">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" <?php if ($pageno <= 1) {
                                                                echo "#";
                                                            } else {
                                                            ?> onclick="sellingHistorySearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                                        } ?>>Previous</a></li>
                <?php

                for ($x = 1; $x <= $number_of_pages; $x++) {
                    if ($x == $pageno) {
                ?>
                        <li class="page-item"><a class="page-link" onclick="sellingHistorySearch(<?php echo ($x); ?>);"><?php echo $x; ?></a></li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item"><a class="page-link" onclick="sellingHistorySearch(<?php echo ($x); ?>);"><?php echo $x; ?></a></li>
                <?php
                    }
                }

                ?>

                <li class="page-item"><a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                                echo "#";
                                                            } else {
                                                            ?> onclick="sellingHistorySearch(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                                        } ?>>Next</a></li>
            </ul>
        </nav>
    </div>

</div>
<?php

?>