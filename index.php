<?php
/* 
First release 10/22/2024
v1.01 - added functionality for logged in users and entry into course
selection.
William Maggs
CST499
Notes:
The first time the URL is loaded, the login status is undefined since
a user has not tried to login yet. Warnings and Notices are suppressed
for this statement, and then re-enabled after. */ 
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
$loggedIn = $_GET['status'];
error_reporting(E_ALL & E_NOTICE & E_WARNING);
if ($loggedIn == 'true') {		
// check if logged in
// if logged start seesion and get current user
	session_start();
	$user = $_SESSION["currentUser"];
//	echo 'current user is ' . $user; //debug use for tracking user
	?>
	<!DOCTYPE html>
	<html>

	<head>
		<title> University Enrollment Website </title>
		<style>
				body {background-color: powderblue;}
		</style>
		<meta name="author" content="Bill Maggs">
	</head>

	<body>
	<h1> University Enrollment Homepage</h1>

	<nav>
		<a href="index.php?status=true">Home</a> |
		<a href="contact.php">Contact Us</a> |
		<a href="logout.php">Logout</a> |
		<a href="enrollment.php">Course Selection</a>
		<a href="viewmine.php"> View My Courses</a>
	</nav>
	<?php
	}
else
// if not logged in show default home page
	{
	?>
	<!DOCTYPE html>
	<html>

	<head>
		<title> University Enrollment Homepage </title>
		<style>
				body {background-color: powderblue;}
		</style>
		<meta name="author" content="Bill Maggs">
	</head>

	<body>
	<h1> University Enrollment Homepage </h1>
		<nav>
		<a href="index.php">Home</a> |
		<a href="contact.php">Contact Us</a> |
		<a href="login.php">Login</a> |
		<a href="registration.php">Registration</a>
	</nav>
	<?php
	}
?>	

</body>
</html>