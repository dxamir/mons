<?php
/*
 * Created on Jan 28, 2008
 */
 
 
	class Game
	{
		
		var $event;

		
		/**
		 * Returns all events >= the given index.
		 *
		 * @param index Index of the offset
		 * @return array Array of events
		 */
		function events($index)
		{
			return array_slice($this->event, $index);
		}
	}

?>
