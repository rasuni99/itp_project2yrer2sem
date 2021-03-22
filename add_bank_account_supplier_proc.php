<?php
include 'connection.php';
include 'header.php';
// $user = $_SESSION['sess_user_id'];
// $company = $_SESSION['sess_company'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                        $bank = $_POST['bank'];
                        $acctype = $_POST['acctype'];
                        $accno = $_POST['accno'];
                        $accowner = $_POST['accowner'];
                        $accname = $_POST['accname'];
                        $accname=strtoupper($accname);
                        
                         
                            $sql1 = "INSERT INTO bank_accounts (bank,owner,acc_name,type,account_no,company,user) VALUES 
									('$bank','$accowner','$accname','$acctype','$accno','$company',$user)";   
                        
                      if(mysqli_query($con, $sql1))
                            echo "<div class='callout callout-success'><center>SUPPLIER BANK ACCOUNT REGISTERED SUCCESSULLY !</center><div>";
                        else 
                            echo "<div class='callout callout-danger'><center>SUPPLIER BANK ACCOUNT REGISTRATION HAS BEEN FAILED ! CONTACT ADMINISTRATOR</center><div>";
                    }
   
                        
                        
                        ?>