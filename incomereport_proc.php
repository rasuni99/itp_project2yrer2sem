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
                                       <h3 class="box-title" style="color: green; ">All Cash Receipts</h3>
                                       <div class="box-tools pull-right">
                                       </div>
                                       </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table id="" class="table table-bordered table-striped">
                                            <thead>

                                               
                                                 <?php
                                                echo "<tr><th><center> Receipt # </center></th><th><center> Type </center></th><th><center> Receipt Date </center></th><th><center> Amount </center></th>
					</tr></tfoot></thead><tbody>";
                                           
                                                $net_cash = $amount = 0;
                                                $sql18 = "SELECT id,receipt_no,amount,payment_type,entered_date FROM cash_book WHERE payment_type='CASH' AND company='$company' AND stat = '1' AND (entered_date BETWEEN '$start' AND '$end') ORDER BY id ASC";
                                                $result18 = mysqli_query($con, $sql18);
                                                    while ($arraySomething18 = mysqli_fetch_array($result18)) {
                                                        $receipt_id1 = $arraySomething18['id'];
                                                        $receipt_no = $arraySomething18['receipt_no'];
                                                        $amount = $arraySomething18['amount'];
                                                        $pay_type = $arraySomething18['payment_type'];
                                                        $receipt_date = $arraySomething18['entered_date'];
                                                       
                                                        $net_cash = $amount + $net_cash;
                                                        
                                                        
                                                         echo "<tr><td> <center>" .$receipt_no. "</center> </td><td><center>" .  $pay_type . " <center></td><td> <center> ".$receipt_date." </center> </td><td align='right'> ".number_format($amount,2)."</td>";
                                                                 
                                                                  
                                                            }
                              
                                                                        echo "</tbody><tfoot><tr><th><center> Receipt # </center></th><th><center> Type </center></th><th><center> Receipt Date </center></th><th><center> Amount </center></th> </tr></tfoot> ";
                                                                       
                                            ?>
                                                    </table>
                                                    </div>
                                                </div>
                                        </div>
                              </div>
                
                <div class="row">
                        <div class='col-xs-12'>
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                       <h3 class="box-title" style="color: green; ">All Cheque Receipts</h3>
                                       <div class="box-tools pull-right">
                                       </div>
                                       </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table id="" class="table table-bordered table-striped">
                                            <thead>

                                                <?php
                                                echo "<tr><th><center> Receipt # </center></th><th><center> Type </center></th><th><center> Cheque No </center></th><th><center> Cheque Date </center></th><th><center> Status </center></th><th><center> Receipt Date </center></th><th><center> Amount </center></th> 
					</tr></tfoot></thead><tbody>";
                                           
                                                $net_cheque = $amount = 0;
                                                $sql1 = "SELECT id,receipt_no,amount,payment_type,payment_type_id,entered_date FROM cash_book WHERE payment_type = 'CHEQUE' AND company='$company' AND stat = '1' AND (entered_date BETWEEN '$start' AND '$end') ORDER BY id ASC";
                                                $result1 = mysqli_query($con, $sql1);
                                                    while ($arraySomething1 = mysqli_fetch_array($result1)) {
                                                        $receipt_id1 = $arraySomething1['id'];
                                                        $receipt_no5 = $arraySomething1['receipt_no'];
                                                        $amount = $arraySomething1['amount'];
                                                        $pay_type = $arraySomething1['payment_type'];
                                                        $pay_type_id_ch = $arraySomething1['payment_type_id'];
                                                        $receipt_date = $arraySomething1['entered_date'];
                                                        $job_no1 = $arraySomething1['job_no'];
                                                        
                                                        $sql25 = "SELECT cheque_no,DATE(cheque_date) AS cheque_date,realize FROM cheque WHERE id='$pay_type_id_ch' ";
                                                        $result25 = mysqli_query($con, $sql25);
                                                        while ($arraySomething25 = mysqli_fetch_array($result25)) {
                                                        $cheque_no = $arraySomething25['cheque_no'];
                                                        $cheque_date = $arraySomething25['cheque_date'];
                                                        $realize = $arraySomething25['realize'];
                                                        }
                                                        
                                                        if($realize == '1')
                                                            $cheque_status = "REALIZED";
                                                            else
                                                                $cheque_status = "REALIZING PENDING";
                                                        
                                                        $net_cheque = $amount + $net_cheque;
                                                        
                                                        
                                                        
                                                      
                                                         echo "<tr><td> <center>" .$receipt_no5 . "</center> </td><td><center>" .  $pay_type . " <center></td><td><center>" .  $cheque_no . " <center></td><td><center>" .  $cheque_date . " <center></td>"
                                                                 . "<td><center>" .  $cheque_status . " <center></td><td> <center> ".$receipt_date." </center> </td><td align='right'> ".number_format($amount,2)."</td>";
                                                                 
                                                                  
                                                            }
                              
                                                                        echo "</tbody><tfoot><tr><th><center> Receipt # </center></th><th><center> Type </center></th><th><center> Cheque No </center></th><th><center> Cheque Date </center></th><th><center> Status </center></th><th><center> Receipt Date </center></th><th><center> Amount </center></th> 
					</tr></tfoot> ";
                                                                       
                                            ?>
                                                    </table>
                                                    </div>
                                                </div>
                                        </div>
                              </div>
                
                
                <div class="row">
                        <div class='col-xs-12'>
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                       <h3 class="box-title" style="color: green; ">All Card Receipts</h3>
                                       <div class="box-tools pull-right">
                                       </div>
                                       </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table id="" class="table table-bordered table-striped">
                                            <thead>

                                                <?php
                                                echo "<tr><th><center> Receipt # </center></th><th><center> Type </center></th><th><center> Card No </center></th><th><center> Receipt Date </center></th><th><center> Amount </center></th> 
					</tr></tfoot></thead><tbody>";
                                           
                                               $net_card = $amount = 0;
                                                $sql18 = "SELECT id,receipt_no,amount,payment_type,payment_type_id,entered_date FROM cash_book WHERE payment_type = 'CARD' AND company='$company' AND stat = '1' AND (entered_date BETWEEN '$start' AND '$end') ORDER BY id ASC";
                                                $result18 = mysqli_query($con, $sql18);
                                                    while ($arraySomething18 = mysqli_fetch_array($result18)) {
                                                        $receipt_id1 = $arraySomething18['id'];
                                                        $receipt_no4 = $arraySomething18['receipt_no'];
                                                        $amount = $arraySomething18['amount'];
                                                        $pay_type = $arraySomething18['payment_type'];
                                                        $pay_type_id_ca = $arraySomething18['payment_type_id'];
                                                        $receipt_date = $arraySomething18['entered_date'];
                                                       
                                                        
                                                        $sql11 = "SELECT card_no FROM card WHERE id='$pay_type_id_ca' ";
                                                        $result11 = mysqli_query($con, $sql11);
                                                        while ($arraySomething11 = mysqli_fetch_array($result11)) {
                                                        $card_no = $arraySomething11['card_no'];
                                                        }
                                                        
                                                        $net_card = $amount + $net_card;
                                                        
                                                       
                                                         echo "<tr><td> <center>" . $receipt_no4 . "</center> </td><td><center>" .  $pay_type . " <center></td><td><center>" .  $card_no . "XXXXXXXXXX <center></td><td> <center> ".$receipt_date." </center> </td><td align='right'> ".number_format($amount,2)."</td>";
                                                                 
                                                                  
                                                            }
                              
                                                                        echo "</tbody><tfoot><tr><th><center> Receipt # </center></th><th><center> Type </center></th><th><center> Card No </center></th><th><center> Receipt Date </center></th><th><center> Amount </center></th> ";
                                                                       
                                            ?>
                                                    </table>
                                                    </div>
                                                </div>
                                        </div>
                              </div>


                              <div class="row">
                                             <div class='col-xs-5'>
                                                     <div class="box box-primary">
                                                         <div class="box-header with-border">
                                               <h3 class="box-title" style="color: green;">Income Summery</h3>
                                              <div class="box-tools pull-right">
                                              </div>
                                               </div>
                                     <?php
                                     $net_total = $net_card + $net_cash + $net_cheque;
                                      echo "<table id='example6' class='table table-bordered table-striped'>";
                                     echo "<tr><td>Total Cash : </td><td align='right'>". number_format($net_cash,2) . "</td></tr>";
                                      echo "<tr><td>Total Card : </td><td align='right'>". number_format($net_card,2) . "</td></tr>"     ;
                                      echo "<tr><td>Total Cheque (All) : </td><td align='right'>". number_format($net_cheque,2) . "</td></tr>"     ;
                                      echo "<tr><td><b>Total Income :</b> </td><td align='right'><b>". number_format($net_total,2) . "</b></td></tr> </table>"     ;
                                    ?>
                                             </div>     
                                           </div>
                                  </div>

                                               
         <?php } ?>