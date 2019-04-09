<?php 
session_start();
if($_SESSION['nickname'] == '' || $_SESSION['nickname'] == null){
	header("Location: index.php");
}
if(isset($_POST['logout'])){
	session_unset(); 
	session_destroy();
	header("Location: index.php");
}
$chatTitle = $_GET['chatTitle'];
// echo $chatTitle;
json_encode($chatTitle);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Welcome <?php echo $_SESSION['nickname']?></title>
	<link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link href="https://fonts.googleapis.com/css?family=VT323" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
	<script
  	src="https://code.jquery.com/jquery-3.3.1.min.js"
  	integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  	crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<a href="chatrooms.php" class="back">Back to chats</a>
		<div class="row">
			<div class="col">
				<div class="chat-wrapper">
					<h2><?php echo $chatTitle; ?></h2>
					<h2>Welcome <?php echo $_SESSION['nickname']?></h2>

					<form action="" method="POST" id="ajaxForm">
		<textarea name="content" id="content" cols="30" rows="10" class="chat-area"></textarea><br>
		<button type="submit" id="button" class="button">Send message</button>
	</form>
	<form action="" method="POST">
		<input type="submit" name="logout" value="logout" class="button logout">
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
				</div>
			</div>
		</div>
	</div>
</body>
</html>