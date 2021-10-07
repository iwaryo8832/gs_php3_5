<?php

    // mysqlとのコネクションを確率
    $con = mysqli_connect('localhost','root','root','unityaccess');
    // サーバーのホスト名、ユーザー名、接続するデータベースのユーザー名、を指定している

    if(mysqli_connect_errno())
    {
        echo "1:Connection failed";
        exit();
    }

//1. POSTデータ取得
$username   = $_POST['username'];
$password  = $_POST['password'];
$id = $_POST['id'];




$salt="\$5\$rounds=5000\$" . "steamedhams" . $username . "\$";
    $hash=crypt($password,$salt);
    $insertuserquery="UPDATE players SET username='$username',hash='$hash',salt='$salt' WHERE id ='$id'";
    mysqli_query($con,$insertuserquery)or die("4;Insert player query failed");
    // $status = $stmt->execute(); //実行

?>



    <!DOCTYPE html>
    <html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
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
                        <h1></h1>
                    </div>
                </div>
            </nav>
        </header>
        <!-- Head[End] -->
    
        <!-- Main[Start] -->
        <div>
            <div class="container jumbotron">
                <a href="select.php">ゲーム登録者一覧に戻る</a>
                <?= $view ?>
            </div>
        </div>
        <!-- Main[End] -->
    
    </body>
    
    </html>