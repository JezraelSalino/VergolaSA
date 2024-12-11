<?php
set_time_limit(3600);


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- include files -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
include('functions_general.php');
include('functions_module.php');
// include('html_templates.php');
include('sql_templates.php');
// require('config_module.php');


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- initialise variables -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$db_connection = new mysqli(
    $config['db']['host_name'], 
    $config['db']['user_name'], 
    $config['db']['password'], 
    $config['db']['db_name'] 
);
if ($db_connection->connect_error) {
    die('error: ' . $db_connection->connect_error);
}


if (isset($_GET['data_migration']) && $_GET['data_migration'] == 'y') {
    include('data_migration.php');
}


$log_contents = '';
$program_begin_date_time = date('Y-m-d H:i:s');


if (isset($_REQUEST['api_mode'])) {
    /*
    ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
    ----- process api access -----
    ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
    */
    $api_response = array();
    $api_response['error'] = array();
    $api_response['message'] = array();
    $api_response['data'] = array();

    if (isset($_REQUEST['api_data'])) {
        $api_data_string = $_REQUEST['api_data'];
        $results = getApiData($api_data_string);
        $api_data_string = $results['api_data_string'];
        $api_data = $results['api_data'];

        if (json_decode($api_data_string, true) == true) {
            if (isset($api_data['vr_form_operation'])) {
                $valid_operations = array('save', 'retrieve', 'update', 'delete');
                if (in_array($api_data['vr_form_operation'], $valid_operations)) {
                    switch ($api_data['vr_form_operation']) {
                        case 'save':
                            include('script_module_save_data.php');
                            break;
                        case 'retrieve':
                            include('script_module_retrieve_data.php');
                            break;
                        case 'update':
                            include('script_module_update_data.php');
                            break;
                        case 'delete':
                            include('script_module_delete_data.php');
                            break;
                    }
                } else {
                    $api_response['error'][] = '30040';
                    $api_response['message'][] = 'Invalid operation';
                    $api_response['data'][] = array();
                }
            } else {
                $api_response['error'][] = '30030';
                $api_response['message'][] = 'Missing operation';
                $api_response['data'][] = array();
            }
        } else {
            $api_response['error'][] = '30020';
            $api_response['message'][] = 'Invalid data format';
            $api_response['data'][] = array();
        }
    } else {
        $api_response['error'][] = '30010';
        $api_response['message'][] = 'Empty data';
        $api_response['data'][] = array();
    }

    echo json_encode($api_response);
    exit;
} else {
    /*
    ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
    ----- process normal access -----
    ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
    */


    /*
    ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
    ----- initialise variables -----
    ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
    */
    $app_response = array();
    $app_response['error'] = array();
    $app_response['message'] = array();
    $app_response['data'] = array();
    $vr_form_system_info = array();


    $vr_form_system_info['access_mode'] = 'quote_add';
    if (isset($_REQUEST['page_name'])) {
        switch ($_REQUEST['page_name']) {
            case 'quote_edit':
                $vr_form_system_info['access_mode'] = 'quote_edit';
                break;
            case 'quote_details':
                $vr_form_system_info['access_mode'] = 'quote_view';
                break;
            case 'contract_bom':
                $vr_form_system_info['access_mode'] = 'contract_bom_edit';
                break;
        }
    }


    if (isset($_REQUEST['project_id'])) {
        $vr_form_system_info['project_id'] = mysql_real_escape_string($_REQUEST['project_id']);
        $vr_form_system_info['quote_id'] = '';

        $sql = str_replace(
            array('[PROJECT_ID]'), 
            array($vr_form_system_info['project_id']), 
            $sql_template_retrieve_data_followup
        );
        $results = executeDbQuery($sql);
        if ($results['error'] == 'null') {
            $r1 = mysql_fetch_array($results['data']);
            $vr_form_system_info['quote_id'] = $r1['quoteid'];
            $vr_form_system_info['quote_date'] = $r1['quotedate'];
            $vr_form_system_info['project_id'] = $r1['projectid'];
        } else {
            $app_response['error'][] = $results['error'];
            $app_response['message'][] = $results['message'];
        }
    } else {
        $vr_form_system_info['project_id'] = '';
        $vr_form_system_info['quote_id'] = mysql_real_escape_string($_REQUEST['quoteid']);
    }


    $sql = str_replace(
        array('[QUOTE_ID]'), 
        array($vr_form_system_info['quote_id']), 
        $sql_template_retrieve_data_clientpersonal
    );
    $results = executeDbQuery($sql);
    if ($results['error'] == 'null') {
        $r1 = mysql_fetch_array($results['data']);
        $vr_form_system_info['sales_rep_id'] = $r1['repident'];
        $vr_form_system_info['sales_rep_name'] = $r1['repname'];
        $vr_form_system_info['lodged_date'] = $r1['datelodged'];
        $vr_form_system_info['is_builder_project'] = 0; //$r1['is_builder'];
        $vr_form_system_info['client_name'] = $r1['client_firstname'] . ' ' . $r1['client_lastname'];
    } else {
        $app_response['error'][] = $results['error'];
        $app_response['message'][] = $results['message'];
    }


    $sql = str_replace(
        array(), 
        array(), 
        $sql_template_retrieve_data_systable
    );
    $results = executeDbQuery($sql);
    if ($results['error'] == 'null') {
        $r1 = mysql_fetch_array($results['data']);
        $vr_form_system_info['payment_tax_percentage'] = $r1['gst'] / 100;
        $vr_form_system_info['payment_vergola_commission_percentage'] = $r1['commision'] / 100;
        $vr_form_system_info['commission_sales_commission_percentage'] = $r1['sales_comm'] / 100;
        $vr_form_system_info['commission_installer_payment_percentage'] = $r1['install_comm'] / 100;
    } else {
        $app_response['error'][] = $results['error'];
        $app_response['message'][] = $results['message'];
    }


    $vr_item_default_dimensions_list = array();
    $sql = str_replace(
        array(), 
        array(), 
        $sql_template_retrieve_data_contract_items_default_deminsions
    );
    $results = executeDbQuery($sql);
    if ($results['error'] == 'null') {
        while ($r1 = mysql_fetch_array($results['data'])) {
                // 'item_dimension_record_index' => $r1['id'], 
            $vr_item_default_dimensions_list[$r1['inventoryid']] = array(
                'item_dimension_record_index' => '', 
                'item_dimension_length_meter' => intval($r1['length']), 
                'item_dimension_a_mm' => $r1['dimension_a'], 
                'item_dimension_b_mm' => $r1['dimension_b'], 
                'item_dimension_c_mm' => $r1['dimension_c'], 
                'item_dimension_d_mm' => $r1['dimension_d'], 
                'item_dimension_e_mm' => $r1['dimension_e'], 
                'item_dimension_f_mm' => $r1['dimension_f'], 
                'item_dimension_g_mm' => $r1['dimension_g'], 
                'item_dimension_h_mm' => $r1['dimension_h'], 
                'item_dimension_p_mm' => $r1['dimension_p'], 
                'item_dimension_girth_side_a_mm' => $r1['girth_side_a'], 
                'item_dimension_girth_side_b_mm' => $r1['girth_side_b']
            );
        }
    } else {
        $app_response['error'][] = $results['error'];
        $app_response['message'][] = $results['message'];
    }
    $vr_item_default_dimensions_list = json_encode($vr_item_default_dimensions_list);


    $vr_form_system_info['payment_deposit_calculation_method'] = 'fixed_amount'; /* percentage, range, fixed_amount */
    $vr_form_system_info['payment_deposit_percentage'] = 0.1;
    $vr_form_system_info['payment_deposit_minimum'] = 0;
    $vr_form_system_info['payment_deposit_maximum'] = 2000;
    $vr_form_system_info['payment_deposit_fixed_amount'] = 2000;

    $vr_form_system_info['payment_progress_payment_percentage'] = 0.65;
    $vr_form_system_info['commission_pay1_percentage'] = 0.4;
    $vr_form_system_info['commission_pay2_percentage'] = 0.3;
    $vr_form_system_info['commission_final_percentage'] = 0.3;
    $vr_form_system_info['commission_final_percentage'] = 0.3;

    $vr_form_url_info['base'] = JURI::base();
    $vr_form_url_info['unique_code'] = date('YmdHisu');
    switch ($vr_form_system_info['access_mode']) {
        case 'quote_add':
        case 'quote_edit':
            $vr_form_url_info['previous'] = JURI::base() . 'client-listing-vic/client-folder-vic?cid='. $vr_form_system_info['quote_id'];
            break;
        case 'quote_view':
        case 'contract_bom_edit':
            $vr_form_url_info['previous'] = JURI::base() . 'contract-listing-vic/contract-folder-vic?quoteid=' . $vr_form_system_info['quote_id'] . '&projectid=' . $vr_form_system_info['project_id'];
            break;
    }

    $vr_form_url_info['save_quote'] = JURI::base() . 'add-quote-vic?page_name=quote_edit';
    $vr_form_url_info['contract_details'] = JURI::base() . 'contract-listing-vic/contract-folder-vic/contract-folder-vic?quoteid=' . $vr_form_system_info['quote_id'] . '&projectid=' . $vr_form_system_info['project_id'];
    $vr_form_url_info['quote_details'] = JURI::base() . 'view-quote-vic?ref=back&ref_page=contracts&page_name=quote_details&quoteid=' . $vr_form_system_info['quote_id'] . '&projectid=' . $vr_form_system_info['project_id'];
    $vr_form_url_info['bom'] = JURI::base() . 'contract-listing-vic/contract-folder-vic/contract-bom-vic?quoteid=' . $vr_form_system_info['quote_id'] . '&projectid=' . $vr_form_system_info['project_id'];
    $vr_form_url_info['po'] = JURI::base() . 'contract-listing-vic/contract-folder-vic/contract-po-vic?page_name=po&quoteid=' . $vr_form_system_info['quote_id'] . '&projectid=' . $vr_form_system_info['project_id'];
    $vr_form_url_info['po_summary'] = JURI::base() . 'contract-listing-vic/contract-folder-vic/contract-po-vic?&page_name=po&view=summary&quoteid=' . $vr_form_system_info['quote_id'] . '&projectid=' . $vr_form_system_info['project_id'];
    $vr_form_url_info['check_list'] = JURI::base() . 'contract-listing-vic/contract-folder-vic/contract-folder-vic?tab=checklist&quoteid=' . $vr_form_system_info['quote_id'] . '&projectid=' . $vr_form_system_info['project_id'];
    $vr_form_url_info['download_pdf'] = JURI::base() . 'index.php?option=com_chronoforms&tmpl=component&chronoform=Download-PDF&titleID=' . $vr_form_system_info['project_id'];

    $vr_form_system_info_in_json = json_encode($vr_form_system_info);
    $vr_form_url_info_in_json = json_encode($vr_form_url_info);


    /*
    ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
    ----- html form -----
    ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
    */
    include('form_items_data_entry.php');
}
?>