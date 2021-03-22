<?php

include 'header.php';
include 'connection.php';
// $company = $_SESSION['sess_company'];

$id = $_GET['id'];
$nic = str_replace(' ', '', $id);

$query1 = "SELECT id FROM company_customer WHERE nic='$nic' AND company='$company' ";	
			$result = mysqli_query($con,$query1);
			$rowcount=mysqli_num_rows($result);
			if($rowcount>0){
				
				echo "<div class='callout callout-warning'><center>THIS CUSTOMER IS ALREADY REGISTERED.CHECK CUSTOMER LIST AND PROCEED  !</center><div>";
				
			}

?>
