<?php
  // connect to database
  //$con = mysql_connect("localhost","root","password");
  include 'database.php';
  if (!$con) { echo "Error"; }
  $dbname = 'vergola_quotedb';
  mysql_select_db($dbname);
  
  $section=$_POST['section'];
    $sql = "SELECT * FROM ver_chronoforms_data_section_vic WHERE section='$section' ORDER BY category";
    $sql_result = mysql_query ($sql, $con ) or die ('request "Could not execute SQL query" '.$sql);
    while ($row = mysql_fetch_assoc($sql_result)) 
    {
                echo "<option value='".$row["category"]."'".($row["category"]==$_REQUEST["category"] ? " selected" : "").">".$row["category"]."</option>"; 
    } 
    exit;

  ?>