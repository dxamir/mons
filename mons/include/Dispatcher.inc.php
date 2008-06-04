<?php

	/**
	 * Dispatcher class
	 * 
	 * @author sssilver@gmail.com
	 * @todo Finish the dispatch() function
	 */


 	require_once('Action.inc.php');
 	require_once('core/ActionLogger.inc.php');



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
		
			return new Action($request[$action], $request[$uid], $request[$gid], $request[$param]);
		}

		/**
		 * Validates the given command, making sure its game exists and is active and the command is valid
		 *
		 * @param Command $command
		 * @return bool
		 */
		function validate($action, $game)
		{
			/*
			$games = $_SESSION['games'];		// active games instances
			$game = $_SESSION['game'];			// the game interface object
			
			
			// check the game exists and is active			
			if ($games && !array_key_exists($command->gid, $games))
				return false;
			*/
				
			// check the command exists
			if (!method_exists($game, 'do' . $action->name))
				return false;
				
				
			return true;
		}
		

		/**
		 * Main function for dispatching. Dispatches the given request to the matching command and returns the response.
		 *
		 * Note that this currently assumes the game is in the session and doesn't load it when it is not. See @todo.
		 * 
		 * @param map $request
		 * @todo add the logic for http://code.google.com/p/mons/wiki/ServerLogic, section 1 pt. 3
		 */
		function dispatch($request)
		{
			global $actionLogger;
			
			$action = $this->parse($request);
			
			$game = $_SESSION['game'][1];

			if (!$this->validate($action, $game))
				return new ActionResponse(new Message('Action does not validate: ' . $action->name, 1), 1);
				
			$actionLogger->log($action);

			$call = 'do' . $action->name;
			
			// call the action
			$actionResponse = $game->$call($action->param, $action->gid, $action->uid);
			
			return $actionResponse;
		}
		
		
	}
	
?>
