<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');

	Conectar();

	if (!isset($IdTabla))
		PaginaSalir();

	$sql = "select Codigo, Descripcion, Singular, Plural, IdGenero from tablas where Id = $IdTabla";
	$rs = mysql_query($sql);
	list($Codigo, $Descripcion, $Singular, $Plural, $IdGenero) = mysql_fetch_row($rs);
	mysql_free_result($rs);

	$sql = "select Id, Descripcion from $Codigo order by Descripcion";
	$rs = mysql_query($sql);

	$PaginaTitulo = $Plural;

	$rsPaises = mysql_query("Select Id, Descripcion from paises order by descripcion");
	echo mysql_error();

	$titulos = array("Descripción");

	SesionPone("TablaEnlace", PaginaActual());

	require('Inicio.inc.php');
?>

<center>

<p>
<a href="TablaDatoActualiza.php?IdTabla=<? echo $IdTabla; ?>">Nuevo <? echo $Singular; ?>...</a>
<p>

<?		
function MuestraRegistro($reg) {
	global $Codigo;
	global $IdTabla;

	FilaInicio();
	DatoEnlaceGenera($reg["Descripcion"], "TablaDato.php?IdTabla=$IdTabla&Id=$reg[Id]");
	FilaFinal();
}
	
	TablaInicio($titulos,'90%');

	while ($reg=mysql_fetch_array($rs)) 
		MuestraRegistro($reg);
				
	TablaFinal();
	
?>

</center>

<?
	Desconectar();
	include('Final.inc.php');
?>
