using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using DG.Tweening;

public class BattleManager : MonoBehaviour
{
    public Transform PlayerDamagePanel;
    public QuestManager questManager;
    public PlayerUIManager playerUI;
    public EnemyUIManager enemyUI;
    public PlayerManager player;
    EnemyManager enemy;

    private void Start()
    {
        enemyUI.gameObject.SetActive(false);
        // StartCoroutine(SampleCol());
    }

    // IEnumerator SampleCol()
    // {
    //     Debug.Log("開始");
    //     yield return new WaitForSeconds(2f);
    //     Debug.Log("２秒経過");
    // }

    public void Setup(EnemyManager enemyManager)
    {
        SoundManager.instance.PlayBGM("Battle");
        enemyUI.gameObject.SetActive(true);
        enemy=enemyManager;
        enemyUI.SetupUI(enemy);
        playerUI.SetupUI(player);

        enemy.AddEventLIstenerOnTap(PlayerAttack);

        
    }

    void PlayerAttack()
    {
        StopAllCoroutines();
        SoundManager.instance.PlaySE(1);
        // playerがenemyに攻撃
        int damage=player.Attack(enemy);
        enemyUI.UpdateUI(enemy);
        DialogTextManager.instance.SetScenarios(new string[]{
            "Playerの攻撃\nモンスターに"+damage+"ダメージを与えた。"});
        if(enemy.hp<=0)
        {
            
            StartCoroutine(EndBattle());
        }
        else
        {
           StartCoroutine(EnemyTurn()) ;
        }
    }

    IEnumerator EnemyTurn()
    {
        yield return new WaitForSeconds(2f);
        SoundManager.instance.PlaySE(1);
        PlayerDamagePanel.DOShakePosition(0.3f,0.5f,20,0,false,true);
         // EnemyがPlayerに攻撃
        int damage = enemy.Attack(player);
        playerUI.UpdateUI(player);
        DialogTextManager.instance.SetScenarios(new string[]{"モンスターの攻撃\nプレイヤーは"+damage+"ダメージを受けた"});
    }

    IEnumerator EndBattle()
    {
        yield return new WaitForSeconds(1f);
        DialogTextManager.instance.SetScenarios(new string[]{"モンスターは去っていった"});
        
        enemyUI.gameObject.SetActive(false);
        Destroy(enemy.gameObject);
         SoundManager.instance.PlayBGM("Quest");
        questManager.EndBattle();
        
    }
    
   
}
