<?php
include 'connection.php';
include 'header.php';

?>


<html>

<head>
    <script>
        
        function checkPass()
{
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('new');
    var pass2 = document.getElementById('confirm');
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessage');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if(pass1.value == pass2.value){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Passwords Match!"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Passwords Do Not Match!"
    }
}  
        
        </script>
   
    
    
    <style>
/* Style all input fields */
input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 16px;
}

/* Style the submit button */
input[type=submit] {
    background-color: #4CAF50;
    color: white;
}

/* Style the container for inputs */
.container {
    background-color: #f1f1f1;
    padding: 20px;
}

/* The message box is shown when the user clicks on the password field */
#message {
    display:none;
    background: #f1f1f1;
    color: #000;
    position: relative;
    padding: 20px;
    margin-top: 10px;
}

#message p {
    padding: 10px 35px;
    font-size: 18px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
    color: green;
}

.valid:before {
    position: relative;
    left: -35px;
    content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
    color: red;
}

.invalid:before {
    position: relative;
    left: -35px;
    content: "✖";
}
</style>
    

</head>


<body class="hold-transition skin-green sidebar-mini">

		
		<div class="wrapper">
		
		
		<?php
		include 'headerbar.php';
		?>
	
 
		<div class="col-md-2">
		<?php
		include 'sidebar.php';
		?>
		 </div>
		 
