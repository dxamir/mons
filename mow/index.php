<?php

?>


<html>

<head>
	<title>mow: Monopoly Web</title>
	
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>

	<h1 style="float:left;">mow | </h1>
	<h4 style="padding-top:12px; text-indent:5px;">Aid to mons development as a mons client simulator.</h4>

	<label>Action</label> <input type="text" id="a" value="Tell">
	<label>UID</label> <input type="text" id="uid" value="1">
	<label>GID</label> <input type="text" id="gid" value="1">
	<input type="submit" onclick="Javascript:action()" value="Go">

	<fieldset>
		<legend>Parameters</legend>

		<div class="field"><label>Parameter 1</label> <input type="text" id="p1" value="message"></div>
		<div class="field"><label>Value 1</label> <input type="text" id="v1" value="Hello"></div>
		<div class="field"><label>Parameter 2</label> <input type="text" id="p2" value=""></div>
		<div class="field"><label>Value 2</label> <input type="text" id="v2" value=""></div>
		<div class="field"><label>Parameter 3</label> <input type="text" id="p3" value=""></div>
		<div class="field"><label>Value 3</label> <input type="text" id="v3" value=""></div>
		<div class="field"><label>Parameter 4</label> <input type="text" id="p4" value=""></div>
		<div class="field"><label>Value 4</label> <input type="text" id="v4" value=""></div>
		<div class="field"><label>Parameter 5</label> <input type="text" id="p5" value=""></div>
		<div class="field"><label>Value 5</label> <input type="text" id="v5" value=""></div>
	</fieldset>

	<fieldset>
		<legend>Events</legend>
		Starting from <input type="text" value="1" size="4"> <input type="submit" value="Fetch">
		<hr>

		<div id="events"></div>
	</fieldset>

</body>

</html>
