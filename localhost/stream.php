<?php
session_start();

// if there is no stream selected then redirect to homepage
if(!(isset($_SESSION['streamRedir'])))
{
	echo '<meta http-equiv="refresh" content="0; URL=lobby.php">';
	exit;
}
else
{
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="stream.css">
		<link rel="stylesheet" href="emote.css">
		<link rel="stylesheet" href="streamUI.css">
		<link rel="stylesheet" href="gameLobby.css">
		<script src="jquery.min.js" type="text/javascript"></script>
		<title><?php echo $_SESSION['streamRedir']."'s stream"?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	</head>
	
	<span class = "portrait">
		<div class = "gameLobby">
		<?php
			include 'gameLobby.php';
		?>
		</div>
	
		<div class = "streamUI">
		<?php
			include 'streamUI.php';
		?>
		</div>
	
		<div class = "chat">
		<?php
			include 'chat.php';
		?>
		</div>
	
		<div class = "emoteTab" style="visibility: hidden;">
		<?php
			include 'emote.php';
		?>
		</div>
	
		<div class = "shopTab" style="visibility: hidden;">
		<?php
			include 'shop.php';
		?>
		</div>
	</span>
	<script>
	
	var testList = ["Evading taxes", "Sample text", "I'm too tired to be creative"];
	
	
		var portraitDiv = document.getElementsByClassName('portrait');
		var messageDiv = document.getElementsByClassName('chat');
		var emoteDiv = document.getElementsByClassName('emoteTab');
		var shopDiv = document.getElementsByClassName('shopTab');
		var streamUI = document.getElementsByClassName('streamUI');
		var gameLobby = document.getElementsByClassName('gameLobby');
		
		var chatBonusMoney = 5;
		
		var currentlySelected = messageDiv[0];
		
		// check outterwidth and outterheight
		window.addEventListener("orientationchange", function() {
			// Announce the new orientation number
			if(screen.orientation.angle == 0)
			{
				// portrait
				portraitDiv[0].style.visibility = "visible";
				currentlySelected.style.visibility = "visible";
				streamUI[0].style.visibility = "visible";
				gameLobby[0].classList.remove('landscapeStream');
			}
			else
			{
				// landscape
				portraitDiv[0].style.visibility = "hidden";
				messageDiv[0].style.visibility = "hidden";
				emoteDiv[0].style.visibility = "hidden";
				shopDiv[0].style.visibility = "hidden";
				streamUI[0].style.visibility = "hidden";
				gameLobby[0].style.visibility = "visible";
				gameLobby[0].classList.add('landscapeStream');
			}
		}, false);
		
		// reset the chat timer to receive money after chat
		function resetChatTimer()
		{
			var chatTimerInterval = setInterval(function(){
				if(parseInt(localStorage.getItem('chatTimer')) > 0)
					window.localStorage['chatTimer'] = parseInt(localStorage.getItem('chatTimer')) - 1;
				else
					 clearInterval(chatTimerInterval);
			}, 1000);
		}
		
		// init the chat timer or set it and call the decrement function
		window.onload = function() 
		{
			loadButtonHTML();
			if(localStorage.getItem('chatTimer') === null)
			{
				window.localStorage['chatTimer'] = 0;
			}
			else
			{
				resetChatTimer();
			}
		}
		
		// add money to mysql table and to local variable
		function addMoney(amount)
		{
			var theMoney = document.getElementById('money');
			var intMoney = theMoney.textContent;
			var intMoney = parseInt(intMoney.replace(/\D+/g, ''), 10);
			
			intMoney += parseInt(amount);
			
			$.ajax({
				type: 'POST',
				url: 'updateMoney.php',
				data: 
				{
					updatedMoney:intMoney
				},
				success: function(data) {
					theMoney.textContent = "$ " + intMoney + "k";
					moneyAnimation(amount, true);
				}
			});
		}
		
		// check if chat bonus should be reset
		function checkChatBonus()
		{
			if(localStorage.getItem('chatTimer') == 0)
			{
				addMoney(5);
				writeNotificationToScreen("You gained $" + 5 + "k for " + testList[Math.floor((Math.random() * testList.length) + 0)] + " Keep it up!", 1);
				window.localStorage['chatTimer'] = 2;
				resetChatTimer();
			}
		}
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
				//$(location).attr('href', 'http://localhost/~TEEBQNE/accountDBPractice/lobby.php');
			
			}
			
			// send group message id and pull shop data
			$(document).ready(function(){
			
				setTimeout( function(){ 
					websocket_server.send(
						JSON.stringify({
							'type':'subscribe',
							'user_id': <?php echo "'{$_SESSION['username']}'"; ?>,
							'channel': <?php echo "'{$_SESSION['streamRedir']}'"; ?>
						})
					);
					onloadEmoteData();
					$.onloadShopData();
				}, 200);
			});
			
			websocket_server.onmessage = function(e)
			{
				var json = JSON.parse(e.data);
				switch(json.type) {
					case 'chat':
						var newMessage = "<span>"+json.msg+"</span><br>";
						
						// append the new message
						$("#container > #result-wrapper > #result > .chats").append(newMessage);
						 var out = document.getElementById('result');
						 
						 // scroll down if they are close enough to the bottom
						 if(out.scrollHeight - out.scrollTop < 400)
						 	out.scrollTop = out.scrollHeight;
						 	
						break;
					case 'shopData':
						// update shop data on load
						serverUpdateContribution(json.buttonID, json.current);
						break;
					case 'loadShopData':
						var buttonInfo = json.buttonData;
						
						// hard-coding 9 as that's the max buttons we have currently
						for(var x = 1; x < 10; x++)
						{
							if(buttonInfo[x] !== null)
							{
								// if the button has information, update it
								if(!(buttonInfo[x] === undefined) && buttonInfo[x].totalAmount != 0)
								{
									updateShopButtonData(x, buttonInfo[x].totalAmount, buttonInfo[x].currentAmount)
								}
							}
						}
						
						break;
					case 'roundEndMoneyBonus':
					
						// simulating round ended money bonus
						var cashAmount = json.amount;
						addMoney(cashAmount);
						break;
				}
			}
			
			// submit button hit on form
			$("#container > .theForm").submit(function(e)
			{
				var chat_msg = $("#container > .theForm > #form-container > .form-text > #comment").val();
					websocket_server.send(
						JSON.stringify({
							'type':'chat',
							'user_id': <?php echo "'{$_SESSION['username']}'"; ?>,
							'chat_msg':chat_msg
						})
					);
					$("#container > .theForm > #form-container > .form-text > #comment").val('');
					
					checkChatBonus();
					
					// scrolls down since you sent a message
					 var out = document.getElementById('result');
					 out.scrollTop = out.scrollHeight;
			});
			
			// enter key hit in form
			$("#container > .theForm > #form-container > .form-text > #comment").on('keyup',function(e){
				if(e.keyCode==13 && !e.shiftKey)
				{
					var chat_msg = $(this).val();
					websocket_server.send(
						JSON.stringify({
							'type':'chat',
							'user_id': <?php echo "'{$_SESSION['username']}'"; ?>,
							'chat_msg':chat_msg
						})
					);
					$(this).val('');
					
					checkChatBonus();
					
					// scrolls down since you sent a message
					 var out = document.getElementById('result');
					 out.scrollTop = out.scrollHeight;
				}
			});
			
			$.contributeToShopItem = function(totalCost, buttonID)
			{
				// send update to shop contribution
				websocket_server.send(
					JSON.stringify({
						'type':'contribution',
						'lobby': <?php echo "'{$_SESSION['streamRedir']}'"; ?> + "shop",
						'user_id': <?php echo "'{$_SESSION['username']}'"; ?>,
						'buttonID': buttonID,
						'totalCost': totalCost
					})
				);
			};
			
			$.buyEmoteEvent = function(emoteName)
			{
				// send emote the user bought to unity
				websocket_server.send(
					JSON.stringify({
						'type':'emote',
						'lobby': <?php echo "'{$_SESSION['streamRedir']}'"; ?>,
						'user_id': <?php echo "'{$_SESSION['username']}'"; ?>,
						'emoteName': emoteName
					})
				);
			};
			
			$.onloadShopData = function()
			{	
				console.log("Shop data loading");
				websocket_server.send(
					JSON.stringify({
						'type':'loadShopData',
						'lobby': <?php echo "'{$_SESSION['streamRedir']}'"; ?> + "shop"
					})
				);
			}
		});
	</script>
	
	<script>
		function toggleIcons(buttonPress)
		{
			var theHighlight = document.getElementById('highlight');
			var messageDiv = document.getElementsByClassName('chat');
			var emoteDiv = document.getElementsByClassName('emoteTab');
			var shopDiv = document.getElementsByClassName('shopTab');
			
			switch(buttonPress)
			{
				// message 
				case 0:
					// enable the chat here, hide everything else
					// move the highlight circle over message
					theHighlight.style.left = "20%";
					messageDiv[0].style.visibility = "visible";
					emoteDiv[0].style.visibility = "hidden";
					shopDiv[0].style.visibility = "hidden";
					currentlySelected = messageDiv[0];
					
					break;
				// back
				case 1:
					// go back to the lobby page
					window.location.replace("lobby.php");
					// unset streamer variable here 
					<?php unset($_SESSION['streamChat']); ?>
					break;
				// shop
				case 2:
					// enable the shop here, hide everything else
					// move the highlight circle over shop
					theHighlight.style.left = "35%";
					messageDiv[0].style.visibility = "hidden";
					emoteDiv[0].style.visibility = "hidden";
					shopDiv[0].style.visibility = "visible";
					currentlySelected = shopDiv[0];
					break;
				// emote
				case 3:
					// enable the emote here, hide everything else
					// move the highlight circle over emote
					theHighlight.style.left = "50%";
					messageDiv[0].style.visibility = "hidden";
					emoteDiv[0].style.visibility = "visible";
					shopDiv[0].style.visibility = "hidden";
					currentlySelected = emoteDiv[0];
					break;
				default:
					// error
			}
		}
	</script>
	</html>
	<?php
}
?>