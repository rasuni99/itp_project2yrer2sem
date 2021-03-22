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
        
                    <?php 
                    
                    
                     if (isset($_GET['id'])) {

                    $id = $_GET['id'];
                    
                    $job_company="";
                    $sql3 = "SELECT id,company FROM grn WHERE id='$id' AND stat='1' ";
                            $result3 = mysqli_query($con, $sql3);
                            while ($arraySomething3 = mysqli_fetch_array($result3)) {
                            $job_company = $arraySomething3['company'];
                            }
                            
                    
                    }
                    
                    if($company == $job_company) {
                   
                     ?> 
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
             
                                                $total_price = 0;
                                                $sql18 = "SELECT id,grn_no,supplier_id,date,invoice_no,total_price,user FROM grn WHERE id='$id'";
                                                $result18 = mysqli_query($con, $sql18);
                                                    while ($arraySomething18 = mysqli_fetch_array($result18)) {
                                                        $id = $arraySomething18['id'];
                                                        $grn_no = $arraySomething18['grn_no'];
                                                        $supplier_id = $arraySomething18['supplier_id'];
                                                        $date = $arraySomething18['date'];
                                                        $invoice_no = $arraySomething18['invoice_no'];
                                                        $total_price = $arraySomething18['total_price'];
                                                        $user = $arraySomething18['user'];
                                                        
                                                      
                                                        $sql3 = "SELECT company_name FROM supplier WHERE id='$supplier_id'";
                                                        $result3 = mysqli_query($con, $sql3);
                                                        while ($arraySomething3 = mysqli_fetch_array($result3)) {
                                                        $supplier_name = $arraySomething3['company_name'];
                                                        }
                                                        
                                                        $sql31 = "SELECT name FROM users WHERE id='$user'";
                                                        $result31 = mysqli_query($con, $sql31);
                                                        while ($arraySomething31 = mysqli_fetch_array($result31)) {
                                                        $user_name = $arraySomething31['name'];
                                                        }
                                                    }                             
             
                                                      ?>  
        
     
      <h1>
       GRN Details : <?php echo $grn_no; ?>
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View GRN</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
<div class="box box-primary">
         <div class="box-header with-border">
        
          <div class="box-tools pull-right">
          </div>
       </div>
      <div class="box-body">
          <div class="row">
     
       
             <div class="col-md-6">
             <div class="form-group">
                <label for="exampleInputPassword1">Supplier</label>
                <input type="text" name="grnprice" class="form-control" id="grnprice" value='<?php echo $supplier_name?>' disabled="">
              </div>
                
            <div class="form-group">
            <label for="exampleInputPassword1">GRN Total (LKR)</label>
            <input type="text" name="grnprice" class="form-control" id="grnprice" value='<?php echo number_format($total_price) ?>' disabled="">
            </div>


             <div class="form-group">
             <label for="exampleInputPassword1">GRN User</label>
             <input type="text" name="supplierinvoiceno" class="form-control" id="supplierinvoiceno" value='<?php echo $user_name ?>' disabled="">
             </div>   
              
                 
            </div>
            <!-- /.col -->
            <div class="col-md-6">

                <div class="form-group">
                <label for="exampleInputPassword1">GRN Date</label>
                <input type="text" name="grnprice" class="form-control" id="grnprice" value='<?php echo $date ?>' disabled="">
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Supplier Invoice No</label>
                <input type="text" name="supplierinvoiceno" class="form-control" id="supplierinvoiceno" value='<?php echo $invoice_no ?>' disabled="">
              </div>
                
                <div class="form-group">
                <label for="exampleInputPassword1">GRN No</label>
                <input type="text" name="supplierinvoiceno" class="form-control" id="supplierinvoiceno" value='<?php echo $grn_no ?>' disabled="">
              </div>
               
             </div>   
           </div>     
                <div class="row">
                        <div class='col-xs-12'>
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                       
                                       <div class="box-tools pull-right">
                                       </div>
                                       </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table id="example" class="table table-bordered table-striped">
                                            <thead>

                                               
                                                 <?php
                                                // echo $id;
                                                echo "<tr><th><center> # </center><th><center> Item </center></th><th><center> Quantity </center></th><th><center> Unit Price </center></th><th><center> Sub Total </center></th>
					</tr></tfoot></thead><tbody>";
                                                
                                                $no = 0;
                                                $sql8 = "SELECT id,item_id,quantity,unit_price FROM items_stock WHERE grn_id='$id' ORDER BY id ASC";
                                                $result8 = mysqli_query($con, $sql8);
                                                    while ($arraySomething8 = mysqli_fetch_array($result8)) {
                                                       // $id = $arraySomething8['id'];
                                                        $item_id = $arraySomething8['item_id'];
                                                        $quantity = $arraySomething8['quantity'];
                                                        $unit_price = $arraySomething8['unit_price'];
                                                        $sub_total = $quantity * $unit_price;
                                                    
                                                        $query = "SELECT cat1,cat2,cat3,cat4 FROM row_item WHERE id='$item_id'";
                                                        $result81 = mysqli_query($con, $query);
                                                        while ($arraySomething1 = mysqli_fetch_array($result81)) {
                                                             
                                                                  $cat1 = $arraySomething1['cat1'];
                                                                  $cat2 = $arraySomething1['cat2'];
                                                                  $cat3 = $arraySomething1['cat3'];
                                                                  $cat4 = $arraySomething1['cat4'];
                                                        }                
                                                            $sql118 = "SELECT name FROM row_category_one WHERE id='$cat1' ";
                                                            $result118 = mysqli_query($con, $sql118);
                                                            while ($arraySomething6 = mysqli_fetch_array($result118)) {
                                                            $cat1_name = $arraySomething6['name'];
                                                            }
                                                        
                                                            $sql2 = "SELECT name FROM row_category_two WHERE id='$cat2' ";
                                                            $result2 = mysqli_query($con, $sql2);
                                                            while ($arraySomething2 = mysqli_fetch_array($result2)) {
                                                            $cat2_name = $arraySomething2['name'];
                                                            }
                                                            
                                                            $sql31 = "SELECT name FROM row_category_three WHERE id='$cat3' ";
                                                            $result31 = mysqli_query($con, $sql31);
                                                            while ($arraySomething31 = mysqli_fetch_array($result31)) {
                                                            $cat3_name = $arraySomething31['name'];
                                                            }
                                                            
                                                            
                                                            $sql4 = "SELECT name FROM row_category_four WHERE id='$cat4' ";
                                                            $result4 = mysqli_query($con, $sql4);
                                                            while ($arraySomething4 = mysqli_fetch_array($result4)) {
                                                            $cat4_name = $arraySomething4['name'];
                                                            }
                                                            $no = $no + 1;
                                                         echo "<tr><td> <center>".$no . "</center> </td><td> " . $cat1_name." ".$cat2_name." ".$cat3_name." ".$cat4_name . "</td><td><center>" .$quantity . " <center></td><td align='right'>" .number_format($unit_price,2). " </td><td align='right'>" .number_format($sub_total,2) . "</td> </tr>";
                                                    
    
                                                         
                                                 
                                                            
                                                       
                                                    }                  
                                                                       
                                            ?>
                                                    </table>
                                                    </div>
                                    <button type="button" class="btn btn-primary" onclick="myFunction()">Print this GRN</button>
                                                </div>
                                        </div>
                              </div>
        
        
        
        
        </div></div>
                        
         </section>
<?php } 
        else{ ?>
           <center> <i class="fa fa-user-times" style="font-size:100px; color:black "><br></i></center><div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <center><strong><font size='5'>ACCESS DENIED : </strong> YOU ARE TRYING TO RETRIEVE UNAUTHORIZED DATA. ACCESS DENIED. ACTIVITY RECORDED. <BR><BR>CLICK LEFT HAND SIDE "WorkshopMGT" TO GO BACK.<center>
                    </div>
                 <?php
                 
              $sql11 ="INSERT INTO user_activity (user,activity) VALUES ('$user','ACCESS UNAUTHORIZED DATA.LINK MODIFIED.')";
              mysqli_query($con, $sql11);   
                 
        }
        
        
        ?>                                              </div>
                                                </div>
                          
           
   <script>
function myFunction() {
  window.print();
}
</script>     
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

