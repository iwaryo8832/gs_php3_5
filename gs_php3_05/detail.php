<?php
require_once('funcs.php');
$pdo = db_conn();
$id = $_GET['id'];

//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_user_table WHERE id =' . $id . ';');
$status = $stmt->execute();

//３．データ表示
$view = '';
if ($status == false) {
    sql_error($status);
} else {
    $row = $stmt->fetch();
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ユーザー登録情報更新画面</title>
    <link rel="stylesheet" href="css/range.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body id="main">
    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">データ登録</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method="POST" action="update.php">
        <div class="jumbotron">
        <fieldset>
                <legend>ユーザー情報登録</legend>
                <label>名前：<input type="text" name="name" value="<?= h($row['name']) ?>"></label><br>
                <label>ログインID：<input type="text" name="lid" value="<?= h($row['lid']) ?>" ></label><br>
                <label>パスワード：<input type="text" name="lpw" value="<?= h($row['lpw']) ?>"></label><br>
                <!-- kanri_flg: int(1) ※0=一般社員, 1=管理者、life_flg: int(1) ※0=退職済み（もう会社に在籍してない人）, 1=現職-->
                <select class="kanri_flg" name="kanri_flg" id="kanri_flg" value="<?= h($row['kanri_flg']) ?>">
                    <option value="0">一般社員</option>
                    <option value="1">管理者</option>
                </select><br>
                <select class="life_flg" name="life_flg" id="life_flg" value="<?= h($row['life_flg']) ?>">
                    <option value="0">退職済み</option>
                    <option value="1">現職</option>
                </select><br>
                <!-- <label><textarea name="content" rows="4" cols="40"></textarea></label><br> -->
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->
</body>

</html>