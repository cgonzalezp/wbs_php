<script>
function confirmDel(idd)
{
  var agree=confirm("¿Realmente desea eliminarlo? ");
  if (agree){
  	//alert(idd);
  	document.location.href='querys/delete_project.php?id='+idd;
  	//return true ;
  }else{
  return false;
}
}
</script>
<?php
include ('db.php');

$consulta1="SELECT * FROM user WHERE email_user='".$_SESSION['user']."'";
$execute1=mysql_query($consulta1);
$var1="Vacio";// tendra el cod_user.

if($row = mysql_fetch_array($execute1)){
		$var1=$row['cod_user']; //asignamos el cod_user.
}

$consulta2="SELECT Project_id_project FROM project_has_user WHERE user_cod_user = $var1 ";
$execute2=mysql_query($consulta2);
$var2="vacio";


//listamos todos los proyectos
while($row = mysql_fetch_array($execute2)){
		$var2=$row['Project_id_project'];
		$consulta3="SELECT * FROM project WHERE id_project = $var2 ";
		$execute3=mysql_query($consulta3);
		$var3="vacio";
		while($row2 = mysql_fetch_array($execute3)){
			$var3=$row2['name_project'];
			$id_project=$row2['id_project'];
			//echo "<a href='querys/active_project.php?id=$id_project'><img src='images/wbs-icon.png'>".$var3.""."</a>&nbsp;&nbsp;&nbsp;<a href=?id=$id_project#modal5><img width='15' height='20'src='images/edit_project.png'></a>&nbsp;&nbsp;&nbsp;<a href='querys/delete_project.php?id=$id_project'><img width='15' height='20'src='images/file_delete.png'></a>&nbsp;&nbsp;&nbsp;<a href='?id=$id_project#modal6'><img width='15' height='20'src='images/shared_project.png'></a><br>";
			echo "<a href='querys/active_project.php?id=$id_project'><img src='images/wbs-icon.png'>".$var3.""."</a>&nbsp;&nbsp;&nbsp;<a href=?id=$id_project#modal5><img width='15' height='20'src='images/edit_project.png'></a>&nbsp;&nbsp;&nbsp;<a  href='#modal1' onClick='javascript: confirmDel(".$id_project.");'><img width='15' height='20'src='images/file_delete.png'></a>&nbsp;&nbsp;&nbsp;<a href='?id=$id_project#modal6'><img width='15' height='20'src='images/shared_project.png'></a><br>";
			//echo "<a href='querys/active_project.php?id=$id_project'><img src='images/wbs-icon.png'>".$var3.""."</a>&nbsp;&nbsp;&nbsp;<a href=?id=$id_project#modal5><img width='15' height='20'src='images/edit_project.png'></a>&nbsp;&nbsp;&nbsp;<a  href='querys/wewe.php' onClick='javascript: return confirm('¿Estas seguro?');'><img width='15' height='20'src='images/file_delete.png'></a>&nbsp;&nbsp;&nbsp;<a href='?id=$id_project#modal6'><img width='15' height='20'src='images/shared_project.png'></a><br>";

		}
}


?>