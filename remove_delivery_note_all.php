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



    </head>
    <?php
    include 'headerbar.php';
    ?>

    <?php
    include 'sidebar.php';
    ?>
    <body class="hold-transition skin-green sidebar-mini">


        <div class="wrapper">



            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">

                    <!-- Content Wrapper. Contains page content -->





                    <h1>
                        Cancel Delivery Note

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Cancel Delivery Note</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- SELECT2 EXAMPLE -->
                 <?php
                    $sql12 = "SELECT SUM(net_amount) AS amount FROM invoice WHERE convert_to_invoice='0' AND company='$company' AND stat = '1' ORDER BY date ASC";
                    $sql = "SELECT invoice_no,net_amount,type,customer_id,date FROM invoice WHERE convert_to_invoice='0' AND company='$company' AND stat = '1' ORDER BY date ASC";
					$result = mysqli_query($con, $sql);
					$result12 = mysqli_query($con, $sql12);
					while ($arraySomething1 = mysqli_fetch_array($result12)) {
						$all_amount = $arraySomething1['amount'];
						}
                    $count_incomplete_orders = mysqli_num_rows($result);
                    
                    ?>
                    
                    <div class="row">
                      <div class='col-xs-12'>
                          <div class='box box-primary'>
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>In-completed Orders (<?php echo " ".$count_incomplete_orders." "; ?>)  (Rs. <?php echo " ".number_format($all_amount,2)." "; ?>)</h3></strong></h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-wrench"></i></button>

                                        </div>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <table id="example2" class="table table-bordered table-striped">
                                            <thead>

                                               
                                                <?php
                                                echo "<tr><th><center> Order # </center></th><th><center> Date </center></th><th><center> Customer Name </center></th><th><center> Customer Phone </center></th><th><center> Address </center></th><th><center> Sales Type </center></th><th><center> Amount </center></th><th><center> Remove </center></th>
					</tr></tfoot></thead><tbody>";
                                           
                                                $type = 0;
                                                
                                                $sql = "SELECT id,invoice_no,net_amount,type,customer_id,date FROM invoice WHERE convert_to_invoice='0' AND company='$company' AND stat = '1' ORDER BY date ASC";
                                                $result = mysqli_query($con, $sql);
                                                    while ($arraySomething1 = mysqli_fetch_array($result)) {
                                                        $invoice_id = $arraySomething1['id'];
                                                        $invoice_no = $arraySomething1['invoice_no'];
                                                        $net_amount = $arraySomething1['net_amount'];
                                                        $sales_type = $arraySomething1['type'];
                                                        $customer_id = $arraySomething1['customer_id'];
                                                        $date = $arraySomething1['date'];
                                                       
                                                            $sql16 = "SELECT id,type_customer,company_name,company_address,company_phone,salutation,person,person_mobile FROM company_customer WHERE id='$customer_id'";
                                                            $result16 = mysqli_query($con, $sql16);
                                                            while ($arraySomething16 = mysqli_fetch_array($result16)) {
                                                                $id = $arraySomething16['id'];
                                                                $salutation = $arraySomething16['salutation'];
                                                                $type = $arraySomething16['type_customer'];
                                                                $company_name = $arraySomething16['company_name'];
                                                                $company_phone = $arraySomething16['company_phone'];
                                                                $name = $arraySomething16['person'];
                                                                $mobile = $arraySomething16['person_mobile'];
                                                                $company_address = $arraySomething16['company_address'];


                                                                if($type==2){
                                                                        $customer_name = $company_name;
                                                                        $customer_phone = $company_phone;
                                                                        $salutation = "";
                                                                }else{
                                                                        $customer_name = $name;
                                                                        $customer_phone = $mobile;
                                                                } 
                                                            }
                        
                                                        
                                                         echo "<tr><td> &nbsp" .  $invoice_no . " </td><td> &nbsp" .  $date . " </td><td> &nbsp" .  $salutation." ".$customer_name . " </td><td align='center'> &nbsp" . $customer_phone." </td><td align='left'> &nbsp" . $company_address." </td><td align='left'> &nbsp" . $sales_type. " </td><td align='right'>" . number_format($net_amount,2) . "</td>";
                                                                                
                                                             echo "<td align='center'><a type='button' title='Click to Cancel the Delivery Note' class='btn btn-default btn-xs confirm_action' href='remove_delivery_order_proc.php?delivery_no_all=".$invoice_no."'>
																 <span class='glyphicon glyphicon-remove' aria-hidden='true'></span> </a></td>";     
                                                                   
                                                            }

                                           
                                            ?>
                                                    </table>
                            </div>
                        </div> 
                    </div>







                </section>
            </div>
        </div>
    </body>      

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



            <!-- Page script -->
            <script>

                $(function () {
                    //Initialize Select2 Elements
                    $('.select2').select2()
                    $('.select3').select2()

                    //Datemask dd/mm/yyyy
                    $('#datepicker').datepicker('mm-dd-yyyy', {'placeholder': 'dd/mm/yyyy'})
                    $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
                    //Datemask2 mm/dd/yyyy
                    $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'})
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
                        'searching': true,
                        'ordering': true,
                        'info': true,
                        'autoWidth': false
                    })
                })


                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal-blue',
                    radioClass: 'iradio_minimal-blue'
                })
                //Red color scheme for iCheck
                $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                    checkboxClass: 'icheckbox_minimal-red',
                    radioClass: 'iradio_minimal-red'
                })
                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                })


            </script>
        </body>
    </html>
