<?php
session_start();
?>
    <?php
    $qty_session = 0;
    $max = 0;
    $gweight = 0;
    if(isset($_SESSION['cart'])){
        $max = sizeof($_SESSION['cart']);
    }
    for ($i = 0; $i < $max; $i++) {
        $weight_session = "";

        if (isset($_SESSION['cart'][$i])) {

            foreach ($_SESSION['cart'][$i] as $key => $val) {
                if ($key == "qty") {
                    $qty_session = $val;
                }elseif($key == "weight"){
                    $weight_session = $val;
                }
            }
            $gweight = (int)$gweight + ((int)$qty_session * (int)$weight_session);
        }
    }
echo $gweight;
    ?>
