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


$chats = array();
$xml = simplexml_load_file("XML/chatrooms.xml");
$chats = $xml->chatrooms->chatroom;
$numberChats = count($chats);
if(isset($_POST['addChat'])){
	$newChatName = $_POST['newChatName'];
	
	$xmlstr = '<?xml version="1.0" encoding="utf-8"?><chatwindow></chatwindow>';

	$newXML = new SimpleXMLElement($xmlstr);
	$newChatroom = $newXML->addChild('chatroom');
	$newChatroom->addAttribute('id', 'chatroom_' .($numberChats + 1));
	$newChatroomName = $newChatroom->addChild('chatroom_name', $newChatName);
	$newMessages = $newChatroom->addChild('messages');

	$newXML->saveXML('XML/' . $newChatName . ".xml");
//------------------------------------------------------------------------
	$newChat = $xml->chatrooms->addChild('chatroom');
	$newChat->addAttribute('chatroom_id', ($numberChats + 1));
	$newName = $newChat->addChild('name', $newChatName);


	$xml->saveXML("XML/chatrooms.xml");
	header("Refresh:0");
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Welcome <?php echo $_SESSION['nickname']?></title>
	<link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link href="https://fonts.googleapis.com/css?family=VT323" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4">
				<div class="form-wrapper">
					<h2>Welcome <?php echo $_SESSION['nickname']?></h2>
					<h3>Choose a chatroom or create a new one</h3>
					<ul class="conversationList">
 					<?php
 					for ($i=0; $i < $numberChats; $i++) { 
					$chats[$i]['name'] = $xml->chatrooms->chatroom[$i]->name;

					echo "<li class='chatTitle'><a href='chat.php?chatTitle=" . $chats[$i]['name'] . "'>" . $chats[$i]['name'] . "</a></li>";
					}
 					?>
 					</ul>
 	<form action="" method="POST" class="form">
 		<label for="newChatName">Enter chatroom name</label><br>
 		<input type="text" name="newChatName" id="newChatName" class="input"><br>
 		<input type="submit" name="addChat" value="Add new chat" class="button new-chat-btn">
 	</form>
	<form action="" method="POST">
		<input type="submit" name="logout" value="logout" class="logout button">
	</form>
				</div>
			</div>
			<div class="col-md-8">
				<div class="chatroom-img-wrapper">
					<img src="img/dragon.jpg" alt="dragon" class="img-responsive">
				</div>
			</div>
		</div>
	</div>
</body>
</html>