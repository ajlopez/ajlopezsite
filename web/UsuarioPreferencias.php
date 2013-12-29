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

	SesionPone('PreferenciasEnlace',PaginaActual());

	$sql = "select * from preferencias where IdUsuario = $Id";
	$res = mysql_query($sql);
	$preferencias = mysql_fetch_object($res);
	mysql_free_result($res);
	$PaginaTitulo = "Preferencias del Usuario";

	if ($Id==UsuarioId())
		$PaginaTitulo = "Mis Preferencias";

	require('Inicio.inc.php');
?>
<p align="center">
<a href="UsuarioPreferenciasActualiza.php?Id=<? echo $Id; ?>">Actualiza</a>
<?
	if ($Id==UsuarioId()) {
?>
<p>
Estas son sus preferencias. Puede <a href="UsuarioPreferenciasActualiza.php?Id=<? echo $Id; ?>">actualizarlas</a> en cualquier momento.
<?
	}
?>
<center>
<p>
<table cellspacing=1 cellpadding=2 class="Formulario">
<?
function EstaticoGeneraEx($leyenda) {
	EstaticoGenera($leyenda . "<br>");
}

	CampoEstaticoGenera("Deseo recibir novedades sobre todocontenidos.com en mi email?", TextoSiNo($preferencias->Novedades));
	CampoEstaticoGenera("Deseo recibir email en formato HTML?", TextoSiNo($preferencias->Html));
	FilaCampoInicio();
	LeyendaGenera("Deseo recibir informaci&oacute;n peri&oacute;dica sobre estos temas");
	CampoInicio();
	if ($preferencias->Internet)
		EstaticoGeneraEx('Internet');
	if ($preferencias->Negocios)
		EstaticoGeneraEx('Negocios');
	if ($preferencias->Empleo)
		EstaticoGeneraEx('Empleo');
	if ($preferencias->Educacion)
		EstaticoGeneraEx('Educaci&oacute;n');
	if ($preferencias->Finanzas)
		EstaticoGeneraEx('Finanzas');
	if ($preferencias->Computacion)
		EstaticoGeneraEx('Computaci&oacute;n');
	if ($preferencias->Ciencia)
		EstaticoGeneraEx('Ciencia');
	if ($preferencias->Tecnologia)
		EstaticoGeneraEx('Tecnolog&iacute;a');
	if ($preferencias->Deportes)
		EstaticoGeneraEx('Deportes');
	if ($preferencias->Viajes)
		EstaticoGeneraEx('Viajes');
	if ($preferencias->Compras)
		EstaticoGeneraEx('Compras');
	if ($preferencias->Juegos)
		EstaticoGeneraEx('Juegos');
	if ($preferencias->Entretenimiento)
		EstaticoGeneraEx('Entretenimiento');
	if ($preferencias->Salud)
		EstaticoGeneraEx('Salud');
	if ($preferencias->Familia)
		EstaticoGeneraEx('Familia');
	CampoFinal();
	FilaCampoFinal();	
?>
</table>
</p>
</center>
<?
	Desconectar();
	require('Final.inc.php');
?>