<div class="content-wrapper">
 <section class="content-header">
      <h1>
      Create Accounts
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Create Accounts</li>
      </ol>
    </section>
	
	<section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-3">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Create Company </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="create_user.php" method="POST">
              <div class="box-body">
                  <div class="form-group">
                  <label for="exampleInputEmail1">Name<font color='red'> *</font></label>
                  <input type="text" name="name" class="form-control" id="name" placeholder="Enter Company Name">
                </div>
                 <div class="form-group">
                  <label for="exampleInputEmail1">Phone<font color='red'> *</font></label>
                  <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Company Phone">
                </div>
                   <div class="form-group">
                       <label for="exampleInputEmail1">Address<font color='red'> *</font></label>
                  <input type="text" name="address" class="form-control" id="address" placeholder="Enter Address">
                </div>
                   <div class="form-group">
                  <label for="exampleInputEmail1">Owner Name</label>
                  <input type="text" name="owner" class="form-control" id="owner" placeholder="Enter Owner's Name">
                </div>
                   <div class="form-group">
                  <label for="exampleInputEmail1">BR No<font color='red'> *</font></label>
                  <input type="text" name="br" class="form-control" id="br" placeholder="Enter BR No">
                </div>
                   <div class="form-group">
                  <label for="exampleInputEmail1">Cheques Payable<font color='red'> *</font></label>
                  <input type="text" name="cheques" class="form-control" id="cheques" placeholder="Enter Cheques Payable">
                </div>
                   <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email">
                </div>
                   <div class="form-group">
                  <label for="exampleInputEmail1">Description<font color='red'> *</font></label>
                  <input type="text" name="description" class="form-control" id="description" placeholder="Enter Full Name">
                </div>
                   <div class="form-group">
                  <label for="exampleInputEmail1">Contact Person Name</label>
                  <input type="text" name="contactperson" class="form-control" id="cperson" placeholder="Enter Contact Person Name">
                </div>
                   <div class="form-group">
                  <label for="exampleInputEmail1">Contact Person Phone</label>
                  <input type="text" name="contactphone" class="form-control" id="contactphone" placeholder="Enter Contact Person Phone">
                </div>
                   <div class="form-group">
                    <label>Subscription </label>
                <select class="form-control select2" style="width: 100%;" name="subscription" id="subscription" >
                <option value=""> SELECT SUBSCRIPTION </OPTION> 
                 <option value="1"> YES</OPTION>  
                 <option value="2"> NO </OPTION>
                </select>   
              </div>
                   <div class="form-group">
                    <label>Warning </label>
                <select class="form-control select2" style="width: 100%;" name="warning" id="warning" >
                <option value=""> SELECT WARNING </OPTION> 
                 <option value="1"> YES</OPTION>  
                 <option value="2"> NO </OPTION>
                </select>   
              </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Subscription Date</label>
                  <input type="text" name="sub_date" class="form-control" id="sub_date" placeholder="Enter Contact Person Phone">
                </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Subscription Charge</label>
                  <input type="text" name="sub_charge" class="form-control" id="sub_charge" placeholder="Enter Subscription Charge">
                </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Current Sale</label>
                  <input type="text" name="current_sale" class="form-control" id="current_sale" placeholder="Enter Current Sale">
                </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Current Rent</label>
                  <input type="text" name="current_rent" class="form-control" id="current_rent" placeholder="Enter Current Rent">
                </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Current Job</label>
                  <input type="text" name="current_job" class="form-control" id="current_job" placeholder="Enter Current Job">
                </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Current Invoice</label>
                  <input type="text" name="current_invoice" class="form-control" id="current_invoice" placeholder="Enter Current Invoice">
                </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Current Receipt</label>
                  <input type="text" name="current_receipt" class="form-control" id="current_receipt" placeholder="Enter Contact Current Receipt">
                </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Current GRN</label>
                  <input type="text" name="current_grn" class="form-control" id="current_grn" placeholder="Enter Current GRN">
                </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Subscription Date</label>
                  <input type="text" name="sub_date" class="form-control" id="sub_date" placeholder="Enter Contact Person Phone">
                </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Code Invoice</label>
                  <input type="text" name="code_invoice" class="form-control" id="code_invoice" placeholder="Enter Code Invoice">
                </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Code Job</label>
                  <input type="text" name="code_job" class="form-control" id="code_job" placeholder="Enter Code Job">
                </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Code GRN</label>
                  <input type="text" name="code_grn" class="form-control" id="code_grn" placeholder="Enter Code GRN">
                </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Code Sale</label>
                  <input type="text" name="code_sale" class="form-control" id="code_sale" placeholder="Enter Code Sale">
                </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Code Rent</label>
                  <input type="text" name="code_rent" class="form-control" id="code_rent" placeholder="Enter Code Rent">
                </div>
                   <div class="form-group">
                  <label for="exampleInputEmail1">Code Receipt</label>
                  <input type="text" name="code_receipt" class="form-control" id="code_receipt" placeholder="Enter Code Receipt">
                </div>
                 
		<div class="box-footer">
                <button type="submit" name='create_company' class="btn btn-success">Submit</button>
              </div>
            </form>
          </div>
 </div></div>
        
         <div class="col-md-3">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Create Shop </h3>
            </div>
              
              <?Php
              $sql45 = "SELECT username FROM users ORDER BY id DESC LIMIT 1";
              $result45 = mysqli_query($con,$sql45); 
                while ($row45 = mysqli_fetch_array($result45)) { 
                $username = $row45['username']; 
              }
              $new_username = $username + 1;
              ?>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="create_user.php" method="POST">
              <div class="box-body">
                  <div class="form-group">
                  <label for="exampleInputEmail1">Shop Name<font color='red'> *</font></label>
                  <input type="text" name="shop_name" class="form-control" id="shop_name" placeholder="Enter Shop Name">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Address<font color='red'> *</font></label>
                  <input type="text" name="address" class="form-control" id="address" placeholder="Enter Shop Address">
                </div>
               
                 <div class="form-group">
                <label>Company<font color='red'> *</font></label>
                <select class="form-control select2" style="width: 100%;" name="company" id="company" required>
                <option value=""> SELECT Customer </OPTION>  
                 <?php
                    $sql1 = mysqli_query($con,"SELECT id,name FROM company WHERE stat='1' ORDER BY name  ASC");
                    while ($row = mysqli_fetch_array($sql1)) {
                            ?>
                            <option value=" <?php echo $row['id'] ?> "> <?php echo $row['name'] ?> </option>;
                    <?php }
                    ?>
                </select>   
              </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Phone</label>
                  <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Shop Phone">
                </div>
                
                 	
				<div class="box-footer">
                <button type="submit" name='cretae_user' class="btn btn-success">Submit</button>
              </div>
            </form>
          </div>
 </div></div>
        
        
        
        
        
        <div class="col-md-3">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Create User </h3>
            </div>
              
              <?Php
              $sql45 = "SELECT username FROM users ORDER BY id DESC LIMIT 1";
              $result45 = mysqli_query($con,$sql45); 
                while ($row45 = mysqli_fetch_array($result45)) { 
                $username = $row45['username']; 
              }
              $new_username = $username + 1;
              ?>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="create_user.php" method="POST">
              <div class="box-body">
                  <div class="form-group">
                  <label for="exampleInputEmail1">Full Name<font color='red'> *</font></label>
                  <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Enter Full Name">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">User Name<font color='red'> *</font></label>
                  <input type="text" name="username" class="form-control" id="username" value='<?php echo $new_username?>'>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">New Password (Ex : PassworD123456)<font color='red'> *</font></label>
                  <input type="password" name="new" class="form-control" id="new" placeholder="Enter new Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                </div>
				<div class="form-group">
                  <label for="exampleInputEmail1">Confirm Password<font color='red'> *</font></label>
                  <input type="password" name="confirm" class="form-control" id="confirm" placeholder="Enter Confirm Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" onkeyup="checkPass(); return false;" required>
                <span id="confirmMessage" class="confirmMessage"></span>
                              </div>
                
                 <div class="form-group">
                <label>Company<font color='red'> *</font></label>
                <select class="form-control select2" style="width: 100%;" name="company" id="company" required>
                <option value=""> SELECT Customer </OPTION>  
                 <?php
                    $sql1 = mysqli_query($con,"SELECT id,name FROM company WHERE stat='1' ORDER BY name  ASC");
                    while ($row = mysqli_fetch_array($sql1)) {
                            ?>
                            <option value=" <?php echo $row['id'] ?> "> <?php echo $row['name'] ?> </option>;
                    <?php }
                    ?>
                </select>   
              </div>
                  
                <div class="form-group">
                    <label>User Type </label>
                <select class="form-control select2" style="width: 100%;" name="type" id="type" >
                <option value=""> SELECT TYPE </OPTION> 
                 <option value="1"> ADMINISTRATOR</OPTION>  
                 <option value="2"> SHOP USER </OPTION>
                </select>   
              </div>
                  
                  <div class="form-group">
                <label>Shop<font color='red'> *</font></label>
                <select class="form-control select2" style="width: 100%;" name="customer" id="customer" required>
                <option value=""> SELECT Shop </OPTION>  
                 <?php
                    $sql1 = mysqli_query($con,"SELECT id,name FROM shops WHERE stat='1' ORDER BY name ASC");
                    while ($row1 = mysqli_fetch_array($sql1)) {
                            ?>
                            <option value=" <?php echo $row1['id'] ?> "> <?php echo $row1['name'] ?> </option>;
                    <?php }
                    ?>
                </select>   
              </div>
              
				
				<div class="box-footer">
                <button type="submit" name='cretae_user' class="btn btn-success">Submit</button>
              </div>
            </form>
          </div>
 </div></div>
          
          
           <div class="col-md-3">
                        <div class="row">
                            <div class="col-xs-12">
          <div id="message">
  <h3>Password must contain the following:</h3>
	<p id="letter" class="invalid">A <b>lowercase</b> letter</p>
	<p id="capital" class="invalid">A <b>capital (uppercase)</b></p>
	<p id="number" class="invalid">A <b>number</b></p>
	<p id="length" class="invalid">Minimum <b>8 characters</b></p>
