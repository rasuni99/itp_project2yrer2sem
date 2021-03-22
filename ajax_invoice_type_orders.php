 <?php
include 'header.php';
include 'connection.php';

if ($_POST) {
    $customer = $_POST['customer'];
    if ($customer != '') {

?>
<div class="col-md-2">
                <div class="form-group">
                <label>Invoice Type</label>
                <select class="form-control select2" style="width: 100%;" name="vat" id="vat" required>
                <option value=""> SELECT INVOICE TYPE </OPTION>
                <option value="NON_VAT"> NON VAT INVOICE  </OPTION>
            <?php
                            $sql11 = "SELECT vat_no FROM company_customer WHERE id='$customer'";
                            $result1 = mysqli_query($con, $sql11);
                                while ($arraySomething1 = mysqli_fetch_array($result1)) {
                                    $vat_no = $arraySomething1['vat_no'];
                                }       
                                    if($vat_no==""){
                                           
                                    }else{
                                        ?>
                                    
                                        <option value="VAT"> <?php echo "VAT INVOICE" ?> </option>;
                                      
                                     <?php }
                                              ?>              
                                   
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
