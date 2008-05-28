<?php
/*
 * Created on Jan 28, 2008
 */
 
 	require_once('Command.inc.php');

 
	class Dispatcher
	{
	
		function parse($request)
		{
			$action = 'a';
			$uid = 'u';
			$gid = 'g';
			$param = 'p';
		
			return new Command($request[$action], $request[$uid], $request[$gid], $request[$param]);
		}

		
		function validate($command)
		{
			$games = $_SESSION['games'];		// active games instances
			$game = $_SESSION['game'];			// the game interface object
			
			
			// check the game exists and is active			
			if ($games && !array_key_exists($command->gid, $games))
				return false;
				
				
			// check the command exists
			if (!method_exists($game, 'cmd' . $command->action))
				return false;
				
				
			return true;
			
		}
		
		
		function dispatch($request)
		{
			$command = $this->parse($request);
			
			if (!$this->validate($command))
				exit;						// die, the command does not validate

			$game = $_SESSION['game'];
			

			//$game->context()
			//$game->{$command->action}();				
			
		}
		
		
	}
	
?>
