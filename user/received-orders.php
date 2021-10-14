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
$page = "orders";
include "./header.php";
include "./connection.php";
?>

<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
    <div id="breadcrumb"> <a href="demo.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="" class="tip-bottom">Received Orders</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: auto; padding:10px;">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                    <h5>All Received Orders</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Bill No</th>
                                <th>Card Number</th>
                                <th>Party Name</th>
                                <th>Received Date</th>
                                <th>Received Time</th>
                                <th>Total Weight(kg)</th>
                                <th>Bill Status</th>
                                <th>Bill Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd gradeX">
                                <?php
                                $sql1 = "SELECT * FROM billing_header WHERE  status='Requested' || status='Warehouse Disline' || status='Accepted' || status='Disline'";
                                $res1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
                                while ($row1 = mysqli_fetch_assoc($res1)) {
                                    $or_ID = $row1['id'];
                                ?>
                                    <td><?php echo $row1['bill_no']; ?></td>
                                    <td><?php echo $row1['cardnumber']; ?></td>
                                    <td><?php echo $row1['partyname']; ?></td>
                                    <td><?php echo $row1['loadingdate']; ?></td>
                                    <td><?php echo $row1['loadingtime']; ?></td>
                                    <td><?php echo total_weight($or_ID, $conn); ?></td>
                                    <td><?php echo $row1['status']; ?></td>
                                    <td style="text-align:center;"><a href="order-details.php?id=<?php echo $row1['bill_no']; ?>" style="text-align:center; color:blue;">View Details</a></td>
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

<!--end-main-container-part-->

<?php

function total_weight($orderID, $conn){
    $totalw = 0;
    $sql2 = "SELECT * FROM billing_details WHERE bill_id='$orderID'";
    $res2 = mysqli_query($conn, $sql2);
    while($row2=mysqli_fetch_assoc($res2)){
        $qty = $row2['quantity'];
        $weight = $row2['weight'];
        $totalw = $totalw + ($weight * $qty);
    }
    return $totalw;
}

?>

<?php
include "footer.php";
?>