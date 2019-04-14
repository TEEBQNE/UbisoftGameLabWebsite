<!DOCTYPE html>
<html>
<head>
<script>
function loadButtonHTML()
{
	console.log("HI");
	var numberOfButtons = 9;
	var buttonImages = ["http://screenprintz.net/image/cache/catalog/Corporate_Logos/Logos_Corporate_apparel/6810_ubisoft-prev-500x500.png"];
	var buttonHolder = document.getElementById("myUL");
	var buttonPrices = ["$100k", "$110k", "$125k", "$150k", "$200k", "$350k", "$500k", "$900k", "$1000k"];
	var buttonTimeouts = [2000, 4000, 5000, 10000, 12000, 15000, 20000, 30000, 60000];
	var buttonNames = ["Cheer", "Blink", "Clap with 1 Hand", "Projectile Vomit", "Clap but hold your hands together", "Punch someone", "Do a backflip but fail", "Do a backflip", "Start a wave"];
	
	
	for(var x = 0; x < numberOfButtons; x++)
	{
		console.log(x);
		var containerDiv = document.createElement("div");
		containerDiv.className = 'container';
		
		var buttonLI = document.createElement("LI");
		var emoteContainer = document.createElement("div");
		emoteContainer.className = 'emoteImg';
		var buttonTimer = document.createElement("div");
		buttonTimer.className = 'timers';
		buttonTimer.setAttribute("id", "timer" + x);
		var buttonPrice = document.createElement("div");
		buttonPrice.className = 'priceTag';
		buttonPrice.setAttribute("id", "price" + x);
		var priceTagP = document.createElement("p");
		timerP.innerHTML = buttonPrices[x];
		buttonPrice.appendChild(priceTagP);
		var buttonImage = document.create("div");
		buttonImage.className = 'userPicture';
		var imageInput = document.createElement("input");
		imageInput.setAttribute("onclick", "interactButton(this.id)");
		imageInput.setAttribute("id", "emote" + x);
		imageInput.setAttribute("type", "image");
		imageInput.setAttribute("src", buttonImages[0]);
		imageInput.className = 'btTxt submit';
		buttonImage.appendChild(imageInput);
		var buttonCooldown = document.createElement("div");
		buttonCooldown.className = 'cooldown';
		buttonCooldown.setAttribute("id", "cooldown" + x);
		buttonCooldown.innerHTML = "&nbsp";
		var cooldownSpan = document.createElement("span");
		buttonCooldown.appendChild(cooldownSpan);
		var buttonTimeout = document.createElement("div");
		buttonTimeout.className = 'timeout';
		buttonTimeout.setAttribute("id", "timeout" + x);
		buttonTimeout.innerHTML = buttonTimeouts[x];
		emoteContainer.appendChild(buttonTimer);
		emoteContainer.appendChild(buttonPrice);
		emoteContainer.appendChild(buttonImage);
		emoteContainer.appendChild(buttonCooldown);
		emoteContainer.appendChild(buttonTimeout);
		var emoteID = document.createElement("div");
		emoteID.className = 'emoteId';
		emoteID.setAttribute("id", "emoteId" + x);
		var emoteIDP = document.createElement("p");
		var emoteIDSpan = document.createElement("span");
		emoteIDSpan.innerHTML = buttonNames[x];
		emoteIDP.appendChild(emoteIDSpan);
		emoteID.appendChild(emoteIDP);
		buttonLI.appendChild(emoteContainer);
		buttonLI.appendChild(emoteID);
		containerDiv.appendChild(buttonLI);
		buttonHolder.appendChild(containerDiv);
	}
};
</script>
</head>
<body>
<div class ="wrapper">
<div id = "theText">
<div id = "headerText">Spectator Interaction Menu</div>
<div id = "headerText2">Interact with the streamer without changing gameplay</div>
</div>
<div id = "line"></div>
<ul id="myUL">
	<div class = "container">
	<li>
			<div id = "emoteImg">
			<div class = "timers" id = "timer1"></div>
			<div class = "priceTag" id = "price1"><p>$100k</p></div>
  			<div class = "userPicture"><input onclick="interactButton(this.id)"id ="emote1" type="image" src="http://screenprintz.net/image/cache/catalog/Corporate_Logos/Logos_Corporate_apparel/6810_ubisoft-prev-500x500.png" name="message" class="btTxt submit"/></div>
  			<div class="cooldown" id="cooldown1">&nbsp<span></span></div>
  			<div class = "timeout" id = "timeout1">2000</div>
  			</div>
  			<div id="emoteId1" class="emoteId"><p><span>Cheer</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			
  			<div class = "timers" id = "timer2"></div>
  			<div class = "priceTag" id = "price2"><p>$110k</p></div>
  			<div class = "userPicture"><input onclick="interactButton(this.id)"id ="emote2" type="image" src="http://screenprintz.net/image/cache/catalog/Corporate_Logos/Logos_Corporate_apparel/6810_ubisoft-prev-500x500.png" name="message" class="btTxt submit"/></div>
  			<div class="cooldown" id="cooldown2">&nbsp<span></span></div>
  			<div class = "timeout" id = "timeout2">4000</div>
  			</div>
  			<div id="emoteId2" class="emoteId"><p><span>Blink</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			
  			<div class = "timers" id = "timer3"></div>
  			<div class = "priceTag" id = "price3"><p>$125k</p></div>
  			<div class = "userPicture"><input onclick="interactButton(this.id)"id ="emote3" type="image" src="http://screenprintz.net/image/cache/catalog/Corporate_Logos/Logos_Corporate_apparel/6810_ubisoft-prev-500x500.png" name="message" class="btTxt submit"/></div>
  			<div class="cooldown" id="cooldown3">&nbsp<span></span></div>
  			<div class = "timeout" id = "timeout3">5000</div>
  			</div>
  			<div id="emoteId3" class="emoteId"><p><span>Clap with 1 hand</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			
  			<div class = "timers" id = "timer4"></div>
  			<div class = "priceTag" id = "price4"><p>$150k</p></div>
  			<div class = "userPicture"><input onclick="interactButton(this.id)"id ="emote4" type="image" src="http://screenprintz.net/image/cache/catalog/Corporate_Logos/Logos_Corporate_apparel/6810_ubisoft-prev-500x500.png" name="message" class="btTxt submit"/></div>
  			<div class="cooldown" id="cooldown4">&nbsp<span></span></div>
  			<div class = "timeout" id = "timeout4">10000</div>
  			</div>
  			<div id="emoteId4" class="emoteId"><p><span>Projectile vomit</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			
  			<div class = "timers" id = "timer5"></div>
  			<div class = "priceTag" id = "price5"><p>$200k</p></div>
  			<div class = "userPicture"><input onclick="interactButton(this.id)"id ="emote5" type="image" src="http://screenprintz.net/image/cache/catalog/Corporate_Logos/Logos_Corporate_apparel/6810_ubisoft-prev-500x500.png" name="message" class="btTxt submit"/></div>
  			<div class="cooldown" id="cooldown5">&nbsp<span></span></div>
  			<div class = "timeout" id = "timeout5">12000</div>
  			</div>
  			<div id="emoteId5" class="emoteId"><p><span>Clap but just hold your hands together</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			
  			<div class = "timers" id = "timer6"></div>
  			<div class = "priceTag" id = "price6"><p>$350k</p></div>
  			<div class = "userPicture"><input onclick="interactButton(this.id)"id ="emote6" type="image" src="http://screenprintz.net/image/cache/catalog/Corporate_Logos/Logos_Corporate_apparel/6810_ubisoft-prev-500x500.png" name="message" class="btTxt submit"/></div>
  			<div class="cooldown" id="cooldown6">&nbsp<span></span></div>
  			<div class = "timeout" id = "timeout6">15000</div>
  			</div>
  			<div id="emoteId6" class="emoteId"><p><span>Punch someone</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			
  			<div class = "timers" id = "timer7"></div>
  			<div class = "priceTag" id = "price7"><p>$500k</p></div>
  			<div class = "userPicture"><input onclick="interactButton(this.id)"id ="emote7" type="image" src="http://screenprintz.net/image/cache/catalog/Corporate_Logos/Logos_Corporate_apparel/6810_ubisoft-prev-500x500.png" name="message" class="btTxt submit"/></div>
  			<div class="cooldown" id="cooldown7">&nbsp<span></span></div>
  			<div class = "timeout" id = "timeout7">20000</div>
  			</div>
  			<div id="emoteId7" class="emoteId"><p><span>Do a backflip but fail</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			<div style="visibility:hidden" class = "blackCircle" id = "circle8">&nbsp<span></span></div>
  			<div class = "timers" id = "timer8"></div>
  			<div class = "priceTag" id = "price8"><p>$900k</p></div>
  			<div class = "userPicture"><input onclick="interactButton(this.id)"id ="emote8" type="image" src="http://screenprintz.net/image/cache/catalog/Corporate_Logos/Logos_Corporate_apparel/6810_ubisoft-prev-500x500.png" name="message" class="btTxt submit"/></div>
  			<div class="cooldown" id="cooldown8">&nbsp<span></span></div>
  			<div class = "timeout" id = "timeout8">30000</div>
  			</div>
  			<div id="emoteId8" class="emoteId"><p><span>Do a backflip</span></p></div>
	</li>
	</div>
	<div class = "container">
	<li>
  			<div id = "emoteImg">
  			
  			<div class = "timers" id = "timer9"></div>
  			<div class = "priceTag" id = "price9"><p>$1000k</p></div>
  			<div class = "userPicture"><input onclick="interactButton(this.id)"id ="emote9" type="image" src="http://screenprintz.net/image/cache/catalog/Corporate_Logos/Logos_Corporate_apparel/6810_ubisoft-prev-500x500.png" name="message" class="btTxt submit"/></div>
  			<div class="cooldown" id="cooldown9">&nbsp<span></span></div>
  			<div class = "timeout" id = "timeout9">60000</div>
  			</div>
  			<div id="emoteId9" class="emoteId"><p><span>Start a wave</span></p></div>
	</li>
	</div>
