using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.Networking;

public class GameManager : MonoBehaviour
{
    public string username;
    public string profilePhoto;

    public GameObject welcomeMessage;
    public GameObject photo;

    Image img;

    Text welcomeText;

    RawImage thePhoto;

    // Start is called before the first frame update
    void Start()
    {
        welcomeText = welcomeMessage.GetComponent<Text>();
        thePhoto = photo.GetComponent<RawImage>();
    }

    // Update is called once per frame
    void Update()
    {
        
    }

    public void setWelcome()
    {
        gameObject.GetComponent<ChatManager>().streamerName = username;
        gameObject.GetComponent<ChatManager>().enabled = true;
        // set the text
        welcomeText.text = "Welcome " + username + ". If you would like to start a stream lobby, click the 'start' button.";

        // retrieve the user's image profile
        StartCoroutine(getPhoto());

        // set it active in scene
        photo.SetActive(true);
    }

    IEnumerator getPhoto()
    {
        UnityWebRequest www = UnityWebRequestTexture.GetTexture (profilePhoto, false);
        www.SetRequestHeader ("Accept", "image/png");
        yield return www.Send ();
 
        while (!www.isDone) {
            Debug.LogError (".");
            yield return null;
        }
 
        if (www.isNetworkError) {
            Debug.Log (www.error);
        } else {

        // applying the texture to the UI object 
        Texture2D texture = DownloadHandlerTexture.GetContent(www);
        thePhoto.texture = texture;
        }
    }
}
