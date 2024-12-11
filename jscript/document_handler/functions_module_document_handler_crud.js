        /*
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        ----- helper -----
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        */
        function filterVrFormJsonContent(json_ref_name) {
            var c1;
            var c2;
            var special_chars_encoding_list = [
                {"search_text":"&", "replace_text":"[AMPERSAND]"}
            ];
            var json_text = '';
            var filtered_json_text = '';

            switch (json_ref_name) {
                case 'document_handler_form_entity_data_entry':
                    json_text = JSON.stringify(document_handler_form_entity_data_entry);
                    filtered_json_text = encodeSpecialCharsInJsonText(json_text, special_chars_encoding_list);
                    document_handler_form_entity_data_entry = JSON.parse(filtered_json_text);
                    break;
                case 'document_handler_form_folder_data_entry':
                    json_text = JSON.stringify(document_handler_form_folder_data_entry);
                    filtered_json_text = encodeSpecialCharsInJsonText(json_text, special_chars_encoding_list);
                    document_handler_form_folder_data_entry = JSON.parse(filtered_json_text);
                    break;
                case 'document_handler_form_file_data_entry':
                    json_text = JSON.stringify(document_handler_form_file_data_entry);
                    filtered_json_text = encodeSpecialCharsInJsonText(json_text, special_chars_encoding_list);
                    document_handler_form_file_data_entry = JSON.parse(filtered_json_text);
                    break;
            }
        }










        /*
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        ----- retrieve entity user info -----
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        */
        // function processRetrieveResultDocumentHandlerFormEntityUserInfo(results) {
        //     if (results['error'] == 'null') {
        //         if (debug_mode_enabled == 'y') {
        //             console.log('processRetrieveResultDocumentHandlerFormEntityUserInfo > results:');
        //             console.log(results);
        //         }

        //         document_handler_form_selected_entity_user_info = results['data']['document_handler_form_selected_entity_user_info'];
        //     } else {
        //         console.log('processRetrieveResultDocumentHandlerFormEntityUserInfo > results:');
        //         console.log(results);
        //     }
        // }


        // function retrieveDocumentHandlerFormEntityUserInfo() {
        //     if (document.getElementById('document_handler_form_entity_list').value !== 'null') {
        //         var url = document_handler_form_system_info['script_url'] + '&api_mode=1';
        //         var request_data = {
        //             "document_handler_form_operation":"retrieve", 
        //             "access_mode":"entity_user_info", 
        //             "username":login_user_info['username'], 
        //             "password":login_user_info['password'], 
        //             "entity_id":document.getElementById('document_handler_form_entity_list').value 
        //         };

        //         requestAjaxCall(url, request_data, 'processRetrieveResultDocumentHandlerFormEntityUserInfo');
        //         if (debug_mode_enabled == 'y') {
        //             console.log('url:');
        //             console.log(url);
        //             console.log('request_data:');
        //             console.log(request_data);
        //         }
        //     }
        // }




        /*
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        ----- retrieve entity data -----
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        */
        function processRetrieveResultDocumentHandlerFormEntitiesData(results) {
            if (results['error'] == 'null') {
                if (debug_mode_enabled == 'y') {
                    console.log('processRetrieveResultDocumentHandlerFormEntitiesData > results:');
                    console.log(results);
                }
                document_handler_form_entity_list = results['data']['document_handler_form_entity_list'];

                initHtmlSelectBox(
                    document_handler_form_entity_list, 
                    'document_handler_form_selectbox_1', 
                    'document_handler_form_entity_list', 
                    [], 
                    [], 
                    'entity_id', 
                    'entity_name', 
                    '', 
                    false
                );

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
            } else {
                console.log('processRetrieveResultDocumentHandlerFormEntitiesData > results:');
                console.log(results);
            }
        }


        function retrieveDocumentHandlerFormEntitiesData() {
            var url = document_handler_form_system_info['script_url'] + '&api_mode=1';
            var request_data = {
                "document_handler_form_operation":"retrieve", 
                "access_mode":"entity_list", 
                "module":document_handler_form_system_info['module'], 
                "username":login_user_info['username'], 
                "password":login_user_info['password']
            };

            requestAjaxCall(url, request_data, 'processRetrieveResultDocumentHandlerFormEntitiesData');
            if (debug_mode_enabled == 'y') {
                console.log('request_data:');
                console.log(request_data);
            }
        }




        /*
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        ----- retrieve folder data -----
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        */
        function processRetrieveResultDocumentHandlerFormFoldersData(results) {
            if (results['error'] == 'null') {
                if (debug_mode_enabled == 'y') {
                    console.log('processRetrieveResultDocumentHandlerFormFoldersData > results:');
                    console.log(results);
                }
                document_handler_form_entity_folder_list = results['data']['document_handler_form_entity_folder_list'];

                initHtmlSelectBox(
                    document_handler_form_entity_folder_list, 
                    'document_handler_form_selectbox_1', 
                    'document_handler_form_entity_folder_list', 
                    [], 
                    [], 
                    'folder_id', 
                    'folder_name', 
                    '', 
                    false
                );

                initHtmlDivSelectBox(
                    document_handler_form_entity_folder_list, 
                    'document_handler_form_divselect_1',
                    'document_handler_form_checkbox_1',
                    'document_handler_form_file_folder_divselectbox', 
                    'document_handler_form_file_folder_link', 
                    [], 
                    [], 
                    'folder_id', 
                    'folder_name', 
                    '', 
                    'document_handler_form_file_folder_link_count', 
                    false
                );

                document.getElementById('document_handler_form_entity_folder_list').value = default_folder_id;

                processEntityFolderSelectionChange();
            } else {
                console.log('processRetrieveResultDocumentHandlerFormFoldersData > results:');
                console.log(results);
            }
        }


        function retrieveDocumentHandlerFormFoldersData() {
            var url = document_handler_form_system_info['script_url'] + '&api_mode=1';
            var request_data = {
                "document_handler_form_operation":"retrieve", 
                "access_mode":"entity_folder_list", 
                "module":document_handler_form_system_info['module'], 
                "username":login_user_info['username'], 
                "password":login_user_info['password'], 
                "entity_id":document.getElementById('document_handler_form_entity_list').value 
            };

            requestAjaxCall(url, request_data, 'processRetrieveResultDocumentHandlerFormFoldersData');
            if (debug_mode_enabled == 'y') {
                console.log('url:');
                console.log(url);
                console.log('request_data:');
                console.log(request_data);
            }
        }




        /*
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        ----- retrieve file data -----
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        */
        function processRetrieveResultDocumentHandlerFormFilesData(results) {
            if (results['error'] == 'null') {
                if (debug_mode_enabled == 'y') {
                    console.log('processRetrieveResultDocumentHandlerFormFilesData > results:');
                    console.log(results);
                }
                document_handler_form_folder_file_list = results['data']['document_handler_form_folder_file_list'];

                initHtmlSelectBox(
                    document_handler_form_folder_file_list, 
                    'document_handler_form_selectbox_1', 
                    'document_handler_form_folder_file_list', 
                    [], 
                    [], 
                    'file_id', 
                    'file_name', 
                    '', 
                    false
                );

                // initHtmlDivSelectBox(
                //     document_handler_form_entity_folder_list, 
                //     'document_handler_form_divselect_1',
                //     'document_handler_form_checkbox_1',
                //     'document_handler_form_file_folder_divselectbox', 
                //     'document_handler_form_file_folder_link', 
                //     [], 
                //     [], 
                //     'folder_id', 
                //     'folder_name', 
                //     '', 
                //     'document_handler_form_file_folder_link_count', 
                //     false
                // );

                document.getElementById('document_handler_form_folder_file_list').value = default_file_id;
                processEntityFileSelectionChange();
            } else {
                console.log('processRetrieveResultDocumentHandlerFormFilesData > results:');
                console.log(results);
            }
        }


        function retrieveDocumentHandlerFormFilesData() {
            var url = document_handler_form_system_info['script_url'] + '&api_mode=1';
            var request_data = {
                "document_handler_form_operation":"retrieve", 
                "access_mode":"folder_file_list", 
                "default_content_category":default_content_category, 
                "username":login_user_info['username'], 
                "password":login_user_info['password'], 
                "folder_id":document.getElementById('document_handler_form_entity_folder_list').value 
            };

            requestAjaxCall(url, request_data, 'processRetrieveResultDocumentHandlerFormFilesData');
            if (debug_mode_enabled == 'y') {
                console.log('request_data:');
                console.log(request_data);
            }
        }



        /*
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        ----- retrieve entity search data -----
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        */
        function processRetrieveResultEntitySearchData(results) {
            var current_search_list = [];

            if (results['error'] == 'null') {
                if (debug_mode_enabled == 'y') {
                    console.log('processRetrieveResultEntitySearchData > results:');
                    console.log(results);
                }

                current_search_list = results['data']['document_handler_form_entity_search_list'];

                document.getElementById('document_handler_form_entity_search_total_result').innerHTML = current_search_list.length + ' found';

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

                switch (document_handler_form_current_search_target) {
                    case 'entity_search':
                        document_handler_form_entity_search_list = current_search_list;
                        break;
                    case 'contact_from_search':
                        document_handler_form_contact_from_search_list = current_search_list;
                        break;
                    case 'contact_to_search':
                        document_handler_form_contact_to_search_list = current_search_list;
                        break;
                }
            } else {
                console.log('processRetrieveResultEntitySearchData > results:');
                console.log(results);
            }
        }


        function retrieveEntitySearchData() {
            var url = document_handler_form_system_info['script_url'] + '&api_mode=1';
            var target_access_mode = '';
            var request_data = {};

            switch (document_handler_form_current_search_target) {
                case 'entity_search':
                    target_access_mode = 'entity_search_list';
                    break;
                case 'contact_from_search':
                    target_access_mode = 'contact_from_search_list';
                    break;
                case 'contact_to_search':
                    target_access_mode = 'contact_to_search_list';
                    break;
            }

            request_data = {
                "document_handler_form_operation":"retrieve", 
                "access_mode":target_access_mode, 
                "module":document_handler_form_system_info['module'], 
                "username":login_user_info['username'], 
                "password":login_user_info['password'], 
                "entity_search_keyword":document.getElementById('document_handler_form_entity_search_keyword').value 
            };

            requestAjaxCall(url, request_data, 'processRetrieveResultEntitySearchData');
            if (debug_mode_enabled == 'y') {
                console.log('url:');
                console.log(url);
                console.log('request_data:');
                console.log(request_data);
            }
        }










        /*
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        ----- save entity data -----
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        */
        function processSaveResultDocumentHandlerFormEntityDataEntry(results) {
            if (results['error'] == 'null') {
                if (debug_mode_enabled == 'y') {
                    console.log('processSaveResultDocumentHandlerFormEntityDataEntry > results:');
                    console.log(results);
                }

                document.getElementById('document_handler_form_entity_id').value = results['message']['new_entity_id'];

                refreshEntityPropertiesToFields();
            } else {
                console.log('processSaveResultDocumentHandlerFormEntityDataEntry > results:');
                console.log(results);
            }
        }


        function saveDocumentHandlerFormEntityDataEntry() {
            copyDocumentHandlerFormEntityDataEntryFormValue();
            filterVrFormJsonContent('document_handler_form_entity_data_entry');

            var document_handler_form_operation = 'save';
            if (document.getElementById('document_handler_form_entity_id').value.length > 0) {
                document_handler_form_operation = 'update';
            }

            var url = document_handler_form_system_info['script_url'] + '&api_mode=1';
            var request_data = {
                "document_handler_form_operation":document_handler_form_operation, 
                "access_mode":"entity_save", 
                "module":document_handler_form_system_info['module'], 
                "username":login_user_info['username'], 
                "password":login_user_info['password'], 
                "document_handler_form_entity_data_entry":document_handler_form_entity_data_entry
            };

            requestAjaxCall(url, request_data, 'processSaveResultDocumentHandlerFormEntityDataEntry');
            if (debug_mode_enabled == 'y') {
                console.log('url:');
                console.log(url);
                console.log('request_data:');
                console.log(request_data);
            }
        }










        /*
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        ----- save folder data -----
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        */
        function processSaveResultDocumentHandlerFormFolderDataEntry(results) {
            if (results['error'] == 'null') {
                if (debug_mode_enabled == 'y') {
                    console.log('processSaveResultDocumentHandlerFormFolderDataEntry > results:');
                    console.log(results);
                }

                document.getElementById('document_handler_form_folder_id').value = results['message']['new_folder_id'];

                refreshEntityFolderPropertiesToFields();
            } else {
                console.log('processSaveResultDocumentHandlerFormFolderDataEntry > results:');
                console.log(results);
            }
        }


        function saveDocumentHandlerFormFolderDataEntry() {
            copyDocumentHandlerFormFolderDataEntryFormValue();
            filterVrFormJsonContent('document_handler_form_folder_data_entry');

            var document_handler_form_operation = 'save';
            if (document.getElementById('document_handler_form_folder_id').value.length > 0) {
                document_handler_form_operation = 'update';
            }

            var url = document_handler_form_system_info['script_url'] + '&api_mode=1';
            var request_data = {
                "document_handler_form_operation":document_handler_form_operation, 
                "access_mode":"folder_save", 
                "module":document_handler_form_system_info['module'], 
                "username":login_user_info['username'], 
                "password":login_user_info['password'], 
                "document_handler_form_folder_data_entry":document_handler_form_folder_data_entry
            };

            requestAjaxCall(url, request_data, 'processSaveResultDocumentHandlerFormFolderDataEntry');
            if (debug_mode_enabled == 'y') {
                console.log('url:');
                console.log(url);
                console.log('request_data:');
                console.log(request_data);
            }
        }




        /*
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        ----- save file data -----
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        */
        function processSaveResultDocumentHandlerFormFileDataEntry(results) {
            if (results['error'] == 'null') {
                if (debug_mode_enabled == 'y') {
                    console.log('processSaveResultDocumentHandlerFormFileDataEntry > results:');
                    console.log(results);
                }

                document.getElementById('document_handler_form_file_id').value = results['message']['new_file_id'];

                refreshEntityFilePropertiesToFields();

                closeDocumentHandlerForm();
            } else {
                console.log('processSaveResultDocumentHandlerFormFileDataEntry > results:');
                console.log(results);
            }
        }


        function saveDocumentHandlerFormFileDataEntry() {
            copyDocumentHandlerFormFileDataEntryFormValue();
            filterVrFormJsonContent('document_handler_form_file_data_entry');

            var document_handler_form_operation = 'save';
            if (document.getElementById('document_handler_form_file_id').value.length > 0) {
                document_handler_form_operation = 'update';
            }

            var access_mode = 'file_save';
            if (document_handler_form_system_info['module'] == '') {
                access_mode = 'folio_save';
            }

            var url = document_handler_form_system_info['script_url'] + '&api_mode=1';
            var request_data = {
                "document_handler_form_operation":document_handler_form_operation, 
                "access_mode":access_mode, 
                "module":document_handler_form_system_info['module'], 
                "username":login_user_info['username'], 
                "password":login_user_info['password'], 
                "document_handler_form_file_data_entry":document_handler_form_file_data_entry
            };

            requestAjaxCall(url, request_data, 'processSaveResultDocumentHandlerFormFileDataEntry');
            if (debug_mode_enabled == 'y') {
                console.log('url:');
                console.log(url);
                console.log('request_data:');
                console.log(request_data);
            }
        }










        /*
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        ----- upload file -----
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        */
        function processUploadResultDocumentHandlerFormFileDataEntry(results) {
            if (results['error'] == 'null') {
                if (debug_mode_enabled == 'y') {
                    console.log('processUploadResultDocumentHandlerFormFileDataEntry > results:');
                    console.log(results);
                }

                var temp_text = document.getElementById('document_handler_form_file_info').value;
                temp_text = replaceSubstringInText(
                    ['C:\\fakepath\\'], 
                    [''], 
                    temp_text
                );
                document.getElementById('document_handler_form_file_original_name').value = temp_text;
                if (document.getElementById('document_handler_form_file_name').value.length == 0) {
                    document.getElementById('document_handler_form_file_name').value = temp_text;
                }

                document.getElementById('document_handler_form_file_extension').value = results['message']['file_extension'];
                document.getElementById('document_handler_form_file_type').value = results['message']['file_type'];
                document.getElementById('document_handler_form_file_size').value = results['message']['file_size'];
                document.getElementById('document_handler_form_file_external_ref_name').value = results['message']['file_external_ref_name'];
            } else {
                console.log('processUploadResultDocumentHandlerFormFileDataEntry > results:');
                console.log(results);
            }
        }

        function uploadDocumentHandlerFormFileDataEntry() {
            var entity_name = document.getElementById('document_handler_form_entity_list').options[document.getElementById('document_handler_form_entity_list').selectedIndex].text;
            var folder_name = document.getElementById('document_handler_form_entity_folder_list').options[document.getElementById('document_handler_form_entity_folder_list').selectedIndex].text;
            var file_name = document.getElementById('document_handler_form_file_info').value;
            var file_object = document.getElementById('document_handler_form_file_info').files[0];
            var form_data = new FormData();
            form_data.append('document_handler_form_file_info', file_object);

            var url = document_handler_form_system_info['script_url'] + '&api_mode=1';
            url += '&api_data={"document_handler_form_operation":"save", "access_mode":"file_upload", "username":"' + login_user_info['username'] + '", "password":"' + login_user_info['password'] + '", "entity_name":"' + entity_name + '", "folder_name":"' + folder_name + '"}';
            var request_data = {
                "document_handler_form_operation":"save", 
                "access_mode":"file_upload", 
                "username":login_user_info['username'], 
                "password":login_user_info['password'], 
                "form_data":form_data
            };

            requestAjaxCall(url, request_data, 'processUploadResultDocumentHandlerFormFileDataEntry');
            if (debug_mode_enabled == 'y') {
                console.log('request_data:');
                console.log(request_data);
            }
        }










        /*
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        ----- download file -----
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        */
        function downloadDocumentHandlerFormFile(download_option) {
            var entity_name = document.getElementById('document_handler_form_entity_name').value;
            var folder_name = document.getElementById('document_handler_form_folder_name').value;
            var file_name = document.getElementById('document_handler_form_file_name').value;
            var file_external_ref_name = document.getElementById('document_handler_form_file_external_ref_name').value;

            if (document.getElementById('document_handler_form_folder_file_list').value != 'null') {
                if (document.getElementById('document_handler_form_file_version_list').value != 'null') {
                    file_external_ref_name = document.getElementById('document_handler_form_file_version_list').value;
                } else {
                    if (document.getElementById('document_handler_form_file_version_list').length >= 2) {
                        file_external_ref_name = document.getElementById('document_handler_form_file_version_list').options[1].value;
                    }
                }

                var url = document_handler_form_system_info['script_url'] + '&api_mode=1';
                url += '&api_data={"document_handler_form_operation":"retrieve", "access_mode":"file_download", "module":"' + document_handler_form_system_info['module'] + '", "download_option":"' + download_option + '", "username":"' + login_user_info['username'] + '", "password":"' + login_user_info['password'] + '", "file_external_ref_name":"' + file_external_ref_name + '", "entity_name":"' + entity_name + '", "folder_name":"' + folder_name + '", "file_name":"' + file_name + '"}';
                window.location = url;
            }
        }


        /*
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        ----- download msword plugin -----
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        */
        function downloadDocumentHandlerFormMsWordPlugin() {
            var usage_message = '';
            var url = document_handler_form_system_info['script_url'] + '&api_mode=1';

            alert(document_handler_form_system_info['plugin_msword_usage_message']);

            url += '&api_data={"document_handler_form_operation":"retrieve", "access_mode":"msword_plugin_download", "username":"' + login_user_info['username'] + '", "password":"' + login_user_info['password'] + '"}';
            window.location = url;
        }


        /*
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        ----- download msoutlook plugin -----
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        */
        function downloadDocumentHandlerFormMsOutlookPlugin() {
            var usage_message = '';
            var url = document_handler_form_system_info['script_url'] + '&api_mode=1';

            alert(document_handler_form_system_info['plugin_msoutlook_usage_message']);

            url += '&api_data={"document_handler_form_operation":"retrieve", "access_mode":"msoutlook_plugin_download", "username":"' + login_user_info['username'] + '", "password":"' + login_user_info['password'] + '"}';
            window.location = url;
        }


















        /*
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        ----- delete entity data -----
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        */
        function processDeleteResultDocumentHandlerFormEntityDataEntry(results) {
            if (results['error'] == 'null') {
                if (debug_mode_enabled == 'y') {
                    console.log('processDeleteResultDocumentHandlerFormEntityDataEntry > results:');
                    console.log(results);
                }

                refreshEntityPropertiesToFields();
            } else {
                console.log('processDeleteResultDocumentHandlerFormEntityDataEntry > results:');
                console.log(results);
            }
        }


        function deleteDocumentHandlerFormEntityDataEntry() {
            copyDocumentHandlerFormEntityDataEntryFormValue();
            filterVrFormJsonContent('document_handler_form_entity_data_entry');

            var document_handler_form_operation = 'delete';
            var url = document_handler_form_system_info['script_url'] + '&api_mode=1';
            var request_data = {
                "document_handler_form_operation":document_handler_form_operation, 
                "access_mode":"entity_delete", 
                "username":login_user_info['username'], 
                "password":login_user_info['password'], 
                "document_handler_form_entity_data_entry":document_handler_form_entity_data_entry
            };

            requestAjaxCall(url, request_data, 'processDeleteResultDocumentHandlerFormEntityDataEntry');
            if (debug_mode_enabled == 'y') {
                console.log('url:');
                console.log(url);
                console.log('request_data:');
                console.log(request_data);
            }
        }




        /*
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        ----- delete folder data -----
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        */
        function processDeleteResultDocumentHandlerFormFolderDataEntry(results) {
            if (results['error'] == 'null') {
                if (debug_mode_enabled == 'y') {
                    console.log('processDeleteResultDocumentHandlerFormFolderDataEntry > results:');
                    console.log(results);
                }

                refreshEntityFolderPropertiesToFields();
            } else {
                console.log('processDeleteResultDocumentHandlerFormFolderDataEntry > results:');
                console.log(results);
            }
        }


        function deleteDocumentHandlerFormFolderDataEntry() {
            copyDocumentHandlerFormFolderDataEntryFormValue();
            filterVrFormJsonContent('document_handler_form_folder_data_entry');

            var document_handler_form_operation = 'delete';
            var url = document_handler_form_system_info['script_url'] + '&api_mode=1';
            var request_data = {
                "document_handler_form_operation":document_handler_form_operation, 
                "access_mode":"folder_delete", 
                "username":login_user_info['username'], 
                "password":login_user_info['password'], 
                "document_handler_form_folder_data_entry":document_handler_form_folder_data_entry
            };

            requestAjaxCall(url, request_data, 'processDeleteResultDocumentHandlerFormFolderDataEntry');
            if (debug_mode_enabled == 'y') {
                console.log('url:');
                console.log(url);
                console.log('request_data:');
                console.log(request_data);
            }
        }




        /*
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        ----- delete file data -----
        ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
        */
        function processDeleteResultDocumentHandlerFormFileDataEntry(results) {
            if (results['error'] == 'null') {
                if (debug_mode_enabled == 'y') {
                    console.log('processDeleteResultDocumentHandlerFormFileDataEntry > results:');
                    console.log(results);
                }

                refreshEntityFilePropertiesToFields();
            } else {
                console.log('processDeleteResultDocumentHandlerFormFileDataEntry > results:');
                console.log(results);
            }
        }


        function deleteDocumentHandlerFormFileDataEntry() {
            copyDocumentHandlerFormFileDataEntryFormValue();
            filterVrFormJsonContent('document_handler_form_file_data_entry');

            var document_handler_form_operation = 'delete';
            var url = document_handler_form_system_info['script_url'] + '&api_mode=1';
            var request_data = {
                "document_handler_form_operation":document_handler_form_operation, 
                "access_mode":"file_delete", 
                "username":login_user_info['username'], 
                "password":login_user_info['password'], 
                "document_handler_form_file_data_entry":document_handler_form_file_data_entry
            };

            requestAjaxCall(url, request_data, 'processDeleteResultDocumentHandlerFormFileDataEntry');
            if (debug_mode_enabled == 'y') {
                console.log('url:');
                console.log(url);
                console.log('request_data:');
                console.log(request_data);
            }
        }
