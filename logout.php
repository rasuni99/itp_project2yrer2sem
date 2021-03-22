<?php
 include 'header.php';
 include 'connection.php';
 //session_start();
 // $user = $_SESSION['sess_user_id'];
 // $company = $_SESSION['sess_company'];
$ip = $_SERVER['REMOTE_ADDR'];

    $sql = "INSERT INTO login_history (user,company,activity,ip) VALUES 
    ('$user','$company','SYSTEM LOGOUT','$ip')";
     mysqli_query($con, $sql);

        // If the user is logged in, delete the session variables to log them out
      //  session_start();
        if (isset($user)) {
            $_SESSION = array();

            //If cookie available set time parameters
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time()-3600);
        }

            session_destroy(); //destroy session
        }

 
     ?><script>
       window.location.href = "/shanaz_production/login.php";
		</script>
        <?php
