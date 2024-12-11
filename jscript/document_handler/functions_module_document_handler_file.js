        function refreshEntityFilePropertiesToFields() {
            var previousSelectedValueFromEntityFolderList = document.getElementById('document_handler_form_entity_folder_list').value;
            var previousSelectedValueFromFolderFileList = document.getElementById('document_handler_form_folder_file_list').value;

            processEntityFolderSelectionChange();
            document.getElementById('document_handler_form_entity_folder_list').value = previousSelectedValueFromEntityFolderList;

            /*
            processEntityFileSelectionChange();
            document.getElementById('document_handler_form_folder_file_list').value = previousSelectedValueFromFolderFileList;
            */
            if (document.getElementById('document_handler_form_file_id').value == '') {
                processEntityFileSelectionChange();
                document.getElementById('document_handler_form_folder_file_list').value = previousSelectedValueFromFolderFileList;
            }
        }


        function assignEntityFilePropertiesToFields() {
            var data_list = document_handler_form_folder_file_list;
            var search_ref_names = ['file_id'];
            var search_values = [document.getElementById('document_handler_form_folder_file_list').value];
            var data_rows = getDataRowsFromDataList(data_list, search_ref_names, search_values);
            var c1 = 0;
            var c2 = 0;
            var file_folder_link_count = 0;
            var current_attach_list = [];

            if (data_rows.length > 0) {
                for (c1 = 0; c1 < data_rows[0]['file_folder_entity_list'].length; c1++) {
                    current_attach_list[current_attach_list.length] = {"entity_id":data_rows[0]['file_folder_entity_list'][c1]['entity_name'], "entity_info":data_rows[0]['file_folder_entity_list'][c1]['entity_description']};
                }
                document_handler_form_current_entity_search_attach_list = current_attach_list;

                initHtmlDivSelectBox2(
                    document_handler_form_current_entity_search_attach_list, 
                    'document_handler_form_divselect_1',
                    'document_handler_form_checkbox_1',
                    'document_handler_form_entity_attach_divselectbox', 
                    'document_handler_form_entity_attach_link', 
                    [], 
                    [], 
                    'entity_id', 
                    'entity_info', 
                    '', 
                    'document_handler_form_entity_attach_link_count', 
                    false
                );

                document.getElementById('document_handler_form_document_category').value = document.getElementById('document_handler_form_entity_folder_list').options[document.getElementById('document_handler_form_entity_folder_list').selectedIndex].text;
                document.getElementById('document_handler_form_current_entity_name').value = document.getElementById('document_handler_form_entity_list').options[document.getElementById('document_handler_form_entity_list').selectedIndex].text;
                document.getElementById('document_handler_form_current_entity_id').value = document.getElementById('document_handler_form_entity_list').value;
                document.getElementById('document_handler_form_current_folder_name').value = document.getElementById('document_handler_form_entity_folder_list').options[document.getElementById('document_handler_form_entity_folder_list').selectedIndex].text;
                document.getElementById('document_handler_form_current_folder_id').value = document.getElementById('document_handler_form_entity_folder_list').value;

                document.getElementById('document_handler_form_file_id').value = data_rows[0]['file_id'];
                document.getElementById('document_handler_form_file_name').value = data_rows[0]['file_name']; /* data_rows[0]['folder_name']; */
                document.getElementById('document_handler_form_file_description').value = data_rows[0]['file_description'];
                document.getElementById('document_handler_form_file_summary').value = data_rows[0]['file_summary'];
                document.getElementById('document_handler_form_file_from').value = data_rows[0]['file_from'];
                document.getElementById('document_handler_form_file_date_received').value = data_rows[0]['file_date_received'];
                document.getElementById('document_handler_form_file_to').value = data_rows[0]['file_to'];
                document.getElementById('document_handler_form_file_date_sent').value = data_rows[0]['file_date_sent'];
                document.getElementById('document_handler_form_file_original_name').value = data_rows[0]['file_original_name'];
                document.getElementById('document_handler_form_file_extension').value = data_rows[0]['file_extension'];
                document.getElementById('document_handler_form_file_type').value = data_rows[0]['file_type'];
                document.getElementById('document_handler_form_file_size').value = data_rows[0]['file_size'];
                document.getElementById('document_handler_form_file_external_ref_name').value = data_rows[0]['file_external_ref_name'];
                document.getElementById('document_handler_form_file_content_date').value = data_rows[0]['file_content_date'];
                document.getElementById('document_handler_form_file_content_category').value = data_rows[0]['file_content_category'];
                document.getElementById('document_handler_form_file_date_created').value = data_rows[0]['file_date_created'];
                // document.getElementById('document_handler_form_file_folder_link_count').value = data_rows[0]['file_folder_list'].length;
                document.getElementById('document_handler_form_file_status').value = data_rows[0]['file_status'];
                if (document.getElementById('document_handler_form_file_status').value == 'null') {
                    document.getElementById('document_handler_form_file_status').value = 'Unpublished';
                }

                if (! isNaN(document.getElementById('document_handler_form_file_folder_link_count').value)) {
                    file_folder_link_count = parseInt(document.getElementById('document_handler_form_file_folder_link_count').value);
                }
                for (c1 = 0; c1 < file_folder_link_count; c1++) {
                    document.getElementById('document_handler_form_file_folder_link_' + (c1 + 1)).checked = false;
                    for (c2 = 0; c2 < data_rows[0]['file_folder_list'].length; c2++) {
                        if (data_rows[0]['file_folder_list'][c2]['folder_id'] == document.getElementById('document_handler_form_file_folder_link_' + (c1 + 1)).value) {
                            document.getElementById('document_handler_form_file_folder_link_' + (c1 + 1)).checked = true;
                        } 
                    }
                }

                initHtmlSelectBox(
                    data_rows[0]['file_version_list'], 
                    'document_handler_form_selectbox_1', 
                    'document_handler_form_file_version_list', 
                    [], 
                    [], 
                    'file_version_external_ref_name', 
                    'file_version_date_created', 
                    '', 
                    false
                );
            }
        }


        function clearFolderFilePropertiesToFields() {
            var c1 = 0;
            var file_folder_link_count = 0;

            document_handler_form_current_search_target = '';
            document_handler_form_current_entity_search_attach_list = [];
            document_handler_form_current_contact_from_search_attach_list = [];
            document_handler_form_current_contact_to_search_attach_list = [];

            document_handler_form_entity_search_list = [];
            document_handler_form_entity_search_keyword = '';

            document_handler_form_contact_from_search_list = [];
            document_handler_form_contact_from_search_keyword = '';

            document_handler_form_contact_to_search_list = [];
            document_handler_form_contact_to_search_keyword = '';

            document.getElementById('document_handler_form_folder_file_list').value = 'null';

            document.getElementById('document_handler_form_entity_attach_divselectbox').innerHTML = '';
            document.getElementById('document_handler_form_entity_attach_link_count').value = '0';

            document.getElementById('document_handler_form_document_category').value = 'null';
            document.getElementById('document_handler_form_current_entity_name').value = '';
            document.getElementById('document_handler_form_current_entity_id').value = '';
            document.getElementById('document_handler_form_current_folder_name').value = '';
            document.getElementById('document_handler_form_current_folder_id').value = '';
            document.getElementById('document_handler_form_new_entity_name').value = '';
            document.getElementById('document_handler_form_new_entity_id').value = '';
            document.getElementById('document_handler_form_new_folder_name').value = '';
            document.getElementById('document_handler_form_new_folder_id').value = '';

            document.getElementById('document_handler_form_file_id').value = '';
            document.getElementById('document_handler_form_file_info').value = '';
            document.getElementById('document_handler_form_file_name').value = '';
            document.getElementById('document_handler_form_file_description').value = '';
            document.getElementById('document_handler_form_file_summary').value = '';
            document.getElementById('document_handler_form_file_from').value = '';
            document.getElementById('document_handler_form_file_date_received').value = '';
            document.getElementById('document_handler_form_file_to').value = '';
            document.getElementById('document_handler_form_file_date_sent').value = '';
            document.getElementById('document_handler_form_file_original_name').value = '';
            document.getElementById('document_handler_form_file_extension').value = '';
            document.getElementById('document_handler_form_file_type').value = '';
            document.getElementById('document_handler_form_file_size').value = '';
            document.getElementById('document_handler_form_file_external_ref_name').value = '';
            document.getElementById('document_handler_form_file_content_date').value = '';
            document.getElementById('document_handler_form_file_content_category').value = 'null';
            document.getElementById('document_handler_form_file_date_created').value = '';
            document.getElementById('document_handler_form_file_status').value = 'Unpublished';

            if (! isNaN(document.getElementById('document_handler_form_file_folder_link_count').value)) {
                file_folder_link_count = parseInt(document.getElementById('document_handler_form_file_folder_link_count').value);
            }
            for (c1 = 0; c1 < file_folder_link_count; c1++) {
                document.getElementById('document_handler_form_file_folder_link_' + (c1 + 1)).checked = false;
            }

            document.getElementById('document_handler_form_file_version_list').value = ''

            document.getElementById('document_handler_form_file_name').focus();
        }


        function closeDocumentHandlerForm() {
            var url = document_handler_form_system_info['base_url'] + 'system-management-vic/template-listing-vic';
            if (document_handler_form_system_info['module'] == '') {
                url = document_handler_form_system_info['base_url'] + 'system-management-vic/folio-listing-vic';
            }
            window.location = url;
        }


        function processEntityFileSelectionChange() {
            assignEntityFilePropertiesToFields();
        }


        function copyDocumentHandlerFormFileDataEntryFormValue() {
            var c1 = 0;
            var file_folder_link_count = 0;
            var current_file_folder_link_index = 0;
            var temp_text = '';
            var total_file_folder_link_selected = 0;

            document_handler_form_file_data_entry['document_handler_form_current_entity_search_attach_list'] = document_handler_form_current_entity_search_attach_list;
            document_handler_form_file_data_entry['document_handler_form_document_category'] = document.getElementById('document_handler_form_document_category').value;
            document_handler_form_file_data_entry['document_handler_form_current_entity_name'] = document.getElementById('document_handler_form_current_entity_name').value;
            document_handler_form_file_data_entry['document_handler_form_current_entity_id'] = document.getElementById('document_handler_form_current_entity_id').value;
            document_handler_form_file_data_entry['document_handler_form_current_folder_name'] = document.getElementById('document_handler_form_current_folder_name').value;
            document_handler_form_file_data_entry['document_handler_form_current_folder_id'] = document.getElementById('document_handler_form_current_folder_id').value;
            document_handler_form_file_data_entry['document_handler_form_new_entity_name'] = document.getElementById('document_handler_form_entity_list').options[document.getElementById('document_handler_form_entity_list').selectedIndex].text;
            document_handler_form_file_data_entry['document_handler_form_new_entity_id'] = document.getElementById('document_handler_form_entity_list').value;
            document_handler_form_file_data_entry['document_handler_form_new_folder_name'] = document.getElementById('document_handler_form_entity_folder_list').options[document.getElementById('document_handler_form_entity_folder_list').selectedIndex].text;
            document_handler_form_file_data_entry['document_handler_form_new_folder_id'] = document.getElementById('document_handler_form_entity_folder_list').value;

            document_handler_form_file_data_entry['document_handler_form_file_id'] = document.getElementById('document_handler_form_file_id').value;

            document_handler_form_file_data_entry['document_handler_form_file_name'] = document.getElementById('document_handler_form_file_name').value;
            if (document.getElementById('document_handler_form_file_name').value.length > 0 && 
                document.getElementById('document_handler_form_folder_file_list').value == 'null') {
                document_handler_form_file_data_entry['document_handler_form_file_id'] = '';
            }

            document_handler_form_file_data_entry['document_handler_form_file_description'] = document.getElementById('document_handler_form_file_description').value;
            document_handler_form_file_data_entry['document_handler_form_file_summary'] = document.getElementById('document_handler_form_file_summary').value;
            document_handler_form_file_data_entry['document_handler_form_file_from'] = document.getElementById('document_handler_form_file_from').value;
            document_handler_form_file_data_entry['document_handler_form_file_date_received'] = document.getElementById('document_handler_form_file_date_received').value;
            document_handler_form_file_data_entry['document_handler_form_file_to'] = document.getElementById('document_handler_form_file_to').value;
            document_handler_form_file_data_entry['document_handler_form_file_date_sent'] = document.getElementById('document_handler_form_file_date_sent').value;
            document_handler_form_file_data_entry['document_handler_form_file_content_date'] = document.getElementById('document_handler_form_file_content_date').value;

            document_handler_form_file_data_entry['document_handler_form_file_content_category'] = document.getElementById('document_handler_form_file_content_category').value;
            if (default_content_category != 'null' && default_content_category != '') {
                document_handler_form_file_data_entry['document_handler_form_file_content_category'] = default_content_category;
            }

            document_handler_form_file_data_entry['document_handler_form_file_original_name'] = document.getElementById('document_handler_form_file_original_name').value;
            document_handler_form_file_data_entry['document_handler_form_file_extension'] = document.getElementById('document_handler_form_file_extension').value;
            document_handler_form_file_data_entry['document_handler_form_file_type'] = document.getElementById('document_handler_form_file_type').value;
            document_handler_form_file_data_entry['document_handler_form_file_size'] = document.getElementById('document_handler_form_file_size').value;
            document_handler_form_file_data_entry['document_handler_form_file_external_ref_name'] = document.getElementById('document_handler_form_file_external_ref_name').value;

            document_handler_form_file_data_entry['document_handler_form_file_status'] = document.getElementById('document_handler_form_file_status').value;
            if (document_handler_form_file_data_entry['document_handler_form_file_status'] == 'null') {
                document_handler_form_file_data_entry['document_handler_form_file_status'] = 'Unpublished';
            }

            document_handler_form_file_data_entry['document_handler_form_file_folder_links'] = [];

            if (! isNaN(document.getElementById('document_handler_form_file_folder_link_count').value)) {
                file_folder_link_count = parseInt(document.getElementById('document_handler_form_file_folder_link_count').value);
            }
            for (c1 = 0; c1 < file_folder_link_count; c1++) {
                if (document.getElementById('document_handler_form_file_folder_link_' + (c1 + 1)).checked) {
                    current_file_folder_link_index = document_handler_form_file_data_entry['document_handler_form_file_folder_links'].length;
                    document_handler_form_file_data_entry['document_handler_form_file_folder_links'][current_file_folder_link_index] = document.getElementById('document_handler_form_file_folder_link_' + (c1 + 1)).value;
                    total_file_folder_link_selected++;
                }
            }

            if (total_file_folder_link_selected == 0) {
                for (c1 = 0; c1 < file_folder_link_count; c1++) {
                    if (document.getElementById('document_handler_form_file_folder_link_' + (c1 + 1)).value == document.getElementById('document_handler_form_entity_folder_list').value) {
                        document.getElementById('document_handler_form_file_folder_link_' + (c1 + 1)).checked = true;
                        current_file_folder_link_index = document_handler_form_file_data_entry['document_handler_form_file_folder_links'].length;
                        document_handler_form_file_data_entry['document_handler_form_file_folder_links'][current_file_folder_link_index] = document.getElementById('document_handler_form_file_folder_link_' + (c1 + 1)).value;
                        break;
                    }
                }
            }

            if (document_handler_form_file_data_entry['document_handler_form_current_folder_id'] != document_handler_form_file_data_entry['document_handler_form_new_folder_id']) {
                document_handler_form_file_data_entry['document_handler_form_file_folder_links'] = [];
                for (c1 = 0; c1 < file_folder_link_count; c1++) {
                    document.getElementById('document_handler_form_file_folder_link_' + (c1 + 1)).checked = false;
                    if (document.getElementById('document_handler_form_file_folder_link_' + (c1 + 1)).value == document.getElementById('document_handler_form_entity_folder_list').value) {
                        document.getElementById('document_handler_form_file_folder_link_' + (c1 + 1)).checked = true;
                        current_file_folder_link_index = document_handler_form_file_data_entry['document_handler_form_file_folder_links'].length;
                        document_handler_form_file_data_entry['document_handler_form_file_folder_links'][current_file_folder_link_index] = document.getElementById('document_handler_form_file_folder_link_' + (c1 + 1)).value;
                        break;
                    }
                }
            }
        }


        function initInputElementsFormFolderFiles() {
            initHtmlSelectBox(
                document_categories_list, 
                'document_handler_form_selectbox_1', 
                'document_handler_form_document_category', 
                [], 
                [], 
                'ref_name', 
                'display_name', 
                '', 
                false
            );

            initHtmlSelectBox(
                content_categories_list, 
                'document_handler_form_selectbox_1', 
                'document_handler_form_file_content_category', 
                [], 
                [], 
                'ref_name', 
                'display_name', 
                'Document', 
                false
            );

            initHtmlSelectBox(
                document_file_statuses_list, 
                'document_handler_form_selectbox_1', 
                'document_handler_form_file_status', 
                [], 
                [], 
                'ref_name', 
                'display_name', 
                'Unpublished', 
                false
            );
        }
