<?php
include ('db.php');

$id_project=$_GET['id'];
$query1="SELECT * FROM no_works_has_project WHERE Project_id_project = $id_project";
$execute1=mysql_query($query1);
$var1="";
$idnoworks;

while($row = mysql_fetch_array($execute1)){
	$var1=$row['no_works_id_no_works'];
	$query2="SELECT * FROM no_works WHERE id_no_works = $var1";
	$execute2=mysql_query($query2);
	$var2="";
	while($row2 = mysql_fetch_array($execute2)){
			$var2=$row2['name_date_nowork'];
			$idnoworks=$row2['id_no_works'];	
			echo "<a href='#modal2'><img width='35' height='35' src='images/dias.png'>".$var2.""."</a>&nbsp;&nbsp;&nbsp;<a href='querys/delete_days.php?id2=$idnoworks'><img width='15' height='20'src='images/file_delete.png'></a><br>";
			//echo "<a href='querys/active_project.php?id=$id_project'><img src='images/wbs-icon.png'>".$var2.""."</a>&nbsp;&nbsp;&nbsp;<a href=?id=$id_project#modal5><img width='15' height='20'src='images/edit_project.png'></a>&nbsp;&nbsp;&nbsp;<a href='querys/delete_project.php?id=$id_project'><img width='15' height='20'src='images/file_delete.png'></a>&nbsp;&nbsp;&nbsp;<a href='?id=$id_project#modal6'><img width='15' height='20'src='images/shared_project.png'></a><br>";
		}
}

?>
