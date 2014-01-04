<?php
    include_once('Settings.inc.php');
    
	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Paginas.inc.php');
	include_once('Sesion.inc.php');
	include_once('Usuarios.inc.php');
	include_once('Utiles.inc.php');

	$PaginaTitulo = "Eventos por Fecha";

	AdministradorControla();

	Conectar();

	$sql = "select left(FechaHora,10), count(*) from eventos";

	if ($Tipo) {
		$where = WhereAgrega($where,"Tipo = '$Tipo'");
		$Parametros .= "&Tipo=$Tipo";
	}
	if ($IdUsuario)	{
		$where = WhereAgrega($where,"IdUsuario = '$IdUsuario'");
		$Parametros .= "&IdUsuario=$IdUsuario";
	}
	if ($Ip)	{
		$where = WhereAgrega($where,"Ip = '$Ip'");
		$Parametros .= "&Ip=$Ip";
	}
	if ($IdParametro)	{
		$where = WhereAgrega($where,"IdParametro = $IdParametro");
		$Parametros .= "&IdParametro=$IdParametro";
	}
	if ($Parametro)	{
		$where = WhereAgrega($where,"Parametro = '$Parametro'");
		$Parametros .= "&Parametro=$Parametro";
	}
	if ($Subparametro)	{
		$where = WhereAgrega($where,"Subparametro = '$Subparametro'");
		$Parametros .= "&Subparametro=$Subparametro";
	}

	$Desde += 0;
	$Cantidad = 50;

	$sqlcuenta = "Select count(distinct left(FechaHora,10)) from eventos";

	if ($where) {
		$sql .= " where $where";
		$sqlcuenta .= " where $where";
	}

	$sql .= " group by left(FechaHora,10) order by 1 desc";
	$sql .= " limit $Desde, $Cantidad";

	$rs = mysql_query($sql);

	$rsCuenta = mysql_query($sqlcuenta);
	list($TotalCantidad) = mysql_fetch_row($rsCuenta);
	mysql_free_result($rsCuenta);

	$titulos = array("Fecha", "Eventos");

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
<a href="EventosPorFecha.php?Desde=0<?php echo $Parametros; ?>">Inicio</a>
&nbsp;&nbsp;
<a href="EventosPorFecha.php?Desde=<?php echo $Anterior; ?><?php echo $Parametros; ?>">Anterior</a>
&nbsp;&nbsp;
<a href="EventosPorFecha.php?Desde=<?php echo $Siguiente; ?><?php echo $Parametros; ?>">Siguiente</a>
&nbsp;&nbsp;
<a href="EventosPorFecha.php?Desde=<?php echo $Ultimo; ?><?php echo $Parametros; ?>">Final</a>
&nbsp;&nbsp;
<br>
<a href="EventosPorFecha.php">Todos</a>
&nbsp;&nbsp;
<a href="EventosPorFecha.php?Tipo=RM">Emails</a>
&nbsp;&nbsp;
<a href="EventosPorFecha.php?Tipo=RR">Referidos</a>
&nbsp;&nbsp;
<a href="EventosPorFecha.php?Tipo=RG">Registraciones</a>
&nbsp;&nbsp;
<a href="EventosPorFecha.php?Tipo=IN">Ingresos</a>
&nbsp;&nbsp;
<a href="EventosPorFecha.php?Tipo=IT">Items</a>
&nbsp;&nbsp;
<p>

<?php
function MuestraRegistro($reg) {
	FilaInicio();
	DatoGenera($reg[0]);
	DatoNumGenera($reg[1]);
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
