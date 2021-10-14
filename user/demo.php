<?php
session_start();
if(!isset($_SESSION["user"])){
    ?>
    <script type="text/javascript">
            window.location = "../index.php";
        </script>
    <?php
}
?>
<?php
$page = "dashboard";

$Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
file_put_contents('UIDContainer.php',$Write);

include "header.php";
include "./connection.php";
require __DIR__ . '/vendor/autoload.php';
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


<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="demo.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
                Home</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">

    <div class="row-fluid" style="background-color: white; min-height: auto; padding:10px;">
            <br>
            <form action="" method="POST" class="form-horizontal">
                <div class="span10">
                    <div>
                        <!-- <input type="text" class="span12" name="cnum" required> -->
                        <textarea name="cnum" class="span12" id="getUID" rows="1" cols="1" required readonly></textarea> 
                    </div>
                </div>
                <div class="span2">
                    <div>
                        <button type="submit" name="submit10" class="btn span12" style="background-color: #261A4D; color:white;">SEARCH</button>
                    </div>
                </div>
            </form>


            <?php
            if (isset($_POST['submit10'])) {
                $cardNumber = $_POST['cnum'];

                $count = 0;
                $sql1 = "SELECT * FROM billing_header WHERE cardnumber='$cardNumber'";
                $res1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
                $count = mysqli_num_rows($res1);

                if ($count == 1) {
                    while ($row1 = mysqli_fetch_assoc($res1)) {
                        $billNo = $row1['bill_no'];
                        $partyName = $row1['partyname'];
                        $billDate = $row1['billingdate'];
                        $billTime = $row1['billingtime'];
                        $driverName = $row1['drivername'];
                        $driverIdNumber = $row1['driverid'];
                        $vehicleNumber = $row1['vehiclenumber'];
                        $id = $row1['id'];
                    }
            ?>
                    <form name="form1" action="" method="POST" class="form-horizontal">
                        <div class="widget-content nopadding">
                            <div class=" span2">
                                <br>
                                <div>
                                    <label>Bill Number</label>
                                    <input type="text" class="span12" name="billnum" value="<?php echo $billNo; ?>" readonly>
                                </div>
                            </div>
                            <div class=" span3">
                                <br>
                                <div>
                                    <label>Party Name</label>
                                    <input type="text" class="span12" value="<?php echo $partyName; ?>" readonly>
                                </div>
                            </div>
                            <div class="span2">
                                <br>
                                <div>
                                    <label>Bill Date</label>
                                    <input type="text" class="span12" value="<?php echo $billDate; ?>" readonly>
                                </div>
                            </div>
                            <div class="span2">
                                <br>
                                <div>
                                    <label>Bill Time</label>
                                    <input type="text" class="span12" value="<?php echo $billTime; ?>" readonly>
                                </div>
                            </div>
                            <div class="span3">
                                <br>
                                <div>
                                    <label>Driver Name</label>
                                    <input type="text" class="span12" value="<?php echo $driverName; ?>" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="widget-content nopadding">
                            <div class=" span3">
                                <br>
                                <div>
                                    <label>Driver ID Card Number</label>
                                    <input type="text" class="span12" value="<?php echo $driverIdNumber; ?>" readonly>
                                </div>
                            </div>
                            <div class="span2">
                                <br>
                                <div>
                                    <label>Vehicle Number</label>
                                    <input type="text" class="span12" value="<?php echo $vehicleNumber; ?>" readonly>
                                </div>
                            </div>
                            <div class="span2">
                                <br>
                                <div>
                                    <label>Order Weight</label>
                                    <input type="text" class="span12" value="<?php echo total_weight($id, $conn); ?>" readonly>
                                </div>
                            </div>
                            <div class="span3">
                                <br>
                                <div>
                                    <label>&nbsp</label>
                                    <button type="submit" name="submit11" class="btn span12" style="background-color: #261A4D; color:white;">REQUEST TO DISPATCH</button>
                                </div>
                            </div>
                            <div class="span2">
                                <br>
                                <div>
                                    <label>&nbsp;</label>
                                    <button type="submit" name="submit12" class="btn span12" style="background-color: red; color:white;">DISLINE</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    &nbsp;
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                            <h5>Bill Detalis</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Diameter</th>
                                        <th>Tire Size</th>
                                        <th>Weight</th>
                                        <th>Unit Price</th>
                                        <th>Quantity</th>
                                        <th>Total Weight</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $sql2 = "SELECT * FROM billing_details WHERE bill_id = '$id'";
                                    $res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
                                    while ($row2 = mysqli_fetch_assoc($res2)) {
                                        $total1 = 0;
                                        $weight1 = 0;
                                        $prodCompany = $row2['companyname'];
                                        $diameter = $row2['diameter'];
                                        $tireSize = $row2['tiresize'];
                                        $weight = $row2['weight'];
                                        $price = $row2['price'];
                                        $qty = $row2['quantity'];
                                    ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $prodCompany; ?></td>
                                            <td><?php echo $diameter; ?></td>
                                            <td><?php echo $tireSize; ?></td>
                                            <td><?php echo $weight; ?></td>
                                            <td><?php echo $price; ?></td>
                                            <td><?php echo $qty; ?></a></td>
                                            <td><?php echo ($qty * $weight); ?></a></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr class="odd gradeX">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td style="text-align: center;"> <?php echo "<b>Final Weight : </b>" . total_weight($id, $conn) . "kg"; ?> </a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php

                date_default_timezone_set('Asia/Colombo');
                $nowDate = date('Y-m-d');
                $nowTime = date('h:i:sa');

                $sql3 = "UPDATE billing_header SET loadingdate='$nowDate', loadingtime='$nowTime' WHERE bill_no=$billNo ";
                mysqli_query($conn, $sql3) or die(mysqli_error($conn));

                } else {
                    ?>
                    <script type="text/javascript">
                    alert("No Card Found!");
                    window.location.href = window.location.href;
                </script>
                <?php
                }
            } else {
                ?>
                <form name="form1" action="" method="POST" class="form-horizontal">
                        <div class="widget-content nopadding">
                            <div class=" span2">
                                <br>
                                <div>
                                    <label>Bill Number</label>
                                    <input type="text" class="span12" readonly>
                                </div>
                            </div>
                            <div class=" span3">
                                <br>
                                <div>
                                    <label>Party Name</label>
                                    <input type="text" class="span12"  readonly>
                                </div>
                            </div>
                            <div class="span2">
                                <br>
                                <div>
                                    <label>Bill Date</label>
                                    <input type="text" class="span12"  readonly>
                                </div>
                            </div>
                            <div class="span2">
                                <br>
                                <div>
                                    <label>Bill Time</label>
                                    <input type="text" class="span12"  readonly>
                                </div>
                            </div>
                            <div class="span3">
                                <br>
                                <div>
                                    <label>Driver Name</label>
                                    <input type="text" class="span12"  readonly>
                                </div>
                            </div>
                        </div>

                        <div class="widget-content nopadding">
                            <div class=" span3">
                                <br>
                                <div>
                                    <label>Driver ID Card Number</label>
                                    <input type="text" class="span12"  readonly>
                                </div>
                            </div>
                            <div class="span2">
                                <br>
                                <div>
                                    <label>Vehicle Number</label>
                                    <input type="text" class="span12"  readonly>
                                </div>
                            </div>
                            <div class="span2">
                                <br>
                                <div>
                                    <label>Order Weight</label>
                                    <input type="text" class="span12" readonly>
                                </div>
                            </div>
                            <div class="span3">
                                <br>
                                <div>
                                    <label>&nbsp</label>
                                    <button type="submit" class="btn span12" style="background-color: #261A4D; color:white;">REQUEST TO DISPATCH</button>
                                </div>
                            </div>
                            <div class="span2">
                                <br>
                                <div>
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn span12" style="background-color: red; color:white;">DISLINE</button>
                                    &nbsp;
                                </div>
                            </div>
                        </div>
                    </form>
            <?php
            }
            ?>
        </div>

    </div>
</div>

<!--end-main-container-part-->



<?php
function total_weight($bill_ID, $conn)
{
    $totalw = 0;
    $sql10 = "SELECT * FROM billing_details WHERE bill_id='$bill_ID'";
    $res10 = mysqli_query($conn, $sql10);
    while ($row10 = mysqli_fetch_assoc($res10)) {
        $qty = $row10['quantity'];
        $weight = $row10['weight'];
        $totalw = $totalw + ($weight * $qty);
    }
    return $totalw;
}

if(isset($_POST['submit11'])){
    $options = array(
        'cluster' => 'ap2',
        'useTLS' => true
      );
      $pusher = new Pusher\Pusher(
        'a14e4453e32002cd5a51',
        '58d0da1be3378b68123f',
        '1278815',
        $options
      );
      
    $billNumber = $_POST['billnum'];
    $sql4 = "UPDATE billing_header SET status='Requested' WHERE bill_no='$billNumber'";
    mysqli_query($conn, $sql4);
    $data['message'] = $billNumber;
    $pusher->trigger('my-channel', 'my-event', $data);
}

 if(isset($_POST['submit12'])){
    $billNumber = $_POST['billnum'];
    $sql5 = "UPDATE billing_header SET status='Warehouse Disline' WHERE bill_no='$billNumber'";
    mysqli_query($conn, $sql5);
}

?>






<?php
include "footer.php";
?>