</div></div></div></div>
        
        
				
<script>
var myInput = document.getElementById("new");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
    document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
    document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$current = $_POST['current'];
$new = $_POST['new'];
$confirm = $_POST['confirm'];
$current = $_POST['current'];
$new = $_POST['new'];
$confirm = $_POST['confirm'];
$current = $_POST['current'];
$new = $_POST['new'];
$confirm = $_POST['confirm'];
$current = $_POST['current'];
$new = $_POST['new'];
$confirm = $_POST['confirm'];
$current = $_POST['current'];
$new = $_POST['new'];
$confirm = $_POST['confirm'];




$current = sha1($current);
$new = sha1($new);


$sql = "SELECT id FROM users WHERE password='$current' AND id='$user' ";
$result = mysqli_query($con, $sql);
$rowcount = mysqli_num_rows($result);



if($rowcount>0){

$sql = "UPDATE users SET password='$new' WHERE id='$user'";
			if(mysqli_query($con, $sql)){
                            
                            $sql11 ="INSERT INTO user_activity (user,activity) VALUES ('$user','PASSWORD CHANGED.')";
                            mysqli_query($con, $sql11);
	 		echo '<script language="javascript">';
                        echo 'alert("PASSWORD CHANGED SUCCESSFULLY ! ")';
                        echo '</script>';
                        
				
				
			} else{
			echo '<script language="javascript">';
                        echo 'alert("CHANGING PASSWORD FAILED ! ")';
                        echo '</script>';
                      
			}
                       
}
else{
    
                        echo '<script language="javascript">';
                        echo 'alert("CURRENT PASSWORD WRONG.CHANGING PASSWORD FAILED ! ")';
                        echo '</script>';
                         
    
}
?>

<?php
}
?>

<!-- jQuery 3 -->
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
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>



</html>