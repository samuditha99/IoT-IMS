<?php
include "../../user/connection.php";
$companyName = $_GET['companyname'];
$sql = "SELECT DISTINCT diameter FROM stock WHERE companyname='$companyName'";
$res = mysqli_query($conn, $sql);
?>
<select class="span11" name="diameter" id="diameter" onchange="select_diameter(this.value, '<?php echo $companyName; ?>')">
<option>Select</option>
<?php
while($row=mysqli_fetch_assoc($res)){
    $diameter = $row['diameter'];
    ?>
    <option><?php echo $diameter; ?></option>
    <?php
}
?>

</select>