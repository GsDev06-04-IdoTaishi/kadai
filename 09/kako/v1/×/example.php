<?php
print "<html><body>";
if (isset($_POST['cbox'])){
foreach($_POST['cbox'] as $val){
$val=htmlspecialchars($val);
print "チェック${val}が選択されました<br>\n";
}
} else {
print <<<_FORM_
<form action="" method="post">
<input type="checkbox" name="cbox[]" value="1">チェック1<br>
<input type="checkbox" name="cbox[]" value="2">チェック2<br>
<input type="checkbox" name="cbox[]" value="3">チェック3<br>
<input type="submit">
</form>
_FORM_;
}
print "</body></html>";
?>