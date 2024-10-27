<?php
// You won't get here unless there is a session with a valid user ..
session_start();
$user = $_SESSION["currentUser"]; 
?>
<!DOCTYPE html>
<html>

<head>
	<title> Add Waitlist </title>
	<style>
			body {background-color: powderblue;}
	</style>
	<meta name="author" content="Bill Maggs">
</head>

<body>
<a href="index.php?status=true">Home</a> |
<a href="catalog.php">Catalog</a> |

<h1> Adding to Waitlist</h1>
<h2> Welcome User ID  <?php echo $user; ?></h2>
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
    $result = mysqli_query($con,$sql);
    return $result;
    }

/* ----------------------------Main ------------------------------------- */
$p_courseid = ($_POST['courseid']);
$sname = 'university';				    // Temp hardcode the schema name
$con=myConnect($sname); 			    // Call the connect function and assign to $con

$sql = "INSERT INTO twaitlist (p_id,p_cid)
VALUES ('$user', '$p_courseid')";
$result = executeSelectQuery($con,$sql);
echo 'User ID ' . $user . ' Successfully added to waitlist for course ' . $p_courseid;

mysqli_close($con);
//echo 'connection closed </br> goodbye';
?>

</body>
</html>