using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class reauthenticate : MonoBehaviour
{
    public GameObject authenticateButton;

    public GameObject authenticateForm;

    // Start is called before the first frame update
    void Start()
    {
        
    }

    // Update is called once per frame
    void Update()
    {
        
    }

    public void buttonPressed()
    {
        authenticateButton.SetActive(true);
        authenticateForm.SetActive(false);
        gameObject.SetActive(false);
    }
}
