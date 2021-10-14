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
$page = "company";
include "header.php";
include "../user/connection.php";

$id = $_GET['id'];
$sql1 = "SELECT * FROM companies WHERE id='$id'";
$res1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_assoc($res1)) {
    $companyName = $row1['companyname'];
}
?>

<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
    <div id="breadcrumb"> <a href="demo.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="add-new-company.php" class="tip-bottom">Add New Company</a> <a href="" class="tip-bottom">Edit Company</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: auto; padding:10px;">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Edit Company</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="" method="POST" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Company Name :</label>
                                <div class="controls">
                                        <input type="text" class="span11" name="comname" value="<?php echo $companyName; ?>" required />
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" name="submit" class="btn" style="background-color: #261A4D; color:white">UPDATE</button>
                            </div>
                            <div class="control-group">
                                <div class="alert alert-danger" style="margin: 10px; display:none;" id="error">
                                    This Company Already Exist. Please Try Another!
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="alert alert-success" style="margin: 10px; display:none;" id="success">
                                    Company Added Successfully!
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
    $companyName = $_POST['comname'];

    $count = 0;
    $sql2 = "SELECT * FROM companies WHERE companyname='$companyName'";
    $res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
    $count = mysqli_num_rows($res2);
    if ($count > 0) {
?>
        <script type="text/javascript">
            document.getElementById("error").style.display = "block";
            document.getElementById("success").style.display = "none";
        </script>
    <?php
    } else {
        $sql3 = "UPDATE companies SET companyname='$companyName' WHERE id='$id'";
        mysqli_query($conn, $sql3) or die(mysqli_error($conn));
    ?>
        <script type="text/javascript">
            document.getElementById("error").style.display = "none";
            document.getElementById("success").style.display = "block";
            setTimeout(function() {
                window.location = "add-new-company.php";
            }, 3000);
        </script>
<?php
    }
}
?>
<?php
include "footer.php";
?>