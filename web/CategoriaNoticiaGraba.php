<?php
    include_once('Settings.inc.php');
    
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Sesion.inc.php');
	include_once('Validaciones.inc.php');
	include_once('Usuarios.inc.php');

	Conectar();

	UsuarioControla();

	$IdCategoriaNoticia += 0;
	$IdCategoria += 0;
	$IdNoticia += 0;

	if (!$IdCategoria)
		$mensaje .= "Debe especificar Categor&iacute;a<br>";
	if (!$IdNoticia)
		$mensaje .= "Debe especificar Enlace<br>";
	if ($mensaje)
		ErrorMuestra($mensaje);	

	if ($IdCategoriaNoticia)
		$sql = "Update categoriasnoticias Set ";
	else
		$sql = "Insert categoriasnoticias Set ";

	$sql = $sql .  "
		IdNoticia = $IdNoticia, 
		IdCategoria = $IdCategoria";

	if ($IdCategoriaNoticia)
		$sql = $sql . " where Id = $IdCategoriaNoticia";

	mysql_query($sql);
	$IdNuevo = mysql_insert_id();

	$NoticiaEnlace = SesionToma("NoticiaEnlace");
	SesionSaca("NoticiaEnlace");

	if (!$NoticiaEnlace)
		$NoticiaEnlace = "Noticias.php";

	header("Location: $NoticiaEnlace");
	exit;
?>