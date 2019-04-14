<?php include 'process.php'?> 

<?php

// redirects if the username is not set
if (isset($_SESSION['username']) == false)
{
	echo '<meta http-equiv="refresh" content="0; URL=index.php">';
	exit;
}

// checks user input for errors
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'process.php'))
{
	// handles error if name is too long
	if(isset($_SESSION['tooLong']))
	{
		echo '<p>Username can only be up to 10 characters. Please try another name.</p>';
		unset($_SESSION['tooLong']);
	}
	else
	{
		// handles error if name is already in the database
		echo '<p>Username already taken. Please try another name.</p>';
	}
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Change Name</title>
  <link rel="stylesheet" href="index.css">
   <script src="jquery.min.js"></script>
   <script>
  	// makes the input no symbols
  	$(document).keypress(function (e) {
  		// handles the enter key press
  		if(e.keyCode == 13)
  			return true;
		var txt = String.fromCharCode(e.which);
		if (!txt.match(/[A-Za-z0-9.  ]/)) {
			return false;
		}
	});
  </script>
</head>
<body>
 <div class="rlform">
  <div class="rlform rlform-wrapper">
   <div class="rlform-box">
    <div class="rlform-box-inner">
   <form method="post" name="newusername" action="process.php">
    <p>Enter a new Username</p>
    <p>Note: This will leave your old one up for grabs</p>

    <div class="rlform-group">
     <input type="username" name="newusername" class="rlform-input" placeholder='New Username' autocomplete="off"required>
    </div>
   </form>
  </div>
   </div>
     </div>
 </div>
 </body>
</html>