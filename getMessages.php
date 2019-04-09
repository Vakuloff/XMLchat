<?php 
session_start();
$chatTitle = $_GET['chatTitle'];
$xml = simplexml_load_file($xmlPath = 'XML/' . $chatTitle . '.xml');

$messages = array();
$messages = $xml->chatroom->messages->message;
$numberMessages = count($messages);

for ($i = ($numberMessages -1); $i >= 0 ; $i--) { 
	$messages[$i]['name'] = $messages[$i]->name;
	$messages[$i]['content'] = $messages[$i]->content;
	$messages[$i]['messageTime'] = $messages[$i]->messageTime;
	
	if($messages[$i]->name == $_SESSION['nickname']){
		echo "<ul class='message right'>";
		echo "<li>" . $messages[$i]['name'] . "</li>";
		echo "<li class='message-content'>" . $messages[$i]['content'] . "</li>";
		echo "<li class='message-time'>" . $messages[$i]['messageTime'] . "</li>";
		echo "</ul>";
	} else{
		echo "<ul class='message left'>";
		echo "<li>" . $messages[$i]['name'] . "</li>";
		echo "<li class='message-content'>" . $messages[$i]['content'] . "</li>";
		echo "<li class='message-time'>" . $messages[$i]['messageTime'] . "</li>";
		echo "</ul>";
	}
}
 ?>