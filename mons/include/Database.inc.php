<?php


/*

	MySQL implementation

*/


class Database
{


	function Database()
	{
		if (!mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS)) return false;
		if (!mysql_select_db(MYSQL_DB)) return false;
		if (!mysql_query("SET NAMES utf8")) return false;
	}
	
	function query($q)
	{
		// Version I: Replace all sharps in the query
		//$q = str_replace('#', MYSQL_PREFIX . '_', $q);
		
		// Version II: Replace the last sharp in the query
		/*
		$posSharp = strrpos($q, '#');
		
		if ($posSharp)
			$q = substr($q, 0, $posSharp) . MYSQL_PREFIX . substr($q, $posSharp+1);
		*/
		
		//echo $q;
		
		$res = mysql_query($q);
		if (!$res && DEBUG == true)
			echo $q . ' --- ' . mysql_error();
		
		return $res;
	}
	
	function select($fields, $where, $post, $table)
	{
		$q = 'SELECT ';
		
		if (count($fields) == 0 || !is_array($fields))
			$q .= '*';
		else
		{
			$q .= $fields[0];
			
			for ($i = 1; $i < count($fields); ++$i)
				$q .= ', ' . $fields[$i];
		}
		
		$q .= ' FROM ';
		$q .= '`' . MYSQL_PREFIX . '_' . $table . '`';
		
		if ($where)
			$q .= ' WHERE ' . $where;
			
		$q .= ' ' . $post;
		
//		if ($table == 'parameter' && $post == 'LIMIT 1')
//			echo $q . "\n";
		
		$res = $this->query($q);
		if (!$res && DEBUG == true)
			echo $q . ' --- ' . mysql_error();
		
		//if ($post == 'LIMIT 1') echo $q . "\n";
		return $res;
		
	}
	
	function lastInsertID()
	{
		return mysql_insert_id();
	}
	
	function affectedRows()
	{
		return mysql_affected_rows();
	}
	
	function numRows($res)
	{
		return mysql_num_rows($res);
	}
	
	function fetchRow($res)
	{
		if (!$res) return false;
		
		return mysql_fetch_row($res);
			
	}
	
	function fetchAssoc($res)
	{
		if (!$res) return false;

		return mysql_fetch_assoc($res);
	}
	
	function update($map, $where = '', $table)
	{
		if (!$map) return false;
		
		
		$q = 'UPDATE `' . MYSQL_PREFIX . '_' . $table . '` SET ';
		
		foreach ($map as $key => $value)
		{
			$q .= ' `' . $key;

			if (!is_null($value))
				$q .= '` = \'' . $value . '\', '; // HETT modified on 21/12/07 //$q .= '` = \'' . mysql_real_escape_string($value) . '\', ';
			else
				$q .= '` = NULL, ';
		}

		$q .= ' `' . $key . '` = \'' . $value . '\'';
		
		if ($where)
			$q .= ' WHERE ' . $where;
			
		//echo $q;
			
		return $this->query($q);
	}
	
	function replace($map, $table)
	{
		if (!$map) return 0;
		
		//$table = str_replace('#', MYSQL_PREFIX, $table);
		$table = MYSQL_PREFIX . '_' . $table;
		
		$q = 'REPLACE INTO `' . $table . '`(';
		
		$numFields = count($map); $i = 0;
		
		foreach ($map as $key=>$value)
		{
			$q .= '`' . $key . '`';
			if ($numFields > ++$i) $q .= ', ';
		}
			
		$q .= ') VALUES(';	
		
		$i = 0;

		foreach ($map as $value)
		{
			//$q .= '\'' . $value . '\'';
			
			
			if (!is_null($value))
				$q .= '\'' . $value . '\'';
			else
				$q .= 'NULL';
			
			
			if ($numFields > ++$i) $q .= ', ';
		}
		
		$q .= ')';
		
		//echo $q;
		
		return $this->query($q);
	}
	
	function insert($map, $table)
	{
		if (!$map) return 0;
		
		//$table = str_replace('#', MYSQL_PREFIX, $table);
		$table = MYSQL_PREFIX . '_' . $table;
		
		$q = 'INSERT INTO `' . $table . '`(';
		
		$numFields = count($map); $i = 0;
		
		foreach ($map as $key=>$value)
		{
			$q .= '`' . $key . '`';
			if ($numFields > ++$i) $q .= ', ';
		}
			
		$q .= ') VALUES(';	
		
		$i = 0;

		foreach ($map as $value)
		{
			//$q .= '\'' . $value . '\'';
			
			
			if (!is_null($value))
				$q .= '\'' . $value . '\'';
			else
				$q .= 'NULL';
			
			
			if ($numFields > ++$i) $q .= ', ';
		}
		
		$q .= ')';
		
		//echo $q;
		
		return $this->query($q);
	}
	
	function delete($where='', $table)
	{
		
		$q = 'DELETE FROM `' . MYSQL_PREFIX . '_' . $table . '`';
		
		if ($where)
			$q .= ' WHERE ' . $where;
			
		// echo $q;
			
		return mysql_query($q);
	}
	
	function begin()
	{
		if (!mysql_query("SET AUTOCOMMIT = 0"))
			return false;
			
		if (!mysql_query('START TRANSACTION'))
			return false;
			
		return true;
	}
	
	function commit()
	{
		if (!mysql_query('COMMIT'))
			return false;

		if (!mysql_query("SET AUTOCOMMIT = 1"))
			return false;
			
		return true;		
	}
	
	
	/*
	
			Escape the input map to avoid SQL Injection
	
	*/
	
	function sanitize($input)
	{
		
		if(is_array($input))
		{
			foreach($input as $k=>$i)
			{
				$output[$k]=$this->sanitize($i);
			}
		}
		else
		{
			if(get_magic_quotes_gpc())
			{
				$input=stripslashes($input);
			}
			
			$output=mysql_real_escape_string($input);
		}   
		
		return $output;
	}
	
}

$db = new Database();

?>