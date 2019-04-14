<!-- Emote tab portion of the stream page -->

<!DOCTYPE html>
<html>
<body>
<div class ="wrapper">
<div class = "theText" id = "theText">
<div id = "headerText">Spectator Interaction Menu</div>
<!--<div id = "headerText2">Interact with the streamer without changing gameplay</div>-->
</div>

<!-- 
	 This can be generated with javascript but do to the buttons being loaded in from the server
	 decided against it so the user load time for this page is not even larger
-->

<ul id="myUL">
	<div class = "container">
	<li>
			<div id = "emoteImg">
			<div class = "timers" id = "timer1"></div>
			<div class = "priceTag" id = "price1"><p>$3k</p></div>
  			<div class = "userPicture"><input onclick="interactButton(this.id)"id ="emote1" type="image" src="WebsiteArt/BuyCheer.png" name="message" class="btTxt submit"/></div>
  			<div class="cooldown" id="cooldown1">&nbsp<span></span></div>
  			<div class = "timeout" id = "timeout1">5000</div>
  			</div>
  			<div id="emoteId1" class="emoteId"><p><span>Cheer</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			
  			<div class = "timers" id = "timer2"></div>
  			<div class = "priceTag" id = "price2"><p>$3k</p></div>
  			<div class = "userPicture"><input onclick="interactButton(this.id)"id ="emote2" type="image" src="WebsiteArt/BuyClap.png" name="message" class="btTxt submit"/></div>
  			<div class="cooldown" id="cooldown2">&nbsp<span></span></div>
  			<div class = "timeout" id = "timeout2">5000</div>
  			</div>
  			<div id="emoteId2" class="emoteId"><p><span>Clap</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			
  			<div class = "timers" id = "timer3"></div>
  			<div class = "priceTag" id = "price3"><p>$3k</p></div>
  			<div class = "userPicture"><input onclick="interactButton(this.id)"id ="emote3" type="image" src="WebsiteArt/basketball.png" name="message" class="btTxt submit"/></div>
  			<div class="cooldown" id="cooldown3">&nbsp<span></span></div>
  			<div class = "timeout" id = "timeout3">5000</div>
  			</div>
  			<div id="emoteId3" class="emoteId"><p><span>BasketBall</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			
  			<div class = "timers" id = "timer4"></div>
  			<div class = "priceTag" id = "price4"><p>$3k</p></div>
  			<div class = "userPicture"><input onclick="interactButton(this.id)"id ="emote4" type="image" src="WebsiteArt/ymca.png" name="message" class="btTxt submit"/></div>
  			<div class="cooldown" id="cooldown4">&nbsp<span></span></div>
  			<div class = "timeout" id = "timeout4">5000</div>
  			</div>
  			<div id="emoteId4" class="emoteId"><p><span>YMCA</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			
  			<div class = "timers" id = "timer5"></div>
  			<div class = "priceTag" id = "price5"><p>$3k</p></div>
  			<div class = "userPicture"><input onclick="interactButton(this.id)"id ="emote5" type="image" src="WebsiteArt/spin.png" name="message" class="btTxt submit"/></div>
  			<div class="cooldown" id="cooldown5">&nbsp<span></span></div>
  			<div class = "timeout" id = "timeout5">5000</div>
  			</div>
  			<div id="emoteId5" class="emoteId"><p><span>Spin</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			
  			<div class = "timers" id = "timer6"></div>
  			<div class = "priceTag" id = "price6"><p>$3k</p></div>
  			<div class = "userPicture"><input onclick="interactButton(this.id)"id ="emote6" type="image" src="WebsiteArt/throw.png" name="message" class="btTxt submit"/></div>
  			<div class="cooldown" id="cooldown6">&nbsp<span></span></div>
  			<div class = "timeout" id = "timeout6">5000</div>
  			</div>
  			<div id="emoteId6" class="emoteId"><p><span>ThrowHead</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			
  			<div class = "timers" id = "timer7"></div>
  			<div class = "priceTag" id = "price7"><p>$3k</p></div>
  			<div class = "userPicture"><input onclick="interactButton(this.id)"id ="emote7" type="image" src="WebsiteArt/BuyDab.png" name="message" class="btTxt submit"/></div>
  			<div class="cooldown" id="cooldown7">&nbsp<span></span></div>
  			<div class = "timeout" id = "timeout7">5000</div>
  			</div>
  			<div id="emoteId7" class="emoteId"><p><span>Dab</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			<div style="visibility:hidden" class = "blackCircle" id = "circle8">&nbsp<span></span></div>
  			<div class = "timers" id = "timer8"></div>
  			<div class = "priceTag" id = "price8"><p>$3k</p></div>
  			<div class = "userPicture"><input onclick="interactButton(this.id)"id ="emote8" type="image" src="WebsiteArt/backflip.png" name="message" class="btTxt submit"/></div>
  			<div class="cooldown" id="cooldown8">&nbsp<span></span></div>
  			<div class = "timeout" id = "timeout8">5000</div>
  			</div>
  			<div id="emoteId8" class="emoteId"><p><span>Backflip</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			
  			<div class = "timers" id = "timer9"></div>
  			<div class = "priceTag" id = "price9"><p>$3k</p></div>
  			<div class = "userPicture"><input onclick="interactButton(this.id)"id ="emote9" type="image" src="WebsiteArt/hide.png" name="message" class="btTxt submit"/></div>
  			<div class="cooldown" id="cooldown9">&nbsp<span></span></div>
  			<div class = "timeout" id = "timeout9">5000</div>
  			</div>
  			<div id="emoteId9" class="emoteId"><p><span>YouCantSeeMe</span></p></div>
	</li>
	</div>
