<!doctype html>
<html>
<head>
</head>
<meta charset="utf-8">
<title>Editar Proyecto</title>
<script>
	
	$.ajax({
	url: 'querys/getdata_editproject.php',
	type: 'POST',
	dataType: 'json',
	data: { number: 1 }
	})
	.done(function(resp) {
		console.log("success");
		//comentar el dataType//alert(resp);	
		$("#new_name_project").val(resp.name_project);	
		$("#edit_start_date").val(resp.start_date_project);
		$("#edit_finish_date").val(resp.finish_date_project);
		//alert(document.getElementById("nameproject").value);
	})
	.fail(function() {
		console.log("error");
	});
</script>
<body>

<div id="contenedor">
<h1><strong><br>Editar Proyecto</br>
</strong></h1>
<div id="cuerpo">
<form id="editproject" name="editproject" method="post" action="querys/edit_project.php">
<fieldset>
<table width="374">

<tr>
	<td width="262"><label><strong>Nombre del Proyecto</strong></label></td>
  	<td width="100"><input type="text" title="nombre del proyecto" name="new_name_project" id="new_name_project" required></imput></td>
</tr>
<tr>
	<td width="262"><label><strong>Fecha de inicio</strong></label></td>
  	<td width="100"><input type="date" title="fecha de inicio del proyecto" name="edit_start_date" id="edit_start_date" required></imput></td>
</tr>
<tr>
	<td width="262"><label><strong>Fecha de fin</strong></label></td>
  	<td width="100"><input type="date" title="fecha de fin del proyecto" name="edit_finish_date" id="edit_finish_date" required></imput></td>
</tr>
<tr>
	<td><input type="submit" name="enviar" id="enviar" value="Aceptar" />
	<a href="querys/edit_project.php"><input type="reset" name="borrar" id="borrar" value="Borrar campos" /></td>
</tr>

</table>
</fieldset>
</form>
</div>
</div>
</body>
</html>
