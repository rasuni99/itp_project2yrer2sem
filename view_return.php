<?php
include 'connection.php';
include 'header.php';
//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
 
     
   
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
//$invoice_code = $_SESSION['code_invoice'];
//$sale_code = $_SESSION['code_sale'];
$today = date('Y-m-d'); 
$todaynow = date("Y-m-d h:i:sA");


if (isset($_GET['id'])) {
    $invoice_id = $_GET['id'];


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

    $sql1 = "SELECT id,return_number,net_amount,type,customer_id,DATE(date_enter) AS date FROM invoice_return WHERE id='$invoice_id'";
    $result1 = mysqli_query($con, $sql1);
        while ($arraySomething1 = mysqli_fetch_array($result1)) {
        $invoice_id = $arraySomething1['id'];
        $customer = $arraySomething1['customer_id'];
        $invoicedate = $arraySomething1['date'];
        $current_invoice_no = $arraySomething1['return_number'];
        $net_amount = $arraySomething1['net_amount'];
        $type = $arraySomething1['type'];
       
        }
                        $sql = "SELECT id,type_customer,company_name,company_phone,salutation,person,person_mobile,vat_no,company_address FROM company_customer WHERE id='$customer'";
                            $result = mysqli_query($con, $sql);
                                while ($arraySomething1 = mysqli_fetch_array($result)) {
                                    $id = $arraySomething1['id'];
                                    $salutation = $arraySomething1['salutation'];
                                    $type1 = $arraySomething1['type_customer'];
                                    $company_name = $arraySomething1['company_name'];
                                    $company_phone = $arraySomething1['company_phone'];
                                    $name = $arraySomething1['person'];
                                    $mobile = $arraySomething1['person_mobile'];
                                    $vat_no = $arraySomething1['vat_no'];
                                    $customer_address = $arraySomething1['company_address'];

                                    if($type1==2){
                                            $customer_name = $company_name;
                                            $customer_phone = $company_phone;
                                            $salutation = "";
                                    }else{
                                            $customer_name = $name;
                                            $customer_phone = $mobile;
                                    } 
                                }
                        
                     if($type=="DAMAGE-RETURN")
                     $invoice_name = "DAMAGE-RETURN NOTE";
                     if($type=="NORMAL-RETURN")
                    $invoice_name = "NORMAL-RETURN NOTE";
                    
                     
                     
                         
    
       
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
                                   // echo "<tr><td>Address :</td><td align='right'>".$customer_address."</td></tr>";
                                    ?>
                                    </table></div>
    
            <div class="col-xs-6">                                 
                                 
                                     <table class="table table-bordered table-condensed">
                                     <?php
                                     echo "<tr><td>Order No :</td><td align='right'>".$current_invoice_no."</td></tr>";
                                     echo "<tr><td>Generated </td><td align='right'>".$invoicedate."</td></tr>";
                                    
                                     ?>
                                     </table></div>
</div>
<?php     
            
                
         
            echo '<table id="example1" class="table table-bordered ">';

                   $net_total = 0; $vat_amount_total = $nbt_amount_total = 0;
                   $item_discount_all = 0;    
                   echo "<tr><th><center> Item </center></th><th><center> Serial </center></th><th><center> Description</center></th><th><center> Qty </center></th><th><center>Unit Price</center></th><th><center> Sub Total</center></th>
                                                   </tr></tfoot></thead><tbody>";
                       
                       $sql = "SELECT item_name,description,serial,quantity,unit_price FROM invoice_items_return WHERE return_id='$invoice_id'";
                            $result = mysqli_query($con, $sql);
                            while ($arraySomething1 = mysqli_fetch_array($result)) {
                            
                            $item_name = $arraySomething1['item_name'];
                            $description = $arraySomething1['description'];
                            $quantity = $arraySomething1['quantity'];
                            $unit_price = $arraySomething1['unit_price'];
                            $serial = $arraySomething1['serial'];
                            $sub_total = $unit_price * $quantity;
                              

                         
                         echo "<tr bgcolor='#80D8AD'><td>".$item_name." </td><td align='right'>".$serial."</td><td align='right'>".$description."</td><td align='right'>".$quantity."</td><td align='right'>".number_format($unit_price,2)."</td><td align='right'>".number_format($sub_total,2)."</td>";

                        }
                        
                            echo "<tr bgcolor='#80D8AD'><td colspan='5' align='right'><b>Total</b></td><td align='right'><b>-".number_format($net_amount,2)."</b></td>";
                            
                    echo "</table>"   ;
          
                                  
  
$sql4 = "SELECT cheques_payable FROM company WHERE id='$company' ";
$result4 = mysqli_query($con, $sql4);
while ($arraySomething4 = mysqli_fetch_array($result4)) {
$cheques_payable = $arraySomething4['cheques_payable'];
}

            ?>
      <?php
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
        else{
            echo "Error4";  
        }

   

?>
    