<?php
error_reporting(E_ALL);
// mysql_query("START TRANSACTION");


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- initialise variables -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$enable_saving = array(
    'entity_save' => false, 
    'folder_save' => false, 
    'file_save' => false, 
    'file_upload' => false, 
    'file_save_2' => false, 
    'folio_save' => false
);
if (isset($api_data['access_mode'])) {
    switch ($api_data['access_mode']) {
        case 'entity_save':
            $enable_saving['entity_save'] = true;
            break;
        case 'folder_save':
            $enable_saving['folder_save'] = true;
            break;
        case 'file_save':
            $enable_saving['file_save'] = true;
            break;
        case 'file_upload':
            $enable_saving['file_upload'] = true;
            break;
        case 'file_save_2':
            $enable_saving['file_save_2'] = true;
            break;
        case 'folio_save':
            $enable_saving['folio_save'] = true;
            break;
    }
}

$new_entity_id = null;
$new_folder_id = null;
$new_file_id = null;
$temp_text = '';


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- save entity -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_save_data['entity_save']['total_input'] = 0;
$results_save_data['entity_save']['total_success'] = 0;
$results_save_data['entity_save']['total_failure'] = 0;
$results_save_data['entity_save']['failure_indexes'] = array();
$results_save_data['entity_save']['is_success'] = false;

