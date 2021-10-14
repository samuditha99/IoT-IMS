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
$page = "user";
include "header.php";
include "../user/connection.php";
$id = $_GET['id'];
$sql1 = "SELECT * FROM user_registrstion WHERE id=$id";
$res1 = mysqli_query($conn, $sql1);
while ($row = mysqli_fetch_assoc($res1)) {
    $fullName = $row['full_name'];
    $userName = $row['user_name'];
    $idNum = $row['id_number'];
    $dob = $row['dob'];
    $gender = $row['gender'];
    $password = $row['password'];
    $role = $row['role'];
    $status = $row['status'];
}
?>

<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
    <div id="breadcrumb"> <a href="demo.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="add-new-user.php" class="tip-bottom">Add New User</a> <a href="" class="tip-bottom">Edit User</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: auto; padding:10px;">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Update User Details</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="" method="POST" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Full Name :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="fname" value="<?php echo $fullName ?>" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">User Name :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="uname" value="<?php echo $userName ?>" readonly />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">ID Card Number :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="idnum" value="<?php echo $idNum ?>" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Date of Birth :</label>
                                <div class="controls">
                                    <input type="date" class="span11" name="bday" value="<?php echo $dob ?>" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Select Gender :</label>
                                <div class="controls">
                                    <select class="span11" name="gender">
                                        <option <?php if ($gender == "Male") {
                                                    echo "selected";
                                                } ?>>Male</option>
                                        <option <?php if ($gender == "Female") {
                                                    echo "selected";
                                                } ?>>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Enter Password :</label>
                                <div class="controls">
                                    <input type="password" name="pword" class="span11" value="<?php echo $password ?>" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Select Role :</label>
                                <div class="controls">
                                    <select class="span11" name="role">
                                        <option <?php if ($role == "User") {
                                                    echo "selected";
                                                } ?>>User</option>
                                        <option <?php if ($role == "Admin") {
                                                    echo "selected";
                                                } ?>>Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Select Status :</label>
                                <div class="controls">
                                    <select class="span11" name="status">
                                        <option <?php if ($status == "Active") {
                                                    echo "selected";
                                                } ?>>Active</option>
                                        <option <?php if ($status == "Inactive") {
                                                    echo "selected";
                                                } ?>>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" name="submit" class="btn" style="background-color: #261A4D; color:white">UPDATE</button>
                            </div>
                            <div class="control-group">
                                <div class="alert alert-danger" style="margin: 10px; display:none;" id="uerror">
                                    This Username Already Exist. Please Try Another!
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="alert alert-success" style="margin: 10px; display:none;" id="success">
                                    User Updated Successfully!
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
    $fullName = $_POST['fname'];
    $userName = $_POST['uname'];
    $idNum = $_POST['idnum'];
    $dob = $_POST['bday'];
    $gender = $_POST['gender'];
    $password = $_POST['pword'];
    $role = $_POST['role'];
    $status = $_POST['status'];


    $sql3 = "UPDATE user_registrstion SET full_name='$fullName', id_number='$idNum', dob='$dob', gender='$gender', password='$password', role='$role', status='$status' WHERE id='$id'";
    mysqli_query($conn, $sql3) or die(mysqli_error($conn));
?>
    <script type="text/javascript">
        document.getElementById("uerror").style.display = "none";
        document.getElementById("success").style.display = "block";
        setTimeout(function() {
            window.location = "add-new-user.php";
        }, 3000);
    </script>
<?php

}
?>
<?php
include "footer.php";
?>