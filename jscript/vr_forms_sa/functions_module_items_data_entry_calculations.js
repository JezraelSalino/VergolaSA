        function getVrItemPricingInfo(vr_item_ref_name) {
            var c1 = 0;
            var results = {"item_uom":"", "item_unit_price":""};

            if (vr_item_ref_name.toLowerCase() != 'null') {
                for (c1 = 0; c1 < vr_items_list.length; c1++) {
                    if (vr_items_list[c1]['item_ref_name'] == vr_item_ref_name) {
                        results['item_uom'] = vr_items_list[c1]['item_uom'];
                        results['item_unit_price'] = vr_items_list[c1]['item_unit_price'];
                    }
                }
            }

            return results;
        }


        function getVrItemWebbingPricingInfo(vr_section_ref_name, selected_webbing_value) {
            var c1 = 0;
            var results = {"item_uom":"", "item_unit_price":""};

            if (selected_webbing_value.toLowerCase() == 'yes') {
                for (c1 = 0; c1 < vr_items_list.length; c1++) {
                    if (vr_items_list[c1]['section_ref_name'] == vr_section_ref_name && 
                        vr_items_list[c1]['subsection_ref_name'] == 'Beam Fixings' && 
                        vr_items_list[c1]['item_display_name'].toLowerCase().indexOf('webbing') != -1) {
                        /*vr_items_list[c1]['item_display_name'] == 'C beam open webbing'*/
                        results['item_uom'] = vr_items_list[c1]['item_uom'];
                        results['item_unit_price'] = vr_items_list[c1]['item_unit_price'];
                    }
                }
            }

            return results;
        }


        function getVrItemFinishPricingInfo(vr_section_ref_name, selected_finish_value) {
            var c1 = 0;
            var results = {"item_uom":"", "item_unit_price":""};

            for (c1 = 0; c1 < vr_items_list.length; c1++) {
                if (vr_items_list[c1]['section_ref_name'] == vr_section_ref_name && 
                    vr_items_list[c1]['subsection_ref_name'] == 'Finish' && 
                    vr_items_list[c1]['item_display_name'].toLowerCase() == selected_finish_value.toLowerCase()) {
                    results['item_uom'] = vr_items_list[c1]['item_uom'];
                    results['item_unit_price'] = vr_items_list[c1]['item_unit_price'];
                }
            }

            return results;
        }


        function setVrFormItemDataEntryRowValuesByInternalRefName(vr_item_config_internal_ref_name, row_values) {
            var c1 = 0;
            var c2 = 0;

            for (c1 = 0; c1 < vr_form_items_data_entry.length; c1++) {
                if (vr_form_items_data_entry[c1]['vr_item_config_internal_ref_name'] == vr_item_config_internal_ref_name) {
                    for (c2 = 0; c2 < row_values.length; c2++) {
                        document.getElementById(row_values[c2]['form_item_name'] + '_' + c1).value = row_values[c2]['col_value'];
                        vr_form_items_data_entry[c1][row_values[c2]['variable_name']] = row_values[c2]['col_value'];
                    }
                }
            }
        }


        function setVrFormItemDataEntryRowValuesByRowIndex(row_index, row_values) {
            var c1 = 0;
            var c2 = 0;

            for (c1 = 0; c1 < vr_form_items_data_entry.length; c1++) {
                if (c1 == row_index) {
                    for (c2 = 0; c2 < row_values.length; c2++) {
                        document.getElementById(row_values[c2]['form_item_name'] + '_' + c1).value = row_values[c2]['col_value'];
                        vr_form_items_data_entry[c1][row_values[c2]['variable_name']] = row_values[c2]['col_value'];
                    }
                }
            }
        }


        function getVrFormItemDataEntryRowValuesByInternalRefName(vr_item_config_internal_ref_name) {
            var c1 = 0;
            var results = {
                "type_ref_name":"", 
                "type_display_name":"", 
                "section_ref_name":"", 
                "section_display_name":"", 
                "subsection_ref_name":"", 
                "subsection_display_name":"", 
                "item_ref_name":"", 
                "item_display_name":"", 
                "item_webbing":"", 
                "item_colour":"", 
                "item_finish":"", 
                "item_uom":"", 
                "item_unit_price":"", 
                "item_qty":"", 
                "item_length_meter":"", 
                "item_rrp":""
            };

            for (c1 = 0; c1 < vr_form_items_data_entry.length; c1++) {
                if (vr_form_items_data_entry[c1]['vr_item_config_internal_ref_name'] == vr_item_config_internal_ref_name) {
                    results['type_ref_name'] = document.getElementById('vr_type_data_entry_ref_name_' + c1).value;
                    results['type_display_name'] = document.getElementById('vr_type_data_entry_display_name_' + c1).value;
                    results['section_ref_name'] = document.getElementById('vr_section_data_entry_ref_name_' + c1).value;
                    results['section_display_name'] = document.getElementById('vr_section_data_entry_display_name_' + c1).value;
                    results['subsection_ref_name'] = document.getElementById('vr_subsection_data_entry_ref_name_' + c1).value;
                    results['subsection_display_name'] = document.getElementById('vr_subsection_data_entry_display_name_' + c1).value;
                    results['item_ref_name'] = document.getElementById('vr_item_data_entry_ref_name_' + c1).value;
                    results['item_display_name'] = document.getElementById('vr_item_data_entry_display_name_' + c1).value;
                    results['item_webbing'] = document.getElementById('vr_item_data_entry_webbing_' + c1).value;
                    results['item_colour'] = document.getElementById('vr_item_data_entry_colour_' + c1).value;
                    results['item_finish'] = document.getElementById('vr_item_data_entry_finish_' + c1).value;
                    results['item_uom'] = document.getElementById('vr_item_data_entry_uom_' + c1).value;
                    results['item_unit_price'] = document.getElementById('vr_item_data_entry_unit_price_' + c1).value;
                    results['item_qty'] = document.getElementById('vr_item_data_entry_qty_' + c1).value;
                    results['item_length_meter'] = document.getElementById('vr_item_data_entry_length_meter_' + c1).value;
                    results['item_rrp'] = formatInputValue('float', document.getElementById('vr_item_data_entry_rrp_' + c1).value);
                }
            }

            return results;
        }


        function formatNumberWithoutComma(input_value) {
            var result;
            var temp_text = '';
            var temp_array = [];
            var c1 = 0;
            var new_input_value = '';

            temp_text = '' + input_value;
            temp_array = temp_text.split(',');

            for (c1 in temp_array) {
                if (!isNaN(c1)) {
                    new_input_value += temp_array[c1];
                }
            }
            result = new_input_value;

            return result;
        }


        function formatNumberWithComma(input_value) {
            var result;
            var temp_text = '';
            var temp_array = [];
            var c1 = 0;
            var comma_per_total_chars = 3;
            var current_total_chars = 0;
            var new_input_value = '';


            if (isNaN(input_value)) {
                result = 0;
            } else {
                temp_text = '' + input_value;
                temp_array = temp_text.split('.')
                temp_text = temp_array[0];
                for (c1 = (temp_text.length - 1); c1 >= 0; c1--) {
                    current_total_chars++;
                    new_input_value = temp_text.substring(c1, c1 + 1) + new_input_value;
                    if (current_total_chars >= comma_per_total_chars) {
                        current_total_chars = 0;
                        if (c1 > 0) {
                            new_input_value = ',' + new_input_value;
                        }
                    }
                }

                if (temp_array.length == 2) {
                    new_input_value = '' + new_input_value + '.' + temp_array[1];
                }

                result = new_input_value;
            }

            return result;
        }


        function formatInputValue(input_type, input_value) {
            var result;

            switch (input_type) {
                case 'integer':
                    result = formatNumberWithoutComma(input_value);
                    break;
                case 'float':
                    result = formatNumberWithoutComma(input_value);
                    break;
                case 'number':
                    result = formatNumberWithoutComma(input_value);
                    break;
                case 'text':
                    result = input_value;
                    break;
            }

            return result;
        }


        function formatOutputValue(output_type, output_value) {
            var result;

            switch (output_type) {
                case 'integer':
                    if (isNaN(output_value)) {
                        result = 0;
                    } else {
                        result = formatNumberWithComma(parseInt(output_value));
                    }
                    break;
                case 'float':
                    if (isNaN(output_value)) {
                        result = 0.0;
                    } else {
                        result = formatNumberWithComma(parseFloat(output_value).toFixed(2));
                    }
                    break;
                case 'number':
                    if (isNaN(output_value)) {
                        result = '0';
                    } else {
                        result = formatNumberWithComma(output_value);
                    }
                    break;
                case 'text':
                    result = output_value;
                    break;
            }

            return result;
        }


        function assignVrDimensionsToVrFormItemsDataEntry() {
            assignVrDimensionsToVrFormBeamRows();
            switch (document.getElementById('vr_type_form_query').value) {
                case 'VR1':
                case 'VR2':
                case 'VR4':
                case 'VR6':
                case 'VR8':
                    assignVrDimensionsToVrYFormRelatedRows();
                    break;
                case 'VR3':
                case 'VR3G':
                case 'VR5':
                case 'VR7':
                case 'VR9':
                    assignVrDimensionsToVrXFormRelatedRows();
                    break;
            }
        }


        function assignSubtotalPriceToVrFormItemsDataEntry() {
            var c1 = 0;
            var length_unit_types = ['mtrs', 'inches'];
            var current_item_length = 0.0;
            var current_item_length_in_value_for_calculation = 0.0;
            var current_item_length_meter = 0.0;
            var current_item_length_meter_in_value_for_calculation = 0.0;
            var current_item_unit_price = 0.0;
            var current_item_qty = 0.0;
            var current_item_rrp = 0.0;
            var current_subtotal = 0.0;
            var current_webbing_subtotal = 0.0;
            var current_finish_subtotal = 0.0;
            var item_pricing_info = {"item_uom":"", "item_unit_price":""};
            var webbing_pricing_info = {"item_uom":"", "item_unit_price":""};
            var finish_pricing_info = {"item_uom":"", "item_unit_price":""};
            var current_calculation_log = '';

            for (c1 = 0; c1 < vr_form_items_data_entry.length; c1++) {
                if (document.getElementById('vr_type_data_entry_ref_name_' + c1)) {
                    current_item_length_meter = vr_form_items_data_entry[c1]['vr_item_length_meter'];
                    current_item_length_meter = (current_item_length_meter.length == 0 || isNaN(current_item_length_meter)) ? 0 : current_item_length_meter;
                    current_item_length = current_item_length_meter;
                    current_item_length_in_value_for_calculation = convertValueForCalculation(current_item_length);

                    current_item_qty = vr_form_items_data_entry[c1]['vr_item_qty'];/*parseInt(vr_form_items_data_entry[c1]['vr_item_qty'])*/
                    current_item_qty = (current_item_qty.length == 0 || isNaN(current_item_qty)) ? 0 : current_item_qty;

                    item_pricing_info = {"item_uom":"", "item_unit_price":""};
                    item_pricing_info = getVrItemPricingInfo(vr_form_items_data_entry[c1]['vr_item_ref_name']);
                    if (item_pricing_info['item_uom'] != '' && item_pricing_info['item_unit_price'] != '') {
                        if (item_pricing_info['item_uom'].toLowerCase() != vr_form_items_data_entry[c1]['vr_item_uom'].toLowerCase()) {
                            vr_form_items_data_entry[c1]['vr_item_uom'] = item_pricing_info['item_uom'];
                        }
                        if (item_pricing_info['item_unit_price'] != vr_form_items_data_entry[c1]['vr_item_unit_price']) {
                            vr_form_items_data_entry[c1]['vr_item_unit_price'] = item_pricing_info['item_unit_price'];
                        }
                    }
                    current_item_unit_price = parseFloat(vr_form_items_data_entry[c1]['vr_item_unit_price']);

                    current_subtotal = 0.0;
                    if (length_unit_types.indexOf(vr_form_items_data_entry[c1]['vr_item_uom'].toLowerCase()) == -1) {
                        current_subtotal = current_item_unit_price * current_item_qty;
                    } else {
                        current_subtotal = current_item_unit_price * current_item_length_in_value_for_calculation * current_item_qty;
                    }

                    webbing_pricing_info = {"item_uom":"", "item_unit_price":""};
                    current_webbing_subtotal = 0.0;
                    if (vr_form_items_data_entry[c1]['vr_item_webbing_input_type'] == 'Select Box' && 
                        vr_form_items_data_entry[c1]['vr_item_webbing'] != 'null') {
                        webbing_pricing_info = getVrItemWebbingPricingInfo(vr_form_items_data_entry[c1]['vr_section_ref_name'], vr_form_items_data_entry[c1]['vr_item_webbing']);
                        if (webbing_pricing_info['item_uom'] != '' && webbing_pricing_info['item_unit_price'] != '') {
                            if (length_unit_types.indexOf(webbing_pricing_info['item_uom'].toLowerCase()) == -1) {
                                current_webbing_subtotal = parseFloat(webbing_pricing_info['item_unit_price']) * current_item_qty;
                            } else {
                                current_webbing_subtotal = parseFloat(webbing_pricing_info['item_unit_price']) * current_item_length_in_value_for_calculation * current_item_qty;
                            }
                        }
                    }

                    finish_pricing_info = {"item_uom":"", "item_unit_price":""};
                    current_finish_subtotal = 0.0;
                    if (vr_form_items_data_entry[c1]['vr_item_finish_input_type'] == 'Select Box' && 
                        vr_form_items_data_entry[c1]['vr_item_finish'] != 'null') {
                        finish_pricing_info = getVrItemFinishPricingInfo(vr_form_items_data_entry[c1]['vr_section_ref_name'], vr_form_items_data_entry[c1]['vr_item_finish']);
                        if (finish_pricing_info['item_uom'] != '' && finish_pricing_info['item_unit_price'] != '') {
                            if (length_unit_types.indexOf(finish_pricing_info['item_uom'].toLowerCase()) == -1) {
                                current_finish_subtotal = parseFloat(finish_pricing_info['item_unit_price']) * current_item_qty;
                            } else {
                                current_finish_subtotal = parseFloat(finish_pricing_info['item_unit_price']) * current_item_length_in_value_for_calculation * current_item_qty;
                            }
                        }
                    }

                    current_item_rrp = (current_subtotal + current_webbing_subtotal + current_finish_subtotal).toFixed(2);
                    vr_form_items_data_entry[c1]['vr_item_rrp'] = current_item_rrp;
                    document.getElementById('vr_item_data_entry_rrp_' + c1).value = formatOutputValue('float', current_item_rrp);

                    current_calculation_log = '' + 
                                                'item length: ' + formatOutputValue('float', current_item_length_in_value_for_calculation) + '<br />' + 
                                                'item unit price: ' + formatOutputValue('float', current_item_unit_price) + '<br />' + 
                                                'webbing uom: ' + webbing_pricing_info['item_uom'] + '<br />' + 
                                                'webbing unit price: ' + webbing_pricing_info['item_unit_price'] + '<br />' + 
                                                'finish uom: ' + finish_pricing_info['item_uom'] + '<br />' + 
                                                'finish unit price: ' + finish_pricing_info['item_unit_price'] + '<br />' + 
                                                'item subtotal: ' + formatOutputValue('float', current_subtotal) + '<br />' + 
                                                'webbing subtotal: ' + formatOutputValue('float', current_webbing_subtotal) + '<br />' + 
                                                'finish subtotal: ' + formatOutputValue('float', current_finish_subtotal);
                    document.getElementById('vr_item_data_entry_rrp_log_' + c1).innerHTML = current_calculation_log;
                }
            }
        }


        function assignVrFormBillingInfo() {
            var c1 = 0;
            var total_payment_vr_items_rrp = 0.0;
            var total_payment_vergola = 0.0;
            var total_payment_disbursement_sub_total = 0.0;
            var total_payment_sub_total = 0.0;
            var total_payment_tax = 0.0;
            var total_payment_total = 0.0;

            var total_payment_deposit = 0.0;
            var total_payment_progress_payment = 0.0;
            var total_payment_final_payment = 0.0;

            var total_commission_sales_commission = 0.0;
            var total_commission_pay1 = 0.0;
            var total_commission_pay2 = 0.0;
            var total_commission_final = 0.0;
            var total_commission_installer_payment = 0.0;

            for (c1 = 0; c1 < vr_form_items_data_entry.length; c1++) {
                if (vr_form_items_data_entry[c1]['vr_section_ref_name'] != 'Disbursements') {
                    total_payment_vr_items_rrp += parseFloat(vr_form_items_data_entry[c1]['vr_item_rrp']);
                }
                if (vr_form_items_data_entry[c1]['vr_section_ref_name'] == 'Disbursements') {
                    total_payment_disbursement_sub_total += parseFloat(vr_form_items_data_entry[c1]['vr_item_rrp']);
                }
            }

            total_payment_vergola = total_payment_vr_items_rrp / vr_form_system_info['payment_vergola_commission_percentage'];

            total_payment_sub_total = total_payment_vergola + total_payment_disbursement_sub_total;
            total_payment_tax = total_payment_sub_total * vr_form_system_info['payment_tax_percentage'];
            total_payment_total = total_payment_sub_total + total_payment_tax;

            switch (vr_form_system_info['payment_deposit_calculation_method']) {
                case 'percentage':
                    total_payment_deposit = total_payment_total * vr_form_system_info['payment_deposit_percentage'];
                    break;
                case 'range':
                    total_payment_deposit = total_payment_total * vr_form_system_info['payment_deposit_percentage'];
                    if (total_payment_deposit < vr_form_system_info['payment_deposit_minimum']) {
                        total_payment_deposit = vr_form_system_info['payment_deposit_minimum'];
                    }
                    if (total_payment_deposit > vr_form_system_info['payment_deposit_maximum']) {
                        total_payment_deposit = vr_form_system_info['payment_deposit_maximum'];
                    }
                    break;
                case 'fixed_amount':
                    total_payment_deposit = vr_form_system_info['payment_deposit_fixed_amount'];
                    break;
            }

            total_payment_progress_payment = total_payment_total * vr_form_system_info['payment_progress_payment_percentage'];
            total_payment_final_payment = total_payment_total - total_payment_deposit - total_payment_progress_payment;

            if (total_payment_final_payment < 0) {
                total_payment_progress_payment = total_payment_total - total_payment_deposit;
                total_payment_final_payment = total_payment_total - total_payment_deposit - total_payment_progress_payment;
            }

            total_commission_sales_commission = total_payment_vergola * vr_form_system_info['commission_sales_commission_percentage'];
            total_commission_pay1 = total_commission_sales_commission * vr_form_system_info['commission_pay1_percentage'];
            total_commission_pay2 = total_commission_sales_commission * vr_form_system_info['commission_pay2_percentage'];
            total_commission_final = total_commission_sales_commission * vr_form_system_info['commission_final_percentage'];
            total_commission_installer_payment = total_payment_vergola * vr_form_system_info['commission_installer_payment_percentage'];

            document.getElementById('vr_payment_vergola_form_billing').value = formatOutputValue('float', total_payment_vergola);
            document.getElementById('vr_payment_vr_items_rrp_form_billing').value = formatOutputValue('float', total_payment_vr_items_rrp);

            document.getElementById('vr_payment_disbursement_sub_total_form_billing').value = formatOutputValue('float', total_payment_disbursement_sub_total);
            document.getElementById('vr_payment_sub_total_form_billing').value = formatOutputValue('float', total_payment_sub_total);
            document.getElementById('vr_payment_tax_form_billing').value = formatOutputValue('float', total_payment_tax);
            document.getElementById('vr_payment_total_form_billing').value = formatOutputValue('float', total_payment_total);

            document.getElementById('vr_payment_deposit_form_billing').value = formatOutputValue('float', total_payment_deposit);
            document.getElementById('vr_payment_progress_payment_form_billing').value = formatOutputValue('float', total_payment_progress_payment);
            document.getElementById('vr_payment_final_payment_form_billing').value = formatOutputValue('float', total_payment_final_payment);

            document.getElementById('vr_commission_sales_commission_form_billing').value = formatOutputValue('float', total_commission_sales_commission);
            document.getElementById('vr_commission_pay1_form_billing').value = formatOutputValue('float', total_commission_pay1);
            document.getElementById('vr_commission_pay2_form_billing').value = formatOutputValue('float', total_commission_pay2);
            document.getElementById('vr_commission_final_form_billing').value = formatOutputValue('float', total_commission_final);
            document.getElementById('vr_commission_installer_payment_form_billing').value = formatOutputValue('float', total_commission_installer_payment);
        }


        function adjustPaymentTaxManually() {
            assignVrFormBillingInfo();
        }


        function calculateVrFormItemsDataEntryValues(process_option) {
            if (vr_form_system_info['access_mode'] != 'quote_view' && vr_form_system_info['access_mode'] != 'contract_bom_edit') {
                if (vr_form_system_info['access_mode'] == 'quote_add') {
                    total_calculation_process_done++;
                }
                if (total_calculation_process_done > 0) {
                    switch (process_option) {
                        case 1:
                            setMandatoryNumericFields();
                            copyVrFormItemsDataEntryFormValue();
                            extractVrFormItemDataEntryPropertiesName();
                            assignVrDimensionsToVrFormItemsDataEntry();
                            calculateTotalGutterLining();
                            calculateLouvreRelatedInfo();
                            assignSubtotalPriceToVrFormItemsDataEntry();
                            assignVrFormBillingInfo();
                            break;
                        case 2:
                            setMandatoryNumericFields();
                            copyVrFormItemsDataEntryFormValue();
                            extractVrFormItemDataEntryPropertiesName();
                            calculateTotalGutterLining();
                            calculateLouvreRelatedInfo();
                            assignSubtotalPriceToVrFormItemsDataEntry();
                            assignVrFormBillingInfo();
                            break;
                    }
                }
                total_calculation_process_done++;
            }
            if (vr_form_system_info['access_mode'] == 'contract_bom_edit') {
                if (total_calculation_process_done > 0) {
                    switch (process_option) {
                        case 2:
                            setMandatoryNumericFields();
                            copyVrFormItemsDataEntryFormValue();
                            extractVrFormItemDataEntryPropertiesName();
                            calculateTotalGutterLining();
                            calculateLouvreRelatedInfo();
                            break;
                    }
                }
                total_calculation_process_done++;
            }
        }


        function separateFeetAndInchFromInputValue(input_value, delimiter) {
            var results = {"feet":"0", "inch":"0"};
            var temp_array = [];

            temp_array = input_value.split(delimiter);
            if (temp_array.length >= 2) {
                results['feet'] = temp_array[0];
                results['inch'] = temp_array[1];
            } else if (temp_array.length == 1) {
                results['feet'] = temp_array[0];
                results['inch'] = 0;
            } else {
                results['feet'] = 0;
                results['inch'] = 0;
            }

            if (results['feet'] == '' || results['feet'] == null || results['feet'] == 'null') {
                results['feet'] = 0;
            }
            if (results['inch'] == '' || results['inch'] == null || results['inch'] == 'null') {
                results['inch'] = 0;
            }

            return results;
        }


        function separateWholeAndFractionalNumbersFromInputValue(input_value, delimiter) {
            var results = {"whole_number":"0", "fractional_number":"0"};
            var temp_array = [];

            temp_array = input_value.split(delimiter);
            if (temp_array.length >= 2) {
                results['whole_number'] = temp_array[0];
                results['fractional_number'] = temp_array[1];
            } else if (temp_array.length == 1) {
                results['whole_number'] = temp_array[0];
                results['fractional_number'] = 0;
            } else {
                results['whole_number'] = 0;
                results['fractional_number'] = 0;
            }

            if (results['whole_number'] == '' || results['whole_number'] == null || results['whole_number'] == 'null') {
                results['whole_number'] = 0;
            }
            if (results['fractional_number'] == '' || results['fractional_number'] == null || results['fractional_number'] == 'null') {
                results['fractional_number'] = 0;
            }

            return results;
        }


        function convertValueForCalculation(input_value) {
            var result = 0.0;

            if (application_region == 'LA') {
                result = formulaConvertFeetAndInchToInch(input_value);
            } else {
                result = parseFloat(input_value);
            }

            return result;
        }


        function revertValueForCalculation(input_value) {
            var result = '';

            if (application_region == 'LA') {
                result = formulaConvertInchToFeetAndInch(input_value);
            } else {
                result = String(input_value);
            }

            return result;
        }


        function calculateBomFormDimensionValues(base_fraction_for_calulation, dimension_ref_ids) {
            var results = {
                "total_mm":0.0
            };
            var c1 = 0;
            var temp_text = '';
            var current_mm = 0.0;
            var total_mm = 0.0;
            var temp_array = [];

            for (c1 = 0; c1 < dimension_ref_ids.length; c1++) {
                temp_text = document.getElementById(dimension_ref_ids[c1] + '_form_bom').value;
                if (dimension_ref_ids[c1].search('mm') >= 0) {
                    if (!isNaN(temp_text)) {
                        current_mm = Math.abs(temp_text);
                        total_mm += current_mm;
                    }
                }
            }

            results['total_mm'] = total_mm;

            return results;
        }


        function calculateBomFormGirthValues() {
            var girth_side_a_calculation_for_gutter_ref_ids = [
                "item_dimension_f_mm", 
                "item_dimension_a_mm", 
                "item_dimension_p_mm", 
                "item_dimension_c_mm", 
                "item_dimension_e_mm", 
                "item_dimension_g_mm",
                "item_dimension_h_mm",
            ];
            var girth_side_b_calculation_for_gutter_ref_ids = [
                "item_dimension_f_mm", 
                "item_dimension_b_mm", 
                "item_dimension_p_mm", 
                "item_dimension_d_mm", 
                "item_dimension_e_mm", 
                "item_dimension_g_mm",
                "item_dimension_h_mm",
            ];
            var girth_side_a_calculation_for_flashing_ref_ids = [
                "item_dimension_a_mm", 
                "item_dimension_c_mm", 
                "item_dimension_e_mm", 
                "item_dimension_f_mm", 
                "item_dimension_g_mm",
                "item_dimension_h_mm",
                "item_dimension_p_mm", 
            ];
            var girth_side_b_calculation_for_flashing_ref_ids = [
                "item_dimension_b_mm", 
                "item_dimension_d_mm", 
                "item_dimension_e_mm", 
                "item_dimension_f_mm", 
                "item_dimension_g_mm",
                "item_dimension_h_mm",
                "item_dimension_p_mm", 
            ];
            var target_vr_section_ref_name = vr_form_items_data_entry[bom_form_item_dimension_current_popup_index]['vr_section_ref_name'].toLowerCase();
            var result1 = {};
            var result2 = {};

            if (target_vr_section_ref_name.search('gutter') >= 0) {
                result1 = calculateBomFormDimensionValues(32, girth_side_a_calculation_for_gutter_ref_ids);
                result2 = calculateBomFormDimensionValues(32, girth_side_b_calculation_for_gutter_ref_ids);
            } else {
                if (target_vr_section_ref_name.search('flashing') >= 0) {
                    result1 = calculateBomFormDimensionValues(32, girth_side_a_calculation_for_flashing_ref_ids);
                    result2 = calculateBomFormDimensionValues(32, girth_side_b_calculation_for_flashing_ref_ids);
                }
            }

            document.getElementById('item_dimension_girth_side_a_mm_form_bom').value = result1['total_mm'];
            document.getElementById('item_dimension_girth_side_b_mm_form_bom').value = result2['total_mm'];
        }
