<?php

    // mysqlとのコネクションを確率
    $con = mysqli_connect('localhost','root','root','unityaccess');
    // サーバーのホスト名、ユーザー名、接続するデータベースのユーザー名、を指定している

    if(mysqli_connect_errno())
    {
        echo "1:Connection failed";
        exit();
    }

    $username = $_POST["name"];
    $password = $_POST["password"];
    
    // すでに登録がないか確認
    $namecheckquery = "SELECT username FROM players WHERE username='".$username."';";

    $namecheck = mysqli_query($con,$namecheckquery) or die("2:Name check query failed");

    if(mysqli_num_rows($namecheck)>0)
    {
        echo "3:Name already exists";
        exit();
    }

    // 以下で登録実行（ハッシュ化している）
    $salt="\$5\$rounds=5000\$" . "steamedhams" . $username . "\$";
    $hash=crypt($password,$salt);
    $insertuserquery="INSERT INTO players (username,hash,salt) VALUES ('".$username."','".$hash."','".$salt."');";
    mysqli_query($con,$insertuserquery)or die("4;Insert player query failed");

    echo("0");


?>