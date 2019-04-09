<?php 
	$name = $_POST['name'];
	$content = $_POST['content'];
	$date = date(" dS F Y h:m:s A");

	$xml = simplexml_load_file("XML-chat.xml");
	$messages = array();
	$messages = $xml->chatroom->messages->message;
	$numberMessages = count($messages);

	$newMessage = $xml->chatroom->messages->addChild('message');
	$newMessage->addAttribute('message_id', ($numberMessages + 1));

	$newMessageUsername = $newMessage->addChild('name', $name);
	$newMessageContent = $newMessage->addChild('content', $content);
	$newMessageDate = $newMessage->addChild('messageTime', $date);
	$xml->saveXML("XML-chat.xml");
	
?>
