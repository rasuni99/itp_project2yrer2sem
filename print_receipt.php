<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
 
  <title></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();history.go(-1); "><head>
    
    <style>
        
        tr td{
  padding: 2px !important;
  margin: 2px !important;
}
        
        
    </style>
    
    
</head>




<?php
include 'connection.php';
include 'header.php';
// $user = $_SESSION['sess_user_id']; 
// $company = $_SESSION['sess_company'];


$todaynow = date("Y-m-d h:i:sA");
$today = date("Y-m-d");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

$receipt_id = $_GET['id'];
//$receipt_id = 3;
}

// RETRIEVE RECEIPT DATA - START
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

<?php
if($receipt_payment_type=="CASH")
    $receipt_name = "CASH RECEIPT";
else
    $receipt_name = "CHEQUE RECEIVED NOTE";

?>

<h4 class="box-title"><center><?PHP echo $receipt_name; ?></center></h4></u>

<div class="row">
            <div class="col-xs-6">
                                
                                        <table id="example3" class="table table-bordered table-condensed">
                                     <?php
                                    
                                      echo "<tr><td>Customer : </td><td align='right'>".$salutation." ".$customer_name."</td></tr>";
                                     echo "<tr><td>Contact :</td><td align='right'>".$customer_phone."</td></tr>";
                                     echo "<tr><td>Address :</td><td align='right'>".$company_address."</td></tr>";
                                     
//                                    echo "<tr><td>Insurance :</td><td align='right'>".strtoupper($insurance_name)."</td></tr>";
                                     
                                     
                                    ?>
           </table></div>
    
            <div class="col-xs-6">                                 
                                 
                                        <table class="table table-bordered table-condensed">
                                     <?php
                                     echo "<tr><td>Receipt No : </td><td align='right'>".$receipt_no."</td></tr>";
                                    echo "<tr><td>Invoice No :</td><td align='right'>".$invoice_real_no."</td></tr>";
                                     echo "<tr><td>Generated On :</td><td align='right'>".$todaynow."</td></tr>";
//                                     echo "<tr><td>Generated :</td><td align='right'>".$todaynow."</td></tr>";
                                     
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
                                                
//                                                $sql17 = "SELECT amount FROM cash_book WHERE id='$receipt_id'";
//                                                $result17 = mysqli_query($con, $sql17);
//                                                    while ($arraySomething17 = mysqli_fetch_array($result17)) {
//                                                    $last_receipt_amount = $arraySomething17['amount'];
                                                    
                                                    
                                                    echo "<tr><td><center>".$receipt_date."</center></td><td><center>CASH</center></td><td> <center> ".number_format($receipt_amount1,2)." </center> </td> </td>";
                                                    
                                                    
                                                    
                                               
                                                    echo "</tbody>  <tfoot></tfoot>";  
                                                    
                                                }
                                                
//                                            
                                                
                                                if($receipt_payment_type == 'CHEQUE'){
                                                   
                                                    
                                                    echo "<tr><th><center> RECEIPT DATE </center></th><th><center> PAY TYPE </center></th><th><center>DATE </center></th><th><center> BANK </center></th><th><center> AMOUNT </center></th>
                                                    </tr></tfoot></thead><tbody>";
                                                
//                                                $sql17 = "SELECT amount,payment_type_id FROM cash_book WHERE id='$receipt_id' AND stat='1'";
//                                                $result17 = mysqli_query($con, $sql17);
//                                                    while ($arraySomething17 = mysqli_fetch_array($result17)) {
//                                                    $last_receipt_amount = $arraySomething17['amount'];
//                                                    $last_receipt_payment_type_id = $arraySomething17['payment_type_id'];
                                                    
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
                        
                        <?php
//                        if($pay_by_insurance == 1){
//                            $net_repair = $net_total_approved_repair;
//                            $net_part = $net_total_approved;
//                        }
//                        else{
//                            $net_repair = $net_total_charge_repair;
//                            $net_part = $net_total_charge;
//                            
//                        }
                        
//                        $sql12 = "SELECT net_amount FROM invoice WHERE job_no='$jobid' AND stat='1'";
//                        $result12 = mysqli_query($con, $sql12);
//                            while ($arraySomething12 = mysqli_fetch_array($result12)) {
//                            $invoice_net_amount = $arraySomething12['net_amount'];
//                        }
                        
                        ?>
                        
                        <div class='col-xs-8'>
                            <br><br><br><br><br>
                            <table id="example3" class="table-condensed">
                                      
                                                <?php
                                                
                                                
                                                echo "<tr><td align='left' colspan='4'>Note : All Cheques are subjects to Realisation. </td></tr>";
                                                
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
                                             <div class='col-xs-4'>
                                                 <br><br><br><br><br>   
                                            <?php
                                             echo "<table id='example9' class='table table-condensed' >";

                                             echo "<tr><td>Payments as :</td><td align='right'>". $today . "</td></tr>";
                                             echo "<tr><td><b>Net Invoice Total :</b> </td><td align='right'><b>". number_format($invoice_amount,2) . "</b></td></tr>";
                                             echo "<tr><td>Total Paid : </td><td align='right'>". number_format($total_receipt_amount,2) . "</td></tr>"     ;
                                             echo "<tr><td><b>Total Due :</b> </td><td align='right'><b>". number_format($toatl_due,2) . "</b></td></tr> </table>"     ;
                                            ?>
                                                   
                                                 
                                                  
                                           </div>
                                   
                                           
                                   
                                  
                                     </div>            
                                    
               

                  

                   
                <br><br><br><br>
                 <footer style='font-size: 14px;'><center>THANK YOU FOR YOUR BUSINESS !</center><footer>
                         <br>
                    
                        
                                    
                                    <script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>