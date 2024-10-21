<!DOCTYPE html>
<html>
<head>
	<title> User Login </title>
	<style>
			body {background-color: powderblue;}
	</style>
	<meta name="author" content="Bill Maggs">
</head>
<body>
<nav>
	<a href="index.php"?status=false>Home</a> |
</nav>

<h1> Welcome to the University Login Page </h1>
<h2> Please enter your student or staff User ID and password:

<form method="POST" action="myLogin.php">
  <p>UserID: <input type="text" name="UserID"></p>
  <p>Password: <input type="text" name="password"></p>
  <input type="submit">
  <input type="reset">
</form>
</h2>
</body>
</html>