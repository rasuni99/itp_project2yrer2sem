<?php
include 'header.php';
include 'connection.php';

if ($_POST) {
   $order_id = $_POST['order'];
    if ($order_id != '') {

        ?>
 <div class="row">
                           <div class='col-xs-12'>
                                <div class="box box-primary">
                                    <div class="box-header with-border">
          <h3 class="box-title" style="color: green; font-weight: bold">Order Details</h3>
          <div class="box-tools pull-right">
          </div>
         </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table id="example1" class="table table-bordered ">
                                            <thead>

                                                <?php
                                                echo "<tr><th><center> Item Name </center></th><th><center> Serial No </center></th><th><center> Description </center></th><th><center> Quantity </center></th><th><center> Unit Price </center></th>
					<th><center> Sub Total</center></th>
					</tr></tfoot></thead><tbody>";
                                           
                                          
                                               $total = 0 ; 
                                                $sql = "SELECT item_name,serial,description,quantity,unit_price FROM invoice_items WHERE invoice_id='$order_id'";
                                                $result = mysqli_query($con, $sql);
                                                    while ($arraySomething1 = mysqli_fetch_array($result)) {
                                                        $item_name = $arraySomething1['item_name'];
                                                        $serial = $arraySomething1['serial'];
                                                        $description = $arraySomething1['description'];
                                                        $quantity = $arraySomething1['quantity'];
                                                        $unit_price = $arraySomething1['unit_price'];
                                                        
                                                        $sub_total = $unit_price * $quantity;
                                                        $total = $total + $sub_total;
                                                     
                                                         echo "<tr><td> &nbsp" .  $item_name . " </td><td> &nbsp" . $serial. " </td><td> &nbsp" . $description. " </td><td align='right'>" . $quantity . "</td><td align='right'> " . number_format($unit_price,2) . "</td>
                                                                <td align='right'> &nbsp" . number_format($sub_total,2) . " </td></tr>";
                                       
                                                            }
                                                         echo "<tr><td colspan='6'></td></tr><tr><td colspan='5'> <b>Total</b></td><td align='right'> &nbsp" . number_format($total,2) . " </td></tr>";    
                                                        
                                                    }                                                                                                   
                                                                       
                                                                        ?>
                                                 </table></div>
                                                </div>
                                                </div>
                                                </div>

<?php

}
?>