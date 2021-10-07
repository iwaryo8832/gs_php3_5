using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using DG.Tweening;


// クエスト全体を管理

public class QuestManager : MonoBehaviour
{

    
    public StageUIManager stageUI;
    public GameObject enemyPrefab;
    public BattleManager battleManager;
    public SceneTransitionManager sceneTransitionManager;
    public GameObject questBG;

    int[] encountTable ={-1,-1,0,-1,-1,0,-1};

    int currentStage =0; 
    private void Start()
    {
        stageUI.UpdateUI(currentStage);
        DialogTextManager.instance.SetScenarios(new string[]{"神殿に入った。"});
    }
   


    IEnumerator Seaching()
    {
        DialogTextManager.instance.SetScenarios(new string[]{"探索中....."});
         // 背景を大きくする
        questBG.transform.DOScale(new Vector3(1.5f,1.5f,1.5f),2f).OnComplete(()=>questBG.transform.localScale=new Vector3(1,1,1));
        // フェードアウト効果
        SpriteRenderer questBGSpriteRenderer=questBG.GetComponent<SpriteRenderer>();
        questBGSpriteRenderer.DOFade(0,2f)
          .OnComplete(()=>questBGSpriteRenderer.DOFade(1,0));

        yield return new WaitForSeconds(2f);

        currentStage++;
        stageUI.UpdateUI(currentStage);

        // 配列の長さmをクリックの数が超えたらクリア！！
        if(encountTable.Length<=currentStage)
        {
            Debug.Log("クエストクリア");
            QuestClaer();
        }
        else if (encountTable[currentStage]==0)
        {
            EncountEnemy();
        }
        else
        {
            stageUI.ShowButtons();
        }
    }


    // NextButtonが押されたら
    public void OnNextButton()
    {
         SoundManager.instance.PlaySE(0);
         stageUI.HideButtons();
         StartCoroutine(Seaching()) ;
       
    }

    public void OnToTownButton()
    {
        SoundManager.instance.PlaySE(0);
    }

    void EncountEnemy()
    {
        DialogTextManager.instance.SetScenarios(new string[]{"モンスターに遭遇した"});
        stageUI.HideButtons();
        GameObject enemyObj = Instantiate(enemyPrefab);
        EnemyManager enemy = enemyObj.GetComponent<EnemyManager>();
        battleManager.Setup(enemy);

    }

    public void EndBattle()
    {
        stageUI.ShowButtons();
    }

    void QuestClaer()
    {
        DialogTextManager.instance.SetScenarios(new string[]{"クエストをクリアした！！！\n街に戻りましょう。"});
        SoundManager.instance.StopBGM();
        SoundManager.instance.PlaySE(2);
        stageUI.ShowClearText();
        // sceneTransitionManager.LoadTo("Town");
    }
    

}
