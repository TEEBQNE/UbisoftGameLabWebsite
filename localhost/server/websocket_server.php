<?php
set_time_limit(0);

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
require_once '/Users/TEEBQNE/Sites/AccountDBPractice/vendor/autoload.php';

class ButtonInfo {
	public $currentAmount;
	public $totalAmount;
	
	public function __construct()
	{
		$currentAmount = 0;
		$totalAmount = 0;
	}
}

class Chat implements MessageComponentInterface {
	protected $clients = new \SplObjectStorage;
	protected $users = [];
	protected $subscriptions= [];
	protected $viewerCounts= [];
	protected $shopContributions= [];
	protected $buttonArray= [];
	protected $streamerList= [];

	public function __construct() {
		$this->clients = new \SplObjectStorage;
		$this->users = [];
		$subscriptions = [];
		$this->$viewerCounts = [];
		$this->$shopContributions = [];
		$this->$buttonArray = [];
		$this->$streamerList = [];
	}

	public function onOpen(ConnectionInterface $conn) {
		$this->clients->attach($conn);
		$this->users[$conn->resourceId] = $conn;
		//print($conn->resourceId);
	}

	public function onClose(ConnectionInterface $conn) {
		$this->clients->detach($conn);
		
		// checks if the user leaving is a streamer, if they are, close the lobby
		if($this->$streamerList[$this->subscriptions[$conn->resourceId]."Streamer"]->resourceId == $conn->resourceId)
		{
			// causes errors but does not break everything?
			include('/Users/TEEBQNE/Sites/AccountDBPractice/database.php');
			
			$twitchName = $this->subscriptions[$conn->resourceId];
			$number = 0;
			
			$query = "UPDATE lobbies SET streamActive='".$number."' WHERE streamerName='" . $twitchName . "'";
			mysqli_query($connect, $query);
			
			unset($this->$streamerList[$this->subscriptions[$conn->resourceId]]);
			unset($this->$shopContributions[$this->subscriptions[$conn->resourceId]]);
			
			$connect->close();
		}
		else if(isset($this->subscriptions[$conn->resourceId]))
		{
			// if they were just a user, decrement the lobby count
			$this->$viewerCounts[$this->subscriptions[$conn->resourceId]]--;
		}
		unset($this->subscriptions[$conn->resourceId]);
		unset($this->users[$conn->resourceId]);
	}

	public function onMessage(ConnectionInterface $from,  $data) {
		$from_id = $from->resourceId;
		$data = json_decode($data);
		$type = $data->type;
		switch ($type) {
			case 'subscribe':
				// set lobby
				$this->subscriptions[$from->resourceId] = $data->channel;
				
				// welcome message
				$message = "<span style='color:red;'>Welcome to ".$data->channel."'s chat!</span><br>";
				
				// increment the lobby count of the specific channel by key
				$this->$viewerCounts[$data->channel]++;
				
				$from->send(json_encode(array("type"=>'chat', "msg"=>$message)));
				break;
			case 'chat':
			 if (isset($this->subscriptions[$from->resourceId])) {
			 		$user_id = $data->user_id;
					$chat_msg = $data->chat_msg;
					
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
						if($from!=$client && $this->subscriptions[$client->resourceId] == $target)
						{
							$client->send(json_encode(array("type"=>$type,"msg"=>$response_to)));
						}
					}
				}
				break;
			case 'updateViewerCount':
				// send back requested viewer data
				$from->send(json_encode(array("type"=>$type, "msg"=>$this->$viewerCounts)));
				break;
			case 'streamerSubscribe':
				$this->subscriptions[$from->resourceId] = $data->channel;
			
				// set the streamer's index
				$this->$streamerList[$data->channel."Streamer"] = $from;
				
				// creates the data for the streamer's shop
				// it is done here as a lobby can't exist without a streamer making
				// the streamer the first 'viewer'
				$lobby = $data->channel."shop";
				for($x = 0; $x < 9; $x++)
				{
					$this->$buttonArray[$x] = new ButtonInfo();
					$this->$buttonArray[$x]->currentAmount = 0;
					$this->$buttonArray[$x]->totalAmount = 0;
				}
						
				// insert into the dictionary under key $data->channel of value $buttonArray
				$this->$shopContributions[$lobby] = $this->$buttonArray;
				
				break;
			case 'contribution':
				$buttonID = $data->buttonID;
				$lobby = $data->lobby;
				$totalCost = $data->totalCost;
				$target = $this->subscriptions[$from->resourceId];
				$newType = "shopData";
				
				// add the normal contribution amount
				$current = $this->$shopContributions[$lobby][$buttonID]->currentAmount+= 5;
				
				// update the total (Might not need this?)
				$total = $this->$shopContributions[$lobby][$buttonID]->totalAmount = $totalCost;
				
				// loop through each client and send them updated shop data if they are in the same
				// lobby
				foreach($this->clients as $client)
				{
					if($from!=$client && $this->subscriptions[$client->resourceId] == $target)
					{
						$client->send(json_encode(array("type"=>$newType,"buttonID"=>$buttonID,"current"=>$current)));
					}
				}
				
				// when the contribution is equal to or exceeds the target amount, reset it and send Unity data
				if($this->$shopContributions[$lobby][$buttonID]->currentAmount >= $this->$shopContributions[$lobby][$buttonID]->totalAmount)
				{
					// reset the value on the server when it hits max
					$current = $this->$shopContributions[$lobby][$buttonID]->currentAmount = 0;
					
					$unityShopType = "unityShopData";
					
					// just sending button id, could send name of it, or just reuse this and handle
					// item type in a switch statement in Unity. Less data sent this way
					$this->$streamerList[$target."Streamer"]->send(json_encode(array("type"=>$unityShopType,"buttonID"=>$buttonID)));
				}
				break;
				
			case 'emote':
				// send emote data to Unity
				$emoteName = $data->emoteName;
				$lobbyName = $data->lobby;
				$username = $data->user_id;
				$emotePurchased = "emotePurchased";
				$this->$streamerList[$lobbyName."Streamer"]->send(json_encode(array("type"=>$emotePurchased,"userBought"=>$username,"emoteName"=>$emoteName)));
				break;
			case 'loadShopData':
				$lobbyName = $data->lobby;
				// send shop data on load
				$buttonData = $this->$shopContributions[$lobbyName];
				
				$from->send(json_encode(array("type"=>$type, "buttonData"=>$buttonData)));
				break;
			case 'roundEndMoneyBonus':
				// send money to each user in the lobby as the round has ended
				
				$lobbyName = $data->lobby;
				$bonusAmount = $data->bonus;
				$target = $this->subscriptions[$from->resourceId];
				
				foreach($this->clients as $client)
				{
					if($from!=$client && $this->subscriptions[$client->resourceId] == $target)
					{
						$client->send(json_encode(array("type"=>$type,"amount"=>$bonusAmount)));
					}
				}
				
				break;
		}
	}

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