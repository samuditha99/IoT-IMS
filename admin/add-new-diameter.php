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
$page = "diameter";
include "header.php";
include "../user/connection.php";
?>

<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
    <div id="breadcrumb"> <a href="demo.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="add-new-diameter.php" class="tip-bottom">Add New Diameter</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: auto; padding:10px;">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Add Diameter</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="" method="POST" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Diameter(inch) :</label>
                                <div class="controls">
                                    <!-- <div class="input-append span11" style="margin-bottom: 10px;" > -->
                                        <input type="text" class="span11" name="diameter" placeholder="Enter diameter" required />
                                        <!-- <span class="add-on">inch</span> -->
                                    <!-- </div> -->
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" name="submit" class="btn" style="background-color: #261A4D; color:white">SAVE</button>
                            </div>
                            <div class="control-group">
                                <div class="alert alert-danger" style="margin: 10px; display:none;" id="error">
                                    This Diameter Already Exist. Please Try Another!
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="alert alert-success" style="margin: 10px; display:none;" id="success">
                                    Diameter Added Successfully!
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                    <h5>Added Diameters</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Diameter(inch)</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd gradeX">
                                <?php
                                $sql2 = "SELECT * FROM diameters";
                                $res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
                                while ($row = mysqli_fetch_assoc($res2)) {
                                ?>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['diameter']; ?></td>
                                    <td style="text-align:center;"><a href="edit-diameter.php?id=<?php echo $row['id']; ?>" style="text-align:center; color:green;">EDIT</a></td>
                                    <td style="text-align:center;"><a href="delete-diameter.php?id=<?php echo $row['id']; ?>" onClick="return checkdelete()" style="text-align:center; color:red;">DELETE</a></td>
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
    $diameter = $_POST['diameter'];

    $count = 0;
    $sql = "SELECT * FROM diameters WHERE diameter='$diameter'";
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $count = mysqli_num_rows($res);
    if ($count > 0) {
?>
        <script type="text/javascript">
            document.getElementById("error").style.display = "block";
            document.getElementById("success").style.display = "none";
        </script>
    <?php
    } else {
        $sql3 = "INSERT INTO diameters VALUES (NULL, '$diameter')";
        mysqli_query($conn, $sql3) or die(mysqli_error($conn));
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