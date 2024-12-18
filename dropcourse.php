<?php
// You won't get here unless there is a session with a valid user ..
session_start();
$user = $_SESSION["currentUser"]; 
?>
<!DOCTYPE html>
<html>

<head>
	<title> Drop a Course </title>
	<style>
			body {background-color: powderblue;}
	</style>
	<meta name="author" content="Bill Maggs">
</head>

<body>
<a href="enrollment.php">Course Selection</a> |
<a href="addcourse.php">Add Course</a> |
<!-- <a href="dropcourse.php">Drop Course</a> | -->
<a href="waitlist.php">Waitlist</a> |
<a href="catalog.php"> View Catalog</a> |

<h1> Request a Drop</h1>


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
            <th>Available</th>
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
$sname = 'university';				    // Temp hardcode the schema name
$con=myConnect($sname); 			    // Call the connect function and assign to $con
$sql = "SELECT * FROM tblcatalog";	    // Set the $sql variable for the table
$result = executeSelectQuery($con, $sql); 	    // Call the executeSelectQuery function
displayTable($result);						    // Display the table
?>
<form method="POST" action="mydrop.php">
  <p>Course ID to Drop: <input type="text" name="courseid"></p>
  <input type="submit">
  <input type="reset">
</form>
<?php
/* Housekeeping */
mysqli_free_result($result);
//echo 'memory freed </br>';
mysqli_close($con);
//echo 'connection closed </br> goodbye';
?>
</body>
</html>