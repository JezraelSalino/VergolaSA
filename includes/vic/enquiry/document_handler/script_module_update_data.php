<?php
// mysql_query("START TRANSACTION");


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- initialise variables -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$enable_updating = array(
    'entity_save' => false, 
    'folder_save' => false, 
    'file_save' => false, 
    'folio_save' => false, 
);
if (isset($api_data['access_mode'])) {
    switch ($api_data['access_mode']) {
        case 'entity_save':
            $enable_updating['entity_save'] = true;
            break;
        case 'folder_save':
            $enable_updating['folder_save'] = true;
            break;
        case 'file_save':
            $enable_updating['file_save'] = true;
            break;
        case 'folio_save':
            $enable_updating['folio_save'] = true;
            break;
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- update entity -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_update_data['entity_save']['total_input'] = 0;
$results_update_data['entity_save']['total_success'] = 0;
$results_update_data['entity_save']['total_failure'] = 0;
$results_update_data['entity_save']['failure_indexes'] = array();
$results_update_data['entity_save']['is_success'] = false;

if ($enable_updating['entity_save'] == true) {
    $results_update_data['entity_save']['total_input'] = 1;

    $sql = str_replace(
            array(
                '[ENTITY_NAME]', 
                '[ENTITY_DESCRIPTION]', 
                '[ENTITY_SUMMARY]', 
                '[USER_ID]', 
                '[GROUP_ID]', 
                '[ENTITY_ID]' 
            ), 
            array(
                addslashes($api_data['document_handler_form_entity_data_entry']['document_handler_form_entity_name']), 
                addslashes($api_data['document_handler_form_entity_data_entry']['document_handler_form_entity_description']), 
                addslashes($api_data['document_handler_form_entity_data_entry']['document_handler_form_entity_summary']), 
                addslashes($login_user_info['user_id']), 
                addslashes($login_user_info['user_group_id']), 
                addslashes($api_data['document_handler_form_entity_data_entry']['document_handler_form_entity_id'])
            ), 
            $sql_template_update_document_handler_entity
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        $results_update_data['entity_save']['total_success']++;
    } else {
        $results_update_data['entity_save']['total_failure']++;
    }

    if ($results_update_data['entity_save']['total_input'] == $results_update_data['entity_save']['total_success']) {
        $results_update_data['entity_save']['is_success'] = true;
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- update folder -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_update_data['folder_save']['total_input'] = 0;
$results_update_data['folder_save']['total_success'] = 0;
$results_update_data['folder_save']['total_failure'] = 0;
$results_update_data['folder_save']['failure_indexes'] = array();
$results_update_data['folder_save']['is_success'] = false;

if ($enable_updating['folder_save'] == true) {
    $results_update_data['folder_save']['total_input'] = 2 + count($api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_entity_links']);

    $sql = str_replace(
            array(
                '[FOLDER_NAME]', 
                '[FOLDER_DESCRIPTION]', 
                '[FOLDER_SUMMARY]', 
                '[USER_ID]', 
                '[GROUP_ID]', 
                '[FOLDER_ID]' 
            ), 
            array(
                addslashes($api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_name']), 
                addslashes($api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_description']), 
                addslashes($api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_summary']), 
                addslashes($login_user_info['user_id']), 
                addslashes($login_user_info['user_group_id']), 
                addslashes($api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_id'])
            ), 
            $sql_template_update_document_handler_folder
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        $results_update_data['folder_save']['total_success']++;
    } else {
        $results_update_data['folder_save']['total_failure']++;
    }


    $sql = str_replace(
        array(
            '[FOLDER_ID]' 
        ), 
        array(
            addslashes($api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_id'])
        ), 
        $sql_template_delete_document_handler_entity_folder
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        $results_update_data['folder_save']['total_success']++;
    } else {
        $results_update_data['folder_save']['total_failure']++;
    }


    for ($c1 = 0; $c1 < count($api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_entity_links']); $c1++) {
        $sql = str_replace(
            array(
                '[ENTITY_ID]', 
                '[FOLDER_ID]', 
                '[USER_ID]', 
                '[GROUP_ID]'
            ), 
            array(
                addslashes($api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_entity_links'][$c1]), 
                addslashes($api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_id']), 
                addslashes($login_user_info['user_id']), 
                addslashes($login_user_info['user_group_id'])
            ), 
            $sql_template_insert_document_handler_entity_folder
        );

        $results = executeDbQuery($sql, $db_connection);
        if ($results['error'] == 'null') {
            $results_update_data['folder_save']['total_success']++;
        } else {
            $results_update_data['folder_save']['total_failure']++;
            $results_update_data['folder_save']['failure_indexes'][] = $c1;
        }
    }

    if (count($api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_entity_links']) == 0) {
        $results_update_data['folder_save']['total_input'] += 1;

        $sql = str_replace(
            array(
                '[ENTITY_ID]', 
                '[FOLDER_ID]', 
                '[USER_ID]', 
                '[GROUP_ID]'
            ), 
            array(
                $config['db']['entity_temp_id'], 
                addslashes($api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_id']), 
                addslashes($login_user_info['user_id']), 
                addslashes($login_user_info['user_group_id'])
            ), 
            $sql_template_insert_document_handler_entity_folder
        );

        $results = executeDbQuery($sql, $db_connection);
        if ($results['error'] == 'null') {
            $results_update_data['folder_save']['total_success']++;
        } else {
            $results_update_data['folder_save']['total_failure']++;
            $results_update_data['folder_save']['failure_indexes'][] = $c1;
        }
    }

    if ($results_update_data['folder_save']['total_input'] == $results_update_data['folder_save']['total_success']) {
        $results_update_data['folder_save']['is_success'] = true;
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- update file -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_update_data['file_save']['total_input'] = 0;
$results_update_data['file_save']['total_success'] = 0;
$results_update_data['file_save']['total_failure'] = 0;
$results_update_data['file_save']['failure_indexes'] = array();
$results_update_data['file_save']['is_success'] = false;

if ($enable_updating['file_save'] == true) {
    $results_update_data['file_save']['total_input'] = 2 + count($api_data['document_handler_form_file_data_entry']['document_handler_form_file_folder_links']);

    $sql = str_replace(
            array(
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
                '[GROUP_ID]', 
                '[FILE_ID]'
            ), 
            array(
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
                addslashes($login_user_info['user_group_id']), 
                addslashes($api_data['document_handler_form_file_data_entry']['document_handler_form_file_id'])
            ), 
            $sql_template_update_document_handler_file
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        $results_update_data['file_save']['total_success']++;
    } else {
        $results_update_data['file_save']['total_failure']++;
    }


    $sql = str_replace(
        array(
            '[FILE_ID]' 
        ), 
        array(
            addslashes($api_data['document_handler_form_file_data_entry']['document_handler_form_file_id'])
        ), 
        $sql_template_delete_document_handler_folder_file
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        $results_update_data['file_save']['total_success']++;
    } else {
        $results_update_data['file_save']['total_failure']++;
    }

    for ($c1 = 0; $c1 < count($api_data['document_handler_form_file_data_entry']['document_handler_form_file_folder_links']); $c1++) {
        $sql = str_replace(
            array(
                '[FOLDER_ID]', 
                '[FILE_ID]', 
                '[USER_ID]', 
                '[GROUP_ID]'
            ), 
            array(
                addslashes($api_data['document_handler_form_file_data_entry']['document_handler_form_file_folder_links'][$c1]), 
                addslashes($api_data['document_handler_form_file_data_entry']['document_handler_form_file_id']), 
                addslashes($login_user_info['user_id']), 
                addslashes($login_user_info['user_group_id'])
            ), 
            $sql_template_insert_document_handler_folder_file
        );

        $results = executeDbQuery($sql, $db_connection);
        if ($results['error'] == 'null') {
            $results_update_data['file_save']['total_success']++;
        } else {
            $results_update_data['file_save']['total_failure']++;
            $results_update_data['file_save']['failure_indexes'][] = $c1;
        }
    }

    if (count($api_data['document_handler_form_file_data_entry']['document_handler_form_file_folder_links']) == 0) {
        $results_update_data['file_save']['total_input'] += 1;

        $sql = str_replace(
            array(
                '[FOLDER_ID]', 
                '[FILE_ID]', 
                '[USER_ID]', 
                '[GROUP_ID]'
            ), 
            array(
                $config['db']['folder_temp_id'], 
                addslashes($api_data['document_handler_form_file_data_entry']['document_handler_form_file_id']), 
                addslashes($login_user_info['user_id']), 
                addslashes($login_user_info['user_group_id'])
            ), 
            $sql_template_insert_document_handler_folder_file
        );

        $results = executeDbQuery($sql, $db_connection);
        if ($results['error'] == 'null') {
            $results_update_data['file_save']['total_success']++;
        } else {
            $results_update_data['file_save']['total_failure']++;
            $results_update_data['file_save']['failure_indexes'][] = $c1;
        }
    }

    if ($results_update_data['file_save']['total_input'] == $results_update_data['file_save']['total_success']) {
        $results_update_data['file_save']['is_success'] = true;
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- update folio -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_update_data['folio_save']['total_input'] = 0;
$results_update_data['folio_save']['total_success'] = 0;
$results_update_data['folio_save']['total_failure'] = 0;
$results_update_data['folio_save']['failure_indexes'] = array();
$results_update_data['folio_save']['is_success'] = false;

$target_entity_info_list = array();
$target_folder_info_list = array();

if ($enable_updating['folio_save'] == true) {
    $results_update_data['folio_save']['total_input'] += 1;

    $submitted_file_id = $api_data['document_handler_form_file_data_entry']['document_handler_form_file_id'];
    $submitted_file_name = $api_data['document_handler_form_file_data_entry']['document_handler_form_file_name'];

    $sql = str_replace(
            array(
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
                '[GROUP_ID]', 
                '[FILE_ID]'
            ), 
            array(
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
                addslashes($login_user_info['user_group_id']), 
                addslashes($api_data['document_handler_form_file_data_entry']['document_handler_form_file_id'])
            ), 
            $sql_template_update_document_handler_file
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        $results_update_data['folio_save']['total_success']++;
    } else {
        $results_update_data['folio_save']['total_failure']++;
    }


    // --- delete - document_handler_folder_file --- //
    $results_update_data['folio_save']['total_input'] += 1;

    $sql = str_replace(
        array(
            '[FILE_ID]' 
        ), 
        array(
            addslashes($api_data['document_handler_form_file_data_entry']['document_handler_form_file_id'])
        ), 
        $sql_template_delete_document_handler_folder_file
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        $results_update_data['folio_save']['total_success']++;
    } else {
        $results_update_data['folio_save']['total_failure']++;
    }


    // --- delete - document_handler_entity_folder_file --- //
    $results_update_data['folio_save']['total_input'] += 1;

    $sql = str_replace(
        array(
            '[FILE_ID]' 
        ), 
        array(
            addslashes($api_data['document_handler_form_file_data_entry']['document_handler_form_file_id'])
        ), 
        $sql_template_delete_document_handler_entity_folder_file
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        $results_update_data['folio_save']['total_success']++;
    } else {
        $results_update_data['folio_save']['total_failure']++;
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
            'file_id' => $submitted_file_id, 
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
                'file_id' => $submitted_file_id, 
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

    if ($results_update_data['folio_save']['total_input'] == $results_update_data['folio_save']['total_success']) {
        $results_update_data['folio_save']['is_success'] = true;
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- process update data results -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$total_overall_input = 0;
foreach ($results_update_data as $key1 => $value1) {
    $total_overall_input += $value1['total_input'];
}

$total_overall_success = 0;
foreach ($results_update_data as $key1 => $value1) {
    $total_overall_success += $value1['total_success'];
}

if ($total_overall_input == $total_overall_success) {
    $api_response['error'] = 'null';
} else {
    $api_response['error'] = '10030';
}

$api_response['message'] = array(
    'total_overall_input' => $total_overall_input, 
    'total_overall_success' => $total_overall_success
);

if (isset($api_data['access_mode'])) {
    switch ($api_data['access_mode']) {
        case 'entity_save':
            break;
        case 'folder_save':
            break;
        case 'file_save':
            break;
        case 'folio_save':
            $api_response['message']['submitted_file_id'] = $submitted_file_id;
            $api_response['message']['target_entity_info_list'] = $target_entity_info_list;
            $api_response['message']['target_folder_info_list'] = $target_folder_info_list;
            $api_response['message']['target_entity_folder_info_list'] = $target_entity_folder_info_list;
            $api_response['message']['target_folder_file_info_list'] = $target_folder_file_info_list;
            break;
    }
}

$api_response['data'] = array(
);

// if (! ($enable_updating[$target_data_source] == true && $results_update_data[$target_data_source]['is_success'] == true) && 
      // ($enable_updating['data_followup'] == true && $results_update_data['data_followup']['is_success'] == true) &&  
      // ($enable_updating['data_measurement'] == true && $results_update_data['data_measurement']['is_success'] == true)) {
    // mysql_query("ROLLBACK");
// }
?>