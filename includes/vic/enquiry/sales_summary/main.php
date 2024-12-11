<?php
/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- include files -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
include('functions_general.php');
include('functions_module.php');
include('html_templates.php');
include('sql_templates.php');
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

$current_year = date('Y');
$current_month = date('m');
$financial_year_begin_month = '07';
$financial_year_end_month = '06';
$financial_year_begin_date_this_year = date('Y') . '-' . $financial_year_begin_month . '-01';
$financial_year_end_date_this_year = (date('Y') + 1) . '-' . $financial_year_end_month . '-30';
$financial_year_begin_date_last_year = (date('Y') - 1) . '-' . $financial_year_begin_month . '-01';
$financial_year_end_date_last_year = date('Y') . '-' . $financial_year_end_month . '-30';
if ($current_month < intval($financial_year_begin_month)) {
	$financial_year_begin_date_this_year = (date('Y') - 1) . '-' . $financial_year_begin_month . '-01';
	$financial_year_end_date_this_year = date('Y') . '-' . $financial_year_end_month . '-30';
	$financial_year_begin_date_last_year = (date('Y') - 2) . '-' . $financial_year_begin_month . '-01';
	$financial_year_end_date_last_year = (date('Y') - 1) . '-' . $financial_year_end_month . '-' . date('t');
}
$sales_summary_info_this_year = initialiseArraySalesSummaryInfo($financial_year_begin_date_this_year);
$sales_summary_info_last_year = initialiseArraySalesSummaryInfo($financial_year_begin_date_last_year);


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- retrieve records -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
// ----- this year -----//
$sql = str_replace(
	array('[TARGET_DATE_BEGIN]', '[TARGET_DATE_END]'), 
	array($financial_year_begin_date_this_year, $financial_year_end_date_this_year), 
	$sql_template_get_sales_summary_01
);
$query_results = executeDbQuery($db_connection, $sql);
$adhoc_consultant_filter = 'AND ' . rtrim(trim($consultant_filter), 'AND');
$sql = str_replace(
	array('[ADDITIONAL_CONDITION]'), 
	array($adhoc_consultant_filter), 
	$sql_template_get_sales_summary_02
);
$extracted_sales_summary_data_this_year = executeDbQuery($db_connection, $sql);
$sales_summary_info_this_year = populateArraySalesSummaryInfo($sales_summary_info_this_year, $extracted_sales_summary_data_this_year);

// ----- last year -----//
$sql = str_replace(
	array('[TARGET_DATE_BEGIN]', '[TARGET_DATE_END]'), 
	array($financial_year_begin_date_last_year, $financial_year_end_date_last_year), 
	$sql_template_get_sales_summary_01
);
$query_results = executeDbQuery($db_connection, $sql);
$adhoc_consultant_filter = 'AND ' . rtrim(trim($consultant_filter), 'AND');
$sql = str_replace(
	array('[ADDITIONAL_CONDITION]'), 
	array($adhoc_consultant_filter), 
	$sql_template_get_sales_summary_02
);
$extracted_sales_summary_data_last_year = executeDbQuery($db_connection, $sql);
$sales_summary_info_last_year = populateArraySalesSummaryInfo($sales_summary_info_last_year, $extracted_sales_summary_data_last_year);


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- populate variables -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
// ----- this year -----//
$graph_data_sales_summary_target_sales_amount_this_year = array();
$graph_data_sales_summary_sales_amount_this_year = array();
$graph_data_sales_summary_enquiries_this_year = array();
$graph_data_sales_summary_quotes_this_year = array();
$graph_data_sales_summary_contracts_this_year = array();
foreach ($sales_summary_info_this_year as $key1 => $value1) {
	$graph_data_sales_summary_target_sales_amount_this_year[] = $value1['target_sales_amount'];
	$graph_data_sales_summary_sales_amount_this_year[] = $value1['sales_amount'];
	$graph_data_sales_summary_enquiries_this_year[] = $value1['enquiries'];
	$graph_data_sales_summary_quotes_this_year[] = $value1['quotes'];
	$graph_data_sales_summary_contracts_this_year[] = $value1['contracts'];
}

