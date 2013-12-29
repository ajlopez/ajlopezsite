<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');
	include('Usuarios.inc.php');
	include('Utiles.inc.php');

	$PaginaTitulo = "Eventos";

	AdministradorControla();

	Conectar();

	$sql = "Select * from eventos";

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

	$sqlcuenta = "Select count(*) from eventos";

	if ($where) {
		$sql .= " where $where";
		$sqlcuenta .= " where $where";
	}

	if ($Orden) {
		$sql .= " order by $Orden";
		$Parametros .= "&Orden=" . urlencode($Orden);
	}
	else
		$sql .= " order by Id desc";

	$sql .= " limit $Desde, $Cantidad";

	$rs = mysql_query($sql);

	$rsCuenta = mysql_query($sqlcuenta);
	list($TotalCantidad) = mysql_fetch_row($rsCuenta);
	mysql_free_result($rsCuenta);

	$titulos = array("Id", "Usuario", "Fecha/Hora", "Tipo", "Par&aacute;metro", "Subpar&aacute;metro", "IdPar&aacute;metro", "IP");

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
<a href="Eventos.php?Desde=0<? echo $Parametros; ?>">Inicio</a>
&nbsp;&nbsp;
<a href="Eventos.php?Desde=<? echo $Anterior; ?><? echo $Parametros; ?>">Anterior</a>
&nbsp;&nbsp;
<a href="Eventos.php?Desde=<? echo $Siguiente; ?><? echo $Parametros; ?>">Siguiente</a>
&nbsp;&nbsp;
<a href="Eventos.php?Desde=<? echo $Ultimo; ?><? echo $Parametros; ?>">Final</a>
&nbsp;&nbsp;
<br>
<a href="Eventos.php">Todos</a>
&nbsp;&nbsp;
<a href="Eventos.php?Tipo=PG">P&aacute;ginas</a>
&nbsp;&nbsp;
<a href="Eventos.php?Tipo=IN">Ingresos</a>
&nbsp;&nbsp;
<a href="Eventos.php?Tipo=RG">Registraciones</a>
&nbsp;&nbsp;
<a href="Eventos.php?Tipo=RM">Emails</a>
&nbsp;&nbsp;
<a href="Eventos.php?Tipo=RR">Referentes</a>
&nbsp;&nbsp;
<a href="Eventos.php?Tipo=RA">Afiliados</a>
&nbsp;&nbsp;
<p>

<?		
function MuestraRegistro($reg) {
	FilaInicio();
	DatoEnlaceGenera($reg["Id"], "Evento.php?Id=".$reg["Id"]);
	if ($reg["IdUsuario"])
		DatoEnlaceGenera(UsuarioTraduce($reg["IdUsuario"]), "Usuario.php?Id=".$reg["IdUsuario"]);
	else
		DatoGenera(UsuarioTraduce($reg["IdUsuario"]));
	DatoGenera($reg["FechaHora"]);
	DatoGenera($reg["Tipo"]);
	if ($reg["Tipo"]=='PG') {
		$Pagina = $reg["Parametro"];
		if ($reg["Subparametro"])
			$Pagina .= "?" . $reg["Subparametro"];
		DatoEnlaceGenera($reg["Parametro"],$Pagina);
	}
	else
		DatoGenera($reg["Parametro"]);
	DatoGenera($reg["Subparametro"]);
	DatoGenera($reg["IdParametro"]);
	DatoEnlaceGenera($reg["Ip"], "Eventos.php?Ip=".$reg["Ip"]);
	FilaFinal();
}
	
	TablaInicio($titulos,"98%");

	while ($reg=mysql_fetch_array($rs)) 
		MuestraRegistro($reg);
				
	TablaFinal();
	
?>

</center>

<?
	Desconectar();
	include('Final.inc.php');
?>
