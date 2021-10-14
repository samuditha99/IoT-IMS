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
$page = "sell";

$Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
file_put_contents('UIDContainer.php',$Write);

include "header.php";
include "../user/connection.php";
$bill_id = 0;
$sql0 = "SELECT * FROM billing_header ORDER BY id DESC LIMIT 1";
$res0 = mysqli_query($conn, $sql0);
while ($row0 = mysqli_fetch_assoc($res0)) {
    $bill_id = $row0['id'];
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
			$(document).ready(function(){
				 $("#getUID").load("UIDContainer.php");
				setInterval(function() {
					$("#getUID").load("UIDContainer.php");
				}, 500);
			});
</script>
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
    <div id="breadcrumb"> <a href="demo.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="sells-master.php" class="tip-bottom">Create Orders</a></div>
    </div>

    <div class="container-fluid">
        <form name="form1" action="" method="post" class="form-horizontal">
            <div class="row-fluid" style="background-color: white; min-height: 100px; padding:10px;">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"><span class="icon"> <i class="icon-align-justify"></i> </span>
                            <h5>Create a Order</h5>
                        </div>

                        <form name="form1" action="" method="POST" class="form-horizontal">
                            <div class="widget-content nopadding">
                                <div class=" span3">
                                    <br>
                                    <div>
                                        <label>Card Number</label>
                                        <textarea name="cardnum" class="span12" id="getUID" rows="1" cols="1" required readonly></textarea>
                                    </div>
                                </div>
                                <div class=" span2">
                                    <br>
                                    <div>
                                        <label>Bill Number</label>
                                        <input type="text" class="span12" name="billno" value="<?php echo generate_bill_no($bill_id); ?>" readonly>
                                    </div>
                                </div>

                                <div class="span3">
                                    <br>
                                    <div>
                                        <label>Party Name</label>
                                        <select class="span12" name="partyname">
                                            <option>Select</option>
                                            <?php
                                            $sql1 = "SELECT * FROM party_info";
                                            $res1 = mysqli_query($conn, $sql1);
                                            while ($row1 = mysqli_fetch_assoc($res1)) {
                                            ?>
                                                <option><?php echo $row1['businessneame']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="span2">
                                    <br>
                                    <div>
                                        <label>Date</label>
                                        <input type="text" class="span12" name="date" value="<?php date_default_timezone_set('Asia/Colombo');
                                                                                                echo date('Y-m-d'); ?>" readonly>
                                    </div>
                                </div>
                                <div class="span2">
                                    <br>
                                    <div>
                                        <label>Time</label>
                                        <input type="text" class="span12" name="time" value="<?php date_default_timezone_set('Asia/Colombo');
                                                                                                echo date('h:i:sa'); ?>" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="widget-content nopadding">
                                <div class=" span3">
                                    <br>
                                    <div>
                                        <label>Driver ID Card Number</label>
                                        <input type="text" class="span12" name="driverid" required>
                                    </div>
                                </div>

                                <div class="span3">
                                    <br>
                                    <div>
                                        <label>Driver Name</label>
                                        <input type="text" class="span12" name="drivername" required>
                                    </div>
                                </div>
                                <div class="span3">
                                    <br>

                                    <div>
                                        <label>Vehicle Number</label>
                                        <input type="text" class="span12" name="vehiclenum" required>
                                    </div>
                                </div>
                                <div class="span3">
                                    <br>
                                    <div>
                                        <label>Trailer Number</label>
                                        <input type="text" class="span12" name="trailernum" required>
                                    </div>
                                </div>
                            </div>
                    </div>

                </div>
            </div>

            <!-- new row-->
            <div class="row-fluid" style="background-color: white; min-height: 100px; padding:10px;">
                <div class="span12">


                    <center>
                        <h4>Select A Product</h4>
                    </center>

                    <div class=" nopadding">
                        <div class="span2">
                            <div>
                                <label>Product Company</label>
                                <select class="span11" name="comname" id="compname" onchange="select_company(this.value)">
                                    <option>Select</option>
                                    <?php
                                    $res2 = mysqli_query($conn, "SELECT * FROM stock");
                                    while ($row2 = mysqli_fetch_array($res2)) {
                                    ?>
                                        <option><?php echo $row2['companyname']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="span2">
                            <div>
                                <label>Diameter</label>
                                <div id="product_name_div">
                                    <select class="span11">
                                        <option>Select</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="span2">
                            <div>
                                <label>Tire Size</label>
                                <div id="size_div">
                                    <select class="span11">
                                        <option>Select</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="span1">
                            <div>
                                <label>Weight</label>
                                <div>
                                    <input type="text" class="span11" id="weight" name="weight" readonly>
                                </div>
                            </div>
                        </div>


                        <div class="span1">
                            <div>
                                <label>Price</label>
                                <input type="text" class="span11" name="price" id="price" readonly value="0">
                            </div>
                        </div>

                        <div class="span1">
                            <div>
                                <label>Enter Qty</label>
                                <input type="text" class="span11" name="qty" id="qty" onkeyup="final_weight()" autocomplete="off">
                            </div>
                        </div>
                        <div class="span1">
                            <div>
                                <label>T. Weight</label>
                                <input type="text" class="span11" name="tweight" id="tweight" value="0" readonly>
                            </div>
                        </div>
                        <div class="span1">
                            <div>
                                <label>T. Price</label>
                                <input type="text" class="span11" name="tprice" id="tprice" value="0" readonly>
                            </div>
                        </div>

                        <div class="span1">
                            <div>
                                <label>&nbsp</label>
                                <input type="button" class="span11 btn" style="background-color: #261A4D; color:white" value="ADD" onclick="add_session()">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- end new row-->







            <div class="row-fluid" style="background-color: white; min-height: 100px; padding:10px;">
                <div class="span12">
                    <center>
                        <h4>Taken Products</h4>
                    </center>

                    <div id="bill_products"></div>

                    <h4>
                        <div style="float: right"><span style="float:left;">Total Weight:&nbsp;</span><span style="float: left" id="totalweight">0</span><span style="float:left;">kg</span></div>
                    </h4>
                    <br>
                    <h4>
                        <div style="float: right"><span style="float:left;">Total Price:&nbsp;Rs.&nbsp;</span><span style="float: left" id="totalbill">0</span><span style="float:left;">.00</span></div>
                    </h4>


                    <br><br>

                    <center>
                        <input type="submit" name="submit2" style="background-color: #261A4D; color:white" value="GENERATE BILL" class="btn">
                    </center>
                    <div class="control-group">
                        <div class="alert alert-danger" style="margin: 10px; display:none;" id="error">
                            This Card Number Already Exist. Please Try Another!
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
</div>

<script type="text/javascript">
    function select_company(companyname) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("product_name_div").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "ajax/load-diameter-using-companyname-s.php?companyname=" + companyname, true);
        xmlhttp.send();
    }

    function select_diameter(diameter, companyname) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("size_div").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "ajax/load-size-using-companyname-s.php?companyname=" + companyname + "&diameter=" + diameter, true);
        xmlhttp.send();
    }

    function select_tire_size(tiresize, diameter, companyname) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("weight").value = xmlhttp.responseText;
                select_weight(tiresize, diameter, companyname);
            }
        }
        xmlhttp.open("GET", "ajax/load-weight-using-companyname-s.php?companyname=" + companyname + "&diameter=" + diameter + "&tiresize=" + tiresize, true);
        xmlhttp.send();
    }

    function select_weight(tiresize, diameter, companyname) {
        console.log(tiresize, diameter, companyname);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("price").value = xmlhttp.responseText;
                console.log(xmlhttp.responseText);
            }
        }
        xmlhttp.open("GET", "ajax/load-price-using-companyname-s.php?companyname=" + companyname + "&diameter=" + diameter + "&tiresize=" + tiresize, true);
        xmlhttp.send();
    }

    function final_weight() {
        document.getElementById("tweight").value = eval(document.getElementById("weight").value) * eval(document.getElementById("qty").value);
        final_price();
    }

    function final_price() {
        document.getElementById("tprice").value = eval(document.getElementById("price").value) * eval(document.getElementById("qty").value);
    }

    function add_session() {
        var companyanme = document.getElementById("compname").value;
        var diameter = document.getElementById("diameter").value;
        var tiresize = document.getElementById("size").value;
        var tireweight = document.getElementById("weight").value;
        var price = document.getElementById("price").value;
        var quantity = document.getElementById("qty").value;
        var totalweight = document.getElementById("tweight").value;
        var totalprice = document.getElementById("tprice").value;

        console.log(companyanme, diameter, tiresize, tireweight, price, quantity, totalweight, totalprice);

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                if (xmlhttp.responseText == "") {
                    load_billing_products();
                    alert("Product Added Successfully");
                } else {
                    load_billing_products();
                    alert(xmlhttp.responseText);
                }
            }
        }
        xmlhttp.open("GET", "ajax/save_in_session.php?companyname=" + companyanme + "&diameter=" + diameter + "&tiresize=" + tiresize + "&tireweight=" + tireweight + "&price=" + price + "&quantity=" + quantity + "&totweight=" + totalweight + "&totprice=" + totalprice, true);
        xmlhttp.send();

    }

    function load_billing_products() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("bill_products").innerHTML = xmlhttp.responseText;
                load_total_bill();
                load_total_weight();
            }
        }
        xmlhttp.open("GET", "ajax/load-billing-products.php", true);
        xmlhttp.send();
    }

    function load_total_bill() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("totalbill").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "ajax/load-billing-amount.php", true);
        xmlhttp.send();
    }

    function load_total_weight() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("totalweight").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "ajax/load-total-weight.php", true);
        xmlhttp.send();
    }

    load_billing_products();

    function edit_qty(qty1, companyname1, diameter1, tiresize1, weight1, price1) {
        console.log(qty1, companyname1, diameter1, tiresize1, weight1, price1);
        var companyanme = companyname1;
        var diameter = diameter1;
        var tiresize = tiresize1;
        var tireweight = weight1;
        var price = price1;
        var quantity = qty1;
        var totalweight = eval(qty1) * eval(weight1);
        var totalprice = eval(qty1) * eval(price1);

        console.log(companyanme, diameter, tiresize, tireweight, price, quantity, totalweight, totalprice);

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                if (xmlhttp.responseText == "") {
                    load_billing_products();
                    alert("Product Updated Successfully");
                } else {
                    load_billing_products();
                    alert(xmlhttp.responseText);
                }
            }
        }
        xmlhttp.open("GET", "ajax/update_in_session.php?companyname=" + companyanme + "&diameter=" + diameter + "&tiresize=" + tiresize + "&tireweight=" + tireweight + "&price=" + price + "&quantity=" + quantity + "&totweight=" + totalweight + "&totprice=" + totalprice, true);
        xmlhttp.send();
    }

    function delete_qty(sessionid) {

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                if (xmlhttp.responseText == "") {
                    load_billing_products();
                    alert("Product Updated Successfully");
                } else {
                    load_billing_products();
                    alert(xmlhttp.responseText);
                }
            }
        }
        xmlhttp.open("GET", "ajax/delete_in_session.php?sessionid=" + sessionid, true);
        xmlhttp.send();
    }
