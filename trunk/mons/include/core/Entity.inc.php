<?php

	class Entity
	{
		var $id;
		
		var $_name;
		
		var $_type;
		var $_rule;
		var $_key;
		
		
		function Entity()
		{
			$map = get_object_vars($this);
			
			foreach ($map as $key=>$value)
				if ($key[0] != '_') $this->$key = null;
			
			$this->_key[] = 'id';			
		}
		
		
		// saves the class into the database
		function serialize($storage)
		{
			if (!$this->id) return false;
			
			$map = get_object_vars($this);
			
			foreach ($map as $key=>$value)
				if ($key[0] != '_') $varmap[$key] = $value;
			
			$errmap = array();
			
			
			global $db;
			
			$res = $db->update($varmap, 'id=' . $this->id, $storage);
			
			return $res;
		}
		
		
		// loads data from the database
		function unserialize($storage)
		{
			if (!$this->id) return false;
			
			global $db;
			
			$res = $db->select('*', 'id=\'' . $this->id . '\'', 'LIMIT 1', $storage);
			
			if (!$db->numRows($res))
				return false;
			
			//echo $this->id;
			

			if (!$res) return false;
			
			$row = $db->fetchAssoc($res);
			
			//print_r($row);
			
			foreach ($row as $key=>$value)
				$this->$key = $value;
				
				
			return true;
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