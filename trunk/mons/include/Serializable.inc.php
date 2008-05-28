<?php
/*
 * Created on Jan 28, 2008
 */
 
	class Serializable
	{
		
		
		function serialize()
		{
			
		}
		
		function fromMap($map)
		{
			$vars = get_object_vars($this);
			
			foreach ($map as $key=>$value)
				if (array_key_exists($key, $vars))
					$this->$key = $value;
		}
		
	}
	
	
?>
