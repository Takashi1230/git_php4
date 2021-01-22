<?php
//ファイル読みこみ
require_once('funcs.php');

//1.  DB接続
$pdo = db_conn();

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  $view .= '<form method="POST" action="delete.php">';
  //追加メモ FETC_ASSOCを指定することで配列に格納時に、カラム名を添字として保村してくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<p><input type="checkbox" name="deleteTarget[]" value="'.$result["id"].'">';
    $view .= $result["id"]." ";

    $view .= str_repeat('★', $result['star']);
    $view .= str_repeat('　', 6-$result['star']);
    
    $view .= '<a href ="'.h($result["url"]).'" target = _blank>'.h($result["bookname"]).'　</a>';
    $view .= " ".h($result["comment"]).'　';
    $view .= $result["indate"].":";
    $view .= "</p>";
  }
  $view.='
      </form>';

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ブックマーク表示</title>
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
      <a class="navbar-brand" href="index.php">登録データ一覧</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?= $view ?></div>
    <div><a href="index.php">ホームへ戻る</a></div>
    <div><a href="user_list2.php">ユーザー一覧（閲覧のみ）</a></div>
</div>
<!-- Main[End] -->

</body>
</html>
