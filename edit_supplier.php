<!DOCTYPE html>
<?php
include 'connection.php';
include 'header.php';
// $user = $_SESSION['sess_user_id'];
// $company = $_SESSION['sess_company'];

if(isset($_GET['id'])){
$id = $_GET['id']; 

?>
<html>
<head>
        <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
        <link rel="stylesheet" href="plugins/iCheck/all.css">
        
        <script>
            
         
            
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
            

            function supplier_check(str) {

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
                        document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                        if (xmlhttp.responseText) {
                            document.getElementById("submit1").disabled = false;
                        } else {
                            document.getElementById("submit1").disabled = false;
                        }
                    }
                }
                xmlhttp.open("GET", "ajax_add_supplier.php?id=" + str, true);
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
         $sql7 = "SELECT id FROM supplier WHERE company='$company' AND stat = '1' ";
         $result7 = mysqli_query($con, $sql7);
         $supplier_count = mysqli_num_rows($result7)
        
        ?>
        
      <h1>
        Edit Supplier
        <small><?php echo "Registered Suppliers : ".$supplier_count; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Supplier</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    
     <div class="box box-primary">
       <div class="box-header with-border">
           <h3 class="box-title" style="color: green; font-weight: bold">Update Supplier Details</h3>
          <div class="box-tools pull-right">
          </div>
       </div>
        <?php
        $sql = "SELECT id,company_name,br_no,company_address,company_phone,company_fax,salutation,person,person_mobile,company_email,country FROM supplier WHERE company='$company' AND id='$id'";
        $result = mysqli_query($con, $sql);
            while ($arraySomething1 = mysqli_fetch_array($result)) {
               
                $company_name = $arraySomething1['company_name'];
                $company_address = $arraySomething1['company_address'];
                $br = $arraySomething1['br_no'];
                $company_phone = $arraySomething1['company_phone'];
                $fax = $arraySomething1['company_fax'];
                $salutation = $arraySomething1['salutation'];
                $person = $arraySomething1['person'];
                $person_mobile = $arraySomething1['person_mobile'];
                $company_email = $arraySomething1['company_email'];
                $country = $arraySomething1['country'];
            }
                                                    ?>
         <form name="myForm" id ="myform" action="edit_supplier.php" method="POST" >
                 
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
               <input type='hidden' name ='id' value='<?php echo $id?>'>
                <label for="exampleInputPassword1">Supplier Name <font color='red'>*</font></label>
                <input type="text" name="companyname"  class="form-control" id="companyname" value='<?php echo $company_name?>' required="">
              </div>
              <div id="txtHint"></div>
              <div class="form-group">
                <label for="exampleInputPassword1">Supplier Phone</label>
                <input type="text" name="phone" class="form-control" id="phone" pattern="[0-9]{10}" title="Invalid Format.Contact No consists of 10 Digits" value='<?php echo $company_phone?>' >
              </div>
              <div class="form-group">
                 <div class="form-group">
                <label for="exampleInputPassword1">Supplier Address</label>
                <input type="text" name="address" class="form-control" id="address" value='<?php echo $company_address?>' >
              </div>
              </div>
               <div class="form-group">
                <label for="exampleInputPassword1">Supplier Fax</label>
                <input type="text" name="fax" class="form-control" id="fax" pattern="[0-9]{10}" title="Invalid Format.Contact No consists of 10 Digits" value='<?php echo $fax?>' >
              </div>
               <div class="form-group">
                <label for="exampleInputPassword1">Supplier Email</label>
                <input type="email" name="email" class="form-control" id="email" value='<?php echo $company_email?>' >
              </div>
             
           
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
                <div class="form-group">
                 <div class="form-group">
                <label for="exampleInputPassword1">BR No</label>
                <input type="text" name="br" onchange="supplier_check(this.value);" class="form-control" id="br" value='<?php echo $br?>' >
              </div>
              </div>
                 
                <div class="form-group">
                <label>Contact Person Salutation </label>
                <select class="form-control select2" style="width: 100%;" name="salutation" id="salutation" >
              
               <option value=""></OPTION>  
                 <option value="MR"> Mr</OPTION>  
                 <option value="MRS"> Mrs </OPTION>
                 <option value="MISS"> Miss </OPTION>
                 <option value="MS"> Ms </OPTION>
                 <option value="DR"> Dr </OPTION>
                 <option value="VEN"> Ven </OPTION>
                </select>   
              </div>
                
                 <div class="form-group">
                <label for="exampleInputPassword1">Contact Person Name</label>
                <input type="text" name="cname" class="form-control" id="cname" value='<?php echo $person?>' >
             </div>
              <div class="form-group">
                 <div class="form-group">
                <label for="exampleInputPassword1">Contact Person Mobile</label>
                <input type="text" name="cmobile" class="form-control" id="cmobile" pattern="[0-9]{10}" title="Invalid Format.Contact No consists of 10 Digits" value='<?php echo $person_mobile ?>' >
              </div>
              </div>
              <!-- /.form-group -->
            
            <div class="form-group">
                <label>Supplier Country </label>
                <select class="form-control select2" style="width: 100%;" name="country" id="country" >
               <?php  ECHO '<option value="'.$country.'"> '.$country.'</OPTION>';  ?>
               <option value=""></OPTION>  
                 <option value="Sri Lanka">Sri Lanka</option> 
                <option value="Afghanistan">Afghanistan</option> 
                <option value="Albania">Albania</option> 
                <option value="Algeria">Algeria</option> 
                <option value="American Samoa">American Samoa</option> 
                <option value="Andorra">Andorra</option> 
                <option value="Angola">Angola</option> 
                <option value="Anguilla">Anguilla</option> 
                <option value="Antarctica">Antarctica</option> 
         
                <option value="Norway">Norway</option> 
                <option value="Oman">Oman</option> 
                <option value="Pakistan">Pakistan</option> 
              
                </select>   
              </div>
             
              
            </div>
           
          </div>
         
        </div>
        
        <div class="box-footer">
        <button type="submit" id="submit" class="btn btn-success">Submit</button>
        </div>
                
     </form> 
        </div>
                        
  <?php
}

?>       
                                                </div>
                                                </div>
                                                </section>
                                                </div>
                                                </div>
    <?php   if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
                        $company = STRTOUPPER($_POST['companyname']);
                        $phone = $_POST['phone'];
                        $address = STRTOUPPER($_POST['address']);
                        $fax = $_POST['fax'];
                        $email = $_POST['email'];
                        $br = $_POST['br'];
                        $salutation = STRTOUPPER($_POST['salutation']);
                        $name = STRTOUPPER($_POST['cname']);
                        $cmobile = $_POST['cmobile'];
                        $country = $_POST['country'];
                        $id = $_POST['id'];
                        
                        $sql = "UPDATE supplier SET company_name='$company',br_no='$br',company_phone='$phone',company_fax='$fax',company_address='$address',person='$name',person_mobile='$cmobile',salutation='$salutation',company_email='$email',country='$country' WHERE id='$id'";
                        if (mysqli_query($con, $sql)) {
                            
                            $sql1 ="INSERT INTO user_activity (user,activity) VALUES ('$user','SUPPLIER DETAILS UPDATED ID :$id ')";
                            mysqli_query($con, $sql1);
                             echo "<script>window.location = 'supplier_register.php?msg=SUPPLIER DETAILS UPDATED ! ';</script>";
                            
                            
                        } else {
                            echo "<script>window.location = 'supplier_register.php?msge=UPDATING SUPPLIER DETAILS FAILED ! CONTACT ADMINISTRATOR ';</script>";
                        }
                    }
                    ?>     
        
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
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
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
