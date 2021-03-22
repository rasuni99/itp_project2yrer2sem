<?php
     include 'connection.php';
include 'header.php';
// $user = $_SESSION['sess_user_id'];
// $company = $_SESSION['sess_company'];
     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        
                        $cat2 = STRTOUPPER($_POST['cat2']);
                        $sql4 = "INSERT INTO category_two (name,user,company) VALUES 
                            ('$cat2','$user','$company')";
                         
                        if (mysqli_query($con, $sql4)) {
                            
                            echo "<div class='callout callout-success'><center>NEW CATEGORY 02 ADDED SUCCESSULLY !</center><div>";
                        } else {
                            echo "<div class='callout callout-danger'><center>ADDING CATEGORY 02 HAS BEEN FAILED !</center><div>";
                        }
                    }
     
     
     ?>