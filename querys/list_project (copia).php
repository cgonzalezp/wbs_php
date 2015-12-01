<?php
include ('db.php');

$consulta1="SELECT * FROM user WHERE email_user='".$_SESSION['user']."'";
$execute1=mysql_query($consulta1);
$var1="Vacio";// tendra el cod_user.

if($row = mysql_fetch_array($execute1)){
		$var1=$row['cod_user']; //asignamos el cod_user.
}

$consulta2="SELECT * FROM project WHERE id_project_user = $var1 ";
$execute2=mysql_query($consulta2);
$var2="vacio";
$id_project;

//listamos todos los proyectos del usuario
while($row = mysql_fetch_array($execute2)){
		$var2=$row['name_project'];	
		$id_project=$row['id_project'];
		//echo "<a href='querys/active_project.php?id=$id_project'><img src='images/wbs-icon.png'>".$var2." "."</a><br>";
		echo "<a href='querys/active_project.php?id=$id_project'><img src='images/wbs-icon.png'>".$var2.""."</a>&nbsp;&nbsp;&nbsp;<a href=?id=$id_project#modal5><img width='15' height='20'src='images/edit_project.png'></a>&nbsp;&nbsp;&nbsp;<a href='querys/delete_project.php?id=$id_project'><img width='15' height='20'src='images/file_delete.png'></a>&nbsp;&nbsp;&nbsp;<a href='?id=$id_project#modal6'><img width='15' height='20'src='images/shared_project.png'></a><br>";
		//echo "<img width='15' height='20'src='images/edit_project.png'>";

		//no borrar//echo "<a href='index2.php?id=$id_project'><img src='images/wbs-icon.png'>".$var2." "."</a><br>";
}

		//mysql_query("UPDATE project SET active=0 where id_project=".$id_antiguo."");
		//mysql_query("UPDATE project SET active=1 where id_project=".$id_project."");
?>