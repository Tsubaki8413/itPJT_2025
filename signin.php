<?php

// modelの読み込み
include_once dirname(__FILE__) . '/model/functions.php';


if($_POST){
    $userName = $_POST['user'];
    $userEmail = $_POST['email'];
    $userPassword = $_POST['password'];

    $error = '';  // エラーメッセージ

    if($userName !== '' && $userEmail !== '' && $userPassword !== ''){
        // メールアドレスの確認
        $sql = "SELECT * FROM `user` WHERE `mail` = '{$userEmail}'";
        $userData = getData($dbname, $user, $password, $sql);

        if(count($userData) < 1){
            // 新規登録
            $sql = "
                INSERT
                INTO `user`
                (`id`, `name`, `mail`, `password`)
                VALUES
                (null, '{$userName}', '{$userEmail}', '{$userPassword}')
            ";

            $result = setData($dbname, $user, $password, $sql);

            if($result){
                // 登録成功
                header('Location: ./login.php');
            }else{
                // 登録失敗
                $error = '登録に失敗しました。';
            }
        }else{
            // ログインに遷移
            header('Location: ./login.php');
        }
    }else{
        $error = '入力値が足りません';
    }
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録</title>
    <style>
        input{
            margin-left: 10px;
        }
    </style>
</head>
<body>
<body>
    <h1>新規登録</h1>

    <form action="" method="post">
        名前　　　　　<input type="text" name="user"><br>
        メールアドレス<input type="email" name="email"><br>
        パスワード　　<input type="text" name="password"><br>
        <button type="submit">ログイン</button>
    </form>

    <a href="index.php">トップに戻る</a>
</body>
</html>