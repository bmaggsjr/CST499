<!DOCTYPE html>
<html>
<!-- addReg.php is the <action> for registration.php. It contains all of the routines 
    necessary to add a user to the mySQL database. Once completed,
    this page will return the user to the university landing page -->
<head>
	<title> Add User </title>
	<style>
			body {background-color: powderblue;}
	</style>
	<meta name="author" content="Bill Maggs">
</head>
<body>
<nav>
	<a href="index.php">Home</a>
</nav>


<?php
/* ------------------ function to connect to schema ---------------- */
function myConnect($sname) {
$host = 'localhost'; //host name
$user = 'billmaggs'; //user name
$passwd = 'passme'; //password
$schema = $sname;

try{
 //place code here that could potentially throw an exception
 
$con = new mysqli($host, $user, $passwd, $schema); //oop connection
/* Did connection succeed? */
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

/* ---------------- executeQuery function ---------------------- */
function executeQuery($con,$sql)
{
if (mysqli_query($con,$sql)){
  echo "New record created successfully<br/>";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
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

/* ------------ alternate display function using htmnl ---------
This will use the passed variable $result for the row data <td>
to fill the html table */

function displayTableAlt ($result)
{
?>
<!-- setup the table border and header first -->
<table border="1px" style="width:600px; line-height:40px;">
    <thead>
        <tr>
            <th>User ID</th>
            <th>Email</th>
            <th>Password</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Role</th>
        </tr>
    </thead>
<!-- now fill in the data into the body -->    
    <tbody>
        <?php
            while($row = mysqli_fetch_assoc($result)){?>
            <tr>
                <td><?php echo $row['p_id']; ?></td>
                <td><?php echo $row['p_email']; ?></td>
                <td><?php echo $row['p_password']; ?></td>
                <td><?php echo $row['p_fname']; ?></td>
                <td><?php echo $row['p_lname']; ?></td>
                <td><?php echo $row['p_address']; ?></td>
                <td><?php echo $row['p_phone']; ?></td>
                <td><?php echo $row['p_role']; ?></td>
            <tr>
        <?php
        }
        ?>
    </tbody>
</table>
<?php
}

/* -------------------Display User Data ----------------------- */

function displayUser ($result)
{
?>
<!-- setup the table border and header first -->
<table border="1px" style="width:600px; line-height:40px;">
    <thead>
        <tr>
            <th>User ID</th>
            <th>Email</th>
            <th>Password</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Role</th>
        </tr>
    </thead>
<!-- now fill in the data into the body -->    
    <tbody>
      <?php
 $row = mysqli_fetch_assoc($result);?>
            <tr>
                <td><?php echo $row['p_id']; ?></td>
                <td><?php echo $row['p_email']; ?></td>
                <td><?php echo $row['p_password']; ?></td>
                <td><?php echo $row['p_fname']; ?></td>
                <td><?php echo $row['p_lname']; ?></td>
                <td><?php echo $row['p_address']; ?></td>
                <td><?php echo $row['p_phone']; ?></td>
                <td><?php echo $row['p_role']; ?></td>
            <tr>
        <?php
//        }
        ?>
    </tbody>
</table>
<?php
}

/* ----------- Main script ------------------------------------ */

/* ---------------- Debug Flags ----------------------------------- */
//$myVerbose = "on";
$myVerbose = "off";


/* ----------------------------------------------------------- */
// Use the $_POST superglobal to assign user data to variables
$p_email = ($_POST['p_email']);
$p_password = ($_POST['p_password']);
$p_fname = ($_POST['p_fname']);
$p_lname = ($_POST['p_lname']);
$p_address = ($_POST['p_address']);
$p_phone = ($_POST['p_phone']);

$sname = 'university';							// Temp hardcode the schema name
$con=myConnect($sname); 							// Call the connect function and assign to $con

// Put together the $sql variable to INSERT with the variable values, student is default role
$sql = "INSERT INTO tbluser (p_email,p_password,p_fname,p_lname,p_address,p_phone,p_role)
VALUES ('$p_email', '$p_password', '$p_fname', '$p_lname', '$p_address', '$p_phone', 'student')";
executeQuery($con,$sql);

//$sql = "SELECT * FROM tbluser"; 					// Set the $sql variable for a wildcard table SELECT
$sql = "SELECT * FROM tblUser WHERE p_id=(SELECT max(p_id) FROM tbluser)";
$result = executeSelectQuery($con, $sql);
                 
// Display the user information with UserID
echo 'Registration succesful</br>';
displayUser($result);
echo 'REMEMBER your assigned User ID, you will need it to login!</br>';
/* Housekeeping */
mysqli_free_result($result);
echo 'memory freed </br>';
mysqli_close($con);
echo 'connection closed </br> goodbye';
?>
</body>
</html>