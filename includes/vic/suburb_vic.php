<?php
ini_set('display_errors', 0);


$system_config_file_path = $_SERVER['DOCUMENT_ROOT'] . '/configuration.php';
$config = array();
if (file_exists($system_config_file_path)) {
    include($system_config_file_path);
    $system_config = new JConfig();
    $config['db']['host_name'] = $system_config->host;
    $config['db']['db_name'] = $system_config->db;
    $config['db']['user_name'] = $system_config->user;
    $config['db']['password'] = $system_config->password;
    $config['path']['log_folder'] = $system_config->log_path . '\\';

    $config['db']['table_name']['suburbs'] = "ver_chronoforms_data_suburbs_vic";
}


$matches = array(
    array(
        'cf_id' => 'Error', 
        'suburb' => 'Error', 
        'suburb_state' => 'Error', 
        'suburb_postcode' => 'Error', 
        'value' => 'Error', 
        'label' => 'Error'
    )
);
if (count($config) > 0) {
    $con = mysql_connect(
        $config['db']['host_name'], 
        $config['db']['user_name'], 
        $config['db']['password']
    );
    if ($con) {
        mysql_select_db($config['db']['db_name']);
        $state_table = $config['db']['table_name']['suburbs'];

        $initialSuburbsArray = array( );
        $result = mysql_query("SELECT cf_id, suburb, suburb_state, suburb_postcode FROM {$state_table} ",$con) or die (mysql_error());
        while( $row = mysql_fetch_assoc( $result ) ) {
            $initialSuburbsArray[] = $row;
        }
        $suburbs = $initialSuburbsArray;

        $term = trim(strip_tags($_GET['term']));
        // get match
        $matches = array();
        foreach($suburbs as $suburb) {
            if(stripos($suburb['suburb'], $term) !== false) {
                // Adding the necessary "value" and "label" fields and appending to result set
                $suburb['value'] = $suburb['suburb'];
                $suburb['label'] = "{$suburb['suburb']}, {$suburb['suburb_state']} {$suburb['suburb_postcode']}";
                $matches[] = $suburb;
            }
        } 
        mysql_close($con);
    }
}
// Truncate, encode and return the results
// $matches = array_slice($matches, 0, 5);
print json_encode($matches);
exit;



/*
  // connect to database
  //$con = mysql_connect("localhost","root","password");
  //include 'database.php';
  //$con = mysql_connect("localhost","root","pass123");
  $con = mysql_connect("localhost","root","");
  if (!$con) { echo "Error"; }
  //$dbname = 'vergola_quotedb_sa_v1';

 
  //$dbname = 'vergola_quotedb_sa_v1';
  // $dbname = 'vergola_quotedb_v4_as_live';
  $dbname = 'vergola_quotedb_sa_v1_as_live';
  mysql_select_db($dbname);
  
  $state_table = "ver_chronoforms_data_suburbs_vic";
  
  $initialSuburbsArray = array( );
  $result = mysql_query("SELECT cf_id, suburb, suburb_state, suburb_postcode FROM {$state_table} ",$con) or die (mysql_error());
  while( $row = mysql_fetch_assoc( $result ) ) {
      $initialSuburbsArray[] = $row;
  }

  //$qr = "SELECT cf_id, suburb, suburb_state, suburb_postcode FROM {$state_table} ";
  //error_log($qr, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
  $suburbs = $initialSuburbsArray;
  // Cleaning up the term
  $term = trim(strip_tags($_GET['term']));
  // get match
  $matches = array();
  foreach($suburbs as $suburb){
    if(stripos($suburb['suburb'], $term) !== false){
      // Adding the necessary "value" and "label" fields and appending to result set
      $suburb['value'] = $suburb['suburb'];
      $suburb['label'] = "{$suburb['suburb']}, {$suburb['suburb_state']} {$suburb['suburb_postcode']}";
      $matches[] = $suburb;
    }
  } 
  // Truncate, encode and return the results
  $matches = array_slice($matches, 0, 5);
  // error_log(print_r($matches,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
  print json_encode($matches);
  mysql_close($con);
*/
?>