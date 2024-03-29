using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using DG.Tweening;

public class FadeManager : MonoBehaviour
{
   public float fadeTime=1f;
   public static FadeManager instance;
   private void Awake()
   {
      if(instance==null)
      {
         instance=this;
         DontDestroyOnLoad(gameObject);
      }
      else
      {
          Destroy(gameObject);
      }
   }

   public CanvasGroup canvasGroup;
   public void FadeOut()
   {
      canvasGroup.blocksRaycasts=true;
      canvasGroup.DOFade(1,fadeTime).OnComplete(()=>canvasGroup.blocksRaycasts=false);
   }

   public void FadeIn()
   {
      canvasGroup.blocksRaycasts=true;
      canvasGroup.DOFade(0,fadeTime).OnComplete(()=>canvasGroup.blocksRaycasts=false);
   }

   public void FadeOutToIn(TweenCallback action)
   {
      canvasGroup.blocksRaycasts=true;
      canvasGroup.DOFade(1,fadeTime).OnComplete(()=>
      {action();
       FadeIn();
      });
   }
}
