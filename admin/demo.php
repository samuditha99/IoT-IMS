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
$page = "dashboard";
include "../user/connection.php";
include "header.php";
?>

<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
            Home</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">

<div class="row-fluid" style="background-color: white; min-height: auto; padding:10px;">
    <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5>Requested Orders</h5>
        </div>
        <div class="widget-content nopadding">
        <form action="" method="POST" class="form-horizontal">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Bill No</th>
                        <th>Card Number</th>
                        <th>Party Name</th>
                        <th>Received Date</th>
                        <th>Reveived Time</th>
                        <th>Total Amount(Rs)</th>
                        <th>Accept Request</th>
                        <th>Disline Request</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="odd gradeX">
                        <?php
                        $sql1 = "SELECT * FROM billing_header WHERE status='Requested'";
                        $res1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
                        while ($row1 = mysqli_fetch_assoc($res1)) {
                            $or_ID = $row1['id'];
                            $billNo = $row1['bill_no'];
                        ?>
                            <td><?php echo $billNo; ?></td>
                            <td><?php echo $row1['cardnumber']; ?></td>
                            <td><?php echo $row1['partyname']; ?></td>
                            <td><?php echo $row1['loadingdate']; ?></td>
                            <td><?php echo $row1['loadingtime']; ?></td>
                            <td><?php echo total_amount($or_ID, $conn); ?></td>
                            <td style="text-align: center;"><button type="button" onclick="location.href='order-accept.php?id=<?php echo $or_ID; ?>'" style="font-size:13px; margin-bottom: 0px; color: blue;" >Accept</button></td>
                            <td style="text-align: center;"><button type="button" onclick="location.href='order-disline.php?id=<?php echo $or_ID; ?>'" style="font-size:13px; margin-bottom: 0px; color: red;" >Disline</button></td>
                    </tr>
                <?php
                        }
                ?>
                </tbody>
            </table>
            </form>
        </div>
    </div>
</div>
</div>
</div>

<!--end-main-container-part-->

<?php

function total_amount($orderID, $conn){
    $total = 0;
    $sql2 = "SELECT * FROM billing_details WHERE bill_id='$orderID'";
    $res2 = mysqli_query($conn, $sql2);
    while($row2=mysqli_fetch_assoc($res2)){
        $qty = $row2['quantity'];
        $price = $row2['price'];
        $total = $total + ($price * $qty);
    }
    return $total;
}
?>


<?php
include "footer.php";
?>