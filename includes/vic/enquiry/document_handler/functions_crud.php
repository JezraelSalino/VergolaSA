<?php
function saveEntityInfo($db_connection, $input_data, $sql_templates) {
    $processing_results = array(
        'total_input' => 0, 
        'total_success' => 0, 
        'total_failure' => 0, 
        'is_success' => false, 
        'error' => array(), 
        'message' => array(), 
        'new_entity_id' => null
    );

    $submitted_entity_name = $input_data['entity_name'];
    $submitted_entity_id = null;

    $sql = str_replace(
        array(
            '[ENTITY_NAME]'
        ), 
        array(
            addslashes($submitted_entity_name)
        ), 
        $sql_templates['retrieve_entity_by_name']
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        if ($results['num_rows'] > 0) {
            while ($r1 = mysql_fetch_array($results['data'])) {
                $submitted_entity_id = $r1['entity_id'];
            }
        }
    } else {
        $processing_results['error'][] = $results['error'];
        $processing_results['message'][] = $results['message'];
    }

    $new_entity_id = null;
    if ($submitted_entity_id == null) {
        $processing_results['total_input'] = 1;

        $sql = str_replace(
            array('[TABLE_NAME]'), 
            array('document_handler_entity'), 
            $sql_templates['retrieve_table_status']
        );

        $results = executeDbQuery($sql, $db_connection);
        if ($results['error'] == 'null') {
            $r1 = mysql_fetch_array($results['data']);
            $new_entity_id = $r1['Auto_increment'];
        } else {
            $processing_results['error'][] = $results['error'];
            $processing_results['message'][] = $results['message'];
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
                    addslashes($input_data['module']), 
                    addslashes($input_data['entity_name']), 
                    addslashes($input_data['entity_description']), 
                    addslashes($input_data['entity_summary']), 
                    addslashes($input_data['user_id']), 
                    addslashes($input_data['user_group_id']), 
                ), 
                $sql_templates['insert_document_handler_entity']
            );

            $results = executeDbQuery($sql, $db_connection);
            if ($results['error'] == 'null') {
                $processing_results['total_success']++;
            } else {
                $processing_results['total_failure']++;
                $processing_results['error'][] = $results['error'];
                $processing_results['message'][] = $results['message'];
            }
        }

        if ($processing_results['total_input'] == $processing_results['total_success']) {
            $processing_results['is_success'] = true;
        }
    }

    if ($new_entity_id == null) {
        $new_entity_id = $submitted_entity_id;
    }

    $processing_results['new_entity_id'] = $new_entity_id;

    return $processing_results;
}


function saveFolderInfo($db_connection, $input_data, $sql_templates) {
    $processing_results = array(
        'total_input' => 0, 
        'total_success' => 0, 
        'total_failure' => 0, 
        'is_success' => false, 
        'error' => array(), 
        'message' => array(), 
        'new_folder_id' => null
    );


    $submitted_folder_name = $input_data['folder_name'];
    $submitted_folder_id = null;

    $sql = str_replace(
        array(
            '[FOLDER_NAME]'
        ), 
        array(
            addslashes($submitted_folder_name)
        ), 
        $sql_templates['retrieve_folder_by_name']
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        if ($results['num_rows'] > 0) {
            while ($r1 = mysql_fetch_array($results['data'])) {
                $submitted_folder_id = $r1['folder_id'];
            }
        }
    } else {
        $processing_results['error'][] = $results['error'];
        $processing_results['message'][] = $results['message'];
    }

    $new_folder_id = null;
    if ($submitted_folder_id == null) {
        $processing_results['total_input'] = 1;

        $sql = str_replace(
            array('[TABLE_NAME]'), 
            array('document_handler_folder'), 
            $sql_templates['retrieve_table_status']
        );

        $results = executeDbQuery($sql, $db_connection);
        if ($results['error'] == 'null') {
            $r1 = mysql_fetch_array($results['data']);
            $new_folder_id = $r1['Auto_increment'];
        } else {
            $processing_results['error'][] = $results['error'];
            $processing_results['message'][] = $results['message'];
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
                    addslashes($input_data['folder_name']), 
                    addslashes($input_data['folder_description']), 
                    addslashes($input_data['folder_summary']), 
                    addslashes($input_data['user_id']), 
                    addslashes($input_data['user_group_id']), 
                ), 
                $sql_templates['insert_document_handler_folder']
            );

            $results = executeDbQuery($sql, $db_connection);
            if ($results['error'] == 'null') {
                $processing_results['total_success']++;
            } else {
                $processing_results['total_failure']++;
                $processing_results['error'][] = $results['error'];
                $processing_results['message'][] = $results['message'];
            }
        }

        if ($processing_results['total_input'] == $processing_results['total_success']) {
            $processing_results['is_success'] = true;
        }
    }

    if ($new_folder_id == null) {
        $new_folder_id = $submitted_folder_id;
    }

    $processing_results['new_folder_id'] = $new_folder_id;

    return $processing_results;
}


