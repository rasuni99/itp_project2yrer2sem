<?php
     include 'connection.php';
include 'header.php';
// $user = $_SESSION['sess_user_id'];
// $company = $_SESSION['sess_company'];
     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        
                        $cat3 = STRTOUPPER($_POST['cat3']);
                        $sql4 = "INSERT INTO row_category_three (name,user,company) VALUES 
                            ('$cat3','$user','$company')";
                         
                        if (mysqli_query($con, $sql4)) {
                            
                            echo "<div class='callout callout-success'><center>NEW CATEGORY 03 FOR ROW ITEMS ADDED SUCCESSULLY !</center><div>";
                        } else {
                            echo "<div class='callout callout-danger'><center>ADDING FOR ROW ITEMS CATEGORY 03 HAS BEEN FAILED !</center><div>";
                        }
                    }
     
     
     ?>