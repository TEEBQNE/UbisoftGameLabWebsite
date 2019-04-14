/*
This code was written by Tyler Chapman in 2019 for Ubisoft Game Lab Competition
Team Early O Clock Productions
 */

using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.Networking;

public class checkAuthenticationKey : MonoBehaviour
{
    // input field for user input
    InputField theField;

    // ui component where user enters key
    public GameObject userKey;

    public GameObject GameManager;

    public GameObject backButton;

    public GameObject startButton;

    // variables to post to website
    private string accept =  "Accept: application/vnd.twitchtv.v5+json";
    private string clientID = "Client-ID: AUTHKEY";
    private string authKey = "Authorization: OAuth ";

    private string authURL = "http://descentofchampions.com/verifyTwitchKey.php";

    // text of the component
    Text keyText;

    // variables to pass to gamemanager
    string twitchName = "";
    string twitchProfileLink = "";

    // Start is called before the first frame update
    void Start()
    {
        theField = gameObject.GetComponent<InputField>();
        keyText = userKey.GetComponent<Text>();

        GameManager = GameObject.Find("GameManager");
    }

    // Update is called once per frame
    void Update()
    {
        if(theField.isFocused == false && theField.text != "" && Input.GetKey(KeyCode.Return))
        {
            // send key to webpage
            StartCoroutine(verifyKey(theField.text));

            // reset text field
            theField.text = "";
        }
    }


    void authenticationFailed(string theKey)
    {
        keyText.text = "Authentication Failed! " + theKey + " is not a valid Twitch key. Try again!";
        authKey = "Authorization: OAuth ";
    }

    IEnumerator verifyKey(string theKey)
    {
        // add the user input to the key variable
        authKey += theKey;

        string dataReturned;

        // builds a form for data to push
         List<IMultipartFormSection> formData = new List<IMultipartFormSection>();
         formData.Add(new MultipartFormDataSection("acceptVar", accept));
         formData.Add(new MultipartFormDataSection("clientVar", clientID));
         formData.Add(new MultipartFormDataSection("keyVar", authKey));

        // posts the information
         UnityWebRequest www = UnityWebRequest.Post(authURL, formData);

            // IS NEEDED - - Unity or WWW fucked up
            www.chunkedTransfer = false;

            // wait for information to post
            yield return www.SendWebRequest();

        // did it succeed posting or not?
        if (www.isNetworkError || www.isHttpError) {
            Debug.Log(www.error);
        } else {
            
            // parse information returned on page
            dataReturned = www.downloadHandler.text;

            // find out of it succeeded or not
            string success = getData(dataReturned, "Success:");

            // if it succeeded then send info to gamemanager. If not display error
            if(success == "TRUE")
            {
                // parse information out of string recieved
                twitchName = getData(dataReturned, "NAME:");
                twitchProfileLink = getData(dataReturned, "PHOTO:");

                // possibly get the script in start? 
                GameManager.GetComponent<GameManager>().username = twitchName;
                GameManager.GetComponent<GameManager>().profilePhoto = twitchProfileLink;
                GameManager.GetComponent<GameManager>().setWelcome();

                // set these objects to false (won't need them after this)
                backButton.SetActive(false);
                gameObject.SetActive(false);
                startButton.SetActive(true);
            }
            else
            {
                //Debug.Log(dataReturned);
                // failed - - display error message to screen
                authenticationFailed(theKey);   
            }
        }
        authKey = "Authorization: OAuth ";
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
}
