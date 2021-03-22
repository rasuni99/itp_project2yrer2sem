 <!DOCTYPE html>
<?php
include 'connection.php';
include 'header.php';
// $user = $_SESSION['sess_user_id'];
// $company = $_SESSION['sess_company'];
$today = date("Y-m-d");
?>
<html>
<head>
        <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
        <link rel="stylesheet" href="plugins/iCheck/all.css"> 
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
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        
                     <div id='ajaxmsg'>
                    </div>
        
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
        
       
      <h1>
        Customer's Payments Outstandings 
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pending Cheques</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
                           <div class='col-xs-12'>
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                    <h3 class="box-title" style="color: green; font-weight: bold">Customer's Outstandings</h3>
                                   <div class="box-tools pull-right">
                                   </div>
                                  </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                    
                                <?php
                                $total_due = $unsettle_balance = $total_net_amount = $total_paid = $cheque_realize_total = 0;
                                echo " <table id='example1' class='table table-bordered table-striped'><thead>";

                                echo "<tr><th><center> Customer Name </center></th><th><center> Address </center></th><th><center> Phone </center></th><th><center> Phone </center></th><th><center> Total Invoice Amount </center></th><th><center> Total Cash Received </center></th>
                                                                <th width='8%'><center> Pending Cheque Amount </center></th><th><center> Total Due Amount </center></th> <th><center> Unsettled Amount </center></th>
                                                                <th width='2%'><center> View</center></th>
                                                                </tr><tfoot></thead><tbody>";
                                 $sql = "SELECT id,type_customer,company_name,company_phone,salutation,person,person_mobile,company_address FROM company_customer WHERE stat='1'";
                                 $result = mysqli_query($con, $sql);
                                while ($arraySomething1 = mysqli_fetch_array($result)) {
                                    $customer_id = $arraySomething1['id'];
                                    $salutation = $arraySomething1['salutation'];
                                    $type = $arraySomething1['type_customer'];
                                    $company_name = $arraySomething1['company_name'];
                                    $company_phone = $arraySomething1['company_phone'];
                                    $name = $arraySomething1['person'];
                                    $mobile = $arraySomething1['person_mobile'];
                                    $company_address = $arraySomething1['company_address'];


                                    if($type==2){
                                            $customer_name = $company_name;
                                            $customer_phone = $company_phone;
                                            $salutation = "";
                                    }else{
                                            $customer_name = $name;
                                            $customer_phone = $mobile;
                                    } 
                                    
                                    
                                                $total_net_amount = 0;
                                                 
                                                $sql18 = "SELECT id,invoice_real_no,net_amount,DATE(date_enter) AS date FROM invoice_real WHERE customer_id='$customer_id' AND stat = '1' ORDER BY id DESC";
                                                $result18 = mysqli_query($con, $sql18);
                                                while ($arraySomething18 = mysqli_fetch_array($result18)) {
                                                    $invoice_id = $arraySomething18['id'];
                                                    $invoice_no = $arraySomething18['invoice_real_no'];
                                                    $net_amount = $arraySomething18['net_amount'];
                                                    $entered_date = $arraySomething18['date'];
                                                    
                                                $total_net_amount = $total_net_amount + $net_amount;
                                                }
                                                        $total_paid = 0;    
                                                        $sql9 = "SELECT amount FROM cash_book WHERE customer_id='$customer_id' AND stat = '1' AND payment_received='1'";
                                                        $result9 = mysqli_query($con, $sql9);
                                                        while ($arraySomething9 = mysqli_fetch_array($result9)) {
                                                            $invoice_paid = $arraySomething9['amount'];
                                                            $total_paid = $total_paid + $invoice_paid; //all payments received
                                                        }
                                                        
//                                                        $total_paid_not = 0;
//                                                        $sql91 = "SELECT amount FROM cash_book WHERE customer_id='$customer_id' AND stat = '1' AND payment_received='0' ORDER BY id DESC";
//                                                        $result91 = mysqli_query($con, $sql91);
//                                                        while ($arraySomething91 = mysqli_fetch_array($result91)) {
//                                                            $invoice_paid = $arraySomething91['amount'];
//                                                            $total_paid_not = $total_paid_not + $invoice_paid; //all payments received
//                                                        }
                                                        
                                                        $pending_cheque_all = 0;
                                                        $sql911 = "SELECT amount FROM cash_book WHERE customer_id='$customer_id' AND stat = '1' AND payment_received='0' AND payment_type='CHEQUE'  AND cheque_reject='0' ORDER BY id DESC";
                                                        $result911 = mysqli_query($con, $sql911);
                                                        while ($arraySomething91 = mysqli_fetch_array($result911)) {
                                                            $pending_cheque = $arraySomething91['amount'];
                                                            $pending_cheque_all = $pending_cheque_all + $pending_cheque; // pending cheque total
                                                        }
                                                        
                                                        $total_due = $total_net_amount - $total_paid;
                                                        $unsettle_balance = $total_due - $pending_cheque_all;
                                                
                                                
                                                
                                                
                                                
                                           
                                   
                                echo "<tr><td align='left'>".$customer_name . "</td><td align='left'>".$company_address . "</td><td align='center'>" . $company_phone . "</center> </td><td align='center'>" . $mobile . "</center> </td>
                                <td align='right'> <b>" . number_format($total_net_amount,2)."</b> </td><td align='right'><b>" . number_format($total_paid ,2)."</b></td><td align='right'><b>" . number_format($pending_cheque_all,2)."</b> </td><td align='right'><b>" . number_format($total_due ,2)."</b></td><td align='right'><b><font color='red'>" . number_format($unsettle_balance,2)."</b> </td>";
                                

                                echo "<td align='center'> <a type='button' title='Click to realize the cheque' class='btn btn-default btn-xs confirm_action' href='all_credits.php?id=".$customer_id."'>
																 <span class='glyphicon glyphicon-ok' aria-hidden='true'></span> </a></td></tr>";  
                                 }
                                 echo "<tr><tfoot><th><center> Customer Name </center></th><th><center> Address </center></th><th><center> Phone </center></th><th><center> Phone </center></th><th><center> Total Invoice Amount </center></th><th><center> Total Cash Received </center></th>
                                                                <th width='8%'><center> Pending Cheque Amount </center></th><th><center> Total Due Amount </center></th> <th><center> Unsettled Amount </center></th>
                                                                <th width='2%'><center> View</center></th>
                                                                </tr></tfoot>";
                               echo "</table></div>";
                                ?>

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
            $('#example2').DataTable()
            $('#example1').DataTable({
                'paging': false,
                'lengthChange': false,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': true
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
