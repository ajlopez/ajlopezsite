<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');

	$PaginaTitulo = "Noticias";

	Conectar();

	if ($IdCategoria)
		$sql = "select n.Titulo, n.Id from categoriasnoticias cn left join noticias n on cn.IdNoticia = n.Id where cn.IdCategoria = $IdCategoria order by n.Titulo";
	else
		$sql = "select Titulo, Id from noticias order by titulo";

	$rs = mysql_query($sql);

	$titulos = array("T&iacute;tulo");

	SesionPone("NoticiaEnlace", PaginaActual());

	include('Inicio.inc.php');
?>

<center>

<p>
<a href="NoticiaActualiza.php?IdCategoria=$IdCategoria">Nueva Noticia...</a>
<p>

<?		
function MuestraRegistro($reg) {
	FilaInicio();
	DatoEnlaceGenera($reg["Titulo"], "Noticia.php?Id=".$reg["Id"]);
	FilaFinal();
}
	
	TablaInicio($titulos,"90%");

	while ($reg=mysql_fetch_array($rs)) 
		MuestraRegistro($reg);
				
	TablaFinal();
	
?>

</center>

<?
	Desconectar();
	include('Final.inc.php');
?>
