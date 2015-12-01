<?php
include ('users/seguridad.php');
session_start();
?>
<?php
include_once('../db.php');
//OBTENEMOS EL ID DEL PROYECTO ACTIVO
$Project_id_project=$_SESSION['id'];
$consulta1="SELECT * FROM project where id_project=".$Project_id_project."";
//$consulta1="SELECT * FROM project where active='1'";
$execute1=mysql_query($consulta1);	
$row1=mysql_fetch_assoc($execute1);
$id_project=$row1['id_project'];

//ASIGNAMOS LOS VALORES RECIBIDOS DEL FORMULARIO A VARIABLES POR MEDIO DE _POST.
$name_project=$_POST['new_name_project'];
echo $start_date=$_POST['edit_start_date'];
echo $finish_date=$_POST['edit_finish_date'];



//COMPROBAMOS QUE LOS CAMPOS NO VENGAN VACIOS.
if($name_project=="" || $start_date=="" || $finish_date==""){
	echo"<script>".'confirm("Existen campos vacios.");'."</script>";
}else{
//MODIFICAMOS  LA TABLA PROYECTO CON LOS DATOS RECIBIDOS SOLO SI NUESTRO PROYECTO ES EL ACTIVO Y CONSIDE CON EL ID.
	mysql_query("UPDATE project SET start_date_project='".$start_date."', finish_date_project='".$finish_date."', name_project='".$name_project."' WHERE id_project=$id_project");
	echo"<script>".'confirm("OK.");'."</script>";
//MODIFICAMOS LA ACTIVIDAD CON EL ID_TREE=1 CON LOS MISMOS DATOS OBTENIDOS CON DEL FORMULARIO EDICION.
	mysql_query("UPDATE activity SET start_date='".$start_date."', finish_date='".$finish_date."', name='".$name_project."' WHERE id_tree=1 AND Project_id_project=$id_project");
	echo"<script>".'confirm("OK.");'."</script>";
}
//REDIRECCIONAMOS.
header("location:../index2.php?id=$id_project");

?>
