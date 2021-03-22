<?php
include 'connection.php';
include 'header.php';
// $user = $_SESSION['sess_user_id']; 
$today = date('Y-m-d');
?>

<head>
    


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

<div class="row">
                        <div class='col-xs-12'>
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                       <h3 class="box-title" style="color: green; "><strong>All Cash Receipts</strong></h3>
                                       <div class="box-tools pull-right">
                                       </div>
                                       </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table id="example5" class="table table-bordered table-striped">
                                            <thead>

                                               
                                                 <?php
                                                echo "<tr><th><center> Receipt # </center></th> <th><center> Type </center></th><th><center> Receipt Date </center></th><th><center> Amount </center></th>
					</tr></tfoot></thead><tbody>";
                                           
                                               
                                                $sql18 = "SELECT id,receipt_no,amount,payment_type,entered_date FROM cash_book WHERE payment_type='CASH' AND company='$company' AND stat = '1' ORDER BY id ASC";
                                                $result18 = mysqli_query($con, $sql18);
                                                    while ($arraySomething18 = mysqli_fetch_array($result18)) {
                                                        $receipt_id1 = $arraySomething18['id'];
                                                        $receipt_no = $arraySomething18['receipt_no'];
                                                        $amount = $arraySomething18['amount'];
                                                        $pay_type = $arraySomething18['payment_type'];
                                                        $receipt_date = $arraySomething18['entered_date'];
                                                        
                                                        
                                                        
                                                         echo "<tr><td> <center>" .$receipt_no . "</center> </td><td><center>" .  $pay_type . " <center></td><td> <center> ".$receipt_date." </center> </td><td align='right'> ".number_format($amount,2)."</td>";
                                                                 
                                                                  
                                                            }
                              
                                                                        echo "</tbody><tfoot><tr><th><center> Receipt # </center></th> <th><center> Type </center></th><th><center> Receipt Date </center></th><th><center> Amount </center></th> </tr></tfoot> ";
                                                                       
                                            ?>
                                                    </table>
                                                    </div>
                                                </div>
                                        </div>
                              </div>
                
                <div class="row">
                        <div class='col-xs-12'>
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                       <h3 class="box-title" style="color: green; "><strong>All Cheque Receipts</strong></h3>
                                       <div class="box-tools pull-right">
                                       </div>
                                       </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table id="example4" class="table table-bordered table-striped">
                                            <thead>

                                               
                                                <?php
                                                echo "<tr><th><center> Receipt # </center></th> <th><center> Type </center></th><th><center> Cheque No </center></th><th><center> Cheque Date </center></th><th><center> Status </center></th><th><center> Receipt Date </center></th><th><center> Amount </center></th> 
					</tr></tfoot></thead><tbody>";
                                           
                                               
                                                $sql1 = "SELECT id,receipt_no,amount,payment_type,payment_type_id,entered_date FROM cash_book WHERE payment_type = 'CHEQUE' AND company='$company' AND stat = '1' ORDER BY id ASC";
                                                $result1 = mysqli_query($con, $sql1);
                                                    while ($arraySomething1 = mysqli_fetch_array($result1)) {
                                                        $receipt_id1 = $arraySomething1['id'];
                                                        $receipt_no5 = $arraySomething1['receipt_no'];
                                                        $amount = $arraySomething1['amount'];
                                                        $pay_type = $arraySomething1['payment_type'];
                                                        $pay_type_id_ch = $arraySomething1['payment_type_id'];
                                                        $receipt_date = $arraySomething1['entered_date'];
                                                       
                                                        
                                                        $sql25 = "SELECT cheque_no,DATE(cheque_date) AS cheque_date,realize FROM cheque WHERE id='$pay_type_id_ch' ";
                                                        $result25 = mysqli_query($con, $sql25);
                                                        while ($arraySomething25 = mysqli_fetch_array($result25)) {
                                                        $cheque_no = $arraySomething25['cheque_no'];
                                                        $cheque_date = $arraySomething25['cheque_date'];
                                                        $realize = $arraySomething25['realize'];
                                                        }
                                                        
                                                        if($realize == '1')
                                                            $cheque_status = "REALIZED";
                                                            else
                                                                $cheque_status = "REALIZING PENDING";
                                                            
                                                       
                                                         echo "<tr><td> <center>" .$receipt_no5 . "</center> </td><td><center>" .  $pay_type . " <center></td><td><center>" .  $cheque_no . " <center></td><td><center>" .  $cheque_date . " <center></td>"
                                                                 . "<td><center>" .  $cheque_status . " <center></td><td> <center> ".$receipt_date." </center> </td><td align='right'> ".number_format($amount,2)."</td>";
                                                                 
                                                                  
                                                            }
                              
                                                                        echo "</tbody><tfoot><tr><th><center> Receipt # </center></th> <th><center> Type </center></th><th><center> Cheque No </center></th><th><center> Cheque Date </center></th><th><center> Status </center></th><th><center> Receipt Date </center></th><th><center> Amount </center></th> 
					</tr></tfoot> ";
                                                                       
                                            ?>
                                                    </table>
                                                    </div>
                                                </div>
                                        </div>
                              </div>
                
                
                <div class="row">
                        <div class='col-xs-12'>
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                       <h3 class="box-title" style="color: green; "><strong>All Card Receipts</strong></h3>
                                       <div class="box-tools pull-right">
                                       </div>
                                       </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table id="example6" class="table table-bordered table-striped">
                                            <thead>

                                               
                                                <?php
                                                echo "<tr><th><center> Receipt # </center></th> <th><center> Type </center></th><th><center> Card No </center></th><th><center> Receipt Date </center></th><th><center> Amount </center></th> 
					</tr></tfoot></thead><tbody>";
                                           
                                               
                                                $sql18 = "SELECT id,receipt_no,  amount,payment_type,payment_type_id,entered_date FROM cash_book WHERE payment_type = 'CARD' AND company='$company' AND stat = '1' ORDER BY id ASC";
                                                $result18 = mysqli_query($con, $sql18);
                                                    while ($arraySomething18 = mysqli_fetch_array($result18)) {
                                                        $receipt_id1 = $arraySomething18['id'];
                                                        $receipt_no4 = $arraySomething18['receipt_no'];
                                                        $amount = $arraySomething18['amount'];
                                                        $pay_type = $arraySomething18['payment_type'];
                                                        $pay_type_id_ca = $arraySomething18['payment_type_id'];
                                                        $receipt_date = $arraySomething18['entered_date'];
                                                       
                                                        
                                                        $sql11 = "SELECT card_no FROM card WHERE id='$pay_type_id_ca' ";
                                                        $result11 = mysqli_query($con, $sql11);
                                                        while ($arraySomething11 = mysqli_fetch_array($result11)) {
                                                        $card_no = $arraySomething11['card_no'];
                                                        }
                                                        
                                                        
                                                         echo "<tr><td> <center>" .$receipt_no4 . "</center> </td><td><center>" .  $pay_type . " <center></td><td><center>" .  $card_no . "XXXXXXXXXX <center></td><td> <center> ".$receipt_date." </center> </td><td align='right'> ".number_format($amount,2)."</td>";
                                                                 
                                                                  
                                                            }
                              
                                                                        echo "</tbody><tfoot><tr><th><center> Receipt # </center></th> <th><center> Type </center></th><th><center> Card No </center></th><th><center> Receipt Date </center></th><th><center> Amount </center></th> ";
                                                                       
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
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': true
            })
           
            $('#example4').DataTable({
                 'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': true
            })
            $('#example6').DataTable({
                 'paging': true,
                'lengthChange': true,
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

