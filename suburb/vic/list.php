<?php
 
$querysub="SELECT cf_id, suburb, suburb_state, suburb_postcode FROM ver_chronoforms_data_suburbs_vic ORDER BY suburb ASC";
$resultsub = mysql_query($querysub);
if(!$resultsub){die ("Could not query the database: <br />" . mysql_error());}
 //create selection list				
	while($row = mysql_fetch_row($resultsub))
	{
		$heading = $row[0];	
		$SuburbIDArrayPhp .= 'SuburbIDArray["'.$heading.'"]="'.$row[0].'";';
		$SuburbArrayPhp .= 'SuburbArray["'.$heading.'"]="'.$row[1].'";';
		$StateArrayPhp .= 'StateArray["'.$heading.'"]="'.$row[2].'";';
		$PostcodeArrayPhp .= 'PostcodeArray["'.$heading.'"]="'.$row[3].'";';

	}
	
echo "<label class='input'><span>Suburb</span><select class='csuburb-list' id='csuburblist' name='csuburblist' onchange='javascript:SelectChangedClient();'><option></option>";
      
            $querysub2="SELECT cf_id, suburb, suburb_state, suburb_postcode FROM ver_chronoforms_data_suburbs_vic ORDER BY suburb ASC";
            $resultsub2 = mysql_query($querysub2);
            if(!$resultsub2){die ("Could not query the database: <br />" . mysql_error());
			}
			
			  while ($data=mysql_fetch_assoc($resultsub2)){
                  echo "<option value = '{$data[cf_id]}'";
                       if ($ClientSuburbID == $data[cf_id]) {
                            echo "selected = 'selected'";
					    }
                        echo ">{$data[suburb]}</option>";
		        }
 
echo "</select></label>";


?>