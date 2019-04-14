<?php
include_once('database.php');
session_start();

// <!-- Update user money in the mysql table -->

// pulls money data of user on load (by username)
if(isset($_POST['updatedMoney']))
{
	$query = "UPDATE users SET money='".$_POST['updatedMoney']."' WHERE username='" . $_SESSION['username'] . "'";
	
	$result = mysqli_query($connect, $query);
}
?>
