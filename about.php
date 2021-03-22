<?php
include 'connection.php';
include 'header.php';
?>


<html>
    <head>
  
       
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
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    

    <!-- Main content -->
    <section class="content">

    
        

        <div class="error-content">
          <h2 class="headline text-red">ABOUT</h2>

          <p>
           <strong> Product Version:  </strong>DailySystem 1.0 (Build 20171110) </p>
<p> <strong>Updates: </strong>Updates available to version DailySystem 1.1</p>
<p> <strong>Interent Protocol (IP): </strong><?php echo $_SERVER['REMOTE_ADDR']; ?> </p>
<p> <strong>Port : </strong><?php echo $_SERVER['REMOTE_PORT'];  ?> </p>
<p> <strong>Browser Ver: </strong><?php echo $_SERVER['HTTP_USER_AGENT'];?> </p>
<p> <strong>Accept Header: </strong><?php echo $_SERVER['HTTP_ACCEPT'];  ?> </p>
          </p>

         
        </div>
      </div></center>
      <!-- /.error-page -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  

 
 
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
