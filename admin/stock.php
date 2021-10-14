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
?>

<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
    <div id="breadcrumb"> <a href="demo.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="stock.php" class="tip-bottom">Stock</a> </div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: auto; padding:10px;">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                    <h5>Tire Stock</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Diameter(inch)</th>
                                <th>Size</th>
                                <th>Weight(kg)</th>
                                <th>Quantity</th>
                                <th>Selling Price</th>
                                <th>Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd gradeX">
                                <?php
                                $sql1 = "SELECT * FROM stock";
                                $res1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
                                while ($row1 = mysqli_fetch_assoc($res1)) {
                                ?>
                                    <td><?php echo $row1['companyname']; ?></td>
                                    <td><?php echo $row1['diameter']; ?></td>
                                    <td><?php echo $row1['tiresize']; ?></td>
                                    <td><?php echo $row1['weight']; ?></td>
                                    <td><?php echo $row1['quantity']; ?></td>
                                    <td><?php echo $row1['sellingprice']; ?></td>
                                    <td style="text-align:center;"><a href="edit-stock.php?id=<?php echo $row1['id']; ?>" style="text-align:center; color:green;">EDIT</a></td>
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
include "footer.php";
?>