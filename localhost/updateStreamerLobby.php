<?php
include_once("database.php");
$clientID="Client-ID: pmf4wuh7oxjagb6aezhtzigjozzeuy";

// array to curl
$headers = array(
);

// push clientID to curl it
array_push($headers, $clientID);
$lobbyQuery = "SELECT * FROM lobbies";

$lobbyResult = mysqli_query($connect, $lobbyQuery);

// loop through all lobbies
while($row = mysqli_fetch_array($lobbyResult))
{
	$twitchName = $row['streamerName'];
	// get info on USER that was posted
	$url = "https://api.twitch.tv/helix/streams?user_login=".$twitchName;

	// curl data
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 3);

	// retrieve data
	$result = curl_exec($ch);

	// if they were streaming but aren't now
	if($row['streamActive'] == 1 && !preg_match('/(?<="id":").[:"]*/', $result, $test))
	{
		$activeStreaming = 0;
		// do nothing, they are not streaming
		if($stmt = $connect->prepare("UPDATE lobbies SET streamActive=? WHERE streamerName='" . $twitchName . "'"))
		{
			$stmt->bind_param("i", $activeStreaming);
			$stmt->execute();
			$stmt->close();
		}
	}
}
// end connection
$connect->close();
?>