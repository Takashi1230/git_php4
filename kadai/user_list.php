<?php
session_start();

//ファイル読みこみ
require_once('funcs.php');
//セッションID確認
loginCheck();

//DB接続
$pdo = db_conn();

//ユーザー一覧取得
$stmt = $pdo->prepare('SELECT * FROM gs_user_table;');
$status = $stmt->execute(); //SQL実行結果をいれる

//データ表示
$view=""; //データ表示する変数を初期化
if($status == false){
    sql_error($stmt);
}else{
    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $view .= '<p>';
        $view .= $result['id'] . '：' . $result['name'].' ';
        if($result['kanri_flg']==0){
            $view.='管理者　';
        }else{
            $view.='スーパー管理者　';
        }
        if($result['life_flg']==0){
            $view.='退社　';
        }else{
            $view.='入社　';
        }
        $view .= '<a href="u_edit.php?id='.$result['id'].'">[編集]</a>';
        $view .= '</p>';
    }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ユーザー一覧</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">ユーザー覧</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?= $view ?></div>
    <div><a href="index.php">ホームへ戻る</a></div>
    <div><a href="select.php">結果一覧</a></div>
    <div><a href="user_reg_view.php">ユーザー登録</a></div>
</div>
<!-- Main[End] -->

</body>
</html>