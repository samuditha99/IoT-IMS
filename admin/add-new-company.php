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
?>

<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header"><div id="breadcrumb"> 
        <a href="demo.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="add-new-company.php" class="tip-bottom">Add New User</a> </div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">
        <div class="row-fluid" style="background-color: white; min-height: auto; padding:10px;">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Add Company</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="" method="POST" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Company Name :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="comname" placeholder="Enter company name" required />
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" name="submit" class="btn" style="background-color: #261A4D; color:white">SAVE</button>
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
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                    <h5>All Companies</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Company</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd gradeX">
                                <?php
                                $sql1 = "SELECT * FROM companies";
                                $res1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
                                while ($row = mysqli_fetch_assoc($res1)) {
                                ?>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['companyname']; ?></td>
                                    <td style="text-align:center;"><a href="edit-company.php?id=<?php echo $row['id']; ?>" style="text-align:center; color:green;">EDIT</a></td>
                                    <td style="text-align:center;"><a href="delete-company.php?id=<?php echo $row['id']; ?>" onClick="return checkdelete()" style="text-align:center; color:red;">DELETE</a></td>
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


<script type="text/javascript">
    function checkdelete() {
        return confirm('Are you sure you want to DELETE this record');
    }
</script>


<!--end-main-container-part-->

<?php

if(isset($_POST['submit'])) {
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
        $sql3 = "INSERT INTO companies VALUES (NULL, '$companyName')";
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