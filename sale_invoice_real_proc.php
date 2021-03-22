<?php
include 'connection.php';
include 'header.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  

     $order_id = $_POST['order'];

      $sql11 = "SELECT customer_id,date FROM invoice WHERE id='$order_id'";
                            $result1 = mysqli_query($con, $sql11);
                                while ($arraySomething1 = mysqli_fetch_array($result1)) {
                                    $customer = $arraySomething1['customer_id'];
                                    $invoicedate = $arraySomething1['date'];
                                }
     
         
                        
?>

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
  <style>
        
        tr td{
  padding: 2px !important;
  margin: 2px !important;
}
        
        
    </style>
</head>
<body>
    
<?php
//include 'connection.php';
//include 'header.php';
// $user = $_SESSION['sess_user_id'];
// $company = $_SESSION['sess_company'];
// $code_invoice = $_SESSION['code_invoice'];
// $sale_code = $_SESSION['code_sale'];
$today = date('Y-m-d'); 
$todaynow = date("Y-m-d h:i:sA");

 $sql1 = "SELECT name,phone,address,email,description,br_no,vat_no,cheques_payable FROM company WHERE id='$company'";
    $result1 = mysqli_query($con, $sql1);
        while ($arraySomething1 = mysqli_fetch_array($result1)) {
        $companyname = $arraySomething1['name'];
        $companyaddress = $arraySomething1['address'];
        $companyemail = $arraySomething1['email'];
        $companyphone = $arraySomething1['phone'];
        $companydescription = $arraySomething1['description'];
        $companybrno = $arraySomething1['br_no'];
        $companyvatno = $arraySomething1['vat_no'];
        $cheques_payable = $arraySomething1['cheques_payable'];
        }

                        $normal_return = $damage_return = 0;
                        $vat = $_POST['vat'];
                      //  $invoicedate = $_POST['date'];
                        if($_POST['normal_return'])
                        $normal_return = $_POST['normal_return'];
                        if($_POST['damage_return'])
                        $damage_return = $_POST['damage_return'];
                     
                        
                        //RETRIVE RETURN DATA - START
                        
                       $return_amount = $normal_return_amount = $damage_return_amount = 0;
                        
                        if($normal_return>0){
                        $sql71 = mysqli_query($con,"SELECT net_amount FROM invoice_return WHERE id='$normal_return'");
                            while ($row7 = mysqli_fetch_array($sql71)) {
                            
                            $normal_return_amount = $row7['net_amount'] ; 
                            }
                        }
                        if($damage_return>0){
                        $sql71 = mysqli_query($con,"SELECT net_amount FROM invoice_return WHERE id='$damage_return'");
                            while ($row7 = mysqli_fetch_array($sql71)) {
                            
                            $damage_return_amount = $row7['net_amount'] ; 
                            }
                        }
                        $return_amount = $normal_return_amount + $damage_return_amount;
                        //RETRIVE RETURN DATA - END
                        
                        
                        $sql = "SELECT id,type_customer,company_name,company_phone,salutation,person,person_mobile,vat_no,company_address FROM company_customer WHERE id='$customer'";
                            $result = mysqli_query($con, $sql);
                                while ($arraySomething1 = mysqli_fetch_array($result)) {
                                    $id = $arraySomething1['id'];
                                    $salutation = $arraySomething1['salutation'];
                                    $type = $arraySomething1['type_customer'];
                                    $company_name = $arraySomething1['company_name'];
                                    $company_phone = $arraySomething1['company_phone'];
                                    $name = $arraySomething1['person'];
                                    $mobile = $arraySomething1['person_mobile'];
                                    $vat_no = $arraySomething1['vat_no'];
                                    $customer_address = $arraySomething1['company_address'];

                                    if($type==2){
                                            $customer_name = $company_name;
                                            $customer_phone = $company_phone;
                                            $salutation = "";
                                    }else{
                                            $customer_name = $name;
                                            $customer_phone = $mobile;
                                    } 
                                }
                        
                        
           //GENERATE INVOICE - START