// ----- last year -----//
$graph_data_sales_summary_target_sales_amount_last_year = array();
$graph_data_sales_summary_sales_amount_last_year = array();
$graph_data_sales_summary_enquiries_last_year = array();
$graph_data_sales_summary_quotes_last_year = array();
$graph_data_sales_summary_contracts_last_year = array();
foreach ($sales_summary_info_last_year as $key1 => $value1) {
	$graph_data_sales_summary_target_sales_amount_last_year[] = $value1['target_sales_amount'];
	$graph_data_sales_summary_sales_amount_last_year[] = $value1['sales_amount'];
	$graph_data_sales_summary_enquiries_last_year[] = $value1['enquiries'];
	$graph_data_sales_summary_quotes_last_year[] = $value1['quotes'];
	$graph_data_sales_summary_contracts_last_year[] = $value1['contracts'];
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- assign graph variables -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
// ----- sales target -----//
// note: sales target graph currently done using variable $sales_amount, $sales_target
// note: applied new variables at graph initialise section
// $sales_amount = $graph_data_sales_summary_sales_amount_this_year;
// $sales_target = $graph_data_sales_summary_target_sales_amount_this_year;

// ----- sales activity -----//
// note: sales activity graph currently done using variable $enquiry_qty_list, $enquiry_qty_list_prevyr, $quote_qty_list, $quote_qty_list_prevyr, $contract_qty_list, $contract_qty_list_prevyr
// note: applied new variables at graph initialise section
// $enquiry_qty_list = $graph_data_sales_summary_enquiries_this_year;
// $enquiry_qty_list_prevyr = $graph_data_sales_summary_enquiries_last_year;
// $quote_qty_list = $graph_data_sales_summary_quotes_this_year;
// $quote_qty_list_prevyr = $graph_data_sales_summary_quotes_last_year;
// $contract_qty_list = $graph_data_sales_summary_contracts_this_year;
// $contract_qty_list_prevyr = $graph_data_sales_summary_contracts_last_year;

// ----- sales summary -----//
// note: sales summary graph currently done using variable $sales_amount, $sales_amount_last_yr
// note: applied new variables at graph initialise section
// $sales_amount = $graph_data_sales_summary_sales_amount_this_year;
// $sales_amount_last_yr = $graph_data_sales_summary_sales_amount_last_year;


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- generate html tables -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
// ----- sales target -----//
// note: sales target table currently done using variable $sales_table
$html_template_data_row_sales_target = extractInnerStringFromText(
	'<!-- html_template_data_row_begin -->', 
	'<!-- html_template_data_row_end -->', 
	$html_template_table_sales_target 
);
$html_data_rows_sales_target = '';
$grand_total_target_sales_amount = '';
$grand_total_sales_amount = '';
foreach ($sales_summary_info_this_year as $key1 => $value1) {
	$search_tag_html_template_data_row_sales_target = array(
		'[SALES_MONTH_NAME]', 
		'[TARGET_SALES_AMOUNT]', 
		'[SALES_AMOUNT]', 
		'[SALES_PERFORMANCE_MONTHLY_DIFF]', 
		'[SALES_PERFORMANCE_YTD_DIFF]' 
	);
	$replace_value_html_template_data_row_sales_target = array(
		$value1['summary_month_name'], 
		'$' . number_format($value1['target_sales_amount'], 2), 
		'$' . number_format($value1['sales_amount'], 2), 
		'$' . number_format($value1['sales_performance_monthly_diff'], 2), 
		'$' . number_format($value1['sales_performance_ytd_diff'], 2) 
	);
	$html_data_rows_sales_target .= str_replace(
		$search_tag_html_template_data_row_sales_target, 
		$replace_value_html_template_data_row_sales_target, 
		$html_template_data_row_sales_target
	);
	$grand_total_target_sales_amount = '$' . number_format($value1['grand_total_target_sales_amount'], 2);
	$grand_total_sales_amount = '$' . number_format($value1['grand_total_sales_amount'], 2);
}

$html_table_sales_target = extractOuterStringFromText(
	'<!-- html_template_data_row_begin -->', 
	'header', 
	$html_template_table_sales_target 
);
$html_table_sales_target .= extractOuterStringFromText(
	'<!-- html_template_data_row_end -->', 
	'footer', 
	$html_template_table_sales_target 
);
$search_tag_html_table_sales_target = array(
	'<!-- html_template_data_row_section -->', 
	'[GRAND_TOTAL_TARGET_SALES_AMOUNT]', 
	'[GRAND_TOTAL_SALES_AMOUNT]' 
);
$replace_value_html_table_sales_target = array(
	$html_data_rows_sales_target, 
	$grand_total_target_sales_amount, 
	$grand_total_sales_amount 
);
$html_table_sales_target = str_replace(
	$search_tag_html_table_sales_target, 
	$replace_value_html_table_sales_target, 
	$html_table_sales_target 
);


// ----- sales activity -----//
// ----- sales activity: last year -----//
// note: sales activity table currently done using variable $kpi_table_last_yr, $kpi_table_this_yr
$html_template_data_row_sales_activity = extractInnerStringFromText(
    '<!-- html_template_data_row_begin -->', 
    '<!-- html_template_data_row_end -->', 
    $html_template_table_sales_activity 
);
$html_data_rows_sales_activity = '';
$grand_total_enquiries = '';
$grand_total_quotes = '';
$grand_total_contracts = '';
$grand_total_enquiry_to_quote = '';
$grand_total_quote_to_contract = '';
$grand_total_enquiry_to_contract = '';
foreach ($sales_summary_info_last_year as $key1 => $value1) {
    $search_tag_html_template_data_row_sales_activity = array(
        '[SALES_MONTH_NAME]', 
        '[ENQUIRIES]', 
        '[QUOTES]', 
        '[CONTRACTS]', 
        '[ENQUIRY_TO_QUOTE]', 
        '[QUOTE_TO_CONTRACT]', 
        '[ENQUIRY_TO_CONTRACT]' 
    );
    $replace_value_html_template_data_row_sales_activity = array(
        $value1['summary_month_name'], 
        $value1['enquiries'], 
        $value1['quotes'], 
        $value1['contracts'], 
        number_format($value1['enquiry_to_quote'], 2), 
        number_format($value1['quote_to_contract'], 2), 
        number_format($value1['enquiry_to_contract'], 2) 
    );
    $html_data_rows_sales_activity .= str_replace(
        $search_tag_html_template_data_row_sales_activity, 
        $replace_value_html_template_data_row_sales_activity, 
        $html_template_data_row_sales_activity
    );
    $grand_total_enquiries = $value1['grand_total_enquiries'];
    $grand_total_quotes = $value1['grand_total_quotes'];
    $grand_total_contracts = $value1['grand_total_contracts'];
    $grand_total_enquiry_to_quote = number_format($value1['grand_total_enquiry_to_quote'], 2);
    $grand_total_quote_to_contract = number_format($value1['grand_total_quote_to_contract'], 2);
    $grand_total_enquiry_to_contract = number_format($value1['grand_total_enquiry_to_contract'], 2);
}

$html_table_sales_activity = extractOuterStringFromText(
    '<!-- html_template_data_row_begin -->', 
    'header', 
    $html_template_table_sales_activity 
);
$html_table_sales_activity .= extractOuterStringFromText(
    '<!-- html_template_data_row_end -->', 
    'footer', 
    $html_template_table_sales_activity 
);
$target_width = '49%';
if (isset($user->groups['9'])) {
	//$target_width = '100%';
}
$search_tag_html_table_sales_activity = array(
	'[TARGET_WIDTH]', 
    '<!-- html_template_data_row_section -->', 
    '[GRAND_TOTAL_ENQUIRIES]', 
    '[GRAND_TOTAL_QUOTES]', 
    '[GRAND_TOTAL_CONTRACTS]', 
    '[GRAND_TOTAL_ENQUIRY_TO_QUOTE]', 
    '[GRAND_TOTAL_QUOTE_TO_CONTRACTS]', 
    '[GRAND_TOTAL_ENQUIRY_TO_CONTRACTS]' 
);
$replace_value_html_table_sales_activity = array(
	$target_width, 
    $html_data_rows_sales_activity, 
    $grand_total_enquiries, 
    $grand_total_quotes, 
    $grand_total_contracts, 
    $grand_total_enquiry_to_quote, 
    $grand_total_quote_to_contract, 
    $grand_total_enquiry_to_contract 
);
$html_table_sales_activity_last_year = str_replace(
    $search_tag_html_table_sales_activity, 
    $replace_value_html_table_sales_activity, 
    $html_table_sales_activity 
);


// ----- sales activity: this year -----//
// note: sales activity table currently done using variable $kpi_table_last_yr, $kpi_table_this_yr
$html_template_data_row_sales_activity = extractInnerStringFromText(
    '<!-- html_template_data_row_begin -->', 
    '<!-- html_template_data_row_end -->', 
    $html_template_table_sales_activity 
);
$html_data_rows_sales_activity = '';
$grand_total_enquiries = '';
$grand_total_quotes = '';
$grand_total_contracts = '';
$grand_total_enquiry_to_quote = '';
$grand_total_quote_to_contract = '';
$grand_total_enquiry_to_contract = '';
foreach ($sales_summary_info_this_year as $key1 => $value1) {
    $search_tag_html_template_data_row_sales_activity = array(
        '[SALES_MONTH_NAME]', 
        '[ENQUIRIES]', 
        '[QUOTES]', 
        '[CONTRACTS]', 
        '[ENQUIRY_TO_QUOTE]', 
        '[QUOTE_TO_CONTRACT]', 
        '[ENQUIRY_TO_CONTRACT]' 
    );
    $replace_value_html_template_data_row_sales_activity = array(
        $value1['summary_month_name'], 
        $value1['enquiries'], 
        $value1['quotes'], 
        $value1['contracts'], 
        number_format($value1['enquiry_to_quote'], 2), 
        number_format($value1['quote_to_contract'], 2), 
        number_format($value1['enquiry_to_contract'], 2) 
    );
    $html_data_rows_sales_activity .= str_replace(
        $search_tag_html_template_data_row_sales_activity, 
        $replace_value_html_template_data_row_sales_activity, 
        $html_template_data_row_sales_activity
    );
    $grand_total_enquiries = $value1['grand_total_enquiries'];
    $grand_total_quotes = $value1['grand_total_quotes'];
    $grand_total_contracts = $value1['grand_total_contracts'];
    $grand_total_enquiry_to_quote = number_format($value1['grand_total_enquiry_to_quote'], 2);
    $grand_total_quote_to_contract = number_format($value1['grand_total_quote_to_contract'], 2);
    $grand_total_enquiry_to_contract = number_format($value1['grand_total_enquiry_to_contract'], 2);
}

$html_table_sales_activity = extractOuterStringFromText(
    '<!-- html_template_data_row_begin -->', 
    'header', 
    $html_template_table_sales_activity 
);
$html_table_sales_activity .= extractOuterStringFromText(
    '<!-- html_template_data_row_end -->', 
    'footer', 
    $html_template_table_sales_activity 
);
$target_width = '48%';
if (isset($user->groups['9'])) {
	//$target_width = '100%';
}
$search_tag_html_table_sales_activity = array(
	'[TARGET_WIDTH]', 
    '<!-- html_template_data_row_section -->', 
    '[GRAND_TOTAL_ENQUIRIES]', 
    '[GRAND_TOTAL_QUOTES]', 
    '[GRAND_TOTAL_CONTRACTS]', 
    '[GRAND_TOTAL_ENQUIRY_TO_QUOTE]', 
    '[GRAND_TOTAL_QUOTE_TO_CONTRACTS]', 
    '[GRAND_TOTAL_ENQUIRY_TO_CONTRACTS]' 
);
$replace_value_html_table_sales_activity = array(
	$target_width, 
    $html_data_rows_sales_activity, 
    $grand_total_enquiries, 
    $grand_total_quotes, 
    $grand_total_contracts, 
    $grand_total_enquiry_to_quote, 
    $grand_total_quote_to_contract, 
    $grand_total_enquiry_to_contract 
);
$html_table_sales_activity_this_year = str_replace(
    $search_tag_html_table_sales_activity, 
    $replace_value_html_table_sales_activity, 
    $html_table_sales_activity 
);


// ----- sales summary -----//
// note: sales summary table currently done using variable $sales_compare_table
$html_template_data_row_sales_summary = extractInnerStringFromText(
    '<!-- html_template_data_row_begin -->', 
    '<!-- html_template_data_row_end -->', 
    $html_template_table_sales_summary 
);
$html_data_rows_sales_summary = '';
$grand_total_sales_amount_last_year = '';
$grand_total_sales_amount_this_year = '';
foreach ($sales_summary_info_last_year as $key1 => $value1) {
	$sales_amount_this_year = 0;
	foreach ($sales_summary_info_this_year as $key2 => $value2) {
		if ($value2['summary_month_name'] == $value1['summary_month_name']) {
			$sales_amount_this_year = $value2['sales_amount'];
			$grand_total_sales_amount_this_year = $value2['grand_total_sales_amount'];
		}
	}

    $search_tag_html_template_data_row_sales_summary = array(
        '[SALES_MONTH_NAME]', 
        '[SALES_AMOUNT_LAST_YEAR]', 
        '[SALES_AMOUNT_THIS_YEAR]' 
    );
    $replace_value_html_template_data_row_sales_summary = array(
        $value1['summary_month_name'], 
        '$' . number_format($value1['sales_amount'], 2), 
        '$' . number_format($sales_amount_this_year, 2) 
    );
    $html_data_rows_sales_summary .= str_replace(
        $search_tag_html_template_data_row_sales_summary, 
        $replace_value_html_template_data_row_sales_summary, 
        $html_template_data_row_sales_summary
    );
    $grand_total_sales_amount_last_year = '$' . number_format($value1['grand_total_sales_amount'], 2);
    $grand_total_sales_amount_this_year = '$' . number_format($grand_total_sales_amount_this_year, 2);
}

$html_table_sales_summary = extractOuterStringFromText(
    '<!-- html_template_data_row_begin -->', 
    'header', 
    $html_template_table_sales_summary 
);
$html_table_sales_summary .= extractOuterStringFromText(
    '<!-- html_template_data_row_end -->', 
    'footer', 
    $html_template_table_sales_summary 
);
$search_tag_html_table_sales_summary = array(
    '<!-- html_template_data_row_section -->', 
    '[GRAND_TOTAL_SALES_AMOUNT_LAST_YEAR]', 
    '[GRAND_TOTAL_SALES_AMOUNT_THIS_YEAR]' 
);
$replace_value_html_table_sales_summary = array(
    $html_data_rows_sales_summary, 
    $grand_total_sales_amount_last_year, 
    $grand_total_sales_amount_this_year 
);
$html_table_sales_summary = str_replace(
    $search_tag_html_table_sales_summary, 
    $replace_value_html_table_sales_summary, 
    $html_table_sales_summary 
);
?>