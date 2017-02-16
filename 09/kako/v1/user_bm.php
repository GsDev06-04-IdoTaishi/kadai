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
    <link rel="stylesheet" href="css/style-user.css">
</head>
<body>

<div class="container_all">
    <!-- Head[Start] -->
    <header>
            <!--ヘッダー部分-->
            <div class="headeryoko">
                    <div  class="header-up">
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
            <form method="post" action="user_insert_bm.php" onSubmit="return check()">
                <div class="content_name">- ユーザー登録 -</div>
                <div class="content_name_underbar">====================</div>
                <div class="contents">
<!--
                    <div class="koumokus">
                        <p class="koumokumei">ID</p>
                        <input type="text" name="id" id="id">
                    </div>
-->
                    <br>
                    <div class="koumokus">
                        <p class="koumokumei">名前</p>
                        <input type="text" name="name" id="name">
                    </div>
                    <br>
                    <div class="koumokus">
                        <p class="koumokumei">ログインID</p>
                        <input type="text" name="lid" id="lid">
                    </div>
                    <br>
                    <div class="koumokus">
                        <p class="koumokumei">ログインPASS</p>
                        <input type="text" name="lpw" id="lpw">
                    </div>
                    <br>
                    <div class="koumokus">
                        <p class="koumokumei">管理者フラグ</p>
                        <select type="text" name="kanri_flg">
                            <option value="0">一般ユーザー</option>
                            <option value="1">管理者</option>
                        </select>
                    </div>
                    <br>
                    <div class="koumokus">
                        <p class="koumokumei">利用フラグ</p>
                        <select type="text" name="life_flg">
                            <option value="0">利用者</option>
                            <option value="1">退会者</option>
                        </select>
                    </div>
                    <br>
                    <br>
                    <br>
                    <input type="submit" value="登録" class="btn_touroku">
                </div>
            </form>
    </main>
</div>
<!-- Main[End] -->
<script>
    
            function check() {
                var id = $('#id').val();
                var name = $('#name').val();
                var lid = $('#lid').val();
                var lpw = $('#lpw').val();
                //未入力チェック
                if (id == '' || name == '' || lid == '' || lpw == '') {
                    alert('- 未記入項目があります。 -');
                    return false;
                }
            }
    
</script>
</body>
</html>