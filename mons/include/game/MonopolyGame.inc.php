<?php
/*
 * Created on Jan 28, 2008
 *
 */

	require_once('include/Game.inc.php');
	
	
	
	class MonopolyGame extends Game
	{
		var $players;
		var $currentPlayer;
		
		
		function doTell($params, $gid, $uid)
		{
			$response = new ActionResponse(new Message('All OK'));
			return $response;
		}
		
	}
	 

?>
