<?
	$PaginaPrefijo = '../';
	include($PaginaPrefijo.'Paginas.inc.php');
	include($PaginaPrefijo.'Articulos.inc.php');
	include($PaginaPrefijo.'Conexion.inc.php');
	include($PaginaPrefijo.'Utiles.inc.php');
?>

<html>
<head>

<link rel="stylesheet" href="<? echo $PaginaPrefijo; ?>css/Estilo.css">
</head>

<body bgcolor=#ffffff leftmargin=0 topmargin=0 marginwidth=0 marginheight=0>

<table width="100%" class="Tope" cellspacing=0 cellpadding=0 border=0>
<tr height=60>
<td class="TituloSitio">
<a href="<? echo PaginaPrincipal(); ?>" target="_top">
<img src="<?= $PaginaPrefijo?>images/ajlopez2.gif" border=0>
</a>
</td>
<td align="center">
<p>
<a href='http://www.ajlopez.net/dotnet' target='_top'>.NET</a>
&nbsp;&nbsp;
<a href='http://www.ajlopez.net/en/Topic.php?Id=43' target='_top'>ASP.NET</a>
&nbsp;&nbsp;
<a href='http://www.ajlopez.net/en/Topic.php?Id=18' target='_top'>C#</a>
&nbsp;&nbsp;
<a href='http://www.ajlopez.net/en/Topic.php?Id=13' target='_top'>COBOL</a>
&nbsp;&nbsp;
<a href='http://www.ajlopez.net/en/java' target='_top'>Java</a>
&nbsp;&nbsp;
<a href='http://www.ajlopez.net/en/oracle' target='_top'>Oracle</a>
&nbsp;&nbsp;
<a href='http://www.ajlopez.net/en/Topic.php?Id=47' target='_top'>Patterns</a>
&nbsp;&nbsp;
<a href='http://www.ajlopez.net/en/php' target='_top'>PHP</a>
&nbsp;&nbsp;
<a href='http://www.ajlopez.net/en/programming' target='_top'>Software Development</a>
&nbsp;&nbsp;
<a href='http://www.ajlopez.net/en/Topic.php?Id=14' target='_top'>Smalltalk</a>
&nbsp;&nbsp;
<a href='http://www.ajlopez.net/en/uml' target='_top'>UML</a>
&nbsp;&nbsp;
<a href='http://www.ajlopez.net/en/vb' target='_top'>Visual Basic</a>
&nbsp;&nbsp;
<a href='http://www.ajlopez.net/en/Topic.php?Id=19' target='_top'>VB.NET</a>
&nbsp;&nbsp;
<a href='http://www.ajlopez.net/en/webmasters' target='_top'>Webmasters</a>
&nbsp;&nbsp;
<a href='http://www.ajlopez.net/en/xml' target='_top'>XML</a>
</td>
</tr>
</table>

<?
	Conectar();

	$rsArticulo = mysql_query("select Visitas, Votos1, Votos2, Votos3, Votos4, Votos5, Enlace from articulos where Id = $Id");
	list($Visitas, $Votos1, $Votos2, $Votos3, $Votos4, $Votos5, $Url) = mysql_fetch_row($rsArticulo);
	mysql_free_result($rsArticulo);

	if (!$Votado)
		$Votado = ArticuloVotado($Id);
?>

<table width=100% bgcolor=black cellspacing=1 cellpadding=0>
<tr>
<?
	if (!$Votado) {
?>
<td bgcolor="#e71212" align=left>
<font class=headerU><b>&nbsp;&nbsp;Vote 
&nbsp;&nbsp;<a class=headerU href="ArticleVote.php?Id=<? echo $Id ?>&Voto=1">1=Bad</a>
&nbsp;&nbsp;<a class=headerU href="ArticleVote.php?Id=<? echo $Id ?>&Voto=2">2=Regular</a>
&nbsp;&nbsp;<a class=headerU href="ArticleVote.php?Id=<? echo $Id ?>&Voto=3">3=Good</a>
&nbsp;&nbsp;<a class=headerU href="ArticleVote.php?Id=<? echo $Id ?>&Voto=4">4=Very Good</a>
&nbsp;&nbsp;<a class=headerU href="ArticleVote.php?Id=<? echo $Id ?>&Voto=5">5=Excellent</a>
</b>
</font>
</td>
<?
	}
	else {
		$Promedio=ArticuloPromedio($Votos1,$Votos2,$Votos3,$Votos4,$Votos5);
?>
<td bgcolor="#e71212" align=left>
<font class=headerU><b>&nbsp;&nbsp;
<? echo $Visitas; ?> Visits
</b>
</font>
</td>

<td bgcolor="#e71212" align=left>
<font class=headerU><b>&nbsp;&nbsp;
Average Vote <? echo $Promedio; ?>
</b>
</font>
</td>
<?
	}
?>

<td bgcolor="#e71212" align=center>
<font class=headerU><b>
<a class=headerU href="<? echo NormalizaUrl($Url); ?>" target="_top">Without Frame</a>
</b>
</font>
</td>


<td bgcolor="#000000" align=right>
<font class=headerU><b>Angel "Java" Lopez Website</b>&nbsp;&nbsp;&nbsp;&nbsp;</font>
</td>
</table>
</body>
</html>

<?
	Desconectar();
?>
