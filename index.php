<?php  
session_start();
if(isset($_POST['addNickname'])){
	$nickname = $_POST['nickname'];
	$_SESSION['nickname'] = $nickname;
	header("Location: chatrooms.php");
}
if(isset($_POST['logout'])){
	session_unset(); 
	session_destroy();
	header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="" method="POST">
		<label for="">Please enter your nickname</label>
		<input type="text" id="nickname" name="nickname">
		<input type="submit" name="addNickname">
	</form>
	<form action="" method="POST">
		<input type="submit" name="logout" value="logout">
	</form>
</body>
</html>