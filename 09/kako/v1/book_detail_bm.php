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
    
//    カウント集計
    
    $cnt_all = 'SELECT COUNT(*) FROM gs_bm_table';
    $cnt_mstr = 'SELECT COUNT(*) FROM gs_bm_table as bm WHERE bm.jannru="ミステリ小説"';
    $cnt_jidai = 'SELECT COUNT(*) FROM gs_bm_table as bm WHERE bm.jannru="時代小説"';
    $cnt_sf = 'SELECT COUNT(*) FROM gs_bm_table as bm WHERE bm.jannru="SF小説"';
    $cnt_non = 'SELECT COUNT(*) FROM gs_bm_table as bm WHERE bm.jannru="ノンフィクション"';
    $cnt_lnov = 'SELECT COUNT(*) FROM gs_bm_table as bm WHERE bm.jannru="ラノベ"';
    $cnt_mc = 'SELECT COUNT(*) FROM gs_bm_table as bm WHERE bm.jannru="男性コミック"';
    $cnt_fc = 'SELECT COUNT(*) FROM gs_bm_table as bm WHERE bm.jannru="女性コミック"';
    $cnt_ad = 'SELECT COUNT(*) FROM gs_bm_table as bm WHERE bm.jannru="アダルト"';
    $cnt_bl = 'SELECT COUNT(*) FROM gs_bm_table as bm WHERE bm.jannru="BL"';

    $rows_all = $pdo->query($cnt_all)->fetchColumn();
    $rows_mstr = $pdo->query($cnt_mstr)->fetchColumn();
    $rows_jidai = $pdo->query($cnt_jidai)->fetchColumn();
    $rows_sf = $pdo->query($cnt_sf)->fetchColumn();
    $rows_non = $pdo->query($cnt_non)->fetchColumn();
    $rows_lnov = $pdo->query($cnt_lnov)->fetchColumn();
    $rows_mc = $pdo->query($cnt_mc)->fetchColumn();
    $rows_fc = $pdo->query($cnt_fc)->fetchColumn();
    $rows_ad = $pdo->query($cnt_ad)->fetchColumn();
    $rows_bl = $pdo->query($cnt_bl)->fetchColumn();
    
//    チャートに渡すように配列化
    $cnt_array = array($rows_mstr,
                        $rows_jidai,
                        $rows_sf,
                        $rows_non,
                        $rows_lnov,
                        $rows_mc,
                        $rows_fc,
                        $rows_ad,
                        $rows_bl
                       );
    
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
       <div class="ov_container">
            <div class="content_name">- OVERVIEW -</div>
            <div class="content_name_underbar">====================</div>
            <div class="status">
                <div class="chart_area">
                    <div class="chart">
                    <canvas id="myChart" width="200"></canvas>
                    <div class="label_total">TOTAL<span class="total_sassuu"><?php echo $rows_all;?></span>冊</div>
                    </div>
                    <div class="labels">
                        <div class="labels_j">
                            <div class="label_j">
                                <div class="jannru">ミステリ</div>
                                <span class="sassuu mytr"><?php echo $rows_mstr;?></span>冊
                            </div>
                            <div class="label_j">
                                <div class="jannru">時代</div>
                                <span class="sassuu jidai"><?php echo $rows_jidai;?></span>冊
                            </div>
                            <div class="label_j">
                            <div class="jannru">SF</div>
                            <span class="sassuu sf"><?php echo $rows_sf;?></span>冊
                            </div>
                        </div>
                        <div class="labels_j">
                            <div class="label_j">
                                <div class="jannru">ノンフィク</div>
                                <span class="sassuu non"><?php echo $rows_non;?></span>冊
                            </div>
                            <div class="label_j">
                                <div class="jannru">ラノベ</div>
                                <span class="sassuu lnov"><?php echo $rows_lnov;?></span>冊
                            </div>
                            <div class="label_j">
                                <div class="jannru">男性コミック</div>
                                <span class="sassuu mc"><?php echo $rows_mc;?></span>冊
                            </div>
                        </div>
                        <div class="labels_j">
                            <div class="label_j">
                                <div class="jannru">女性コミック</div>
                                <span class="sassuu fc"><?php echo $rows_fc;?></span>冊
                            </div>
                            <div class="label_j">
                               <div class="jannru">アダルト</div>
                                <span class="sassuu ad"><?php echo $rows_ad;?></span>冊
                            </div>
                            <div class="label_j">
                               <div class="jannru">BL</div>
                                <span class="sassuu bl"><?php echo $rows_bl;?></span>冊
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
       
        <div class="content_name">- DETAIL -</div>
        <div class="content_name_underbar">====================</div>

        <div class="detail">
            <div class="records">
                <div class="record">
                    <div><img src="" alt=""></div>

                </div>
            </div>


            <div>
                <table class="r_list">
                    <tr class="r_header">
                        <th>ISBN</th>
                        <th>書名</th>
                        <th>著者</th>
                        <th>ジャンル</th>
                        <th>評価</th>
                        <th>感想</th>
                        <th>登録時間</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tbody><?=$view?></tbody>
                </table>
            </div>
        </div>
    </main>
</div>
<!-- Head[Start] -->

<!-- Main[End] -->
    <script>
        
        var cnt_array = <?php echo json_encode($cnt_array, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);?>;
//        console.log(cnt_array);

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx,{
            type: 'pie',
            data: {
                labels: ["ミステリ", "時代", "SF", "ノンフィク", "ラノベ", "漫画（男）", "漫画（女）","アダルト","BL"],
                datasets: [{
                    backgroundColor: [
                        "#1abc9c",
                        "#f1c40f",
                        "#2ecc71",
                        "#e67e22",
                        "#3498db",
                        "#e74c3c",
                        "#9b59b6",
                        "#9b59b6",
                        "#34495e",
                    ],
                    data: cnt_array
                }]
            },
            options:{
                animation:false,
                legend: {
                    display: false
                }
            }
        });
        
    </script>

</body>
</html>
