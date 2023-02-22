<?php

require "connection.php";
if (isset($_GET["search"])) {
  $searchText = $_GET["search"];

  $query = "SELECT * FROM `user` WHERE `fname`='" . $searchText . "' ";

?>
    <div class="row">

      <?php

      $vewiUser_rs = Database::search($query);
      $vewiUser_num = $vewiUser_rs->num_rows;

      for ($s = 0; $s < $vewiUser_num; $s++) {
        $vewiUser_data = $vewiUser_rs->fetch_assoc();

      ?>



        <div class="col-1 col-lg-1 me-sm-4 me-lg-4 ">
          <?php
          $vewiUser_profile = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $vewiUser_data["email"] . "'");
          $vewiUser_profile_data = $vewiUser_profile->fetch_assoc();
          ?>
          <img src="<?php echo $vewiUser_profile_data["path"]; ?>" style="background-repeat: no-repeat;height: 55px;width: auto;">
        </div>
        <div class="col-9 col-lg-5  mt-1 ">
          <label class="form-label fw-bold "><?php echo $vewiUser_data["fname"] . " " . $vewiUser_data["lname"]; ?></label>
          <?php
          $message_rs = Database::search("SELECT * FROM `chat`  WHERE `to`='" . $vewiUser_data["email"] . "'");
          $message_num = $message_rs->num_rows;

          for ($a = 0; $a < $message_num; $a++) {
            $message_data = $message_rs->fetch_assoc();

          ?>
            <p class="fs-6 me-lg-2"><?php echo $message_data["content"]; ?></p>
          <?php
          }
          ?>

        </div>
        <div class="col-1 col-lg-1 offset-0 offset-lg-3 text-lg-end me-lg-5">
          <?php

          if (isset($_SESSION["u"])) {
          ?>
            <i class="bi bi-circle-fill fs-6 text-end" style="color: greenyellow;"></i>
          <?php
          } else {
          ?>
            <i class="bi bi-circle-fill fs-6 text-end" style="color: gray;"></i>
          <?php
          }

          ?>

        </div>

        <div style="width: 100%;">
          <hr>
        </div>

      <?php
      }


      ?>

    </div>
  <?php
  }





  ?>