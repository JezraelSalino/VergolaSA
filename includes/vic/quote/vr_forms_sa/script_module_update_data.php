<?php
// mysql_query("START TRANSACTION");


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- initialise variables -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$number_of_bay = 0;
if (isset($api_data['vr_form_queries_info']['vr_number_of_bay'])) {
    $number_of_bay = intval($api_data['vr_form_queries_info']['vr_number_of_bay']);
}

$number_of_items_data_entry = 0;
if (isset($api_data['vr_form_items_data_entry'])) {
    $number_of_items_data_entry = count($api_data['vr_form_items_data_entry']);
}

$enable_updating = array(
    'data_quote' => true, 
    'data_followup' => true, 
    'data_measurement' => true, 
    'data_letters' => true, 
    'data_contract_items' => false, 
    'data_contract_items_deminsions' => false
);

if (isset($api_data['access_mode'])) {
    if ($api_data['access_mode'] == 'contract_bom_item_dimension_update') {
        $enable_updating = array(
            'data_quote' => false, 
            'data_followup' => false, 
            'data_measurement' => false, 
            'data_letters' => false, 
            'data_contract_items' => false, 
            'data_contract_items_deminsions' => true
        );
    }
    if ($api_data['access_mode'] == 'contract_bom_save') {
        $enable_updating = array(
            'data_quote' => false, 
            'data_followup' => false, 
            'data_measurement' => false, 
            'data_letters' => false, 
            'data_contract_items' => true, 
            'data_contract_items_deminsions' => false
        );
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- update data quote / data contract items -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$target_data_source = 'data_quote';
$target_sql_template_insert = $sql_template_insert_data_quote;
$target_sql_template_update = $sql_template_update_data_quote;
$target_sql_template_retrieve = $sql_template_retrieve_data_quote;
$target_sql_template_delete = $sql_template_delete_data_quote_by_record_index;

if (isset($api_data['access_mode'])) {
    if ($api_data['access_mode'] == 'contract_bom_save') {
        $target_data_source = 'data_contract_items';
        $target_sql_template_insert = $sql_template_insert_data_contract_items;
        $target_sql_template_update = $sql_template_update_data_contract_items;
        $target_sql_template_retrieve = $sql_template_retrieve_data_contract_items;
        $target_sql_template_delete = $sql_template_delete_data_contract_items_by_record_index;
    }
}

$sql = '';
$results_update_data[$target_data_source]['total_input'] = $number_of_items_data_entry;
$results_update_data[$target_data_source]['total_success'] = 0;
$results_update_data[$target_data_source]['total_failure'] = 0;
$results_update_data[$target_data_source]['failure_indexes'] = array();
$results_update_data[$target_data_source]['is_success'] = false;

if ($enable_updating[$target_data_source] == true) {
    $previously_saved_vr_record_indexes = array();
    $sql = str_replace(
        array('[PROJECT_ID]'), 
        array($api_data['vr_form_system_info']['project_id']), 
        $target_sql_template_retrieve
    );
    $results = executeDbQuery($sql);
    if ($results['error'] == 'null') {
        while ($r1 = mysql_fetch_array($results['data'])) {
            $previously_saved_vr_record_indexes[] = $r1['cf_id'];
        }
    }

    $submitted_vr_record_indexes = array();

    for ($c1 = 0; $c1 < $number_of_items_data_entry; $c1++) {
        $current_vr_item_adhoc = ($api_data['vr_form_items_data_entry'][$c1]['vr_item_adhoc'] == 'yes') ? 1 : 0;

        $customisation_options = array();
        $customisation_options['vr_type_ref_name'] = $api_data['vr_form_items_data_entry'][$c1]['vr_type_ref_name'];
        $customisation_options['vr_section_display_name'] = $api_data['vr_form_items_data_entry'][$c1]['vr_section_display_name'];
        $customisation_options['vr_section_ref_name'] = $api_data['vr_form_items_data_entry'][$c1]['vr_section_ref_name'];
        $customisation_options['vr_subsection_display_name'] = $api_data['vr_form_items_data_entry'][$c1]['vr_subsection_display_name'];
        $customisation_options['vr_subsection_ref_name'] = $api_data['vr_form_items_data_entry'][$c1]['vr_subsection_ref_name'];
        $customisation_options['vr_item_display_name_input_type'] = $api_data['vr_form_items_data_entry'][$c1]['vr_item_display_name_input_type'];
        $customisation_options['vr_item_webbing_input_type'] = $api_data['vr_form_items_data_entry'][$c1]['vr_item_webbing_input_type'];
        $customisation_options['vr_item_colour_input_type'] = $api_data['vr_form_items_data_entry'][$c1]['vr_item_colour_input_type'];
        $customisation_options['vr_item_finish_input_type'] = $api_data['vr_form_items_data_entry'][$c1]['vr_item_finish_input_type'];
        $customisation_options['vr_item_uom_input_type'] = $api_data['vr_form_items_data_entry'][$c1]['vr_item_uom_input_type'];
        $customisation_options['vr_item_unit_price_input_type'] = $api_data['vr_form_items_data_entry'][$c1]['vr_item_unit_price_input_type'];
        $customisation_options['vr_item_qty_input_type'] = $api_data['vr_form_items_data_entry'][$c1]['vr_item_qty_input_type'];
        $customisation_options['vr_item_length_meter_input_type'] = $api_data['vr_form_items_data_entry'][$c1]['vr_item_length_meter_input_type'];
        $customisation_options['vr_item_rrp_input_type'] = $api_data['vr_form_items_data_entry'][$c1]['vr_item_rrp_input_type'];
        $customisation_options['vr_item_image'] = $api_data['vr_form_items_data_entry'][$c1]['vr_item_image'];
        $customisation_options['vr_item_image_input_type'] = $api_data['vr_form_items_data_entry'][$c1]['vr_item_image_input_type'];
        $customisation_options['vr_item_config_internal_ref_name'] = $api_data['vr_form_items_data_entry'][$c1]['vr_item_config_internal_ref_name'];
        $customisation_options_in_string = json_encode($customisation_options);

        if (strval($api_data['vr_form_items_data_entry'][$c1]['vr_record_index']) != '' && 
            strval($api_data['vr_form_items_data_entry'][$c1]['vr_record_index']) != '0') {
            $submitted_vr_record_indexes[] = $api_data['vr_form_items_data_entry'][$c1]['vr_record_index'];
            // use update sql template
            $sql = str_replace(
                array(
                    '[PROJECT_NAME]',           '[VR_FRAMEWORK_TYPE]', 
                    '[VR_TYPE_DISPLAY_NAME]',   '[VR_ITEM_REF_NAME]', 
                    '[VR_ITEM_DISPLAY_NAME]',   '[VR_ITEM_WEBBING]', 
                    '[VR_ITEM_COLOUR]',         '[VR_ITEM_FINISH]', 
                    '[VR_ITEM_UOM]',            '[VR_ITEM_UNIT_PRICE]', 
                    '[VR_ITEM_QTY]',            '[VR_ITEM_LENGTH_METER]', 
                    '[VR_ITEM_RRP]',            '[VR_ITEM_ADHOC]', 
                    '[CUSTOMISATION_OPTIONS]',  '[PROJECT_ID]', 
                    '[VR_RECORD_INDEX]'
                ), 
                array(
                    addslashes($api_data['vr_form_queries_info']['vr_project_name']), 
                    addslashes($api_data['vr_form_queries_info']['vr_framework_type']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_type_display_name']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_ref_name']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_display_name']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_webbing']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_colour']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_finish']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_uom']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_unit_price']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_qty']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_length_meter']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_rrp']), 
                    addslashes($current_vr_item_adhoc), 
                    addslashes($customisation_options_in_string), 
                    addslashes($api_data['vr_form_system_info']['project_id']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_record_index']) 
                ), 
                $target_sql_template_update
            );
        } else {
            // use save sql template
            $sql = str_replace(
                array(
                    '[QUOTE_ID]',                   '[PROJECT_ID]',             '[PROJECT_NAME]', 
                    '[VR_FRAMEWORK_TYPE]',          '[VR_TYPE_DISPLAY_NAME]',   '[VR_ITEM_REF_NAME]', 
                    '[VR_ITEM_DISPLAY_NAME]',       '[VR_ITEM_WEBBING]',        '[VR_ITEM_COLOUR]', 
                    '[VR_ITEM_FINISH]',             '[VR_ITEM_UOM]',            '[VR_ITEM_UNIT_PRICE]', 
                    '[VR_ITEM_QTY]',                '[VR_ITEM_LENGTH_METER]',    
                    '[VR_ITEM_RRP]',                '[VR_ITEM_ADHOC]', 
                    '[CUSTOMISATION_OPTIONS]'
                ), 
                array(
                    addslashes($api_data['vr_form_system_info']['quote_id']), 
                    addslashes($api_data['vr_form_system_info']['project_id']), 
                    addslashes($api_data['vr_form_queries_info']['vr_project_name']), 
                    addslashes($api_data['vr_form_queries_info']['vr_framework_type']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_type_display_name']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_ref_name']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_display_name']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_webbing']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_colour']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_finish']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_uom']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_unit_price']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_qty']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_length_meter']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_rrp']), 
                    addslashes($current_vr_item_adhoc), 
                    addslashes($customisation_options_in_string)
                ), 
                $target_sql_template_insert
            );
        }

        $results = executeDbQuery($sql);
        if ($results['error'] == 'null') {
            $results_update_data[$target_data_source]['total_success']++;
        } else {
            $results_update_data[$target_data_source]['total_failure']++;
            $results_update_data[$target_data_source]['failure_indexes'][] = $c1;
        }
    }

    if ($results_update_data[$target_data_source]['total_input'] == $results_update_data[$target_data_source]['total_success']) {
        $results_update_data[$target_data_source]['is_success'] = true;
    }

    // clear removed items from table
    foreach ($previously_saved_vr_record_indexes as $key1 => $vr_record_index) {
        if (!in_array($vr_record_index, $submitted_vr_record_indexes)) {
            $sql = str_replace(
                array('[PROJECT_ID]', '[CF_ID]'), 
                array($api_data['vr_form_system_info']['project_id'], $vr_record_index), 
                $target_sql_template_delete
            );
            $results = executeDbQuery($sql);
        }
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- update data followup -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_update_data['data_followup']['total_input'] = 1;
$results_update_data['data_followup']['total_success'] = 0;
$results_update_data['data_followup']['total_failure'] = 0;
$results_update_data['data_followup']['failure_indexes'] = array();
$results_update_data['data_followup']['is_success'] = false;

if ($enable_updating['data_followup'] == true) {
    $customisation_options_in_string = '';
    if ($api_data['vr_form_queries_info']['vr_type'] == 'VR8' || 
        $api_data['vr_form_queries_info']['vr_type'] == 'VR9') {
        $customisation_options = array();
        $customisation_options['vr_run_meter'] = $api_data['vr_form_queries_info']['vr_run_meter'];
        $customisation_options['vr_rise_meter'] = $api_data['vr_form_queries_info']['vr_rise_meter'];
        $customisation_options_in_string = json_encode($customisation_options);
    }

    $sql = str_replace(
        array(
            '[PROJECT_NAME]',                       '[VR_FRAMEWORK_TYPE]', 
            '[VR_DEFAULT_COLOUR]',                  '[VR_COMMISSION_SALES_COMMISSION]', 
            '[VR_COMMISSION_SALES_COMMISSION]',     '[VR_COMMISSION_PAY1]', 
            '[VR_COMMISSION_PAY2]',                 '[VR_COMMISSION_FINAL]', 
            '[VR_COMMISSION_INSTALLER_PAYMENT]',    '[VR_COMMISSION_INSTALLER_PAYMENT]', 
            '[VR_PAYMENT_DEPOSIT]',                 '[VR_PAYMENT_PROGRESS_PAYMENT]', 
            '[VR_PAYMENT_FINAL_PAYMENT]',           '[VR_PAYMENT_VERGOLA]', 
            '[VR_PAYMENT_DISBURSEMENT_SUB_TOTAL]',  '[VR_PAYMENT_SUB_TOTAL]', 
            '[VR_PAYMENT_TAX]',                     '[VR_PAYMENT_TAX]', 
            '[VR_PAYMENT_TOTAL]',                   '[TOTAL_RRP]', 
            '[GST_PERCENT]',                        '[COMM_PERCENT]', 
            '[CUSTOMISATION_OPTIONS]',              '[PROJECT_ID]', 
            '[VR_RECORD_INDEX]'
        ), 
        array(
            addslashes($api_data['vr_form_queries_info']['vr_project_name']), 
            addslashes($api_data['vr_form_queries_info']['vr_framework_type']), 
            addslashes($api_data['vr_form_queries_info']['vr_default_colour']), 
            addslashes($api_data['vr_form_billing_info']['vr_commission_sales_commission']), 
            addslashes($api_data['vr_form_billing_info']['vr_commission_sales_commission']), 
            addslashes($api_data['vr_form_billing_info']['vr_commission_pay1']), 
            addslashes($api_data['vr_form_billing_info']['vr_commission_pay2']), 
            addslashes($api_data['vr_form_billing_info']['vr_commission_final']), 
            addslashes($api_data['vr_form_billing_info']['vr_commission_installer_payment']), 
            addslashes($api_data['vr_form_billing_info']['vr_commission_installer_payment']), 
            addslashes($api_data['vr_form_billing_info']['vr_payment_deposit']), 
            addslashes($api_data['vr_form_billing_info']['vr_payment_progress_payment']), 
            addslashes($api_data['vr_form_billing_info']['vr_payment_final_payment']), 
            addslashes($api_data['vr_form_billing_info']['vr_payment_vergola']), 
            addslashes($api_data['vr_form_billing_info']['vr_payment_disbursement_sub_total']), 
            addslashes($api_data['vr_form_billing_info']['vr_payment_sub_total']), 
            addslashes($api_data['vr_form_billing_info']['vr_payment_tax']), 
            addslashes($api_data['vr_form_billing_info']['vr_payment_tax']), 
            addslashes($api_data['vr_form_billing_info']['vr_payment_total']), 
            addslashes($api_data['vr_form_billing_info']['vr_payment_vr_items_rrp']), 
            addslashes($api_data['vr_form_system_info']['payment_tax_percentage'] * 100), 
            addslashes($api_data['vr_form_system_info']['payment_vergola_commission_percentage'] * 100), 
            addslashes($customisation_options_in_string), 
            addslashes($api_data['vr_form_system_info']['project_id']), 
            addslashes($api_data['vr_form_billing_info']['vr_record_index']) 
        ), 
        $sql_template_update_data_followup
    );

    $results = executeDbQuery($sql);
    if ($results['error'] == 'null') {
        $results_update_data['data_followup']['total_success']++;
    } else {
        $results_update_data['data_followup']['total_failure']++;
    }

    if ($results_update_data['data_followup']['total_input'] == $results_update_data['data_followup']['total_success']) {
        $results_update_data['data_followup']['is_success'] = true;
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- update data measurement -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_update_data['data_measurement']['total_input'] = count($api_data['vr_form_queries_info']['vr_length_info']['vr_lengths_meter']);
$results_update_data['data_measurement']['total_success'] = 0;
$results_update_data['data_measurement']['total_failure'] = 0;
$results_update_data['data_measurement']['failure_indexes'] = array();
$results_update_data['data_measurement']['is_success'] = false;

if ($enable_updating['data_measurement'] == true) {
    for ($c1 = 0; $c1 < count($api_data['vr_form_queries_info']['vr_length_info']['vr_lengths_meter']); $c1++) {
        $sql = str_replace(
            array(
                '[VR_FRAMEWORK_TYPE]',  '[VR_WIDTH_METER]', 
                '[VR_LENGTH_METER]', 
                '[PROJECT_ID]', 
                '[VR_RECORD_INDEX]'
            ), 
            array(
                addslashes($api_data['vr_form_queries_info']['vr_framework_type']), 
                addslashes($api_data['vr_form_queries_info']['vr_width_meter']), 
                addslashes($api_data['vr_form_queries_info']['vr_length_info']['vr_lengths_meter'][$c1]), 
                addslashes($api_data['vr_form_system_info']['project_id']), 
                addslashes($api_data['vr_form_queries_info']['vr_length_info']['vr_record_indexes'][$c1]) 
            ), 
            $sql_template_update_data_measurement
        );

        $results = executeDbQuery($sql);
        if ($results['error'] == 'null') {
            $results_update_data['data_measurement']['total_success']++;
        } else {
            $results_update_data['data_measurement']['total_failure']++;
            $results_update_data['data_measurement']['failure_indexes'][] = $c1;
        }
    }

    if ($results_update_data['data_measurement']['total_input'] == $results_update_data['data_measurement']['total_success']) {
        $results_update_data['data_measurement']['is_success'] = true;
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- update data letters -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_update_data['data_letters']['total_input'] = 1;
$results_update_data['data_letters']['total_success'] = 0;
$results_update_data['data_letters']['total_failure'] = 0;
$results_update_data['data_letters']['failure_indexes'] = array();
$results_update_data['data_letters']['is_success'] = false;

if ($enable_updating['data_letters'] == true) {
    if ($results_update_data[$target_data_source]['is_success'] == true && 
        $results_update_data['data_followup']['is_success'] == true && 
        $results_update_data['data_measurement']['is_success'] == true) {

        $template_content = str_replace(
            array('[BLANK_SPACE]'), 
            array('&nbsp;'), 
            $api_data['vr_form_report_info']
        );

        $sql = str_replace(
            array(
                '{[TEMPLATE_CONTENT]}', '[CLIENT_ID]', '[TEMPLATE_NAME]'  
            ), 
            array(
                addslashes($template_content), 
                addslashes($api_data['vr_form_system_info']['quote_id']), 
                addslashes($api_data['vr_form_system_info']['project_id'])
            ), 
            $sql_template_update_data_letters
        );

        if (mysql_query($sql)) {
            $results_update_data['data_letters']['total_success']++;
        } else {
            $results_update_data['data_letters']['total_failure']++;
        }

        if ($results_update_data['data_letters']['total_input'] == $results_update_data['data_letters']['total_success']) {
            $results_update_data['data_letters']['is_success'] = true;
        }
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- update data contract items deminsions -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_update_data['data_contract_items_deminsions']['total_input'] = 1;
$results_update_data['data_contract_items_deminsions']['total_success'] = 0;
$results_update_data['data_contract_items_deminsions']['total_failure'] = 0;
$results_update_data['data_contract_items_deminsions']['failure_indexes'] = array();
$results_update_data['data_contract_items_deminsions']['is_success'] = false;

$last_insert_id_data_contract_items = '0';
$last_insert_id_data_contract_items_deminsions = '0';
$data_contract_items_deminsions_action = 'update';

if ($enable_updating['data_contract_items_deminsions'] == true) {
    $current_vr_item_adhoc = ($api_data['vr_form_items_data_entry']['vr_item_adhoc'] == 'yes') ? 1 : 0;

    $customisation_options = array();
    $customisation_options['vr_type_ref_name'] = $api_data['vr_form_items_data_entry']['vr_type_ref_name'];
    $customisation_options['vr_section_display_name'] = $api_data['vr_form_items_data_entry']['vr_section_display_name'];
    $customisation_options['vr_section_ref_name'] = $api_data['vr_form_items_data_entry']['vr_section_ref_name'];
    $customisation_options['vr_subsection_display_name'] = $api_data['vr_form_items_data_entry']['vr_subsection_display_name'];
    $customisation_options['vr_subsection_ref_name'] = $api_data['vr_form_items_data_entry']['vr_subsection_ref_name'];
    $customisation_options['vr_item_display_name_input_type'] = $api_data['vr_form_items_data_entry']['vr_item_display_name_input_type'];
    $customisation_options['vr_item_webbing_input_type'] = $api_data['vr_form_items_data_entry']['vr_item_webbing_input_type'];
    $customisation_options['vr_item_colour_input_type'] = $api_data['vr_form_items_data_entry']['vr_item_colour_input_type'];
    $customisation_options['vr_item_finish_input_type'] = $api_data['vr_form_items_data_entry']['vr_item_finish_input_type'];
    $customisation_options['vr_item_uom_input_type'] = $api_data['vr_form_items_data_entry']['vr_item_uom_input_type'];
    $customisation_options['vr_item_unit_price_input_type'] = $api_data['vr_form_items_data_entry']['vr_item_unit_price_input_type'];
    $customisation_options['vr_item_qty_input_type'] = $api_data['vr_form_items_data_entry']['vr_item_qty_input_type'];
    $customisation_options['vr_item_length_meter_input_type'] = $api_data['vr_form_items_data_entry']['vr_item_length_meter_input_type'];
    $customisation_options['vr_item_rrp_input_type'] = $api_data['vr_form_items_data_entry']['vr_item_rrp_input_type'];
    $customisation_options['vr_item_image'] = $api_data['vr_form_items_data_entry']['vr_item_image'];
    $customisation_options['vr_item_image_input_type'] = $api_data['vr_form_items_data_entry']['vr_item_image_input_type'];
    $customisation_options['vr_item_config_internal_ref_name'] = $api_data['vr_form_items_data_entry']['vr_item_config_internal_ref_name'];
    $customisation_options_in_string = json_encode($customisation_options);

    if ($api_data['vr_form_items_data_entry']['bom_form_item_dimensions_info']['item_dimension_record_index'] != '') {
        $results_update_data['data_contract_items_deminsions']['total_input'] = 2;

        $sql = str_replace(
            array(
                '[PROJECT_NAME]',           '[VR_FRAMEWORK_TYPE]', 
                '[VR_TYPE_DISPLAY_NAME]',   '[VR_ITEM_REF_NAME]', 
                '[VR_ITEM_DISPLAY_NAME]',   '[VR_ITEM_WEBBING]', 
                '[VR_ITEM_COLOUR]',         '[VR_ITEM_FINISH]', 
                '[VR_ITEM_UOM]',            '[VR_ITEM_UNIT_PRICE]', 
                '[VR_ITEM_QTY]',            '[VR_ITEM_LENGTH_METER]', 
                '[VR_ITEM_RRP]',            '[VR_ITEM_ADHOC]', 
                '[CUSTOMISATION_OPTIONS]',  '[PROJECT_ID]', 
                '[VR_RECORD_INDEX]'
            ), 
            array(
                addslashes($api_data['vr_project_name']), 
                addslashes($api_data['vr_framework_type']), 
                addslashes($api_data['vr_form_items_data_entry']['vr_type_display_name']), 
                addslashes($api_data['vr_form_items_data_entry']['vr_item_ref_name']), 
                addslashes($api_data['vr_form_items_data_entry']['vr_item_display_name']), 
                addslashes($api_data['vr_form_items_data_entry']['vr_item_webbing']), 
                addslashes($api_data['vr_form_items_data_entry']['vr_item_colour']), 
                addslashes($api_data['vr_form_items_data_entry']['vr_item_finish']), 
                addslashes($api_data['vr_form_items_data_entry']['vr_item_uom']), 
                addslashes($api_data['vr_form_items_data_entry']['vr_item_unit_price']), 
                addslashes($api_data['vr_form_items_data_entry']['vr_item_qty']), 
                addslashes($api_data['vr_form_items_data_entry']['vr_item_length_meter']), 
                addslashes($api_data['vr_form_items_data_entry']['vr_item_rrp']), 
                addslashes($current_vr_item_adhoc), 
                addslashes($customisation_options_in_string), 
                addslashes($api_data['project_id']), 
                addslashes($api_data['vr_form_items_data_entry']['vr_record_index']) 
            ), 
            $sql_template_update_data_contract_items
        );

        $results = executeDbQuery($sql);
        if ($results['error'] == 'null') {
            $results_update_data['data_contract_items_deminsions']['total_success']++;
        } else {
            $results_update_data['data_contract_items_deminsions']['total_failure']++;
        }
        $last_insert_id_data_contract_items = $api_data['vr_form_items_data_entry']['vr_record_index'];

        $data_contract_items_deminsions_action = 'update';
        $sql = str_replace(
            array(
                '[VR_ITEM_REF_NAME]', 
                '[LENGTH_METER]', 
                '[DIMENSION_A_MM]', 
                '[DIMENSION_B_MM]', 
                '[DIMENSION_C_MM]', 
                '[DIMENSION_D_MM]', 
                '[DIMENSION_E_MM]', 
                '[DIMENSION_F_MM]', 
                '[DIMENSION_G_MM]', 
                '[DIMENSION_H_MM]', 
                '[DIMENSION_P_MM]', 
                '[GIRTH_SIDE_A_MM]', 
                '[GIRTH_SIDE_B_MM]', 
                '[PROJECT_ID]', 
                '[VR_RECORD_INDEX]'
            ), 
            array(
                addslashes($api_data['inventory_id']), 
                addslashes($api_data['vr_form_items_data_entry']['bom_form_item_dimensions_info']['item_dimension_length_meter']), 
                addslashes($api_data['vr_form_items_data_entry']['bom_form_item_dimensions_info']['item_dimension_a_mm']), 
                addslashes($api_data['vr_form_items_data_entry']['bom_form_item_dimensions_info']['item_dimension_b_mm']), 
                addslashes($api_data['vr_form_items_data_entry']['bom_form_item_dimensions_info']['item_dimension_c_mm']), 
                addslashes($api_data['vr_form_items_data_entry']['bom_form_item_dimensions_info']['item_dimension_d_mm']), 
                addslashes($api_data['vr_form_items_data_entry']['bom_form_item_dimensions_info']['item_dimension_e_mm']), 
                addslashes($api_data['vr_form_items_data_entry']['bom_form_item_dimensions_info']['item_dimension_f_mm']), 
                addslashes($api_data['vr_form_items_data_entry']['bom_form_item_dimensions_info']['item_dimension_g_mm']), 
                addslashes($api_data['vr_form_items_data_entry']['bom_form_item_dimensions_info']['item_dimension_h_mm']), 
                addslashes($api_data['vr_form_items_data_entry']['bom_form_item_dimensions_info']['item_dimension_p_mm']), 
                addslashes($api_data['vr_form_items_data_entry']['bom_form_item_dimensions_info']['item_dimension_girth_side_a_mm']), 
                addslashes($api_data['vr_form_items_data_entry']['bom_form_item_dimensions_info']['item_dimension_girth_side_b_mm']), 
                addslashes($api_data['project_id']), 
                addslashes($api_data['vr_form_items_data_entry']['bom_form_item_dimensions_info']['item_dimension_record_index'])
            ), 
            $sql_template_update_data_contract_item_dimensions
        );
    } else {
        $cf_id = $api_data['cf_id'];
        if (!(strval($api_data['cf_id']) != '' && 
              strval($api_data['cf_id']) != '0')) {
            $results_update_data['data_contract_items_deminsions']['total_input'] = 2;

            $sql = str_replace(
                array(
                    '[QUOTE_ID]',                   '[PROJECT_ID]',             '[PROJECT_NAME]', 
                    '[VR_FRAMEWORK_TYPE]',          '[VR_TYPE_DISPLAY_NAME]',   '[VR_ITEM_REF_NAME]', 
                    '[VR_ITEM_DISPLAY_NAME]',       '[VR_ITEM_WEBBING]',        '[VR_ITEM_COLOUR]', 
                    '[VR_ITEM_FINISH]',             '[VR_ITEM_UOM]',            '[VR_ITEM_UNIT_PRICE]', 
                    '[VR_ITEM_QTY]',                '[VR_ITEM_LENGTH_METER]',    
                    '[VR_ITEM_RRP]',                '[VR_ITEM_ADHOC]', 
                    '[CUSTOMISATION_OPTIONS]'
                ), 
                array(
                    addslashes($api_data['quote_id']), 
                    addslashes($api_data['project_id']), 
                    addslashes($api_data['vr_project_name']), 
                    addslashes($api_data['vr_framework_type']), 
                    addslashes($api_data['vr_form_items_data_entry']['vr_type_display_name']), 
                    addslashes($api_data['vr_form_items_data_entry']['vr_item_ref_name']), 
                    addslashes($api_data['vr_form_items_data_entry']['vr_item_display_name']), 
                    addslashes($api_data['vr_form_items_data_entry']['vr_item_webbing']), 
                    addslashes($api_data['vr_form_items_data_entry']['vr_item_colour']), 
                    addslashes($api_data['vr_form_items_data_entry']['vr_item_finish']), 
                    addslashes($api_data['vr_form_items_data_entry']['vr_item_uom']), 
                    addslashes($api_data['vr_form_items_data_entry']['vr_item_unit_price']), 
                    addslashes($api_data['vr_form_items_data_entry']['vr_item_qty']), 
                    addslashes($api_data['vr_form_items_data_entry']['vr_item_length_meter']), 
                    addslashes($api_data['vr_form_items_data_entry']['vr_item_rrp']), 
                    addslashes($current_vr_item_adhoc), 
                    addslashes($customisation_options_in_string)
                ), 
                $sql_template_insert_data_contract_items
            );

            $results = executeDbQuery($sql);
            if ($results['error'] == 'null') {
                $sql = $sql_template_retrieve_last_insert_id;
                $results2 = executeDbQuery($sql);
                while ($r2 = mysql_fetch_array($results2['data'])) {
                    $last_insert_id_data_contract_items = $r2['last_insert_id'];
                }
                $cf_id = $last_insert_id_data_contract_items;

                $results_update_data['data_contract_items_deminsions']['total_success']++;
            } else {
                $results_update_data['data_contract_items_deminsions']['total_failure']++;
            }
        }

        $data_contract_items_deminsions_action = 'save';
        $sql = str_replace(
            array(
                '[CF_ID]',                      '[QUOTE_ID]',               '[PROJECT_ID]', 
                '[VR_ITEM_REF_NAME]', 
                '[LENGTH_METER]',                
                '[DIMENSION_A_MM]',           
                '[DIMENSION_B_MM]',           
                '[DIMENSION_C_MM]',           
                '[DIMENSION_D_MM]',           
                '[DIMENSION_E_MM]',           
                '[DIMENSION_F_MM]',           
                '[DIMENSION_G_MM]', 
                '[DIMENSION_H_MM]', 
                '[DIMENSION_P_MM]',           
                '[GIRTH_SIDE_A_MM]',          
                '[GIRTH_SIDE_B_MM]' ), array( addslashes($cf_id), addslashes
                 ($api_data['quote_id']), addslashes($api_data
                 ['project_id']), addslashes($api_data
                 ['inventory_id']), addslashes($api_data
                 ['vr_form_items_data_entry']
                 ['bom_form_item_dimensions_info']
                 ['item_dimension_length_meter']), addslashes($api_data
                 ['vr_form_items_data_entry']
                 ['bom_form_item_dimensions_info']
                 ['item_dimension_a_mm']), addslashes($api_data
                 ['vr_form_items_data_entry']
                 ['bom_form_item_dimensions_info']
                 ['item_dimension_b_mm']), addslashes($api_data
                 ['vr_form_items_data_entry']
                 ['bom_form_item_dimensions_info']
                 ['item_dimension_c_mm']), addslashes($api_data
                 ['vr_form_items_data_entry']
                 ['bom_form_item_dimensions_info']
                 ['item_dimension_d_mm']), addslashes($api_data
                 ['vr_form_items_data_entry']
                 ['bom_form_item_dimensions_info']
                 ['item_dimension_e_mm']), addslashes($api_data
                 ['vr_form_items_data_entry']
                 ['bom_form_item_dimensions_info']
                 ['item_dimension_f_mm']), addslashes($api_data
                 ['vr_form_items_data_entry']
                 ['bom_form_item_dimensions_info']
                 ['item_dimension_g_mm']), addslashes($api_data
                 ['vr_form_items_data_entry']
                 ['bom_form_item_dimensions_info']
                 ['item_dimension_h_mm']), addslashes($api_data
                 ['vr_form_items_data_entry']
                 ['bom_form_item_dimensions_info']
                 ['item_dimension_p_mm']), addslashes($api_data
                 ['vr_form_items_data_entry']
                 ['bom_form_item_dimensions_info']
                 ['item_dimension_girth_side_a_mm']), addslashes($api_data
                 ['vr_form_items_data_entry']
                 ['bom_form_item_dimensions_info']
                 ['item_dimension_girth_side_b_mm']) ),
                 $sql_template_insert_data_contract_item_dimensions ); }

    if (mysql_query($sql)) {
        if ($data_contract_items_deminsions_action == 'save') {
            $sql = $sql_template_retrieve_last_insert_id;
            $results2 = executeDbQuery($sql);
            while ($r2 = mysql_fetch_array($results2['data'])) {
                $last_insert_id_data_contract_items_deminsions = $r2['last_insert_id'];
            }
        } else {
            $last_insert_id_data_contract_items_deminsions = $api_data['vr_form_items_data_entry']['bom_form_item_dimensions_info']['item_dimension_record_index'];
        }

        $results_update_data['data_contract_items_deminsions']['total_success']++;
    } else {
        $results_update_data['data_contract_items_deminsions']['total_failure']++;
    }

    if ($results_update_data['data_contract_items_deminsions']['total_input'] == $results_update_data['data_contract_items_deminsions']['total_success']) {
        $results_update_data['data_contract_items_deminsions']['is_success'] = true;
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- process update data results -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$total_overall_input = $results_update_data[$target_data_source]['total_input'] + 
                            $results_update_data['data_followup']['total_input'] + 
                            $results_update_data['data_measurement']['total_input'] + 
                            $results_update_data['data_letters']['total_input'];
$total_overall_success = $results_update_data[$target_data_source]['total_success'] + 
                            $results_update_data['data_followup']['total_success'] + 
                            $results_update_data['data_measurement']['total_success'] + 
                            $results_update_data['data_letters']['total_success'];
$total_overall_failure = $results_update_data[$target_data_source]['total_failure'] + 
                            $results_update_data['data_followup']['total_failure'] + 
                            $results_update_data['data_measurement']['total_failure'] + 
                            $results_update_data['data_letters']['total_failure'];

if (isset($api_data['access_mode'])) {
    if ($api_data['access_mode'] == 'contract_bom_item_dimension_update') {
        $total_overall_input = $results_update_data['data_contract_items_deminsions']['total_input'];
        $total_overall_success = $results_update_data['data_contract_items_deminsions']['total_success'];
        $total_overall_failure = $results_update_data['data_contract_items_deminsions']['total_failure'];
    }
    if ($api_data['access_mode'] == 'contract_bom_save') {
        $total_overall_input = $results_update_data[$target_data_source]['total_input'];
        $total_overall_success = $results_update_data[$target_data_source]['total_success'];
        $total_overall_failure = $results_update_data[$target_data_source]['total_failure'];
    }
}

if ($total_overall_input == $total_overall_success) {
    $api_response['error'] = 'null';
} else {
    $api_response['error'] = '10010';
}

$api_response['message'] = array(
    'total_overall_input' => $total_overall_input, 
    'total_overall_success' => $total_overall_success, 
    'total_overall_failure' => $total_overall_failure, 
    'failure_indexes' => array(
        $target_data_source => $results_update_data[$target_data_source]['failure_indexes'], 
        'data_followup' => $results_update_data['data_followup']['failure_indexes'], 
        'data_measurement' => $results_update_data['data_measurement']['failure_indexes'], 
        'data_letters' => $results_update_data['data_letters']['failure_indexes'], 
        'data_contract_items_deminsions' => $results_update_data['data_contract_items_deminsions']['failure_indexes']
    ) 
);

$api_response['data'] = array(
    'last_insert_id_data_contract_items' => $last_insert_id_data_contract_items, 
    'last_insert_id_data_contract_items_deminsions' => $last_insert_id_data_contract_items_deminsions
);

// if (! ($enable_updating[$target_data_source] == true && $results_update_data[$target_data_source]['is_success'] == true) && 
      // ($enable_updating['data_followup'] == true && $results_update_data['data_followup']['is_success'] == true) &&  
      // ($enable_updating['data_measurement'] == true && $results_update_data['data_measurement']['is_success'] == true)) {
    // mysql_query("ROLLBACK");
// }
?>