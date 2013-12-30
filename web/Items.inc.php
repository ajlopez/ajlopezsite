<?php
if (__Items_inc == 1)
	return;
define ('__Items_inc', 1);

	include_once('Usuarios.inc.php');
	include_once('Conexion.inc.php');

function ItemVisita($Id) {
	Conectar();
	mysql_query("update items set Visitas = Visitas + 1 where Id = $Id");
	Desconectar();
}

function ItemVoto($Id,$Voto) {
	Conectar();
	mysql_query("update items set Votos$Voto = Votos$Voto + 1 where Id = $Id");
	Desconectar();
}

function ItemVotado($Id) {
	global $REMOTE_ADDR;

	Conectar();
	if (UsuarioIdentificado()) {
		$IdUsuario = UsuarioId();
		$rsVotos = mysql_query("select * from eventos where tipo='VI' and IdUsuario = $IdUsuario and IdParametro = $Id and FechaHora >= (Now()-Interval 1 day)");
		if (mysql_num_rows($rsVotos))
			$Votado=1;
		else
			$Votado=0;
		mysql_free_result($rsVotos);
	}
	else {
		$rsVotos = mysql_query("select * from eventos where tipo='VI' and IP = '$REMOTE_ADDR' and IdUsuario=0 and IdParametro = $Id and FechaHora >= (Now()-Interval 1 hour)");
		if (mysql_num_rows($rsVotos))
			$Votado=1;
		else
			$Votado=0;
		mysql_free_result($rsVotos);
	}

	Desconectar();

	return $Votado;
}

function ItemPromedio($Votos1,$Votos2,$Votos3,$Votos4,$Votos5)
{
	$Total = $Votos1 + $Votos2 + $Votos3 + $Votos4 + $Votos5;

	if (!$Total)
		return 'Sin Votos';

	$Suma = $Votos1 + 2 * $Votos2 + 3 * $Votos3 + 4 * $Votos4 + 5 * $Votos5;

	return number_format($Suma / $Total, 2);
}

?>