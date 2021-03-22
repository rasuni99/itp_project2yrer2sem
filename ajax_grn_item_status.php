<?php
include 'connection.php';
include 'header.php';
// $user = $_SESSION['sess_user_id'];
// $company = $_SESSION['sess_company'];

$item = $_GET['item'];
$unit_price =0.0;
$enter_date = "No Previous GRN found for this item";
                                                $sql78 = "SELECT unit_price,enter_date FROM grn_items WHERE item_id = '$item' ORDER BY id DESC LIMIT 1";
                                                $result78 = mysqli_query($con, $sql78);
                                                    while ($arraySomething78 = mysqli_fetch_array($result78)) {
                                                        $unit_price = $arraySomething78['unit_price'];
                                                        $enter_date = $arraySomething78['enter_date'];
                                                        
														
                                                    }
                                                    
//                                                    if($unit_price==""){
//                                                        $unit_price = 0;
//                                                    }
//                                                    if($enter_date==""){
//                                                        $enter_date = "No Previous GRN found for this item";
//                                                    }
                                                    echo "Last GRN Price for the item : ".number_format($unit_price,2)." || Last GRN Date : ".$enter_date;