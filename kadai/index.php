<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <?php //認証していない場合は閲覧用のメニューを表示
    session_start();
    if(!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] != session_id()){ //chk_ssidに中身がない場合
      echo '<div class="navbar-header"><a class="navbar-brand" href="select2.php">データ一覧(閲覧のみ)</a></div>';
    }else{
      // SESSION IDがチェックできた場合
      // SESSION IDを継続利用（セッションハイジャック）すると盗まれる場合もあるため、再発行する
      session_regenerate_id(true); //セッションIDを再発行
      $_SESSION['chk_ssid'] = session_id();
      echo '<div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>';  
    }
    ?>
    <div class="navbar-header"><a class="navbar-brand" href="login.php">ログイン</a></div>
    <div class="navbar-header"><a class="navbar-brand" href="logout.php">ログアウト</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ブックマーク登録</legend>
     <label>書籍名：<input type="text" name="bookname"></label><br>
     <label>書籍URL：<input type="text" name="url"></label><br>
     <b>おすすめ度：</b>
      <label>★★★★★<input type="radio" name="star" value = "5"></label>
      <label>★★★★<input type="radio" name="star" value = "4"></label>
      <label>★★★<input type="radio" name="star" value = "3"></label>
      <label>★★<input type="radio" name="star" value = "2"></label>
      <label>★<input type="radio" name="star" value = "1"></label>
     <br>
     <label>書籍コメント<textArea name="comment" rows="4" cols="40"></textArea></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
