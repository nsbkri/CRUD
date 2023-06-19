<?php
session_start();
$_SESSION['id_user']='';
$_SESSION['username']='';
$_SESSION['nama']='';
$_SESSION['email']='';

unset($_SESSION['id_user']);


session_unset();

session_destroy();
header('Location:login.php');

?>