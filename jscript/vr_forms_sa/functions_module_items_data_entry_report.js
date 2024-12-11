        function getReportFromVrFormIntroInfo() {
            var c1 = 0;
            var c2 = 0;
            var temp_text = '';
            var items_list_text = '';
            var template_vr_form_intro_info = '' + 
                '<table width="100%" border="0">' + 
                '    <tr>' + 
                '        <td colspan="7" align="center"><h3>Vergola System Costing Summary</h3></td>' + 
                '    </tr>' + 
                '    <tr>' + 
                '        <td colspan="7" align="center"><br /></td>' + 
                '    </tr>' + 
                '    <tr>' + 
                '        <td class="text_field_title_name_11"><b>Client Name</b></td>' + 
                '        <td class="text_field_separator_11">[BLANK_SPACE]</td>' + 
                '        <td class="text_field_title_name_11"><b>Client No</b></td>' + 
                '        <td class="text_field_separator_11">[BLANK_SPACE]</td>' + 
                '        <td class="text_field_title_name_11"><b>Consultant</b></td>' + 
                '        <td class="text_field_separator_11">[BLANK_SPACE]</td>' + 
                '        <td class="text_field_title_name_11"><b>Date Quoted</b></td>' + 
                '    </tr>' + 
                '    <tr>' + 
                '        <td class="text_field_value_11">[VR_FORM_INTRO_CLIENT_NAME_AREA]</td>' + 
                '        <td class="text_field_separator_11">[BLANK_SPACE]</td>' + 
                '        <td class="text_field_value_11">[VR_FORM_INTRO_CLIENT_NUMBER_AREA]</td>' + 
                '        <td class="text_field_separator_11">[BLANK_SPACE]</td>' + 
                '        <td class="text_field_value_11">[VR_FORM_INTRO_CONSULTANT_AREA]</td>' + 
                '        <td class="text_field_separator_11">[BLANK_SPACE]</td>' + 
                '        <td class="text_field_value_11">[VR_FORM_INTRO_DATE_QUOTED_AREA]</td>' + 
                '    </tr>' + 
                '</table>' + 
                '<br />';

            temp_text = replaceSubstringInText(
                [
                    '[VR_FORM_INTRO_CLIENT_NAME_AREA]', '[VR_FORM_INTRO_CLIENT_NUMBER_AREA]', 
                    '[VR_FORM_INTRO_CONSULTANT_AREA]', '[VR_FORM_INTRO_DATE_QUOTED_AREA]'
                ], 
                [
                    vr_form_system_info['client_name'], vr_form_system_info['quote_id'], 
                    vr_form_system_info['sales_rep_name'], vr_form_system_info['quote_date']
                ], 
                template_vr_form_intro_info
            );
            items_list_text += temp_text;

            return items_list_text;
        }


        function getReportFromVrFormQueriesInfo() {
            var c1 = 0;
            var c2 = 0;
            var temp_text = '';
            var items_list_text = '';
            var template_vr_form_queries_info = '' + 
                '<table width="100%" border="0">' + 
                '    <tr>' + 
                '        <td class="text_field_title_name_21"><b>Project Name</b></td>' + 
                '        <td class="text_field_separator_21">[BLANK_SPACE]</td>' + 
                '        <td class="text_field_title_name_21"><b>Framework Type</b></td>' + 
                '        <td class="text_field_separator_21">[BLANK_SPACE]</td>' + 
                '        <td class="text_field_title_name_21"><b>VR Type</b></td>' + 
                '        <td class="text_field_separator_21">[BLANK_SPACE]</td>' + 
                '        [VR_RUN_FORM_QUERY_HEADER_AREA]' + 
                '        [VR_RISE_FORM_QUERY_HEADER_AREA]' + 
                '        [VR_LENGTH_FORM_QUERY_HEADER_AREA]' + 
                '        [VR_WIDTH_FORM_QUERY_HEADER_AREA]' + 
                '    </tr>' + 
                '    <tr>' + 
                '        <td class="text_field_value_21">[VR_PROJECT_NAME_FORM_QUERY_AREA]</td>' + 
                '        <td class="text_field_separator_21">[BLANK_SPACE]</td>' + 
                '        <td class="text_field_value_21">[VR_FRAMEWORK_TYPE_FORM_QUERY_AREA]</td>' + 
                '        <td class="text_field_separator_21">[BLANK_SPACE]</td>' + 
                '        <td class="text_field_value_21">[VR_TYPE_FORM_QUERY_AREA]</td>' + 
                '        <td class="text_field_separator_21">[BLANK_SPACE]</td>' + 
                '        [VR_RUN_FORM_QUERY_BODY_AREA]' + 
                '        [VR_RISE_FORM_QUERY_BODY_AREA]' + 
                '        [VR_LENGTH_FORM_QUERY_BODY_AREA]' + 
                '        [VR_WIDTH_FORM_QUERY_BODY_AREA]' + 
                '    </tr>' + 
                '</table>' + 
                '<br />';
            var template_vr_length_form_query_header = '<td class="text_field_title_name_22"><b>Length [INDEX_NUMBER]</b></td>';
            var template_vr_width_form_query_header = '<td class="text_field_title_name_22"><b>Width</b></td>';
            var template_vr_run_form_query_header = '<td class="text_field_title_name_22"><b>Run</b></td>';
            var template_vr_rise_form_query_header = '<td class="text_field_title_name_22"><b>Rise</b></td>';
            var template_vr_length_form_query_body = '<td class="text_field_value_22">[LENGTH_VALUE]</td>';
            var template_vr_width_form_query_body = '<td class="text_field_value_22">[WIDTH_VALUE]</td>';
            var template_vr_run_form_query_body = '<td class="text_field_value_22">[RUN_VALUE]</td>';
            var template_vr_rise_form_query_body = '<td class="text_field_value_22">[RISE_VALUE]</td>';

            var vr_type_info = getVrTypeInfo();
            var vr_run_form_query_header_area = '';
            var vr_rise_form_query_header_area = '';
            var vr_length_form_query_header_area = '';
            var vr_width_form_query_header_area = '';
            var vr_framework_type_form_query_area = '';
            var vr_type_form_query_area = '';
            var vr_project_name_form_query_area = '';
            var vr_run_form_query_body_area = '';
            var vr_rise_form_query_body_area = '';
            var vr_length_form_query_body_area = '';
            var vr_width_form_query_body_area = '';

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
                vr_length_form_query_header_area += temp_text;
            }
            vr_width_form_query_header_area = template_vr_width_form_query_header;
            if (document.getElementById('vr_type_form_query').value == 'null' || 
                document.getElementById('vr_type_form_query').value == 'VR0') {
                vr_width_form_query_header_area = '';
            }

            vr_framework_type_form_query_area = document.getElementById('vr_framework_type_form_query').options[document.getElementById('vr_framework_type_form_query').selectedIndex].text;
            vr_type_form_query_area = document.getElementById('vr_type_form_query').options[document.getElementById('vr_type_form_query').selectedIndex].text;
            vr_project_name_form_query_area = document.getElementById('vr_project_name_form_query').value;

            if (vr_type_info['bay_roof_shape'] == 'gable') {
                temp_text = replaceSubstringInText(
                    ['[RUN_VALUE]'], 
                    [document.getElementById('vr_run_meter_form_query').value], 
                    template_vr_run_form_query_body
                );
                vr_run_form_query_body_area = temp_text;
                if (document.getElementById('vr_type_form_query').value == 'null') {
                    vr_run_form_query_body_area = '';
                }

                temp_text = replaceSubstringInText(
                    ['[RISE_VALUE]'], 
                    [document.getElementById('vr_rise_meter_form_query').value], 
                    template_vr_rise_form_query_body
                );
                vr_rise_form_query_body_area = temp_text;
                if (document.getElementById('vr_type_form_query').value == 'null') {
                    vr_rise_form_query_body_area = '';
                }
            }
            for (c1 = 0; c1 < parseInt(vr_type_info['number_of_bay']); c1++) {
                temp_text = replaceSubstringInText(
                    ['[LENGTH_VALUE]'], 
                    [document.getElementById('vr_length_meter_form_query_' + c1).value], 
                    template_vr_length_form_query_body
                );
                vr_length_form_query_body_area += temp_text;
            }
            if (document.getElementById('vr_type_form_query').value == 'null') {
                vr_length_form_query_body_area = '';
            }

            if (document.getElementById('vr_width_meter_form_query')) {
                temp_text = replaceSubstringInText(
                    ['[WIDTH_VALUE]'], 
                    [document.getElementById('vr_width_meter_form_query').value], 
                    template_vr_width_form_query_body
                );
                vr_width_form_query_body_area = temp_text;
            }
            if (document.getElementById('vr_type_form_query').value == 'null' || 
                document.getElementById('vr_type_form_query').value == 'VR0') {
                vr_width_form_query_body_area = '';
            }

            temp_text = replaceSubstringInText(
                [
                    '[VR_RUN_FORM_QUERY_HEADER_AREA]', '[VR_RISE_FORM_QUERY_HEADER_AREA]', 
                    '[VR_LENGTH_FORM_QUERY_HEADER_AREA]', '[VR_WIDTH_FORM_QUERY_HEADER_AREA]', 
                    '[VR_FRAMEWORK_TYPE_FORM_QUERY_AREA]', '[VR_TYPE_FORM_QUERY_AREA]', 
                    '[VR_PROJECT_NAME_FORM_QUERY_AREA]', 
                    '[VR_RUN_FORM_QUERY_BODY_AREA]', '[VR_RISE_FORM_QUERY_BODY_AREA]', 
                    '[VR_LENGTH_FORM_QUERY_BODY_AREA]', '[VR_WIDTH_FORM_QUERY_BODY_AREA]'
                ], 
                [
                    vr_run_form_query_header_area, vr_rise_form_query_header_area, 
                    vr_length_form_query_header_area, vr_width_form_query_header_area, 
                    vr_framework_type_form_query_area, vr_type_form_query_area, 
                    vr_project_name_form_query_area, 
                    vr_run_form_query_body_area, vr_rise_form_query_body_area, 
                    vr_length_form_query_body_area, vr_width_form_query_body_area 
                ], 
                template_vr_form_queries_info
            );
            items_list_text += temp_text;

            return items_list_text;
        }


        function getReportFromVrFormBillingInfo() {
            var c1 = 0;
            var c2 = 0;
            var temp_text = '';
            var items_list_text = '';
            var template_vr_form_billing_info = '' + 
                '<table width="100%" border="0">' + 
                '    <tr>' + 
                '        <td colspan="3" class="text_field_title_name_41"><b>Commission</b></td>' + 
                '        <td class="text_field_separator_41">[BLANK_SPACE]</td>' + 
                '        <td colspan="3" class="text_field_title_name_41"><b>Payment</b></td>' + 
                '        <td class="text_field_separator_41">[BLANK_SPACE]</td>' + 
                '        <td colspan="3" class="text_field_title_name_41"><b>Total</b></td>' + 
                '    </tr>' + 
                '    <tr>' + 
                '        <td class="text_field_name_41"><u>Sales Commission</u></td>' + 
                '        <td class="text_field_separator_41">$</td>' + 
                '        <td class="text_field_value_41"><b>[VR_COMMISSION_SALES_COMMISSION_FORM_BILLING_AREA]</b></td>' + 
                '        <td class="text_field_separator_41">[BLANK_SPACE]</td>' + 
                '        <td class="text_field_name_41">Deposit</td>' + 
                '        <td class="text_field_separator_41">$</td>' + 
                '        <td class="text_field_value_41">[VR_PAYMENT_DEPOSIT_FORM_BILLING_AREA]</td>' + 
                '        <td class="text_field_separator_41">[BLANK_SPACE]</td>' + 
                '        <td class="text_field_name_41">Vergola</td>' + 
                '        <td class="text_field_separator_41">$</td>' + 
                '        <td class="text_field_value_41">[VR_PAYMENT_VERGOLA_FORM_BILLING_AREA]</td>' + 
                '    </tr>' + 
                '    <tr>' + 
                '        <td colspan="3" class="text_field_title_name_41">[BLANK_SPACE]</td>' + 
                '        <td class="text_field_separator_41">[BLANK_SPACE]</td>' + 
                '        <td class="text_field_name_41">Progress Payment</td>' + 
                '        <td class="text_field_separator_41">$</td>' + 
                '        <td class="text_field_value_41">[VR_PAYMENT_PROGRESS_PAYMENT_FORM_BILLING_AREA]</td>' + 
                '        <td class="text_field_separator_41">[BLANK_SPACE]</td>' + 
                '        <td class="text_field_name_41">Disbursement Sub Total</td>' + 
                '        <td class="text_field_separator_41">$</td>' + 
                '        <td class="text_field_value_41"><u>[VR_PAYMENT_DISBURSEMENT_SUB_TOTAL_FORM_BILLING_AREA]</u></td>' + 
                '    </tr>' + 
                '    <tr>' + 
                '        <td colspan="3" class="text_field_title_name_41"><b>Sales Commission Payment Schedule</b></td>' + 
                '        <td class="text_field_separator_41">[BLANK_SPACE]</td>' + 
                '        <td class="text_field_name_41">Final Payment</td>' + 
                '        <td class="text_field_separator_41">$</td>' + 
                '        <td class="text_field_value_41">[VR_PAYMENT_FINAL_PAYMENT_FORM_BILLING_AREA]</td>' + 
                '        <td class="text_field_separator_41">[BLANK_SPACE]</td>' + 
                '        <td class="text_field_name_41">Sub Total</td>' + 
                '        <td class="text_field_separator_41">$</td>' + 
                '        <td class="text_field_value_41">[VR_PAYMENT_SUB_TOTAL_FORM_BILLING_AREA]</td>' + 
                '    </tr>' + 
                '    <tr>' + 
                '        <td class="text_field_name_41">Pay 1</td>' + 
                '        <td class="text_field_separator_41">$</td>' + 
                '        <td class="text_field_value_41">[VR_COMMISSION_PAY1_FORM_BILLING_AREA]</td>' + 
                '        <td class="text_field_separator_41">[BLANK_SPACE]</td>' + 
                '        <td colspan="3" class="text_field_title_name_41">[BLANK_SPACE]</td>' + 
                '        <td class="text_field_separator_41">[BLANK_SPACE]</td>' + 
                '        <td class="text_field_name_41"></td>' + 
                '        <td class="text_field_separator_41">$</td>' + 
                '        <td class="text_field_value_41"><u>[VR_PAYMENT_TAX_FORM_BILLING_AREA]</u></td>' + 
                '    </tr>' + 
                '    <tr>' + 
                '        <td class="text_field_name_41">Pay 2</td>' + 
                '        <td class="text_field_separator_41">$</td>' + 
                '        <td class="text_field_value_41">[VR_COMMISSION_PAY2_FORM_BILLING_AREA]</td>' + 
                '        <td class="text_field_separator_41">[BLANK_SPACE]</td>' + 
                '        <td colspan="3" class="text_field_title_name_41">[BLANK_SPACE]</td>' + 
                '        <td class="text_field_separator_41">[BLANK_SPACE]</td>' + 
                '        <td class="text_field_name_41"><u>Total</u></td>' + 
                '        <td class="text_field_separator_41">$</td>' + 
                '        <td class="text_field_value_41"><u>[VR_PAYMENT_TOTAL_FORM_BILLING_AREA]</u></td>' + 
                '    </tr>' + 
                '    <tr>' + 
                '        <td class="text_field_name_41">Final</td>' + 
                '        <td class="text_field_separator_41">$</td>' + 
                '        <td class="text_field_value_41">[VR_COMMISSION_FINAL_FORM_BILLING_AREA]</td>' + 
                '        <td class="text_field_separator_41">[BLANK_SPACE]</td>' + 
                '        <td colspan="3" class="text_field_title_name_41">[BLANK_SPACE]</td>' + 
                '        <td class="text_field_separator_41">[BLANK_SPACE]</td>' + 
                '        <td colspan="3" class="text_field_title_name_41">[BLANK_SPACE]</td>' + 
                '    </tr>' + 
                '    <tr>' + 
                '        <td class="text_field_name_41"><u>Installer Payment</u></td>' + 
                '        <td class="text_field_separator_41">$</td>' + 
                '        <td class="text_field_value_41"><b>[VR_COMMISSION_INSTALLER_PAYMENT_FORM_BILLING_AREA]</b></td>' + 
                '        <td class="text_field_separator_41">[BLANK_SPACE]</td>' + 
                '        <td colspan="3" class="text_field_title_name_41">[BLANK_SPACE]</td>' + 
                '        <td class="text_field_separator_41">[BLANK_SPACE]</td>' + 
                '        <td colspan="3" class="text_field_title_name_41">[BLANK_SPACE]</td>' + 
                '    </tr>' + 
                '</table>' + 
                '<br />';

            temp_text = replaceSubstringInText(
                [
                    '[VR_COMMISSION_SALES_COMMISSION_FORM_BILLING_AREA]', 
                    '[VR_COMMISSION_PAY1_FORM_BILLING_AREA]', 
                    '[VR_COMMISSION_PAY2_FORM_BILLING_AREA]', 
                    '[VR_COMMISSION_FINAL_FORM_BILLING_AREA]', 
                    '[VR_COMMISSION_INSTALLER_PAYMENT_FORM_BILLING_AREA]', 
                    '[VR_PAYMENT_DEPOSIT_FORM_BILLING_AREA]', 
                    '[VR_PAYMENT_PROGRESS_PAYMENT_FORM_BILLING_AREA]', 
                    '[VR_PAYMENT_FINAL_PAYMENT_FORM_BILLING_AREA]', 
                    '[VR_PAYMENT_VERGOLA_FORM_BILLING_AREA]', 
                    '[VR_PAYMENT_DISBURSEMENT_SUB_TOTAL_FORM_BILLING_AREA]', 
                    '[VR_PAYMENT_SUB_TOTAL_FORM_BILLING_AREA]', 
                    '[VR_PAYMENT_TAX_FORM_BILLING_AREA]', 
                    '[VR_PAYMENT_TOTAL_FORM_BILLING_AREA]'
                ], 
                [
                    formatOutputValue('float', vr_form_billing_info['vr_commission_sales_commission']), 
                    formatOutputValue('float', vr_form_billing_info['vr_commission_pay1']), 
                    formatOutputValue('float', vr_form_billing_info['vr_commission_pay2']), 
                    formatOutputValue('float', vr_form_billing_info['vr_commission_final']), 
                    formatOutputValue('float', vr_form_billing_info['vr_commission_installer_payment']), 
                    formatOutputValue('float', vr_form_billing_info['vr_payment_deposit']), 
                    formatOutputValue('float', vr_form_billing_info['vr_payment_progress_payment']), 
                    formatOutputValue('float', vr_form_billing_info['vr_payment_final_payment']), 
                    formatOutputValue('float', vr_form_billing_info['vr_payment_vergola']), 
                    formatOutputValue('float', vr_form_billing_info['vr_payment_disbursement_sub_total']), 
                    formatOutputValue('float', vr_form_billing_info['vr_payment_sub_total']), 
                    formatOutputValue('float', vr_form_billing_info['vr_payment_tax']), 
                    formatOutputValue('float', vr_form_billing_info['vr_payment_total'])
                ], 
                template_vr_form_billing_info
            );
            items_list_text += temp_text;

            return items_list_text;
        }


        function getReportFromVrFormAllInfo() {
            var template_vr_form_all_info = '';
            var report_css_1 = `
                <style>
                    .text_field_title_name_11 {
                        width: 140px;
                        border: 1px solid #cccccc;
                        vertical-align: top;
                        padding: 4px;
                        text-align: left;
                        font-size: 9pt;
                        font-family: Arial, Helvetica, sans-serif;
                        font-weight: bold;
                    }
                    .text_field_separator_11 {
                        width: 20px;
                        border: 1px solid #cccccc;
                        vertical-align: top;
                        padding: 4px;
                        text-align: left;
                        font-size: 9pt;
                        font-family: Arial, Helvetica, sans-serif;
                    }
                    .text_field_value_11 {
                        width: 140px;
                        border: 1px solid #cccccc;
                        vertical-align: top;
                        padding: 4px;
                        text-align: left;
                        font-size: 9pt;
                        font-family: Arial, Helvetica, sans-serif;
                    }

                    .text_field_title_name_21 {
                        width: 105px;
                        border: 1px solid #cccccc;
                        vertical-align: top;
                        padding: 4px;
                        text-align: left;
                        font-size: 9pt;
                        font-family: Arial, Helvetica, sans-serif;
                        font-weight: bold;
                    }
                    .text_field_title_name_22 {
                        border: 1px solid #cccccc;
                        vertical-align: top;
                        padding: 4px;
                        text-align: left;
                        font-size: 9pt;
                        font-family: Arial, Helvetica, sans-serif;
                        font-weight: bold;
                    }
                    .text_field_separator_21 {
                        width: 20px;
                        border: 1px solid #cccccc;
                        vertical-align: top;
                        padding: 4px;
                        text-align: left;
                        font-size: 9pt;
                        font-family: Arial, Helvetica, sans-serif;
                    }
                    .text_field_value_21 {
                        width: 105px;
                        border: 1px solid #cccccc;
                        vertical-align: top;
                        padding: 4px;
                        text-align: left;
                        font-size: 9pt;
                        font-family: Arial, Helvetica, sans-serif;
                    }
                    .text_field_value_22 {
                        border: 1px solid #cccccc;
                        vertical-align: top;
                        padding: 4px;
                        text-align: left;
                        font-size: 9pt;
                        font-family: Arial, Helvetica, sans-serif;
                    }

                    .text_field_title_name_41 {
                        width: 195px;
                        border: 1px solid #cccccc;
                        vertical-align: top;
                        padding: 4px;
                        text-align: left;
                        font-size: 9pt;
                        font-family: Arial, Helvetica, sans-serif;
                        font-weight: bold;
                    }
                    .text_field_name_41 {
                        width: 120px;
                        border: 1px solid #cccccc;
                        vertical-align: top;
                        padding: 4px;
                        text-align: left;
                        font-size: 9pt;
                        font-family: Arial, Helvetica, sans-serif;
                    }
                    .text_field_separator_41 {
                        width: 15px;
                        border: 1px solid #cccccc;
                        vertical-align: top;
                        padding: 4px;
                        text-align: left;
                        font-size: 9pt;
                        font-family: Arial, Helvetica, sans-serif;
                    }
                    .text_field_value_41 {
                        width: 60px;
                        border: 1px solid #cccccc;
                        vertical-align: top;
                        padding: 4px;
                        text-align: right;
                        font-size: 9pt;
                        font-family: Arial, Helvetica, sans-serif;
                    }

                    .vr_table_head_1 {
                        border: 1px solid #cccccc;
                        font-weight: bold;
                    }
                    .vr_table_body_1 {
                        border: 1px solid #cccccc;
                    }
                    .vr_table_head_2 {
                        border: 1px solid #cccccc;
                        color: #4D4D4D;
                        background-color: #EEEEEE;
                        padding: 4px;
                        text-align: left;
                        font-size: 9pt;
                        font-family: Arial, Helvetica, sans-serif;
                        font-weight: bold;
                    }
                    .vr_form_field_description_2 {
                        width: 200px;
                        vertical-align: top;
                        padding: 4px;
                        text-align: left;
                        font-size: 9pt;
                        font-family: Arial, Helvetica, sans-serif;
                    }
                    .vr_form_field_webbing_2 {
                        width: 60px;
                        vertical-align: top;
                        padding: 4px;
                        text-align: left;
                        font-size: 9pt;
                        font-family: Arial, Helvetica, sans-serif;
                    }
                    .vr_form_field_colour_1 {
                        width: 70px;
                        vertical-align: top;
                        padding: 4px;
                        text-align: left;
                        font-size: 9pt;
                        font-family: Arial, Helvetica, sans-serif;
                    }
                    .vr_form_field_finish_1 {
                        width: 70px;
                        vertical-align: top;
                        padding: 4px;
                        text-align: left;
                        font-size: 9pt;
                        font-family: Arial, Helvetica, sans-serif;
                    }
                    .vr_form_field_uom_2 {
                        width: 40px;
                        vertical-align: top;
                        padding: 4px;
                        text-align: left;
                        font-size: 9pt;
                        font-family: Arial, Helvetica, sans-serif;
                    }
                    .vr_form_field_qty_2 {
                        width: 50px;
                        vertical-align: top;
                        padding: 4px;
                        text-align: right;
                        font-size: 9pt;
                        font-family: Arial, Helvetica, sans-serif;
                    }
                    .vr_form_field_length_2 {
                        width: 75px;
                        vertical-align: top;
                        padding: 4px;
                        text-align: right;
                        font-size: 9pt;
                        font-family: Arial, Helvetica, sans-serif;
                    }
                    .vr_form_field_rrp_2 {
                        width: 65px;
                        vertical-align: top;
                        padding: 4px;
                        text-align: right;
                        font-size: 9pt;
                        font-family: Arial, Helvetica, sans-serif;
                    }
                </style>
            `;
            var report_text = generateVrFormItemsDataEntry('report');
            var temp_text = '';
            var replace_text_list = [
                {"search_text":"vr_form_field_description_1", "replace_text":"vr_form_field_description_2"}, 
                {"search_text":"vr_form_field_webbing_1", "replace_text":"vr_form_field_webbing_2"}, 
                {"search_text":"vr_form_field_uom_1", "replace_text":"vr_form_field_uom_2"}, 
                {"search_text":"vr_form_field_qty_1", "replace_text":"vr_form_field_qty_2"}, 
                {"search_text":"vr_form_field_length_1", "replace_text":"vr_form_field_length_2"}, 
                {"search_text":"vr_form_field_rrp_1", "replace_text":"vr_form_field_rrp_2"}, 
                {"search_text":"null", "replace_text":""}
            ];
            var c1 = 0;
            for (c1 = 0; c1 < replace_text_list.length; c1++) {
                while (report_text.indexOf(replace_text_list[c1]['search_text']) != -1) {
                    temp_text = report_text.replace(replace_text_list[c1]['search_text'], replace_text_list[c1]['replace_text']);
                    report_text = temp_text;
                }
            }

            template_vr_form_all_info += report_css_1;
            template_vr_form_all_info += '<div style="font-family:Arial, Helvetica, sans-serif; width:700px;  font-size: 10pt;">';
            template_vr_form_all_info += getReportFromVrFormIntroInfo();
            template_vr_form_all_info += getReportFromVrFormQueriesInfo();
            template_vr_form_all_info += report_text;
            template_vr_form_all_info += getReportFromVrFormBillingInfo();
            template_vr_form_all_info += '</div>';

            // document.getElementById('vr_form_log_area').style.display = 'block';
            document.getElementById('vr_form_log_area').innerHTML = template_vr_form_all_info;

            return template_vr_form_all_info;
        }
