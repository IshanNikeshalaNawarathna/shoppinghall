<?php

require "connection.php";

$text = $_POST["t"];
// echo($text);
$query = "SELECT * FROM `product`";

if (!empty($text)) {
    $query .= " WHERE `title` LIKE '%" . $text . "%'";

}
?>
<div class="row">



    <div class="col-12 mt-3 ">
        <label class="form-label fs-4 fw-bold">Manage Product</label>
        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
            <ol class="breadcrumb bg-white">
                <li class="breadcrumb-item"><a href="adminPenal.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage Product</li>
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
                                <th scope="col" class="fs-6">#</th>
                                <th scope="col" class="fs-6">Product Image</th>
                                <th scope="col" class="fs-6">Title</th>
                                <th scope="col" class="fs-6">Price</th>
                                <th scope="col" class="fs-6">Register Date</th>
                                <th scope="col"></th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            // $pageno;

                            // $query = "SELECT * FROM `product`";

                            if (isset($_GET["page"])) {
                                $pageno = $_GET["page"];
                            } else {
                                $pageno = 1;
                            }

                            $user_rs = Database::search($query);
                            $user_num = $user_rs->num_rows;

                            $results_per_page = 6;
                            $number_of_pages = ceil($user_num / $results_per_page);

                            $page_results = ($pageno - 1) * $results_per_page;
                            $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                            $selected_num = $selected_rs->num_rows;

                            for ($x = 0; $x < $selected_num; $x++) {
                                $selected_data = $selected_rs->fetch_assoc();

                                // echo($selected_data["title"]);

                                $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $selected_data["user_email"] . "'");
                                $seller_data = $seller_rs->fetch_assoc();

                                $img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $selected_data["id"] . "'");
                                $img_data = $img_rs->fetch_assoc();

                            ?>

                                <tr>
                                    <td class="fs-6"><?php echo $x + 1; ?></td>
                                    <td onclick="productDetalisModel('<?php echo $selected_data['id']; ?>');">
                                        <img src="<?php echo $img_data["code"]; ?>" class=" shadow" style="background-repeat: no-repeat;height: 60px;width: auto;">
                                    </td>
                                    <td class="fs-6"><?php echo $selected_data["title"]; ?></td>
                                    <td class="fs-6">Rs.<?php echo $selected_data["price"]; ?>./=</td>
                                    <td class="fs-6"><?php echo $selected_data["datetime_added"] ?></td>
                                    <td>
                                        <div class="col-12">
                                            <?php
                                            if ($selected_data["status_id"] ==  1) {
                                            ?>
                                                <button class="btn btn-warning shadow" id="buttonStatus<?php echo $selected_data['id']; ?>" onclick="blockProductChengStatus('<?php echo $selected_data['id']; ?>');">Block</button>
                                            <?php
                                            } else {
                                            ?>
                                                <button class="btn btn-dark shadow" id="buttonStatus<?php echo $selected_data['id']; ?>" onclick="blockProductChengStatus('<?php echo $selected_data['id']; ?>');">Unblock</button>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </td>
                                </tr>

                                <!-- User datelis Model -->
                                <div class="modal fade" id="productDetalisModel<?php echo $selected_data["id"]; ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #d0ece7;">
                                                <h1 class="modal-title fs-4  fw-bold " id="exampleModalToggleLabel"><?php echo $selected_data["title"]; ?></h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body " style="background-color:  #fbfcfc ;">

                                                <div class="col-5 mt-3 mb-3 shadow-lg rounded-3 offset-3 offset-lg-3">
                                                    <img src="<?php echo $img_data["code"]; ?>" style="background-repeat: no-repeat;height: 200px;width: auto;">
                                                </div>

                                                <div class="col-12 bg-white mt-3 p-4 mb-3 shadow-lg rounded-4 px-4">
                                                    <span class="fs-5 fw-bold">Price :</span>
                                                    <span class="fs-5">Rs.<?php echo $selected_data["price"]; ?>/=</span><br>
                                                    <span class="fs-5 fw-bold">Quantity :</span>
                                                    <span class="fs-5"><?php echo $selected_data["qty"]; ?> Items</span><br>
                                                    <span class="fs-5 fw-bold">Description :</span>
                                                    <span class="fs-5"><?php echo $selected_data["description"]; ?></span><br>
                                                    <span class="fs-5 fw-bold">Seller :</span>
                                                    <span class="fs-5"><?php echo $seller_data["fname"] . " " . $seller_data["lname"]; ?></span>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary shadow" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- User datelis Model -->

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
<?php
// }
?>