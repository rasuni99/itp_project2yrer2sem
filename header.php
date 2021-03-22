<?php
include 'connection.php';
$ip_now = $_SERVER['REMOTE_ADDR'];

//Start session

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    


$user = $_SESSION['sess_user_id']; 
$company = $_SESSION['sess_company'];
//$code_invoice_real = $_SESSION['code_invoice_real'];
//Check whether the session variable  is present or not
if (!isset($_SESSION['sess_user_id']) || (trim($_SESSION['sess_user_id']) == '')) {
    header("location: login.php");
    exit();
}



if (($_SESSION['ip'])!=$ip_now) {
    $ip_old = $_SESSION['ip'];
    $sql = "INSERT INTO login_history (user,company,activity,ip) VALUES 
    ('$user','$company','SYSTEM LOGOUT. IP CHANGED.NEW IP : $ip_now','$ip_old')";
     mysqli_query($con, $sql);
    
     $Message = urlencode("The login IP is changed.<br>Please log again.");
    header("Location:login.php?msge=" . $Message);
    exit();
}
?>

<?php
date_default_timezone_set("Asia/Colombo");
$user_name = $_SESSION['sess_username'];
$type = $_SESSION['sess_user_type'];

$grn_code = $_SESSION['code_grn'];
$internal_grn_code = $_SESSION['code_grn_internal'];
$code_invoice =  $_SESSION['code_invoice'];
$code_invoice_real =   $_SESSION['code_invoice_real'];
$code_receipt = $_SESSION['code_receipt'];
$sale_code = $_SESSION['code_sale'];
$code_returns = $_SESSION['code_returns'];




?>
<html>
    <head>
        
		<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>TAC</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
		
		
		
    </head>
    <body> 
	
	

       
    </body>
    <html>




