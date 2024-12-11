<?php
// mysql_query("START TRANSACTION");


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- initialise variables -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = str_replace(
    array(), 
    array(), 
    $sql_template_retrieve_status_data_followup
);
$results = executeDbQuery($sql);
if ($results['error'] == 'null') {
    $r1 = mysql_fetch_array($results['data']);
    $next_project_id = 'PRV' . $r1['Auto_increment'];
} else {
    $app_response['error'][] = $results['error'];
    $app_response['message'][] = $results['message'];
}

$submitted_project_id = $api_data['vr_form_system_info']['project_id'];
$api_data['vr_form_system_info']['project_id'] = $next_project_id;

$number_of_bay = 0;
if (isset($api_data['vr_form_queries_info']['vr_number_of_bay'])) {
    $number_of_bay = intval($api_data['vr_form_queries_info']['vr_number_of_bay']);
}

$number_of_items_data_entry = 0;
if (isset($api_data['vr_form_items_data_entry'])) {
    $number_of_items_data_entry = count($api_data['vr_form_items_data_entry']);
}

$enable_saving = array(
    'data_quote' => true, 
    'data_followup' => true, 
    'data_measurement' => true, 
    'data_letters' => true, 
    'data_contract_bom_meterial' => false, 
    'data_contract_bom' => false
);
 
