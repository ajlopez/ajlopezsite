<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');
	include('Usuarios.inc.php');
	include('Puntos.inc.php');

	$PaginaTitulo = "Detalle de Mis Puntos";

	UsuarioControla();

	Conectar();

	$IdUsuario = UsuarioId();

	$sql = "select * from puntos where IdUsuario = $IdUsuario order by Id";
	$rs = mysql_query($sql);

	$titulos = array("Fecha/Hora", "Puntos", "Detalle");

	include('Inicio.inc.php');
?>

<center>

<p>

<?		
function MuestraRegistro($reg) {
   FilaInicio();
   DatoGenera($reg["FechaHora"]);
   DatoNumGenera($reg["Puntos"]);
   DatoGenera(PuntosTipoTraduce($reg["Tipo"]));
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
