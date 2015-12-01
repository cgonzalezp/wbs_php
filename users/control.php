<?php
include("conexion.php");

session_start();

$usuario=$_POST['user-name'];
$password=$_POST['user-pw'];


$pass=md5($password);

$resultado=mysql_query("select * from user where email_user='$usuario' and pass_user='$password' ",$conexion);
$filas=mysql_num_rows($resultado);
if($filas==1){
$_SESSION['autentificado']="1";
//$_SESSION['user']=$_POST['usuario'];
$_SESSION['user']=$usuario;
$_SESSION['pass']=$password;
header("location:../index2.php?id=0");
}
else{
header("Location:../index.php?errorusuario=1");
}
?>