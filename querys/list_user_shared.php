<?php
include ('db.php');
$id_project_shared=$_GET['id'];
$query1="SELECT user_cod_user FROM project_has_user WHERE Project_id_project = $id_project_shared";
$execute1=mysql_query($query1);
$var1="";

while($row = mysql_fetch_array($execute1)){
	$var1=$row['user_cod_user'];
	$query2="SELECT * FROM user WHERE cod_user = $var1";
	$execute2=mysql_query($query2);
	$var2="";
	while($row2 = mysql_fetch_array($execute2)){
			$var2=$row2['email_user'];
			$id_user=$row2['cod_user'];	
			echo "<a href='#modal6'><img width='35' height='35' src='images/usuario1.png'>".$var2.""."</a>&nbsp;&nbsp;&nbsp;<a href='querys/delete_shared_users.php?id=$id_user'><img width='15' height='20'src='images/file_delete.png'></a>&nbsp;&nbsp;&nbsp;<br>";
		}
}

?>