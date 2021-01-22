<?php
session_start();

//ファイル読みこみ
require_once('funcs.php');
//セッションID確認
loginCheck();

//選択したIDを取得
$id = $_GET["id"];
echo "GET: ".$id;

//DB接続
$pdo = db_conn();


//対象のデータ抽出
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=".$id.";" );
$status = $stmt->execute();


//３．データ表示
if ($status == false) {
    sql_error($status);
} else {
    $row = $stmt->fetch(); //単一レコードなので記載方法を変更

    }

?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>編集画面</title>
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
                    <a class="navbar-brand" href="index.php">データ一覧</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method="POST" action="bm_update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>詳細</legend>  
     <label>書籍名：<input type="text" name="bookname" value="<?= $row['bookname'] ?>"></label><br>
     <label>URL：<input type="text" name="url" value="<?=$row["url"] ?>"></label><br>
     <b>おすすめ度：</b>
        <?php
         $view='';
         for($i=5; $i>0; $i--){
            $view .= '<label>';
            $view .= str_repeat('★', $i); //str_repeat関数は同じ文字を指定した回数繰り返す
            $view .= '<input type="radio" name="star" value = "'.$i;
            if($i == $row['star']){
                $view .= '" checked ="checked';
            }
            $view .='"></label>';
         }
         echo $view;
        ?>
     <br>
     <label><textArea name="comment" rows="4" cols="40"><?= $row["comment"]?></textArea></label><br>
     <input type="hidden" name="id" value="<?= $row['id'] ?>"><br>  <!--送信時に更新対象のIDを送る-->
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
    <!-- Main[End] -->

</body>

</html>
