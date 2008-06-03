<?

	require_once('config/config.inc.php');
	require_once('include/game/MonopolyGame.inc.php');

	session_start();
	
	
	
	
	$game = $_SESSION['game'][1] = new MonopolyGame();
	

?>