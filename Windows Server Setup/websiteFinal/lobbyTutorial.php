<?php include 'database.php'?> 
<?php
session_start();

// <!-- Tutorial for lobby page -->

if(!isset($_SESSION['username']))
{
	echo '<meta http-equiv="refresh" content="0; URL=http://'.$localIP.$adminUsername.'/websiteFinal/index.php">';
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="lobbystyle.css">
		<link rel="shortcut icon" type="image/png" href="WebsiteArt/favicon.png">
		<script src="jquery.min.js" type="text/javascript"></script>
		<title>Lobby Tutorial</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		
	<style>
	/* load in custom font */
	@font-face {
    		font-family: "autumnregular";
    		src: url('http://'.$localIP.'/~'.$adminUsername.'websiteFinal/autumn__-webfont.woff') format('woff');
    		font-weight: normal;
    		font-style: normal;
	}

	/* disables all tapping for objects */
	*
	{
		touch-action: none;
	}

	/* specific blur for the page */
	/*#tutorialPortrait > #lobbyCopy > *:not(.showing)
	{
  		-webkit-filter: blur(3px);
		filter: blur(3px);
		-moz-filter: blur(3px);
	}*/
	/* not needed for this page - - designers wanted a shorter tutorial */

	html
	{
		overflow: hidden;
	}

	/* always blur this element (never un-blurred) */
	/*#myInput
	{
		-webkit-filter: blur(3px);
	}*/

	/* fixes skip button for iOS users */
	button
	{
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
	}

	#skipButton
    	{
		background-color: red;
		z-index: 999;
		position: fixed;
		bottom: 0;
		left: 0;
		height: 5vh;
		width: 10vh;
    	}

	/* allows for relative screen space positioning that dynamically scales on any device
	I have tested it on so far. Also forces images not to flicker when changed */	
	#tutorialImg
	{
		-webkit-backface-visibility: hidden;
		-moz-backface-visibility:    hidden;
		-ms-backface-visibility:     hidden;
		z-index:999;
		width: 30vw;
		font-size: 20px;
		margin: 0 auto;
		-webkit-transform: translate(135%, 25em);
		-moz-transform: translate(135%, 25em);
		transform: translate(135%, 25em);
		position: absolute;
		pointer-events: none;
	}
	
	/* handles mobile version of tutorial */
	@media screen and (max-device-width: 480px){
	
		#tutorialImg
		{
			width: 50vw;
			-webkit-transform: translate(60%, 15em);
			-moz-transform: translate(60%, 15em);
			transform: translate(60%, 15em);
		}	
	}
	
	.username
	{
		font-size: 2vh;
		top: -2vh;
		font-family: "autumnregular";
	}
</style>
</head>
<body>
<script>

// preload the images to make image flicker not occur when switching src of image
function preloadImages(srcs, imgs) {
    var img;
    for (var i = 0; i < srcs.length; i++) {
        img = new Image();
        img.src = "WebsiteArt/Tutorial/" + srcs[i];
        imgs.push(img);
    }
}

// determine what device is being used (iOS task bar messes everything up)
// desktops are too large, this is the only solution I found to make everything
// look nice and have the images point correctly at the elements

// finds what device is being used
var userAgent = navigator.userAgent || navigator.vendor || window.opera;

// source files to load images
//var tutorialImageSrcArray = ["Step2.png", "Step3.png", "Step4.png"];

// loaded references to be used later
//var tutorialImageReferences = [];
var tutorialTextPosition = [];

// check if you are on mobile
/*if (/android/i.test(userAgent) || (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream))
{   
	  var tutorialTextPosition = [
        {
                yOffset: '5%',
                xOffset: '35%',
                numberUnblur: 0,
                unblurArray: []
        },
        {
                yOffset: '75%',
                xOffset: '50%',
                numberUnblur: 2,
                unblurArray: ["#emptyPicture", "#helloMessage"]
        },
        {
                yOffset: '60%',
                xOffset: '15em',
                numberUnblur: 1,
                unblurArray: ["#lobbyPortraitBody"] 
        }
   ];
}
else
{
	// desktop
	var tutorialTextPosition = [
        {
                yOffset: '5%',
                xOffset: '100%',
                numberUnblur: 0,
                unblurArray: []
        },
        {
                yOffset: '200%',
                xOffset: '50%',
                numberUnblur: 2,
                unblurArray: ["#emptyPicture", "#helloMessage"]
        },
        {
                yOffset: '135%',
                xOffset: '25em',
                numberUnblur: 1,
                unblurArray: ["#lobbyPortraitBody"] 
        }
   ];
}*/
var buttonClickCount = -1;
var isPortrait = true;

// poll for any press on screen
$(document).on('click touchstart', doTutorial);

/*window.addEventListener('load', function(){
	// reloads the images on load
	preloadImages(tutorialImageSrcArray, tutorialImageReferences);
});*/

function doTutorial(e){
if(e.type == 'touchstart')
{
	$(document).off('click', doTutorial).click(function(e)
	{
			// removes the ghost click on mobile 
	 		e.stopPropagation();
         	e.preventDefault();
         	return false;
	});
}

if(isPortrait)
  buttonClickCount++;
  
  // if they reached the max, then go to the next portion of tutorial
  if(buttonClickCount == tutorialTextPosition.length)
  	window.location.href = "streamTutorial.php";
  else
  {
  	// blur the divs before this one if it is not the first one
	if(buttonClickCount > 0 && tutorialTextPosition[buttonClickCount-1].numberUnblur > 0)
	{
		for(var x = 0; x < tutorialTextPosition[buttonClickCount-1].numberUnblur; x++)
		{
			$(tutorialTextPosition[buttonClickCount-1].unblurArray[x]).removeClass("showing");
		}
	}
	
	// un-blur the divs that need to be seen for this portion of the tutorial 
	if(tutorialTextPosition[buttonClickCount].numberUnblur > 0)
	{
		for(var x = 0; x < tutorialTextPosition[buttonClickCount].numberUnblur; x++)
		{
			$(tutorialTextPosition[buttonClickCount].unblurArray[x]).addClass("showing");
		}
	}
	
	// set the new positions, transition the fade for the flicker, update src of image
	var localXOffset = tutorialTextPosition[buttonClickCount].yOffset;
	var localYOffset = tutorialTextPosition[buttonClickCount].xOffset;
	$("#tutorialImg").css("transition", "background-image 1s ease-in-out");
	$("#tutorialImg").css("-webkit-transform", "translate(" + localXOffset + ", " + localYOffset + ")"); 
	$("#tutorialImg").css("-moz-transform", "translate(" + localXOffset + ", " + localYOffset + ")"); 
 	$("#tutorialImg").attr('src', tutorialImageReferences[buttonClickCount].src);
  
 }

	// prevents the ghost click on mobile to skip images
    e.stopPropagation();
    e.preventDefault();
    return false;
};

function GoToLobby()
{
	// skip button
	window.location.href = "lobby.php";
	return false;
}

</script>
<div id = "tutorialPortrait">

<img id = "tutorialImg" src="WebsiteArt/Tutorial/Step4.png"/>
<button id="skipButton" onclick="GoToLobby()">Skip Tutorial</button>

	<div id = "lobbyCopy">
	<body>
<h2 id = "page title">Descent of</br>Champions</h2>
<h2 id = "helloMessage">Hello <?php echo $_SESSION['username']; ?></h2>

<p style="visibility: hidden;" id = "headerBox"></p>

<input disabled style="visibility: visible;" id ="emptyPicture" type="image" src="WebsiteArt/SettingIcon.png" name="saveForm" class="btTxt submit"/>
<div id = "lobbyPortraitBody">
<input disabled type="text" id="myInput" placeholder="Search for a streamer.." title="Type in a name">

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

<img id = "backgroundImage" src = "WebsiteArt/lobbyBackgroundMain.png">
<img id = "topHolder" src = "WebsiteArt/lobbyBackgroundTop.png">
</div>
</body>
</div>
</div>

<div id="lobbyLandscapeBody" class = "hideThisDiv">
	<p> This page should only be viewed in portrait mode. Please reorient your device! </p>
</div>

<script>

var potraitBody = document.getElementById("tutorialPortrait");
var landscapeBody = document.getElementById("lobbyLandscapeBody");

// determines screen orientation (page should only be viewed in portrait as decided by designers
var handleOrientationChange = (function() {
    var struct = function(){
        struct.parse();
    };
    struct.showPortraitView = function(){
         potraitBody.classList.remove("hideThisDiv");
         landscapeBody.classList.add("hideThisDiv");
	 isPortrait = true;
    };
    struct.showLandscapeView = function(){
         potraitBody.classList.add("hideThisDiv");
         landscapeBody.classList.remove("hideThisDiv");
	 isPortrait = false; 
    };
    struct.parse = function(){
        switch(window.orientation){
            case 0:
                    //Portrait Orientation
                    this.showPortraitView();
                break;
            default:
                   // Landscape Orientation
                   this.lastOrientation = window.orientation;
                   this.showLandscapeView();
                break;
        }
    };
    struct.lastOrientation = window.orientation;
    return struct;
})();
window.addEventListener("orientationchange", handleOrientationChange, false);
</script>
</body>
</html>
