<?php
// ***************************** First Standard Vergola Gutter Lip Out 200 x 200 ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Gutters</td></tr>";
if ($getQty[0] != '0.00') {
echo "<tr id=\"stdgutter1\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[0]\" value=\"{$getCFID[0]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        $gutters = array();
		while ($gutter = mysql_fetch_array($resultstdgutter)) {
		$gutters[] = $gutter;
		$heading = isset($gutter[0]) ? $gutter[0] : null;
        $BeamIDArrayPhp .= isset($gutter[1]) ? 'BeamIDArray["'.$heading.'"]="'.$gutter[1].'";' : null;	
        $BeamDESCArrayPhp .= isset($gutter[2]) ? 'BeamDESCArray["'.$heading.'"]="'.$gutter[2].'";' : null;
        $BeamRRPArrayPhp .= isset($gutter[4]) ? 'BeamRRPArray["'.$heading.'"]="'.$gutter[4].'";' : null;
        $BeamCOSTArrayPhp .= isset($gutter[5]) ? 'BeamCOSTArray["'.$heading.'"]="'.$gutter[5].'";' : null;
		}
		
		foreach($gutters as $gutter) {
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[0]) { 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$gutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($gutters as $gutter) {
	 if ($gutter['cf_id'] == $getID[0]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[0]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[0]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
}
else {echo "<tr id=\"stdgutter1\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[0]\" value=\"{$getCFID[0]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        $gutters = array();
		while ($gutter = mysql_fetch_array($resultstdgutter)) {
		$gutters[] = $gutter;
		$heading = isset($gutter[0]) ? $gutter[0] : null;
        $BeamIDArrayPhp .= isset($gutter[1]) ? 'BeamIDArray["'.$heading.'"]="'.$gutter[1].'";' : null;	
        $BeamDESCArrayPhp .= isset($gutter[2]) ? 'BeamDESCArray["'.$heading.'"]="'.$gutter[2].'";' : null;
        $BeamRRPArrayPhp .= isset($gutter[4]) ? 'BeamRRPArray["'.$heading.'"]="'.$gutter[4].'";' : null;
        $BeamCOSTArrayPhp .= isset($gutter[5]) ? 'BeamCOSTArray["'.$heading.'"]="'.$gutter[5].'";' : null;
		}
        foreach($gutters as $gutter) {
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[0]){ 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$gutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($gutters as $gutter){
	 if ($gutter['cf_id'] == $getID[0]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[0]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[0]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[0]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[0]\">";
     $colours = array();
     while ($colour = mysql_fetch_array($resultcolours)) { 
	     $colours[] = $colour['colour']; }
		 foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[0]){ echo "selected=\"selected\""; 
		} else {echo ""; }
		echo ">".$colour."</option>";
		 }		 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";
       $paints = array();
while ($paint = mysql_fetch_array($resultpp)){
	     $paints[] = $paint; 
		 $heading = isset($paint[0]) ? $paint[0] : null;	
		 $BeamDESCArrayPhp .= isset($paint[3]) ? 'BeamDESCArray["'.$heading.'"]="'.$paint[3].'";' : null;
		 $BeamRRPArrayPhp .= isset($paint[1]) ? 'BeamRRPArray["'.$heading.'"]="'.$paint[1].'";' : null;
		 $BeamCOSTArrayPhp .= isset($paint[2]) ? 'BeamCOSTArray["'.$heading.'"]="'.$paint[2].'";' : null;
         }
       
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[0]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";

foreach($paints as $paint) {
if ($paint['category'] == $getFinish[0]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[0]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo ""; }
     }
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[0]\" readonly=\"readonly\" value=\"{$getUOM[0]}\"></td>";
 
 // Unit Quantity
echo "<td><input type=\"text\" id=\"addqty7\" name=\"qty[0]\" value=\"{$getQty[0]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"width\" name=\"slength[0]\" value=\"{$getLength[0]}\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[0]\" value=\"{$getRRP[0]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[0]\" value=\"{$getCost[0]}\"></td></tr>";
// ***************************** Second Standard Vergola Gutter Lip Out 250 x 250 ********************************************//
if ($getQty[1] != '0.00') {
echo "<tr id=\"stdgutter2\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[1]\" value=\"{$getCFID[1]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($gutters as $gutter) {
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[1]){ 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$gutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($gutters as $gutter) {
	 if ($gutter['cf_id'] == $getID[1]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[1]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[1]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
}
else {echo "<tr id=\"stdgutter2\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[1]\" value=\"{$getCFID[1]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($gutters as $gutter) {
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[1]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$gutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($gutters as $gutter) {
	 if ($gutter['cf_id'] == $getID[1]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[1]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[1]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[1]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[1]\">";
        foreach($colours as $colour) {
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[1]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}		 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint) {
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[1]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint) {
if($paint['category'] == $getFinish[1]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[1]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[1]\" readonly=\"readonly\" value=\"{$getUOM[1]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty8\" name=\"qty[1]\" value=\"{$getQty[1]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"width\" name=\"slength[1]\" value=\"{$getLength[1]}\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[1]\" value=\"{$getRRP[1]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[1]\" value=\"{$getCost[1]}\"></td></tr>";


// ***************************** Third Standard Vergola Tappered  Gutter Lip Out 200 x 250 ********************************************//
if ($getQty[2] != '0.00') {
echo "<tr id=\"stdgutter3\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[2]\" value=\"{$getCFID[2]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
      foreach($gutters as $gutter) {
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[2]) { 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$gutter['description']."</option>";	
	  }
		
echo "</select>";
    
	 foreach($gutters as $gutter) {
	 if ($gutter['cf_id'] == $getID[2]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[2]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[2]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
}
else {echo "<tr id=\"stdgutter3\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[2]\" value=\"{$getCFID[2]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($gutters as $gutter){
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[2]){ 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$gutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($gutters as $gutter) {
	 if ($gutter['cf_id'] == $getID[2]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc18[]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[2]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[2]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[2]\">";
        foreach($colours as $colour) {
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[2]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}		 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint) {
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[2]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint) {
if($paint['category'] == $getFinish[2]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[2]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[2]\" readonly=\"readonly\" value=\"{$getUOM[2]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty9\" name=\"qty[2]\" value=\"{$getQty[2]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"width\" name=\"slength[2]\" value=\"{$getLength[2]}\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[2]\" value=\"{$getRRP[2]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[2]\" value=\"{$getCost[2]}\"></td></tr>";

// ***************************** Fourth Standard Vergola Tappered Gutter Lip Out 250 x 200 ********************************************//
if ($getQty[3] != '0.00') {
echo "<tr id=\"stdgutter4\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[3]\" value=\"{$getCFID[3]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
     
		foreach($gutters as $gutter) {
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[3]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$gutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($gutters as $gutter) {
	 if ($gutter['cf_id'] == $getID[3]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[3]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[3]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
}
else {echo "<tr id=\"stdgutter4\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[3]\" value=\"{$getCFID[3]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($gutters as $gutter) {
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[3]){
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$gutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($gutters as $gutter) {
	 if ($gutter['cf_id'] == $getID[3]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[3]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[3]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[3]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[3]\">";
        foreach($colours as $colour) {
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[3]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint) {
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[3]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint) {
if($paint['category'] == $getFinish[3]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[3]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[3]\" readonly=\"readonly\" value=\"{$getUOM[3]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty10\" name=\"qty[3]\" value=\"{$getQty[3]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"width\" name=\"slength[3]\" value=\"{$getLength[3]}\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[3]\" value=\"{$getRRP[3]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[3]\" value=\"{$getCost[3]}\"></td></tr>";

// ***************************** Fifth Standard Vergola Gutter Lip Out 200 x 200 ********************************************//
if ($getQty[4] != '0.00') {
	echo "<tr id=\"stdgutter5\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[4]\" value=\"{$getCFID[4]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
     
		foreach($gutters as $gutter) {
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[4]) { 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$gutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($gutters as $gutter){
	 if ($gutter['cf_id'] == $getID[4]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[4]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[4]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
	
	}
else {echo "<tr id=\"stdgutter5\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[4]\" value=\"{$getCFID[4]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($gutters as $gutter) {
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[4]){
		echo "selected=\"selected\""; 
		} else { echo "";}
		echo ">".$gutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($gutters as $gutter) {
	 if ($gutter['cf_id'] == $getID[4]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[4]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[4]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}

// Webbing
echo"<td><input id=\"removegutter1\" onClick=\"hidegutter1();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[4]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[4]\">";
        foreach($colours as $colour) {
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[4]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}		 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint) {
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[4]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint) {
if($paint['category'] == $getFinish[4]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[4]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else { echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[4]\" readonly=\"readonly\" value=\"{$getUOM[4]}\"></td>";
		
// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty11\" name=\"qty[4]\" value=\"{$getQty[4]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[4]\" value=\"{$getLength[4]}\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[4]\" value=\"{$getRRP[4]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[4]\" value=\"{$getCost[4]}\"></td></tr>";

// ***************************** Sixth Standard Vergola Gutter Lip Out 200 x 200 ********************************************//
if ($getQty[5] != '0.00') {
	echo "<tr id=\"stdgutter6\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[5]\" value=\"{$getCFID[5]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
     
		foreach($gutters as $gutter){
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[5]){
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$gutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($gutters as $gutter) {
	 if ($gutter['cf_id'] == $getID[5]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[5]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[5]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
	
	}
else {echo "<tr id=\"stdgutter6\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[5]\" value=\"{$getCFID[5]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($gutters as $gutter) {
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[5]){ 
		echo "selected=\"selected\""; 
		}  else {echo "";}
		echo ">".$gutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($gutters as $gutter){
	 if ($gutter['cf_id'] == $getID[5]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[5]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[5]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}

// Webbing
echo"<td><input id=\"removegutter2\" onClick=\"hidegutter2();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[5]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[5]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[5]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}		 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint) {
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[5]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[5]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[5]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[5]\" readonly=\"readonly\" value=\"{$getUOM[5]}\"></td>";
		
// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty12\" name=\"qty[5]\" value=\"{$getQty[5]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[5]\" value=\"{$getLength[5]}\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[5]\" value=\"{$getRRP[5]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[5]\" value=\"{$getCost[5]}\"></td></tr>";

// ***************************** Seventh Standard Vergola Gutter Lip Out 200 x 200 ********************************************//
if ($getQty[6] != '0.00') {
	echo "<tr id=\"stdgutter7\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[6]\" value=\"{$getCFID[6]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
     
		foreach($gutters as $gutter){
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[6]){
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$gutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($gutters as $gutter) {
	 if ($gutter['cf_id'] == $getID[6]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[6]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[6]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
	
	}
else {echo "<tr id=\"stdgutter7\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[6]\" value=\"{$getCFID[6]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($gutters as $gutter) {
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[6]){ 
		echo "selected=\"selected\""; 
		}  else {echo "";}
		echo ">".$gutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($gutters as $gutter){
	 if ($gutter['cf_id'] == $getID[6]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[6]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[6]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}

// Webbing
echo"<td><input id=\"removegutter3\" onClick=\"hidegutter3();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[6]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[6]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[6]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}		 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint) {
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[6]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[6]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[6]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[6]\" readonly=\"readonly\" value=\"{$getUOM[6]}\"></td>";
		
// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty13\" name=\"qty[6]\" value=\"{$getQty[6]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[6]\" value=\"{$getLength[6]}\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[6]\" value=\"{$getRRP[6]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[6]\" value=\"{$getCost[6]}\"></td></tr>";
// ***************************** Eight Standard Vergola Gutter Lip Out 200 x 200 ********************************************//

if ($getQty[7] != '0.00') {
	echo "<tr id=\"stdgutter8\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[7]\" value=\"{$getCFID[7]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
     
		foreach($gutters as $gutter){
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[7]){
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$gutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($gutters as $gutter) {
	 if ($gutter['cf_id'] == $getID[7]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[7]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[7]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
	
	}
else {echo "<tr id=\"stdgutter8\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[7]\" value=\"{$getCFID[7]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($gutters as $gutter) {
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == $getID[7]){ 
		echo "selected=\"selected\""; 
		}  else {echo "";}
		echo ">".$gutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($gutters as $gutter){
	 if ($gutter['cf_id'] == $getID[7]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[7]\" value=\"".$gutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[7]\" value=\"".$gutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$gutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$gutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}

// Webbing
echo"<td><input id=\"removegutter4\" onClick=\"hidegutter4();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[7]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[7]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[7]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}		 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint) {
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[7]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[7]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[7]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[7]\" readonly=\"readonly\" value=\"{$getUOM[7]}\"></td>";
		
// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty14\" name=\"qty[7]\" value=\"{$getQty[7]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[7]\" value=\"{$getLength[7]}\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[7]\" value=\"{$getRRP[7]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[7]\" value=\"{$getCost[7]}\"></td></tr>";
?>