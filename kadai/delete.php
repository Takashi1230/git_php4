<?php

//ファイル読みこみ
require_once('funcs.php');

//POSTデータ取得
$deleteTarget = $_POST['deleteTarget'];
//1.  DB接続
$pdo = db_conn();

//データ削除のSQL
$sql = "DELETE FROM gs_bm_table WHERE FIND_IN_SET (id, :targetID)"; //FIND_IN_SETでバインド変数内のidと一致するレコードを削除する
$param = implode(',',$deleteTarget);//削除対象のidが配列に入っているため、","で区切って文字列にする
// 1. SQL文を用意
$stmt = $pdo->prepare($sql);
//  2. バインド変数を用意

echo '$param: '.$param."\n";
$stmt->bindValue(':targetID', $param, PDO::PARAM_STR); 

//  3. 実行
$status = $stmt->execute();

//データ削除後処理
if($status==false){
  sql_error($stmt);
}else{
  redirect("select.php");
}
?>
