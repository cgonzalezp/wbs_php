<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>WBS Tree</title>
        <link rel="shortcut icon" type="image/x-icon" href="/wbs_php/images/favicon.ico">
        <!--<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Cabin:400,700,600"/>-->
        <link rel="stylesheet" type="text/css" href="css/font.css"/>
        <link href="style.css" rel="stylesheet" type="text/css">
        <script src="js/jquery-1.8.1.min.js"></script>
        <script src="js/jquery-ui.js"></script>
        <script src="js/jquery.tree.js"></script>
 
        <script>
            $(document).ready(function () {
                $('.tree').tree_structure({
                    'add_option': true,
                    'edit_option': true,
                    'delete_option': true,
                    'confirm_before_delete': true,
                    'animate_option': [true, 5],
                    'fullwidth_option': false,
                    'align_option': 'center',
                    'draggable_option': true
                });
            });
        </script>
    </head>
    <body>


        <?php
        include_once ("db.php");
        //require ("calendar/calculo_semanas.php");
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
                //$cont_hijos;
           return $dur_total_padres+$cantidad_padres;
        }

        function duracion_padres($project_id){
            $query1="SELECT DISTINCT id_tree FROM activity where parent_id =1 and Project_id_project=$project_id";
            $execute1=mysql_query($query1);
            $var1;
            $var2;
            $var3;
            $costo=0;
            while($row = mysql_fetch_array($execute1)){
                    $var1=$row['id_tree'];
                    $query2="SELECT duration FROM activity WHERE id_tree = $var1 and Project_id_project=$project_id";
                    $execute2=mysql_query($query2);
                    $row2 = mysql_fetch_array($execute2);
                    $var2=$row2['duration'];
                    $var3=$var2+$costo;
                   $costo=$var3;
                }
           return $costo;
        }
        $store_all_id = array();
        
        $id_result = mysql_query("SELECT * FROM activity");
        while ($all_id = mysql_fetch_array($id_result)) {
          
            array_push($store_all_id, $all_id['parent_id']);

        }
        echo "<div class='overflow' id='overflow'><div>";
        in_parent(0, $store_all_id);
        echo "</div></div>";     


        function in_parent($in_parent, $store_all_id) {
            if (in_array($in_parent, $store_all_id)) {
                
                $result = mysql_query("SELECT * FROM activity where parent_id = " . $in_parent . " and Project_id_project='". $_GET['id'] ."'");
                
                $project_selected=$_GET['id'];
                echo $in_parent == 0 ? "<ul class='tree'>" : "<ul>";
                
                while ($row = mysql_fetch_array($result)) {
                    $project_id=$row['Project_id_project'];
                    $wbs_id = $row['id_wbs'];

                    $start_date=$row['start_date'];
                    $finish_date=$row['finish_date'];
                    $duration=$row['duration'];
                    $costo_propio=$row['cost'];

                               
                    
                    $conca = "";
                    for ($i = 0; $i <= strlen($wbs_id) - 1; $i++) {
                        if ($i == (strlen($wbs_id) - 1)) {
                            $conca = $conca . $wbs_id[$i];
                        } else {
                            $conca = $conca . $wbs_id[$i] . '.';
                        }
                    }
                   

                    $query0="SELECT is_father_func($wbs_id,$project_id) as father";
                    $execute0=mysql_query($query0);
                    $row0=mysql_fetch_array($execute0);
                    $is_father=$row0['father'];


                    //Calculo Costos
                    $costo=0;
                    
                    $query_1="SELECT sum(cost) from activity where id_tree like '".$wbs_id."%' AND Project_id_project=$project_id";

                    $execute_1 = mysql_query($query_1);
                    $row_1=mysql_fetch_assoc($execute_1);
                    $costo_total=$row_1['sum(cost)'];
//                  echo $costo_total; //VERIFICAR
                    
                    $cost=$costo_total;

                                       
                   if($wbs_id==1){
                            $cost;
                    }
                    //calculo costo.
                    





                    //calculo fechas
                    $dias=0;
                    $x=dias_no_laborables($row['start_date'],$row['finish_date'],$project_id);//calcula los dias no laborables.
                    duracion_proyecto($project_id);
                   

                   $_SESSION['id']=$_REQUEST['id'];

                   
                $query="select is_father_func('".$wbs_id."','".$project_id."')as resultado";
				$execute=mysql_query($query);
				$row1=mysql_fetch_array($execute);
                $var=$row1['resultado'];//identifica si es padre 1 o 0.

                //echo $duracion_pro=duracion_proyecto($project_id);
                $duracion_padres=duracion_padres($project_id);//retorna la duracion de los padres (hijos del 1)
                //echo  $duracion_padres;
                
                   if($var==1){//si es padre... trae la duracion total de sus hijos 
                    $query_2="SELECT sum(duration) as duracion_total from activity where parent_id=".$wbs_id." AND Project_id_project=$project_id";
                    $execute_2=mysql_query($query_2);
                    $row_2=mysql_fetch_array($execute_2);
                    $duracion_total=$row_2['duracion_total'];
                    $dias=$duracion_total;
                    
                   }else{//si no es padre... trae su duracion propia.
                    $query_2="SELECT duration as duracion_propia from activity where id_tree=".$wbs_id." AND Project_id_project=$project_id";
                    $execute_2=mysql_query($query_2);
                    $row_2=mysql_fetch_array($execute_2);
                    $duracion_propia=$row_2['duracion_propia'];
                    $dias=$duracion_propia;
                   }
                    $total_dias=$dias;
                    $dias=$total_dias-$x; //a la duracion total se le restan los dias no laborables.

                    if($wbs_id==1){//si la actividad es la general(id=1), se trae la suma de todas las duraciones.
                        $query_9="SELECT sum(duration) as duracion_total from activity where Project_id_project=$project_id";
                        $execute_9=mysql_query($query_9);
                        $row_9=mysql_fetch_array($execute_9);
                        $duracion_total9=$row_9['duracion_total'];
                        $dias=$duracion_total9;
                        //$dias=duracion_proyecto($project_id);
                    }


                    echo "<li";
                    if ($row['hide'])
                        echo " class='hide'";
                    echo "><div father=".$var."  id=" . $row['id_tree'] . ">" . '<p>' . $conca . ' - ' . $row['name'] . '</p>' . '<p>' . 'Costo: $' . $cost . '</p>' . '<p>' . 'Duracion (dias): ' . $dias .'</p>'."</div>";
						
                   
                    
                    in_parent($row['id_tree'], $store_all_id);                 
                    echo "</li>";  
                }
                echo "</ul>";      
            }
        }

        ?>
       
        
    </body>
</html>