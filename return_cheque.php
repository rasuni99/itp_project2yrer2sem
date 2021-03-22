<?php
include 'connection.php';
include 'header.php';
// $user = $_SESSION['sess_user_id'];
?>

<head>
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

    <!-- style for all delete red dialog box -->
    <link rel="stylesheet" type="text/css" href="bower_components/styles/style.css">




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

        <div class="content-wrapper">

            <section class="content">

<?php
if (isset($_GET['cid'])) {

    $cheque_id = $_GET['cid'];
    

          ?> 
                <div class="example-modal">
                        <div class="modal modal-warning">
                            <div class="modal-dialog">
                                <form action = "return_cheque.php" class="form-horizontal" method="POST"  enctype="multipart/form-data" name="form" id="form">
                                    <input type="hidden" name="back_url" value="">
                                    <input type="hidden" name="cheque_id" value="<?php echo $cheque_id; ?>">
                                    
                                   
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Are you sure you want to mark this cheque as return ?</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>This will lead to modify the status of cheque after your confirmation. All transactions, combined with this item will be modified and system won't be able to roll-back these transactions in future.</p>
                                        </div>
                                        <div class="modal-footer">
                                           <button type="button" class="btn btn-outline pull-left"  onClick="parent.location = 'pending_realizing.php'">Cancel</button>
                                            <button type="submit" name='return' class="btn btn-outline" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait">Mark Return</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </form>
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    </div>
                
              
                <?php } ?>



            </section>
        </div><!-- /.content-wrapper -->
    </div><!-- ./wrapper -->




</body>
</html>

<?php
if (isset($_POST['return'])) {

    $id = $_POST['cheque_id'];
    
    $sql8 = "SELECT id FROM cheque WHERE reject='1' AND id='$id' ";
    $result=mysqli_query($con,$sql8);
    $row_count = mysqli_num_rows($result);
    
    if($row_count>0){
        
        echo "<script>window.location = 'pending_realizing.php?msge=CHEQUE IS ALREADY MAEKED AS RETURNED ! ( YOU ARE CLICKING TOO FAST ! ) ';</script>";
        
    }
    else{
    
                $sql = "UPDATE cheque SET reject='1' WHERE id='$id' ";



                if (mysqli_query($con, $sql)) {

                 $sql1 = "UPDATE cash_book SET cheque_reject='1' WHERE payment_type_id='$id' ";    
                 mysqli_query($con, $sql1)  ; 
//                $sql23 = "SELECT amount,invoice_id FROM cheque WHERE id='$id'";
//                $result23 = mysqli_query($con, $sql23);
//                    while ($arraySomething23 = mysqli_fetch_array($result23)) {
//                        $cheque_amount = $arraySomething23['amount']; 
//                        $invoice_id = $arraySomething23['invoice_id']; 
//                    }

//                $sql23 = "SELECT updated_paid_amount FROM invoice WHERE company='$company' AND stat = '1' AND id='$invoice_id'";
//                $result23 = mysqli_query($con, $sql23);
//                    while ($arraySomething23 = mysqli_fetch_array($result23)) {
//                        $updated_paid_amount = $arraySomething23['updated_paid_amount']; 
//                    }
//                $paid_total = $updated_paid_amount + $cheque_amount;
//
//                $sql2 = "UPDATE invoice SET updated_paid_amount='$paid_total' WHERE id='$invoice_id'";
//                 mysqli_query($con, $sql2);


                $sql11 ="INSERT INTO user_activity (user,activity) VALUES ('$user','MARKED RETURN CHEQUE ID :$id ')";
                                                                            mysqli_query($con, $sql11);

                echo "<script>window.location = 'pending_realizing.php?msg=CHEQUE IS MARKED AS RETURNED ! AMOUNT MARKED AS UNSETTLED ';</script>";

                }
    
    }
}

?>
                            



