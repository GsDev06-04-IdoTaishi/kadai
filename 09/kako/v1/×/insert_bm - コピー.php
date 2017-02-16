<?php
//1. POSTデータ取得

$name     = $_POST['name'];
$isbn13     = $_POST['isbn13'];
$book_name    = $_POST['book_name'];
$author    = $_POST['author'];
$jannru    = $_POST['jannru'];
$hyouka   = $_POST['hyouka'];
$comment   = $_POST['comment'];


//2. DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());//エラーが出た場合処理を中止して、エラーを吐き出す
}


//3．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(id, name, isbn13, book_name, author, jannru, hyouka, comment,
indate )VALUES(NULL, :name, :isbn13, :book_name, :author, :jannru, :hyouka, :comment, sysdate())");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':isbn13', $isbn13, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':book_name', $book_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':author', $author, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':jannru', $jannru, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':hyouka', $hyouka, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//4．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: index_bm.php");//"Location:"の後の半角スペースは必要
  exit;//headerの後はexitを書く

}
?>
