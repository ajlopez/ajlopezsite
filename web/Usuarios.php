<?php
    include_once('Settings.inc.php');

	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Paginas.inc.php');
	include_once('Sesion.inc.php');
	include_once('Usuarios.inc.php');

	$PaginaTitulo = "Usuarios";

	AdministradorControla();

	Conectar();

	$sql = "select Id, Codigo, Nombre, Apellido, Puntos from usuarios";

	if ($Orden)
		$sql .= " order by $Orden";
	else
		$sql .= " order by Codigo";

	$rs = mysql_query($sql);

	$titulos = array("Código", "Nombre", "Apellido", "Puntos");

	SesionPone("UsuarioEnlace", PaginaActual());

	include('Inicio.inc.php');
?>

<center>

<p>
<a href="UsuarioActualiza.php">Nuevo Usuario...</a>
&nbsp;&nbsp;
<a href="Usuarios.php?Orden=Codigo">Usuarios por Código</a>
&nbsp;&nbsp;
<a href="Usuarios.php?Orden=Id+desc">Usuarios por Id</a>
&nbsp;&nbsp;
<a href="Usuarios.php?Orden=FechaHoraUltimoIngreso+desc">Usuarios por Ingreso</a>
&nbsp;&nbsp;
<a href="Usuarios.php?Orden=Puntos+desc">Usuarios por Puntos</a>
<p>

<?php
function MuestraRegistro($reg) {
   FilaInicio();
   DatoEnlaceGenera($reg["Codigo"], "Usuario.php?Id=".$reg["Id"]);
   DatoGenera($reg["Nombre"]);
   DatoGenera($reg["Apellido"]);
   DatoNumGenera($reg["Puntos"]);
   FilaFinal();
}
	
	TablaInicio($titulos,"90%");

	while ($reg=mysql_fetch_array($rs)) 
		MuestraRegistro($reg);
				
	TablaFinal();
	
?>

</center>

<?php
	Desconectar();
	include('Final.inc.php');
?>
