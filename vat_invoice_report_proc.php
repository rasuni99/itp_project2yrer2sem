<?php
include 'connection.php';
include 'header.php';
// $company = $_SESSION['sess_company'];
$sql18 = "SELECT name FROM company WHERE id='$company'";
$result18 = mysqli_query($con, $sql18);
    while ($arraySomething18 = mysqli_fetch_array($result18)) {
         $company_name = $arraySomething18['name'];
    }

?>

<head>
     <style>
 @media print {
  /* style sheet for print goes here */
  .noprint {
    visibility: hidden;
  }
  .hello { font-size: 10pt }
}   
</style>

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

  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
 
    
    
   
    
</head>
<body>
    <?php   

// $user = $_SESSION['sess_user_id'];
// $company = $_SESSION['sess_company'];

         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
             $start = $_POST['start'];
             $end = $_POST['end'];
             $start = date('Y-m-d', strtotime(str_replace('-', '/', $start)));
             $end = date('Y-m-d', strtotime(str_replace('-', '/', $end)));
        ?>

 <h3 class="box-title" style="color: green; font-weight: bold">Sales Report (VAT Invoices)</h3>
 
<div class="row"> 
                           <div class='col-xs-3'>
                              
                                    
                                    <!-- /.box-header -->
                                 
                                       <table id="example1" class="table table-bordered ">
                                       <tr><td>From : </td><td><?php echo $start ?></td></tr>
                                       <tr><td>To : </td><td><?php echo $end ?></td></tr>
                                       </table>
                                      
                                
                                 </div>
    <div class='col-xs-6'>
                              
                                    
                                    <!-- /.box-header -->
                                 
                                       <table id="example1" class="table table-bordered ">
                                       <tr><td>Company : </td><td><?php echo $company_name;?></td></tr>
                                       <tr><td>VAT No : </td><td>114724831-7000</td></tr>
                                       </table>
                                      
                                
                                 </div>
    <div class='col-xs-3'>
                              
                                    
                                    <!-- /.box-header -->
                                 
                                       <button onclick='window.print()' class='btn btn-primary noprint'>Print Report</button><BR><BR>
                                       <button onclick='window.close()' class='btn btn-warning noprint'>Close Report</button>
                                      
                                
                                 </div>
      
            
                        <div class='col-xs-12'>
                                
                                  
                                    <!-- /.box-header --> 
                                    <div class="box-body">
                                        <table id="" class="table table-bordered table-striped hello">
                                            <thead>

                                                <?php
                                                echo "<tr><th width='7%'><center> Invoice # </center></th><th width='35%'><center> Customer </center></th><th width='12%'><center> Date </center></th><th><center> Total </center></th><th><center> NBT </center></th><th><center> VAT </center></th><th><center> Net Total </center></th>
					</tr></tfoot></thead><tbody>";
                                             $nbt_percentage = $vat_percentage = 0;
                                               $total_vat = $total_nbt = $total_invoice = $total_cash = $total_credit = $net_total = $without_tax_total = 0;
                                                $salutation = $customer_name = "";
                                                $sql18 = "SELECT id,invoice_real_no,net_amount,customer_id,date,user,type,tax_percentage_id FROM invoice_real WHERE company='$company' AND stat = '1'  AND invoice_type='VAT' AND (date >= '$start' AND date <= '$end') ORDER BY id ASC";
                                                $result18 = mysqli_query($con, $sql18);
                                                    while ($arraySomething18 = mysqli_fetch_array($result18)) {
                                                        $invoice_id = $arraySomething18['id'];
                                                        $invoice_no = $arraySomething18['invoice_real_no'];
                                                        $net_total_final = $arraySomething18['net_amount'];
                                                        $type = $arraySomething18['type'];
                                                        $customer_id = $arraySomething18['customer_id'];
                                                        $entered_date = $arraySomething18['date'];
                                                        $invoice_user_id = $arraySomething18['user'];
                                                        $tax_percentage_id = $arraySomething18['tax_percentage_id'];
//                                                       
                                                       
                                                        $sql = "SELECT nbt,vat FROM tax_percentages WHERE id='$tax_percentage_id'";
                                                        $result = mysqli_query($con, $sql);
                                                            while ($arraySomething1 = mysqli_fetch_array($result)) {
                                                                $nbt_percentage = $arraySomething1['nbt'];
                                                                $vat_percentage = $arraySomething1['vat'];
                                                            }
                                                        
                                                        $net_amount = $net_total_final;
                                                        if($type=='CASH-SALE'){
                                                            $type='CASH';
                                                        $total_cash = $total_cash + $net_amount; 
                                                        }
                                                        if($type=='CREDIT-SALE'){
                                                            $type='CREDIT';
                                                        $total_credit = $total_credit + $net_amount;     
                                                        }
                                                        
                                                        $net_total = $net_total + $net_amount; 
                                                        
                                                        $sql15 = "SELECT name FROM users WHERE id='$invoice_user_id'";
                                                        $result15 = mysqli_query($con, $sql15);
                                                        while ($arraySomething15 = mysqli_fetch_array($result15)) {
                                                        $invoice_user = $arraySomething15['name'];
                                                        }
                                                        
                                                        $sql19 = "SELECT type_customer,company_name,salutation,person,company_address,vat_no FROM company_customer WHERE id='$customer_id'";
                                                        $result19 = mysqli_query($con, $sql19);
                                                        while ($arraySomething19 = mysqli_fetch_array($result19)) {
                                                        $type_customer = $arraySomething19['type_customer'];
                                                        $company_name = $arraySomething19['company_name'];
                                                        $salutation = $arraySomething19['salutation'];
                                                        $person = $arraySomething19['person'];
                                                        $company_address = $arraySomething19['company_address'];
                                                        $company_vat_no = $arraySomething19['vat_no'];
                                                        
                                                        }
                                                        
                                                        
                                                        if($type_customer==2){
                                                            $salutation = "";
                                                            $customer_name = $company_name;
                                                        }
                                                        else
                                                            $customer_name = $person;
                                                        
                                                        $amount_with_nbt = (100 / (100+$vat_percentage)) * $net_total_final;
                                                        $net = ($amount_with_nbt / (100+$nbt_percentage)) * 100;
                                                        $nbt_per_item = ($net / 100) * $nbt_percentage;
                                                        $vat_per_item = ($amount_with_nbt / 100) * $vat_percentage;

                        //                                $nbt_for_all_items = $nbt_per_item * $quantity;
                        //                                $nbt_amount_total = $nbt_amount_total + $nbt_for_all_items;

                                                        $final_total = $net_total_final - ($nbt_per_item+$vat_per_item);
                                                        
                                                        $total_nbt = $total_nbt + $nbt_per_item;
                                                        $total_vat = $total_vat + $vat_per_item;
                                                        $total_invoice = $total_invoice + $net_total_final;
                                                        $without_tax_total = $without_tax_total + $final_total;
                                                        echo "<tr><td> <center>".$invoice_no. "</center> </td><td align='left'>".$salutation." ".$customer_name. "<br>".$company_vat_no."</td><td><center>" .$entered_date. " <center></td><td align='right'> ".number_format($final_total,2)."</td><td align='right'> ".number_format($nbt_per_item,2)."</BR>(".$nbt_percentage."%)</td><td align='right'> ".number_format($vat_per_item,2)."</BR>(".$vat_percentage."%)</td><td align='right'> ".number_format($net_total_final,2)."</td>";
                                                         
                                                            }
                                                     echo "<tr><td colspan='6'> &nbsp; </td><td align='right'> &nbsp;</td>";
                                                     echo "<tr><td colspan='6'> TOTAL SALE (WITHOUT NBT/VAT) </td><td align='right'> ".number_format($without_tax_total,2)."</td>"; 
                                                     echo "<tr><td colspan='6'> TOTAL VAT </td><td align='right'> ".number_format($total_vat,2)."</td>";
                                                     echo "<tr><td colspan='6'> TOTAL NBT </td><td align='right'> ".number_format($total_nbt,2)."</td>";
                                                     echo "<tr><td colspan='6'> NET TOTAL SALE (WITH NBT/VAT) </td><td align='right'> ".number_format($total_invoice,2)."</td>";
                                                     
                                           
                                            ?>
                                                
                                                
                                               
                                                    </table>
                                        
                                                    </div>
                                                </div>
                                        </div>
Note : The invoice numbers except above mentioned are non-vat invoices for given period of time. 

</div></body>
</html> 
      
                               
         <?php } ?>
