<?php
     include 'connection.php';
include 'header.php';
// $user = $_SESSION['sess_user_id'];
// $company = $_SESSION['sess_company'];
     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        
                        $cat1 = STRTOUPPER($_POST['cat1']);
                        $sql4 = "INSERT INTO expenses_cat1 (name,user,company) VALUES 
                            ('$cat1','$user','$company')";
                        

                         
                        if (mysqli_query($con, $sql4)) {
                            
                            echo "<div class='callout callout-success'><center>NEW MAIN EXPENSE ADDED SUCCESSULLY !</center><div>";
                        } else {
                            echo "<div class='callout callout-danger'><center>ADDING MAIN EXPENSE HAS BEEN FAILED !</center><div>";
                        }
                    }
     
     
     ?>