<?php
include ("../users/seguridad.php");
session_start();
?>
<?php
include_once("../db.php");
echo $Project_id_project=$_SESSION['id'];
//SELECCIONAMOS EL PROYECTO ACTIVO.
//$query1="SELECT id_project FROM project where Project_id_project=$Project_id_project";
$execute1=mysql_query("SELECT id_project FROM project where id_project=".$Project_id_project."");	
$row1=mysql_fetch_assoc($execute1);
$id_project=$row1['id_project'];
echo $id_project;
//ELIMINAMOS LAS ACTIVIDADES ASOCIADAS A ESE ID.
$query2="DELETE FROM activity WHERE Project_id_project=".$id_project."";
$execute2=mysql_query($query2);
//ELIMINAMOS EL CALENDARIO ASOCIADO A ESE ID.
$query3="DELETE FROM calendar WHERE Project_id_project=".$id_project."";
$execute3=mysql_query($query3);
//ELIMINAMOS LOS DIAS NO LABORALES ASOCIADOS AL ID.
$query4="DELETE FROM no_works_has_project WHERE Project_id_project=".$id_project."";
$execute4=mysql_query($query4);
//ELIMINAMOS EL PROYECTO ASOCIADO A ESE ID.
$query4="DELETE FROM project WHERE id_project=".$id_project."";
$execute4=mysql_query($query4);
header("location:../index2.php?id=0");
?>
