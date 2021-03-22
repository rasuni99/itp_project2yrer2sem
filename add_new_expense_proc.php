<?php
     include 'connection.php';
include 'header.php';
// $user = $_SESSION['sess_user_id'];
// $company = $_SESSION['sess_company'];
     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $cat1 = $_POST['cat1'];
                        $expense_name = STRTOUPPER($_POST['expense_name']);
                        
                        $sql78 = "SELECT name FROM expenses_cat1 WHERE id='$cat1'";
                            $result78 = mysqli_query($con, $sql78);
                                while ($arraySomething78 = mysqli_fetch_array($result78)) {
                                    $name = $arraySomething78['name'];
                                }
                        $expense_final = $name." - ".$expense_name;
                        
                        $sql4 = "INSERT INTO expenses_types (expences_cat_1_id,expense_name,expense_final,user,company) VALUES 
                            ('$cat1','$expense_name','$expense_final','$user','$company')";
                        

                         
                        if (mysqli_query($con, $sql4)) {
                            
                            echo "<div class='callout callout-success'><center>NEW MAIN EXPENSE ADDED SUCCESSULLY !</center><div>";
                        } else {
                            echo "<div class='callout callout-danger'><center>ADDING MAIN EXPENSE HAS BEEN FAILED !</center><div>";
                        }
                    }
     
     
     ?>