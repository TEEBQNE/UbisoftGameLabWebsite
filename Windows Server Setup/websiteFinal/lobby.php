<?php
include_once("database.php");
session_start();

// <!-- Lobby page for active streams -->

if(!isset($_SESSION['username']))
{
	echo '<meta http-equiv="refresh" content="0; URL=http://'.$localIP.$adminUsername.'/websiteFinal/index.php">';
	exit;
}

echo $_SESSION['error'];
unset($_SESSION['error']);
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<link rel="shortcut icon" type="image/png" href="WebsiteArt/favicon.png">
	<title>Stream Lobbies</title>
	 <link rel="stylesheet" href="lobbystyle.css">
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
		
			// transposes the list of lobbies as css sorts the by columns
			// designers want it to sort by viewer count by row
			/* EX:
					Viewer Counts (Wrong):  1000 200
								    		300 100
								    		
					Viewer Counts (Right): 1000 300
										    200 100
			*/
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
					  // not equal, transpose them
					  var temp = arr[i][j];
					  arr[i][j] = arr[j][i];
					  arr[j][i] = temp;
					}
				}
			  }
			}
			
			// hard-coding to two columns as specified by the designers 
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
		// display error message if one occured
		if(localStorage.getItem('doc_displayErrorMessage') !== 'undefined' && localStorage.getItem('doc_displayErrorMessage') !== null)
		{
			var popupHolder = document.getElementById("popupHolder");
			//alert(localStorage.getItem('doc_displayErrorMessage'));
			var popupDiv = document.createElement("div");
			popupDiv.className = "popupText";
			popupDiv.textContent = localStorage.getItem('doc_displayErrorMessage');
			popupHolder.append(popupDiv);
			setTimeout(function() {popupDiv.classList.add('fadeClass')}, 4000);
			localStorage.removeItem('doc_displayErrorMessage');
		}
		// allows the sorting, transposing, etc. to finish (no jerky motion after load)
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
	 var autoReconnect = 0;
	 var gettingViewerCount = 0;
	
	 // connect to the server through a web socket connection (Pull viewer counts)
	 jQuery(function startServer(){
	 
			// attempt to connect to server by IP through ws
			websocket_server = new WebSocket("ws://<?php echo $localIP?>:8080/");	
					
			websocket_server.onopen = function(e) {
			
				// if you are auto reconnected, reset checks
				if(window.autoReconnect)
				{
					window.clearInterval(window.autoReconnect)
					window.autoReconnect = 0;
				}
				
				// let the server know you are not in a lobby, just need user viewer data
				websocket_server.send(
					JSON.stringify({
						'type':'socket',
						'user_id': <?php echo "'{$_SESSION['username']}'"; ?>,
						'streamer_name': <?php echo "'{$_SESSION['streamRedir']}'"; ?>
					})
				);
				getViewerCount();
			};
			
			// auto reconnect to server if there is no connection or a connection is stopped 
			websocket_server.onclose = function(e)
			{
				// delete the current socket attempt
				websocket_server = null;
				
				// if the interval is not set, attempt to reconnect every 5 seconds
				if(!window.autoReconnect)
				{
					// attempt reconnect every 5 seconds
					window.autoReconnect = setInterval(function(){startServer()}, 5000);
				}
			};

			// error handling if needed 
			websocket_server.onerror = function(e) {
				// Errorhandling
			}
			
			// send group message id
			function getViewerCount(){
			
				// clear the interval if it exists
				if(window.gettingViewerCount != 0)
				{
					window.clearInterval(window.gettingViewerCount);
				}
				
				// call the update for view count
				window.gettingViewerCount = setTimeout( function(){ 
				callUpdateViewer();
				$.updateLobbyStreamers();
				setInterval(callUpdateViewer, 1000);
				}, 200);
				function callUpdateViewer()
				{
					// try catch to not throw endless errors with server down
					try
					{
						websocket_server.send(
							JSON.stringify({
								'type':'updateViewerCount',
								'user_id': <?php echo "'{$_SESSION['username']}'"; ?>,
								'channel': <?php echo "'{$_SESSION['streamRedir']}'"; ?>
							})
						);
					}
					catch(err)
					{
						console.log("Server down. Attempting to reconnect...");
					}
					
				}
			};
			
			// updates active lobby streamers
			$.updateLobbyStreamers = function()
			{
				websocket_server.send(
					JSON.stringify({
						'type':'updateStreamerLobbies',
					})
				);
			}
			
			// receive data from the server, display it on the lobbies
			websocket_server.onmessage = function(e)
			{
				var json = JSON.parse(e.data);
				switch(json.type) {
					case 'updateViewerCount':
						if(json.msg)
						{
							// loop through each element received
							$.each(json.msg,function(index,value){  
								$('#' + index).text(value);
							});
						}
						
						// when new viewer data is received, resort the elements in case
						// new element has more viewers to align correctly 
						sortList();
						break;
				}
			}
		});
	</script>
