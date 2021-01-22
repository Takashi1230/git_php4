<?php

//1. POSTデータ取得
$bookname = $_POST["bookname"];
$url =$_POST["url"];
$comment = $_POST["comment"];
$star = $_POST["star"];


//2. DB接続します
try {
  //ID:'root', Password: 'root'
  $pdo = new PDO('mysql:dbname=gs_db; charset=utf8; host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

//３．データ登録SQL作成
$sql = "INSERT INTO gs_bm_table(id, bookname, url, star, comment, indate)
        VALUES(NULL, :a1, :a2, :a3, :a4, sysdate())"; //ユーザーの入力情報を一度バインド変数で受けることでSQLインジェクションなどを避ける

// 1. SQL文を用意
$stmt = $pdo->prepare($sql);

//  2. バインド変数を用意
$stmt->bindValue(':a1', $bookname, PDO:: PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $url, PDO:: PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $star, PDO:: PARAM_INT);
$stmt->bindValue(':a4', $comment, PDO:: PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMessage:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  echo "登録完了。1秒後にフォームに戻ります。";
  header('refresh:1; url=index.php'); //1秒後にリダイレクト
  exit;


}
?>
