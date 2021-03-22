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
                                       <h3 class="box-title" style="color: green; ">All GRNs - Products [<?php echo $start." - ".$end?>]</h3>
                                       <div class="box-tools pull-right">
                                       </div>
                                       </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table id="" class="table table-bordered table-striped">
                                            <thead>

                                               
                                                 <?php
                                                echo "<tr><th><center> GRN # </center><th><center> GRN Date </center></th><th><center> Supplier </center></th><th><center> GRN Total </center></th>
					<th><center> Actions </center><th></tr></tfoot></thead><tbody>";
                                                
                                                $total_price = 0;
                                                $sql18 = "SELECT id,grn_no,supplier_id,date,invoice_no,total_price FROM grn WHERE company='$company' AND stat = '1' AND (enter_date BETWEEN '$start' AND '$end') ORDER BY id ASC";
                                                $result18 = mysqli_query($con, $sql18);
                                                    while ($arraySomething18 = mysqli_fetch_array($result18)) {
                                                        $id = $arraySomething18['id'];
                                                        $grn_no = $arraySomething18['grn_no'];
                                                        $supplier_id = $arraySomething18['supplier_id'];
                                                        $date = $arraySomething18['date'];
                                                        $invoice_no = $arraySomething18['invoice_no'];
                                                        $total_price = $arraySomething18['total_price'];
                                                        
                                                      
                                                        $sql3 = "SELECT company_name FROM supplier WHERE id='$supplier_id'";
                                                        $result3 = mysqli_query($con, $sql3);
                                                        while ($arraySomething3 = mysqli_fetch_array($result3)) {
                                                        $supplier_name = $arraySomething3['company_name'];
                                                        }
                                                      
                                                         echo "<tr><td> <center>".$grn_no . "</center> </td><td> <center>" . $date . "</center> </td><td><center>" .$supplier_name . " <center></td> <td align='right'> ".number_format($total_price,2)."</td>";
                                                              
                                                         echo "<td align='center'><a type='button' title='Click to View the GRN' class='btn btn-default btn-xs confirm_action' href='viewgrn.php?id=".$id."'>
																 <span class='glyphicon glyphicon-share' aria-hidden='true'></span> </a>";
                                                         
                                                            }
                              
                                                                        
                                                                       
                                            ?>
                                                    </table>
                                                    </div>
                                                </div>
                                        </div>
                              </div>
                               
         <?php } ?>