<?php
include ('users/seguridad.php');
session_start();
?>
<?php
include_once ("db.php");



$data = json_decode (stripslashes($_REQUEST['data']));
$id_project=$_SESSION['id'];
$name_user=$_SESSION['user'];
$Project_id_project=$id_project;
$duracion=0; 

if($data->action == 'edit') {
	
		mysql_query("UPDATE activity SET name='".$data->html."', hide='".$data->showhideval."', cost='".$data->cost."', predecessors='".$data->predecessors."', duration='".$data->duration."', start_date='".$data->start_date."', finish_date='".$data->finish_date."' WHERE id_tree='".$data->id."' and Project_id_project='".$Project_id_project."'");
		$query="SELECT * FROM activity WHERE id_tree='".$data->parentid."' AND Project_id_project='".$Project_id_project."'";
		$execute=mysql_query($query);
		$row=mysql_fetch_array($execute);
		$padre=$row['parent_id'];
		if($row['children_finish_date'] >= $data->finish_date){
			mysql_query("UPDATE activity SET children_finish_date='".$row['children_finish_date']."' WHERE id_tree='".$padre."' AND Project_id_project='".$Project_id_project."'");
		}else{
			mysql_query("UPDATE activity SET children_finish_date='".$data->finish_date."' WHERE id_tree='".$padre."' AND Project_id_project='".$Project_id_project."'");
		}
		$costo=$row['children_cost']+$data->cost;
		mysql_query("UPDATE activity SET children_cost='".$costo."' WHERE id_tree='".$padre."' AND Project_id_project='".$Project_id_project."'");

} elseif($data->action == 'delete') {
	
		$query="SELECT * FROM activity WHERE id_tree='".$data->id."' AND Project_id_project='".$Project_id_project."'";
		$execute=mysql_query($query);
		$row=mysql_fetch_array($execute);
		$costo_actividad=$row['cost'];//costo de la actividad.
		$padre=$row['parent_id']; //padre de la actividad.
		mysql_query("DELETE FROM activity WHERE id_tree in(".$data->id.") and Project_id_project='".$Project_id_project."'");
		$query2="SELECT * FROM activity WHERE parent_id='".$padre."' AND Project_id_project='".$Project_id_project."'";
		$execute2=mysql_query($query2);
		$row2=mysql_fetch_array($execute2);
		$costo_hijos=$row2['children_cost'];//costo de los hijos.

		if($row2['cost']==''){
			$nuevo_costo=0;
			$children_finish_date='0000-00-00';
		}else{
			$nuevo_costo=$costo_actividad-$costo_hijos;
		}
		mysql_query("UPDATE activity SET children_cost='".$nuevo_costo."', children_finish_date='".$children_finish_date."' WHERE id_tree='".$padre."' AND Project_id_project='".$Project_id_project."'");

} elseif($data->action == 'add') {

		if($data->predecessors==""){
			$data->predecessors='null';
		}elseif($data->start_date==""){
			$data->start_date='0000-00-00';
		}elseif($data->finish_date==""){
			$data->finish_date='0000-00-00';
		}
		//VERIFICAR
		//elseif($data->duration==""){
			//$data->duration=0;
		//}


		mysql_query("INSERT INTO activity (id_tree, name, parent_id, hide,id_wbs,cost,predecessors,duration, start_date,Project_id_project, finish_date) VALUES (".$data->id.", '".$data->html."', ".$data->parentid.", ".$data->showhideval.",".$data->id.",".$data->cost.",".$data->predecessors.",".$data->duration.",'".$data->start_date."',".$Project_id_project.",'".$data->finish_date."')");

		$query="SELECT children_cost,children_finish_date FROM activity WHERE id_tree='".$data->parentid."' AND Project_id_project='".$Project_id_project."'";
		$execute=mysql_query($query);
		$row=mysql_fetch_array($execute);


		
		if($row['children_finish_date'] >= $data->finish_date){
			mysql_query("UPDATE activity SET children_finish_date='".$row['children_finish_date']."' WHERE id_tree='".$data->parentid."' AND Project_id_project='".$Project_id_project."'");
		}else{
			mysql_query("UPDATE activity SET children_finish_date='".$data->finish_date."' WHERE id_tree='".$data->parentid."' AND Project_id_project='".$Project_id_project."'");
		}

		$costo=$row['children_cost']+$data->cost;
		mysql_query("UPDATE activity SET children_cost='".$costo."' WHERE id_tree='".$data->parentid."' AND Project_id_project='".$Project_id_project."'");

		

}elseif($data->action == 'drag') {

		mysql_query("UPDATE activity SET id_tree='".$data->new_id."', id_wbs='".$data->new_id."' , parent_id='".$data->parentid."' WHERE id_tree='".$data->id."' and Project_id_project='".$Project_id_project."'");

		$query="SELECT * FROM activity WHERE id_tree='".$data->new_id."' AND Project_id_project='".$Project_id_project."'";
		$execute=mysql_query($query);
		$row=mysql_fetch_array($execute);


		
		if($row['children_finish_date'] >= $row['finish_date']){
			mysql_query("UPDATE activity SET children_finish_date='".$row['children_finish_date']."' WHERE id_tree='".$data->parentid."' AND Project_id_project='".$Project_id_project."'");
		}else{
			mysql_query("UPDATE activity SET children_finish_date='".$row['finish_date']."' WHERE id_tree='".$data->parentid."' AND Project_id_project='".$Project_id_project."'");
		}

		$costo=$row['children_cost']+$row['cost'];
		mysql_query("UPDATE activity SET children_cost='".$costo."' WHERE id_tree='".$data->parentid."' AND Project_id_project='".$Project_id_project."'");

		
}

mysql_close($con);
?>