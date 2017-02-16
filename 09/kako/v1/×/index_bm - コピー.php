<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>読書登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
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
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select_bm.php">読書履歴</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="insert_bm.php">
  <div class="jumbotron">
   <fieldset>
    <legend>読書登録</legend>
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
</form>
<!-- Main[End] -->


</body>
</html>
