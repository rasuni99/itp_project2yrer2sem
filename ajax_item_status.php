<?php
include 'connection.php';
include 'header.php';
// $user = $_SESSION['sess_user_id'];
// $company = $_SESSION['sess_company'];

$item = $_GET['item'];


$min_sale_price = $cash_price = $credit_price = 0;
$sql78 = "SELECT min_sale_price,cash_price,credit_price,stock_shop FROM item WHERE id = '$item'";
$result78 = mysqli_query($con, $sql78);
    while ($arraySomething78 = mysqli_fetch_array($result78)) {
        $min_sale_price = $arraySomething78['min_sale_price'];
        $cash_price = $arraySomething78['cash_price'];
        $credit_price = $arraySomething78['credit_price'];
        $stock_shop = $arraySomething78['stock_shop'];
    }
    echo "<font color='blue'> <b>MSP :".number_format($min_sale_price,2)." </b></font>|| <font color='orange'> <b>CASH_P : ".number_format($cash_price,2)."</b></font> ||<font color='green'> <b> CREDIT_P : ".number_format($credit_price,2)."</b></font> ||<font color='red'> <b> IN STOCK : ".$stock_shop."</b></font>";