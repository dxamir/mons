<?

	require_once('include/core/xml/Message.inc.php');


	class ActionResponse
	{
		var $status;
		
		var $message;
		
		
		function ActionResponse($message = null, $status = 0)
		{
			if ($message)
				$this->message = $message;
				
			$this->status = $status;
		}
		
		function toXML()
		{
			echo '<ActionResponse status="' . $this->status . '">';
			
			if ($this->message)
				$this->message->toXML();
			
			echo '</ActionResponse>';
		}
	}



?>