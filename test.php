<!DOCTYPE html>
<?php
include 'header.php';
include 'connection.php';
?>
<head>
    <title></title>
    <meta charset="utf-8">
   
    
     <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
        <script src="bower_components/morris.js/morris.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.js"></script>
        <script src="bower_components/morris.js/examples/lib/example.js"></script>

        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.css">
        <link rel="stylesheet" href="bower_components/morris.js/morris.css">
    
<?php

$user = $_SESSION['sess_user_id'];
$company = $_SESSION['sess_company'];
$today = date('Y-m-d');
$connect = new PDO("mysql:host=localhost;dbname=sale_repair", "root", "");




function fill_unit_select_box($connect,$company)
{ 

 $output = '';
 $query = "SELECT id,cat1,cat2,cat3,cat4 FROM item WHERE stat='1' AND company='$company' ORDER BY cat1 ASC";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $arraySomething1)
 {
    $id1 = $arraySomething1['id'];
    $cat1 = $arraySomething1['cat1'];
    $cat2 = $arraySomething1['cat2'];
    $cat3 = $arraySomething1['cat3'];
    $cat4 = $arraySomething1['cat4'];
    
    
            $query1 = "SELECT name FROM category_one WHERE id='$cat1'";
            $statement1 = $connect->prepare($query1);
            $statement1->execute();
            $result1 = $statement1->fetchAll();
            foreach($result1 as $arraySomething11)
            {
               $cat1name = $arraySomething11['name'];
            }
            $query1 = "SELECT name FROM category_two WHERE id='$cat2'";
            $statement1 = $connect->prepare($query1);
            $statement1->execute();
            $result1 = $statement1->fetchAll();
            foreach($result1 as $arraySomething11)
            {
               $cat2name = $arraySomething11['name'];
            }
            $query1 = "SELECT name FROM category_three WHERE id='$cat3'";
            $statement1 = $connect->prepare($query1);
            $statement1->execute();
            $result1 = $statement1->fetchAll();
            foreach($result1 as $arraySomething11)
            {
               $cat3name = $arraySomething11['name'];
            }
            $query1 = "SELECT name FROM category_four WHERE id='$cat4'";
            $statement1 = $connect->prepare($query1);
            $statement1->execute();
            $result1 = $statement1->fetchAll();
            foreach($result1 as $arraySomething11)
            {
               $cat4name = $arraySomething11['name'];
            }
            
             if($cat3==0){
                $cat3name = "";  
              } 
              if($cat4==0){
                $cat4name = "";  
              } 
    
  $output .= '<option value="'.$id1.'">'.$cat1name.' '.$cat2name.' '.$cat3name.' '.$cat4name.'</option>';
 }
 return $output;
}

?>
<html>
<head>
    <script>
        
  function get_states() { // Call to ajax function
    var customer = $('#customer').val();
    var dataString = "customer="+customer;
    $.ajax({
        type: "POST",
        url: "ajax_get_states_return_note.php", // Name of the php files
        data: dataString,
        success: function(html)
        {
            $("#return_note").html(html);
        }
    });
}

function get_tax() { // Call to ajax function
    var customer = $('#customer').val();
    var dataString = "customer="+customer;
    $.ajax({
        type: "POST",
        url: "ajax_invoice_type_orders.php", // Name of the php files
        data: dataString,
        success: function(html)
        {
            $("#tax").html(html);
        }
    });
}
    

function item_status(str) {
	
    document.getElementById("txtHint").innerHTML="ok";
  if (str=="") {
    document.getElementById("txtHint").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
      if (xmlhttp.responseText) {
            document.getElementById("submit1").disabled = false;
        } else {
            document.getElementById("submit1").disabled = false;
        }
    }
  }
  xmlhttp.open("GET","ajax_item_status.php?item="+str,true);
  xmlhttp.send();
};

</script>
    <script>
    var MessageManager = {
            show: function(content) {
            $('#ajaxmsg').html(content);
            setTimeout(function(){
                $('#ajaxmsg').html('');
            }, 4000);
        }
    }; 
    </script>
        <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
        <link rel="stylesheet" href="plugins/iCheck/all.css"> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
         <script type="text/javascript" src="bower_components/TableExport/dist/js/tableexport.js"></script>
