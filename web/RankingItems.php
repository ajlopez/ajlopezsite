<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');
	include('Usuarios.inc.php');
	include('Utiles.inc.php');

	$PaginaTitulo = "Ranking de Items";

	AdministradorControla();

	Conectar();

	$sql = "Select Id, Descripcion, Visitas from items";
	$where = "Visitas>0";

	$Desde += 0;
	$Cantidad = 50;

	$sqlcuenta = "Select count(*) from items";

	if ($where) {
		$sql .= " where $where";
		$sqlcuenta .= " where $where";
	}

	$sql .= " order by Visitas desc";

	$sql .= " limit $Desde, $Cantidad";

	$rs = mysql_query($sql);

	$rsCuenta = mysql_query($sqlcuenta);
	list($TotalCantidad) = mysql_fetch_row($rsCuenta);
	mysql_free_result($rsCuenta);

	$titulos = array("Descripci&oacute;n", "Visitas");

	$Primero = 0;
	$Ultimo = $TotalCantidad - $Cantidad;
	$Anterior = $Desde-$Cantidad;
	$Siguiente = $Desde+$Cantidad;

	if ($Anterior<0)
		$Anterior = 0;
	if ($Siguiente+$Cantidad>$TotalCantidad)
		$Siguiente = $TotalCantidad - $Cantidad;
	if ($Siguiente<0)
		$Siguiente = 0;
	if ($Ultimo<0)
		$Ultimo = 0;

	include('Inicio.inc.php');
?>

<center>

<p>
<a href="RankingItems?Desde=0<? echo $Parametros; ?>">Inicio</a>
&nbsp;&nbsp;
<a href="RankingItems?Desde=<? echo $Anterior; ?><? echo $Parametros; ?>">Anterior</a>
&nbsp;&nbsp;
<a href="RankingItems?Desde=<? echo $Siguiente; ?><? echo $Parametros; ?>">Siguiente</a>
&nbsp;&nbsp;
<a href="RankingItems?Desde=<? echo $Ultimo; ?><? echo $Parametros; ?>">Final</a>
&nbsp;&nbsp;
<p>

<?		
function MuestraRegistro($reg) {
	FilaInicio();
	DatoEnlaceGenera($reg["Descripcion"],"Item.php?Id=" . $reg["Id"]);
	DatoNumGenera($reg["Visitas"]);
	FilaFinal();
}
	
	TablaInicio($titulos);

	while ($reg=mysql_fetch_array($rs)) 
		MuestraRegistro($reg);
				
	TablaFinal();
	
?>

</center>

<?
	Desconectar();
	include('Final.inc.php');
?>
