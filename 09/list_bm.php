<?php

session_start();
$sid = session_id();
$select_user = '<a class="header_menu" href="#"><div>USER管理</div></a>';


//0.外部ファイル読み込み
include("functions.php");

//echo $_SESSION["chk_ssid"];
//echo $sid;

//ここからデータ取り出し処理

//1.  DB接続します
try {
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());//エラーが出た場合処理を中止して、エラーを吐き出す
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示

$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
}else{
        
    //Selectデータの数だけ自動でループしてくれる
    while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        $view .= '<tr>';
        $view .= '<td>'.$res['isbn13'].'</td>';
        $view .= '<td>'.$res['title'].'</td>';
        $view .= '<td>'.$res['authors'].'</td>';
        $view .= '<td>'.$res['jannru'].'</td>';
        $view .= '<td>'.$res['hyouka'].'</td>';
        $view .= '<td>'.$res['comment'].'</td>';
        $view .= '<td>'.$res['indate'].'</td>';
        //削除&更新
        $view .= '<td>';
        $view .=  '<a href="detail_bm.php?id='.$res["id"].'">';
        $view .= '[更新]';
        $view .= '</a>';
        $view .= '</td>';
        $view .= '<td>';
        $view .=  '<a href="delete_bm.php?id='.$res["id"].'">';
        $view .= '[削除]';
        $view .= '</a>';
        $view .= '</td>';
    }

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="css/main.css" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.raty.js"></script>
    <script type="text/javascript" src="js/qrcodelib.js"></script>
    <script type="text/javascript" src="js/webcodecamjs.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style_list.css">
    <title>BOO</title>
</head>
<body>


<!--左のヘッダー部分-->
<div class="header_left">
    <div  class="header-up">
        <img src="img/ddbd_logo.png" alt="" class="header-logo">
    </div>
    <div class="header-down">
        <a class="header_menu" href="input_bm.php"><div>登録</div></a>
        <a class="header_menu" href="#"><div>読んだ本</div></a>
        <a class="header_menu" href="#"><div>本の検索</div></a>
        <a class="header_menu" href="user_bm.php"><div>人の検索</div></a>
        <!--    管理者メニューの表示 スタート    -->
        <?php
            if($_SESSION["kanri_flg"] == 1){
                echo $select_user;
            }
        ?>
    </div>
</div>

<main>
   <div class="title">- 読んだ本一覧 -</div>
   <div class="title_ub">=====================</div>
   
   
    
</main>
<!-- lLOGINogin_act.php は認証処理用のPHPです。 -->

<!--右のヘッダー部分-->
<div class="header_right">
</div>


<!--以下、js-->
<script>
</script>

</body>
</html>