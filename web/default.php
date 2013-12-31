<?php
    include_once('Settings.inc.php');
	include_once('Usuarios.inc.php');
	include_once('Paginas.inc.php');
	include_once('Eventos.inc.php');
	include_once('Categorias.inc.php');

	Conectar();

	EventoPagina();

	$Categorias = array();
	$Resumenes = array();

	$sql = "select * from categorias where IdPadre=0";
	if (!EsAdministrador())
		$sql .= " and Estado = " . CATEGORIAS_ESTADO_NORMAL;
	$sql .= " order by descripcion";
	$rs = mysql_query($sql);
	while ($reg = mysql_fetch_object($rs)) {
		if ($reg->Estado)
			$Categorias[$reg->Id] = "($reg->Descripcion)";
		else
			$Categorias[$reg->Id] = $reg->Descripcion;
		$Resumenes[$reg->Id] = $reg->Resumen;
	}

	$rsReferencias = mysql_query("select Id, Titulo, Detalle from referencias where Titulo not like '%material%' and Estado=0 order by Prioridad, Id desc");

	$PaginaTitulo = "El sitio de Angel \"Java\" Lopez";

	include_once('InicioTags.inc.php');
?>

<p>
Bienvenido a mi sitio <a href="<? echo PaginaPrincipal(); ?>">ajlopez</a>, donde encontrar&aacute; recursos, enlaces, p&aacute;ginas, y art&iacute;culos
sobre desarrollo de software y sobre los temas que me interesan. Desde casi treinta años
me dedico a la creación de software, en distintas tecnologías, entornos y lenguajes.
</p>
<p>Espero que este
sitio y sus temas, enlaces, materiales, les resulte útiles. Cualquier consulta o sugerencia
<a href="Contacto.php">contácteme</a>
</p>

<br>

<center>

<!--
<p class="destacado">
Estamos lanzando los nuevos <b>Cursos a Distancia</b> de Java, .NET, PHP. Para
más información, consulte <a href="http://www.ajlopez.net/CursosADistancia.php">aquí</a>,
o pida información en <a href="http://www.ajlopez.net/ContactoADistancia.php">este formulario</a>.
</p>
-->

</center>

<center>

<table border="0" cellpadding="20" width="100%">

<tr>
<td valign="top" colspan="2" width="100%">

<table border=0 cellpadding=0 cellspacing=0 width=100%>
	<tr><td bgcolor=#000000 height=4>
	</td></tr>
	<tr><td bgcolor=#eeeeee>
	&nbsp;<a href="Temas.php">Desarrollo de Software y otros temas</a></td></tr>
	<tr><td bgcolor=#00000 height=4>

	</td></tr>
</table>
<img src="images/spacer.gif" height=1 width=170>

<table border=0 cellpadding=2 cellspacing=0 width=100%>
<tr><td valign="top" bgcolor=#FFFFFF colspan=2>
<p>
	<img src="images/development01.png" align=left>
	<img src="images/spacer.gif" height=180 width=7 align=left>
Desde el comienzo de este sitio, he ido publicando enlaces, artículos y recursos
en la web de los temas de desarrollo de software.
<br>
<br>
<a href="programacion">Programación</a>,
<a href="java">Java</a>,
<a href="puntonet">.NET</a>,
<a href="xml">XML</a>,
<a href="uml">UML</a>,
<a href="vb">Visual Basic</a>,
<a href="php">PHP</a>,
<a href="webmasters">Desarrollo Web</a>,
<a href="Tema.php?Id=71">Inteligencia Artificial</a>,
<a href="Tema.php?Id=64">Computer Go</a>,
<a href="Tema.php?Id=47">Patrones</a>,
<a href="Tema.php?Id=14">Smalltalk</a>,
<a href="Tema.php?Id=13">COBOL</a>,
y más...
<br>
<br>
También he ido coleccionando enlaces en mi <a href="Delicious.php">nube Delicious</a> y
publicado recursos interesantes en mis <a href="Blogs.php">blogs</a>
</p>
</td></tr>
</table>

</td>

</tr>

<tr>
<td valign="top" colspan="2" width="100%">

<table border=0 cellpadding=0 cellspacing=0 width=100%>
	<tr><td bgcolor=#408056 height=4>
	</td></tr>
	<tr><td bgcolor=#F4F4FF>
	&nbsp;<a href="cursos">Cursos en línea</a></td></tr>
	<tr><td bgcolor=#408056 height=4>

	</td></tr>
</table>
<img src="images/spacer.gif" height=1 width=170>

<table border=0 cellpadding=2 cellspacing=0 width=100%>
<tr><td valign="top" bgcolor=#FFFFFF colspan=2>
<p>
	<img src="images/ajlearning.png" align=left>
	<img src="images/spacer.gif" height=180 width=7 align=left>
