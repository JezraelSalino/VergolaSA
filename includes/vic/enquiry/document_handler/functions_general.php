<?php
function executeDbQuery($sql, $db_connection) {
    $results = 'null';
    $record_display_commands = ['SELECT', 'SHOW'];
    $record_manipulate_commands = ['INSERT', 'UPDATE', 'REPLACE', 'DELETE'];

    if ($query_result = mysql_query($sql, $db_connection)) {
        $results = array(
            'error' => 'null', 
            'message' => '', 
            'num_rows' => 0, 
            'affected_rows' => 0, 
            'data' => $query_result, 
        );
        foreach ($record_display_commands as $key1 => $value1) {
            if (strtoupper(substr(trim($sql), 0, strlen($value1))) == $value1) {
                $results['num_rows'] = mysql_num_rows($query_result);
                break;
            }
        }
        foreach ($record_manipulate_commands as $key1 => $value1) {
            if (strtoupper(substr(trim($sql), 0, strlen($value1))) == $value1) {
                $results['affected_rows'] = mysql_affected_rows($db_connection);
                break;
            }
        }
    } else {
        $results = array(
            'error' => '00010', 
            'message' => mysql_error($db_connection), 
            'num_rows' => 0, 
            'affected_rows' => 0, 
            'data' => 'null', 
        );
    }

    return $results;
}


function getResultsetInJson($sql, $db_connection) {
    $temp_array = array();
    $c1 = 0;

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        while ($r1 = mysql_fetch_array($results['data'])) {
            $c1 = count($temp_array);
            foreach ($r1 as $key1 => $value1) {
                if (! is_numeric($key1)) {
                    $temp_array[$c1][$key1] = $value1;
                }
            }
        }
    }

    return json_encode($temp_array);
}


function getApiData($api_data_string) {
    $results = array(
        'api_data_string' => '', 
        'api_data' => array()
    );

    $api_data_string = str_replace('[AMPERSAND]', '&', $api_data_string);
    $api_data = json_decode($api_data_string, true);

    $results['api_data_string'] = $api_data_string;
    $results['api_data'] = $api_data;

    return $results;
}


function generateRandomString($target_length = 20, $character_map = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz') {
    $c1 = 0;
    $current_random_position = -1;
    $random_string = '';

    while (strlen($random_string) < $target_length) {
        $current_random_position = mt_rand(0, strlen($character_map));
        $random_string .= substr($character_map, $current_random_position, 1);
    }

    return $random_string;
}


function requestCurlCall($url, $data, $call_method = 'post') {
    switch ($call_method) {
        case 'post':
            $curl_options = array(
                CURLOPT_URL => $url, 
                CURLOPT_POST => true, 
                CURLOPT_RETURNTRANSFER => true, 
                CURLOPT_POSTFIELDS => 'api_data=' . json_encode($data)
            );
            break;
        case 'get':
            $url = $url . '&api_data=' . json_encode($data);
            $curl_options = array(
                CURLOPT_URL => $url, 
                CURLOPT_RETURNTRANSFER => true
            );
            break;
    }

    $curl_handler = curl_init();
    curl_setopt_array($curl_handler, $curl_options);
    $results = curl_exec($curl_handler);
    curl_close($curl_handler);

    return json_decode($results, true);
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


function logInputData($switch_log_input_data, $input_data, $file_folder, $file_name) {
    $log_content = '';

    if ($switch_log_input_data['php_input'] == 'on') {
        if (strlen($input_data['php_input']) > 0) {
            $log_content .= '// ----- $input_data[\'php_input\'] ----- //';
            $log_content .= "\n";
            $log_content .= $input_data['php_input'];
            $log_content .= "\n\n";
        }
    }

    if ($switch_log_input_data['request'] == 'on') {
        if (strlen($input_data['request']) > 0) {
            $log_content .= '// ----- $input_data[\'request\'] ----- //';
            $log_content .= "\n";
            $log_content .= $input_data['request'];
            $log_content .= "\n\n";
        }
    }

    logContents($file_folder, $file_name, $log_content);
}
?>