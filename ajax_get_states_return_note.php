
<?php
include 'header.php';
include 'connection.php';

if ($_POST) {
    $order_id = $_POST['order'];
    if ($order_id != '') {
        
         $sql11 = "SELECT customer_id FROM invoice WHERE id='$order_id'";
                            $result1 = mysqli_query($con, $sql11);
                                while ($arraySomething1 = mysqli_fetch_array($result1)) {
                                    $customer = $arraySomething1['customer_id'];
                                }
        

?>

<div class="col-md-8">
    <div class="col-md-6">
                <div class="form-group">
                <label>Normal Return Note</label>
                <select class="form-control select2" style="width: 100%;" name="normal_return" id="return">
                <option value=""> NORMAL RETURN</OPTION>
            <?php
                    $sql1 = mysqli_query($con,"SELECT id,return_number,net_amount FROM invoice_return WHERE stat='1' AND used='0' AND type='NORMAL-RETURN' AND customer_id='$customer'");
                    while ($row = mysqli_fetch_array($sql1)) {
                     
                    $return_amount = $row['net_amount'] ; 
                    $return_number = $row['return_number'] ;
                    
                            $sql11 = "SELECT id,company_name,salutation,person,type_customer FROM company_customer WHERE id='$customer'";
                            $result1 = mysqli_query($con, $sql11);
                                while ($arraySomething1 = mysqli_fetch_array($result1)) {
                                    $salutation = $arraySomething1['salutation'];
                                    $company_name = $arraySomething1['company_name'];
                                    $type = $arraySomething1['type_customer'];
                                    $name = $arraySomething1['person'];
                                    if($type==2){
                                            $customer_name = $company_name;
                                            $salutation = "";
                                    }else{
                                            $customer_name = $name;
                                      
                                    } 
                                }
                   ?>
                <option value=" <?php echo $row['id'] ?> "> <?php echo " Return # : ".$return_number."  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; [ Return Amount : ".number_format($return_amount,2)." ] " ?> </option>;
                                              <?php }
                                              ?>              
                                   
                </select> 
              </div></div>
    
        <div class="col-md-6">
     <div class="form-group">
                <label>Damage Return Note</label>
                <select class="form-control select2" style="width: 100%;" name="damage_return" id="return">
                <option value=""> DAMAGE RETURN</OPTION>
            <?php
                    $sql1 = mysqli_query($con,"SELECT id,return_number,net_amount FROM invoice_return WHERE stat='1' AND used='0' AND type='DAMAGE-RETURN' AND customer_id='$customer'");
                    while ($row = mysqli_fetch_array($sql1)) {
                     
                    $return_amount = $row['net_amount'] ; 
                    $return_number = $row['return_number'] ;
                    
                            $sql11 = "SELECT id,company_name,salutation,person,type_customer FROM company_customer WHERE id='$customer'";
                            $result1 = mysqli_query($con, $sql11);
                                while ($arraySomething1 = mysqli_fetch_array($result1)) {
                                    $salutation = $arraySomething1['salutation'];
                                    $company_name = $arraySomething1['company_name'];
                                    $type = $arraySomething1['type_customer'];
                                    $name = $arraySomething1['person'];
                                    if($type==2){
                                            $customer_name = $company_name;
                                            $salutation = "";
                                    }else{
                                            $customer_name = $name;
                                      
                                    } 
                                }
                   ?>
                <option value=" <?php echo $row['id'] ?> "> <?php echo " Return # : ".$return_number."  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; [ Return Amount : ".number_format($return_amount,2)." ] " ?> </option>;
                                              <?php }
                                              ?>              
                                   
                </select> 
              </div> </div>
          
            </div>
              
               
              
           <div class="col-md-4">
            <div class="form-group">
                <label>Sales Type<font color='red'> *</font></label>
                <select class="form-control select2" style="width: 100%;" name="sale_type" id="sale_type" required>
                <option value=""> SELECT SALES TYPE </OPTION>
                <option value="CREDIT-SALE"> CREDIT SALE </OPTION>
                <option value="CASH-SALE"> CASH SALE </OPTION>
                </select>
               
              </div>
          
            </div> 

 <?php
}
    else
    {
        echo  '';
    }
}

?>
<script>
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    $('.select3').select2()
    }
    
    </script>