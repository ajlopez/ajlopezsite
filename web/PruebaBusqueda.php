<?
	$PaginaTitulo = $Archivo;

	$file = fopen($Archivo,"r");

	include('Conexion.inc.php');
//	include('Inicio.inc.php');

	define("EST_URL",1);
	define("EST_TITULO",2);
	define("EST_DESCRIPCION",3);

	Conectar();

function AgregaCategoria($idcat,$iditem)
{
	if (!$idcat || !$iditem)
		return;

	$rs = mysql_query("select id from categoriasitems where IdCategoria = $idcat and IdItem = $iditem");

	if (!mysql_num_rows($rs))
		mysql_query("insert categoriasitems set IdCategoria = $idcat, IdItem = $iditem, Estado=1");
}

function GrabaDato()
{
	global $datourl;
	global $datotitulo;
	global $datodescripcion;
	global $IdCategoria;
	global $Graba;

	echo "<br>";
	echo "Enlace: $datourl<br>";
	echo "Titulo: $datotitulo<br>";
	echo "Descripcion: $datodescripcion<br>";
	echo "<br>";

	if (!$Graba)
		return;

	$datotitulo = addSlashes($datotitulo);
	$datodescripcion = addSlashes($datodescripcion);

	$rs = mysql_query("select id from items where Url = '$datourl' or Descripcion='$datotitulo'");

	if (mysql_num_rows($rs)) {
		list($id) = mysql_fetch_row($rs);
		mysql_free_result($rs);

		if ($IdCategoria)
			AgregaCategoria($IdCategoria,$id);
		
		return;
	}


	mysql_query("insert items set Url = '$datourl', Descripcion = '$datotitulo', Detalle = '$datodescripcion', Estado=1");

	if (mysql_errno()) 
		echo mysql_error()."<br>";
	else {
		AgregaCategoria($IdCategoria,mysql_insert_id());
		echo "Grabado<br><br>";
	}
}

function SacaHTML($linea)
{
	global $esmenor;

	if (!$esmenor) {
		$posmayor = strpos($linea,'<');

		if ($posmayor===false)
			return $linea;

		$posmenor = strpos($linea,'>',$posmayor+1);
		if (!$posmenor) {
			$esmenor = true;
			return substr($linea,0,$posmayor);
		}
		$linea = substr($linea,0,$posmayor) . substr($linea,$posmenor+1);

		return SacaHTML($linea);
	}

	$posmenor = strpos($linea,'>');

	if ($posmenor===false)
		return '';

	$linea = substr($linea,$posmenor+1);

	$esmenor = false;

	return SacaHTML($linea);
}

function ProcesaLinea($linea)
{
	global $ultimaurl;
	global $estado;
	global $esmenor;
	global $datourl;
	global $datotitulo;
	global $datodescripcion;

	$poshttp = strpos($linea,'"http:');

	if ($poshttp) {
		$poshttp2 = strpos($linea,'"',$poshttp+1);
		$url = substr($linea,$poshttp+1,$poshttp2-$poshttp-1);
		if (!strpos($url,"copernic") && $url<>$ultimaurl) {
			if ($ultimaurl) {
				GrabaDato();
				echo "=====<br>";
			}
			echo "$url<br><br>";
			$ultimaurl = $url;
			$estado = EST_TITULO;
			$datourl = $url;
			$datotitulo = '';
			$datodescripcion = '';
		}
	}

	$posdescription = strpos($linea,"Description");

	if ($posdescription && $ultimaurl) {
		echo "<br>";
		$estado = EST_DESCRIPCION;
	}

	$linea = SacaHtml($linea);
	$linea = str_replace("<","&lt;",$linea);
	$linea = str_replace(">","&gt;",$linea);
	$linea = str_replace("&nbsp;"," ",$linea);
	$linea = str_replace("  "," ",$linea);
	$linea = str_replace("√°","·",$linea);
	$linea = str_replace("√Å","A",$linea);
	$linea = str_replace("√≥","Û",$linea);
	$linea = str_replace("√±","Ò",$linea);
	$linea = str_replace("√","Ì",$linea);
	$linea = str_replace("¬ø","ø",$linea);
	$linea = str_replace("Ì©","È",$linea);

	$poslocalizado = strpos($linea,"Localizado");

	if (!($poslocalizado===false)) {
		$estado=0;
	}

	$linea = Chop($linea);

	if (substr($linea,strlen($linea)-1,1)=='%')
		$linea='';

	if ($estado && $linea) {
		echo "$linea<br>";
		if ($estado==EST_DESCRIPCION) {
			if ($datodescripcion)
				$datodescripcion .= ' ';
			$datodescripcion .= $linea;
		}
		if ($estado==EST_TITULO) {
			if ($datotitulo) 
				$datotitulo .= ' ';
			$datotitulo .= $linea;
		}
	}
}

	while ($linea=fgets($file,20000))
		ProcesaLinea($linea);

	fclose($file);
?>

<?
//	include('Final.inc.php');
	Desconectar();
?>

