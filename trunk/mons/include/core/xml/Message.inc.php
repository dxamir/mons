<?


	class Message
	{
		var $type;
		var $text;
		
		
		function Message($text, $type = 0)
		{
			$this->text = $text;
			$this->type = $type;
		}
		
		function toXML()
		{
			echo '<Message type="' . $this->type . '">';
			echo $this->text;
			echo '</Message>';
		}
	}



?>