<?php
    $id = $_GET["id"];
    //1.  DB接続します
    try {
        $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
    } catch (PDOException $e) {
        exit('データベースに接続できませんでした。'.$e->getMessage());
    }

    //２．データ登録SQL作成
    
    $stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $status = $stmt->execute();

    //３．データ表示
    $view="";
    if($status==false){
        //execute（SQL実行時にエラーがある場合）
        $error = $stmt->errorInfo();
        exit("エラーの原因::".$error[2]);
    }else{
    //Selectデータの数だけ自動でループしてくれる
        $res = $stmt->fetch();//1レコード取得
    }
    ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>あああああああああ</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.raty.js"></script>
    <script type="text/javascript" src="js/qrcodelib.js"></script>
    <script type="text/javascript" src="js/webcodecamjs.js"></script>
<!--    <link rel="stylesheet" href="css/reset.css">-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="css/style.css">
<!--    <link rel="stylesheet" href="css/style-header.css">-->
    <link rel="stylesheet" href="css/style_header.css">
    <link rel="stylesheet" href="css/style-index.css">
</head>
<body>

<div class="container_all">
    <!-- Head[Start] -->
    <header>
            <!--ヘッダー部分-->
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
    <main>
        <!--メインコンテンツ-->
            <form method="post" action="update_bm.php" onSubmit="return check()">
                <div class="content_name">- INPUT -</div>
                <div class="content_name_underbar">====================</div>
                <div class="contents">
                    <div class="left_box">
                        <div class="container_img">
                           <div class="img_bg" id="img_bg">
<!--                               <div id="no_img">NO IMAGE</div>-->
                                <img id="book_img" class="book_img" style="width:auto; height:200px;">
                           </div>
                        </div>
                        <br>
                            <div class="koumokus">
                                <div>
                                   <div>
                                        <input id="switch" type="checkbox">
                                        バーコードリーダーの起動
                                   </div>
                                </div>
                                <canvas style="border: dashed 1px; width: 260px; height: 70px;"></canvas>
                            </div>
                            <br>
                            <div class="koumokus">
                                <p class="koumokumei">ISBN</p>
                                <div>
                                    <input type="text" id="isbn" value="<?= $res['isbn13']?>">
                                    <button type="button" id="search_btn">検索</button>
                                </div>
                            </div>
                            <br>
                            <div class="koumokus">
                                <p class="koumokumei">タイトル</p>
                                <span id="title"><?= $res['title']?></span>
                                <br>
                                <p class="koumokumei">著者</p>
                                <span id="authors"><?= $res['authors']?></span>
                            </div>
<!--
                                <div style="width: 30%;">
                                <img id="book_img" style="width:auto; height:200px;">
                                </div>
-->
                    </div>

                    <div class="right_box">
                        <!--                  <div class="jumbotron">-->
                        <!--                   <fieldset>-->
                        <br>
                        <!--
                        <label>名前：<input type="text" name="name"></label><br>
                        <label>ISBNコード：<input type="text" name="isbn13"></label><br>
                        <label>書名：<input type="text" name="book_name"></label><br>
                        <label>著者名：<input type="text" name="author"></label><br>
                        -->
                        <div class="koumokus">
                           <p class="koumokumei">ジャンル</p>
                            <select name="jannru">
                            <option value="ミステリ小説">ミステリ小説</option>
                            <option value="時代小説">時代小説</option>
                            <option value="SF小説">SF小説</option>
                            <option value="ノンフィクション">ノンフィクション</option>
                            <option value="ラノベ">ラノベ</option>
                            <option value="男性コミック">男性コミック</option>
                            <option value="女性コミック">女性コミック</option>
                            <option value="アダルト">アダルト</option>
                            <option value="BL">BL</option>
                            </select>
                        </div>
                        <br>
                        <br>
                        <div class="koumokus">
                            <p class="koumokumei">評価</p>
                            <div id="hyouka_val">3</div>
                            <input type="range" name="hyouka" max="5" min="0" step="1" id="hyouka" value="<?= $res['hyouka']?>">
                        </div>
                        <br>
                        <br>
                        <div class="koumokus">
                           <p class="koumokumei">ヒトコト</p>
                            <textArea name="comment" rows="2" cols="40"><?= $res['comment']?></textArea>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <input type="submit" value="更新" class="btn_touroku">
                        <!--                    </fieldset>-->
                        <!--                  </div>-->
                    </div>
                </div>
                
                
                <input type="hidden" id="id" name="id" value="<?= $id?>">
                <!--        検索入手した情報をinput用に格納する-->
                <input type="hidden" id="isbn_saved" name="isbn13">
                <input type="hidden" id="title_saved" name="title">
                <input type="hidden" id="authors_saved" name="authors">
                <input type="hidden" id="book_img_saved" name="book_img">
            </form>
    </main>
