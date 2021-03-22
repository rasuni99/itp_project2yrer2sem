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
         $sql7 = "SELECT id FROM item WHERE company='$company' AND stat = '1' ";
         $result7 = mysqli_query($con, $sql7);
         $item_count = mysqli_num_rows($result7)
        
        ?>
        
      <h1>
        Edit Item - Products
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Item</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    
     <div class="box box-primary">
          
        
        <!-- /.box-header -->
        
       
             
        
          <!-- /.row -->
       
        <!-- /.box-body -->
       <div class="box-header with-border">
           <h3 class="box-title" style="color: green; font-weight: bold">Update Item Price</h3>
          <div class="box-tools pull-right">
          </div>
       </div>
        <?php
        $cat1 = $cat2 = $cat3 = $cat4 = "";
        $cat3_name = $cat4_name = "";
        $sql = "SELECT id,cat1,cat2,cat3,cat4,min_sale_price,cash_price,credit_price,stock_shop,item_code FROM item WHERE id='$id' ";
                                                $result = mysqli_query($con, $sql);
                                                    while ($arraySomething1 = mysqli_fetch_array($result)) {
                                                        $id = $arraySomething1['id'];
                                                        $cat1 = $arraySomething1['cat1'];
                                                        $cat2 = $arraySomething1['cat2'];
                                                        $cat3 = $arraySomething1['cat3'];
                                                        $cat4 = $arraySomething1['cat4'];
                                                        $min_sale_price = $arraySomething1['min_sale_price'];
                                                        $cash_price = $arraySomething1['cash_price'];
                                                        $credit_price = $arraySomething1['credit_price'];
                                                        $code = $arraySomething1['item_code'];
                                                        
                                                        $stock_shop = $arraySomething1['stock_shop'];
                                                       
                                                            $sql1 = "SELECT name FROM category_one WHERE id='$cat1' ";
                                                            $result1 = mysqli_query($con, $sql1);
                                                            while ($arraySomething5 = mysqli_fetch_array($result1)) {
                                                            $cat1_name = $arraySomething5['name'];
                                                            }
                                                        
                                                            $sql2 = "SELECT name FROM category_two WHERE id='$cat2' ";
                                                            $result2 = mysqli_query($con, $sql2);
                                                            while ($arraySomething2 = mysqli_fetch_array($result2)) {
                                                            $cat2_name = $arraySomething2['name'];
                                                            }
                                                            
                                                            $sql3 = "SELECT name FROM category_three WHERE id='$cat3' ";
                                                            $result3 = mysqli_query($con, $sql3);
                                                            while ($arraySomething3 = mysqli_fetch_array($result3)) {
                                                            $cat3_name = $arraySomething3['name'];
                                                            }
                                                            
                                                            
                                                            $sql4 = "SELECT name FROM category_four WHERE id='$cat4' ";
                                                            $result4 = mysqli_query($con, $sql4);
                                                            while ($arraySomething4 = mysqli_fetch_array($result4)) {
                                                            $cat4_name = $arraySomething4['name'];
                                                            }
                                                            
                                                            $item_name = $cat1_name." ".$cat2_name." ".$cat3_name." ".$cat4_name;
                                                    }
        ?>
        
        <form name="myForm" id ="myform" action="edit_price.php" 
                 method="POST" >
            
            <input type='hidden' name ='id' value='<?php echo $id?>'>
        <div class="box-body">
          <div class="row">
           
              <div class="col-md-12"> 
               <div class="form-group">
                <label for="exampleInputPassword1">Item Name</font></label>
                <input type="text" name="nic" class="form-control" value="<?php echo $item_name ?>" disabled="">
              </div>
                  <div class="form-group">
                <label for="exampleInputPassword1">Item Code</label>
                <input type="text" name="code" class="form-control" id="reorderlevel" value="<?php echo $code?>">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Minimum Selling Price</label>
                <input type="text" name="minprice" class="form-control" id="sellingprice" value="<?php echo $min_sale_price?>">
              </div>
                  <div class="form-group">
                <label for="exampleInputPassword1">Cash Price</label>
                <input type="text" name="cashprice" class="form-control" id="technicianprice" value="<?php echo $cash_price?>">
              </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Credit Price</label>
                <input type="text" name="creditprice" class="form-control" id="reorderlevel" value="<?php echo $credit_price?>">
              </div>
                  <div class="form-group">
                <label for="exampleInputPassword1">Stock Shop</label>
                <input type="text" name="stock" class="form-control" id="stock" value="<?php echo $stock_shop?>">
              </div>
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
                        $minprice = $_POST['minprice'];
                        $cashprice = $_POST['cashprice'];
                        $creditprice = $_POST['creditprice'];
                        $code = $_POST['code'];
                        $stock = $_POST['stock'];
                        
                        $sql = "UPDATE item SET min_sale_price='$minprice',cash_price='$cashprice',credit_price='$creditprice',item_code='$code',stock_shop='$stock' WHERE id='$id'";
                        if (mysqli_query($con, $sql)) {
                            
                            $sql1 ="INSERT INTO user_activity (user,activity) VALUES ('$user','ITEM DETAILS UPDATED ID :$id ')";
                            mysqli_query($con, $sql1);
                             echo "<script>window.location = 'create_item.php?msg=ITEM DETAILS UPDATED SUCCESSFULLY ! ';</script>";
                            
                            
                        } else {
                             echo "<script>window.location = 'create_item.php?msge=UPDATING ITEMS DETAILS FAILED ! CONTACT ADMINISTRATOR ';</script>";
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

