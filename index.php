<?php 
require_once './models/Database.php';
require_once './models/User.php'; 
$invalid_login= "";
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
    	$invalid_login = "login or password is incorrect";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="561208277297-9pb8i7r23a6hb4eru84k49h5av0t1c1f.apps.googleusercontent.com">
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link href="https://fonts.googleapis.com/css?family=VT323" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
	<title>Login</title>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4">
				<div class="login-wrapper">
				<h2>Welcome to our Chat</h2>
				<form action="" method="POST" class="login-form">
				<p class="error"><?php echo $invalid_login ?></p>
				<label for="user_login">Please enter your nickname</label><br>
				<input type="text" id="user_login" name="user_login"><br>
				<label for="user_password">Please enter your password</label><br>
				<input type="password" id="user_password" name="user_password"><br>
				<input type="submit" name="loginUser" id="submit" class="button" value="Login">
				<a href="registration.php" class="button">Register</a>
				<div class=" button" data-onsuccess="onSignIn" data-theme="dark">Google Sign In</div>
				<a href="#" class="button" onclick="signOut();">Google Sign out</a>
				</form>
	 			<a href="#" onclick="signOut();">Sign out</a>
				</div>
			</div>
			<div class="col-md-8">
				<div class="index-img-wrapper">
					<img src="img/Sans_Face.jpg" alt="skull" class="img-responsive">
				</div>
			</div>
		</div>
	</div>
	<script>
		function onSignIn(googleUser) {
        // Useful data for your client-side scripts:
        	var profile = googleUser.getBasicProfile();
      	}
      	function signOut() {
        	document.location.href = "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=http://localhost/XMLchat/XMLchat/index.php";
      	}
  </script>
</body>
</html>