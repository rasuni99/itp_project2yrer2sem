<?php
include 'header.php';
// $company = $_SESSION['sess_company'];
include 'connection.php';



if ($_POST) {
    $payee = $_POST['payee_account'];
    if ($payee != '') {

        if($payee==1){
            $sql9 = "SELECT SUM(pettry_cash_in)-SUM(pettry_cash_out) AS petty_cash FROM petty_cash WHERE stat = '1'";
            $result9 = mysqli_query($con, $sql9);
            while ($arraySomething9 = mysqli_fetch_array($result9)) {
                $petty_cash = $arraySomething9['petty_cash'];
        }
        echo '<h4>&nbsp;&nbsp;&nbsp;&nbsp;Petty Cash Balance : Rs. <label for="exampleInputPassword1">'.number_format($petty_cash).'</lable></h4>';
        }
        if($payee==2){
            ?>

            <div class="col-md-1">
                
                <div class="form-group">
                <label for="exampleInputPassword1">Cheque No<font color='red'> *</font></label>
                <input type="text" autocomplete="off" name="cheque_no" class="form-control" id="cheque_no" placeholder="Cheque No" required="">
              </div>
             </div>
                 
                <div class="col-md-5"> 
                <div class="form-group">
                                        <label>Bank Account<font color='red'> *</font></label>
                                        <select class="form-control select5" style="width: 100%;" name="cheque_bank_account" id="cheque_bank" required="">
                                         <option value=""> SELECT BANK ACCOUNT </option>;
                                              <?php
                                              $sql9 = "SELECT id,bank,acc_name,account_no FROM bank_accounts WHERE type='COMPANY' AND stat = '1'";
                                                $result9 = mysqli_query($con, $sql9);
                                                while ($arraySomething9 = mysqli_fetch_array($result9)) {
                                                    $bank_account_id = $arraySomething9['id'];
                                                    $bank = $arraySomething9['bank'];
                                                    $acc_name = $arraySomething9['acc_name'];
                                                    $account_no = $arraySomething9['account_no'];
                                              
                                                    $sql1 = mysqli_query($con,"SELECT name FROM banks WHERE id='$bank'");
                                                    while ($row = mysqli_fetch_array($sql1)) {
                                                    $bank_name = $row['name'];    
                                                    }
                                                            ?>
                      <option value=" <?php echo $bank_account_id; ?> "> <?php echo strtoupper($bank_name)." : ".$acc_name." : ".$account_no ?> </option>;
                                                    <?php }
                                                    ?>
                                        </select>   
                                      </div> 
                </div>
              
              <div class="col-md-2"> 
              <div class="form-group">
                <label>Cheque Date<font color='red'> *</font></label>

                <div class="input-group date">
                  <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                  </div>
                    <input type="text" autocomplete="off" data-date-format='yyyy-mm-dd' name="cheque_date" class="form-control pull-right" id="datepicker" required="">
                </div>  
                 </div>  
              </div> 

               <div class="col-md-4"> 
                <div class="form-group">
                <label for="exampleInputPassword1">Cheque Amount<font color='red'> *</font></label>
                <input type="text" autocomplete="off" name="cheque_amount" class="form-control" id="cheque_amount" placeholder="Enter Cheque Amount" required="">
              </div>
                   </div>
              
          
           
        <?php    
        }
        if($payee==3){
           ?> 
        
           <div class="col-md-4">
            <div class="form-group">
                <label>Customer (Cheque Owner)<font color='red'> *</font></label>
                <select  class="form-control select4" style="width: 100%;" name="customer" id="customer" required>
                <option value=""> SELECT CUSTOMER </OPTION>
                
               <optgroup label="COMPANIES">
                      <?php
                                              $sql80 = mysqli_query($con,"SELECT id,company_name FROM company_customer WHERE type_customer='2' AND stat='1' AND company='$company' ORDER BY company_name  ASC");
                                              while ($row80 = mysqli_fetch_array($sql80)) {
                                                      ?>
                                                      <option value=" <?php echo $row80['id'] ?> "> <?php echo $row80['company_name'] ?> </option>;
                                              <?php }
                                              ?>
               <optgroup label="INDIVIDUAL CUSTOMERS">
                      <?php
                                              $sql81 = mysqli_query($con,"SELECT id,person FROM company_customer WHERE (type_customer='1' OR type_customer='3') AND stat='1' AND company='$company' ORDER BY person  ASC");
                                              while ($row81 = mysqli_fetch_array($sql81)) {
                                                      ?>
                                                      <option value=" <?php echo $row81['id'] ?> "> <?php echo $row81['person'] ?> </option>;
                                              <?php }
                                              ?>
               
                </select>   
              </div>
               </div>
          <div class="col-md-1">
                
                <div class="form-group">
                <label for="exampleInputPassword1">Cheque No<font color='red'> *</font></label>
                <input type="text" autocomplete="off" name="cheque_no" class="form-control" id="cheque_no" placeholder="Cheque No" required="">
              </div>
             </div>
         <div class="col-md-3">
         <div class="form-group">
                                        <label>Bank<font color='red'> *</font></label>
                                        <select class="form-control select3" style="width: 100%;" name="cheque_bank" id="cheque_bank" required="">
                                        <option value=""> SELECT BANK </option>;
                                              <?php
                                                                      $sql1 = mysqli_query($con,"SELECT id,name FROM banks WHERE stat='1' ORDER BY name ASC");
                                                                      while ($row = mysqli_fetch_array($sql1)) {
                                                                              ?>
                                        <option value=" <?php echo $row['id'] ?> "> <?php echo strtoupper($row['name']) ?> </option>;
                                                                      <?php }
                                                                      ?>
                                        </select>   
                                      </div>
             </div>
        
         <div class="col-md-2"> 
                <div class="form-group">
                <label for="exampleInputPassword1">Cheque Amount<font color='red'> *</font></label>
                <input type="text" autocomplete="off" name="cheque_amount" class="form-control" id="cheque_amount" placeholder="Enter Cheque Amount" required="">
              </div>
          </div>
        
        
          <div class="col-md-2"> 
              <div class="form-group">
                <label>Cheque Date<font color='red'> *</font></label>

                <div class="input-group date">
                  <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                  </div>
                    <input type="text" autocomplete="off" data-date-format='yyyy-mm-dd' name="cheque_date" class="form-control pull-right" id="datepicker" required="">
                </div>  
                 </div>  
              </div> 
            
            <?php
            
        }
            
        }
        if($payee==4){
            
            
            
        }
        ?>

          
               
           <?php  
           
         // echo $payee; 
    }   
               ?>
    
 <script>           
$(function () {
    //Initialize Select2 Elements
    $('.select3').select2()
    $('.select4').select2() 
    $('.select5').select2() 
     
  

    //Datemask dd/mm/yyyy
    $('#datepicker').datepicker('mm-dd-yyyy', { 'placeholder': 'dd/mm/yyyy' })
	 $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

  

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
     $('#datepicker1').datepicker({
      autoclose: true
    })
    $('#datepicker2').datepicker({
      autoclose: true
    })
 
  })
    </script>    
    
    <script>
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
        })

</script>
</body>
</html>
