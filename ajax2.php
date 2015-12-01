<?php
include ('users/seguridad.php');
session_start();
?>
<?php
include_once('db.php');
//include('aaa.php');
$data=$_POST['number'];
$id_project=$_SESSION['id'];



//Calculo Costos
$costo=0;                  
$query_1="SELECT sum(cost) from activity where id_tree like '".$data."%' AND Project_id_project=$id_project";
$execute_1 = mysql_query($query_1);
$row_1=mysql_fetch_assoc($execute_1);
$costo_total=$row_1['sum(cost)'];          
$cost=$costo_total;
//Calculo Costos
                    
                                       
                    
                    

$query1="SELECT is_father_func($data,$id_project) as father";
$execute1=mysql_query($query1);
$row1=mysql_fetch_array($execute1);



if($data != null ){



	
	$query="SELECT * FROM activity WHERE id_tree=$data AND Project_id_project=$id_project";
	$execute=mysql_query($query);
	$row=mysql_fetch_object($execute);

	if($data==1){
	
	$query3="SELECT MIN(start_date) as fecha_hijo_minima ,MAX(children_finish_date) as fecha_hijo_maxima, sum(cost) as cost from activity where parent_id like '".$data."%' AND Project_id_project=$id_project";
	}
	else {
	
	$query3="SELECT MIN(start_date) as fecha_hijo_minima , MAX(finish_date) as fecha_hijo_maxima from activity where parent_id like '".$data."%' AND Project_id_project=$id_project";
	
	}
	
	
	
   	$execute3=mysql_query($query3);
    $row3=mysql_fetch_object($execute3);                    
   	$query4="CALL hijo_mayor($data,$id_project)";
    $execute4=mysql_query($query4);
    $row4=mysql_fetch_object($execute4); 

    //////////////////////AQUII/////////////////////////////////////////////////////////
    //$fecha_inicio=$row4->start_date;
    //$fecha_hijo_maxima=$row3->fecha_hijo_maxima;
	
	/*$query55="CALL durationa('".$row4->start_date."','".$row3->fecha_hijo_maxima."','".$id_project."')";
    $execute55=mysql_query($query55);
    $row55=mysql_fetch_object($execute55); 
   	$dur=$row55->duracion;*/



	
	$jsondata['names']= $row->name;
	$jsondata['cost']= $row->cost;
	$jsondata['predecessors']=$row->predecessors;
	//$jsondata['duration']=$dur;
	$jsondata['duration']=$row->duration;
	$jsondata['start_date']=$row->start_date;

	if($row1['father']==1 ){
	
    

	//$jsondata['names']= $row->name;
	$jsondata['cost']= $cost;
	$jsondata['predecessors']=$row4->predecessors;
	$jsondata['duration']=$row4->duration;
	//$jsondata['duration']=$dur;
	
		if($data==1){
			////////////////////////////////AQUI/////////////////////////////////////////////////////////////////
			/*$query5="CALL durationa('".$row3->fecha_hijo_minima."','".$row3->fecha_hijo_maxima."','".$id_project."')";
    		$execute5=mysql_query($query5);
    		$row5=mysql_fetch_object($execute5); */

			$jsondata['start_date']=$row3->fecha_hijo_minima;
			$jsondata['finish_date']=$row3->fecha_hijo_maxima;
			$jsondata['cost']= $cost;
			//$jsondata['father']= duracion_padres_aaa();
			
		}else{
			$jsondata['start_date']=$row4->start_date;
			$jsondata['finish_date']=$row3->fecha_hijo_maxima;
		}

	
		
		
		
		//$jsondata['start_date']=$row4->start_date;
		
		
	}else{

		$jsondata['finish_date']=$row->finish_date;
	}

	echo json_encode($jsondata);
}else{
	echo "Error al procesar la informacion.";
	//echo $id_project;
}
?>