        function removeCurrentEntitySearchAttachItems() {
            var new_data_list = [];
            for (c1 = 0; c1 < document_handler_form_current_entity_search_attach_list.length; c1++) {
                if(document.getElementById('document_handler_form_entity_attach_link_' + (c1 + 1)).checked == false) {
                    new_data_list[new_data_list.length] = document_handler_form_current_entity_search_attach_list[c1];
                }
            }
            document_handler_form_current_entity_search_attach_list = new_data_list;

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
        }


        function assignEntitySearchResultToField() {
            var data_list = [];
            var c1 = 0;
            var c2 = 0;
            var entity_search_link_count = 0;
            var current_attach_list = [];

            switch (document_handler_form_current_search_target) {
                case 'entity_search':
                    data_list = document_handler_form_entity_search_list;
                    break;
                case 'contact_from_search':
                    data_list = document_handler_form_contact_from_search_list;
                    break;
                case 'contact_to_search':
                    data_list = document_handler_form_contact_to_search_list;
                    break;
            }

            if (! isNaN(document.getElementById('document_handler_form_entity_search_link_count').value)) {
                entity_search_link_count = parseInt(document.getElementById('document_handler_form_entity_search_link_count').value);
            }

            current_attach_list = [];
            for (c1 = 0; c1 < data_list.length; c1++) {
                if(document.getElementById('document_handler_form_entity_search_link_' + (c1 + 1)).checked == true) {
                    current_attach_list[current_attach_list.length] = {"entity_id":data_list[c1]['entity_id'], "entity_info":data_list[c1]['entity_info']};
                }
            }

            switch (document_handler_form_current_search_target) {
                case 'entity_search':
                    document_handler_form_entity_search_keyword = document.getElementById('document_handler_form_entity_search_keyword').value;
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
                    break;
                case 'contact_from_search':
                    document_handler_form_contact_from_search_keyword = document.getElementById('document_handler_form_entity_search_keyword').value;
                    document_handler_form_current_contact_from_search_attach_list = current_attach_list;
                    if (document_handler_form_current_contact_from_search_attach_list.length > 0) {
                        document.getElementById('document_handler_form_file_from').value = document_handler_form_current_contact_from_search_attach_list[0]['entity_id'];
                    }
                    break;
                case 'contact_to_search':
                    document_handler_form_contact_to_search_keyword = document.getElementById('document_handler_form_entity_search_keyword').value;
                    document_handler_form_current_contact_to_search_attach_list = current_attach_list;
                    if (document_handler_form_current_contact_to_search_attach_list.length > 0) {
                        document.getElementById('document_handler_form_file_to').value = document_handler_form_current_contact_to_search_attach_list[0]['entity_id'];
                    }
                    break;
            }
        }


        function processEntitySearch() {
            // assignEntityPropertiesToFields();
            retrieveEntitySearchData();
            // clearEntityFolderPropertiesToFields();
            // clearFolderFilePropertiesToFields();
            // refreshEntityFilePropertiesToFields();
        }


        function closeEntitySearchForm() {
            assignEntitySearchResultToField();
            document.getElementById('document_handler_form_entity_search_area').style.display = 'none';
        }




        function initInputElementsFormEntitySearch(search_target) {
            var c1 = 0;
            var c2 = 0;
            var is_current_entity_being_attached = false;
            var current_search_list = [];
            var current_attach_list = [];

            switch (search_target) {
                case 'entity_search':
                    document.getElementById('document_handler_form_entity_search_keyword').value = document_handler_form_entity_search_keyword;
                    current_search_list = document_handler_form_entity_search_list;
                    current_attach_list = document_handler_form_current_entity_search_attach_list;
                    break;
                case 'contact_from_search':
                    document.getElementById('document_handler_form_entity_search_keyword').value = document_handler_form_contact_from_search_keyword;
                    current_search_list = document_handler_form_contact_from_search_list;
                    current_attach_list = document_handler_form_current_contact_from_search_attach_list;
                    break;
                case 'contact_to_search':
                    document.getElementById('document_handler_form_entity_search_keyword').value = document_handler_form_contact_to_search_keyword;
                    current_search_list = document_handler_form_contact_to_search_list;
                    current_attach_list = document_handler_form_current_contact_to_search_attach_list;
                    break;
            }

            document.getElementById('document_handler_form_entity_search_total_result').innerHTML = current_search_list.length;

            initHtmlDivSelectBox2(
                current_search_list, 
                'document_handler_form_divselect_1',
                'document_handler_form_checkbox_1',
                'document_handler_form_entity_search_divselectbox', 
                'document_handler_form_entity_search_link', 
                [], 
                [], 
                'entity_id', 
                'entity_info', 
                '', 
                'document_handler_form_entity_search_link_count', 
                false
            );

            for (c1 = 0; c1 < current_search_list.length; c1++) {
                is_current_entity_being_attached = false;
                for (c2 = 0; c2 < current_attach_list.length; c2++) {
                    if (current_search_list[c1]['entity_id'] == current_attach_list[c2]['entity_id']) {
                        is_current_entity_being_attached = true;
                        break;
                    }
                }
                if (is_current_entity_being_attached == true) {
                    document.getElementById('document_handler_form_entity_search_link_' + (c1 + 1)).checked = true;
                }
            }

            document_handler_form_current_search_target = search_target;
            document.getElementById('document_handler_form_entity_search_area').style.display = 'block';
            document.getElementById('document_handler_form_entity_search_keyword').focus();
        }
