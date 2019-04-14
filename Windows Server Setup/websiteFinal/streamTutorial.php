<html>
<!DOCTYPE html>
<head>
		<link rel="shortcut icon" type="image/png" href="WebsiteArt/favicon.png">
		<meta charset="utf-8">
		<link rel="stylesheet" href="chat.css">
                <link rel="stylesheet" href="stream.css">
                <link rel="stylesheet" href="emote.css">
		 <link rel="stylesheet" href="streamUI.css">
                <link rel="stylesheet" href="gameLobby.css">	
		<script src="jquery.min.js" type="text/javascript"></script>
		<title>Stream Tutorial</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		
	<style>
	*
        {
                touch-action: none;
        }
	#tutorialPortrait > #chatCopy > *:not(.noBlur)
	{
		-webkit-filter: blur(3px);
		  filter: blur(3px);
                -moz-filter: blur(3px);
	}
	#tutorialPortrait > #streamUICopy > *:not(.noBlur)
	{
		-webkit-filter: blur(3px);
		  filter: blur(3px);
                -moz-filter: blur(3px);
	}	
	#tutorialPortrait > #gameLobbyCopy > .holder >  *:not(.noBlur)
	{
		-webkit-filter: blur(3px);
	  	filter: blur(3px);
                -moz-filter: blur(3px);
	}
	#tutorialPortrait > #emoteTabCopy > *:not(.noBlur)
	{
		-webkit-filter: blur(3px);
		  filter: blur(3px);
                -moz-filter: blur(3px);
	}
	#tutorialPortrait > #shopTabCopy > *:not(.noBlur)
	{
		-webkit-filter: blur(3px);
	  	filter: blur(3px);
                -moz-filter: blur(3px);
	}
	/*#tutorialPortrait *:not(.showing)
        {
                -webkit-filter: blur(3px);
        }*/
	/*button
	{
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
	}*/
	.hideThisDiv
	{
		display:none;
	}

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

	#GruntHelper
        {
                width: 15vh;
                position: absolute;
                top: 50%;
                left: 7%;
                z-index: 1000;
        }
	#lobbyLandscapeBody
	{
    		position:fixed;
    		margin:0 auto;
    		clear:left;
    		height:auto;
    		z-index: 0;
    		text-align:center;
    		color: red;
    		font-size: 6vh;
    		top: 20vh;
	}
	.UIBanner
	{
		top: 35%;
	}
	#tutorialImg
	{
		-webkit-backface-visibility: hidden;
		-moz-backface-visibility:    hidden;
		-ms-backface-visibility:     hidden;
                z-index:999;
		width: 50vw;
		font-size: 20px;
    		margin: 0 auto;
		-webkit-transform: translate(45%, 36vh);
        	-moz-transform: translate(45%, 36vh);
        	transform: translate(45%, 36vh);
    		position: absolute;
   		 pointer-events: none;
	}
	
	.TutorialTextHolder p
	{
		text-align: center;
		font-size: 20px;
	}
	</style>

