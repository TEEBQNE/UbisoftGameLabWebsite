/*
This code was written by Tyler Chapman in 2019 for Ubisoft Game Lab Competition
Team Early O Clock Productions
 */

using System;
using System.Threading;
using WebSocketSharp;
using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using System.Text;
using Newtonsoft.Json;
using System.Text.RegularExpressions;

public class message
{
    public string type { get; set; }
    public string name { get; set; }
    public string theMessage { get; set; }
}

public class ChatManager : MonoBehaviour
{
    public WebSocket ws;

    bool setSub = false;

    // not necessarily needed (Just keeps the size of objects in scene down)
    public int maxMessages = 25;

    // users display name
    string username;

    // chat system
    public GameObject chatSystem;

    // bonus money data
    private float currentTime = 0.0f;
    private bool sendPayout = false;
    public float payoutTime = 20.0f;
    public int cashPayoutAmount = 100;

    // regex patterns
    string typePattern = @"(?<=""type"":"").[^""""]*";
    string userPattern = @"(?<=""msg"":"").[^:]*";
    string messagePattern = @"(?<=\\u00a0).+?(?=""})";
    string removeNewlines = @"(\\n)";
    string idPattern = @"(?<=""buttonID"":"").[^""""]*";
    string emoteUserPattern = @"(?<=""userBought"":"").[^""""]*";
    string emoteNamePattern = @"(?<=""emoteName"":"").[^""""]*";

    // colors of chat
    public Color playerMessage, info, item, emote;

    // place text is displayed and text object
    [SerializeField]
    public GameObject chatPanel, textObject;        // only public to remove stupid warning

    // list of messages
    [SerializeField]
    List<Message> messageList = new List<Message>();


    // read this in on start eventually 

    public string streamerName;

    // messages for update to read
    List<string> arrivedMessages = new List<string>();

    // shop items for update to read
    List<string> itemsPurchased = new List<string>();

    // emotes purchased 
    List<string> emotesPurchased = new List<string>();

    // not working
    // https://stackoverflow.com/questions/45671451/pass-variable-in-json-string-in-c-sharp

    // try getting using Newtonsoft.Json;
    // works for packing/unpacking json
    // example of use: https://stackoverflow.com/questions/32009293/signalr-websocketsharp-in-unity3d

    // example of json string set up to be used with string.Format
    // need the {{ to escape the {TERM}
    string json = @"
    {{
        ""type"": ""streamerSubscribe"",
        ""user_id"": ""{0}"",
        ""channel"": ""{0}""
    }}";

    string disconnectJson = @"
    {{
        ""type"": ""streamerDisconnect"",
        ""user_id"": ""{0}"",
        ""channel"": ""{0}""
    }}";

    string roundBonusJson = @"
    {{
        ""type"": ""roundEndMoneyBonus"",
        ""bonus"": ""{0}""
    }}";

    public void OnSuccessfulSend(bool success)
    {
        if (success)
        {
            Debug.Log("Message sent successfully");
        }
        else
        {
            Debug.Log("Message could not be sent");
        }
    }

