<?php include 'database.php'?> 

<?php 
	session_start();	
?>

<!DOCTYPE html>
<html>
<body>

<script>
$(document).on('fullscreenchange mozfullscreenchange webkitfullscreenchange msfullscreenchange', function() {
    if (document.fullScreen || document.mozFullScreen || document.webkitIsFullScreen || document.msFullscreenElement)
    {
        //$(document).trigger('enterFullScreen');
       $('.holder').addClass("fullscreenvideo");
       $('body').addClass("outerVideo");

		screen.orientation.lock("landscape-primary");
       console.log("FULL SCREEN");
    }
    else
    {
        //$(document).trigger('leaveFullScreen');
        $('.holder').removeClass("fullscreenvideo");
        $('body').removeClass("outerVideo");
        console.log("NOT FULL SCREEN");
        screen.orientation.unlock();
    }
});
</script>


<div class="holder">
<iframe
	class = "frame"  
	allowfullscreen="true";
	src="https://player.twitch.tv/?channel=<?php echo $_SESSION['streamRedir']?>"; 
	scrolling="no">
</iframe>
	<!--<div class="bar"><h1>WORDS OVER VIDEO YE</h1></div>-->
</div>

<div id = "notificationHolder">
<!--<div id = "notificationText" class = "bar">Congratulations: Contribution reached for Golden Grunt! Watch for it in game.</div>-->
</div>
</body>
</html>