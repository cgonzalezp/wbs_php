<?php
include_once ('../db.php');
include ('../users/seguridad.php');

// Con esta sentencia SQL obtendremos el ID del ultimo projecto creado de la base de datos.
//$consulta1="SELECT Project_id_project FROM activity ORDER BY id_tree DESC LIMIT 1";
echo $user=$_SESSION['user'];
echo $id_project=$_SESSION['id'];
//$fecha_actual=date("d/m/Y");
$fecha_actual = date('Y/m/d'); 
//OBtenemos el COD_USER a partir del nomnre de usuario
$consulta0="SELECT cod_user FROM user where email_user='".$user."'";
$execute0=mysql_query($consulta0);
$row0= mysql_fetch_array($execute0);
$cod_user=$row0['cod_user'];
//Guardamos el nombre del nuevo proyecto
$name_project=$_POST['nameproject'];
//obtenemos el ultimo valor del todos los proyectos
$consulta1="SELECT Project_id_project FROM activity ORDER BY Project_id_project DESC LIMIT 1";
$execute=mysql_query($consulta1);
//verificamos que valor obtenido y le sumamos uno para crear el siguiente ID
$id_project="";
$var1="";
if($row = mysql_fetch_array($execute)){
		$var1=$row['Project_id_project'];
		$id_project=$var1+1;
}
//seleccionamos el id del proyecto activo
$consulta5="SELECT id_project,name_project FROM project WHERE active=1";
$execute5=mysql_query($consulta5);
$row5=mysql_fetch_assoc($execute5);

//Insertamos en la BD asignandole el Project_id_project de forma automatica.
$consulta2="INSERT INTO project (id_project,start_date_project,active,finish_date_project,id_project_user,name_project) VALUES ($id_project,'".$fecha_actual."','1','".$fecha_actual."','".$cod_user."','".$name_project."')";
$execute2=mysql_query($consulta2);

//Insertamos el primer nodo (actividad) del nuevo proyecto.
$consulta3="INSERT INTO activity (id_tree,name,parent_id,hide,id_wbs,cost,predecessors,duration,start_date,Project_id_project,finish_date) VALUES (1,'".$name_project."',0,0,1,0,0,0,'".$fecha_actual."',$id_project,'".$fecha_actual."')";
$execute3=mysql_query($consulta3);


$consulta4="UPDATE project SET active=0 WHERE id_project='".$row5['id_project']."'";
$execute4=mysql_query($consulta4);

$query6="INSERT INTO project_has_user (project_id_project,user_cod_user)VALUES($id_project,$cod_user)";
$execute6=mysql_query($query6);
//cerramos la conexion.
//mysql_close($con);
//redireccionamos al index.
header("location:../index2.php?id=$id_project");

?>

