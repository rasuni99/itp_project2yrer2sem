<!DOCTYPE html>
<html>
    <head>
	
    <style>html,body{margin:0;height:100%;}</style>
<script>



function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
</script>
        <?php
        include 'header.php';
        include 'connection.php';
        // $company = $_SESSION['sess_company'];
        $today = date('Y-m-d');
        $lastdate = "";
        ?>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
        <script src="bower_components/morris.js/morris.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.js"></script>
        <script src="bower_components/morris.js/examples/lib/example.js"></script>

        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.css">
        <link rel="stylesheet" href="bower_components/morris.js/morris.css">

    </head>
    <body class="hold-transition skin-green sidebar-mini" onload="startTime()">


        <div class="wrapper">
            <?php
            include 'headerbar.php';
            ?>
                        
                        <?php
                        include 'sidebar.php';
                        ?>
                       
            

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <?php
                    $special_message = "";
                    $year = date('Y');
                    $month = date('m');
                    $system_end_date = date('Y-m-d');
                     $query6 = "SELECT owner,subscription,warning,subscription_date,subscription_charge,special_message FROM company WHERE id='$company' ";
                     $result6 = mysqli_query($con, $query6);
                        while ($row1 = mysqli_fetch_array($result6)) {
                            $owner = $row1['owner'];
                            $subscription = $row1['subscription'];
                            $warning = $row1['warning'];
                            $subscription_date = $row1['subscription_date'];
                            $subscription_charge = $row1['subscription_charge']; 
                            $special_message = $row1['special_message'];
                            
                                    }
                            $date = date('d', strtotime($subscription_date));
                            $dates_to_stop = $date - (date('d'));   
                            
                    if($special_message!=""){
                    ?>
                    <div class="callout callout-success">
                        <h4><center>Special Message!</center></h4>         
                    <p><center>Dear <?php echo $owner.", ".$special_message; ?></center></p>
                    </div>       
                  
                    <?php
                    }
                    if($warning==1){
                    ?>   
                    
                        <?php
                        if($dates_to_stop<=3 && $dates_to_stop>0) { ?>
                     <div class="callout callout-danger">
                    <h4><center>Account Suspession. Only <?php echo $dates_to_stop." ";  ?> Days more!</center></h4>         
                    <p><center>Dear <?php echo $owner; ?>, Please kindly note. You couldn't pay your monthly subscription charge yet. Please make sure to pay your subscription charge (<?php echo "Rs ".$subscription_charge.".00" ?>)
                    on or before <?php echo $year."-". $month."-".$date."." ;  ?> If you have paid it already please ignore this warning and let the System Admininistrator know by dialing 071-560-6919. Thank you</center></p>
                    </div>           
                    
                        <?php }
                        else if($dates_to_stop<=5 && $dates_to_stop>0) { ?>
                    <div class="callout callout-warning">
                        <h4><center>Warning. Only <?php echo $dates_to_stop." ";  ?> Days more!</center></h4>         
                    <p><center>Dear <?php echo $owner; ?>, Please kindly note. You couldn't pay your monthly subscription charge yet. Please make sure to pay your subscription charge (<?php echo "Rs ".$subscription_charge.".00" ?>)
                    on or before <?php echo $year."-". $month."-".$date.".";  ?> If you have paid it already please ignore this warning and let the System Admininistrator know by dialing 071-560-6919. Thank you</center></p>
                    </div>
                    
                    <?php
                    }
                    
                    }
                    ?>
                    
                    <h1>
                       <?php
                        
                        echo "Date : ".date('Y-M-d')." ".date('l')."  &nbsp&nbsp&nbsp&nbsp&nbsp  Time : <span id='txt'></span> ";
                        ?>
                        
                       
                        <small>Version 1.0</small>
                    </h1>
                     
                   
                </section>
               

                <!-- Main content -->
                <section class="content">
            <div class="row">
                  <div class="col-md-12">     
                      
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-blue"><i class="ion-model-s"></i></span>
                                    <?php
                                    $sql = "SELECT id FROM company_customer WHERE company = '$company' AND stat='1'";
                                    $result = mysqli_query($con, $sql);
                                    $cus_count = mysqli_num_rows($result);
                                    ?>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Customers</span>
                                        <span class="info-box-number"><?php echo $cus_count; ?></span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="ion-speedometer"></i></span>
                                <?php
                                
                                $total_cash = 0;
                                                $salutation = $customer_name = "";
                                                $sql18 = "SELECT amount FROM cash_book WHERE company='$company' AND stat = '1' AND payment_received='1' ";
                                                $result18 = mysqli_query($con, $sql18);
                                                    while ($arraySomething18 = mysqli_fetch_array($result18)) {
                                                        $amount = $arraySomething18['amount'];
                                                        $total_cash = $total_cash + $amount;
                                                    }
                                                        
                                ?>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Income<br> </span>
                                    <span class="info-box-number">0.00<?php //echo number_format($total_cash,2) ?></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->

                        <!-- fix for small devices only -->
                        <div class="clearfix visible-sm-block"></div>

                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="ion-trophy"></i></span>
                                
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Cash</span>
                                    <span class="info-box-number"><?php echo "0.00"; ?></span>
                                    
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-orange"><i class="ion-cash"></i></span>
                                <?php
                               
                                ?>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Credit</span>
                                    <span class="info-box-number"><?php echo "0.00"; ?></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                    </div> 
                        </div>  
                
                    <div class="row">
                  <div class="col-md-12">     
                      
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-blue"><i class="ion-model-s"></i></span>
                                    <?php
                                    $sql = "SELECT id FROM company_customer WHERE company = '$company' AND stat='1'";
                                    $result = mysqli_query($con, $sql);
                                    $cus_count = mysqli_num_rows($result);
                                    ?>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Pending Company's Cheques</span>
                                        <span class="info-box-text">(18)</span>
                                        <span class="info-box-number"><?php echo "0.00"; ?></span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="ion-speedometer"></i></span>
                                <?php
                                $cheque_total =0;
                                
                                                $salutation = $customer_name = "";
                                                
                                                       
                                                        $sql191 = "SELECT amount FROM cheque WHERE reject='0' AND realize='0' AND stat='1'";
                                                        $result191 = mysqli_query($con, $sql191);
                                                        while ($arraySomething191 = mysqli_fetch_array($result191)) {
                                                        $cheque_amount = $arraySomething191['amount'];
                                                        $cheque_total = $cheque_amount + $cheque_total;
                                                        }
                                                        
                                                        $no_of_cheques = mysqli_num_rows($result191);
                                                        
                                                    
                                                        
                                ?>
                                <div class="info-box-content">
                                    <span class="info-box-text">Pending Customer's Cheques </span>
                                    <span class="info-box-text">0.00<?php //echo "(".$no_of_cheques.")";  ?></span>
                                    <span class="info-box-number">(0)<?php //echo $cheque_total; ?></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->

                        <!-- fix for small devices only -->
                        <div class="clearfix visible-sm-block"></div>

                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="ion-trophy"></i></span>
                                <?php
                                 $cheque_amount_total = $cheque_amount = 0;
                                $sql18 = "SELECT amount FROM cheque WHERE company='$company' AND stat = '1' AND reject='1'";
                                $result18 = mysqli_query($con, $sql18);
                                    while ($arraySomething18 = mysqli_fetch_array($result18)) {
                                        $cheque_amount = $arraySomething18['amount'];
                                        $cheque_amount_total = $cheque_amount_total + $cheque_amount;
                                    }
                                $return_number=mysqli_num_rows($result18);
                                
                                ?>
                                <div class="info-box-content">
                                    <span class="info-box-text">Customer's Return Cheques</span>
                                    <span class="info-box-text"><?php echo "(".$return_number.")" ?></span>
                                    <span class="info-box-number">0.00<?php //echo number_format($cheque_amount_total,2); ?></span>
                                    
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-orange"><i class="ion-cash"></i></span>
                                <?php
                               
                                ?>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Income (Last 7 Days)</span>
                                    <span class="info-box-number"><?php echo "0.00"; ?></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                    </div> 
                        </div>  
                    <?php
                    $sql12 = "SELECT SUM(net_amount) AS amount FROM invoice WHERE convert_to_invoice='0' AND company='$company' AND stat = '1' ORDER BY date ASC";
                    $sql = "SELECT invoice_no,net_amount,type,customer_id,date FROM invoice WHERE convert_to_invoice='0' AND company='$company' AND stat = '1' ORDER BY date ASC";
					$result = mysqli_query($con, $sql);
					$result12 = mysqli_query($con, $sql12);
					while ($arraySomething1 = mysqli_fetch_array($result12)) {
						$all_amount = $arraySomething1['amount'];
						}
                    $count_incomplete_orders = mysqli_num_rows($result);
                    
                    ?>
                    
                    <div class="row">
                      <div class='col-xs-12'>
                          <div class='box box-primary'>
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>In-completed Orders (<?php echo " ".$count_incomplete_orders." "; ?>)  (Rs. <?php echo " ".number_format($all_amount,2)." "; ?>)</h3></strong></h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-wrench"></i></button>

                                        </div>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <table id="example18" class="table table-bordered table-striped">
                                            <thead>

                                               
                                                <?php
                                                echo "<tr><th><center> Order # </center></th><th><center> Date </center></th><th><center> Customer Name </center></th><th><center> Customer Phone </center></th><th><center> Address </center></th><th><center> Sales Type </center></th><th><center> Amount </center></th>
					</tr></tfoot></thead><tbody>";
                                           
                                                $type = 0;
                                                
                                                $sql = "SELECT invoice_no,net_amount,type,customer_id,date FROM invoice WHERE convert_to_invoice='0' AND company='$company' AND stat = '1' ORDER BY date ASC";
                                                $result = mysqli_query($con, $sql);
                                                    while ($arraySomething1 = mysqli_fetch_array($result)) {
                                                        $invoice_no = $arraySomething1['invoice_no'];
                                                        $net_amount = $arraySomething1['net_amount'];
                                                        $sales_type = $arraySomething1['type'];
                                                        $customer_id = $arraySomething1['customer_id'];
                                                        $date = $arraySomething1['date'];
                                                       
                                                            $sql16 = "SELECT id,type_customer,company_name,company_address,company_phone,salutation,person,person_mobile FROM company_customer WHERE id='$customer_id'";
                                                            $result16 = mysqli_query($con, $sql16);
                                                            while ($arraySomething16 = mysqli_fetch_array($result16)) {
                                                                $id = $arraySomething16['id'];
                                                                $salutation = $arraySomething16['salutation'];
                                                                $type = $arraySomething16['type_customer'];
                                                                $company_name = $arraySomething16['company_name'];
                                                                $company_phone = $arraySomething16['company_phone'];
                                                                $name = $arraySomething16['person'];
                                                                $mobile = $arraySomething16['person_mobile'];
                                                                $company_address = $arraySomething16['company_address'];


                                                                if($type==2){
                                                                        $customer_name = $company_name;
                                                                        $customer_phone = $company_phone;
                                                                        $salutation = "";
                                                                }else{
                                                                        $customer_name = $name;
                                                                        $customer_phone = $mobile;
                                                                } 
                                                            }
                        
                                                        
                                                         echo "<tr><td> &nbsp" .  $invoice_no . " </td><td> &nbsp" .  $date . " </td><td> &nbsp" .  $salutation." ".$customer_name . " </td><td align='center'> &nbsp" . $customer_phone." </td><td align='left'> &nbsp" . $company_address." </td><td align='left'> &nbsp" . $sales_type. " </td><td align='right'>" . number_format($net_amount,2) . "</td>";
                                                                                
                                                               
                                                                   
                                                            }

                                           
                                            ?>
                                                    </table>
                            </div>
                        </div> 
                    </div>
                    
                    <div class="row">
                      <div class='col-xs-12'>
                          <div class='box box-primary'>
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>Credit Invoices</h3></strong></h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-wrench"></i></button>

                                        </div>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                               <table id="example18" class="table table-bordered table-striped">
                                            <thead>

                                               
                                                <?php
                                                echo "<tr><th><center> Invoice # </center></th><th><center> Invoice Date </center></th>
                                                    <th><center> Customer </center></th>
                                                    <th><center> Contact </center></th>
                                                    <th><center> Invoice Amount </center></th>
                                                    <th><center> Actions</center></th>
					</tr></tfoot></thead><tbody>";