</ul>

<div id = "recentEmotePurchase"></div>
<img id="buyableButton" src="WebsiteArt/BuyButton.png">
<button onclick="buyEmote()" id = "emoteInteractButton">Interact</button>
</div>


<script>
// actively selected element
var elementSelected = null;

var notificationHolder = document.getElementById('notificationHolder');

	function writeNotificationToScreen(notificationToWrite, type)
	{
		// create a div, throw the text in it, add the correct div
		// make it an animation (Possibly wait X seconds, then add fade animation)
		
		// make a new element to place the text in
		var newDiv = document.createElement("div");
		
		if(type == 0)
		{
			// 'error' happened (not enough money, no item selected, etc.)
			newDiv.className = "errorNotificationText";
		}
		else if(type == 1)
		{
			// bought item class
			newDiv.className = "notificationText";
		}
		else if(type == 2)
		{
			// add money class
			newDiv.className = "moneyNotificationText";
		}
		// create the text object
		var notificationText = document.createTextNode(notificationToWrite);
		
		// append it to the new div
		newDiv.appendChild(notificationText);
		
		// add the new div to the notification holder (anchor point)
		notificationHolder.appendChild(newDiv);
		
		// start fading out the notification in 2 seconds
		setTimeout(function() {newDiv.classList.add('fadeClass')}, 4000);
	}

	// subtract money based on purchase of emote
	function emoteUpdateMoney(currentMoney, moneyElem, price)
	{
		// subtract the current money by the price and post the new money to server
		currentMoney-=price;
		$.ajax({
			type: 'POST',
			url: 'updateMoney.php',
			data: 
			{
				updatedMoney:currentMoney
			},
			success: function(data) {
				// update the visual for the money
				moneyElem.text("$ " + currentMoney + "k");

				var emoteName = document.getElementById('emoteId' + elementSelected.id[5]).textContent;
                
                // write the notification of purchase to screen
                writeNotificationToScreen("You bought the emote: " + emoteName + ". Look for it in game!", 1);
                
                // send emote to server to be displayed in Unity
                $.buyEmoteEvent(emoteName);				
                
                // make each emote go on cooldown (They now share a cooldown)
				for(var x  = 1; x <= 9; x++)
				{
					buttonCooldown('emote' + x);
				}
				
				// animate the money being subtracted for the purchase 
				moneyAnimation(price, false);

				// remove the border around button selected
                elementSelected.classList.remove('thePicture');
                elementSelected = null;
			}
		});
	}

	// get money from mysql table - - makes cheating harder but took out
	// for extra performance 
	function emoteRetrieveMoney()
	{
		/*$.ajax({
			url: 'getMoney.php',
			dataType: 'text',
			success: function(data) {
				// pulls information, converts ints to ints, does arithmetic calculation
				// to test if they can buy emote
				var moneyElem = $('#money');
				var currentMoney = parseInt(data);
				moneyElem.text();

				var name = document.getElementById('emoteId' + elementSelected.id[5]).textContent;
				var price = document.getElementById('price' + elementSelected.id[5]).textContent;

				price = parseInt(price.replace(/\D+/g, ''), 10);

				// if you have enough money, buy it and update money
				if(price > currentMoney)
				{
					writeNotificationToScreen("You do not have enough to purchase " + name + ". It costs: $" + price + "k and you only have: $" + currentMoney + "k.", 0);
				}
				else
				{
					// update money on mysql table and in front end
					emoteUpdateMoney(currentMoney, moneyElem, price);
				}
			}
		});*/

		// still functions, simply uses the local money value instead of the server tracked one
		
		// get the current money
		var moneyElem = $('#money');
		
		// pull the text from it
		var currentMoney = moneyElem.text();
		
		// remove everything but the numerical values and convert the string to an int
		currentMoney = parseInt(currentMoney.replace(/\D+/g, ''), 10);

		// get the emote purchased and its cost
		var name = document.getElementById('emoteId' + elementSelected.id[5]).textContent;
		var price = document.getElementById('price' + elementSelected.id[5]).textContent;

		// remove everything but he numerical values and convert the string to int
		price = parseInt(price.replace(/\D+/g, ''), 10);

		// if you have enough money, buy it and update money
		if(price > currentMoney)
		{
			// write the notification to screen that you are broke
			writeNotificationToScreen("You do not have enough to purchase " + name + ". It costs: $" + price + "k and you only have: $" + currentMoney + "k.", 0);
		}
		else
		{
			// update money on mysql table and in front end
			emoteUpdateMoney(currentMoney, moneyElem, price);
		}
	}
	
	function interactButton(info)
	{
		// removes previous button selected if a button has been selected already
		if(elementSelected != null)
			elementSelected.classList.remove('thePicture');
		
		// updates currently selected button
		elementSelected = document.getElementById(info);
		elementSelected.classList.add('thePicture');
	}
	
	function buyEmote()
	{
		if(elementSelected != null)
		{
			// if you have an item selected, see if you can buy it
			emoteRetrieveMoney();
		}
		else
		{
			// if you do not have an item selected, tell the user what they are doing wrong
			writeNotificationToScreen("You need to select an item to buy before buying something!", 0);
		}
	}
	
	// add cool down animation class
	$.addClassToId = function(sec, id)
	{
		// add the animation to cooldown on page refresh
		var buttonSpan = $('#cooldown' + id + ' span');
		buttonSpan.addClass('emoteRefresh');
		
		// is modular, but the time is the same now so does not matter as much
		buttonSpan.css("-webkit-animation", "test " + sec + "s linear");
		setTimeout(function(){buttonSpan.css("-webkit-animation", "");}, sec * 1000);
	};
	
	// remove cooldown animation class when animation is over
	$.removeClassToId = function(sec, id)
	{
		// remove animation class when animation is done
		var buttonSpan = $('#cooldown' + id + ' span');
		buttonSpan.removeClass('emoteRefresh');
		buttonSpan.removeClass('emoteCD'+ id);
	};
	
	function setTimer(timerID)
	{ 
		// check if animation is happening on refresh or by onclick
		if (localStorage.getItem('timer' + timerID[5]) === null)
		{
			// animation happening from onclick, load data directly from the button
			var sec = (parseInt(document.getElementById('timeout' + timerID[5]).textContent))/1000;
		}
		else
		{
			// loading information from local storage, add animation event as well
			// prevents cheating by refreshing the page to get around cooldowns
			
			// loads the data from localStorage
			var sec = parseInt(localStorage.getItem('timer' + timerID[5]));
			
			// disables the button
			document.getElementById('emote' + timerID[5]).disabled = true;
			
			// sets a timeout until it will be re-enabled
			setTimeout(function() {document.getElementById('emote' + timerID[5]).disabled = false;}, sec * 1000);
			//setTimeout(function() {$('#emote' + timerID[5] + ' span').css("-webkit-animation", "");}, sec * 1000);
			// adds the animation class back to it with a newer updated time
			$.addClassToId(sec, timerID[5]);
		}
		
		// start the first call to timer
		theTimer();
		
		// then set interval of every second to call it until 0 seconds
		var test = setInterval(theTimer, 1000);
		
		function theTimer(){
			// updates the timer text
			document.getElementById('timer' + timerID[5]).textContent=sec + '..';
			
			// update timer 
			sec--;
			
			// sets local storage for timer
			window.localStorage['timer' + timerID[5]] = sec;
			
			// if the timer goes below 0, reset it and re-enable button(s)
			if (sec < 0) {
			
				// stop the interval
				clearInterval(test);
				
				// remove the locally stored info for this timer
				localStorage.removeItem('timer' + timerID[5]);
				
				// remove text component and enable button
				document.getElementById('timer' + timerID[5]).textContent = '';
				document.getElementById('emote' + timerID[5]).disabled = false;
				
				// remove animation class
				$.removeClassToId(sec, timerID[5]);
			}
		}
    }
    
    // function call on load to retrieve button data on refresh for 'cheating'
    function onloadEmoteData()
    {
    	// hard-coded for 9 as there will never be more than 9 buttons (easy to make modular) 
    	for(var x = 1; x < 10; x++)
    	{
    		// if the local storage of the timer is set, then it needs an animation
    		// and time data
    		if(!(localStorage.getItem('timer' + x) === null))
    		{
    			setTimer('emote' + x);
    		}
    	}
    }
	
	function buttonCooldown(theID)
	{
		// disable button just selected
		document.getElementById(theID).disabled = true;
		document.getElementById(theID);
		
		var timeout = document.getElementById('timeout' + theID[5]).textContent;
				
		// animation function (adds/removes animation class)
		$(function(){
			// adds the cooldown animation class
			var localID = theID;
			setTimer(localID);
			e1 = $('#cooldown' + localID[5] + ' span');
			e1.addClass('emoteCD'+ localID[5]);
		
			// wait until animation has ended, then remove the class to hide it again
			e1.one('webkitAnimationEnd oanimationend msAnimationEnd animationend',
			function (e) {
				// removes the animation after the animation successfully ends
				var localTest = $('#cooldown' + localID[5] + ' span');
				localTest.removeClass('emoteCD'+ localID[5]);
		   
			});

			setTimeout(function() { var localTest = $('#cooldown' + localID[5] + ' span'); localTest.removeClass('emoteCD'+ localID[5]);}, timeout);
		});
		
		// currently set to X seconds (it is in ms)
    	setTimeout(function() {document.getElementById(theID).disabled = false;}, timeout);
	}
	
	var moneyContainer = document.getElementById('moneyHolder');
	function moneyAnimation(amount, increase)
	{
		// handles which text money animation to add to div
		var newDiv = document.createElement("div");
		
		
		if(increase)
		{
			// increase money, make it float upward and green
  			newDiv.className = "increaseMoney";
			var incMoneyObj = document.createTextNode("+ $" + amount +"k");
  			newDiv.appendChild(incMoneyObj);
		}
		else
		{
			// decrease money, make it float downward and red
  			newDiv.className = "decreaseMoney";
			var decMoneyObj = document.createTextNode("- $" + amount +"k");
  			newDiv.appendChild(decMoneyObj);
		}
		moneyContainer.appendChild(newDiv);
	}
	
	// remove the element once the animation is finished
	$('#moneyHolder').on("animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function(){
  		$(this).children(":first").remove();
	});
	
	// remove the notification once the animation is finished
	$('#notificationHolder').on("animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function(){
  		$(this).children(":first").remove();
	});

</script>
</body>
</html>
