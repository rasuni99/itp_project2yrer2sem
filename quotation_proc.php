
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
include 'connection.php';
include 'header.php';
// $user = $_SESSION['sess_user_id'];
// $company = $_SESSION['sess_company'];
//$quotation_code = $_SESSION['code_quotation'];
//$sale_code = $_SESSION['code_sale'];
$today = date('Y-m-d'); 
$todaynow = date("Y-m-d h:i:sA");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
 if(isset($_POST["item_name"][0])){
     $customer = STRTOUPPER($_POST['customer']);
     $address = STRTOUPPER($_POST['address']);
     $vat = $_POST['sale_type'];
     $type = $vat;
     $quotedate = $_POST['quotedate'];
     $expiredate = $_POST['expiredate'];
     $pono = "";
     
     if(isset($_POST['pono']))
     $pono = $_POST['pono'];
     
     $price_low = "NO";
     $price_low_item =  "";
     
     $sql = "SELECT low_min_sale_price FROM company_customer WHERE id='$customer'";
                            $result = mysqli_query($con, $sql);
                                while ($arraySomething1 = mysqli_fetch_array($result)) {
                                    $low_min_sale_price = $arraySomething1['low_min_sale_price'];
                                }
                                
     
     
     for($count = 0; $count < count($_POST["item_name"]); $count++)
       {  
                            $item = $_POST["item_name"][$count];
                            $item_charge = $_POST["unit_price"][$count];
                           // $serial = $_POST["serial"][$count];
                            $description = $_POST["description"][$count];
                            $quantity = $_POST["quantity"][$count];
                           
                            //take aitem name 
                            
                                   $cat4 = $cat4_name="";
                                   $cat3 = $cat3_name="";
                             $sql78 = "SELECT id,cat1,cat2,cat3,cat4 FROM item WHERE id = '$item'";
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
                           
                           
                        //ITEM COUNT DEDUCTION FROM STOCK TABLE - START
                            $sql25 = "SELECT stock_shop,min_sale_price FROM item WHERE id = '$item'";
                               $result25 = mysqli_query($con, $sql25);
                                   while ($arraySomething25 = mysqli_fetch_array($result25)) {
                                      // $stock_shop = $arraySomething25['stock_shop']; 
                                       $min_sale_price = $arraySomething25['min_sale_price']; 
                                   }

                           if($item_charge<$min_sale_price){
                               $price_low = "YES";
                               $price_low_item = "UNIT PRICE IS BELOW THE MINIMUM SELLING PRICE : ".$item_name."[ MSP : ". number_format($min_sale_price,2)." ] ";
                               
                               
                           }
        }                    
     
//        if($avaiability=="YES"){
     
            if($price_low=="NO"){
     
         // $net_amount = $item_total = 0;  
          



 $sql1 = "SELECT name,phone,address,email,description,br_no,cheques_payable,code_quotation,current_quotation FROM company WHERE id='$company'";
    $result1 = mysqli_query($con, $sql1);
        while ($arraySomething1 = mysqli_fetch_array($result1)) {
        $companyname = $arraySomething1['name'];
        $companyaddress = $arraySomething1['address'];
        $companyemail = $arraySomething1['email'];
        $companyphone = $arraySomething1['phone'];
        $companydescription = $arraySomething1['description'];
        $companybrno = $arraySomething1['br_no'];
        $cheques_payable = $arraySomething1['cheques_payable'];
        $code_quotation = $arraySomething1['code_quotation'];
        $current_quotation = $arraySomething1['current_quotation'];
        }

                        
                       
                        $invoicedate = $quotedate;

                        
                        
           //GENERATE INVOICE - START
                        $net_amount = $item_total = 0;    
                        for($counter = 0; $counter < count($_POST["item_name"]); $counter++)
                        {  
                            $item_charge = $_POST["unit_price"][$counter];
                            $quantity = $_POST["quantity"][$counter];
                            $item_total = $item_charge * $quantity;
                            $net_amount = $net_amount + $item_total;
                          
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
                  
                    
                     
                     $current_quotation1 = $current_quotation + 1;
                     $current_quotation2 = $current_quotation1 + 100000;
                     $current_quotation_no = $code_quotation.$current_quotation2 ;

                     $invoice_name = "QUOTATION";

                     
                    
                 
                     
                     $sql = "INSERT INTO invoice_quotation (quotation_no,invoice_amount, type, customer, customer_address, quotation_date, expiry_date, pono,vat_percentage,nbt_percentage,user,company) VALUES"
                            . " ('$current_quotation_no','$net_amount','$vat','$customer','$address','$quotedate','$expiredate','$pono','$vat_percentage','$nbt_percentage', '$user', '$company')";   
                         if(mysqli_query($con, $sql)){
                          
                             $sql1 = "UPDATE company SET current_quotation = '$current_quotation1' WHERE id='$company'";
                             mysqli_query($con, $sql1);
                             

                         }  
//                         else{
//                             echo("Error description: " . mysqli_error($con));
//                         }
            //GENERATE INVOICE - END      
                         
                        
                         
            
       
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
<u>
</div>                   
   </div>

<h4 class="box-title"><center><?php echo $invoice_name; ?></center></h4></u>    

<div class="row">
            <div class="col-xs-8">
                                
                                    <table id="example3" class="table table-bordered table-condensed">
                                    <?php
                                    echo "<tr><td>Customer</td><td align='right'>".$customer."</td></tr>";
                                    echo "<tr><td>Address</td><td align='right'>".$address."</td></tr>";
                                    echo "<tr><td> Your P.O # </td><td align='right'>".$pono."</td></tr>";
                                    ?>
                                    </table></div>
    
            <div class="col-xs-4">                                 
                                 
                                     <table class="table table-bordered table-condensed">
                                     <?php
                                     echo "<tr><td>Quote No </td><td align='right'>".$current_quotation_no."</td></tr>";
                                     echo "<tr><td>Quote Date </td><td align='right'>".$quotedate."</td></tr>";
                                    
                                     echo "<tr><td>Valid Until </td><td align='right'>".$expiredate."</td></tr>";
                                    
                                     ?>
                                     </table></div>
</div>
<?php     
            
                
         
            echo '<table id="example1" class="table table-bordered ">';

                   $net_total = 0; $total_discount  = 0;
                       echo "<tr><th><center> * </center></th><th><center> Item </center></th><th><center>Unit Price</center></th><th><center> Qty </center></th><th><center> Discounted Price</center></th><th><center> Sub Total</center></th>
                                                   </tr></tfoot></thead><tbody>";
                        for($count = 0; $count < count($_POST["item_name"]); $count++)
                        {  
                            $item = $_POST["item_name"][$count];
                            $item_charge = $_POST["unit_price"][$count];
                           
                            $description = $_POST["description"][$count];
                            $quantity = $_POST["quantity"][$count];
                           
                            

                         
                        //RETRIEVE INVOICE ID - START
                            $sql75 = "SELECT id FROM invoice_quotation WHERE quotation_no = '$current_quotation_no'";
                               $result75 = mysqli_query($con, $sql75);
                                   while ($arraySomething75 = mysqli_fetch_array($result75)) {
                                       $quotation_id = $arraySomething75['id'];  
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
                            if($type=="CASH"){
                            $discount_per_item = $cash_price - $item_charge;
                            $price_to_show = $cash_price;
                            }
                            if($type=="CREDIT"){
                            $discount_per_item = $credit_price - $item_charge;
                            $price_to_show = $credit_price;
                            }
                            
                            $item_discount = $discount_per_item * $quantity;
                            $total_discount = $total_discount + $item_discount;
                            // DISCOUNT CAL - END
                          
                            //RETRIEVE ITEM DATA - START
                                   $cat4 = $cat4_name="";
                                   $cat3 = $cat3_name="";
                             $sql78 = "SELECT id,cat1,cat2,cat3,cat4 FROM item WHERE id = '$item'";
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
                           $serial = "";
                            // DATA INSERTIION TO INVOICE_ITEMS TABLE - START
                            $query = "INSERT INTO invoice_items_quotation (item_id,item_name,description,invoice_id,unit_price,discount_per_item,min_sale_price,cash_price,credit_price,quantity,user,company) VALUES "
                                    . "('$item','$item_name','$description','$quotation_id','$item_charge','$discount_per_item','$min_sale_price','$cash_price','$credit_price','$quantity','$user', '$company')";
                            mysqli_query($con, $query);
                         // DATA INSERTIION TO INVOICE_ITEMS TABLE - END
                           
                            //RETRIEVE RENT CHARGE DATA - END
                         $sub_total = $item_charge*$quantity;  
                         $net_total = $net_total + $sub_total;
                         
                         //IF DISCOUNTED PRICE > UNIT PRICE
                         if($price_to_show<=$item_charge){
                           $price_to_show = $item_charge;
                         }
                         
                         
                         echo "<tr bgcolor='#80D8AD'><td width='1%'> </td><td>".$cat1_name." ".$cat2_name." ".$cat3_name." ".$cat4_name." </td><td align='right'>".number_format($price_to_show,2)."</td><td align='right'>".$quantity."</td><td align='right'>".number_format($item_charge,2)."</td><td align='right'>".number_format($sub_total,2)."</td>";

                        }
                        
                        
                            
                          $net_total_final = $net_total;
                  
                            echo "<tr bgcolor='#80D8AD'><td colspan='5' align='right'><b>Gross Total</b></td><td align='right'><b>".number_format($net_total,2)."</b></td>";
                            echo "<tr bgcolor='#80D8AD'><td colspan='5' align='right'><b>Net Total</b></td><td align='right'><b>".number_format($net_total_final,2)."</b></td>";

                    echo "</table>"   ;
                    

         
                                  
  
$sql4 = "SELECT cheques_payable FROM company WHERE id='$company' ";
$result4 = mysqli_query($con, $sql4);
while ($arraySomething4 = mysqli_fetch_array($result4)) {
$cheques_payable = $arraySomething4['cheques_payable'];
}

            ?>
      <?php
      ?>
      <div class="row">
         <div class="col-md-10">  
           <div class='col-md-5'>
                            
                            <table id="example3" class="table-condensed">
                                      
                                                <?php
                                                
                                                
                                                echo "<tr><td align='left' colspan='4'>We are pleased to quote you the above.We will be happy to supply any further information you may need. </td></tr>";
                                                
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
                                                echo "<tr><td colspan='2' align='center'>MANAGER-SALES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td colspan='2' align='center'>CUSTOMER</td></tr>";

                                               ?>
                                           </table>     
                            
                            
                            
                        </div><br>
  
     </div>
      
      
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
        else{
            echo $price_low_item;  
        }


//        }
//        else{
//            echo $not_available_item;  
//        }

     }
     else{
        echo "Error3";  
     }
     
     
     
     }
     else{
    echo "Error1";
   
} 

?>
    