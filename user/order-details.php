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
include "header.php";
include "./connection.php";
$billNo = $_GET['id'];
$sql1 = "SELECT * FROM billing_header WHERE bill_no='$billNo'";
$res1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
while($row1 = mysqli_fetch_assoc($res1)){
    $billID = $row1['id'];
}
?>


<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
    <div id="breadcrumb"> <a href="demo.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="received-orders.php" class="tip-bottom">Received Orders</a>  <a href="" class="tip-bottom">Order Details</a></div>
    </div>
    <!--End-breadcrumbs-->

    
    <div class="container-fluid">
        <div class="row-fluid" style="background-color: white;  padding:10px;"> 
      <div class="span12">


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

                $sql2 = "SELECT * FROM billing_details WHERE bill_id = '$billID'";
                $res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
                $weight1 = 0;
                while($row2 = mysqli_fetch_assoc($res2)){
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
                    $weight1 = $weight1 + ($qty * $weight);
                  }
                ?>
                <tr class="odd gradeX">
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td style="text-align: center;"> <?php  echo "<b>Final Weight : </b>".$weight1."kg"; ?> </a></td>
                    </tr>
              </tbody>
            </table>
          </div>
        </div>        

      </div>
    </div>
  </div>
</div>


<?php
include "footer.php";
?>