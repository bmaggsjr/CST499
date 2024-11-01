<?php
session_start(); // Keep the user data of login
?>
<!DOCTYPE html>
<html>
 
 <head>
	<title> login </title>
	<style>
			body {background-color: powderblue;}
	</style>
	<meta name="author" content="Bill Maggs">
</head>

<body>
    <h1> Verifying Credentials </h1>

<?php
/* ------------------ function to connect to schema ---------------- */
function myConnect($sname) {
$host = 'localhost'; //host name
$sqluser = 'billmaggs'; //sql user name
$passwd = 'passme'; //sql password
$schema = $sname;
try{
//place code here that could potentially throw an exception
$con = new mysqli($host, $sqluser, $passwd, $schema); //oop connection
}
catch(Exception $e)
{
  //We will catch ANY exception that the try block will throw

	echo 'Error - connection failed<br>';
    echo 'A connection to the University Database could not be completed, if this continues please<br>';
    echo 'contact University IT support<br>';
	die(); // Stop execution and allow to return home
}
echo $sname.' database connection successfull! </br>';
return $con;
}
/* ---------------- executeSelectQuery function ---------------------- */
function executeSelectQuery($con,$sql)
{
$result = mysqli_query($con,$sql);
return $result;
}

/* --------------- display table function ----------------------- */
function displayTable ($result)
{

echo 'returned rows are: ' . $result -> num_rows . '</br>';
while ($row = mysqli_fetch_row($result)) 
{
    $arrlength = count($row);
    for($i = 0; $i < $arrlength; $i++)
        {
        echo $row[$i]." ";
        }
    echo "<br/>";
}
}
/* ---------------- main -------------------------------------*/

//set the local variables from post
$loggedIn = false; //start not logged in 
$id = ($_POST['userid']);
//echo $id . '</br>'; // use for debug
$password = ($_POST['password']);
//echo $password . '</br>'; // use for debug


//set schema
$sname = 'university';							// Temp hardcode the schema name
$con=myConnect($sname); 							// Call the connect function and assign to $con
$sql = "SELECT p_id, p_password,p_role FROM tbluser WHERE p_id='$id'";
$result = executeSelectQuery($con, $sql); 			// Call the executeSelectQuery function, the <full>
//displayTable($result);

$row = mysqli_fetch_row($result);
//$check_id = $row[0];
//echo $check_id . '  ';
//$check_password = $row[1];
//echo $check_password . '</br>';

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
if ($id == $row[0] && $password == $row[1]){
    echo 'User ID ' . $id . ' is logged in succesfully</br>';
    $loggedIn = true;
    $role = $row[2];
    echo 'Role is: ' . $role . '</br>';
    error_reporting(E_ALL & E_NOTICE & E_WARNING);
    $_SESSION["currentUser"] = $id;     //save SESSION user
    $_SESSION["currentRole"] = $role;   //save SESSION role
}
    else {
        echo 'credentials not accepted</br>';
        echo 'user id entered is '. $id . '</br>';
        echo 'password entered is ' . $password . '</br>';
        echo 'please verify your credentials </br>';
        error_reporting(E_ALL & E_NOTICE & E_WARNING);

    }
/* Housekeeping */
mysqli_free_result($result);
echo 'memory freed </br>';
mysqli_close($con);
echo 'connection closed </br>';
if ($loggedIn){
    ?>
        <a href="index.php?status=true">Continue</a>
    <?php
    }
else{
    ?>
        <a href="index.php?status=false">Continue</a>
    <?php
    }
?>
</body>
</html>