<?php include 'database.php'?> 
<?php
session_start();
//<!-- Chat portion of the stream page -->

// doesn't allow user to be here without an assigned username, redirects to index page
if (isset($_SESSION['username']) == false)
{
	echo '<meta http-equiv="refresh" content="0; URL=http://'.$localIP.$adminUsername.'/websiteFinal/index.php">';
	exit;
}


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" href="chat.css">
<script type="text/javascript">
// dummy function to prevent page refresh / post on submission
function post()
{
  	return false;
}
</script>
</head>
<body>
<script>
function checkEmptyMessage()
{
	// checks to see if the value is empty, if it is, don't send it
	var x;
	
    x = document.getElementById("username").value;
    if (x == "") {
        return false;
    };
}
</script>
 	
<div id="container">

<div id="result-wrapper">
	<div id="result">
		<div class="chats"></div>
	</div>			
</div>

<form class = "theForm" onsubmit="return post();" id="my_form" name="my_form">

<div id="form-container">
	<div class="form-text">
    	<input type="text" style="display:none" id="username" value="<?= $_SESSION['username'] ?>">
    	<textarea type="text" maxlength="250"id="comment"></textarea>
    </div>
    <div class="form-btn">
    	<input type="submit" value="Send" id="btn" name="btn"/>
    </div>
</div>
</form>
</div> 	
 </body>
</html>
