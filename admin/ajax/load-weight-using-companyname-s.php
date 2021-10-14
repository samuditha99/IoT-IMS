<?php
include "../../user/connection.php";
$companyName = $_GET['companyname'];
$diameter = $_GET['diameter'];
$tireSize = $_GET['tiresize'];
$sql="SELECT * FROM stock WHERE companyname='$companyName' && diameter='$diameter' && tiresize='$tireSize'";
$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
?>
<?php
while($row=mysqli_fetch_assoc($res)){
     $weight = $row['weight'];
     echo $weight;
}
?>

