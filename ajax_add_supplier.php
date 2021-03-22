<?php

include 'header.php';
include 'connection.php';
// $company = $_SESSION['sess_company'];

$id = $_GET['id'];
$br_no = str_replace(' ', '', $id);

$query1 = "SELECT br_no FROM supplier WHERE br_no='$br_no' AND stat='1' AND company='$company' ";	
			$result = mysqli_query($con,$query1);
			$rowcount=mysqli_num_rows($result);
			if($rowcount>0){
				
				echo "<div class='callout callout-warning'><center>THIS SUPPLIER IS ALREADY REGISTERED  !</center><div>";
                        }	

?>
