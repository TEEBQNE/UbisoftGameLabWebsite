<!-- Reset username post -->

<?php include 'process.php'?> 

<?php
// doesn't allow user to be here without an assigned username
if (isset($_SESSION['username']) == false)
{
	echo '<meta http-equiv="refresh" content="0; URL=/">';
	exit;
}


// makes sure the php does not delete entry unless prompted in success.php
if($_POST['action'] == 'call_this') {
	
	// reassigns the var username to session user (for some reason username is lost?)
	$username = $_SESSION['username'];
	
	// deletes the username from the table
	$result = mysqli_query($connect, "DELETE FROM users WHERE username='$username'");
	
	// unsets the username from the session so that user can revisit index.php to re-enter username
	unset($_SESSION['username']);
}
// redirect to homepage
echo '<meta http-equiv="refresh" content="0; URL=/">';
?>
