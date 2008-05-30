<?php

	/**
	 * Dispatcher class
	 * 
	 * @author sssilver@gmail.com
	 * @todo Finish the dispatch() function
	 */


 	require_once('Command.inc.php');



	class Dispatcher
	{
	
		/**
		 * Parses the request map, returning a command
		 *
		 * @param map $request
		 * @return Command
		 */
		function parse($request)
		{
			$action = 'a';
			$uid = 'u';
			$gid = 'g';
			$param = 'p';
		
			return new Command($request[$action], $request[$uid], $request[$gid], $request[$param]);
		}

		/**
		 * Validates the given command, making sure its game exists and is active and the command is valid
		 *
		 * @param Command $command
		 * @return bool
		 */
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
		

		/**
		 * Main function for dispatching. Dispatches the given request to the matching command and returns the response.
		 *
		 * @param map $request
		 */
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
