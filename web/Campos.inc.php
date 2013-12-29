<?php

if (__Campos_inc == 1) return;
define ('__Campos_inc', 1);

$Meses2 = array(
  Ene => 1, Feb => 2, Mar => 3, Abr => 4,
  May => 5, Jun => 6, Jul => 7, Ago => 8,
  Set => 9, Oct => 10, Nov => 11, Dic => 12
);

$Meses = array(
  1 => Ene, 2 => Feb, 3 => Mar, 4 => Abr,
  5 => May, 6 => Jun, 7 => Jul, 8 => Ago,
  9 => Set, 10 => Oct, 11 => Nov, 12 => Dic
);

$Sexos = array( 1 => Masculino, 2 => Femenino );

function FilaCampoInicio() {
		echo "<tr>\n";
}

function FilaCampoFinal() {
		echo "</tr>\n";
}

function CampoInicio($align='left') {
		echo "<td class=Dato align=$align valign=top>";
}

function CampoFinal() {
		echo "</td>";
}

function SeparadorGenera($leyenda='&nbsp;') {
	echo "<tr><td colspan=2 class=Separador valign=top align=center>$leyenda</td></tr>\n";
}

function LeyendaGenera($leyenda='&nbsp;',$requerido=false) {
	echo "<td class=Leyenda valign=top>$leyenda";
	if ($requerido)
		echo " <font color=red>*</font>";
	echo "</td>\n";
}

function EstaticoGenera($leyenda) {
		echo "$leyenda\n";
}

function EnlaceGenera($leyenda,$enlace) {
		echo "<a href='$enlace'>$leyenda</a>";
}

function MemoEstaticoGenera($leyenda,$eshtml=0) {
	if ($eshtml)
		echo $leyenda;
	else
		echo nl2br($leyenda) ."\n";
}

function HTMLEstaticoGenera($leyenda) {
		echo $leyenda ."\n";
}

function TituloGenera($titulo) {
		echo "<h1>$titulo</h1>";
}

function TextoGenera($nombre,$valor,$tamanio) {
		echo "<input type=text name=\"$nombre\" value=\"$valor\" size=$tamanio>\n";
}

function ArchivoGenera($nombre,$tamanio) {
		echo "<input type=file name=\"$nombre\" size=$tamanio>\n";
}

function CheckGenera($nombre,$leyenda,$valor) {
	if ($valor)
		$checked="checked";
	else
		$checked="";
	echo "<input type=checkbox name=\"$nombre\" value=\"1\" $checked> $leyenda\n";
}

function MemoGenera($nombre,$valor,$filas,$columnas) {
		echo "<textarea name=\"$nombre\" rows=$filas cols=$columnas>\n$valor</textarea>";
}

function FileGenera($nombre,$archivo,$filas,$columnas) {
	echo "<textarea name=\"$nombre\" rows=$filas cols=$columnas>\n";
	$fp = @fopen($archivo,"r");
	if ($fp)
		fpassthru($fp);
	echo "</textarea>\n";
}

function ContraseniaGenera($nombre,$valor,$tamanio) {
		echo "<input type=password name=\"$nombre\" value=\"$valor\" size=$tamanio>\n";
}

function DiaGenera($nombre,$valor, $novalor=0) {
		echo "<select name='$nombre'>\n";
		if ($novalor)
			 echo "<option value=''></option>\n";
		for ($k=1; $k<=31; $k++) {
				$s = $k == $valor ? " selected" : "";
				echo "<option value='$k' $s>$k</option>\n";
		}
		echo "</select>\n";
}

function MesGenera($nombre,$valor, $novalor=0) {
		echo "<select name='$nombre'>\n";
	  global $Meses;
    reset($Meses);

		if ($novalor)
			 echo "<option value=''></option>\n";
		while (list($k, $v) = each($Meses))  {
					$s = $k == $valor ? " selected" : "";
    			echo "<option $s value=$k>$v</option>\n";
		}
		echo "</select>\n";
}

function AnioGenera($nombre,$valor, $novalor=0) {
		echo "<select name='$nombre'>\n";
		if ($novalor)
			 echo "<option value=''></option>\n";
  for ($i=1900; $i<=2010; $i++)
  { $s = $i == $valor ? " selected" : "";
    echo "<option $s value=$i>$i</option>\n";
  }
		echo "</select>\n";
}

