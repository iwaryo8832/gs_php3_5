using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class SoundManager : MonoBehaviour
{
    // シングルトン（一つのゲームに一つしか存在しないもの、音を管理するとか）
    // シーン間でのデータ共有とかとか、オブジェクト共有とかとか
    public static SoundManager instance;

    private void Awake()
    {
        if(instance==null)
        {
            instance=this;
            DontDestroyOnLoad(this.gameObject);
        }
        else
        {
            Destroy(this.gameObject);
        }
    }


    // BGMのスピーカー
    public AudioSource audioSourceBGM;
    // BGMの素材
    public AudioClip[] audioClipsBGM;
    // SEスピーカー
    public AudioSource audioSourceSE;
    //SE 素材
    public AudioClip[] audioClipsSE;

    public void StopBGM()
    {
        audioSourceBGM.Stop();
    }


    public void PlayBGM(string sceneName)
    {
        audioSourceBGM.Stop();
        switch(sceneName)
        {
            default:
            case "Title":
            audioSourceBGM.clip=audioClipsBGM[0];
            break;

            case "Town":
            audioSourceBGM.clip=audioClipsBGM[1];
            break;

            case "Quest":
            audioSourceBGM.clip=audioClipsBGM[2];
            break;

            case "Battle":
            audioSourceBGM.clip=audioClipsBGM[3];
            break;


        }
        audioSourceBGM.Play();
    }



    public void PlaySE(int index)
    {
        audioSourceSE.PlayOneShot(audioClipsSE[index]);
    }
    
}