</ul>

<div id = "recentEmotePurchase"></div>

<button onclick="buyEmote()" id = "interactButton">Interact</button>
</div>


<script>

function loadButtonHTML()
{
	/*console.log("HI");
	var numberOfButtons = 9;
	var buttonImages = ["http://screenprintz.net/image/cache/catalog/Corporate_Logos/Logos_Corporate_apparel/6810_ubisoft-prev-500x500.png"];
	var buttonHolder = document.getElementById("myUL");
	var buttonPrices = ["$100k", "$110k", "$125k", "$150k", "$200k", "$350k", "$500k", "$900k", "$1000k"];
	var buttonTimeouts = [2000, 4000, 5000, 10000, 12000, 15000, 20000, 30000, 60000];
	var buttonNames = ["Cheer", "Blink", "Clap with 1 Hand", "Projectile Vomit", "Clap but hold your hands together", "Punch someone", "Do a backflip but fail", "Do a backflip", "Start a wave"];
	
	
	for(var x = 0; x < numberOfButtons; x++)
	{
		var containerDiv = document.createElement("div");
		containerDiv.className = 'container';
		
		var buttonLI = document.createElement("LI");
		var emoteContainer = document.createElement("div");
		emoteContainer.className = 'emoteImg';
		var buttonTimer = document.createElement("div");
		buttonTimer.className = 'timers';
		buttonTimer.setAttribute("id", "timer" + x);
		var buttonPrice = document.createElement("div");
		buttonPrice.className = 'priceTag';
		buttonPrice.setAttribute("id", "price" + x);
		var priceTagP = document.createElement("p");
		priceTagP.innerHTML = buttonPrices[x];
		buttonPrice.appendChild(priceTagP);
		var buttonImage = document.createElement("div");
		buttonImage.className = 'userPicture';
		var imageInput = document.createElement("input");
		imageInput.setAttribute("onclick", "interactButton(this.id)");
		imageInput.setAttribute("id", "emote" + x);
		imageInput.setAttribute("type", "image");
		imageInput.setAttribute("src", buttonImages[0]);
		imageInput.className = 'btTxt submit';
		buttonImage.appendChild(imageInput);
		var buttonCooldown = document.createElement("div");
		buttonCooldown.className = 'cooldown';
		buttonCooldown.setAttribute("id", "cooldown" + x);
		buttonCooldown.innerHTML = "&nbsp";
		var cooldownSpan = document.createElement("span");
		buttonCooldown.appendChild(cooldownSpan);
		var buttonTimeout = document.createElement("div");
		buttonTimeout.className = 'timeout';
		buttonTimeout.setAttribute("id", "timeout" + x);
		buttonTimeout.innerHTML = buttonTimeouts[x];
		emoteContainer.appendChild(buttonTimer);
		emoteContainer.appendChild(buttonPrice);
		emoteContainer.appendChild(buttonImage);
		emoteContainer.appendChild(buttonCooldown);
		emoteContainer.appendChild(buttonTimeout);
		var emoteID = document.createElement("div");
		emoteID.className = 'emoteId';
		emoteID.setAttribute("id", "emoteId" + x);
		var emoteIDP = document.createElement("p");
		var emoteIDSpan = document.createElement("span");
		emoteIDSpan.innerHTML = buttonNames[x];
		emoteIDP.appendChild(emoteIDSpan);
		emoteID.appendChild(emoteIDP);
		buttonLI.appendChild(emoteContainer);
		buttonLI.appendChild(emoteID);
		containerDiv.appendChild(buttonLI);
		buttonHolder.appendChild(containerDiv);
	}*/
}

