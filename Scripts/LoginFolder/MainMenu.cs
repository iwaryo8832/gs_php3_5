using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.SceneManagement;
using UnityEngine.UI;

public class MainMenu : MonoBehaviour
{

    public Text playerDisplay;

    private void Start()
    {
         if(DBManager.LoggedIn)
         {
            playerDisplay.text = "Player:"+DBManager.username;
         }

    }

   public void GoToRegister()
   {
       SceneManager.LoadScene(3);
   }

    public void GoToLogin()
   {
       SceneManager.LoadScene(4);
   }

    public void GoToGame()
   {
       SceneManager.LoadScene(5);
   }



}
