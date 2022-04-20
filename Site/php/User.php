<?php
            if (isset($_POST["Submit"])) {
              header("location: addUser.php");
            }

            if (isset($_POST["Delete"])) {
              header("location: delUser.php");
            }

            if(isset($_POST["Update"])) {
              header("location: editUser.php")
            }
?>