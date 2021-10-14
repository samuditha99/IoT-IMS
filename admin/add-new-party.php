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
$page = "party";
include "header.php";
include "../user/connection.php";
?>
<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
    <div id="breadcrumb"> <a href="demo.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="add-new-party.php" class="tip-bottom">Add New Party</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: auto; padding:10px;">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Add Party Details</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="" method="POST" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">First Name :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="fname" placeholder="Enter first name" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Last Name :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="lname" placeholder="Enter last name" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Business Name :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="bname" placeholder="Enter business name" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Contact :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="contact" placeholder="Enter contact number" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Address :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="address" placeholder="Enter business address" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">City :</label> 
                                <div class="controls">
                                    <input type="text" class="span11" name="city" placeholder="Enter city" required />
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" name="submit" class="btn" style="background-color: #261A4D; color:white">SAVE</button>
                            </div>
                            <div class="control-group">
                                <div class="alert alert-danger" style="margin: 10px; display:none;" id="error">
                                    This Business Name Already Exist. Please Try Another!
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="alert alert-success" style="margin: 10px; display:none;" id="success">
                                    User Added Successfully!
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                    <h5>Registered Parties</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Business Name</th>
                                <th>Contact</th>
                                <th>City</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd gradeX">
                                <?php
                                $sql1 = "SELECT * FROM party_info";
                                $res1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
                                while ($row1 = mysqli_fetch_assoc($res1)) {
                                ?>
                                    <td><?php echo $row1['firstname']." ". $row1['lastname']; ?></td>
                                    <td><?php echo $row1['businessneame']; ?></td>
                                    <td><?php echo $row1['contact']; ?></td>
                                    <td><?php echo $row1['city']; ?></td>
                                    <td style="text-align:center;"><a href="edit-party.php?id=<?php echo $row1['id']; ?>" style="text-align:center; color:green;">EDIT</a></td>
                                    <td style="text-align:center;"><a href="delete-party.php?id=<?php echo $row1['id']; ?>" onClick="return checkdelete()" style="text-align:center; color:red;">DELETE</a></td>
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
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $businessName = $_POST['bname'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $city = $_POST['city'];

    $count = 0;
    $sql2 = "SELECT * FROM party_info WHERE businessneame='$businessName'";
    $res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
    $count = mysqli_num_rows($res2);
    if ($count > 0) {
?>
        <script type="text/javascript">
            document.getElementById("error").style.display = "block";
            document.getElementById("success").style.display = "none";
        </script>
    <?php
    }else {
        $sql3 = "INSERT INTO party_info VALUES (NULL, '$firstName', '$lastName', '$businessName', '$contact', '$address', '$city')";
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