<script>
function preloadImages(srcs, imgs) {
    var img;
    for (var i = 0; i < srcs.length; i++) {
        img = new Image();
        img.src = "WebsiteArt/Tutorial/" + srcs[i];
        imgs.push(img);
    }
}
var userAgent = navigator.userAgent || navigator.vendor || window.opera;
if (/android/i.test(userAgent)) {
var tutorialImageSrcArray = ["Step6.png", "Step7.png", "Step8.png", "Step10.png", "Step11.png",  "Step13.png"];
  var tutorialImageReferences = [];
   var tutorialTextPosition = [
        {
                yOffset: '90%',
                xOffset: '65vh',
		pageDiv: '0',
		numberUnblur: 1,
		unblurArray: ["#container"]
        },
        {
                yOffset: '60%',
                xOffset: '36vh',
		pageDiv: '0',
		numberUnblur: 1,
		unblurArray: ["#UIWrapper"]
        },
        {
                yOffset: '10%',
                xOffset: '60vh',
		pageDiv: '1',
		numberUnblur: 1,
		unblurArray: ["#shopWrapper"]
        },
        /*{
                yOffset: '80%',
                xOffset: '33vh',
		pageDiv: '1',
		numberUnblur: 1,
		unblurArray: ["#UIWrapper"]
        },*/
        {
                yOffset: '70%',
                xOffset: '36vh',
		pageDiv: '1',
		numberUnblur:1,
		unblurArray: ["#UIWrapper"] 
        },
        {
                yOffset: '99%',
                xOffset: '55vh',
		pageDiv: '2',
		numberUnblur:1,
		unblurArray: ["#emoteWrapper"]
        },
        /*{
                yOffset: '48%',
                xOffset: '40vh',
		pageDiv: '2',
		numberUnblur: 1,
		unblurArray: ["#emoteWrapper"]
        },*/
        {
                yOffset: '95%',
                xOffset: '25vh',
                pageDiv: '2',
		numberUnblur: 3,
		unblurArray: ["#emoteWrapper", "#UIWrapper", "#theIframe"]
        }
   ];
}
else if(/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream)
{
var tutorialImageSrcArray = ["Step6.png", "Step7.png", "Step8.png",  "Step10.png", "Step11.png", "Step13.png"];
  var tutorialImageReferences = [];
   var tutorialTextPosition = [
        {
                yOffset: '90%',
                xOffset: '65vh',
		pageDiv: '0',
		numberUnblur: 1,
		unblurArray: ["#container"]
        },
        {
                yOffset: '60%',
                xOffset: '33.5vh',
		pageDiv: '0',
		numberUnblur: 1,
		unblurArray: ["#UIWrapper"]
        },
        {
                yOffset: '10%',
                xOffset: '60vh',
		pageDiv: '1',
		numberUnblur: 1,
		unblurArray: ["#shopWrapper"]
        },
        /*{
                yOffset: '80%',
                xOffset: '30.5vh',
		pageDiv: '1',
		numberUnblur: 1,
		unblurArray: ["#UIWrapper"]
        },*/
        {
                yOffset: '70%',
                xOffset: '33.5vh',
		pageDiv: '1',
		numberUnblur: 1,
		unblurArray: ["#UIWrapper"]
        },
        {
                yOffset: '99%',
                xOffset: '55vh',
		pageDiv: '2',
		numberUnblur: 1,
		unblurArray: ["#emoteWrapper"]
        },
        /*{
                yOffset: '48%',
                xOffset: '40vh',
		pageDiv: '2',
		numberUnblur: 1,
		unblurArray: ["#emoteWrapper"]
		
        },*/
        {
                yOffset: '95%',
                xOffset: '25vh',
                pageDiv: '2',
		numberUnblur: 3,
		unblurArray: ["#emoteWrapper", "#UIWrapper", "#theIframe"]
        }
   ];
}
else
{
// desktop - - designers said NOT to accomidate this platform
var tutorialImageSrcArray = ["Step6.png", "Step7.png", "Step8.png", "Step10.png", "Step11.png",  "Step13.png"];
  var tutorialImageReferences = [];
   var tutorialTextPosition = [
	 {
                yOffset: '90%',
                xOffset: '65vh',
		pageDiv: '0',
		numberUnblur: 1,
		unblurArray: ["#container"]
        },
        {
                yOffset: '60%',
                xOffset: '36vh',
		pageDiv: '0',
		numberUnblur: 1,
		unblurArray: ["#UIWrapper"]
        },
        {
                yOffset: '10%',
                xOffset: '60vh',
		pageDiv: '1',
		numberUnblur: 1,
		unblurArray: ["#shopWrapper"]
        },
        /*{
                yOffset: '80%',
                xOffset: '33vh',
		pageDiv: '1',
		numberUnblur: 1,
		unblurArray: ["#UIWrapper"]
        },*/
        {
                yOffset: '70%',
                xOffset: '36vh',
		pageDiv: '1',
		numberUnblur:1,
		unblurArray: ["#UIWrapper"] 
        },
        {
                yOffset: '99%',
                xOffset: '55vh',
		pageDiv: '2',
		numberUnblur:1,
		unblurArray: ["#emoteWrapper"]
        },
        /*{
                yOffset: '48%',
                xOffset: '40vh',
		pageDiv: '2',
		numberUnblur: 1,
		unblurArray: ["#emoteWrapper"]
        },*/
        {
                yOffset: '95%',
                xOffset: '25vh',
                pageDiv: '2',
		numberUnblur: 3,
		unblurArray: ["#emoteWrapper", "#UIWrapper", "#theIframe"]
        }
   ];
}
window.addEventListener('load', function(){
	preloadImages(tutorialImageSrcArray, tutorialImageReferences);
});
</script>
</head>
<body>
<div class = "noBlur" id = "tutorialPortrait">

