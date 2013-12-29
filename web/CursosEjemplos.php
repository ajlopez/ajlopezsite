<?
	include_once('Usuarios.inc.php');
	include_once('Paginas.inc.php');
	include_once('Eventos.inc.php');
	include_once('Categorias.inc.php');

	Conectar();

	EventoPagina();

	$rsReferencias = mysql_query("select Id, Titulo, Detalle from referencias where (Titulo like '%material%' or Titulo like '%curso%' or Titulo like '%seminario%'  or Titulo like '%charla%' or Titulo like '%jornada%')and Estado=0 order by Prioridad, Id desc");

	$PaginaTitulo = "Cursos y Seminarios: Ejemplos, Enlaces y Recursos";

	include('InicioTags.inc.php');
?>

<p>
Durante más de diez años, he dado seminarios y cursos sobre temas
de desarrollo de software: Java, .NET, PHP, ASP.NET, desarrollo web en general, Ajax,
Hibernate, NHibernate, Spring, y otras tecnologías, librerías y frameworks.
</p>
<p>
En esta página está material de esos cursos: presentaciones, ejemplos, enlaces, 
recursos, listos para bajar.
</p>

<center>

<script type="text/javascript"><!--
google_ad_client = "pub-8624135492444658";
//728x90, created 12/12/07
google_ad_slot = "1011191902";
google_ad_width = 728;
google_ad_height = 90;
//--></script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

<!--
<p class="destacado">
Estamos lanzando los nuevos <b>Cursos a Distancia</b> de Java, .NET, PHP. Para
más información, consulte <a href="http://www.ajlopez.net/CursosADistancia.php">aquí</a>,
o pida información en <a href="http://www.ajlopez.net/ContactoADistancia.php">este formulario</a>.
</p>
-->

</center>

<?
	while ($reg=mysql_fetch_array($rsReferencias)) {
?>

<p>
<a class=item href='ReferenciaVe.php?Id=<? echo $reg['Id']; ?>'><? echo $reg['Titulo'] ?></a>
<?
	if (EsAdministrador()) {
?>
&nbsp;&nbsp;<a href='Referencia.php?Id=<? echo $reg['Id']; ?>'>Administra</a>
<?
	}
?>
<br>
<? echo $reg['Detalle'] ?>
</p>
<?
	}
?>

<?
	Desconectar();
	include('Final.inc.php');
?>

