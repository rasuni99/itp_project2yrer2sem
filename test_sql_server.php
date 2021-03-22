<?php
/////////////////////////SQL SERVER CONNECTION/////////////////////////////
$serverName = "DESKTOP-F92C6DD\SQLEXPRESS"; //serverName\instanceName
$connectionInfo = array( "Database"=>"ATT2000", "UID"=>"sa", "PWD"=>"PrasA291990");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}

/////////////////////////MYSQL CONNECTION/////////////////////////////

$con = mysqli_connect("localhost","root","","shanaz_payroll");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  
///////////////////////////////////////////////////////////////////////
  
  
  
 $tsql = "SELECT USERID,NAME FROM dbo.USERINFO";
                $getResults= sqlsrv_query($conn, $tsql);

if ($getResults == FALSE)
    die(FormatErrors(sqlsrv_errors()));
while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
    
            $userid = ($row['USERID'] . PHP_EOL);
            $name = ($row['NAME'] . PHP_EOL);

            $sql1 = "INSERT INTO employee (emp_id,first_name) VALUES
                ('$userid','$name')";
            if(mysqli_query($con, $sql1)){
                   
                echo "User Added : ".$name."</br>";
                    
            }
            else{
                    echo "Shit Happens";
            }
    
}



?> 