if (isset($api_data['access_mode'])) {
    if ($api_data['access_mode'] == 'contract_bom_save') {
        $enable_saving = array(
            'data_quote' => false, 
            'data_followup' => false, 
            'data_measurement' => false, 
            'data_letters' => false, 
            'data_contract_bom_meterial' => true, 
            'data_contract_bom' => true
        );
        $api_data['vr_form_system_info']['project_id'] = $submitted_project_id;
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- save data quote -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_save_data['data_quote']['total_input'] = $number_of_items_data_entry;
$results_save_data['data_quote']['total_success'] = 0;
$results_save_data['data_quote']['total_failure'] = 0;
$results_save_data['data_quote']['failure_indexes'] = array();
$results_save_data['data_quote']['is_success'] = false;

if ($enable_saving['data_quote'] == true) {
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

        $sql = str_replace(
            array(
                '[QUOTE_ID]',                   '[PROJECT_ID]',             '[PROJECT_NAME]', 
                '[VR_FRAMEWORK_TYPE]',          '[VR_TYPE_DISPLAY_NAME]',   '[VR_ITEM_REF_NAME]', 
                '[VR_ITEM_DISPLAY_NAME]',       '[VR_ITEM_WEBBING]',        '[VR_ITEM_COLOUR]', 
                '[VR_ITEM_FINISH]',             '[VR_ITEM_UOM]',            '[VR_ITEM_UNIT_PRICE]', 
                '[VR_ITEM_QTY]',                '[VR_ITEM_LENGTH_METER]',    
                '[VR_ITEM_RRP]',            '[VR_ITEM_ADHOC]', 
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
            $sql_template_insert_data_quote
        );

        $results = executeDbQuery($sql);
        if ($results['error'] == 'null') {
            $results_save_data['data_quote']['total_success']++;
        } else {
            $results_save_data['data_quote']['total_failure']++;
            $results_save_data['data_quote']['failure_indexes'][] = $c1;
        }
    }

    if ($results_save_data['data_quote']['total_input'] == $results_save_data['data_quote']['total_success']) {
        $results_save_data['data_quote']['is_success'] = true;
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- save data followup -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_save_data['data_followup']['total_input'] = 1;
$results_save_data['data_followup']['total_success'] = 0;
$results_save_data['data_followup']['total_failure'] = 0;
$results_save_data['data_followup']['failure_indexes'] = array();
$results_save_data['data_followup']['is_success'] = false;

if ($enable_saving['data_followup'] == true) {
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
            '[QUOTE_ID]',                           '[QUOTE_DATE]',                         '[PROJECT_ID]', 
            '[PROJECT_NAME]',                       '[SALES_REP_ID]',                       '[SALES_REP_NAME]', 
            '[VR_FRAMEWORK_TYPE]',                  '[VR_DEFAULT_COLOUR]',                  '[VR_COMMISSION_SALES_COMMISSION]', 
            '[VR_COMMISSION_SALES_COMMISSION]',     '[VR_COMMISSION_PAY1]',                 '[VR_COMMISSION_PAY2]', 
            '[VR_COMMISSION_FINAL]',                '[VR_COMMISSION_INSTALLER_PAYMENT]',    '[VR_COMMISSION_INSTALLER_PAYMENT]', 
            '[VR_PAYMENT_DEPOSIT]',                 '[VR_PAYMENT_PROGRESS_PAYMENT]',        '[VR_PAYMENT_FINAL_PAYMENT]', 
            '[VR_PAYMENT_VERGOLA]',                 '[VR_PAYMENT_DISBURSEMENT_SUB_TOTAL]',  '[VR_PAYMENT_SUB_TOTAL]', 
            '[VR_PAYMENT_TAX]',                     '[VR_PAYMENT_TAX]',                     '[VR_PAYMENT_TOTAL]', 
            '[TOTAL_RRP]',                          '[GST_PERCENT]',                        '[COMM_PERCENT]', 
            '[IS_BUILDER_PROJECT]',                 '[CUSTOMISATION_OPTIONS]'
        ), 
        array(
            addslashes($api_data['vr_form_system_info']['quote_id']), 
            addslashes(date('Y-m-d H:i:s')), 
            addslashes($api_data['vr_form_system_info']['project_id']), 
            addslashes($api_data['vr_form_queries_info']['vr_project_name']), 
            addslashes($api_data['vr_form_system_info']['sales_rep_id']), 
            addslashes($api_data['vr_form_system_info']['sales_rep_name']), 
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
            addslashes($api_data['vr_form_system_info']['is_builder_project']), 
            addslashes($customisation_options_in_string)
        ), 
        $sql_template_insert_data_followup
    );

    $results = executeDbQuery($sql);
    if ($results['error'] == 'null') {
        $results_save_data['data_followup']['total_success']++;
    } else {
        $results_save_data['data_followup']['total_failure']++;
    }

    if ($results_save_data['data_followup']['total_input'] == $results_save_data['data_followup']['total_success']) {
        $results_save_data['data_followup']['is_success'] = true;
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- save data measurement -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_save_data['data_measurement']['total_input'] = count($api_data['vr_form_queries_info']['vr_length_info']['vr_lengths_meter']);
$results_save_data['data_measurement']['total_success'] = 0;
$results_save_data['data_measurement']['total_failure'] = 0;
$results_save_data['data_measurement']['failure_indexes'] = array();
$results_save_data['data_measurement']['is_success'] = false;

if ($enable_saving['data_measurement'] == true) {
    for ($c1 = 0; $c1 < count($api_data['vr_form_queries_info']['vr_length_info']['vr_lengths_meter']); $c1++) {
        $sql = str_replace(
            array(
                '[PROJECT_ID]',             '[VR_FRAMEWORK_TYPE]',  '[VR_WIDTH_METER]', 
                '[VR_LENGTH_METER]'
            ), 
            array(
                addslashes($api_data['vr_form_system_info']['project_id']), 
                addslashes($api_data['vr_form_queries_info']['vr_framework_type']), 
                addslashes($api_data['vr_form_queries_info']['vr_width_meter']), 
                addslashes($api_data['vr_form_queries_info']['vr_length_info']['vr_lengths_meter'][$c1])
            ), 
            $sql_template_insert_data_measurement
        );

        $results = executeDbQuery($sql);
        if ($results['error'] == 'null') {
            $results_save_data['data_measurement']['total_success']++;
        } else {
            $results_save_data['data_measurement']['total_failure']++;
            $results_save_data['data_measurement']['failure_indexes'][] = $c1;
        }
    }

    if ($results_save_data['data_measurement']['total_input'] == $results_save_data['data_measurement']['total_success']) {
        $results_save_data['data_measurement']['is_success'] = true;
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- save data letters -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_save_data['data_letters']['total_input'] = 1;
$results_save_data['data_letters']['total_success'] = 0;
$results_save_data['data_letters']['total_failure'] = 0;
$results_save_data['data_letters']['failure_indexes'] = array();
$results_save_data['data_letters']['is_success'] = false;

if ($enable_saving['data_letters'] == true) {
    if ($results_save_data['data_quote']['is_success'] == true && 
        $results_save_data['data_followup']['is_success'] == true && 
        $results_save_data['data_measurement']['is_success'] == true) {

        $template_content = str_replace(
            array('[BLANK_SPACE]'), 
            array('&nbsp;'), 
            $api_data['vr_form_report_info']
        );

        $sql = str_replace(
            array(
                '[CLIENT_ID]',  '[TEMPLATE_NAME]',  '{[TEMPLATE_CONTENT]}' 
            ), 
            array(
                addslashes($api_data['vr_form_system_info']['quote_id']), 
                addslashes($api_data['vr_form_system_info']['project_id']), 
                addslashes($template_content)
            ), 
            $sql_template_insert_data_letters
        );

        $results = executeDbQuery($sql);
        if ($results['error'] == 'null') {
            $results_save_data['data_letters']['total_success']++;
        } else {
            $results_save_data['data_letters']['total_failure']++;
        }

        if ($results_save_data['data_letters']['total_input'] == $results_save_data['data_letters']['total_success']) {
            $results_save_data['data_letters']['is_success'] = true;
        }
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- save data contract bom meterial -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_save_data['data_contract_bom_meterial']['total_input'] = 0;
$results_save_data['data_contract_bom_meterial']['total_success'] = 0;
$results_save_data['data_contract_bom_meterial']['total_failure'] = 0;
$results_save_data['data_contract_bom_meterial']['failure_indexes'] = array();
$results_save_data['data_contract_bom_meterial']['is_success'] = false;

$number_of_targeted_items = 0;
if ($enable_saving['data_contract_bom_meterial'] == true) {
    for ($c1 = 0; $c1 < $number_of_items_data_entry; $c1++) {
        if (isset($api_data['process_order_by_vr_section_display_name']) && 
            $api_data['process_order_by_vr_section_display_name'] == $api_data['vr_form_items_data_entry'][$c1]['vr_section_display_name']) {
            $number_of_targeted_items++;

            $sql = str_replace(
                array(
                    '[CONTRACT_ITEM_CF_ID]',    '[VR_SECTION_REF_NAME]', 
                    '[PROJECT_ID]',             '[VR_ITEM_QTY]',        '[LENGTH_METER]', 
                    '[INVENTORY_ID]'
                ), 
                array(
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_record_index']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_section_ref_name']), 
                    addslashes($api_data['vr_form_system_info']['project_id']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_qty']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_length_meter']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_ref_name'])
                ), 
                $sql_template_insert_data_contract_bom_meterial
            );

            $results = executeDbQuery($sql);
            if ($results['error'] == 'null') {
                $results_save_data['data_contract_bom_meterial']['total_success']++;
            } else {
                $results_save_data['data_contract_bom_meterial']['total_failure']++;
                $results_save_data['data_contract_bom_meterial']['failure_indexes'][] = $c1;
            }
        }
    }

    $results_save_data['data_contract_bom_meterial']['total_input'] = $number_of_targeted_items;
    if ($results_save_data['data_contract_bom_meterial']['total_input'] == $results_save_data['data_contract_bom_meterial']['total_success']) {
        $results_save_data['data_contract_bom_meterial']['is_success'] = true;
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- save data contract bom -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_save_data['data_contract_bom']['total_input'] = 0;
$results_save_data['data_contract_bom']['total_success'] = 0;
$results_save_data['data_contract_bom']['total_failure'] = 0;
$results_save_data['data_contract_bom']['failure_indexes'] = array();
$results_save_data['data_contract_bom']['is_success'] = false;

$number_of_targeted_items = 0;
if ($enable_saving['data_contract_bom'] == true) {
    for ($c1 = 0; $c1 < $number_of_items_data_entry; $c1++) {
        if (isset($api_data['process_order_by_vr_section_display_name']) && 
            $api_data['process_order_by_vr_section_display_name'] == $api_data['vr_form_items_data_entry'][$c1]['vr_section_display_name']) {
            $number_of_targeted_items++;

            $sql = str_replace(
                array(
                    '[QUOTE_ID]',                       '[PROJECT_ID]', 
                    '[VR_FRAMEWORK_TYPE]',              '[VR_TYPE_DISPLAY_NAME]',       '[VR_ITEM_DISPLAY_NAME]', 
                    '[VR_ITEM_REF_NAME]',               '[VR_ITEM_COLOUR]',             '[VR_ITEM_FINISH]', 
                    '[VR_ITEM_UOM]',                    '[VR_ITEM_QTY]',                '[VR_ITEM_LENGTH_METER]', 
                    '[VR_ITEM_UNIT_PRICE]', 
                    '[VR_ITEM_RRP]',                    '[CONTRACT_ITEM_CF_ID]',        '[VR_SECTION_REF_NAME]', 
                    '[VR_SUBSECTION_REF_NAME]',         '[SUPPLIER_ID]',                '[IS_REORDER]'
                ), 
                array(
                    addslashes($api_data['vr_form_system_info']['quote_id']), 
                    addslashes($api_data['vr_form_system_info']['project_id']), 
                    addslashes($api_data['vr_form_queries_info']['vr_framework_type']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_type_display_name']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_display_name']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_ref_name']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_colour']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_finish']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_uom']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_qty']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_length_meter']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_unit_price']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_item_rrp']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_record_index']), 
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_section_ref_name']),
                    addslashes($api_data['vr_form_items_data_entry'][$c1]['vr_subsection_ref_name']), 
                    '',
                    0
                ), 
                $sql_template_insert_data_contract_bom
            );

            $results = executeDbQuery($sql);
            if ($results['error'] == 'null') {
                $results_save_data['data_contract_bom']['total_success']++;
            } else {
                $results_save_data['data_contract_bom']['total_failure']++;
                $results_save_data['data_contract_bom']['failure_indexes'][] = $c1;
            }
        }
    }

    $results_save_data['data_contract_bom']['total_input'] = $number_of_targeted_items;
    if ($results_save_data['data_contract_bom']['total_input'] == $results_save_data['data_contract_bom']['total_success']) {
        $results_save_data['data_contract_bom']['is_success'] = true;
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- process save data results -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$total_overall_input = $results_save_data['data_quote']['total_input'] + 
                            $results_save_data['data_followup']['total_input'] + 
                            $results_save_data['data_measurement']['total_input'] + 
                            $results_save_data['data_letters']['total_input'];
$total_overall_success = $results_save_data['data_quote']['total_success'] + 
                            $results_save_data['data_followup']['total_success'] + 
                            $results_save_data['data_measurement']['total_success'] + 
                            $results_save_data['data_letters']['total_success'];
$total_overall_failure = $results_save_data['data_quote']['total_failure'] + 
                            $results_save_data['data_followup']['total_failure'] + 
                            $results_save_data['data_measurement']['total_failure'] + 
                            $results_save_data['data_letters']['total_failure'];

if (isset($api_data['access_mode'])) {
    if ($api_data['access_mode'] == 'contract_bom_save') {
        $total_overall_input = $results_save_data['data_contract_bom_meterial']['total_input'] + 
                                $results_save_data['data_contract_bom']['total_input'];
        $total_overall_success = $results_save_data['data_contract_bom_meterial']['total_success'] + 
                                    $results_save_data['data_contract_bom']['total_success'];
        $total_overall_failure = $results_save_data['data_contract_bom_meterial']['total_failure'] + 
                                    $results_save_data['data_contract_bom']['total_failure'];
    }
}

if ($total_overall_input == $total_overall_success) {
    $api_response['error'] = 'null';
} else {
    $api_response['error'] = '31010';
}

$api_response['message'] = array(
    'total_overall_input' => $total_overall_input, 
    'total_overall_success' => $total_overall_success, 
    'total_overall_failure' => $total_overall_failure, 
    'last_sql' => $sql, 
    'last_results' => $results, 
    'next_project_id' => $next_project_id, 
    'failure_indexes' => array(
        'data_quote' => $results_save_data['data_quote']['failure_indexes'], 
        'data_followup' => $results_save_data['data_followup']['failure_indexes'], 
        'data_measurement' => $results_save_data['data_measurement']['failure_indexes'], 
        'data_letters' => $results_save_data['data_letters']['failure_indexes'], 
        'data_contract_bom_meterial' => $results_save_data['data_contract_bom_meterial']['failure_indexes'], 
        'data_contract_bom' => $results_save_data['data_contract_bom']['failure_indexes'] 
    )
);

$api_response['data'] = array();

// if (! ($enable_saving['data_quote'] == true && $results_save_data['data_quote']['is_success'] == true) && 
      // ($enable_saving['data_followup'] == true && $results_save_data['data_followup']['is_success'] == true) &&  
      // ($enable_saving['data_measurement'] == true && $results_save_data['data_measurement']['is_success'] == true)) {
    // mysql_query("ROLLBACK");
// }
?>