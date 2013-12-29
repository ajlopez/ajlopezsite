<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');
	include('Eventos.inc.php');

	$PaginaTitulo = "Mis Cursos";

	Conectar();

	UsuarioControla();

	EventoPagina();

	$sql = "select c.*, uc.Id as IdInscripcion, uc.Estado as CursoEstado from cursos c inner join usuarioscursos uc on c.Id = uc.IdCurso where uc.IdUsuario = " . UsuarioId();
	$rs = mysql_query($sql);

	include('Inicio.inc.php');
?>


<?
	if (mysql_num_rows($rs)) {
?>
<p>
Estos son los cursos en los que est&aacute; inscripto.
</p>
<p>

<?		
	while ($reg=mysql_fetch_array($rs)) {
		$IdCurso = $reg["Id"];
		$IdInscripcion = $reg["IdInscripcion"];
		
		echo "<p><a href='CursoIngreso.php?Id=$IdCurso'>" . $reg["Descripcion"] . "</a></p>\n";
			echo "<p>" . $reg["Detalle"] . "\n</p>\n";

		if (!$reg["CursoEstado"] && $reg["ImportePrecio"]>0)
			echo "<p><b>Ingrese los datos de <a href='CursoPago.php?Id=$reg[Id]'>su pago</a></b>";
	}
?>


<?
	}
	else {
?>
<p>
Actualmente no est&aacute; inscripto en ning&uacute;n curso. Consulte nuestra <a href="CursosMuestra.php">gu&iacute;a de cursos</a>.
<?
	}
	Desconectar();
	include('Final.inc.php');
?>