if ($enable_saving['entity_save'] == true) {
    $submitted_entity_id = null;
    $submitted_entity_name = $api_data['document_handler_form_entity_data_entry']['document_handler_form_entity_name'];

    $sql = str_replace(
        array(
            '[ENTITY_NAME]'
        ), 
        array(
            addslashes($submitted_entity_name)
        ), 
        $sql_template_retrieve_entity_by_name
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        if ($results['num_rows'] > 0) {
            while ($r1 = mysql_fetch_array($results['data'])) {
                $submitted_entity_id = $r1['entity_id'];
            }
        }
    }

    $new_entity_id = null;
    if ($submitted_entity_id == null) {
        $results_save_data['entity_save']['total_input'] = 1;

        $sql = str_replace(
            array('[TABLE_NAME]'), 
            array('document_handler_entity'), 
            $sql_template_retrieve_table_status
        );

        $results = executeDbQuery($sql, $db_connection);
        if ($results['error'] == 'null') {
            $r1 = mysql_fetch_array($results['data']);
            $new_entity_id = $r1['Auto_increment'];
        } else {
            $app_response['error'][] = $results['error'];
            $app_response['message'][] = $results['message'];
        }

        if ($new_entity_id != null) {
            $sql = str_replace(
                array(
                    '[ENTITY_ID]', 
                    '[MODULE]', 
                    '[ENTITY_NAME]', 
                    '[ENTITY_DESCRIPTION]', 
                    '[ENTITY_SUMMARY]', 
                    '[USER_ID]', 
                    '[GROUP_ID]'
                ), 
                array(
                    $new_entity_id, 
                    addslashes($api_data['module']), 
                    addslashes($api_data['document_handler_form_entity_data_entry']['document_handler_form_entity_name']), 
                    addslashes($api_data['document_handler_form_entity_data_entry']['document_handler_form_entity_description']), 
                    addslashes($api_data['document_handler_form_entity_data_entry']['document_handler_form_entity_summary']), 
                    addslashes($login_user_info['user_id']), 
                    addslashes($login_user_info['user_group_id']), 
                ), 
                $sql_template_insert_document_handler_entity
            );

            $results = executeDbQuery($sql, $db_connection);
            if ($results['error'] == 'null') {
                $results_save_data['entity_save']['total_success']++;
            } else {
                $results_save_data['entity_save']['total_failure']++;
            }
        }

        if ($results_save_data['entity_save']['total_input'] == $results_save_data['entity_save']['total_success']) {
            $results_save_data['entity_save']['is_success'] = true;
        }
    }

    if ($new_entity_id == null) {
        $new_entity_id = $submitted_entity_id;
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- save folder -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_save_data['folder_save']['total_input'] = 0;
$results_save_data['folder_save']['total_success'] = 0;
$results_save_data['folder_save']['total_failure'] = 0;
$results_save_data['folder_save']['failure_indexes'] = array();
$results_save_data['folder_save']['is_success'] = false;

if ($enable_saving['folder_save'] == true) {
    $submitted_folder_id = null;
    $submitted_folder_name = $api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_name'];

    $sql = str_replace(
        array(
            '[FOLDER_NAME]'
        ), 
        array(
            addslashes($submitted_folder_name)
        ), 
        $sql_template_retrieve_folder_by_name
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        if ($results['num_rows'] > 0) {
            while ($r1 = mysql_fetch_array($results['data'])) {
                $submitted_folder_id = $r1['folder_id'];
            }
        }
    }

    $new_folder_id = null;
    if ($submitted_folder_id == null) {
        $results_save_data['folder_save']['total_input'] = 1;

        $new_folder_id = null;
        $sql = str_replace(
            array('[TABLE_NAME]'), 
            array('document_handler_folder'), 
            $sql_template_retrieve_table_status
        );

        $results = executeDbQuery($sql, $db_connection);
        if ($results['error'] == 'null') {
            $r1 = mysql_fetch_array($results['data']);
            $new_folder_id = $r1['Auto_increment'];
        } else {
            $app_response['error'][] = $results['error'];
            $app_response['message'][] = $results['message'];
        }

        if ($new_folder_id != null) {
            $sql = str_replace(
                array(
                    '[FOLDER_ID]', 
                    '[FOLDER_NAME]', 
                    '[FOLDER_DESCRIPTION]', 
                    '[FOLDER_SUMMARY]', 
                    '[USER_ID]', 
                    '[GROUP_ID]'
                ), 
                array(
                    $new_folder_id, 
                    addslashes($api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_name']), 
                    addslashes($api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_description']), 
                    addslashes($api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_summary']), 
                    addslashes($login_user_info['user_id']), 
                    addslashes($login_user_info['user_group_id']), 
                ), 
                $sql_template_insert_document_handler_folder
            );

            $results = executeDbQuery($sql, $db_connection);
            if ($results['error'] == 'null') {
                $results_save_data['folder_save']['total_success']++;
            } else {
                $results_save_data['folder_save']['total_failure']++;
            }
        }

        if ($results_save_data['folder_save']['total_input'] == $results_save_data['folder_save']['total_success']) {
            $results_save_data['folder_save']['is_success'] = true;
        }
    }

    if ($new_folder_id == null) {
        $new_folder_id = $submitted_folder_id;
    }

    if ($new_folder_id != null) {
        if (isset($api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_entity_links'])) {
            if (count($api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_entity_links']) > 0) {
                for ($c1 = 0; $c1 < count($api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_entity_links']); $c1++) {
                    $submitted_entity_folder_id = null;
                    $submitted_entity_id = $api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_entity_links'][$c1];

                    $sql = str_replace(
                        array(
                            '[ENTITY_ID]', 
                            '[FOLDER_ID]'
                        ), 
                        array(
                            addslashes($submitted_entity_id), 
                            addslashes($new_folder_id)
                        ), 
                        $sql_template_retrieve_entity_folder_by_ids
                    );

                    $results = executeDbQuery($sql, $db_connection);
                    if ($results['error'] == 'null') {
                        if ($results['num_rows'] > 0) {
                            while ($r1 = mysql_fetch_array($results['data'])) {
                                $submitted_entity_folder_id = $r1['id'];
                            }
                        }
                    }

                    if ($submitted_entity_folder_id == null) {
                        $results_save_data['folder_save']['total_input'] += 1;

                        $sql = str_replace(
                            array(
                                '[MODULE]', 
                                '[ENTITY_ID]', 
                                '[FOLDER_ID]', 
                                '[USER_ID]', 
                                '[GROUP_ID]'
                            ), 
                            array(
                                addslashes($api_data['module']), 
                                addslashes($submitted_entity_id), 
                                $new_folder_id, 
                                addslashes($login_user_info['user_id']), 
                                addslashes($login_user_info['user_group_id'])
                            ), 
                            $sql_template_insert_document_handler_entity_folder
                        );

                        $results = executeDbQuery($sql, $db_connection);
                        if ($results['error'] == 'null') {
                            $results_save_data['folder_save']['total_success']++;
                        } else {
                            $results_save_data['folder_save']['total_failure']++;
                            $results_save_data['folder_save']['failure_indexes'][] = $c1;
                        }
                    }
                }
            } else {
                $submitted_entity_folder_id = null;
                $submitted_entity_id = $config['db']['entity_temp_id'];

                $sql = str_replace(
                    array(
                        '[ENTITY_ID]', 
                        '[FOLDER_ID]'
                    ), 
                    array(
                        addslashes($submitted_entity_id), 
                        addslashes($new_folder_id)
                    ), 
                    $sql_template_retrieve_entity_folder_by_ids
                );

                $results = executeDbQuery($sql, $db_connection);
                if ($results['error'] == 'null') {
                    if ($results['num_rows'] > 0) {
                        while ($r1 = mysql_fetch_array($results['data'])) {
                            $submitted_entity_folder_id = $r1['id'];
                        }
                    }
                }

                if ($submitted_entity_folder_id == null) {
                    $results_save_data['folder_save']['total_input'] += 1;

                    $sql = str_replace(
                        array(
                            '[MODULE]', 
                            '[ENTITY_ID]', 
                            '[FOLDER_ID]', 
                            '[USER_ID]', 
                            '[GROUP_ID]'
                        ), 
                        array(
                            addslashes($api_data['module']), 
                            $config['db']['entity_temp_id'], 
                            $new_folder_id, 
                            addslashes($login_user_info['user_id']), 
                            addslashes($login_user_info['user_group_id'])
                        ), 
                        $sql_template_insert_document_handler_entity_folder
                    );

                    $results = executeDbQuery($sql, $db_connection);
                    if ($results['error'] == 'null') {
                        $results_save_data['folder_save']['total_success']++;
                    } else {
                        $results_save_data['folder_save']['total_failure']++;
                        $results_save_data['folder_save']['failure_indexes'][] = $c1;
                    }
                }
            }
        }

        if (isset($api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_entity_info_links'])) {
            if (count($api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_entity_info_links']) > 0) {
                for ($c1 = 0; $c1 < count($api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_entity_info_links']); $c1++) {
                    $submitted_entity_folder_id = null;
                    $submitted_entity_name = $api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_entity_info_links'][$c1]['entity_name'];
                    $submitted_entity_id = $api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_entity_info_links'][$c1]['entity_id'];

                    $sql = str_replace(
                        array(
                            '[ENTITY_NAME]', 
                            '[FOLDER_NAME]'
                        ), 
                        array(
                            addslashes($submitted_entity_name), 
                            addslashes($submitted_folder_name)
                        ), 
                        $sql_template_retrieve_entity_folder_by_names
                    );

                    $results = executeDbQuery($sql, $db_connection);
                    if ($results['error'] == 'null') {
                        if ($results['num_rows'] > 0) {
                            while ($r1 = mysql_fetch_array($results['data'])) {
                                $submitted_entity_folder_id = $r1['id'];
                            }
                        }
                    }

                    if ($submitted_entity_folder_id == null) {
                        $results_save_data['folder_save']['total_input'] += 1;

                        $sql = str_replace(
                            array(
                                '[MODULE]', 
                                '[ENTITY_ID]', 
                                '[FOLDER_ID]', 
                                '[USER_ID]', 
                                '[GROUP_ID]'
                            ), 
                            array(
                                addslashes($api_data['module']), 
                                addslashes($submitted_entity_id), 
                                $new_folder_id, 
                                addslashes($login_user_info['user_id']), 
                                addslashes($login_user_info['user_group_id'])
                            ), 
                            $sql_template_insert_document_handler_entity_folder
                        );

                        $results = executeDbQuery($sql, $db_connection);
                        if ($results['error'] == 'null') {
                            $results_save_data['folder_save']['total_success']++;
                        } else {
                            $results_save_data['folder_save']['total_failure']++;
                            $results_save_data['folder_save']['failure_indexes'][] = $c1;
                        }
                    }
                }
            }
        }
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- save file -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_save_data['file_save']['total_input'] = 0;
$results_save_data['file_save']['total_success'] = 0;
$results_save_data['file_save']['total_failure'] = 0;
$results_save_data['file_save']['failure_indexes'] = array();
$results_save_data['file_save']['is_success'] = false;

if ($enable_saving['file_save'] == true) {
    $results_save_data['file_save']['total_input'] = 1 + count($api_data['document_handler_form_file_data_entry']['document_handler_form_file_folder_links']);

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
            $results_save_data['file_save']['total_success']++;
        } else {
            $results_save_data['file_save']['total_failure']++;
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
                    $new_file_id, 
                    addslashes($login_user_info['user_id']), 
                    addslashes($login_user_info['user_group_id'])
                ), 
                $sql_template_insert_document_handler_folder_file
            );

            $results = executeDbQuery($sql, $db_connection);
            if ($results['error'] == 'null') {
                $results_save_data['file_save']['total_success']++;
            } else {
                $results_save_data['file_save']['total_failure']++;
                $results_save_data['file_save']['failure_indexes'][] = $c1;
            }
        }

        if (count($api_data['document_handler_form_file_data_entry']['document_handler_form_file_folder_links']) == 0) {
            $results_save_data['file_save']['total_input'] += 1;

            $sql = str_replace(
                array(
                    '[FOLDER_ID]', 
                    '[FILE_ID]', 
                    '[USER_ID]', 
                    '[GROUP_ID]'
                ), 
                array(
                    $config['db']['folder_temp_id'], 
                    $new_file_id, 
                    addslashes($login_user_info['user_id']), 
                    addslashes($login_user_info['user_group_id'])
                ), 
                $sql_template_insert_document_handler_folder_file
            );

            $results = executeDbQuery($sql, $db_connection);
            if ($results['error'] == 'null') {
                $results_save_data['file_save']['total_success']++;
            } else {
                $results_save_data['file_save']['total_failure']++;
                $results_save_data['file_save']['failure_indexes'][] = $c1;
            }
        }
    }

    if ($results_save_data['file_save']['total_input'] == $results_save_data['file_save']['total_success']) {
        $results_save_data['file_save']['is_success'] = true;
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- save file 2 -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_save_data['file_save_2']['total_input'] = 0;
$results_save_data['file_save_2']['total_success'] = 0;
$results_save_data['file_save_2']['total_failure'] = 0;
$results_save_data['file_save_2']['failure_indexes'] = array();
$results_save_data['file_save_2']['is_success'] = false;

if ($enable_saving['file_save_2'] == true) {
    $submitted_file_external_ref_name = $api_data['file_external_ref_name'];

    $temp_array = explode('___', $submitted_file_external_ref_name);
    if (count($temp_array) >= 4) {
        $submitted_file_external_ref_name = $temp_array[3];
    }

    $temp_array = explode('.', $submitted_file_external_ref_name);
    if (count($temp_array) == 2) {
        $submitted_file_external_ref_name = substr($temp_array[0], 0, 25);
    }

    $sql = str_replace(
        array(
            '[FILE_EXTERNAL_REF_NAME]'
        ), 
        array(
            $submitted_file_external_ref_name
        ), 
        $sql_template_retrieve_download_file_info
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        $file_id = '';
        $file_extension = '';
        $file_type = '';

        if ($results['num_rows'] > 0) {
            $results_retrieve_data['file_download']['is_success'] = true;
            $r1 = mysql_fetch_array($results['data']);
            $file_id = $r1['file_id'];
            $file_extension = $r1['file_extension'];
            $file_type = $r1['file_type'];
        } else {
            $sql = str_replace(
                array(
                    '[FILE_EXTERNAL_REF_NAME]'
                ), 
                array(
                    $submitted_file_external_ref_name
                ), 
                $sql_template_retrieve_download_file_info_2
            );

            $results2 = executeDbQuery($sql, $db_connection);
            if ($results2['error'] == 'null') {
                if ($results2['num_rows'] > 0) {
                    $results_retrieve_data['file_download']['is_success'] = true;
                    $r2 = mysql_fetch_array($results2['data']);
                    $file_id = $r2['file_id'];
                    $file_extension = $r2['file_extension'];
                    $file_type = $r2['file_type'];
                }
            }
        }

        if ($file_id != '' && $file_extension != '' && $file_type != '') {
            $results_save_data['file_save_2']['total_input'] = 2;

            $file_error = null;
            if (isset($api_data['document_handler_form_file_in_base64'])) {
                $file_content = base64_decode($api_data['document_handler_form_file_in_base64']);

                $file_external_ref_name = generateRandomString(25);
                $new_file_path = $config['path']['upload_folder'] . $file_external_ref_name . '.' . $file_extension;

                $file_error = file_put_contents($new_file_path, $file_content);
            }
            if ($file_error != null && $file_error !== false) {
                $results_save_data['file_save_2']['total_success']++;
            }

            $sql = str_replace(
                array(
                    '[FILE_ID]', 
                    '[FILE_EXTERNAL_REF_NAME]', 
                    '[USER_ID]', 
                    '[GROUP_ID]'
                ), 
                array(
                    $file_id, 
                    $file_external_ref_name, 
                    addslashes($login_user_info['user_id']), 
                    addslashes($login_user_info['user_group_id'])
                ), 
                $sql_template_insert_document_handler_file_version
            );

            $results3 = executeDbQuery($sql, $db_connection);
            if ($results3['error'] == 'null') {
                $results_save_data['file_save_2']['total_success']++;
            } else {
                $results_save_data['file_save_2']['total_failure']++;
            }
        } else {
            $results_save_data['file_save_2']['total_input'] = 4;

            $temp_entity_name = $api_data['username'];
            $url = $config['path']['base_script_url'] . '?api_mode=1';

            $request_data = array(
                'document_handler_form_operation' => 'save', 
                'access_mode' => 'entity_save', 
                'module' => $api_data['module'], 
                'username' => $api_data['username'], 
                'password' => $api_data['password'], 
                'document_handler_form_entity_data_entry' => array(
                    'document_handler_form_entity_name' => $temp_entity_name, 
                    'document_handler_form_entity_description' => '', 
                    'document_handler_form_entity_summary' => ''
                )
            );

            $results2 = requestCurlCall($url, $request_data);
            if ($results2['error'] == 'null') {
                $results_save_data['file_save_2']['total_success']++;

                $temp_text = ucfirst(str_replace('_', '', $api_data['module']));
                $temp_folder_name = $temp_text . ' (' . date('Y-m-d H:i:s') . ')';
                $url = $config['path']['base_script_url'] . '?api_mode=1';

                $request_data = array(
                    'document_handler_form_operation' => 'save', 
                    'access_mode' => 'folder_save', 
                    'module' => $api_data['module'], 
                    'username' => $api_data['username'], 
                    'password' => $api_data['password'], 
                    'document_handler_form_folder_data_entry' => array(
                        'document_handler_form_folder_name' => $temp_folder_name, 
                        'document_handler_form_folder_description' => '', 
                        'document_handler_form_folder_summary' => '', 
                        'document_handler_form_folder_entity_links' => array(
                            $results2['message']['new_entity_id']
                            // $config['db']['entity_temp_id']
                        )
                    )
                );

                $results3 = requestCurlCall($url, $request_data);
                if ($results3['error'] == 'null') {
                    $results_save_data['file_save_2']['total_success']++;

                    $file_error = null;
                    if (isset($api_data['document_handler_form_file_in_base64'])) {
                        $file_content = base64_decode($api_data['document_handler_form_file_in_base64']);

                        $temp_array = explode('.', $api_data['file_external_ref_name']);
                        $file_extension = '';
                        if (isset($temp_array[1])) {
                            $file_extension = $temp_array[1];
                        }

                        $file_external_ref_name = generateRandomString(25);
                        $new_file_path = $config['path']['upload_folder'] . $file_external_ref_name . '.' . $file_extension;

                        $file_error = file_put_contents($new_file_path, $file_content);

                        sleep(2);
                        $file_extension = pathinfo($new_file_path, PATHINFO_EXTENSION);
                        $file_size = filesize($new_file_path);
                        $file_type = $config['mime_types'][$file_extension];
                    }
                    if ($file_error != null && $file_error !== false) {
                        $results_save_data['file_save_2']['total_success']++;

                        $temp_file_name = $api_data['file_external_ref_name'];
                        $url = $config['path']['base_script_url'] . '?api_mode=1';
                        $request_data = array(
                            'document_handler_form_operation' => 'save', 
                            'access_mode' => 'file_save', 
                            'username' => $api_data['username'], 
                            'password' => $api_data['password'], 
                            'document_handler_form_file_data_entry' => array(
                                'document_handler_form_file_name' => $temp_file_name, 
                                'document_handler_form_file_description' => '', 
                                'document_handler_form_file_summary' => '', 
                                'document_handler_form_file_from' => '', 
                                'document_handler_form_file_date_received' => date('Y-m-d H:i:s'), 
                                'document_handler_form_file_to' => '', 
                                'document_handler_form_file_date_sent' => '', 
                                'document_handler_form_file_content_date' => date('Y-m-d H:i:s'), 
                                'document_handler_form_file_content_category' => '', 
                                'document_handler_form_file_original_name' => $temp_file_name, 
                                'document_handler_form_file_extension' => $file_extension, 
                                'document_handler_form_file_type' => $file_type, 
                                'document_handler_form_file_size' => $file_size, 
                                'document_handler_form_file_external_ref_name' => $file_external_ref_name, 
                                'document_handler_form_file_folder_links' => array(
                                    $results3['message']['new_folder_id']
                                    // $config['db']['folder_temp_id']
                                )
                            )
                        );

                        if ($api_data['module'] == 'adhoc_email') {
                            $request_data['document_handler_form_file_data_entry']['document_handler_form_file_from'] = base64_decode($api_data['email_sender']);
                            $request_data['document_handler_form_file_data_entry']['document_handler_form_file_to'] = base64_decode($api_data['email_recipient']);
                            $request_data['document_handler_form_file_data_entry']['document_handler_form_file_date_received'] = base64_decode($api_data['email_date_time']);
                            $request_data['document_handler_form_file_data_entry']['document_handler_form_file_description'] = base64_decode($api_data['email_subject']);
                            $request_data['document_handler_form_file_data_entry']['document_handler_form_file_summary'] = base64_decode($api_data['email_message']);
                        }

                        $results4 = requestCurlCall($url, $request_data);
                        if ($results4['error'] == 'null' || $results4['error'] != 'null') {
                            $results_save_data['file_save_2']['total_success']++;
                        }
                    }
                }
            }
        }
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- upload file -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_save_data['file_upload']['total_input'] = 0;
$results_save_data['file_upload']['total_success'] = 0;
$results_save_data['file_upload']['total_failure'] = 0;
$results_save_data['file_upload']['failure_indexes'] = array();
$results_save_data['file_upload']['is_success'] = false;

$file_name = null;
$file_extension = null;
$file_type = null;
$file_size = null;
$file_external_ref_name = null;
$file_error = null;

if ($enable_saving['file_upload'] == true) {
    $results_save_data['file_upload']['total_input'] = 1;

    $file_name = $_FILES['document_handler_form_file_info']['name'];
    $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
    $new_file_name = str_replace('.' . $file_extension, '', $file_name);
    $file_type = $_FILES['document_handler_form_file_info']['type'];
    $file_size = $_FILES['document_handler_form_file_info']['size'];
    $file_error = $_FILES['document_handler_form_file_info']['error'];
    $file_content = file_get_contents($_FILES['document_handler_form_file_info']['tmp_name']);

    $file_external_ref_name = generateRandomString(25);

    $new_file_name = $file_external_ref_name . '.' . $file_extension;
    $new_file_path = $config['path']['upload_folder'] . $new_file_name;
    file_put_contents($new_file_path, $file_content);

    if ($file_error == 0) {
        $results_save_data['file_upload']['total_success']++;
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- save folio -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
include('script_module_save_data_folio.php');


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- process save data results -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$total_overall_input = 0;
foreach ($results_save_data as $key1 => $value1) {
    $total_overall_input += $value1['total_input'];
}

$total_overall_success = 0;
foreach ($results_save_data as $key1 => $value1) {
    $total_overall_success += $value1['total_success'];
}

if ($total_overall_input == $total_overall_success) {
    $api_response['error'] = 'null';
} else {
    $api_response['error'] = '10010';
}

$api_response['message'] = array(
    'total_overall_input' => $total_overall_input, 
    'total_overall_success' => $total_overall_success, 
    'temp_text' => $temp_text
);

if (isset($api_data['access_mode'])) {
    switch ($api_data['access_mode']) {
        case 'entity_save':
            $api_response['message']['new_entity_id'] = $new_entity_id;
            break;
        case 'folder_save':
            $api_response['message']['new_folder_id'] = $new_folder_id;
            break;
        case 'file_save':
            $api_response['message']['new_file_id'] = $new_file_id;
            break;
        case 'file_upload':
            $api_response['message']['file_name'] = $file_name;
            $api_response['message']['file_extension'] = $file_extension;
            $api_response['message']['file_type'] = $file_type;
            $api_response['message']['file_size'] = $file_size;
            $api_response['message']['file_external_ref_name'] = $file_external_ref_name;
            $api_response['message']['file_error'] = $file_error;
            break;
        case 'file_save_2':
            break;
        case 'folio_save':
            $api_response['message']['new_file_id'] = $new_file_id;
            $api_response['message']['target_entity_info_list'] = $target_entity_info_list;
            $api_response['message']['target_folder_info_list'] = $target_folder_info_list;
            $api_response['message']['target_entity_folder_info_list'] = $target_entity_folder_info_list;
            $api_response['message']['target_folder_file_info_list'] = $target_folder_file_info_list;
            break;
    }
}

$api_response['data'] = array(
);


// if ($total_overall_input != $total_overall_success) {
//     mysql_query("ROLLBACK");
// }
?>