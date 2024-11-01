<?php
// You won't get here unless there is a session with a valid admin role ..
session_start();
$user = $_SESSION["currentUser"]; 
?>
<!DOCTYPE html>
<html>

<head>
	<title> Add Course to Catalog </title>
	<style>
			body {background-color: powderblue;}
	</style>
	<meta name="author" content="Bill Maggs">
</head>

<body>
<a href="index.php?status=true">Home</a> |
<a href="logout.php">Logout</a>

<!-- <a href="catalog.php"> View Catalog</a> | -->
<h1> Enter Course Course</h1>


<form method="POST" action="addNewCatalog.php">
  <p>Course Name: <input type="text" name="course"></p>
  <p>Semester: <input type="text" name="semester"></p>
  <p>Seating Capacity: <input type="text" name="capacity"></p>
  <input type="submit">
  <input type="reset">
</form>
</body>
</html>