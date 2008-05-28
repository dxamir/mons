<?php
/*
 * Created on Jan 28, 2008
 *
 */

	require_once('include/Game.inc.php');
	
	
	
	class MonopolyGame extends Game
	{
		var $games;
		var $users;
		var $user;
		
		function context($user, $game)
		{
			$this->user = $user;
			$this->game = $game;
		}
		
		function cmdBuyHouse()
		{
			return;
		}
		
	}
	 

?>
