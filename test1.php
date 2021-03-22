<?php
//
////$first_day_this_month = date('m-01-Y'); // hard-coded '01' for first day
//$first_day_this_month = date('Y-m-01'); 
//$last_day_this_month  = date('Y-m-t');
//
//echo $first_day_this_month."<br>";
//echo $last_day_this_month;


$month1 = date('Y-m', strtotime(date('Y-m') . " -10 month"));
echo $month1;

?>