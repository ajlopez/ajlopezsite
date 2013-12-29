<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');
	include('Usuarios.inc.php');

	$PaginaTitulo = "Items";

	AdministradorControla();

	Conectar();

	if ($IdCategoria)
		$sql = "select i.* from categoriasitems ci left join items i on ci.IdItem = i.Id where ci.IdCategoria = $IdCategoria order by i.Descripcion";
	else
		$sql = "select * from items order by descripcion";

	$rs = mysql_query($sql);

	$titulos = array('Descripci&oacute;n','Visitas','Prioridad');

	SesionPone("ItemEnlace", PaginaActual());

	include('Inicio.inc.php');
?>

<center>

<p>
<a href="ItemActualiza.php?IdCategoria=$IdCategoria">Nuevo Item...</a>
<p>

<?		
function MuestraRegistro($reg) {
	FilaInicio();
	$Descripcion = $reg["Descripcion"];

	if ($reg["Estado"])
		$Descripcion = '('. $Descripcion . ')';
	DatoEnlaceGenera($Descripcion, "Item.php?Id=".$reg["Id"]);
	DatoNumGenera($reg['Visitas']);
	DatoNumGenera($reg['Prioridad']);
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
