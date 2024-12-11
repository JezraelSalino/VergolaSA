<?php
set_time_limit(3600);
/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- cli command -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
/*
// --- at local site --- //
C:\xampp_3\php\php C:\xampp_3\htdocs\vergola_contract_system_v3_sa\includes\vic\enquiry\sales_summary\agent_summary_daily_sales_info.php data="{\"server_mode\":\"local\", \"vergola_region\":\"sa\", \"record_update_type\":\"flush\"}"
C:\xampp_3\php\php C:\xampp_3\htdocs\vergola_contract_system_v3_sa\includes\vic\enquiry\sales_summary\agent_summary_daily_sales_info.php data="{\"server_mode\":\"local\", \"vergola_region\":\"sa\", \"record_update_type\":\"append\"}"

// --- at preproduction site --- //
C:\xampp\php\php C:\xampp\htdocs\vergola_contract_system_v3\includes\vic\enquiry\sales_summary\agent_summary_daily_sales_info.php data="{\"server_mode\":\"preproduction\", \"vergola_region\":\"sa\", \"record_update_type\":\"flush\"}"
C:\xampp\php\php C:\xampp\htdocs\vergola_contract_system_v3\includes\vic\enquiry\sales_summary\agent_summary_daily_sales_info.php data="{\"server_mode\":\"preproduction\", \"vergola_region\":\"sa\", \"record_update_type\":\"append\"}"

// --- at live site --- //
C:\xampp\php\php C:\xampp\htdocs\vergola_contract_system_v3\includes\vic\enquiry\sales_summary\agent_summary_daily_sales_info.php data="{\"server_mode\":\"live\", \"vergola_region\":\"sa\", \"record_update_type\":\"flush\"}"
C:\xampp\php\php C:\xampp\htdocs\vergola_contract_system_v3\includes\vic\enquiry\sales_summary\agent_summary_daily_sales_info.php data="{\"server_mode\":\"live\", \"vergola_region\":\"sa\", \"record_update_type\":\"append\"}"
*/


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- include files -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
require('functions_general.php');
require('functions_module.php');
require('html_templates.php');
require('sql_templates.php');
require('config_module.php');


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

$log_contents = '';
$agent_process_begin_date_time = date('Y-m-d H:i:s');


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- process summary date list(tblsummarydatelist) -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
echo '===== ===== ===== ===== ===== ===== ===== ===== ===== =====';
echo "\n";
echo "processing: tblsummarydatelist";
echo "\n";
echo '===== ===== ===== ===== ===== ===== ===== ===== ===== =====';
echo "\n";
echo "\n";
$log_contents .=  '===== ===== ===== ===== ===== ===== ===== ===== ===== =====';
$log_contents .=  "\n";
$log_contents .=  "processing: tblsummarydatelist";
$log_contents .=  "\n";
$log_contents .=  '===== ===== ===== ===== ===== ===== ===== ===== ===== =====';
$log_contents .=  "\n";
$log_contents .=  "\n";

// --- prepare table --- //
if (!isDbTableExists($db_connection, 'tblsummarydatelist')) {
    if ($config['db']['enable_create_table'] == true) {
        $sql = $sql_template_create_table_summary_date_list;
        $results = getTargetSalesSummaryTableInfo($config, 'tblsummarydatelist', $sql);
        $sql = $results['sql'];
        executeDbQuery($db_connection, $sql);
        echo 'create table...' . "\n\n";
        $log_contents .=  'create table...' . "\n\n";

        sleep($config['interval']['db_transaction']['normal']);
    } else {
        echo 'DB table not found and no permission to create table. Agent aborted.' . "\n\n";
        $log_contents .=  'DB table not found and no permission to create table. Agent aborted.' . "\n\n";
    }
}

// --- get fill date info --- //
$results = getTargetSalesSummaryTableInfo($config, 'tblsummarydatelist', '');
$target_table_name = $results['target_table_name'];
$fill_date_info_summary_date_list = getFillDateInfoBySalesSummaryTable($db_connection, $config, $target_table_name, 'date', false);
echo 'fill_date_info_summary_date_list:';
echo "\n";
print_r($fill_date_info_summary_date_list);
echo "\n";
echo "\n";
$log_contents .=  'fill_date_info_summary_date_list:' . "\n" . print_r($fill_date_info_summary_date_list, true) . "\n\n";

