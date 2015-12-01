<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Menu</title>

<!--Ventanas Modales-->
<link href="css/modal_windows.css" rel="stylesheet" type="text/css">
<!--Ventanas Modales-->

<!--Menu-->
<link href="css/menu.css" rel="stylesheet" type="text/css">
<script language="javascript" src="js/menu.js"></script>
<script type="text/javascript" src="js/export.js"></script>
<script>
function mainmenu(){ //Oculto los submenus 
$(" #nav ul ").css({display: "none"}); // Defino que submenus deben estar visibles cuando se pasa el mouse por encima 
$(" #nav li").hover(function(){   
$(this).find('ul:first:hidden').css({visibility: "visible",display: "none"}).slideDown(400);    },
function(){      
$(this).find('ul:first').slideUp(400);  }); } 
$(document).ready(function(){     mainmenu(); });
</script>
<!--Menu-->

<!--Canvas-->
<script language="javascript">
    
function guardarcomo (){
var canvas = document.querySelector("canvas");
var ctx = canvas.getContext("2d");
var ctx = canvas.getContext('2d');

 	  html2canvas(document.querySelector("#overflow"), {
                onrendered: function(canvas) {
                window.open(document.querySelector('#overflow').appendChild(canvas).toDataURL()).focus();
                //window.open(document.querySelector('#overflow').appendChild(canvas).toDataURL(),"imagen").focus();
                //document.querySelector("#overflow").appendChild(canvas);
                location.reload();
               
        }
        });
      
        };
</script>
<!--Canvas-->

<!--Reload-->
<script>
function reloadFunction() {
    location.reload();
}
</script>
<!--Reload-->

</head>

<body>
<?php include ('users/seguridad.php');?>
<?php define ('BASE_URL','http://localhost/wbs_php/');?>

<!--MENU-->
<div id="menu">
<ul id="nav">
	<!--<li><a href="<?php //echo BASE_URL?>">Proyecto de tesis WBS</a></li>-->
	<li><a href="#">Proyecto de tesis WBS</a></li>
    <li><a href="#">Archivo</a>
<ul class="submenu">
    <li><a href="#modal4">Nuevo</a></li>
    <li><a href="#modal1" >Mis Proyectos</a></li>
	<li><a href="javascript:guardarcomo()">Guardar como...</a></li>
</ul>
</li>
    <li><a href="#">Ajustes</a>
<ul class="submenu">
    <li><a href="#">Configuraciones</a>
<ul class="subsubmenu">
    <li><a href="#modal3" >Ajustes de calendario</a></li>
    <li><a href="#modal2">Dias no laborables</a></li>
</ul>
</li>
    <li><a href="#modal5">Editar Proyecto</a></li>
    <li><a href="querys/delete2_project.php" onClick="javascript: return confirm('¿Realmente desea eliminarlo? ');">Eliminar Proyecto</a></li>
    
</ul>
</li>
<!--<ul class="submenu">
 
</ul>-->
</li>
    <li><a href="users/salir.php"> Cerrar sesion (<?php echo $_SESSION['user'];?>)</a></li>
</ul>

</div>
<!--MENU-->


<!-- Ventana Modal Lista de proyectos-->
<div id="modal1" class="modalmask">
		<div class="modalbox movedown">
			<a href="#close" title="Close" class="close">X</a>
			<h2>Lista de proyectos:</h2>
			<p><?php include ('querys/list_project.php');?></p>
			<p>..........................</p>

		</div>
	</div>

<!-- Ventana Modal dias no laborables-->    
<div id="modal2" class="modalmask">
		<div class="modalbox2 movedown">
			<a href="#close" title="Close" class="close">X</a>
			<h2>Días no laborables:</h2>
			<!--<script>location.reload();</script>-->
			<p><?php include_once ("querys/list_days_no_work2.php");?></p>
			<p><?php include_once ("forms/days_no_work_form.php");?></p>
			<p>..........................</p>

		</div>
	</div>

<!-- Ventana Modal ajustes de calendario-->
    <div id="modal3" class="modalmask">
		<div class="modalbox movedown">
			<a href="#close" title="Close" class="close">X</a>
			<h2>Ajustes de calendario:</h2>
			<p><?php include_once("forms/date_form.php"); ?></p>
			<p>..........................</p>

		</div>
	</div>

	<!-- Ventana Modal Nuevo proyecto-->
	<div id="modal4" class="modalmask">
		<div class="modalbox movedown">
			<a href="#close" title="Close" class="close">X</a>
			<h2>Creación de proyecto:</h2>
			<p><?php include_once("forms/new_project.php");?></p>
			<p>..........................</p>

		</div>
	</div>

	<!-- Ventana Modal edicion de proyecto-->
	<div id="modal5" class="modalmask">
		<div class="modalbox movedown">
			<a href="#close" title="Close" class="close">X</a>
			<h2>Edición de proyecto:</h2>
			<p><?php include_once("forms/edit_Project.php");?></p>
			<p>..........................</p>

		</div>
	</div>

	<!-- Ventana Modal Compartir proyecto-->
	<div id="modal6" class="modalmask">
		<div class="modalbox movedown">
			<a href="#close" title="Close" class="close">X</a>
			<h2>Lista de usuarios:</h2>
			<p><?php include_once("querys/list_user_shared.php");?></p>
			<p><?php include_once("forms/shared_form_project.php");?></p>
			<p>..........................</p>
		</div>
	</div>

	<!-- Ventana Modal exportar a imagen-->
	<div id="modal7" class="modalmask">
		<div class="modalbox movedown">
			<a href="#close" title="Close" class="close">X</a>
			<h2>Guardar proyecto como:</h2>
			<p><?php include_once("forms/export.php");?></p>
			<p>..........................</p>

		</div>
	</div>
<!--Ventana Modal-->

 	

  

</body>
</html>
