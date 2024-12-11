<?php 
// ***************************** Shop Drawings ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Disbursements</td></tr>";
echo "<tr><td><input type=\"hidden\" name=\"id[49]\" value=\"{$getCFID[49]}\" />";
        $disburses = array();
		while ($disburse = mysql_fetch_array($resultdisb)) {
		$disburses[] = $disburse;}
		foreach($disburses as $disburse) {
		if ($disburse['cf_id'] == $getID[49]) { 
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[49]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[49]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[49]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[49]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[49]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[49]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}
		else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[49]\" value=\"{$getQty[49]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[49]\" value=\"{$getLength[49]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[49]\" value=\"{$getRRP[49]}\"><input type=\"hidden\" class=\"cstd\" name=\"cst[49]\" value=\"{$getCost[49]}\"></td></tr>";

// ***************************** Certifier ********************************************//

echo "<tr><td><input type=\"hidden\" name=\"id[50]\" value=\"{$getCFID[50]}\" />";
		foreach($disburses as $disburse) {
		if ($disburse['cf_id'] == $getID[50]) { 
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[50]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[50]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[50]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[50]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[50]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[50]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}
		else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[50]\" value=\"{$getQty[50]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[50]\" value=\"{$getLength[50]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[50]\" value=\"{$getRRP[50]}\"><input type=\"hidden\" class=\"cstd\" name=\"cst[50]\" value=\"{$getCost[50]}\"></td></tr>";

// ***************************** Council ********************************************//

echo "<tr><td><input type=\"hidden\" name=\"id[51]\" value=\"{$getCFID[51]}\" />";
		foreach($disburses as $disburse) {
		if ($disburse['cf_id'] == $getID[51]) { 
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[51]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[51]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[51]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[51]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[51]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[51]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}
		else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[51]\" value=\"{$getQty[51]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[51]\" value=\"{$getLength[51]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[51]\" value=\"{$getRRP[51]}\"><input type=\"hidden\" class=\"cstd\" name=\"cst[51]\" value=\"{$getCost[51]}\"></td></tr>";

// ***************************** Lands Title Office ********************************************//

echo "<tr><td><input type=\"hidden\" name=\"id[52]\" value=\"{$getCFID[52]}\" />";
		foreach($disburses as $disburse) {
		if ($disburse['cf_id'] == $getID[52]) { 
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[52]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[52]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[52]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[52]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[52]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[52]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}
		else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[52]\" value=\"{$getQty[52]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[52]\" value=\"{$getLength[52]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[52]\" value=\"{$getRRP[52]}\"><input type=\"hidden\" class=\"cstd\" name=\"cst[52]\" value=\"{$getCost[52]}\"></td></tr>";

// ***************************** Crane Hire ********************************************//

echo "<tr><td><input type=\"hidden\" name=\"id[53]\" value=\"{$getCFID[53]}\" />";
		foreach($disburses as $disburse) {
		if ($disburse['cf_id'] == $getID[53]) { 
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[53]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[53]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[53]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[53]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[53]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[53]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}
		else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[53]\" value=\"{$getQty[53]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[53]\" value=\"{$getLength[53]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[53]\" value=\"{$getRRP[53]}\"><input type=\"hidden\" class=\"cstd\" name=\"cst[53]\" value=\"{$getCost[53]}\"></td></tr>";

// ***************************** Genie Lift ********************************************//

echo "<tr><td><input type=\"hidden\" name=\"id[54]\" value=\"{$getCFID[54]}\" />";
		foreach($disburses as $disburse) {
		if ($disburse['cf_id'] == $getID[54]) { 
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[54]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[54]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[54]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[54]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[54]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[54]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}
		else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[54]\" value=\"{$getQty[54]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[54]\" value=\"{$getLength[54]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[54]\" value=\"{$getRRP[54]}\"><input type=\"hidden\" class=\"cstd\" name=\"cst[54]\" value=\"{$getCost[54]}\"></td></tr>";

// ***************************** Training Levy ********************************************//

echo "<tr><td><input type=\"hidden\" name=\"id[55]\" value=\"{$getCFID[55]}\" />";
		foreach($disburses as $disburse) {
		if ($disburse['cf_id'] == $getID[55]) { 
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[55]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[55]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[55]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[55]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[55]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[55]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}
		else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[55]\" value=\"{$getQty[55]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[55]\" value=\"{$getLength[55]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[55]\" value=\"{$getRRP[55]}\"><input type=\"hidden\" class=\"cstd\" name=\"cst[55]\" value=\"{$getCost[55]}\"></td></tr>";

// ***************************** Indemnity Insurance ********************************************//

echo "<tr><td><input type=\"hidden\" name=\"id[56]\" value=\"{$getCFID[56]}\" />";
		foreach($disburses as $disburse) {
		if ($disburse['cf_id'] == $getID[56]) { 
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[56]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[56]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[56]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[56]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[56]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[56]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}
		else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[56]\" value=\"{$getQty[56]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[56]\" value=\"{$getLength[56]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[56]\" value=\"{$getRRP[56]}\"><input type=\"hidden\" class=\"cstd\" name=\"cst[56]\" value=\"{$getCost[56]}\"></td></tr>";

// ***************************** Electrician ********************************************//

echo "<tr><td><input type=\"hidden\" name=\"id[57]\" value=\"{$getCFID[57]}\" />";
		foreach($disburses as $disburse) {
		if ($disburse['cf_id'] == $getID[57]) { 
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[57]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[57]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[57]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[57]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[57]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[57]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}
		else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[57]\" value=\"{$getQty[57]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[57]\" value=\"{$getLength[57]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[57]\" value=\"{$getRRP[57]}\"><input type=\"hidden\" class=\"cstd\" name=\"cst[57]\" value=\"{$getCost[57]}\"></td></tr>";

// ***************************** Engineering ********************************************//


echo "<tr><td><input type=\"hidden\" name=\"id[58]\" value=\"{$getCFID[58]}\" />";
		foreach($disburses as $disburse) {
		if ($disburse['cf_id'] == $getID[58]) { 
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[58]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[58]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[58]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[58]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[58]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[58]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}
		else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[58]\" value=\"{$getQty[58]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[58]\" value=\"{$getLength[58]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[58]\" value=\"{$getRRP[58]}\"><input type=\"hidden\" class=\"cstd\" name=\"cst[58]\" value=\"{$getCost[58]}\"></td></tr>";

// ***************************** Material Deliveries ********************************************//

echo "<tr><td><input type=\"hidden\" name=\"id[59]\" value=\"{$getCFID[59]}\" />";
		foreach($disburses as $disburse) {
		if ($disburse['cf_id'] == $getID[59]) { 
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[59]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[59]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[59]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[59]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[59]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[59]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}
		else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[59]\" value=\"{$getQty[59]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[59]\" value=\"{$getLength[59]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[59]\" value=\"{$getRRP[59]}\"><input type=\"hidden\" class=\"cstd\" name=\"cst[59]\" value=\"{$getCost[59]}\"></td></tr>";

// ***************************** Site Labour ********************************************//

echo "<tr><td><input type=\"hidden\" name=\"id[60]\" value=\"{$getCFID[60]}\" />";
		foreach($disburses as $disburse) {
		if ($disburse['cf_id'] == $getID[60]) { 
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[60]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[60]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[60]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[60]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[60]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[60]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}
		else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[60]\" value=\"{$getQty[60]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[60]\" value=\"{$getLength[60]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[60]\" value=\"{$getRRP[60]}\"><input type=\"hidden\" class=\"cstd\" name=\"cst[60]\" value=\"{$getCost[60]}\"></td></tr>";

// ***************************** Traveling Fix 1& 2 ********************************************//


echo "<tr><td><input type=\"hidden\" name=\"id[61]\" value=\"{$getCFID[61]}\" />";
		foreach($disburses as $disburse) {
		if ($disburse['cf_id'] == $getID[61]) { 
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[61]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[61]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[61]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[61]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[61]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[61]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}
		else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[61]\" value=\"{$getQty[61]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[61]\" value=\"{$getLength[61]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[61]\" value=\"{$getRRP[61]}\"><input type=\"hidden\" class=\"cstd\" name=\"cst[61]\" value=\"{$getCost[61]}\"></td></tr>";

// ***************************** Delivery Distance ********************************************//


echo "<tr><td><input type=\"hidden\" name=\"id[62]\" value=\"{$getCFID[62]}\" />";
		foreach($disburses as $disburse) {
		if ($disburse['cf_id'] == $getID[62]) { 
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[62]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[62]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[62]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[62]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[62]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[62]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}
		else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[62]\" value=\"{$getQty[62]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[62]\" value=\"{$getLength[62]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[62]\" value=\"{$getRRP[62]}\"><input type=\"hidden\" class=\"cstd\" name=\"cst[62]\" value=\"{$getCost[62]}\"></td></tr>";

// ***************************** Accomodation ********************************************//

echo "<tr><td><input type=\"hidden\" name=\"id[63]\" value=\"{$getCFID[63]}\" />";
		foreach($disburses as $disburse) {
		if ($disburse['cf_id'] == $getID[63]) { 
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[63]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[63]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[63]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[63]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[63]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[63]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}
		else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[63]\" value=\"{$getQty[63]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[63]\" value=\"{$getLength[63]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[63]\" value=\"{$getRRP[63]}\"><input type=\"hidden\" class=\"cstd\" name=\"cst[63]\" value=\"{$getCost[63]}\"></td></tr>";

// ***************************** Factory Labour ********************************************//

echo "<tr><td><input type=\"hidden\" name=\"id[64]\" value=\"{$getCFID[64]}\" />";
		foreach($disburses as $disburse) {
		if ($disburse['cf_id'] == $getID[64]) { 
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[64]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[64]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[64]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[64]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[64]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[64]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}
		else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[64]\" value=\"{$getQty[64]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[64]\" value=\"{$getLength[64]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[64]\" value=\"{$getRRP[64]}\"><input type=\"hidden\" class=\"cstd\" name=\"cst[64]\" value=\"{$getCost[64]}\"></td></tr>";

// ***************************** Other ********************************************//

echo "<tr><td><input type=\"hidden\" name=\"id[65]\" value=\"{$getCFID[65]}\" />";
		foreach($disburses as $disburse) {
		if ($disburse['cf_id'] == $getID[65]) { 
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[65]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[65]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[65]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[65]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[65]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[65]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}
		else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[65]\" value=\"{$getQty[65]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[65]\" value=\"{$getLength[65]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[65]\" value=\"{$getRRP[65]}\"><input type=\"hidden\" class=\"cstd\" name=\"cst[65]\" value=\"{$getCost[65]}\"></td></tr>";
?>