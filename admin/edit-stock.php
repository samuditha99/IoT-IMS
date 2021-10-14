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
$page = "stock";
include "header.php";
include "../user/connection.php";
$id = $_GET['id'];
$sql1 = "SELECT * FROM stock WHERE id='$id'";
$res1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
while($row1=mysqli_fetch_assoc($res1)){
    $companyName = $row1['companyname'];
    $diameter = $row1['diameter'];
    $tireSize = $row1['tiresize'];
    $weight = $row1['weight'];
    $quantity = $row1['quantity'];
    $sellingPrice = $row1['sellingprice'];
}
?>

<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
    <div id="breadcrumb"> <a href="demo.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="stock.php" class="tip-bottom">Stock</a> <a href="" class="tip-bottom">Edit Stock</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: auto; padding:10px;">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Edit Stock</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="" method="POST" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Company Name :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="comname" value="<?php echo $companyName; ?>" readonly />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Diameter :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="diameter" value="<?php echo $diameter; ?>" readonly />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tire Size :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="tiresize" value="<?php echo $tireSize; ?>" readonly />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tire Weight :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="weight" value="<?php echo $weight; ?>" readonly/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Quantity :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="qty" value="<?php echo $quantity; ?>" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Selling Price :</label>
                                <div class="controls">
                                     
                                        <input type="text" name="sprice" class="span11" id="tprice" style="margin-bottom: 10px;" value="<?php echo $sellingPrice; ?>">
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" name="submit" class="btn" style="background-color: #261A4D; color:white">UPDATE</button>
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
    $quantity = $_POST['qty'];
    $sellingPrice = $_POST['sprice'];

    
    $sql2 = "UPDATE stock SET quantity='$quantity', sellingprice='$sellingPrice' WHERE companyname='$companyName' && diameter='$diameter' && tiresize='$tireSize'";
    mysqli_query($conn, $sql2) or die(mysqli_error($conn));
    ?>
        <script type="text/javascript">
            document.getElementById("success").style.display = "block";
            setTimeout(function() {
                window.location = "stock.php";
            }, 3000);
        </script>
<?php
}
?>
<?php
include "footer.php";
?>