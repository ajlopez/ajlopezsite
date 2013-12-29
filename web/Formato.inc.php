<?
if (__Formato_inc == 1)
	return;
define ('__Formato_inc', 1);

function ProcesaEnlaceExterno($file)
{
	$linea = chop(fgets($file,1024));
	echo "<a href='$linea' target='_blank'>";
	ProcesaLinea($file);
	echo "</a>\n";
}

function ProcesaEnlace($file)
{
	$linea = chop(fgets($file,1024));
	echo "<a href='$linea'>";
	ProcesaLinea($file);
	echo "</a>\n";
}

function ProcesaImagen($file)
{
	$linea = chop(fgets($file,1024));
	echo "<center>\n";
	echo "<img src='$linea' border=0>";
	echo "</center>\n";
}

function ProcesaCodigo($file)
{
	global $NoHtml;
	$NoHtmlAnt = $NoHtml;

	echo "<xmp>\n";
	$NoHtml = true;
	ProcesaBloque($file);
	echo "</xmp>\n";
	$NoHtml = $NoHtmlAnt;
}

function ProcesaTexto($file)
{
	global $NoHtml;
	$NoHtmlAnt = $NoHtml;

	$NoHtml = true;
	ProcesaBloque($file);
	$NoHtml = $NoHtmlAnt;
}

function ProcesaHtml($file)
{
	global $EsHtml;
	$EsHtmlAnt = $EsHtml;

	echo "<div class=code>\n";
	echo "<code>";
	$EsHtml = true;
	ProcesaBloque($file);
	echo "</code>\n";
	echo "</div>\n";
	$EsHtml = $EsHtmlAnt;
}

function ProcesaCorte($file)
{
	echo "<br>\n";
}

function ProcesaTitulo($file)
{
	echo "<h1>";
	ProcesaLinea($file);
	echo "</h1>\n";
}

function ProcesaTitulo2($file)
{
	echo "<h2>";
	ProcesaLinea($file);
	echo "</h2>\n";
}

function ProcesaTitulo3($file)
{
	echo "<h3>";
	ProcesaLinea($file);
	echo "</h3>\n";
}

function ProcesaSeparacion($file)
{
	echo "<hr>\n";
}

function ProcesaNegrita($file)
{
	echo "<b>";
	ProcesaLinea($file);
	echo "</b>";
}

function ProcesaComando($file,$linea)
{
	switch ($linea) {
		case ".h\n":
		case ".H\n":
			ProcesaTitulo($file);
			break;
		case ".h2\n":
		case ".H2\n":
			ProcesaTitulo2($file);
			break;
		case ".h3\n":
		case ".H3\n":
			ProcesaTitulo3($file);
			break;
		case ".hr\n":
		case ".Hr\n":
			ProcesaSeparacion($file);
			break;
		case ".b\n":
		case ".B\n":
			ProcesaNegrita($file);
			break;
		case ".br\n":
		case ".BR\n":
			ProcesaCorte($file);
			break;
		case ".im\n":
		case ".IM\n":
			ProcesaImagen($file);
			break;
		case ".ax\n":
		case ".AX\n":
			ProcesaEnlaceExterno($file);
			break;
		case ".a\n":
		case ".A\n":
			ProcesaEnlace($file);
			break;
		case ".code\n":
		case ".CODE\n":
			ProcesaCodigo($file);
			break;
		case ".html\n":
		case ".HTML\n":
			ProcesaHtml($file);
			break;
		case ".text\n":
		case ".TEXT\n":
			ProcesaTexto($file);
			break;
	}
}

function EsComando($linea)
{
	if (substr($linea,0,1)=='.')
		return true;

	return false;
}

function EmiteLinea($linea)
{
	global $NoHtml;
	global $EsHtml;

	if ($NoHtml)
		echo $linea;
	else if ($EsHtml) {
		$linea = str_replace(" ","&nbsp;",$linea);
		$linea = str_replace("\t","&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$linea);		
		$linea = str_replace("<%","@lt%@",$linea);
		$linea = str_replace("%>","@gt%@",$linea);
		$linea = str_replace("<?","@lt?@",$linea);
		$linea = str_replace("?>","@gt?@",$linea);
		$linea = str_replace("<","@lt@",$linea);
		$linea = str_replace(">","@gt@",$linea);
		$linea = str_replace("@lt@","<span class=tag>&lt;",$linea);
		$linea = str_replace("@gt@","&gt;</span>",$linea);
		$linea = str_replace("@lt%@","<span class=asp>&lt;%",$linea);
		$linea = str_replace("@gt%@","%&gt;</span>",$linea);
		$linea = str_replace("@lt?@","<span class=php>&lt;?",$linea);
		$linea = str_replace("@gt?@","?&gt;</span>",$linea);
		echo $linea;
		echo "<br>\n";
	}
	else {
		$linea = htmlentities($linea);
		$linea = str_replace("{{","<b>",$linea);
		$linea = str_replace("}}","</b>",$linea);	
		echo $linea;
	}
}

function ProcesaUnaLinea($linea,$file)
{	
	global $NoHtml;
	global $EsHtml;

	if (!$linea)
		return false;

	if ($linea=="\n" && !$NoHtml && !$EsHtml) {
		echo "<p>";
		return true;
	}

	if (EsComando($linea)) {
		ProcesaComando($file,$linea);
		return true;
	}

	EmiteLinea($linea);

	return true;
}

function ProcesaLinea($file)
{
	$linea = fgets($file,10000);

	return ProcesaUnaLinea($linea,$file);
}

function ProcesaBloque($file)
{
	while ($linea=fgets($file,10000)) {
		if ($linea==".\n")
			return;
		if (!ProcesaUnaLinea($linea,$file))
			return;
	}
}

function ProcesaArchivo($file)
{
	while (ProcesaLinea($file))
		;
}

?>