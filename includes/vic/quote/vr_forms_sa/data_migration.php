<?php
include('functions_module_calculations.php');
include('functions_module_formulas.php');


$enable_migration = array(
    'data_followup' => false, 
    'data_measurement' => false, 
    'data_quote' => true, 
    'data_contract_items' => false, 
    'data_contract_items_deminsions' => false, 
    'data_contract_bom_meterial' => false, 
    'data_contract_bom' => false
);

$enable_migration = array(
    'data_followup' => true, 
    'data_measurement' => true, 
    'data_quote' => true, 
    'data_contract_items' => true, 
    'data_contract_items_deminsions' => true, 
    'data_contract_bom_meterial' => true, 
    'data_contract_bom' => true
);

$table_names = array(
    'data_followup' => 'ver_chronoforms_data_followup_vic', 
    'data_measurement' => 'ver_chronoforms_data_measurement_vic', 
    'data_quote' => 'ver_chronoforms_data_quote_vic', 
    'data_contract_items' => 'ver_chronoforms_data_contract_items_vic', 
    'data_contract_items_deminsions' => 'ver_chronoforms_data_contract_items_deminsions', 
    'data_contract_bom_meterial' => 'ver_chronoforms_data_contract_bom_meterial_vic', 
    'data_contract_bom' => 'ver_chronoforms_data_contract_bom_vic'
);

$id_field_names = array(
    'data_followup' => 'cf_id', 
    'data_measurement' => 'cf_id', 
    'data_quote' => 'cf_id', 
    'data_contract_items' => 'cf_id', 
    'data_contract_items_deminsions' => 'cf_id', 
    'data_contract_bom_meterial' => 'id', 
    'data_contract_bom' => 'cf_id'
);

$migration_results = array();


foreach ($enable_migration as $key1 => $value1) {
    if ($value1 == true) {
        $sql = "SELECT * FROM " . $table_names[$key1] . " ORDER BY " . $id_field_names[$key1] . " ";
        $results = executeDbQuery($sql);

        $total_record_outdated = 0;
        $total_record_updated = 0;
        $failure_indexes = array();

        if ($results['error'] == 'null') {
            while ($r1 = mysql_fetch_array($results['data'])) {
                $temp_array = array();
                $current_length_feet = "";
                $current_length_inch = "";
                $current_width_feet = "";
                $current_width_inch = "";
                $additional_conditions = array();
                $additional_comments = array();
                $current_update_sql = "";

                if (isset($r1['length'])) {
                    if (strlen($r1['length']) > 0) {
                        if (is_null($r1['length_feet']) || is_null($r1['length_inch'])) {
                            $temp_array = explode("'", formulaConvertInchToFeetAndInch($r1['length']));
                            $current_length_feet = $temp_array[0];
                            $current_length_inch = $temp_array[1];
                            $additional_conditions[] = "length_feet = '" . $current_length_feet . "'";
                            $additional_conditions[] = "length_inch = '" . $current_length_inch . "'";
                            $additional_comments[] = "length = '" . $r1['length'] . "'";
                        }
                    }
                }

                if (isset($r1['width'])) {
                    if (strlen($r1['width']) > 0) {
                        if (is_null($r1['width_feet']) || is_null($r1['width_inch'])) {
                            $temp_array = explode("'", formulaConvertInchToFeetAndInch($r1['width']));
                            $current_width_feet = $temp_array[0];
                            $current_width_inch = $temp_array[1];
                            $additional_conditions[] = "width_feet = '" . $current_width_feet . "'";
                            $additional_conditions[] = "width_inch = '" . $current_width_inch . "'";
                            $additional_comments[] = "width = '" . $r1['width'] . "'";
                        }
                    }
                }

                if (count($additional_conditions) > 0) {
                    $total_record_outdated++;
                    $current_update_sql = "
                        UPDATE " . $table_names[$key1] . " 
                        SET 
                        " . implode(', ', $additional_conditions) . " 
                        WHERE " . $id_field_names[$key1] . " = '" . $r1[$id_field_names[$key1]] . "'; 
                        /*" . implode(', ', $additional_comments) . "*/
                    ";

                    $results2 = executeDbQuery($current_update_sql);
                    if ($results2['error'] == 'null') {
                        $total_record_updated++;
                    } else {
                        $failure_indexes[$r1[$id_field_names[$key1]]] = $current_update_sql;
                    }
                }
            }
            echo '<br />';
        }

        $migration_results[$key1] = array(
            'total_record_outdated' => $total_record_outdated, 
            'total_record_updated' => $total_record_updated, 
            'failure_indexes' => $failure_indexes
        );
    }
}


foreach ($migration_results as $key1 => $value1) {
    echo $key1;
    echo '<br />';
    echo 'total_record_outdated: ' . $value1['total_record_outdated'];
    echo '<br />';
    echo 'total_record_updated: ' . $value1['total_record_updated'];
    echo '<br />';
    echo 'failure_indexes: ';
    echo '<br />';
    print_r($value1['failure_indexes']);
    echo '<br />';
    echo '<br />';
}


exit;
?>