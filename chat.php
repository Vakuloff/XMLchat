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
$chatTitle = $_GET['chatTitle'];
echo $chatTitle;
json_encode($chatTitle);
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
		<textarea name="content" id="content" cols="30" rows="10"></textarea><br>
		<button type="submit" id="button">Send message</button>
	</form>
	<form action="" method="POST">
		<input type="submit" name="logout" value="logout">
	</form>
	<div id="messages"></div>
	<script>
		$(document).ready(function(){
			var chatTitle = <?php echo json_encode($chatTitle); ?>;
			console.log(chatTitle);
			//-----------------------------------------------
			$('#ajaxForm').on('submit', function (event){
				event.preventDefault();
				var content = $('#content').val();
				$.ajax({
					type: 'POST',
					url: 'func.php?chatTitle=' + chatTitle,
					data: {content: content},
				});
				$('#ajaxForm')[0].reset();
			});
			// -------------------------------------------
			setInterval(function(){
				$.ajax({
					url: 'getMessages.php?chatTitle=' + chatTitle,
					success: function(data){
						$('#messages').html(data);
					}
				});
			}, 100);
		});
	</script>
</body>
</html>