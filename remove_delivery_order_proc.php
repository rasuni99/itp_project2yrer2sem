<?php
include 'connection.php';
include 'header.php';

?>

<head>
    
 <style>
  input[type=text] {
  background-color: #EECA44  ;
  color: white;
}
</style>
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

 

if (isset($_GET['delivery_no']) or isset($_GET['delivery_no_all'])) {
    if (isset($_GET['delivery_no'])){
    $delivery_no = $_GET['delivery_no'];
    $redirect  = "parent.location = 'remove_delivery_note.php'";
    }
    
    if (isset($_GET['delivery_no_all'])){
    $delivery_no = $_GET['delivery_no_all'];
    $redirect  = "parent.location = 'remove_delivery_note_all.php'";
    }
    
    $delivery_id = 0;
    $sql9 = "SELECT id,stat,convert_to_invoice FROM invoice WHERE invoice_no = '$delivery_no'";
            $result9 = mysqli_query($con, $sql9);
            while ($arraySomething9 = mysqli_fetch_array($result9)) {
                $delivery_id = $arraySomething9['id'];
                 $stat = $arraySomething9['stat'];
                 $convert_to_invoice = $arraySomething9['convert_to_invoice'];
                
            }
            
            if($delivery_id>0){
                
                if($stat==1){
                    
                    if($convert_to_invoice==0){
    
 
                 $id = $delivery_no;
    
 ?> 
                <div class="example-modal">
                        <div class="modal modal-warning">
                            <div class="modal-dialog">
                                <form action = "remove_delivery_order_proc.php" class="form-horizontal" method="POST"  enctype="multipart/form-data" name="form" id="form">
                                    <input type="hidden" name="back_url" value="">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                   
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Are you sure you want to cancel this order note ?</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>This will lead to cancel the delivery note after your confirmation. All transactions, combined with this customer will be removed and system won't be able to roll-back these transactions in future.</p>
                                       
                <h4 class="modal-title">Reason to Cancel </ha>
                <input type="text" autocomplete="off" name="reason" class="form-control" id="payto"  required="">
            
                                        
                                        </div>
                                        <div class="modal-footer">
                                           <button type="button" class="btn btn-outline pull-left"  onClick="<?php echo $redirect?>">Cancel</button>
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
                
                
                 <?php 
                
                }else{
                    
                      ?>
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <center><strong>FAILED : </strong> <?php echo $delivery_no.' CAN NOT CANCEL, THIS ORDER NOTE CONVERTED TO A INVOICE !'; ?><center>
                    </div>
           
             <meta http-equiv="refresh" content="5;url=remove_delivery_note.php" />
                
                <?php
                    
                }
              
               
                
                }else{
                    
                      ?>
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <center><strong>FAILED : </strong> <?php echo $delivery_no.' IS ALREADY CANCELED !'; ?><center>
                    </div>
           
             <meta http-equiv="refresh" content="5;url=remove_delivery_note.php" />
                
                <?php
                    
                }
                
                
                
                
                
                
                
                }else{
                    
                    ?>
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <center><strong>FAILED : </strong> <?php echo 'WRONG DELIVERY NOTE NO. TRY AGAIN !'; ?><center>
                    </div>
           
             <meta http-equiv="refresh" content="5;url=remove_delivery_note.php" />
                
                <?php
                    
                }
                
                
                
}
                ?>



            </section>
        </div><!-- /.content-wrapper -->
    </div><!-- ./wrapper -->




</body>
</html>

<?php
if (isset($_POST['delete'])) {

    $delivery_no = $_POST['id'];
    $reason = strtoupper($_POST['reason']);
     $sql9 = "SELECT id FROM invoice WHERE invoice_no = '$delivery_no'";
            $result9 = mysqli_query($con, $sql9);
            while ($arraySomething9 = mysqli_fetch_array($result9)) {
                $delivery_id = $arraySomething9['id'];
            }
    
    $sql = "UPDATE invoice SET stat='0' WHERE id='$delivery_id' ";
    
    if (mysqli_query($con, $sql)) {
        $sql11 ="INSERT INTO user_activity (user,activity) VALUES ('$user','DELIVERY NOTE REMOVED ID :$delivery_id / REASON : $reason ')";
                                                                    mysqli_query($con, $sql11);
        if (isset($_GET['delivery_no_all']))
        echo "<script>window.location = 'remove_delivery_note_all.php?msg=DELIVERY NOTE HAS BEEN REMOVED ! ';</script>";
        else
        echo "<script>window.location = 'remove_delivery_note.php?msg=DELIVERY NOTE HAS BEEN REMOVED ! ';</script>";
        
    }
    else{
        
        if (isset($_GET['delivery_no_all']))
        echo "<script>window.location = 'remove_delivery_note_all.php?msge=ROMVING DELIVERY NOTE FAILED ! CONTACT ADMINISTRATOR ';</script>";
        else
        echo "<script>window.location = 'remove_delivery_note.php?msge=ROMVING DELIVERY NOTE FAILED ! CONTACT ADMINISTRATOR ';</script>";
    }
}

?>
                            


