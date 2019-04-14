<?php

// <!-- Sends local storage from javascript to php session variable -->

include("database.php");
session_start();

// if the posted variable is set, then set the session variable
if(isset($_POST['localName']))
	$_SESSION['username'] = $_POST['localName'];
?>