<img class = "noBlur" id = "tutorialImg" src = "WebsiteArt/Tutorial/Step5.png"/>
<button id="skipButton" onclick="GoToLobby()">Skip Tutorial</button>
	<div id = "gameLobbyCopy">
        	<body>
			<div class="holder">
			<iframe
				id = "theIframe"
				src="https://player.twitch.tv/?channel=TEEBQNE>" 
				scrolling="no">
			</iframe>
			</div>

			<div id = "notificationHolder"></div>
		</body>
	</div>
        
        <div id = "streamUICopy">
                <body>
                <div class = "UIBanner noBlur" id = "UIWrapper">
                        <input id ="messages" type="image" src="WebsiteArt/MessageButton.png" name="message" class="btTxt submit"/>
                        <input id ="backButton" type="image" src="WebsiteArt/BackButton.png" name="backButton" class="btTxt submit"/>
                        <input id ="shop" type="image" src="WebsiteArt/ShopButton.png" name="shop" class="btTxt submit"/>
                        <input id ="emote" type="image" src="WebsiteArt/EmoteButton.png" name="emote" class="btTxt submit"/>
                        <p id = "money">$1000000k</p>
                        <div id = "moneyHolder"></div>
                        <img id="highlight" src="WebsiteArt/MessageButtonSelect.png"/>
                        <div id = "verticalLine"></div>
                </div>
                </body>
        </div>

	<div id = "chatCopy">
		<body>
			<div id="container">

			<div id="result-wrapper">
				<div id="result">
					<div class="chats"></div>
				</div>			
			</div>

		<form class = "theForm"  id="my_form" name="my_form">

		<div id="form-container">
			<div class="form-text">
    				<input  type="text" style="display:none" id="username">
    				<textarea disabled type="text" maxlength="250"id="comment"></textarea>
    			</div>
    			<div class="form-btn">
    				<input disabled style="text-align: center;" value = "Send" id="btn" name="btn"/>
    			</div>
			</div>
			</form>

		</div>

 	
 		</body>		
	</div>
	
	<div id = "emoteTabCopy" class = "hideThisDiv">
		<body>
