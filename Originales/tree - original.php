<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>WBS Tree</title>
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Cabin:400,700,600"/>
        <link href="style.css" rel="stylesheet" type="text/css">
        <script src="js/jquery-1.8.1.min.js"></script>
        <script src="js/jquery-ui.js"></script>
        <script src="js/jquery.tree.js"></script>
	    <script>
            $(document).ready(function () {
                $('.tree').tree_structure({
                    'add_option': true,
                    'edit_option': true,
                    'delete_option': true,
                    'confirm_before_delete': true,
                    'animate_option': [true, 5],
                    'fullwidth_option': false,
                    'align_option': 'center',
                    'draggable_option': true
                });
            });
        </script>
    </head>
    <body>


        <?php
        include_once "db.php";
        $store_all_id = array();
		//$Project_id_project=$_GET['id'];
		//echo $Project_id_project; 
        $id_result = mysql_query("SELECT * FROM activity");
        while ($all_id = mysql_fetch_array($id_result)) {
            array_push($store_all_id, $all_id['parent_id']);
        }
        echo "<div class='overflow'><div>";
        in_parent(0, $store_all_id);
        echo "</div></div>";
		
        function in_parent($in_parent, $store_all_id) {
            if (in_array($in_parent, $store_all_id)) {
				
				$result = mysql_query("SELECT * FROM activity where parent_id = " . $in_parent . " and Project_id_project='".$_GET['id']."'");
                //$result = mysql_query("SELECT * FROM activity where parent_id = " . $in_parent . " and Project_id_project='1'");

                echo $in_parent == 0 ? "<ul class='tree'>" : "<ul>";

                while ($row = mysql_fetch_array($result)) {

                    $wbs_id = $row['id_wbs'];
                    $conca = "";
                    for ($i = 0; $i <= strlen($wbs_id) - 1; $i++) {
                        if ($i == (strlen($wbs_id) - 1)) {
                            $conca = $conca . $wbs_id[$i];
                        } else {
                            $conca = $conca . $wbs_id[$i] . '.';
                        }
                    }
                    
                    $result2="select sum(cost) from activity where id_wbs=$wbs_id or parent_id=$wbs_id";
                    //$result2 = "call calculo_costo(" . $wbs_id . ")";//revisar
                    $execute2 = mysql_query($result2);
                    $row2 = mysql_fetch_assoc($execute2);

                    echo "<li";
                    if ($row['hide'])
                        echo " class='hide'";
                    //ORIGINAL//echo "><div id=".$row['id'].">" . $row['name'] . "</div>";
                    echo "><div id=" . $row['id_tree'] . ">" . '<p>' . $conca . ' - ' . $row['name'] . '</p>' . '<p>' . 'Costo: $' . $row2['sum(cost)'] . '</p>' . '<p>' . 'Fecha de inicio: ' . $row['start_date'] . '</p>' . "</div>";
                    //echo "><div id=" . $row['id_tree'] . ">" . '<p>' . $conca . ' - ' . $row['name'] . '</p>' . '<p>' . 'Costo: $' . $row2['costo_base'] . '</p>' . '<p>' . 'Fecha de inicio: ' . $row['start_date'] . '</p>' . "</div>";
                    //echo "><div id=" . $row['id_tree'] . ">" . $conca . ' - ' . $row['name'] . 'Costo: $' . $row2['sum(cost)'] . 'Fecha de inicio: ' . $row['start_date'] . "</div>"; 
                    mysql_free_result($execute2);//revisar
                    $result2=null;//revisar
                    in_parent($row['id_tree'], $store_all_id);
                    
                    //echo $row['id_tree'];
                    
                    echo "</li>";

                }
                echo "</ul>";
            }
        }
        mysql_close($con);
        ?>
    </body>
</html>