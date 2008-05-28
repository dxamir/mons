<?php
/*
 * Created on Jan 25, 2008
 */


	require_once('config/config.inc.php');
	require_once('include/Database.inc.php');
	require_once('include/Dispatcher.inc.php');




	$dispatcher = new Dispatcher();
	
	$dispatcher->dispatch($_REQUEST); 

?>
