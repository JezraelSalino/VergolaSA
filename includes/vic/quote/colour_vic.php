<?php
$resultcolours = mysql_query("SELECT cf_id, colour FROM ver_chronoforms_data_colour_vic ORDER BY colour" );
echo"<select name=\"colour[]\">";
     while ($colours = mysql_fetch_array($resultcolours)) :
      	echo "<option value=\"".$colours['colour']."\">".$colours['colour']."</option>";	
	 endwhile;	
echo"</select>";
  ?>