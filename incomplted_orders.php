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
 $today  = date('Y-m-d');
// $user = $_SESSION['sess_user_id'];
// $company = $_SESSION['sess_company'];

$sql12 = "SELECT SUM(net_amount) AS amount FROM invoice WHERE convert_to_invoice='0' AND company='$company' AND stat = '1' ORDER BY date ASC";
$sql = "SELECT invoice_no,net_amount,type,customer_id,date FROM invoice WHERE convert_to_invoice='0' AND company='$company' AND stat = '1' ORDER BY date ASC";
                    $result = mysqli_query($con, $sql);
                    $result12 = mysqli_query($con, $sql12);
                    while ($arraySomething1 = mysqli_fetch_array($result12)) {
                            $all_amount = $arraySomething1['amount'];
                            }
$count_incomplete_orders = mysqli_num_rows($result);      
    
        ?>

 <h3 class="box-title" style="color: green; font-weight: bold">Incomplete Orders</h3>
  <h5 class="box-title" style="color: green; font-weight: bold"><?php echo $company_name;?></h5>
<div class="row"> 
    
     <div class='col-xs-6'>
                              
                                    
                                    <!-- /.box-header -->
                                 
                                       <table id="example1" class="table table-bordered ">
                                       <tr><td>No of Orders : </td><td><?php echo $count_incomplete_orders?></td></tr>
                                       <tr><td>Total Value : </td><td>Rs. <?php echo number_format($all_amount,2) ?></td></tr>
                                       </table>
                                      
                                
                                 </div>
                              <div class='col-xs-4'>
                              
                                    
                                    <!-- /.box-header -->
                                 
                                       <button onclick='window.print()' class='btn btn-primary noprint'>Print Report</button>
                                       <button onclick='window.close()' class='btn btn-warning noprint'>Close Report</button>
                                      
                                
                                 </div>
      
            
                      
                      <div class='col-xs-12'>
                         
                                
                                <table id="example18" class="table table-bordered table-striped hello">
                                            <thead>

                                               
                                                <?php
                                                echo "<tr><th><center> Order # </center></th><th><center> Date </center></th><th><center> Customer Name </center></th><th><center> Customer Phone </center></th><th><center> Sales Type </center></th><th><center> Amount </center></th>
					</tr></tfoot></thead><tbody>";
                                           
                                                $type = 0;
                                                
                                               $sql = "SELECT invoice_no,net_amount,type,customer_id,date FROM invoice WHERE convert_to_invoice='0' AND company='$company' AND stat = '1' ORDER BY date ASC";
                                                $result = mysqli_query($con, $sql);
                                                    while ($arraySomething1 = mysqli_fetch_array($result)) {
                                                        $invoice_no = $arraySomething1['invoice_no'];
                                                        $net_amount = $arraySomething1['net_amount'];
                                                        $sales_type = $arraySomething1['type'];
                                                        $customer_id = $arraySomething1['customer_id'];
                                                        $date = $arraySomething1['date'];
                                                       
                                                            $sql16 = "SELECT id,type_customer,company_name,company_address,company_phone,salutation,person,person_mobile FROM company_customer WHERE id='$customer_id'";
                                                            $result16 = mysqli_query($con, $sql16);
                                                            while ($arraySomething16 = mysqli_fetch_array($result16)) {
                                                                $id = $arraySomething16['id'];
                                                                $salutation = $arraySomething16['salutation'];
                                                                $type = $arraySomething16['type_customer'];
                                                                $company_name = $arraySomething16['company_name'];
                                                                $company_phone = $arraySomething16['company_phone'];
                                                                $name = $arraySomething16['person'];
                                                                $mobile = $arraySomething16['person_mobile'];
                                                                $company_address = $arraySomething16['company_address'];


                                                                if($type==2){
                                                                        $customer_name = $company_name;
                                                                        $customer_phone = $company_phone;
                                                                        $salutation = "";
                                                                }else{
                                                                        $customer_name = $name;
                                                                        $customer_phone = $mobile;
                                                                } 
                                                            }
                        
                                                        
                                                         echo "<tr><td> &nbsp" .  $invoice_no . " </td><td> &nbsp" .  $date . " </td><td> &nbsp" .  $salutation." ".$customer_name . " </td><td align='center'> &nbsp" . $customer_phone." </td><td align='right'> &nbsp" . $sales_type. " </td><td align='right'>" . number_format($net_amount,2) . "</td>";
                                                                                
                                                               
                                                                   
                                                            }

                                           
                                            ?>
                                                    </table>
                            </div>
                        </div> 
                    </div></body>
</html> 
      
                               
      