// actively selected element
var elementSelected = null;

// emote purchase text
var emoteText = document.getElementById('notificationText');
var notificationHolder = document.getElementById('notificationHolder');

	function writeNotificationToScreen(notificationToWrite, type)
	{
		// create a div, throw the text in it, add the correct div
		// make it an animation (Possibly wait X seconds, then add fade animation)
		
		// make a new element to place the text in
		var newDiv = document.createElement("div");
		
		if(type == 0)
		{
			// add correct class to it
			newDiv.className = "notificationText";
		}
		else if(type == 1)
		{
			newDiv.className = "moneyNotificationText";
		}
		
		// create the text object
		var notificationText = document.createTextNode(notificationToWrite);
		
		// append it to the new div
		newDiv.appendChild(notificationText);
		
		// add the new div to the notification holder (anchor point)
		notificationHolder.appendChild(newDiv);
		
		// start fading out the notification in 2 seconds
		setTimeout(function() {newDiv.classList.add('fadeClass')}, 2000);
	}

	// subtract money based on purchase of emote
	function emoteUpdateMoney(currentMoney, moneyElem, price)
	{
		currentMoney-=price;
		$.ajax({
			type: 'POST',
			url: 'updateMoney.php',
			data: 
			{
				updatedMoney:currentMoney
			},
			success: function(data) {
				moneyElem.text("$ " + currentMoney + "k");
				buttonCooldown('"' + elementSelected.id + '"');
				moneyAnimation(price, false);
			}
		});
	}

	// get money from mysql table
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
					emoteText.textContent = "You do not have enough to purchase " + name + ". It costs: $" + price + "k and you only have: $" + currentMoney + "k.";
				}
				else
				{
					// update money on mysql table and in front end
					emoteUpdateMoney(currentMoney, moneyElem, price);
				}
			}
		});*/
		
			var moneyElem = $('#money');
			var currentMoney = parseInt(moneyElem.text());
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
	
	function interactButton(info)
	{
		// handle button selection
		if(elementSelected != null)
			elementSelected.classList.remove('thePicture');
		
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
			writeNotificationToScreen("You need to select an item to buy before buying something!", 0);
		}
	}
	
	$.addClassToId = function(sec, id)
	{
		// add the animation to cooldown on page refresh
		var buttonSpan = $('#cooldown' + id + ' span');
		buttonSpan.addClass('emoteRefresh');
		buttonSpan.css("-webkit-animation", "test " + sec + "s linear");
	};
	
	$.removeClassToId = function(sec, id)
	{
		// remove animation class when animation is done
		var buttonSpan = $('#cooldown' + id + ' span');
		buttonSpan.removeClass('emoteRefresh');
	};
	
	function setTimer(timerID)
	{ 
		// check if animation is happening on refresh or by onclick
		if (localStorage.getItem('timer' + timerID[5]) === null)
		{
			var sec = (parseInt(document.getElementById('timeout' + timerID[5]).textContent))/1000;
		}
		else
		{
			// loading information from local storage, add animation event as well
			var sec = parseInt(localStorage.getItem('timer' + timerID[5]));
			document.getElementById('emote' + timerID[5]).disabled = true;
			setTimeout(function() {document.getElementById('emote' + timerID[5]).disabled = false;}, sec * 1000);
			$.addClassToId(sec, timerID[5]);
		}
		
		// start the first call to timer
		theTimer();
		
		// then set interval of every second to call it until 0 seconds
		var test = setInterval(theTimer, 1000);
		
		function theTimer(){
			document.getElementById('timer' + timerID[5]).textContent=sec + '..';
			sec--;
			window.localStorage['timer' + timerID[5]] = sec;
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
    
    function onloadEmoteData()
    {
    	// hard-coded for 9 as there will never be more than 9 buttons
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
	
	function buttonCooldown()
	{
		var theID = elementSelected.id;
		elementSelected.classList.remove('thePicture');
		elementSelected = null;
		
		// disable button just selected
		document.getElementById(theID).disabled = true;
		document.getElementById(theID);
		
		var timeout = document.getElementById('timeout' + theID[5]).textContent;
		
		var emoteName = document.getElementById('emoteId' + theID[5]).textContent;
		
		// call this function in a loop of 9
		// call this function outside of that loop
		writeNotificationToScreen("You bought the emote: " + emoteName + ". Look for it in game!", 0);
		
		// send emote to server
		$.buyEmoteEvent(emoteName);
		
		// animation function (adds/removes animation class)
		$(function(){
			var localID = theID;
			setTimer(localID);
			e1 = $('#cooldown' + localID[5] + ' span');
			e1.addClass('emoteCD'+ localID[5]);
		
			// wait until animation has ended, then remove the class to hide it again
			e1.one('webkitAnimationEnd oanimationend msAnimationEnd animationend',
			function (e) {
				var localTest = $('#cooldown' + localID[5] + ' span');
				localTest.removeClass('emoteCD'+ localID[5]);
		   
			});
		});
		// timeout is the number of seconds the anim/disable will be
    	setTimeout(function() {document.getElementById(theID).disabled = false;}, timeout);
	}
	
	var moneyContainer = document.getElementById('moneyHolder');
	function moneyAnimation(amount, increase)
	{
		// handles which text money animation to add to div
		var newDiv = document.createElement("div");
		
		if(increase)
		{
  			newDiv.className = "increaseMoney";
			var incMoneyObj = document.createTextNode("+ $" + amount +"k");
  			newDiv.appendChild(incMoneyObj);
		}
		else
		{
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