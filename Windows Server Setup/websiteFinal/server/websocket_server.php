<?php
set_time_limit(0);
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

// use relative paths so it can be used on any computer
require_once __DIR__.'/../vendor/autoload.php';
include __DIR__.'/../src/Emoji.php';

// button class to hold shop info
class ButtonInfo {
	public $currentAmount;
	public $totalAmount;
	
	public function __construct()
	{
		$currentAmount = 0;
		$totalAmount = 0;
	}
}

// entire server is a dignified chat client
class Chat implements MessageComponentInterface {

	// active clients (objects)
	protected $clients;
	
	// local user instance
	protected $users;
	
	// lobby stream they are 'subscriped' to
	protected $subscriptions;
	
	// viewer count per room
	protected $viewerCounts;
	
	// shop contribution buttons per lobby
	protected $shopContributions;
	
	// array of buttons
	protected $buttonArray;
	
	// list of active streamers
	protected $streamerList;

	// default constructor 
	public function __construct() {
		$this->clients = new \SplObjectStorage;
		$this->users = [];
		$subscriptions = [];
		$viewerCounts = [];
		$shopContributions = [];
		$buttonArray = [];
		$streamerList = [];
	}

	// on connection, bind the session to a client and store this client
	// in the user instance 
	public function onOpen(ConnectionInterface $conn) {
		$this->clients->attach($conn);
		$this->users[$conn->resourceId] = $conn;
	}

	// close connection, remove from client / user array
	// and if they are a streamer, remove from streamer list
	public function onClose(ConnectionInterface $conn) {
		
		// if they are not in a lobby and leave, remove their connnection
		// they left from the lobby page
		if(!(isset($this->subscriptions[$conn->resourceId])))
		{
			unset($this->users[$conn->resourceId]);
            $this->clients->detach($conn);
			return;
		}
			
		// checks if the user leaving is a streamer, if they are, close the lobby
		if($this->streamerList[$this->subscriptions[$conn->resourceId]."Streamer"]->resourceId == $conn->resourceId)
		{
			$type = "closing";
			$target = $this->subscriptions[$conn->resourceId];
			// kicks any clients connected to this closed lobby
			foreach($this->clients as $client)
                        {
                                if($conn!=$client && isset($this->subscriptions[$client->resourceId]) && $this->subscriptions[$client->resourceId] == $target)
                                {
                                      // send to anyone but the sender, if they are in the same lobby and if they are in a lobby
                                      $client->send(json_encode(array("type"=>$type)));
                                }
                        }

			// is needed, can not use include_once
			// needed each removal. Sometimes throws a Notice
			include(__DIR__.'/../database.php');

			// pulls streamer's name
			$twitchName = $this->subscriptions[$conn->resourceId];
			
			// deactivation number
			$number = 0;
			
			// updates the streamer in the mysql table to be deactive (0 active)
			$query = "UPDATE lobbies SET streamActive='".$number."' WHERE streamerName='" . $twitchName . "'";
			
			// querys the table
			mysqli_query($connect, $query);
			
			// unsets the streamer lobby and shop contribution for that lobby
			unset($this->streamerList[$this->subscriptions[$conn->resourceId]]);
			unset($this->shopContributions[$this->subscriptions[$conn->resourceId]]);
			
			// call an onclose for anyone connected to this lobby (Implement if have time)
			// is good feedback
			
			$connect->close();
		}
		else if(isset($this->subscriptions[$conn->resourceId]))
		{
			// if they were just a user, decrement the lobby count
			if($this->viewerCounts[$this->subscriptions[$conn->resourceId]] > 0)
				$this->viewerCounts[$this->subscriptions[$conn->resourceId]]--;
		}
		
		// unset the subsription to this particular streamer or lobby
		unset($this->subscriptions[$conn->resourceId]);
		
		// unset the user array
		unset($this->users[$conn->resourceId]);
		
		// detach the client binding
		$this->clients->detach($conn);
	}

