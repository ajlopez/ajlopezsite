<?php
    include_once('Settings.inc.php');

	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Paginas.inc.php');
	include_once('Sesion.inc.php');
	include_once('Usuarios.inc.php');
	include_once('Utiles.inc.php');

	$PaginaTitulo = "Ranking de Art&iacute;culos";

	AdministradorControla();

	Conectar();

	$sql = "Select Id, Titulo, Visitas from articulos";
	$where = "Visitas>0";

	$Desde += 0;
	$Cantidad = 50;

	$sqlcuenta = "Select count(*) from articulos";

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

	$titulos = array("T&iacute;tulo", "Visitas");

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
<a href="RankingArticulos.php?Desde=0<?php echo $Parametros; ?>">Inicio</a>
&nbsp;&nbsp;
<a href="RankingArticulos.php?Desde=<?php echo $Anterior; ?><?php echo $Parametros; ?>">Anterior</a>
&nbsp;&nbsp;
<a href="RankingArticulos.php?Desde=<?php echo $Siguiente; ?><?php echo $Parametros; ?>">Siguiente</a>
&nbsp;&nbsp;
<a href="RankingArticulos.php?Desde=<?php echo $Ultimo; ?><?php echo $Parametros; ?>">Final</a>
&nbsp;&nbsp;
<p>

<?php
function MuestraRegistro($reg) {
	FilaInicio();
	DatoEnlaceGenera($reg["Titulo"],"Articulo.php?Id=" . $reg["Id"]);
	DatoNumGenera($reg["Visitas"]);
	FilaFinal();
}
	
	TablaInicio($titulos);

	while ($reg=mysql_fetch_array($rs)) 
		MuestraRegistro($reg);
				
	TablaFinal();
	
?>

</center>

<?php
	Desconectar();
	include('Final.inc.php');
?>
