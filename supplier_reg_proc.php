<?php
include 'connection.php';
include 'header.php';
// $user = $_SESSION['sess_user_id'];
// $company = $_SESSION['sess_company'];
     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $country = "";
                        $vat = "";
                        $company1 = STRTOUPPER($_POST['companyname']);
                        $phone = $_POST['phone'];
                        $address = STRTOUPPER($_POST['address']);
                        $fax = $_POST['fax'];
                        $email = $_POST['email'];
                        $br = $_POST['br'];
                        $salutation = STRTOUPPER($_POST['salutation']);
                        $name = STRTOUPPER($_POST['cname']);
                        $cmobile = $_POST['cmobile'];
                        $country = STRTOUPPER($_POST['country']);
                        $vat = $_POST['vat'];
                        
  
                        
                        $sql = "INSERT INTO supplier (company_name,br_no,vat_no,company_phone,company_fax,company_address,person,person_mobile,salutation,company_email,country,user,company) VALUES
			('$company1','$br','$vat','$phone','$fax','$address','$name','$cmobile','$salutation','$email','$country','$user','$company')";
                       if(mysqli_query($con, $sql))
                            echo "<div class='callout callout-success'><center>SUPPLIER REGISTERED SUCCESSULLY !</center><div>";
                        else 
                            echo "<div class='callout callout-danger'><center>SUPPLIER REGISTRATION HAS BEEN FAILED ! CONTACT ADMINISTRATOR</center><div>";
                    }
     
     
     ?>