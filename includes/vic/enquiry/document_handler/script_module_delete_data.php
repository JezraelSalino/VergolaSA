<?php
// mysql_query("START TRANSACTION");


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- initialise variables -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$enable_deleting = array(
    'entity_delete' => false, 
    'folder_delete' => false, 
    'file_delete' => false, 
);
if (isset($api_data['access_mode'])) {
    switch ($api_data['access_mode']) {
        case 'entity_delete':
            $enable_deleting['entity_delete'] = true;
            break;
        case 'folder_delete':
            $enable_deleting['folder_delete'] = true;
            break;
        case 'file_delete':
            $enable_deleting['file_delete'] = true;
            break;
    }
}

$document_handler_entity_folder_records = array();
$document_handler_entity_record = array();
$document_handler_entity_folder_records_2 = array();
$document_handler_folder_records = array();
$document_handler_folder_record = array();
$document_handler_folder_file_records = array();
$document_handler_file_records = array();
$document_handler_file_record = array();
$data_before_activity = array();


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- delete entity -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_delete_data['entity_delete']['total_input'] = 0;
$results_delete_data['entity_delete']['total_success'] = 0;
$results_delete_data['entity_delete']['total_failure'] = 0;
$results_delete_data['entity_delete']['failure_indexes'] = array();
$results_delete_data['entity_delete']['is_success'] = false;

