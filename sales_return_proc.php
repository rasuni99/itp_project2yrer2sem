<?php
include 'connection.php';
include 'header.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
 if(isset($_POST["item_name"][0])){
     
     
          $net_amount = $item_total = 0;  
          $dataresult = "DONE";
                        for($counter = 0; $counter < count($_POST["item_name"]); $counter++)
                        {  
                            $item = $_POST["item_name"][$counter];
                            $item_charge = $_POST["unit_price"][$counter];
                            $quantity = $_POST["quantity"][$counter];
                            $item_total = $item_charge * $quantity;
                            $net_amount = $net_amount + $item_total;
                            
                             $sql78 = "SELECT cat1 FROM item WHERE id = '$item'";
                               $result78 = mysqli_query($con, $sql78);
                                   while ($arraySomething78 = mysqli_fetch_array($result78)) {
                                       $cat1 = $arraySomething78['cat1'];
                                   }
                              if($cat1==1 && $quantity>1) 
                                  $dataresult = "DONE";
                        }
                        
    
         if($dataresult == "DONE"){
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
// $code_returns = $_SESSION['code_returns'];
//$sale_code = $_SESSION['code_sale'];
$today = date('Y-m-d'); 
$todaynow = date("Y-m-d h:i:sA");

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

                        $customer = $_POST['customer'];
                        $returndate = $_POST['date'];
                     //   $returndate = date('Y-m-d', strtotime(str_replace('-', '/', $returndate)));
                        
                        $sql = "SELECT id,type_customer,company_name,company_phone,salutation,person,person_mobile FROM company_customer WHERE id='$customer'";
                            $result = mysqli_query($con, $sql);
                                while ($arraySomething1 = mysqli_fetch_array($result)) {
                                    $id = $arraySomething1['id'];
                                    $salutation = $arraySomething1['salutation'];
                                    $type = $arraySomething1['type_customer'];
                                    $company_name = $arraySomething1['company_name'];
                                    $company_phone = $arraySomething1['company_phone'];
                                    $name = $arraySomething1['person'];
                                    $mobile = $arraySomething1['person_mobile'];


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
                        $net_amount = $item_total = 0;    
                        for($counter = 0; $counter < count($_POST["item_name"]); $counter++)
                        {  
                            $item_charge = $_POST["unit_price"][$counter];
                            $quantity = $_POST["quantity"][$counter];
                            $item_total = $item_charge * $quantity;
                            $net_amount = $net_amount + $item_total;
                          
                        }
                    
                  
                    
                     $sql4 = "SELECT current_return FROM company WHERE id='$company' ";
                        $result4 = mysqli_query($con, $sql4);
                        while ($arraySomething4 = mysqli_fetch_array($result4)) {
                        $current_return = $arraySomething4['current_return'];
                        }
                     $current_return1 = $current_return + 1;
                     $current_return2 = $current_return1 + 100000;
                     $current_return_no = $code_returns.$current_return2 ;
                     $type = $_POST['sale_type'];
                     $invoice_name = $type." NOTE";
                     
                    
                     $sql = "INSERT INTO invoice_return (return_number,net_amount,type,customer_id,date,user,company) VALUES"
                            . " ('$current_return_no','$net_amount','$type', '$customer','$returndate', '$user', '$company')";   
                     if(mysqli_query($con, $sql))
                             {
                          
                             $sql1 = "UPDATE company SET current_return = '$current_return1' WHERE id='$company'";
                             mysqli_query($con, $sql1);
                         }  
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
            <div class="col-xs-6">
                                
                                    <table id="example3" class="table table-bordered table-condensed">
                                    <?php
                                    echo "<tr><td>Customer : </td><td align='right'>".$salutation." ".$customer_name."</td></tr>";
                                    echo "<tr><td>Contact :</td><td align='right'>".$customer_phone."</td></tr>";
                                    ?>
                                    </table></div>
    
            <div class="col-xs-6">                                 
                                 
                                     <table class="table table-bordered table-condensed">
                                     <?php
                                     echo "<tr><td>Return Note No :</td><td align='right'>".$current_return_no."</td></tr>";
                                     echo "<tr><td>Date </td><td align='right'>".$returndate."</td></tr>";
                                     ?>
                                     </table></div>
</div>
<?php     

   
         
            echo '<table id="example1" class="table table-bordered ">';

                   $net_total = 0;
                       echo "<tr><th><center> Item </center></th><th><center> Serial </center></th><th><center> Description</center></th><th><center> Qty </center></th><th><center> Unit Price</center></th><th><center> Sub Total</center></th>
                                                   </tr></tfoot></thead><tbody>";
                        for($count = 0; $count < count($_POST["item_name"]); $count++)
                        {  
                            $item = $_POST["item_name"][$count];
                            $item_charge = $_POST["unit_price"][$count];
                            $serial = $_POST["serial"][$count];
                            $description = $_POST["description"][$count];
                            $quantity = $_POST["quantity"][$count];
                           
                        
                            if($type=="NORMAL-RETURN"){
                        //ITEM COUNT ADDITION TO STOCK TABLE - START
                            $sql25 = "SELECT stock_shop FROM item WHERE id = '$item'";
                               $result25 = mysqli_query($con, $sql25);
                                   while ($arraySomething25 = mysqli_fetch_array($result25)) {
                                       $stock_shop = $arraySomething25['stock_shop'];  
                                   }
                            $new_stock_shop = $stock_shop + $quantity;
                             
                        $sql18 = "UPDATE item SET stock_shop = '$new_stock_shop' WHERE id='$item'";
                        mysqli_query($con, $sql18);   
                        //ITEM COUNT ADDITION TO STOCK TABLE - END
                         
                            }
                        //RETRIEVE INVOICE ID - START
                            $sql75 = "SELECT id FROM invoice_return WHERE return_number = '$current_return_no'";
                               $result75 = mysqli_query($con, $sql75);
                                   while ($arraySomething75 = mysqli_fetch_array($result75)) {
                                       $return_id = $arraySomething75['id'];  
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
                            //RETRIEVE RENT CHARGE DATA - END
                         $sub_total = $item_charge*$quantity;  
                         $net_total = $net_total + $sub_total;
                         echo "<tr bgcolor='#80D8AD'><td>".$cat1_name." ".$cat2_name." ".$cat3_name." ".$cat4_name." </td><td align='right'>".$serial."</td><td align='right'>".$description."</td><td align='right'>".$quantity."</td><td align='right'>".number_format($item_charge,2)."</td><td align='right'>".number_format($sub_total,2)."</td>";

                         $item_name = $cat1_name." ".$cat2_name." ".$cat3_name." ".$cat4_name;
                           // DATA INSERTION TO INVOICE_ITEMS TABLE - START
                            $query = "INSERT INTO invoice_items_return (item_id,customer_id,item_name,serial,description,return_id,unit_price,min_sale_price,cash_price,credit_price,quantity,user,company) VALUES "
                                    . "('$item','$customer','$item_name','$serial','$description','$return_id','$item_charge','$min_sale_price','$cash_price','$credit_price','$quantity','$user', '$company')";
                            mysqli_query($con, $query);
                         // DATA INSERTION TO INVOICE_ITEMS TABLE - END
                         
                         
                        }
                        
                        
                        // echo "<tr bgcolor='#80D8AD'><td> </td><td> </td><td> </td><td></td>";
                          
                          echo "<tr bgcolor='#80D8AD'><td colspan='5' align='right'><b>Net Total</b></td><td align='right'><b>-".number_format($net_total,2)."</b></td>";
                         
                           
                    echo "</table>"   ;
                    
										$cash = $net_amount;
      
         }
                                  
  
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
<?php 
}
     else{
        echo "Error3";  
     }
     }
     
           
  else{
    echo "Error1";
   // echo "<center><font color='red'>No Items Selected. Please go Back and Select Items !</font></center><br><br>";
} 

?>
    