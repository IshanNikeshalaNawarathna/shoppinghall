<?php

require "connection.php";

if (isset($_GET["searchText"])) {
    $searchText = $_GET["searchText"];
    $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `id`='" . $searchText . "'");
    $invoice_num = $invoice_rs->num_rows;

    if ($invoice_num == 1) {

        $invoice_data = $invoice_rs->fetch_assoc();

?>
        <!-- <div class="row"> -->
        <tr class="mb-3 ">
            <td class="fs-6 text-danger fw-bold"><?php echo $invoice_data["id"]; ?></td>
            <?php

            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_data["product_id"] . "'");
            $product_data = $product_rs->fetch_assoc();

            ?>
            <td class="fs-6 text-danger fw-bold"><?php echo $product_data["title"]; ?></td>
            <?php
            $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $invoice_data["user_email"] . "'");
            $user_data = $user_rs->fetch_assoc();
            ?>
            <td class="fs-6 text-danger fw-bold"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></td>
            <td class="fs-6 text-danger fw-bold"><?php echo $invoice_data["total"] ?></td>
            <td class="fs-6 text-danger fw-bold"><?php echo $invoice_data["qty"] ?></td>
            <td>
                <div class="col-12 d-grid">

                    <?php

                    if ($invoice_data["status"] == 0) {
                    ?>
                        <button class="btn btn-info shadow" onclick="changeInvoice('<?php echo $invoice_data['id']; ?>');" id="changeBtn<?php echo $invoice_data['id']; ?>">Confirm&nbsp;Order</button>
                    <?php
                    } else if ($invoice_data["status"] == 1) {
                    ?>
                        <button class="btn btn-info shadow" onclick="changeInvoice('<?php echo $invoice_data['id']; ?>');" id="changeBtn<?php echo $invoice_data['id']; ?>">Packing</button>
                    <?php
                    } else if ($invoice_data["status"] == 2) {
                    ?>
                        <button class="btn btn-info shadow" onclick="changeInvoice('<?php echo $invoice_data['id']; ?>');" id="changeBtn<?php echo $invoice_data['id']; ?>">Dispatch</button>
                    <?php
                    } else if ($invoice_data["status"] == 3) {
                    ?>
                        <button class="btn btn-info shadow" onclick="changeInvoice('<?php echo $invoice_data['id']; ?>');" id="changeBtn<?php echo $invoice_data['id']; ?>">Shipping</button>
                    <?php
                    } else if ($invoice_data["status"] == 4) {
                    ?>
                        <button class="btn btn-success shadow "  onclick="changeInvoice('<?php echo $invoice_data['id']; ?>');" id="changeBtn<?php echo $invoice_data['id']; ?>">Delivered</button>
                    <?php
                    }




                    ?>


                </div>
            </td>
        </tr>
        <!-- </div> -->
    <?php
   
} else {
    echo ("Invalid Inovice Id");
}
}
?>