if ($enable_deleting['entity_delete'] == true) {
    // // --- retrieve - document_handler_entity_folder_records --- //
    // $sql = str_replace(
    //     array(
    //         '[ENTITY_ID]'
    //     ), 
    //     array(
    //         addslashes($api_data['document_handler_form_entity_data_entry']['document_handler_form_entity_id'])
    //     ), 
    //     $sql_template_retrieve_document_handler_entity_folder_records
    // );

    // $results = executeDbQuery($sql, $db_connection);
    // if ($results['error'] == 'null') {
    //     while ($r1 = mysql_fetch_array($results['data'])) {
    //         $current_item_index = count($document_handler_entity_folder_records);
    //         foreach ($r1 as $key1 => $value1) {
    //             if (! is_numeric($key1)) {
    //                 $document_handler_entity_folder_records[$current_item_index][$key1] = $value1;
    //             }
    //         }
    //     }
    // }


    // --- retrieve - document_handler_entity_record --- //
    $sql = str_replace(
        array(
            '[ENTITY_ID]'
        ), 
        array(
            addslashes($api_data['document_handler_form_entity_data_entry']['document_handler_form_entity_id'])
        ), 
        $sql_template_retrieve_document_handler_entity_record
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        $r1 = mysql_fetch_array($results['data']);
        foreach ($r1 as $key1 => $value1) {
            if (! is_numeric($key1)) {
                $document_handler_entity_record[$key1] = $value1;
            }
        }
    }


    // --- retrieve - document_handler_entity_folder_records --- //
    $sql = str_replace(
        array(
            '[ENTITY_ID]'
        ), 
        array(
            addslashes($api_data['document_handler_form_entity_data_entry']['document_handler_form_entity_id'])
        ), 
        $sql_template_retrieve_document_handler_entity_folder_records
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        while ($r1 = mysql_fetch_array($results['data'])) {
            $current_item_index = count($document_handler_entity_folder_records);
            foreach ($r1 as $key1 => $value1) {
                if (! is_numeric($key1)) {
                    $document_handler_entity_folder_records[$current_item_index][$key1] = $value1;
                }


                // --- retrieve - document_handler_folder_records --- //
                $sql = str_replace(
                    array(
                        '[FOLDER_ID]'
                    ), 
                    array(
                        addslashes($r1['folder_id'])
                    ), 
                    $sql_template_retrieve_document_handler_folder_record
                );

                $results2 = executeDbQuery($sql, $db_connection);
                if ($results2['error'] == 'null') {
                    while ($r2 = mysql_fetch_array($results2['data'])) {
                        $current_item_index2 = count($document_handler_folder_records);
                        foreach ($r2 as $key2 => $value2) {
                            if (! is_numeric($key2)) {
                                $document_handler_folder_records[$current_item_index2][$key2] = $value2;
                            }
                        }
                    }
                }


                // --- retrieve - document_handler_folder_file_records --- //
                $sql = str_replace(
                    array(
                        '[FOLDER_ID]'
                    ), 
                    array(
                        addslashes($r1['folder_id'])
                    ), 
                    $sql_template_retrieve_document_handler_folder_file_records
                );

                $results3 = executeDbQuery($sql, $db_connection);
                if ($results3['error'] == 'null') {
                    while ($r3 = mysql_fetch_array($results3['data'])) {
                        $current_item_index3 = count($document_handler_folder_file_records);
                        foreach ($r3 as $key3 => $value3) {
                            if (! is_numeric($key3)) {
                                $document_handler_folder_file_records[$current_item_index3][$key3] = $value3;
                            }
                        }


                        // --- retrieve - document_handler_file_records --- //
                        $sql = str_replace(
                            array(
                                '[FILE_ID]'
                            ), 
                            array(
                                addslashes($r3['file_id'])
                            ), 
                            $sql_template_retrieve_document_handler_file_record
                        );

                        $results4 = executeDbQuery($sql, $db_connection);
                        if ($results4['error'] == 'null') {
                            while ($r4 = mysql_fetch_array($results4['data'])) {
                                $current_item_index4 = count($document_handler_file_records);
                                foreach ($r4 as $key4 => $value4) {
                                    if (! is_numeric($key4)) {
                                        $document_handler_file_records[$current_item_index4][$key4] = $value4;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }


    // --- delete - document_handler_entity_folder_records --- //
    $results_delete_data['entity_delete']['total_input']++;

    $sql = str_replace(
        array(
            '[ENTITY_ID]' 
        ), 
        array(
            addslashes($api_data['document_handler_form_entity_data_entry']['document_handler_form_entity_id'])
        ), 
        $sql_template_delete_document_handler_entity_folder_records
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        if ($results['affected_rows'] == count($document_handler_entity_folder_records)) {
            $results_delete_data['entity_delete']['total_success']++;
        } else {
            $results_delete_data['entity_delete']['total_failure']++;
        }
    } else {
        $results_delete_data['entity_delete']['total_failure']++;
    }


    // --- delete - document_handler_entity_record --- //
    $results_delete_data['entity_delete']['total_input']++;

    $sql = str_replace(
        array(
            '[ENTITY_ID]' 
        ), 
        array(
            addslashes($api_data['document_handler_form_entity_data_entry']['document_handler_form_entity_id'])
        ), 
        $sql_template_delete_document_handler_entity_record
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        $results_delete_data['entity_delete']['total_success']++;
    } else {
        $results_delete_data['entity_delete']['total_failure']++;
    }


    // --- delete - document_handler_folder_records --- //
    $results_delete_data['entity_delete']['total_input'] += count($document_handler_folder_records);

    for ($c1 = 0; $c1 < count($document_handler_folder_records); $c1++) {
        $sql = str_replace(
            array(
                '[FOLDER_ID]' 
            ), 
            array(
                addslashes($document_handler_folder_records[$c1]['id'])
            ), 
            $sql_template_delete_document_handler_folder_record
        );

        $results = executeDbQuery($sql, $db_connection);
        if ($results['error'] == 'null') {
            $results_delete_data['entity_delete']['total_success']++;
        } else {
            $results_delete_data['entity_delete']['total_failure']++;
        }


        // --- delete - document_handler_folder_file_records --- //
        $results_delete_data['entity_delete']['total_input']++;

        $sql = str_replace(
            array(
                '[FOLDER_ID]' 
            ), 
            array(
                addslashes($document_handler_folder_records[$c1]['id'])
            ), 
            $sql_template_delete_document_handler_folder_file_records
        );

        $results = executeDbQuery($sql, $db_connection);
        if ($results['error'] == 'null') {
            if ($results['affected_rows'] == count($document_handler_folder_file_records)) {
                $results_delete_data['entity_delete']['total_success']++;
            } else {
                $results_delete_data['entity_delete']['total_failure']++;
            }
        } else {
            $results_delete_data['entity_delete']['total_failure']++;
        }
    }


    // --- delete - document_handler_file_records --- //
    $results_delete_data['entity_delete']['total_input'] += count($document_handler_file_records);

    for ($c1 = 0; $c1 < count($document_handler_file_records); $c1++) {
        $sql = str_replace(
            array(
                '[FILE_ID]' 
            ), 
            array(
                addslashes($document_handler_file_records[$c1]['id'])
            ), 
            $sql_template_delete_document_handler_file_record
        );

        $results = executeDbQuery($sql, $db_connection);
        if ($results['error'] == 'null') {
            $results_delete_data['entity_delete']['total_success']++;
        } else {
            $results_delete_data['entity_delete']['total_failure']++;
        }
    }


    if ($results_delete_data['entity_delete']['total_input'] == $results_delete_data['entity_delete']['total_success']) {
        $results_delete_data['entity_delete']['is_success'] = true;
    }


    $data_before_activity = array(
        'document_handler_entity_record' => $document_handler_entity_record, 
        'document_handler_entity_folder_records' => $document_handler_entity_folder_records, 
        'document_handler_folder_records' => $document_handler_folder_records, 
        'document_handler_folder_file_records' => $document_handler_folder_file_records, 
        'document_handler_file_records' => $document_handler_file_records
    );
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- delete folder -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_delete_data['folder_delete']['total_input'] = 0;
$results_delete_data['folder_delete']['total_success'] = 0;
$results_delete_data['folder_delete']['total_failure'] = 0;
$results_delete_data['folder_delete']['failure_indexes'] = array();
$results_delete_data['folder_delete']['is_success'] = false;

if ($enable_deleting['folder_delete'] == true) {
    // --- retrieve - document_handler_entity_folder_records --- //
    $sql = str_replace(
        array(
            '[FOLDER_ID]'
        ), 
        array(
            addslashes($api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_id'])
        ), 
        $sql_template_retrieve_document_handler_entity_folder_records_2
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        while ($r1 = mysql_fetch_array($results['data'])) {
            $current_item_index = count($document_handler_entity_folder_records_2);
            foreach ($r1 as $key1 => $value1) {
                if (! is_numeric($key1)) {
                    $document_handler_entity_folder_records_2[$current_item_index][$key1] = $value1;
                }
            }
        }
    }


    // --- retrieve - document_handler_folder_record --- //
    $sql = str_replace(
        array(
            '[FOLDER_ID]'
        ), 
        array(
            addslashes($api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_id'])
        ), 
        $sql_template_retrieve_document_handler_folder_record
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        $r1 = mysql_fetch_array($results['data']);
        foreach ($r1 as $key1 => $value1) {
            if (! is_numeric($key1)) {
                $document_handler_folder_record[$key1] = $value1;
            }
        }
    }


    // --- retrieve - document_handler_folder_file_records --- //
    $sql = str_replace(
        array(
            '[FOLDER_ID]'
        ), 
        array(
            addslashes($api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_id'])
        ), 
        $sql_template_retrieve_document_handler_folder_file_records
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        while ($r1 = mysql_fetch_array($results['data'])) {
            $current_item_index = count($document_handler_folder_file_records);
            foreach ($r1 as $key1 => $value1) {
                if (! is_numeric($key1)) {
                    $document_handler_folder_file_records[$current_item_index][$key1] = $value1;
                }
            }


            // --- retrieve - document_handler_file_records --- //
            $sql = str_replace(
                array(
                    '[FILE_ID]'
                ), 
                array(
                    addslashes($r1['file_id'])
                ), 
                $sql_template_retrieve_document_handler_file_record
            );

            $results2 = executeDbQuery($sql, $db_connection);
            if ($results2['error'] == 'null') {
                while ($r2 = mysql_fetch_array($results2['data'])) {
                    $current_item_index2 = count($document_handler_file_records);
                    foreach ($r2 as $key2 => $value2) {
                        if (! is_numeric($key2)) {
                            $document_handler_file_records[$current_item_index2][$key2] = $value2;
                        }
                    }
                }
            }
        }
    }


    // --- delete - document_handler_entity_folder_records --- //
    $results_delete_data['folder_delete']['total_input']++;

    $sql = str_replace(
        array(
            '[FOLDER_ID]' 
        ), 
        array(
            addslashes($api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_id'])
        ), 
        $sql_template_delete_document_handler_entity_folder_records_2
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        if ($results['affected_rows'] == count($document_handler_entity_folder_records_2)) {
            $results_delete_data['folder_delete']['total_success']++;
        } else {
            $results_delete_data['folder_delete']['total_failure']++;
        }
    } else {
        $results_delete_data['folder_delete']['total_failure']++;
    }


    // --- delete - document_handler_folder_record --- //
    $results_delete_data['folder_delete']['total_input']++;

    $sql = str_replace(
        array(
            '[FOLDER_ID]' 
        ), 
        array(
            addslashes($api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_id'])
        ), 
        $sql_template_delete_document_handler_folder_record
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        $results_delete_data['folder_delete']['total_success']++;
    } else {
        $results_delete_data['folder_delete']['total_failure']++;
    }

    // --- delete - document_handler_folder_file_records --- //
    $results_delete_data['folder_delete']['total_input']++;

    $sql = str_replace(
        array(
            '[FOLDER_ID]' 
        ), 
        array(
            addslashes($api_data['document_handler_form_folder_data_entry']['document_handler_form_folder_id'])
        ), 
        $sql_template_delete_document_handler_folder_file_records
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        if ($results['affected_rows'] == count($document_handler_folder_file_records)) {
            $results_delete_data['folder_delete']['total_success']++;
        } else {
            $results_delete_data['folder_delete']['total_failure']++;
        }
    } else {
        $results_delete_data['folder_delete']['total_failure']++;
    }


    // --- delete - document_handler_file_records --- //
    $results_delete_data['folder_delete']['total_input'] += count($document_handler_file_records);

    for ($c1 = 0; $c1 < count($document_handler_file_records); $c1++) {
        $sql = str_replace(
            array(
                '[FILE_ID]' 
            ), 
            array(
                addslashes($document_handler_file_records[$c1]['id'])
            ), 
            $sql_template_delete_document_handler_file_record
        );

        $results = executeDbQuery($sql, $db_connection);
        if ($results['error'] == 'null') {
            $results_delete_data['folder_delete']['total_success']++;
        } else {
            $results_delete_data['folder_delete']['total_failure']++;
        }
    }


    if ($results_delete_data['folder_delete']['total_input'] == $results_delete_data['folder_delete']['total_success']) {
        $results_delete_data['folder_delete']['is_success'] = true;
    }


    $data_before_activity = array(
        'document_handler_entity_folder_records' => $document_handler_entity_folder_records_2, 
        'document_handler_folder_record' => $document_handler_folder_record, 
        'document_handler_folder_file_records' => $document_handler_folder_file_records, 
        'document_handler_file_records' => $document_handler_file_records
    );
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- delete file -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql = '';
$results_delete_data['file_delete']['total_input'] = 0;
$results_delete_data['file_delete']['total_success'] = 0;
$results_delete_data['file_delete']['total_failure'] = 0;
$results_delete_data['file_delete']['failure_indexes'] = array();
$results_delete_data['file_delete']['is_success'] = false;

if ($enable_deleting['file_delete'] == true) {
    // --- retrieve - document_handler_folder_file_records --- //
    $sql = str_replace(
        array(
            '[FILE_ID]'
        ), 
        array(
            addslashes($api_data['document_handler_form_file_data_entry']['document_handler_form_file_id'])
        ), 
        $sql_template_retrieve_document_handler_folder_file_records_2
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        while ($r1 = mysql_fetch_array($results['data'])) {
            $current_item_index = count($document_handler_folder_file_records);
            foreach ($r1 as $key1 => $value1) {
                if (! is_numeric($key1)) {
                    $document_handler_folder_file_records[$current_item_index][$key1] = $value1;
                }
            }
        }
    }


    // --- retrieve - document_handler_file_records --- //
    $sql = str_replace(
        array(
            '[FILE_ID]'
        ), 
        array(
            addslashes($api_data['document_handler_form_file_data_entry']['document_handler_form_file_id'])
        ), 
        $sql_template_retrieve_document_handler_file_record
    );

    $results2 = executeDbQuery($sql, $db_connection);
    if ($results2['error'] == 'null') {
        while ($r2 = mysql_fetch_array($results2['data'])) {
            foreach ($r2 as $key2 => $value2) {
                if (! is_numeric($key2)) {
                    $document_handler_file_record[$key2] = $value2;
                }
            }
        }
    }


    // --- delete - document_handler_folder_file_records --- //
    $results_delete_data['file_delete']['total_input']++;

    $sql = str_replace(
        array(
            '[FILE_ID]' 
        ), 
        array(
            addslashes($api_data['document_handler_form_file_data_entry']['document_handler_form_file_id'])
        ), 
        $sql_template_delete_document_handler_folder_file_records_2
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        if ($results['affected_rows'] == count($document_handler_folder_file_records)) {
            $results_delete_data['file_delete']['total_success']++;
        } else {
            $results_delete_data['file_delete']['total_failure']++;
        }
    } else {
        $results_delete_data['file_delete']['total_failure']++;
    }


    // --- delete - document_handler_file_records --- //
    $results_delete_data['file_delete']['total_input']++;

    $sql = str_replace(
        array(
            '[FILE_ID]' 
        ), 
        array(
            addslashes($api_data['document_handler_form_file_data_entry']['document_handler_form_file_id'])
        ), 
        $sql_template_delete_document_handler_file_record
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        $results_delete_data['file_delete']['total_success']++;
    } else {
        $results_delete_data['file_delete']['total_failure']++;
    }


    // --- delete - document_handler_file_version --- //
    $results_delete_data['file_delete']['total_input']++;

    $sql = str_replace(
        array(
            '[FILE_ID]' 
        ), 
        array(
            addslashes($api_data['document_handler_form_file_data_entry']['document_handler_form_file_id'])
        ), 
        $sql_template_delete_document_handler_file_version
    );

    $results = executeDbQuery($sql, $db_connection);
    if ($results['error'] == 'null') {
        $results_delete_data['file_delete']['total_success']++;
    } else {
        $results_delete_data['file_delete']['total_failure']++;
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


    if ($results_delete_data['file_delete']['total_input'] == $results_delete_data['file_delete']['total_success']) {
        $results_delete_data['file_delete']['is_success'] = true;
    }


    $data_before_activity = array(
        'document_handler_folder_file_records' => $document_handler_folder_file_records, 
        'document_handler_file_record' => $document_handler_file_record
    );
}


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- save activity log file -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
// $results_delete_data['folder_delete']['total_input']++;

// $data_before_activity_in_json = json_encode($data_before_activity);

// $sql = str_replace(
//     array(
//         '[ACTIVITY_TYPE]', 
//         '[ACTIVITY_TARGET_ID]', 
//         '[DATA_BEFORE_ACTIVITY]', 
//         '[USER_ID]', 
//         '[GROUP_ID]'
//     ), 
//     array(
//         'folder_delete', 
//         // where is the id //
//         $data_before_activity_in_json, 
//         addslashes($login_user_info['user_id']), 
//         addslashes($login_user_info['user_group_id'])
//     ), 
//     $sql_template_insert_document_handler_activity_log
// );

// $results = executeDbQuery($sql, $db_connection);
// if ($results['error'] == 'null') {
//     $results_delete_data['folder_delete']['total_success']++;
// } else {
//     $results_delete_data['folder_delete']['total_failure']++;
// }




/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- process update data results -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$total_overall_input = 0;
foreach ($results_delete_data as $key1 => $value1) {
    $total_overall_input += $value1['total_input'];
}

$total_overall_success = 0;
foreach ($results_delete_data as $key1 => $value1) {
    $total_overall_success += $value1['total_success'];
}

if ($total_overall_input == $total_overall_success) {
    $api_response['error'] = 'null';
} else {
    $api_response['error'] = '10040';
}

$api_response['message'] = array(
    'total_overall_input' => $total_overall_input, 
    'total_overall_success' => $total_overall_success
);

if (isset($api_data['access_mode'])) {
    switch ($api_data['access_mode']) {
        case 'entity_delete':
            break;
        case 'folder_delete':
            break;
        case 'file_delete':
            break;
    }
}

$api_response['data'] = array(
);

// if (! ($enable_deleting[$target_data_source] == true && $results_delete_data[$target_data_source]['is_success'] == true) && 
      // ($enable_deleting['data_followup'] == true && $results_delete_data['data_followup']['is_success'] == true) &&  
      // ($enable_deleting['data_measurement'] == true && $results_delete_data['data_measurement']['is_success'] == true)) {
    // mysql_query("ROLLBACK");
// }
?>