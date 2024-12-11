<?php
/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- initialise variables -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$enable_retrieve = array(
    'entity_list' => false, 
    'entity_folder_list' => false, 
    'folder_file_list' => false, 
    'file_download' => false, 
    'template_data_tag_list' => false, 
    'msword_plugin_download' => false, 
    'msoutlook_plugin_download' => false, 
    'entity_search_list' => false, 
);
if (isset($api_data['access_mode'])) {
    switch ($api_data['access_mode']) {
        case 'entity_list':
            $enable_retrieve['entity_list'] = true;
            break;
        case 'entity_folder_list':
            $enable_retrieve['entity_folder_list'] = true;
            break;
        case 'folder_file_list':
            $enable_retrieve['folder_file_list'] = true;
            break;
        case 'file_download':
            $enable_retrieve['file_download'] = true;
            break;
        case 'template_data_tag_list':
            $enable_retrieve['template_data_tag_list'] = true;
            break;
        case 'msword_plugin_download':
            $enable_retrieve['msword_plugin_download'] = true;
            break;
        case 'msoutlook_plugin_download':
            $enable_retrieve['msoutlook_plugin_download'] = true;
            break;
        case 'entity_search_list':
        case 'contact_from_search_list':
        case 'contact_to_search_list':
            $enable_retrieve['entity_search_list'] = true;
            break;
    }
}


$document_handler_form_entity_list = array();
$document_handler_form_entity_folder_list = array();
$document_handler_form_folder_file_list = array();
$template_data_tag_list = array();
$document_handler_form_entity_search_list = array();


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- retrieve entity_list -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_retrieve_data['entity_list']['is_success'] = true;
$results_retrieve_data['entity_list']['total_record'] = 0;

