<?php 
require_once './models/Database.php';
require_once './models/User.php'; 
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
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registration</title>

<link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link href="https://fonts.googleapis.com/css?family=VT323" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4">
				<div class="register-wrapper">
					<h2>Registration</h2>
					<form action="" method="POST" class="login-form">
					<label for="user_login">Please enter your nickname</label>
					<input type="text" id="user_login" name="user_login"><br>
					<label for="user_password">Please enter your password</label>
					<input type="password" id="user_password" name="user_password"><br>
					<input type="submit" name="addUser" class="button" value="Register">
					</form>
				</div>
			</div>
			<div class="col-md-8">
				<div class="index-img-wrapper">
					<img src="img/Sans_Face.jpg" alt="skull" class="img-responsive">
				</div>
			</div>
		</div>
	</div>
</body>
</html>