<script type="text/javascript" src="bower_components/base64/jquery.base64.js"></script>

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
            var global_final;
            $(document).ready(function(){
              
                    var final_total_amt = $('#final_total_amt').text();
                    var count = 1;

                    $(document).on('click', '.add', function(){
                      
                    count++;
                    
                   
                     
                    var html = '';
                     html += '<tr id="row_id_'+count+'">';

                     html += '<td><div class="form-group"><select name="item_name[]" id="item_name'+count+'" style="width: 600px" onchange="item_status(this.value);" required><option value="">Select Item</option><?php echo fill_unit_select_box($connect,$company); ?></select></div></td>';
                     html += '<td><input type="text" style="text-align:right;" name="serial[]" id="serial'+count+'" class="form-control item_quantity" ></td>';
                     html += '<td><input type="text" style="text-align:right;" name="description[]" id="description'+count+'" class="form-control item_quantity" ></td>';
                     html += '<td><input type="text" style="text-align:center;" name="quantity[]" id="quantity'+count+'" class="form-control item_quantity" required/></td>';
                     html += '<td><input type="text" style="text-align:right;" name="unit_price[]" id="unit_price'+count+'"  class="form-control item_quantity" required/></td>';
                     html += '<td><input type="text" style="text-align:right;" name="total_price[]" id="total_price'+count+'" class="form-control item_quantity" required/></td>';

                     html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
                     $('#item_table').append(html);
                    
                    $('#item_name2').select2()
                    $('#item_name3').select2()
                    $('#item_name4').select2()
                    $('#item_name5').select2()
                    $('#item_name6').select2()
                    $('#item_name7').select2()
                    $('#item_name8').select2()
                    $('#item_name9').select2()
                    $('#item_name10').select2()
                    $('#item_name11').select2()
                    $('#item_name12').select2()
                    $('#item_name13').select2()
                    $('#item_name14').select2()
                    $('#item_name15').select2()
                    $('#item_name16').select2()
                    $('#item_name17').select2()
                    $('#item_name18').select2()
                    $('#item_name19').select2()
                    $('#item_name20').select2()
                    $('#item_name21').select2()
                    $('#item_name22').select2()
                    $('#item_name23').select2()
                    $('#item_name24').select2()
                    $('#item_name25').select2()
                   
                    
                    
                   

                    });
                    
                    $(document).on('click', '.remove', function(){
                     $(this).closest('tr').remove();
                      cal_final_total(count);
                    });

                                        function cal_final_total(count)
                                            {
                                           
                                            var final_item_total = 0;
                                            for(j=1; j<=count; j++)
                                            {
                                            var quantity = 0;
                                            var price = 0;
                                            var actual_amount = 0;
                                            var item_total = 0;
                                            quantity = $('#quantity'+j).val();

                                            if(quantity > 0)
                                            {
                                              price = $('#unit_price'+j).val();
                                              if(price > 0)
                                              {
                                                actual_amount = parseFloat(quantity) * parseFloat(price);
                                                actual_amount1 = actual_amount.toLocaleString(undefined, {maximumFractionDigits:2});
                                                $('#total_price'+j).val(actual_amount1);

                                                item_total = parseFloat(actual_amount);
                                                final_item_total = parseFloat(final_item_total) + parseFloat(item_total);
                                                final_item_total1 = final_item_total.toLocaleString(undefined, {maximumFractionDigits:2});
                                                global_final = final_item_total;
                                               // $('#order_item_final_amount'+j).val(item_total);
                                              }
                                            }
                                          }
                                          $('#final_total_amt').text(final_item_total1);
                                         
                                        }  
                        
                                        $(document).on('blur', 'input', function(){
                                         
                                              cal_final_total(count);
                                            });
                        


                    $('#insert_form').on('submit', function(event){
                     event.preventDefault();
                     var error = '';
                     $('.item_name').each(function(){
                      var counter = 1;
                      if($(this).val() == '')
                      {
                       error += "<p>Enter Item Name at "+counter+" Row</p>";
                       return false;
                      }
                      counter = counter + 1;
                     });

                     $('.quantity').each(function(){
                      var counter = 1;
                      if($(this).val() == '')
                      {
                       error += "<p>Enter Item Quantity at "+counter+" Row</p>";
                       return false;
                      }
                      counter = counter + 1;
                     });


                     var form_data = $(this).serialize();
                     if(error == '')
                     {
                      $.ajax({
                       url:"sale_invoice_proc.php",
                       method:"POST",
                       data:form_data,
                       success:function(data)
                       {
                           
                           if(data.includes("Error1")){
                                MessageManager.show("<div class='callout callout-danger'><center>FAILED : ADD ITEMS TO THE SALES ORDER.</center></div>");
                           }
                           else if(data.includes("Error2"))
                                MessageManager.show("<div class='callout callout-danger'><center>FAILED : WRONG PAYMENT.</center></div>");
                            else if(data.includes("Error3"))
                                MessageManager.show("<div class='callout callout-danger'><center>FAILED : ADD ITEMS TO THE SALES ORDER.</center></div>");
                            else if(data.includes("Error4"))
                                MessageManager.show("<div class='callout callout-danger'><center>FAILED : NO ITEMS AVAILABLE.</center></div>");
    
                            else{

                        var newWindow = window.open("", "_blank");
                        newWindow.document.write(data);
                        location.reload();
                    }
                       }
                      });
                     }
                     else
                     {
                      $('#error').html('<div class="alert alert-danger">'+error+'</div>');
                     }
                    });
            
            

           });






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
        
         
        
      <h1>
        New Sales Order
      
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
     <div class="box box-primary">
        <div class="box-header with-border">
           <h3 class="box-title" style="color: green; font-weight: bold">Enter Sales Details</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
     <div class="box-body">
                                      
        
         
          <div class="box-body">
          <form method="POST" id="insert_form" name="myform" >   
              
           <div class="row">
            <div class="col-md-4">
            <div class="form-group">
                <label>Customer<font color='red'> *</font></label>
                <select onchange="get_tax()" class="form-control select2" style="width: 100%;" name="customer" id="customer" required>
                <option value=""> SELECT Customer </OPTION>
                
               <optgroup label="COMPANIES">
                      <?php
                                              $sql1 = mysqli_query($con,"SELECT id,company_name FROM company_customer WHERE type_customer='2' AND stat='1' AND company='$company' ORDER BY company_name  ASC");
                                              while ($row = mysqli_fetch_array($sql1)) {
                                                      ?>
                                                      <option value=" <?php echo $row['id'] ?> "> <?php echo $row['company_name'] ?> </option>;
                                              <?php }
                                              ?>
               <optgroup label="INDIVIDUAL CUSTOMERS">
                      <?php
                                              $sql1 = mysqli_query($con,"SELECT id,person FROM company_customer WHERE (type_customer='1' OR type_customer='3') AND stat='1' AND company='$company' ORDER BY person  ASC");
                                              while ($row = mysqli_fetch_array($sql1)) {
                                                      ?>
                                                      <option value=" <?php echo $row['id'] ?> "> <?php echo $row['person'] ?> </option>;
                                              <?php }
                                              ?>
               
                </select>   
              </div>
               </div>
              
                 <div class="col-md-4">
                <div class="form-group">
                <label>Order Date <font color='red'> *</font></label>

                <div class="input-group date">
                  <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                  </div>
                    <input type="text" data-date-format='yyyy-mm-dd' autocomplete="off" name="date" class="form-control pull-right" id="datepicker1" required="">
                </div>  
                
              </div>
                </div>
               
              <div id='tax'></div>
              
                <div class="col-md-2">
            <div class="form-group">
                <label>Sales Type<font color='red'> *</font></label>
                <select class="form-control select2" style="width: 100%;" name="sale_type" id="sale_type" required>
                <option value=""> SELECT SALES TYPE </OPTION>
                <option value="CREDIT-SALE"> CREDIT SALE </OPTION>
                <option value="CASH-SALE"> CASH SALE </OPTION>
                </select>
               
              </div>
          
            </div> 
               
              </div>    
              
            
      <br> 
         
         
    <div class="table-bordered">
     <span id="error"></span>
     <table class="table table-bordered" id="item_table">
      <tr>
       <th width="40%">Item Name</th>
       <th width="10%">Serial No</th>
       <th width="20%">Description</th>
       <th width="10%">Qty</th>
       <th width="10%">Unit Price</th>
       <th width="10%">Sub Total</th>
         </div>
      
      
       <th><button type="button" name="add" id='#add' class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button></th>
      </tr>
       
    </table>
     
    </div>
              <table class="table table-bordered" >
         <tr>
                <td align="right"></td>
                <td align="right"><font size='5'><b>TOTAL : </b><b>Rs. <span id="final_total_amt">0.00</span></b></font></td></tr>
                
         </table>
              
          
                        
                                           
         													
      <button type="submit" id="add_payment" class="btn btn-success" >Generate Order Note</button>
  
  <br>      
<div id="txtHint"></div>			
    </div>  
  </form>         
          
      
                                             
                                         
    

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
(charCode != 46 || $(element).val().indexOf('.') != -1) &&      // ???.??? CHECK DOT, AND ONLY ONE.
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
//    $('.select2').select2()
//    $('.select3').select2()

    //Datemask dd/mm/yyyy
    $('#datepicker').datepicker('mm-dd-yyyy', { 'placeholder': 'dd/mm/yyyy' })
	
  

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
