<?
	include('Campos.inc.php');

function TablaMuestra($result, $link="") {

?>
<TABLE BORDER=0 cellspacing=2 cellpadding=0>
   <THEAD>
      <TR>
         <?php
            for ($i = 0; $i < mysql_num_fields($result); $i++) {
               echo("<TH class=titulo>" . mysql_field_name($result,$i) . "</TH>");
            }
         ?>
      </TR>
   </THEAD>
   <TBODY>
      <?php
         for ($i = 0; $i < mysql_num_rows($result); $i++) {
            echo("<TR>");
            $row_array = mysql_fetch_row($result);
            for ($j = 0; $j < mysql_num_fields($result); $j++) {
		if ($j==0 && !empty($link))
			echo ("<td class=dato><a href=\"$link?" . mysql_field_name($result,0) . "=" . urlencode($row_array[$j]) . "\">" . $row_array[$j] . "</a></TD>");
		else
			echo("<TD class=dato>" . $row_array[$j] . "</TD>");
            }
            echo("</TR>");
         }
      ?>
   </TBODY>
</TABLE>

<?
}

function RegistroMuestra($result) {
//  $row_array = mysql_fetch_row($result);
?>
<table>
<tbody>

<?
	for ($i = 0; $i < mysql_num_fields($result); $i++) {
?>
<tr>
<td><? echo mysql_field_name($result, $i) ?></td>
<td><? echo mysql_result($result,0, $i) ?></td>
</tr>
<?
	}
?>

</tbody>
</table>
<?
}
?>
