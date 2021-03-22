    <!DOCTYPE html>
<?php
include 'connection.php';
include 'header.php';
// $user = $_SESSION['sess_user_id'];
// $company = $_SESSION['sess_company'];
// $code =   $_SESSION['code_invoice_real'];
?>
<html>
<head>
       

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
            
//            function submitForm() {
//
//          var form_data = new FormData(document.getElementById("myform"));
//          form_data.append("label", "WEBUPLOAD");
//          $.ajax({
//              url: "allinvoices_proc.php",
//              type: "POST",
//              data: form_data,
//              processData: false,  // tell jQuery not to process the data
//              contentType: false   // tell jQuery not to set contentType
//          }).done(function( data ) {
//            console.log(data);
//          
//           $("#example1").load(window.location + " #example1");
//           
//            
//            
//         MessageManager.show(data);
//          
//         });
//          return false;     
//        }
            
//           var MessageManager = {
//        show: function(content) {
//        $('#ajaxmsg').html(content);
//        setTimeout(function(){
//            $('#ajaxmsg').html('');
//        }, 300000);
//    }
//}; 
//        
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
        
                    
        
        
      <h1>
        Generate Receipt
         <small>Enter Invoice no to generate the receipts :<?php echo  $code_invoice_real;?>100023</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Generate Receipts by Invoice NO</li>
      </ol>
    </section>

    <!-- Main content -->
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
        
     
     <div class="box box-primary">
        <div class="box-header with-border">
        

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        
        <form name="myForm"  id ="myform" action="resolve_credit.php" 
                 method="POST" target='_blank'>
             
        <div class="box-body">
            
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Invoice No</label>

                <div class="input-group">
                 
                    <input type="text" autocomplete="off" name="invoiceno" class="form-control pull-right" >
                </div>  
                
              </div>
              
               
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
       
        <div class="box-footer">
        <button type="submit" id="submit" class="btn btn-success">Submit</button>
        </div>
      
        </form>
       
      
        </div>
      
      
       <div id='ajaxmsg'>
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
