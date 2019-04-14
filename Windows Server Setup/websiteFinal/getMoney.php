<?php
include_once('database.php');
session_start();

	// <!-- Retrieve user money from mysql table -->

    	// pulls money data of user on load (by username)
	$query = "SELECT money FROM users WHERE username= '".$_SESSION['username']."' limit 1";
	
	$result = mysqli_query($connect, $query);
	
	// if it finds the username, it pulls the money from the table
	if(mysqli_num_rows($result) == 1)
	{
		$value = mysqli_fetch_object($result);
		echo $value->money;
		$result->close();
	}
	else
	{
		// if it can not find the name, it throws an error and forces the user back to the
		// homepage 
		unset($_SESSION['username']);
		unset($_SESSION['streamChat']);
		$_SESSION['error'] = "Fatal Error: Username not found in database";
		$result->close();
		
		// if it fails, this user does not exist, throw them to homepage
		echo '<meta http-equiv="refresh" content="0; URL=http://'.$localIP.$adminUsername.'/websiteFinal/index.php">';
		exit;
	}
?>
