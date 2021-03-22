<?php
include 'connection.php';
include 'header.php';
 // $user = $_SESSION['sess_user_id'];
 // $company = $_SESSION['sess_company'];
 
 //Comany name
  $sql2 = "SELECT name FROM company WHERE id='$company' AND stat = '1'";
    $result2 = mysqli_query($con, $sql2);
        while ($arraySomething2 = mysqli_fetch_array($result2)) {
            $companyname = $arraySomething2['name'];
        }

 
 
 
?>

 <script>
            
            function submitForm() {

          var form_data = new FormData(document.getElementById("myform"));
          form_data.append("label", "WEBUPLOAD");
          $.ajax({
              url: "add_bank_account_company_proc.php",
              type: "POST",
              data: form_data,
              processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
          }).done(function( data ) {
            console.log(data);
          
            $("#example1").load(window.location + " #example1");
            $('#accname').val("");
            $('#accno').val("");
            
            
            MessageManager.show(data);
          
         });
          return false;     
        }
            
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

<html>
    <head>
        <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
        <link rel="stylesheet" href="plugins/iCheck/all.css">

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
                 <section class="content-header">
                     
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
                     
                       <div id='ajaxmsg'>
                    </div>
                <h1>
                 Add Company's Bank Account (Own Accounts)   
                </h1>
                <ol class="breadcrumb">
                  <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active"> Add Bank Accounts     </li>
                </ol>
                 </section>
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-3">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>Enter Account Details </strong></h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                 <form name="myForm" id ="myform" action="" 
                 method="POST" enctype="multipart/form-datam" onsubmit="return submitForm();">
                               
                                    <div class="box-body">
                                       <input type="hidden" name="acctype" value="COMPANY">
                                        
                                         <div class="form-group">
                                            <label for="exampleInputPassword1">Account Name</label>
                                            <input type="text" autocomplete="off" name="accowner" class="form-control" id="accname" placeholder="Enter the Account Owner Name" required>
                                        </div>
                                      <div class="form-group">
                                        <label>Bank</label>
                                        <select class="form-control select2" style="width: 100%;" name="bank" id="bank" required>
                                        
                                              <?php
                                                                      $sql1 = mysqli_query($con,"SELECT id,name FROM banks WHERE stat='1' ORDER BY name ASC");
                                                                      while ($row = mysqli_fetch_array($sql1)) {
                                                                              ?>
                                        <option value=" <?php echo $row['id'] ?> "> <?php echo strtoupper($row['name']) ?> </option>;
                                                                      <?php }
                                                                      ?>
                                        </select>   
                                      </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Account No</label>
                                            <input type="text" autocomplete="off" name="accno" class="form-control" id="accno" placeholder="Enter the Account No" required>
                                        </div>
                                       

                                         <div class="box-footer">
        <button type="submit" id="submit" class="btn btn-success">Submit</button>
        </div>
                                </form>
                            </div>
                        </div> 
                    </div> 



                    <?php
//                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//
//                        $bank = $_POST['bank'];
//                        $acctype = $_POST['acctype'];
//                        $accno = $_POST['accno'];
//                        $accowner = 0;
//                        $accname = $_POST['accowner'];;
//                        
//                         
//                            $sql1 = "INSERT INTO bank_accounts (bank,owner,acc_name,type,account_no,company,user) VALUES 
//									('$bank','$accowner','$accname','$acctype','$accno','$company',$user)";   
//                        
//                        
//                        if (mysqli_query($con, $sql1)) {
//                            
//                            
//                            echo '<script language="javascript">';
//                            echo 'alert("BANK ACCOUNT ADDED SUCCESSFULLY !")';
//                            echo '</script>';
//                        } else {
//                            echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
//                        }
//                    }
                    ?>



                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><strong>All Bank Accounts - Company own </strong></h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>

                                                <?php
                                                echo "<tr><th><center> Owner <center></th> 
					<th><center> Bank <center></th> 
					<th><center> Account No <center></th>
					
                                        <th><center>Actions<center></th>
					</tr><t/foot></thead><tbody>";


                                                $sql = "SELECT id,acc_name,bank,account_no FROM bank_accounts WHERE type='COMPANY' AND company='$company' AND stat = '1' ORDER BY bank ASC";
                                                $result = mysqli_query($con, $sql);
                                                    while ($arraySomething1 = mysqli_fetch_array($result)) {
                                                        $id = $arraySomething1['id'];
                                                        $bankid = $arraySomething1['bank'];
                                                        $accountno = $arraySomething1['account_no'];
                                                        $owner = $arraySomething1['acc_name'];
                                                     
                                                             
                                                              
                                                             $sql1 = "SELECT name FROM banks WHERE id='$bankid'";
                                                             $result1 = mysqli_query($con, $sql1) ;

                                                                while ($arraySomething11 = mysqli_fetch_array($result1)) {        
                                                                  $bank = $arraySomething11['name'];
        
                                                                                echo "<tr> <td> &nbsp" . $owner . " </td>
                                                                <td> &nbsp" . strtoupper($bank) . " </td>
                                                                <td> &nbsp" . $accountno . " </td>
                                                                
                                                                 <td align='center'><a type='button'  class='btn btn-default btn-xs confirm_action' href='delete_bankaccount_company.php?account_id=".$id. "&bank=" . $bank."'>
																 <span class='glyphicon glyphicon-remove' aria-hidden='true'></span> </a></td>
                                                               ";
                                                                            }
                                                                            
                                                                        } 
                                                                                                    
                                                                        echo "</tbody></table>
                                                                                 ";
                                                                        ?>
                                                                        </div>
                                                                        </div>
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
    //Flat red color scheme or iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })


</script>
</body>
</html>
