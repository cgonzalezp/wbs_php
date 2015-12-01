
<!doctype html>
<html>
<meta charset="utf-8">
<head>
<?php
include_once('../db.php');

function cal_cost($id_activity) {
$query="SELECT * FROM activity WHERE Project_id_project=$id_activity";
$execute=mysql_query($query);
$row=mysql_fetch_assoc($execute);
while($row = mysql_fetch_array($execute2)){
	echo "Contenido de la actividad: ".$row['name'];
}
}

?>
</head>
<body>
	<table>
		<tr>
			<td>
			<?php include_once('../db.php'); 
			cal_cost(1) 
			?>	
			</td>
		</tr>
	</table>
</body>
</html>