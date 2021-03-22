<!DOCTYPE html>
<?php
include 'connection.php';
include 'header.php';
// $user = $_SESSION['sess_user_id'];
// $company = $_SESSION['sess_company'];
?>
<html>
<head>
      <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
        <link rel="stylesheet" href="plugins/iCheck/all.css">
     <script src="bower_components/jquery/dist/jquery.min.js"></script>

<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>


        
        <script>
            
            function submitForm() {

          var form_data = new FormData(document.getElementById("myform"));
          form_data.append("label", "WEBUPLOAD");
          $.ajax({
              url: "add_new_expense_proc.php",
              type: "POST",
              data: form_data,
              processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
          }).done(function( data ) {
            console.log(data);
          
            $("#example1").load(window.location + " #example1");
            $('#cat1').val("");
            $('#expense_name').val("");
           
            
            
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
        
         <?php
         $sql7 = "SELECT id FROM expenses_types WHERE company='$company' AND stat = '1' ";
         $result7 = mysqli_query($con, $sql7);
         $item_count = mysqli_num_rows($result7)
        
        ?>
        
        
      <h1>
        Add New Expense
        <small><?php echo "Total Expenses Types : ".$item_count; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Generate Expense</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
     <div class="box box-primary">
        <div class="box-header with-border">
           <h3 class="box-title" style="color: green; font-weight: bold">Select Expenses Details</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        
          <form name="myForm" id ="myform" action="" 
                 method="POST" enctype="multipart/form-datam" onsubmit="return submitForm();">
             
        <div class="box-body">
            
          <div class="row">
            <div class="col-md-3">
              
             <div class="form-group">
                <label>Expenses Category<font color='red'> *</font></label>
                <select class="form-control select2" style="width: 100%;" name="cat1" id="cat1" required>
                <option value=""> SELECT EXPENSES CATEGORY </OPTION>
                      <?php
                                              $sql1 = mysqli_query($con,"SELECT id,name FROM expenses_cat1 WHERE stat='1' AND company='$company' ORDER BY name ASC");
                                              while ($row = mysqli_fetch_array($sql1)) {
                                                      ?>
                                                      <option value=" <?php echo $row['id'] ?> "> <?php echo $row['name'] ?> </option>;
                                              <?php }
                                              ?>
                </select>   
              </div>
            </div>
              
            <div class="col-md-9">
               
              <div class="form-group">
                <label for="exampleInputPassword1">Expense Type<font color='red'> *</font></label>
                <input type="text" autocomplete="off" name="expense_name" class="form-control" id="expense_name" placeholder="Enter Expenses Name" required="">
              </div>
            </div>
              
           
              
              
           
               </div>
          
             
          
      </div>
      
          
          
         
        <div class="box-footer">
        <button type="submit" id="submit" class="btn btn-success">SAVE</button>
        </div>
      
        </form>
       
      
        </div>
                        
        
         <div class="row">
                           <div class='col-xs-12'>
                                <div class="box box-primary">
                                    <div class="box-header with-border">
           <h3 class="box-title" style="color: green; font-weight: bold">All Expenses</h3>
          <div class="box-tools pull-right">
          </div>
         </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>

                                                <?php
                                                echo "<tr><th><center> Category Name </center></th><th><center>Type </center></th><th><center> Payee Expense</center></th>
					</tr></tfoot></thead><tbody>";
                                           
                                                $total_stock = 0;
                                             //   $cat1 = $cat2 = $cat3 = $cat4 = 0;
                                                $sql78 = "SELECT id,expences_cat_1_id,expense_name,expense_final FROM expenses_types WHERE stat = '1' AND company='$company' ";
                                                $result78 = mysqli_query($con, $sql78);
                                                    while ($arraySomething78 = mysqli_fetch_array($result78)) {
                                                        $id = $arraySomething78['id'];
                                                        $expences_cat_1_id = $arraySomething78['expences_cat_1_id'];
                                                        $expense_name = $arraySomething78['expense_name'];
                                                        $expense_final = $arraySomething78['expense_final'];
                                                        
                                                        
                                                        
                                                    $sql79 = "SELECT name FROM expenses_cat1 WHERE id='$expences_cat_1_id'";
                                                    $result79 = mysqli_query($con, $sql79);
                                                        while ($arraySomething79 = mysqli_fetch_array($result79)) {
                                                            $name = $arraySomething79['name'];
                                                        }
                                                       
                                                         
                                                         echo "<tr><td align='left'>".$name." </td> <td align='left'>" .  $expense_name . " </td><td align='left'>" .  $expense_final . " </td></tr>";
                                                            }
                                
                                                                        echo "</tbody>  </table>
                                                                                 ";
                                                                        ?>
                                                 </table></div>
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
                'paging': false,
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
