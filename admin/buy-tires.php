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
$page = "buy";
include "header.php";
include "../user/connection.php";
?>

<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
    <div id="breadcrumb"> <a href="demo.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="buy-tires.php" class="tip-bottom">Add New Purchase</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: auto; padding:10px;">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Purchase Details</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="" method="POST" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Company Name :</label>
                                <div class="controls">
                                    <select class="span11" name="comname" id="comname" onchange="selectcompany(this.value)">
                                        <option>Select</option>
                                        <?php
                                        $sql1 = "SELECT * FROM companies";
                                        $res1 = mysqli_query($conn, $sql1);
                                        while ($row1 = mysqli_fetch_assoc($res1)) {
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
                                <div class="controls" id="diameter_div">
                                    <select class="span11">
                                        <option>Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tire Size :</label>
                                <div class="controls" id="size_div">
                                    <select class="span11" name="size">
                                        <option>Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tire Weight(kg) :</label>
                                <div class="controls">
                                    <input type="text" class="span11" id="weight" name="weight" readonly />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Quantity :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="qty" id="qty" value="0" onkeyup="count_total();" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Unit Price (Rs.) :</label>
                                <div class="controls">
                                    <!-- <div class="input-prepend span"> <span class="add-on span1" style="margin-right:21px;">Rs. </span> -->
                                        <input type="text" class="span11" name="uprice" id="uprice" value="0" onkeyup="count_total();" >
                                    <!-- </div> -->
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Total Amount (Rs.):</label>
                                <div class="controls">
                                    <!-- <div class="input-prepend span"> <span class="add-on span1" style="margin-right:21px;">Rs. </span> -->
                                        <input type="text" name="tprice" class="span11" id="tprice"  readonly>
                                    <!-- </div> -->
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Payment Type :</label>
                                <div class="controls">
                                    <select class="span11" name="ptype">
                                        <option>Check</option>
                                        <option>Cash</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Purchase Date :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="pdate" value="<?php date_default_timezone_set('Asia/Colombo'); echo date('Y-m-d'); ?>" readonly />
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" name="submit" class="btn" style="background-color: #261A4D; color:white">PURCHASE NOW</button>
                            </div>
                            <div class="control-group">
                                <div class="alert alert-success" style="margin: 10px; display:none;" id="success">
                                    Purchase Added Successfully!
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

<script type="text/javascript">

    function selectcompany(company_name) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("diameter_div").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "ajax/load-diameter-using-companyname.php?companyname=" + company_name, true);
        xmlhttp.send();
    }

    function select_diameter(diameter, companyName){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("size_div").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "ajax/load-size-using-companyname.php?companyname=" + companyName + "&diameter=" + diameter, true);
        xmlhttp.send();
    }

    function select_tire_size(tiresize, diameter, companyname){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("weight").value = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "ajax/load-weight-using-companyname.php?companyname=" + companyname + "&diameter=" + diameter + "&tiresize=" + tiresize, true);
        xmlhttp.send();
    }

    function count_total(){
        document.getElementById("tprice").value = eval(document.getElementById("uprice").value) * eval(document.getElementById("qty").value)
    }
    
</script>


<!--end-main-container-part-->

<?php

if (isset($_POST['submit'])) {
    $companyName = $_POST['comname'];
    $diameter = $_POST['diameter'];
    $tireSize = $_POST['size'];
    $weight = $_POST['weight'];
    $quantity = $_POST['qty'];
    $unitPrice = $_POST['uprice'];
    $totalPrice = $_POST['tprice'];
    $paymenyType = $_POST['ptype'];
    $purchaseDate = $_POST['pdate'];

    $sql2 = "INSERT INTO purchase_info VALUES (NULL, '$companyName', '$diameter', '$tireSize', '$weight', '$quantity', '$unitPrice', '$totalPrice', '$paymenyType', '$purchaseDate')";
    mysqli_query($conn, $sql2) or die(mysqli_error($conn));
    
    $count = 0;
    $sql3 = "SELECT * FROM stock WHERE companyname='$companyName' && diameter='$diameter' && tiresize='$tireSize'";
    $res3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
    $count = mysqli_num_rows($res3);
    if ($count > 0) {
        $sql4 = "UPDATE stock SET quantity=quantity+$quantity WHERE companyname='$companyName' && diameter='$diameter' && tiresize='$tireSize'";
        mysqli_query($conn,$sql4);
    } else {
        $sql5 = "INSERT INTO stock VALUES (NULL, '$companyName', '$diameter', '$tireSize', '$weight','$quantity','0')";
        mysqli_query($conn, $sql5) or die(mysqli_error($conn));
    }
    ?>
    <script type="text/javascript">
            document.getElementById("success").style.display = "block";
            setTimeout(function() {
                window.location.href = window.location.href;
            }, 3000);
        </script>
    <?php
}
?>
<?php
include "footer.php";
?>