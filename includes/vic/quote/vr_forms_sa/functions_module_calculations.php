<?php
$application_region = 'SA';


function convertValueForCalculation($input_value) {
    $result = 0.0;

    if ($GLOBALS['application_region'] == 'LA') {
        $result = formulaConvertFeetAndInchToInch($input_value);
    } else {
        $result = floatval($input_value);
    }

    return $result;
}


function revertValueForCalculation($input_value) {
    $result = '';

    if ($GLOBALS['application_region'] == 'LA') {
        $result = formulaConvertInchToFeetAndInch($input_value);
    } else {
        $result = String($input_value);
    }

    return $result;
}


function separateWholeAndFractionalNumbersFromInputValue($input_value, $delimiter) {
    $results = array('whole_number' => '0', 'fractional_number' => '0');
    $temp_array = array();

    $temp_array = explode($delimiter, $input_value);
    if (count($temp_array) >= 2) {
        $results['whole_number'] = $temp_array[0];
        $results['fractional_number'] = $temp_array[1];
    } elseif (count($temp_array) == 1) {
        $results['whole_number'] = $temp_array[0];
        $results['fractional_number'] = 0;
    } else {
        $results['whole_number'] = 0;
        $results['fractional_number'] = 0;
    }

    if ($results['whole_number'] == '' || $results['whole_number'] == null || $results['whole_number'] == 'null') {
        $results['whole_number'] = 0;
    }
    if ($results['fractional_number'] == '' || $results['fractional_number'] == null || $results['fractional_number'] == 'null') {
        $results['fractional_number'] = 0;
    }

    return $results;
}


function formatOutputValue($output_type, $output_value) {
    $result;

    switch ($output_type) {
        case 'integer':
            if (! is_numeric($output_value)) {
                $result = 0;
            } else {
                $result = intval($output_value);
            }
            break;
        case 'float':
            if (! is_numeric($output_value)) {
                $result = 0.0;
            } else {
                $result = number_format(floatval($output_value), 2, '.', '');
            }
            break;
        case 'number':
            if (! is_numeric($output_value)) {
                $result = '0';
            } else {
                $result = $output_value;
            }
            break;
        case 'text':
            $result = $output_value;
            break;
    }

    return $result;
}


function separateFeetAndInchFromInputValue($input_value, $delimiter) {
    $results = array('feet' => '0', 'inch' => '0');
    $temp_array = array();

    $temp_array = explode($delimiter, $input_value);
    if (count($temp_array) >= 2) {
        $results['feet'] = $temp_array[0];
        $results['inch'] = $temp_array[1];
    } elseif (count($temp_array) == 1) {
        $results['feet'] = $temp_array[0];
        $results['inch'] = 0;
    } else {
        $results['feet'] = 0;
        $results['inch'] = 0;
    }

    if ($results['feet'] == '' || $results['feet'] == null || $results['feet'] == 'null') {
        $results['feet'] = 0;
    }
    if ($results['inch'] == '' || $results['inch'] == null || $results['inch'] == 'null') {
        $results['inch'] = 0;
    }

    return $results;
}
?>