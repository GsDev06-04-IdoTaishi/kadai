<?php
    //1.POSTでParamを取得
$id = $_POST['id'];
$isbn13     = $_POST['isbn13'];
$title    = $_POST['title'];
$jannru    = $_POST['jannru'];
$hyouka   = $_POST['hyouka'];
$comment   = $_POST['comment'];

//echo $title;
//echo $comment;


    //2.DB接続など
    try {
      $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
    } catch (PDOException $e) {
      exit('DbConnectError:'.$e->getMessage());
    }

    //3.UPDATE gs_an_table SET ....; で更新(bindValue)
    //基本的にinsert.phpの処理の流れです。

    $stmt = $pdo->prepare("UPDATE gs_bm_table SET isbn13=:isbn13,title=:title, jannru=:jannru, hyouka=:hyouka, comment=:comment WHERE id=:id;");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':isbn13', $isbn13, PDO::PARAM_STR);
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':jannru', $jannru, PDO::PARAM_STR);
    $stmt->bindValue(':hyouka', $hyouka, PDO::PARAM_INT);
    $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
    $status = $stmt->execute();

    if($status==false){
        //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
        $error = $stmt->errorInfo();
        exit("QueryError:".$error[2]);
    }else{
        //５．index.phpへリダイレクト
        header("Location: select_bm.php");
        exit;
    }
?>
