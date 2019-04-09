<?php 
session_start();
	$chatTitle= $_GET['chatTitle'];
	$name = $_SESSION['nickname'];
	$content = $_POST['content'];
	$date = date(" dS F Y h:m:s A");

	$xmlPath = 'XML/' . $chatTitle . '.xml';
	$xml = simplexml_load_file($xmlPath);
	$messages = array();
	$messages = $xml->chatroom->messages->message;
	$numberMessages = count($messages);

	$newMessage = $xml->chatroom->messages->addChild('message');
	$newMessage->addAttribute('message_id', ($numberMessages + 1));

	$newMessageUsername = $newMessage->addChild('name', $name);
	$newMessageContent = $newMessage->addChild('content', $content);
	$newMessageDate = $newMessage->addChild('messageTime', $date);
	$xml->saveXML('XML/' . $chatTitle . '.xml');
?>
