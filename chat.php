<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<title></title>
	<script
  	src="https://code.jquery.com/jquery-3.3.1.min.js"
  	integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  	crossorigin="anonymous"></script>
</head>
<body>
	<form action="" method="POST" id="ajaxForm">
		<input type="text" name="name" id="name"/>
		<input type="text" name="content" id="content"/>
		<button type="submit" id="button">Button</button>
	</form>
	<div id="messages"></div>
	<script>
		$(document).ready(function(){
			//-----------------------------------------------
			$('#ajaxForm').on('submit', function (event){
				
				event.preventDefault();
				var name = $('#name').val();
				var content = $('#content').val();
				$.ajax({
					type: 'POST',
					url: 'func.php',
					data: {name:name, content: content},
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