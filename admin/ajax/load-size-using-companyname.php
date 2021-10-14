<?php
include "../../user/connection.php";
$companyName = $_GET['companyname'];
$diameter = $_GET['diameter'];
$sql = "SELECT * FROM tire_info  WHERE companyname='$companyName' && diameter='$diameter'";
$res = mysqli_query($conn, $sql);
?>
<select class="span11" name="size" onchange="select_tire_size(this.value, '<?php echo $diameter; ?>', '<?php echo $companyName; ?>')">
<option>Select</option>
<?php
while($row=mysqli_fetch_assoc($res)){
    ?>
        <option><?php echo $row['tiresize']; ?></option>
    <?php
}
?>
</select>