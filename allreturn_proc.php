<?php   
include 'connection.php';
include 'header.php';
// $user = $_SESSION['sess_user_id'];
// $company = $_SESSION['sess_company'];

         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
             $start = $_POST['start'];
             $end = $_POST['end'];
             $start = date('Y-m-d', strtotime(str_replace('-', '/', $start)));
             $end = date('Y-m-d', strtotime(str_replace('-', '/', $end)));
        ?>
        <div class="row">
                        <div class='col-xs-12'>
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                       <h3 class="box-title" style="color: green; ">All Return Notes [<?php echo $start." - ".$end?>]</h3>
                                       <div class="box-tools pull-right">
                                       </div>
                                       </div>
                                    <!-- /.box-header --> 
                                    <div class="box-body">
                                        <table id="" class="table table-bordered table-striped">
                                            <thead>

                                                <?php
                                                echo "<tr><th><center> Return # </center></th><th><center> Customer </center></th><th><center> Address </center></th><th><center> Return User </center></th><th><center> Returned Date </center></th><th><center> Return Type </center></th><th><center> Return Amount </center></th><th><center> Actions</center></th>
					</tr></tfoot></thead><tbody>";
                                               
                                                $salutation = $customer_name = "";
                                                $sql18 = "SELECT id,return_number,net_amount,customer_id,DATE(date_enter) AS date,user,type FROM invoice_return WHERE company='$company' AND stat = '1' AND (DATE(date_enter) >= '$start' AND DATE(date_enter) <= '$end') ORDER BY id ASC";
                                                $result18 = mysqli_query($con, $sql18);
                                                    while ($arraySomething18 = mysqli_fetch_array($result18)) {
                                                        $return_id = $arraySomething18['id'];
                                                        $return_no = $arraySomething18['return_number'];
                                                        $net_amount = $arraySomething18['net_amount'];
                                                        $type = $arraySomething18['type'];
                                                        $customer_id = $arraySomething18['customer_id'];
                                                        $entered_date = $arraySomething18['date'];
                                                        $return_user_id = $arraySomething18['user'];
                                                      
                                                        
                                                        $sql15 = "SELECT name FROM users WHERE id='$return_user_id'";
                                                        $result15 = mysqli_query($con, $sql15);
                                                        while ($arraySomething15 = mysqli_fetch_array($result15)) {
                                                        $return_user = $arraySomething15['name'];
                                                        }
                                                        
                                                        
                                                        
                                                        $sql19 = "SELECT type_customer,company_name,salutation,person,company_address FROM company_customer WHERE id='$customer_id'";
                                                        $result19 = mysqli_query($con, $sql19);
                                                        while ($arraySomething19 = mysqli_fetch_array($result19)) {
                                                        $type_customer = $arraySomething19['type_customer'];
                                                        $company_name = $arraySomething19['company_name'];
                                                        $salutation = $arraySomething19['salutation'];
                                                        $person = $arraySomething19['person'];
                                                        $company_address = $arraySomething19['company_address'];
                                                        
                                                        }
                                                        
                                                        
                                                        if($type_customer==2){
                                                            $salutation = "";
                                                            $customer_name = $company_name;
                                                        }
                                                        else
                                                            $customer_name = $person;
                                                        
                                                        
                                                        
                                                        echo "<tr><td> <center>".$return_no. "</center> </td><td align='left'>".$salutation." ".$customer_name. "</td><td align='left'>" . $company_address . " </td><td>" . $return_user . "</td><td><center>" .$entered_date. " <center></td><td><center>" .$type. " <center></td><td align='right'> ".number_format($net_amount,2)."</td>";
                                                                 
                                                        echo "<td align='center'><a type='button' title='Click to View this Invoice' class='btn btn-default btn-xs confirm_action' target='_blank' href='view_return.php?id=".$return_id."'>
																 <span class='glyphicon glyphicon-share' aria-hidden='true'></span> </a>";  
                                                      
                                                            }
                                           
                                            ?>
                                               
                                                    </table>
                                                    </div>
                                                </div>
                                        </div>
                              </div>
                               
         <?php } ?>