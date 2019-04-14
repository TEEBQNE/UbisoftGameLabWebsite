<?php
// is bad practice, but throws weird errors on windows
// just here to have these not pop up for people who have no idea what they are seeing
error_reporting(0);
// <!-- Universal include file to access azure mysql database -->
// Make a session variable here that passes around the IP that you need to set
// checks if there is already a session called
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

// grabs local IP of the machine to use for URL redirection
$localIP = $_SERVER['SERVER_ADDR'];

// change this to your username
// make the below variable just "" if you are on Windows/Linux
$adminUsername = "/~yourUsernameHere";

// change the password to whatever you set the mySQL password to in the setup
$connect=mysqli_connect('localhost','root','yourPasswordHere','mydatabase');
// verify the connecition
if(mysqli_connect_errno($connect))
{
 	echo 'Failed to connect';
}
?>