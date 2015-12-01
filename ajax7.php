<?php
include ('users/seguridad.php');
session_start();
?>
<?php
include_once ("db.php");
$predecesora=$_POST["predecesora"];
$project_id=$_SESSION['id'];
	

process($predecesora,$project_id);


function process($predecesora,$project_id){
	

	$query6="CALL predecesoras('".$predecesora."','".$project_id."')";
	$execute6=mysql_query($query6);
	$row6=mysql_fetch_object($execute6); 
	$fecha=$row6->nueva_fecha_inicio;


	$jsondata['fecha_final']= $fecha;
	echo json_encode($jsondata);
	
}



?>