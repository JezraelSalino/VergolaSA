        function refreshEntityPropertiesToFields() {
            retrieveDocumentHandlerFormEntitiesData();

            var previousSelectedValueFromEntityList = document.getElementById('document_handler_form_entity_id').value;

            processEntitySelectionChange();
            document.getElementById('document_handler_form_entity_list').value = previousSelectedValueFromEntityList;
        }


        function getFirstLinkedEntityId() {
            var first_linked_id = null;
            var c1 = 0;
            var folder_entity_link_count = 0;

            if (! isNaN(document.getElementById('document_handler_form_folder_entity_link_count').value)) {
                folder_entity_link_count = parseInt(document.getElementById('document_handler_form_folder_entity_link_count').value);
            }
            for (c1 = 0; c1 < folder_entity_link_count; c1++) {
                if (document.getElementById('document_handler_form_folder_entity_link_' + (c1 + 1)).checked) {
                    first_linked_id = document.getElementById('document_handler_form_folder_entity_link_' + (c1 + 1)).value;
                }
            }

            return first_linked_id;
        }


        function assignEntityPropertiesToFields() {
            var data_list = document_handler_form_entity_list;
            var search_ref_names = ['entity_id'];
            var search_values = [document.getElementById('document_handler_form_entity_list').value];
            var data_rows = getDataRowsFromDataList(data_list, search_ref_names, search_values);

            if (data_rows.length > 0) {
                document.getElementById('document_handler_form_entity_id').value = data_rows[0]['entity_id'];
                document.getElementById('document_handler_form_entity_name').value = data_rows[0]['entity_name'];
                document.getElementById('document_handler_form_entity_description').value = data_rows[0]['entity_description'];
                document.getElementById('document_handler_form_entity_summary').value = data_rows[0]['entity_summary'];
                document.getElementById('document_handler_form_entity_date_created').value = data_rows[0]['entity_date_created'];
            }
        }


        function initInputElementsFormEntities() {
            var target_list = [];
            var target_id_field_name = '';
            var target_value_field_name = '';

            switch (document_handler_form_system_info['module']) {
                case 'template':
                    target_list = document_entities_list;
                    target_id_field_name = 'ref_name';
                    target_value_field_name = 'display_name';
                    break;
                case '':
                    target_list = document_handler_form_entity_list;
                    target_id_field_name = 'entity_id';
                    target_value_field_name = 'entity_name';
                    break;
            }

            initHtmlSelectBox(
                target_list, 
                'document_handler_form_selectbox_1', 
                'document_handler_form_entity_list', 
                [], 
                [], 
                target_id_field_name, 
                target_value_field_name, 
                '', 
                false
            );

            initInputElementsFormEntityFolders();
            initInputElementsFormFolderFiles();

            document.getElementById('document_handler_form_entity_list').value = default_entity_id;
            refreshEntityFolderPropertiesToFields();
        }
        /*
        function initInputElementsFormEntities() {
            initHtmlSelectBox(
                document_entities_list, 
                'document_handler_form_selectbox_1', 
                'document_handler_form_entity_list', 
                [], 
                [], 
                'ref_name', 
                'display_name', 
                '', 
                false
            );

            initInputElementsFormEntityFolders();
            initInputElementsFormFolderFiles();

            document.getElementById('document_handler_form_entity_list').value = default_entity_id;
            refreshEntityFolderPropertiesToFields();
        }
        */


        function clearEntityPropertiesToFields() {
            document.getElementById('document_handler_form_entity_list').value = 'null';
            document.getElementById('document_handler_form_entity_id').value = '';
            document.getElementById('document_handler_form_entity_name').value = '';
            document.getElementById('document_handler_form_entity_description').value = '';
            document.getElementById('document_handler_form_entity_summary').value ='';
            document.getElementById('document_handler_form_entity_date_created').value = '';

            document.getElementById('document_handler_form_entity_name').focus();
        }


        function copyDocumentHandlerFormEntityDataEntryFormValue() {
            document_handler_form_entity_data_entry['document_handler_form_entity_id'] = document.getElementById('document_handler_form_entity_id').value;
            document_handler_form_entity_data_entry['document_handler_form_entity_name'] = document.getElementById('document_handler_form_entity_name').value;

            if (document.getElementById('document_handler_form_entity_name').value.length > 0 && 
                document.getElementById('document_handler_form_entity_list').value == 'null') {
                document_handler_form_entity_data_entry['document_handler_form_entity_id'] = '';
            }

            document_handler_form_entity_data_entry['document_handler_form_entity_description'] = document.getElementById('document_handler_form_entity_description').value;
            document_handler_form_entity_data_entry['document_handler_form_entity_summary'] = document.getElementById('document_handler_form_entity_summary').value;
        }


        function processEntitySelectionChange() {
            /*
            assignEntityPropertiesToFields();
            // retrieveDocumentHandlerFormEntityUserInfo();
            retrieveDocumentHandlerFormFoldersData();
            clearEntityFolderPropertiesToFields();
            clearFolderFilePropertiesToFields();
            refreshEntityFilePropertiesToFields();
            */
            assignEntityPropertiesToFields();
            // retrieveDocumentHandlerFormEntityUserInfo();
            retrieveDocumentHandlerFormFoldersData();
            clearEntityFolderPropertiesToFields();
            if (document.getElementById('document_handler_form_file_id').value == '') {
                clearFolderFilePropertiesToFields();
                refreshEntityFilePropertiesToFields();
            }
        }
