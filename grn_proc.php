<?php

include 'connection.php';
include 'header.php';
// $user = $_SESSION['sess_user_id'];
// $company = $_SESSION['sess_company'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 $itempart = $_POST['itempart'];
 $itempart = strtoupper($itempart);
 $itempartprice = $_POST['itempartprice'];
 $itempartquantity = 1;
 
 $jobid = $_POST['jobid'];
 
$sql16 = "SELECT id FROM job WHERE job_main='$jobid' AND pay_by_insurance = '1' AND company='$company' ";
$result16 = mysqli_query($con, $sql16);
$insurance_count = mysqli_num_rows($result16);
 
if($insurance_count<=0 && $itempartprice<=0){
    echo "<div class='callout callout-danger'><center>NO INSURANCE CLAIMING FOUND. YOU CAN NOT PROCEED WITH 0.00 PRICE !</center><div>";
}
else{
     $sql15 = "SELECT id FROM invoice WHERE job_no='$jobid' AND stat = '1'";
     $result15 = mysqli_query($con, $sql15);
     $inovoice_count = mysqli_num_rows($result15);
                                                
                if($inovoice_count>0) {
                    
                    echo "<div class='callout callout-danger'><center>INVOICE HAS BEEN GENERATED.YOU CAN NOT MODIFY PARTS QUOTATION !</center><div>";
                    
                }  
                else{
                $sql = "INSERT INTO quotation_parts (job_no,item,charge_per_part,qty,user,company) VALUES 
									('$jobid','$itempart','$itempartprice','$itempartquantity','$user','$company')";   
                         if(mysqli_query($con, $sql))
                     echo "<div class='callout callout-success'><center>ADDED ITEMS TO PARTS QUOTATION SUCCESSULLY !</center><div>";
                   else 
                     echo "<div class='callout callout-danger'><center>ADDING PARTS HAVE BEEN FAILED !</center><div>";

                }                      

}
}
?>