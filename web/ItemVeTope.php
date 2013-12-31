<?php
    include_once('Settings.inc.php');
    
	include_once('Paginas.inc.php');
	include_once('Items.inc.php');
	include_once('Conexion.inc.php');
?>

<html>
<head>

<link rel="stylesheet" href="css/Estilo.css">
</head>

<body bgcolor=#ffffff leftmargin=0 topmargin=0 marginwidth=0 marginheight=0>

<table width="100%" class="Tope" cellspacing=0 cellpadding=0 border=0>
<tr height=60>
<td class="TituloSitio">
<!-- &nbsp;todocontenidos.com -->
<a href="<?php echo PaginaPrincipal(); ?>" target="_top"><img src="images/ajlopez2.gif" border=0></a></td>

<td align="center">
<p>
<a href='http://www.ajlopez.net/puntonet' target='_top'>.NET</a>
&nbsp;&nbsp;
<a href='http://www.ajlopez.net/Tema.php?Id=43' target='_top'>ASP.NET</a>
&nbsp;&nbsp;
<a href='http://www.ajlopez.net/Tema.php?Id=18' target='_top'>C#</a>
&nbsp;&nbsp;
<a href='http://www.ajlopez.net/Tema.php?Id=13' target='_top'>COBOL</a>
&nbsp;&nbsp;
<a href='http://www.ajlopez.net/java' target='_top'>Java</a>
&nbsp;&nbsp;
<a href='http://www.ajlopez.net/oracle' target='_top'>Oracle</a>
&nbsp;&nbsp;
<a href='http://www.ajlopez.net/Tema.php?Id=47' target='_top'>Patrones</a>
&nbsp;&nbsp;
<a href='http://www.ajlopez.net/php' target='_top'>PHP</a>
&nbsp;&nbsp;
<a href='http://www.ajlopez.net/programacion' target='_top'>Programaci&oacute;n</a>
&nbsp;&nbsp;
<a href='http://www.ajlopez.net/Tema.php?Id=14' target='_top'>Smalltalk</a>
&nbsp;&nbsp;
<a href='http://www.ajlopez.net/uml' target='_top'>UML</a>
&nbsp;&nbsp;
<a href='http://www.ajlopez.net/vb' target='_top'>Visual Basic</a>
&nbsp;&nbsp;
<a href='http://www.ajlopez.net/Tema.php?Id=19' target='_top'>VB.NET</a>
&nbsp;&nbsp;
<a href='http://www.ajlopez.net/webmasters' target='_top'>Webmasters</a>
&nbsp;&nbsp;
<a href='http://www.ajlopez.net/xml' target='_top'>XML</a>
</td>

</tr>
</table>

<?php
	Conectar();

	$rsItem = mysql_query("select Visitas, Url, Votos1, Votos2, Votos3, Votos4, Votos5 from items where Id = $Id");
	list($Visitas, $Url, $Votos1, $Votos2, $Votos3, $Votos4, $Votos5) = mysql_fetch_row($rsItem);
	mysql_free_result($rsItem);

	if (!$Votado)
		$Votado = ItemVotado($Id);
?>

<table width=100% bgcolor=black cellspacing=1 cellpadding=0>
<tr>
<?php
	if (!$Votado) {
?>
<td bgcolor="#e71212" align=left>
<font class=headerU><b>&nbsp;&nbsp;Vote 
&nbsp;&nbsp;<a class=headerU href="ItemVoto.php?Id=<?php echo $Id ?>&Voto=1">1=Malo</a>
&nbsp;&nbsp;<a class=headerU href="ItemVoto.php?Id=<?php echo $Id ?>&Voto=2">2=Regular</a>
&nbsp;&nbsp;<a class=headerU href="ItemVoto.php?Id=<?php echo $Id ?>&Voto=3">3=Bueno</a>
&nbsp;&nbsp;<a class=headerU href="ItemVoto.php?Id=<?php echo $Id ?>&Voto=4">4=Muy Bueno</a>
&nbsp;&nbsp;<a class=headerU href="ItemVoto.php?Id=<?php echo $Id ?>&Voto=5">5=Excelente</a>
</b>
</font>
</td>
<?php
	}
	else {
		$Promedio=ItemPromedio($Votos1,$Votos2,$Votos3,$Votos4,$Votos5);
?>
<td bgcolor="#e71212" align=left>
<font class=headerU><b>&nbsp;&nbsp;
<?php echo $Visitas; ?> Visitas
</b>
</font>
</td>
<td bgcolor="#e71212" align=left>
<font class=headerU><b>&nbsp;&nbsp;
Voto Promedio <?php echo $Promedio; ?>
</b>
</font>
</td>
<?php
	}
?>

<td bgcolor="#e71212" align=center>
<font class=headerU><b>
<a class=headerU href="<?php echo $Url; ?>" target="_top">Quitar Marco</a>
</b>
</font>
</td>


<td bgcolor="#000000" align=right>
<font class=headerU><b>El sitio de Angel "Java" Lopez</b>&nbsp;&nbsp;&nbsp;&nbsp;</font>
</td>
</table>

</html>

<?php
	Desconectar();
?>
