<?php
	include_once('database.php');
	session_start();
	
	// <!-- Stream UI bar for the stream page -->	
	
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
		//echo '<meta http-equiv="refresh" content="0; URL=http://descentofchampions.com/index.php/error">';
		echo '<meta http-equiv="refresh" content="0; URL=http://'.$localIP.$adminUsername.'/websiteFinal/index.php">';
		exit;
	}
?>


<!DOCTYPE html>
<html>
<body>
	<div class = "UIBanner">
		<img id="highlight" src="WebsiteArt/MessageButtonSelect.png"/>
		<input onclick="toggleIcons(1)"id ="messages" type="image" src="WebsiteArt/MessageButton.png" name="message" class="btTxt submit"/>
		<input onclick="toggleIcons(0)"id ="backButton" type="image" src="WebsiteArt/BackButton.png" name="backButton" class="btTxt submit"/>
		<input onclick="toggleIcons(2)"id ="shop" type="image" src="WebsiteArt/ShopButton.png" name="shop" class="btTxt submit"/>
		<input onclick="toggleIcons(3)"id ="emote" type="image" src="WebsiteArt/EmoteButton.png" name="emote" class="btTxt submit"/>
		<p id = "money">$<?php echo $currentMoney?>k</p>
		<div id = "moneyHolder"></div>
		<div id = "verticalLine"></div>
	</div>
</body>
</html>
