<?php
include ('users/seguridad.php');
session_start();
?>
<?php
include_once('db.php');
$data=$_POST['number'];
$id_project=$_SESSION['id'];

//echo "Actividad numero: ".$data;
$query="SELECT * FROM project WHERE id_project=$id_project";
$execute=mysql_query($query);
$row=mysql_fetch_object($execute);
	
$jsondata['name_project']= $row->name_project;
$jsondata['start_date_project']= $row->start_date_project;
$jsondata['finish_date_project']=$row->finish_date_project;

echo json_encode($jsondata);


?>