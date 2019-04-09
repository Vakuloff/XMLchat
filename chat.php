<?php 
session_start();
if($_SESSION['nickname'] == '' || $_SESSION['nickname'] == ''){
	header("Location: index.php");
}
if(isset($_POST['logout'])){
	session_unset(); 
	session_destroy();
	header("Location: index.php");
}
echo $_SESSION['nickname'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<title>Welcome <?php echo $_SESSION['nickname']?></title>
	<script
  	src="https://code.jquery.com/jquery-3.3.1.min.js"
  	integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  	crossorigin="anonymous"></script>
</head>
<body>
	<form action="" method="POST" id="ajaxForm">
		<input type="text" name="content" id="content"/>
		<button type="submit" id="button">Button</button>
	</form>
	<form action="" method="POST">
		<input type="submit" name="logout" value="logout">
	</form>
	<div id="messages"></div>
	<script>
		$(document).ready(function(){
			//-----------------------------------------------
			$('#ajaxForm').on('submit', function (event){
				event.preventDefault();
				var content = $('#content').val();
				$.ajax({
					type: 'POST',
					url: 'func.php',
					data: {content: content},
				});
				$('#ajaxForm')[0].reset();
			});
			// -------------------------------------------
			setInterval(function(){
				$.ajax({
					url: 'getMessages.php',
					success: function(data){
						$('#messages').html(data);
					}
				});
			}, 100);
		});
	</script>
</body>
</html>