<!-- Main[End] -->
    <script>
        
        //取ってきた初期値を入れる
        var newval = $('input[type=range]').val();
        $('#hyouka_val').html(newval);
        
        var isbn = $('#isbn').val();
        var url = "https://www.googleapis.com/books/v1/volumes?q=" + isbn;
        //ajaxでURLを投げて検索
        $.ajax({
            type: "get",
            url: url,
            dataType: "json"
        }).done(function (json) {
            //書籍情報を表示(書名、著者、表紙画像)
            //書名
            var title = json.items["0"].volumeInfo.title;
            console.log(json.items["0"].volumeInfo);
            $('#title').html(title);
            $('#title_saved').val(title);
            //著者
            var authors_list = json.items["0"].volumeInfo.authors;
            //複数の場合を考慮
            var authors = '';
            for (var i = 0; i < authors_list.length; i++) {
                authors = authors + authors_list[i];
                //最後の著者以外はカンマ区切りでつなげる
                if (i != authors_list.length - 1) {
                    authors = authors + ' & ';
                }
            }
            console.log(authors);
            $('#authors').html(authors);
            $('#authors_saved').val(authors);
            //表紙画像
            var book_img = json.items["0"].volumeInfo.imageLinks.thumbnail;
            $('#book_img').attr('src', book_img);
            $('#book_img_saved').val(book_img);
            //発売日
//                var publishedDate = json.items["0"].volumeInfo.publishedDate;
//                $('#book_publishedDate_saved').val(publishedDate);
            //説明書き
//                var description = json.items["0"].volumeInfo.description;
//                $('#book_description_saved').val(description);
        });
        //検索後にISBNが変更されると厄介なので、念の為格納
        if (isbn.length == 13) {
            isbn = isbn.substr(3);
        }
            $('#isbn_saved').val(isbn);
        
        
        //
        //評価の値取得して画面上に反映する
        //
        $('input[type=range]').on('input',function(){
            var newval = $(this).val();
            $('#hyouka_val').html(newval);
        });

        //
        //★ISBNより書籍を検索★（金田さんのをもろパクリ）

        //
        $('#search_btn').on('click', function () {
            var isbn = $('#isbn').val();
            var url = "https://www.googleapis.com/books/v1/volumes?q=" + isbn;
            //ajaxでURLを投げて検索
            $.ajax({
                type: "get",
                url: url,
                dataType: "json"
            }).done(function (json) {
                //書籍情報を表示(書名、著者、表紙画像)
                //書名
                var title = json.items["0"].volumeInfo.title;
                console.log(json.items["0"].volumeInfo);
                $('#title').html(title);
                $('#title_saved').val(title);
                //著者
                var authors_list = json.items["0"].volumeInfo.authors;
                //複数の場合を考慮
                var authors = '';
                for (var i = 0; i < authors_list.length; i++) {
                    authors = authors + authors_list[i];
                    //最後の著者以外はカンマ区切りでつなげる
                    if (i != authors_list.length - 1) {
                        authors = authors + ' & ';
                    }
                }
                console.log(authors);
                $('#authors').html(authors);
                $('#authors_saved').val(authors);
                //表紙画像
                var book_img = json.items["0"].volumeInfo.imageLinks.thumbnail;
                $('#book_img').attr('src', book_img);
                $('#book_img_saved').val(book_img);
                //発売日
//                var publishedDate = json.items["0"].volumeInfo.publishedDate;
//                $('#book_publishedDate_saved').val(publishedDate);
                //説明書き
//                var description = json.items["0"].volumeInfo.description;
//                $('#book_description_saved').val(description);
            });
            //検索後にISBNが変更されると厄介なので、念の為格納
            if (isbn.length == 13) {
                isbn = isbn.substr(3);
            }
            $('#isbn_saved').val(isbn);
        });
        
        function check() {
//            var nick_name = $('#nick_name').val();
//            var score = $('#score_saved').val();
//            var title = $('#title').val();
//            var comment = $('#comment').val();
            var book_title = $('#title_saved').val();
            //未入力チェック
            if (book_title == '') {
                alert('- タイトルが確認できません。');
                return false;
            }
        }
        
    </script>
    <script>
        //
        //バーコード検索
        //
        var arg = {
            resultFunction: function (result) {
                $('#isbn').val(result.code);
            }
        };

        var video = new WebCodeCamJS("canvas").init(arg);
        $('#switch').on('click', function () {
            if ($('#switch')[0].checked == true) {
                video.play();
            }
            if ($('#switch')[0].checked == false) {
                video.stop();
            }
        });
    </script>
</body>
</html>