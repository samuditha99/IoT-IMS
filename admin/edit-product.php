<?php
session_start();
if(!isset($_SESSION["admin"])){
    ?>
    <script type="text/javascript">
            window.location = "../index.php";
        </script>
    <?php
}
?>
<?php
$page = "product";
include "header.php";
include "../user/connection.php";
$id = $_GET['id'];
$sql1 = "SELECT * FROM tire_info WHERE id='$id'";
$res1 = mysqli_query($conn, $sql1);
while ($row1 = mysqli_fetch_assoc($res1)) {
    $companyName = $row1['companyname'];
    $diameter = $row1['diameter'];
    $tireSize = $row1['tiresize'];
    $tireWeight = $row1['weight'];
}
?>

<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
    <div id="breadcrumb"> <a href="demo.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="add-new-product.php" class="tip-bottom">Add New Tire</a> <a href="" class="tip-bottom">Edit Tire</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: auto; padding:10px;">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Edit Tire Details</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="" method="POST" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Company Name :</label>
                                <div class="controls">
                                    <select class="span11" name="comname" disabled>
                                        <?php
                                        $sql2 = "SELECT * FROM companies";
                                        $res2 = mysqli_query($conn, $sql2);
                                        while ($row2 = mysqli_fetch_assoc($res2)) {
                                        ?>
                                            <option <?php if ($row2['companyname'] == $companyName) {
                                                        echo "selected";
                                                    } ?>><?php echo $row2['companyname']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Diameter(inch) :</label>
                                <div class="controls">
                                    <select class="span11" name="diameter" disabled>
                                        <?php
                                        $sql3 = "SELECT * FROM diameters";
                                        $res3 = mysqli_query($conn, $sql3);
                                        while ($row3 = mysqli_fetch_assoc($res3)) {
                                        ?>
                                            <option <?php if ($row3['diameter'] == $diameter) {
                                                        echo "selected";
                                                    } ?>><?php echo $row3['diameter']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tire Size :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="size" value="<?php echo $tireSize; ?>" readonly />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tire Weight(kg) :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="weight" value="<?php echo $tireWeight; ?>" required />
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" name="submit" class="btn" style="background-color: #261A4D; color:white">UPDATE</button>
                            </div>
                            <div class="control-group">
                                <div class="alert alert-danger" style="margin: 10px; display:none;" id="error">
                                    This Tire Size Already Exist. Please Try Another!
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="alert alert-success" style="margin: 10px; display:none;" id="success">
                                    Product Added Successfully!
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!--end-main-container-part-->

<?php

if (isset($_POST['submit'])) {
    $weight = $_POST['weight'];

    $sql4 = "UPDATE tire_info SET weight='$weight' WHERE id=$id";
    mysqli_query($conn, $sql4) or die(mysqli_error($conn));
?>
    <script type="text/javascript">
        document.getElementById("error").style.display = "none";
        document.getElementById("success").style.display = "block";
        setTimeout(function() {
            window.location = "add-new-product.php";
        }, 3000);
    </script>
<?php
}
?>
<?php
include "footer.php";
?>