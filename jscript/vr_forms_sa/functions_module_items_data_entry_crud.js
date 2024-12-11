        function getNonHiddenVrFormItemsConfig(target_vr_item_config_list) {
            var c1 = 0;
            var temp_array = [];

            for (c1 = 0; c1 < target_vr_item_config_list.length; c1++) {
                if (target_vr_item_config_list[c1]['status'] != 'hidden') {
                    temp_array[temp_array.length] = target_vr_item_config_list[c1];
                }
            }

            return temp_array;
        }


        function jsonDecodeVrFormItemsConfig() {
            var vr_type_form_query_value = document.getElementById('vr_type_form_query').value;
            var temp_text = '';
            var json_encoded_output = '';
            var target_vr_item_config_list = [];

            if (vr_type_form_query_value != 'null') {
                if (vr_item_config_saved_data_list[vr_type_form_query_value].length == 0) {
                    target_vr_item_config_list = getNonHiddenVrFormItemsConfig(vr_item_config_list[vr_type_form_query_value]);
                    vr_item_config_saved_data_list[vr_type_form_query_value] = target_vr_item_config_list;
                }

                json_encoded_output = vr_item_config_saved_data_list[vr_type_form_query_value];

                if (json_encoded_output.length > 0) {
                    vr_form_items_data_entry = json_encoded_output;
                } else {
                    vr_form_items_data_entry = [];
                }
            } else {
                vr_form_items_data_entry = [];
            }
        }


        function jsonEncodeVrFormItemsDataEntry() {
            var c1 = 0;
            var c2 = 0;
            var items_list_json = '';
            var new_line_code = '<br />';
            var indentation_code = '&nbsp;&nbsp;&nbsp;&nbsp;';

            items_list_json += '[';
            items_list_json += new_line_code;
            for (c1 = 0; c1 < vr_form_items_data_entry.length; c1++) {
                items_list_json += indentation_code;
                items_list_json += '{';
                for (c2 = 0; c2 < vr_form_item_data_entry_property_names.length; c2++) {
                    items_list_json += '"' + vr_form_item_data_entry_property_names[c2] + '":' + JSON.stringify(vr_form_items_data_entry[c1][vr_form_item_data_entry_property_names[c2]]);
                    if (c2 < vr_form_item_data_entry_property_names.length - 1) {
                        items_list_json += ', ';
                    }
                }
                items_list_json += '}';
                if (c1 < vr_form_items_data_entry.length - 1) {
                    items_list_json += ', ';
                }
                items_list_json += new_line_code;
            }
            items_list_json += ']';

            vr_form_items_data_entry_in_string = items_list_json;
        }


        function filterVrFormJsonArray(json_array_ref_name) {
            var c1;
            var c2;
            var special_chars_encoding_list = [
                {"search_text":"&", "replace_text":"[AMPERSAND]"}
            ];
            var json_text = '';

            switch (json_array_ref_name) {
                case 'vr_form_system_info':
                    for (c1 in vr_form_system_info) {
                        json_text = vr_form_system_info[c1];
                        if (isNaN(json_text)) {
                            vr_form_system_info[c1] = encodeSpecialCharsInJsonText(json_text, special_chars_encoding_list);
                        }
                    }
                    break;
                case 'vr_form_queries_info':
                    for (c1 in vr_form_queries_info) {
                        if ((typeof vr_form_queries_info[c1] === 'object') && (vr_form_queries_info[c1] !== null)) {
                            /* no processing for object or array */
                        } else {
                            json_text = vr_form_queries_info[c1];
                            if (isNaN(json_text)) {
                                vr_form_queries_info[c1] = encodeSpecialCharsInJsonText(json_text, special_chars_encoding_list);
                            }
                        }
                    }
                    break;
                case 'vr_form_items_data_entry':
                    for (c1 = 0; c1 < vr_form_items_data_entry.length; c1++) {
                        for (c2 in vr_form_items_data_entry[c1]) {
                            if ((typeof vr_form_items_data_entry[c1][c2] === 'object') && (vr_form_items_data_entry[c1][c2] !== null)) {
                                /* no processing for object or array */
                            } else {
                                json_text = vr_form_items_data_entry[c1][c2];
                                if (isNaN(json_text)) {
                                    vr_form_items_data_entry[c1][c2] = encodeSpecialCharsInJsonText(json_text, special_chars_encoding_list);
                                }
                            }
                        }
                    }
                    break;
                case 'vr_form_report_info':
                    json_text = vr_form_report_info;
                    if (isNaN(json_text)) {
                        vr_form_report_info = encodeSpecialCharsInJsonText(json_text, special_chars_encoding_list);
                    }
                    break;
            }
        }


        function processRetrieveResult(results) {
            if (results['error'] == 'null') {
                console.log('processRetrieveResult > results:');
                console.log(results);

                document.getElementById('vr_framework_type_form_query').value = results['data']['vr_form_queries_info']['vr_framework_type'];
                document.getElementById('vr_type_form_query').value = results['data']['vr_form_items_data_entry'][0]['vr_type_ref_name'];
                document.getElementById('vr_project_name_form_query').value = results['data']['vr_form_queries_info']['vr_project_name'];
                document.getElementById('vr_default_colour_form_query').value = results['data']['vr_form_queries_info']['vr_default_colour'];

                vr_item_config_saved_data_list[document.getElementById('vr_type_form_query').value] = results['data']['vr_form_items_data_entry'];

                processVrFrameworkTypeFormQueries(3);
                processVrDimensionFormQueries(3);

                if (document.getElementById('vr_type_form_query').value == 'VR8' || 
                    document.getElementById('vr_type_form_query').value == 'VR9') {
                    document.getElementById('vr_run_meter_form_query').value = results['data']['vr_form_queries_info']['vr_run_meter'];
                    document.getElementById('vr_rise_meter_form_query').value = results['data']['vr_form_queries_info']['vr_rise_meter'];
                }

                var c1 = 0;
                var vr_type_info = getVrTypeInfo();
                for (c1 = 0; c1 < parseInt(vr_type_info['number_of_bay']); c1++) {
                    document.getElementById('vr_length_meter_form_query_' + c1).value = results['data']['vr_form_queries_info']['vr_length_info']['vr_lengths_meter'][c1];
                }

                if (document.getElementById('vr_width_meter_form_query')) {
                    document.getElementById('vr_width_meter_form_query').value = results['data']['vr_form_queries_info']['vr_width_meter'];
                }

                vr_form_queries_info = results['data']['vr_form_queries_info'];
                vr_form_queries_info['vr_type'] = document.getElementById('vr_type_form_query').value;


                var billing_info_fields = [
                    'vr_payment_vergola', 
                    'vr_payment_vr_items_rrp', 
                    'vr_payment_disbursement_sub_total', 
                    'vr_payment_sub_total', 
                    'vr_payment_tax', 
                    'vr_payment_total', 
                    'vr_payment_deposit', 
                    'vr_payment_progress_payment', 
                    'vr_payment_final_payment', 
                    'vr_commission_sales_commission', 
                    'vr_commission_pay1', 
                    'vr_commission_pay2', 
                    'vr_commission_final', 
                    'vr_commission_installer_payment'
                ];
                for (c1 = 0; c1 < billing_info_fields.length; c1++) {
                    document.getElementById(billing_info_fields[c1] + '_form_billing').value = formatOutputValue('float', results['data']['vr_form_billing_info'][billing_info_fields[c1]]);
                }
                vr_form_billing_info = results['data']['vr_form_billing_info'];

                document.getElementById('project_name_form_bom').innerHTML = vr_form_queries_info['vr_project_name'];
                document.getElementById('contract_id_form_bom').innerHTML = vr_form_system_info['project_id'];

                switch (vr_form_system_info['access_mode']) {
                    case 'quote_edit':
                        disableVrFormFrameworkAndVrTypesDataEntryMode(true);
                        processVrFormRecordActionMode();
                        break;
                    case 'quote_view':
                        disableVrFormDataEntryMode(true);
                        processVrFormRecordActionMode();
                        break;
                    case 'contract_bom_edit':
                        processVrFormRecordActionMode();
                        break;
                }

                /* if currently is in process order mode, perform process order actions */
                if (current_process_order_by_vr_section_display_name != '') {
                    saveBomFormPoData2();
                }
            } else {
                console.log('processRetrieveResult > results:');
                console.log(results);
            }
        }


        function retrieveVrFormData() {
            var url = window.location.href + '&api_mode=1';
            var request_data = {
                "vr_form_operation":"retrieve", 
                "access_mode":vr_form_system_info['access_mode'], 
                "quote_id":vr_form_system_info['quote_id'], 
                "project_id":vr_form_system_info['project_id'], 
                "sales_rep_id":vr_form_system_info['sales_rep_id']
            };

            requestAjaxCall(url, request_data, 'processRetrieveResult');
            console.log('request_data:');
            console.log(request_data);
        }


        function processDeleteResult(results) {
            if (results['error'] == 'null') {
                window.location = vr_form_url_info['previous'] + '&uc=' + vr_form_url_info['unique_code'];
            } else {
                console.log('processDeleteResult > results:');
                console.log(results);
            }
        }


        function deleteVrFormData() {
            var url = window.location.href + '&api_mode=1';
            var request_data = {
                "vr_form_operation":"delete", 
                "access_mode":vr_form_system_info['access_mode'], 
                "quote_id":vr_form_system_info['quote_id'], 
                "project_id":vr_form_system_info['project_id'], 
                "sales_rep_id":vr_form_system_info['sales_rep_id']
            };

            requestAjaxCall(url, request_data, 'processDeleteResult');
            console.log('request_data:');
            console.log(request_data);
        }


        function processSaveResult1(results) {
            if (results['error'] == 'null') {
                window.location = vr_form_url_info['previous'] + '&uc=' + vr_form_url_info['unique_code'];
            } else {
                console.log('processSaveResult1 > results:');
                console.log(results);
            }
        }


        function processSaveResult2(results) {
            if (results['error'] == 'null') {
                var project_id = '';
                if (vr_form_system_info['access_mode'] == 'quote_add') {
                    project_id = results['message']['next_project_id'];
                }
                if (vr_form_system_info['access_mode'] == 'quote_edit') {
                    project_id = vr_form_system_info['project_id'];
                }
                window.location = vr_form_url_info['save_quote'] + '&project_id=' + project_id + '&uc=' + vr_form_url_info['unique_code'];
            } else {
                console.log('processSaveResult2 > results:');
                console.log(results);
            }
        }


        function processSaveResult3(results) {
            if (results['error'] == 'null') {
                window.location = vr_form_url_info['download_pdf'] + '&uc=' + vr_form_url_info['unique_code'];
            } else {
                console.log('processSaveResult3 > results:');
                console.log(results);
            }

            if (vr_form_system_info['access_mode'] == 'quote_view') {
                disableVrFormDataEntryMode(true);
            }
        }


        function saveVrFormData(save_option) {
            setMandatoryNumericFields();
            copyVrFormItemsDataEntryFormValue();
            extractVrFormItemDataEntryPropertiesName();
            jsonEncodeVrFormItemsDataEntry();
            copyVrFormQueriesInfoFormValue();
            copyVrFormBillingInfoFormValue();

            vr_form_report_info = getReportFromVrFormAllInfo();

            filterVrFormJsonArray('vr_form_system_info');
            filterVrFormJsonArray('vr_form_queries_info');
            filterVrFormJsonArray('vr_form_items_data_entry');
            filterVrFormJsonArray('vr_form_report_info');

            var url = window.location.href + '&api_mode=1';
            var request_data = {
                "vr_form_system_info":vr_form_system_info, 
                "vr_form_queries_info":vr_form_queries_info, 
                "vr_form_items_data_entry":vr_form_items_data_entry, 
                "vr_form_billing_info":vr_form_billing_info, 
                "vr_form_report_info":vr_form_report_info
            };
            request_data['vr_form_operation'] = 'save';
            if (vr_form_system_info['access_mode'] == 'quote_edit' || 
                vr_form_system_info['access_mode'] == 'contract_bom_edit') {
                request_data['vr_form_operation'] = 'update';
            }

            if (save_option == 'duplicate') {
                request_data['vr_form_operation'] = 'save';
                vr_form_queries_info['vr_project_name'] = 'Duplicate: ' + vr_form_queries_info['vr_project_name'];
            }

            if (save_option == 'download_pdf') {
                request_data['vr_form_operation'] = 'update';
            }

            if (save_option == 'save_and_exit' || save_option == 'duplicate') {
                requestAjaxCall(url, request_data, 'processSaveResult1');
            } else if (save_option == 'download_pdf') {
                requestAjaxCall(url, request_data, 'processSaveResult3');
            } else {
                requestAjaxCall(url, request_data, 'processSaveResult2');
            }

            console.log('url:');
            console.log(url);
            console.log('request_data:');
            console.log(request_data);
        }


        function cancelVrFormData() {
            window.location = vr_form_url_info['previous'] + '&uc=' + vr_form_url_info['unique_code'];
        }


        function downloadVrFormData() {
            saveVrFormData('download_pdf');
        }


        function processSaveResultBomFormItemDimensionData(results) {
            if (results['error'] == 'null') {
                vr_form_items_data_entry[bom_form_item_dimension_current_popup_index]['vr_record_index'] = results['data']['last_insert_id_data_contract_items'];
                vr_form_items_data_entry[bom_form_item_dimension_current_popup_index]['bom_form_item_dimensions_info']['item_dimension_record_index'] = results['data']['last_insert_id_data_contract_items_deminsions'];
                hideBomFormItemDimensionPopup();
                saveBomFormContractItemData(1);
            } else {
                console.log('processSaveResultBomFormItemDimensionData > results:');
                console.log(results);
            }
        }


        function saveBomFormItemDimensionData() {
            calculateBomFormGirthValues();
            copyVrFormItemsDataEntryFormValue();
            copyBomFormDimensionInfoFormValue();

            filterVrFormJsonArray('vr_form_system_info');
            filterVrFormJsonArray('vr_form_queries_info');
            filterVrFormJsonArray('vr_form_items_data_entry');

            var url = window.location.href + '&api_mode=1';
            var request_data = {
                "vr_form_operation":"update", 
                "access_mode":"contract_bom_item_dimension_update", 
                "cf_id":vr_form_items_data_entry[bom_form_item_dimension_current_popup_index]['vr_record_index'], 
                "quote_id":vr_form_system_info['quote_id'], 
                "project_id":vr_form_system_info['project_id'], 
                "vr_project_name":vr_form_queries_info['vr_project_name'], 
                "vr_framework_type":vr_form_queries_info['vr_framework_type'], 
                "inventory_id":vr_form_items_data_entry[bom_form_item_dimension_current_popup_index]['vr_item_ref_name'], 
                "vr_form_items_data_entry": vr_form_items_data_entry[bom_form_item_dimension_current_popup_index]
            };

            requestAjaxCall(url, request_data, 'processSaveResultBomFormItemDimensionData');
            console.log('request_data:');
            console.log(request_data);
        }


        function processDeleteResultBomFormData(results) {
            if (results['error'] == 'null') {
                window.location = vr_form_url_info['bom'] + '&uc=' + vr_form_url_info['unique_code'];
            } else {
                console.log('processDeleteResultBomFormData > results:');
                console.log(results);
            }
        }


        function deleteBomFormData(cancel_order_by_vr_section_display_name) {
            copyVrFormItemsDataEntryFormValue();
            extractVrFormItemDataEntryPropertiesName();
            jsonEncodeVrFormItemsDataEntry();
            copyVrFormQueriesInfoFormValue();

            filterVrFormJsonArray('vr_form_system_info');
            filterVrFormJsonArray('vr_form_queries_info');
            filterVrFormJsonArray('vr_form_items_data_entry');

            var url = window.location.href + '&api_mode=1';
            var request_data = {
                "vr_form_operation":"delete", 
                "access_mode":"contract_bom_delete", 
                "quote_id":vr_form_system_info['quote_id'], 
                "project_id":vr_form_system_info['project_id'], 
                "vr_framework_type":vr_form_queries_info['vr_framework_type'], 
                "vr_form_items_data_entry":vr_form_items_data_entry, 
                "cancel_order_by_vr_section_display_name":cancel_order_by_vr_section_display_name
            };

            requestAjaxCall(url, request_data, 'processDeleteResultBomFormData');
            console.log('url:');
            console.log(url);
            console.log('request_data:');
            console.log(request_data);
        }


        function saveBomFormPoData(process_order_by_vr_section_display_name) {
            current_process_order_by_vr_section_display_name = process_order_by_vr_section_display_name;
            saveBomFormContractItemData(2);
        }


        function processSaveResultBomFormPoData2(results) {
            if (results['error'] == 'null') {
                window.location = vr_form_url_info['po'] + '&uc=' + vr_form_url_info['unique_code'];
            } else {
                console.log('processSaveResultBomFormPoData > results:');
                console.log(results);
            }
            current_process_order_by_vr_section_display_name = '';
        }


        function saveBomFormPoData2() {
            copyVrFormItemsDataEntryFormValue();
            extractVrFormItemDataEntryPropertiesName();
            jsonEncodeVrFormItemsDataEntry();
            copyVrFormQueriesInfoFormValue();

            filterVrFormJsonArray('vr_form_system_info');
            filterVrFormJsonArray('vr_form_queries_info');
            filterVrFormJsonArray('vr_form_items_data_entry');

            var url = window.location.href + '&api_mode=1';
            var request_data = {
                "vr_form_operation":"save", 
                "access_mode":"contract_bom_save", 
                "vr_form_system_info":vr_form_system_info, 
                "vr_form_queries_info":vr_form_queries_info, 
                "vr_form_items_data_entry":vr_form_items_data_entry, 
                "process_order_by_vr_section_display_name":current_process_order_by_vr_section_display_name
            };

            requestAjaxCall(url, request_data, 'processSaveResultBomFormPoData2');
            console.log('url:');
            console.log(url);
            console.log('request_data:');
            console.log(request_data);
        }


        function processSaveResultBomFormContractItemData1(results) {
            if (results['error'] == 'null') {
                /* remain still in page, at the moment no need do retrieveVrFormData() function */
                // retrieveVrFormData();
            } else {
                console.log('processSaveResultBomFormContractItemData > results:');
                console.log(results);
            }
        }


        function processSaveResultBomFormContractItemData2(results) {
            if (results['error'] == 'null') {
                /* process order mode checking is done in retrieveVrFormData() function */
                retrieveVrFormData();
            } else {
                console.log('processSaveResultBomFormContractItemData > results:');
                console.log(results);
            }
        }


        function saveBomFormContractItemData(process_option) {
            copyVrFormItemsDataEntryFormValue();
            extractVrFormItemDataEntryPropertiesName();
            jsonEncodeVrFormItemsDataEntry();
            copyVrFormQueriesInfoFormValue();

            filterVrFormJsonArray('vr_form_system_info');
            filterVrFormJsonArray('vr_form_queries_info');
            filterVrFormJsonArray('vr_form_items_data_entry');

            var url = window.location.href + '&api_mode=1';
            var request_data = {
                "vr_form_operation":"update", 
                "access_mode":"contract_bom_save", 
                "vr_form_system_info":vr_form_system_info, 
                "vr_form_queries_info":vr_form_queries_info, 
                "vr_form_items_data_entry":vr_form_items_data_entry
            };

            switch (process_option) {
                case 1:
                    requestAjaxCall(url, request_data, 'processSaveResultBomFormContractItemData1');
                    break;
                case 2:
                    requestAjaxCall(url, request_data, 'processSaveResultBomFormContractItemData2');
                    break;
            }

            console.log('url:');
            console.log(url);
            console.log('request_data:');
            console.log(request_data);
        }
