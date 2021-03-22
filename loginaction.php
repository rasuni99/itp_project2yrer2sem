<?php
session_start();
ob_start();


include 'connection.php';



$username = $password = "";
$ip = $_SERVER['REMOTE_ADDR'];

if ($_SERVER["REQUEST_METHOD"] == "POST") { //Retrive data from login form
    $username = test_input($_POST["user"]); // Use test input function to test data
    $password = test_input($_POST["pass"]);
    $password = SHA1($password);
}

function test_input($data) { //Remove unnecessary characters from login details.
    $data1 = trim($data); //Removes whitespace and other predefined characters from both sides of a string
    $data2 = stripslashes($data1); //Un-quotes a quoted string
    $data3 = htmlspecialchars($data2); //Convert special characters to HTML entities
    return $data3;
}

$company = 0;
$user_name = mysqli_real_escape_string($con,$username); //Retrieve data from login table
$query = "SELECT id,name,type,stat,company FROM users WHERE username = '$username'  AND password = '$password' ";
//1' OR 1='1
$result = mysqli_query($con,$query); 
while ($row = mysqli_fetch_array($result)) { 
    $id = $row['id']; 
    $user = $row['name'];
    $active = $row['stat'];
    $company = $row['company'];
    $type = $row['type'];
    
}
$company_stat = 0;
if($company>0){
$query1 = "SELECT subscription,stat,code_receipt,code_invoice,code_invoice_real,code_grn,code_returns,code_sale,code_grn_internal FROM company WHERE id = '{$company}'";
$result1 = mysqli_query($con,$query1); 
while ($row1 = mysqli_fetch_array($result1)) { 
    $subscription = $row1['subscription']; 
    $company_stat = $row1['stat']; 
    $code_invoice = $row1['code_invoice']; 
    $code_invoice_real = $row1['code_invoice_real']; 
    $code_receipt = $row1['code_receipt']; 
    $code_grn = $row1['code_grn'];
    $code_returns = $row1['code_returns']; 
    $code_sale = $row1['code_sale']; 
    $code_grn_internal = $row1['code_grn_internal'];
}
}

// User not found. So, redirect to login_form again.
if (mysqli_num_rows($result) == 0) {
    echo "The login details you entered is incorrect.<br>Please try again (make sure your caps lock is off).";
    die;
    
} else if ($company_stat == 0) { //User inactive.So, redirect to login_form again.
    echo "Your company is inactive.<br>Please Contact Administrator.";
    die;
    
} else if ($active == 0) { //User inactive.So, redirect to login_form again.
    echo "Your account is inactive.<br>Please Contact Administrator.";
    die;
     
} else if ($subscription == 0) { //User inactive.So, redirect to login_form again.
    
    echo "Your company didn't pay the subscription charges.<br>Your account is inactive.Please Contact Administrator.";
    die;
}
else { // Redirect to home page after successful login.
    $_SESSION['sess_user_id'] = $id; //Initializing login id
    $_SESSION['sess_username'] = $user; //Initializing username
    $_SESSION['sess_active'] = $active; //Initializing user level 
    $_SESSION['sess_company'] = $company; //Initializing user level 
    $_SESSION['ip'] = $ip; //Initializing IP 
    $_SESSION['code_invoice'] = $code_invoice; //Initializing code for invoices
    $_SESSION['code_invoice_real'] = $code_invoice_real; //Initializing invoice no 
    $_SESSION['code_receipt'] = $code_receipt; //Initializing user level 
    $_SESSION['code_grn'] = $code_grn; //Initializing user level 
    $_SESSION['code_returns'] = $code_returns; //Initializing user level 
    $_SESSION['code_sale'] = $code_sale; //Initializing user level 
    $_SESSION['sess_user_type'] = $type; //Initializing user level 
    $_SESSION['code_grn_internal'] = $code_grn_internal; 
    
    $query1 = "SELECT datetime FROM login_history WHERE user = '$id' AND activity='SYSTEM LOGIN' ORDER BY id DESC LIMIT 1";
    $result1 = mysqli_query($con,$query1); 
    $datetime = "";
    while ($row1 = mysqli_fetch_array($result1)) { 
    $datetime = $row1['datetime']; 
    }
    
    if($datetime==""){
        $datetime = "NO DATA";
    }
    
    $_SESSION['sess_user_last_login'] = $datetime;
   
    session_write_close();
    
     $sql = "INSERT INTO login_history (user,company,activity,ip) VALUES 
    ('$id','$company','SYSTEM LOGIN','$ip')";
     mysqli_query($con, $sql);
    
    echo "done";
    
    //header('Location: index.php'); //Redirect to home page
}
?>