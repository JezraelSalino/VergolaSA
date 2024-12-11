<?php
// mysql_query("START TRANSACTION");


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- initialise variables -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$number_of_items_data_entry = 0;
if (isset($api_data['vr_form_items_data_entry'])) {
    $number_of_items_data_entry = count($api_data['vr_form_items_data_entry']);
}

$enable_deleting = array(
    'data_quote' => true, 
    'data_followup' => true, 
    'data_measurement' => true, 
    'data_letters' => true, 
    'data_contract_bom_meterial' => false, 
    'data_contract_bom' => false
);

if (isset($api_data['access_mode'])) {
    if ($api_data['access_mode'] == 'contract_bom_delete') {
        $enable_deleting = array(
            'data_quote' => false, 
            'data_followup' => false, 
            'data_measurement' => false, 
            'data_letters' => false, 
            'data_contract_bom_meterial' => true, 
            'data_contract_bom' => true
        );
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- delete data quote -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_delete_data['data_quote']['total_success'] = 0;
$results_delete_data['data_quote']['total_failure'] = 0;
$results_delete_data['data_quote']['is_success'] = false;

if ($enable_deleting['data_quote'] == true) {
    $sql = str_replace(
        array('[PROJECT_ID]'), 
        array($api_data['project_id']), 
        $sql_template_delete_data_quote 
    );

    $results = executeDbQuery($sql);
    if ($results['error'] == 'null') {
        $results_delete_data['data_quote']['total_success']++;
    } else {
        $results_delete_data['data_quote']['total_failure']++;
    }

    if ($results_delete_data['data_quote']['total_success'] > 0) {
        $results_delete_data['data_quote']['is_success'] = true;
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- delete data followup -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_delete_data['data_followup']['total_success'] = 0;
$results_delete_data['data_followup']['total_failure'] = 0;
$results_delete_data['data_followup']['is_success'] = false;

if ($enable_deleting['data_followup'] == true) {
    $sql = str_replace(
        array('[PROJECT_ID]'), 
        array($api_data['project_id']), 
        $sql_template_delete_data_followup 
    );

    $results = executeDbQuery($sql);
    if ($results['error'] == 'null') {
        $results_delete_data['data_followup']['total_success']++;
    } else {
        $results_delete_data['data_followup']['total_failure']++;
    }

    if ($results_delete_data['data_followup']['total_success'] > 0) {
        $results_delete_data['data_followup']['is_success'] = true;
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- delete data measurement -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_delete_data['data_measurement']['total_success'] = 0;
$results_delete_data['data_measurement']['total_failure'] = 0;
$results_delete_data['data_measurement']['is_success'] = false;

if ($enable_deleting['data_measurement'] == true) {
    $sql = str_replace(
        array('[PROJECT_ID]'), 
        array($api_data['project_id']), 
        $sql_template_delete_data_measurement 
    );

    $results = executeDbQuery($sql);
    if ($results['error'] == 'null') {
        $results_delete_data['data_measurement']['total_success']++;
    } else {
        $results_delete_data['data_measurement']['total_failure']++;
    }

    if ($results_delete_data['data_measurement']['total_success'] > 0) {
        $results_delete_data['data_measurement']['is_success'] = true;
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- delete data letters -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_delete_data['data_letters']['total_success'] = 0;
$results_delete_data['data_letters']['total_failure'] = 0;
$results_delete_data['data_letters']['is_success'] = false;

if ($enable_deleting['data_letters'] == true) {
    if ($results_delete_data['data_quote']['is_success'] == true && 
        $results_delete_data['data_followup']['is_success'] == true && 
        $results_delete_data['data_measurement']['is_success'] == true) {

        $sql = str_replace(
            array(
                '[CLIENT_ID]', '[TEMPLATE_NAME]'  
            ), 
            array(
                addslashes($api_data['quote_id']), 
                addslashes($api_data['project_id'])
            ), 
            $sql_template_delete_data_letters
        );

        if (mysql_query($sql)) {
            $results_delete_data['data_letters']['total_success']++;
        } else {
            $results_delete_data['data_letters']['total_failure']++;
        }

        if ($results_delete_data['data_letters']['total_success'] > 0) {
            $results_delete_data['data_letters']['is_success'] = true;
        }
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- delete data contract bom meterial -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_delete_data['data_contract_bom_meterial']['total_success'] = 0;
$results_delete_data['data_contract_bom_meterial']['total_failure'] = 0;
$results_delete_data['data_contract_bom_meterial']['is_success'] = false;

$number_of_targeted_items = 1;
if ($enable_deleting['data_contract_bom_meterial'] == true) {
    $target_section_ref_name = '';
    for ($c1 = 0; $c1 < $number_of_items_data_entry; $c1++) {
        if (isset($api_data['cancel_order_by_vr_section_display_name']) && 
            $api_data['cancel_order_by_vr_section_display_name'] == $api_data['vr_form_items_data_entry'][$c1]['vr_section_display_name']) {
            $target_section_ref_name = $api_data['vr_form_items_data_entry'][$c1]['vr_section_ref_name'];
            $results_delete_data['data_contract_bom_meterial']['failure_indexes'][] = $c1;
        }
    }
    if ($target_section_ref_name != '') {
        $sql = str_replace(
            array('[PROJECT_ID]', '[VR_SECTION_REF_NAME]'), 
            array($api_data['project_id'], $target_section_ref_name), 
            $sql_template_delete_data_contract_bom_meterial 
        );

        $results = executeDbQuery($sql);
        if ($results['error'] == 'null') {
            $results_delete_data['data_contract_bom_meterial']['total_success']++;
        } else {
            $results_delete_data['data_contract_bom_meterial']['total_failure']++;
        }
    }

    if ($results_delete_data['data_contract_bom_meterial']['total_success'] > 0) {
        $results_delete_data['data_contract_bom_meterial']['is_success'] = true;
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- delete data contract bom -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_delete_data['data_contract_bom']['total_success'] = 0;
$results_delete_data['data_contract_bom']['total_failure'] = 0;
$results_delete_data['data_contract_bom']['is_success'] = false;

$number_of_targeted_items = 1;
if ($enable_deleting['data_contract_bom'] == true) {
    $target_section_ref_name = '';
    for ($c1 = 0; $c1 < $number_of_items_data_entry; $c1++) {
        if (isset($api_data['cancel_order_by_vr_section_display_name']) && 
            $api_data['cancel_order_by_vr_section_display_name'] == $api_data['vr_form_items_data_entry'][$c1]['vr_section_display_name']) {
            $target_section_ref_name = $api_data['vr_form_items_data_entry'][$c1]['vr_section_ref_name'];
            $results_delete_data['data_contract_bom']['failure_indexes'][] = $c1;
        }
    }
    if ($target_section_ref_name != '') {
        $sql = str_replace(
            array('[PROJECT_ID]', '[VR_SECTION_REF_NAME]'), 
            array($api_data['project_id'], $target_section_ref_name), 
            $sql_template_delete_data_contract_bom 
        );

        $results = executeDbQuery($sql);
        if ($results['error'] == 'null') {
            $results_delete_data['data_contract_bom']['total_success']++;
        } else {
            $results_delete_data['data_contract_bom']['total_failure']++;
        }
    }

    if ($results_delete_data['data_contract_bom']['total_success'] > 0) {
        $results_delete_data['data_contract_bom']['is_success'] = true;
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- process delete data results -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$total_overall_success = $results_delete_data['data_quote']['total_success'] + 
                            $results_delete_data['data_followup']['total_success'] + 
                            $results_delete_data['data_measurement']['total_success'] + 
                            $results_delete_data['data_letters']['total_success'];

if (isset($api_data['access_mode'])) {
    if ($api_data['access_mode'] == 'contract_bom_delete') {
        $total_overall_success = $results_delete_data['data_contract_bom_meterial']['total_success'] + 
                                    $results_delete_data['data_contract_bom']['total_success'];
    }
}

if ($total_overall_success > 0) {
    $api_response['error'] = 'null';
} else {
    $api_response['error'] = '10010';
}

$api_response['message'] = array(
    'total_overall_success' => $total_overall_success, 
    'total_overall_failure' => $total_overall_failure, 
    'failure_indexes' => array(
        'data_contract_bom_meterial' => $results_delete_data['data_contract_bom_meterial']['failure_indexes'], 
        'data_contract_bom' => $results_delete_data['data_contract_bom']['failure_indexes'] 
    )
);

$api_response['data'] = array();

// if (! ($enable_deleting['data_quote'] == true && $results_delete_data['data_quote']['is_success'] == true) && 
      // ($enable_deleting['data_followup'] == true && $results_delete_data['data_followup']['is_success'] == true) &&  
      // ($enable_deleting['data_measurement'] == true && $results_delete_data['data_measurement']['is_success'] == true)) {
    // mysql_query("ROLLBACK");
// }
?>