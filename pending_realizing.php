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
        Customer's Pending Cheques
        
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
                                    <h3 class="box-title" style="color: green; font-weight: bold">Customer's Pending Cheques</h3>
                                   <div class="box-tools pull-right">
                                   </div>
                                  </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                    
                                <?php
                                
                                echo " <table id='example1' class='table table-bordered table-striped'><thead>";

                                echo "<tr><th><center> Invoice No </center></th><th><center> Receipt No </center></th><th><center> Customer </center></th><th><center> Contact </center></th>
                                                                <th><center> Cheque No </center></th> <th><center> Bank </center></th>
                                                                <th><center> Cheque Date </center></th><th><center> Amount </center></th><th><center> Realize </center></th><th><center> Return </center></th>
                                                                </tr><tfoot></thead><tbody>";
                                $cheque_id =  0;
                                $customername = $mobile = $registration_no  = $bank = $cheque_no = $amount = $cheque_date = "";
                                $query1 = "SELECT id,invoice_id,cheque_no,bank,DATE(cheque_date) AS cheque_date,amount FROM cheque WHERE company = '$company' AND stat='1' AND realize='0' AND reject='0' ORDER BY id ASC ";
                                $result1 = mysqli_query($con, $query1);
                                 while ($row = mysqli_fetch_array($result1)) {
                                    $cheque_id = $row['id'];
                                    $cheque_no = $row['cheque_no'];
                                    $invoice_id = $row['invoice_id'];
                                    $bank_id = $row['bank'];
                                    $cheque_date = $row['cheque_date'];
                                    $amount= $row['amount'];
                                    
                                $query11 = "SELECT receipt_no FROM cash_book WHERE payment_type_id='$cheque_id' ";
                                $result11 = mysqli_query($con, $query11);
                                 while ($row1 = mysqli_fetch_array($result11)) {
                                    $receipt_no = $row1['receipt_no'];
                                 }
                                 
                                $query4 = "SELECT name FROM banks WHERE id='$bank_id' ";
                                $result4 = mysqli_query($con, $query4);
                                while ($row4 = mysqli_fetch_array($result4)) {
                                    $bank = $row4['name'];
                                }
                                    
                                $query5 = "SELECT invoice_real_no,customer_id FROM invoice_real WHERE id='$invoice_id' ";
                                $result5 = mysqli_query($con, $query5);
                                while ($row5 = mysqli_fetch_array($result5)) {
                                    $invoice_no = $row5['invoice_real_no'];
                                    $customer_id = $row5['customer_id'];
                                }  
                                $type_customer = $compny_name = $company_phone = $person = $person_mobile = $customer = $contact = '';
                                    $query2 = "SELECT type_customer,company_name,company_phone,person,person_mobile FROM company_customer WHERE id='$customer_id'";
                                    $result2 = mysqli_query($con, $query2);
                                    while ($row2 = mysqli_fetch_array($result2)) {
                                        $type_customer = $row2['type_customer'];
                                        $company_name= $row2['company_name'];
                                        $company_phone = $row2['company_phone'];
                                        $person = $row2['person'];
                                        $person_mobile = $row2['person_mobile'];
                                    }
                                    
                                    if($type_customer==2){
                                        $customer = $company_name;
                                        $contact = $company_phone;
                                    }
                                    else{
                                        $customer = $person;
                                        $contact = $person_mobile;
                                    }

                                
                                     
                                    
                                   
                                echo "<tr><td><center>".$invoice_no . "</center> </td><td><center>".$receipt_no . "</center> </td><td align='left'>" . $customer . "</center> </td><td><center>" . $contact . "</center></td><td align='center'> &nbsp" . $cheque_no . "</td>
                                <td align='left'> " . strtoupper($bank). " </td><td align='center'> ".$cheque_date." </td><td align='right'> ".number_format($amount,2)." </td>";
                                

                                echo "<td align='center'> <a type='button' title='Click to realize the cheque' class='btn btn-default btn-xs confirm_action' href='realize_cheque.php?chequeid=".$cheque_id."'>
																 <span class='glyphicon glyphicon-ok' aria-hidden='true'></span> </a></td>
                                                                                                                                 
                                <td align='center'><a type='button' title='Click to mark the cheque return' class='btn btn-default btn-xs confirm_action' href='return_cheque.php?cid=".$cheque_id."'>
																 <span class='glyphicon glyphicon-remove' aria-hidden='true'></span> </a></td></tr>";  
                                 }
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

<script type="text/javascript">
  $(document).ready(function(){
    var table = $('#data-table').DataTable({
          "order":[],
          "columnDefs":[
          {
            "targets":[4, 5, 6],
            "orderable":false,
          },
        ],
        "pageLength": 25
        });
    $(document).on('click', '.delete', function(){
      var id = $(this).attr("id");
      if(confirm("Are you sure you want to remove this?"))
      {
        window.location.href="invoice.php?delete=1&id="+id;
      }
      else
      {
        return false;
      }
    });
  });

</script>

<script>
$(document).ready(function(){
$('.number_only').keypress(function(e){
return isNumbers(e, this);      
});
function isNumbers(evt, element) 
{
var charCode = (evt.which) ? evt.which : event.keyCode;
if (
(charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
(charCode < 48 || charCode > 57))
return false;
return true;
}
});
</script>
				
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
