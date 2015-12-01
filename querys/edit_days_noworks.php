<?php
include ('users/seguridad.php');
session_start();
?>
<?php
include_once('../db.php');
$id_day=$_GET['id2'];
$id_project=$_SESSION['id'];
$dias=10;

$query1="SELECT * FROM no_works where id_no_works=$id_day";
$execute1=mysql_query($query1);
$row1=mysql_fetch_array($execute1);

echo $row1['name_date_nowork'];
echo "<br>";
echo $row1['start_date_nowork'];
echo "<br>";
echo $row1['start_date_nowork'];
echo "<br>";
$query2="CALL duracion('".$row1['start_date_nowork']."','".$dias."')";
$execute2=mysql_query($query2);
$row2=mysql_fetch_array($execute2);
echo "Procedimiento almacenado: ".$row2['resultado'];

/*
//$consulta1="SELECT * FROM project where active='1'";
$execute1=mysql_query($consulta1);	
$row1=mysql_fetch_assoc($execute1);
$id_project=$row1['id_project'];

//ASIGNAMOS LOS VALORES RECIBIDOS DEL FORMULARIO A VARIABLES POR MEDIO DE _POST.
$name_project=$_POST['nameproject'];
echo $start_date=$_POST['edit_start_date'];
echo $finish_date=$_POST['edit_finish_date'];



//COMPROBAMOS QUE LOS CAMPOS NO VENGAN VACIOS.
if($name_project=="" || $start_date=="" || $finish_date==""){
	echo"<script>".'confirm("Existen campos vacios.");'."</script>";
}else{
//MODIFICAMOS  LA TABLA PROYECTO CON LOS DATOS RECIBIDOS SOLO SI NUESTRO PROYECTO ES EL ACTIVO Y CONSIDE CON EL ID.
	mysql_query("UPDATE project SET start_date_project='".$start_date."', finish_date_project='".$finish_date."', name_project='".$name_project."' WHERE id_project=$id_project");
	echo"<script>".'confirm("OK.");'."</script>";
}
//REDIRECCIONAMOS.
header("location:../index2.php?id=$id_project");
*/
//header("location:../index2.php?id=$id_project#modal2");
?>
