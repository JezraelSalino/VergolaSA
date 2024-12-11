        function initialiseDocumentHandlerFormLayout() {
            var target_hidden_elements = [];
            switch (document_handler_form_system_info['module']) {
                case 'template':
                    target_hidden_elements = [
                        'document_handler_form_entity_area', 
                        'document_handler_form_folder_area', 

                        'document_handler_form_entity_name_row', 
                        'document_handler_form_entity_area_properties_title_row',
                        'document_handler_form_entity_description_row', 
                        'document_handler_form_entity_summary_row', 
                        'document_handler_form_entity_date_created_row', 
                        'document_handler_form_entity_area_button_row', 

                        'document_handler_form_folder_name_row', 
                        'document_handler_form_folder_area_properties_title_row', 
                        'document_handler_form_folder_description_row', 
                        'document_handler_form_folder_summary_row', 
                        'document_handler_form_folder_entity_divselectbox_row', 
                        'document_handler_form_folder_date_created_row', 
                        'document_handler_form_folder_area_button_row', 

                        'document_handler_form_file_area_main_title_separator', 
                        'document_handler_form_file_area_properties_title_row', 
                        'document_handler_form_file_attach_to_row', 
                        'document_handler_form_document_category_list_row', 
                        'document_handler_form_file_from_row', 
                        'document_handler_form_file_date_received_row', 
                        'document_handler_form_file_to_row', 
                        'document_handler_form_file_date_sent_row', 
                        'document_handler_form_file_content_date_row', 
                        'document_handler_form_file_content_category_row', 
                        'document_handler_form_file_folder_divselectbox_row', 
                        'document_handler_form_file_date_created_row', 
                        'document_handler_form_record_activity_list_row' 
                    ];

                    document.getElementById('document_handler_form_file_area_main_title').innerHTML = 'TEMPLATE';
                    break;
                case 'adhoc_email':
                    target_hidden_elements = [
                        'document_handler_form_entity_area', 
                        'document_handler_form_folder_area', 

                        'document_handler_form_entity_name_row', 
                        'document_handler_form_entity_area_properties_title_row',
                        'document_handler_form_entity_description_row', 
                        'document_handler_form_entity_summary_row', 
                        'document_handler_form_entity_date_created_row', 
                        'document_handler_form_entity_area_button_row', 

                        'document_handler_form_folder_name_row', 
                        'document_handler_form_folder_area_properties_title_row', 
                        'document_handler_form_folder_description_row', 
                        'document_handler_form_folder_summary_row', 
                        'document_handler_form_folder_entity_divselectbox_row', 
                        'document_handler_form_folder_date_created_row', 
                        'document_handler_form_folder_area_button_row', 
                    ];
                    break;
                case '':
                    target_hidden_elements = [
                        'document_handler_form_entity_list_row', 
                        'document_handler_form_entity_area', 
                        'document_handler_form_folder_area', 

                        'document_handler_form_folder_list_row', 
                        'document_handler_form_entity_name_row', 
                        'document_handler_form_entity_area_properties_title_row',
                        'document_handler_form_entity_description_row', 
                        'document_handler_form_entity_summary_row', 
                        'document_handler_form_entity_date_created_row', 
                        'document_handler_form_entity_area_button_row', 

                        'document_handler_form_file_area_main_title_separator', 
                        'document_handler_form_file_area_entity_list_separator', 
                        'document_handler_form_file_area_folder_list_separator', 
                        'document_handler_form_file_list_row', 
                        'document_handler_form_folder_name_row', 
                        'document_handler_form_folder_area_properties_title_row', 
                        'document_handler_form_file_area_properties_title_row', 
                        'document_handler_form_folder_description_row', 
                        'document_handler_form_folder_summary_row', 
                        'document_handler_form_folder_entity_divselectbox_row', 
                        'document_handler_form_file_folder_divselectbox_row', 
                        'document_handler_form_folder_date_created_row', 
                        'document_handler_form_folder_area_button_row', 
                    ];

                    document.getElementById('document_handler_form_file_area').style.width = '80%';
                    document.getElementById('document_handler_form_file_area_main_title').innerHTML = 'FOLIO';
                    break;
            };

            if (default_file_id == 'null' || default_file_id == '') {
                target_hidden_elements.push('document_handler_form_file_date_created_row');
                target_hidden_elements.push('document_handler_form_file_version_list_row');
                target_hidden_elements.push('document_handler_form_record_activity_list_row');
            }

            var c1 = 0;

            for (c1 = 0; c1 < target_hidden_elements.length; c1++) {
                document.getElementById(target_hidden_elements[c1]).style.display = 'none';
            }
        }

