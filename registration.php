<?php 
require_once './models/Database.php';
require_once './models/User.php'; 
session_start();
if(isset($_POST['addUser'])){
	$user_login = $_POST['user_login'];
	$user_password = $_POST['user_password'];
	$user_password = md5($user_password);

	$db = Database::getDb();
    $u = new User();
    $u = $u->addUser($user_login, $user_password, $db);
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registration</title>
</head>
<body>
	<form action="" method="POST">
		<label for="user_login">Please enter your nickname</label>
		<input type="text" id="user_login" name="user_login"><br>
		<label for="user_password">Please enter your password</label>
		<input type="password" id="user_password" name="user_password"><br>
		<input type="submit" name="addUser">
	</form>
</body>
</html>