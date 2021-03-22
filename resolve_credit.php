<!DOCTYPE html>
<?php
include 'connection.php';
include 'header.php';
// $user = $_SESSION['sess_user_id'];
// $company = $_SESSION['sess_company'];
// ?>
<html>
<head>
    
       <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
        <link rel="stylesheet" href="plugins/iCheck/all.css"> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
         <script type="text/javascript" src="bower_components/TableExport/dist/js/tableexport.js"></script>
<script type="text/javascript" src="bower_components/base64/jquery.base64.js"></script>

        <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
        <link rel="stylesheet" href="plugins/iCheck/all.css">
        <meta content="width=device-width, initial-scale=1, maximum-scal    e=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
        
        <script>
            
  
         <script>
            
//            function submitForm() {

//          var form_data = new FormData(document.getElementById("myform"));
//          form_data.append("label", "WEBUPLOAD");
//          $.ajax({
//              url: "resolve_credit_proc.php",
//              type: "POST",
//              data: form_data,
//              processData: false,  // tell jQuery not to process the data
//              contentType: false   // tell jQuery not to set contentType
//          //}).done(function( data ) {
//            console.log(data);
//          
//            $("#example1").load(window.location + " #example1");
//            $('#cname').val("");
//            $('#br').val("");
//            $('#address').val("");
//            $('#cmobile').val("");
//            $('#email').val("");
//            $('#phone').val("");
//            $('#fax').val("");
//            $('#vat').val("");
//            $('#companyname').val("");
//            $('#country').val("");
//            
//            MessageManager.show(data);
          
         //});
