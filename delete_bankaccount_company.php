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

 

if (isset($_GET['account_id'])) {
    
 
 $id = $_GET['account_id'];
    
 ?> 
                <div class="example-modal">
                        <div class="modal modal-warning">
                            <div class="modal-dialog">
                                <form action = "delete_bankaccount_company.php" class="form-horizontal" method="POST"  enctype="multipart/form-data" name="form" id="form">
                                    <input type="hidden" name="back_url" value="">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                   
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Are you sure you want to remove this Bank Account ?</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>This will lead to remove the bank account after your confirmation. All transactions, combined with this customer will be removed and system won't be able to roll-back these transactions in future.</p>
                                        </div>
                                        <div class="modal-footer">
                                           <button type="button" class="btn btn-outline pull-left"  onClick="parent.location = 'add_bank_account_company.php'">Cancel</button>
                                            <button type="submit" name='delete' class="btn btn-outline" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait">Delete</button>
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
if (isset($_POST['delete'])) {

    $id = $_POST['id'];
    
    $sql = "UPDATE bank_accounts SET stat='0' WHERE id='$id' ";
    
    if (mysqli_query($con, $sql)) {
        $sql11 ="INSERT INTO user_activity (user,activity) VALUES ('$user','BANK ACCOUNT REMOVED ID :$id ')";
                                                                    mysqli_query($con, $sql11);
       
        echo "<script>window.location = 'add_bank_account_company.php?msg=BANK ACCOUNT HAS BEEN REMOVED ! ';</script>";
        
    }
    else{
        echo "<script>window.location = 'add_bank_account_company.php?msge=REMVING BANK ACCOUNT FAILED ! CONTACT ADMINISTRATOR ';</script>";
    }
}

?>
                            

