<!DOCTYPE html>
<html>
    <head>
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

      
       <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Morris charts -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
 
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
                       
                        <!-- /.col -->

                        <!-- fix for small devices only -->
                        <div class="clearfix visible-sm-block"></div>

                       <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-orange"><i class="ion-cash"></i></span>
                                <?php
                                $start = date('Y-m-01'); 
                                $end  = date('Y-m-t');
                                $sql18 = "SELECT SUM(net_amount)AS amount FROM invoice_real WHERE type='CASH-SALE' AND company='$company' AND stat = '1' AND (DATE(date_enter) >= '$start' AND DATE(date_enter) <= '$end')";
                                                $result18 = mysqli_query($con, $sql18);
                                                    while ($arraySomething18 = mysqli_fetch_array($result18)) {
                                                        $cash_amount = $arraySomething18['amount'];
                                                    }    
                               
                                ?>
                                <div class="info-box-content">
                                    <span class="info-box-text">CASH SALE </span>
                                    <span class="info-box-text">(<?php echo date('F-Y'); ?>)</span>
                                    <span class="info-box-number"><?php echo number_format($cash_amount,2); ?></span>
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
                                $start = date('Y-m-01'); 
                                $end  = date('Y-m-t');
                                $sql18 = "SELECT SUM(net_amount)AS amount FROM invoice_real WHERE type='CREDIT-SALE' AND company='$company' AND stat = '1' AND (DATE(date_enter) >= '$start' AND DATE(date_enter) <= '$end')";
                                                $result18 = mysqli_query($con, $sql18);
                                                    while ($arraySomething18 = mysqli_fetch_array($result18)) {
                                                        $credit_amount = $arraySomething18['amount'];
                                                    }    
                               
                                ?>
                                <div class="info-box-content">
                                    <span class="info-box-text">CREDIT SALE </span>
                                    <span class="info-box-text">(<?php echo date('F-Y'); ?>)</span>
                                    <span class="info-box-number"><?php echo number_format($credit_amount,2); ?></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                         <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="ion-speedometer"></i></span>
                                <?php
                                $start = date('Y-m-01'); 
                                $end  = date('Y-m-t');
                                $sql18 = "SELECT SUM(net_amount)AS amount FROM invoice_real WHERE company='$company' AND stat = '1' AND (DATE(date_enter) >= '$start' AND DATE(date_enter) <= '$end')";
                                                $result18 = mysqli_query($con, $sql18);
                                                    while ($arraySomething18 = mysqli_fetch_array($result18)) {
                                                        $amount = $arraySomething18['amount'];
                                                    }                        
                                ?>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Sale</span>
                                    <span class="info-box-text">(<?php echo date('F-Y'); ?>)</span>
                                    <span class="info-box-number"><?php echo number_format($amount,2) ?></span>
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
                    
                    <div class="row">
                      <div class='col-xs-12'>
                          <div class='box box-primary'>
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>Incompleted Orders</h3></strong></h3>

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
                                                echo "<tr><th><center> Order # </center></th><th><center> Customer Name </center></th><th><center> Customer Phone </center></th><th><center> Address </center></th><th><center> Sales Type </center></th><th><center> Amount </center></th>
					</tr></tfoot></thead><tbody>";
                                           
                                                $type = 0;
                                                
                                                $sql = "SELECT invoice_no,net_amount,type,customer_id,DATE(date_enter) AS date FROM invoice WHERE convert_to_invoice='0' AND company='$company' AND stat = '1' ORDER BY date DESC";
                                                $result = mysqli_query($con, $sql);
                                                    while ($arraySomething1 = mysqli_fetch_array($result)) {
                                                        $invoice_no = $arraySomething1['invoice_no'];
                                                        $net_amount = $arraySomething1['net_amount'];
                                                        $sales_type = $arraySomething1['type'];
                                                        $customer_id = $arraySomething1['customer_id'];
                                                        $date = $arraySomething1['date'];
                                                       
                                                            $sql = "SELECT id,type_customer,company_name,company_address,company_phone,salutation,person,person_mobile FROM company_customer WHERE id='$customer_id'";
                                                            $result = mysqli_query($con, $sql);
                                                            while ($arraySomething1 = mysqli_fetch_array($result)) {
                                                                $id = $arraySomething1['id'];
                                                                $salutation = $arraySomething1['salutation'];
                                                                $type = $arraySomething1['type_customer'];
                                                                $company_name = $arraySomething1['company_name'];
                                                                $company_phone = $arraySomething1['company_phone'];
                                                                $name = $arraySomething1['person'];
                                                                $mobile = $arraySomething1['person_mobile'];
                                                                $company_address = $arraySomething1['company_address'];


                                                                if($type==2){
                                                                        $customer_name = $company_name;
                                                                        $customer_phone = $company_phone;
                                                                        $salutation = "";
                                                                }else{
                                                                        $customer_name = $name;
                                                                        $customer_phone = $mobile;
                                                                } 
                                                            }
                        
                                                        
                                                         echo "<tr><td> &nbsp" .  $invoice_no . " </td><td> &nbsp" .  $salutation." ".$customer_name . " </td><td align='center'> &nbsp" . $customer_phone." </td><td align='center'> &nbsp" . $company_address." </td><td align='right'> &nbsp" . $sales_type. " </td><td align='right'>" . number_format($net_amount,2) . "</td>";
                                                                                
                                                               
                                                                   
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
                                    <h3 class="box-title"><strong>Last 05 Cheque Expenses</h3></strong></h3>

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
                                             
                                                echo "<tr><th><center> Voucher # </center></th><th><center> Expense Type </center></th><th width='12%'><center> Expense Date </center></th><th><center> Amount </center></th>
					</tr></tfoot></thead><tbody>";
                                              // $total_cash = 0; 
                                               
                                                $sql18 = "SELECT id,payee_name,DATE(pay_date) AS date,amount FROM expenses_cheque WHERE company='$company' AND stat = '1'  ORDER BY id DESC LIMIT 5";
                                                $result18 = mysqli_query($con, $sql18);
                                                    while ($arraySomething18 = mysqli_fetch_array($result18)) {
                                                        $id = $arraySomething18['id'];
                                                        $payee_name = $arraySomething18['payee_name'];
                                                        $amount = $arraySomething18['amount'];
                                                        $date = $arraySomething18['date'];
                                                       
                                                       // $total_cash = $total_cash + $amount;
                                                        $voucherno = $id + 10000;
                                                        $voucherno = "VHC".$voucherno;
                                                        echo "<tr><td> <center>".$voucherno. "</center> </td><td align='left'>".$payee_name. "</td><td align='center'>" . $date . "</td> <td align='right'> ".number_format($amount,2)."</td>";
                                                         
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
                                    <h3 class="box-title"><strong>Last 05 Petty Cash Expenses</h3></strong></h3>

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
                                             
                                                echo "<tr><th><center> Voucher # </center></th><th><center> Expense Type </center></th><th width='12%'><center> Expense Date </center></th><th><center> Amount </center></th>
					</tr></tfoot></thead><tbody>";
                                               $total_cash = 0; 
                                               
                                                $sql18 = "SELECT id,payee_name,DATE(pay_date) AS date,amount FROM expenses_cash WHERE company='$company' AND stat = '1'  ORDER BY id DESC LIMIT 5";
                                                $result18 = mysqli_query($con, $sql18);
                                                    while ($arraySomething18 = mysqli_fetch_array($result18)) {
                                                        $id = $arraySomething18['id'];
                                                        $payee_name = $arraySomething18['payee_name'];
                                                        $amount = $arraySomething18['amount'];
                                                        $date = $arraySomething18['date'];
                                                       
                                                        $total_cash = $total_cash + $amount;
                                                        $voucherno = $id + 10000;
                                                        $voucherno = "VH".$voucherno;
                                                        echo "<tr><td> <center>".$voucherno. "</center> </td><td align='left'>".$payee_name. "</td><td align='center'>" . $date . "</td> <td align='right'> ".number_format($amount,2)."</td>";
                                                         
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
                 
        
        <!-- /.col (LEFT) -->
        <div class="col-xs-12">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
               <h3 class="box-title"><strong>Total Sale Vs Income </strong></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="line-chart" style="height: 300px;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- BAR CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Bar Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="bar-chart" style="height: 300px;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (RIGHT) -->
      </div>
          <!-- /.box -->

        </div>   </div>
                                  <footer>
                                            <div class="pull-right hidden-xs">
                                              <b>Version</b> 1.1.0 (Build 20180328)
                                            </div>
                                            <strong>Copyright &copy; 2018-2019 <a href="http://dpsoftwares.net">dpSolutions</a>.</strong> All Rights
                                            Reserved.
                                          </footer>       
                     
                       </div> 
   
            <!-- /.box-body -->
          </div>
 
                </section>  
                 
                 
                 
              
                    
                
               

  </div>    </div>    </div>   
       
                 
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
                       
</body>
</html>
<?php
$thismonth =  date('Y-m');
$month1 = date('Y-m', strtotime(date('Y-m') . " -1 month"));
$month2 = date('Y-m', strtotime(date('Y-m') . " -2 month"));
$month3 = date('Y-m', strtotime(date('Y-m') . " -3 month"));
$month4 = date('Y-m', strtotime(date('Y-m') . " -4 month"));
$month5 = date('Y-m', strtotime(date('Y-m') . " -5 month"));
$month6 = date('Y-m', strtotime(date('Y-m') . " -6 month"));
$month7 = date('Y-m', strtotime(date('Y-m') . " -7 month"));
$month8 = date('Y-m', strtotime(date('Y-m') . " -8 month"));
$month9 = date('Y-m', strtotime(date('Y-m') . " -9 month"));
$month10 = date('Y-m', strtotime(date('Y-m') . " -10 month"));
$month11 = date('Y-m', strtotime(date('Y-m') . " -11 month"));


?>
<script>
  $(function () {
    "use strict";

    // AREA CHART
//    var area = new Morris.Area({
//      element: 'revenue-chart',
//      resize: true,
//      data: [
//        {y: '2011 Q1', item1: 2666, item2: 2666},
//        {y: '2011 Q2', item1: 2778, item2: 2294},
//        {y: '2011 Q3', item1: 4912, item2: 1969},
//        {y: '2011 Q4', item1: 3767, item2: 3597},
//        {y: '2012 Q1', item1: 6810, item2: 1914},
//        {y: '2012 Q2', item1: 5670, item2: 4293},
//        {y: '2012 Q3', item1: 4820, item2: 3795},
//        {y: '2012 Q4', item1: 15073, item2: 5967},
//        {y: '2013 Q1', item1: 10687, item2: 4460},
//        {y: '2013 Q2', item1: 8432, item2: 5713}
//      ],
//      xkey: 'y',
//      ykeys: ['item1', 'item2'],
//      labels: ['Item 1', 'Item 2'],
//      lineColors: ['#a0d0e0', '#3c8dbc'],
//      hideHover: 'auto'
//    });

    // LINE CHART
    var line = new Morris.Line({
      element: 'line-chart',
      resize: true,
      data: [
        {y: '<?php echo $thismonth?>', item1: 2666},
        {y: '<?php echo $month1?>', item1: 2778},
        {y: '<?php echo $month2?>', item1: 4912},
        {y: '<?php echo $month3?>', item1: 3767},
        {y: '<?php echo $month4?>', item1: 6810},
        {y: '<?php echo $month5?>', item1: 5670},
        {y: '<?php echo $month6?>', item1: 4820},
        {y: '<?php echo $month7?>', item1: 15073},
        {y: '<?php echo $month8?>', item1: 10687},
        {y: '<?php echo $month9?>', item1: 4820},
        {y: '<?php echo $month10?>', item1: 15073},
        {y: '<?php echo $month11?>', item1: 10687},
       
      ],
      
      xkey: 'y',
      ykeys: ['item1'],
      labels: ['Item 1'],
      lineColors: ['#3c8dbc'],
      hideHover: 'auto'
    });

    //DONUT CHART
//    var donut = new Morris.Donut({
//      element: 'sales-chart',
//      resize: true,
//      colors: ["#3c8dbc", "#f56954", "#00a65a"],
//      data: [
//        {label: "Download Sales", value: 12},
//        {label: "In-Store Sales", value: 30},
//        {label: "Mail-Order Sales", value: 20}
//      ],
//      hideHover: 'auto'
//    });
    //BAR CHART
    var bar = new Morris.Bar({
      element: 'bar-chart',
      resize: true,
      data: [
        {y: '2006', a: 100, b: 90},
        {y: '2007', a: 75, b: 65},
        {y: '2008', a: 50, b: 40},
        {y: '2009', a: 75, b: 65},
        {y: '2010', a: 50, b: 40},
        {y: '2011', a: 75, b: 65},
        {y: '2012', a: 100, b: 90}
      ],
      barColors: ['#00a65a', '#f56954'],
      xkey: 'y',
      ykeys: ['a', 'b'],
      labels: ['CPU', 'DISK'],
      hideHover: 'auto'
    });
  });
</script>

