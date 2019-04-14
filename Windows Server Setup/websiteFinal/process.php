<?php include 'database.php'?> 

<?php
session_start();

// <!-- Process posted username data and handle it -->

// checks if it is a valid form submission (prevents blank entries in mysql table)
if(isset($_POST['username']))
{
	// create username variable
	$theName=$_POST['username'];
	
	// user's starting balance for a new account
	$startingBalance = 6;
	
	// redirect if the username is longer than 10 characters
	if(strlen($theName) > 10)
	{
                echo 'Name must be shorter than 10 characters! Please try again.';
		exit;
	}
	
	// sanatize input and see if it exists in the database
	if($stmt = $connect->prepare("SELECT username FROM users WHERE username=?"))
	{
		$stmt->bind_param("s", $theName);
		$stmt->execute();
		$stmt->store_result();
		$numRows = mysqli_stmt_num_rows($stmt);
		$stmt->close();
	}

	// if it exists, then don't add it
	if($numRows < 1)
	{	
		// sanatize the input again
		if($stmt = $connect->prepare("INSERT INTO users(username, money) VALUES(?, ?)"))
		{
			$stmt->bind_param("si", $theName, $startingBalance);
			$username = $_SESSION['username'];
			$stmt->execute();
			$stmt->close();
		}
		$_SESSION['username'] = $theName;
		// redirect to lobby
		echo 'success';
	}
	else
	{
		// skips over print if redirecting to index page after name reset
		if(isset($theName))
		{
                	echo 'Name is already taken. Please try another name.';
		}
	}
	$connect->close();
} else if(isset($_POST['newusername']))
{
	// create username variable
	$theName=$_POST['newusername'];
	
	// redirect if the username is longer than 10 characters
	if(strlen($theName) > 10)
	{
		echo 'Name must be shorter than 10 characters! Please try again.';
		exit;
	}

	// sanatize input and see if it exists in the database
	if($stmt = $connect->prepare("SELECT username FROM users WHERE username=?"))
	{
		$stmt->bind_param("s", $theName);
		$stmt->execute();
		$stmt->store_result();
		$numRows = mysqli_stmt_num_rows($stmt);
		$stmt->close();
	}
	
	// if it exists, then don't add it
	if($numRows < 1)
	{
		// sanatize the input again
		if($stmt = $connect->prepare("UPDATE users SET username=? WHERE username='" . $_SESSION['username'] . "'"))
		{
			$stmt->bind_param("s", $theName);
			$username = $_SESSION['username'];
			$stmt->execute();
			$stmt->close();
		}
		
		// set session variable
		$_SESSION['username'] = $theName;
		echo 'success';
	}
	else
	{
		// skips over print if redirecting to index page after name reset
		if(isset($theName))
		{
			echo 'Name is already taken. Please try another name.';
		}
	}
	$connect->close();
}
else
{
//	echo '<meta http-equiv="refresh" content="0; URL=/">';
}
?>
