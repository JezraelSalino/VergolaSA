<?php 
// ***************************** Downpipe Plastic 3m ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Downpipe</td></tr>";
echo "<tr><td><input type=\"hidden\" name=\"id[39]\" value=\"{$getCFID[39]}\" />".$getDesc[39];
        $pipes = array();
		while ($pipe = mysql_fetch_array($resultpipe)){
		$pipes[] = $pipe; }	
		
		foreach($pipes as $pipe) {
		if ($pipe['cf_id'] == $getID[39]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[39]\" value=\"".$pipe['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[39]\" value=\"".$pipe['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$pipe['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$pipe['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[39]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[39]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[39]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[39]\" readonly=\"readonly\" value=\"".$pipe['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[39]\" value=\"{$getQty[39]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[39]\" value=\"{$getLength[39]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[39]\" value=\"{$getRRP[39]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[39]\" value=\"{$getCost[39]}\"></td></tr>";
// ***************************** Plastic Fittings ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[40]\" value=\"{$getCFID[40]}\" />".$getDesc[40];
		foreach($pipes as $pipe) {
		if ($pipe['cf_id'] == $getID[40]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[40]\" value=\"".$pipe['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[40]\" value=\"".$pipe['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$pipe['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$pipe['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[40]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[40]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[40]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[40]\" readonly=\"readonly\" value=\"".$pipe['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[40]\" value=\"{$getQty[40]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[40]\" value=\"{$getLength[40]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[40]\" value=\"{$getRRP[40]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[40]\" value=\"{$getCost[40]}\"></td></tr>";
// ***************************** Downpipe Cbond ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[41]\" value=\"{$getCFID[41]}\" />".$getDesc[41];
		foreach($pipes as $pipe) {
		if ($pipe['cf_id'] == $getID[41]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[41]\" value=\"".$pipe['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[41]\" value=\"".$pipe['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$pipe['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$pipe['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[41]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[41]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[41]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[41]\" readonly=\"readonly\" value=\"".$pipe['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[41]\" value=\"{$getQty[41]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength41[]\" value=\"{$getLength[41]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[41]\" value=\"{$getRRP[41]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[41]\" value=\"{$getCost[41]}\"></td></tr>";
// ***************************** Join to Stormwater ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[42]\" value=\"{$getCFID[42]}\" />".$getDesc[42];
		foreach($pipes as $pipe) {
		if ($pipe['cf_id'] == $getID[42]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[42]\" value=\"".$pipe['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[42]\" value=\"".$pipe['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$pipe['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$pipe['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[42]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[42]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[42]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[42]\" readonly=\"readonly\" value=\"".$pipe['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[42]\" value=\"{$getQty[42]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[42]\" value=\"{$getLength[42]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[42]\" value=\"{$getRRP[42]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[42]\" value=\"{$getCost[42]}\"></td></tr>";

// ***************************** Join into Existing Downpipe ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[43]\" value=\"{$getCFID[43]}\" />".$getDesc[43];
		foreach($pipes as $pipe) {
		if ($pipe['cf_id'] == $getID[43]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[43]\" value=\"".$pipe['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[43]\" value=\"".$pipe['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$pipe['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$pipe['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[43]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[43]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[43]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[43]\" readonly=\"readonly\" value=\"".$pipe['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[43]\" value=\"{$getQty[43]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[43]\" value=\"{$getLength[43]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[43]\" value=\"{$getRRP[43]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[43]\" value=\"{$getCost[43]}\"></td></tr>";
?>