<?php

    // mysqlとのコネクションを確率
    $con = mysqli_connect('localhost','root','root','unityaccess');

    if(mysqli_connect_errno())
    {
        echo "1:Connection failed";
        exit();
    }

    $username = $_POST["name"];
    $password = $_POST["password"];

    // すでに登録がないか確認
    $namecheckquery = "SELECT username,salt,hash,score FROM players WHERE username='".$username."';";

    $namecheck = mysqli_query($con,$namecheckquery) or die("2:Name check query failed");
    if(mysqli_num_rows($namecheck)!=1)
    {
        echo "5:Either no user name, or more than one";
        exit();
    }

    $existinginfo = mysqli_fetch_assoc($namecheck);
    $salt = $existinginfo["salt"];
    $hash = $existinginfo["hash"];

    $logingash = crypt($password,$salt);
    if($hash !=$logingash)
    {
        echo "6:Incorrect password";
        exit();
    }

    echo "0\t" . $existinginfo["score"];

?>