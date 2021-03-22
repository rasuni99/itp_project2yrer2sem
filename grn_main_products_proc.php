<?php

include 'connection.php';
include 'header.php';
// $user = $_SESSION['sess_user_id'];
// $company = $_SESSION['sess_company'];
// $internal_grn_code = $_SESSION['code_grn_internal'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
 $date = $_POST["grndate"];
 $description_main = $_POST["description_main"];
 $count = $_POST["count"];
    
    
            $quantity_total = 0;
            for($counter = 0; $counter < count($_POST["item_name"]); $counter++)
                        {  
                             
                            $quantity = $_POST["quantity"][$counter];
                            $quantity_total = $quantity + $quantity_total;
                        }              
       
                        if($quantity_total==$count){
    
    

 //$internal_grn_code = "AB";
 $sql4 = "SELECT current_grn_internal FROM company WHERE id='$company' ";
    $result4 = mysqli_query($con, $sql4);
    while ($arraySomething4 = mysqli_fetch_array($result4)) {
    $current_grn_internal = $arraySomething4['current_grn_internal'];
    }
    $current_grn_internal1 = $current_grn_internal + 1;
    $current_grn_internal2 = $current_grn_internal1 + 100000;
    $current_grn_internal_no = $internal_grn_code.$current_grn_internal2 ;
 
 $sql = "INSERT INTO grn_internal (grn_no,date,description,items_added,user,company) VALUES"
    . " ('$current_grn_internal_no','$date','$description_main','$count','$user', '$company')";   
    if(mysqli_query($con, $sql)){

     $sql1 = "UPDATE company SET current_grn_internal = '$current_grn_internal1' WHERE id='$company'";
     mysqli_query($con, $sql1);
    }
                            
    for($counter = 0; $counter < count($_POST["item_name"]); $counter++)
                        {  
                            $item_id = $_POST["item_name"][$counter];
                            $quantity = $_POST["quantity"][$counter];
                            $description = $_POST["description"][$counter];
                          
                          
                             //ITEM COUNT ADDITION FROM STOCK TABLE - START
                            $sql25 = "SELECT stock_shop FROM item WHERE id = '$item_id'";
                               $result25 = mysqli_query($con, $sql25);
                                   while ($arraySomething25 = mysqli_fetch_array($result25)) {
                                       $stock_shop = $arraySomething25['stock_shop'];  
                                   }
                            $new_stock_shop = $stock_shop + $quantity;
                            
                            $sql18 = "UPDATE item SET stock_shop = '$new_stock_shop' WHERE id='$item_id'";
                            mysqli_query($con, $sql18); 
                            
                            
                            
                            //RETRIEVE ITEM DATA - START
                                   $cat4 = $cat4_name="";
                                   $cat3 = $cat3_name="";
                             $sql78 = "SELECT id,cat1,cat2,cat3,cat4 FROM item WHERE id = '$item_id'";
                               $result78 = mysqli_query($con, $sql78);
                                   while ($arraySomething78 = mysqli_fetch_array($result78)) {
                                       $cat1 = $arraySomething78['cat1'];
                                       $cat2 = $arraySomething78['cat2'];
                                       $cat3 = $arraySomething78['cat3'];
                                       $cat4 = $arraySomething78['cat4'];

                                   }
                             
                                 
                           $sql18 = "SELECT name FROM category_one WHERE id='$cat1' ";
                           $result18 = mysqli_query($con, $sql18);
                           while ($arraySomething18 = mysqli_fetch_array($result18)) {
                           $cat1_name = $arraySomething18['name'];
                           }

                           $sql2 = "SELECT name FROM category_two WHERE id='$cat2' ";
                           $result2 = mysqli_query($con, $sql2);
                           while ($arraySomething2 = mysqli_fetch_array($result2)) {
                           $cat2_name = $arraySomething2['name'];
                           }

                           $sql3 = "SELECT name FROM category_three WHERE id='$cat3' ";
                           $result3 = mysqli_query($con, $sql3);
                           while ($arraySomething3 = mysqli_fetch_array($result3)) {
                           $cat3_name = $arraySomething3['name'];
                           }


                           $sql4 = "SELECT name FROM category_four WHERE id='$cat4' ";
                           $result4 = mysqli_query($con, $sql4);
                           while ($arraySomething4 = mysqli_fetch_array($result4)) {
                           $cat4_name = $arraySomething4['name'];
                           }
                            
                           $item_name = $cat1_name." ".$cat2_name." ".$cat3_name." ".$cat4_name;
                           
                           //RETRIEVE GRN ID - START
                            $sql75 = "SELECT id FROM grn_internal WHERE grn_no = '$current_grn_internal_no'";
                               $result75 = mysqli_query($con, $sql75);
                                   while ($arraySomething75 = mysqli_fetch_array($result75)) {
                                       $grn_id = $arraySomething75['id'];  
                                   }
                        //RETRIEVE GRN ID - END     
                            
                           $sql = "INSERT INTO grn_internal_items (item_id,grn_id,quantity,item_name,description,user,company) VALUES"
                            . " ('$item_id','$grn_id','$quantity','$item_name','$description','$user', '$company')";   
                            if(mysqli_query($con, $sql)){
                            
                            
                            }   
                            
                          }    
                            
                            
                            
                            
                           //  $sql189 = "UPDATE item SET stock_shop = '$new_stock_shop' WHERE id='$item_id'";
                             
                             if(mysqli_query($con, $sql))   
                                echo "<div class='callout callout-success'><center>GRN GENERATED SUCCESSULLY !</center><div>";
                             else 
                                echo "<div class='callout callout-danger'><center>FAILED : GRN GENERATED HAS BEEN FAILED ! CONTACT ADMINISTRATOR</center><div>";
                  
                            
                        }
                        else{
     echo "<div class='callout callout-danger'><center>FAILED : TOTAL ITEM QUNTITY NOT MATCHING !</center><div>";
}
        
}

               
?>