He comenzado a publicar las lecciones de mis cursos presenciales. Estoy 
publicando una o más lecciones por días, de mi curso de <a href="http://ajlopez.net/cursos/Course.php?Id=1">Introducción a Java</a> y del <a href="http://ajlopez.net/cursos/Course.php?Id=4">Desarrollo de Sitios con PHP y MySQL</a>. En estos
días también sumaré PHP y MySQL, .NET, JavaServer Pages, y más adelante,
arquitectura de software con .NET y con Java. Son gratuitos.
</p>
<p>Pueden ver el avance de las lecciones publicadas en <a href="http://msmvps.com/blogs/lopez/archive/2008/04/08/a-lesson-a-day-keeps-the-doctor-away.aspx"
target="_blank">A lesson a day keeps the doctor away</a>
</td></tr>
</table>

</td>

</tr>


<tr>
<td valign="top" width="50%">

<table border=0 cellpadding=0 cellspacing=0 width=100%>
	<tr><td bgcolor=#405680 height=4>
	</td></tr>
	<tr><td bgcolor=#F4FFF4>
	&nbsp;<a href="CursosEjemplos.php">Materiales de Cursos</a></td></tr>
	<tr><td bgcolor=#405680 height=4>

	</td></tr>
</table>
<img src="images/spacer.gif" height=1 width=170>

<table border=0 cellpadding=2 cellspacing=0 width=100%>
<tr><td valign="top" bgcolor=#FFFFFF colspan=2>
<p>
	<img src="images/coursematerial01.png" align=left>
	<img src="images/spacer.gif" height=140 width=7 align=left>
	Durante más de diez años, he dado seminarios y cursos sobre temas
de desarrollo de software: Java, .NET, PHP, ASP.NET, desarrollo web en general, Ajax,
Hibernate, NHibernate, Spring, y otras tecnologías, librerías y frameworks.
<br>
<br>
Aquí encontraran material de esos cursos: presentaciones, ejemplos, enlaces, 
recursos, listos para bajar.
</p>
	<p align="right">
<a href="CursosEjemplos.php">Leer más...</a>
	<p>
</td></tr>
</table>

</td>

<td valign="top" width="50%">

<table border=0 cellpadding=0 cellspacing=0 width=100%>
	<tr><td bgcolor=#A00008 height=4>
	</td></tr>
	<tr><td bgcolor=#FFF0FF>
	&nbsp;<a href="CursosSeminarios.php">Cursos y Seminarios</a></td></tr>
	<tr><td bgcolor=#A00008 height=4>
	</td></tr>
</table>
<img src="images/spacer.gif" height=1 width=170>
<table border=0 cellpadding=2 cellspacing=0 width=100%>
<tr><td valign="top" bgcolor=#FFFFFF colspan=2>
<p>
	<img src="images/training02.png" align=left>
	<img src="images/spacer.gif" height=110 width=7 align=left>
Información sobre cursos y seminarios que dicto en instituciones, grupos
de usuarios, universidades y empresas.
<br>
<br>
Algunos de los temas: Arquitectura de Software, Java, JSP, J2EE, .NET, ASP.NET, PHP,
Desarrollo Web, Patrones...
</p>
	<p align="right">
<a href="CursosSeminarios.php">Leer más...</a>
	<p>
</td></tr>
</table>

</td>
</tr>

<tr>
<td valign="top">

<table border=0 cellpadding=0 cellspacing=0 width=100%>
	<tr><td bgcolor=#408056 height=4>
	</td></tr>
	<tr><td bgcolor=#F4F4FF>
	&nbsp;<a href="Proyectos.php">Proyectos</a></td></tr>
	<tr><td bgcolor=#408056 height=4>

	</td></tr>
</table>
<img src="images/spacer.gif" height=1 width=170>

<table border=0 cellpadding=2 cellspacing=0 width=100%>
<tr><td valign="top" bgcolor=#FFFFFF colspan=2>
<p>
	<img src="images/projects01.png" align=left>
	<img src="images/spacer.gif" height=140 width=7 align=left>
Proyectos de código abierto que he desarrollado. En especial, mi preferido,
el generador de código <a href="http://www.ajlopez.com/ajgenesis">AjGenesis</a>.
</p>
	<p align="right">
<a href="Proyectos.php">Leer más...</a>
	<p>
</td></tr>
</table>

</td>

<td valign="top">

<table border=0 cellpadding=0 cellspacing=0 width=100%>
	<tr><td bgcolor=#F0F000 height=4>
	</td></tr>
	<tr><td bgcolor=#FFFFD0>
	&nbsp;<a href="Blogs.php">Blogs</a></td></tr>
	<tr><td bgcolor=#F0F000 height=4>
	</td></tr>
