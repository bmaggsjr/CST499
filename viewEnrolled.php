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

<h1> Current University Enrollment</h1>


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
    $cid = $row['p_cid']; //get the course id
    $sid = $row['p_id']; //get the student id
 //   echo $cid . '</br>';
    $sql = "SELECT * FROM tbluser WHERE p_id = $sid";
    $result3 = executeSelectQuery($con, $sql);
    $row3 = mysqli_fetch_assoc($result3);
    echo $row3['p_id'] . ' ' . $row3['p_fname'] . ' ' . $row3['p_lname'] . ' ';

    $sql = "SELECT * FROM tblcatalog WHERE p_cid = $cid";
    $result2 = executeSelectQuery($con, $sql);
    $row2 = mysqli_fetch_assoc($result2);
    echo $row2['p_cid'] . ' ' . $row2['p_cname'] . ' ' . $row2['p_csemester'] . '</br>';
    };


/* Housekeeping */
mysqli_free_result($result);
//echo 'memory freed </br>';
mysqli_close($con);
//echo 'connection closed </br> goodbye';
?>

</body>
</html>