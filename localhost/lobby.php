<?php
include_once("database.php");
session_start();

if(!isset($_SESSION['username']))
{
	header('Location: index.php');
	exit;
}
?>
<!DOCTYPE HTML>
<html lang="en">

<!-- Needed so that javascript can load sorted list-->
<div id="cover">FETCHING STREAMS...</div>
<head>
	<title>Descent of Champions</title>
	 <link rel="stylesheet" href="lobby.css">
	 <script src="jquery.min.js"></script>
	 <!-- disables zoom -->
	 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	 <script>
	 
	 // sorts the list elements by numerical view value
	 function sortList() {
	 
	 	// get the list
	 	var ul = $("#myUL:first");
	 	
	 	// get the element of the list
	 	var list = document.getElementById("myUL");
	 	
	 	// grabs all non hidden elements to display
	 	var theElements = list.querySelectorAll('.container li:not([style*="display:none"]):not([style*="display: none"]) > #viewerCount');
	 	
	 	// grabs rest of elements to not lose the data when appending new array
	 	var otherElements = list.querySelectorAll('.container li[style*="display: none"] > #viewerCount');
	 	
	 	// throws the above lists into arrays to handle data
	 	var arr = $.makeArray(theElements);
	 	var other = $.makeArray(otherElements);
	 	if(arr.length > 1)
	 	{
			// sorting the visible array by numerical viewer value
			arr.sort(function(a, b) {
				var textA = +$(a).text();
				var textB = +$(b).text();
				if (textA > textB) return -1;
				if (textA < textB) return 1;

				return 0;
			});
		
			// empty the ul element 
			ul.empty();
		
			// create new array to hold info in 2D to transpose
			var newarr=[];
		
			// create 2D array with 2 columns
			while(arr.length)
				newarr.push(arr.splice(0,2));
			
			var newerArr=[];
		
			newArr = transpose(newarr, newarr.length);
		
			function transpose(arr,arrLen) {
			  for (var i = 0; i < arrLen; i++) {
				for (var j = 0; j <i; j++) {
				  //swap element[i,j] and element[j,i]
			  
					// checks to see if values are equal to not transpose them endlessly 
					if(parseInt((arr[i][j].textContent)) == parseInt((arr[j][i]).textContent))
					{
					}	
					else
					{
					  var temp = arr[i][j];
					  arr[i][j] = arr[j][i];
					  arr[j][i] = temp;
					}
				}
			  }
			}
			// hard-coding to two columns
			for(var x = 0; x < 2; x++)
			{
				for(var y = 0; y < (newarr.length)+1; y++)
				{
					if(!(newarr[x] === undefined))
					{
						newerArr.push(newarr[x][y]);
					}
				}
			}
		
			// append information to array (first show visible to order them correctly)
			$.each(newerArr, function() {
				if(!(this.parentNode === undefined))
					ul.append(this.parentNode.parentNode);
			});
		
			// append the rest to not lose the data
			$.each(other, function() {
				ul.append(this.parentNode.parentNode);
			});
		}
	}
	 
	// shows black and "fetching streams..." until sort javascript loads
	$(window).on('load', function() {
    	$("#cover").fadeOut(2000);
	});
	
	// refresh lobbies ever 10 seconds from database
	$(document).ready(function()
	{
		setInterval(function(){
			refreshLobbyStreams();
		}, 10000);
	});
	
	// helper function for the load in case it takes a while
	function newW()
	{
    	$(window).load();
	}
	setTimeout(newW, 500);
	 
	// use this function on load
	window.onload = sortList;
	  
	  </script>
	  <script type="text/javascript">
	 jQuery(function($){
			// Websocket
			var websocket_server = new WebSocket("ws://localhost:8080/");
			websocket_server.onopen = function(e) {
				websocket_server.send(
					JSON.stringify({
						'type':'socket',
						'user_id': <?php echo "'{$_SESSION['username']}'"; ?>,
						'streamer_name': <?php echo "'{$_SESSION['streamRedir']}'"; ?>
					})
				);
			};
			websocket_server.onerror = function(e) {
				// Errorhandling
			}
			
			// send group message id
			$(document).ready(function(){
				setTimeout( function(){ 
				callUpdateViewer();
				$.updateLobbyStreamers();
				setInterval(callUpdateViewer, 1000);
				}, 200);
				function callUpdateViewer()
				{
					websocket_server.send(
						JSON.stringify({
							'type':'updateViewerCount',
							'user_id': <?php echo "'{$_SESSION['username']}'"; ?>,
							'channel': <?php echo "'{$_SESSION['streamRedir']}'"; ?>
					})
				);
				}
			});
			
			// updates active lobby streamers
			$.updateLobbyStreamers = function()
			{
				websocket_server.send(
					JSON.stringify({
						'type':'updateStreamerLobbies',
					})
				);
			}
			
			websocket_server.onmessage = function(e)
			{
				var json = JSON.parse(e.data);
				switch(json.type) {
					case 'updateViewerCount':
						//console.log(json.msg);
						$.each(json.msg,function(index,value){  
							$('#' + index).text(value);
						});
						// eventually call sort (Swaps equal elements right now)
						sortList();
						break;
				}
			}
		});
	</script>
</head>

<body>
<h2 id = "page title">Descent of</br>Champions</h2>
<h2 id = "helloMessage">Hello <?php echo $_SESSION['username']; ?></h2>