//                                                $cheque_total = $net_total = 0; 
//                                                $salutation = $customer_name = "";
//                                                $sql18 = "SELECT id,invoice_no,net_amount,updated_paid_amount,paid_amount,customer_id,DATE(date_enter) AS date,user FROM invoice WHERE company='$company' AND stat = '1' AND user='$user' AND type LIKE 'SALECREDIT' ORDER BY id ASC";
//                                                $result18 = mysqli_query($con, $sql18);
//                                                    while ($arraySomething18 = mysqli_fetch_array($result18)) {
//                                                        $invoice_id = $arraySomething18['id'];
//                                                        $invoice_no = $arraySomething18['invoice_no'];
//                                                        $net_amount = $arraySomething18['net_amount'];
//                                                        $paid_amount = $arraySomething18['paid_amount'];
//                                                        $updated_paid_amount = $arraySomething18['updated_paid_amount'];
//                                                        $customer_id = $arraySomething18['customer_id'];
//                                                        $entered_date = $arraySomething18['date'];
//                                                        $invoice_user_id = $arraySomething18['user'];
//                                                        
//                                                        $sql15 = "SELECT username FROM users WHERE id='$invoice_user_id'";
//                                                        $result15 = mysqli_query($con, $sql15);
//                                                        while ($arraySomething15 = mysqli_fetch_array($result15)) {
//                                                        $invoice_user = $arraySomething15['username'];
//                                                        }
//                                                        
//                                                        $sql19 = "SELECT type_customer,company_name,salutation,person FROM company_customer WHERE id='$customer_id'";
//                                                        $result19 = mysqli_query($con, $sql19);
//                                                        while ($arraySomething19 = mysqli_fetch_array($result19)) {
//                                                        $type_customer = $arraySomething19['type_customer'];
//                                                        $company_name = $arraySomething19['company_name'];
//                                                        $salutation = $arraySomething19['salutation'];
//                                                        $person = $arraySomething19['person'];
//                                                        
//                                                        }
//                                                        
//                                                        $sql191 = "SELECT amount FROM cheque WHERE invoice_id='$invoice_id' AND realize='0' AND reject='0'";
//                                                        $result191 = mysqli_query($con, $sql191);
//                                                        while ($arraySomething191 = mysqli_fetch_array($result191)) {
//                                                        $cheque_amount = $arraySomething191['amount'];
//                                                        $cheque_total = $cheque_amount + $cheque_total;
//                                                        }
//                                                        
//                                                        $due_amount = $net_amount - $updated_paid_amount;
//                                                        $cash_due = $due_amount - $cheque_total;
//                                                        
//                                                        if($type_customer==2){
//                                                            $salutation = "";
//                                                            $customer_name = $company_name;
//                                                        }
//                                                        else
//                                                            $customer_name = $person;
//                                                        
//                                                        
//                                                        if($due_amount>0){
//                                                        echo "<tr><td> <center>".$invoice_no. "</center> </td><td align='left'>".$salutation." ".$customer_name. "</td><td> <center>" . $invoice_user . "</center> </td> <td><center>" .$entered_date. " <center></td><td align='right'> ".number_format($net_amount,2)."</td><td align='right'> ".number_format($updated_paid_amount,2)."</td><td align='right'> ".number_format($due_amount,2)."</td><td align='right'> ".number_format($cheque_total,2)."</td><td align='right' style='color:red'><b> ".number_format($cash_due,2)."</b></td>";
//                                                                 
//                                                        echo "<td align='center'><a type='button' title='Click to resolve the Credits' class='btn btn-default btn-xs confirm_action' href='resolve_credit.php?id=".$invoice_id."'>
//																 <span class='glyphicon glyphicon-share' aria-hidden='true'></span> </a>";  
//                                                       
//                                                              }
//                                                        }
                                           
                                            ?>
                                                    </table>

                            </div>
                        </div> 
                    </div> 
                    
                    
                    <div class="row">
                      <div class='col-xs-12'>
                          <div class='box box-primary'>
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>Customer' Cheques - Realization Pending  as <?php echo $today ?></h3></strong></h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-wrench"></i></button>

                                        </div>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <?php
                                
                                echo " <table id='example1' class='table table-bordered table-striped'><thead>";

                                echo "<tr><th><center> Invoice No </center></th><th><center> Receipt No </center></th><th><center> Customer </center></th><th><center> Contact </center></th>
                                                                <th><center> Cheque No </center></th> <th><center> Bank </center></th>
                                                                <th><center> Cheque Date </center></th><th><center> Amount </center></th><th><center> Realize </center></th><th><center> Return </center></th>
                                                                </tr><tfoot></thead><tbody>";
                                $cheque_id =  0;
                                $customername = $mobile = $registration_no  = $bank = $cheque_no = $amount = $cheque_date = "";
                                $query1 = "SELECT id,invoice_id,cheque_no,bank,DATE(cheque_date) AS cheque_date,amount FROM cheque WHERE company = '$company' AND stat='1' AND realize='0' AND reject='0' ORDER BY id ASC ";
                                $result1 = mysqli_query($con, $query1);
                                 while ($row = mysqli_fetch_array($result1)) {
                                    $cheque_id = $row['id'];
                                    $cheque_no = $row['cheque_no'];
                                    $invoice_id = $row['invoice_id'];
                                    $bank_id = $row['bank'];
                                    $cheque_date = $row['cheque_date'];
                                    $amount= $row['amount'];
                                    
                                $query11 = "SELECT receipt_no FROM cash_book WHERE payment_type_id='$cheque_id' ";
                                $result11 = mysqli_query($con, $query11);
                                 while ($row1 = mysqli_fetch_array($result11)) {
                                    $receipt_no = $row1['receipt_no'];
                                 }
                                 
                                $query4 = "SELECT name FROM banks WHERE id='$bank_id' ";
                                $result4 = mysqli_query($con, $query4);
                                while ($row4 = mysqli_fetch_array($result4)) {
                                    $bank = $row4['name'];
                                }
                                    
                                $query5 = "SELECT invoice_real_no,customer_id FROM invoice_real WHERE id='$invoice_id' ";
                                $result5 = mysqli_query($con, $query5);
                                while ($row5 = mysqli_fetch_array($result5)) {
                                    $invoice_no = $row5['invoice_real_no'];
                                    $customer_id = $row5['customer_id'];
                                }  
                                $type_customer = $compny_name = $company_phone = $person = $person_mobile = $customer = $contact = '';
                                    $query2 = "SELECT type_customer,company_name,company_phone,person,person_mobile FROM company_customer WHERE id='$customer_id'";
                                    $result2 = mysqli_query($con, $query2);
                                    while ($row2 = mysqli_fetch_array($result2)) {
                                        $type_customer = $row2['type_customer'];
                                        $company_name= $row2['company_name'];
                                        $company_phone = $row2['company_phone'];
                                        $person = $row2['person'];
                                        $person_mobile = $row2['person_mobile'];
                                    }
                                    
                                    if($type_customer==2){
                                        $customer = $company_name;
                                        $contact = $company_phone;
                                    }
                                    else{
                                        $customer = $person;
                                        $contact = $person_mobile;
                                    }

                                
                                     
                                    
                                   
                                echo "<tr><td><center>".$invoice_no . "</center> </td><td><center>".$receipt_no . "</center> </td><td align='left'>" . $customer . "</center> </td><td><center>" . $contact . "</center></td><td align='center'> &nbsp" . $cheque_no . "</td>
                                <td align='left'> " . strtoupper($bank). " </td><td align='center'> ".$cheque_date." </td><td align='right'> ".number_format($amount,2)." </td>";
                                

                                echo "<td align='center'> <a type='button' title='Click to realize the cheque' class='btn btn-default btn-xs confirm_action' href='realize_cheque.php?chequeid=".$cheque_id."'>
																 <span class='glyphicon glyphicon-ok' aria-hidden='true'></span> </a></td>
                                                                                                                                 
                                <td align='center'><a type='button' title='Click to mark the cheque return' class='btn btn-default btn-xs confirm_action' href='return_cheque.php?cid=".$cheque_id."'>
																 <span class='glyphicon glyphicon-remove' aria-hidden='true'></span> </a></td></tr>";  
                                 }
                               echo "</table></div>";
                                ?>

                            </div>
                                  <footer>
                                            <div class="pull-right hidden-xs">
                                              <b>Version</b> 1.1.0 (Build 20180328)
                                            </div>
                                            <strong>Copyright &copy; 2018-2019 <a href="http://dpsoftwares.net">dpSolutions</a>.</strong> All Rights
                                            Reserved.
                                          </footer>       
                        </div> 
                       
                    </div> 

 
                </section>  
                 
                 
                 
                 </div> 
                    
                
               

  </div>   
                      

 <script src="bower_components/jquery/dist/jquery.min.js"></script>
                                            <!-- Bootstrap 3.3.7 -->
                                            <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
                                            <!-- DataTables -->
                                            <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
                                            <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
                                            <!-- SlimScroll -->
                                            <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
                                            <!-- FastClick -->
                                            <script src="bower_components/fastclick/lib/fastclick.js"></script>
                                            <!-- AdminLTE App -->
                                            <script src="dist/js/adminlte.min.js"></script>
                                            <!-- AdminLTE for demo purposes -->
                                            <script src="dist/js/demo.js"></script>
                                            <script src="plugins/iCheck/icheck.min.js"></script>
                                            
                                            
                       
</body>
</html>