<div class ="wrapper" id = "emoteWrapper">
<div id = "theText">
<div id = "headerText">Spectator Interaction Menu</div>
</div>
<ul id="myUL">
	<div class = "container">
	<li>
			<div id = "emoteImg">
			<div class = "timers" id = "timer1"></div>
			<div class = "priceTag" id = "price1"><p>$3k</p></div>
  			<div class = "userPicture"><input id ="emote1" type="image" src="WebsiteArt/BuyCheer.png" name="message" class="btTxt submit"/></div>
  			<div class="cooldown" id="cooldown1">&nbsp<span></span></div>
  			<div class = "timeout" id = "timeout1">3000</div>
  			</div>
  			<div id="emoteId1" class="emoteId"><p><span>Cheer</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			
  			<div class = "timers" id = "timer2"></div>
  			<div class = "priceTag" id = "price2"><p>$3k</p></div>
  			<div class = "userPicture"><input id ="emote2" type="image" src="WebsiteArt/BuyClap.png" name="message" class="btTxt submit"/></div>
  			<div class="cooldown" id="cooldown2">&nbsp<span></span></div>
  			<div class = "timeout" id = "timeout2">3000</div>
  			</div>
  			<div id="emoteId2" class="emoteId"><p><span>Clap</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			
  			<div class = "timers" id = "timer3"></div>
  			<div class = "priceTag" id = "price3"><p>$3k</p></div>
  			<div class = "userPicture"><input id ="emote3" type="image" src="WebsiteArt/basketball.png" name="message" class="btTxt submit"/></div>
  			<div class="cooldown" id="cooldown3">&nbsp<span></span></div>
  			<div class = "timeout" id = "timeout3">3000</div>
  			</div>
  			<div id="emoteId3" class="emoteId"><p><span>BasketBall</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			
  			<div class = "timers" id = "timer4"></div>
  			<div class = "priceTag" id = "price4"><p>$3k</p></div>
  			<div class = "userPicture"><input id ="emote4" type="image" src="WebsiteArt/ymca.png" name="message" class="btTxt submit"/></div>
  			<div class="cooldown" id="cooldown4">&nbsp<span></span></div>
  			<div class = "timeout" id = "timeout4">3000</div>
  			</div>
  			<div id="emoteId4" class="emoteId"><p><span>YMCA</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			
  			<div class = "timers" id = "timer5"></div>
  			<div class = "priceTag" id = "price5"><p>$3k</p></div>
  			<div class = "userPicture"><input id ="emote5" type="image" src="WebsiteArt/spin.png" name="message" class="btTxt submit"/></div>
  			<div class="cooldown" id="cooldown5">&nbsp<span></span></div>
  			<div class = "timeout" id = "timeout5">3000</div>
  			</div>
  			<div id="emoteId5" class="emoteId"><p><span>Spin</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			
  			<div class = "timers" id = "timer6"></div>
  			<div class = "priceTag" id = "price6"><p>$3k</p></div>
  			<div class = "userPicture"><input id ="emote6" type="image" src="WebsiteArt/throw.png" name="message" class="btTxt submit"/></div>
  			<div class="cooldown" id="cooldown6">&nbsp<span></span></div>
  			<div class = "timeout" id = "timeout6">3000</div>
  			</div>
  			<div id="emoteId6" class="emoteId"><p><span>ThrowHead</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			
  			<div class = "timers" id = "timer7"></div>
  			<div class = "priceTag" id = "price7"><p>$3k</p></div>
  			<div class = "userPicture"><input id ="emote7" type="image" src="WebsiteArt/BuyDab.png" name="message" class="btTxt submit"/></div>
  			<div class="cooldown" id="cooldown7">&nbsp<span></span></div>
  			<div class = "timeout" id = "timeout7">3000</div>
  			</div>
  			<div id="emoteId7" class="emoteId"><p><span>Dab</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			<div style="visibility:hidden" class = "blackCircle" id = "circle8">&nbsp<span></span></div>
  			<div class = "timers" id = "timer8"></div>
  			<div class = "priceTag" id = "price8"><p>$3k</p></div>
  			<div class = "userPicture"><input id ="emote8" type="image" src="WebsiteArt/backflip.png" name="message" class="btTxt submit"/></div>
  			<div class="cooldown" id="cooldown8">&nbsp<span></span></div>
  			<div class = "timeout" id = "timeout8">3000</div>
  			</div>
  			<div id="emoteId8" class="emoteId"><p><span>Backflip</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			
  			<div class = "timers" id = "timer9"></div>
  			<div class = "priceTag" id = "price9"><p>$3k</p></div>
  			<div class = "userPicture"><input id ="emote9" type="image" src="WebsiteArt/hide.png" name="message" class="btTxt submit"/></div>
  			<div class="cooldown" id="cooldown9">&nbsp<span></span></div>
  			<div class = "timeout" id = "timeout9">3000</div>
  			</div>
  			<div id="emoteId9" class="emoteId"><p><span>YouCantSeeMe</span></p></div>
	</li>
	</div>
</ul>

<div id = "recentEmotePurchase"></div>
<img id="buyableButton" src="WebsiteArt/BuyButton.png">
<button disabled id = "emoteInteractButton">Interact</button>
</div>
</body>
	</div>
	
	<div id = "shopTabCopy" class = "hideThisDiv">
		<body>
			<div class ="wrapper" id="shopWrapper">
			<div id = "theText">
