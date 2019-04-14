/*
This code was written by Tyler Chapman in 2019 for Ubisoft Game Lab Competition
Team Early O Clock Productions
 */

using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.Networking;
using UnityEngine.UI;

public class StartStream : MonoBehaviour
{
    // relevant links
    private string twitchLinkURL = "https://www.twitch.tv/";
    private string postURL = "http://descentofchampions.com/createLobby.php";

    // gameObjects to hide
    public GameObject profilePicture;
    public GameObject textObject;
    public GameObject gameText;
    public GameObject failedAuthText;

    public GameObject chatSystem;

    // post information
    string twitchName = "";
    string twitchProfilePic = "";
    private string clientID = "Client-ID: AUTHKEY";

    GameObject theManager;

    // Start is called before the first frame update
    void Start()
    {
        theManager = GameObject.Find("GameManager");
        gameText.SetActive(true);
        failedAuthText.SetActive(false);
    }

    // Update is called once per frame
    void Update()
    {
        
    }

    public IEnumerator CreateStreamLobby()
    {
        // update links to information pulled from Twitch authentication
        twitchLinkURL += theManager.GetComponent<GameManager>().username;
        twitchName = theManager.GetComponent<GameManager>().username;
        twitchProfilePic = theManager.GetComponent<GameManager>().profilePhoto;

       string dataReturned;

        // builds a form for data to push
         List<IMultipartFormSection> formData = new List<IMultipartFormSection>();
         formData.Add(new MultipartFormDataSection("twitchURL", twitchLinkURL));
         formData.Add(new MultipartFormDataSection("twitchUser", twitchName));
         formData.Add(new MultipartFormDataSection("twitchPic", twitchProfilePic));
         formData.Add(new MultipartFormDataSection("clientID", clientID));

        // posts the information
         UnityWebRequest www = UnityWebRequest.Post(postURL, formData);

            // IS NEEDED - - Unity or WWW fucked up
            www.chunkedTransfer = false;

            // wait for information to post
            yield return www.SendWebRequest();

        // did it succeed posting or not?
        if (www.isNetworkError || www.isHttpError) {
            Debug.Log(www.error);
        } else {
            dataReturned = www.downloadHandler.text;


            //Debug.Log(dataReturned);
            if(dataReturned == "IS STREAMING")
            {
                // hide all buttons, show success message
                profilePicture.SetActive(false);
                textObject.SetActive(false);
                gameText.SetActive(true);
                gameText.GetComponent<Text>().text = "Congrats you're playing a game now or something";
                chatSystem.SetActive(true);
                gameObject.SetActive(false);
            }
            else
            {
                gameText.GetComponent<Text>().text = "Your stream is not active. You need to have a stream on to play!";
                // inform them why it failed? (Probably that their stream has not started)
            }
        }
    }

    public void CreateTheLobby()
    {
        StartCoroutine(CreateStreamLobby());
    }
}
