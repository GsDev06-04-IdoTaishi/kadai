<?php
//1.  DB接続します
try {
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());//エラーが出た場合処理を中止して、エラーを吐き出す
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
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
        
        //    $view .= '<tr><td>'.$res['name'].'</td><td>'.$res["indate"].'</td></tr>';
        //      DBからとってきたデータを配列/オブジェクトの形にすることでjavascript等で扱いやすくなる
        $view .= '<tr>';
        $view .= '<td>'.$res['id'].'</td>';
        $view .= '<td>'.$res['name'].'</td>';
        $view .= '<td>'.$res['lid'].'</td>';
        $view .= '<td>'.$res['lpw'].'</td>';
        $view .= '<td>'.$res['kanri_flg'].'</td>';
        $view .= '<td>'.$res['life_flg'].'</td>';
        //削除&更新
        $view .= '<td>';
        $view .=  '<a href="detail_user_bm.php?id='.$res["id"].'">';
        $view .= '[更新]';
        $view .= '</a>';
        $view .= '</td>';
        $view .= '<td>';
        $view .=  '<a href="delete_user_bm.php?id='.$res["id"].'">';
        $view .= '[削除]';
        $view .= '</a>';
        $view .= '</td>';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>あああああああああ</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.js"></script>
<!--    <link rel="stylesheet" href="css/reset.css">-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/range.css">
    <link rel="stylesheet" href="css/style.css">
<!--    <link rel="stylesheet" href="css/style-header.css">-->
    <link rel="stylesheet" href="css/style_header.css">
    <link rel="stylesheet" href="css/style_select.css">
<!--    <style>div{padding: 10px;font-size:16px;}</style>-->
    
</head>

<body>
<div class="container_all">
    <!-- Head[Start] -->
    <header>
        <div class="headeryoko">
            <div  class="header-up">
                <!--あとでここは画像に差し替えよう-->
                <img src="img/ddbd_logo.png" alt="" class="header-logo">
            </div>
            <div class="header-down">
                <a class="header_menu" href="index_bm.php"><div>INPUT</div></a>
                <a class="header_menu" href="select_bm.php"><div>STATUS</div></a>
                <a class="header_menu" href="user_bm.php"><div>USER</div></a>
            </div>
        </div>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <main  id="main">
        <div class="content_name">- ユーザーリスト -</div>
        <div class="content_name_underbar">====================</div>
        
        <div class="detail">
            <div>
                <table class="r_list">
                    <tr class="r_header">
                        <th>ID</th>
                        <th>名前</th>
                        <th>ログインID</th>
                        <th>ログインPW</th>
                        <th>管理者権限</th>
                        <th>利用ステータス</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tbody><?=$view?></tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<!-- Main[End] -->

</body>
</html>
