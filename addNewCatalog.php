<?php
// You won't get here unless there is a session with a valid user ..
session_start();
$user = $_SESSION["currentUser"]; 
?>
<!DOCTYPE html>
<html>

<head>
	<title> Add to Course Catalog </title>
	<style>
			body {background-color: powderblue;}
	</style>
	<meta name="author" content="Bill Maggs">
</head>

<body>
<a href="index.php?status=true">Home</a> |
<h1> Add to Catalog</h1>
<h2> Welcome User ID  <?php echo $user; ?></h2>
<h2> You have selected this course to add to the University Catalog</h2>


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
$p_coursename = ($_POST['course']);
$p_semester = ($_POST['semester']);
$p_capacity = ($_POST['capacity']);
$p_defaultfilled = 0;
$sname = 'university';				    // Temp hardcode the schema name
$con=myConnect($sname); 			    // Call the connect function and assign to $con

// Put together the $sql variable to INSERT with the variable values, student is default role
$sql = "INSERT INTO tblcatalog (p_cname,p_csemester,p_cseats,p_cfilled)
VALUES ('$p_coursename', '$p_semester', '$p_capacity', '$p_defaultfilled')";
executeSelectQuery($con,$sql);

// Now verify
$sql = "SELECT * FROM tblcatalog WHERE p_cid=(SELECT max(p_cid) FROM tblcatalog)";
$result = executeSelectQuery($con, $sql);
displayTable($result);
/* Housekeeping */
mysqli_free_result($result);
//echo 'memory freed </br>';
mysqli_close($con);
//echo 'connection closed </br> goodbye';
?>

</body>
</html>