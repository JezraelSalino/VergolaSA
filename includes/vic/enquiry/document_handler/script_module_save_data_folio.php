<?php
/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- save folio -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_save_data['folio_save']['total_input'] = 0;
$results_save_data['folio_save']['total_success'] = 0;
$results_save_data['folio_save']['total_failure'] = 0;
$results_save_data['folio_save']['failure_indexes'] = array();
$results_save_data['folio_save']['is_success'] = false;


$target_entity_info_list = array();
$target_folder_info_list = array();


if ($enable_saving['folio_save'] == true) {
    $results_save_data['folio_save']['total_input'] = 1;

    $submitted_file_name = $api_data['document_handler_form_file_data_entry']['document_handler_form_file_name'];

    $new_file_id = null;
    $sql = str_replace(
        array('[TABLE_NAME]'), 
        array('document_handler_file'), 
        $sql_template_retrieve_table_status
    );
    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        $r1 = mysql_fetch_array($results['data']);
        $new_file_id = $r1['Auto_increment'];
    } else {
        $app_response['error'][] = $results['error'];
        $app_response['message'][] = $results['message'];
    }

    if ($new_file_id != null) {
        $sql = str_replace(
            array(
                '[FILE_ID]', 
                '[FILE_NAME]', 
                '[FILE_DESCRIPTION]', 
                '[FILE_SUMMARY]', 
                '[FILE_FROM]', 
                '[FILE_DATE_RECEIVED]', 
                '[FILE_TO]', 
                '[FILE_DATE_SENT]', 
                '[FILE_CONTENT_DATE]', 
                '[FILE_CONTENT_CATEGORY]', 
                '[FILE_ORIGINAL_NAME]', 
                '[FILE_EXTENSION]', 
                '[FILE_TYPE]', 
                '[FILE_SIZE]', 
                '[EXTERNAL_REF_NAME]', 
                '[FILE_STATUS]', 
                '[USER_ID]', 
                '[GROUP_ID]'
            ), 
            array(
                $new_file_id, 
                addslashes($api_data['document_handler_form_file_data_entry']['document_handler_form_file_name']), 
                addslashes($api_data['document_handler_form_file_data_entry']['document_handler_form_file_description']), 
                addslashes($api_data['document_handler_form_file_data_entry']['document_handler_form_file_summary']), 
                addslashes($api_data['document_handler_form_file_data_entry']['document_handler_form_file_from']), 
                addslashes($api_data['document_handler_form_file_data_entry']['document_handler_form_file_date_received']), 
                addslashes($api_data['document_handler_form_file_data_entry']['document_handler_form_file_to']), 
                addslashes($api_data['document_handler_form_file_data_entry']['document_handler_form_file_date_sent']), 
                addslashes($api_data['document_handler_form_file_data_entry']['document_handler_form_file_content_date']), 
                addslashes($api_data['document_handler_form_file_data_entry']['document_handler_form_file_content_category']), 
                addslashes($api_data['document_handler_form_file_data_entry']['document_handler_form_file_original_name']), 
                addslashes($api_data['document_handler_form_file_data_entry']['document_handler_form_file_extension']), 
                addslashes($api_data['document_handler_form_file_data_entry']['document_handler_form_file_type']), 
                addslashes($api_data['document_handler_form_file_data_entry']['document_handler_form_file_size']), 
                addslashes($api_data['document_handler_form_file_data_entry']['document_handler_form_file_external_ref_name']), 
                addslashes($api_data['document_handler_form_file_data_entry']['document_handler_form_file_status']), 
                addslashes($login_user_info['user_id']), 
                addslashes($login_user_info['user_group_id'])
            ), 
            $sql_template_insert_document_handler_file
        );

        $results = executeDbQuery($sql, $db_connection);
        if ($results['error'] == 'null') {
            $results_save_data['folio_save']['total_success']++;
        } else {
            $results_save_data['folio_save']['total_failure']++;
        }


        $target_entity_info_list = array();
        for ($c1 = 0; $c1 < count($api_data['document_handler_form_file_data_entry']['document_handler_form_current_entity_search_attach_list']); $c1++) {
            $current_entity_name = $api_data['document_handler_form_file_data_entry']['document_handler_form_current_entity_search_attach_list'][$c1]['entity_id'];
            $current_entity_info = $api_data['document_handler_form_file_data_entry']['document_handler_form_current_entity_search_attach_list'][$c1]['entity_info'];

            $input_data = array(
                'module' => $api_data['module'], 
                'entity_name' => $current_entity_name, 
                'entity_description' => $current_entity_info, 
                'entity_summary' => '', 
                'user_id' => $login_user_info['user_id'], 
                'user_group_id' => $login_user_info['user_group_id'], 
            );

            $sql_templates = array(
                'retrieve_entity_by_name' => $sql_template_retrieve_entity_by_name, 
                'retrieve_table_status' => $sql_template_retrieve_table_status, 
                'insert_document_handler_entity' => $sql_template_insert_document_handler_entity
            );

            $results2 = saveEntityInfo($db_connection, $input_data, $sql_templates);
            if ($results2['new_entity_id'] != null) {
                $target_entity_info_list[count($target_entity_info_list)] = array(
                    'entity_id' => $results2['new_entity_id'], 
                    'entity_name' => $current_entity_name
                );
            } else {
                $target_entity_info_list[count($target_entity_info_list)] = array(
                    'entity_id' => $config['db']['entity_temp_id'], 
                    'entity_name' => $current_entity_name
                );
            }
        }


        $target_folder_info_list = array();
        $current_folder_name = $api_data['document_handler_form_file_data_entry']['document_handler_form_document_category'];
        $input_data = array(
            'folder_name' => $current_folder_name, 
            'folder_description' => '', 
            'folder_summary' => '', 
            'user_id' => $login_user_info['user_id'], 
            'user_group_id' => $login_user_info['user_group_id']
        );

        $sql_templates = array(
            'retrieve_folder_by_name' => $sql_template_retrieve_folder_by_name, 
            'retrieve_table_status' => $sql_template_retrieve_table_status, 
            'insert_document_handler_folder' => $sql_template_insert_document_handler_folder
        );

        $results3 = saveFolderInfo($db_connection, $input_data, $sql_templates);
        if ($results3['new_folder_id'] != null) {
            $target_folder_info_list[count($target_folder_info_list)] = array(
                'folder_id' => $results3['new_folder_id'], 
                'folder_name' => $current_folder_name
            );
        } else {
            $target_folder_info_list[count($target_folder_info_list)] = array(
                'folder_id' => $config['db']['folder_temp_id'], 
                'folder_name' => $current_folder_name
            );
        }


        $target_entity_folder_info_list = array();
        for ($c1 = 0; $c1 < count($target_entity_info_list); $c1++) {
            for ($c2 = 0; $c2 < count($target_folder_info_list); $c2++) {
                $input_data = array(
                    'entity_id' => $target_entity_info_list[$c1]['entity_id'], 
                    'entity_name' => $target_entity_info_list[$c1]['entity_name'], 
                    'folder_id' => $target_folder_info_list[$c2]['folder_id'], 
                    'folder_name' => $target_folder_info_list[$c2]['folder_name'], 
                    'module' => $api_data['module'], 
                    'user_id' => $login_user_info['user_id'], 
                    'user_group_id' => $login_user_info['user_group_id']
                );

                $sql_templates = array(
                    'retrieve_entity_folder_by_names' => $sql_template_retrieve_entity_folder_by_names, 
                    'retrieve_table_status' => $sql_template_retrieve_table_status, 
                    'insert_document_handler_entity_folder' => $sql_template_insert_document_handler_entity_folder_2
                );

                $results4 = saveEntityFolderInfo($db_connection, $input_data, $sql_templates);
                if ($results4['new_entity_folder_id'] != null) {
                    $target_entity_folder_info_list[count($target_entity_folder_info_list)] = array(
                        'new_entity_folder_id' => $results4['new_entity_folder_id']
                    );
                }
            }
        }


        $target_folder_file_info_list = array();
        for ($c1 = 0; $c1 < count($target_folder_info_list); $c1++) {
            $input_data = array(
                'folder_id' => $target_folder_info_list[$c1]['folder_id'], 
                'folder_name' => $target_folder_info_list[$c1]['folder_name'], 
                'file_id' => $new_file_id, 
                'file_name' => $api_data['document_handler_form_file_data_entry']['document_handler_form_file_name'], 
                'module' => $api_data['module'], 
                'user_id' => $login_user_info['user_id'], 
                'user_group_id' => $login_user_info['user_group_id']
            );

            $sql_templates = array(
                'retrieve_folder_file_by_names' => $sql_template_retrieve_folder_file_by_names, 
                'retrieve_table_status' => $sql_template_retrieve_table_status, 
                'insert_document_handler_folder_file' => $sql_template_insert_document_handler_folder_file_2
            );

            $results4 = saveFolderFileInfo($db_connection, $input_data, $sql_templates);
            if ($results4['new_folder_file_id'] != null) {
                $target_folder_file_info_list[count($target_folder_file_info_list)] = array(
                    'new_folder_file_id' => $results4['new_folder_file_id']
                );
            }
        }


        $target_entity_folder_file_info_list = array();
        for ($c1 = 0; $c1 < count($target_entity_info_list); $c1++) {
            for ($c2 = 0; $c2 < count($target_folder_info_list); $c2++) {
                $input_data = array(
                    'entity_id' => $target_entity_info_list[$c1]['entity_id'], 
                    'entity_name' => $target_entity_info_list[$c1]['entity_name'], 
                    'folder_id' => $target_folder_info_list[$c2]['folder_id'], 
                    'folder_name' => $target_folder_info_list[$c2]['folder_name'], 
                    'file_id' => $new_file_id, 
                    'file_name' => $api_data['document_handler_form_file_data_entry']['document_handler_form_file_name'], 
                    'module' => $api_data['module'], 
                    'user_id' => $login_user_info['user_id'], 
                    'user_group_id' => $login_user_info['user_group_id']
                );

                $sql_templates = array(
                    'retrieve_entity_folder_file_by_names' => $sql_template_retrieve_entity_folder_file_by_names, 
                    'retrieve_table_status' => $sql_template_retrieve_table_status, 
                    'insert_document_handler_entity_folder_file' => $sql_template_insert_document_handler_entity_folder_file_2
                );

                $results4 = saveEntityFolderFileInfo($db_connection, $input_data, $sql_templates);
                if ($results4['new_entity_folder_file_id'] != null) {
                    $target_entity_folder_file_info_list[count($target_entity_folder_file_info_list)] = array(
                        'new_entity_folder_file_id' => $results4['new_entity_folder_file_id']
                    );
                }
            }
        }
    }

    if ($results_save_data['folio_save']['total_input'] == $results_save_data['folio_save']['total_success']) {
        $results_save_data['folio_save']['is_success'] = true;
    }
}
?>