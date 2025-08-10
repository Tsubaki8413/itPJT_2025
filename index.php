<?php

// modelの読み込み
include_once dirname(__FILE__) . '/model/functions.php';

// データの取得
if(isset($_GET['name'])){
  $sql = "SELECT * FROM `cards` WHERE `character_name` LIKE '%{$_GET['name']}%'";
}else{
  $sql = 'SELECT * FROM `cards`';
}

$data = getData($dbname, $user, $password, $sql);

?>


<!DOCTYPE html>
<html lang="ja" xmlns:mso="urn:schemas-microsoft-com:office:office" xmlns:msdt="uuid:C2F41010-65B3-11d1-A29F-00AA00C14882">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>Deck Maker</title>
</head>
<body>
  <div class="header">
    <?php if(!isset($_SESSION["user"])){ ?><a href="signin.php">新規登録</a><?php } ?>
    <?php if(!isset($_SESSION["user"])){ ?><a href="login.php" class="margin">ログイン</a><?php } ?>
    <?php if(isset($_SESSION["user"])){ ?><a href="logout.php">ログアウト</a><?php } ?>
    <?php if(isset($_SESSION["user"])){ ?><p>ログイン中のユーザー：<?php echo $_SESSION["user"]; ?>（<?php echo $_SESSION["mail"]; ?>）</p><?php } ?>
    <?php if(isset($_SESSION["user"])){ ?><a href="" class="right">マイデッキ</a><?php } ?>
  </div>

  <div class="area">
    <div class="list">
      <?php include_once dirname(__FILE__) . '/list.php'; ?>
    </div>

    <div class="deck-list">
      <h2>デッキリスト</h2>

      <div id="addListArea" class="popup_list">
      </div>

      <button type="button">登録</button>
    </div>
  </div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="assets/script.js"></script>
</body>
</html>