<?
if (__Articulos_inc == 1)
	return;
define ('__Articulos_inc', 1);

	define('ARTICULOS_CLASE_ARTICULO',1);
	define('ARTICULOS_CLASE_NOTICIA',2);

	$ArticulosClases = array(ARTICULOS_CLASE_ARTICULO => 'Artículo',
		ARTICULOS_CLASE_NOTICIA => 'Noticia');

	include_once($PaginaPrefijo.'Usuarios.inc.php');
	include_once($PaginaPrefijo.'Conexion.inc.php');

function ArticuloVisita($Id) {
	Conectar();
	mysql_query("update articulos set Visitas = Visitas + 1 where Id = $Id");
	Desconectar();
}

function ArticuloVoto($Id,$Voto) {
	Conectar();
	mysql_query("update articulos set Votos$Voto = Votos$Voto + 1 where Id = $Id");
	Desconectar();
}

function ArticuloVotado($Id) {
	global $REMOTE_ADDR;

	Conectar();
	if (UsuarioIdentificado()) {
		$IdUsuario = UsuarioId();
		$rsVotos = mysql_query("select * from eventos where tipo='VA' and IdUsuario = $IdUsuario and IdParametro = $Id and FechaHora >= (Now()-Interval 1 day)");
		if (mysql_num_rows($rsVotos))
			$Votado=1;
		else
			$Votado=0;
		mysql_free_result($rsVotos);
	}
	else {
		$rsVotos = mysql_query("select * from eventos where tipo='VA' and IP = '$REMOTE_ADDR' and IdUsuario=0 and IdParametro = $Id and FechaHora >= (Now()-Interval 1 hour)");
		if (mysql_num_rows($rsVotos))
			$Votado=1;
		else
			$Votado=0;
		mysql_free_result($rsVotos);
	}

	Desconectar();

	return $Votado;
}

function ArticuloPromedio($Votos1,$Votos2,$Votos3,$Votos4,$Votos5)
{
	$Total = $Votos1 + $Votos2 + $Votos3 + $Votos4 + $Votos5;

	if (!$Total)
		return 'Sin Votos';

	$Suma = $Votos1 + 2 * $Votos2 + 3 * $Votos3 + 4 * $Votos4 + 5 * $Votos5;

	return number_format($Suma / $Total,2);
}

function ArticuloClaseTraduce($clase) {
	global $ArticulosClases;

	if ($ArticulosClases[$clase])
		return $ArticulosClases[$clase];

	return $clase;
}

?>