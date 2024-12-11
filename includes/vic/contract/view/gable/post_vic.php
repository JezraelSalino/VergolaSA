<?php 
// ***************************** First Post 90 x 90 - 2mm Galv ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Fittings</td></tr>";
echo "<tr id=\"post1\">";
echo "<td><input type=\"hidden\" name=\"id[3]\" value=\"{$getCFID[3]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        $posts = array();
		while ($post = mysql_fetch_array($resultpost)) {
		$posts[] = $post;
		$heading = isset($post[0]) ? $post[0] : null;
		$BeamIDArrayPhp .= isset($post[1]) ? 'BeamIDArray["'.$heading.'"]="'.$post[1].'";' : null;	
		$BeamDESCArrayPhp .= isset($post[2]) ? 'BeamDESCArray["'.$heading.'"]="'.$post[2].'";' : null;
		$BeamRRPArrayPhp .= isset($post[4]) ? 'BeamRRPArray["'.$heading.'"]="'.$post[4].'";' : null;
		$BeamCOSTArrayPhp .= isset($post[5]) ? 'BeamCOSTArray["'.$heading.'"]="'.$post[5].'";' : null;
		}
		foreach($posts as $post) {
      	echo "<option value=\"".$post['cf_id']."\"";
		if($post['cf_id'] == $getID[3]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$post['description']."</option>";	
		}
echo "</select>";
    
	 foreach($posts as $post){
     if ($post['cf_id'] == $getID[3]) {
	 echo "<input type=\"hidden\" class=\"desc\" name=\"desc[3]\" value=\"".$post['description']."\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[3]\" value=\"".$post['inventoryid']."\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$post['rrp']."\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$post['cost']."\"/>"; }
	 else {echo "";}
	 } 
	 echo "</td>";

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
echo "<td><input type=\"text\" id=\"addqty1\" name=\"qty[3]\" value=\"{$getQty[3]}\"></td>";

// Length or Width
if ($getID[3] == '107') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[3]\" value=\"{$getLength[3]}\" style=\"display:none;\"></td>"; }
else { echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[3]\" value=\"{$getLength[3]}\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[3]\" value=\"{$getRRP[3]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[3]\" value=\"{$getCost[3]}\"></td></tr>";

// ***************************** First New Post ********************************************//
if ($getQty[4] != '0.00') {
echo "<tr id=\"post2\" style=\"display:table-row\">";

echo "<td><input type=\"hidden\" name=\"id[4]\" value=\"{$getCFID[4]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
		foreach($posts as $post) {
      	echo "<option value=\"".$post['cf_id']."\"";
		if($post['cf_id'] == $getID[4]) { echo "selected=\"selected\""; 
		} else { echo "";}
		echo ">".$post['description']."</option>";	
		}
echo "</select>";
    
	 foreach($posts as $post){
     if ($post['cf_id'] == $getID[4]) {
	 echo "<input type=\"hidden\" class=\"desc\" name=\"desc[4]\" value=\"".$post['description']."\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[4]\" value=\"".$post['inventoryid']."\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$post['rrp']."\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$post['cost']."\"/>"; }
	 else {echo "";}
	 } 
	 echo "</td>";
} 
else { echo "<tr id=\"post2\" style=\"display:none\"><td><input type=\"hidden\" name=\"id[4]\" value=\"{$getCFID[4]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
		foreach($posts as $post) {
      	echo "<option value=\"".$post['cf_id']."\"";
		if($post['cf_id'] == $getID[4]) { echo "selected=\"selected\""; 
		} else { echo "";}
		echo ">".$post['description']."</option>";	
		}
echo "</select>";
    
	 foreach($posts as $post){
     if ($post['cf_id'] == $getID[4]) {
	 echo "<input type=\"hidden\" class=\"desc\" name=\"desc[4]\" value=\"".$post['description']."\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[4]\" value=\"".$post['inventoryid']."\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$post['rrp']."\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$post['cost']."\"/>"; }
	 else {echo "";}
	 } 
	 echo "</td>";}

// Webbing
echo"<td><input type=\"button\" value=\"Remove Post\" onclick=\"hidepost1();\" id=\"removepost1\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[4]\" value=\"\" readonly=\"readonly\" /></td>";

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
		} else { echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";

foreach($paints as $paint){
if ($paint['category'] == $getFinish[4]) {
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[4]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
     } else { echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[4]\" readonly=\"readonly\" value=\"{$getUOM[4]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty2\" name=\"qty[4]\" value=\"{$getQty[4]}\"></td>";

// Length or Width
if ($getID[4] == '107') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[4]\" value=\"{$getLength[4]}\" style=\"display:none;\"></td>"; }
else { echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[4]\" value=\"{$getLength[4]}\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[4]\" value=\"{$getRRP[4]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[4]\" value=\"{$getCost[4]}\"></td></tr>";


// ***************************** Second New Post ********************************************//
if ($getQty[5] != '0.00') {
echo "<tr id=\"post3\" style=\"display:table-row\">";

echo "<td><input type=\"hidden\" name=\"id[5]\" value=\"{$getCFID[5]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
		foreach($posts as $post){
      	echo "<option value=\"".$post['cf_id']."\"";
		if($post['cf_id'] == $getID[5]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$post['description']."</option>";	
		}
echo "</select>";
    
	foreach($posts as $post){
     if ($post['cf_id'] == $getID[5]) {
	 echo "<input type=\"hidden\" class=\"desc\" name=\"desc[5]\" value=\"".$post['description']."\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[5]\" value=\"".$post['inventoryid']."\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$post['rrp']."\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$post['cost']."\"/>"; }
	 else {echo "";}
	} 
	 echo "</td>";
} 
else { echo "<tr id=\"post3\" style=\"display:none\"><td><input type=\"hidden\" name=\"id[5]\" value=\"{$getCFID[5]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
		foreach($posts as $post){
      	echo "<option value=\"".$post['cf_id']."\"";
		if($post['cf_id'] == $getID[5]) { echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$post['description']."</option>";	
		}
echo "</select>";
    
	 foreach($posts as $post){
     if ($post['cf_id'] == $getID[5]) {
	 echo "<input type=\"hidden\" class=\"desc\" name=\"desc[5]\" value=\"".$post['description']."\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[5]\" value=\"".$post['inventoryid']."\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$post['rrp']."\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$post['cost']."\"/>"; }
	 else {echo "";}
	 }
	 echo "</td>";}

// Webbing
echo"<td><input type=\"button\" value=\"Remove Post\" onclick=\"hidepost2();\" id=\"removepost2\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[5]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[5]\">";
        foreach($colours as $colour) {
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[5]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}		 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[5]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";

foreach($paints as $paint){
if ($paint['category'] == $getFinish[5]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[5]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[5]\" readonly=\"readonly\" value=\"{$getUOM[5]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty3\" name=\"qty[5]\" value=\"{$getQty[5]}\"></td>";

// Length or Width
if ($getID[5] == '107') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[5]\" value=\"{$getLength[5]}\" style=\"display:none;\"></td>"; }
else { echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[5]\" value=\"{$getLength[5]}\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[5]\" value=\"{$getRRP[5]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[5]\" value=\"{$getCost[5]}\"></td></tr>";


// ***************************** Third New Post ********************************************//
if ($getQty[6] != '0.00') {
echo "<tr id=\"post4\" style=\"display:table-row\">";

echo "<td><input type=\"hidden\" name=\"id[6]\" value=\"{$getCFID[6]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
		foreach($posts as $post){
      	echo "<option value=\"".$post['cf_id']."\"";
		if($post['cf_id'] == $getID[6]) { echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$post['description']."</option>";	
		}
echo "</select>";
    
	 foreach($posts as $post){
     if ($post['cf_id'] == $getID[6]) {
	 echo "<input type=\"hidden\" class=\"desc\" name=\"desc[6]\" value=\"".$post['description']."\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[6]\" value=\"".$post['inventoryid']."\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$post['rrp']."\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$post['cost']."\"/>"; }
	 else {echo "";}
	 } 
	 echo "</td>";
} 
else { echo "<tr id=\"post4\" style=\"display:none\"><td><input type=\"hidden\" name=\"id[6]\" value=\"{$getCFID[6]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
		foreach($posts as $post){
      	echo "<option value=\"".$post['cf_id']."\"";
		if($post['cf_id'] == $getID[6]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$post['description']."</option>";	
		}
echo "</select>";
    
	 foreach($posts as $post){
     if ($post['cf_id'] == $getID[6]) {
	 echo "<input type=\"hidden\" class=\"desc\" name=\"desc[6]\" value=\"".$post['description']."\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[6]\" value=\"".$post['inventoryid']."\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$post['rrp']."\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$post['cost']."\"/>"; }
	 else {echo "";}
	 }
	 echo "</td>";}

// Webbing
echo"<td><input type=\"button\" value=\"Remove Post\" onclick=\"hidepost3();\" id=\"removepost3\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[6]\" value=\"\" readonly=\"readonly\" /></td>";

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
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[6]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";

foreach($paints as $paint){
if ($paint['category'] == $getFinish[6]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[6]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
     }
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[6]\" readonly=\"readonly\" value=\"{$getUOM[6]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty4\" name=\"qty[6]\" value=\"{$getQty[6]}\"></td>";

// Length or Width
if ($getID[6] == '107') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[6]\" value=\"{$getLength[6]}\" style=\"display:none;\"></td>"; }
else { echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[6]\" value=\"{$getLength[6]}\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[6]\" value=\"{$getRRP[6]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[6]\" value=\"{$getCost[6]}\"></td></tr>";


// ***************************** Fourth New Post ********************************************//
if ($getQty[7] != '0.00') {
echo "<tr id=\"post5\" style=\"display:table-row\">";

echo "<td><input type=\"hidden\" name=\"id[7]\" value=\"{$getCFID[7]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
		foreach($posts as $post){
      	echo "<option value=\"".$post['cf_id']."\"";
		if($post['cf_id'] == $getID[7]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$post['description']."</option>";	
		}
echo "</select>";
    
	 foreach($posts as $post){
     if ($post['cf_id'] == $getID[7]) {
	 echo "<input type=\"hidden\" class=\"desc\" name=\"desc[7]\" value=\"".$post['description']."\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[7]\" value=\"".$post['inventoryid']."\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$post['rrp']."\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$post['cost']."\"/>"; }
	 else {echo "";}
	 } 
	 echo "</td>";
} 
else { echo "<tr id=\"post5\" style=\"display:none\"><td><input type=\"hidden\" name=\"id[7]\" value=\"{$getCFID[7]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
		foreach($posts as $post) {
      	echo "<option value=\"".$post['cf_id']."\"";
		if($post['cf_id'] == $getID[7]) { echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$post['description']."</option>";	
		}
echo "</select>";
    
	 foreach($posts as $post){
     if ($post['cf_id'] == $getID[7]) {
	 echo "<input type=\"hidden\" class=\"desc\" name=\"desc[7]\" value=\"".$post['description']."\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[7]\" value=\"".$post['inventoryid']."\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$post['rrp']."\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$post['cost']."\"/>"; }
	 else {echo "";}
	 }
	 echo "</td>";}

// Webbing
echo"<td><input type=\"button\" value=\"Remove Post\" onclick=\"hidepost4();\" id=\"removepost4\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[7]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[7]\">";
        foreach($colours as $colour) {
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
if ($paint['category'] == $getFinish[7]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[7]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";


// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[7]\" readonly=\"readonly\" value=\"{$getUOM[7]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty5\" name=\"qty[7]\" value=\"{$getQty[7]}\"></td>";

// Length or Width
if ($getID[7] == '107') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[7]\" value=\"{$getLength[7]}\" style=\"display:none;\"></td>"; }
else { echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[7]\" value=\"{$getLength[7]}\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[7]\" value=\"{$getRRP[7]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[7]\" value=\"{$getCost[7]}\"></td></tr>";

// ***************************** Fifth New Post ********************************************//
if ($getQty[8] != '0.00') {
echo "<tr id=\"post6\" style=\"display:table-row\">";

echo "<td><input type=\"hidden\" name=\"id[8]\" value=\"{$getCFID[8]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
		foreach($posts as $post){
      	echo "<option value=\"".$post['cf_id']."\"";
		if($post['cf_id'] == $getID[8]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$post['description']."</option>";	
		}
echo "</select>";
    
	 foreach($posts as $post){
     if ($post['cf_id'] == $getID[8]) {
	 echo "<input type=\"hidden\" class=\"desc\" name=\"desc[8]\" value=\"".$post['description']."\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[8]\" value=\"".$post['inventoryid']."\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$post['rrp']."\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$post['cost']."\"/>"; }
	 else {echo "";}
	 }
	 echo "</td>";
} 
else { echo "<tr id=\"post6\" style=\"display:none\"><td><input type=\"hidden\" name=\"id[8]\" value=\"{$getCFID[8]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
		foreach($posts as $post) {
      	echo "<option value=\"".$post['cf_id']."\"";
		if($post['cf_id'] == $getID[8]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$post['description']."</option>";	
		}
echo "</select>";
    
	 foreach($posts as $post){
     if ($post['cf_id'] == $getID[8]) {
	 echo "<input type=\"hidden\" class=\"desc\" name=\"desc[8]\" value=\"".$post['description']."\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[8]\" value=\"".$post['inventoryid']."\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$post['rrp']."\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$post['cost']."\"/>"; }
	 else {echo "";}
	 }
	 echo "</td>";}

// Webbing
echo"<td><input type=\"button\" value=\"Remove Post\" onclick=\"hidepost5();\" id=\"removepost5\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[8]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[8]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[8]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}		 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint) {
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[8]){ echo "selected=\"selected\"";
		} else {echo  "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";

foreach($paints as $paint) {
if ($paint['category'] == $getFinish[8]) {
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[8]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[8]\" readonly=\"readonly\" value=\"{$getUOM[8]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty6\" name=\"qty[8]\" value=\"{$getQty[8]}\"></td>";

// Length or Width
if ($getID[8] == '107') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[8]\" value=\"{$getLength[8]}\" style=\"display:none;\"></td>"; }
else { echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[8]\" value=\"{$getLength[8]}\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[8]\" value=\"{$getRRP[8]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[8]\" value=\"{$getCost[8]}\"></td></tr>";


if ($getQty[4] != '0.00' && $getQty[5] == '0.00'){
// Add New Post 1
echo "<tr id=\"post7\" style=\"display:none;\"><td><input id=\"addpost1\" onClick=\"showpost1();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add New Post 2
echo "<tr id=\"post8\" style=\"display:table-row;\"><td><input id=\"addpost2\" onClick=\"showpost2();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add New Post 3
echo "<tr id=\"post9\" style=\"display:none;\"><td><input id=\"addpost3\" onClick=\"showpost3();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add New Post 4
echo "<tr id=\"post10\" style=\"display:none;\"><td><input id=\"addpost4\" onClick=\"showpost4();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add New Post 5
echo "<tr id=\"post11\" style=\"display:none;\"><td><input id=\"addpost5\" onClick=\"showpost5();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
}
elseif ($getQty[4] != '0.00' && $getQty[5] != '0.00' && $getQty[6] == '0.00') {
// Add New Post 1
echo "<tr id=\"post7\" style=\"display:none;\"><td><input id=\"addpost1\" onClick=\"showpost1();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add New Post 2
echo "<tr id=\"post8\" style=\"display:none;\"><td><input id=\"addpost2\" onClick=\"showpost2();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add New Post 3
echo "<tr id=\"post9\" style=\"display:table-row;\"><td><input id=\"addpost3\" onClick=\"showpost3();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add New Post 4
echo "<tr id=\"post10\" style=\"display:none;\"><td><input id=\"addpost4\" onClick=\"showpost4();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add New Post 5
echo "<tr id=\"post11\" style=\"display:none;\"><td><input id=\"addpost5\" onClick=\"showpost5();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";	

}

elseif ($getQty[4] != '0.00' && $getQty[5] != '0.00' && $getQty[6] != '0.00' && $getQty[7] == '0.00') {
// Add New Post 1
echo "<tr id=\"post7\" style=\"display:none;\"><td><input id=\"addpost1\" onClick=\"showpost1();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add New Post 2
echo "<tr id=\"post8\" style=\"display:none;\"><td><input id=\"addpost2\" onClick=\"showpost2();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add New Post 3
echo "<tr id=\"post9\" style=\"display:none;\"><td><input id=\"addpost3\" onClick=\"showpost3();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add New Post 4
echo "<tr id=\"post10\" style=\"display:table-row;\"><td><input id=\"addpost4\" onClick=\"showpost4();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add New Post 5
echo "<tr id=\"post11\" style=\"display:none;\"><td><input id=\"addpost5\" onClick=\"showpost5();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";	

}

elseif ($getQty[4] != '0.00' && $getQty[5] != '0.00' && $getQty[6] != '0.00' && $getQty[7] != '0.00' && $getQty[8] == '0.00') {
// Add New Post 1
echo "<tr id=\"post7\" style=\"display:none;\"><td><input id=\"addpost1\" onClick=\"showpost1();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add New Post 2
echo "<tr id=\"post8\" style=\"display:none;\"><td><input id=\"addpost2\" onClick=\"showpost2();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add New Post 3
echo "<tr id=\"post9\" style=\"display:none;\"><td><input id=\"addpost3\" onClick=\"showpost3();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add New Post 4
echo "<tr id=\"post10\" style=\"display:none;\"><td><input id=\"addpost4\" onClick=\"showpost4();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add New Post 5
echo "<tr id=\"post11\" style=\"display:table-row;\"><td><input id=\"addpost5\" onClick=\"showpost5();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";	

}

elseif ($getQty[4] != '0.00' && $getQty[5] != '0.00' && $getQty[6] != '0.00' && $getQty[7] != '0.00' && $getQty[8] != '0.00') {
// Add New Post 1
echo "<tr id=\"post7\" style=\"display:none;\"><td><input id=\"addpost1\" onClick=\"showpost1();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add New Post 2
echo "<tr id=\"post8\" style=\"display:none;\"><td><input id=\"addpost2\" onClick=\"showpost2();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add New Post 3
echo "<tr id=\"post9\" style=\"display:none;\"><td><input id=\"addpost3\" onClick=\"showpost3();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add New Post 4
echo "<tr id=\"post10\" style=\"display:none;\"><td><input id=\"addpost4\" onClick=\"showpost4();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add New Post 5
echo "<tr id=\"post11\" style=\"display:none;\"><td><input id=\"addpost5\" onClick=\"showpost5();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";	

}

else {
	// Add New Post 1
echo "<tr id=\"post7\"><td><input id=\"addpost1\" onClick=\"showpost1();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add New Post 2
echo "<tr id=\"post8\" style=\"display:none;\"><td><input id=\"addpost2\" onClick=\"showpost2();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add New Post 3
echo "<tr id=\"post9\" style=\"display:none;\"><td><input id=\"addpost3\" onClick=\"showpost3();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add New Post 4
echo "<tr id=\"post10\" style=\"display:none;\"><td><input id=\"addpost4\" onClick=\"showpost4();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add New Post 5
echo "<tr id=\"post11\" style=\"display:none;\"><td><input id=\"addpost5\" onClick=\"showpost5();\" type=\"button\" value=\"Add New Post\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";	
	}

?>