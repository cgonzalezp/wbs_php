<?php
function calculo_duracion(){
	$wbs_id=11;
	$project_id=1;

	$query0="SELECT is_father_func($wbs_id,$project_id) as father";
    $execute0=mysql_query($query0);
    $row0=mysql_fetch_array($execute0);


    if($row0['father']==1){

    	$query4="SELECT id_tree from activity where parent_id=$wbs_id and Project_id_project=$project_id";
    	$execute4=mysql_query($query4);
    	$row4=mysql_fetch_assoc($execute4);
    	$id_hijo=$row4['id_tree'];

    	$query0="SELECT is_father_func($id_hijo,$project_id) as father";
    	$execute0=mysql_query($query0);
    	$row0=mysql_fetch_array($execute0);

    	while($row0['father']==1){
    		$query1="SELECT  MAX(children_finish_date) as fecha_maxima from activity where parent_id=$wbs_id and Project_id_project=$project_id";//asignamos la fecha maxima del proyecto.
    		$execute1 = mysql_query($query1);
    		$row1=mysql_fetch_array($execute1);
    		$fecha_maxima=$row_2['fecha_maxima'];//imprimimos la fecha maxima
		}
		echo $fecha_maxima;

    }

   

    







    $query1="SELECT  MAX(children_finish_date) as fecha_maxima from activity where Project_id_project=$project_id";//asignamos la fecha maxima del proyecto.
    $execute1 = mysql_query($query1);
    $row1=mysql_fetch_array($execute1);
    $dias=$row_2['fecha_maxima'];//imprimimos la fecha maxima

    $dias=0;

    $query2="select DATEDIFF(finish_date,start_date) as total_dias from activity where id_wbs=$wbs_id and Project_id_project=$project_id";
    $execute2 = mysql_query($query2);
    $row2=mysql_fetch_assoc($execute2);
    $total_dias=$row2['total_dias'];


    $query3="select sum(DATEDIFF(finish_date,start_date)) as dias_proyecto from activity where Project_id_project=$project_id";
    $execute3=mysql_query($query3);
    $row3=mysql_fetch_assoc($execute3);
    $dias_proyecto=$row3['dias_proyecto'];

    $dias=$row_2['total_dias'];//duracion de la actividad

}

echo calculo_duracion();
?>