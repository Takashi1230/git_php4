<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ユーザー登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="user_reg.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザー登録</legend>
    <label>名前：<input type="text" name="name"></label><br>
     <label>ユーザーID：<input type="text" name="lid"></label><br>
     <label>パスワード：<input type="text" name="lpw"></label><br>
     <label>管理者設定　
       <input type="radio" name="kanri_flg" value = '0'>管理者
       <input type="radio" name="kanri_flg" value = '1'>スーパー管理者
     </label><br>
     <label>在籍設定　
       <input type="radio" name="life_flg" value = '0'>入社
       <input type="radio" name="life_flg" value = '1'>退社
     </label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<a href="user_list.php">ユーザー一覧</a>
<!-- Main[End] -->


</body>
</html>
