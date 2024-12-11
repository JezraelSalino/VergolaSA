<?php 
// Unit of Measurement
$resultcbeamuom = mysql_query("SELECT uom FROM ver_chronoforms_data_inventory_vic WHERE section = 'Frame' and category  = 'Posts' GROUP BY uom" );
echo "<td>";
     while ($cbeamuom = mysql_fetch_array($resultcbeamuom)) {
      	echo "<input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$cbeamuom['uom']."\">";	
		}	
echo "</td>";
?>