        function formulaGetRafterLength(run, rise) {
            var run_in_value_for_calculation = convertValueForCalculation(run);
            var rise_in_value_for_calculation = convertValueForCalculation(rise);
            var rafter_length_in_value_for_calculation = 0.0;
            var temp_float = 0.0;
            var rafter_length_in_value_for_display = '';

            rafter_length_in_value_for_calculation = Math.sqrt(Math.pow(run_in_value_for_calculation, 2) + Math.pow(rise_in_value_for_calculation, 2));
            temp_float = parseFloat(revertValueForCalculation(rafter_length_in_value_for_calculation));
            rafter_length_in_value_for_display = temp_float.toFixed(2);

            return rafter_length_in_value_for_display;
        }


        function formulaConvertInchToFeetAndInch(inch_value) {
            var feet_per_inch = 0.08333;
            var feet_value1 = inch_value * feet_per_inch;
            var feet_value1_in_string = '' + feet_value1;
            var feet_value1_1 = 0.0;
            var feet_value1_2 = 0.0;

            var feet_value2 = 0.0;
            var feet_value2_in_string = '';
            var feet_value2_1 = 0.0;
            var feet_value2_2 = 0.0;

            var feet_value3 = 0.0;
            var feet_value3_in_string = '';
            var feet_value3_1 = 0.0;
            var feet_value3_2 = 0.0;

            var feet_value4 = 0.0;
            var feet_value4_in_string = '';
            var feet_value4_1 = 0.0;
            var feet_value4_2 = 0.0;

            var inch_value2 = 0.0;
            var inch_value3 = 0.0;
            var inch_value4 = 0.0;

            var feet_value_final = 0.0;
            var inch_value_final = 0.0;

            var feet_and_inch_in_string = '';

            var temp_results = [];

            temp_results = separateWholeAndFractionalNumbersFromInputValue(feet_value1_in_string, ".");
            feet_value1_1 = temp_results['whole_number'];
            feet_value1_2 = temp_results['fractional_number'];

            if (feet_value1_2 > 0) {
                inch_value2 = Math.round(parseFloat('0.' + feet_value1_2) / feet_per_inch);
            }

            if (inch_value2 > 0 && (inch_value2 / 12) >= 1) {
                feet_value2 = inch_value2 / 12;
                feet_value2_in_string = '' + feet_value2;

                temp_results = separateWholeAndFractionalNumbersFromInputValue(feet_value2_in_string, ".");
                feet_value2_1 = temp_results['whole_number'];
                feet_value2_2 = temp_results['fractional_number'];

                if (feet_value2_2 > 0) {
                    inch_value3 = Math.round(parseFloat('0.' + feet_value2_2) / feet_per_inch);
                }
            } else {
                inch_value3 = inch_value2;
            }

            feet_value_final = parseFloat(feet_value1_1) + parseFloat(feet_value2_1);
            inch_value_final = parseFloat(inch_value3);
            feet_and_inch_in_string = "" + formatOutputValue('number', feet_value_final)  + "'" + formatOutputValue('number', inch_value_final);

            return feet_and_inch_in_string;
        }


        function formulaConvertFeetToInch(feet_value) {
            var meter_per_feet = 0.3048;
            var meter_per_inch = 0.0254;
            var meter_value = feet_value * meter_per_feet;
            var inch_value = meter_value / meter_per_inch;
            return inch_value;
        }


        function formulaConvertFeetAndInchToInch(input_value) {
            var results = separateFeetAndInchFromInputValue(input_value, "'");
            var total_inch = parseFloat(formulaConvertFeetToInch(results['feet'])) + parseFloat(results['inch']);
            return total_inch;
        }
