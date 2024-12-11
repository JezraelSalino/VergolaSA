        function processVrFormQueriesValueForGableType() {
            var run_value = 0;
            var run_meter_value = 0;
            var rise_value = 0;
            var rise_meter_value = 0;
            var rafter_length_value = 0.0;
            var rafter_length_meter_value = 0.0;
            var temp_array = [];

            if (document.getElementById('vr_run_meter_form_query').value.length > 0) {
                run_meter_value = document.getElementById('vr_run_meter_form_query').value;
            }
            if (document.getElementById('vr_rise_meter_form_query').value.length > 0) {
                rise_meter_value = document.getElementById('vr_rise_meter_form_query').value;
            }

            run_value = run_meter_value;
            rise_value = rise_meter_value;
            rafter_length_value = formulaGetRafterLength(run_value, rise_value);
            temp_array = rafter_length_value.split('\'');
            rafter_length_meter_value = temp_array[0];

            document.getElementById('vr_length_meter_form_query_0').value = rafter_length_meter_value;
            document.getElementById('vr_length_meter_form_query_1').value = rafter_length_meter_value;
        }


        function getVrTypeInfo() {
            var c1 = 0;
            var i1;
            var vr_type_info = {};

            for (c1 = 0; c1 < vr_types_list.length; c1++) {
                if (vr_types_list[c1]['ref_name'] == document.getElementById('vr_type_form_query').value) {
                    for (i1 in vr_types_list[c1]) {
                        vr_type_info[i1] = vr_types_list[c1][i1];
                    }
                }
            }

            return vr_type_info;
        }


        function copyVrFormQueriesInfoFormValue() {
            var c1 = 0;
            var vr_type_info = getVrTypeInfo();
            var queries_info_fields = [
                'vr_framework_type', 
                'vr_type', 
                'vr_project_name', 
                'vr_default_colour', 
                'vr_run_meter', 
                'vr_rise_meter', 
                'vr_width_meter'
            ];

            for (c1 = 0; c1 < queries_info_fields.length; c1++) {
                if (document.getElementById(queries_info_fields[c1] + '_form_query')) {
                    vr_form_queries_info[queries_info_fields[c1]] = document.getElementById(queries_info_fields[c1] + '_form_query').value;
                }
            }
            for (c1 = 0; c1 < parseInt(vr_type_info['number_of_bay']); c1++) {
                if (document.getElementById('vr_length_meter_form_query_' + c1)) {
                    vr_form_queries_info['vr_length_info']['vr_lengths_meter'][c1] = document.getElementById('vr_length_meter_form_query_' + c1).value;
                }
            }
            vr_form_queries_info['vr_number_of_bay'] = vr_type_info['number_of_bay'];
        }


        function clearVrFormBillingInfoFormValue() {
            var c1 = 0;
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
                if (document.getElementById(billing_info_fields[c1] + '_form_billing')) {
                    document.getElementById(billing_info_fields[c1] + '_form_billing').value = '';
                }
            }
        }


        function copyVrFormBillingInfoFormValue() {
            var c1 = 0;
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
                if (document.getElementById(billing_info_fields[c1] + '_form_billing')) {
                    vr_form_billing_info[billing_info_fields[c1]] = formatInputValue('float', document.getElementById(billing_info_fields[c1] + '_form_billing').value);
                }
            }
        }


        function processVrDimensionFormQueries(process_option) {
            processVrFrameworkTypeFormQueries(process_option);
            copyVrFormQueriesInfoFormValue();

            var template_vr_form_queries_table_row_header = '' + 
                    '<tr>' + 
                        '[VR_QUOTE_DATE_FORM_QUERY_HEADER_AREA]' + 
                        '<td class="vr_table_head_3">Framework Type</td>' + 
                        '<td class="vr_table_head_3">VR Type</td>' + 
                        '<td class="vr_table_head_3">Project Name</td>' + 
                        '<td class="vr_table_head_3">Default Colour</td>' + 
                        '[VR_RUN_FORM_QUERY_HEADER_AREA]' + 
                        '[VR_RISE_FORM_QUERY_HEADER_AREA]' + 
                        '[VR_LENGTH_FORM_QUERY_HEADER_AREA]' + 
                        '[VR_WIDTH_FORM_QUERY_HEADER_AREA]' + 
                    '</tr>';
            var template_vr_quote_date_form_query_header = '<td class="vr_table_head_3">Quote Date</td>';
            var template_vr_run_form_query_header = '<td class="vr_table_head_3">Run</td>';
            var template_vr_rise_form_query_header = '<td class="vr_table_head_3">Rise</td>';
            var template_vr_length_form_query_header = '<td class="vr_table_head_3">Length [INDEX_NUMBER]</td>';
            var template_vr_width_form_query_header = '<td class="vr_table_head_3">Width</td>';

            var template_vr_form_queries_table_row_body = '' + 
                    '<tr>' + 
                        '[VR_QUOTE_DATE_FORM_QUERY_BODY_AREA]' + 
                        '<td class="vr_table_body_3">[VR_FRAMEWORK_TYPE_FORM_QUERY_AREA]</td>' + 
                        '<td class="vr_table_body_3">[VR_TYPE_FORM_QUERY_AREA]</td>' + 
                        '<td class="vr_table_body_3">[VR_PROJECT_NAME_FORM_QUERY_AREA]</td>' + 
                        '<td class="vr_table_body_3">[VR_DEFAULT_COLOUR_FORM_QUERY_AREA]</td>' + 
                        '[VR_RUN_FORM_QUERY_BODY_AREA]' + 
                        '[VR_RISE_FORM_QUERY_BODY_AREA]' + 
                        '[VR_LENGTH_FORM_QUERY_BODY_AREA]' + 
                        '[VR_WIDTH_FORM_QUERY_BODY_AREA]' + 
                    '</tr>';
            var template_vr_quote_date_form_query_body = '' +  
                    '<td class="vr_table_body_3">' + 
                        '<input type="text" class="vr_form_field_textbox_1" id="[FIELD_NAME]" name="[FIELD_NAME]" value="[FIELD_VALUE]" disabled />' + 
                    '</td>';
            var template_vr_run_form_query_body = '' +  
                    '<td class="vr_table_body_3">' + 
                        '<input type="text" class="vr_form_field_textbox_meter_1" id="vr_run_meter_form_query" name="vr_run_meter_form_query" value="" placeholder="Meter" onchange="processVrFormQueriesValueForGableType()">' + 
                    '</td>';
            var template_vr_rise_form_query_body = '' + 
                    '<td class="vr_table_body_3">' + 
                        '<input type="text" class="vr_form_field_textbox_meter_1" id="vr_rise_meter_form_query" name="vr_rise_meter_form_query" value="" placeholder="Meter" onchange="processVrFormQueriesValueForGableType()">' + 
                    '</td>';
            var template_vr_length_form_query_body = '' + 
                    '<td class="vr_table_body_3">' + 
                        '<input type="text" class="vr_form_field_textbox_meter_1" id="vr_length_meter_form_query_[INDEX_NUMBER]" name="vr_length_meter_form_query_[INDEX_NUMBER]" placeholder="Meter" value="" onchange="calculateVrFormItemsDataEntryValues(1)" />' + 
                    '</td>';
            var template_vr_width_form_query_body = '' + 
                    '<td class="vr_table_body_3">' + 
                        '<input type="text" class="vr_form_field_textbox_meter_1" id="vr_width_meter_form_query" name="vr_width_meter_form_query" value="" placeholder="Meter" onchange="calculateVrFormItemsDataEntryValues(1)" />' + 
                    '</td>';
            var template_vr_form_inputbox = '<input type="text" class="vr_form_field_textbox_1" id="[FIELD_NAME]" name="[FIELD_NAME]" value="[FIELD_VALUE]" onchange="" />';

            var vr_framework_type_form_query_area = '';
            var vr_type_form_query_area = '';
            var vr_project_name_form_query_area = '';
            var vr_default_colour_form_query_area = '';

            var vr_quote_date_form_query_header_area = '';
            var vr_run_form_query_header_area = '';
            var vr_rise_form_query_header_area = '';
            var vr_length_form_query_header_area = '';
            var vr_width_form_query_header_area = '';

            var vr_quote_date_form_query_body_area = '';
            var vr_run_form_query_body_area = '';
            var vr_rise_form_query_body_area = '';
            var vr_length_form_query_body_area = '';
            var vr_width_form_query_body_area = '';

            var temp_text = '';
            var temp_text1 = '';
            var items_list_text = '';
            var c1 = 0;
            var i1;
            var vr_type_info = getVrTypeInfo();

            vr_quote_date_form_query_header_area = '';
            if (vr_form_system_info['quote_date']) {
                vr_quote_date_form_query_header_area = template_vr_quote_date_form_query_header;
            }

            vr_run_form_query_header_area = '';
            vr_rise_form_query_header_area = '';
            if (vr_type_info['bay_roof_shape'] == 'gable') {
                vr_run_form_query_header_area = template_vr_run_form_query_header;
                vr_rise_form_query_header_area = template_vr_rise_form_query_header;
            }

            for (c1 = 0; c1 < parseInt(vr_type_info['number_of_bay']); c1++) {
                temp_text = replaceSubstringInText(
                    ['[INDEX_NUMBER]'], 
                    [c1 + 1], 
                    template_vr_length_form_query_header
                );
                /* --- */
                if (document.getElementById('vr_type_form_query').value == 'VR3' || 
                    document.getElementById('vr_type_form_query').value == 'VR3G' || 
                    document.getElementById('vr_type_form_query').value == 'VR5' || 
                    document.getElementById('vr_type_form_query').value == 'VR7') {
                    temp_text = replaceSubstringInText(
                        [
                            '[INDEX_NUMBER]', 
                            'Length'
                        ], 
                        [
                            c1 + 1, 
                            'Width'
                        ], 
                        template_vr_length_form_query_header
                    );
                }
                /* --- */
                vr_length_form_query_header_area += temp_text;
            }

            vr_width_form_query_header_area = template_vr_width_form_query_header;
            /* --- */
            if (document.getElementById('vr_type_form_query').value == 'VR3' || 
                document.getElementById('vr_type_form_query').value == 'VR3G' || 
                document.getElementById('vr_type_form_query').value == 'VR5' || 
                document.getElementById('vr_type_form_query').value == 'VR7') {
                vr_width_form_query_header_area = replaceSubstringInText(
                    ['Width'], 
                    ['Length'], 
                    template_vr_width_form_query_header
                );
            }
            /* --- */
            if (document.getElementById('vr_type_form_query').value == 'null' || 
                document.getElementById('vr_type_form_query').value == 'VR0') {
                vr_width_form_query_header_area = '';
            }

            temp_text = replaceSubstringInText(
                [
                    '[VR_QUOTE_DATE_FORM_QUERY_HEADER_AREA]', 
                    '[VR_RUN_FORM_QUERY_HEADER_AREA]', 
                    '[VR_RISE_FORM_QUERY_HEADER_AREA]', 
                    '[VR_LENGTH_FORM_QUERY_HEADER_AREA]', 
                    '[VR_WIDTH_FORM_QUERY_HEADER_AREA]' 
                ], 
                [
                    vr_quote_date_form_query_header_area, 
                    vr_run_form_query_header_area, 
                    vr_rise_form_query_header_area, 
                    vr_length_form_query_header_area, 
                    vr_width_form_query_header_area 
                ], 
                template_vr_form_queries_table_row_header
            );
            items_list_text += temp_text;

            vr_quote_date_form_query_body_area = '';
            if (vr_form_system_info['quote_date']) {
                vr_quote_date_form_query_body_area = replaceSubstringInText(
                    ['[FIELD_NAME]', '[FIELD_VALUE]'], 
                    ['vr_quote_date_form_query', vr_form_system_info['quote_date']], 
                    template_vr_quote_date_form_query_body
                );
            }

            vr_framework_type_form_query_area = initHtmlSelectBox(
                vr_framework_types_list, 
                'vr_framework_type_form_query', 
                [], 
                [], 
                'ref_name', 
                'display_name', 
                vr_form_queries_info['vr_framework_type'], 
                true
            );
            vr_framework_type_form_query_area = replaceSubstringInText(
                ['onchange=""'], 
                ['onchange="processVrFrameworkTypeFormQueries(1)"'], 
                vr_framework_type_form_query_area
            );

            vr_type_form_query_area = initHtmlSelectBox(
                vr_types_list, 
                'vr_type_form_query', 
                [], 
                [], 
                'ref_name', 
                'display_name', 
                vr_form_queries_info['vr_type'], 
                true
            );
            vr_type_form_query_area = replaceSubstringInText(
                ['onchange=""'], 
                ['onchange="processVrDimensionFormQueries(1)"'], 
                vr_type_form_query_area
            );

            vr_project_name_form_query_area = replaceSubstringInText(
                ['[FIELD_NAME]', '[FIELD_VALUE]'], 
                ['vr_project_name_form_query', vr_form_queries_info['vr_project_name']], 
                template_vr_form_inputbox
            );

            vr_default_colour_form_query_area = initHtmlSelectBox(
                vr_colours_list, 
                'vr_default_colour_form_query', 
                [], 
                [], 
                'ref_name', 
                'display_name', 
                vr_form_queries_info['vr_default_colour'], 
                true
            );
            vr_default_colour_form_query_area = replaceSubstringInText(
                ['onchange=""'], 
                ['onchange="setVrFormItemsDataEntryColourByDefaultValue()"'], 
                vr_default_colour_form_query_area
            );

            vr_run_form_query_body_area = '';
            vr_rise_form_query_body_area = '';
            if (vr_type_info['bay_roof_shape'] == 'gable') {
                vr_run_form_query_body_area = template_vr_run_form_query_body;
                vr_rise_form_query_body_area = template_vr_rise_form_query_body;
            }

            for (c1 = 0; c1 < parseInt(vr_type_info['number_of_bay']); c1++) {
                temp_text = replaceSubstringInText(
                    ['[INDEX_NUMBER]'], 
                    [c1], 
                    template_vr_length_form_query_body
                );
                vr_length_form_query_body_area += temp_text;
            }

            vr_width_form_query_body_area = template_vr_width_form_query_body;
            if (document.getElementById('vr_type_form_query').value == 'null' || 
                document.getElementById('vr_type_form_query').value == 'VR0') {
                vr_width_form_query_body_area = '';
            }

            temp_text = replaceSubstringInText(
                [
                    '[VR_QUOTE_DATE_FORM_QUERY_BODY_AREA]', 
                    '[VR_FRAMEWORK_TYPE_FORM_QUERY_AREA]', 
                    '[VR_TYPE_FORM_QUERY_AREA]', 
                    '[VR_PROJECT_NAME_FORM_QUERY_AREA]', 
                    '[VR_DEFAULT_COLOUR_FORM_QUERY_AREA]', 
                    '[VR_RUN_FORM_QUERY_BODY_AREA]',  
                    '[VR_RISE_FORM_QUERY_BODY_AREA]', 
                    '[VR_LENGTH_FORM_QUERY_BODY_AREA]', 
                    '[VR_WIDTH_FORM_QUERY_BODY_AREA]' 
                ], 
                [
                    vr_quote_date_form_query_body_area, 
                    vr_framework_type_form_query_area, 
                    vr_type_form_query_area, 
                    vr_project_name_form_query_area, 
                    vr_default_colour_form_query_area, 
                    vr_run_form_query_body_area, 
                    vr_rise_form_query_body_area,  
                    vr_length_form_query_body_area, 
                    vr_width_form_query_body_area 
                ], 
                template_vr_form_queries_table_row_body
            );
            items_list_text += temp_text;

            document.getElementById('vr_form_queries_table').innerHTML = items_list_text;
        }


        function processVrFrameworkTypeFormQueries(process_option) {
            var adhoc_criteria = {};
            var targeted_vr_section_ref_names = [];
            var targeted_vr_form_item_data_entry_indexes = [];
            var temp_vr_form_items_data_entry = [];
            var temp_vr_form_items_data_entry1 = [];
            var temp_vr_form_items_data_entry2 = [];
            var source_info_vr_form_items_data_entry = [];

            if (document.getElementById('vr_framework_type_form_query').value != 'null' && 
                document.getElementById('vr_type_form_query').value != 'null') {
                jsonDecodeVrFormItemsConfig();

                /* --- begin framework type == drop-in processing --- */
                if (document.getElementById('vr_framework_type_form_query').value == 'Drop-In') {
                    source_info_vr_form_items_data_entry = vr_form_items_data_entry;
                    adhoc_criteria = {
                        "target_fields":[
                            {"field_name":"vr_section_ref_name", "field_value":"Frame"}, 
                            {"field_name":"vr_section_ref_name", "field_value":"Fixings"} 
                        ]
                    };
                    targeted_vr_section_ref_names = ['Frame', 'Fixings'];
                    targeted_vr_form_item_data_entry_indexes = extractVrFormItemsIndexByAdhocCriteria(source_info_vr_form_items_data_entry, adhoc_criteria);
                    temp_vr_form_items_data_entry = extractVrFormItemsRowByAdhocCriteria(source_info_vr_form_items_data_entry, targeted_vr_section_ref_names, targeted_vr_form_item_data_entry_indexes, 'not_exist');
                    vr_form_items_data_entry = temp_vr_form_items_data_entry;
                }
                /* --- end framework type == drop-in processing --- */

                /* --- begin framework type == framework processing --- */
                if (document.getElementById('vr_framework_type_form_query').value == 'Framework') {
                    if (vr_form_items_data_entry[0]['vr_section_display_name'] != vr_item_config_list[document.getElementById('vr_type_form_query').value][0]['vr_section_display_name']) {
                        source_info_vr_form_items_data_entry = vr_item_config_list[document.getElementById('vr_type_form_query').value];
                        adhoc_criteria = {
                            "target_fields":[
                                {"field_name":"vr_section_ref_name", "field_value":"Frame"}, 
                                {"field_name":"vr_section_ref_name", "field_value":"Fixings"} 
                            ]
                        };
                        targeted_vr_section_ref_names = ['Frame', 'Fixings'];
                        targeted_vr_form_item_data_entry_indexes = extractVrFormItemsIndexByAdhocCriteria(source_info_vr_form_items_data_entry, adhoc_criteria);
                        temp_vr_form_items_data_entry1 = extractVrFormItemsRowByAdhocCriteria(source_info_vr_form_items_data_entry, targeted_vr_section_ref_names, targeted_vr_form_item_data_entry_indexes, 'exist');

                        source_info_vr_form_items_data_entry = vr_form_items_data_entry;
                        adhoc_criteria = {
                            "target_fields":[
                                {"field_name":"vr_section_ref_name", "field_value":"Frame"}, 
                                {"field_name":"vr_section_ref_name", "field_value":"Fixings"} 
                            ]
                        };
                        targeted_vr_section_ref_names = ['Frame', 'Fixings'];
                        targeted_vr_form_item_data_entry_indexes = extractVrFormItemsIndexByAdhocCriteria(source_info_vr_form_items_data_entry, adhoc_criteria);
                        temp_vr_form_items_data_entry2 = extractVrFormItemsRowByAdhocCriteria(source_info_vr_form_items_data_entry, targeted_vr_section_ref_names, targeted_vr_form_item_data_entry_indexes, 'not_exist');

                        var c1 = 0;
                        for (c1 = 0; c1 < temp_vr_form_items_data_entry1.length; c1++) {
                            temp_vr_form_items_data_entry[temp_vr_form_items_data_entry.length] = temp_vr_form_items_data_entry1[c1];
                        }
                        for (c1 = 0; c1 < temp_vr_form_items_data_entry2.length; c1++) {
                            temp_vr_form_items_data_entry[temp_vr_form_items_data_entry.length] = temp_vr_form_items_data_entry2[c1];
                        }

                        vr_form_items_data_entry = temp_vr_form_items_data_entry;
                    }
                }
                /* --- end framework type == framework processing --- */

                generateVrFormItemsDataEntry('form');
                hideFormArea('vr_form_queries_button_area_1');
                setTimeout(
                    function () {
                        calculateVrFormItemsDataEntryValues(process_option);
                    }, 
                    1000
                );

                switch (vr_form_system_info['access_mode']) {
                    case 'quote_add':
                        showFormArea('vr_form_billing_table_area');
                        showFormArea('vr_form_queries_button_area_21');
                        showFormArea('vr_form_queries_button_area_22');
                        break;
                    case 'quote_edit':
                        showFormArea('vr_form_billing_table_area');
                        showFormArea('vr_form_queries_button_area_31');
                        showFormArea('vr_form_queries_button_area_32');
                        break;
                }
            } else {
                document.getElementById('vr_form_items_data_entry_table').innerHTML = '';
                hideFormArea('vr_form_billing_table_area');
                showFormArea('vr_form_queries_button_area_1');
                hideFormArea('vr_form_queries_button_area_21');
                hideFormArea('vr_form_queries_button_area_22');
                hideFormArea('vr_form_queries_button_area_31');
                hideFormArea('vr_form_queries_button_area_32');
            }
        }


        function initInputElementsFormQueries() {
            initHtmlSelectBox(
                vr_framework_types_list, 
                'vr_framework_type_form_query', 
                [], 
                [], 
                'ref_name', 
                'display_name', 
                '', 
                false
            );

            initHtmlSelectBox(
                vr_types_list, 
                'vr_type_form_query', 
                [], 
                [], 
                'ref_name', 
                'display_name', 
                '', 
                false
            );

            initHtmlSelectBox(
                vr_colours_list, 
                'vr_default_colour_form_query', 
                [], 
                [], 
                'ref_name', 
                'display_name', 
                '', 
                false
            );
        }