<p style="visibility: hidden;" id = "headerBox"></p>

<input style="visibility: visible;" onclick="showButtons()"id ="emptyPicture" type="image" src="http://meng.uic.edu/wp-content/uploads/sites/92/2018/07/empty-profile.png" name="saveForm" class="btTxt submit"/>
<input style="visibility: hidden;" onclick="hideButtons()"id="deletePicture" type="image" src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/44/Wheel_cross.svg/1024px-Wheel_cross.svg.png" name="deleteForm" class="btTxt submit"/>

<input style="visibility: hidden;" onclick="deleteAccount(); location.href='reset.php';"id="deleteAccount" type="image" src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f5/Circle-icons-caution.svg/2000px-Circle-icons-caution.svg.png" name="deleteName" class="btTxt submit"/>
<input style="visibility: hidden;" onclick="changeName(); location.href='change.php';"id="changeName" type="image" src="https://cdn0.iconfinder.com/data/icons/round-ui-icons/512/settings_red.png" name="changeName" class="btTxt submit"/>
<div id = "lobbyPortraitBody">
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for a streamer.." title="Type in a name">
<ul id = "hiddenElement" style="display:none">
</ul>

<ul id="myUL">
<?php

$query = "SELECT * FROM lobbies WHERE streamActive = '1'";
$result = mysqli_query($connect,$query);

if($result->num_rows == 0)
{
	// there are no lobbies, show something here
	echo "There are currently no streamers online. Please check back later!";
}

while($row = $result->fetch_assoc()){
?>
	<div class = "container">
	<li>
  			<div class="username"><a href="http://localhost/~TEEBQNE/accountDBPractice/index.php/stream/<?php echo $row['streamerName']?>"><span><?php echo $row['streamerName']."<br>"?></span></a></div>
  			<div class = "userPicture"><a href="http://localhost/~TEEBQNE/accountDBPractice/index.php/stream/<?php echo $row['streamerName']?>"><img id ="userPhoto" src="<?php echo $row['streamerProfilePic']?>"></a></div>
  			<img class = "viewerCountPic" src="//i.imgur.com/0nzTHqC.png"/>
  			<div id="viewerCount" class="viewerCount"><p><span id = <?php echo $row['streamerName']?>>0</span></p></div>
	</li>
	</div>
	<?php
	}
	?>
</ul>
</div>
<script>
function showButtons()
{
	var node = document.getElementById('emptyPicture')
	var deletePic = document.getElementById('deletePicture')
	var headerBar = document.getElementById('headerBox')
	var pageTitle = document.getElementById('page title')
	var changeName = document.getElementById('changeName')
	var deleteAccount = document.getElementById('deleteAccount')
	
    node.style.visibility = "hidden";
    deletePic.style.visibility = "visible";
    headerBar.style.visibility = "visible";
    pageTitle.style.visibility = "hidden";
    changeName.style.visibility = "visible";
    deleteAccount.style.visibility = "visible";
}

function hideButtons()
{
	var node = document.getElementById('emptyPicture')
	var deletePic = document.getElementById('deletePicture')
	var headerBar = document.getElementById('headerBox')
	var pageTitle = document.getElementById('page title')
	var changeName = document.getElementById('changeName')
	var deleteAccount = document.getElementById('deleteAccount')
	
    node.style.visibility = "visible";
    deletePic.style.visibility = "hidden";
    headerBar.style.visibility = "hidden";
    pageTitle.style.visibility = "visible";
    changeName.style.visibility = "hidden";
    deleteAccount.style.visibility = "hidden";
}

function myFunction() {
    var input, filter, ul, li, a, i, txtValue;
    
    // get the input box
    input = document.getElementById("myInput");
    
    // filter the input
    filter = input.value.toUpperCase();
    
    // get the ul id element
    ul = document.getElementById("myUL");
    
    // get the list elements
    li = ul.getElementsByTagName("li");
    
    // loop through all the list elements
    for (i = 0; i < li.length; i++) {
    
    	// grab the link within the list element
        a = li[i].getElementsByTagName("a")[0];
        
        // get the text in the link
        txtValue = a.textContent || a.innerText;
        
        // check if it is a match, if it is, show it, if not, hide it
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = " none";
        }
    }
    
    // sort the new generated list
    sortList();
}

function deleteAccount() {
  $.ajax({
	   type: "POST",
	   url: 'reset.php',
	   data:{action:'call_this'},
  });
 }
 
// reloads the lobbies open to show newer streamers and hide streamers who went offline
function refreshLobbyStreams()
{
	$.ajax({
		type: "GET",
		url: "loadLobbies.php",
		success:function(data)
		{
			var currentCount = ($('#myUL').children().length);
			var test = $('#hiddenElement').html(data);
			if(parseInt(test.children().length) != parseInt(currentCount))
			{
				$('#myUL').html(data);
				$('#myUL').hide();
				sortList();
				$.when(sortList).done(function()
				{
					$('#myUL').show();
				})
			}
			test.empty();
		}
	});
}
 
 function changeName() {
 	$.ajax({
	   type: "POST",
	   url: 'change.php',
	   data:{changeActions:'new_call'},
  });
 }
</script>

<div id="lobbyLandscapeBody" class = "hideThisDiv">
	<p> This page should only be viewed in portrait mode. Please reorient your device! </p>
</div>

</body>
</html>