//                        $net_amount = $item_total = 0;    

                                                $net_amount = 0 ; 
                                                $sql = "SELECT quantity,unit_price FROM invoice_items WHERE invoice_id='$order_id'";
                                                $result = mysqli_query($con, $sql);
                                                    while ($arraySomething1 = mysqli_fetch_array($result)) {
                                                        $quantity = $arraySomething1['quantity'];
                                                        $unit_price = $arraySomething1['unit_price'];
                                                        
                                                        $sub_total = $unit_price * $quantity;
                                                        $net_amount = $net_amount + $sub_total;  
                                                    }
                    
                         // RETRIEVE VAT PERCENTAGES - START
                            $sql741 = "SELECT id,nbt,vat FROM tax_percentages WHERE stat = '1'";
                              $result741 = mysqli_query($con, $sql741);
                               while ($arraySomething741 = mysqli_fetch_array($result741)) {
                               $tax_percentage_id = $arraySomething741['id'];
                               $nbt_percentage = $arraySomething741['nbt'];
                               $vat_percentage = $arraySomething741['vat'];
                               }
                            
                // RETRIEVE VAT PERCENTAGES - END
                  
                    
                     $sql4 = "SELECT current_invoice_real FROM company WHERE id='$company' ";
                        $result4 = mysqli_query($con, $sql4);
                        while ($arraySomething4 = mysqli_fetch_array($result4)) {
                        $current_invoice = $arraySomething4['current_invoice_real'];
                        }
                     $current_invoice1 = $current_invoice + 1;
                     $current_invoice2 = $current_invoice1 + 100000;
                     $current_invoice_no = $code_invoice_real.$current_invoice2 ;
                     $type = $_POST['sale_type'];
                     
                     if($type=="CREDIT-SALE")
                     $invoice_name = "CREDIT INVOICE";
                     if($type=="CASH-SALE")
                     $invoice_name = "CASH INVOICE";
                     
                    
                     $net_amount1 = $net_amount - $return_amount;
                     
                     $sql = "INSERT INTO invoice_real (invoice_real_no,order_id,invoice_amount,net_amount,return_amount,normal_return_id,damage_return_id,type,customer_id,invoice_type,tax_percentage_id,date,user,company) VALUES"
                            . " ('$current_invoice_no','$order_id','$net_amount','$net_amount1','$return_amount','$normal_return','$damage_return','$type','$customer','$vat','$tax_percentage_id','$invoicedate', '$user', '$company')";   
                         if(mysqli_query($con, $sql)){
                          
                             $sql1 = "UPDATE company SET current_invoice_real = '$current_invoice1' WHERE id='$company'";
                             mysqli_query($con, $sql1);
                             
                             if($order_id>0){
                             $sql8 = "UPDATE invoice SET convert_to_invoice = '1' WHERE id='$order_id'";
                             mysqli_query($con, $sql8);
                             }
                             
                             if($normal_return>0){
                             $sql8 = "UPDATE invoice_return SET used = '1' WHERE id='$normal_return'";
                             mysqli_query($con, $sql8);
                             }
                             if($damage_return>0){
                             $sql8 = "UPDATE invoice_return SET used = '1' WHERE id='$damage_return'";
                             mysqli_query($con, $sql8);
                             }
                         } 