function saveEntityFolderInfo($db_connection, $input_data, $sql_templates) {
    $processing_results = array(
        'total_input' => 0, 
        'total_success' => 0, 
        'total_failure' => 0, 
        'is_success' => false, 
        'error' => array(), 
        'message' => array(), 
        'new_entity_folder_id' => null
    );

    $submitted_entity_id = $input_data['entity_id'];;
    $submitted_entity_name = $input_data['entity_name'];
    $submitted_folder_id = $input_data['folder_id'];;
    $submitted_folder_name = $input_data['folder_name'];
    $submitted_entity_folder_id = null;

    $sql = str_replace(
        array(
            '[ENTITY_NAME]', 
            '[FOLDER_NAME]'
        ), 
        array(
            addslashes($submitted_entity_name), 
            addslashes($submitted_folder_name)
        ), 
        $sql_templates['retrieve_entity_folder_by_names']
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        if ($results['num_rows'] > 0) {
            while ($r1 = mysql_fetch_array($results['data'])) {
                $submitted_entity_folder_id = $r1['id'];
            }
        }
    } else {
        $processing_results['error'][] = $results['error'];
        $processing_results['message'][] = $results['message'];
    }

    $new_entity_folder_id = null;
    if ($submitted_entity_folder_id == null) {
        $processing_results['total_input'] = 1;

        $sql = str_replace(
            array('[TABLE_NAME]'), 
            array('document_handler_entity_folder'), 
            $sql_templates['retrieve_table_status']
        );

        $results = executeDbQuery($sql, $db_connection);
        if ($results['error'] == 'null') {
            $r1 = mysql_fetch_array($results['data']);
            $new_entity_folder_id = $r1['Auto_increment'];
        } else {
            $processing_results['error'][] = $results['error'];
            $processing_results['message'][] = $results['message'];
        }

        if ($new_entity_folder_id != null) {
            $sql = str_replace(
                array(
                    '[ENTITY_FOLDER_ID]', 
                    '[MODULE]', 
                    '[ENTITY_ID]', 
                    '[FOLDER_ID]', 
                    '[USER_ID]', 
                    '[GROUP_ID]'
                ), 
                array(
                    $new_entity_folder_id, 
                    addslashes($input_data['module']), 
                    addslashes($submitted_entity_id), 
                    addslashes($submitted_folder_id), 
                    addslashes($input_data['user_id']), 
                    addslashes($input_data['user_group_id'])
                ), 
                $sql_templates['insert_document_handler_entity_folder']
            );

            $results = executeDbQuery($sql, $db_connection);
            if ($results['error'] == 'null') {
                $processing_results['total_success']++;
            } else {
                $processing_results['total_failure']++;
                $processing_results['error'][] = $results['error'];
                $processing_results['message'][] = $results['message'];
            }
        }

        if ($processing_results['total_input'] == $processing_results['total_success']) {
            $processing_results['is_success'] = true;
        }
    }

    if ($new_entity_folder_id == null) {
        $new_entity_folder_id = $submitted_entity_folder_id;
    }

    $processing_results['new_entity_folder_id'] = $new_entity_folder_id;

    return $processing_results;
}


function saveFolderFileInfo($db_connection, $input_data, $sql_templates) {
    $processing_results = array(
        'total_input' => 0, 
        'total_success' => 0, 
        'total_failure' => 0, 
        'is_success' => false, 
        'error' => array(), 
        'message' => array(), 
        'new_folder_file_id' => null
    );

    $submitted_folder_id = $input_data['folder_id'];;
    $submitted_folder_name = $input_data['folder_name'];
    $submitted_file_id = $input_data['file_id'];;
    $submitted_file_name = $input_data['file_name'];
    $submitted_folder_file_id = null;

    $sql = str_replace(
        array(
            '[FOLDER_NAME]', 
            '[FILE_NAME]'
        ), 
        array(
            addslashes($submitted_folder_name), 
            addslashes($submitted_file_name)
        ), 
        $sql_templates['retrieve_folder_file_by_names']
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        if ($results['num_rows'] > 0) {
            while ($r1 = mysql_fetch_array($results['data'])) {
                $submitted_folder_file_id = $r1['id'];
            }
        }
    } else {
        $processing_results['error'][] = $results['error'];
        $processing_results['message'][] = $results['message'];
    }

    $new_folder_file_id = null;
    if ($submitted_folder_file_id == null) {
        $processing_results['total_input'] = 1;

        $sql = str_replace(
            array('[TABLE_NAME]'), 
            array('document_handler_folder_file'), 
            $sql_templates['retrieve_table_status']
        );

        $results = executeDbQuery($sql, $db_connection);
        if ($results['error'] == 'null') {
            $r1 = mysql_fetch_array($results['data']);
            $new_folder_file_id = $r1['Auto_increment'];
        } else {
            $processing_results['error'][] = $results['error'];
            $processing_results['message'][] = $results['message'];
        }

        if ($new_folder_file_id != null) {
            $sql = str_replace(
                array(
                    '[FOLDER_FILE_ID]', 
                    '[FOLDER_ID]', 
                    '[FILE_ID]', 
                    '[USER_ID]', 
                    '[GROUP_ID]'
                ), 
                array(
                    $new_folder_file_id, 
                    addslashes($submitted_folder_id), 
                    addslashes($submitted_file_id), 
                    addslashes($input_data['user_id']), 
                    addslashes($input_data['user_group_id'])
                ), 
                $sql_templates['insert_document_handler_folder_file']
            );

            $results = executeDbQuery($sql, $db_connection);
            if ($results['error'] == 'null') {
                $processing_results['total_success']++;
            } else {
                $processing_results['total_failure']++;
                $processing_results['error'][] = $results['error'];
                $processing_results['message'][] = $results['message'];
            }
        }

        if ($processing_results['total_input'] == $processing_results['total_success']) {
            $processing_results['is_success'] = true;
        }
    }

    if ($new_folder_file_id == null) {
        $new_folder_file_id = $submitted_folder_file_id;
    }

    $processing_results['new_folder_file_id'] = $new_folder_file_id;

    return $processing_results;
}


