using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.Networking;

public class authenticateTwitch : MonoBehaviour
{
    // Twitch key to authenticate users with
    private string authenticationKey = "AUTHKEY";

    // redirection page after Twitch authentication (change it eventually)
    public string redirectLink = "http://descentofchampions.com/twitchAuthentication.php";

    // Twitch API key link
    private string twitchLink = "https://id.twitch.tv/oauth2/authorize?response_type=token&client_id=";

    // part of Twitch redirect link
    private string redirectConnection = "&redirect_uri=";

    // scope of authentications for the key
    private string twitchAuthentications = "&scope=user_read+channel_read";

    private string url;

    public GameObject backButton;
    public GameObject authenticationForm;

    // Start is called before the first frame update
    void Start()
    {
        url = twitchLink+authenticationKey+redirectConnection+redirectLink+twitchAuthentications;
    }

    // Update is called once per frame
    void Update()
    {
        
    }

    // hides button and shows input field
    public void buttonClick()
    {
        Application.OpenURL(url);
        backButton.SetActive(true);
        authenticationForm.SetActive(true);
        gameObject.SetActive(false);
    }
}
