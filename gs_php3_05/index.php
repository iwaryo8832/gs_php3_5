<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
            </div>
        </nav>
    </header>

   

    <form method="POST" action="insert.php">
        <div class="jumbotron">
        <fieldset>
                <legend>ユーザー情報登録</legend>
                <label>名前：<input type="text" name="name"></label><br>
                <label>ログインID：<input type="text" name="lid"></label><br>
                <label>パスワード：<input type="text" name="lpw"></label><br>
                <!-- kanri_flg: int(1) ※0=一般社員, 1=管理者、life_flg: int(1) ※0=退職済み（もう会社に在籍してない人）, 1=現職-->
                <select class="kanri_flg" name="kanri_flg" id="kanri_flg">
                    <option value="0">一般社員</option>
                    <option value="1">管理者</option>
                </select><br>
                <select class="life_flg" name="life_flg" id="life_flg">
                    <option value="0">退職済み</option>
                    <option value="1">現職</option>
                </select><br>
                <!-- <label><textarea name="content" rows="4" cols="40"></textarea></label><br> -->
                <input type="submit" value="送信">

                <a class="navbar-brand" href="select.php">登録者データ一覧参照</a>
            </fieldset>
        </div>
    </form>
</body>

</html>