    void Start()
    {
        var url = "ws://13.71.165.236:8080/";
        ws = new WebSocket(url);
        string theJson = string.Format(json, streamerName);

        // on open connection (establishes handshake with webapge)
        ws.OnOpen += (sender, e) =>
        {
            Debug.Log("Socket connected!");

            // sends the subscription as handshake (establishes which streamer room
            // it is)
            ws.SendAsync(Encoding.UTF8.GetBytes(theJson), OnSuccessfulSend);
        };

        // whenever a message is recieved (currently just does chat, will need to
        // figure out a way to get the type:'EXAMPLE' out for a switch statement
        // can use this function to handle messaging, emotes, events, etc.
        // just use regex, returend param is a string

        // regex to get the type: /(?<="type":").[^"]*/
        ws.OnMessage += (sender, e) =>
        {

            string toSend = e.Data;
            Match theType = Regex.Match(toSend, typePattern);
            string type = theType.Value;

            //Debug.Log(type);

            if (type == "chat")
            {
                arrivedMessages.Add(toSend);
            }
            else if (type == "unityShopData")
            {
                itemsPurchased.Add(toSend);
            }
            else if (type == "emotePurchased")
            {
                emotesPurchased.Add(toSend);
            }

            // can't have a function call here, simply add it to a list
            // then process the list in Update()
            Debug.Log("Message: " + toSend);
        };

        // for debugging (am bad at web sockets / json)
        ws.OnError += (sender, e) =>
            Debug.Log("Error: " + e.Message);

        // closes the connection 
        ws.OnClose += (sender, e) =>
        {
            string theDisonnect = string.Format(disconnectJson, streamerName);
            ws.SendAsync(Encoding.UTF8.GetBytes(theDisonnect), OnSuccessfulSend);
            Debug.Log("Socket connection closed " + e.Code + " " + e.Reason);
        };

        // connects
        ws.Connect();
    }

    void Update()
    {
        currentTime += Time.deltaTime;

        if(currentTime > payoutTime)
        {
            currentTime = 0.0f;
            string thePayout = string.Format(roundBonusJson, cashPayoutAmount);
            ws.SendAsync(Encoding.UTF8.GetBytes(thePayout), OnSuccessfulSend);
        }

        // handles messages to be displayed in game
        if (arrivedMessages.Count > 0)
        {
            // use regex to find first of ":" until first ' ' (space) to find name
            // then take everything until the last \n"}
            // then display the message name: message (with alt space)

            // regex for username: /(?<="msg":").[^:]*/
            // regex for messages: /(?<=\\u00a0).+?(?=\\n"})/

            Match theName = Regex.Match(arrivedMessages[0], userPattern);
            Match theMessage = Regex.Match(arrivedMessages[0], messagePattern);

            //  string messageText = Regex.Replace(theMessage.Value, removeNewlines, theMessage.Value);

            string messageTextValue;


            messageTextValue = theMessage.Value.Replace("\\n", "");

            string toSend = theName.Value + ":" + '\u00A0' + messageTextValue;

            // don't send unless both objects are found
            //if (theName.Success && theMessage.Success)
                SendMessageToChat(toSend, Message.MessageType.playerMessage);
            arrivedMessages.RemoveAt(0);
        }

        if (itemsPurchased.Count > 0)
        {
            // for now just print the data
            Match theID = Regex.Match(itemsPurchased[0], idPattern);

            string itemBought = "Player's bought item with ID: " + theID.Value;

            SendMessageToChat(itemBought, Message.MessageType.item);
            itemsPurchased.RemoveAt(0);
        }

        if (emotesPurchased.Count > 0)
        {
            Match theUsername = Regex.Match(emotesPurchased[0], emoteUserPattern);
            Match theEmote = Regex.Match(emotesPurchased[0], emoteNamePattern);

            string toSend = theUsername.Value + " bought emote: " + theEmote;

            SendMessageToChat(toSend, Message.MessageType.emote);
            emotesPurchased.RemoveAt(0);

        }
    }

    public void addToQueue(int id)
    {
        // add the id of the event to the queue here
    }

    // creates the chat object and adds it to the chatbox
    public void SendMessageToChat(string text, Message.MessageType messageType)
    {
        // checks if the message list is too large, if it is delete oldest message
        if (messageList.Count >= maxMessages)
        {
            Destroy(messageList[0].textObject.gameObject);
            messageList.Remove(messageList[0]);
        }

        // creates a new message obj
        Message newMessage = new Message();

        // sets the text of the obj to the text passed
        newMessage.text = text;

        // instantiates the new text on the panel
        GameObject newText = Instantiate(textObject, chatPanel.transform);

        // gets the text object of the new text
        newMessage.textObject = newText.GetComponent<Text>();

        // sets the text of the new object to the text passed in
        newMessage.textObject.text = newMessage.text;

        // sets the color of the new message
        newMessage.textObject.color = MessageTypeColor(messageType);

        // adds the new message to the list
        messageList.Add(newMessage);
    }