function FechaGenera($nombre, $anio, $mes, $dia, $novalor=0) {
		DiaGenera($nombre . "Dia", $dia, $novalor);
		MesGenera($nombre . "Mes", $mes, $novalor);
		AnioGenera($nombre . "Anio", $anio, $novalor);
}

function ComboHashGenera($nombre,$arreglo,$valor) {
		echo "<select name=\"$nombre\">\n";

		reset($arreglo);
		
		while (list($k, $v) = each($arreglo)) {
					$s = $k == $valor ? " selected" : "";
					echo "<option$s value=\"$k\">$v</option>\n";
		}
		
		echo "</select>\n";
}

function ComboRsGenera($nombre, $rs, $valor, $id='id', $des='descripcion', $enblanco=0) {
	echo "<select name=\"$nombre\">\n";

	if ($enblanco)
		echo "<option value=''></option>\n";

	while ($reg=mysql_fetch_array($rs)) {
		if ($reg[$id]==$valor)
			$s = "selected";
		else
			$s = "";
		echo "<option $s value=\"$reg[$id]\">$reg[$des]</option>\n";
	}

	echo "</select>\n";
}

function RadioHashGenera($nombre,$arreglo,$valor) {
		reset($arreglo);
		
		while (list($k, $v) = each($arreglo)) {
					$s = $k == $valor ? " checked" : "";
					echo "<input type='radio' name='$nombre' $s value=\"$k\">$v&nbsp;<br>\n";
		}
}

function SexoGenera($nombre, $valor) {
		global $Sexos;
		
		RadioHashGenera($nombre, $Sexos, $valor);
}

function ComboArregloGenera($nombre,$arreglo,$valor) {
		echo "<select name=\"$nombre\">\n";

		reset($arreglo);
  		
		while (list(,$k) = each($arreglo)) {
					$s = $k == $valor ? " selected" : "";
					echo "<option$s value=\"$k\">$k</option>\n";
		}
		
		echo "</select>\n";
}

function IdGenera($valor) {
		echo "<input type=hidden name=\"Id\" value=\"$valor\">\n";
}

function CampoTextoGenera($nombre,$leyenda,$valor,$tamanio=30,$requerido=false) {
		FilaCampoInicio();
		LeyendaGenera($leyenda,$requerido);
		CampoInicio();
		TextoGenera($nombre,$valor,$tamanio);
		CampoFinal();
		FilaCampoFinal();
}

function CampoFechaGenera($nombre,$leyenda,$fecha,$requerido=0) {
		$anio = substr($fecha,0,4);
		$mes = substr($fecha,5,2);
		$dia = substr($fecha,8,2);
		FilaCampoInicio();
		LeyendaGenera($leyenda,$requerido);
		CampoInicio();
		FechaGenera($nombre,$anio,$mes,$dia,1);
		CampoFinal();
		FilaCampoFinal();
}

function CampoArchivoGenera($nombre,$leyenda,$tamanio=30) {
		FilaCampoInicio();
		LeyendaGenera($leyenda);
		CampoInicio();
		ArchivoGenera($nombre,$tamanio);
		CampoFinal();
		FilaCampoFinal();
}

function CampoMemoGenera($nombre,$leyenda,$valor,$filas=10,$columnas=40,$requerido=false) {
		FilaCampoInicio();
		LeyendaGenera($leyenda,$requerido);
		CampoInicio();
		MemoGenera($nombre,$valor,$filas,$columnas);
		CampoFinal();
		FilaCampoFinal();
}

function CampoFileGenera($nombre,$leyenda,$archivo,$filas=10,$columnas=40) {
		FilaCampoInicio();
		LeyendaGenera($leyenda);
		CampoInicio();
		FileGenera($nombre,$archivo,$filas,$columnas);
		CampoFinal();
		FilaCampoFinal();
}

function CampoSexoGenera($nombre,$leyenda,$valor,$requerido=false) {
		FilaCampoInicio();
		LeyendaGenera($leyenda,$requerido);
		CampoInicio();
		SexoGenera($nombre,$valor);
		CampoFinal();
		FilaCampoFinal();
}

