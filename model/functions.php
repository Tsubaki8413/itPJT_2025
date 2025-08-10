<?php

// 接続情報
$dbname = 'mysql:dbname=it_card_db;host=localhost;charset=utf8;';
$user = 'root';
$password = '';

session_start();
// var_dump('セッションIDは:', $_COOKIE['PHPSESSID']);

// ログインチェック用の関数を作成
function loginCheck(){
    if(isset($_SESSION["user"])){
        // セッション情報を取得
    }else{
        // index.phpに遷移
        header('Location: ./index.php');
        exit();
    }
}

// DBからSQLのデータを取得する
function getData($dbname, $user, $password, $sql){
    $error = [];
    // 接続
    try{
        $dbh = new PDO($dbname, $user, $password);
        if ($dbh == null){
            $error += '接続に失敗しました。';
        }
    }catch(PDOException $e){
        print('Error:'.$e->getMessage());
        die();
    }

    // クエリ
    $query = $sql;
    // クエリの実行
    $stmt = $dbh->query($query);
    
    // データの準備
    $data = [];
    // データを1行づつ$data配列に代入
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    
    // DBの切断
    $dbh;
    return $data;
}

// 新規登録
function setData($dbname, $user, $password, $sql){
    // 接続
    try{
        $dbh = new PDO($dbname, $user, $password);
        if ($dbh == null){
            print('接続に失敗しました。<br>');
        }

        // クエリ
        $query = $sql;
        // クエリの実行
        $stmt = $dbh->prepare($query);
        // 動作確認
        $flag = $stmt->execute();   
    }catch(PDOException $e){
        print('Error:'.$e->getMessage());
        die();
    }
    
    // DBの切断
    $dbh = null;
    return $flag;
}