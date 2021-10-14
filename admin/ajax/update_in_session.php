<?php
session_start();
include "../../user/connection.php";
$companyName = $_GET['companyname'];
$diameter = $_GET['diameter'];
$tireSize = $_GET['tiresize'];
$weight = $_GET['tireweight'];
$unitPrice = $_GET['price'];
$quantity = $_GET['quantity'];
$totalWeight = $_GET['totweight'];
$totalPrice = $_GET['totprice'];


    
        $av_qty = 0;
        $exist_qty = 0;
        $exist_qty = 0;
        $exist_qty = $quantity;
        $av_qty = check_qty($companyName, $diameter, $tireSize, $weight, $conn);
        if($av_qty >= $exist_qty){
            $check_product_no_session = check_product_no_session($companyName, $diameter, $tireSize, $weight);
            $b = array("company_name" => $companyName, "diameter" => $diameter, "tire_size" => $tireSize, "weight" => $weight, "price" => $unitPrice, "qty" => $exist_qty);
            $_SESSION['cart'][$check_product_no_session] = $b;
        }else{
            echo "Entered Quantity is not Available";
        }


function check_qty($companyName, $diameter, $tireSize, $weight, $conn){
    $product_qty=0;
    $sql = "SELECT * FROM stock WHERE companyname='$companyName' && diameter='$diameter' && tiresize='$tireSize' && weight='$weight'";
    $res = mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($res)){
        $product_qty = $row['quantity'];
    }
    return $product_qty;
}

function check_duplicate_product($companyName, $diameter, $tireSize, $weight){
    $found = 0;
    $max = sizeof($_SESSION['cart']);
    for($i=0; $i<$max; $i++){
        if(isset($_SESSION['cart'][$i])){
            $company_name_session = "";
            $diameter_session = "";
            $tire_size_sessoin = "";
            $weight_session = "";

            foreach($_SESSION['cart'][$i] as $key => $val){
                if($key=="company_name"){
                    $company_name_session = $val;
                }elseif($key == "diameter"){
                    $diameter_session = $val;
                }elseif($key == "tire_size"){
                    $tire_size_sessoin = $val;
                }elseif($key == "weight"){
                    $weight_session = $val;
                }
            }
            if($company_name_session == $companyName && $diameter_session == $diameter && $tire_size_sessoin == $tireSize && $weight_session == $weight){
                $found = $found + 1;
            }
        }
    }
    return $found;
}

function check_the_qty($companyName, $diameter, $tireSize, $weight){
    $qty_found = 0;
    $qty_session= 0;
    $max = sizeof($_SESSION['cart']);
    for($i=0; $i<$max; $i++){
        $company_name_session = "";
        $diameter_session = "";
        $tire_size_sessoin = "";
        $weight_session = "";

        if(isset($_SESSION['cart'][$i])){

            foreach($_SESSION['cart'][$i] as $key => $val){
                if($key=="company_name"){
                    $company_name_session = $val;
                }elseif($key == "diameter"){
                    $diameter_session = $val;
                }elseif($key == "tire_size"){
                    $tire_size_sessoin = $val;
                }elseif($key == "weight"){
                    $weight_session = $val;
                }elseif($key == "qty"){
                    $qty_session = $val;
                }
            }
            if($company_name_session == $companyName && $diameter_session == $diameter && $tire_size_sessoin == $tireSize && $weight_session == $weight){
                $qty_found = $qty_session;
            }
        }
    }
    return $qty_found;
}

function check_product_no_session($companyName, $diameter, $tireSize, $weight){
    $recordno = 0;
    $max = sizeof($_SESSION['cart']);
    for($i=0; $i<$max; $i++){
        if(isset($_SESSION['cart'][$i])){
            $company_name_session = "";
            $diameter_session = "";
            $tire_size_sessoin = "";
            $weight_session = "";

            foreach($_SESSION['cart'][$i] as $key => $val){
                if($key=="company_name"){
                    $company_name_session = $val;
                }elseif($key == "diameter"){
                    $diameter_session = $val;
                }elseif($key == "tire_size"){
                    $tire_size_sessoin = $val;
                }elseif($key == "weight"){
                    $weight_session = $val;
                }
            }
            if($company_name_session == $companyName && $diameter_session == $diameter && $tire_size_sessoin == $tireSize && $weight_session == $weight){
                $recordno = $i;
            }
        }
    }
    return $recordno;
}

?>