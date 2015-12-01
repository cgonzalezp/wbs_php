<?php
include ('../users/seguridad.php');
session_start();
?>
<?php
$Project_id_project=$_SESSION['id'];
include ('../db.php');
//SELECIONAMOS EL PROYECTO ACTIVO.
$consulta1="SELECT * FROM project where active='1'";
$execute1=mysql_query($consulta1);	
$row1=mysql_fetch_assoc($execute1);
//OBTENEMOS EL ID DEL PROYECTO.
$id_antiguo=$row1['id_project'];
//ALMACENAMOS EL ID NUEVO, EN LA VARIABLE $ID_ACTUAL.
$id_actual=$_GET['id'];

//CAMBIAMOS LOS VALORES DE LOS PROYECTOS CON LOS ID'S CORRESPONDIENTES.
mysql_query("UPDATE project SET active=1 where id_project=".$id_actual."");
mysql_query("UPDATE project SET active=0 where id_project=".$id_antiguo."");
//REDIRECCIONAMOS.
header("location:../index2.php?id=$id_actual");
?>