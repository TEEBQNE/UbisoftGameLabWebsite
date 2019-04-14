<!DOCTYPE html>
<html>
<body>
<head>
		<meta charset="utf-8">
	
		<link rel="stylesheet" href="lobby.css">
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
	</style>
</head>

<script>
var buttonClickCount = -1;

function GoToLobby()
{
	// set the session variable (has done tutorial to true)
	// then load index page
	window.location.href = "index.php";
	return false;
}

// poll for any press on screen
$(document).on('click', function() {
  buttonClickCount++;
  
  var tutorialTextArray = ["Tap a stream to begin spectating"];
  var tutorialTextPosition = 0;
  
  // if they reached the max, then go back to the main page
  if(buttonClickCount == 1)
  	window.location.href = "tutorialTest2.php";
  	// route them to the actual lobby page
  $("#tutorialText").text(tutorialTextArray[buttonClickCount]);
  $(".TutorialTextHolder").css("top", "180px");
  $(".TutorialTextHolder").css("left", "40vw");
});

</script>

<!-- 

Keep a 'click' count on the webpage
Confirmation button or anywhere on the page? (Except skip button - - skip button just sets the count to max click count)
Store text bubbles in an array using click count to find what to print
Use an arrow which position is stored in another array
Have an array of the current webpage / tab to show everything
possibly make this a fake webpage that has no interaction, just css / html to show the user what everything looks like
-->

<div id = "tutorialPotrait">

<div class = "TutorialTextHolder">
<p id = "tutorialText">Tap your profile to change your username</p>
</div>
<!--<img id = "backgroundImg" src="TutorialPics/img1.png"/>-->
<button onclick="GoToLobby()">SKIP</button>

	<div id = "lobbyCopy">
	<body>
<h2 id = "page title">Descent of</br>Champions</h2>
<h2 id = "helloMessage">Hello Name</h2>

<p style="visibility: hidden;" id = "headerBox"></p>

<input style="visibility: visible;" onclick="showButtons()"id ="emptyPicture" type="image" src="http://meng.uic.edu/wp-content/uploads/sites/92/2018/07/empty-profile.png" name="saveForm" class="btTxt submit"/>
<input style="visibility: hidden;" onclick="hideButtons()"id="deletePicture" type="image" src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/44/Wheel_cross.svg/1024px-Wheel_cross.svg.png" name="deleteForm" class="btTxt submit"/>

<input style="visibility: hidden;" onclick="deleteAccount(); location.href='reset.php';"id="deleteAccount" type="image" src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f5/Circle-icons-caution.svg/2000px-Circle-icons-caution.svg.png" name="deleteName" class="btTxt submit"/>
<input style="visibility: hidden;" onclick="changeName(); location.href='change.php';"id="changeName" type="image" src="https://cdn0.iconfinder.com/data/icons/round-ui-icons/512/settings_red.png" name="changeName" class="btTxt submit"/>
<div id = "lobbyPortraitBody">
<input type="text" id="myInput" placeholder="Search for a streamer.." title="Type in a name">

<ul id="myUL">
	<div class = "container">
	<li>
  			<div class="username">TEEBQNE</div>
  			<div class = "userPicture"><img width="100" height="100" id ="userPhoto" src="//i.imgur.com/cGRVCK5.jpg"></div>
  			<img class = "viewerCountPic" src="//i.imgur.com/0nzTHqC.png"/>
  			<div id="viewerCount" class="viewerCount"><p><span>100</span></p></div>
	</li>
	</div>
</ul>
</div>
</body>
</div>
</div>

<div id="lobbyLandscapeBody" class = "hideThisDiv">
	<p> This page should only be viewed in portrait mode. Please reorient your device! </p>
</div>


</body>
</html>