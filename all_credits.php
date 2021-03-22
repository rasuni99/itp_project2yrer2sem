<?php
include 'connection.php';
include 'header.php';
// $user = $_SESSION['sess_user_id']; 
// $user_name = $_SESSION['sess_username'];
$today = date('Y-m-d');
?>

<head>
    
    <style>
@media print{
   .noprint{
       display:none;
   }
}
</style>
    
  <script>   
            
    window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 4000);
            
        </script>

</head>

<body class="hold-transition skin-green sidebar-mini">


    <div class="wrapper">


<?php
include 'headerbar.php';
?>


        <div class="col-md-2">
        <?php
        include 'sidebar.php';
        ?>
        </div>

        <div class="content-wrapper">

            <section class="content">
                
                <?php
                     if(isset($_GET['msg'])){ ?>
                    <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <center><strong>SUCCESS : </strong> <?php echo $_GET['msg']; ?><center>
                  </div>
                    <?php }  
        
                    if(isset($_GET['msge'])){ ?>
                    <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <center><strong>FAILED : </strong> <?php echo $_GET['msge']; ?><center>
                    </div>
                    <?php }  ?>
        <?php
        
    if (isset($_GET['id'])) {
    $customer_id = $_GET['id'];             
        
     
          $sql = "SELECT id,type_customer,company_name,company_phone,salutation,person,person_mobile FROM company_customer WHERE id='$customer_id'";
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
                                
        
        
        ?>

                <div class="row">
                        <div class='col-xs-12'>
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                       <h3 class="box-title" style="color: green; "><strong>Customer :  <?php echo $customer_name ?>     s' All Due Invoices as <?php echo $today ?> </strong><small>All Cheques are subject to realization <small></h3>
                                       <div class="box-tools pull-right">
                                       </div>
                                       </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                       

                                               
                                                <?php
                                               
                                                 
                                                $sql18 = "SELECT id,invoice_real_no,net_amount,DATE(date_enter) AS date FROM invoice_real WHERE customer_id='$customer_id' AND stat = '1' ORDER BY id DESC";
                                                $result18 = mysqli_query($con, $sql18);
                                                while ($arraySomething18 = mysqli_fetch_array($result18)) {
                                                    $invoice_id = $arraySomething18['id'];
                                                    $invoice_no = $arraySomething18['invoice_real_no'];
                                                    $net_amount = $arraySomething18['net_amount'];
                                                    $entered_date = $arraySomething18['date'];
                                                 
                                                $total_paid = 0;    
                                                $sql9 = "SELECT amount FROM cash_book WHERE invoice_id='$invoice_id' AND stat = '1' AND payment_received='1' ORDER BY id DESC";
                                                $result9 = mysqli_query($con, $sql9);
                                                while ($arraySomething9 = mysqli_fetch_array($result9)) {
                                                    $invoice_paid = $arraySomething9['amount'];
                                                    $total_paid = $total_paid + $invoice_paid; //total cash_received
                                                }
                                                    
                                               
                                                
                                                $total_paid_all = 0;
                                                $sql91 = "SELECT amount FROM cash_book WHERE invoice_id='$invoice_id' AND stat = '1'  AND cheque_reject='0' AND payment_received='0' ORDER BY id DESC";
                                                $result91 = mysqli_query($con, $sql91);
                                                while ($arraySomething91 = mysqli_fetch_array($result91)) {
                                                    $invoice_paid_all = $arraySomething91['amount'];
                                                    $total_paid_all = $total_paid_all + $invoice_paid_all; //total_due
                                                }
                                                
                                                
                                                
                                                $pending_cheque_all = 0;
                                                $sql911 = "SELECT amount FROM cash_book WHERE invoice_id='$invoice_id' AND stat = '1' AND payment_received='0' AND payment_type='CHEQUE'  AND cheque_reject='0' ORDER BY id DESC";
                                                $result911 = mysqli_query($con, $sql911);
                                                while ($arraySomething91 = mysqli_fetch_array($result911)) {
                                                    $pending_cheque = $arraySomething91['amount'];
                                                    $pending_cheque_all = $pending_cheque_all + $pending_cheque; // pending cheque total
                                                }
                                                
                                                $due_total = $net_amount - $total_paid;
                                                $unsettle_balance = $due_total - $pending_cheque_all;
                                                
                                                if($unsettle_balance>0) {
                                                 echo "<table id='example18' class='table table-bordered '><tr bgcolor='#91F79E'><th><center> Invoice # </center></th><th width='150'><center> Invoice Date </center></th><th><center> Invoice Amount </center></th><th><center> Received Amount </center></th><th><center> Total Due Amount </center></th><th><center> Due Cheque Amount </center></th><th><center> Unsettled Amount </center></th>
					</tr></tfoot></thead><tbody>";
                                                echo "<tr bgcolor='#91F79E'><td><center>".$invoice_no. "</center> </td><td align='center' width='150'>".$entered_date. "</td><td> <center>" . number_format($net_amount,2). "</center> </td><td> <center>" . number_format($total_paid,2). "</center> </td><td> <center><b><font color='brown'>" . number_format($due_total,2)."</font> </center></b> </td><td> <center><b><font color='orange'>" . number_format($pending_cheque_all ,2)."</font> </center></b> </td><td> <center><b><font color='red'>" . number_format($unsettle_balance,2)."</font> </center></b> </td>";
                                            //    echo "<td align='center'><a type='button' title='Click to settle the payemnt' class='btn btn-default btn-xs confirm_action' href='resolve_credit.php?id=".$invoice_id."'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> </a></td></tr>";  
                                                   
                                                
                                                echo " </table><br><font size='3'>RECEIPTS DETAILS FOR INVOICE NO : ".$invoice_no. "</font><br><br><table id='example18' class='table table-bordered '>";
                                                echo "<tr><th width='200'><center> Receipt # </center></th><th width='150'><center> Receipt Date </center></th><th width='200'><center> Payment Type </center></th><th width='200'><center> Receipt Amount </center></th><th width='200'><center> Payment Settlement</center></th><th width='50'><center> View Receipt</center></th>
					              </tr></tfoot></thead><tbody>";

                                                        //TAKE ALL RECEIPTS FOR THE ABOUVE INVOICE NO - START
                                                        
                                                
                                                        $receipt_total = $payment_type_id = 0;
                                                        $sql5 = "SELECT id,receipt_no,amount,payment_type,payment_type_id,DATE(entered_date) AS date_enter FROM cash_book WHERE invoice_id='$invoice_id' AND stat = '1' ORDER BY id ASC";
                                                            $result5 = mysqli_query($con, $sql5);
                                                            while ($arraySomething5 = mysqli_fetch_array($result5)) {
                                                                $receipt_id = $arraySomething5['id'];
                                                                $receipt_no = $arraySomething5['receipt_no'];
                                                                $amount = $arraySomething5['amount'];
                                                                $payment_type = $arraySomething5['payment_type'];
                                                                $payment_type_id = $arraySomething5['payment_type_id'];
                                                                $date_enter = $arraySomething5['date_enter'];
                                                                
                                                                $receipt_total = $receipt_total + $amount;
                                                                
                                                                $pay_type = "CASH";
                                                                $pay_settle = "Payment Settled";
                                                                if($payment_type_id>0){
                                                                 
                                                                    //RETRIVE CHEQUE DETAILS
                                                                
                                                                    $sql6 = "SELECT bank,cheque_no,DATE(cheque_date) AS cheque_date,amount,realize,reject FROM cheque WHERE id='$payment_type_id'";
                                                                    $result6 = mysqli_query($con, $sql6);
                                                                    while ($arraySomething6 = mysqli_fetch_array($result6)) {
                                                                        $bank_id = $arraySomething6['bank'];
                                                                        $cheque_no = $arraySomething6['cheque_no'];
                                                                        $cheque_date = $arraySomething6['cheque_date'];
                                                                        $cheque_amount = $arraySomething6['amount'];
                                                                        $realize = $arraySomething6['realize'];
                                                                        $reject = $arraySomething6['reject'];
                                                                    }   
                                                                    $check_status = "";
                                                                    if(date("Y-m-d")>$cheque_date){
                                                                        
                                                                        $check_status = " and Cheque date has been Passed.";
                                                                        
                                                                    }
                                                                            //RETRIVE NAME OF THE BANK OF CHEQUE
                                                                            $sql1 = "SELECT name FROM banks WHERE id='$bank_id'";
                                                                            $result1 = mysqli_query($con, $sql1) ;
                                                                            while ($arraySomething11 = mysqli_fetch_array($result1)) {        
                                                                            $bank = $arraySomething11['name'];
                                                                            }
                                                                        
                                                                            $pay_type = "Cheque No :".$cheque_no."<br>Bank :".$bank."<br>Cheque Date :".$cheque_date;  
                                                                            $pay_settle = "<font color='orange'>Cheque Realizing Pending".$check_status."</font> ";
                                                                            if($realize>0)
                                                                                $pay_settle = "Payment Settled";
                                                                            if($reject>0)
                                                                                $pay_settle = "<font color='red'>Cheque Returned</font>";
                                                                            
                                                                }    
                                                                
//                                                                if($receipt_total<$net_amount){
                                                                    
                                                                    echo "<tr><td width='200'> <center>".$receipt_no. "</center> </td><td align='center' width='150'>".$date_enter. "</td><td width='200'>" . $pay_type . "</td><td ALIGN='right' width='200'>" . number_format($amount,2) . "</td> <td width='200'>" .$pay_settle. "</td>";
                                                                   
                                                                  
                                                                    echo "<td align='center' width='50'><a type='button' title='Click to view the Receipt' class='btn btn-default btn-xs confirm_action' target='' href='print_receipt.php?id=".$receipt_id."'>
																 <span class='glyphicon glyphicon-print' aria-hidden='true'></span> </a></td></tr>";  

                                                                   
                                                                
                                                            }
                                                        
                                                            echo "</tbody></table><br><br><hr size='300'>";
                                                }  
                                                }
    }
    else{
        
       ?>
         <script type="text/javascript">
    window.location.href = "/shanaz_production/new_receipt.php";
         </script>                             
       <?php
    }
                                                        ?>
                                                    </table>
                                                    </div>
                                                </div>
                                        </div>
                              </div>
                
           </section>
      </div> 
    </div>  
            
            
                                               
           
        
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="dist/js/demo.js"></script>

				
<!-- Page script -->
<script>
    
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    $('.select3').select2()

    //Datemask dd/mm/yyyy
    $('#datepicker').datepicker('mm-dd-yyyy', { 'placeholder': 'dd/mm/yyyy' })
	 $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

  

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
     $('#datepicker1').datepicker({
      autoclose: true
    })
    $('#datepicker2').datepicker({
      autoclose: true
    })
 
  })
    </script>    
    
    <script>
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging': false,
                'lengthChange': false,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
        })
        
        
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })


</script>
</body>
</html>
