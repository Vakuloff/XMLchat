<?php 
$chatTitle = $_GET['chatTitle'];
$xml = simplexml_load_file($xmlPath = 'XML/' . $chatTitle . '.xml');

$messages = array();
$messages = $xml->chatroom->messages->message;
$numberMessages = count($messages);

for ($i=0; $i < $numberMessages; $i++) { 
	$messages[$i]['name'] = $messages[$i]->name;
	$messages[$i]['content'] = $messages[$i]->content;
	$messages[$i]['messageTime'] = $messages[$i]->messageTime;
	
	echo "<li class='username'>" . $messages[$i]['name'] . "</li>";
	echo "<li>" . $messages[$i]['content'] . "</li>";
	echo "<li>" . $messages[$i]['messageTime'] . "</li>";
			}
 ?>