function CampoEstaticoGenera($leyenda,$valor,$align='left') {
		FilaCampoInicio();
		LeyendaGenera($leyenda);
		CampoInicio($align);
		EstaticoGenera($valor);
		CampoFinal();
		FilaCampoFinal();
}

function CampoEnlaceGenera($leyenda,$valor,$enlace,$align='left') {
		FilaCampoInicio();
		LeyendaGenera($leyenda);
		CampoInicio($align);
		EnlaceGenera($valor,$enlace);
		CampoFinal();
		FilaCampoFinal();
}

function CampoMemoEstaticoGenera($leyenda,$valor,$eshtml=0) {
		FilaCampoInicio();
		LeyendaGenera($leyenda);
		CampoInicio();
		MemoEstaticoGenera($valor,$eshtml);
		CampoFinal();
		FilaCampoFinal();
}

function CampoHTMLEstaticoGenera($leyenda,$valor) {
		FilaCampoInicio();
		LeyendaGenera($leyenda);
		CampoInicio();
		HTMLEstaticoGenera($valor);
		CampoFinal();
		FilaCampoFinal();
}

function CampoContraseniaGenera($nombre,$leyenda,$valor,$tamanio=30,$requerido=false) {
		FilaCampoInicio();
		LeyendaGenera($leyenda,$requerido);
		CampoInicio();
		ContraseniaGenera($nombre,$valor,$tamanio);
		CampoFinal();
		FilaCampoFinal();
}

function CampoComboHashGenera($nombre,$leyenda,$arreglo,$valor,$requerido=false) {
		FilaCampoInicio();
		LeyendaGenera($leyenda,$requerido);
		CampoInicio();
		ComboHashGenera($nombre,$arreglo,$valor);
		CampoFinal();
		FilaCampoFinal();
}

function CampoComboRsGenera($nombre,$leyenda,$rs,$valor,$id='id',$des='descripcion',$enblanco=0,$requerido=false) {
	FilaCampoInicio();
	LeyendaGenera($leyenda,$requerido);
	CampoInicio();
	ComboRsGenera($nombre,$rs,$valor,$id,$des,$enblanco);
	CampoFinal();
	FilaCampoFinal();
}

function CampoCheckGenera($nombre,$leyenda,$valor,$requerido=false) {
	FilaCampoInicio();
	LeyendaGenera("&nbsp;",$requerido);
	CampoInicio();
	CheckGenera($nombre,$leyenda,$valor);
	CampoFinal();
	FilaCampoFinal();
}

function CampoAceptarGenera() {
		echo "<td colspan=2 class=Dato align=center><input type='submit' value='Aceptar'></td>\n";
}

function CampoAceptarEliminarGenera() {
	echo "<td colspan=2 class=Dato align=center><input type='submit' name='Aceptar' value='Aceptar'>\n";
	echo "<input type='submit' name='Eliminar' value='Eliminar'></td>\n";
}

function TablaInicio($titulos,$ancho='') {
	if ($ancho)
		echo "<table width='$ancho' cellspacing=1 cellpadding=2 class='informe'>\n";
	else
		echo "<table cellspacing=1 cellpadding=2 class='informe'>\n";	
	echo "<tr>\n";

	reset($titulos);

	while (list($k,$v) = each($titulos))
		if ($v)
			echo "<td class=titulo align='center'>$v</td>";
		else
			echo "<td>&nbsp;</td>";

	echo "</tr>\n";
}

function TablaFinal() {
	  echo "</table>\n";
}

function FilaInicio() {
	  echo "<tr>\n";
}

function FilaFinal() {
	  echo "</tr>\n";
}

function DatoGenera($dato,$alinea='left',$colspan=1) {
    echo "<td class=Dato colspan=$colspan align=$alinea>$dato&nbsp;</td>\n";
}

function DatoNumGenera($dato) {
    echo "<td class=Dato align=right>$dato&nbsp;</td>\n";
}

function DatoImporteGenera($dato) {
    echo "<td class=Dato align=right>" . number_format($dato+0,2) . "&nbsp;</td>\n";
}

function DatoEnlaceGenera($dato,$enlace,$alinea='left') {
    echo "<td class=Dato align=$alinea><a href='$enlace'>$dato</a>&nbsp;</td>\n";
}

?>