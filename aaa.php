<?php
include('db.php');

echo duracion_proyecto(9);

function duracion_proyecto($project_id){
            

            $queryy="SELECT id_tree FROM activity WHERE Project_id_project=$project_id";
            $executee=mysql_query($queryy);
            $cont_hijos_temp=0;
            $cont_hijos=0;

            while($roww=mysql_fetch_array($executee)){
                $query0="SELECT is_father_func(".$roww['id_tree'].",$project_id) as father";
                $execute0=mysql_query($query0);
                $row0=mysql_fetch_array($execute0);
                $is_father=$row0['father'];
                if($is_father==0){
                    $cont_hijos++;
                   
                }


            }
            echo "Contador_hijos: ".$cont_hijos;//ok
            echo "<br>";

            $query1="SELECT DISTINCT parent_id FROM activity where parent_id>1 and Project_id_project=$project_id";
            $execute1=mysql_query($query1);
            $id_padres;
            $dur_padres;
            $cantidad_padres=0;
            $temp;
            $dur_total_padres=0;
            while($row = mysql_fetch_array($execute1)){
                    $id_padres=$row['parent_id'];
                    $cantidad_padres++;
                    $query2="SELECT duration FROM activity WHERE id_tree = $id_padres and Project_id_project=$project_id";
                    $execute2=mysql_query($query2);
                    $row2 = mysql_fetch_array($execute2);
                    $dur_padres=$row2['duration'];
                    $temp=$dur_padres+$dur_total_padres;
                   $dur_total_padres=$temp;
             }
           echo "duracion total padres: ".$dur_total_padres;//fail
           echo "<br>";
           echo "Cantidad de padres: ".$cantidad_padres;//ok
           echo "<br>";
        }
?>