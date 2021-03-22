<!DOCTYPE html>
<?php
include 'header.php';
include 'connection.php';
?>
<head>
    
    
<?php

//if($_POST) {
//    $payee = $_POST['payee'];
//    //$payee = 2;
//    if ($payee != '') {
//
//// $user = $_SESSION['sess_user_id'];
//// $company = $_SESSION['sess_company'];
//$today = date('Y-m-d');
//$connect = new PDO("mysql:host=localhost;dbname=sale_repair", "root", "");
//
//
//
//
//function fill_unit_select_box($connect,$company,$expenses_cat)
//{ 
//
// $output = '';
// $query = "SELECT id,expense_name FROM expenses_types WHERE expences_cat_1_id='$expenses_cat'";
// $statement = $connect->prepare($query);
// $statement->execute();
// $result = $statement->fetchAll();
// foreach($result as $arraySomething1)
// {
//    $expense_name = $arraySomething1['expense_name'];
//    $expense_id = $arraySomething1['id'];
//    
//    
//  $output .= '<option value="'.$expense_id.'">'.$expense_name.'</option>';
// }
// return $output;
//}
?>

 
        
        <script>
            var global_final;
            $(document).ready(function(){
                   
                    var final_total_amt = $('#final_total_amt').text();
                    var count = 1;

                    $(document).on('click', '.add', function(){
                      
                    count++;
                  
                    var html = '';
                     html += '<tr id="row_id_'+count+'">';
                     html += '<td><input autocomplete="off"type="text" style="text-align:left;" name="description[]" id="description'+count+'" class="form-control item_quantity" required/></td>';
                   
                     html += '<td><input autocomplete="off"type="text" style="text-align:center;" name="quantity[]" id="quantity'+count+'" class="form-control item_quantity" required/></td>';
                     html += '<td><input autocomplete="off"type="text" style="text-align:right;" name="unit_price[]" id="unit_price'+count+'"  class="form-control item_quantity" required/></td>';
                     html += '<td><input autocomplete="off" type="text" style="text-align:right;" name="total_price[]" id="total_price'+count+'" class="form-control item_quantity" required/></td>';

                     html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
                     $('#item_table').append(html);
                     
                    $('#item_name2').select2()
                    $('#item_name3').select2()
                    $('#item_name4').select2()
                    $('#item_name5').select2()
                    $('#item_name6').select2()
                    $('#item_name7').select2()
                    $('#item_name8').select2()
                    $('#item_name9').select2()
                    $('#item_name10').select2()
                    $('#item_name11').select2()
                    $('#item_name12').select2()
                    $('#item_name13').select2()
                    $('#item_name14').select2()
                    $('#item_name15').select2()
                    $('#item_name16').select2()
                    $('#item_name17').select2()
                    $('#item_name18').select2()
                    $('#item_name19').select2()
                    $('#item_name20').select2()
                    $('#item_name21').select2()
                    $('#item_name22').select2()
                    $('#item_name23').select2()
                    $('#item_name24').select2()
                    $('#item_name25').select2()
                    $('#item_name26').select2()
                    $('#item_name27').select2()
                    $('#item_name28').select2()
                    $('#item_name29').select2()
                    $('#item_name30').select2()
                    $('#item_name31').select2()
                    $('#item_name32').select2()
                    $('#item_name33').select2()
                    $('#item_name34').select2()
                    $('#item_name35').select2()
                    $('#item_name36').select2()
                    $('#item_name37').select2()
                    $('#item_name38').select2()
                    $('#item_name39').select2()
                    $('#item_name40').select2()
                    $('#item_name41').select2()
                    $('#item_name42').select2()
                    $('#item_name43').select2()
                    $('#item_name44').select2()
                    $('#item_name45').select2()
                    $('#item_name46').select2()
                    $('#item_name47').select2()
                    $('#item_name48').select2()
                    $('#item_name49').select2()
                    $('#item_name50').select2()
                     
                     
                     
                    });

                    $(document).on('click', '.remove', function(){
                     $(this).closest('tr').remove();
                      cal_final_total(count);
                    });

                                        function cal_final_total(count)
                                            {
                                           
                                            var final_item_total = 0;
                                            for(j=1; j<=count; j++)
                                            {
                                            var quantity = 0;
                                            var price = 0;
                                            var actual_amount = 0;
                                            var item_total = 0;
                                            quantity = $('#quantity'+j).val();

                                            if(quantity > 0)
                                            {
                                              price = $('#unit_price'+j).val();
                                              if(price > 0)
                                              {
                                                actual_amount = parseFloat(quantity) * parseFloat(price);
                                                actual_amount1 = actual_amount.toLocaleString(undefined, {maximumFractionDigits:2});
                                                $('#total_price'+j).val(actual_amount1);

                                                item_total = parseFloat(actual_amount);
                                                final_item_total = parseFloat(final_item_total) + parseFloat(item_total);
                                                final_item_total1 = final_item_total.toLocaleString(undefined, {maximumFractionDigits:2});
                                                global_final = final_item_total;
                                               // $('#order_item_final_amount'+j).val(item_total);
                                              }
                                            }
                                          }
                                          $('#final_total_amt').text(final_item_total1);
                                         
                                        }  
                        
                                        $(document).on('blur', 'input', function(){
                                         
                                              cal_final_total(count);
                                            });
                        


                    $('#insert_form').on('submit', function(event){
                     event.preventDefault();
                     var error = '';
                     $('.item_name').each(function(){
                      var counter = 1;
                      if($(this).val() == '')
                      {
                       error += "<p>Enter Item Name at "+counter+" Row</p>";
                       return false;
                      }
                      counter = counter + 1;
                     });

                     $('.quantity').each(function(){
                      var counter = 1;
                      if($(this).val() == '')
                      {
                       error += "<p>Enter Item Quantity at "+counter+" Row</p>";
                       return false;
                      }
                      counter = counter + 1;
                     });


                     var form_data = $(this).serialize();
                     if(error == '')
                     {
                     if (confirm(" Are you sure you want to generate the expense? "))
                     {
                      $.ajax({
                       url:"mark_expenses_proc.php",
                       method:"POST",
                       data:form_data,
                       success:function(data)
                       {
                           
                           if(data.includes("Error1")){
                                MessageManager.show("<div class='callout callout-danger'><center>FAILED : ORDER GENERATING FAILED.CONTACT SYSTEM ADMINISTRATOR !</center></div>");
                                MessageManager1.show("<div class='callout callout-danger'><center>FAILED : ORDER GENERATING FAILED.CONTACT SYSTEM ADMINISTRATOR !</center></div>");
                           }
                           else if(data.includes("Error2")){
                                MessageManager.show("<div class='callout callout-danger'><center>FAILED : WRONG PAYMENT.</center></div>");
                                MessageManager1.show("<div class='callout callout-danger'><center>FAILED : WRONG PAYMENT.</center></div>");
                            }
                            else if(data.includes("Error3")){
                                MessageManager.show("<div class='callout callout-danger'><center>FAILED : ADD ITEMS TO THE SALES ORDER.</center></div>");
                                MessageManager1.show("<div class='callout callout-danger'><center>FAILED : ADD ITEMS TO THE SALES ORDER.</center></div>");
                            }
                            else if(data.includes(" || Available Quantity : ")){
                                MessageManager.show("<div class='callout callout-danger'><center>FAILED : NO ITEMS AVAILABLE."+data+"</center></div>");
                                MessageManager1.show("<div class='callout callout-danger'><center>FAILED : NO ITEMS AVAILABLE."+data+"</center></div>");
                            }
                            else if(data.includes("UNIT PRICE IS BELOW THE MINIMUM SELLING PRICE : ")){
                                MessageManager.show("<div class='callout callout-danger'><center>FAILED : "+data+"</center></div>");
                                MessageManager1.show("<div class='callout callout-danger'><center>FAILED : "+data+"</center></div>");
                            }else{
 
                        var newWindow = window.open("", "_blank");
                        newWindow.document.write(data);
                        location.reload();
                    }
                       }
                      });
                     }
                     }
                     else
                     {
                      $('#error').html('<div class="alert alert-danger">'+error+'</div>');
                     }
                    });
            
           

           });






 </script>   
 <body>



<script>
function myFunction() {
   $("#item_table").load(window.location + " #item_table");
}
</script>
 
  <div class="table-repsonsive">
     <span id="error"></span>
     <table class="table table-bordered" id="item_table">
      <tr>
 
       <th width="70%">Description</th>
       <th width="10%">Quantity</th>
       <th width="10%">Unit Charge</th>
       <th width="10%">Sub Total</th>
       
        
         </div>
      
      
       <th><button type="button" name="add" id='#add' class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button></th>
      </tr>
       
    </table>
     
       <table class="table table-bordered" >
         <tr>
                <td align="right"></td>
                <td align="right"><font size='5'><b>TOTAL : </b><b>Rs. <span id="final_total_amt">0.00</span></b></font></td></tr>
                
         </table>
       <div class='row'>
            <div class="col-md-6">
            <button type="submit" id="add_payment" class="btn btn-success" >Generate</button>       												
       </div>
           
      <div class="col-md-6" align='right'>
       <div align='right'><button type="button" name="add" id='#add' class="btn btn-success btn-default add"><span class="glyphicon glyphicon-plus"></span></button></div>  	
      </div> 
      </div>
     
    </div>
    </body>
    <?php

    
    
    

    ?>
   