    // defines the color that the chat message will be
    Color MessageTypeColor(Message.MessageType messageType)
    {
        // defaulting it to info color
        Color color = item;

        // switch for the color decision
        switch (messageType)
        {
            case Message.MessageType.playerMessage:
                color = playerMessage;
                break;
            case Message.MessageType.item:
                color = item;
                break;
            case Message.MessageType.emote:
                color = emote;
                break;
        }

        return color;
    }
}

// message class
[System.Serializable]
public class Message
{
    public string text;
    public Text textObject;
    public MessageType messageType;

    public enum MessageType
    {
        playerMessage,
        info,
        item,
        emote
    }
}

/* OLD WEBSITE GET REQUEST CODE
 * Leaving it here in case it is needed
 * 
 * using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.Networking;
using System;

public class ChatManager : MonoBehaviour
{
    string[] webData;

    // not necessarily needed (Just keeps the size of objects in scene down)
    public int maxMessages = 25;

    // users display name
    string username;

    // string of php file
    string url = "http://localhost/~TEEBQNE/accountDBPractice/unityChatRequest.php";

    // chat system
    public GameObject chatSystem;

    // colors of chat
    public Color playerMessage, info;

    // place text is displayed and text object
    [SerializeField]
    public GameObject chatPanel, textObject;        // only public to remove stupid warning

    // list of messages
    [SerializeField]
    List<Message> messageList = new List<Message>();

    void Start()
    {
        StartCoroutine(test());
    }

    // delay to not overwhelm server (does make messages seem 'laggy' at times)
    public float emptyStringDelayTime = 0.5f;

    IEnumerator test(){

        // connects to the php page with relevant msql data
        UnityWebRequest messageData = UnityWebRequest.Get(url);

        // waits until all message data is returned
        yield return messageData.SendWebRequest();

        // if it fails connecting, print error
        if (messageData.isNetworkError)
        {
            Debug.Log("Error While Sending: " + messageData.error);
        }
        else
        {
            string messageDataString = messageData.downloadHandler.text;
            // if it is all white spaces, it waits 0.5 second to try again
             if(string.IsNullOrWhiteSpace(messageDataString))
            {
                // waits for some time before trying again
                yield return new WaitForSeconds(emptyStringDelayTime);

                // sends request again
                StartCoroutine(test());
            }
            else
            {
                // spits each username/message into an array
                webData = messageDataString.Split(';');

                // variables of each data being pulled from array
                string name = "";
                string message = "";
                string toSend = "";

                // not good if there is a large amount of messages to catch up on
                // this is extremely inefficent and dead halts the program
                for(int x = 0; x < webData.Length; x++)
                {
                    // for some reason blank responses are getting in, this prevents the processing
                    // of them
                    if(!string.IsNullOrWhiteSpace(webData[x]))
                    {
                        name = getData(webData[x],"name:");
                        message = getData(webData[x],"comment:");
                        toSend = name + ": " + message;
                        // sends data and recalls to pull new data
                        SendMessageToChat(toSend, Message.MessageType.playerMessage);                            
                    }
                }
                
                // clear the array
                Array.Clear(webData, 0, webData.Length);

                 // reset string
                messageDataString = "";

                // call function again
                StartCoroutine(test());
            }
        }
    }

    // pulls relevant data from the string for processing
    string getData(string dataToReturn, string index)
    {
        // start looking at string after the keyword
        string value = dataToReturn.Substring(dataToReturn.IndexOf(index)+index.Length);

        // cut off the end of the string up until the wildcard |
        if(value.Contains("|"))value = value.Remove(value.IndexOf("|"));
        return value;
    }
    */
