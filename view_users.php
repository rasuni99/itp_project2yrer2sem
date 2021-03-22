<?php
include 'connection.php';
include 'header.php';
 // $user = $_SESSION['sess_user_id'];
 // $company = $_SESSION['sess_company'];
?>


<html>
    <head>
        
        <link rel="stylesheet" href="plugins/iCheck/all.css">
        <script>

           

        </script>
    </head>



    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php
            include 'headerbar.php';
            ?>
            <div class="col-md-2">
                <?php
                include 'sidebar.php';
                ?>
            </div>
            <div class="content-wrapper">
                 <section class="content-header">
                <h1>
                 All Users - <?php echo $company; ?>    
                </h1>
                <ol class="breadcrumb">
                  <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">All Users</li>
                </ol>
                 </section>
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                 



                   
                   



                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><font color='red'><strong>All User's details</strong></font></h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>

                                                <?php
                                                echo "<tr>
					<th align='center'> Name </center></th> 
					<th><center> Short name </center></th>
					<th><center>NIC</center></th>
					<th><center>Mobile</center></th>
					<th align='center'>Address</center></th>
                                                <th><center>Active</center></th>
                                                <th><center>Finished</center></th>
                                                <th><center>Actions</center></th>
                                                </tr></tfoot></thead><tbody>";

                                                
                                                

                                                $sql = "SELECT id,fullname,shortname,mobile,address,NIC FROM customer WHERE (type='1' OR type='2') AND company='$company' AND stat = '1' ORDER BY fullname ASC";


                                                if ($result = mysqli_query($con, $sql)) {

                                                    while ($arraySomething1 = mysqli_fetch_array($result)) {
                                                        $id = $arraySomething1['id'];
                                                        $full_name = $arraySomething1['fullname'];
                                                        $shortname = $arraySomething1['shortname'];
                                                        $mobile = $arraySomething1['mobile'];
                                                        $address = $arraySomething1['address'];
                                                        $nic = $arraySomething1['NIC'];


                                                        
                                                         //active loans
                                                        $sql5 = "SELECT id FROM loan_core WHERE customer_id='$id' AND stat = '1'  AND settle='0'";
                                                        $activeresult =mysqli_query($con,$sql5);
                                                        $activenos = mysqli_num_rows($activeresult);
                                                        
                                                        //finished loans
                                                          $sql6 = "SELECT id FROM loan_core WHERE customer_id='$id' AND stat = '1'  AND settle='1'";
                                                          $finishresult =mysqli_query($con,$sql6);
                                                        $finishenos = mysqli_num_rows($finishresult);
                                                        
                                                        echo "<tr>
                                                        <td> &nbsp" . $full_name . " </td>
                                                        <td> &nbsp" . $shortname . " </td>
                                                        <td align='center'> &nbsp" . $nic . " </td>
                                                        <td align='center'> &nbsp" . $mobile . " </td>
                                                        <td> &nbsp" . $address . " </td>
                                                            <td align='center'> &nbsp<font color='red'><b>" . $activenos . "</b></font> </td>
                                                        <td align='center'> &nbsp<font color='green'><b>" . $finishenos . " </b></font></td></a>
                                                         <td align='center'><a type='button' title='View Borrower Details' class='btn btn-default btn-xs confirm_action' href='details_borrower.php?borrower=".$id."'>
                                                                                                                                        <span class='glyphicon glyphicon-search' aria-hidden='true'></span> </a> 
                                                          <a type='button' title='Edit Borrower Details' class='btn btn-default btn-xs confirm_action' href='edit_customer.php?borrower=".$id."'>
                                                                                                                                        <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> </a>                                                                               
                                                        <a type='button' title='Delete Borrower' class='btn btn-default btn-xs confirm_action' href='delete_borrower.php?borrower=".$id."'>
                                                                                                                                        <span class='glyphicon glyphicon-remove' aria-hidden='true'></span> </a></td> </tr>";    
                                                        }
                                                                } else {
                                                                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
                                                                }

                                                echo "</tbody>  <tfoot>
                <tr>
					<th><center> Name </center></th> 
					<th><center> Short name </center></th>
					<th><center>NIC</center></th>
					<th><center>Mobile</center></th>
					<th><center>Address</center></th>
                                        <th><center>Active</center></th>
                                        <th><center>Finished</center></th>
                                        <th><center>Actions</center></th>
                                        </tr>
                                        </tfoot></table>
							 
							 ";
                                                ?>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                                                </section>
                                                </div>
                                                </div>
                                                <!-- jQuery 3 -->
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
                                            <script src="plugins/iCheck/icheck.min.js"></script>
                                            <!-- page script -->
                                            <script>
                                                $(function () {
                                                    $('#example1').DataTable()
                                                    $('#example2').DataTable({
                                                        'paging': true,
                                                        'lengthChange': false,
                                                        'searching': false,
                                                        'ordering': true,
                                                        'info': true,
                                                        'autoWidth': true
                                                    })
                                                })
                                                
                                                
                                                //iCheck for checkbox and radio inputs
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

