<?php
include ('users/seguridad.php');
session_start();
?>
<?php
include_once ("db.php");
$duration=$_POST["duracion"];
$start_date=$_POST["fecha_inicio"];
//$finish_date=$_POST["fecha_fin"];
$project_id=$_SESSION['id'];
	

process($start_date,$duration,$project_id);


function process($start_date,$duration,$project_id){
	

	$query6="CALL dias('".$start_date."','".$duration."','".$project_id."')";
	$execute6=mysql_query($query6);
	$row6=mysql_fetch_array($execute6); 


	$dia1=$row6['dia1'];
	$dia2=$row6['dia2'];
	$fecha22=$row6['resultado'];


	$fecha1 = strtotime($start_date); 
	$fecha2 = strtotime($fecha22);
	$fecha3; 
	$cont=1;
		for($fecha1;$cont<=$duration;$fecha1=strtotime('+1 day ' . date('Y-m-d',$fecha1))){ 
   		 if((strcmp(date('l',$fecha1),$dia2)!=0) && (strcmp(date('l',$fecha1),$dia1)!=0)){
        		$fecha3=date('Y-m-d',$fecha1);
			$cont++;
   			 }
			}
	
	

	$jsondata['fecha_final']= $fecha3;

	
	
	
	
	
	
	
	echo json_encode($jsondata);
	
}



?>