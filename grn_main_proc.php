<?php

include 'connection.php';
include 'header.php';
// $user = $_SESSION['sess_user_id'];
// $company = $_SESSION['sess_company'];
// $grn_code = $_SESSION['code_grn'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
     if(isset($_POST["item_name"][0])){
    
    $grnprice = $_POST['grnprice'];
    $net_amount = $item_total = 0;  
    for($counter = 0; $counter < count($_POST["item_name"]); $counter++)
                        {  
                           
                            $item_charge = $_POST["unit_price"][$counter];
                            $quantity = $_POST["quantity"][$counter];
                            $item_total = $item_charge * $quantity;
                            $net_amount = $net_amount + $item_total;
                            
                        }
                        
    if($net_amount==$grnprice){
    
 $date = $_POST["grndate"];
// $grnprice = $_POST["grnprice"];
 $supplierinvoiceno = $_POST["supplierinvoiceno"];
 $supplier = $_POST["supplier"];
    
    
 $sql4 = "SELECT current_grn FROM company WHERE id='$company' ";
    $result4 = mysqli_query($con, $sql4);
    while ($arraySomething4 = mysqli_fetch_array($result4)) {
    $current_grn = $arraySomething4['current_grn'];
    }
    $current_grn1 = $current_grn + 1;
    $current_grn2 = $current_grn1 + 100000;
    $current_grn_no = $grn_code.$current_grn2 ;
 
 $sql = "INSERT INTO grn (grn_no,supplier_id,date,total_price,invoice_no,user,company) VALUES"
    . " ('$current_grn_no','$supplier','$date','$grnprice','$supplierinvoiceno','$user', '$company')";   
    if(mysqli_query($con, $sql)){

     $sql1 = "UPDATE company SET current_grn = '$current_grn1' WHERE id='$company'";
     mysqli_query($con, $sql1);
    }
                            
    for($counter = 0; $counter < count($_POST["item_name"]); $counter++)
                        {  
                            $item_id = $_POST["item_name"][$counter];
                            $quantity = $_POST["quantity"][$counter];
                            $unit_price = $_POST["unit_price"][$counter];
                          
                          
                             //ITEM COUNT ADDITION FROM STOCK TABLE - START
                            $sql25 = "SELECT stock_stores FROM row_item WHERE id = '$item_id'";
                               $result25 = mysqli_query($con, $sql25);
                                   while ($arraySomething25 = mysqli_fetch_array($result25)) {
                                       $stock_shop = $arraySomething25['stock_stores'];  
                                   }
                            $new_stock_shop = $stock_shop + $quantity;
                            
                            $sql18 = "UPDATE row_item SET stock_stores = '$new_stock_shop' WHERE id='$item_id'";
                            mysqli_query($con, $sql18); 
                            
                            
                            
                            //RETRIEVE ITEM DATA - START
                                   $cat4 = $cat4_name="";
                                   $cat3 = $cat3_name="";
                             $sql78 = "SELECT id,cat1,cat2,cat3,cat4 FROM row_item WHERE id = '$item_id'";
                               $result78 = mysqli_query($con, $sql78);
                                   while ($arraySomething78 = mysqli_fetch_array($result78)) {
                                       $cat1 = $arraySomething78['cat1'];
                                       $cat2 = $arraySomething78['cat2'];
                                       $cat3 = $arraySomething78['cat3'];
                                       $cat4 = $arraySomething78['cat4'];

                                   }
                             
                                 
                           $sql18 = "SELECT name FROM row_category_one WHERE id='$cat1' ";
                           $result18 = mysqli_query($con, $sql18);
                           while ($arraySomething18 = mysqli_fetch_array($result18)) {
                           $cat1_name = $arraySomething18['name'];
                           }

                           $sql2 = "SELECT name FROM row_category_two WHERE id='$cat2' ";
                           $result2 = mysqli_query($con, $sql2);
                           while ($arraySomething2 = mysqli_fetch_array($result2)) {
                           $cat2_name = $arraySomething2['name'];
                           }

                           $sql3 = "SELECT name FROM row_category_three WHERE id='$cat3' ";
                           $result3 = mysqli_query($con, $sql3);
                           while ($arraySomething3 = mysqli_fetch_array($result3)) {
                           $cat3_name = $arraySomething3['name'];
                           }


                           $sql4 = "SELECT name FROM row_category_four WHERE id='$cat4' ";
                           $result4 = mysqli_query($con, $sql4);
                           while ($arraySomething4 = mysqli_fetch_array($result4)) {
                           $cat4_name = $arraySomething4['name'];
                           }
                            
                           $item_name = $cat1_name." ".$cat2_name." ".$cat3_name." ".$cat4_name;
                           
                           //RETRIEVE GRN ID - START
                            $sql75 = "SELECT id FROM grn WHERE grn_no = '$current_grn_no'";
                               $result75 = mysqli_query($con, $sql75);
                                   while ($arraySomething75 = mysqli_fetch_array($result75)) {
                                       $grn_id = $arraySomething75['id'];  
                                   }
                        //RETRIEVE GRN ID - END     
                            
                           $sql = "INSERT INTO grn_items (item_id,grn_id,quantity,item_name,unit_price,user,company) VALUES"
                            . " ('$item_id','$grn_id','$quantity','$item_name','$unit_price','$user', '$company')";   
                           
                           mysqli_query($con, $sql);
                             
                            
                          }    
                            
                            
                            
                        echo "Error1";
                          
                             
                            
                  
                            
                        
                        }
            else{
                echo "Error3";
            }
            
             }
     else{
        echo "Error4";  
     }
        
}

               
?>