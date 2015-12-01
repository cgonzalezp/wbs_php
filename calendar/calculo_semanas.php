<?php



function calculo_costo_total($project_id){
$query2="SELECT sum(cost) FROM activity WHERE Project_id_project=6";
$execute2=mysql_query($query2);
$row2=mysql_fetch_array($execute2);
$costo_total=$row2['sum(cost)'];
return $costo_total;

}

function calculo_semanas($start_date_project, $finish_date_project){

$datetime1 = new DateTime($start_date_project);
$datetime2 = new DateTime($finish_date_project);
$interval = $datetime1->diff($datetime2);
//echo floor(($interval->format('%a') / 7)) . ' semanas con '. ($interval->format('%a') % 7) . ' dias';
$result= floor(($interval->format('%a') / 7)) . ' semanas con '. ($interval->format('%a') % 7) . ' dias';
return $result;
}



function calculo_total_dias($start_date_project, $finish_date_project){

$start_date_project = strtotime($start_date_project);
$finish_date_project = strtotime($finish_date_project);
$dif = $finish_date_project - $start_date_project;
$diasFalt = (( ( $dif / 60 ) / 60 ) / 24);
return ceil($diasFalt);

}

function calculo_fin_de_semana($start_date_project, $finish_date_project,$project_id){
$id_project=$project_id;
$query1="SELECT * FROM calendar WHERE Project_id_project=$id_project";
$execute1=mysql_query($query1);
$row1=mysql_fetch_array($execute1);
$dia=$row1['start_week'];


if ($dia=="Lunes"){ 
$dia1="Saturday"; 
$dia2="Sunday";
}elseif ($dia=="Martes"){
$dia1="Sunday";
$dia2="Monday";
}elseif ($dia=="Miercoles"){
$dia1="Monday";
$dia2="Tuesday";
}elseif ($dia=="Jueves") {
$dia1="Tuesday";
$dia2="Wednesday";
}elseif ($dia=="Viernes"){
$dia1="Wednesday";
$dia2="Thursday";
}elseif ($dia=="Sabado"){
$dia1="Thursday";
$dia2="Friday";
}elseif ($dia=="Domingo"){
$dia1="Friday";
$dia2="Saturday";
}

$starDate = new DateTime($start_date_project);
$endDate = new DateTime( $finish_date_project);
$cont=0;
//$dias=calculo_total_dias($start_date_project, $finish_date_project);
while( $starDate <= $endDate){
     if($starDate->format('l')== $dia1 || $starDate->format('l')== $dia2){
                    $starDate->format('y-m-d (D)')."<br/>";
                    $cont++;
     }
     $starDate->modify("+1 days");
                
}
//$c=$dias-$cont;
return $cont;
}


function dias_no_laborables($start_date,$finish_date,$project_id){

$id_project=$project_id;
$query1="SELECT * FROM no_works_has_project WHERE Project_id_project = $id_project";
$execute1=mysql_query($query1);
$var1="";
$dias_no_laborables;

    while($row1= mysql_fetch_array($execute1)){
        $var1=$row1['no_works_id_no_works'];
        $query2="SELECT * FROM no_works WHERE id_no_works = $var1";
        $execute2=mysql_query($query2);
        $var2="";
        $cont;
        while($row2 = mysql_fetch_array($execute2)){
                $var2=$row2['start_date_nowork'];
                //echo "<br>";
                //$cont++;
                $start_ts = strtotime($start_date); 
                $end_ts = strtotime($finish_date); 
                $user_ts = strtotime($var2); 
                if(($user_ts >= $start_ts) && ($user_ts <= $end_ts)){
                    $cont++;
                } 

        }
        $dias_no_laborables=$cont;
    }
return $dias_no_laborables;
}

function dias_habiles($start_date_project,$finish_date_project,$project_id){
$query1="SELECT * FROM calendar WHERE Project_id_project=$project_id";
$execute1=mysql_query($query1);
$row1=mysql_fetch_array($execute1);
$dia=$row1['start_week'];

$query6="CALL dias('".$dia."')";
$execute6=mysql_query($query6);
$row6=mysql_fetch_array($execute6); 
$dia1=$row6['dia1'];
$dia2=$row6['dia2'];



$fecha1 = strtotime($start_date_project); 
$fecha2 = strtotime($finish_date_project);
$fecha3; 
$cont;
echo "Dias habiles: <br>";
for($fecha1;$fecha1<=$fecha2;$fecha1=strtotime('+1 day ' . date('Y-m-d',$fecha1))){ 
    if((strcmp(date('l',$fecha1),$dia2)!=0) && (strcmp(date('l',$fecha1),$dia1)!=0)){
        echo date('Y-m-d l',$fecha1) . '<br />'; 
        $fecha3=date('Y-m-d l',$fecha1);
        $cont++;

    }
}  
        return $fecha3.",".$cont;
}



