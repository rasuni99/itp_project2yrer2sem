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
        
        <script>
            
            function submitForm() {

          var form_data = new FormData(document.getElementById("myform"));
          form_data.append("label", "WEBUPLOAD");
          $.ajax({
              url: "company_reg_proc.php",
              type: "POST",
              data: form_data,
              processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
          }).done(function( data ) {
            console.log(data);
          
            $("#example1").load(window.location + " #example1");
            $('#cname').val("");
            $('#br').val("");
            $('#address').val("");
            $('#cmobile').val("");
            $('#email').val("");
            $('#phone').val("");
            $('#fax').val("");
            $('#companyname').val("");
            $('#vat_no').val("");
            
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
             

            function company_check(str) {

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
                            document.getElementById("submit1").disabled = false;
                        } else {
                            document.getElementById("submit1").disabled = false;
                        }
                    }
                }
                xmlhttp.open("GET", "ajax_add_company.php?id=" + str, true);
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
         $sql7 = "SELECT id FROM company_customer WHERE type_customer='2' AND company='$company' AND stat = '1' ";
         $result7 = mysqli_query($con, $sql7);
         $company_count = mysqli_num_rows($result7)
        
        ?>
        
      <h1>
        Register Company Customer
        <small><?php echo "Registered Companies : ".$company_count; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Enter Company Details</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    
     <div class="box box-primary">
          
        
        <!-- /.box-header -->
        
          <form name="myForm" id ="myform" action="" 
                 method="POST" enctype="multipart/form-data" onsubmit="return submitForm();">
             
        
          <!-- /.row -->
       
        <!-- /.box-body -->
       <div class="box-header with-border">
           <h3 class="box-title" style="color: green; font-weight: bold">Enter Company Details</h3>
          <div class="box-tools pull-right">
          </div>
       </div>
        
        
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label for="exampleInputPassword1">Company Name <font color='red'>*</font></label>
                <input type="text" autocomplete="off" name="companyname"  class="form-control" id="companyname" placeholder="Enter Company Name" required>
              </div>
              <div id="txtHint"></div>
              <div class="form-group">
                <label for="exampleInputPassword1">Company Phone</label>
                <input type="text" autocomplete="off" name="phone" class="form-control" id="phone" pattern="[0-9]{10}" title="Invalid Format.Contact No consists of 10 Digits" placeholder="Enter Company Phone No">
              </div>
              <div class="form-group">
                 <div class="form-group">
                <label for="exampleInputPassword1">Company Address</label>
                <input type="text" autocomplete="off" name="address" class="form-control" id="address" placeholder="Enter Company's Address">
              </div>
              </div>
               <div class="form-group">
                <label for="exampleInputPassword1">Company Fax</label>
                <input type="text" autocomplete="off" name="fax" class="form-control" id="fax" pattern="[0-9]{10}" title="Invalid Format.Contact No consists of 10 Digits" placeholder="Enter Company Fax No">
              </div>
               <div class="form-group">
                <label for="exampleInputPassword1">Company Email</label>
                <input type="email" autocomplete="off" name="email" class="form-control" id="email" placeholder="Enter Company's Email">
              </div>
             
           
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
                <div class="col-md-6">
                <div class="form-group">
                 <div class="form-group">
                <label for="exampleInputPassword1">Business Registration No</label>
                <input type="text" autocomplete="off" name="br" class="form-control" onchange="company_check(this.value);" id="br" placeholder="Enter Company's BR Number">
              </div>
              </div></div>
                
                 <div class="col-md-6">
                <div class="form-group">
                <label>Price Below MSP <font color='red'>*</font></label>
                <select class="form-control select2" style="width: 100%;" name="msp" id="msp" required>
                <option value=""> SELECT MSP LEVEL </OPTION>
                <option value="1"> YES </OPTION>
                 <option value="0"> NO</OPTION>  
                
                </select>   
              </div></div>
                
                 <div class="form-group">
                  <div class="form-group">
                <label>Contact Person Salutation </label>
                <select class="form-control select2" style="width: 100%;" name="salutation" id="salutation" >
                <option value=""> SELECT SALUTATION </OPTION> 
                 <option value="MR"> Mr</OPTION>  
                 <option value="MRS"> Mrs </OPTION>
                 <option value="MISS"> Miss </OPTION>
                 <option value="MS"> Ms </OPTION>
                 <option value="DR"> Dr </OPTION>
                 <option value="VEN"> Ven </OPTION>
                </select>   
              </div>
                <label for="exampleInputPassword1">Contact Person Name</label>
                <input type="text" autocomplete="off" name="cname" class="form-control" id="cname" placeholder="Enter Contact Person's Name" >
              </div>
              <div class="form-group">
                 <div class="form-group">
                <label for="exampleInputPassword1">Contact Person Mobile</label>
                <input type="text" autocomplete="off" name="cmobile" class="form-control" id="cmobile" pattern="[0-9]{10}" title="Invalid Format.Contact No consists of 10 Digits" placeholder="Enter Contact Person's Mobile No">
              </div>
              </div>
              <!-- /.form-group -->
            
              <div class="form-group">
                <label for="exampleInputPassword1">VAT No</label>
                <input type="text" autocomplete="off" name="vat_no" class="form-control" id="vat_no" placeholder="Enter VAT Registrered No (Leave blank if not Registered)" >
              </div>
             
              
            </div>
           
          </div>
         
        </div>
        
        <div class="box-footer">
        <button type="submit" id="submit" class="btn btn-success">Submit</button>
        </div>
      
       
       
      
                   
     </form> 
        </div>
                        
        
         <div class="row">
                           <div class='col-xs-12'>
                                <div class="box box-primary">
                                    <div class="box-header with-border">
           <h3 class="box-title" style="color: green; font-weight: bold">Registered Companies</h3>
          <div class="box-tools pull-right">
          </div>
         </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>

                                                <?php
                                                echo "<tr><th><center> Company # </center></th><th><center> Company </center></th><th><center> Address </center></th><th><center> Phone </center></th><th><center>Fax</center></th><th><center> Contact Person </center></th><th><center> Mobile </center></th>
					<th><center> VAT #</center></th><th><center> Actions</center></th>
					</tr></tfoot></thead><tbody>";
                                           
                                                $credit_limit1 = 0;
                                                $sql = "SELECT id,company_name,company_address,company_phone,company_fax,salutation,person,person_mobile,vat_no FROM company_customer WHERE company='$company' AND stat = '1' AND type_customer='2' ORDER BY company_name ASC";
                                                $result = mysqli_query($con, $sql);
                                                    while ($arraySomething1 = mysqli_fetch_array($result)) {
                                                        $id = $arraySomething1['id'];
                                                        $company_name1 = $arraySomething1['company_name'];
                                                        $company_address1 = $arraySomething1['company_address'];
                                                        $company_phone1 = $arraySomething1['company_phone'];
                                                        $fax1 = $arraySomething1['company_fax'];
                                                        $salutation1 = $arraySomething1['salutation'];
                                                        $person1 = $arraySomething1['person'];
                                                        $person_mobile1 = $arraySomething1['person_mobile'];
                                                        $vat_no = $arraySomething1['vat_no'];
                                                       
                                                        $id1 = $id + 100000;  
                                                         echo "<tr><td> <center>B" . $id1 . " </center></td> <td> &nbsp" .  $company_name1 . " </td><td> &nbsp" . $company_address1. " </td><td>" . $company_phone1 . "</td><td> <center>" . $fax1 . "</center> </td>
                                                                <td> &nbsp" . $salutation1." ". $person1 . " </td><td> &nbsp" . $person_mobile1 . " </td><td align='right'> &nbsp" . $vat_no . " </td>";
                                                                                
                                                               
                                                                   echo "<td align='center'><a type='button' title='Click to Edit the Company Details' class='btn btn-default btn-xs confirm_action' href='edit_company.php?id=".$id."'>
																 <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> </a><a type='button' title='Click to remove the Company' class='btn btn-default btn-xs confirm_action' href='delete_company.php?id=".$id."'>
																 <span class='glyphicon glyphicon-remove' aria-hidden='true'></span> </a></td>";  
                                                            }

                                                        
                                                                                                    
                                                                        echo "</tbody>  <tfoot>
                                        <tr><th><center> Company </center></th><th><center> Address </center></th><th><center> Phone </center></th><th><center>Fax</center></th><th><center> Contact Person </center></th><th><center> Mobile </center></th>
					<th><center> Credit Limit</center></th><th><center> Actions</center></th>
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
