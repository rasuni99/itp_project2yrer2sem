<?php
include 'connection.php';
include 'header.php';
// $user = $_SESSION['sess_user_id'];
// $company = $_SESSION['sess_company'];
     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        
                        $nic = STRTOUPPER($_POST['nic']);
                        $nic = str_replace(' ', '', $nic);
                        $salutation = STRTOUPPER($_POST['salutation']);
                        $name = STRTOUPPER($_POST['name']);
                        $address = STRTOUPPER($_POST['address']);
                        $mobile = $_POST['mobile'];
                        $email = $_POST['email'];
                        $recidence = $_POST['recidence'];
                        $type = $_POST['type'];
                        $msp = $_POST['msp'];
  
                        
                        $sql = "INSERT INTO company_customer (type_customer,nic,salutation,person,company_address,person_mobile,company_phone,company_email,low_min_sale_price,company,user) VALUES 
			('$type','$nic','$salutation','$name','$address','$mobile','$recidence','$email','$msp','$company','$user')";
                       if(mysqli_query($con, $sql))
                            echo "<div class='callout callout-success'><center>CUSTOMER REGISTERED SUCCESSULLY !</center><div>";
                        else 
                            echo "<div class='callout callout-danger'><center>CUSTOMER REGISTRATION HAS BEEN FAILED ! CONTACT ADMINISTRATOR</center><div>";
                    }
     
     
     ?>