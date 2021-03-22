<?php
include 'connection.php';
include 'header.php';

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

 <h3 class="box-title" style="color: green; font-weight: bold">Expenses Report(Cash and Cheque)</h3>
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
                                        <h4>CASH EXPENSES</h4>
                                        <table id="" class="table table-bordered table-striped">
                                            <thead>

                                                <?php
                                                echo "<tr><th><center> Voucher # </center></th><th><center> Expense Type </center></th><th><center> Expense Date </center></th><th><center> Amount </center></th>
					</tr></tfoot></thead><tbody>";
                                               $total_cash = 0; 
                                               $total = 0;
                                                $sql18 = "SELECT id,payee_name,DATE(pay_date) AS date,amount FROM expenses_cash WHERE company='$company' AND stat = '1' AND (DATE(pay_date) >= '$start' AND DATE(pay_date) <= '$end') ORDER BY id ASC";
                                                $result18 = mysqli_query($con, $sql18);
                                                    while ($arraySomething18 = mysqli_fetch_array($result18)) {
                                                        $id = $arraySomething18['id'];
                                                        $payee_name = $arraySomething18['payee_name'];
                                                        $amount = $arraySomething18['amount'];
                                                        $date = $arraySomething18['date'];
                                                       
                                                        $total_cash = $total_cash + $amount;
                                                        $voucherno = $id + 10000;
                                                        $voucherno = "VH".$voucherno;
                                                        echo "<tr><td> <center>".$voucherno. "</center> </td><td align='left'>".$payee_name. "</td><td align='left'>" . $date . "</td> <td align='right'> ".number_format($amount,2)."</td>";
                                                         
                                                            }
                                                     echo "<tr><td colspan='3'> &nbsp; </td><td align='right'> &nbsp;</td>";       
                                                     echo "<tr><td colspan='3'> TOTAL CASH EXPENSES</td><td align='right'> <b>".number_format($total_cash,2)."</b></td>";
                                                   
                                           
                                            ?>
                                                
                                                
                                               
                                                    </table>
                                                    </div>
                                                </div>
                                        </div>

                         <div class='col-xs-12'>
                                <div class="box box-primary">
                                  
                                    <!-- /.box-header --> 
                                    <div class="box-body">
                                       <h4>CHEQUE EXPENSES</h4>
                                        <table id="" class="table table-bordered table-striped">
                                            <thead>

                                                <?php
                                                echo "<tr><th><center> Voucher # </center></th><th><center> Expense Type </center></th><th><center>Bank Account </center></th><th><center> Cheque No </center></th><th><center> Expense Date </center></th><th><center> Amount </center></th>
					</tr></tfoot></thead><tbody>";
                                               $total_cheque = 0; 
                                               
                                                $sql18 = "SELECT id,payee_name,DATE(pay_date) AS date,amount,cheque_no,bank_account FROM expenses_cheque WHERE company='$company' AND stat = '1' AND (DATE(pay_date) >= '$start' AND DATE(pay_date) <= '$end') ORDER BY id ASC";
                                                $result18 = mysqli_query($con, $sql18);
                                                    while ($arraySomething18 = mysqli_fetch_array($result18)) {
                                                        $id = $arraySomething18['id'];
                                                        $payee_name = $arraySomething18['payee_name'];
                                                        $amount = $arraySomething18['amount'];
                                                        $date = $arraySomething18['date'];
                                                        $bank_account = $arraySomething18['bank_account'];
                                                        $cheque_no = $arraySomething18['cheque_no'];
                                                        
                                                        
                                                        $sql181 = "SELECT bank,account_no FROM bank_accounts WHERE id='$bank_account'";
                                                        $result181 = mysqli_query($con, $sql181);
                                                        while ($arraySomething181 = mysqli_fetch_array($result181)) {
                                                        $bank_id = $arraySomething181['bank'];
                                                        $account_no = $arraySomething181['account_no'];
                                                        }
                                                        $sql181 = "SELECT name FROM banks WHERE id='$bank_id'";
                                                        $result181 = mysqli_query($con, $sql181);
                                                        while ($arraySomething181 = mysqli_fetch_array($result181)) {
                                                        $bank_name = $arraySomething181['name'];
                                                        $bank_name = strtoupper($bank_name);
                                                        }
                                                       
                                                        $total_cheque = $total_cheque + $amount;
                                                        $voucherno = $id + 10000;
                                                        $voucherno = "VE".$voucherno;
                                                        echo "<tr><td> <center>".$voucherno. "</center> </td><td align='left'>".$payee_name. "</td><td align='left'>" . $bank_name."-".$account_no . "</td><td align='left'>" . $cheque_no . "</td><td align='left'>" . $date . "</td> <td align='right'> ".number_format($amount,2)."</td>";
                                                         
                                                            }
                                                     echo "<tr><td colspan='5'> &nbsp; </td><td align='right'> &nbsp;</td>";       
                                                     echo "<tr><td colspan='5'> TOTAL CHEQUE EXPENSES</td><td align='right'><b> ".number_format($total_cheque,2)."</b></td>";
                                                     $total = $total_cheque + $total_cash;
                                                      echo "<tr><td colspan='5'> &nbsp; </td><td align='right'> &nbsp;</td>";  
                                                       echo "<tr><td colspan='5'> &nbsp; </td><td align='right'> &nbsp;</td>";  
                                                        echo "<tr><td colspan='5'>TOTAL EXPENSES(CASH)</td><td align='right'>".number_format($total_cash,2)."</td>";
                                                        echo "<tr><td colspan='5'> TOTAL EXPENSES (CHEQUE)</td><td align='right'>".number_format($total_cheque,2)."</td>";
                                                        echo "<tr><td colspan='5'><b> TOTAL EXPENSES(CASH & CHEQUE)</b></td><td align='right'><b> ".number_format($total,2)."</b></td>";
                                           
                                            ?>
                                                
                                                
                                               
                                                    </table>
                                                    </div>
                                                </div>
                                        </div>                   




</div><H5><CENTER>- REPORT END -</CENTER></H5></body>
</html> 
      
                               
         <?php } ?>
