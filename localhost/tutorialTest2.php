<!DOCTYPE html>
<html>
<body>
<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="stream.css">
		<link rel="stylesheet" href="emote.css">
		<link rel="stylesheet" href="streamUI.css">
		<link rel="stylesheet" href="gameLobby.css">
		<script src="jquery.min.js" type="text/javascript"></script>
		<title>Tutorial</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		
	<style>
	.TutorialTextHolder
	{
		position:absolute; 
		width: 30%;
		word-wrap: break-word;
		z-index:999;
		background-color: gray;
		color: white;
		top: 100px;
		right: 30%;
	}
	
	.TutorialTextHolder p
	{
		text-align: center;
		font-size: 20px;
	}
	
	.hideThisDiv
	{
		display: none;
	}
	</style>
</head>

<script>
var buttonClickCount = -1;

$(document).on('click', function() {
  buttonClickCount++;
  
  var tutorialTextArray = ["Right now, you're looking at the stream chat. Chatting will generate part of your income!", "Tap the '$' to participate in gameplay!", "This is your disposable income from being rich!", "Contribute money to personalize your entertainment", "Navigate to the interaction menu to show the fighters you're entertained", "Interact from a safe distance and see your hologram represent you at the arena", "That's all for now. Enjoy the show!"];
  var tutorialTextPosition = 0;
  // if they reached the max, then go back to the main page
  if(buttonClickCount == 7)
  	GoToLobby();
  	// route them to the actual lobby page
  $("#tutorialText").text(tutorialTextArray[buttonClickCount]);
});

function GoToLobby()
{
	// set the session variable (has done tutorial to true)
	// then load index page
	window.location.href = "index.php";
	return false;
}
</script>

<!-- 

Keep a 'click' count on the webpage
Confirmation button or anywhere on the page? (Except skip button - - skip button just sets the count to max click count)
Store text bubbles in an array using click count to find what to print
Use an arrow which position is stored in another array
Have an array of the current webpage / tab to show everything
possibly make this a fake webpage that has no interaction, just css / html to show the user what everything looks like
-->
<p id = "tutorialText">"This is the spectator navigation bar!"</p>
<!--<img id = "backgroundImg" src="TutorialPics/img1.png"/>-->
<button onclick="GoToLobby()">SKIP</button>

<div id = "tutorialPotrait">
	<div id = "chatCopy">
	</div>
	
	<div id = "gameLobbyCopy">
	</div>
	
	<div id = "streamUICopy">
	</div>
	
	<div id = "emoteTabCopy">
	</div>
	
	<div id = "shopTabCopy">
	</div>
</div>

<div id="lobbyLandscapeBody" class = "hideThisDiv">
	<p> This page should only be viewed in portrait mode. Please reorient your device! </p>
</div>
</body>
</html>