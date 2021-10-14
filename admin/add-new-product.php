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
?>

<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
    <div id="breadcrumb"> <a href="demo.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="add-new-product.php" class="tip-bottom">Add New Tire</a> </div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: auto; padding:10px;">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Add Tire Details</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="" method="POST" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Company Name :</label>
                                <div class="controls">
                                    <select class="span11" name="comname">
                                        <?php
                                            $sql1="SELECT * FROM companies";
                                            $res1=mysqli_query($conn, $sql1);
                                            while($row1=mysqli_fetch_assoc($res1)){
                                                ?>
                                                <option><?php echo $row1['companyname']; ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Diameter(inch) :</label>
                                <div class="controls">
                                    <select class="span11" name="diameter">
                                        <?php
                                            $sql2 = "SELECT * FROM diameters";
                                            $res2 = mysqli_query($conn, $sql2);
                                            while($row2=mysqli_fetch_assoc($res2)){
                                                ?>
                                                    <option><?php echo $row2['diameter']; ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tire Size :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="size" placeholder="Enter the tire size" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tire Weight(kg) :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="weight" placeholder="Enter the tire weight" required />
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" name="submit" class="btn" style="background-color: #261A4D; color:white">SAVE</button>
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
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                    <h5>Added Tires</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Diameter(inch)</th>
                                <th>Size</th>
                                <th>Weight(kg)</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd gradeX">
                                <?php
                                $sql3 = "SELECT * FROM tire_info";
                                $res3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
                                while ($row3 = mysqli_fetch_assoc($res3)) {
                                ?>
                                    <td><?php echo $row3['companyname']; ?></td>
                                    <td><?php echo $row3['diameter']; ?></td>
                                    <td><?php echo $row3['tiresize']; ?></td>
                                    <td><?php echo $row3['weight']; ?></td>
                                    <td style="text-align:center;"><a href="edit-product.php?id=<?php echo $row3['id']; ?>" style="text-align:center; color:green;">EDIT</a></td>
                                    <td style="text-align:center;"><a href="delete-product.php?id=<?php echo $row3['id']; ?>" onClick="return checkdelete()" style="text-align:center; color:red;">DELETE</a></td>
                            </tr>
                        <?php
                                }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    function checkdelete() {
        return confirm('Are you sure you want to DELETE this record');
    }
</script>


<!--end-main-container-part-->

<?php

if (isset($_POST['submit'])) {
    $companyName = $_POST['comname'];
    $diameter = $_POST['diameter'];
    $tireSize = $_POST['size'];
    $weight = $_POST['weight'];

    $count = 0;
    $sql4 = "SELECT * FROM tire_info WHERE companyname='$companyName' && diameter='$diameter' && tiresize='$tireSize'";
    $res4 = mysqli_query($conn, $sql4) or die(mysqli_error($conn));
    $count = mysqli_num_rows($res4);
    if ($count > 0) {
?>
        <script type="text/javascript">
            document.getElementById("error").style.display = "block";
            document.getElementById("success").style.display = "none";
        </script>
    <?php
    }else {
        $sql5 = "INSERT INTO tire_info VALUES (NULL, '$companyName', '$diameter', '$tireSize', '$weight')";
        mysqli_query($conn, $sql5) or die(mysqli_error($conn));
    ?>
        <script type="text/javascript">
            document.getElementById("error").style.display = "none";
            document.getElementById("success").style.display = "block";
            setTimeout(function() {
                window.location.href = window.location.href;
            }, 3000);
        </script>
<?php
    }
}
?>
<?php
include "footer.php";
?>