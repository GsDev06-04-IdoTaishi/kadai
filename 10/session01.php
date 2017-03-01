<?php

session_start();

$_SESSION['a'] = 1;
$_SESSION['name'] = 'Ido';


echo $_SESSION['a'];

$_SESSION["a"]+=1;

?>