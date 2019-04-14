<?php
include_once("database.php");

// post info
$twitchLink=$_REQUEST['twitchURL'];
$twitchName=$_REQUEST['twitchUser'];
$twitchProfilePic=$_REQUEST['twitchPic'];
$clientID=$_REQUEST['clientID'];

// array to curl
$headers = array(
);

// push clientID to curl it
array_push($headers, $clientID);

// defaulting here to true as they are attempting to connect
$activeStreaming = 1;

// get info on USER that was posted
$url = "https://api.twitch.tv/helix/streams?user_login=".$twitchName;

// curl data
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 3);

// retrieve data
$result = curl_exec($ch);

// find out if they are streaming
if(preg_match('/(?<="id":").[:"]*/', $result, $test))
{
	echo "IS STREAMING";
	
	// sanatize input and see if it exists in the database
	if($stmt = $connect->prepare("SELECT streamerName FROM lobbies WHERE streamerName=?"))
	{
		$stmt->bind_param("s", $twitchName);
		$stmt->execute();
		$stmt->store_result();
		$numRows = mysqli_stmt_num_rows($stmt);
		$stmt->close();
	}

	// if it does not exist, create an entry, if it does, update it to streaming
	if($numRows < 1)
	{	
		// sanatize the input again
		if($stmt = $connect->prepare("INSERT INTO lobbies(streamerName, streamerProfilePic, lobbyCount, streamActive) VALUES(?, ?, ?, ?)"))
		{
			$twitchProfileCount = 0;
			$stmt->bind_param("sssi", $twitchName, $twitchProfilePic, $twitchProfileCount, $activeStreaming);
			$stmt->execute();
			$stmt->close();
		}
		
		// create webpage for user here
	}
	else
	{
		// if they are already in the table then their html file exists, no need to generate it
		// just switch their active streaming to 1
		if($stmt = $connect->prepare("UPDATE lobbies SET streamActive=? WHERE streamerName='" . $twitchName . "'"))
		{
			$stmt->bind_param("i", $activeStreaming);
			$stmt->execute();
			$stmt->close();
		}
	}
}
else
{
	// do nothing, they are not streaming
	echo "NOT STREAMING";
}

// end connection
$connect->close();
?>