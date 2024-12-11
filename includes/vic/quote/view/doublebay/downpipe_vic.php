<?php 
// ***************************** Downpipe Plastic 3m ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Downpipe</td></tr>";
echo "<tr><td><input type=\"hidden\" name=\"id[44]\" value=\"{$getCFID[44]}\" />".$getDesc[44];
        $pipes = array();
		while ($pipe = mysql_fetch_array($resultpipe)){
		$pipes[] = $pipe; }	
		
		foreach($pipes as $pipe) {
		if ($pipe['cf_id'] == $getID[44]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[44]\" value=\"".$pipe['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[44]\" value=\"".$pipe['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$pipe['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$pipe['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[44]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[44]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[44]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[44]\" readonly=\"readonly\" value=\"".$pipe['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[44]\" value=\"{$getQty[44]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[44]\" value=\"{$getLength[44]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[44]\" value=\"{$getRRP[44]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[44]\" value=\"{$getCost[44]}\"></td></tr>";
// ***************************** Plastic Fittings ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[45]\" value=\"{$getCFID[45]}\" />".$getDesc[45];
		foreach($pipes as $pipe) {
		if ($pipe['cf_id'] == $getID[45]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[45]\" value=\"".$pipe['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[45]\" value=\"".$pipe['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$pipe['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$pipe['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[45]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[45]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[45]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[45]\" readonly=\"readonly\" value=\"".$pipe['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[45]\" value=\"{$getQty[45]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[45]\" value=\"{$getLength[45]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[45]\" value=\"{$getRRP[45]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[45]\" value=\"{$getCost[45]}\"></td></tr>";
// ***************************** Downpipe Cbond ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[46]\" value=\"{$getCFID[46]}\" />".$getDesc[46];
		foreach($pipes as $pipe) {
		if ($pipe['cf_id'] == $getID[46]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[46]\" value=\"".$pipe['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[46]\" value=\"".$pipe['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$pipe['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$pipe['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[46]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[46]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[46]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[46]\" readonly=\"readonly\" value=\"".$pipe['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[46]\" value=\"{$getQty[46]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength41[]\" value=\"{$getLength[46]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[46]\" value=\"{$getRRP[46]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[46]\" value=\"{$getCost[46]}\"></td></tr>";
// ***************************** Join to Stormwater ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[47]\" value=\"{$getCFID[47]}\" />".$getDesc[47];
		foreach($pipes as $pipe) {
		if ($pipe['cf_id'] == $getID[47]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[47]\" value=\"".$pipe['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[47]\" value=\"".$pipe['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$pipe['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$pipe['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[47]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[47]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[47]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[47]\" readonly=\"readonly\" value=\"".$pipe['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[47]\" value=\"{$getQty[47]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[47]\" value=\"{$getLength[47]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[47]\" value=\"{$getRRP[47]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[47]\" value=\"{$getCost[47]}\"></td></tr>";

// ***************************** Join into Existing Downpipe ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[48]\" value=\"{$getCFID[48]}\" />".$getDesc[48];
		foreach($pipes as $pipe) {
		if ($pipe['cf_id'] == $getID[48]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[48]\" value=\"".$pipe['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[48]\" value=\"".$pipe['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$pipe['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$pipe['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[48]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[48]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[48]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[48]\" readonly=\"readonly\" value=\"".$pipe['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[48]\" value=\"{$getQty[48]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[48]\" value=\"{$getLength[48]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[48]\" value=\"{$getRRP[48]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[48]\" value=\"{$getCost[48]}\"></td></tr>";
?>