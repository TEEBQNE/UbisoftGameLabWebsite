<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Twitch Authentication</title>
	
</head>
<body>
<script>
window.onload = function() {
  displayKeyOnWebpage();
};

function displayKeyOnWebpage()
{
	var h1Element = document.getElementById("pageh1");
	var keyElement = document.getElementById("key");
	var theKey = null;
	
	var S = window.location.href;
	
	// example url to deal with (regex should be able to handle it unless this base URL changes drastically
	// http://localhost/~TEEBQNE/accountDBPractice/twitchAuthentication.php#access_token=TOKENHERE&scope=user_read+channel_read&token_type=bearer
	
	theKey = S.match(/(?<=access_token=).[^&]*/);

	if(theKey != null)
	{
		h1Element.innerHTML = "Please copy this key into the input box in Unity to confirm your identity with Twitch:";
	}
	
	keyElement.innerHTML = theKey;
	
}
</script>
	<h1 id ="pageh1">You did not get to this page correctly. Go to Unity and click the authentication button please.</h1>
	<br></br>
	<p id="key"></p>
</body>
</html>