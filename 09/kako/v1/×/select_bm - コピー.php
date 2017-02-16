<?php
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
      
//    $view .= '<tr><td>'.$res['name'].'</td><td>'.$res["indate"].'</td></tr>';
//      DBからとってきたデータを配列/オブジェクトの形にすることでjavascript等で扱いやすくなる
    $view .= '<tr>';
    $view .= '<td>'.$res['isbn13'].'</td>';
    $view .= '<td>'.$res['book_name'].'</td>';
    $view .= '<td>'.$res['author'].'</td>';
    $view .= '<td>'.$res['jannru'].'</td>';
    $view .= '<td>'.$res['hyouka'].'</td>';
    $view .= '<td>'.$res['comment'].'</td>';
    $view .= '<td>'.$res['indate'].'</td>';
    $view .= '</tr>';
  }
    
//    カウント集計
    
    $cnt_all = 'SELECT COUNT(*) FROM gs_bm_table';
    $cnt_mstr = 'SELECT COUNT(*) FROM gs_bm_table as bm WHERE bm.jannru="ミステリ小説"';
    $cnt_jidai = 'SELECT COUNT(*) FROM gs_bm_table as bm WHERE bm.jannru="時代小説"';
    $cnt_sf = 'SELECT COUNT(*) FROM gs_bm_table as bm WHERE bm.jannru="SF小説"';
    $cnt_non = 'SELECT COUNT(*) FROM gs_bm_table as bm WHERE bm.jannru="ノンフィクション"';
    $cnt_lnov = 'SELECT COUNT(*) FROM gs_bm_table as bm WHERE bm.jannru="ラノベ"';
    $cnt_mc = 'SELECT COUNT(*) FROM gs_bm_table as bm WHERE bm.jannru="男性コミック"';
    $cnt_fc = 'SELECT COUNT(*) FROM gs_bm_table as bm WHERE bm.jannru="女性コミック"';
    $cnt_ad = 'SELECT COUNT(*) FROM gs_bm_table as bm WHERE bm.jannru="アダルト（男性向け）"';
    $cnt_bl = 'SELECT COUNT(*) FROM gs_bm_table as bm WHERE bm.jannru="BL"';
    
    $rows_all = $pdo->query($cnt_all);
    $rows_mstr = $pdo->query($cnt_mstr);
    $rows_jidai = $pdo->query($cnt_jidai);
    $rows_sf = $pdo->query($cnt_sf);
    $rows_non = $pdo->query($cnt_non);
    $rows_lnov = $pdo->query($cnt_lnov);
    $rows_mc = $pdo->query($cnt_mc);
    $rows_fc = $pdo->query($cnt_fc);
    $rows_ad = $pdo->query($cnt_ad);
    $rows_bl = $pdo->query($cnt_bl);
    
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>読書履歴表示</title>
    <link rel="stylesheet" href="css/range.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <style>div{padding: 10px;font-size:16px;}</style>
    
    <script>
    $(function(){
        
//        名前を記入した際に、その記入内容で集計を再実行する
        
        $('#name_slct').on('change',function(){
            var name_slct = $(this).val();
            
            <?php
            $name_slct = '<script>document.write(name_slct);</script>';
            echo $name_slct;
            ?>
        });
    });
    </script>
</head>

<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index_bm.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->

<div>ステータス</div>
<div>
    <div>NAME:<input type="text" name="name_slct" id="name_slct"></div>
    <div>TOTAL:<?php echo $rows_all->fetchColumn();?>冊</div>
    <div>ミステリ:<?php echo $rows_mstr->fetchColumn();?>冊</div>
    <div>時代:<?php echo $rows_jidai->fetchColumn();?>冊</div>
    <div>SF:<?php echo $rows_sf->fetchColumn();?>冊</div>
    <div>ノンフィクション:<?php echo $rows_non->fetchColumn();?>冊</div>
    <div>ラノベ:<?php echo $rows_lnov->fetchColumn();?>冊</div>
    <div>男性コミック:<?php echo $rows_mc->fetchColumn();?>冊</div>
    <div>女性コミック:<?php echo $rows_fc->fetchColumn();?>冊</div>
    <div>アダルト:<?php echo $rows_ad->fetchColumn();?>冊</div>
    <div>BL:<?php echo $rows_bl->fetchColumn();?>冊</div>
</div>

<div>詳細</div>
<div>
    <table><?=$view?></table>
</div>
<!-- Main[End] -->

</body>
</html>
