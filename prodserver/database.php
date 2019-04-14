<?php
// <!-- Universal include file to access azure mysql database -->

// checks if there is already a session called
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

// connects to the azure server (Syntax: database, credentials, password, specific database to access)
$connect=mysqli_connect('azureURL','email@gamelab.mysql.database.azure.com','password','databaseToConnectTo');
 
// verify the connecition
if(mysqli_connect_errno($connect))
{
 	echo 'Failed to connect';
}
?>