function saveEntityFolderFileInfo($db_connection, $input_data, $sql_templates) {
    $processing_results = array(
        'total_input' => 0, 
        'total_success' => 0, 
        'total_failure' => 0, 
        'is_success' => false, 
        'error' => array(), 
        'message' => array(), 
        'new_entity_folder_file_id' => null
    );

    $submitted_entity_id = $input_data['entity_id'];;
    $submitted_entity_name = $input_data['entity_name'];
    $submitted_folder_id = $input_data['folder_id'];;
    $submitted_folder_name = $input_data['folder_name'];
    $submitted_file_id = $input_data['file_id'];;
    $submitted_file_name = $input_data['file_name'];
    $submitted_entity_folder_file_id = null;

    $sql = str_replace(
        array(
            '[ENTITY_NAME]', 
            '[FOLDER_NAME]', 
            '[FILE_NAME]'
        ), 
        array(
            addslashes($submitted_entity_name), 
            addslashes($submitted_folder_name), 
            addslashes($submitted_file_name)
        ), 
        $sql_templates['retrieve_entity_folder_file_by_names']
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        if ($results['num_rows'] > 0) {
            while ($r1 = mysql_fetch_array($results['data'])) {
                $submitted_entity_folder_file_id = $r1['id'];
            }
        }
    } else {
        $processing_results['error'][] = $results['error'];
        $processing_results['message'][] = $results['message'];
    }

    $new_entity_folder_file_id = null;
    if ($submitted_entity_folder_file_id == null) {
        $processing_results['total_input'] = 1;

        $sql = str_replace(
            array('[TABLE_NAME]'), 
            array('document_handler_entity_folder_file'), 
            $sql_templates['retrieve_table_status']
        );

        $results = executeDbQuery($sql, $db_connection);
        if ($results['error'] == 'null') {
            $r1 = mysql_fetch_array($results['data']);
            $new_entity_folder_file_id = $r1['Auto_increment'];
        } else {
            $processing_results['error'][] = $results['error'];
            $processing_results['message'][] = $results['message'];
        }

        if ($new_entity_folder_file_id != null) {
            $sql = str_replace(
                array(
                    '[ENTITY_FOLDER_FILE_ID]', 
                    '[ENTITY_ID]', 
                    '[ENTITY_NAME]', 
                    '[FOLDER_ID]', 
                    '[FOLDER_NAME]', 
                    '[FILE_ID]', 
                    '[FILE_NAME]', 
                    '[USER_ID]', 
                    '[GROUP_ID]'
                ), 
                array(
                    $new_entity_folder_file_id, 
                    addslashes($submitted_entity_id), 
                    addslashes($submitted_entity_name), 
                    addslashes($submitted_folder_id), 
                    addslashes($submitted_folder_name), 
                    addslashes($submitted_file_id), 
                    addslashes($submitted_file_name), 
                    addslashes($input_data['user_id']), 
                    addslashes($input_data['user_group_id'])
                ), 
                $sql_templates['insert_document_handler_entity_folder_file']
            );

            $results = executeDbQuery($sql, $db_connection);
            if ($results['error'] == 'null') {
                $processing_results['total_success']++;
            } else {
                $processing_results['total_failure']++;
                $processing_results['error'][] = $results['error'];
                $processing_results['message'][] = $results['message'];
            }
        }

        if ($processing_results['total_input'] == $processing_results['total_success']) {
            $processing_results['is_success'] = true;
        }
    }

    if ($new_entity_folder_file_id == null) {
        $new_entity_folder_file_id = $submitted_entity_folder_file_id;
    }

    $processing_results['new_entity_folder_file_id'] = $new_entity_folder_file_id;

    return $processing_results;
}
?>