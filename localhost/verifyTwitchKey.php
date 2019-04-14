<?php

$accept=$_REQUEST['acceptVar'];
$client=$_REQUEST['clientVar'];
$key=$_REQUEST['keyVar'];

// for the check of streamers just need Client-ID: <ID HERE> in the array for curling

$headers = array(
);

array_push($headers, $accept);
array_push($headers,$key);
array_push($headers, $client);

// possibly keep this webpage local to each unity game
// if not will need to check if the site stores the changes that users enter whenever
// a key is posted

$url = 'https://api.twitch.tv/kraken/user';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 3);

$result = curl_exec($ch);

echo $result;

curl_close($ch);

// confirm there is a match, if there is, it worked!

// return the profile image
if(preg_match('/(?<="logo":").[^"]*/', $result, $logoMatches))
{
	echo $matches[0];
}

// return the username
if (preg_match('/(?<=display_name":").[^"]*/', $result, $matches))
{
   echo "Success:TRUE|NAME:".$matches[0] . "|PHOTO:".$logoMatches[0];
}
else
{
	echo "Success:FALSE|";
}
?>