<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>読書歴管理</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>div{padding: 10px;font-size:16px;}</style>
    <script>
        $(function(){
//                        rangeの値取得
            $('input[type=range]').on('input',function(){
                var newval = $(this).val();
                $('#hyouka_val').html(newval);
            });
            
            
            
            
            
        })
    </script>

</head>
<body>

<!-- Head[Start] -->
<header>
    <?PHP include("./temple/header.html");?><!--綴り違いはめんどくさいので放置-->
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<main>
    
    <form method="post" action="insert_bm.php">
       <br>
       <br>
       <br>
       <br>
       <br>
        <div class="left_box">
            <div>-SERCH-</div>
            <div class="spacing">
                <div class="flex_wrapper">
                    <div>
                        <br>
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
            </div>
            
            <div class="spacing">
                <div class="flex_wrapper">
                    <div style="width:70%;">Title:
                        <br>
                        <br>
                        <span id="book_title"></span>
                        <br>
                        <br>
                        <br> Authors:
                        <br>
                        <br>
                        <span id="book_authors"></span>
                    </div>
                    <br>
                    <div style="width: 30%;">
                        <img id="book_img" style="width:auto; height:200px;">
                    </div>
                </div>
            </div>
            
            
        </div>

        <div class="right_box">

              <div class="jumbotron">
               <fieldset>
                <legend>INPUT</legend>
                 <label>名前：<input type="text" name="name"></label><br>
                 <label>ISBNコード：<input type="text" name="isbn13"></label><br>
                 <label>書名：<input type="text" name="book_name"></label><br>
                 <label>著者名：<input type="text" name="author"></label><br>
                   <label>ジャンル：<select name="jannru">
                       <option value="ミステリ小説">ミステリ小説</option>
                       <option value="時代小説">時代小説</option>
                       <option value="SF小説">SF小説</option>
                       <option value="ノンフィクション">ノンフィクション</option>
                       <option value="ラノベ">ラノベ</option>
                       <option value="男性コミック">男性コミック</option>
                       <option value="女性コミック">女性コミック</option>
                       <option value="アダルト（男性向け）">アダルト（男性向け）</option>
                       <option value="BL">BL</option>
                   </select></label><br>
                 <label>評価：<input type="range" name="hyouka" max="5" min="0" step="1" id="hyouka"><div id="hyouka_val">3</div></label><br>
                 <label><textArea name="comment" rows="4" cols="40"></textArea></label><br>
                 <input type="submit" value="送信">
                </fieldset>
              </div>

        </div>
    </form>
    
</main>
<!-- Main[End] -->


</body>
</html>
