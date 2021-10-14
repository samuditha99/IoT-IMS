<?php
include "../user/connection.php";

$sql = "SELECT * FROM billing_header WHERE status='Requested'";
$result = $conn->query($sql);
echo $result->num_rows;
$conn->close();
?>