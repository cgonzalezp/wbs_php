<?php
include("conexion.php");

$name=$_POST['name'];
$user_email=$_POST['user-email'];
$user_password=$_POST['user-pw'];
$user_password_repeat=$_POST['user-pw-repeat'];

if($user_password==$user_password_repeat){

$query1="SELECT cod_user FROM user ORDER BY cod_user DESC LIMIT 1";
$execute1=mysql_query($query1);
$row1=mysql_fetch_assoc($execute1);
$last_cod=$row1['cod_user'];
$new_cod=$last_cod+1;

$query2="INSERT INTO user (cod_user,name_user,pass_user,digit_user,email_user,Project_id_project) VALUES($new_cod,'".$name."','".$user_password."',$new_cod,'".$user_email."',$new_cod)";
$execute2=mysql_query($query2);
header("location:../index.php");
}else{
	echo ("No coinciden las contraseñas");
	alert("No coinciden las contraseñas");
}


?>