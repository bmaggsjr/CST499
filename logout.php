<?php
session_start();
$user = $_SESSION["currentUser"];
?>

<!DOCTYPE html>
<html>

<head>
	<title> Logging out </title>
	<style>
			body {background-color: powderblue;}
	</style>
	<meta name="author" content="Bill Maggs">
</head>

<body>
<h1> User Logout</h1>
<?php
echo "You are logged in as: ".$user."<br/";
echo "<br/>Click Logout to end your session, click Cancel to stay logged in <br/>";
?>

<a href="index.php?status=false">Logout</a> |
<a href="index.php?status=true">Cancel</a><br>

</body>
</html>