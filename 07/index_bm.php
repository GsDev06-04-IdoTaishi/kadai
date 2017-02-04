<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>読書歴管理</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.raty.js"></script>
    <script type="text/javascript" src="js/qrcodelib.js"></script>
    <script type="text/javascript" src="js/webcodecamjs.js"></script>
<!--    <link rel="stylesheet" href="css/reset.css">-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_index.css">
    
<!--    <style>div{padding: 10px;font-size:16px;}</style>-->
    

</head>
<body>

<!-- Head[Start] -->
<header>
    <?PHP include("./temple/header.html");?><!--綴り違いはめんどくさいので放置-->
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<main>
    
    
    <form method="post" action="insert_bm.php" onSubmit="return check()">
        <div class="contents">
            <div class="left_box">
                <div class="title1">-SERCH-</div>
                <div class="spacing">
                        <div>
                            <br>ISBN
                            <br>
                            <input type="text" id="isbn">
                            <br>
                            <br>
                            <button type="button" id="search_btn">Search</button>
                        </div>
                        <div>
                            <br>
                            <input id="switch" type="checkbox"> Barcode Reader
                            <br>
                            <canvas style="border: dashed 1px; width: 260px; height: 70px;"></canvas>
                        </div>
                </div>
                <br>
                <div class="spacing">
                    <div class="flex_wrapper">
                        <div style="width:70%;">Title:
                            <br>
                            <br>
                            <span id="title"></span>
                            <br>
                            <br>
                            <br> Authors:
                            <br>
                            <br>
                            <span id="authors"></span>
                        </div>
                        <br>
                        <div style="width: 30%;">
                            <img id="book_img" style="width:auto; height:200px;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="right_box">
<!--                  <div class="jumbotron">-->
<!--                   <fieldset>-->
                    <div class="title1">-INPUT-</div>
                    <br>
    <!--
                     <label>名前：<input type="text" name="name"></label><br>
                     <label>ISBNコード：<input type="text" name="isbn13"></label><br>
                     <label>書名：<input type="text" name="book_name"></label><br>
                     <label>著者名：<input type="text" name="author"></label><br>
    -->
                    <label>ジャンル:
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
                    </label>
                    <br>
                    <br>
                    <label>評価:
                        <input type="range" name="hyouka" max="5" min="0" step="1" id="hyouka"><div id="hyouka_val">3</div>
                    </label>
                    <br>
                    <br>
                    <label>ヒトコト:
                        <textArea name="comment" rows="2" cols="40"></textArea>
                    </label>
                    <br>
                    <br>
                    <br>
                    <input type="submit" value="登録">
<!--                    </fieldset>-->
<!--                  </div>-->
            </div>
        </div>
        
<!--        検索入手した情報をinput用に格納する-->
        <input type="hidden" id="isbn_saved" name="isbn13">
        <input type="hidden" id="title_saved" name="title">
        <input type="hidden" id="authors_saved" name="authors">
        <input type="hidden" id="book_img_saved" name="book_img">
        
    </form>
</main>
<!-- Main[End] -->
    <script>
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