<?php
include ("../users/seguridad.php");
session_start();
?>
<?php
include_once('../db.php');
$id_project=$_SESSION['id'];
$id_day=$_GET['id2'];




//ELIMINAMOS EL dia no laboral de la tabla "no_works_has_project"
$query2="DELETE FROM no_works_has_project WHERE no_works_id_no_works=$id_day";
$execute2=mysql_query($query2);

//ELIMINAMOS el dia no laboral de la tabla "no_works"
$query1="DELETE FROM no_works WHERE id_no_works=$id_day";
$execute1=mysql_query($query1);

header("location:../index2.php?id=$id_project");
?>