</table>
<img src="images/spacer.gif" height=1 width=170>
<table border=0 cellpadding=2 cellspacing=0 width=100%>
<tr><td valign="top" bgcolor=#FFFFFF colspan=2>
<p>
	<img src="images/blogs01.png" align=left>
	<img src="images/spacer.gif" height=140 width=7 align=left>
Soy un "blogger" compulsivo. Escribo diariamente en mis blogs, sobre desarrollo de software, ciencia, filosofía
y temas en general</p>
	<p align="right">
<a href="Blogs.php">Leer más...</a>
	<p>
</td></tr>
</table>

</td>
</tr>

<tr>
<td valign="top">

<table border=0 cellpadding=0 cellspacing=0 width=100%>
	<tr><td bgcolor=#F00000 height=4>
	</td></tr>
	<tr><td bgcolor=#FFF0F0>
	&nbsp;<a href="SitiosWeb.php">Sitios</a></td></tr>
	<tr><td bgcolor=#F00000 height=4>

	</td></tr>
</table>
<img src="images/spacer.gif" height=1 width=170>

<table border=0 cellpadding=2 cellspacing=0 width=100%>
<tr><td valign="top" bgcolor=#FFFFFF colspan=2>
<p>
	<img src="images/sites01.png" align=left>
	<img src="images/spacer.gif" height=140 width=7 align=left>
Sitios y aplicaciones web que estoy desarrollando, como el "sitio hermano"
de éste, <a href="http://www.todocontenidos.com" target="_blank">www.todocontenidos.com</a>.
</p>
	<p align="right">
<a href="SitiosWeb.php">Leer más...</a>
	<p>
</td></tr>
</table>

</td>

<td valign="top">

<table border=0 cellpadding=0 cellspacing=0 width=100%>
	<tr><td bgcolor=#A000A0 height=4>
	</td></tr>
	<tr><td bgcolor=#FFF0FF>
	&nbsp;<a href="http://www.todocontenidos.com/Tema.php?Id=133" target="_blank">Go</a></td></tr>
	<tr><td bgcolor=#A000A0 height=4>
	</td></tr>
</table>
<img src="images/spacer.gif" height=1 width=170>
<table border=0 cellpadding=2 cellspacing=0 width=100%>
<tr><td valign="top" bgcolor=#FFFFFF colspan=2>
<p>
	<img src="images/go01.png" align=left>
	<img src="images/spacer.gif" height=140 width=7 align=left>
Juego milenario: fascinante y hermoso. Lo recomiendo a cualquiera que
le gusten los juegos inteligentes. Y para los desarrolladores de software,
el Go es un juego desafío de la inteligencia artificial: no hay programa
de software que se acerque mínimamente al juego de un profesional.
<br>
<br>
Estos son <a href="http://www.todocontenidos.com/Tema.php?Id=133" target="_blank">mis enlaces sobre Go</a>, que mantengo en mi sitio <a href="http://www.todocontenidos.com" target="_blank">www.todocontenidos.com</a>.
</p>
	<p align="right">
<a href="http://www.todocontenidos.com/Tema.php?Id=133" target="_blank">Leer más...</a>
	<p>
</td></tr>
</table>

</td>
</tr>

<tr>
<td valign="top" width="50%">

<table border=0 cellpadding=0 cellspacing=0 width=100%>
	<tr><td bgcolor=#405680 height=4>
	</td></tr>
	<tr><td bgcolor=#F4FFF4>
	&nbsp;<a href="Delicious.php">Mi Delicious</a></td></tr>
	<tr><td bgcolor=#405680 height=4>

	</td></tr>
</table>
<img src="images/spacer.gif" height=1 width=170>

<table border=0 cellpadding=2 cellspacing=0 width=100%>
<tr><td valign="top" bgcolor=#FFFFFF colspan=2>
<p>
	<img src="images/delicious01.png" align=left>
	<img src="images/spacer.gif" height=140 width=7 align=left>
<a href="http://del.icio.us/" target="_blank">http://del.icio.us</a> es adictivo. Estoy
coleccionando enlaces de los distintos temas que me interesan. Esta es <a href="Delicious.php">mi
nube de tags</a> en Delicious.
</p>
</p>
	<p align="right">
<a href="Delicious.php">Leer más...</a>
	<p>
</td></tr>
</table>

</td>

<td valign="top" width="50%">

<table border=0 cellpadding=0 cellspacing=0 width=100%>
	<tr><td bgcolor=#A00008 height=4>
	</td></tr>
	<tr><td bgcolor=#FFF0FF>
	&nbsp;<a href="http://ajlopez.zoomblog.com/cat/6946" target="_blank">Filosofía</a></td></tr>
	<tr><td bgcolor=#A00008 height=4>
	</td></tr>
</table>
<img src="images/spacer.gif" height=1 width=170>
<table border=0 cellpadding=2 cellspacing=0 width=100%>
<tr><td valign="top" bgcolor=#FFFFFF colspan=2>
<p>
	<img src="images/philosophy01.png" align=left>
	<img src="images/spacer.gif" height=110 width=7 align=left>
