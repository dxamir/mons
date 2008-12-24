<?php
/*
 * Created on Jan 25, 2008
 */


	require_once('config/config.inc.php');
	require_once('include/Database.inc.php');
	require_once('include/Dispatcher.inc.php');
 	require_once('include/core/xml/ActionResponse.inc.php');
 	require_once('include/game/monopoly/MonopolyGame.inc.php');


	session_start();
	
	/*** DEV -- SET UP A DUMMY GAME INSTANCE ***/
	if (!$_SESSION['game'][1])
		$_SESSION['game'][1] = new MonopolyGame();


	$dispatcher = new Dispatcher();
	
	$actionResponse = $dispatcher->dispatch($_REQUEST);
	
	
	header('Content-Type: text/xml');
	
	echo $actionResponse->toXML();

?>
