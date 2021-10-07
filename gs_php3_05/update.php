<?php
//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//   POSTデータ受信 → DB接続 → SQL実行 → 前ページへ戻る
//2. $id = POST["id"]を追加
//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更

require_once('funcs.php');

//1. POSTデータ取得
$name   = $_POST['name'];
$lid  = $_POST['lid'];
$lpw    = $_POST['lpw'];
$kanricheck = $_POST['kanri_flg'];
$lifecheck = $_POST['life_flg'];
$id = $_POST['id'];

// echo $name;
// echo $lid;
// echo $lpw;
// echo $kanricheck;
// echo $lifecheck;
// echo $id;

$pdo=db_conn();


//2. DB接続します
//*** function化する！  *****************
// try {
//     $db_name = 'gs_db3';    //データベース名
//     $db_id   = 'root';      //アカウント名
//     $db_pw   = 'root';      //パスワード：XAMPPはパスワード無しに修正してください。
//     $db_host = 'localhost'; //DBホスト
//     $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
// } catch (PDOException $e) {
//     exit('DB Connection Error:' . $e->getMessage());
// }

//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE 
 gs_user_table SET name=:name,
                        lid = :lid,
                        lpw = :lpw,
                        kanri_flg = :kanri_flg,
                        life_flg = :life_flg,
                        indate = sysdate()
                        WHERE
                        id = :id;");

// 数値の場合 PDO::PARAM_INT
// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$stmt->bindValue(':kanri_flg', $kanricheck, PDO::PARAM_INT);
$stmt->bindValue(':life_flg', $lifecheck, PDO::PARAM_INT);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
    
} else {
   redirect('index.php');
}
