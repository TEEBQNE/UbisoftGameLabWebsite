<?php
	include_once('database.php');
	session_start();
	
	// pulls money data of user on load (by username)
	$query = "SELECT money FROM users WHERE username= '".$_SESSION['username']."' limit 1";
	
	$result = mysqli_query($connect, $query);
	
	// if user is found, pull and display money
	if(mysqli_num_rows($result) == 1)
	{
		$value = mysqli_fetch_object($result);
		$currentMoney = $value->money;
		$result->close();
	}
	else
	{
		// if user is not found, redirect with fatal error
		unset($_SESSION['username']);
		unset($_SESSION['streamChat']);
		$_SESSION['error'] = "Fatal Error: Username not found in database";
		$result->close();
		// if it fails, this user does not exist, throw them to homepage
		echo '<meta http-equiv="refresh" content="0; URL=http://localhost/~TEEBQNE/accountDBPractice/index.php">';
		exit;
	}
?>


<!DOCTYPE html>
<html>
<body>
	<div class = "UIBanner">
		<input onclick="toggleIcons(0)"id ="messages" type="image" src="//i.imgur.com/nVLI4Zu.png" name="message" class="btTxt submit"/>
		<input onclick="toggleIcons(1)"id ="backButton" type="image" src="//i.imgur.com/nVLI4Zu.png" name="backButton" class="btTxt submit"/>
		<input onclick="toggleIcons(2)"id ="shop" type="image" src="//i.imgur.com/nVLI4Zu.png" name="shop" class="btTxt submit"/>
		<input onclick="toggleIcons(3)"id ="emote" type="image" src="//i.imgur.com/nVLI4Zu.png" name="emote" class="btTxt submit"/>
		<p id = "money">$<?php echo $currentMoney?>k</p>
		<div id = "moneyHolder"></div>
		<img id="highlight" src="//i.imgur.com/FWqhFzA.png"/>
		<div id = "verticalLine"></div>
	</div>
</body>
</html>