//                         else{
//                             echo("Error description: " . mysqli_error($con));
//                         }
            //GENERATE INVOICE - END      
                         $vat_reg_no = "";
                         if($vat=="VAT"){
                             $invoice_name="TAX INVOICE";
                             $vat_reg_no = " | VAT Reg # : ".$companyvatno;
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
                                      echo "<tr><td><center>Contact : ".$companyphone." | BR Reg # : ".$companybrno.$vat_reg_no."</center></td></tr>";
                                    ?>
         </center>         </table></div>
<u>
</div>                   
   </div>

<h4 class="box-title"><center><?php echo $invoice_name; ?></center></h4></u>    

<div class="row">
            <div class="col-xs-7">
                                
                                    <table id="example3" class="table table-bordered table-condensed">
                                    <?php
                                    echo "<tr><td>Customer</td><td align='right'>".$salutation." ".$customer_name."</td></tr>";
                                    echo "<tr><td>Contact</td><td align='right'>".$customer_phone."</td></tr>";
                                    echo "<tr><td>Address</td><td align='right'>".$customer_address."</td></tr>";
                                    ?>
                                    </table></div>
    
            <div class="col-xs-5">                                 
                                 
                                     <table class="table table-bordered table-condensed">
                                     <?php
                                     echo "<tr><td>Invoice No</td><td align='right'>".$current_invoice_no."</td></tr>";
                                     echo "<tr><td>Date</td><td align='right'>".$invoicedate."</td></tr>";
                                     if($vat=="NON_VAT")
                                     echo "<tr><td>Sales Type </td><td align='right'>".$type."</td></tr>";
                                     if($vat=="VAT")
                                     echo "<tr><td>Customer VAT # </td><td align='right'>".$vat_no."</td></tr>";
                                     ?>
                                     </table></div>
</div>
<?php     
            
                
         
            echo '<table id="example1" class="table table-bordered ">';

                   $net_total = 0; $total_discount = 0; $vat_amount_total = $nbt_amount_total = 0;
                       echo "<tr><th><center> Item </center></th><th><center> Description</center></th><th><center> Qty </center></th><th><center> Unit Price</center></th><th><center> Sub Total</center></th>
                                                   </tr></tfoot></thead><tbody>";
                        $total = 0 ; 
                        $sql = "SELECT item_id,item_name,serial,description,quantity,unit_price FROM invoice_items WHERE invoice_id='$order_id'";
                        $result = mysqli_query($con, $sql);
                            while ($arraySomething1 = mysqli_fetch_array($result)) {
                                $item = $arraySomething1['item_id'];
                                $item_name = $arraySomething1['item_name'];
                                $serial = $arraySomething1['serial'];
                                $description = $arraySomething1['description'];
                                $quantity = $arraySomething1['quantity'];
                                $item_charge = $arraySomething1['unit_price'];

                            
                        //ITEM COUNT DEDUCTION FROM STOCK TABLE - START
                            $sql25 = "SELECT stock_shop FROM item WHERE id = '$item'";
                               $result25 = mysqli_query($con, $sql25);
                                   while ($arraySomething25 = mysqli_fetch_array($result25)) {
                                       $stock_shop = $arraySomething25['stock_shop'];  
                                   }
                            $new_stock_shop = $stock_shop - $quantity;
                             
                        $sql18 = "UPDATE item SET stock_shop = '$new_stock_shop' WHERE id='$item'";
                        mysqli_query($con, $sql18);   
                        //ITEM COUNT DEDUCTION FROM STOCK TABLE - END
                         
                        //RETRIEVE INVOICE ID - START
                            $sql75 = "SELECT id FROM invoice_real WHERE invoice_real_no = '$current_invoice_no'";
                               $result75 = mysqli_query($con, $sql75);
                                   while ($arraySomething75 = mysqli_fetch_array($result75)) {
                                       $invoice_id = $arraySomething75['id'];  
                                   }
                        //RETRIEVE INVOICE ID - END     
                        
                        //DATA INSERTION TO CASH_BOOK - START  
                              
                                 
                          $sql74 = "SELECT min_sale_price,cash_price,credit_price FROM item WHERE id = '$item'";
                               $result74 = mysqli_query($con, $sql74);
                                   while ($arraySomething74 = mysqli_fetch_array($result74)) {
                                       $min_sale_price = $arraySomething74['min_sale_price'];
                                       $cash_price = $arraySomething74['cash_price'];  
                                       $credit_price = $arraySomething74['credit_price'];  
                                   }         
                        
                            // DISCOUNT CAL - START
                            if($type=="CASH-SALE"){
                            $discount_per_item = $cash_price - $item_charge;
                            $price_to_show = $cash_price;
                            }
                            if($type=="CREDIT-SALE"){
                            $discount_per_item = $credit_price - $item_charge;
                            $price_to_show = $credit_price;
                            }
                            
                            $item_discount = $discount_per_item * $quantity;
                            $total_discount = $total_discount + $item_discount;
                            // DISCOUNT CAL - END
                            
      
                            // DATA INSERTIION TO INVOICE_ITEMS TABLE - START
                            $query = "INSERT INTO invoice_items_real (item_id,customer_id,item_name,serial,description,invoice_id,unit_price,discount_per_item,min_sale_price,cash_price,credit_price,quantity,user,company) VALUES "
                                    . "('$item','$customer','$item_name','$serial','$description','$invoice_id','$item_charge','$discount_per_item','$min_sale_price','$cash_price','$credit_price','$quantity','$user', '$company')";
                            mysqli_query($con, $query);
                         // DATA INSERTIION TO INVOICE_ITEMS TABLE - END

                        //RETRIEVE RENT CHARGE DATA - END
                         $sub_total = $item_charge*$quantity;  
                         $net_total = $net_total + $sub_total;
                         
                         //IF DISCOUNTED PRICE > UNIT PRICE
                         if($price_to_show<=$item_charge){
                           $price_to_show = $item_charge;
                         }
                         
                         echo "<tr bgcolor='#80D8AD'><td>".$item_name." </td><td align='right'>".$description."</td><td align='right'>".$quantity."</td><td align='right'>".number_format($item_charge,2)."</td><td align='right'>".number_format($sub_total,2)."</td>";

                        }
                        
                        
                            
                          $net_total_final = $net_total - $return_amount;
                          
                          
                        //VAT NBT CALCULATE - START
                            if($vat=="VAT"){
                                
                                $amount_with_nbt = (100 / (100+$vat_percentage)) * $net_total_final;
                                $net = ($amount_with_nbt / (100+$nbt_percentage)) * 100;
                                $nbt_per_item = ($net / 100) * $nbt_percentage;
                                $vat_per_item = ($amount_with_nbt / 100) * $vat_percentage;
                                
//                                $nbt_for_all_items = $nbt_per_item * $quantity;
//                                $nbt_amount_total = $nbt_amount_total + $nbt_for_all_items;
                                
                                $final_total = $net_total_final - ($nbt_per_item+$vat_per_item);
                                
                            }
                            
                           //VAT NBT CALCULATE - END 
                            
                            if($vat=="NON_VAT"){
                            echo "<tr bgcolor='#80D8AD'><td colspan='4' align='right'><b>Gross Total</b></td><td align='right'><b>".number_format($net_total,2)."</b></td>";
                            echo "<tr bgcolor='#80D8AD'><td colspan='4' align='right'><b>Returned Total</b></td><td align='right'><b>-".number_format($return_amount,2)."</b></td>";
                            echo "<tr bgcolor='#80D8AD'><td colspan='4' align='right'><b>Net Total</b></td><td align='right'><b>".number_format($net_total_final,2)."</b></td>";
                            }
                            if($vat=="VAT"){
                            echo "<tr bgcolor='#80D8AD'><td colspan='4' align='right'><b>Total</b></td><td align='right'><b>".number_format($net_total,2)."</b></td>";
                            echo "<tr bgcolor='#80D8AD'><td colspan='4' align='right'><b>Returned Amount</b></td><td align='right'><b>-".number_format($return_amount,2)."</b></td>";
                           echo "<tr bgcolor='#80D8AD'><td colspan='4' align='right'> </td><td align='right'><b> </b></td>"; 
						   echo "<tr bgcolor='#80D8AD'><td colspan='4' align='right'><b>Net Total</b></td><td align='right'><b>".number_format($final_total,2)."</b></td>";    
                            echo "<tr bgcolor='#80D8AD'><td colspan='4' align='right'><b>NBT ".$nbt_percentage."%</b></td><td align='right'><b>".number_format($nbt_per_item,2)."</b></td>";
                            echo "<tr bgcolor='#80D8AD'><td colspan='4' align='right'><b>VAT ".$vat_percentage."%</b></td><td align='right'><b>".number_format($vat_per_item,2)."</b></td>";
                             echo "<tr bgcolor='#80D8AD'><td colspan='4' align='right'><b>Grand Total</b></td><td align='right'><b>".number_format($net_total_final,2)."</b></td>";    
                                
                                
                            }
                           
                    echo "</table>"   ;

         
                                  
  
$sql4 = "SELECT cheques_payable FROM company WHERE id='$company' ";
$result4 = mysqli_query($con, $sql4);
while ($arraySomething4 = mysqli_fetch_array($result4)) {
$cheques_payable = $arraySomething4['cheques_payable'];
}

            ?>
      <div class='col-md-12'>
                            
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
                                                 echo "<tr><td colspan='2' align='center'>................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td colspan='2' align='center'>................................</td></tr>";
                                                 echo "<tr><td colspan='2' align='center'></td><td colspan='2' align='center'></td></tr>";
                                                echo "<tr><td colspan='2' align='center'>CASHIER&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td colspan='2' align='center'>CUSTOMER</td></tr>";

                                               ?>
                                           </table>     
                            
                            
                            
                        </div><br>
  <center>THANK YOU FOR YOUR BUSINESS !</center><br>
                                    
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

<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>

<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script src="dist/js/demo.js"></script>
</body>
</html>    
<?php 
 }
       


?>
    