<?
	include($PaginaPrefijo.'Usuarios.inc.php');
	include($PaginaPrefijo.'Paginas.inc.php');
	include($PaginaPrefijo.'Cache.inc.php');
	include($PaginaPrefijo.'Configuracion.inc.php');
?>

<html>
<head>

<title><? echo $PaginaTitulo; ?></title>

<META name="title" content="ajlopez Angel Java Lopez Website">
<META name="description" content="ajlopez Angel Java Lopez Website">
<META name="keywords" content="ajlopez, Angel Java Lopez, visual basic, .net, xml, programming, windows, linux, php, asp, .net, jsp, webmasters, internet, courses, training">
<META name="language" content="es">
<META name="revisit-after" content="3 days">
<META name="rating" content="General">
<META name="author" content="Angel J Lopez">
<META name="owner" content="Angel J Lopez">
<META name="robot" content="index, follow">

<link rel="stylesheet" href="<? echo $PaginaPrefijo; ?>css/Estilo.css">
<?
	if ($ArchivoJs)
		echo "<script language='javascript' src='js/$ArchivoJs'></script>\n";
?>
</head>

<body bgcolor=#ffffff leftmargin=0 topmargin=0 marginwidth=0 marginheight=0>

<table width="100%" class="Tope" cellspacing=0 cellpadding=0 border=0>
<tr height=60>
<td class="TituloSitio">
<!-- &nbsp;ajlopez.net -->
<a href="<?= $PaginaPrefijo ?><? echo PaginaPrincipal(); ?>" target="_top">
<img src="<? echo $PaginaPrefijo; ?>images/ajlopez2.gif" border=0>
</a>
</td>
<td valign="bottom" align="right">
<div>
<form action='<?= $PaginaPrefijo ?>en/Search.php' action='post'><input type=text name='Filter' size=14 value='<?= $Filtro ?>'>&nbsp;<input type=submit value='Search'></form></div>
</td>
</tr>
</table>

<table width="100%" class="Tope" cellspacing=0 cellpadding=0 border=0>
<tr>
<td>

<table width=100% cellspacing=0 cellpadding=0 border=0>
<tr height=23 bgcolor=white>
<td align="left" valign="top" background="<? echo $PaginaPrefijo; ?>images/2bg.gif">
<img src="<? echo $PaginaPrefijo; ?>images/2.gif" height=23></td></tr>
<tr  bgcolor=black>
<td bgcolor="#000000" align=right>
<font class=headerU><b>Angel "Java" Lopez Website</b>&nbsp;&nbsp;&nbsp;&nbsp;</font>
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
<?
function GeneraOpcionTope($texto,$enlace)
{
	global $PaginaPrefijo;
?>
<A class=navlink target='_top' href="<? echo $PaginaPrefijo.$enlace ?>"><? echo $texto ?></A>&nbsp;&nbsp;|&nbsp&nbsp;
<?
}

function GeneraOpcionTopeExterno($texto,$enlace)
{
	global $PaginaPrefijo;
?>
<A class=navlink target='_blank' href="<? echo $enlace ?>"><? echo $texto ?></A>&nbsp;&nbsp;|&nbsp&nbsp;
<?
}

	GeneraOpcionTope("ajlopez","en/".PaginaPrincipal());
	GeneraOpcionTope("Topics","en/Topics.php");
	GeneraOpcionTope("Projects","en/Projects.php");
	GeneraOpcionTopeExterno("Blog","http://ajlopez.wordpress.com");
	GeneraOpcionTope("Contact","en/Contact.php");
	GeneraOpcionTope("Spanish Version",PaginaPrincipal());
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

<td width=120 height=500 valign="top" class="izquierda">

<br>

<center>

<?
function MenuInicio($titulo)
{
?>
<p>
<table class="menu" cellspacing=1 cellpadding=2 width="95%">
<tr>
<td align=center class="menutitulo">
<? echo $titulo; ?>
</td>
</tr>
</tr>
<td valign="top" class="menuopcion">
<?
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

<?
}
?>

<?
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

	MenuInicio('Topics');
	MenuOpcion('All Topics','en/Topics.php');
	MenuOpcion('Programming','en/programming');
	MenuOpcion('Java','en/java');
	MenuOpcion('.Net','en/dotnet');
	MenuOpcion('Art. Intelligence','en/ai');
	MenuOpcion('XML','en/xml');
	MenuOpcion('UML/UP','en/uml');
	MenuOpcion('Visual Basic','en/vb');
	MenuOpcion('PHP','en/php');
	MenuOpcion('Webmasters','en/webmasters');
	MenuOpcion('Internet','en/internet');
	MenuOpcion('Oracle','en/oracle');
	MenuOpcion('Entrepeneurship','en/entrepeneur');
	MenuFinal();
}
?>



</center>

</td>

<td valign="top">

<table width=100% cellspacing=10 border=0 cellpadding=0>
<tr>
<td>

<p>

<?
	if (!$PaginaTituloInvisible) {
?>
<h1 align="center"><? echo $PaginaTitulo ?></h1>
<?
	}
?>

