<?php
function executeDbQuery($sql) {
    $results = 'null';

    if ($query_result = mysql_query($sql)) {
        $results = array(
            'error' => 'null', 
            'message' => '', 
            'num_rows' => mysql_num_rows($query_result), 
            'affected_rows' => mysql_affected_rows($query_result), 
            'data' => $query_result, 
        );
    } else {
        $results = array(
            'error' => '00010', 
            'message' => mysql_error($query_result), 
            'num_rows' => 0, 
            'affected_rows' => 0, 
            'data' => 'null', 
        );
    }

    return $results;
}


function getResultsetInJson($sql) {
    $temp_array = array();
    $c1 = 0;

    $results = executeDbQuery($sql);
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
?>