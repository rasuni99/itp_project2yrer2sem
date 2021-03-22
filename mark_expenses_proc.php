<?php
include 'connection.php';
include 'header.php';

// $user = $_SESSION['sess_user_id'];
// $company = $_SESSION['sess_company'];

$today = date('Y-m-d'); 
$todaynow = date("Y-m-d h:i:sA");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        if(isset($_POST["description"][0])){
            $payee = $_POST['payee'];
            $pay_date = $_POST['pay_date'];
            $payee_account = $_POST['payee_account'];
            $refno = $_POST['refno'];
            
             $sql71 = "SELECT expense_final FROM expenses_types WHERE id='$payee'";
                $result71 = mysqli_query($con, $sql71);
                   while ($arraySomething71 = mysqli_fetch_array($result71)) {
                   $payee_name = $arraySomething71['expense_final'];
                   }
            
            $net_total = 0;
             for($count = 0; $count < count($_POST["description"]); $count++)
                                   {  

                                                        $item_charge = $_POST["unit_price"][$count];
                                                        $description = $_POST["description"][$count];
                                                        $description = strtoupper($description) ;
                                                        $quantity = $_POST["quantity"][$count];
                                                        $sub_total = $item_charge * $quantity ;
                                                        $net_total = $net_total + $sub_total;

           
          }


            if($payee_account==1){
                
                 $sql9 = "SELECT SUM(pettry_cash_in)-SUM(pettry_cash_out) AS petty_cash FROM petty_cash WHERE stat = '1'";
                    $result9 = mysqli_query($con, $sql9);
                    while ($arraySomething9 = mysqli_fetch_array($result9)) {
                        $petty_cash = $arraySomething9['petty_cash'];
                 }
                 
                 if($petty_cash>=$net_total){

                       $sql = "INSERT INTO expenses_cash (payee,payee_name,pay_date,amount,ref_no,user,company) VALUES ('$payee','$payee_name','$pay_date','$net_total','$refno','$user','$company')";   
                          if(mysqli_query($con, $sql)){

                               $sql7 = "SELECT id FROM expenses_cash WHERE user='$user' AND payee='$payee' AND pay_date='$pay_date' ORDER BY id DESC LIMIT 1";
                               $result7 = mysqli_query($con, $sql7);
                                  while ($arraySomething7 = mysqli_fetch_array($result7)) {
                                  $petty_cash_id = $arraySomething7['id'];
                                  }
                               $account_type = "EXPENSES-CASH";

                              
                                $item_charge = $quantity = $sub_total =  $net_total = 0 ;
                                $description = "";
                                                     
                              for($count = 0; $count < count($_POST["description"]); $count++)
                                   {  

                                                        $item_charge = $_POST["unit_price"][$count];
                                                        $description = $_POST["description"][$count];
                                                        $description = strtoupper($description) ;
                                                        $quantity = $_POST["quantity"][$count];
                                                        $sub_total = $item_charge * $quantity ;
                                                        $net_total = $net_total + $sub_total;

                                     $sql9 = "INSERT INTO expenses_descriptions (description,unit_charge,quantity,sub_total,account_type,type_id,user,company) VALUES ('$description','$item_charge','$quantity','$sub_total','$account_type','$petty_cash_id','$user','$company')";  
                                     mysqli_query($con, $sql9);
                                   }

                              $sql8 =  "INSERT INTO petty_cash (pettry_cash_out,reference_id,user,company) VALUES ('$net_total','$petty_cash_id','$user','$company')";   
                              mysqli_query($con, $sql8);
                          
                           echo "DONE";
                          }
                          else{
                               echo "FAILED";
                          }

            }
            else{
            echo "Error1";
            }
            
            
            }
            if($payee_account==2){
                

             $cheque_no = $_POST['cheque_no'];
             $cheque_bank_account = $_POST['cheque_bank_account'];
             $cheque_date = $_POST['cheque_date'];
             $cheque_amount = $_POST['cheque_amount'];
             
                
                 if($cheque_amount==$net_total){

                       $sql = "INSERT INTO expenses_cheque (payee,payee_name,pay_date,cheque_no,bank_account,cheque_date,amount,ref_no,user,company) VALUES ('$payee','$payee_name','$pay_date','$cheque_no','$cheque_bank_account','$cheque_date','$cheque_amount','$refno','$user','$company')";   
                          if(mysqli_query($con, $sql)){

                               $sql7 = "SELECT id FROM expenses_cheque WHERE user='$user' AND payee='$payee' AND cheque_no='$cheque_no' ORDER BY id DESC LIMIT 1";
                               $result7 = mysqli_query($con, $sql7);
                                  while ($arraySomething7 = mysqli_fetch_array($result7)) {
                                  $cheque_id = $arraySomething7['id'];
                                  }
                               $account_type = "EXPENSES-CHEQUE";

                              
                                $item_charge = $quantity = $sub_total =  $net_total = 0 ;
                                $description = "";
                                                     
                              for($count = 0; $count < count($_POST["description"]); $count++)
                                   {  

                                                        $item_charge = $_POST["unit_price"][$count];
                                                        $description = $_POST["description"][$count];
                                                        $description = strtoupper($description) ;
                                                        $quantity = $_POST["quantity"][$count];
                                                        $sub_total = $item_charge * $quantity ;
                                                        $net_total = $net_total + $sub_total;

                                     $sql9 = "INSERT INTO expenses_descriptions (description,unit_charge,quantity,sub_total,account_type,type_id,user,company) VALUES ('$description','$item_charge','$quantity','$sub_total','$account_type','$cheque_id','$user','$company')";  
                                     mysqli_query($con, $sql9);
                                   }

                         echo "DONE";
                          }
                          else{
                               echo "FAILED";
                          }

            }
            else{
            echo "Error2";
            }
                
                
            }
            if($payee_account==3){
                
             $customer_id  = $_POST['customer'];  
             $cheque_no = $_POST['cheque_no'];
             $cheque_bank = $_POST['cheque_bank'];
             $cheque_date = $_POST['cheque_date'];
             $cheque_amount = $_POST['cheque_amount'];
             
             $sql17 = "SELECT id FROM cheque WHERE cheque_no='$cheque_no' AND stat='1'";
             $result17 = mysqli_query($con, $sql17);
             $count = mysqli_num_rows($result17);
             
             if($count>0){
             
             
                
                 if($cheque_amount==$net_total){

                       $sql = "INSERT INTO expenses_third_party (payee,payee_name,pay_date,customer_id,cheque_no,bank_id,cheque_date,amount,ref_no,user,company) VALUES ('$payee','$payee_name','$pay_date','$customer_id','$cheque_no','$cheque_bank','$cheque_date','$cheque_amount','$refno','$user','$company')";   
                          if(mysqli_query($con, $sql)){

                               $sql7 = "SELECT id FROM expenses_third_party WHERE user='$user' AND payee='$payee' AND cheque_no='$cheque_no' ORDER BY id DESC LIMIT 1";
                               $result7 = mysqli_query($con, $sql7);
                                  while ($arraySomething7 = mysqli_fetch_array($result7)) {
                                  $cheque_id = $arraySomething7['id'];
                                  }
                               $account_type = "EXPENSES-THIRD-PARTY";

                              
                                $item_charge = $quantity = $sub_total =  $net_total = 0 ;
                                $description = "";
                                                     
                              for($count = 0; $count < count($_POST["description"]); $count++)
                                   {  

                                                        $item_charge = $_POST["unit_price"][$count];
                                                        $description = $_POST["description"][$count];
                                                        $description = strtoupper($description) ;
                                                        $quantity = $_POST["quantity"][$count];
                                                        $sub_total = $item_charge * $quantity ;
                                                        $net_total = $net_total + $sub_total;

                                     $sql9 = "INSERT INTO expenses_descriptions (description,unit_charge,quantity,sub_total,account_type,type_id,user,company) VALUES ('$description','$item_charge','$quantity','$sub_total','$account_type','$cheque_id','$user','$company')";  
                                     mysqli_query($con, $sql9);
                                   }

                          echo "DONE";
                          }
                          else{
                               echo "FAILED";
                          }

            }
            else{
            echo "Error2";
            }
       
            }
            else{
            echo "Error4";
            }
                
                
                

            }


        
        
        
        
        }
        else{
            echo "Error3";
        }
        
}
 ?>