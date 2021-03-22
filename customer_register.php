<!DOCTYPE html>
<?php
include 'connection.php';
include 'header.php';
// $user = $_SESSION['sess_user_id'];
// $company = $_SESSION['sess_company'];
?>
<html>
<head>
    
    <style>
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}
        
    </style>
        <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
        <link rel="stylesheet" href="plugins/iCheck/all.css">
        
        <script>
            
            function submitForm() {

          var form_data = new FormData(document.getElementById("myform"));
          form_data.append("label", "WEBUPLOAD");
          $.ajax({
              url: "customer_reg_proc.php",
              type: "POST",
              data: form_data,
              processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
          }).done(function( data ) {
            console.log(data);
          
            $("#example1").load(window.location + " #example1");
           
            $('#name').val("");
            $('#nic').val("");
            $('#address').val("");
            $('#mobile').val("");
            $('#email').val("");
            $('#recidence').val("");
            $('#creditlimit').val("");
            
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
               

            function nic_check(str) {

                document.getElementById("txtHint").innerHTML = "";
                if (str == "") {
                    document.getElementById("txtHint").innerHTML = "";
                    return;
                }
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        //document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                        MessageManager.show(xmlhttp.responseText);
                        if (xmlhttp.responseText) {
                            document.getElementById("submit").disabled = false;
                        } else {
                            document.getElementById("submit").disabled = false;
                        }
                    }
                }
                xmlhttp.open("GET", "ajax_add_customer.php?id=" + str, true);
                xmlhttp.send();
            }


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
         $sql7 = "SELECT id FROM company_customer WHERE (type_customer='0' OR type_customer='1' ) AND company='$company' AND stat = '1' ";
         $result7 = mysqli_query($con, $sql7);
         $customer_count = mysqli_num_rows($result7)
        
        ?>
        
      <h1>
        Register Individual Customer
        <small><?php echo "Registered Customers : ".$customer_count; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Enter Customer Details</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    
     <div class="box box-primary">
          
        
        <!-- /.box-header -->
        
        <form name="myForm" id ="myform" action="" 
                 method="POST" enctype="multipart/form-datam" onsubmit="return submitForm();">
             
        
          <!-- /.row -->
       
        <!-- /.box-body -->
       <div class="box-header with-border">
           <h3 class="box-title" style="color: green; font-weight: bold">Enter Customer Details</h3>
          <div class="box-tools pull-right">
          </div>
       </div>
        
        
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label for="exampleInputPassword1">NIC / Passport </label>
                <input type="text" autocomplete="off" name="nic" onchange="nic_check(this.value);" class="form-control" id="nic" placeholder="Enter Customer's NIC " >
              </div>
              <div id="txtHint"></div>
              
               <div class="form-group">
                <label>Customer Type <font color='red'>*</font></label>
                <select class="form-control select2" style="width: 100%;" name="type" id="type" required>
                <option value=""> SELECT CUSTOMER TYPE </OPTION>
                <option value="3"> CASH/CREDIT CUSTOMER </OPTION>
                 <option value="1"> CASH CUSTOMER</OPTION>  
                 <option value="0"> CREDIT CUSTOMER </OPTION> 
                </select>   
              </div>
                  <div class="form-group">
                <label>Salutation <font color='red'>*</font></label>
                <select class="form-control select2" style="width: 100%;" name="salutation" id="salutation" required>
                <option value=""> SELECT SALUTATION </OPTION> 
                 <option value="MR"> Mr</OPTION>  
                 <option value="MRS"> Mrs </OPTION>
                 <option value="MISS"> Miss </OPTION>
                 <option value="MS"> Ms </OPTION>
                 <option value="DR"> Dr </OPTION>
                 <option value="VEN"> Ven </OPTION>
                </select>   
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Name <font color='red'>*</font></label>
                <input type="text" autocomplete="off" name="name" class="form-control" id="name" placeholder="Enter Customer's Name" required>
              </div>
           
            
               
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
                
                <div class="col-md-6">
                <div class="form-group">
                <label>Price Below MSP <font color='red'>*</font></label>
                <select class="form-control select2" style="width: 100%;" name="msp" id="msp" required>
                <option value=""> SELECT MSP LEVEL </OPTION>
                <option value="1"> YES </OPTION>
                 <option value="0"> NO</OPTION>  
                
                </select>   
              </div></div>
                 
               <div class="col-md-6">
                <div class="form-group">
                <label for="exampleInputPassword1">Email</label>
                <input type="email" autocomplete="off" name="email" class="form-control" id="email" placeholder="Enter Customer's Email">
              </div>
               </div>
             
                 
               
                 <div class="form-group">
                <label for="exampleInputPassword1">Address</label>
                <input type="text" autocomplete="off" name="address" class="form-control" id="address" placeholder="Enter Customer's Address">
              </div>
              
              <!-- /.form-group -->
              <div class="form-group">
                <label for="exampleInputPassword1">Mobile</label>
                <input type="text" autocomplete="off" name="mobile" class="form-control" id="mobile" pattern="[0-9]{10}" title="Invalid Format.Contact No consists of 10 Digits" placeholder="Enter Customer's Mobile No">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Home Contact</label>
                <input type="text" autocomplete="off" name="recidence" class="form-control" id="recidence" pattern="[0-9]{10}" title="Invalid Format.Contact No consists of 10 Digits" placeholder="Enter Customer's Contact No">
              </div>
              
            </div>
           
          </div>
         
        </div>
        
        <div class="box-footer">
        <button type="submit" name ='submit' id="submit" class="btn btn-success">Submit</button>
        </div>
      
       
       
      
                   
     </form> 
        </div>
                        
        
         <div class="row">
                           <div class='col-xs-12'>
                                <div class="box box-primary">
                                    <div class="box-header with-border">
           <h3 class="box-title" style="color: green; font-weight: bold">Registered Customers</h3>
          <div class="box-tools pull-right">
          </div>
         </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table id="example1" class="table table-bordered ">
                                            <thead>

                                                <?php
                                                echo "<tr><th><center> NIC </center></th><th><center> Name </center></th><th><center> Type </center></th><th><center> Address </center></th><th><center> Mobile </center></th>
					<th><center> Email</center></th><th><center> Actions</center></th>
					</tr></tfoot></thead><tbody>";
                                           
                                                $type = 0;
                                                
                                                $sql = "SELECT id,type_customer,nic,salutation,person,person_mobile,company_address,company_email FROM company_customer WHERE (type_customer='0' OR type_customer='1' OR type_customer='3'  ) AND company='$company' AND stat = '1' ORDER BY id ASC";
                                                $result = mysqli_query($con, $sql);
                                                    while ($arraySomething1 = mysqli_fetch_array($result)) {
                                                        $id = $arraySomething1['id'];
                                                        $nic1 = $arraySomething1['nic'];
                                                        $email1 = $arraySomething1['company_email'];
                                                        $address1 = $arraySomething1['company_address'];
                                                        $salutation1 = $arraySomething1['salutation'];
                                                        $name1 = $arraySomething1['person'];
                                                        $mobile1 = $arraySomething1['person_mobile'];
                                                        $type = $arraySomething1['type_customer'];
                                                        
                                                        if($type==0){
                                                                $type_customer1 = "CREDIT";
                                                                $color='#99ddff';
                                                        }else if($type==1){
                                                            $type_customer1 = "CASH";
                                                            $color = "#aaff80";
                                                        }
                                                        else{
                                                            $type_customer1 = "CASH/CREDIT";
                                                            $color = "#FFFFFF";
                                                        }
                                                       
                                                         echo "<tr><td> &nbsp" .  $nic1 . " </td><td> &nbsp" . $salutation1." ".$name1. " </td><td> &nbsp" . $type_customer1. " </td><td>" . $address1 . "</td><td> <center>" . $mobile1 . "</center> </td>
                                                                <td> &nbsp" . $email1 . " </td>";
                                                                                
                                                               
                                                                   echo "<td align='center'><a type='button' title='Click to edit the Customer Details' class='btn btn-default btn-xs confirm_action' href='edit_customer.php?id=".$id."'>
																 <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> </a><a type='button' title='Click to remove the Customer' class='btn btn-default btn-xs confirm_action' href='delete_customer.php?id=".$id."'>
																 <span class='glyphicon glyphicon-remove' aria-hidden='true'></span> </a></td>";  
                                                            }

                                                        
                                                                                                    
                                                                        echo "</tbody>  <tfoot>
                                        <tr><th><center> NIC </center></th><th><center> Name </center></th><th><center> Type </center></th><th><center> Address </center></th><th><center> Mobile </center></th>
					<th><center> Email</center></th><th><center> Actions</center></th>
					</tr>
                                        </tfoot>
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
