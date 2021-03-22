<?php
include 'connection.php';
include 'header.php';
$user = $_SESSION['sess_user_id']; 
// $user_name = $_SESSION['sess_username'];
$today = date('Y-m-d');
?>

<head>
    
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
        

                <div class="row">
                        <div class='col-xs-12'>
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                       <h3 class="box-title" style="color: green; "><strong>Sale Invoices as <?php echo $today ?> || User : <?php echo $user_name ?></strong></h3>
                                       <div class="box-tools pull-right">
                                       </div>
                                       </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table id="example18" class="table table-bordered table-striped">
                                            <thead>

                                               
                                                <?php
                                                echo "<tr><th><center> Invoice # </center></th><th><center> Customer </center></th><th><center> Invoice User </center></th><th><center> Invoice Date </center></th><th><center> Invoice Amount </center></th> <th><center> Paid Amount </center></th><th><center> Due</center></th><th><center> Actions</center></th>
					</tr></tfoot></thead><tbody>";
                                               $cash_total = $card_total = $cheque_total = $net_total = 0; 
                                                $salutation = $customer_name = "";
                                                $sql18 = "SELECT id,invoice_no,net_amount,paid_amount,customer_id,DATE(date_enter) AS date,user FROM invoice WHERE company='$company' AND stat = '1' AND DATE(date_enter)='$today' AND user='$user' AND type LIKE 'SALEC%' ORDER BY id ASC";
                                                $result18 = mysqli_query($con, $sql18);
                                                    while ($arraySomething18 = mysqli_fetch_array($result18)) {
                                                        $invoice_id = $arraySomething18['id'];
                                                        $invoice_no = $arraySomething18['invoice_no'];
                                                        $net_amount = $arraySomething18['net_amount'];
                                                        $paid_amount = $arraySomething18['paid_amount'];
                                                        $customer_id = $arraySomething18['customer_id'];
                                                        $entered_date = $arraySomething18['date'];
                                                        $invoice_user_id = $arraySomething18['user'];
                                                        
                                                        $sql15 = "SELECT username FROM users WHERE id='$invoice_user_id'";
                                                        $result15 = mysqli_query($con, $sql15);
                                                        while ($arraySomething15 = mysqli_fetch_array($result15)) {
                                                        $invoice_user = $arraySomething15['username'];
                                                        }
                                                        
                                                        $sql19 = "SELECT type_customer,company_name,salutation,person FROM company_customer WHERE id='$customer_id'";
                                                        $result19 = mysqli_query($con, $sql19);
                                                        while ($arraySomething19 = mysqli_fetch_array($result19)) {
                                                        $type_customer = $arraySomething19['type_customer'];
                                                        $company_name = $arraySomething19['company_name'];
                                                        $salutation = $arraySomething19['salutation'];
                                                        $person = $arraySomething19['person'];
                                                        
                                                        }
                                                        
                                                        $due_amount = $net_amount - $paid_amount;
                                                        if($type_customer==2){
                                                            $salutation = "";
                                                            $customer_name = $company_name;
                                                        }
                                                        else
                                                            $customer_name = $person;
                                                        
                                                        
                                                        $sql16 = "SELECT amount,payment_type FROM cash_book WHERE invoice_id='$invoice_id'";
                                                        $result16 = mysqli_query($con, $sql16);
                                                        while ($arraySomething16 = mysqli_fetch_array($result16)) {
                                                        $amount = $arraySomething16['amount'];
                                                        $payment_type = $arraySomething16['payment_type'];
                                                        $net_total = $net_total + $amount;
                                                        
                                                        if($payment_type=='CASH')
                                                        $cash_total = $cash_total +  $amount;
                                                         if($payment_type=='CARD')
                                                        $card_total = $card_total +  $amount;
                                                          if($payment_type=='CHEQUE')
                                                        $cheque_total = $cheque_total +  $amount;
                                                            
                                                        }
                                                        echo "<tr><td> <center>".$invoice_no. "</center> </td><td align='left'>".$salutation." ".$customer_name. "</td><td> <center>" . $invoice_user . "</center> </td> <td><center>" .$entered_date. " <center></td><td align='right'> ".number_format($net_amount,2)."</td><td align='right'> ".number_format($paid_amount,2)."</td><td align='right'> ".number_format($due_amount,2)."</td>";
                                                                 
                                                        echo "<td align='center'><a type='button' title='Click to View this Invoice' class='btn btn-default btn-xs confirm_action' target='_blank' href='view_invoice_cash.php?id=".$invoice_id."'>
																 <span class='glyphicon glyphicon-share' aria-hidden='true'></span> </a>";  
                                                        echo "<a type='button' title='Click to CANCEL this Invoice' class='btn btn-default btn-xs confirm_action' href='delete_cash_invoice.php?id=".$invoice_id."'>
																 <span class='glyphicon glyphicon-remove' aria-hidden='true'></span> </a></td>";  
                                                            }
                                           
                                            ?>
                                                    </table>
                                                    </div>
                                                </div>
                                        </div>
                              </div>
                
                <div class="row">
                    <div class='col-xs-6'></div>
                        <div class='col-xs-6'>
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                       <h3 class="box-title" style="color: green; "><strong>Income Summery as <?php echo $today ?> || User : <?php echo $user_name ?></strong></h3>
                                       <div class="box-tools pull-right">
                                       </div>
                                       </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table id="example18" class="table table-bordered ">
                                            <thead>

                                               
                                                <?php
                                                
                                               echo "<tr><th>TOTAL CASH </th><td align='right'><b>".number_format($cash_total,2)."</b></td></tr></tfoot></thead><tbody>";
                                               echo "<tr><th>TOTAL CARD </th><td align='right'><b>".number_format($card_total,2)."</b></td></tr></tfoot></thead><tbody>";
                                               echo "<tr><th>TOTAL CHEQUE </th><td align='right'><b>".number_format($cheque_total,2)."</b></td></tr></tfoot></thead><tbody>";
                                              //  echo "<tr><th>TOTAL </th><td align='right'><b>".number_format($net_total,2)."</b></td></tr></tfoot></thead><tbody>";
                                                echo "<tr><th>NET TOTAL </th><td align='right'><b>".number_format($net_total,2)."</b></td></tr></tfoot></thead><tbody>";
                                               
                                                echo "</tfoot> ";
                                                                       
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
<!-- Page script -->
<script>
    
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datepicker').datepicker('mm-dd-yyyy', { 'placeholder': 'dd/mm/yyyy' })
	 $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
     $('#datepicker1').datepicker('mm-dd-yyyy', { 'placeholder': 'dd/mm/yyyy' })
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
    $('#datepicker3').datepicker({
      autoclose: true
    })
    $('#datepicker4').datepicker({
      autoclose: true
    })
 
  })
    </script>    
    
    <script>
        $(function () {
            $('#example1').DataTable()
            $('#example10').DataTable()
            $('#example11').DataTable()
            $('#example5').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
            $('#example3').DataTable()
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
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



