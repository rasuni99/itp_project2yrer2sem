<?php
include 'connection.php';
include 'header.php';
// $user = $_SESSION['sess_user_id'];
// $company = $_SESSION['sess_company'];
     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        
                        $company1 = STRTOUPPER($_POST['companyname']);
                        $phone = $_POST['phone'];
                        $address = STRTOUPPER($_POST['address']);
                        $fax = $_POST['fax'];
                        $email = $_POST['email'];
                        $br = $_POST['br'];
                        $salutation = STRTOUPPER($_POST['salutation']);
                        $name = STRTOUPPER($_POST['cname']);
                        $cmobile = $_POST['cmobile'];
                        $vat_no = $_POST['vat_no'];
                        $msp = $_POST['msp'];
                        $type = 2;
  
                        
                        $sql = "INSERT INTO company_customer (type_customer,company_name,br_no,company_phone,company_fax,company_address,person,person_mobile,salutation,company_email,vat_no,low_min_sale_price,user,company) VALUES
			('$type','$company1','$br','$phone','$fax','$address','$name','$cmobile','$salutation','$email','$vat_no','$msp','$user','$company')";
                       if(mysqli_query($con, $sql))
                            echo "<div class='callout callout-success'><center>COMPANY REGISTERED SUCCESSULLY !</center><div>";
                        else 
                            echo "<div class='callout callout-danger'><center>COMPANY REGISTRATION HAS BEEN FAILED ! CONTACT ADMINISTRATOR</center><div>";
                    }
     
     
     ?>