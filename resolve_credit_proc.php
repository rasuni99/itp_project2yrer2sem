<style>
 @media print {
  /* style sheet for print goes here */
  .noprint {
    visibility: hidden;
  }
} 


</style><script type="text/javascript">
    function PrintWindow() {                    
       window.print();            
       CheckWindowState();
    }

    function CheckWindowState()    {           
        if(document.readyState=="complete") {
            window.close(); 
        } else {           
            setTimeout("CheckWindowState()", 2000)
        }
    }
    PrintWindow();
</script> 

    <?php
include 'connection.php';
include 'header.php';
// $user = $_SESSION['sess_user_id']; 
// $company = $_SESSION['sess_company'];
$todaynow = date("Y-m-d h:i:sA");
$today = date("Y-m-d");

     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         
         //auto realize or not
         $sql18 = "SELECT auto_realize FROM cheque_realize_condition WHERE id='1'";
         $result18 = mysqli_query($con, $sql18);
            while ($arraySomething18 = mysqli_fetch_array($result18)) {
                $auto_realize = $arraySomething18['auto_realize'];
            }
            
            if($auto_realize=='YES'){
                $payment_received = 1;
                $realize  = 1;
            }
            else{
                 $payment_received = 0;
                 $realize  = 0;
            }
         
         
          $pay_method = $_POST['pay_method'];
          if($pay_method == "CHEQUE")
          $pay_amount = $_POST['cheque_amount'];
          if($pay_method == "CASH")
          $pay_amount = $_POST['cash'];
          
          $due = $_POST['due'];
         if($pay_amount>$due){
             echo "<script>window.location = 'pay_receipt.php?msge= FAILED : RECEIPT AMOUNT IS HIGHER THAN INVOICE DUE AMOUNT ! ';</script>";
         }
         else{
                    
                    $customer_id = $_POST['customer_id'];
                    $invoice_id = $_POST['invoice_id'];

                    if($pay_method == "CHEQUE"){

                        $cheque_no = $_POST['cheque_no'];
                        $cheque_bank = $_POST['cheque_bank'];
                        $cheque_amount = $_POST['cheque_amount'];
                        $cheque_date = $_POST['cheque_date'];
                        $cheque_date = date('Y-m-d', strtotime(str_replace('-', '/', $cheque_date)));

                    }
                    else{

                        $cash = $_POST['cash'];

                    }


                                                  if($pay_method == "CASH"){

                                                      //SELECT CURRENT RECEIPT NO - START
                                                     $sql31 = "SELECT current_receipt FROM company WHERE id='$company'";
                                                       $result31 = mysqli_query($con, $sql31);
                                                       while ($arraySomething31 = mysqli_fetch_array($result31)) {
                                                       $current_receipt = $arraySomething31['current_receipt'];
                                                       } 
                                                       $new_receipt_no = $current_receipt + 1;
                                                       $new_receipt_no2 = $new_receipt_no + 100000;
                                                       $new_receipt_no1 = $code_receipt.$new_receipt_no2;
                                                      //SELECT CURRENT RECEIPT NO - END

                                                     //DATA INSERTION TO CASH_BOOK - START
                                                       $sql80 = "INSERT INTO cash_book (invoice_id,customer_id,receipt_no,amount,payment_type,payment_received,user,company) VALUES 
                                                       ('$invoice_id','$customer_id','$new_receipt_no1','$cash','CASH','1','$user','$company')"; 

                                                      if(mysqli_query($con, $sql80)){
                                                     $sql32 = "UPDATE company SET current_receipt='$new_receipt_no' WHERE id='$company'";
                                                     $result32 = mysqli_query($con, $sql32);

                                                  }
                                                  }
               //                               
                                                  if($pay_method == "CHEQUE"){


                                                       //SELECT CURRENT RECEIPT NO - START
                                                       $sql31 = "SELECT current_receipt FROM company WHERE id='$company'";
                                                       $result31 = mysqli_query($con, $sql31);
                                                       while ($arraySomething31 = mysqli_fetch_array($result31)) {
                                                       $current_receipt = $arraySomething31['current_receipt'];
                                                       } 
                                                       $new_receipt_no = $current_receipt + 1;
                                                       $new_receipt_no2 = $new_receipt_no + 100000;
                                                       $new_receipt_no1 = $code_receipt.$new_receipt_no2;
                                                      //SELECT CURRENT RECEIPT NO - END

                                                       //DATA INSERTION TO CHEQUE - START
                                                       $sql78 = "INSERT INTO cheque (invoice_id,customer_id,bank,cheque_no,cheque_date,amount,realize,user,company) VALUES ('$invoice_id','$customer_id','$cheque_bank','$cheque_no','$cheque_date','$cheque_amount','$realize','$user','$company')";  
                                                       mysqli_query($con, $sql78);
                                                        //DATA INSERTION TO CHEQUE - END

                                                      // RETRIVE LAST CHEQUE ID - START
                                                       $sql15 = "SELECT id FROM cheque WHERE user='$user' AND company='$company' AND stat = '1' AND cheque_no='$cheque_no' AND invoice_id='$invoice_id' ORDER BY id DESC LIMIT 1";
                                                       $result15 = mysqli_query($con, $sql15);
                                                       while ($arraySomething15 = mysqli_fetch_array($result15)) {
                                                       $cheque_last_id = $arraySomething15['id'];
                                                       }

                                                       //DATA INSERTION TO CASH_BOOK - START
                                                       $sql = "INSERT INTO cash_book (invoice_id,customer_id,receipt_no,amount,payment_received,payment_type_id,payment_type,user,company) VALUES 
                                                                                                                    ('$invoice_id','$customer_id','$new_receipt_no1','$cheque_amount','$payment_received','$cheque_last_id','CHEQUE','$user','$company')";  
                                                      if(mysqli_query($con, $sql)){
                                                      $sql32 = "UPDATE company SET current_receipt='$new_receipt_no' WHERE id='$company'";
                                                      mysqli_query($con, $sql32);
                                                      
                                                      }
                                                      //DATA INSERTION TO CASH_BOOK - END 
                                                      }
                          
                                                     ///////////////////////////////////////
                                                      
$sql18 = "SELECT id FROM cash_book WHERE user='$user' ORDER BY id DESC LIMIT 1";
$result18 = mysqli_query($con, $sql18);
    while ($arraySomething18 = mysqli_fetch_array($result18)) {
        $receipt_id = $arraySomething18['id'];                                                      
    }
$sql18 = "SELECT amount,receipt_no,invoice_id,DATE(entered_date) AS date,payment_type_id,payment_type FROM cash_book WHERE id='$receipt_id' ORDER BY id ASC";
$result18 = mysqli_query($con, $sql18);
    while ($arraySomething18 = mysqli_fetch_array($result18)) {
        
        $receipt_no = $arraySomething18['receipt_no'];
        $invoice_id = $arraySomething18['invoice_id'];
        $receipt_date = $arraySomething18['date'];
        $receipt_amount1 = $arraySomething18['amount'];
        $payment_type_id = $arraySomething18['payment_type_id'];
        $receipt_payment_type = $arraySomething18['payment_type'];
    }     
// RETRIEVE RECEIPT DATA - END
 
// RETRIEVE INVOICE NO - START
$sql9 = "SELECT invoice_real_no,net_amount,customer_id FROM invoice_real WHERE id='$invoice_id'";
    $result9 = mysqli_query($con, $sql9);
        while ($arraySomething9 = mysqli_fetch_array($result9)) {
        $invoice_real_no = $arraySomething9['invoice_real_no'];
        $invoice_amount = $arraySomething9['net_amount'];
        $customer_id = $arraySomething9['customer_id'];
       
        }
 // RETRIEVE INVOICE NO - END    


$last_receipt_date  = $todaynow;

// CALCULATE TOTAL PAID FOR INVOICE - START
$total_receipt_amount = $receipt_amount = $last_receipt_cheque_realize = 0;
$sql5 = "SELECT id,payment_type,payment_type_id,amount,entered_date FROM cash_book WHERE invoice_id='$invoice_id' AND stat='1' AND payment_received='1'";
    $result5 = mysqli_query($con, $sql5);
        while ($arraySomething5 = mysqli_fetch_array($result5)) {
        
        $receipt_amount = $arraySomething5['amount'];
        
        $receipt_payment_type_id = $arraySomething5['payment_type_id'];
        $receipt_entered_date = $arraySomething5['entered_date'];
        
        
        $total_receipt_amount = $total_receipt_amount + $receipt_amount;

        
        }
        
        $toatl_due = $invoice_amount - $total_receipt_amount;

$sql1 = "SELECT name,phone,address,email,description,br_no,cheques_payable FROM company WHERE id='$company'";
    $result1 = mysqli_query($con, $sql1);
        while ($arraySomething1 = mysqli_fetch_array($result1)) {
        $companyname = $arraySomething1['name'];
        $companyaddress = $arraySomething1['address'];
        $companyemail = $arraySomething1['email'];
        $companyphone = $arraySomething1['phone'];
        $companydescription = $arraySomething1['description'];
        $companybrno = $arraySomething1['br_no'];
        $cheques_payable = $arraySomething1['cheques_payable'];
        }



        $sql = "SELECT id,type_customer,company_name,company_phone,salutation,person,person_mobile,company_address FROM company_customer WHERE id='$customer_id'";
                            $result = mysqli_query($con, $sql);
                                while ($arraySomething1 = mysqli_fetch_array($result)) {
                                    $id = $arraySomething1['id'];
                                    $salutation = $arraySomething1['salutation'];
                                    $type = $arraySomething1['type_customer'];
                                    $company_name = $arraySomething1['company_name'];
                                    $company_phone = $arraySomething1['company_phone'];
                                    $name = $arraySomething1['person'];
                                    $mobile = $arraySomething1['person_mobile'];
                                    $company_address = $arraySomething1['company_address'];


                                    if($type==2){
                                            $customer_name = $company_name;
                                            $customer_phone = $company_phone;
                                            $salutation = "";
                                    }else{
                                            $customer_name = $name;
                                            $customer_phone = $mobile;
                                    } 
                                }
        
        
        
?>


<div class="row">    
 <div class="col-xs-12">
                   <center>             
                                        <table id="example3" class="table-condensed">
                                     <?php
                                    
                                       echo "<tr><th><center>".$companyname."</center></th></tr>";
                                       echo "<tr><td><center>".$companydescription."</center></td></tr>";
                                      echo "<tr><td><center>Address : ".$companyaddress." | Email : ".$companyemail."</center></td></tr>";
                                      echo "<tr><td><center>Contact : ".$companyphone." | Reg : ".$companybrno."1</center></td></tr>";
                                    ?>
         </center>         </table></div>
<u><
</div>
 <button onclick='window.print()' class='btn btn-primary noprint'>Print Report</button>
<?php
if($receipt_payment_type=="CASH")
    $receipt_name = "CASH RECEIPT";
else
    $receipt_name = "CHEQUE RECEIVED NOTE";

?>

<h4 class="box-title"><center><?PHP echo $receipt_name; ?></center></h4></u>

<div class="row">
    
            <div class="col-xs-8">
                                
                                        <table id="example3" class="table table-bordered table-condensed">
                                     <?php
                                    
                                      echo "<tr><td width='15%'>Customer</td><td align='right'>".$salutation." ".$customer_name."</td></tr>";
                                    
                                     echo "<tr><td>Address</td><td align='right'>".$company_address."</td></tr>";
                                    
//                                    echo "<tr><td>Insurance :</td><td align='right'>".strtoupper($insurance_name)."</td></tr>";
                                     
                                     
                                    ?>
           </table></div>
    
            <div class="col-xs-4">                                 
                                 
                                        <table class="table table-bordered table-condensed">
                                     <?php
                                     echo "<tr><td>Receipt No</td><td align='right'>".$receipt_no."</td></tr>";
                                    echo "<tr><td>Invoice No</td><td align='right'>".$invoice_real_no."</td></tr>";
                                     
//                                     echo "<tr><td>Receipt :</td><td align='right'>".$todaynow."</td></tr>";
                                     
                                    ?>
            </table></div>
</div>
                <div class='row'>
                           <div class='col-md-12'>
                               
                                       <div class="box-tools pull-right">
                                       </div>
                                       
                                    <!-- /.box-header -->
                                        <br><br><br><br><br>
                                        <table id="example3" class="table table-bordered table-condensed">
                                            <thead>

                                                
                                                <?php
                                              
                                                if($receipt_payment_type == 'CASH'){
                                                    
                                                    echo "<tr><th><center> RECEIPT DATE </center></th><th><center> PAY TYPE </center></th><th><center> AMOUNT </center></th>
                                                    </tr></tfoot></thead><tbody>";
                                               
                                                    
                                                    echo "<tr><td><center>".$receipt_date."</center></td><td><center>CASH</center></td><td> <center> ".number_format($receipt_amount,2)." </center> </td> </td>";
                                                    
                                                    
                                                    
                                               
                                                    echo "</tbody>  <tfoot></tfoot>";  
                                                    
                                                }
                                                
//                                            
                                                
                                                if($receipt_payment_type == 'CHEQUE'){
                                                   
                                                    
                                                    echo "<tr><th><center> RECEIPT DATE </center></th><th><center> PAY TYPE </center></th><th><center>DATE </center></th><th><center> BANK </center></th><th><center> AMOUNT </center></th>
                                                    </tr></tfoot></thead><tbody>";
                                             
                                                    
                                                $sql18 = "SELECT bank,cheque_no,DATE(cheque_date) AS cheque_date FROM cheque WHERE id='$payment_type_id'";
                                                $result18 = mysqli_query($con, $sql18);
                                                    while ($arraySomething18 = mysqli_fetch_array($result18)) {
                                                    $cheque_bank_id = $arraySomething18['bank'];
                                                    $cheque_no = $arraySomething18['cheque_no'];
                                                    $receipt_cheque_date = $arraySomething18['cheque_date'];
                                                    }
                                                    
                                                $sql11 = "SELECT name FROM banks WHERE id='$cheque_bank_id ' AND stat='1'";
                                                $result11 = mysqli_query($con, $sql11);
                                                    while ($arraySomething11 = mysqli_fetch_array($result11)) {
                                                    $last_receipt_bank = $arraySomething11['name'];
                                                    }
                                                    
                                                   $last_receipt_bank = strtoupper($last_receipt_bank);
                                                    echo "<tr><td><center>".$receipt_date."</center></td><td><center>CHEQUE : ".$cheque_no."</center></td><td><center>".$receipt_cheque_date."</center></td><td><center>".$last_receipt_bank."</center></td><td> <center> ".number_format($receipt_amount1,2)." </center> </td> </td>";
                                                    
                                                    }
                                               
                                                    echo "</tbody>  <tfoot></tfoot>";  
                                                    
                                                
                                               
                                                                        echo "</tbody>  <tfoot></tfoot>";        
                                                    
                                                                        ?>
                                                 </table>
                                   
                                    </div>
                               </div> 


                    <div class="row">
                        
                     
                      
                        <div class='col-xs-7'>
                            <br><br><br><br><br>
                            <table id="example3" class="table-condensed">
                                      
                                                <?php
                                                
                                                
                                                echo "<tr><td align='left' colspan='4'>**Note : All Cheques are subjects to Realisation. </td></tr>";
                                                
                                                echo "<tr><td colspan='4'></td></tr>";
                                                 echo "<tr><td colspan='4'></td></tr>";
                                                 echo "<tr><td colspan='4'></td></tr>";
                                                 echo "<tr><td colspan='4'></td></tr>";
                                                 echo "<tr><td colspan='4'></td></tr>";
                                                 echo "<tr><td colspan='2' align='center'></td><td colspan='2' align='center'></td></tr>";
                                                 echo "<tr><td colspan='2' align='center'></td><td colspan='2' align='center'></td></tr>";
                                                 echo "<tr><td colspan='2' align='center'></td><td colspan='2' align='center'></td></tr>";
                                                 echo "<tr><td colspan='2' align='center'></td><td colspan='2' align='center'></td></tr>";
                                                 echo "<tr><td colspan='2' align='center'></td><td colspan='2' align='center'></td></tr>";
                                                 echo "<tr><td colspan='2' align='center'></td><td colspan='2' align='center'></td></tr>";
                                                 echo "<tr><td colspan='2' align='center'>.........................................</td><td colspan='2' align='center'>.........................................</td></tr>";
                                                 echo "<tr><td colspan='2' align='center'></td><td colspan='2' align='center'></td></tr>";
                                                echo "<tr><td colspan='2' align='center'>CASHIER</td><td colspan='2' align='center'>CUSTOMER</td></tr>";

                                               ?>
                                           </table>     
                            
                            
                            
                        </div>
                                             <div class='col-xs-5'>
                                                 <br><br><br><br><br>   
                                            <?php
                                             echo "<table id='example9' class='table table-condensed' >";

                                             echo "<tr><td>Payments as :</td><td align='right'>". $today . "</td></tr>";
                                             echo "<tr><td><b>Net Invoice Total :</b> </td><td align='right'><b>". number_format($invoice_amount,2) . "</b></td></tr>";
                                             echo "<tr><td>Total Paid : </td><td align='right'>". number_format($total_receipt_amount,2) . "</td></tr>"     ;
                                             echo "<tr><td><b>**Total Due :</b> </td><td align='right'><b>". number_format($toatl_due,2) . "</b></td></tr> </table>"     ;
                                            ?>
                                                   
                                                 
                                                  
                                           </div>
                                   
                                           
                                   
                                  
                                     </div>            
                                    
               

                  

                   
                <br><br><br><br>
               
                         <br>
                    
                        
              <?php                                        
                                                      
                                                      
                                                      
               

         }
        
    }
    ?>