
<?php
include('../db.php');
session_start();

 $id_project=$_SESSION['id'];
 $email_new_user=$_POST['emailnewuser'];

//Obtenemos el cod_user del usuario al que le compartiremos el proyecto.
$query1="SELECT cod_user FROM user WHERE email_user='".$email_new_user."'";
$execute1=mysql_query($query1);
$row1=mysql_fetch_assoc($execute1);
$cod_new_user=$row1['cod_user'];

//seleccionamos todos los datos del proyecto a compartir.
$query2="SELECT * FROM project WHERE id_project=$id_project";
$execute2=mysql_query($query2);
$row2=mysql_fetch_assoc($execute2);


//se crea un nuevo proyecto con el mismo id del proyecto compartido, pero el id_project_user sera el nuevo cod_user.
//mysql_query("INSERT INTO project (id_project,start_date_project,active,finish_date_project,id_project_user,name_project,id_shared) VALUES ('".$row2['id_project']."','".$row2['start_date_project']."','".$row2['active']."','".$row2['finish_date_project']."','".$cod_new_user."','".$row2['name_project']."','".$row2['id_project_user']."')");
mysql_query("INSERT INTO project_has_user (project_id_project, project_id_shared, user_cod_user) VALUES ('".$row2['id_project']."',' ','".$cod_new_user."')");
//redireccionamos el proyecto en el que estabamos.
header("location:../index2.php?id=$id_project");

?>