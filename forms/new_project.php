<!doctype html>
<html>
<head>
</head>
<meta charset="utf-8">
<title>Nuevo Proyecto</title>
<body>

<div id="contenedor">
<h1><strong><br>Nuevo Proyecto</br>
</strong></h1>
<div id="cuerpo">
<form id="newproject" name="newproject" method="post" action="querys/new_project.php">
<fieldset>
<table width="374">
<tr>
<br/>
	<td width="262"><label><strong>Nombre del Proyecto nuevo </strong></label></td>
  		<td width="100">
			<input type="text" name="nameproject" id="nameproject" required></imput>

		</td>

</tr>

<tr>

	<td>
		<br/>
	<input type="submit" name="enviar" id="enviar" value="Aceptar" /><a href="../querys/new_project.php">
  <input type="reset" name="borrar" id="borrar" value="Borrar campos" />
	</td>
</tr>

</table>
</fieldset>
</form>
</div>
</div>
</body>
</html>
