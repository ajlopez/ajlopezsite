<?php
	include_once($PaginaPrefijo.'Usuarios.inc.php');
	include_once($PaginaPrefijo.'Paginas.inc.php');
	include_once($PaginaPrefijo.'Cache.inc.php');
	include_once($PaginaPrefijo.'Configuracion.inc.php');
?>

<html>
<head>

<title><?php echo $PaginaTitulo; ?></title>

<META name="title" content="ajlopez El Sitio de Angel Java Lopez">
<META name="description" content="ajlopez El Sitio de Angel Java Lopez">
<META name="keywords" content="ajlopez, Angel Java Lopez, visual basic, .net, xml, programacion, windows, linux, php, asp, jsp, webmasters, internet, cursos">
<META name="language" content="es">
<META name="revisit-after" content="3 days">
<META name="rating" content="General">
<META name="author" content="Angel J Lopez">
<META name="owner" content="Angel J Lopez">
<META name="robot" content="index, follow">
<meta name="verify-v1" content="fB2Tl4bVNqSfmr2AGrqUCG8TWnKpR7xZeGStgEpqeBE=" />

<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1448255-1";
urchinTracker();
</script>

<link rel="stylesheet" href="<?php echo $PaginaPrefijo; ?>css/Estilo.css">
<?php
	if ($ArchivoJs)
		echo "<script language='javascript' src='js/$ArchivoJs'></script>\n";
?>
</head>

<body bgcolor=#ffffff leftmargin=0 topmargin=0 marginwidth=0 marginheight=0>

<table width="100%" class="Tope" cellspacing=0 cellpadding=0 border=0>
<tr height=60>
<td class="TituloSitio">
<!-- &nbsp;ajlopez.net -->
<a href="<?= $PaginaPrefijo ?><?php echo PaginaPrincipal(); ?>" target="_top">
<img src="<?php echo $PaginaPrefijo; ?>images/ajlopez2.gif" border=0>
</a>
</td>
<td valign="bottom" align="right">
<div>
<form action='<?= $PaginaPrefijo ?>Busqueda.php' action='post'><input type=text name='Filtro' size=14 value='<?= $Filtro ?>'>&nbsp;<input type=submit value='Buscar'></form></div>
</td>
</tr>
</table>

<table width="100%" class="Tope" cellspacing=0 cellpadding=0 border=0>
<tr>
<td>

<table width=100% cellspacing=0 cellpadding=0 border=0>
<tr height=23 bgcolor=white>
<td align="left" valign="top" background="<?php echo $PaginaPrefijo; ?>images/2bg.gif">
<img src="<?php echo $PaginaPrefijo; ?>images/2.gif" height=23></td></tr>
<tr  bgcolor=black>
<td bgcolor="#000000" align=right>
<font class=headerU><b>El sitio de Angel "Java" Lopez</b>&nbsp;&nbsp;&nbsp;&nbsp;</font>
</td>
</table>

</td>
</tr>

<tr>
<td>

<table width=100% cellspacing=0 cellpadding=0 border=0>
<TR bgColor=#454543>
<TD width=1 bgColor=#454543 rowSpan=3><IMG height=1 src="images/1x1.gif" width=1></TD>
<TD colspan=2><IMG height=1 src="images/1x1.gif" width=1></TD>
<TD width=1 bgColor=#454543 rowSpan=3><IMG height=1 src="images/1x1.gif" width=1></TD>
</TR>
<TR height=24>
<TD vAlign=center noWrap align=left width=* bgColor=#dedede>
&nbsp;&nbsp;
<?php
function GeneraOpcionTope($texto,$enlace)
{
	global $PaginaPrefijo;
?>
<A class=navlink target='_top' href="<?php echo $PaginaPrefijo.$enlace ?>"><?php echo $texto ?></A>&nbsp;&nbsp;|&nbsp&nbsp;
<?php
}

function GeneraOpcionTopeExterno($texto,$enlace)
{
	global $PaginaPrefijo;
?>
<A class=navlink target='_blank' href="<?php echo $enlace ?>"><?php echo $texto ?></A>&nbsp;&nbsp;|&nbsp&nbsp;
<?php
}

	GeneraOpcionTope("ajlopez",PaginaPrincipal());
	GeneraOpcionTope("Temas","Temas.php");
	GeneraOpcionTope("Cursos","CursosSeminarios.php");
	GeneraOpcionTope("Proyectos","Proyectos.php");
	GeneraOpcionTopeExterno("Blog","http://www.msmvps.com/blogs/lopez");
	GeneraOpcionTopeExterno("Blog en Ingl&eacute;s","http://ajlopez.wordpress.com/");
	GeneraOpcionTopeExterno("Blog no t&eacute;cnico","http://ajlopez.zoomblog.com/");
	GeneraOpcionTope("Contacto","Contacto.php");
	GeneraOpcionTope("English Version","en");
//	GeneraOpcionTope("Productos","Productos.php");
//	GeneraOpcionTope("Servicios","Servicios.php");
?>
</TD>
</TR>
<TR bgColor=#454543>
<TD colspan=2><IMG height=1 src="images/1x1.gif" width=1></TD>
</TR>
</TABLE>


