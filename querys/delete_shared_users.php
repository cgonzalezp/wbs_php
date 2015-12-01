<?php
include ("../users/seguridad.php");
session_start();
?>
<?php
include_once('../db.php');
$id_project=$_SESSION['id'];
$id_user=$_GET['id'];
echo "id_project: ".$id_project;
echo "<br>";
echo "cod_user: ".$id_user;
//ELIMINAMOS EL usuario de la tabla "project_has_user"
$query2="DELETE FROM project_has_user WHERE Project_id_project=$id_project AND user_cod_user=$id_user";
$execute2=mysql_query($query2);


header("location:../index2.php?id=$id_project#modal6");
?>