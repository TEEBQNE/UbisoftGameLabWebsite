<?php include 'database.php'?> 
<?php
session_start();

// <!-- Website homepage / login page -->

$path = ltrim($_SERVER['REQUEST_URI'], '/');    // trim leading slash(es)
$elements = explode('/', $path);                // split path on slashes
$redirectPath = "";

// check if there is a redirect necessary
if($elements[3])
	$redirectPath = $elements[3];

// tests if the first element is empty
if(empty($elements[3])) {                       // no path elements means home

	// if a user went to the index page but already had a lobby selected, redirect
	// to the stream
	if(isset($_SESSION['streamChat']))
	{
		echo '<meta http-equiv="refresh" content="0; URL=http://'.$localIP.$adminUsername.'/websiteFinal/stream.php">';
		exit;
	}
    // is homepage
} else switch($redirectPath)             		 
{
	// redirection for the stream lobby
    case 'stream':
		// if username is not found in database, remove it from their storage and let them enter a new name
		// occurs whenever a database reset happens
		/*if(isset($_SESSION['error']))
		{
			unset($_SESSION['error']);
			header('Location: http://descentofchampions.com/error');
			break;
		}else*/ 
		if(isset($_SESSION['streamChat']))
		{
			// redirect to stream, stream is already set
			echo '<meta http-equiv="refresh" content="0; URL=http://'.$localIP.$adminUsername.'/websiteFinal/stream.php">';
		}
		else
		{
			$redirect = $elements[4];
			
			// set the stream lobby
			$_SESSION['streamRedir'] = $redirect;
			$_SESSION['streamChat'] = $redirect;
			
			// redirect to the stream lobby loading the page using the above session variables
			echo '<meta http-equiv="refresh" content="0; URL=http://'.$localIP.$adminUsername.'/websiteFinal/stream.php">';
    	}
    	exit;
        break;
    case 'error':
		alert("ERROR");
		break;
    default:
    	// if it is not redirecting for the stream, then it is a 404
		echo '<meta http-equiv="refresh" content="0; URL=http://'.$localIP.$adminUsername.'/websiteFinal/404.php">';
		exit;
    	break;
//exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" type="image/png" href="WebsiteArt/favicon.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Descent of Champions Login</title>
  <link rel="stylesheet" href="index.css">
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script>

	var lastWindowWidth = $(window).width(),
    	lastWindowHeight = $(window).height();

	$(window).resize(function() {

    	var newWindowWidth = $(window).width(),
        	newWindowHeight = $(window).height();


    	if( newWindowHeight > lastWindowHeight && newWindowWidth == lastWindowWidth ) {
	$('html').css('min-height','100vh');

	setTimeout(function(){$('html').css('min-height', '-webkit-fill-available'); }, 1);
	/*
 min-height: -moz-available;         
    min-height: -webkit-fill-available;
    min-height: fill-available;
*/ 

    	}

    	lastWindowWidth = newWindowWidth;
    	lastWindowHeight = newWindowHeight;

	});

	// checks to see if the user already has an account saved in local storage
	// NOTE:: Does not work on iOS 8.3+
	window.onload = function checkLocalStorageVar()
	{
		/*var isError = "<?php echo $_SESSION['error']?>";
		
		if(isError !== 'undefined' && isError !== null)
		{
			if(localStorage.getItem('doc_username') !== 'undefined')
			{
				localStorage.removeItem('doc_username');
			}
		}*/
		// verifies that the variable is not null / undefined 
		if(localStorage.getItem('doc_username') !== 'undefined' && localStorage.getItem('doc_username') !== null)
		{
			// posts the name to verify that it exists in the mysql table
			var storageName = localStorage.getItem('doc_username');
			$.ajax({
				type: 'POST',
				url: 'loadUserData.php',
				data:
				{
					localName:storageName
				},
				success: function(data)
				{
					// on success, redirect to the lobby
					window.location.replace("lobby.php");
				}
			});
		}
		else
		{
			// else, they are a new user or an iPhone user returning, show the index page
			document.getElementById("indexPageDiv").classList.remove("hideThisDiv");
		}
		 $('#pageCover').fadeOut(300);
	}

	// sends the username entered to the server for validation
	$(function () {

		// grab the submit event from form
        $('form').on('submit', function (e) {

		// prevent page refresh on submission
        e.preventDefault();
        	
        // set local variable to post to server
	 	var localName = $('#theInputForName').val();
		$.ajax({
				type: 'post',
				url: 'process.php',
				data:
				{
					 username:localName
				},
				success: function (data) {
					if(data.indexOf("success") >= 0)
					{
					  // set the storage variable to the new name on success
					  localStorage.setItem('doc_username', localName);
					  
					  // redirect to the tutorial (new user means show the tutorial to them)
					  window.location.replace("lobbyTutorial.php");
					}
					else
					{
						// invalid name, display error to the user (10 char limit, not [A-Za-z0-9]
						$('#theInputForName').val('');
						$("#errorMessage").text(data);	
					}	 
					}
				});

			});
      });

	// function to send unique / edited error response for the input box based on the regex
	// defined in the input element
	function InvalidMsg(textbox)
	{
		if(textbox.validity.patternMismatch){
        	textbox.setCustomValidity('Invalid Name! Please only enter letters, numbers and/or spaces.');
    	}    
    	else {
        	textbox.setCustomValidity('');
    	}
    		return true;
	}
  </script>
</head>
<div id = "pageCover">
	<p>Descending the Champions...</p>
</div>
<div id = "indexPageDiv" class="">
<p style="text-align:center;" id= "errorMessage"></p>
<div id = "hideEverything">
<body>
<!--<img id = "lobbyBackgroundImg" src = "http://i.imgur.com/22zoamK.gif">-->
<div class="rlform">
  <div class="rlform rlform-wrapper">
   <div class="rlform-box">
    <div class="rlform-box-inner">
    <form id = "theForm" name="username">
    <p>Welcome! Please enter a username to join the spectacle</p>

    <div class="rlform-group">
     <input id="theInputForName" pattern="[A-Za-z0-9 ]*" onvalid=";" oninvalid="InvalidMsg(this);"   onchange="try{setCustomValidity('')}catch(e){}" 
  onkeypress="try{setCustomValidity('')}catch(e){}" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="off" type="username" name="username" class="rlform-input" placeholder='Enter a username...' autocomplete="off"required>
    </div>
   </form>
  </div>
   </div>
     </div>
 </div>
 </div>
</div>
 </body>
</html>
