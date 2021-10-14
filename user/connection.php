<?php

    $dbServer = "localhost";
    $dbUser = "root";
    $dbPass = "";
    $database = "iot_ims";

    $conn = mysqli_connect($dbServer, $dbUser, $dbPass, $database) or die(mysqli_error($conn));

?>