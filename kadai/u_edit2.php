<?php
//選択したIDを取得
$id = $_GET["id"];
echo "GET: ".$id;

//ファイル読みこみ
require_once('funcs.php');
$pdo = db_conn();

//対象のデータ抽出
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=".$id.";" );
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
    <form method="POST" action="user_update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>詳細</legend>  
     <label>名前：<?= $row['name'] ?></label><br>
     <label>ユーザーID：<?=$row["lid"] ?></label><br>
     <label>パスワード：非表示</label><br>

     <label>管理者設定：
     <?php
         for($i=0; $i<2; $i++){
            $view1 .= '<input type="radio" name="kanri_flg" value = '.$i;
            if($i == $row['kanri_flg']){
                $view1 .= ' checked ="checked"';
            }
            $view1 .='disabled="disabled">';
            if($i==0){
                $view1 .= '0:管理者';
            }else{
                $view1 .= '1:スーパー管理者';
            }
         }
         echo $view1;
        ?>
     </label><br>
     <label>在籍状況：
     <label>
     <?php
         for($i=0; $i<2; $i++){
            $view2 .= '<input type="radio" name="life_flg" value = '.$i;
            if($i == $row['life_flg']){
                $view2 .= ' checked ="checked"';
            }
            $view2 .='disabled="disabled">';
            if($i==0){
                $view2 .= '0:退社';
            }else{
                $view2 .= '1:入社';
            }
         }
         echo $view2;
        ?>
     </label><br>

    </fieldset>
  </div>
</form>
<div><a href="user_list2.php">ユーザー一覧</a></div>
    <!-- Main[End] -->

</body>

</html>
