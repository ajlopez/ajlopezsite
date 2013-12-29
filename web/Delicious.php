<?
	include($PaginaPrefijo.'Usuarios.inc.php');
	include($PaginaPrefijo.'Paginas.inc.php');
	include($PaginaPrefijo.'Eventos.inc.php');
	include($PaginaPrefijo.'Categorias.inc.php');

	Conectar();

	EventoPagina();


	$PaginaTitulo = "Mi Delicious";

	include('Inicio.inc.php');
?>

      <!-- Del.icio.us Tags -->

<script type="text/javascript" src="http://del.icio.us/feeds/js/tags/ajlopez?icon;size=12-23;color=87ceeb-000080;title=My%20del.icio.us%20Tags;name;showadd"></script>

<br>
<br>

      <!-- Del.icio.us Links -->

	<script type="text/javascript" src="http://del.icio.us/feeds/js/ajlopez?title=My Links;icon=rss"></script>
<noscript><a href="http://del.icio.us/ajlopez">Links</a></noscript>

</center>

<?
	Desconectar();
	include('Final.inc.php');
?>

