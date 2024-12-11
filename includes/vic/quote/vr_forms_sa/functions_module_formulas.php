<?php
function formulaGetRafterLength($run, $rise) {
    $run_in_value_for_calculation = convertValueForCalculation($run);
    $rise_in_value_for_calculation = convertValueForCalculation($rise);
    $rafter_length_in_value_for_calculation = 0.0;
    $rafter_length_in_value_for_display = '';

    $rafter_length_in_value_for_calculation = sqrt(pow($run_in_value_for_calculation, 2) + pow($rise_in_value_for_calculation, 2));
    $rafter_length_in_value_for_display = revertValueForCalculation($rafter_length_in_value_for_calculation);

    return $rafter_length_in_value_for_display;
}


function formulaConvertInchToFeetAndInch($inch_value) {
    $feet_per_inch = 0.08333;
    $feet_value1 = $inch_value * $feet_per_inch;
    $feet_value1_in_string = '' + $feet_value1;
    $feet_value1_1 = 0.0;
    $feet_value1_2 = 0.0;

    $feet_value2 = 0.0;
    $feet_value2_in_string = '';
    $feet_value2_1 = 0.0;
    $feet_value2_2 = 0.0;

    $feet_value3 = 0.0;
    $feet_value3_in_string = '';
    $feet_value3_1 = 0.0;
    $feet_value3_2 = 0.0;

    $feet_value4 = 0.0;
    $feet_value4_in_string = '';
    $feet_value4_1 = 0.0;
    $feet_value4_2 = 0.0;

    $inch_value2 = 0.0;
    $inch_value3 = 0.0;
    $inch_value4 = 0.0;

    $feet_value_final = 0.0;
    $inch_value_final = 0.0;

    $feet_and_inch_in_string = '';

    $temp_results = array();

    $temp_results = separateWholeAndFractionalNumbersFromInputValue($feet_value1_in_string, ".");
    $feet_value1_1 = $temp_results['whole_number'];
    $feet_value1_2 = $temp_results['fractional_number'];

    if ($feet_value1_2 > 0) {
        $inch_value2 = round(floatval('0.' . $feet_value1_2) / $feet_per_inch);
    }

    if ($inch_value2 > 0 && ($inch_value2 / 12) >= 1) {
        $feet_value2 = $inch_value2 / 12;
        $feet_value2_in_string = '' . $feet_value2;

        $temp_results = separateWholeAndFractionalNumbersFromInputValue($feet_value2_in_string, ".");
        $feet_value2_1 = $temp_results['whole_number'];
        $feet_value2_2 = $temp_results['fractional_number'];

        if ($feet_value2_2 > 0) {
            $inch_value3 = round(floatval('0.' . $feet_value2_2) / $feet_per_inch);
        }
    } else {
        $inch_value3 = $inch_value2;
    }

    $feet_value_final = floatval($feet_value1_1) + floatval($feet_value2_1);
    $inch_value_final = floatval($inch_value3);
    $feet_and_inch_in_string = "" . formatOutputValue('number', $feet_value_final)  . "'" . formatOutputValue('number', $inch_value_final);

    return $feet_and_inch_in_string;
}


function formulaConvertFeetToInch($feet_value) {
    $meter_per_feet = 0.3048;
    $meter_per_inch = 0.0254;
    $meter_value = $feet_value * $meter_per_feet;
    $inch_value = $meter_value / $meter_per_inch;
    return $inch_value;
}


function formulaConvertFeetAndInchToInch($input_value) {
    $results = separateFeetAndInchFromInputValue($input_value, "'");
    $total_inch = floatval(formulaConvertFeetToInch($results['feet'])) + floatval($results['inch']);
    return $total_inch;
}
?>