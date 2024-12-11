<?php
 $gutters = array();
while ($gutter = mysql_fetch_array($resultstdgutter)) {
	$gutters[] = $gutter;
	$heading = isset($gutter[0]) ? $gutter[0] : null;
	$BeamIDArrayPhp .= isset($gutter[1]) ? 'BeamIDArray["'.$heading.'"]="'.$gutter[1].'";' : null;	
	$BeamDESCArrayPhp .= isset($gutter[2]) ? 'BeamDESCArray["'.$heading.'"]="'.$gutter[2].'";' : null;
	$BeamRRPArrayPhp .= isset($gutter[4]) ? 'BeamRRPArray["'.$heading.'"]="'.$gutter[4].'";' : null;
	$BeamCOSTArrayPhp .= isset($gutter[5]) ? 'BeamCOSTArray["'.$heading.'"]="'.$gutter[5].'";' : null;
}

// ***************************** First Standard Vergola Gutter Lip Out 200 x 200 ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Gutters</td></tr>";
if ($getQty[16] != '0.00') {
echo "<tr id=\"stdgutter1\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[16]\" value=\"{$getCFID[16]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        
		foreach($gutters as $gutter) {
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[16]) { 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$gutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($gutters as $gutter) {
	 if ($gutter['cf_id'] == $getID[16]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[16]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[16]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
}
else {echo "<tr id=\"stdgutter1\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[16]\" value=\"{$getCFID[16]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
  //       $gutters = array();
		// while ($gutter = mysql_fetch_array($resultstdgutter)) {
		// $gutters[] = $gutter;
		// $heading = isset($gutter[0]) ? $gutter[0] : null;
  //       $BeamIDArrayPhp .= isset($gutter[1]) ? 'BeamIDArray["'.$heading.'"]="'.$gutter[1].'";' : null;	
  //       $BeamDESCArrayPhp .= isset($gutter[2]) ? 'BeamDESCArray["'.$heading.'"]="'.$gutter[2].'";' : null;
  //       $BeamRRPArrayPhp .= isset($gutter[4]) ? 'BeamRRPArray["'.$heading.'"]="'.$gutter[4].'";' : null;
  //       $BeamCOSTArrayPhp .= isset($gutter[5]) ? 'BeamCOSTArray["'.$heading.'"]="'.$gutter[5].'";' : null;
		// }
        foreach($gutters as $gutter) {
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[16]){ 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$gutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($gutters as $gutter){
	 if ($gutter['cf_id'] == $getID[16]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[16]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[16]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[16]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[16]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[16]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[16]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[16]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[16]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[16]\" readonly=\"readonly\" value=\"{$getUOM[16]}\"></td>";
 
 // Unit Quantity
echo "<td><input type=\"text\" id=\"addqty7\" name=\"qty[16]\" value=\"{$getQty[16]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"length\" name=\"slength[16]\" value=\"{$getLength[16]}\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[16]\" value=\"{$getRRP[16]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[16]\" value=\"{$getCost[16]}\"></td></tr>";
// ***************************** Second Standard Vergola Gutter Lip Out 250 x 250 ********************************************//
if ($getQty[17] != '0.00') {
echo "<tr id=\"stdgutter2\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[17]\" value=\"{$getCFID[17]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($gutters as $gutter) {
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[17]){ 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$gutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($gutters as $gutter) {
	 if ($gutter['cf_id'] == $getID[17]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[17]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[17]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
}
else {echo "<tr id=\"stdgutter2\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[17]\" value=\"{$getCFID[17]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($gutters as $gutter) {
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[17]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$gutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($gutters as $gutter) {
	 if ($gutter['cf_id'] == $getID[17]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[17]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[17]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[17]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[17]\">";
        foreach($colours as $colour) {
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[17]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}		 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint) {
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[17]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint) {
if($paint['category'] == $getFinish[17]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[17]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[17]\" readonly=\"readonly\" value=\"{$getUOM[17]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty8\" name=\"qty[17]\" value=\"{$getQty[17]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"length\" name=\"slength[17]\" value=\"{$getLength[17]}\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[17]\" value=\"{$getRRP[17]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[17]\" value=\"{$getCost[17]}\"></td></tr>";


// ***************************** Third Standard Vergola Tappered  Gutter Lip Out 200 x 250 ********************************************//
if ($getQty[18] != '0.00') {
echo "<tr id=\"stdgutter3\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[18]\" value=\"{$getCFID[18]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
      foreach($gutters as $gutter) {
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[18]) { 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$gutter['description']."</option>";	
	  }
		
echo "</select>";
    
	 foreach($gutters as $gutter) {
	 if ($gutter['cf_id'] == $getID[18]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[18]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[18]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
}
else {echo "<tr id=\"stdgutter3\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[18]\" value=\"{$getCFID[18]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($gutters as $gutter){
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[18]){ 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$gutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($gutters as $gutter) {
	 if ($gutter['cf_id'] == $getID[18]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc18[]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[18]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[18]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[18]\">";
        foreach($colours as $colour) {
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[18]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}		 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint) {
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[18]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint) {
if($paint['category'] == $getFinish[18]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[18]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[18]\" readonly=\"readonly\" value=\"{$getUOM[18]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty9\" name=\"qty[18]\" value=\"{$getQty[18]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"width\" name=\"slength[18]\" value=\"{$getLength[18]}\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[18]\" value=\"{$getRRP[18]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[18]\" value=\"{$getCost[18]}\"></td></tr>";

// ***************************** Fourth Standard Vergola Tappered Gutter Lip Out 250 x 200 ********************************************//
if ($getQty[19] != '0.00') {
echo "<tr id=\"stdgutter4\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[19]\" value=\"{$getCFID[19]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
     
		foreach($gutters as $gutter) {
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[19]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$gutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($gutters as $gutter) {
	 if ($gutter['cf_id'] == $getID[19]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[19]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[19]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
}
else {echo "<tr id=\"stdgutter4\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[19]\" value=\"{$getCFID[19]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($gutters as $gutter) {
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[19]){
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$gutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($gutters as $gutter) {
	 if ($gutter['cf_id'] == $getID[19]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[19]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[19]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[19]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[19]\">";
        foreach($colours as $colour) {
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[19]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint) {
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[19]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint) {
if($paint['category'] == $getFinish[19]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[19]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[19]\" readonly=\"readonly\" value=\"{$getUOM[19]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty10\" name=\"qty[19]\" value=\"{$getQty[19]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"width\" name=\"slength[19]\" value=\"{$getLength[19]}\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[19]\" value=\"{$getRRP[19]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[19]\" value=\"{$getCost[19]}\"></td></tr>";

// ***************************** Fifth Standard Vergola Gutter Lip Out 200 x 200 ********************************************//
if ($getQty[20] != '0.00') {
	echo "<tr id=\"stdgutter5\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[20]\" value=\"{$getCFID[20]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
     
		foreach($gutters as $gutter) {
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[20]) { 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$gutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($gutters as $gutter){
	 if ($gutter['cf_id'] == $getID[20]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[20]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[20]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
	
	}
else {echo "<tr id=\"stdgutter5\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[20]\" value=\"{$getCFID[20]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($gutters as $gutter) {
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[20]){
		echo "selected=\"selected\""; 
		} else { echo "";}
		echo ">".$gutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($gutters as $gutter) {
	 if ($gutter['cf_id'] == $getID[20]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[20]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[20]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}

// Webbing
echo"<td><input id=\"removegutter1\" onClick=\"hidegutter1();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[20]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[20]\">";
        foreach($colours as $colour) {
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[20]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}		 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint) {
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[20]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint) {
if($paint['category'] == $getFinish[20]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[20]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else { echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[20]\" readonly=\"readonly\" value=\"{$getUOM[20]}\"></td>";
		
// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty11\" name=\"qty[20]\" value=\"{$getQty[20]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[20]\" value=\"{$getLength[20]}\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[20]\" value=\"{$getRRP[20]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[20]\" value=\"{$getCost[20]}\"></td></tr>";

// ***************************** Sixth Standard Vergola Gutter Lip Out 200 x 200 ********************************************//
if ($getQty[21] != '0.00') {
	echo "<tr id=\"stdgutter6\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[21]\" value=\"{$getCFID[21]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
     
		foreach($gutters as $gutter){
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[21]){
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$gutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($gutters as $gutter) {
	 if ($gutter['cf_id'] == $getID[21]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[21]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[21]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
	
	}
else {echo "<tr id=\"stdgutter6\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[21]\" value=\"{$getCFID[21]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($gutters as $gutter) {
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[21]){ 
		echo "selected=\"selected\""; 
		}  else {echo "";}
		echo ">".$gutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($gutters as $gutter){
	 if ($gutter['cf_id'] == $getID[21]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[21]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[21]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}

// Webbing
echo"<td><input id=\"removegutter2\" onClick=\"hidegutter2();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[21]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[21]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[21]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}		 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint) {
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[21]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[21]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[21]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[21]\" readonly=\"readonly\" value=\"{$getUOM[21]}\"></td>";
		
// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty12\" name=\"qty[21]\" value=\"{$getQty[21]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[21]\" value=\"{$getLength[21]}\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[21]\" value=\"{$getRRP[21]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[21]\" value=\"{$getCost[21]}\"></td></tr>";

// ***************************** Seventh Standard Vergola Gutter Lip Out 200 x 200 ********************************************//
if ($getQty[22] != '0.00') {
	echo "<tr id=\"stdgutter7\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[22]\" value=\"{$getCFID[22]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
     
		foreach($gutters as $gutter){
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[22]){
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$gutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($gutters as $gutter) {
	 if ($gutter['cf_id'] == $getID[22]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[22]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[22]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
	
	}
else {echo "<tr id=\"stdgutter7\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[22]\" value=\"{$getCFID[22]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($gutters as $gutter) {
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[22]){ 
		echo "selected=\"selected\""; 
		}  else {echo "";}
		echo ">".$gutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($gutters as $gutter){
	 if ($gutter['cf_id'] == $getID[22]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[22]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[22]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}

// Webbing
echo"<td><input id=\"removegutter3\" onClick=\"hidegutter3();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[22]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[22]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[22]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}		 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint) {
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[22]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[22]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[22]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[22]\" readonly=\"readonly\" value=\"{$getUOM[22]}\"></td>";
		
// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty13\" name=\"qty[22]\" value=\"{$getQty[22]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[22]\" value=\"{$getLength[22]}\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[22]\" value=\"{$getRRP[22]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[22]\" value=\"{$getCost[22]}\"></td></tr>";
// ***************************** 5th -  Vergola Tapered Gutter Lip Out 200 x 250 - IRV29 ********************************************//

if ($getQty[23] != '0.00') {
	echo "<tr id=\"stdgutter8\" style=\"display: table-row;\">";
			echo "<td><input type=\"hidden\" name=\"id[23]\" value=\"{$getCFID[23]}\" />";

				echo "<select class=\"desclist\" name=\"desclist[]\" >"; 
					foreach($gutters as $gutter){
				      	echo "<option value=\"".$gutter['cf_id']."\"";
						if($gutter['cf_id'] == $getID[23]){
						echo "selected=\"selected\""; 
						} else {echo "";}
						echo ">".$gutter['description']."</option>";	
					} 
				echo "</select>";
		    
			foreach($gutters as $gutter) {
				if ($gutter['cf_id'] == $getID[23]) { 
				 
					echo "<input type=\"hidden\" class=\"desc\" name=\"desc[23]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
					     "<input type=\"hidden\" class=\"invent\" name=\"invent[23]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
					     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
					     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
				 }
				else { echo "";}
			 }
	echo "</td>";
	
	}else {
			echo "<tr id=\"stdgutter8\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[23]\" value=\"{$getCFID[23]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
	        foreach($gutters as $gutter) {
		      	echo "<option value=\"".$gutter['cf_id']."\"";
				if($gutter['cf_id'] == $getID[23]){ 
				echo "selected=\"selected\""; 
				}  else {echo "";}
				echo ">".$gutter['description']."</option>";	
			}
			echo "</select>";
		    
			foreach($gutters as $gutter){
				 if ($gutter['cf_id'] == $getID[23]) {  
					echo "<input type=\"hidden\" class=\"desc\" name=\"desc[23]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
					     "<input type=\"hidden\" class=\"invent\" name=\"invent[23]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
					     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
					     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
						 }
				else { echo "";}
			}
			echo "</td>";

	}

// Webbing
echo"<td><input id=\"removegutter4\" onClick=\"hidegutter4();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[23]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[23]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[23]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}		 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint) {
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[23]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[23]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[23]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[23]\" readonly=\"readonly\" value=\"{$getUOM[23]}\"></td>";
		
// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty14\" name=\"qty[23]\" value=\"{$getQty[23]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[23]\" value=\"{$getLength[23]}\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[23]\" value=\"{$getRRP[23]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[23]\" value=\"{$getCost[23]}\"></td></tr>";

// ***************************** 6th - Vergola Tapered Gutter Lip Out 250 x 200 - IRV30 ********************************************//

if ($getQty[24] != '0.00') {
	echo "<tr id=\"stdgutter8\" style=\"display: table-row;\">";
			echo "<td><input type=\"hidden\" name=\"id[24]\" value=\"{$getCFID[24]}\" />";

				echo "<select class=\"desclist\" name=\"desclist[]\" >"; 
					foreach($gutters as $gutter){
				      	echo "<option value=\"".$gutter['cf_id']."\"";
						if($gutter['cf_id'] == $getID[24]){
						echo "selected=\"selected\""; 
						} else {echo "";}
						echo ">".$gutter['description']."</option>";	
					} 
				echo "</select>";
		    
			foreach($gutters as $gutter) {
				if ($gutter['cf_id'] == $getID[24]) { 
				 
					echo "<input type=\"hidden\" class=\"desc\" name=\"desc[24]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
					     "<input type=\"hidden\" class=\"invent\" name=\"invent[24]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
					     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
					     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
				 }
				else { echo "";}
			 }
	echo "</td>";
	
	}else {
			echo "<tr id=\"stdgutter8\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[24]\" value=\"{$getCFID[24]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
	        foreach($gutters as $gutter) {
		      	echo "<option value=\"".$gutter['cf_id']."\"";
				if($gutter['cf_id'] == $getID[24]){ 
				echo "selected=\"selected\""; 
				}  else {echo "";}
				echo ">".$gutter['description']."</option>";	
			}
			echo "</select>";
		    
			foreach($gutters as $gutter){
				 if ($gutter['cf_id'] == $getID[24]) {  
					echo "<input type=\"hidden\" class=\"desc\" name=\"desc[24]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
					     "<input type=\"hidden\" class=\"invent\" name=\"invent[24]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
					     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
					     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
						 }
				else { echo "";}
			}
			echo "</td>";

	}

// Webbing
echo"<td><input id=\"removegutter4\" onClick=\"hidegutter4();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[24]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[24]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[24]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}		 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint) {
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[24]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[24]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[24]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[24]\" readonly=\"readonly\" value=\"{$getUOM[24]}\"></td>";
		
// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty14\" name=\"qty[24]\" value=\"{$getQty[24]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[24]\" value=\"{$getLength[24]}\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[24]\" value=\"{$getRRP[24]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[24]\" value=\"{$getCost[25]}\"></td></tr>";

?>