En estos últimos tiempos, he estado escribiendo bastante sobre filosofía, filosofía de la
ciencia, realismo, y discutiendo otras posturas y pensadores.
</p>
	<p align="right">
<a href="http://ajlopez.zoomblog.com/cat/6946" target="_blank">Leer más...</a>
	<p>
</td></tr>
</table>

</td>
</tr>

<tr>
<td valign="top">

<table border=0 cellpadding=0 cellspacing=0 width=100%>
	<tr><td bgcolor=#408056 height=4>
	</td></tr>
	<tr><td bgcolor=#F4F4FF>
	&nbsp;<a href="http://www.ajlopez.net/matematicas">Matemáticas</a></td></tr>
	<tr><td bgcolor=#408056 height=4>

	</td></tr>
</table>
<img src="images/spacer.gif" height=1 width=170>

<table border=0 cellpadding=2 cellspacing=0 width=100%>
<tr><td valign="top" bgcolor=#FFFFFF colspan=2>
<p>
	<img src="images/mathematics01.png" align=left>
	<img src="images/spacer.gif" height=140 width=7 align=left>
Uno de mis temas preferidos. Tanto la historia como las distintas ramas de las
matemáticas son tópicos interesantísimos y fascinantes. Aquí algunos enlaces
que visito
</p>
	<p align="right">
<a href="http://www.ajlopez.net/matematicas">Leer más...</a>
	<p>
</td></tr>
</table>

</td>

<td valign="top">

<table border=0 cellpadding=0 cellspacing=0 width=100%>
	<tr><td bgcolor=#F0F000 height=4>
	</td></tr>
	<tr><td bgcolor=#FFFFD0>
	&nbsp;<a href="http://ajlopez.zoomblog.com/cat/4714" target="_blank">Ciencia</a></td></tr>
	<tr><td bgcolor=#F0F000 height=4>
	</td></tr>
</table>
<img src="images/spacer.gif" height=1 width=170>
<table border=0 cellpadding=2 cellspacing=0 width=100%>
<tr><td valign="top" bgcolor=#FFFFFF colspan=2>
<p>
	<img src="images/science01.png" align=left>
	<img src="images/spacer.gif" height=140 width=7 align=left>
Estoy comenzando a escribir sobre algunos temas, tanto de historia como de 
fundamentos de la ciencia.</p>
	<p align="right">
<a href="http://ajlopez.zoomblog.com/cat/4714" target="_blank">Leer más...</a>
	<p>
</td></tr>
</table>

</td>
</tr>


</table>

</center>

<?php
	while ($reg=mysql_fetch_array($rsReferencias)) {
?>

<p>
<a class=item href='ReferenciaVe.php?Id=<?php echo $reg['Id']; ?>'><?php echo $reg['Titulo'] ?></a>
<?php
	if (EsAdministrador()) {
?>
&nbsp;&nbsp;<a href='Referencia.php?Id=<?php echo $reg['Id']; ?>'>Administra</a>
<?php
	}
?>
<br>
<?php echo $reg['Detalle'] ?>
</p>
<?php
	}
?>

<center>

<h2>Temas</h2>

<p>

<table cellspacing=1 cellpadding=3 width=600 border=0 bgcolor=black>

<?php
function MuestraCategoria($Id,$Descripcion,$Resumen,$x,$y)
{
	$pos = $x + $y;

	if ($pos % 2)
		$fondo = "#eeeeee";
	else
		$fondo = "#dddddd";

	echo "<td width='33%' class=categoria valign=top bgcolor=$fondo><a class=categoria href='Tema.php?Id=$Id'>$Descripcion</a></td>\n";
}

function MuestraVacio($x,$y)
{
	$pos = $x + $y;

	if ($pos % 2)
		$fondo = "#eeeeee";
	else
		$fondo = "#dddddd";

	echo "<td width='33%' class=categoria valign=top bgcolor=$fondo>&nbsp;</td>\n";
}

	reset($Categorias);

	$x=0; $y=0;
	$ncols = 3;
	$n=0;

	while (list($Id,$Descripcion) = each($Categorias)) {
		$Resumen = $Resumenes[$Id];
		$y = (integer) ($n / $ncols);
		$x = $n % $ncols;

		if ($x==0 && $n)
			echo "</tr>\n";

		if ($x==0)
			echo "<tr>\n";

		MuestraCategoria($Id,$Descripcion,$Resumen,$x,$y);
		$n++;
	}

	$x++;

	while ($x<$ncols) {
		MuestraVacio($x,$y);
		$x++;
	}

	echo "</tr>\n";
?>

</table>
</center>

<?php
	Desconectar();
	include('Final.inc.php');
?>

