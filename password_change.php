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
      Password Change
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pass word Change</li>
      </ol>
    </section>
	
	<section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-3">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Enter Details </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="password_change.php" method="POST">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Current Password</label>
                  <input type="password" name="current" class="form-control" id="current" placeholder="Enter Current Password">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">New Password</label>
                  <input type="password" name="new" class="form-control" id="new" placeholder="Enter new Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                </div>
				<div class="form-group">
                  <label for="exampleInputEmail1">Confirm Password</label>
                  <input type="password" name="confirm" class="form-control" id="confirm" placeholder="Enter Confirm Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" onkeyup="checkPass(); return false;" required>
                <span id="confirmMessage" class="confirmMessage"></span>
                              </div>
              
				
				<div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
 </div></div>
          
          
           <div class="col-md-8">
                        <div class="row">
                            <div class="col-xs-12">
          <div id="message">
  <h3>Password must contain the following:</h3>
	<p id="letter" class="invalid">A <b>lowercase</b> letter</p>
	<p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
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
$user = $_SESSION['sess_user_id'];

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