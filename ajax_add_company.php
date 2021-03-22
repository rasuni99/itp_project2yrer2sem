<?php

include 'header.php';
include 'connection.php';
// $company = $_SESSION['sess_company'];

$id = $_GET['id'];
$cname = str_replace(' ', '', $id);

$query1 = "SELECT br_no FROM company_customer WHERE br_no='$cname' AND company='$company' ";	
			$result = mysqli_query($con,$query1);
			$rowcount=mysqli_num_rows($result);
			if($rowcount>0){
				
				echo "<div class='callout callout-warning'><center>THIS COMPANY IS ALREADY REGISTERED  !</center><div>";
				
			}

?>
