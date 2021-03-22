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
                        document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                        if (xmlhttp.responseText) {
                            document.getElementById("submit1").disabled = false;
                        } else {
                            document.getElementById("submit1").disabled = false;
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
         $sql7 = "SELECT id FROM company_customer WHERE company='$company' AND stat = '1' AND (type_customer=1 or type_customer=0)";
         $result7 = mysqli_query($con, $sql7);
         $customer_count = mysqli_num_rows($result7)
        
        ?>
        
      <h1>
        Edit Customer
        <small><?php echo "Registered Customers : ".$customer_count; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Customer</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    
     <div class="box box-primary">
      
       <div class="box-header with-border">
           <h3 class="box-title" style="color: green; font-weight: bold">Update Customer Details</h3>
          <div class="box-tools pull-right">
          </div>
       </div>
        <?php
        $sql = "SELECT type_customer,nic,salutation,person,person_mobile,company_address,company_email,company_phone,low_min_sale_price FROM company_customer WHERE company='$company' AND id='$id'";
        $result = mysqli_query($con, $sql);
            while ($arraySomething1 = mysqli_fetch_array($result)) {
                $nic = $arraySomething1['nic'];
                $email = $arraySomething1['company_email'];
                $address = $arraySomething1['company_address'];
                $salutation = $arraySomething1['salutation'];
                $name = $arraySomething1['person'];
                $mobile = $arraySomething1['person_mobile'];
                $recidence = $arraySomething1['company_phone'];
                $type = $arraySomething1['type_customer'];
                $below_msp = $arraySomething1['low_min_sale_price'];
                
                if($below_msp==1){
                    $below_msp_name = "YES";
                }
                else{
                    $below_msp_name = "NO";
                }
                
                
                 if($type==0){
                    $type_customer1 = "CREDIT";
                 }else if($type==1){
                    $type_customer1 = "CASH";
                     }
                     else {
                         $type_customer1 = "CASH/CREDIT";
                     }
            }
        ?>
        
        <form name="myForm" id ="myform" action="edit_customer.php" 
                 method="POST" >
            
            <input type='hidden' name ='id' value='<?php echo $id?>'>
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label for="exampleInputPassword1">NIC / Passport <font color='red'>*</font></label>
                <input type="text" autocomplete="off" name="nic" onchange="nic_check(this.value);" class="form-control" id="nic" value="<?php echo $nic?>">
              </div>
              <div id="txtHint"></div>
              
              <div class="form-group">
                <label>Customer Type <font color='red'>*</font></label>
                <select class="form-control select2" style="width: 100%;" name="type" id="type" required>
                    <?php  ECHO '<option value="'.$type.'"> '.$type_customer1.'</OPTION>';  ?>
               <option value=""></OPTION>  
                <option value=""> SELECT CUSTOMER TYPE </OPTION>
                <option value="3"> CASH/CREDIT CUSTOMER</OPTION>  
                 <option value="1"> CASH CUSTOMER</OPTION>  
                 <option value="0"> CREDIT CUSTOMER </OPTION>
                </select>   
              </div>
              
              <div class="form-group">
                <label>Salutation <font color='red'>*</font></label>
                <select class="form-control select2" style="width: 100%;" name="salutation" id="salutation" required>
                    <?php  ECHO '<option value="'.$salutation.'"> '.$salutation.'</OPTION>';  ?>
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
                <label for="exampleInputPassword1">Name <font color='red'>*</font></label>
                <input type="text" autocomplete="off" name="name" class="form-control" id="name" value="<?php echo $name?>">
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-6">
                <div class="col-md-6">
                <div class="form-group">
                <label for="exampleInputPassword1">Email</label>
                <input type="email" autocomplete="off" name="email" class="form-control" id="email" value="<?php echo $email?>">
              </div>
            </div>
                
              <div class="col-md-6">
             <div class="form-group">
                <label>Price Below MSP <font color='red'>*</font></label>
                <select class="form-control select2" style="width: 100%;" name="msp" id="msp" required>
                    <?php  ECHO '<option value="'.$below_msp.'"> '.$below_msp_name.'</OPTION>';  ?>
               <option value=""></OPTION>  
                <option value=""> SELECT MSP LEVEL </OPTION>
                <option value="0"> NO</OPTION>  
                 <option value="1"> YES</OPTION>  
                
                </select>   
              </div>     
             </div>     
                  
                  
              <div class="form-group">
                <label for="exampleInputPassword1">Address</label>
                <input type="text" autocomplete="off" name="address" class="form-control" id="address" value="<?php echo $address?>">
              </div>
             
              <!-- /.form-group -->
              <div class="form-group">
                <label for="exampleInputPassword1">Mobile</label>
                <input type="text" autocomplete="off" name="mobile" class="form-control" id="mobile" pattern="[0-9]{10}" title="Invalid Format.Contact No consists of 10 Digits" value="<?php echo $mobile?>">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Home Contact</label>
                <input type="text" autocomplete="off" name="recidence" class="form-control" id="recidence" pattern="[0-9]{10}" title="Invalid Format.Contact No consists of 10 Digits" value="<?php echo $recidence?>">
              </div>
             
             
              
            </div>
           
          </div>
         
        </div>
        
        <div class="box-footer">
        <button type="submit" name ='edit' id="submit" class="btn btn-success">Update</button>
        </div>
      
       
       
      
                   
     </form> 
        </div>
                        
         </section>
         
 <?php
}

?>                                               </div>
                                                </div>
    <?php
           if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
                        $id = $_POST['id'];
                        $nic = STRTOUPPER($_POST['nic']);
                        $nic = str_replace(' ', '', $nic);
                        $salutation = STRTOUPPER($_POST['salutation']);
                        $name = STRTOUPPER($_POST['name']);
                        $address = STRTOUPPER($_POST['address']);
                        $mobile = $_POST['mobile'];
                        $email = $_POST['email'];
                        $recidence = $_POST['recidence'];
                        $type = $_POST['type'];
                        $msp = $_POST['msp'];
                        
                        
                       
                        
                        $sql = "UPDATE  company_customer SET type_customer='$type',nic='$nic',salutation='$salutation',person='$name',company_address='$address',person_mobile='$mobile',company_phone='$recidence',company_email='$email',low_min_sale_price='$msp' WHERE id='$id'";
                        if (mysqli_query($con, $sql)) {
                            
                            $sql1 ="INSERT INTO user_activity (user,activity) VALUES ('$user','CUSTOMER DETAILS UPDATED ID :$id ')";
                            mysqli_query($con, $sql1);
                             echo "<script>window.location = 'customer_register.php?msg=CUSTOMER DETAILS UPDATED ! ';</script>";
                            
                            
                        } else {
                            echo "<script>window.location = 'customer_register.php?msge=UPDATING CUSTOMER DETAILS FAILED ! CONTACT ADMINISTRATOR ';</script>";
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

