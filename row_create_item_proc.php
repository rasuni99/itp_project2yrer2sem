<?php
include 'connection.php';
include 'header.php';
// $user = $_SESSION['sess_user_id'];
// $company = $_SESSION['sess_company'];
     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        
                        $cat1 = $_POST['cat1'];
                        $cat2 = $_POST['cat2'];
                        $cat3 = $_POST['cat3']; 
                        $cat4 = $_POST['cat4'];
                        $reorderlevel = $_POST['reorderlevel'];
                        
                        $sql = "SELECT id FROM row_item WHERE cat1='$cat1' AND cat2='$cat2' AND cat3='$cat3' AND cat4='$cat4' AND company='$company' AND stat='1'";
                        $result = mysqli_query($con, $sql);
                        $item_count = mysqli_num_rows($result);
                        
                        if($item_count>0){
                            echo "<div class='callout callout-danger'><center>ADDING ROW ITEM HAS BEEN FAILED ! ITEM IS ALREADY EXISTS.</center><div>";
                        }
                        else{
                        $sql4 = "INSERT INTO row_item (cat1,cat2,cat3,cat4,reorder_level,user,company) VALUES 
                            ('$cat1','$cat2','$cat3','$cat4','$reorderlevel','$user','$company')";
                         
                        if (mysqli_query($con, $sql4)) {
                            
                            echo "<div class='callout callout-success'><center>NEW ROW ITEM ADDED SUCCESSULLY !</center><div>";
                        } else {
                            echo "<div class='callout callout-danger'><center>ADDING ROW ITEM HAS BEEN FAILED !</center><div>";
                        }
                    }
     }
     
     ?>