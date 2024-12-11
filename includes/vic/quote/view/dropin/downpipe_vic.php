<?php 
// ***************************** Downpipe Plastic 3m ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Downpipe</td></tr>";
echo "<tr><td><input type=\"hidden\" name=\"id[23]\" value=\"{$getCFID[23]}\" />".$getDesc[23];
        $pipes = array();
		while ($pipe = mysql_fetch_array($resultpipe)){
		$pipes[] = $pipe; }	
		
		foreach($pipes as $pipe) {
		if ($pipe['cf_id'] == $getID[23]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[23]\" value=\"".$pipe['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[23]\" value=\"".$pipe['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$pipe['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$pipe['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[23]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[23]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[23]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[23]\" readonly=\"readonly\" value=\"".$pipe['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[23]\" value=\"{$getQty[23]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[23]\" value=\"{$getLength[23]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[23]\" value=\"{$getRRP[23]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[23]\" value=\"{$getCost[23]}\"></td></tr>";
// ***************************** Plastic Fittings ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[24]\" value=\"{$getCFID[24]}\" />".$getDesc[24];
		foreach($pipes as $pipe) {
		if ($pipe['cf_id'] == $getID[24]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[24]\" value=\"".$pipe['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[24]\" value=\"".$pipe['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$pipe['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$pipe['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[24]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[24]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[24]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[24]\" readonly=\"readonly\" value=\"".$pipe['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[24]\" value=\"{$getQty[24]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[24]\" value=\"{$getLength[24]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[24]\" value=\"{$getRRP[24]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[24]\" value=\"{$getCost[24]}\"></td></tr>";
// ***************************** Downpipe Cbond ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[25]\" value=\"{$getCFID[25]}\" />".$getDesc[25];
		foreach($pipes as $pipe) {
		if ($pipe['cf_id'] == $getID[25]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[25]\" value=\"".$pipe['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[25]\" value=\"".$pipe['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$pipe['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$pipe['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[25]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[25]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[25]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[25]\" readonly=\"readonly\" value=\"".$pipe['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[25]\" value=\"{$getQty[25]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength41[]\" value=\"{$getLength[25]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[25]\" value=\"{$getRRP[25]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[25]\" value=\"{$getCost[25]}\"></td></tr>";
// ***************************** Join to Stormwater ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[26]\" value=\"{$getCFID[26]}\" />".$getDesc[26];
		foreach($pipes as $pipe) {
		if ($pipe['cf_id'] == $getID[26]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[26]\" value=\"".$pipe['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[26]\" value=\"".$pipe['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$pipe['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$pipe['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[26]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[26]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[26]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[26]\" readonly=\"readonly\" value=\"".$pipe['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[26]\" value=\"{$getQty[26]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[26]\" value=\"{$getLength[26]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[26]\" value=\"{$getRRP[26]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[26]\" value=\"{$getCost[26]}\"></td></tr>";

// ***************************** Join into Existing Downpipe ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[27]\" value=\"{$getCFID[27]}\" />".$getDesc[27];
		foreach($pipes as $pipe) {
		if ($pipe['cf_id'] == $getID[27]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[27]\" value=\"".$pipe['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[27]\" value=\"".$pipe['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$pipe['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$pipe['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[27]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[27]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[27]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[27]\" readonly=\"readonly\" value=\"".$pipe['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[27]\" value=\"{$getQty[27]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[27]\" value=\"{$getLength[27]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[27]\" value=\"{$getRRP[27]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[27]\" value=\"{$getCost[27]}\"></td></tr>";
?>