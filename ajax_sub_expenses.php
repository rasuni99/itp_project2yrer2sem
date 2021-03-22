<?php
include 'header.php';
// $company = $_SESSION['sess_company'];
include 'connection.php';


if ($_POST) {
    $payee = $_POST['payee'];
    if ($payee != '') {

       ?>
         <div class="form-group">
                                        <label>Sub Expense<font color='red'> *</font></label>
                                        <select class="form-control select12" style="width: 100%;" name="sub" id="cheque_bank" required="">
                                        <option value=""> SELECT SUB EXPENSE </option>;
                                         <option value="0"> <?php echo strtoupper("NOT APPLICABLE") ?> </option>;
                                              <?php
                                                                      $sql1 = mysqli_query($con,"SELECT id,expense_name FROM expenses_types WHERE stat='1' AND expences_cat_1_id='$payee'");
                                                                      while ($row = mysqli_fetch_array($sql1)) {
                                                                              ?>
                                        <option value=" <?php echo $row['id'] ?> "> <?php echo strtoupper($row['expense_name']) ?> </option>;
                                                                      <?php }
                                                                      ?>
                                        </select>   
                                      </div>
           <?php
           
         // echo $payee; 
    }
}
               ?>
    
 <script>           
$(function () {
    //Initialize Select2 Elements
    $('.select12').select2()
  
     
  

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