<div id = "headerText">Game Purchase Menu</div>
</div>
<ul id="myUL">
	<div class = "container">
	<li>
			<div id = "emoteImg">
			<div class = "contributed" id = "raised1"><p>$0k</p></div>
			<div class = "priceTag" id = "itemPrice1"><p>$30k</p></div>
  			<div class = "userPicture"><input id ="item1" type="image" src="WebsiteArt/BuyLaser.png" name="message" class="btTxt submit"/></div>
  			<div class="fillup" id="fillup1">&nbsp<span></span></div>
  			</div>
  			<div id="itemId1" class="emoteId"><p><span>Laser Enemy</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			<div class = "contributed" id = "raised2"><p>$0k</p></div>
  			<div style="display: none" class = "priceTag" id = "itemPrice2"><p>$140k</p></div>
  			<div class = "userPicture"><input disabled id ="item2" type="image" src="WebsiteArt/BuyLock.png" name="message" class="btTxt submit"/></div>
  			<div class="fillup" id="fillup2">&nbsp<span></span></div>
  			</div>
  			<div id="itemId2" class="emoteId"><p><span>Coming Soon</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			<div class = "contributed" id = "raised3"><p>$0k</p></div>
  			<div style="display: none" class = "priceTag" id = "itemPrice3"><p>$200k</p></div>
  			<div class = "userPicture"><input disabled id ="item3" type="image" src="WebsiteArt/BuyLock.png" name="message" class="btTxt submit"/></div>
  			<div class="fillup" id="fillup3">&nbsp<span></span></div>
  			</div>
  			<div id="itemId3" class="emoteId"><p><span>Coming Soon</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			<div class = "contributed" id = "raised4"><p>$0k</p></div>
  			<div class = "priceTag" id = "itemPrice4"><p>$45k</p></div>
  			<div class = "userPicture"><input id ="item4" type="image" src="WebsiteArt/BuyElite.png" name="message" class="btTxt submit"/></div>
  			<div class="fillup" id="fillup4">&nbsp<span></span></div>
  			</div>
  			<div id="itemId4" class="emoteId"><p><span>Elite Enemy</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			<div class = "contributed" id = "raised5"><p>$0k</p></div>
  			<div style="display: none" class = "priceTag" id = "itemPrice5"><p>$300k</p></div>
  			<div class = "userPicture"><input disabled id ="item5" type="image" src="WebsiteArt/BuyLock.png" name="message" class="btTxt submit"/></div>
  			<div class="fillup" id="fillup5">&nbsp<span></span></div>
  			</div>
  			<div id="itemId5" class="emoteId"><p><span>Coming Soon</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			<div class = "contributed" id = "raised6"><p>$0k</p></div>
  			<div style="display: none" class = "priceTag" id = "itemPrice6"><p>$420k</p></div>
  			<div class = "userPicture"> <input disabled id ="item6" type="image" src="WebsiteArt/BuyLock.png" name="message" class="btTxt submit"/></div>
  			<div class="fillup" id="fillup6">&nbsp<span></span></div>
  			</div>
  			<div id="itemId6" class="emoteId"><p><span>Coming Soon</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			<div class = "contributed" id = "raised7"><p>$0k</p></div>
  			<div class = "priceTag" id = "itemPrice7"><p>$90k</p></div>
  			<div class = "userPicture"><input id ="item7" type="image" src="WebsiteArt/BuyBomb.png" name="message" class="btTxt submit"/></div>
  			<div class="fillup" id="fillup7">&nbsp<span></span></div>
  			</div>
  			<div id="itemId7" class="emoteId"><p><span>Bomb</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			<div class = "contributed" id = "raised8"><p>$0k</p></div>
  			<div style="display: none" class = "priceTag" id = "itemPrice8"><p>$550k</p></div>
  			<div class = "userPicture"><input disabled id ="item8" type="image" src="WebsiteArt/BuyLock.png" name="message" class="btTxt submit"/></div>
  			<div class="fillup" id="fillup8">&nbsp<span></span></div>
  			</div>
  			<div id="itemId8" class="emoteId"><p><span><span>Coming Soon</span></span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			<div class = "contributed" id = "raised9"><p>$0k</p></div>
  			<div style="display: none" class = "priceTag" id = "itemPrice9"><p>$1000k</p></div>
  			<div class = "userPicture"><input disabled id ="item9" type="image" src="WebsiteArt/BuyLock.png" name="message" class="btTxt submit"/></div>
  			<div class="fillup" id="fillup9">&nbsp<span></span></div>
  			</div>
  			<div id="itemId9" class="emoteId"><p><span>Coming Soon</span></p></div>
	</li>
	</div>
