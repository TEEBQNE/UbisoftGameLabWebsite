<?php
include "database.php";
session_start();

// <!-- Ajax load for the lobby page to refresh lobbies on page -->

// query to select all lobbies that are active
$query = "SELECT * FROM lobbies WHERE streamActive = '1'";
$result = mysqli_query($connect,$query);

// display there are no lobbies (not used as it is an ajax request)
// was printing earlier for debugging, might use it to print error message to user
if($result->num_rows == 0)
{
	// there are no lobbies, show something here
	echo "There are currently no streamers online. Please check back later!";
}

// if lobbies are active, dynamically created elements for the lobby elements based on
// table information
while($row = $result->fetch_assoc()){
?>
	<div class = "container">
	<li>
  			<div class="username"><a href="index.php/stream/<?php echo $row['streamerName']?>"><span><?php echo $row['streamerName']."<br>"?></span></a></div>
  			<div class = "userPicture"><a href="index.php/stream/<?php echo $row['streamerName']?>"><img id ="userPhoto" src="<?php echo $row['streamerProfilePic']?>"></a></div>
  			<img class = "viewerCountPic" src="//i.imgur.com/0nzTHqC.png"/>
  			<div id="viewerCount" class="viewerCount"><p><span id = <?php echo $row['streamerName']?>>0</span></p></div>
	</li>
	</div>
<?php
}
