<?php 
require_once './models/Database.php';
require_once './models/User.php'; 
if(isset($_POST['loginUser'])){
	$user_login = $_POST['user_login'];
	$user_password = $_POST['user_password'];
	$user_password = md5($user_password);

	$db = Database::getDb();
    $u = new User();
    $u = $u->getUser($user_login, $db);

    if($user_login == $u->user_login && $user_password == $u->user_password){
    	session_start();
    	$_SESSION['nickname'] = $user_login;
    	header("Location: chatrooms.php");
    } else{
    	echo "login or password is incorrect";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
</head>
<body>
	<form action="" method="POST">
		<label for="user_login">Please enter your nickname</label>
		<input type="text" id="user_login" name="user_login"><br>
		<label for="user_password">Please enter your password</label>
		<input type="password" id="user_password" name="user_password"><br>
		<input type="submit" name="loginUser">
	</form>
	<a href="registration.php">Register</a>
</body>
</html>