//          return false;     
//        }
            
           var MessageManager = {
        show: function(content) {
        $('#ajaxmsg').html(content);
        setTimeout(function(){
            $('#ajaxmsg').html('');
        }, 3000);
    }
}; 

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
                    <center><strong>SUCCESS!</strong> <?php echo $_GET['msg']; ?><center>
                  </div>
                    <?php }  
        
                    if(isset($_GET['msge'])){ ?>
                    <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <center><strong>FAILED!</strong> <?php echo $_GET['msge']; ?><center>
                    </div>
                    <?php }  ?>
        
        <?php
         
 
    if (isset($_POST['invoiceno'])) {
    $invoice_id = $_POST['invoiceno']; 
//        $invoice_id = 5;
    
        $sql18 = "SELECT id FROM invoice_real WHERE invoice_real_no='$invoice_id' AND company='$company' ";
         $result18 = mysqli_query($con, $sql18);
         $count = mysqli_num_rows( $result18);
         if($count>0){
           
     
    
         $sql18 = "SELECT id,invoice_real_no,net_amount,DATE(date_enter) AS date,customer_id FROM invoice_real WHERE invoice_real_no='$invoice_id'";
            $result18 = mysqli_query($con, $sql18);
            while ($arraySomething18 = mysqli_fetch_array($result18)) {
                $invoice_id = $arraySomething18['id'];
                $invoice_no = $arraySomething18['invoice_real_no'];
                $net_amount = $arraySomething18['net_amount'];
                $entered_date = $arraySomething18['date'];
                $customer_id = $arraySomething18['customer_id'];
    
            $total_paid = 0;    
            $sql9 = "SELECT amount FROM cash_book WHERE invoice_id='$invoice_id' AND stat = '1' AND payment_received='1' ORDER BY id DESC";
            $result9 = mysqli_query($con, $sql9);
            while ($arraySomething9 = mysqli_fetch_array($result9)) {
                $invoice_paid = $arraySomething9['amount'];
                $total_paid = $total_paid + $invoice_paid;
            }

            $due = $net_amount - $total_paid;
         
            }
            
             $total_paid_all = 0;
             
            $sql91 = "SELECT amount FROM cash_book WHERE invoice_id='$invoice_id' AND stat = '1' AND cheque_reject = '0'  ORDER BY id DESC";
            $result91 = mysqli_query($con, $sql91);
            while ($arraySomething91 = mysqli_fetch_array($result91)) {
                $invoice_paid_all = $arraySomething91['amount'];
                $total_paid_all = $total_paid_all + $invoice_paid_all;
            }

            $due_all = $net_amount - $total_paid_all;

           
         ?>   
        
        
      <h1>
        Generate Receipts for Invoice : <?php echo $invoice_no ?>
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Enter Receipt Details</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    
     <div class="box box-primary">
          
         
        
        <!-- /.box-header -->
        
        <form name="myForm" id ="myform" action="resolve_credit_proc.php" 
                 method="POST" target='_blank'>
             
        
          <!-- /.row -->
       
        <!-- /.box-body -->
       <div class="box-header with-border">
           <h3 class="box-title" style="color: green; font-weight: bold">Enter Receipt Details</h3>
          <div class="box-tools pull-right">
          </div>
       </div>
        
        
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label for="exampleInputPassword1"> Invoice Amount </font></label>
                <input type="text" autocomplete="off" name="nic"  value="<?php echo number_format($net_amount,2)?>"class="form-control" id="nic" disabled="">
              </div>
             
              
              <div class="form-group">
                <label for="exampleInputPassword1"> Unsettled Amount </font></label>
                <input type="text" autocomplete="off" name="due"  value="<?php echo number_format($due_all,2)?>"class="form-control" id="nic"  disabled="">
                <input type="hidden" autocomplete="off" name="due"  value="<?php echo $due ?>"class="form-control" id="nic"  >
              </div>
              
              <input type="hidden" name="invoice_id"  value="<?php echo $invoice_id ?>" >
              
                  <div class="form-group">
                <label>Pay Method <font color='red'>*</font></label>
                <select class="form-control select2" style="width: 100%;" name="pay_method" id="pay_method" required>
                <option value=""> SELECT PAY METHOD </OPTION> 
                 <option value="CHEQUE">CHEQUE</OPTION>  
                 <option value="CASH">CASH</OPTION>
                
                </select>   
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Cash Amount </font></label>
                <input type="text" autocomplete="off" name="cash" class="form-control" id="cash" >
                <input type="hidden" autocomplete="off" name="customer_id" value="<?php echo $customer_id?>" >
              </div>
           
            
               
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
                
                <div class="form-group">
                <label for="exampleInputPassword1">Cheque No</label>
                <input type="text" autocomplete="off" name="cheque_no" class="form-control" id="cheque_no" placeholder="Enter Cheque No">
              </div>
             
                 
               
                <div class="form-group">
                                        <label>Bank</label>
                                        <select class="form-control select2" style="width: 100%;" name="cheque_bank" id="cheque_bank" >
                                        
                                              <?php
                                                                      $sql1 = mysqli_query($con,"SELECT id,name FROM banks WHERE stat='1' ORDER BY name ASC");
                                                                      while ($row = mysqli_fetch_array($sql1)) {
                                                                              ?>
                                        <option value=" <?php echo $row['id'] ?> "> <?php echo strtoupper($row['name']) ?> </option>;
                                                                      <?php }
                                                                      ?>
                                        </select>   
                                      </div>
              
              <!-- /.form-group -->
              <div class="form-group">
                <label>Cheque Date</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                  </div>
                    <input type="text" autocomplete="off" data-date-format='yyyy-mm-dd' name="cheque_date" class="form-control pull-right" id="datepicker" >
                </div>  
                
              </div> 
              <div class="form-group">
                <label for="exampleInputPassword1">Cheque Amount</label>
                <input type="text" autocomplete="off" name="cheque_amount" class="form-control" id="cheque_amount" placeholder="Enter Cheque Amount">
              </div>
              
            </div>
           
          </div>
         
        </div>
        
        <div class="box-footer">
        <button type="submit" name ='submit' id="submit" class="btn btn-success">Submit</button>
        </div>
      
       
       
      
                   
     </form> 
        </div>
                        
        
                                                </div>
                                                </div>
                                                </section>
                                                </div>
                                                </div>
           
        <?php
        
        
         }else{
             ?>
             <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <center><strong>FAILED : </strong> <?php echo 'WRONG INVOICE NO. TRY AGAIN !'; ?><center>
                    </div>
           
             <meta http-equiv="refresh" content="3;url=pay_receipt.php" />
             <?php
         }
        
        
        
    }
        ?>
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
      autoclose: true,
    })
     $('#datepicker1').datepicker({
      autoclose: true,
    })
    $('#datepicker2').datepicker({
      autoclose: true,
    })
 
  })
  
  $.fn.datepicker.defaults.autoclose = true;
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
    
    
     $(document).ready(function () {
    var $input = $('input[name=cash]');
    var $input1 = $('input[name=cheque_no]');
    var $input2 = $('input[name=cheque_bank]');
    var $input3 = $('input[name=cheque_date]');
    var $input4 = $('input[name=cheque_amount]');
      $input.attr('disabled', 'disabled');
      $input1.attr('disabled', 'disabled');
     // $input2.attr('disabled', 'disabled');
      $input3.attr('disabled', 'disabled');
      $input4.attr('disabled', 'disabled');
      $('#cheque_bank').prop('disabled', 'disabled');
    $('select[name=pay_method]').on('change', function () {
        $input.attr('disabled', $(this).val() != "CASH");
        $input1.attr('disabled', $(this).val() != "CHEQUE");
        $input2.attr('disabled', $(this).val() != "CHEQUE");
        $input3.attr('disabled', $(this).val() != "CHEQUE");
        $input4.attr('disabled', $(this).val() != "CHEQUE");
       $('#cheque_bank').prop('disabled', $(this).val() != "CHEQUE");
    });
});




</script>
</body>
</html>
