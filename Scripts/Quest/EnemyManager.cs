using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using System;
using DG.Tweening;



// 敵を管理する（ステータス/クリックされた時のクリック検出）
public class EnemyManager : MonoBehaviour
{
    // 関数登録 クリックされたときに実行したい関数（外部から設定したい）
    Action tapAction;


    public new  string name;
    public int hp;
    public int at;
    public GameObject hitEffect;

    public int Attack(PlayerManager player)
    {
        int damage = player.Damage(at);
        return damage;
    }

    public int Damage(int damage)
    {
        Instantiate(hitEffect,this.transform,false);
        transform.DOShakePosition(0.3f,0.5f,20,0,false,true);
        hp-=damage;
        if(hp<=0)
        {
            hp=0;
        }

        return damage;
    }

    public void AddEventLIstenerOnTap(Action action)
    {
        tapAction+=action;
    }

    public void OnTap()
    {
        Debug.Log("クリックされたよ");
        tapAction();
    }
}
