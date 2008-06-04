<?

	require_once('Action.inc.php');


	class ActionLogger
	{
		var $file;
		var $handle;
		
		function ActionLogger()
		{
			// set up the file to write into
			$folder = date('mdy');
			
			if (!file_exists('log/' . $folder))
				if (!mkdir('log/' . $folder))
					return false;
				
			$this->file = 'log/' . $folder . '/action.log';
			
			// open the log
			if (!$this->handle = fopen($this->file, 'a'))
				return false;

			return true;
		}
		
		function log($action)
		{
			if (!$this->handle) return false;
			
			$log = '';
			$log .= date('r') . ' ';
			
			$log .= '[' . $action->uid . ':' . $action->gid . '] ';
			$log .= $action->name;
			
			
			if (is_array($action->param))
			{
				$log .= ' (';
				
				foreach ($action->param as $name => $value)
					$log .= $name . ': ' . $value . ', ';
			
				$log .= ')' . NL;
				
				$log = str_replace(', )', ')', $log);	// remove the trailing pointless comma
			}
			
			
			
			return fwrite($this->handle, $log);
		}
	}
	
	$actionLogger = new ActionLogger();

?>