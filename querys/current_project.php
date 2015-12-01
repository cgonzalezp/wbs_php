<?php
include ('users/seguridad.php');
session_start();
?>
<?php
include ('../db.php');
//OBTENEMOS EL ID DEL PROYECTO ACTIVO.
//$consulta=mysql_query("SELECT id_project FROM project WHERE active=1");
//$resultado=mysql_fetch_assoc($consulta);
//LO ALMACENAMOS EN UNA VARIABLE $Project_id_project.
//$Project_id_project=$resultado['id_project'];
$id_project=$_SESSION['id'];
?>