        function refreshEntityFolderPropertiesToFields() {
            var previousSelectedValueFromEntityList = document.getElementById('document_handler_form_entity_list').value;

            processEntitySelectionChange();
            document.getElementById('document_handler_form_entity_list').value = previousSelectedValueFromEntityList;
        }


        function assignEntityFolderPropertiesToFields() {
            var data_list = document_handler_form_entity_folder_list;
            var search_ref_names = ['folder_id'];
            var search_values = [document.getElementById('document_handler_form_entity_folder_list').value];
            var data_rows = getDataRowsFromDataList(data_list, search_ref_names, search_values);
            var c1 = 0;
            var c2 = 0;
            var folder_entity_link_count = 0;

            if (data_rows.length > 0) {
                document.getElementById('document_handler_form_folder_id').value = data_rows[0]['folder_id'];
                document.getElementById('document_handler_form_folder_name').value = data_rows[0]['folder_name']; /* data_rows[0]['folder_name']; */
                document.getElementById('document_handler_form_folder_description').value = data_rows[0]['folder_description'];
                document.getElementById('document_handler_form_folder_summary').value = data_rows[0]['folder_summary'];
                document.getElementById('document_handler_form_folder_date_created').value = data_rows[0]['folder_date_created'];

                if (! isNaN(document.getElementById('document_handler_form_folder_entity_link_count').value)) {
                    folder_entity_link_count = parseInt(document.getElementById('document_handler_form_folder_entity_link_count').value);
                }
                for (c1 = 0; c1 < folder_entity_link_count; c1++) {
                    document.getElementById('document_handler_form_folder_entity_link_' + (c1 + 1)).checked = false;
                    for (c2 = 0; c2 < data_rows[0]['folder_entity_list'].length; c2++) {
                        if (data_rows[0]['folder_entity_list'][c2]['entity_id'] == document.getElementById('document_handler_form_folder_entity_link_' + (c1 + 1)).value) {
                            document.getElementById('document_handler_form_folder_entity_link_' + (c1 + 1)).checked = true;
                        } 
                    }
                }
            }
        }


        function clearEntityFolderPropertiesToFields() {
            var c1 = 0;
            var folder_entity_link_count = 0;

            document.getElementById('document_handler_form_entity_folder_list').value = 'null';
            document.getElementById('document_handler_form_folder_id').value = '';
            document.getElementById('document_handler_form_folder_name').value = '';
            document.getElementById('document_handler_form_folder_description').value = '';
            document.getElementById('document_handler_form_folder_summary').value ='';
            document.getElementById('document_handler_form_folder_date_created').value = '';

            if (! isNaN(document.getElementById('document_handler_form_folder_entity_link_count').value)) {
                folder_entity_link_count = parseInt(document.getElementById('document_handler_form_folder_entity_link_count').value);
            }
            for (c1 = 0; c1 < folder_entity_link_count; c1++) {
                document.getElementById('document_handler_form_folder_entity_link_' + (c1 + 1)).checked = false;
            }

            document.getElementById('document_handler_form_folder_name').focus();
        }


        function processEntityFolderSelectionChange() {
            /*
            assignEntityFolderPropertiesToFields();
            retrieveDocumentHandlerFormFilesData();
            clearFolderFilePropertiesToFields();
            */
            assignEntityFolderPropertiesToFields();
            if (document.getElementById('document_handler_form_file_id').value == '') {
                retrieveDocumentHandlerFormFilesData();
                clearFolderFilePropertiesToFields();
            }
        }


        function copyDocumentHandlerFormFolderDataEntryFormValue() {
            var c1 = 0;
            var folder_entity_link_count = 0;
            var current_folder_entity_link_index = 0;
            var total_folder_entity_link_selected = 0;

            document_handler_form_folder_data_entry['document_handler_form_folder_id'] = document.getElementById('document_handler_form_folder_id').value;

            document_handler_form_folder_data_entry['document_handler_form_folder_name'] = document.getElementById('document_handler_form_folder_name').value;
            if (document.getElementById('document_handler_form_folder_name').value.length > 0 && 
                document.getElementById('document_handler_form_entity_folder_list').value == 'null') {
                document_handler_form_folder_data_entry['document_handler_form_folder_id'] = '';
            }

            document_handler_form_folder_data_entry['document_handler_form_folder_description'] = document.getElementById('document_handler_form_folder_description').value;
            document_handler_form_folder_data_entry['document_handler_form_folder_summary'] = document.getElementById('document_handler_form_folder_summary').value;
            document_handler_form_folder_data_entry['document_handler_form_folder_entity_links'] = [];

            if (! isNaN(document.getElementById('document_handler_form_folder_entity_link_count').value)) {
                folder_entity_link_count = parseInt(document.getElementById('document_handler_form_folder_entity_link_count').value);
            }
            for (c1 = 0; c1 < folder_entity_link_count; c1++) {
                if (document.getElementById('document_handler_form_folder_entity_link_' + (c1 + 1)).checked) {
                    current_folder_entity_link_index = document_handler_form_folder_data_entry['document_handler_form_folder_entity_links'].length;
                    document_handler_form_folder_data_entry['document_handler_form_folder_entity_links'][current_folder_entity_link_index] = document.getElementById('document_handler_form_folder_entity_link_' + (c1 + 1)).value;
                    total_folder_entity_link_selected++;
                }
            }

            if (total_folder_entity_link_selected == 0) {
                for (c1 = 0; c1 < folder_entity_link_count; c1++) {
                    if (document.getElementById('document_handler_form_folder_entity_link_' + (c1 + 1)).value == document.getElementById('document_handler_form_entity_list').value) {
                        document.getElementById('document_handler_form_folder_entity_link_' + (c1 + 1)).checked = true;
                        current_folder_entity_link_index = document_handler_form_folder_data_entry['document_handler_form_folder_entity_links'].length;
                        document_handler_form_folder_data_entry['document_handler_form_folder_entity_links'][current_folder_entity_link_index] = document.getElementById('document_handler_form_folder_entity_link_' + (c1 + 1)).value;
                        break;
                    }
                }
            }
        }


        function initInputElementsFormEntityFolders() {
            initHtmlDivSelectBox(
                document_handler_form_entity_list, 
                'document_handler_form_divselect_1',
                'document_handler_form_checkbox_1',
                'document_handler_form_folder_entity_divselectbox', 
                'document_handler_form_folder_entity_link', 
                [], 
                [], 
                'entity_id', 
                'entity_name', 
                '', 
                'document_handler_form_folder_entity_link_count', 
                false
            );
        }
