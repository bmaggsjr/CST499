<?php
// You won't get here unless there is a session with a valid student user ..
session_start();
$user = $_SESSION["currentUser"]; 
?>
<!DOCTYPE html>
<html>

<head>
	<title> View Courses </title>
	<style>
			body {background-color: powderblue;}
	</style>
	<meta name="author" content="Bill Maggs">
</head>

<body>
<a href="index.php?status=true">Home</a>

<h1> My Current Courses</h1>


<?php

/* ------------------ function to connect to schema ---------------- */
function myConnect($sname) {
    $host = 'localhost'; //host name
    $sqluser = 'billmaggs'; //sql user name
    $passwd = 'passme'; //sql password
    $schema = $sname;
    $con = new mysqli($host, $sqluser, $passwd, $schema); //oop connection
    /* Did connection succeed? */
    if (!is_null($con->connect_error))
    {
        echo 'connection failed<br>';
        echo 'error number: ' . $con->connect_errno . '<br>';
        echo 'error message: ' . $con->connect_error . '<br>';
        die();
    }
//debug code    echo $sname.' database connection successfull! </br>';
    return $con;
    }
/* ---------------- executeSelectQuery function ---------------------- */
function executeSelectQuery($con,$sql)
    {
    $result = mysqli_query($con,$sql); // get query object
    return $result;
    }

/* ----------------------------Main ------------------------------------- */

$sname = 'university';				    // Temp hardcode the schema name
$con=myConnect($sname); 			    // Call the connect function and assign to $con
$sql = "SELECT * FROM tblenrollment";	    // Set the $sql variable for the table
$result = executeSelectQuery($con, $sql); 	    // Call the executeSelectQuery function
while($row = mysqli_fetch_assoc($result)){
    $cid = $row['p_cid'];
 //   echo $cid . '</br>';
    $sql = "SELECT * FROM tblcatalog WHERE p_cid = $cid";
    $result2 = executeSelectQuery($con, $sql);
    $row2 = mysqli_fetch_assoc($result2);
    echo 'Course ID:   ' . $row2['p_cid'] . '</br>';
    echo 'Course Name: ' . $row2['p_cname'] . '</br>';
    echo 'Semester:    ' . $row2['p_csemester'] . '</br>';
    };
//$classdetail = $row['p_cid']

/* Housekeeping */
mysqli_free_result($result);
//echo 'memory freed </br>';
mysqli_close($con);
//echo 'connection closed </br> goodbye';
?>

</body>
</html>