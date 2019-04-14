<?php
session_start();

$path = ltrim($_SERVER['REQUEST_URI'], '/');    // Trim leading slash(es)
$elements = explode('/', $path);                // Split path on slashes
$redirectPath = "";
if($elements[3])
	$redirectPath = rtrim($elements[3], '.php');
// going to need to change this as the current URL is [~TEEBQNE[0]]/DB[1]/index[2]/link[3]
if(empty($elements[3])) {                       // No path elements means home
	if(isset($_SESSION['streamChat']))
	{
		header('Location: http://localhost/~TEEBQNE/accountDBPractice/stream.php');
		exit;
	}
    // is homepage
} else switch($redirectPath)             // Pop off first item and switch
{
	// redirection
    case 'stream':
		if(isset($_SESSION['streamChat']))
		{
			header('Location: http://localhost/~TEEBQNE/accountDBPractice/stream.php');
		}
		else
		{
			$redirect = rtrim($elements[4], '.php');
			$_SESSION['streamRedir'] = $redirect;
			$_SESSION['streamChat'] = $redirect;
			
			// if they go into a new lobby, reset the backlog
			unset($_SESSION['chatHistory']);
			header('Location: http://localhost/~TEEBQNE/accountDBPractice/stream.php');
    	}
    	exit;
        break;
    default:
		header('Location: http://localhost/~TEEBQNE/accountDBPractice/404.php');
		exit;
    	break;
exit;
//}
}

// redirect from the index to lobby if they have a username but aren't watching a stream
if (isset($_SESSION['username']) && !(isset($_SESSION['streamChat'])))
{
	//echo '<meta http-equiv="refresh" content="0; URL=lobby.php">';
	//exit;
}

// checks if user has come from the process.php - - if they have, they entered a duplicate username
// retains session of user entry until it is reset or cookies deleted

// checks if the incoming connection came from process. If it did, user typed in an owned name
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
  <title>Descent of Champions Login</title>
  <link rel="stylesheet" href="index.css">
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script>
  	// makes the input no symbols
  	$(document).keypress(function (e) {
  		console.log("HI");
  		// handles the enter key press
  		if(e.keyCode == 13)
  			return true;
		var txt = String.fromCharCode(e.which);
		var regexConst = /u[a-z0-9]{4}/gi;
		// makes sure the user cannot enter symbols for their name
		if (!txt.match(/[A-Za-z0-9.  ]/) || txt.match(regexConst)) {
			return false;
		}
	});
	
$('#theInputForName').each(function() {
   var elem = $(this);

   // Save current value of element
   elem.data('oldVal', elem.val());

   // Look for changes in the value
   elem.bind("propertychange change click keyup input paste", function(event){
      // If value has changed...
      if (elem.data('oldVal') != elem.val()) {
       // Updated stored value
       elem.data('oldVal', elem.val());

       // Do action
       ....
     }
   });
 });
  </script>
</head>
<div id = "hideEverything">
<body>
 <div class="rlform">
  <div class="rlform rlform-wrapper">
   <div class="rlform-box">
    <div class="rlform-box-inner">
   <form id = "theForm" method="post" name="username" action="process.php">
    <p>Enter Username to Continue</p>

    <div class="rlform-group">
     <input id="theInputForName" type="username" name="username" class="rlform-input" placeholder='Username' autocomplete="off"required>
    </div>
   </form>
  </div>
   </div>
     </div>
 </div>
 </div>
 </body>
</html>