	public function onMessage(ConnectionInterface $from,  $data) {
		// decode the data received and from who
		$from_id = $from->resourceId;
		$data = json_decode($data);
		$type = $data->type;
		
		// determine how to handle data
		switch ($type) {
			case 'subscribe':
				// makes sure subscription data is sent correctly
				if(isset($data->channel))
				{
					// sets the streamer lobby of this user
					$this->subscriptions[$from->resourceId] = $data->channel;
				
					// sends welcome message for this specific lobby
					$message = "<span style='color:red;'>Welcome to ".$data->channel."'s chat!</span><br>";
				
					// increment the lobby count of the specific channel by key
					if(!(isset($this->viewerCounts[$data->channel])))
					{
						$this->viewerCounts[$data->channel] = 0;
					}
					
					// increment user count for this lobby
					$this->viewerCounts[$data->channel]++;
				
					// send back greeting message
					$from->send(json_encode(array("type"=>'chat', "msg"=>$message)));
				}
				break;
			case 'chat':
			 if (isset($this->subscriptions[$from->resourceId])) {
			 		$user_id = $data->user_id;
					$chat_msg = filter_var($data->chat_msg, FILTER_SANITIZE_STRING);
					
					// do not print blank messages
					if(empty($chat_msg))
					{
						break;
					}
					
					// message to send back to user who sent message
					$response_from = "<span><b>".$user_id."</b>: ".$chat_msg."</span>";
					
					// message to send to everyone else
					$response_to = $user_id.": ".$chat_msg;
					
					// target lobby
					$target = $this->subscriptions[$from->resourceId];
					
					// send to sender
					$from->send(json_encode(array("type"=>$type,"msg"=>$response_from)));
			
					// loop through each client and if they are in the same lobby, send data
					foreach($this->clients as $client)
					{
						// is a streamer, send unique message to encode/decode emojis
						if(isset($this->subscriptions[$client->resourceId]) &&  $this->streamerList[$this->subscriptions[$client->resourceId]."Streamer"]->resourceId == $client->resourceId)
						{
							// encode message using the library file
							$emojiEncodedString = Emoji\detect_emoji($response_to);
							
							// send info
							$client->send(json_encode(array("type"=>$type,"msg"=>$emojiEncodedString)));
						}
						else if($from!=$client && isset($this->subscriptions[$client->resourceId]) && $this->subscriptions[$client->resourceId] == $target)
						{
							// send to anyone but the sender, if they are in the same lobby and if they are in a lobby
							$client->send(json_encode(array("type"=>$type,"msg"=>$response_to)));
						}
					}
				}
				break;
			case 'updateViewerCount':
				// send back requested viewer data
				$from->send(json_encode(array("type"=>$type, "msg"=>$this->viewerCounts)));
				break;
			case 'streamerSubscribe':
				$this->subscriptions[$from->resourceId] = $data->channel;
			
				// set the streamer's index
				$this->streamerList[$data->channel."Streamer"] = $from;
				
				// creates the data for the streamer's shop
				// it is done here as a lobby can't exist without a streamer making
				// the streamer the first 'viewer'
				$lobby = $data->channel."shop";
				
				// hard-coded to 9 as that is the way designers wanted it
				for($x = 0; $x < 9; $x++)
				{
					// inits each button 
					$this->buttonArray[$x] = new ButtonInfo();
					$this->buttonArray[$x]->currentAmount = 0;
					$this->buttonArray[$x]->totalAmount = 0;
				}
						
				// insert into the dictionary under key $data->channel of value $buttonArray
				$this->shopContributions[$lobby] = $this->buttonArray;
				
				break;
			case 'contribution':
				$buttonID = $data->buttonID;
				$lobby = $data->lobby;
				$totalCost = $data->totalCost;
				$target = $this->subscriptions[$from->resourceId];
				$newType = "shopData";
				
				// add the normal contribution amount (5 is hard-coded as decided by designers)
				$current = $this->shopContributions[$lobby][$buttonID]->currentAmount+= 5;
				
				// update the total
				$total = $this->shopContributions[$lobby][$buttonID]->totalAmount = $totalCost;
				
				// loop through each client and send them updated shop data if they are in the same
				// lobby
				foreach($this->clients as $client)
				{
					if($from!=$client && isset($this->subscriptions[$client->resourceId]) && $this->subscriptions[$client->resourceId] == $target)
					{
						$client->send(json_encode(array("type"=>$newType,"buttonID"=>$buttonID,"current"=>$current)));
					}
				}
				
				// when the contribution is equal to or exceeds the target amount, reset it and send Unity data
				if($this->shopContributions[$lobby][$buttonID]->currentAmount >= $this->shopContributions[$lobby][$buttonID]->totalAmount)
				{
					// reset the value on the server when it hits max
					$current = $this->shopContributions[$lobby][$buttonID]->currentAmount = 0;
					
					$unityShopType = "unityShopData";
					
					// just sending button id, could send name of it, or just reuse this and handle
					// item type in a switch statement in Unity. Less data sent this way
					$this->streamerList[$target."Streamer"]->send(json_encode(array("type"=>$unityShopType,"buttonID"=>$buttonID)));
				}
				break;
				
			case 'emote':
				// send emote data to Unity
				$emoteName = $data->emoteName;
				$lobbyName = $data->lobby;
				$username = $data->user_id;
				$emotePurchased = "emotePurchased";
				
				// send the name and the type emote specified to play it correctly 
				$this->streamerList[$lobbyName."Streamer"]->send(json_encode(array("type"=>$emotePurchased,"userBought"=>$username,"emoteName"=>$emoteName)));
				break;
			case 'loadShopData':
				$lobbyName = $data->lobby;
				
				// send shop data on load
				$buttonData = $this->shopContributions[$lobbyName];
				
				// send data to specified user
				$from->send(json_encode(array("type"=>$type, "buttonData"=>$buttonData)));
				break;
			case 'roundEndMoneyBonus':
				// send money to each user in the lobby as the round has ended
				
				// value is determined in Unity and sent every X seconds in stream.php
				$bonusAmount = $data->bonus;
				$target = $this->subscriptions[$from->resourceId];
				
				foreach($this->clients as $client)
				{
					if($from!=$client && array_key_exists($client->resourceId, $this->subscriptions) && $this->subscriptions[$client->resourceId] == $target)
					{
						$client->send(json_encode(array("type"=>$type,"amount"=>$bonusAmount)));
					}
				}
				
				break;
		}
	}

	// error handling if needed 
	public function onError(ConnectionInterface $conn, \Exception $e) {
		$conn->close();
	}
}
$server = IoServer::factory(
	new HttpServer(new WsServer(new Chat())),
	8080
);
$server->run();
?>
