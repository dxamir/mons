<?php
/*
 * Created on Jan 28, 2008
 */
 
 
	class Action
	{
		var $name;
		var $uid;
		var $gid;
		
		var $param;
		
		var $user;
		var $game;
		
		function Action($name = '', $uid = 0, $gid = '', $param = null)
		{
			$this->name = $name;
			$this->uid = $uid;
			$this->gid = $gid;
			
			$this->param = $param;
		}
		
		function serialize()
		{
			global $db;
			
			$res = $db->select('*', 'id=' . intval($this->uid), '', 'user');
			
			if (!$res)
				return false;
				
							
			$row = $db->fetchAssoc($res);
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