</script>

<?php

function generate_bill_no($id)
{
    if ($id == "") {
        $id1 = 0;
    } else {
        $id1 = $id;
    }
    $id1 = $id1 + 1;
    $len = strlen($id1);
    if ($len == "1") {
        $id1 = "0000" . $id1;
    }
    if ($len == "2") {
        $id1 = "000" . $id1;
    }
    if ($len == "3") {
        $id1 = "00" . $id1;
    }
    if ($len == "4") {
        $id1 = "0" . $id1;
    }
    if ($len == "5") {
        $id1 = $id1;
    }
    return $id1;
}
?>
<?php
if (isset($_POST['submit2'])) {
    $cardNumber = $_POST['cardnum'];
    $billNumber = $_POST['billno'];
    $partyName = $_POST['partyname'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $driverID = $_POST['driverid'];
    $driverName = $_POST['drivername'];
    $vehicleNumber = $_POST['vehiclenum'];
    $trailerNumber = $_POST['trailernum'];

    $count = 0;
    $sql2 = "SELECT * FROM billing_header WHERE cardnumber='$cardNumber'";
    $res2 = mysqli_query($conn, $sql2);
    $count = mysqli_num_rows($res2);
    if ($count > 0) {
?>
        <script type="text/javascript">
            document.getElementById("error").style.display = "block";
            setTimeout(function() {
                window.location.href = window.location.href;
            }, 1000);
        </script>
<?php
    } else {
        $sql3 = "INSERT INTO billing_header VALUES(NULL, '$cardNumber', '$partyName', '$date', '$time', '0000-00-00','0' ,'0000-00-00', '0', '$driverID', '$driverName', '$vehicleNumber', '$trailerNumber', '$billNumber', 'Pending')";
        mysqli_query($conn, $sql3) or die(mysqli_error($conn));

        $sql4 = "SELECT * FROM billing_header ORDER BY id DESC LIMIT 1";
        $res4 = mysqli_query($conn, $sql4);
        while ($row4 = mysqli_fetch_assoc($res4)) {
            $lastBillNo = $row4['id'];
        }
        $max = sizeof($_SESSION['cart']);
        for ($i = 0; $i < $max; $i++) {
            $company_name_session = "";
            $diameter_session = "";
            $tire_size_sessoin = "";
            $weight_session = "";
            $price_session = "";

            if (isset($_SESSION['cart'][$i])) {

                foreach ($_SESSION['cart'][$i] as $key => $val) {
                    if ($key == "company_name") {
                        $company_name_session = $val;
                    } elseif ($key == "diameter") {
                        $diameter_session = $val;
                    } elseif ($key == "tire_size") {
                        $tire_size_sessoin = $val;
                    } elseif ($key == "weight") {
                        $weight_session = $val;
                    } elseif ($key == "qty") {
                        $qty_session = $val;
                    } elseif ($key == "price") {
                        $price_session = $val;
                    }
                }
                if ($company_name_session != "") {
                    
                    $sql5 = "INSERT INTO billing_details VALUES(NULL, '$lastBillNo', '$company_name_session', '$diameter_session', '$tire_size_sessoin', '$weight_session', '$price_session', '$qty_session')";
                    $res5 = mysqli_query($conn, $sql5) or die(mysqli_error($conn));

                    $sql6 = "UPDATE stock SET quantity='quantity - $qty_session' WHERE companyname='$company_name_session' && diameter='$diameter_session' && tiresize='$tire_size_sessoin'";
                    $res6 = mysqli_query($conn,$sql6);
                }
            }
        }
        unset($_SESSION['cart']);
        ?>
        <script type="text/javascript">
        alert("Bill Generated Successfully");
        window.location.href = window.location.href;
    </script>
        <?php
    }
}


?>

<?php
include "footer.php";
?>