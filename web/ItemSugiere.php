<?php
    include_once('Settings.inc.php');
    
	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Usuarios.inc.php');
	include_once('Paginas.inc.php');
	include_once('Categorias.inc.php');
	include_once('Puntos.inc.php');

	Conectar();

	$PaginaTitulo = "Agregar Sitio o Enlace";

	include('Inicio.inc.php');

	if ($IdCategoria)
		CategoriaTraduce($IdCategoria,$CatDescripcion,$CatPadre);
	else {
		$sql = "select id, descripcion from categorias where IdPadre=0 order by descripcion";
		$rsCategorias = mysql_query($sql);
	}
?>

<center>

<p>

<?php
	if (UsuarioIdentificado()) {
		echo UsuarioSexoSufijo("Estimad");
		echo ' ';
		echo UsuarioNombreCompleto();
?>
: Gracias por colaborar con nuestro sitio. Por favor, ingrese los datos del enlace o sitio con precisi&oacute;n.
En caso de aceptar su sugerencia, le acreditaremos <b><?php echo PUNTOS_SITIO; ?> puntos</b> (sujeto a la aprobaci&oacute;n de los datos ingresados) en su cuenta de usuario, para que pueda aprovecharlos
en nuestras ofertas.

<p>
Los campos marcados con <font color=red>*</font> son obligatorios
<p>

<?php
	} else {
?>
Gracias por colaborar con nuestro sitio. Por favor, ingrese los datos del enlace o sitio con precisi&oacute;n.
<?php
	}
?>

<form action="ItemSugiereGraba.php" method=post>

<table cellspacing=1 cellpadding=2 class="Formulario">
<?php
	if ($IdCategoria)
		CampoEstaticoGenera("Tema", CategoriasEnlaces($IdCategoria,'Tema.php'));
	else
		CampoComboRsGenera("IdCategoria", "Categor&iacute;a", $rsCategorias, $IdCategoria, 'id', 'descripcion', true, true);

	CampoTextoGenera("Descripcion","Descripci&oacute;n",$Descripcion,50, true);
	CampoTextoGenera("Url", "Enlace", $Url, 50, true);
	CampoMemoGenera("Detalle","Detalle",$Detalle,10,50, true);

	CampoAceptarGenera();
?>
</table>

<?php
	if ($IdCategoria) {
?>
<input type="hidden" name="IdCategoria" value="<?php echo $IdCategoria; ?>">

<?php
	}
?>

</form>

</center>

<?php
	if ($rsCategorias)
		mysql_free_result($rsCategorias);

	Desconectar();
	include('Final.inc.php');
?>
