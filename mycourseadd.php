<?php
// You won't get here unless there is a session with a valid user ..
session_start();
$user = $_SESSION["currentUser"]; 
?>
<!DOCTYPE html>
<html>

<head>
	<title> Add a Course </title>
	<style>
			body {background-color: powderblue;}
	</style>
	<meta name="author" content="Bill Maggs">
</head>

<body>
<a href="index.php?status=true">Home</a> |
<a href="dropcourse.php">Drop Course</a> |
<a href="waitlist.php">Waitlist</a> |
<h1> Add a Course</h1>
<h2> Welcome User ID  <?php echo $user; ?></h2>
<h2> You have selected this course to add</h2>


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

/* --------------- display table function ----------------------- */
function displayTable ($result)
{
?>
<!-- setup the table border and header first -->
<table border="1px" style="width:900px; line-height:40px;">
    <thead>
        <tr>
            <th>Course ID</th>
            <th>Course Name</th>
            <th>Semester</th>
            <th>Capacity</th>
            <th>Filled</th>
        </tr>
    </thead>
<!-- now fill in the data into the body -->    
    <tbody>
        <?php
            while($row = mysqli_fetch_assoc($result)){?>
            <tr>
                <td><?php echo $row['p_cid']; ?></td>
                <td><?php echo $row['p_cname']; ?></td>
                <td><?php echo $row['p_csemester']; ?></td>
                <td><?php echo $row['p_cseats']; ?></td>
                <td><?php echo $row['p_cfilled']; ?></td>
            <tr>
        <?php
        }
        ?>
    </tbody>
</table>
<?php
}
/* ----------------------------Main ------------------------------------- */

// Use the $_POST superglobal to assign user data to variables
$p_courseid = ($_POST['courseid']);
$sname = 'university';				    // Temp hardcode the schema name
$con=myConnect($sname); 			    // Call the connect function and assign to $con
$sql = "SELECT * FROM tblcatalog WHERE p_cid = $p_courseid";	    // Set the $sql variable for the table
$result = executeSelectQuery($con, $sql); 	    // Call the executeSelectQuery function
$row = mysqli_fetch_assoc($result);
echo $row['p_cname'] . ' for ' . $row['p_csemester'] . '</br>';
echo 'There are ' . $row['p_cfilled'] . ' seats filled of ' . $row['p_cseats']. ' capacity </br>';
$avail = $row['p_cfilled'];
$capacity = $row['p_cseats'];
if ($avail < $capacity){
    echo 'Your enrollment is confirmed </br> </br>';
    $sql = "UPDATE tblcatalog SET p_cfilled = p_cfilled + 1 WHERE p_cid = $p_courseid";	    // Set the $sql variable for the table
    $result = executeSelectQuery($con, $sql); 	    // Call the executeSelectQuery function
    $sql = "SELECT * FROM tblcatalog WHERE p_cid = $p_courseid";	    // Set the $sql variable for the table
    $result = executeSelectQuery($con, $sql); 	    // Call the executeSelectQuery function
    displayTable($result);

//Don't forget to update the enrollment table!
// Put together the $sql variable to INSERT with the variable values
    $sql = "INSERT INTO tblenrollment (p_id,p_cid)
    VALUES ('$user', '$p_courseid')";
    executeSelectQuery($con,$sql);
    }
if ($avail == $capacity)
    echo 'There are no seats available, please use the link to waitlist';
/* Housekeeping */
mysqli_free_result($result);
//echo 'memory freed </br>';
mysqli_close($con);
//echo 'connection closed </br> goodbye';
?>

</body>
</html>