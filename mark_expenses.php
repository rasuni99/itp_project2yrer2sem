<!DOCTYPE html>
<?php
include 'header.php';
include 'connection.php';
?>
<head>
    <title></title>
    <meta charset="utf-8">
   
    
     <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
        <script src="bower_components/morris.js/morris.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.js"></script>
        <script src="bower_components/morris.js/examples/lib/example.js"></script>

        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.css">
        <link rel="stylesheet" href="bower_components/morris.js/morris.css">
    
<?php

// $user = $_SESSION['sess_user_id'];
// $company = $_SESSION['sess_company'];
$today = date('Y-m-d');


?>
<html>
<head>
    <script>
        


function get_pay_account() { // Call to ajax function
    var payee_account = $('#payee_account').val();
    var dataString = "payee_account="+payee_account;
    $.ajax({
        type: "POST",
        url: "ajax_mark_expenses.php", // Name of the php files
        data: dataString,
        success: function(html)
        {
            $("#pay_account").html(html);
              
        }
    });
}

function get_subexpense() { // Call to ajax function
    var payee = $('#payee').val();
    var dataString = "payee="+payee;
    $.ajax({
        type: "POST",
        url: "ajax_sub_expenses.php", // Name of the php files
        data: dataString,
        success: function(html)
        {
            $("#expense_sub").html(html);
        }
    });
}

function get_descriptions() { // Call to ajax function
   //  $("#expenses").load(window.location.href + " #expenses" );
     $("#item_table").load(window.location + " #item_table");
//var empty="";
// $("#expenses").html();
    var payee = $('#payee').val();
    var datapayee = "payee="+payee;
    $.ajax({
        type: "POST",
        url: "ajax_expense_descriptions.php", // Name of the php files
        data: datapayee,
        success: function(html)
        {

            $("#expenses").html(html);
            
           
        }
    });
}
    



</script>
    <script>
    var MessageManager = {
            show: function(content) {
            $('#ajaxmsg').html(content);
            setTimeout(function(){
                $('#ajaxmsg').html('');
            }, 6000);
        }
    };
    
    
    var MessageManager1 = {
            show: function(content) {
            $('#ajaxmsg1').html(content);
            setTimeout(function(){
                $('#ajaxmsg1').html('');
            }, 6000);
        }
    }; 
    </script>
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
     
     

 </script>   

</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

            <?php
            include 'headerbar.php';
            ?>
                       
                        <?php
                        include 'sidebar.php';
                        ?>
                     
  

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
        New Expense
      
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
     <div class="box box-primary">
        <div class="box-header with-border">
           <h3 class="box-title" style="color: green; font-weight: bold">Enter Expense Details</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
     <div class="box-body">
                                      
        
         
          <div class="box-body">
              <form method="POST" id="insert_form" name="myform">   
              
           <div class="row">
            <div class="col-md-3">
            <div class="form-group">
                <label>Main Expense<font color='red'> *</font></label>
                <select onchange="get_descriptions(); get_subexpense();" class="form-control select9" style="width: 100%;" name="payee" id="payee" required>
                <option value=""> SELECT EXPENSE </OPTION>
                
             
                      <?php
                                              $sql1 = mysqli_query($con,"SELECT id,name FROM expenses_cat1 WHERE stat='1' AND company='$company' ORDER BY name  ASC");
                                              while ($row = mysqli_fetch_array($sql1)) {
                                                      ?>
                                                      <option value=" <?php echo $row['id'] ?> "> <?php echo $row['name'] ?> </option>;
                                              <?php }
                                              ?>
           
               
                </select>   
              </div>
               </div>
                <div class="col-md-3">
                    <div id='expense_sub'>
                      <div class="form-group">
                                        <label>Sub Expense<font color='red'> *</font></label>
                                        <select class="form-control select12" style="width: 100%;" name="cheque_bank" id="cheque_bank" required="">
                                        <option value=""> SELECT SUB EXPENSE </option>;
                                        
                                        </select>   
                                      </div>
                </div>  </div>  
              <div class="col-md-6">
                   <div class="form-group">
                <label for="exampleInputPassword1"> Payee </font></label>
                <input type="text" autocomplete="off" name="payto" class="form-control" id="payto" >
              </div>
                  </div> </div>
              
                <div class="row">
                 <div class="col-md-2">
                <div class="form-group">
                <label>Payment Date <font color='red'> *</font></label>

                <div class="input-group date">
                  <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                  </div>
                    <input type="text" data-date-format='yyyy-mm-dd' autocomplete="off" name="pay_date" class="form-control pull-right" id="datepicker1" required="">
                </div>  
                
              </div>
                </div>
               
             
              
                <div class="col-md-2">
            <div class="form-group">
                <label>Payment Account<font color='red'> *</font></label>
                <select onchange="get_pay_account()" class="form-control select6" style="width: 100%;" name="payee_account" id="payee_account" required>
                <option value=""> PAY ACCOUNT </OPTION>
                <option value="1"> PETTY CASH </OPTION>
                <option value="2"> CHEQUE </OPTION>
                <option value="3"> THIRD PARTY CHEQUE </OPTION>
              
                </select>
               
              </div>
          
            </div> 
               
                <div class="col-md-3">
                <div class="form-group">
                <label for="exampleInputPassword1"> Ref No </font></label>
                <input type="text" autocomplete="off" name="note" class="form-control" id="note" >
              </div>
              </div>
                     <div class="col-md-5">
                <div class="form-group">
                <label for="exampleInputPassword1"> Note </font></label>
                <input type="text" autocomplete="off" name="refno" class="form-control" id="refno" >
              </div>
              </div>
               </div>
               
              
              <div class='row'>
                  
            <div id='pay_account'>
                  
                  
                  </div>
              
            
      <br> 
         
         
    <div id="expenses">
     <div>
     
    </div>
       
            
              
     
  
  <br>      
			
    </div>  
  </form>         
          
      
                                             
                                         
    

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
<script src="dist/js/adminlte.min.js"></script>
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
    $('.select9').select2()
   
    $('.select6').select2() 
    $('.select3').select2()
    $('.select4').select2() 
    $('.select5').select2() 
     
  

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
        
        
   


</script>
</body>
</html>