</head>

<body>
<div id="cover">FETCHING STREAMS...</div>
<h2 id = "page title">Descent of</br>Champions</h2>
<h2 id = "helloMessage">Hello <?php echo $_SESSION['username']; ?></h2>

<div id = "popupHolder"></div>

<p style="visibility: hidden;" id = "headerBox"></p>

<input style="visibility: visible;" onclick="showButtons()"id ="emptyPicture" type="image" src="WebsiteArt/SettingIcon.png" name="saveForm" class="btTxt submit"/>
<input style="visibility: hidden;" onclick="hideButtons()"id="deletePicture" type="image" src="WebsiteArt/BackIcon.png" name="deleteForm" class="btTxt submit"/>
<div id = "deleteAccountBlock">
<input style="visibility: hidden;" onclick="deleteAccount(); location.href='reset.php';"id="deleteAccount" type="image" src="WebsiteArt/DeleteAccount.png" name="deleteName" class="btTxt submit"/>
<p style="visibility: hidden;" class = "settingsText" id = "deleteAccountText">Delete Account</p>
</div>

<div id = "changeNameBlock">
<input style="visibility: hidden;" onclick="changeName(); location.href='change.php';"id="changeName" type="image" src="WebsiteArt/ChangeName.png" name="changeName" class="btTxt submit"/>
<p style="visibility: hidden;" class = "settingsText" id = "changeNameText">Change Name</p>
</div>

<div id = "goToTutorialBlock">
<input style="visibility: hidden;" onclick="location.href='lobbyTutorial.php';" id="goToTutorial" type="image" src="WebsiteArt/TutorialIcon.png" name="changeName" class="btTxt submit"/>
<p style="visibility: hidden;" class = "settingsText" id = "goToTutorialText">Tutorial</p>
</div>

<div id="lobbyPortraitBody">
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for a streamer.." title="Type in a name">

<ul id = "hiddenElement" style="display:none">
</ul>

<img id = "backgroundImage" src = "WebsiteArt/lobbyBackgroundMain.png">
<img id = "topHolder" src = "WebsiteArt/lobbyBackgroundTop.png">
<ul id="myUL">
<?php
// dynamically created the lobbies based on data from the table
// load lobbies in if they are set to 'active' (1) in the table
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
  			<div class="username"><a href="http://<?php echo $localIP?><?php echo $adminUsername?>/websiteFinal/index.php/stream/<?php echo $row['streamerName']?>"><span><?php echo $row['streamerName']."<br>"?></span></a></div>
  			<div class = "userPicture"><a href="http://<?php echo $localIP?><?php echo $adminUsername?>/websiteFinal/index.php/stream/<?php echo $row['streamerName']?>"><img onclick="showClick(this)" id ="userPhoto" src="<?php echo $row['streamerProfilePic']?>"></a></div>
  			<img class = "viewerCountPic" src="//i.imgur.com/0nzTHqC.png"/>
  			<div id="viewerCount" class="viewerCount"><p><span id = <?php echo $row['streamerName']?>>0</span></p></div>
	</li>
	</div>
	<?php
	}
	?>