</ul>
<img id="buyableButton" src="WebsiteArt/BuyButton.png">
<button disabled id = "interactButton">Contribute 5k</button>
</div>

	</div>
</body>
</div>

<div id="lobbyLandscapeBody" class = "hideThisDiv">
	<p>This page should only be viewed in portrait mode. Please reorient your device!</p>
</div>

<script>
var potraitBody = document.getElementById("tutorialPortrait");
var landscapeBody = document.getElementById("lobbyLandscapeBody");
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

<script>
var emoteDiv = document.getElementById("emoteTabCopy");
var shopDiv = document.getElementById("shopTabCopy");
var chatDiv = document.getElementById("chatCopy");
var buttonHighlightDiv = document.getElementById("highlight");
var buttonClickCount = -1;
var isPortrait = true;
// poll for any press on screen
$(document).on('click touchstart', doTutorial);
if(/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream)
{
	var initialDiv = document.getElementById("tutorialImg").style.webkitTransform = "translate(45%, 33vh)";
}
function doTutorial(e) {
if(e.type == 'touchstart')
{
        $(document).off('click', doTutorial).click(function(e)
        {
                e.stopPropagation();
                //e.preventDefault();
                return false;
        });
}
if(isPortrait)
  buttonClickCount++;
 
  // if they reached the max, then go back to the main page
  if(buttonClickCount == tutorialImageSrcArray.length)
  	window.location.href = "lobby.php";
  	// route them to the actual lobby page
  else
  {
	if(buttonClickCount > 0)
	{
		for(var x = 0; x < tutorialTextPosition[buttonClickCount-1].numberUnblur; x++)
		{
			$(tutorialTextPosition[buttonClickCount-1].unblurArray[x]).removeClass("noBlur");
		}
	}
	else
	{
		$("#UIWrapper").removeClass("noBlur");
	}
	for(var x = 0; x < tutorialTextPosition[buttonClickCount].numberUnblur; x++)
	{
		console.log(tutorialTextPosition[buttonClickCount]);
		$(tutorialTextPosition[buttonClickCount].unblurArray[x]).addClass("noBlur");
	}
	//$("#tutorialImg").attr("src", "WebsiteArt/Tutorial/" + tutorialImgSrcArray[buttonClickCount]);
  	var localXOffset = tutorialTextPosition[buttonClickCount].yOffset;
	var localYOffset = tutorialTextPosition[buttonClickCount].xOffset;
	$("#tutorialImg").css("transition", "background-image 1s ease-in-out");
	$("#tutorialImg").css("-webkit-transform", "translate(" + localXOffset + ", " + localYOffset + ")"); 
	$("#tutorialImg").css("-moz-transform", "translate(" + localXOffset + ", " + localYOffset + ")"); 
 	$("#tutorialImg").attr('src', tutorialImageReferences[buttonClickCount].src);
	ChangeView(tutorialTextPosition[buttonClickCount].pageDiv);
  }	
  e.stopPropagation();
  e.preventDefault();
  return false;
};
function GoToLobby()
{
	// set the session variable (has done tutorial to true)
	// then load index page
	window.location.href = "lobby.php";
	return false;
}
function ChangeView(viewType)
{
	switch(viewType)
	{
		case '0':
			// default (ignore or change depending on what designers want from tutorial)
			break;
		case '1':
			buttonHighlightDiv.src = "WebsiteArt/ShopButtonSelect.png";
			chatDiv.classList.add("hideThisDiv");
			shopDiv.classList.remove("hideThisDiv");
			buttonHighlightDiv.style.left = "35%";
			break;
		case '2': 
			buttonHighlightDiv.src = "WebsiteArt/EmoteButtonSelect.png";
			shopDiv.classList.add("hidethisDiv");
			emoteDiv.classList.remove("hideThisDiv");
			buttonHighlightDiv.style.left = "50%";
			break;
		default:
			break;
	}
}
</script>
</body>
</html>
