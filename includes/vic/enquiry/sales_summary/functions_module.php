<?php
function initialiseArraySalesSummaryInfo($financial_year_begin_date) {
	$results = array();

	for ($i = 0; $i < 12; $i++) {
		$financial_year_processing_month = date(
			'Y-m', 
			mktime(
				'0', 
				'0', 
				'0', 
				date('m', strtotime($financial_year_begin_date)) + $i, 
				date('d', strtotime($financial_year_begin_date)), 
				date('Y', strtotime($financial_year_begin_date))
			)
		);
		$search_date_year = date('Y', strtotime($financial_year_processing_month . '-01'));
		$search_date_month = date('m', strtotime($financial_year_processing_month . '-01'));
		$array_key = $search_date_year . '-' . $search_date_month;
		$summary_month_name = date('F', strtotime($search_date_year . '-' . $search_date_month . '-01'));
		$results[$array_key] = array(
			'summary_date' => '', 
			'summary_year' => '', 
			'summary_month' => '', 
			'summary_month_name' => $summary_month_name, 
			'target_sales_amount' => 0, 
			'target_sales_contract' => 0, 
			'sales_amount' => 0, 
			'sales_performance_monthly_diff' => 0, 
			'sales_performance_ytd_diff' => 0, 
			'enquiries' => 0, 
			'quotes' => 0, 
			'contracts' => 0, 
			'enquiry_to_quote' => 0, 
			'quote_to_contract' => 0, 
			'enquiry_to_contract' => 0, 
			'grand_total_target_sales_amount' => 0, 
			'grand_total_target_sales_contract' => 0, 
			'grand_total_sales_amount' => 0, 
			'grand_total_enquiries' => 0, 
			'grand_total_quotes' => 0, 
			'grand_total_contracts' => 0, 
			'grand_total_enquiry_to_quote' => 0, 
			'grand_total_quote_to_contract' => 0, 
			'grand_total_enquiry_to_contract' => 0, 
		);
	}

	return $results;
}


function populateArraySalesSummaryInfo(&$array_sales_summary_info, $extracted_sales_summary_data) {
	while ($r = $extracted_sales_summary_data->fetch_assoc()) {
		$target_array_key = substr($r['summary_date'], 0, 7);
		if (isset($array_sales_summary_info[$target_array_key])) {
			foreach ($r as $key1 => $value1) {
				$array_sales_summary_info[$target_array_key][$key1] = $value1;
			}
		}
	}

	return $array_sales_summary_info;
}


function getFillDateInfoBySalesSummaryTable($db_connection, $config, $target_table_name, $target_date_field_name, $enable_fill_last_record_date = true) {
	$results = array();
	$results['last_record_date'] = null;
	$results['fill_date_from'] = null;
	$results['fill_date_total_days'] = null;
	$results['fill_date_to'] = null;

	$sql = "
	    SELECT 
	        IF(MAX(" . $target_date_field_name . ") IS NOT NULL, MAX(" . $target_date_field_name . "), '') AS 'last_record_date' 
	    FROM " . $target_table_name . ";
	";
	$query_results = executeDbQuery($db_connection, $sql);
	$row = $query_results->fetch_assoc();
	if (strlen(trim($row['last_record_date'])) == 0) {
	    $fill_date_from = $config['date_time']['project_begin_date'];
	} else {
		if (isset($config['input_data']['record_update_type']) && $config['input_data']['record_update_type'] == 'flush') {
		    $fill_date_from = $config['date_time']['project_begin_date'];
		} else {
			if ($enable_fill_last_record_date == true) {
			    $fill_date_from = $row['last_record_date'];
			} else {
			    $fill_date_from = addDateTime($row['last_record_date'], 'Y-m-d', 'day', 1);
			}
		}
	}

	$results_get_dates_difference = getDatesDifference($fill_date_from, $config['date_time']['next_year_end_date']);
	$fill_date_total_days = $results_get_dates_difference['in_days'];
	$fill_date_to = addDateTime($fill_date_from, 'Y-m-d', 'day', $fill_date_total_days);

	$results['last_record_date'] = $row['last_record_date'];
	$results['fill_date_from'] = $fill_date_from;
	$results['fill_date_total_days'] = $fill_date_total_days;
	$results['fill_date_to'] = $fill_date_to;

	return $results;
}


function getTargetSalesSummaryTableInfo($config, $target_table_name, $sql) {
    $results = array();
    $results['target_table_name'] = $target_table_name;
    $results['sql'] = $sql;

    if (isset($config['input_data']['record_update_type']) && $config['input_data']['record_update_type'] == 'flush') {
        $results['target_table_name'] = $target_table_name . '_temp';
        $results['sql'] = str_replace(
            $target_table_name, 
            $results['target_table_name'], 
            $sql
        );
    }

    return $results;
}
?>