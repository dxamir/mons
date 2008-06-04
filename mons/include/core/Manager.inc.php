<?php

	require_once('Entity.inc.php');
	

	/**
	 * Entity management
	 * 
	 * Regular management class for the Entity class
	 * 
	 * @author silver
	 */
	class Manager
	{
		/**
		 * Adds an Entity into its storage table
		 * 
		 * @param Entity Entity to add
		 * @return int Inserted record ID
		 */
		function add($entity)
		{
			global $db;
			
			$db->begin();
			
			$ok = $db->insert($this->_getfields($entity), $entity->_name);
			$lastInsertID = $db->lastInsertID();
			
			if ($ok)
				$db->commit();
			else
				$db->rollback();
			
				
			return $lastInsertID;
		}
		
		/**
		 * Saves an existing Entity into its storage table
		 * 
		 * The Entity's current state is saved into the storage. The id field of the Entity is required
		 * 
		 * @param Entity Entity to save
		 * @return bool Action outcome
		 */
		function save($entity)
		{
			global $db;
			
			$db->begin();
			
			$oldentity = $this->get($entity);
			
			
			$fields = $this->_getfields($entity);
			
			foreach ($fields as $field=>$value)
				$oldentity->$field = $value;
					
			
			$ok = $db->update($this->_getfields($oldentity), $this->_wherer($oldentity, null, true), $oldentity->_name);
			
			if ($ok)
				$db->commit();
			else
				$db->rollback();
			
			return $ok;
		}
		
		/**
		 * Deletes an Entity from its storage table
		 * 
		 * The Entity should be identifiable
		 * 
		 * @param Entity Entity to delete
		 * @return bool Action outcome
		 */
		function delete($entity)
		{
			// make sure we delete exactly ONE entity at a time
			$entity = $this->get($entity);
			
			//print_r($entity);
			
			if (!$entity || is_array($entity))
				return false;

			
			$fields = $this->_getfields($entity);
			$ok = true;
			
			global $db;
			
			
			$db->begin();

			$ok = $db->delete($this->_identify($entity), $entity->_name);
			
			if ($ok)
				$db->commit();
			else
				$db->rollback();
			
			return $ok; 
		}
		
		/**
		 * Retrieves an Entity from its storage table
		 * 
		 * The Entity should be identifiable
		 * 
		 * @param Entity Entity to delete
		 * @return bool Action outcome
		 */
		function get($entity, $operators=null)
		{
			$onerecord = $this->_identify($entity);
			$fields = array_keys($this->_getfields($entity));
			
			foreach ($fields as $index=>$field)
				$fields[$index] = '`' . $field . '`'; 

			global $db;

			// ONE record:
			if ($onerecord && !$operators)
			{
				$res = $db->select($fields, $onerecord, '', $entity->_name);
			}
			else
			{
				$res = $db->select($fields, $this->_wherer($entity, $operators), '', $entity->_name);
			}
			
			$entityClass = get_class($entity);
			
			while ($row = $db->fetchAssoc($res))
			{
				$fetchedEntity = new $entityClass;
				
				foreach ($row as $field=>$value)
					$fetchedEntity->$field = $value;

				if ($onerecord && !$operators)
					$result = $fetchedEntity;
				else
					$result[] = $fetchedEntity;
			}
			
			return $result;
		}
		
		
		
	//////////////////////////////////////////////////////	
		
		
		function _identify($entity)
		{
			if (!$entity) return false;

			foreach ($entity->_key as $pk)
				if (!$entity->$pk) return false; else
					$where .= ' `' . $pk . '` = ' . $entity->$pk . ' AND ';
					
			$where .= ' 1=1 ';
				
			return $where; 
		}
		
		function _wherer($entity, $operators = null, $pkeys = false)
		{
			if (!$fields = $this->_getfields($entity))
				return false;
			
			foreach ($fields as $field=>$value)
				if ($value != NULL)
				{
					if ((in_array($field, $entity->_key) && $pkeys) || !$pkeys)
						switch ($operators[$field])
						{
							case '~':
								$where .= ' `' . $field . '` LIKE ' . '\'%' . $value . '%\' AND ';
								break;
								
							case 'NULL':
								$where .= ' `' . $field . '` IS NULL AND ';
								break;
								
							case '!NULL':
								$where .= ' `' . $field . '` IS NOT NULL AND ';
								
							default:
								$where .= ' `' . $field . '` ' . ($operators[$field] ? $operators[$field] : '=') . ' ' . '\'' . $value . '\' AND ';
								break;
						}
				}
					
			$where .= ' 1=1 ';
			
			//echo $where;
			
			return $where;
			
		}
		
		function _getfields($entity)
		{
			if (!$entity) return false;

			$membervars = get_object_vars($entity);
			
			foreach ($membervars as $key=>$value)
				if ($key[0] != '_') $fields[$key] = $value;
				
			return $fields;
		}
		
	}
	
?>