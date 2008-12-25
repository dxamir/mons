<?php
/*
 * Created on Jan 28, 2008
 *
 */

	require_once('include/Game.inc.php');
	require_once('include/game/monopoly/Tell.inc.php');
	
	
	
	class MonopolyGame extends Game
	{
		var $players;
		var $currentPlayer;
		

		function doTell($params, $gid, $uid)
		{
			$tell = new TellEvent();

			$tell->uid = $uid;
			$tell->gid = $gid;
			$tell->to = $params['to'];
			$tell->message = $params['message'];

			$this->event[] = $tell;

			$response = new ActionResponse(new Message('All OK'));
			return $response;
		}
		
	}
	 

?>
