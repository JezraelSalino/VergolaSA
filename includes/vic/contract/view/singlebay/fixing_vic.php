<?php
// ***************************** Fixing to Wall - Solid Brick ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[9]\" value=\"{$getCFID[9]}\" />".$getDesc[9];
        $fixs = array();
		while ($fix = mysql_fetch_array($resultfix)){
		$fixs[] = $fix; }	
		
		foreach($fixs as $fix) {
		if ($fix['cf_id'] == $getID[9]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[9]\" value=\"".$fix['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[9]\" value=\"".$fix['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$fix['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$fix['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[9]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[9]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[9]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[9]\" readonly=\"readonly\" value=\"".$fix['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[9]\" value=\"{$getQty[9]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[9]\" value=\"{$getLength[9]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[9]\" value=\"{$getRRP[9]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[9]\" value=\"{$getCost[9]}\"></td></tr>";


// ***************************** Fixing to Wall - Soft Brick ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[10]\" value=\"{$getCFID[10]}\" />".$getDesc[10];	
		foreach($fixs as $fix) {
		if ($fix['cf_id'] == $getID[10]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[10]\" value=\"".$fix['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[10]\" value=\"".$fix['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$fix['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$fix['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[10]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[10]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[10]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[10]\" readonly=\"readonly\" value=\"".$fix['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[10]\" value=\"{$getQty[10]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[10]\" value=\"{$getLength[10]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[10]\" value=\"{$getRRP[10]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[10]\" value=\"{$getCost[10]}\"></td></tr>";

// ***************************** Bracket Fascia ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[11]\" value=\"{$getCFID[11]}\" />".$getDesc[11];	
		foreach($fixs as $fix) {
		if ($fix['cf_id'] == $getID[11]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[11]\" value=\"".$fix['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[11]\" value=\"".$fix['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$fix['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$fix['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[11]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[11]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[11]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[11]\" readonly=\"readonly\" value=\"".$fix['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[11]\" value=\"{$getQty[11]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[11]\" value=\"{$getLength[11]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[11]\" value=\"{$getRRP[11]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[11]\" value=\"{$getCost[11]}\"></td></tr>";
// ***************************** Post Footing to Earth ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[12]\" value=\"{$getCFID[12]}\" />".$getDesc[12];	
		foreach($fixs as $fix) {
		if ($fix['cf_id'] == $getID[12]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[12]\" value=\"".$fix['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[12]\" value=\"".$fix['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$fix['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$fix['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[12]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[12]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[12]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[12]\" readonly=\"readonly\" value=\"".$fix['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[12]\" value=\"{$getQty[12]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[12]\" value=\"{$getLength[12]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[12]\" value=\"{$getRRP[12]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[12]\" value=\"{$getCost[12]}\"></td></tr>";

// ***************************** Post Footing to Earth (Reinforced) ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[13]\" value=\"{$getCFID[13]}\" />".$getDesc[13];	
		foreach($fixs as $fix) {
		if ($fix['cf_id'] == $getID[13]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[13]\" value=\"".$fix['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[13]\" value=\"".$fix['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$fix['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$fix['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[13]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[13]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[13]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[13]\" readonly=\"readonly\" value=\"".$fix['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[13]\" value=\"{$getQty[13]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[13]\" value=\"{$getLength[13]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[13]\" value=\"{$getRRP[13]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"{$getCost[13]}\"></td></tr>";
// ***************************** Post Fixing to Concrete ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[14]\" value=\"{$getCFID[14]}\" />".$getDesc[14];	
		foreach($fixs as $fix) {
		if ($fix['cf_id'] == $getID[14]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[14]\" value=\"".$fix['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[14]\" value=\"".$fix['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$fix['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$fix['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[14]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[14]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[14]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[14]\" readonly=\"readonly\" value=\"".$fix['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[14]\" value=\"{$getQty[14]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[14]\" value=\"{$getLength[14]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[14]\" value=\"{$getRRP[14]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[14]\" value=\"{$getCost[14]}\"></td></tr>";
// ***************************** Additional Fixings to Stabilize Columns ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[15]\" value=\"{$getCFID[15]}\" />".$getDesc[15];	
		foreach($fixs as $fix) {
		if ($fix['cf_id'] == $getID[15]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[15]\" value=\"".$fix['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[15]\" value=\"".$fix['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$fix['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$fix['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[15]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[15]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[15]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[15]\" readonly=\"readonly\" value=\"".$fix['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[15]\" value=\"{$getQty[15]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[15]\" value=\"{$getLength[15]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[15]\" value=\"{$getRRP[15]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[15]\" value=\"{$getCost[15]}\"></td></tr>";
?>