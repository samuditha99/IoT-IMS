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
$page = "bills";
include "header.php";
include "../user/connection.php";
$billID = $_GET['id'];
$sql1 = "SELECT * FROM billing_header WHERE id='$billID'";
$res1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
while($row1 = mysqli_fetch_assoc($res1)){
  $cardNumber = $row1['cardnumber'];
  $partyName = $row1['partyname'];
  $loadingDatee = $row1['loadingdate'];
  $loadintTime = $row1['loadingtime'];
  $departureDate = $row1['exitdate'];
  $departureTime = $row1['exittime'];
  $billNo = $row1['bill_no'];
}
$total1 = 0;
$total2 = 0;
?>


<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
    <div id="breadcrumb"> <a href="demo.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="view_bills.php" class="tip-bottom">Sales Report</a>  <a href="" class="tip-bottom">Bill Details</a></div>
    </div>
    <!--End-breadcrumbs-->

    
    <div class="container-fluid">
        <div class="row-fluid" style="background-color: white;  padding:10px;">
      <div class="span12">

      <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5>Bill Header</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">

              <tbody>
                <tr class="odd gradeX">
                  <td><b>Bill No : </b></td>
                  <td><?php echo $billNo; ?></td>
                </tr>
                <tr class="odd gradeX">
                  <td><b>Card Number : </b></td>
                  <td><?php echo $cardNumber; ?></td>
                </tr>
                <tr class="odd gradeX">
                  <td><b>Party Name : </b></td>
                  <td><?php echo $partyName; ?></td>
                </tr>
                <tr class="odd gradeX">
                  <td><b>Loading Date : </b></td>
                  <td><?php echo $loadingDatee; ?></td>
                </tr>
                <tr class="odd gradeX">
                  <td><b>Loading Time : </b></td>
                  <td><?php echo $loadintTime; ?></td>
                </tr>
                <tr class="odd gradeX">
                  <td><b>Departure Date :</b></td>
                  <td><?php echo $departureDate; ?></td>
                </tr>
                <tr class="odd gradeX">
                  <td><b>Departure Time :</b></td>
                  <td><?php echo $departureTime; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>


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
                  <th>Total Price</th>
                </tr>
              </thead>
              <tbody>

                <?php

                $sql2 = "SELECT * FROM billing_details WHERE bill_id = '$billID'";
                $res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
                while($row2 = mysqli_fetch_assoc($res2)){
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
                      <td><?php echo ($qty * $price); ?></a></td>
                    </tr>
                    <?php
                    $total1 = $total1 + ($qty * $price);
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
                      <td style="text-align: center;"> <?php  echo "<b>Final Amount : </b>Rs. ".$total1; ?> </a></td>
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