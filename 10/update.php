<?php
session_start();
include("functions.php");
ssidCheck();

//1.POSTでParamを取得
$id     = $_POST["id"];
$title   = $_POST["title"];
$article  = $_POST["article"];

//アップロードファイルの取得
if(isset($_FILES['filename']) && $_FILES['filename']['error']==0){
    
    //2. アップロード先とファイル名を作成
    //ファイル名重複を避けるためにidをファイル名に付与
    $upload_file = "./upload/".$id."_".$_FILES["filename"]["name"];
//    echo $upload_file;
//    $upload_file = mb_convert_encoding();
    
    // アップロードしたファイルを指定のパスへ移動
    //move_uploaded_file("一時保存場所","成功後に正しい場所に移動");
    if (move_uploaded_file($_FILES["filename"]['tmp_name'],$upload_file)){
        
        //パーミッションを変更（ファイルの読み込み権限を付けてあげる）chmod:チェンジモディファイ
        chmod($upload_file,0644);//0644：覚えるだけのヤツ
        
    }else{
//        echo "a";
        exit;
    }
}else{
//    echo "b";
    exit;
}


//2.DB接続など
$pdo = db_con();

//3.UPDATE gs_cms_table SET ....; で更新(bindValue)
$stmt = $pdo->prepare("UPDATE gs_cms_table SET title=:title,article=:article, upfile=:upfile WHERE id=:id");
$stmt->bindValue(':title',   $title,   PDO::PARAM_STR);
$stmt->bindValue(':article', $article, PDO::PARAM_STR);
$stmt->bindValue(':upfile', $upload_file, PDO::PARAM_STR);
$stmt->bindValue(':id',      $id,      PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){
  queryError($stmt);
}else{
  header("Location: select.php");
  exit;
}

?>
