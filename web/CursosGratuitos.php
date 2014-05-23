<?php
    include_once('Settings.inc.php');

	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Paginas.inc.php');
	include_once('Sesion.inc.php');
	include_once('Eventos.inc.php');
	include_once('Categorias.inc.php');

	$PaginaTitulo = "Cursos Gratuitos";

	Conectar();

	EventoPagina();

	$sql = "select * from cursoscategorias order by Descripcion";
	$rs = mysql_query($sql);

	include_once('Inicio.inc.php');
?>

<p align=center>
<a href="CursosMuestra.php">Todos los Cursos</a>
</p>

<p>
<a href="http://www.todocontenidos.com">todocontenidos.com</a> ha puesto estos cursos gratuitos,
abiertos a todos los que quieran participar. Est&aacute;n dise&ntilde;ados para que pueda estudiar desde
su casa o trabajo, en su propio tiempo, y a la velocidad que Ud. decida.
Se brindan lecciones, ejercicios, ejemplos, foros de discusión, y en muchos de ellos, preguntas al profesor.

<p>

Consulte por nuestro <a href="Afiliados.php">Sistema de Afiliados</a>, que
le permitirá ganar dinero, participando de la venta de nuestros servicios.

<p>

<?php
	while ($reg=mysql_fetch_array($rs)) {
		echo "<h2>" . $reg["Descripcion"] . "</h2>";

		$rscursos = mysql_query("select Id, Descripcion, Detalle from cursos where ImportePrecio = 0 and Estado = 0 and IdCategoria = " . $reg["Id"]);

		while ($regcurso=mysql_fetch_array($rscursos)) {
			$IdCurso = $regcurso["Id"];
			echo "<p><a href='CursoMuestra.php?Id=$IdCurso'>" . $regcurso["Descripcion"] . "</a></p>\n";
			echo "<p>" . $regcurso["Detalle"] . "\n</p>\n";
		}
	}
?>

<?php
	Desconectar();
	include('Final.inc.php');
?>
