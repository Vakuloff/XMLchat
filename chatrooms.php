<?php 
session_start();
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
	<title>Welcome <?php echo $_SESSION['nickname']?></title>
</head>
<body>
	<ul class="conversationList">
 		<?php
 			for ($i=0; $i < $numberChats; $i++) { 
				$chats[$i]['name'] = $xml->chatrooms->chatroom[$i]->name;

				echo "<li class='chatTitle'><a href='chat.php?chatTitle=" . $chats[$i]['name'] . "'>" . $chats[$i]['name'] . "</a></li>";
			}
 		?>
 	</ul>
 	<form action="" method="POST">
 		<input type="text" name="newChatName">
 		<input type="submit" name="addChat" value="Add new chat">
 	</form>
	<form action="" method="POST">
		<input type="submit" name="logout" value="logout">
	</form>
</body>
</html>