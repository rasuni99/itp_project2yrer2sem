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
}   
</style>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

  
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

 <h3 class="box-title" style="color: green; font-weight: bold">Sales Report</h3>
  <h5 class="box-title" style="color: green; font-weight: bold"><?php echo $company_name;?></h5>
<div class="row"> 
                           <div class='col-xs-4'>
                              
                                    
                                    <!-- /.box-header -->
                                 
                                       <table id="example1" class="table table-bordered ">
                                       <tr><td>From : </td><td><?php echo $start ?></td></tr>
                                       <tr><td>To : </td><td><?php echo $end ?></td></tr>
                                       </table>
                                      
                                
                                 </div>
    <div class='col-xs-4'>
                              
                                    
                                    <!-- /.box-header -->
                                 
                                       <button onclick='window.print()' class='btn btn-primary noprint'>Print Report</button>
                                       <button onclick='window.close()' class='btn btn-warning noprint'>Close Report</button>
                                      
                                
                                 </div>
      
            
                        <div class='col-xs-12'>
                                <div class="box box-primary">
                                  
                                    <!-- /.box-header --> 
                                    <div class="box-body">
                                        <table id="" class="table table-bordered table-striped">
                                            <thead>

                                                <?php
                                                echo "<tr><th><center> Invoice # </center></th><th><center> Customer </center></th><th width='6%'><center> Sale Type </center></th><th><center> Invoice Date </center></th><th width='10%'><center> Invoice Amount </center></th>
					</tr></tfoot></thead><tbody>";
                                               $total_cash = $total_credit = $net_total = 0; 
                                                $salutation = $customer_name = "";
                                                $sql18 = "SELECT id,invoice_real_no,net_amount,customer_id,date,user,type FROM invoice_real WHERE company='$company' AND stat = '1' AND (date >= '$start' AND date <= '$end') ORDER BY id ASC";
                                                $result18 = mysqli_query($con, $sql18);
                                                    while ($arraySomething18 = mysqli_fetch_array($result18)) {
                                                        $invoice_id = $arraySomething18['id'];
                                                        $invoice_no = $arraySomething18['invoice_real_no'];
                                                        $net_amount = $arraySomething18['net_amount'];
                                                        $type = $arraySomething18['type'];
                                                        $customer_id = $arraySomething18['customer_id'];
                                                        $entered_date = $arraySomething18['date'];
                                                        $invoice_user_id = $arraySomething18['user'];
                                                        
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
                                                        
                                                        $sql19 = "SELECT type_customer,company_name,salutation,person,company_address FROM company_customer WHERE id='$customer_id'";
                                                        $result19 = mysqli_query($con, $sql19);
                                                        while ($arraySomething19 = mysqli_fetch_array($result19)) {
                                                        $type_customer = $arraySomething19['type_customer'];
                                                        $company_name = $arraySomething19['company_name'];
                                                        $salutation = $arraySomething19['salutation'];
                                                        $person = $arraySomething19['person'];
                                                        $company_address = $arraySomething19['company_address'];
                                                        
                                                        }
                                                        
                                                        
                                                        if($type_customer==2){
                                                            $salutation = "";
                                                            $customer_name = $company_name;
                                                        }
                                                        else
                                                            $customer_name = $person;
                                                        
                                                        
                                                        
                                                        echo "<tr><td> <center>".$invoice_no. "</center> </td><td align='left'>".$salutation." ".$customer_name. "</td><td align='left'>" . $type . "</td> <td><center>" .$entered_date. " <center></td><td align='right'> ".number_format($net_amount,2)."</td>";
                                                         
                                                            }
                                                     echo "<tr><td colspan='4'> &nbsp; </td><td align='right'> &nbsp;</td>";       
                                                     echo "<tr><td colspan='4'> TOTAL CASH </td><td align='right'> ".number_format($total_cash,2)."</td>";
                                                     echo "<tr><td colspan='4'> TOTAL CREDIT </td><td align='right'> ".number_format($total_credit,2)."</td>";
                                                     echo "<tr><td colspan='4'> TOTAL SALE </td><td align='right'> ".number_format($net_total,2)."</td>"; 
                                           
                                            ?>
                                                
                                                
                                               
                                                    </table>
                                                    </div>
                                                </div>
                                        </div></div></body>
</html> 
      
                               
         <?php } ?>
