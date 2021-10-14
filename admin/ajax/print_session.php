<?php
session_start();
$max=0;
if(isset($_SESSION['cart']))
{
    $max = sizeof($_SESSION['cart']);
}
for ($i = 0;$i < $max; $i++)
{
    if (isset($_SESSION['cart'][$i])) {
        $company_name = "";
        $diameter = "";
        $tireSize = "";
        $weight = "";
        $quantity="";
        while (list ($key, $val) = each($_SESSION['cart'][$i]))
        {
            if ($key == "company_name") {
                $company_name = $val;
            } else if ($key == "diameter") {
                $diameter = $val;
            } else if ($key == "tire_size") {
                $tireSize = $val;
            } else if ($key == "weight") {
                $weight = $val;
            }
            else if($key=="qty")
            {
                $quantity=$val;
            }
        }
        echo $company_name." ".$diameter." ".$tireSize." ".$weight." ".$quantity;
        echo "<br>";
    }


}
// session_destroy();
?>