</td>
</tr>


</table>

<table cellspacing="0" cellpadding="0" border="0" width="100%">
<tr>

<td width=180 height=500 valign="top" class="izquierda">

<br>

<center>

<?php
function MenuInicio($titulo)
{
?>
<p>
<table class="menu" cellspacing=1 cellpadding=2 width="95%">
<tr>
<td align=center class="menutitulo">
<?php echo $titulo; ?>
</td>
</tr>
</tr>
<td valign="top" class="menuopcion">
<?php
}

function MenuOpcion($texto,$enlace)
{
	global $PaginaPrefijo;

	echo "&nbsp;&nbsp;<strong>·</strong>&nbsp;&nbsp;";
	echo "<a target='_top' href='$PaginaPrefijo$enlace' class='menuopcion'>$texto</a>";
	echo "<br>\n";
}

function MenuOpcionRelativa($texto,$enlace)
{
	global $PaginaPrefijo;

	echo "&nbsp;&nbsp;<strong>·</strong>&nbsp;&nbsp;";
	echo "<a target='_top' href='$enlace' class='menuopcion'>$texto</a>";
	echo "<br>\n";
}

function MenuFinal()
{
?>
</td>
</tr>
</table>

<br>
<br>

</p>

<?php
}
?>

<?php
if ($PaginaMenu) {
	include_once($PaginaMenu);
}
else {
	if (UsuarioIdentificado()) {
		MenuInicio('Usuario');
		echo "<div align='center'>";
		echo "<font color='#000080'><b>" . UsuarioCodigo() . "</b></font></div>\n";
		echo "</td></tr><tr><td valign=top class=menuopcion>";
		MenuOpcion('Mis P&aacute;gina','UsuarioPagina.php');
//		MenuOpcion('Mis Cursos','UsuarioCursos.php');
		MenuOpcion('Mis Datos', 'Usuario.php');
		MenuOpcion('Mis Preferencias', 'UsuarioPreferencias.php');
//		MenuOpcion('Mis Favoritos', 'UsuarioFavoritos.php');
//		MenuOpcion('Mis Puntos', 'UsuarioPuntos.php');
		if (EsAdministrador()) {
			MenuOpcion('Administraci&oacute;n','Administrador.php');
			MenuOpcion('Usuarios','Usuarios.php');
			MenuOpcion('Categor&iacute;as','Categorias.php');
			MenuOpcion('Art&iacute;culos','Articulos.php');
			MenuOpcion('Items','Items.php');
			MenuOpcion('P&aacute;ginas','Paginas.php');
			MenuOpcion('Referencias','Referencias.php');
			MenuOpcion('Enviar Email','EnviarEmail.php');
			MenuOpcion('Eventos por Fecha','EventosPorFecha.php');
			MenuOpcion('Contactos','EjecutaSqlEx.php?Consulta='. urlencode("select * from contactos order by id desc"). '&Titulo=Contactos');
			MenuOpcion('Ingresos','Eventos.php?Tipo=IN');
			MenuOpcion('Registraciones','Eventos.php?Tipo=RG');
		}
		MenuOpcion('Recomendar', 'Recomendar.php');
		MenuOpcion('Salir', 'UsuarioSalir.php');
		MenuFinal();
	}
	else if (!$NoUsuario && EsLocal()) {
		MenuInicio('Usuarios');
		echo "<div align=center>\n";
		echo "<form action='UsuarioValida.php' method='post'>\n";

		echo "C&oacute;digo<br>\n";
		echo "<input style='font-size: 8pt;' type=text name=Codigo size=14><br>\n";
		echo "Contrase&ntilde;a<br>\n";
		echo "<input style='font-size: 8pt;' type=password name=Contrasenia size=14><br>\n";
		echo "<input style='font-size: 8pt;' type=submit value='Ingresar'>\n";
		echo "</form>\n";
		echo "</div>\n";
		echo "<p>";
		MenuOpcion('Registrarse', 'UsuarioActualiza.php');
		MenuOpcion('Recomendar', 'Recomendar.php');
		MenuFinal();
	}

	MenuInicio('Temas');
	MenuOpcion('Todos','Temas.php');
	MenuOpcion('Programaci&oacute;n','programacion');
	MenuOpcion('Java','java');
	MenuOpcion('.Net','puntonet');
	MenuOpcion('XML','xml');
	MenuOpcion('UML/UP','uml');
	MenuOpcion('Visual Basic','vb');
	MenuOpcion('PHP','php');
	MenuOpcion('Webmasters','webmasters');
	MenuOpcion('Internet','internet');
	MenuOpcion('Oracle','oracle');
	MenuOpcion('Emprender','emprender');
	MenuOpcion('Matem&aacute;ticas','matematicas');
	MenuFinal();
}
?>



</center>


</td>

<td valign="top" width="100%">

<table width=100% cellspacing=10 border=0 cellpadding=0>
<tr>
<td>

<p>

<?php
	if (!$PaginaTituloInvisible) {
?>
<h1 align="center"><?php echo $PaginaTitulo ?></h1>
<?php
	}
?>

