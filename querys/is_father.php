<?php
include_once('db.php');
$id_father=$_POST['id_father'];
$id_project=$_POST['id'];



process2($id_father,$id_project);

function process2($id_father,$id_project){

	$query="CALL is_father($id_father,$id_project)";
	$execute=mysql_query($query);
	$row=mysql_fetch_object($execute);
	$jsondata['resultado']= $row->resultado;
	echo json_encode($jsondata);
}
?>