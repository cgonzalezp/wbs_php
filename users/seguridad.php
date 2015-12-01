<?php
session_start();
//include("../index.php");
if($_SESSION['autentificado']!="1"){
header("location:index.php");
exit();
}
?>