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
     <script src="bower_components/jquery/dist/jquery.min.js"></script>

<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.0/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>  
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>  
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>   

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.html5.min.js"></script> 
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
 
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css"> 
        
        <script>
            
            function submitForm() {

          var form_data = new FormData(document.getElementById("myform"));
          form_data.append("label", "WEBUPLOAD");
          $.ajax({
              url: "create_item_proc.php",
              type: "POST",
              data: form_data,
              processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
          }).done(function( data ) {
            console.log(data);
          
            $("#example1").load(window.location + " #example1");
            $('#cat1').val("");
            $('#reorderlevel').val("");
            $('#technicianprice').val("");
            $('#sellingprice').val("");
            
            
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
         $sql7 = "SELECT id FROM item WHERE company='$company' AND stat = '1' ";
         $result7 = mysqli_query($con, $sql7);
         $item_count = mysqli_num_rows($result7)
        
        ?>
        
        
      <h1>
        Add New Item - Products
        <small><?php echo "Total Items : ".$item_count; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Generate Item</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
     <div class="box box-primary">
        <div class="box-header with-border">
           <h3 class="box-title" style="color: green; font-weight: bold">Select Item Details</h3>

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
                <label>Category 01 : Type <font color='red'> *</font></label>
                <select class="form-control select2" style="width: 100%;" name="cat1" id="cat1" required>
                <option value=""> SELECT CATEGORY 01 </OPTION>
                      <?php
                                              $sql1 = mysqli_query($con,"SELECT id,name FROM category_one WHERE stat='1' AND company='$company' ORDER BY name ASC");
                                              while ($row = mysqli_fetch_array($sql1)) {
                                                      ?>
                                                      <option value=" <?php echo $row['id'] ?> "> <?php echo $row['name'] ?> </option>;
                                              <?php }
                                              ?>
                </select>   
              </div>
            </div>
              
            <div class="col-md-3">
             <div class="form-group">
                <label>Category 02 : Brand <font color='red'> *</font></label>
                <select class="form-control select3" style="width: 100%;" name="cat2" id="cat2" required>
                <option value=""> SELECT CATEGORY 02 </OPTION>
                      <?php
                                              $sql11 = mysqli_query($con,"SELECT id,name FROM category_two WHERE stat='1' AND company='$company' ORDER BY name ASC");
                                              while ($row11 = mysqli_fetch_array($sql11)) {
                                                      ?>
                                                      <option value=" <?php echo $row11['id'] ?> "> <?php echo $row11['name'] ?> </option>;
                                              <?php }
                                              ?>
                </select>   
              </div>
            </div>
              
            <div class="col-md-3">
             <div class="form-group">
                <label>Category 03 : Model</label>
                <select class="form-control select2" style="width: 100%;" name="cat3" id="cat3" >
                <option value=""> SELECT CATEGORY 03 </OPTION>
                      <?php
                                              $sql12 = mysqli_query($con,"SELECT id,name FROM category_three WHERE stat='1' AND company='$company' ORDER BY name ASC");
                                              while ($row12 = mysqli_fetch_array($sql12)) {
                                                      ?>
                                                      <option value=" <?php echo $row12['id'] ?> "> <?php echo $row12['name'] ?> </option>;
                                              <?php }
                                              ?>
                </select>   
              </div>
            </div>
              
              
            <div class="col-md-3">
             <div class="form-group">
                <label>Category 04 : Extra Features</label>
                <select class="form-control select2" style="width: 100%;" name="cat4" id="cat4" >
                <option value=""> SELECT CATEGORY 04 </OPTION>
                      <?php
                                              $sql14 = mysqli_query($con,"SELECT id,name FROM category_four WHERE stat='1' AND company='$company' ORDER BY name ASC");
                                              while ($row14 = mysqli_fetch_array($sql14)) {
                                                      ?>
                                                      <option value=" <?php echo $row14['id'] ?> "> <?php echo $row14['name'] ?> </option>;
                                              <?php }
                                              ?>
                </select>   
              </div>
            </div>
               </div>
          
             
            <div class="row">   
             <div class="col-md-3">     
              <div class="form-group">
                <label for="exampleInputPassword1">Minimum Selling Price (LKR)<font color='red'> *</font></label>
                <input type="text" autocomplete="off" name="min_sale_price" class="form-control" id="sellingprice" placeholder="Enter Minimum Selling Price" required="">
              </div></div>
                 
                 <div class="col-md-3"> 
                  <div class="form-group">
                <label for="exampleInputPassword1">Cash Price (LKR)<font color='red'> *</font></label>
                <input type="text" autocomplete="off" name="cash_price" class="form-control" id="technicianprice" placeholder="Enter Cash Price" required="">
              </div></div>
                 
             <div class="col-md-3"> 
                 <div class="form-group">
                <label for="exampleInputPassword1">Credit Price (LKR) <font color='red'> *</font></label>
                <input type="text" autocomplete="off" name="credit_price" class="form-control" id="reorderlevel" placeholder="Enter Credit Level" required="">
              </div></div>
             
             <div class="col-md-3">    
             <div class="form-group">
                <label for="exampleInputPassword1">Available Item Count <font color='red'> *</font></label>
                <input type="text" autocomplete="off" name="stock" class="form-control" id="stock" placeholder="Enter Item Count" required="">
              </div>
             </div>  
              
         
          <!-- /.row -->
       
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
           <h3 class="box-title" style="color: green; font-weight: bold">All Items</h3>
          <div class="box-tools pull-right">
          </div>
         </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>

                                                <?php
                                                echo "<tr><th><center> Item Name </center></th><th><center> Min Sale Price </center></th><th><center> Cash Price</center></th><th><center> Credit Price </center></th>
                                        <th><center> Item Stock </center></th><th><center> Actions</center></th>
					</tr></tfoot></thead><tbody>";
                                           
                                                $total_stock = 0;
                                             //   $cat1 = $cat2 = $cat3 = $cat4 = 0;
                                                $sql78 = "SELECT id,cat1,cat2,cat3,cat4,item_code,min_sale_price,cash_price,credit_price,stock_shop FROM item WHERE stat = '1' AND company='$company' ORDER BY cat1,cat2 ASC";
                                                $result78 = mysqli_query($con, $sql78);
                                                    while ($arraySomething78 = mysqli_fetch_array($result78)) {
                                                        $id = $arraySomething78['id'];
                                                        $cat1 = $arraySomething78['cat1'];
                                                        $cat2 = $arraySomething78['cat2'];
                                                        $cat3 = $arraySomething78['cat3'];
                                                        $cat4 = $arraySomething78['cat4'];
                                                        $code = $arraySomething78['item_code'];
                                                        $cash_price = $arraySomething78['cash_price'];
                                                        $min_sale_price = $arraySomething78['min_sale_price'];
                                                        $credit_price = $arraySomething78['credit_price'];
                                                        
                                                        
                                                        $stock_shop = $arraySomething78['stock_shop'];
                                                       
                                                       
                                                            $sql18 = "SELECT name FROM category_one WHERE id='$cat1' ";
                                                            $result18 = mysqli_query($con, $sql18);
                                                            while ($arraySomething18 = mysqli_fetch_array($result18)) {
                                                            $cat1_name = $arraySomething18['name'];
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
                                                            
                                                         if($cat3==0){
                                                           $cat3_name = "";  
                                                         } 
                                                         if($cat4==0){
                                                           $cat4_name = "";  
                                                         } 
                                                         echo "<tr><td align='left'>".$cat1_name." ".$cat2_name." ".$cat3_name." ".$cat4_name." </td> <td align='center'>" .  number_format($min_sale_price,2) . " </td><td align='center'>" .  number_format($cash_price,2) . " </td><td align='center'> ".number_format($credit_price,2)."  </td>
                                                                <td align='center'>" .  $stock_shop . " </td>";
                                                                  echo "<td align='center'><a type='button' title='Click to Edit the Item Price' class='btn btn-default btn-xs confirm_action' href='edit_price.php?id=".$id."'>
																 <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> </a>
                                                                                                                                 
                                                                                            <a type='button' title='Click to Cancel the Item' class='btn btn-default btn-xs confirm_action' href='delete_item.php?id=".$id."'>
																 <span class='glyphicon glyphicon-remove' aria-hidden='true'></span> </a></td>";  
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
           
            $('#example1').DataTable({
                'paging': false,
                'lengthChange': false,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': false,
                'dom': 'Bfrtip',
    'buttons': [
       { extend: 'excel', text: 'Export to Excel',messageTop: 'Shanaz Plastics',title:'Shanaz Plastics - Stock' ,exportOptions: { columns: [ 0, 4,] }},
       
      
    ]
            })
        })


</script>
</body>
</html>
