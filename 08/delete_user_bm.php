<?php
    //1.POSTでParamを取得
    $id     = $_GET["id"];
    //2.DB接続など
    try {
      $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
    } catch (PDOException $e) {
      exit('DbConnectError:'.$e->getMessage());
    }

    //3.UPDATE gs_an_table SET ....; で更新(bindValue)
    //基本的にinsert.phpの処理の流れです。

    $stmt = $pdo->prepare("DELETE FROM gs_user_table WHERE id=:id;");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $status = $stmt->execute();

    if($status==false){
        //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
        $error = $stmt->errorInfo();
        exit("QueryError:".$error[2]);
    }else{
        //５．index.phpへリダイレクト
        header("Location: userlist_bm.php");
        exit;
    }
?>
