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
$id = $_GET['id'];
$sql1 = "SELECT * FROM party_info WHERE id='$id'";
$res1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
while($row1=mysqli_fetch_assoc($res1)){
    $firstName = $row1['firstname'];
    $lastName = $row1['lastname'];
    $businessName = $row1['businessneame'];
    $contact = $row1['contact'];
    $address = $row1['address'];
    $city = $row1['city'];
}
?>

<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
    <div id="breadcrumb"> <a href="demo.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="add-new-party.php" class="tip-bottom">Add New Party</a> <a href="" class="tip-bottom">Edit Party</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: auto; padding:10px;">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Edit Party Details</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="" method="POST" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">First Name :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="fname" value="<?php echo $firstName; ?>" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Last Name :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="lname" value="<?php echo $lastName; ?>" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Business Name :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="bname" value="<?php echo $businessName; ?>" readonly />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Contact :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="contact" value="<?php echo $contact; ?>" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Address :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="address" value="<?php echo $address; ?>" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">City :</label> 
                                <div class="controls">
                                    <input type="text" class="span11" name="city" value="<?php echo $city; ?>" required />
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" name="submit" class="btn" style="background-color: #261A4D; color:white">SAVE</button>
                            </div>
                            <div class="control-group">
                                <div class="alert alert-success" style="margin: 10px; display:none;" id="success">
                                    Party Updated Successfully!
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
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $city = $_POST['city'];

    
    $sql3 = "UPDATE party_info SET firstname='$firstName', lastname='$lastName', contact='$contact', address='$address', city='$city' WHERE id=$id";
    mysqli_query($conn, $sql3) or die(mysqli_error($conn));
    ?>
        <script type="text/javascript">
            document.getElementById("success").style.display = "block";
            setTimeout(function() {
                window.location = "add-new-party.php";
            }, 3000);
        </script>
<?php
}
?>
<?php
include "footer.php";
?>