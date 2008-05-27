<?

	define('SLOT_TYPE_NORMAL1', 	1);
	define('SLOT_TYPE_NORMAL2', 	2);
	define('SLOT_TYPE_NORMAL3', 	3);
	define('SLOT_TYPE_NORMAL4', 	4);
	define('SLOT_TYPE_NORMAL5', 	5);
	define('SLOT_TYPE_NORMAL6', 	6);
	define('SLOT_TYPE_NORMAL7', 	7);
	define('SLOT_TYPE_NORMAL8', 	8);
	define('SLOT_TYPE_GO', 			9);
	define('SLOT_TYPE_CHEST', 		10);
	define('SLOT_TYPE_INCOME', 		11);
	define('SLOT_TYPE_RAILROAD', 	12);
	define('SLOT_TYPE_CHANCE', 		13);
	define('SLOT_TYPE_JAIL', 		14);
	define('SLOT_TYPE_UTILITY', 	15);
	define('SLOT_TYPE_PARKING', 	16);
	define('SLOT_TYPE_GOJAIL', 		17);
	define('SLOT_TYPE_LUXURY', 		18);

	
	class Slot
	{
		var $name;
		var $price;
		var $type;
		var $icon;
	}
	
?>