<?php

// modelの読み込み
include_once dirname(__FILE__) . '/model/functions.php';


if($_POST){
    $userName = $_POST['user'];
    $userEmail = $_POST['email'];
    $userPassword = $_POST['password'];

    $error = '';  // エラーメッセージ用

    if($userName !== '' && $userEmail !== '' && $userPassword !== ''){
        // メールアドレスの確認
        $sql = "SELECT * FROM `user` WHERE `mail` = '{$userEmail}'";
        $userData = getData($dbname, $user, $password, $sql);

        if(count($userData) > 0){  // DBにデータが存在する時
            if($userData[0]['name'] === $userName && $userData[0]['password'] === $userPassword){
                // ユーザー名とパスワードが一致した場合にセッション情報を保存
                $_SESSION['user'] = $userData[0]['name'];
                $_SESSION['mail'] = $userData[0]['mail'];
                $_SESSION['password'] = $userData[0]['password'];
                
                // index.phpに遷移
                header('Location: ./index.php');
            }else{
                $error = 'ユーザ名、パスワードが違っています';
            }
        }else{  // 存在していない
            $error = 'ユーザが存在しません';
        }
    }else{
        $error = "入力値が不正です";
    }
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <style>
        input{
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <h1>ログイン</h1>
    
    <?php
        if(isset($error) && $error != ''){
            echo '<p style="color: red;">';
            echo $error;
            echo '</p>';
        }
    ?>
    
    <form action="" method="post">
        名前　　　　　<input type="text" name="user"><br>
        メールアドレス<input type="email" name="email"><br>
        パスワード　　<input type="text" name="password"><br>
        <button type="submit">ログイン</button>
    </form>

    <a href="index.php">トップに戻る</a>
</body>
</html>