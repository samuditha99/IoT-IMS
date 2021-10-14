<?php
session_start();
$sessionID = $_GET['sessionid'];
$b = array("company_name" => "", "diameter" => "", "tire_size" => "", "weight" => "", "price" => "", "qty" => "");
$_SESSION['cart'][$sessionID] = $b;
?>