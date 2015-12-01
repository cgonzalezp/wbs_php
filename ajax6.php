<?php
include ('users/seguridad.php');
session_start();
?>
<?php
include_once ("db.php");
$project_id=$_SESSION['id'];


	get_data($project_id);

function get_data($project_id){
	

	$query="SELECT * FROM calendar WHERE Project_id_project=$project_id";
	$execute=mysql_query($query);
	$row=mysql_fetch_object($execute);
	$jsondata['start_week']= $row->start_week;
	$jsondata['start_fiscalyear']= $row->start_fiscalyear;
	$jsondata['start_hours']= $row->start_hours;
	$jsondata['end_hours']= $row->end_hours;
	$jsondata['start_workday_hours']= $row->start_workday_hours;
	$jsondata['workweek']= $row->workweek;
	$jsondata['days_for_month']= $row->days_for_month;

	echo json_encode($jsondata);
}





?>