<?php
    
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $sex = $_POST['sex'];
    $nenndai = $_POST['nenndai'];
    
?>

<html>
<head>
<meta charset="utf-8">
<title>受信と書込</title>
</head>
<body>
お名前：<?php echo  htmlspecialchars($name, ENT_QUOTES); ?>
Mail：<?php echo  htmlspecialchars($mail, ENT_QUOTES); ?>
性別：<?php echo  htmlspecialchars($sex, ENT_QUOTES); ?>
年代：<?php echo htmlspecialchars($nenndai, ENT_QUOTES); ?>

<?php
    
    $file = fopen("data/data.csv","a");
    $data = array($name,$mail,$sex,$nenndai);
    $line = implode(',',$data);
    $line_csv = mb_convert_encoding($line, "SJIS-win","UTF-8");
    
    flock($file, LOCK_EX);
    fwrite($file, $line_csv."\r\n");
    flock($file, LOCK_UN);
    fclose($file);
    
?>

</body>
</html>