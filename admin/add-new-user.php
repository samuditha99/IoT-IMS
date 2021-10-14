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
?>

    <!--main-container-part-->
    <div id="content">
        <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb"> <a href="demo.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="add-new-user.php" class="tip-bottom">Add New User</a></div>
        </div>
        <!--End-breadcrumbs-->

        <!--Action boxes-->
        <div class="container-fluid">

            <div class="row-fluid" style="background-color: white; min-height: auto; padding:10px;">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                            <h5>Add User Details</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form action="" method="POST" class="form-horizontal">
                                <div class="control-group">
                                    <label class="control-label">Full Name :</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="fname" placeholder="Enter your name" required />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">User Name :</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="uname" placeholder="Enter a user name" required />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">ID Card Number :</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="idnum" placeholder="Enter your id card number" required />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Date of Birth :</label>
                                    <div class="controls">
                                        <input type="date" class="span11" name="bday" placeholder="Enter your birthday" required />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Select Gender :</label>
                                    <div class="controls">
                                        <select class="span11" name="gender">
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Enter Password :</label>
                                    <div class="controls">
                                        <input type="password" name="pword" class="span11" placeholder="Enter password" required />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Confirm Password :</label>
                                    <div class="controls">
                                        <input type="password" name="cpword" class="span11" placeholder="Re enter password" required />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Select Role :</label>
                                    <div class="controls">
                                        <select class="span11" name="role">
                                            <option>User</option>
                                            <option>Admin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" name="submit" class="btn" style="background-color: #261A4D; color:white">SAVE</button>
                                </div>
                                <div class="control-group">
                                    <div class="alert alert-danger" style="margin: 10px; display:none;" id="uerror">
                                        This Username Already Exist. Please Try Another!
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="alert alert-danger" style="margin: 10px; display:none;" id="perror">
                                        Password Not Match!
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
                        <h5>Registered Admins</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Username</th>
                                    <th>ID Card Number</th>
                                    <th>Date of Birth</th>
                                    <th>Gender</th>
                                    <th>Status</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="odd gradeX">
                                    <?php
                                    $sql3 = "SELECT * FROM user_registrstion WHERE role='Admin'";
                                    $res3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
                                    while ($row3 = mysqli_fetch_assoc($res3)) {
                                    ?>
                                        <td><?php echo $row3['full_name']; ?></td>
                                        <td><?php echo $row3['user_name']; ?></td>
                                        <td><?php echo $row3['id_number']; ?></td>
                                        <td><?php echo $row3['dob']; ?></td>
                                        <td><?php echo $row3['gender']; ?></td>
                                        <td><?php echo $row3['status']; ?></td>
                                        <td style="text-align:center;"><a href="edit-user.php?id=<?php echo $row3['id']; ?>" style="text-align:center; color:green;">EDIT</a></td>
                                        <td style="text-align:center;"><a href="delete-user.php?id=<?php echo $row3['id']; ?>" onClick="return checkdelete()" style="text-align:center; color:red;">DELETE</a></td>

                                </tr>
                            <?php
                                    }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                        <h5>Registered Store</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Username</th>
                                    <th>ID Card Number</th>
                                    <th>Date of Birth</th>
                                    <th>Gender</th>
                                    <th>Status</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="odd gradeX">
                                    <?php
                                    $sql3 = "SELECT * FROM user_registrstion WHERE role='User'";
                                    $res3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
                                    while ($row3 = mysqli_fetch_assoc($res3)) {
                                    ?>
                                        <td><?php echo $row3['full_name']; ?></td>
                                        <td><?php echo $row3['user_name']; ?></td>
                                        <td><?php echo $row3['id_number']; ?></td>
                                        <td><?php echo $row3['dob']; ?></td>
                                        <td><?php echo $row3['gender']; ?></td>
                                        <td><?php echo $row3['status']; ?></td>
                                        <td style="text-align:center;"><a href="edit-user.php?id=<?php echo $row3['id']; ?>" style="text-align:center; color:green;">EDIT</a></td>
                                        <td style="text-align:center;"><a href="delete-user.php?id=<?php echo $row3['id']; ?>" onClick="return checkdelete()" style="text-align:center; color:red;">DELETE</a></td>

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
        $fullName = $_POST['fname'];
        $userName = $_POST['uname'];
        $idNum = $_POST['idnum'];
        $dob = $_POST['bday'];
        $gender = $_POST['gender'];
        $password = $_POST['pword'];
        $cPassword = $_POST['cpword'];
        $role = $_POST['role'];

        $count = 0;
        $sql = "SELECT * FROM user_registrstion WHERE user_name='$userName'";
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $count = mysqli_num_rows($res);
        if ($count > 0) {
    ?>
            <script type="text/javascript">
                document.getElementById("uerror").style.display = "block";
                document.getElementById("perror").style.display = "none";
                document.getElementById("success").style.display = "none";
            </script>
        <?php
        } elseif ($password != $cPassword) {
        ?>
            <script type="text/javascript">
                document.getElementById("uerror").style.display = "none";
                document.getElementById("perror").style.display = "block";
                document.getElementById("success").style.display = "none";
            </script>
        <?php
        } else {
            $sql2 = "INSERT INTO user_registrstion VALUES (NULL, '$fullName', '$userName', '$idNum', '$dob', '$gender', '$password', '$role', 'active')";
            mysqli_query($conn, $sql2) or die(mysqli_error($conn));
        ?>
            <script type="text/javascript">
                document.getElementById("uerror").style.display = "none";
                document.getElementById("perror").style.display = "none";
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