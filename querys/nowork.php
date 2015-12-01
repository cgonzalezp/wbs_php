<?php
include ('../users/seguridad.php');
session_start();
?>
<?php
include('../db.php');
//obtenemos el ultimo id insertado en la base de datos.
$query1="SELECT id_no_works FROM no_works ORDER BY id_no_works DESC LIMIT 1";
$execute1=mysql_query($query1);
//verificamos que valor obtenido y le sumamos uno para crear el siguiente ID
$id_no_works="";
$var1="";
if($row = mysql_fetch_array($execute1)){
		$var1=$row['id_no_works'];
		$id_no_works=$var1+1;
		echo "var1= ".$var1;
		echo "<br>";
};

echo "id del dia no laboral: ".$id_no_works;
echo "<br>";
//Se reciben los datos del formulario y se almacenan en variables.
echo "id de proyecto: ".$id_project=$_SESSION['id'];
echo "<br>";
echo "fecha de inicio: ".$start_date=$_POST['start_date_noworks'];
echo "<br>";
echo "fecha de fin: ".$finish_date=$_POST['finish_date_noworks'];
echo "<br>";
echo "nombre: ".$name=$_POST['name'];
echo "<br>";
//se insertan los datos a la base de datos (tabla no_works).
$query2="INSERT INTO no_works (id_no_works, start_date_nowork, finish_date_nowork, name_date_nowork) VALUES ($id_no_works,'".$start_date."','".$finish_date."','".$name."')";
$execute2=mysql_query($query2);
$query3="INSERT INTO no_works_has_project (no_works_id_no_works, Project_id_project) VALUES ($id_no_works,$id_project)";
$execute3=mysql_query($query3);
//redireccionamos a nuestro proyecto.
header("location:../index2.php?id=$id_project");
?>