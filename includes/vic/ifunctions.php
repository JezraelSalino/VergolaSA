<?php

public function list_colours($name="",$selected=null){ return "test";
	$sqlcolour = "SELECT * FROM ver_chronoforms_data_colour_vic ORDER BY colour";
	$resultcolour = mysql_query ($sqlcolour) or die ('request "Could not execute SQL query" '.$sqlcolour);
	$r = "<select class='colour' name='{$name}' id='{$name}'>";
	while ($colour = mysql_fetch_assoc($resultcolour)) 
	{ 
		$r .= "<option";
		if ($selected != null && $colour['colour'] == $selected) { echo " selected=\"selected\"";} 
		else {$r .= "";}
		$r .= ">{$colour['colour']}</option>";
	}
	$r .= "</select>";
	return $r;
}


?>