<?php
    include_once('Settings.inc.php');
    
	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Paginas.inc.php');
	include_once('Sesion.inc.php');
	include_once('Usuarios.inc.php');
	include_once('Utiles.inc.php');
	include_once('Categorias.inc.php');

	$PaginaTitulo = "Ranking de Categor&iacute;as";

	AdministradorControla();

	Conectar();

	$sql = "Select Id, Descripcion, Visitas from categorias";
	$where = "Visitas>0";

	$Desde += 0;
	$Cantidad = 50;

	$sqlcuenta = "Select count(*) from categorias";

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
<a href="RankingCategorias?Desde=0<? echo $Parametros; ?>">Inicio</a>
&nbsp;&nbsp;
<a href="RankingCategorias?Desde=<? echo $Anterior; ?><? echo $Parametros; ?>">Anterior</a>
&nbsp;&nbsp;
<a href="RankingCategorias?Desde=<? echo $Siguiente; ?><? echo $Parametros; ?>">Siguiente</a>
&nbsp;&nbsp;
<a href="RankingCategorias?Desde=<? echo $Ultimo; ?><? echo $Parametros; ?>">Final</a>
&nbsp;&nbsp;
<p>

<?php
function MuestraRegistro($reg) {
	FilaInicio();
	DatoGenera(CategoriasEnlaces($reg["Id"]));
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
