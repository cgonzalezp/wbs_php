<?php
include_once('../db.php');
$id_project=$_GET['id'];

//ELIMINAMOS LAS ACTIVIDADES ASOCIADAS A ESE ID.
$query1="DELETE FROM activity WHERE Project_id_project=$id_project";
$execute1=mysql_query($query1);

//ELIMINAMOS EL CALENDARIO ASOCIADO A ESE ID.
$query2="DELETE FROM calendar WHERE Project_id_project=$id_project";
$execute2=mysql_query($query2);

//ELIMINAMOS LOS DIAS NO LABORALES ASOCIADOS AL ID.
$query3="DELETE FROM no_works_has_project WHERE Project_id_project=$id_project";
$execute3=mysql_query($query3);

//ELIMINAMOS EL PROYECTO ASOCIADO A ESE ID.
$query4="DELETE FROM project WHERE id_project=$id_project";
$execute4=mysql_query($query4);


header("location:../index2.php?id=0");
?>
