<?php
$accept=$_REQUEST['acceptVar'];
$client=$_REQUEST['clientVar'];
$key=$_REQUEST['keyVar'];

// <!-- Retrieve Streamer Data (User/Photo) -->

// for the check of streamers just need Client-ID: <ID HERE> in the array for curling

$headers = array(
);

array_push($headers, $accept);
array_push($headers,$key);
array_push($headers, $client);

$url = 'https://api.twitch.tv/kraken/user';

// init curl to Twitch
$ch = curl_init($url);

// curl data
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 3);

$result = curl_exec($ch);

// print resulting data
echo $result;

curl_close($ch);

// confirm there is a match, if there is, it worked!

// return the profile image
if(preg_match('/(?<="logo":").[^"]*/', $result, $logoMatches))
{
	echo $matches[0];
}

// return the username and picture if it worked
if (preg_match('/(?<=display_name":").[^"]*/', $result, $matches))
{
   echo "Success:TRUE|NAME:".$matches[0] . "|PHOTO:".$logoMatches[0];
}
else
{
	echo "Success:FALSE|";
}
?>