// --- clear records --- //
$target_date_begin = $fill_date_info_summary_date_list['fill_date_from'];
$target_date_end = $fill_date_info_summary_date_list['fill_date_to'];

$sql = str_replace(
    array('[DATE_BEGIN]', '[DATE_END]'), 
    array($target_date_begin, $target_date_end), 
    $sql_template_delete_table_summary_date_list
);
$results = getTargetSalesSummaryTableInfo($config, 'tblsummarydatelist', $sql);
$sql = $results['sql'];
executeDbQuery($db_connection, $sql);
$total_rows_affected = mysqli_affected_rows($db_connection);
echo 'clear records > total_rows_affected:' . "\n" . print_r($total_rows_affected, true) . "\n\n";
$log_contents .=  'clear records > total_rows_affected:' . "\n" . print_r($total_rows_affected, true) . "\n\n";

sleep($config['interval']['db_transaction']['normal']);

// --- fill records --- //
if ($fill_date_info_summary_date_list['fill_date_total_days'] >= 0) {
    echo 'fill records...' . "\n\n";
    $log_contents .=  'fill records...' . "\n\n";
    for ($i = 0; $i <= $fill_date_info_summary_date_list['fill_date_total_days']; $i++) { 
        $this_fill_date = addDateTime($fill_date_info_summary_date_list['fill_date_from'], 'Y-m-d', 'day', $i);

        $sql = str_replace(
            array('[THIS_FILL_DATE]'), 
            array($this_fill_date), 
            $sql_template_insert_table_summary_date_list
        );
        $results = getTargetSalesSummaryTableInfo($config, 'tblsummarydatelist', $sql);
        $sql = $results['sql'];
        $query_results = executeDbQuery($db_connection, $sql);

        sleep($config['interval']['db_transaction']['very_fast']);
    }
    echo "\n";
    echo "\n";
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- process summary sales quotes(tblsummarydailysalesquote)  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
echo '===== ===== ===== ===== ===== ===== ===== ===== ===== =====';
echo "\n";
echo "processing: tblsummarydailysalesquote";
echo "\n";
echo '===== ===== ===== ===== ===== ===== ===== ===== ===== =====';
echo "\n";
echo "\n";
$log_contents .=  '===== ===== ===== ===== ===== ===== ===== ===== ===== =====';
$log_contents .=  "\n";
$log_contents .=  "processing: tblsummarydailysalesquote";
$log_contents .=  "\n";
$log_contents .=  '===== ===== ===== ===== ===== ===== ===== ===== ===== =====';
$log_contents .=  "\n";
$log_contents .=  "\n";

// --- prepare table --- //
if (!isDbTableExists($db_connection, 'tblsummarydailysalesquote')) {
    if ($config['db']['enable_create_table'] == true) {
        $sql = $sql_template_create_table_summary_daily_sales_quote;
        $results = getTargetSalesSummaryTableInfo($config, 'tblsummarydailysalesquote', $sql);
        $sql = $results['sql'];
        executeDbQuery($db_connection, $sql);
        echo 'create table...' . "\n\n";
        $log_contents .=  'create table...' . "\n\n";

        sleep($config['interval']['db_transaction']['normal']);
    } else {
        echo 'DB table not found and no permission to create table. Agent aborted.' . "\n\n";
        $log_contents .=  'DB table not found and no permission to create table. Agent aborted.' . "\n\n";
    }
}

// --- get fill date info --- //
$results = getTargetSalesSummaryTableInfo($config, 'tblsummarydailysalesquote', '');
$target_table_name = $results['target_table_name'];
$fill_date_info_summary_daily_sales_quote = getFillDateInfoBySalesSummaryTable($db_connection, $config, $target_table_name, 'quote_date', true);
echo 'fill_date_info_summary_daily_sales_quote:';
echo "\n";
print_r($fill_date_info_summary_daily_sales_quote);
echo "\n";
echo "\n";
$log_contents .=  'fill_date_info_summary_daily_sales_quote:' . "\n" . print_r($fill_date_info_summary_daily_sales_quote, true) . "\n\n";

// --- clear records --- //
$target_date_begin = $fill_date_info_summary_daily_sales_quote['fill_date_from'];
$target_date_end = $fill_date_info_summary_daily_sales_quote['fill_date_to'];

$sql = str_replace(
    array('[QUOTE_DATE_BEGIN]', '[QUOTE_DATE_END]'), 
    array($target_date_begin, $target_date_end), 
    $sql_template_delete_table_summary_daily_sales_quote
);
$results = getTargetSalesSummaryTableInfo($config, 'tblsummarydailysalesquote', $sql);
$sql = $results['sql'];
executeDbQuery($db_connection, $sql);
$total_rows_affected = mysqli_affected_rows($db_connection);
echo 'clear records > total_rows_affected:' . "\n" . print_r($total_rows_affected, true) . "\n\n";
$log_contents .=  'clear records > total_rows_affected:' . "\n" . print_r($total_rows_affected, true) . "\n\n";

sleep($config['interval']['db_transaction']['normal']);

// --- fill records --- //
$target_date_time_begin = $fill_date_info_summary_daily_sales_quote['fill_date_from'] . ' 00:00:00';
$target_date_time_end = $fill_date_info_summary_daily_sales_quote['fill_date_to'] . ' 23:59:59';

$sql = str_replace(
    array('[QUOTE_DATE_TIME_BEGIN]', '[QUOTE_DATE_TIME_END]'), 
    array($target_date_time_begin, $target_date_time_end), 
    $sql_template_insert_table_summary_daily_sales_quote
);
$results = getTargetSalesSummaryTableInfo($config, 'tblsummarydailysalesquote', $sql);
$sql = $results['sql'];
executeDbQuery($db_connection, $sql);
$total_rows_affected = mysqli_affected_rows($db_connection);
echo 'fill records > total_rows_affected:' . "\n" . print_r($total_rows_affected, true) . "\n\n";
$log_contents .=  'fill records > total_rows_affected:' . "\n" . print_r($total_rows_affected, true) . "\n\n";

sleep($config['interval']['db_transaction']['normal']);


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- summary sales general(tblsummarydailysalesgeneral)  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
echo '===== ===== ===== ===== ===== ===== ===== ===== ===== =====';
echo "\n";
echo "processing: tblsummarydailysalesgeneral";
echo "\n";
echo '===== ===== ===== ===== ===== ===== ===== ===== ===== =====';
echo "\n";
echo "\n";
$log_contents .=  '===== ===== ===== ===== ===== ===== ===== ===== ===== =====';
$log_contents .=  "\n";
$log_contents .=  "processing: tblsummarydailysalesgeneral";
$log_contents .=  "\n";
$log_contents .=  '===== ===== ===== ===== ===== ===== ===== ===== ===== =====';
$log_contents .=  "\n";
$log_contents .=  "\n";

// --- prepare table --- //
if (!isDbTableExists($db_connection, 'tblsummarydailysalesgeneral')) {
    if ($config['db']['enable_create_table'] == true) {
        $sql = $sql_template_create_table_summary_daily_sales_general;
        $results = getTargetSalesSummaryTableInfo($config, 'tblsummarydailysalesgeneral', $sql);
        $sql = $results['sql'];
        executeDbQuery($db_connection, $sql);
        echo 'create table...' . "\n\n";
        $log_contents .=  'create table...' . "\n\n";

        sleep($config['interval']['db_transaction']['normal']);
    } else {
        echo 'DB table not found and no permission to create table. Agent aborted.' . "\n\n";
        $log_contents .=  'DB table not found and no permission to create table. Agent aborted.' . "\n\n";
    }
}

// --- get fill date info --- //
$results = getTargetSalesSummaryTableInfo($config, 'tblsummarydailysalesgeneral', '');
$target_table_name = $results['target_table_name'];
$fill_date_info_summary_daily_sales_general = getFillDateInfoBySalesSummaryTable($db_connection, $config, $target_table_name, 'summary_date', true);
echo 'fill_date_info_summary_daily_sales_general:';
echo "\n";
print_r($fill_date_info_summary_daily_sales_general);
echo "\n";
echo "\n";
$log_contents .=  'fill_date_info_summary_daily_sales_general:' . "\n" . print_r($fill_date_info_summary_daily_sales_general, true) . "\n\n";

// --- clear records --- //
$target_date_begin = $fill_date_info_summary_daily_sales_general['fill_date_from'];
$target_date_end = $fill_date_info_summary_daily_sales_general['fill_date_to'];

$sql = str_replace(
    array('[SUMMARY_DATE_BEGIN]', '[SUMMARY_DATE_END]'), 
    array($target_date_begin, $target_date_end), 
    $sql_template_delete_table_summary_daily_sales_general
);
$results = getTargetSalesSummaryTableInfo($config, 'tblsummarydailysalesgeneral', $sql);
$sql = $results['sql'];
executeDbQuery($db_connection, $sql);
$total_rows_affected = mysqli_affected_rows($db_connection);
echo 'clear records > total_rows_affected:' . "\n" . print_r($total_rows_affected, true) . "\n\n";
$log_contents .=  'clear records > total_rows_affected:' . "\n" . print_r($total_rows_affected, true) . "\n\n";

sleep($config['interval']['db_transaction']['normal']);

// --- fill records --- //
$target_date_begin = $fill_date_info_summary_daily_sales_general['fill_date_from'];
$target_date_end = $fill_date_info_summary_daily_sales_general['fill_date_to'];

$sql = str_replace(
    array('[SUMMARY_DATE_BEGIN]', '[SUMMARY_DATE_END]'), 
    array($target_date_begin, $target_date_end), 
    $sql_template_insert_table_summary_daily_sales_general_01
);
executeDbQuery($db_connection, $sql);

$sql = $sql_template_insert_table_summary_daily_sales_general_02;
$results = getTargetSalesSummaryTableInfo($config, 'tblsummarydailysalesgeneral', $sql);
$sql = $results['sql'];
executeDbQuery($db_connection, $sql);
$total_rows_affected = mysqli_affected_rows($db_connection);
echo 'fill records > total_rows_affected:' . "\n" . print_r($total_rows_affected, true) . "\n\n";
$log_contents .=  'fill records > total_rows_affected:' . "\n" . print_r($total_rows_affected, true) . "\n\n";

sleep($config['interval']['db_transaction']['normal']);


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- flush and restore summary daily sales info -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
if (isset($config['input_data']['record_update_type']) && $config['input_data']['record_update_type'] == 'flush') {
    // --- flush records --- //
    $sql = $sql_template_flush_table_summary_date_list;
    executeDbQuery($db_connection, $sql);
    $total_rows_affected = mysqli_affected_rows($db_connection);
    echo 'flush records > tblsummarydatelist > total_rows_affected:' . "\n" . print_r($total_rows_affected, true) . "\n\n";
    $log_contents .=  'flush records > tblsummarydatelist > total_rows_affected:' . "\n" . print_r($total_rows_affected, true) . "\n\n";

    $sql = $sql_template_flush_table_summary_daily_sales_quote;
    executeDbQuery($db_connection, $sql);
    $total_rows_affected = mysqli_affected_rows($db_connection);
    echo 'flush records > tblsummarydailysalesquote > total_rows_affected:' . "\n" . print_r($total_rows_affected, true) . "\n\n";
    $log_contents .=  'flush records > tblsummarydailysalesquote > total_rows_affected:' . "\n" . print_r($total_rows_affected, true) . "\n\n";

    $sql = $sql_template_flush_table_summary_daily_sales_general;
    executeDbQuery($db_connection, $sql);
    $total_rows_affected = mysqli_affected_rows($db_connection);
    echo 'flush records > tblsummarydailysalesgeneral > total_rows_affected:' . "\n" . print_r($total_rows_affected, true) . "\n\n";
    $log_contents .=  'flush records > tblsummarydailysalesgeneral > total_rows_affected:' . "\n" . print_r($total_rows_affected, true) . "\n\n";

    sleep($config['interval']['db_transaction']['normal']);

    // --- restore records --- //
    $sql = $sql_template_restore_table_summary_date_list;
    executeDbQuery($db_connection, $sql);
    $total_rows_affected = mysqli_affected_rows($db_connection);
    echo 'restore records > tblsummarydatelist > total_rows_affected:' . "\n" . print_r($total_rows_affected, true) . "\n\n";
    $log_contents .=  'restore records > tblsummarydatelist > total_rows_affected:' . "\n" . print_r($total_rows_affected, true) . "\n\n";

    $sql = $sql_template_restore_table_summary_daily_sales_quote;
    executeDbQuery($db_connection, $sql);
    $total_rows_affected = mysqli_affected_rows($db_connection);
    echo 'restore records > tblsummarydailysalesquote > total_rows_affected:' . "\n" . print_r($total_rows_affected, true) . "\n\n";
    $log_contents .=  'restore records > tblsummarydailysalesquote > total_rows_affected:' . "\n" . print_r($total_rows_affected, true) . "\n\n";

    $sql = $sql_template_restore_table_summary_daily_sales_general;
    executeDbQuery($db_connection, $sql);
    $total_rows_affected = mysqli_affected_rows($db_connection);
    echo 'restore records > tblsummarydailysalesgeneral > total_rows_affected:' . "\n" . print_r($total_rows_affected, true) . "\n\n";
    $log_contents .=  'restore records > tblsummarydailysalesgeneral > total_rows_affected:' . "\n" . print_r($total_rows_affected, true) . "\n\n";

    sleep($config['interval']['db_transaction']['normal']);
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- release resources -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$db_connection->close();


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- processing info -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
echo '===== ===== ===== ===== ===== ===== ===== ===== ===== =====';
echo "\n";
echo "processing info";
echo "\n";
echo '===== ===== ===== ===== ===== ===== ===== ===== ===== =====';
echo "\n";
echo "\n";
$log_contents .=  '===== ===== ===== ===== ===== ===== ===== ===== ===== =====';
$log_contents .=  "\n";
$log_contents .=  "processing info";
$log_contents .=  "\n";
$log_contents .=  '===== ===== ===== ===== ===== ===== ===== ===== ===== =====';
$log_contents .=  "\n";
$log_contents .=  "\n";

$agent_process_end_date_time = date('Y-m-d H:i:s');

$results = getDatesDifference($agent_process_begin_date_time, $agent_process_end_date_time);
$agent_process_total_time = 
    $results['in_days'] . 'd ' . 
    $results['in_hours'] . 'h ' . 
    $results['in_minutes'] . 'm ' . 
    $results['in_seconds'] . 's ';

echo 'agent_process_begin_date_time:';
echo "\n";
print_r($agent_process_begin_date_time);
echo "\n";
echo "\n";
echo 'agent_process_end_date_time:';
echo "\n";
print_r($agent_process_end_date_time);
echo "\n";
echo "\n";
echo 'agent_process_total_time:';
echo "\n";
print_r($agent_process_total_time);
echo "\n";
echo "\n";
$log_contents .=  'agent_process_begin_date_time:' . "\n" . print_r($agent_process_begin_date_time, true) . "\n\n";
$log_contents .=  'agent_process_end_date_time:' . "\n" . print_r($agent_process_end_date_time, true) . "\n\n";
$log_contents .=  'agent_process_total_time:' . "\n" . print_r($agent_process_total_time, true) . "\n\n";

$log_file_name = $config['path']['log_file_name']['agent_summary_daily_sales_info'];
if (isset($config['input_data']['record_update_type']) && $config['input_data']['record_update_type'] == 'flush') {
    $log_file_name = $config['path']['log_file_name']['agent_summary_daily_sales_info_temp'];
}
logContents($config['path']['log_folder'], $log_file_name, $log_contents);
?>