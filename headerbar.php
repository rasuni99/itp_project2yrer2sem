




<?php
 include 'header.php';
 include 'connection.php';
// $company = $_SESSION['sess_company'];
$lastlogin = ""; 
$lastlogin = $_SESSION['sess_user_last_login'];
// $user = $_SESSION['sess_user_id'];

$sql = "SELECT name FROM company WHERE id='$company' ";
                $result = mysqli_query($con, $sql);

                    while ($arraySomething = mysqli_fetch_array($result)) {
                        $companyname = $arraySomething['name'];
                       
                    }
                    
 $sql = "SELECT YEAR(entry_date)  AS year FROM users WHERE id='$user' ";
                $result = mysqli_query($con, $sql);

                    while ($arraySomething = mysqli_fetch_array($result)) {
                        $year = $arraySomething['year'];
                       
                    }
                    
 $sql = "SELECT datetime FROM login_history WHERE user='$user' ORDER BY id DESC LIMIT 1;";
                $result = mysqli_query($con, $sql);

                    while ($arraySomething = mysqli_fetch_array($result)) {
                        $currentlogin = $arraySomething['datetime'];
                       
                    }

?>

	
	<header class="main-header">

    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Mg</b>T</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Shanaz</b>MGT</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          
             
            </a>
            <ul class="dropdown-menu">
            
            
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 <span class="logo-lg"><b>LAST LOGIN :  <?php echo  $lastlogin." || "; ?></b></span>
                <span class="logo-lg"><b>IP :  <?php echo  $_SERVER['REMOTE_ADDR']." || "; ?></b></span>
             <span class="logo-lg"><b>COMPANY :  <?php echo  $companyname; ?></b></span>
            
            </a>
            
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          
             
            </a>
       
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/avatar3.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $user_name;   ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/avatar3.png" class="img-circle" alt="User Image">

                <p>
                  <?php echo $user_name;   ?> 
                  <small>Member since<?php echo " ".$year; ?></small>
                </p>
              </li>
              <!-- Menu Body -->
           
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="password_change.php" class="btn btn-default btn-flat">Config</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
         
        </ul>
      </div>

    </nav>
  </header>

       
    </body>
    
    
                                            
    
    </html>




