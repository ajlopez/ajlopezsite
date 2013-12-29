<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');
	include('Eventos.inc.php');
	include('Categorias.inc.php');

	$PaginaTitulo = "Cursos";

	Conectar();

	EventoPagina();


	if ($IdTema) {
		$rsCategoria = mysql_query("select Descripcion from temas where Id = $IdTema order by Descripcion");
		list($CatDescripcion)=mysql_fetch_row($rsCategoria);
		mysql_free_result($rsCategoria);
		$PaginaTitulo = "Cursos y Eventos $CatDescripcion";
	}
	else {
		$sql = "select * from temas order by Descripcion";
		$rs = mysql_query($sql);
	}

	include('Inicio.inc.php');
?>

<?
	if ($IdTema) {
?>
<p align=center>
<a href="CursosMuestra.php">Todos los Cursos</a>
</p>
<?
	}
?>

<p>
Estos son los cursos que brindamos, en línea, a distancia. Están pensados para que pueda estudiar desde
su casa o trabajo, en su propio tiempo, y a la velocidad que Ud. decida.
Se brindan lecciones, ejercicios, ejemplos, foros de discusión, y en muchos de ellos, preguntas al tutor.

<p>

Si lo desea, consulte por la forma de obtener <a href="Puntos.php">Descuentos</a> en estos cursos gratuitamente,
o inf&oacute;rmese sobre nuestro <a href="Afiliados.php">Sistema de Afiliados</a>, que
le permitirá ganar dinero, participando de la venta de nuestros servicios.

<h2>En Argentina, respetamos UN PESO = UN DOLAR</h2>

<p>
Debido a la situaci&oacute;n por la que atraviesa Argentina, <a href="http://www.todocontenidos.com/">todocontenidos.com</a>
ha decidido mantener la paridad <b>UN PESO es UN DOLAR</b> para el pago de los cursos arancelados online, durante el mes de Febrero de
2002. Esperemos poder seguir manteniendo la medida en el tiempo. Este tipo de cambio es solamente para los usuarios
que residan en Argentina.
</p>
<p>
Agradecemos a todos los usuarios inscriptos, la confianza depositada en nosotros.

</p>

<p>

<?		
	if ($IdCategoria) {
		$rscursos = mysql_query("select Id, Descripcion, Detalle, ImportePrecio from cursos where IdCategoria = $IdCategoria and Estado = 0 order by Descripcion");

		while ($regcurso=mysql_fetch_array($rscursos)) {
			$IdCurso = $regcurso["Id"];
			echo "<p><a href='CursoMuestra.php?Id=$IdCurso'>" . $regcurso["Descripcion"] . "</a>";
			if ($regcurso["ImportePrecio"]==0)
				echo "&nbsp;&nbsp;<font color=red><b>Gratis!!!</b></font>";
			echo "</p>\n";
			echo "<p>" . $regcurso["Detalle"] . "\n</p>\n";
		}
	}
	else {
		while ($reg=mysql_fetch_array($rs)) {
			echo "<h2>" . $reg["Descripcion"] . "</h2>";

			$rscursos = mysql_query("select Id, Descripcion, Detalle, ImportePrecio from cursos where IdCategoria = " . $reg["Id"] . " and Estado = 0 order by Descripcion");

			while ($regcurso=mysql_fetch_array($rscursos)) {
				$IdCurso = $regcurso["Id"];
				echo "<p><a href='CursoMuestra.php?Id=$IdCurso'>" . $regcurso["Descripcion"] . "</a>";
				if ($regcurso["ImportePrecio"]==0)
					echo "&nbsp;&nbsp;<font color=red><b>Gratis!!!</b></font>";
				echo "</p>\n";
				echo "<p>" . $regcurso["Detalle"] . "\n</p>\n";
			}
		}
	}
?>


<?
	Desconectar();
	include('Final.inc.php');
?>