function duracion_dias_habiles($start_date_project,$finish_date_project,$project_id){
$id_project=$project_id;
$query1="SELECT * FROM calendar WHERE Project_id_project=$id_project";
$execute1=mysql_query($query1);
$row1=mysql_fetch_array($execute1);
$dia=$row1['start_week'];

$query6="CALL dias('".$dia."')";
$execute6=mysql_query($query6);
$row6=mysql_fetch_array($execute6); 
$dia1=$row6['dia1'];
$dia2=$row6['dia2'];

$fecha1 = strtotime($start_date_project); 
$fecha2 = strtotime($finish_date_project);
$fecha3; 
$cont;

for($fecha1;$fecha1<=$fecha2;$fecha1=strtotime('+1 day ' . date('Y-m-d',$fecha1))){ 
    if((strcmp(date('l',$fecha1),$dia2)!=1) && (strcmp(date('l',$fecha1),$dia1)!=1)){
        $cont++;
    }
}  
        return $cont;
}



function check_in_range($start_date, $end_date, $evaluame) { 
    $start_ts = strtotime($start_date); 
    $end_ts = strtotime($end_date); 
    $user_ts = strtotime($evaluame); 
    if(($user_ts >= $start_ts) && ($user_ts <= $end_ts)){
        return 1;
    } else{
        return 0;
    }
} 
function costo_padres($project_id){
            $query1="SELECT DISTINCT parent_id FROM activity where parent_id >1 and Project_id_project=$project_id";
            $execute1=mysql_query($query1);
            $var1;
            $var2;
            $var3;
            $costo_padres=0;
                while($row = mysql_fetch_array($execute1)){
                    $var1=$row['parent_id'];
                    $query2="SELECT cost FROM activity WHERE id_tree = $var1 and Project_id_project=$project_id";
                    $execute2=mysql_query($query2);
                    $row2 = mysql_fetch_array($execute2);
                    $var2=$row2['cost'];
                    $var3=$var2+$costo_padres;
                    $costo_padres=$var3;
                }
            $costo_padres;
}

function dias_no_laborables($wbs_id,$project_id){

        $consulta1="SELECT * FROM activity WHERE id_tree=$wbs_id AND Project_id_project=$project_id";
        $execute1=mysql_query($consulta1);
        $row1=mysql_fetch_array($execute1);

        $consulta2="SELECT no_works_id_no_works from no_works_has_project where Project_id_project=$project_id";
        $execute2=mysql_query($consulta2);
        $var2;

            //listamos todos los dias no laborables
            while($row = mysql_fetch_array($execute2)){
                    $var2=$row['no_works_id_no_works'];
                    $consulta3="SELECT * FROM no_works WHERE  id_no_works=$var2 and id_project = $project_id ";
                    $execute3=mysql_query($consulta3);
                    $start_date_noworks;
                    $finish_date_noworks;
                    while($row2 = mysql_fetch_array($execute3)){
                        echo $start_date_noworks=$row2['start_date_noworks'];
                        echo "<br>";
                        echo$finish_date_noworks=$row2['finish_date_noworks'];
                        echo "<br>";
                        //---//
                        //start_date_nowork <= '2015-09-30' and finish_date_noworks >= '2015-09-30'
                        if($row1['start_date']<=$start_date_noworks && $row1['finish_date']>=$finish_date_noworks){
                            echo "aqui hay dias no laborables";
                        }else{
                            echo "no hay";
                        }
                        
                        //---//
            }
        }
                    
}

include_once("../db.php");

//RESULTADOS: 

echo "id del proyecto: ".$id_project=6;
echo "<br>";
echo "Duracion: ".$duracion=3;
echo "<br>";
echo "fecha de inicio: ".$start_date_project='2015-09-17';
echo "<br>";
echo "fecha de fin: ".$finish_date_project='2015-09-20';
echo "<br>";
echo "Inicio fecha a verificar: ".$inicio_check='2015-09-13';
echo "<br>";
echo "Fin fecha a verificar: ".$fin_check='2015-09-14';
echo "<br>";
echo "-------------------------";
echo "<br>";



echo "<br>";
$dias=calculo_total_dias($start_date_project, $finish_date_project);
echo "Total de dias: ".$dias;
echo "<br>";
$semanas=calculo_semanas($start_date_project,$finish_date_project);
echo "Cantidad de semanas: ".$semanas;
echo "<br>";
$fin_de_semana=calculo_fin_de_semana($start_date_project, $finish_date_project,$id_project);
echo "Cantidad de fines de semana: ".$fin_de_semana;
echo "<br>";
$check_in_range=check_in_range($start_date_project,$finish_date_project,$inicio_check);
echo "check in range: ".$check_in_range;
echo "<br>";
$no_laborales=dias_no_laborables($id_project);
echo "dias no laborables: ".$no_laborales;
echo "<br>";
$costo_total=calculo_costo_total($id_project);
echo "Costo total: ".$costo_total;
echo "<br>";
$dur=duracion_dias_habiles($start_date_project,$finish_date_project,$id_project);
echo "Duracion dias habiles: ".$dur;
echo "<br>";
echo dias_habiles($start_date_project,$finish_date_project,$id_project);
echo "<br>";
dias_no_laborables(11,$id_project);
echo "<br>";






?>