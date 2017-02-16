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
    <link rel="stylesheet" href="css/style_login.css">
    <title>ログイン</title>
</head>
<body>


<!--左のヘッダー部分-->
<div class="header_left">
    <div  class="header-up">
        <img src="img/ddbd_logo.png" alt="" class="header-logo">
    </div>
    <div class="header-down">
<!--        <a class="header_menu" href="index_bm.php"><div>BOOK登録</div></a>-->
        <a class="header_menu" href="overview_bm.php"><div>読んだ本</div></a>
        <a class="header_menu" href="user_bm.php"><div>ユーザー登録</div></a>
<!--        <a class="header_menu" href="#"><div>USER管理</div></a>-->
    </div>
</div>

<main>
    <div class="container_login">
       <div class="title">- ログイン -</div>
       <div class="title_ub">=====================</div>
        <form name="form" action="login_act_bm.php" method="post" class="login_form">
           <div class="koumoku_login">お名前</div>
           <input type="text" name="lid" class="nyuuryoku_login">
           <div class="koumoku_login">パスワード</div>
           <input type="password" name="lpw" class="nyuuryoku_login">
           <div>
               <input type="submit" value="ようこそ" class="btn_login">
           </div>
        </form>
    </div>
</main>
<!-- lLOGINogin_act.php は認証処理用のPHPです。 -->

<!--右のヘッダー部分-->
<div class="header_right">
</div>



</body>
</html>