<?php
session_start();
$user = $_SESSION["currentUser"];
//	echo 'current user is ' . $user; //debug use to track user
	?>
<!DOCTYPE html>
<html>
<head>
	<title> Course Enrollment </title>
	<style>
			body {background-color: powderblue;}
	</style>
	<meta name="author" content="Bill Maggs">
</head>

<body>
<h1> Welcome to the University Enrollment Page </h1>
<h2> Please Select an Action </h2>

<nav>
	<a href="index.php?status=true">Home</a> |
	<a href="catalog.php">View Catalog</a> |
	<a href="addcourse.php">Add a Course</a> |
    <a href="dropcourse.php">Drop a Course</a> |
	<a href="waitlist.php">Request Waitlist</a> |
</nav>


</body>
</html>