</ul>
</div>
<div id = "lobbyLandscapeBody" class = "hideThisDiv">
        <p> This page should only be viewed in portrait mode. Please reorient your device! </p>
</div>
<script>

function showClick(elementClicked){
	
	$(function(){
		 $(elementClicked).css("-webkit-filter", "sepia(100%) hue-rotate(180deg) saturate(300%)");
	});

}

function showButtons()
{
	// toggle for the settings button
	var node = document.getElementById('emptyPicture')
	var deletePic = document.getElementById('deletePicture')
	var headerBar = document.getElementById('headerBox')
	var pageTitle = document.getElementById('page title')
	var changeName = document.getElementById('changeName')
	var deleteAccount = document.getElementById('deleteAccount')
	var tutorialButton = document.getElementById('goToTutorial')
	var deleteAccountP = document.getElementById('deleteAccountText')
	var changeNameP = document.getElementById('changeNameText')
	var tutorialP = document.getElementById('goToTutorialText')
	
    node.style.visibility = "hidden";
    deletePic.style.visibility = "visible";
    headerBar.style.visibility = "visible";
    pageTitle.style.visibility = "hidden";
    changeName.style.visibility = "visible";
    deleteAccount.style.visibility = "visible";
    tutorialButton.style.visibility = "visible";
    deleteAccountP.style.visibility = "visible";
    changeNameP.style.visibility = "visible";
    tutorialP.style.visibility = "visible";
}

function hideButtons()
{
	var node = document.getElementById('emptyPicture')
	var deletePic = document.getElementById('deletePicture')
	var headerBar = document.getElementById('headerBox')
	var pageTitle = document.getElementById('page title')
	var changeName = document.getElementById('changeName')
	var deleteAccount = document.getElementById('deleteAccount')
	var tutorialButton = document.getElementById('goToTutorial')
	var deleteAccountP = document.getElementById('deleteAccountText')
        var changeNameP = document.getElementById('changeNameText') 
        var tutorialP = document.getElementById('goToTutorialText') 
	
    node.style.visibility = "visible";
    deletePic.style.visibility = "hidden";
    headerBar.style.visibility = "hidden";
    pageTitle.style.visibility = "visible";
    changeName.style.visibility = "hidden";
    deleteAccount.style.visibility = "hidden";
    tutorialButton.style.visibility = "hidden";
    deleteAccountP.style.visibility = "hidden";
    changeNameP.style.visibility = "hidden";
    tutorialP.style.visibility = "hidden";
    
}

// used as a sorting function for the existing streams
// if there are a lot of streams, viewers can use this
// to narrow down what streamers they see (still sorts by
// viewer count as well)
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

var potraitBody = document.getElementById("lobbyPortraitBody");
var landscapeBody = document.getElementById("lobbyLandscapeBody");

var handleOrientationChange = (function() {
	// handle screen orientation change on all devices
	// designers want this page to only be viewed in portrait mode
	// this will hide / display a message and page elements depending
	// on device orientation

    var struct = function(){
        struct.parse();
    };
    struct.showPortraitView = function(){
	 potraitBody.classList.remove("hideThisDiv");
         landscapeBody.classList.add("hideThisDiv");
    };
    struct.showLandscapeView = function(){
	 potraitBody.classList.add("hideThisDiv");
         landscapeBody.classList.remove("hideThisDiv");	
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

// detects screen orientation change
window.addEventListener("orientationchange", handleOrientationChange, false);

// ajax to delete account
function deleteAccount() {
  localStorage.removeItem('doc_username');
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
 
 // loads page to allow user to change name
 function changeName() {
 	$.ajax({
	   type: "POST",
	   url: 'change.php',
	   data:{changeActions:'new_call'},
  });
 }

 // remove the element once the animation is finished
$('#popupHolder').on("animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function(){
   $(this).children(":first").remove();
});
</script>
</body>
</html>
