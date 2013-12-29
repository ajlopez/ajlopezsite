<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');
	include('Utiles.inc.php');
	include('Usuarios.inc.php');

	Conectar();
	
	if (!UsuarioIdentificado())
		PaginaRedireccionar('UsuarioPuntosNo.php');

	if (!isset($Id))
		$Id = UsuarioId();

	if ($Id<>UsuarioId() and !EsAdministrador())
		PaginaSalir();

//	SesionPone('UsuarioEnlace',PaginaActual());

	$sql = "select * from preferencias where IdUsuario = $Id";
	$res = mysql_query($sql);
	$preferencias = mysql_fetch_object($res);
	mysql_free_result($res);
	$PaginaTitulo = "Preferencias del Usuario";

	if ($Id==UsuarioId())
		$PaginaTitulo = "Mis Preferencias";

	require('Inicio.inc.php');
?>
<?
	if ($Id==UsuarioId()) {
?>
<p>
Actualice sus preferencias. Esto nos permitir&aacute; darle un mejor servicio. Recuerde que puede ganar
puntos leyendo nuestros emails.
<?
	}
?>
<center>
<p>
<form action="UsuarioPreferenciasGraba.php" method="post">
<table cellspacing=1 cellpadding=2 class="Formulario">
<?
function CampoCheckGeneraEx($nombre,$leyenda,$valor,$requerido=false) {
	FilaCampoInicio();
	CampoInicio();
	CheckGenera($nombre,$leyenda,$valor);
	CampoFinal();
	FilaCampoFinal();
}

	CampoCheckGeneraEx("Novedades","Deseo recibir novedades sobre todocontenidos.com en mi email", $preferencias->Novedades);
	CampoCheckGeneraEx("Html", "Deseo recibir emails en formato HTML", $preferencias->Html);
	FilaCampoInicio();
	CampoInicio();
	echo "Deseo recibir emails sobre los siguientes temas<br>";
	CheckGenera("Internet","Internet",$preferencias->Internet);
	echo "<br>";
	CheckGenera("Negocios","Negocios",$preferencias->Negocios);
	echo "<br>";
	CheckGenera("Empleo","Empleo",$preferencias->Empleo);
	echo "<br>";
	CheckGenera("Educacion","Educación",$preferencias->Empleo);
	echo "<br>";
	CheckGenera("Finanzas","Finanzas",$preferencias->Finanzas);
	echo "<br>";
	CheckGenera("Computacion","Computaci&oacute;n",$preferencias->Computacion);
	echo "<br>";
	CheckGenera("Ciencia","Ciencia",$preferencias->Ciencia);
	echo "<br>";
	CheckGenera("Tecnologia","Tecnolog&iacute;a",$preferencias->Tecnologia);
	echo "<br>";
	CheckGenera("Deportes","Deportes",$preferencias->Deportes);
	echo "<br>";
	CheckGenera("Viajes","Viajes",$preferencias->Viajes);
	echo "<br>";
	CheckGenera("Compras","Compras",$preferencias->Compras);
	echo "<br>";
	CheckGenera("Juegos","Juegos",$preferencias->Juegos);
	echo "<br>";
	CheckGenera("Entretenimiento","Entretenimiento",$preferencias->Entretenimiento);
	echo "<br>";
	CheckGenera("Salud","Salud",$preferencias->Salud);
	echo "<br>";
	CheckGenera("Familia","Familia",$preferencias->Familia);
	CampoFinal();
	FilaCampoFinal();

?>
</table>
<br>
<input type="submit" value="Aceptar">
<input type="hidden" value="<? echo $preferencias->Id ?>" name="Id">
<input type="hidden" value="<? echo $Id ?>" name="IdUsuario">

</form>
</p>
</center>
<?
	Desconectar();
	require('Final.inc.php');
?>

