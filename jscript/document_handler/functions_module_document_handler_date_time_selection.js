        function assignDateTimeSelectionResultToField() {
            var selected_date_time = '';
            var temp_text = '';

            temp_text = document.getElementById('document_handler_form_date_time_selection_year').value;
            selected_date_time += '0'.repeat(4 - temp_text.length) + temp_text;
            selected_date_time += '-';

            temp_text = document.getElementById('document_handler_form_date_time_selection_month').value;
            selected_date_time += '0'.repeat(2 - temp_text.length) + temp_text;
            selected_date_time += '-';

            temp_text = document.getElementById('document_handler_form_date_time_selection_day').value;
            selected_date_time += '0'.repeat(2 - temp_text.length) + temp_text;
            selected_date_time += ' ';

            temp_text = document.getElementById('document_handler_form_date_time_selection_hour').value;
            selected_date_time += '0'.repeat(2 - temp_text.length) + temp_text;
            selected_date_time += ':';

            temp_text = document.getElementById('document_handler_form_date_time_selection_minute').value;
            selected_date_time += '0'.repeat(2 - temp_text.length) + temp_text;
            selected_date_time += ':';

            temp_text = document.getElementById('document_handler_form_date_time_selection_second').value;
            selected_date_time += '0'.repeat(2 - temp_text.length) + temp_text;

            switch (document_handler_form_current_date_time_selection_target) {
                case 'contact_date_received':
                    document.getElementById('document_handler_form_file_date_received').value = selected_date_time;
                    break;
                case 'contact_date_sent':
                    document.getElementById('document_handler_form_file_date_sent').value = selected_date_time;
                    break;
                case 'contact_content_date':
                    document.getElementById('document_handler_form_file_content_date').value = selected_date_time;
                    break;
            }
        }



        function closeDateTimeSelectionForm() {
            assignDateTimeSelectionResultToField();
            document.getElementById('document_handler_form_date_time_selection_area').style.display = 'none';
        }




        function initInputElementsFormDateTimeSelection(date_time_selection_target) {
            var selected_date_time = '';
            var date_time_info = JSON.parse(
                '{' + 
                    '"selected_date_object":{}, ' + 
                    '"selected_time_object":{}, ' + 
                    '"date_list":{}, ' + 
                    '"time_list":{}' + 
                '}'
            );
            var selected_date_object = {};
            var selected_time_object = {};
            var date_list = {};
            var time_list = {};
            var k1 = '';

            switch (date_time_selection_target) {
                case 'contact_date_received':
                    selected_date_time = document.getElementById('document_handler_form_file_date_received').value;
                    break;
                case 'contact_date_sent':
                    selected_date_time = document.getElementById('document_handler_form_file_date_sent').value;
                    break;
                case 'contact_content_date':
                    selected_date_time = document.getElementById('document_handler_form_file_content_date').value;
                    break;
            }

            date_time_info = getDateTimeInfo(selected_date_time);

            selected_date_object = date_time_info['selected_date_object'];
            selected_time_object = date_time_info['selected_time_object'];
            date_list = date_time_info['date_list'];
            time_list = date_time_info['time_list'];

            for (k1 in date_list) {
                initHtmlSelectBox(
                    date_list[k1], 
                    'document_handler_form_selectbox_1', 
                    'document_handler_form_date_time_selection_' + k1, 
                    [], 
                    [], 
                    'id', 
                    'value', 
                    selected_date_object[k1], 
                    false
                );
            }

            for (k1 in time_list) {
                initHtmlSelectBox(
                    time_list[k1], 
                    'document_handler_form_selectbox_1', 
                    'document_handler_form_date_time_selection_' + k1, 
                    [], 
                    [], 
                    'id', 
                    'value', 
                    selected_time_object[k1], 
                    false
                );
            }

            document_handler_form_current_date_time_selection_target = date_time_selection_target;
            document.getElementById('document_handler_form_date_time_selection_area').style.display = 'block';
            document.getElementById('document_handler_form_date_time_selection_year').focus();
        }
