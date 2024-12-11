<?php
function executeDbQuery($db_connection, $sql) {
    $results = null;

    if (($query_results = $db_connection->query($sql)) === false) {
        die("error: " . "\n" . $db_connection->errno . "\n" . $db_connection->error);
    }
    $results = $query_results;

    return $results;
}


function isDbTableExists($db_connection, $table_name) {
    $result = false;

    $sql = "
        SHOW TABLES LIKE '" . $table_name . "';
    ";
	$query_results = executeDbQuery($db_connection, $sql);

    $total_rows_affected = mysqli_affected_rows($db_connection);
    if ($total_rows_affected > 0) {
        $result = true;
    }

    return $result;
}


function isPreproductionServer() {
    $result = false;

    $ip_preproduction_server = '192.168.0.9';
	$command = 'ipconfig';
	exec($command, $command_response);

	foreach ($command_response as $key1 => $value1) {
		if (strpos($value1, $ip_preproduction_server) !== false) {
		    $result = true;
		}
	}

    return $result;
}


function extractInnerStringFromText($search_pattern_begin, $search_pattern_end, $textX) {
	$result = false;
	$extract_pos_begin = false;
	$extract_pos_end = false;
	$extract_length = 0;

	if (strpos($textX, $search_pattern_begin) !== false) {
		$extract_pos_begin = strpos($textX, $search_pattern_begin) + strlen($search_pattern_begin);
	}
	if (strpos($textX, $search_pattern_end) !== false) {
		$extract_pos_end = strpos($textX, $search_pattern_end);
	}
	if ($extract_pos_begin != false && $extract_pos_end != false) {
		$extract_length = $extract_pos_end - $extract_pos_begin;
	}
	if (is_numeric($extract_length) && $extract_length > 0) {
		$result = substr($textX, $extract_pos_begin, $extract_length);
	}

	return $result;
}


function extractOuterStringFromText($search_pattern, $extract_portion, $textX) {
	$result = false;
	$extract_pos_begin = false;
	$extract_pos_end = false;
	$extract_length = 0;

	if (strpos($textX, $search_pattern) !== false) {
		switch ($extract_portion) {
			case 'header':
				$extract_pos_begin = 0;
				$extract_pos_end = strpos($textX, $search_pattern);
				$extract_length = $extract_pos_end - $extract_pos_begin;
				if (is_numeric($extract_length) && $extract_length > 0) {
					$result = substr($textX, $extract_pos_begin, $extract_length);
				}
				break;
			case 'footer':
				$extract_pos_begin = strpos($textX, $search_pattern) + strlen($search_pattern);
				$extract_pos_end = strlen($textX);
				$extract_length = $extract_pos_end - $extract_pos_begin;
				if (is_numeric($extract_length) && $extract_length > 0) {
					$result = substr($textX, $extract_pos_begin, $extract_length);
				}
				break;
		}
	}

	return $result;
}


function getDatesDifference($from_date, $to_date) {
    $results = array();

    $total_seconds = strtotime(date('Y-m-d H:i:s', strtotime($to_date))) - strtotime(date('Y-m-d H:i:s', strtotime($from_date)));
    $total_minutes = (intval(floor($total_seconds)) > 0) ? ($total_seconds / 60) : 0;
    $total_hours = (intval(floor($total_minutes)) > 0) ? ($total_minutes / 60) : 0;
    $total_days = (intval(floor($total_hours)) > 0) ? ($total_hours / 24) : 0;

    $results['in_seconds'] = $total_seconds;
    if ( count(explode('.', strval($total_minutes))) > 1 ) {
        list($whole_minutes) = explode('.', strval($total_minutes));
        $results['in_seconds'] = $total_seconds - ($whole_minutes * 60);
    }

    $results['in_minutes'] = $total_minutes;
    if ( count(explode('.', strval($total_hours))) > 1 ) {
        list($whole_hours) = explode('.', strval($total_hours));
        $results['in_minutes'] = $total_minutes - ($whole_hours * 60);
    }

    $results['in_hours'] = $total_hours;
    if ( count(explode('.', strval($total_days))) > 1 ) {
        list($whole_days) = explode('.', strval($total_days));
        $results['in_hours'] = $total_hours - ($whole_days * 24);
    }

    $results['in_days'] = $total_days;

    list($results['in_seconds']) = explode('.', strval($results['in_seconds']));
    list($results['in_minutes']) = explode('.', strval($results['in_minutes']));
    list($results['in_hours']) = explode('.', strval($results['in_hours']));
    list($results['in_days']) = explode('.', strval($results['in_days']));

    return $results;
}


function addDateTime($source_date_time, $output_format, $add_field_name, $add_field_value) {
    $result = '';

    $hour_value = date('H', strtotime($source_date_time));
    $minute_value = date('i', strtotime($source_date_time));
    $second_value = date('s', strtotime($source_date_time));
    $month_value = date('m', strtotime($source_date_time));
    $day_value = date('d', strtotime($source_date_time));
    $year_value = date('Y', strtotime($source_date_time));

    switch ($add_field_name) {
        case 'hour':
            $hour_value = date('H', strtotime($source_date_time)) + $add_field_value;
            break;
        case 'minute':
            $minute_value = date('i', strtotime($source_date_time)) + $add_field_value;
            break;
        case 'second':
            $second_value = date('s', strtotime($source_date_time)) + $add_field_value;
            break;
        case 'month':
            $month_value = date('m', strtotime($source_date_time)) + $add_field_value;
            break;
        case 'day':
            $day_value = date('d', strtotime($source_date_time)) + $add_field_value;
            break;
        case 'year':
            $year_value = date('Y', strtotime($source_date_time)) + $add_field_value;
            break;
    }

    $result = date(
        $output_format, 
        mktime(
            $hour_value, 
            $minute_value, 
            $second_value, 
            $month_value, 
            $day_value, 
            $year_value
        )
    );

    return $result;
}


function logContents($file_folder, $file_name, $contents) {
    $result = null;

	list($file_name_part, $file_ext) = explode('.', $file_name);
	$file_name = $file_name_part . '_' . date('Ymd') . '.' . $file_ext;

	$yesterday_date = addDateTime(date('Y-m-d'), 'Ymd', 'day', -1);
	$yesterday_file_name = $file_name_part . '_' . $yesterday_date . '.' . $file_ext;

	$log_info = '';
	$log_info .=  '##### ##### ##### ##### ##### ##### ##### ##### ##### #####';
	$log_info .=  "\n";
	$log_info .=  "log time: " . date('Y-m-d H:i:s');
	$log_info .=  "\n";
	$log_info .=  '##### ##### ##### ##### ##### ##### ##### ##### ##### #####';
	$log_info .=  "\n";
	$log_info .=  "\n";
	$log_info .=  $contents;
	$log_info .=  "\n";
	$log_info .=  "\n";
	$log_info .=  "\n";
	$log_info .=  "\n";

	if (file_exists($file_folder . $yesterday_file_name)) {
		unlink($file_folder . $yesterday_file_name);
	}

	if (file_exists($file_folder . $file_name)) {
		$result = file_put_contents($file_folder . $file_name, $log_info, FILE_APPEND);
	} else {
		$result = file_put_contents($file_folder . $file_name, $log_info);
	}

    return $result;
}
?>