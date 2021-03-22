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

 

if (isset($_GET['return_no']) or isset($_GET['return_no_all'])) {
    if (isset($_GET['return_no'])){
    $return_no = $_GET['return_no'];
    $redirect  = "parent.location = 'remove_return_note.php'";
    }
    
    if (isset($_GET['return_no_all'])){
    $return_no = $_GET['return_no_all'];
    $redirect  = "parent.location = 'remove_return_note_all.php'";
    }
    
    $return_id = 0;
    $sql9 = "SELECT id,stat,used FROM invoice_return WHERE return_number = '$return_no'";
            $result9 = mysqli_query($con, $sql9);
            while ($arraySomething9 = mysqli_fetch_array($result9)) {
                $return_id = $arraySomething9['id'];
                 $stat = $arraySomething9['stat'];
                 $used = $arraySomething9['used'];
                
            }
            
            if($return_id>0){
                
                if($stat==1){
                    
                    if($used==0){
    
 
                 $id = $return_no;
    
 ?> 
                <div class="example-modal">
                        <div class="modal modal-warning">
                            <div class="modal-dialog">
                                <form action = "remove_return_note_proc.php" class="form-horizontal" method="POST"  enctype="multipart/form-data" name="form" id="form">
                                   
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                   
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Are you sure you want to cancel this return note ?</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>This will lead to cancel the return note after your confirmation. All transactions, combined with this customer will be removed and system won't be able to roll-back these transactions in future.</p>
                                       
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
                
                                    }
                                    else{

                                          ?>
                                    <div class="alert alert-danger" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <center><strong>FAILED : </strong> <?php echo $return_no.' CAN NOT CANCEL, THIS RETURN NOTE IS ALREADY ATTACHED TO A INVOICE !'; ?><center>
                                        </div>

                                 <meta http-equiv="refresh" content="5;url=remove_return_note.php" />

                                    <?php

                                    }
              
                        }else{

                              ?>
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <center><strong>FAILED : </strong> <?php echo $return_no.' IS ALREADY CANCELED !'; ?><center>
                            </div>

                     <meta http-equiv="refresh" content="5;url=remove_return_note.php" />

                        <?php

                        }
                
                
                
                
                
                
                
                }else{
                    
                    ?>
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <center><strong>FAILED : </strong> <?php echo 'WRONG RETURN NOTE NO. TRY AGAIN !'; ?><center>
                    </div>
           
             <meta http-equiv="refresh" content="5;url=remove_return_note.php" />
                
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

    $return_no = $_POST['id'];
    $reason = strtoupper($_POST['reason']);
     $sql9 = "SELECT id,type FROM invoice_return WHERE invoice_no = '$return_no'";
            $result9 = mysqli_query($con, $sql9);
            while ($arraySomething9 = mysqli_fetch_array($result9)) {
                $return_id = $arraySomething9['id'];
            }
    
    
    if($return_type=='NORMAL-RETURN' ){
        
        $sql18 = "SELECT id,item_id,quantity FROM invoice_items_return WHERE return_id='$return_id' ";
        $result18 = mysqli_query($con, $sql18);
        while ($arraySomething18 = mysqli_fetch_array($result18)) {
        $invoice_items_return_id = $arraySomething18['id'];
        $item_id = $arraySomething18['item_id'];
        $item_count = $arraySomething18['quantity'];
        
        $sql181 = "SELECT stock_shop FROM item WHERE id='$item_id' ";
        $result181 = mysqli_query($con, $sql181);
        while ($arraySomething181 = mysqli_fetch_array($result181)) {
        $stock_shop = $arraySomething181['stock_shop'];
        }
        $new_stock_shop = $stock_shop + $item_count;
        
         $sql121 = "UPDATE item SET stock_shop='$new_stock_shop' WHERE id='$item_id' ";
         mysqli_query($con, $sql121);
        
        $sql12 = "UPDATE invoice_items_return SET stat='0' WHERE id='$invoice_items_return_id' ";
         mysqli_query($con, $sql12);
        
        
        }
        
    }
    
    $sql = "UPDATE invoice_return SET stat='0' WHERE id='$return_id' ";
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
                            