if ($enable_retrieve['entity_list'] == true) {

    $target_sql = $sql_template_retrieve_entity_list_1;
    if (isset($api_data['module']) && $api_data['module'] == '') {
        $target_sql = $sql_template_retrieve_entity_list_2;
    }
    $sql = str_replace(
        array(
            '[MODULE]'
        ), 
        array(
            addslashes($api_data['module'])
        ), 
        $target_sql
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        $results_retrieve_data['entity_list']['is_success'] = true;

        while ($r1 = mysql_fetch_array($results['data'])) {
            $current_item_index = count($document_handler_form_entity_list);

            $document_handler_form_entity_list[$current_item_index]['entity_id'] = $r1['entity_id'];
            $document_handler_form_entity_list[$current_item_index]['entity_name'] = $r1['entity_name'];
            $document_handler_form_entity_list[$current_item_index]['entity_description'] = $r1['entity_description'];
            $document_handler_form_entity_list[$current_item_index]['entity_summary'] = $r1['entity_summary'];
            $document_handler_form_entity_list[$current_item_index]['entity_date_created'] = $r1['entity_date_created'];
        }
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- retrieve entity_folder_list -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_retrieve_data['entity_folder_list']['is_success'] = true;
$results_retrieve_data['entity_folder_list']['total_record'] = 0;

if ($enable_retrieve['entity_folder_list'] == true) {
    $target_sql = $sql_template_retrieve_entity_folder_list_1;
    if (isset($api_data['module']) && $api_data['module'] == '') {
        $target_sql = $sql_template_retrieve_entity_folder_list_2;
    }
    $sql = str_replace(
        array(
            '[MODULE]', 
            '[ENTITY_ID]'
        ), 
        array(
            addslashes($api_data['module']), 
            $api_data['entity_id']
        ), 
        $target_sql
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        $results_retrieve_data['entity_folder_list']['is_success'] = true;

        while ($r1 = mysql_fetch_array($results['data'])) {
            $current_item_index = count($document_handler_form_entity_folder_list);

            $document_handler_form_entity_folder_list[$current_item_index]['folder_id'] = $r1['folder_id'];
            $document_handler_form_entity_folder_list[$current_item_index]['folder_name'] = $r1['folder_name'];
            $document_handler_form_entity_folder_list[$current_item_index]['folder_description'] = $r1['folder_description'];
            $document_handler_form_entity_folder_list[$current_item_index]['folder_summary'] = $r1['folder_summary'];
            $document_handler_form_entity_folder_list[$current_item_index]['folder_date_created'] = $r1['folder_date_created'];

            $sql = str_replace(
                array(
                    '[FOLDER_ID]' 
                ), 
                array(
                    $r1['folder_id']
                ), 
                $sql_template_retrieve_folder_entity_list
            );

            $current_folder_entity_list = array();

            $results2 = executeDbQuery($sql, $db_connection);
            if ($results2['error'] == 'null') {
                while ($r2 = mysql_fetch_array($results2['data'])) {
                    $current_item_index2 = count($current_folder_entity_list);
                    $current_folder_entity_list[$current_item_index2]['entity_id'] = $r2['entity_id'];
                    $current_folder_entity_list[$current_item_index2]['entity_name'] = $r2['entity_name'];
                    $current_folder_entity_list[$current_item_index2]['entity_description'] = $r2['entity_description'];
                    $current_folder_entity_list[$current_item_index2]['entity_date_created'] = $r2['entity_date_created'];
                }
            }

            $document_handler_form_entity_folder_list[$current_item_index]['folder_entity_list'] = $current_folder_entity_list;
        }
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- retrieve folder_file_list -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_retrieve_data['folder_file_list']['is_success'] = true;
$results_retrieve_data['folder_file_list']['total_record'] = 0;

if ($enable_retrieve['folder_file_list'] == true) {
    $target_sql = $sql_template_retrieve_folder_file_list_1;
    if (isset($api_data['default_content_category']) && $api_data['default_content_category'] == '') {
        $target_sql = $sql_template_retrieve_folder_file_list_2;
    }
    $sql = str_replace(
        array(
            '[FOLDER_ID]', 
            '[CONTENT_CATEGORY]'
        ), 
        array(
            $api_data['folder_id'], 
            $api_data['default_content_category']
        ), 
        $target_sql 
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        $results_retrieve_data['folder_file_list']['is_success'] = true;

        while ($r1 = mysql_fetch_array($results['data'])) {
            $current_item_index = count($document_handler_form_folder_file_list);

            $document_handler_form_folder_file_list[$current_item_index]['file_id'] = $r1['file_id'];
            $document_handler_form_folder_file_list[$current_item_index]['file_name'] = $r1['file_name'];
            $document_handler_form_folder_file_list[$current_item_index]['file_description'] = $r1['file_description'];
            $document_handler_form_folder_file_list[$current_item_index]['file_summary'] = $r1['file_summary'];
            $document_handler_form_folder_file_list[$current_item_index]['file_from'] = $r1['file_from'];
            $document_handler_form_folder_file_list[$current_item_index]['file_date_received'] = $r1['file_date_received'];
            $document_handler_form_folder_file_list[$current_item_index]['file_to'] = $r1['file_to'];
            $document_handler_form_folder_file_list[$current_item_index]['file_date_sent'] = $r1['file_date_sent'];
            $document_handler_form_folder_file_list[$current_item_index]['file_content_date'] = $r1['file_content_date'];
            $document_handler_form_folder_file_list[$current_item_index]['file_content_category'] = $r1['file_content_category'];
            $document_handler_form_folder_file_list[$current_item_index]['file_original_name'] = $r1['file_original_name'];
            $document_handler_form_folder_file_list[$current_item_index]['file_extension'] = $r1['file_extension'];
            $document_handler_form_folder_file_list[$current_item_index]['file_type'] = $r1['file_type'];
            $document_handler_form_folder_file_list[$current_item_index]['file_size'] = $r1['file_size'];
            $document_handler_form_folder_file_list[$current_item_index]['file_external_ref_name'] = $r1['file_external_ref_name'];
            $document_handler_form_folder_file_list[$current_item_index]['file_status'] = $r1['file_status'];
            $document_handler_form_folder_file_list[$current_item_index]['file_date_created'] = $r1['file_date_created'];

            $sql = str_replace(
                array(
                    '[FILE_ID]' 
                ), 
                array(
                    $r1['file_id']
                ), 
                $sql_template_retrieve_file_folder_list
            );

            $current_file_folder_list = array();

            $results2 = executeDbQuery($sql, $db_connection);
            if ($results2['error'] == 'null') {
                while ($r2 = mysql_fetch_array($results2['data'])) {
                    $current_item_index2 = count($current_file_folder_list);
                    $current_file_folder_list[$current_item_index2]['folder_id'] = $r2['folder_id'];
                    $current_file_folder_list[$current_item_index2]['folder_name'] = $r2['folder_name'];
                    $current_file_folder_list[$current_item_index2]['folder_description'] = $r2['folder_description'];
                    $current_file_folder_list[$current_item_index2]['folder_date_created'] = $r2['folder_date_created'];

                    $sql = str_replace(
                        array(
                            '[FOLDER_ID]' 
                        ), 
                        array(
                            $r2['folder_id']
                        ), 
                        $sql_template_retrieve_folder_entity_list
                    );

                    $current_folder_entity_list = array();

                    $results3 = executeDbQuery($sql, $db_connection);
                    if ($results3['error'] == 'null') {
                        while ($r3 = mysql_fetch_array($results3['data'])) {
                            $current_item_index3 = count($current_folder_entity_list);
                            $current_folder_entity_list[$current_item_index3]['entity_id'] = $r3['entity_id'];
                            $current_folder_entity_list[$current_item_index3]['entity_name'] = $r3['entity_name'];
                            $current_folder_entity_list[$current_item_index3]['entity_description'] = $r3['entity_description'];
                            $current_folder_entity_list[$current_item_index3]['entity_date_created'] = $r3['entity_date_created'];
                        }
                    }

                    $current_file_folder_list[$current_item_index2]['folder_entity_list'] = $current_folder_entity_list;
                }
            }
            $document_handler_form_folder_file_list[$current_item_index]['file_folder_list'] = $current_file_folder_list;


            $sql = str_replace(
                array(
                    '[FILE_ID]' 
                ), 
                array(
                    $r1['file_id']
                ), 
                $sql_template_retrieve_file_folder_entity_list
            );

            $current_file_folder_entity_list = array();

            $results2 = executeDbQuery($sql, $db_connection);
            if ($results2['error'] == 'null') {
                while ($r2 = mysql_fetch_array($results2['data'])) {
                    $current_item_index2 = count($current_file_folder_entity_list);
                    $current_file_folder_entity_list[$current_item_index2]['entity_id'] = $r2['entity_id'];
                    $current_file_folder_entity_list[$current_item_index2]['entity_name'] = $r2['entity_name'];
                    $current_file_folder_entity_list[$current_item_index2]['entity_description'] = $r2['entity_description'];
                    $current_file_folder_entity_list[$current_item_index2]['entity_date_created'] = $r2['entity_date_created'];
                    $current_file_folder_entity_list[$current_item_index2]['folder_id'] = $r2['folder_id'];
                    $current_file_folder_entity_list[$current_item_index2]['folder_name'] = $r2['folder_name'];
                    $current_file_folder_entity_list[$current_item_index2]['folder_description'] = $r2['folder_description'];
                    $current_file_folder_entity_list[$current_item_index2]['folder_date_created'] = $r2['folder_date_created'];
                }
            }
            $document_handler_form_folder_file_list[$current_item_index]['file_folder_entity_list'] = $current_file_folder_entity_list;


            $sql = str_replace(
                array(
                    '[FILE_ID]' 
                ), 
                array(
                    $r1['file_id']
                ), 
                $sql_template_retrieve_file_version_list
            );

            $current_file_version_list = array();

            $results2 = executeDbQuery($sql, $db_connection);
            if ($results2['error'] == 'null') {
                while ($r2 = mysql_fetch_array($results2['data'])) {
                    $current_item_index2 = count($current_file_version_list);
                    $current_file_version_list[$current_item_index2]['file_version_external_ref_name'] = $r2['file_version_external_ref_name'];
                    $current_file_version_list[$current_item_index2]['file_version_date_created'] = $r2['file_version_date_created'];
                }
            }

            $document_handler_form_folder_file_list[$current_item_index]['file_version_list'] = $current_file_version_list;
        }
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- download file -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_retrieve_data['file_download']['is_success'] = true;
$results_retrieve_data['file_download']['total_record'] = 0;

if ($enable_retrieve['file_download'] == true) {
    // ----- get file record ----- //
    $sql = str_replace(
        array(
            '[FILE_EXTERNAL_REF_NAME]'
        ), 
        array(
            $api_data['file_external_ref_name']
        ), 
        $sql_template_retrieve_download_file_info
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        $file_record = null;
        $new_file_id = null;
        $success_insert_file_record = false;
        $file_extension = '';
        $file_type = '';

        if ($results['num_rows'] > 0) {
            $results_retrieve_data['file_download']['is_success'] = true;
            $r1 = mysql_fetch_array($results['data']);
            foreach ($r1 as $key1 => $value1) {
                if (!is_int($key1)) {
                    $file_record[$key1] = $value1;
                }
            }
            $file_extension = $r1['file_extension'];
            $file_type = $r1['file_type'];
        } else {
            $sql = str_replace(
                array(
                    '[FILE_EXTERNAL_REF_NAME]'
                ), 
                array(
                    $api_data['file_external_ref_name']
                ), 
                $sql_template_retrieve_download_file_info_2
            );

            $results2 = executeDbQuery($sql, $db_connection);
            if ($results2['error'] == 'null') {
                if ($results2['num_rows'] > 0) {
                    $results_retrieve_data['file_download']['is_success'] = true;
                    $r2 = mysql_fetch_array($results2['data']);
                    foreach ($r2 as $key2 => $value2) {
                        if (!is_int($key2)) {
                            $file_record[$key2] = $value2;
                        }
                    }
                    $file_extension = $r2['file_extension'];
                    $file_type = $r2['file_type'];
                }
            }
        }

        if ($file_extension != '' && $file_type != '') {
            if (isset($api_data['download_option']) && $api_data['download_option'] == 'dl_dm') {
                // ----- get entity record ----- //
                $entity_record = null;
                $new_entity_id = null;
                $success_insert_entity_record = false;

                $target_sql = $sql_template_retrieve_entity_list_1;
                if (isset($api_data['module']) && $api_data['module'] == '') {
                    $target_sql = $sql_template_retrieve_entity_list_2;
                }
                $sql = str_replace(
                    array(
                        '[MODULE]'
                    ), 
                    array(
                        addslashes($api_data['module'])
                    ), 
                    $target_sql
                );

                $results3 = executeDbQuery($sql, $db_connection);
                if ($results3['error'] == 'null') {
                    while ($r3 = mysql_fetch_array($results3['data'])) {
                        if ($r3['entity_name'] == $api_data['entity_name']) {
                            foreach ($r3 as $key3 => $value3) {
                                if (!is_int($key3)) {
                                    $entity_record[$key3] = $value3;
                                }
                            }
                            break;
                        }
                    }
                }

                if ($entity_record == null) {
                    // ----- insert entity record ----- //
                    $sql = str_replace(
                        array('[TABLE_NAME]'), 
                        array('document_handler_entity'), 
                        $sql_template_retrieve_table_status
                    );

                    $results4 = executeDbQuery($sql, $db_connection);
                    if ($results4['error'] == 'null') {
                        $r4 = mysql_fetch_array($results4['data']);
                        $new_entity_id = $r4['Auto_increment'];
                    } else {
                        $app_response['error'][] = $results4['error'];
                        $app_response['message'][] = $results4['message'];
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
                                addslashes($api_data['module'] . '_applied'), 
                                addslashes($api_data['entity_name']), 
                                addslashes(''), 
                                addslashes(''), 
                                addslashes($login_user_info['user_id']), 
                                addslashes($login_user_info['user_group_id']), 
                            ), 
                            $sql_template_insert_document_handler_entity
                        );

                        $results5 = executeDbQuery($sql, $db_connection);
                        if ($results5['error'] == 'null') {
                            $success_insert_entity_record = true;
                            $entity_record['entity_id'] = $new_entity_id;
                            $entity_record['entity_name'] = $api_data['entity_name'];
                            $entity_record['entity_description'] = '';
                            $entity_record['entity_summary'] = '';
                            $entity_record['entity_date_created'] = date('Y-m-d H:i:s');
                        }
                    }
                }

                // ----- get folder record ----- //
                $folder_record = null;
                $new_folder_id = null;
                $success_insert_folder_record = false;

                $target_sql = $sql_template_retrieve_entity_folder_list_1;
                if (isset($api_data['module']) && $api_data['module'] == '') {
                    $target_sql = $sql_template_retrieve_entity_folder_list_2;
                }
                $sql = str_replace(
                    array(
                        '[MODULE]', 
                        '[ENTITY_ID]'
                    ), 
                    array(
                        addslashes($api_data['module']), 
                        $entity_record['entity_id']
                    ), 
                    $target_sql
                );

                $results6 = executeDbQuery($sql, $db_connection);
                if ($results6['error'] == 'null') {
                    while ($r6 = mysql_fetch_array($results6['data'])) {
                        if ($r6['folder_name'] == $api_data['folder_name']) {
                            foreach ($r6 as $key6 => $value6) {
                                if (!is_int($key6)) {
                                    $folder_record[$key6] = $value6;
                                }
                            }
                            break;
                        }
                    }
                }

                if ($folder_record == null) {
                    // ----- insert folder record ----- //
                    $new_folder_id = null;
                    $sql = str_replace(
                        array('[TABLE_NAME]'), 
                        array('document_handler_folder'), 
                        $sql_template_retrieve_table_status
                    );

                    $results7 = executeDbQuery($sql, $db_connection);
                    if ($results7['error'] == 'null') {
                        $r7 = mysql_fetch_array($results7['data']);
                        $new_folder_id = $r7['Auto_increment'];
                    } else {
                        $app_response['error'][] = $results7['error'];
                        $app_response['message'][] = $results7['message'];
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
                                addslashes($api_data['folder_name']), 
                                addslashes(''), 
                                addslashes(''), 
                                addslashes($login_user_info['user_id']), 
                                addslashes($login_user_info['user_group_id']), 
                            ), 
                            $sql_template_insert_document_handler_folder
                        );

                        $results8 = executeDbQuery($sql, $db_connection);
                        if ($results8['error'] == 'null') {
                            $folder_record['folder_id'] = $new_folder_id;
                            $folder_record['folder_name'] = $api_data['folder_name'];
                            $folder_record['folder_description'] = '';
                            $folder_record['folder_summary'] = '';
                            $folder_record['folder_date_created'] = date('Y-m-d H:i:s');

                            $sql = str_replace(
                                array(
                                    '[MODULE]', 
                                    '[ENTITY_ID]', 
                                    '[FOLDER_ID]', 
                                    '[USER_ID]', 
                                    '[GROUP_ID]'
                                ), 
                                array(
                                    addslashes($api_data['module'] . '_applied'), 
                                    addslashes($entity_record['entity_id']), 
                                    $new_folder_id, 
                                    addslashes($login_user_info['user_id']), 
                                    addslashes($login_user_info['user_group_id'])
                                ), 
                                $sql_template_insert_document_handler_entity_folder
                            );

                            $results9 = executeDbQuery($sql, $db_connection);
                            if ($results9['error'] == 'null') {
                                $success_insert_folder_record = true;
                            }
                        }
                    }
                }

                // ----- insert file record ----- //
                $new_file_id = null;

                $new_file_name = $file_record['file_name'] . ' (' . $api_data['entity_name'] . ')';

                $file_content = file_get_contents($config['path']['upload_folder'] . $file_record['file_external_ref_name'] . '.' . $file_record['file_extension']);
                $new_file_external_ref_name = generateRandomString(25);
                $new_file_path = $config['path']['upload_folder'] . $new_file_external_ref_name . '.' . $file_record['file_extension'];
                $file_error = file_put_contents($new_file_path, $file_content);
                while (!file_exists($new_file_path)) {
                    sleep(1);
                }

                $new_file_content_category = 'Download Data Merge';
                $new_file_status = 'Published';

                $sql = str_replace(
                    array('[TABLE_NAME]'), 
                    array('document_handler_file'), 
                    $sql_template_retrieve_table_status
                );
                $results10 = executeDbQuery($sql, $db_connection);
                if ($results10['error'] == 'null') {
                    $r10 = mysql_fetch_array($results10['data']);
                    $new_file_id = $r10['Auto_increment'];
                } else {
                    $app_response['error'][] = $results10['error'];
                    $app_response['message'][] = $results10['message'];
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
                            addslashes($new_file_name), 
                            addslashes($file_record['file_description']), 
                            addslashes($file_record['file_summary']), 
                            addslashes($file_record['file_from']), 
                            addslashes($file_record['file_date_received']), 
                            addslashes($file_record['file_to']), 
                            addslashes($file_record['file_date_sent']), 
                            addslashes($file_record['file_content_date']), 
                            addslashes($new_file_content_category), 
                            addslashes($file_record['file_original_name']), 
                            addslashes($file_record['file_extension']), 
                            addslashes($file_record['file_type']), 
                            addslashes($file_record['file_size']), 
                            addslashes($new_file_external_ref_name), 
                            addslashes($new_file_status), 
                            addslashes($login_user_info['user_id']), 
                            addslashes($login_user_info['user_group_id'])
                        ), 
                        $sql_template_insert_document_handler_file
                    );

                    $results11 = executeDbQuery($sql, $db_connection);
                    if ($results11['error'] == 'null') {
                        $sql = str_replace(
                            array(
                                '[FOLDER_ID]', 
                                '[FILE_ID]', 
                                '[USER_ID]', 
                                '[GROUP_ID]'
                            ), 
                            array(
                                $folder_record['folder_id'], 
                                $new_file_id, 
                                addslashes($login_user_info['user_id']), 
                                addslashes($login_user_info['user_group_id'])
                            ), 
                            $sql_template_insert_document_handler_folder_file
                        );

                        $results12 = executeDbQuery($sql, $db_connection);
                        if ($results12['error'] == 'null') {
                            $success_insert_file_record = true;
                        }
                    }
                }
            }

            // ----- process download ----- //
            $source_file_name = $api_data['file_external_ref_name'] . '.' . $file_extension;
            if (isset($api_data['download_option']) && $api_data['download_option'] == 'dl_dm') {
                if ($success_insert_file_record == true) {
                    $source_file_name = $new_file_external_ref_name . '.' . $file_extension;
                }
            }

            $source_file_path = $config['path']['upload_folder'] . $source_file_name;

            $download_file_name = $api_data['entity_name'] . "___";
            $download_file_name .= $api_data['folder_name'] . "___";
            $download_file_name .= $api_data['file_name'] . "___";
            $download_file_name .= $source_file_name;

            $source_file_content = file_get_contents($source_file_path);
            $source_file_size = filesize($source_file_path);

            header('Pragma: public');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Cache-Control: private', false);
            header('Content-Type: ' . $file_type);
            header('Content-Disposition: attachement; filename="' . $download_file_name . '"');
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . $source_file_size);
            ob_clean();
            flush();
            echo $source_file_content;
            exit;
        }
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- retrieve template_data_tag_list -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$submitted_file_external_ref_name = '';
$results_retrieve_data['template_data_tag_list']['is_success'] = true;
$results_retrieve_data['template_data_tag_list']['total_record'] = 0;

if ($enable_retrieve['template_data_tag_list'] == true) {
    // ----- get submitted_file_external_ref_name ----- //
    $temp_array = explode('___', $api_data['file_external_ref_name']);
    if (count($temp_array) >= 4) {
        $entity_name = $temp_array[0];
        $folder_name = $temp_array[1];
        $file_name = $temp_array[2];
        $submitted_file_external_ref_name = $temp_array[3];
    }

    $temp_array = explode('.', $submitted_file_external_ref_name);
    if (count($temp_array) == 2) {
        $submitted_file_external_ref_name = substr($temp_array[0], 0, 25);
    }

    // ----- get file record ----- //
    $file_record = null;

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
        if ($results['num_rows'] > 0) {
            $results_retrieve_data['template_data_tag_list']['is_success'] = true;
            $r1 = mysql_fetch_array($results['data']);
            foreach ($r1 as $key1 => $value1) {
                if (!is_int($key1)) {
                    $file_record[$key1] = $value1;
                }
            }
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
                    $results_retrieve_data['template_data_tag_list']['is_success'] = true;
                    $r2 = mysql_fetch_array($results2['data']);
                    foreach ($r2 as $key2 => $value2) {
                        if (!is_int($key2)) {
                            $file_record[$key2] = $value2;
                        }
                    }
                }
            }
        }
    }

    if ($file_record != null) {
        switch ($file_record['file_content_category']) {
            case 'Template':
                $latest_client_id = '';

                $sql = str_replace(
                    array(
                    ), 
                    array(
                    ), 
                    $sql_template_retrieve_ver_chronoforms_data_clientpersonal_vic_last_record
                );

                $results = executeDbQuery($sql, $db_connection);
                if ($results['error'] == 'null') {
                    $results_retrieve_data['template_data_tag_list']['is_success'] = true;

                    while ($r1 = mysql_fetch_array($results['data'])) {
                        $latest_client_id = $r1['clientid'];
                    }
                }

                $target_sql = $sql_template_retrieve_template_data_tag_list;
                $target_entity_name = $latest_client_id;
                $delete_data_field_value = true;
                break;
            case 'Download Data Merge':
                $target_sql = $sql_template_retrieve_template_data_tag_list;
                $target_entity_name = $entity_name;
                $delete_data_field_value = false;
                break;
            default:
                break;
        }

        $sql = str_replace(
            array(
                '[USER_ID]', 
                '[ENTITY_NAME]'
            ), 
            array(
                addslashes($login_user_info['user_id']), 
                $target_entity_name
            ), 
            $target_sql
        );

        //current task
        $results = executeDbQuery($sql, $db_connection);
        if ($results['error'] == 'null') {
            if ($results['affected_rows'] == 0 || $results['num_rows'] == 0) {
                $target_sql = $sql_template_retrieve_template_data_tag_list2;
                $sql = str_replace(
                    array(
                        '[USER_ID]', 
                        '[ENTITY_NAME]'
                    ), 
                    array(
                        addslashes($login_user_info['user_id']), 
                        $target_entity_name
                    ), 
                    $target_sql
                );
                $results = executeDbQuery($sql, $db_connection);
            }
        }

        $results = executeDbQuery($sql, $db_connection);
        if ($results['error'] == 'null') {
            $results_retrieve_data['template_data_tag_list']['is_success'] = true;

            while ($r1 = mysql_fetch_array($results['data'])) {
                foreach ($r1 as $key1 => $value1) {
                    if (!is_int($key1)) {
                        if ($delete_data_field_value == false) {
                            $template_data_tag_list[count($template_data_tag_list)] = array('ref_name' => $key1, 'display_name' => $value1);
                        } else {
                            $template_data_tag_list[count($template_data_tag_list)] = array('ref_name' => $key1, 'display_name' => '');
                        }
                    }
                }
            }
        }
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- download msword plugin -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
if ($enable_retrieve['msword_plugin_download'] == true) {
    $file_type = $config['mime_types'][$config['plugin']['msword']['file_extension']];
    $download_file_name = $config['plugin']['msword']['file_name'];
    $source_file_path = $config['plugin']['msword']['folder'] . $config['plugin']['msword']['file_name'];

    header('Content-Type: ' . $file_type);
    header('Content-Disposition: attachement; filename="' . $download_file_name . '"');
    echo file_get_contents($source_file_path);
    exit;
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- download msoutlook plugin -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
if ($enable_retrieve['msoutlook_plugin_download'] == true) {
    $file_type = $config['mime_types'][$config['plugin']['msoutlook']['file_extension']];
    $download_file_name = $config['plugin']['msoutlook']['file_name'];
    $source_file_path = $config['plugin']['msoutlook']['folder'] . $config['plugin']['msoutlook']['file_name'];

    header('Content-Type: ' . $file_type);
    header('Content-Disposition: attachement; filename="' . $download_file_name . '"');
    echo file_get_contents($source_file_path);
    exit;
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- retrieve entity_search_list (entity, contact) -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_retrieve_data['entity_search_list']['is_success'] = true;
$results_retrieve_data['entity_search_list']['total_record'] = 0;

if ($enable_retrieve['entity_search_list'] == true) {
    $all_results = array();

    switch ($api_data['access_mode']) {
        case 'entity_search_list':
            $target_sql_template = $sql_template_retrieve_entity_search_list;
            break;
        case 'contact_from_search_list':
        case 'contact_to_search_list':
            $target_sql_template = $sql_template_retrieve_contact_search_list;
            break;
    }

    foreach ($target_sql_template as $key1 => $current_sql_template) {
        $sql = str_replace(
            array(
                '[ENTITY_SEARCH_KEYWORD]'
            ), 
            array(
                addslashes(strtolower($api_data['entity_search_keyword']))
            ), 
            $current_sql_template
        );

        $results = executeDbQuery($sql, $db_connection);
        if ($results['error'] == 'null') {
            $results_retrieve_data['entity_search_list']['is_success'] = true;

            while ($r1 = mysql_fetch_array($results['data'])) {
                $current_item_index = count($document_handler_form_entity_search_list);
                $document_handler_form_entity_search_list[$current_item_index]['entity_source_display_name'] = $r1['entity_source_display_name'];
                $document_handler_form_entity_search_list[$current_item_index]['entity_id'] = $r1['entity_id'];
                $document_handler_form_entity_search_list[$current_item_index]['entity_info'] = $r1['entity_info'];
                $document_handler_form_entity_search_list[$current_item_index]['entity_date_created'] = $r1['entity_date_created'];
            }
        }
    }
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- process retrieve data results -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$total_overall_success = 0;
foreach ($results_retrieve_data as $key1 => $value1) {
    if ($value1['is_success'] == true) {
        $total_overall_success++;
    }
}

if ($total_overall_success == count($results_retrieve_data)) {
    $api_response['error'] = 'null';
} else {
    $api_response['error'] = '10020';
}

$api_response['message'] = array(
);

$api_response['data'] = array();

if (isset($api_data['access_mode'])) {
    switch ($api_data['access_mode']) {
        case 'entity_list':
            $api_response['data'] = array(
                'document_handler_form_entity_list' => $document_handler_form_entity_list
            );
            break;
        case 'entity_folder_list':
            $api_response['data'] = array(
                'document_handler_form_entity_folder_list' => $document_handler_form_entity_folder_list
            );
            break;
        case 'folder_file_list':
            $api_response['data'] = array(
                'document_handler_form_folder_file_list' => $document_handler_form_folder_file_list
            );
            break;
        case 'template_data_tag_list':
            $api_response['data'] = array(
                'template_data_tag_list' => $template_data_tag_list
            );
            break;
        case 'entity_search_list':
        case 'contact_from_search_list':
        case 'contact_to_search_list':
            $api_response['data'] = array(
                'document_handler_form_entity_search_list' => $document_handler_form_entity_search_list
            );
            break;
    }
}
?>