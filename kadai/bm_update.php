<?php
//1. POSTデータ取得
$bookname   = $_POST["bookname"];
$url  = $_POST["url"];
$comment = $_POST['comment'];
$star    = $_POST['star']; //追加されています
$id = $_POST["id"];


//2. DB接続します
//*** function化する！  *****************
require_once('funcs.php');
$pdo = db_conn();


//３．データ更新SQL作成
$stmt = $pdo->prepare("UPDATE gs_bm_table SET bookname=:bookname, url=:url, star=:star, comment=:comment WHERE id=:id");
$stmt->bindValue(':bookname', $bookname, PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':star', $star, PDO::PARAM_INT);        //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);        //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    //*** function化する！*****************
    // $error = $stmt->errorInfo();
    // exit("SQLError:".$error[2]);
    sql_error($stmt);
}else{
    //*** function化する！*****************
    redirect("select.php");
}
?>
