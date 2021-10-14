<?php
session_start();
?>
<table class="table table-bordered">
    <tr>
        <th>Company Name</th>
        <th>Diameter(inch)</th>
        <th>Tire Size</th>
        <th>Weight(kg)</th>
        <th>Unit Price</th>
        <th>Quantity</th>
        <th>Total Weight(kg)</th>
        <th>Total Price(Rs)</th>
        <th>Delete</th>
    </tr>
    <?php

    $qty_found = 0;
    $qty_session = 0;
    $max = 0;

    if(isset($_SESSION['cart'])){
        $max = sizeof($_SESSION['cart']);
    }
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
                }elseif($key == "price"){
                    $price_session = $val;
                }
            }
            if($company_name_session != ""){
            ?>
            <tr>
        <td><?php echo $company_name_session; ?></td>
        <td><?php echo $diameter_session; ?></td>
        <td><?php echo $tire_size_sessoin; ?></td>
        <td><?php echo $weight_session; ?></td>
        <td><?php echo $price_session ?></td>
        <td style="text-align: center;"><input type="text" class="span5" id="tt<?php echo $i; ?>" value="<?php echo $qty_session; ?>">&nbsp;&nbsp;&nbsp;<button style="font-size:13px; margin-bottom: 0px;" onclick="edit_qty(document.getElementById('tt<?php echo $i; ?>').value, '<?php echo $company_name_session; ?>', '<?php echo $diameter_session; ?>', '<?php echo $tire_size_sessoin; ?>', '<?php echo $weight_session; ?>', '<?php echo $price_session; ?>')">Update</button></td>
        <td><?php echo ($qty_session * $weight_session); ?></td>
        <td><?php echo ($qty_session * $price_session); ?></td>
        <td style="color:red; text-align:center; cursor:pointer;" onclick="delete_qty('<?php echo $i; ?>')">Delete</td>
    </tr>
    <?php
        }
    }
    }

    ?>

    
</table>