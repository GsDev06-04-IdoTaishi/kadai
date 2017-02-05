<?php
    //1.POSTでParamを取得
$id = $_POST['id'];
$name     = $_POST['name'];
$lid    = $_POST['lid'];
$lpw    = $_POST['lpw'];
$kanri_flg   = $_POST['kanri_flg'];
$life_flg   = $_POST['life_flg'];

    //2.DB接続など
    try {
      $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
    } catch (PDOException $e) {
      exit('DbConnectError:'.$e->getMessage());
    }

    //3.UPDATE gs_an_table SET ....; で更新(bindValue)
    //基本的にinsert.phpの処理の流れです。

    $stmt = $pdo->prepare("UPDATE gs_user_table SET name=:name, lid=:lid, lpw=:lpw, kanri_flg=:kanri_flg, life_flg=:life_flg WHERE id=:id;");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
    $stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
    $stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);
    $stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT);
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
