<?php include 'database.php'?> 

<?php 
	session_start();	
?>
<!-- Stream Video portion of the stream page -->
<!DOCTYPE html>
<html>
<head>
</head>
<body>

<div class="holder">
<iframe
	allowFullScreen=“true”
	src="https://player.twitch.tv/?channel=<?php echo $_SESSION['streamRedir']?>" 
	scrolling="no">
</iframe>
</div>

<div id = "notificationHolder"></div>

<div id = "rotateHolder">
<div id = "rotatePhoneNotification">To view the stream in full screen, rotate your phone to landscape. Rotate it back to interact with the game.</div>
</div>

<script>
	// show the helpful text on load and then fade it
    window.addEventListener('load', function() {
           var rotateBlock = document.getElementById('rotatePhoneNotification');
           setTimeout(function() {rotateBlock.classList.add('fadeClass')}, 4000);
    });

   // remove the notification once the animation is finished
   $('#rotateHolder').on("animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function(){
  	$(this).children(":first").remove();
   });
</script>


</body>
</html>
