<?php
include_once("../db.php");

$query="SELECT * FROM project WHERE id_project_user=1";
$execute=mysql_query($query);
$row=mysql_fetch_assoc($execute);
while($row = mysql_fetch_array($execute)){
	if($row['id_project']==$_GET['id']){

	}else{
		
	}
}
?>