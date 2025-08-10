<?php

// modelの読み込み
include_once dirname(__FILE__) . '/model/functions.php';

// ログアウトの処理
$_SESSION = [];     // セッション情報を空にする
session_destroy();  // セッションを削除

// index.phpに遷移
header('Location: ./index.php');