<?php
$date = "02/01/2017";
$date = date('Y-m-d', strtotime(str_replace('-', '/', $date)));
echo $date;

?>

