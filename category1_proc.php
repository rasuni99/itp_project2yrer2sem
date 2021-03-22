<?php
     include 'connection.php';
include 'header.php';
// $user = $_SESSION['sess_user_id'];
// $company = $_SESSION['sess_company'];
     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        
                        $cat1 = STRTOUPPER($_POST['cat1']);
                        $sql4 = "INSERT INTO category_one (name,user,company) VALUES 
                            ('$cat1','$user','$company')";
                        
//                        $query1 = "SELECT datetime FROM login_history WHERE user = '$id' AND activity='SYSTEM LOGIN' ORDER BY id DESC LIMIT 1";
//                            $result1 = mysqli_query($con,$query1); 
//                            while ($row1 = mysqli_fetch_array($result1)) { 
//                            $datetime = $row1['datetime']; 
//                            }
                         
                        if (mysqli_query($con, $sql4)) {
                            
                            echo "<div class='callout callout-success'><center>NEW CATEGORY 01 ADDED SUCCESSULLY !</center><div>";
                        } else {
                            echo "<div class='callout callout-danger'><center>ADDING CATEGORY 01 HAS BEEN FAILED !</center><div>";
                        }
                    }
     
     
     ?>