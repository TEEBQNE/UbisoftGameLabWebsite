<!-- Authenticates User's Twitch through post in Unity -->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Twitch Authentication</title>
	<link rel="shortcut icon" type="image/png" href="WebsiteArt/favicon.png">	
	
	<style>
		h1, p
		{
			text-align: center;
			color: white;
		}

		h1
		{
			color: violet;
		}
		
		h1
		{
			font-size: 3vh;
			 -webkit-text-stroke-width: 1.5px;
   			-webkit-text-stroke-color: white;
		}

		p
		{
			font-size: 2vw;
			word-wrap: break-word;
		}
	
		#backgroundImg
		{
			z-index: -1;
			position: absolute;
			top: 0px;
			left: 0px;
			width: 100%;
			height: 100%;
		}

		button, h1, .keyHolder
		{
			position: absolute;
   			left: 50%;
   			transform: translate(-50%,-50%);
		}		

		.keyHolder
		{
			top: 60%;
			text-align: center;
			background-color: gray;
			width: 30%;
			border: 4.5px solid #2A2A2A;
 			box-shadow: 0 0 0 1.5px #D7B4FF, 0 0 0 7px #7D34DB;
		}

		h1
		{
			top: 45%;
		}
		
		button
		{
			top: 70%;
			 -webkit-appearance: 
        		none; border-radius: 0; 
        		border:none; 
        		height: 50px; 
        		width:250px; 
        		background:purple; 
        		color:#fff; 
        		font-size:22px
		}
	</style>

</head>
<body>
<script>
window.onload = function() {
  displayKeyOnWebpage();
};

 var theKey = null;

function displayKeyOnWebpage()
{
	var h1Element = document.getElementById("pageh1");
 	var keyElement = document.getElementById("key");
	var S = window.location.href;
	
	// example url to deal with (regex should be able to handle it unless this base URL changes drastically
	// http://localhost/~TEEBQNE/accountDBPractice/twitchAuthentication.php#access_token=TOKENHERE&scope=user_read+channel_read&token_type=bearer
	
	// to support all browsers, cannot use look behind assertion
	// supported in js, but only has support in chrome
	//theKey = S.match(/(?<=access_token=).[^&]*/);
	theKey = S.match(/access_token=([A-Za-z0-9]+)/);

	if(theKey != null)
	{
		h1Element.innerHTML = "Please copy this key into the input box in Unity to confirm your identity with Twitch.";
	  
		// grab the first group as full match includes access_token     
        	keyElement.innerHTML = theKey[1];
	}
	else
	{
		keyElement.innerHTML = "No key sent";
	}
	
}

</script>
	<h1 id ="pageh1">You did not get to this page correctly. Go to the Descent of Champions game app and click the 'i'm streaming this' button.</h1>
	<br></br>
	<div class = "keyHolder">
	<p id="key"></p>
	</div>
	<button onclick="copying_function()">Click here to copy key!</button>
	<img id = "backgroundImg" src = "WebsiteArt/TitleSplash.png"/>

<script>

// copies the keyboard to user's clipboard
function copying_function() {
 // string.select();
  const el = document.createElement('textarea');

  if(theKey === null)
	el.value = "Read the instructions above";
  else
  	el.value = theKey[1];
  document.body.appendChild(el);
  el.select();
  document.execCommand('copy');
  document.body.removeChild(el);
}

</script>
</body>
</html>
