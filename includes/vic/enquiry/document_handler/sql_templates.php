<?php
/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- insert ???  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_insert_document_handler_entity = "
    INSERT INTO document_handler_entity 
    (
        module,             id, 
        name,               description,                summary, 
        user_id,            group_id,                   date_created 
    )
    VALUES 
    (
        '[MODULE]',         '[ENTITY_ID]', 
        '[ENTITY_NAME]',    '[ENTITY_DESCRIPTION]',     '[ENTITY_SUMMARY]', 
        '[USER_ID]',        '[GROUP_ID]',               NOW() 
    );
";





$sql_template_insert_document_handler_folder = "
    INSERT INTO document_handler_folder 
    (
        id, 
        name,               description,                summary, 
        user_id,            group_id,                   date_created 
    )
    VALUES 
    (
        '[FOLDER_ID]', 
        '[FOLDER_NAME]',    '[FOLDER_DESCRIPTION]',     '[FOLDER_SUMMARY]', 
        '[USER_ID]',        '[GROUP_ID]',               NOW() 
    );
";


$sql_template_insert_document_handler_entity_folder = "
    INSERT INTO document_handler_entity_folder 
    (
        module,             entity_id,          folder_id, 
        user_id,            group_id,           date_created 
    )
    VALUES 
    (
        '[MODULE]',         '[ENTITY_ID]',     '[FOLDER_ID]', 
        '[USER_ID]',        '[GROUP_ID]',       NOW() 
    );
";
$sql_template_insert_document_handler_entity_folder_2 = "
    INSERT INTO document_handler_entity_folder 
    (
        id, 
        module,             entity_id,          folder_id, 
        user_id,            group_id,           date_created 
    )
    VALUES 
    (
        [ENTITY_FOLDER_ID], 
        '[MODULE]',         '[ENTITY_ID]',     '[FOLDER_ID]', 
        '[USER_ID]',        '[GROUP_ID]',       NOW() 
    );
";





$sql_template_insert_document_handler_file = "
    INSERT INTO document_handler_file 
    (
        id, 
        name,                   description,                summary, 
        `from`,                 date_received, 
        `to`,                   date_sent, 
        content_date,           content_category, 
        original_name,          extension, 
        type,                   size,                       external_ref_name, 
        status, 
        user_id,                group_id,                   date_created 
    )
    VALUES 
    (
        '[FILE_ID]', 
        '[FILE_NAME]',          '[FILE_DESCRIPTION]',       '[FILE_SUMMARY]', 
        '[FILE_FROM]',          '[FILE_DATE_RECEIVED]', 
        '[FILE_TO]',            '[FILE_DATE_SENT]', 
        '[FILE_CONTENT_DATE]',  '[FILE_CONTENT_CATEGORY]', 
        '[FILE_ORIGINAL_NAME]', '[FILE_EXTENSION]', 
        '[FILE_TYPE]',          '[FILE_SIZE]',              '[EXTERNAL_REF_NAME]', 
        '[FILE_STATUS]', 
        '[USER_ID]',            '[GROUP_ID]',               NOW() 
    );
";


$sql_template_insert_document_handler_folder_file = "
    INSERT INTO document_handler_folder_file 
    (
        folder_id,          file_id, 
        user_id,            group_id,           date_created 
    )
    VALUES 
    (
        '[FOLDER_ID]',     '[FILE_ID]', 
        '[USER_ID]',       '[GROUP_ID]',        NOW() 
    );
";
$sql_template_insert_document_handler_folder_file_2 = "
    INSERT INTO document_handler_folder_file 
    (
        id, 
        folder_id,          file_id, 
        user_id,            group_id,           date_created 
    )
    VALUES 
    (
        '[FOLDER_FILE_ID]', 
        '[FOLDER_ID]',     '[FILE_ID]', 
        '[USER_ID]',       '[GROUP_ID]',        NOW() 
    );
";





$sql_template_insert_document_handler_file_version = "
    INSERT INTO document_handler_file_version 
    (
        file_id,            external_ref_name, 
        user_id,            group_id,                       date_created 
    )
    VALUES 
    (
        '[FILE_ID]',        '[FILE_EXTERNAL_REF_NAME]', 
        '[USER_ID]',        '[GROUP_ID]',                   NOW() 
    );
";



$sql_template_insert_document_handler_entity_folder_file_2 = "
    INSERT INTO document_handler_entity_folder_file 
    (
        id, 
        entity_id,          entity_name,  
        folder_id,          folder_name, 
        file_id,            file_name, 
        user_id,            group_id,           date_created 
    )
    VALUES 
    (
        '[ENTITY_FOLDER_FILE_ID]', 
        '[ENTITY_ID]',     '[ENTITY_NAME]', 
        '[FOLDER_ID]',     '[FOLDER_NAME]', 
        '[FILE_ID]',       '[FILE_NAME]', 
        '[USER_ID]',       '[GROUP_ID]',        NOW() 
    );
";





$sql_template_insert_document_handler_activity_log = "
    INSERT INTO document_handler_activity_log 
    (
        activity_type,      activity_target_id,         data_before_activity, 
        user_id,            group_id,                   date_created 
    )
    VALUES 
    (
        '[ACTIVITY_TYPE]',  '[ACTIVITY_TARGET_ID]',     '[DATA_BEFORE_ACTIVITY]', 
        '[USER_ID]',        '[GROUP_ID]',               NOW() 
    );
";









/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- retrieve ??? -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_retrieve_current_login_user_info = "
    SELECT 
        ver_users.username AS 'username', 
        ver_users.password AS 'password', 
        ver_users.id AS 'user_id', 
        ver_usergroups.id AS 'user_group_id', 
        ver_usergroups.title AS 'user_group_group_name', 
        ver_users.id AS 'employee_id',  
        IFNULL(ver_users.first_name, 'na') AS 'employee_first_name', 
        IFNULL(ver_users.last_name, 'na') AS 'employee_last_name' 
    FROM ver_users 
        LEFT JOIN ver_user_usergroup_map 
            ON ver_users.id = ver_user_usergroup_map.user_id 
        LEFT JOIN ver_usergroups 
            ON ver_user_usergroup_map.group_id = ver_usergroups.id 
    WHERE ver_users.username = '[USERNAME]' 
    AND ver_users.password = '[PASSWORD]' 
    LIMIT 1;
";





$sql_template_retrieve_table_status = "
    SHOW TABLE STATUS LIKE '[TABLE_NAME]';
";





$sql_template_retrieve_entity_list_1 = "
    SELECT 
        -1 AS 'entity_id', 
        'TEMPORARY' AS 'entity_name', 
        '' AS 'entity_description', 
        '' AS 'entity_summary', 
        '' AS 'entity_date_created' 
    UNION 
    SELECT 
        id AS 'entity_id', 
        name AS 'entity_name', 
        description AS 'entity_description', 
        summary AS 'entity_summary', 
        date_created AS 'entity_date_created' 
    FROM document_handler_entity 
    WHERE date_deleted IS NULL 
    AND module = '[MODULE]' 
    ORDER BY entity_id DESC 
    LIMIT 1000;
";
$sql_template_retrieve_entity_list_2 = "
    SELECT 
        -1 AS 'entity_id', 
        'TEMPORARY' AS 'entity_name', 
        '' AS 'entity_description', 
        '' AS 'entity_summary', 
        '' AS 'entity_date_created' 
    UNION 
    SELECT 
        id AS 'entity_id', 
        name AS 'entity_name', 
        description AS 'entity_description', 
        summary AS 'entity_summary', 
        date_created AS 'entity_date_created' 
    FROM document_handler_entity 
    WHERE date_deleted IS NULL 
    ORDER BY entity_id DESC 
    LIMIT 1000;
";





$sql_template_retrieve_entity_folder_list_1 = "
    SELECT 
        -1 AS 'folder_id', 
        'TEMPORARY' AS 'folder_name', 
        '' AS 'folder_description', 
        '' AS 'folder_summary', 
        '' AS 'folder_date_created' 
    UNION 
    SELECT 
        document_handler_folder.id AS 'folder_id', 
        document_handler_folder.name AS 'folder_name', 
        document_handler_folder.description AS 'folder_description', 
        document_handler_folder.summary AS 'folder_summary', 
        document_handler_folder.date_created AS 'folder_date_created' 
    FROM document_handler_entity_folder 
        LEFT JOIN document_handler_folder 
            ON document_handler_entity_folder.folder_id = document_handler_folder.id 
    WHERE document_handler_entity_folder.date_deleted IS NULL 
    AND document_handler_folder.date_deleted IS NULL 
    AND document_handler_entity_folder.module = '[MODULE]' 
    AND document_handler_entity_folder.entity_id = '[ENTITY_ID]' 
    ORDER BY folder_id DESC 
    LIMIT 1000;
";
$sql_template_retrieve_entity_folder_list_2 = "
    SELECT 
        -1 AS 'folder_id', 
        'TEMPORARY' AS 'folder_name', 
        '' AS 'folder_description', 
        '' AS 'folder_summary', 
        '' AS 'folder_date_created' 
    UNION 
    SELECT 
        document_handler_folder.id AS 'folder_id', 
        document_handler_folder.name AS 'folder_name', 
        document_handler_folder.description AS 'folder_description', 
        document_handler_folder.summary AS 'folder_summary', 
        document_handler_folder.date_created AS 'folder_date_created' 
    FROM document_handler_entity_folder 
        LEFT JOIN document_handler_folder 
            ON document_handler_entity_folder.folder_id = document_handler_folder.id 
    WHERE document_handler_entity_folder.date_deleted IS NULL 
    AND document_handler_folder.date_deleted IS NULL 
    AND document_handler_entity_folder.entity_id = '[ENTITY_ID]' 
    ORDER BY folder_id DESC 
    LIMIT 1000;
";


$sql_template_retrieve_folder_entity_list = "
    SELECT 
        document_handler_entity.id AS 'entity_id', 
        document_handler_entity.name AS 'entity_name', 
        document_handler_entity.description AS 'entity_description', 
        document_handler_entity.date_created AS 'entity_date_created' 
    FROM document_handler_entity_folder 
        LEFT JOIN document_handler_entity 
            ON document_handler_entity_folder.entity_id = document_handler_entity.id 
    WHERE document_handler_entity.date_deleted IS NULL 
    AND document_handler_entity_folder.date_deleted IS NULL 
    AND document_handler_entity_folder.folder_id = '[FOLDER_ID]' 
    ORDER BY document_handler_entity_folder.id 
    LIMIT 1000;
";





$sql_template_retrieve_entity_by_name = "
    SELECT 
        id AS 'entity_id', 
        name AS 'entity_name', 
        description AS 'entity_description', 
        summary AS 'entity_summary', 
        date_created AS 'entity_date_created' 
    FROM document_handler_entity 
    WHERE date_deleted IS NULL 
    AND name = '[ENTITY_NAME]' 
    ORDER BY entity_id 
    LIMIT 1;
";
$sql_template_retrieve_entity_folder_by_ids = "
    SELECT 
        id, 
        entity_id, 
        folder_id 
    FROM document_handler_entity_folder 
    WHERE date_deleted IS NULL 
    AND entity_id = '[ENTITY_ID]' 
    AND folder_id = '[FOLDER_ID]' 
    ORDER BY entity_id, folder_id 
    LIMIT 1;
";
$sql_template_retrieve_entity_folder_by_names = "
    SELECT 
        document_handler_entity_folder.id, 
        document_handler_entity_folder.entity_id, 
        document_handler_entity_folder.folder_id, 
        document_handler_entity.name AS 'entity_name', 
        document_handler_folder.name AS 'folder_name' 
    FROM document_handler_entity 
        LEFT JOIN document_handler_entity_folder 
            ON document_handler_entity.id = document_handler_entity_folder.entity_id 
        LEFT JOIN document_handler_folder 
            ON document_handler_entity_folder.folder_id = document_handler_folder.id 
    WHERE document_handler_entity.date_deleted IS NULL 
    AND document_handler_entity_folder.date_deleted IS NULL 
    AND document_handler_folder.date_deleted IS NULL 
    AND document_handler_entity.id IS NOT NULL 
    AND document_handler_folder.id IS NOT NULL 
    AND document_handler_entity.name = '[ENTITY_NAME]' 
    AND document_handler_folder.name = '[FOLDER_NAME]' 
    ORDER BY document_handler_entity_folder.entity_id, document_handler_entity_folder.folder_id 
    LIMIT 1;
";


$sql_template_retrieve_folder_by_name = "
    SELECT 
        id AS 'folder_id', 
        name AS 'folder_name', 
        description AS 'folder_description', 
        summary AS 'folder_summary', 
        date_created AS 'folder_date_created' 
    FROM document_handler_folder 
    WHERE date_deleted IS NULL 
    AND name = '[FOLDER_NAME]' 
    ORDER BY folder_id 
    LIMIT 1;
";
$sql_template_retrieve_folder_file_by_ids = "
    SELECT 
        id, 
        folder_id, 
        file_id 
    FROM document_handler_folder_file 
    WHERE date_deleted IS NULL 
    AND folder_id = '[FOLDER_ID]' 
    AND file_id = '[FILE_ID]' 
    ORDER BY folder_id, file_id 
    LIMIT 1;
";
$sql_template_retrieve_folder_file_by_names = "
    SELECT 
        document_handler_folder_file.id, 
        document_handler_folder_file.folder_id, 
        document_handler_folder_file.file_id, 
        document_handler_folder.name AS 'folder_name', 
        document_handler_file.name AS 'file_name' 
    FROM document_handler_folder 
        LEFT JOIN document_handler_folder_file 
            ON document_handler_folder.id = document_handler_folder_file.folder_id 
        LEFT JOIN document_handler_file 
            ON document_handler_folder_file.file_id = document_handler_file.id 
    WHERE document_handler_folder.date_deleted IS NULL 
    AND document_handler_folder_file.date_deleted IS NULL 
    AND document_handler_file.date_deleted IS NULL 
    AND document_handler_folder.id IS NOT NULL 
    AND document_handler_file.id IS NOT NULL 
    AND document_handler_folder.name = '[FOLDER_NAME]' 
    AND document_handler_file.name = '[FILE_NAME]' 
    ORDER BY document_handler_folder_file.folder_id, document_handler_folder_file.file_id 
    LIMIT 1;
";





$sql_template_retrieve_folder_file_list_1 = "
    SELECT 
        document_handler_file.id AS 'file_id', 
        document_handler_file.name AS 'file_name', 
        document_handler_file.description AS 'file_description', 
        document_handler_file.summary AS 'file_summary', 
        document_handler_file.from AS 'file_from', 
        document_handler_file.date_received AS 'file_date_received', 
        document_handler_file.to AS 'file_to', 
        document_handler_file.date_sent AS 'file_date_sent', 
        document_handler_file.content_date AS 'file_content_date', 
        document_handler_file.content_category AS 'file_content_category', 
        document_handler_file.original_name AS 'file_original_name', 
        document_handler_file.extension AS 'file_extension', 
        document_handler_file.type AS 'file_type', 
        document_handler_file.size AS 'file_size', 
        document_handler_file.external_ref_name AS 'file_external_ref_name', 
        document_handler_file.status AS 'file_status', 
        document_handler_file.date_created AS 'file_date_created' 
    FROM document_handler_folder_file 
        LEFT JOIN document_handler_file 
            ON document_handler_folder_file.file_id = document_handler_file.id 
    WHERE document_handler_folder_file.date_deleted IS NULL 
    AND document_handler_file.date_deleted IS NULL 
    AND document_handler_folder_file.folder_id = '[FOLDER_ID]' 
    AND document_handler_file.content_category = '[CONTENT_CATEGORY]' 
    ORDER BY document_handler_file.name 
    LIMIT 1000;
";


$sql_template_retrieve_folder_file_list_2 = "
    SELECT 
        document_handler_file.id AS 'file_id', 
        document_handler_file.name AS 'file_name', 
        document_handler_file.description AS 'file_description', 
        document_handler_file.summary AS 'file_summary', 
        document_handler_file.from AS 'file_from', 
        document_handler_file.date_received AS 'file_date_received', 
        document_handler_file.to AS 'file_to', 
        document_handler_file.date_sent AS 'file_date_sent', 
        document_handler_file.content_date AS 'file_content_date', 
        document_handler_file.content_category AS 'file_content_category', 
        document_handler_file.original_name AS 'file_original_name', 
        document_handler_file.extension AS 'file_extension', 
        document_handler_file.type AS 'file_type', 
        document_handler_file.size AS 'file_size', 
        document_handler_file.external_ref_name AS 'file_external_ref_name', 
        document_handler_file.status AS 'file_status', 
        document_handler_file.date_created AS 'file_date_created' 
    FROM document_handler_folder_file 
        LEFT JOIN document_handler_file 
            ON document_handler_folder_file.file_id = document_handler_file.id 
    WHERE document_handler_folder_file.date_deleted IS NULL 
    AND document_handler_file.date_deleted IS NULL 
    AND document_handler_folder_file.folder_id = '[FOLDER_ID]' 
    ORDER BY document_handler_file.name 
    LIMIT 1000;
";


$sql_template_retrieve_file_folder_list = "
    SELECT 
        document_handler_folder.id AS 'folder_id', 
        document_handler_folder.name AS 'folder_name', 
        document_handler_folder.description AS 'folder_description', 
        document_handler_folder.date_created AS 'folder_date_created'
    FROM document_handler_folder_file 
        LEFT JOIN document_handler_folder 
            ON document_handler_folder_file.folder_id = document_handler_folder.id 
    WHERE document_handler_folder_file.date_deleted IS NULL 
    AND document_handler_folder.date_deleted IS NULL 
    AND document_handler_folder_file.file_id = '[FILE_ID]' 
    ORDER BY document_handler_folder_file.id 
    LIMIT 1000;
";


$sql_template_retrieve_file_folder_entity_list = "
    SELECT 
        document_handler_entity.id AS 'entity_id', 
        document_handler_entity.name AS 'entity_name', 
        document_handler_entity.description AS 'entity_description', 
        document_handler_entity.date_created AS 'entity_date_created', 
        document_handler_folder.id AS 'folder_id', 
        document_handler_folder.name AS 'folder_name', 
        document_handler_folder.description AS 'folder_description', 
        document_handler_folder.date_created AS 'folder_date_created'
    FROM document_handler_entity_folder_file 
        LEFT JOIN document_handler_entity 
            ON document_handler_entity_folder_file.entity_id = document_handler_entity.id 
        LEFT JOIN document_handler_folder 
            ON document_handler_entity_folder_file.folder_id = document_handler_folder.id 
        LEFT JOIN document_handler_file 
            ON document_handler_entity_folder_file.file_id = document_handler_file.id 
    WHERE document_handler_entity_folder_file.date_deleted IS NULL 
    AND document_handler_entity.date_deleted IS NULL 
    AND document_handler_folder.date_deleted IS NULL 
    AND document_handler_file.date_deleted IS NULL 
    AND document_handler_entity.id IS NOT NULL 
    AND document_handler_folder.id IS NOT NULL 
    AND document_handler_file.id IS NOT NULL 
    AND document_handler_entity_folder_file.file_id = '[FILE_ID]' 
    ORDER BY document_handler_entity_folder_file.id 
    LIMIT 1000;
";


$sql_template_retrieve_file_version_list = "
    SELECT 
        document_handler_file_version.external_ref_name AS 'file_version_external_ref_name', 
        CONCAT(document_handler_file_version.date_created, ' (', ver_users.name, ')') AS 'file_version_date_created' 
    FROM document_handler_file_version 
        LEFT JOIN document_handler_file 
            ON document_handler_file_version.file_id = document_handler_file.id 
        LEFT JOIN ver_users 
            ON document_handler_file_version.user_id = ver_users.id 
    WHERE document_handler_file_version.date_deleted IS NULL 
    AND document_handler_file.date_deleted IS NULL 
    AND document_handler_file_version.file_id = '[FILE_ID]' 
    ORDER BY document_handler_file_version.date_created DESC 
    LIMIT 1000;
";


$sql_template_retrieve_entity_folder_file_by_names = "
    SELECT 
        document_handler_entity_folder_file.id, 
        document_handler_entity.id AS 'entity_id', 
        document_handler_folder.id AS 'folder_id', 
        document_handler_file.id AS 'file_id', 
        document_handler_entity.name AS 'entity_name', 
        document_handler_folder.name AS 'folder_name', 
        document_handler_file.name AS 'file_name' 
    FROM document_handler_entity 
        LEFT JOIN document_handler_entity_folder_file 
            ON document_handler_entity.id = document_handler_entity_folder_file.entity_id 
        LEFT JOIN document_handler_folder 
            ON document_handler_entity_folder_file.folder_id = document_handler_folder.id 
        LEFT JOIN document_handler_file 
            ON document_handler_entity_folder_file.file_id = document_handler_file.id 
    WHERE document_handler_entity.date_deleted IS NULL 
    AND document_handler_folder.date_deleted IS NULL 
    AND document_handler_file.date_deleted IS NULL 
    AND document_handler_entity_folder_file.date_deleted IS NULL 
    AND document_handler_entity.id IS NOT NULL 
    AND document_handler_folder.id IS NOT NULL 
    AND document_handler_file.id IS NOT NULL 
    AND document_handler_entity.name = '[ENTITY_NAME]' 
    AND document_handler_folder.name = '[FOLDER_NAME]' 
    AND document_handler_file.name = '[FILE_NAME]' 
    ORDER BY document_handler_entity_folder_file.entity_name, document_handler_entity_folder_file.folder_name, document_handler_entity_folder_file.file_name 
    LIMIT 1;
";




$sql_template_retrieve_download_file_info = "
    SELECT 
        id AS 'file_id', 
        name AS 'file_name', 
        description AS 'file_description', 
        summary AS 'file_summary', 
        `from` AS 'file_from', 
        date_received AS 'file_date_received', 
        `to` AS 'file_to', 
        date_sent AS 'file_date_sent', 
        content_date AS 'file_content_date', 
        content_category AS 'file_content_category', 
        original_name AS 'file_original_name', 
        extension AS 'file_extension', 
        type AS 'file_type', 
        size AS 'file_size', 
        external_ref_name AS 'file_external_ref_name', 
        customisation_options AS 'file_customisation_options', 
        user_id AS 'file_user_id', 
        group_id AS 'file_group_id', 
        date_created AS 'file_date_created', 
        date_accessed AS 'file_date_accessed', 
        date_modified AS 'file_date_modified', 
        date_deleted AS 'file_date_deleted', 
        status AS 'file_status' 
    FROM document_handler_file 
    WHERE date_deleted IS NULL 
    AND external_ref_name = '[FILE_EXTERNAL_REF_NAME]' 
    LIMIT 1;
";

$sql_template_retrieve_download_file_info_2 = "
    SELECT 
        document_handler_file.id AS 'file_id', 
        document_handler_file.name AS 'file_name', 
        document_handler_file.description AS 'file_description', 
        document_handler_file.summary AS 'file_summary', 
        document_handler_file.`from` AS 'file_from', 
        document_handler_file.date_received AS 'file_date_received', 
        document_handler_file.`to` AS 'file_to', 
        document_handler_file.date_sent AS 'file_date_sent', 
        document_handler_file.content_date AS 'file_content_date', 
        document_handler_file.content_category AS 'file_content_category', 
        document_handler_file.original_name AS 'file_original_name', 
        document_handler_file.extension AS 'file_extension', 
        document_handler_file.type AS 'file_type', 
        document_handler_file.size AS 'file_size', 
        document_handler_file_version.external_ref_name AS 'file_external_ref_name', 
        document_handler_file.customisation_options AS 'file_customisation_options', 
        document_handler_file.user_id AS 'file_user_id', 
        document_handler_file.group_id AS 'file_group_id', 
        document_handler_file.date_created AS 'file_date_created', 
        document_handler_file.date_accessed AS 'file_date_accessed', 
        document_handler_file.date_modified AS 'file_date_modified', 
        document_handler_file.date_deleted AS 'file_date_deleted', 
        document_handler_file.status AS 'file_status' 
    FROM document_handler_file_version 
        LEFT JOIN document_handler_file 
            ON document_handler_file_version.file_id = document_handler_file.id 
    WHERE document_handler_file_version.date_deleted IS NULL 
    AND document_handler_file.date_deleted IS NULL 
    AND document_handler_file_version.external_ref_name = '[FILE_EXTERNAL_REF_NAME]' 
    ORDER BY document_handler_file_version.date_created DESC 
    LIMIT 1;
";





$sql_template_retrieve_document_handler_entity_folder_records = "
    SELECT * 
    FROM document_handler_entity_folder 
    WHERE entity_id = '[ENTITY_ID]' 
    LIMIT 1000;
";

$sql_template_retrieve_document_handler_entity_record = "
    SELECT * 
    FROM document_handler_entity 
    WHERE id = '[ENTITY_ID]' 
    LIMIT 1;
";

$sql_template_retrieve_document_handler_entity_folder_records_2 = "
    SELECT * 
    FROM document_handler_entity_folder 
    WHERE folder_id = '[FOLDER_ID]' 
    LIMIT 1000;
";

$sql_template_retrieve_document_handler_folder_record = "
    SELECT * 
    FROM document_handler_folder 
    WHERE id = '[FOLDER_ID]' 
    LIMIT 1;
";

$sql_template_retrieve_document_handler_folder_file_records = "
    SELECT * 
    FROM document_handler_folder_file 
    WHERE folder_id = '[FOLDER_ID]' 
    LIMIT 1000;
";

$sql_template_retrieve_document_handler_file_record = "
    SELECT * 
    FROM document_handler_file 
    WHERE id = '[FILE_ID]' 
    LIMIT 1;
";

$sql_template_retrieve_document_handler_folder_file_records_2 = "
    SELECT * 
    FROM document_handler_folder_file 
    WHERE file_id = '[FILE_ID]' 
    LIMIT 1000;
";





// $sql_template_retrieve_ver_chronoforms_data_clientpersonal_vic_last_record = "
//     SELECT * 
//     FROM ver_chronoforms_data_clientpersonal_vic 
//     ORDER BY datelodged DESC 
//     LIMIT 1;
// ";
$sql_template_retrieve_ver_chronoforms_data_clientpersonal_vic_last_record = "
    SELECT *, quoteid AS 'clientid' 
    FROM ver_chronoforms_data_contract_list_vic 
    ORDER BY quotedate DESC 
    LIMIT 1;
";





$sql_template_retrieve_template_data_tag_list = "
    SELECT 
        CONCAT(DAY(NOW()), '-', MONTHNAME(NOW()), '-', YEAR(NOW())) AS '[|TODAYS_DATE|]', 
        IFNULL(
            (
                SELECT 
                    vu2.name
                FROM ver_users vu2 
                    LEFT JOIN ver_user_usergroup_map vugm2 
                        ON vu2.id = vugm2.user_id 
                    LEFT JOIN ver_usergroups vug2 
                        ON vugm2.group_id = vug2.id 
                    LEFT JOIN ver_chronoforms_data_user_group_vic dug2 
                        ON vug2.id = dug2.group_id 
                WHERE vu2.id = '[USER_ID]' 
            )
            , '' 
        ) AS '[|LOGGED_IN_USER_NAME|]', 
        IFNULL(
            (
                SELECT 
                    dug2.group_name 
                FROM ver_users vu2 
                    LEFT JOIN ver_user_usergroup_map vugm2 
                        ON vu2.id = vugm2.user_id 
                    LEFT JOIN ver_usergroups vug2 
                        ON vugm2.group_id = vug2.id 
                    LEFT JOIN ver_chronoforms_data_user_group_vic dug2 
                        ON vug2.id = dug2.group_id 
                WHERE vu2.id = '[USER_ID]' 
            )
            , '' 
        ) AS '[|LOGGED_IN_USER_POSITION|]', 
        IFNULL(vu.name, '') AS '[|SALES_REP_NAME|]', 
        IFNULL(vu.email, '') AS '[|SALES_REP_EMAIL|]', 
        IFNULL(vu.mobile, '') AS '[|SALES_REP_MOBILE|]', 
        IFNULL(dug.group_name, '') AS '[|SALES_REP_POSITION|]', 
        IFNULL(cp.clientid, '') AS '[|QUOTE_ID|]', 
        /*
        IFNULL(cp.client_title, '') AS '[|CLIENT_TITLE|]', 
        ( 
            CASE WHEN (cp.client_firstname IS NULL) OR (cp.client_firstname = '') 
            THEN IFNULL(cp.builder_name, '') 
            ELSE IFNULL(cp.client_firstname, '') 
            END 
        ) AS '[|CLIENT_FIRSTNAME|]', 
        ( 
            CASE WHEN (cp.client_lastname IS NULL) OR (cp.client_lastname = '') 
            THEN IFNULL(cp.builder_contact, '') 
            ELSE IFNULL(cp.client_lastname, '') 
            END 
        ) AS '[|CLIENT_LASTNAME|]', 
        */
        IFNULL(cp.client_firstname, '') AS '[|CLIENT_FIRSTNAME|]', 
        IFNULL(cp.client_lastname, '') AS '[|CLIENT_LASTNAME|]', 
        TRIM(
            CONCAT(
                IFNULL(cp.client_title, ''), 
                ' ', 
                IFNULL(cp.client_firstname, ''), 
                ' ', 
                IFNULL(cp.client_lastname, '')
            )
        ) AS '[|CLIENT_NAME|]', 
        IFNULL(cp.builder_name, '') AS '[|BUILDER_NAME|]', 
        IFNULL(cp.builder_contact, '') AS '[|BUILDER_CONTACT|]', 
        IFNULL(cp.client_streetno, '') AS '[|CLIENT_STREET_NUMBER|]', 
        IFNULL(cp.client_streetname, '') AS '[|CLIENT_STREET_NAME|]', 
        IFNULL(cp.client_address1, '') AS '[|CLIENT_ADDRESS_1|]', 
        IFNULL(cp.client_address2, '') AS '[|CLIENT_ADDRESS_2|]', 
        IFNULL(cp.client_suburb, '') AS '[|CLIENT_SUBURB|]', 
        IFNULL(cp.client_state, '') AS '[|CLIENT_STATE|]', 
        IFNULL(cp.client_postcode, '') AS '[|CLIENT_POSTCODE|]', 
        TRIM(
            CONCAT(
                IFNULL(cp.client_streetno, ''), 
                ', ', 
                IFNULL(cp.client_streetname, ''), 
                ', ', 
                IFNULL(cp.client_address1, ''), 
                ', ', 
                IFNULL(cp.client_address2, ''), 
                ', ', 
                IFNULL(cp.client_suburb, ''), 
                ', ', 
                IFNULL(cp.client_state, ''), 
                ', ', 
                IFNULL(cp.client_postcode, '')
            )
        ) AS '[|CLIENT_ADDRESS|]', 
        IFNULL(cp.client_mobile, '') AS '[|CLIENT_MOBILE_PHONE|]', 
        IFNULL(cp.client_hmphone, '') AS '[|CLIENT_HOME_PHONE|]', 
        IFNULL(cp.client_wkphone, '') AS '[|CLIENT_WORK_PHONE|]', 
        IFNULL(cp.client_email, '') AS '[|CLIENT_EMAIL|]', 
        IFNULL(cp.site_sitename, '') AS '[|SITE_NAME|]', 
        IFNULL(cp.site_streetno, '') AS '[|SITE_STREET_NUMBER|]', 
        IFNULL(cp.site_streetname, '') AS '[|SITE_STREET_NAME|]', 
        IFNULL(cp.site_address1, '') AS '[|SITE_ADDRESS_1|]', 
        IFNULL(cp.site_address2, '') AS '[|SITE_ADDRESS_2|]', 
        IFNULL(cp.site_suburb, '') AS '[|SITE_SUBURB|]', 
        IFNULL(cp.site_state, '') AS '[|SITE_STATE|]', 
        IFNULL(cp.site_postcode, '') AS '[|SITE_POSTCODE|]', 
        TRIM(
            CONCAT(
                IFNULL(cp.site_streetno, ''), 
                ', ', 
                IFNULL(cp.site_streetname, ''), 
                ', ', 
                IFNULL(cp.site_address1, ''), 
                ', ', 
                IFNULL(cp.site_address2, ''), 
                ', ', 
                IFNULL(cp.site_suburb, ''), 
                ', ', 
                IFNULL(cp.site_state, ''), 
                ', ', 
                IFNULL(cp.site_postcode, '')
            )
        ) AS '[|SITE_ADDRESS|]', 
        IFNULL(cp.site_mobile, '') AS '[|SITE_MOBILE_PHONE|]', 
        IFNULL(cp.site_hmphone, '') AS '[|SITE_HOME_PHONE|]', 
        IFNULL(cp.site_wkphone, '') AS '[|SITE_WORK_PHONE|]', 
        IFNULL(cp.site_email, '') AS '[|SITE_EMAIL|]', 
        IFNULL(CONCAT(DAY(fu.quotedate), '-', SUBSTRING(MONTHNAME(fu.quotedate), 1, 3), '-', YEAR(fu.quotedate)), '') AS '[|QUOTE_DATE|]', 
        IFNULL(CONCAT(DAY(cl.contractdate), '-', SUBSTRING(MONTHNAME(cl.contractdate), 1, 3), '-', YEAR(cl.contractdate)), '') AS '[|CONTRACT_DATE|]', 
        IFNULL(fu.projectid, '') AS '[|PROJECT_ID|]', 
        IFNULL(fu.project_name, '') AS '[|PROJECT_NAME|]', 
        IFNULL(fu.framework_type, '') AS '[|FRAMEWORK_TYPE|]', 
        /*
        IFNULL(IFNULL(dm4.length, 0), 0) AS '[|VERGOLA_LENGTH|]', 
        IFNULL(IFNULL(dm4.width, 0), 0) AS '[|VERGOLA_WIDTH|]', 
        */
        CONCAT(
            IFNULL(dm4.length, 0), 
            ' X ', 
            IFNULL(dm4.width, 0)
        ) AS '[|VERGOLA_SIZE|]', 
        IFNULL(dq1.framework, '') AS '[|TYPE_OF_VERGOLA|]', 
        IFNULL(dq2.description, '') AS '[|BEAM_TYPE|]', 
        IFNULL(dq3.description, '') AS '[|COLUMN_TYPE|]', 
        IFNULL(dq4.finish, '') AS '[|GUTTER_TYPE|]', 
        IFNULL(dq5.finish, '') AS '[|FLASHING_TYPE|]', 
        IFNULL(dm3.total_record, '') AS '[|NUMBER_OF_BAY|]', 
        FORMAT(IFNULL(fu.subtotal_vergola, 0), 2) AS '[|SUBTOTAL_VERGOLA|]', 
        FORMAT(IFNULL(fu.subtotal_disbursement, 0), 2) AS '[|SUBTOTAL_DISBURSEMENT|]', 
        FORMAT(IFNULL(fu.total_cost, 0), 2) AS '[|TOTAL_COST|]', 
        FORMAT(IFNULL(fu.total_cost_gst, 0), 2) AS '[|TOTAL_GST|]', 
        FORMAT(IFNULL(fu.total_rrp_gst, 0), 2) AS '[|TOTAL_PRICE|]', 
        FORMAT(IFNULL(fu.sales_comm, 0), 2) AS '[|SALES_COMMISSION|]', 
        FORMAT(IFNULL(fu.com_pay1, 0), 2) AS '[|COMMISSION_PAY_1|]', 
        FORMAT(IFNULL(fu.com_pay2, 0), 2) AS '[|COMMISSION_PAY_2|]', 
        FORMAT(IFNULL(fu.com_final, 0), 2) AS '[|COMMISSION_FINAL|]', 
        FORMAT(IFNULL(fu.install_comm, 0), 2) AS '[|INSTALL_COMMISSION|]', 
        FORMAT(IFNULL(fu.payment_deposit, 0), 2) AS '[|PAYMENT_DEPOSIT|]', 
        FORMAT(IFNULL(fu.payment_progress, 0), 2) AS '[|PAYMENT_PROGRESS|]', 
        FORMAT(IFNULL(fu.payment_final, 0), 2) AS '[|PAYMENT_FINAL|]' 
    FROM ver_chronoforms_data_clientpersonal_vic AS cp
        LEFT JOIN ver_users vu 
            ON cp.repid = vu.id 
        LEFT JOIN ver_user_usergroup_map vugm 
            ON vu.id = vugm.user_id 
        LEFT JOIN ver_usergroups vug 
            ON vugm.group_id = vug.id 
        LEFT JOIN ver_chronoforms_data_user_group_vic dug 
            ON vug.id = dug.group_id 
        /*
        LEFT JOIN ver_chronoforms_data_followup_vic AS fu
            ON cp.clientid = fu.quoteid 
        */
        LEFT JOIN ( 
            SELECT fu3.quoteid, MAX(fu3.cf_id) AS 'latest_id' 
            FROM ver_chronoforms_data_followup_vic AS fu3 
            GROUP BY fu3.quoteid 
        ) AS fu4 
            ON cp.clientid = fu4.quoteid 
        LEFT JOIN ver_chronoforms_data_followup_vic AS fu 
            ON fu.cf_id = fu4.latest_id 
        LEFT JOIN ver_chronoforms_data_contract_list_vic AS cl 
            ON fu.projectid = cl.projectid 
        LEFT JOIN ver_chronoforms_data_measurement_vic AS dm 
            ON fu.projectid = dm.projectid 
        LEFT JOIN ver_chronoforms_data_quote_vic dq1 
            ON fu.projectid = dq1.projectid 
        LEFT JOIN ver_chronoforms_data_quote_vic dq2
            ON fu.projectid = dq2.projectid AND dq2.inventoryid = 'IRV3' 
        LEFT JOIN ver_chronoforms_data_quote_vic dq3
            ON fu.projectid = dq3.projectid AND dq3.inventoryid = 'IRV15' 
        LEFT JOIN ver_chronoforms_data_quote_vic dq4
            ON fu.projectid = dq4.projectid AND LOWER(dq4.description) LIKE '%gutter%' 
        LEFT JOIN ver_chronoforms_data_quote_vic dq5
            ON fu.projectid = dq5.projectid AND LOWER(dq5.description) LIKE '%flashing%' 
        LEFT JOIN ( 
            SELECT 
                dm2.projectid, 
                COUNT(*) AS 'total_record' 
            FROM ver_chronoforms_data_measurement_vic dm2 
            WHERE dm2.projectid = '[ENTITY_NAME]' 
            LIMIT 1 
        ) AS dm3 
            ON fu.projectid = dm3.projectid 
        LEFT JOIN (
            SELECT dm2.projectid, SUM(dm2.length) AS 'length', dm2.width AS 'width' 
            FROM ver_chronoforms_data_measurement_vic AS dm2 
            GROUP BY dm2.projectid 
        ) AS dm4 
            ON fu.projectid = dm4.projectid 
    WHERE (
        cp.clientid = '[ENTITY_NAME]' 
        OR 
        fu.projectid = '[ENTITY_NAME]' 
    )
    LIMIT 1;
";





$sql_template_retrieve_template_data_tag_list2 = "
    SELECT 
        CONCAT(DAY(NOW()), '-', MONTHNAME(NOW()), '-', YEAR(NOW())) AS '[|TODAYS_DATE|]', 
        IFNULL(
            (
                SELECT 
                    vu2.name
                FROM ver_users vu2 
                    LEFT JOIN ver_user_usergroup_map vugm2 
                        ON vu2.id = vugm2.user_id 
                    LEFT JOIN ver_usergroups vug2 
                        ON vugm2.group_id = vug2.id 
                    LEFT JOIN ver_chronoforms_data_user_group_vic dug2 
                        ON vug2.id = dug2.group_id 
                WHERE vu2.id = '[USER_ID]' 
            )
            , '' 
        ) AS '[|LOGGED_IN_USER_NAME|]', 
        IFNULL(
            (
                SELECT 
                    dug2.group_name 
                FROM ver_users vu2 
                    LEFT JOIN ver_user_usergroup_map vugm2 
                        ON vu2.id = vugm2.user_id 
                    LEFT JOIN ver_usergroups vug2 
                        ON vugm2.group_id = vug2.id 
                    LEFT JOIN ver_chronoforms_data_user_group_vic dug2 
                        ON vug2.id = dug2.group_id 
                WHERE vu2.id = '[USER_ID]' 
            )
            , '' 
        ) AS '[|LOGGED_IN_USER_POSITION|]', 
        IFNULL(vu.name, '') AS '[|SALES_REP_NAME|]', 
        IFNULL(vu.email, '') AS '[|SALES_REP_EMAIL|]', 
        IFNULL(vu.mobile, '') AS '[|SALES_REP_MOBILE|]', 
        IFNULL(dug.group_name, '') AS '[|SALES_REP_POSITION|]', 
        IFNULL(cp.clientid, '') AS '[|QUOTE_ID|]', 
        /*
        IFNULL(cp.client_title, '') AS '[|CLIENT_TITLE|]', 
        ( 
            CASE WHEN (cp.client_firstname IS NULL) OR (cp.client_firstname = '') 
            THEN IFNULL(cp.builder_name, '') 
            ELSE IFNULL(cp.client_firstname, '') 
            END 
        ) AS '[|CLIENT_FIRSTNAME|]', 
        ( 
            CASE WHEN (cp.client_lastname IS NULL) OR (cp.client_lastname = '') 
            THEN IFNULL(cp.builder_contact, '') 
            ELSE IFNULL(cp.client_lastname, '') 
            END 
        ) AS '[|CLIENT_LASTNAME|]', 
        */
        IFNULL(cp.client_firstname, '') AS '[|CLIENT_FIRSTNAME|]', 
        IFNULL(cp.client_lastname, '') AS '[|CLIENT_LASTNAME|]', 
        TRIM(
            CONCAT(
                IFNULL(cp.client_title, ''), 
                ' ', 
                IFNULL(cp.client_firstname, ''), 
                ' ', 
                IFNULL(cp.client_lastname, '')
            )
        ) AS '[|CLIENT_NAME|]', 
        IFNULL(cp.builder_name, '') AS '[|BUILDER_NAME|]', 
        IFNULL(cp.builder_contact, '') AS '[|BUILDER_CONTACT|]', 
        IFNULL(cp.client_streetno, '') AS '[|CLIENT_STREET_NUMBER|]', 
        IFNULL(cp.client_streetname, '') AS '[|CLIENT_STREET_NAME|]', 
        IFNULL(cp.client_address1, '') AS '[|CLIENT_ADDRESS_1|]', 
        IFNULL(cp.client_address2, '') AS '[|CLIENT_ADDRESS_2|]', 
        IFNULL(cp.client_suburb, '') AS '[|CLIENT_SUBURB|]', 
        IFNULL(cp.client_state, '') AS '[|CLIENT_STATE|]', 
        IFNULL(cp.client_postcode, '') AS '[|CLIENT_POSTCODE|]', 
        TRIM(
            CONCAT(
                IFNULL(cp.client_streetno, ''), 
                ', ', 
                IFNULL(cp.client_streetname, ''), 
                ', ', 
                IFNULL(cp.client_address1, ''), 
                ', ', 
                IFNULL(cp.client_address2, ''), 
                ', ', 
                IFNULL(cp.client_suburb, ''), 
                ', ', 
                IFNULL(cp.client_state, ''), 
                ', ', 
                IFNULL(cp.client_postcode, '')
            )
        ) AS '[|CLIENT_ADDRESS|]', 
        IFNULL(cp.client_mobile, '') AS '[|CLIENT_MOBILE_PHONE|]', 
        IFNULL(cp.client_hmphone, '') AS '[|CLIENT_HOME_PHONE|]', 
        IFNULL(cp.client_wkphone, '') AS '[|CLIENT_WORK_PHONE|]', 
        IFNULL(cp.client_email, '') AS '[|CLIENT_EMAIL|]', 
        IFNULL(cp.site_sitename, '') AS '[|SITE_NAME|]', 
        IFNULL(cp.site_streetno, '') AS '[|SITE_STREET_NUMBER|]', 
        IFNULL(cp.site_streetname, '') AS '[|SITE_STREET_NAME|]', 
        IFNULL(cp.site_address1, '') AS '[|SITE_ADDRESS_1|]', 
        IFNULL(cp.site_address2, '') AS '[|SITE_ADDRESS_2|]', 
        IFNULL(cp.site_suburb, '') AS '[|SITE_SUBURB|]', 
        IFNULL(cp.site_state, '') AS '[|SITE_STATE|]', 
        IFNULL(cp.site_postcode, '') AS '[|SITE_POSTCODE|]', 
        TRIM(
            CONCAT(
                IFNULL(cp.site_streetno, ''), 
                ', ', 
                IFNULL(cp.site_streetname, ''), 
                ', ', 
                IFNULL(cp.site_address1, ''), 
                ', ', 
                IFNULL(cp.site_address2, ''), 
                ', ', 
                IFNULL(cp.site_suburb, ''), 
                ', ', 
                IFNULL(cp.site_state, ''), 
                ', ', 
                IFNULL(cp.site_postcode, '')
            )
        ) AS '[|SITE_ADDRESS|]', 
        IFNULL(cp.site_mobile, '') AS '[|SITE_MOBILE_PHONE|]', 
        IFNULL(cp.site_hmphone, '') AS '[|SITE_HOME_PHONE|]', 
        IFNULL(cp.site_wkphone, '') AS '[|SITE_WORK_PHONE|]', 
        IFNULL(cp.site_email, '') AS '[|SITE_EMAIL|]', 
        IFNULL(CONCAT(DAY(fu.quotedate), '-', SUBSTRING(MONTHNAME(fu.quotedate), 1, 3), '-', YEAR(fu.quotedate)), '') AS '[|QUOTE_DATE|]', 
        IFNULL(CONCAT(DAY(cl.contractdate), '-', SUBSTRING(MONTHNAME(cl.contractdate), 1, 3), '-', YEAR(cl.contractdate)), '') AS '[|CONTRACT_DATE|]', 
        IFNULL(fu.projectid, '') AS '[|PROJECT_ID|]', 
        IFNULL(fu.project_name, '') AS '[|PROJECT_NAME|]', 
        IFNULL(fu.framework_type, '') AS '[|FRAMEWORK_TYPE|]', 
        /*
        IFNULL(IFNULL(dm4.length, 0), 0) AS '[|VERGOLA_LENGTH|]', 
        IFNULL(IFNULL(dm4.width, 0), 0) AS '[|VERGOLA_WIDTH|]', 
        */
        CONCAT(
            IFNULL(dm4.length, 0), 
            ' X ', 
            IFNULL(dm4.width, 0)
        ) AS '[|VERGOLA_SIZE|]', 
        IFNULL(dq1.framework, '') AS '[|TYPE_OF_VERGOLA|]', 
        IFNULL(dq2.description, '') AS '[|BEAM_TYPE|]', 
        IFNULL(dq3.description, '') AS '[|COLUMN_TYPE|]', 
        IFNULL(dq4.finish, '') AS '[|GUTTER_TYPE|]', 
        IFNULL(dq5.finish, '') AS '[|FLASHING_TYPE|]', 
        IFNULL(dm3.total_record, '') AS '[|NUMBER_OF_BAY|]', 
        FORMAT(IFNULL(fu.subtotal_vergola, 0), 2) AS '[|SUBTOTAL_VERGOLA|]', 
        FORMAT(IFNULL(fu.subtotal_disbursement, 0), 2) AS '[|SUBTOTAL_DISBURSEMENT|]', 
        FORMAT(IFNULL(fu.total_cost, 0), 2) AS '[|TOTAL_COST|]', 
        FORMAT(IFNULL(fu.total_cost_gst, 0), 2) AS '[|TOTAL_GST|]', 
        FORMAT(IFNULL(fu.total_rrp_gst, 0), 2) AS '[|TOTAL_PRICE|]', 
        FORMAT(IFNULL(fu.sales_comm, 0), 2) AS '[|SALES_COMMISSION|]', 
        FORMAT(IFNULL(fu.com_pay1, 0), 2) AS '[|COMMISSION_PAY_1|]', 
        FORMAT(IFNULL(fu.com_pay2, 0), 2) AS '[|COMMISSION_PAY_2|]', 
        FORMAT(IFNULL(fu.com_final, 0), 2) AS '[|COMMISSION_FINAL|]', 
        FORMAT(IFNULL(fu.install_comm, 0), 2) AS '[|INSTALL_COMMISSION|]', 
        FORMAT(IFNULL(fu.payment_deposit, 0), 2) AS '[|PAYMENT_DEPOSIT|]', 
        FORMAT(IFNULL(fu.payment_progress, 0), 2) AS '[|PAYMENT_PROGRESS|]', 
        FORMAT(IFNULL(fu.payment_final, 0), 2) AS '[|PAYMENT_FINAL|]' 
    FROM ver_chronoforms_data_clientpersonal_vic AS cp
        LEFT JOIN ver_users vu 
            ON cp.repid = vu.id 
        LEFT JOIN ver_user_usergroup_map vugm 
            ON vu.id = vugm.user_id 
        LEFT JOIN ver_usergroups vug 
            ON vugm.group_id = vug.id 
        LEFT JOIN ver_chronoforms_data_user_group_vic dug 
            ON vug.id = dug.group_id 
        /*
        LEFT JOIN ver_chronoforms_data_followup_vic AS fu
            ON cp.clientid = fu.quoteid 
        */
        LEFT JOIN ( 
            SELECT fu3.quoteid, MAX(fu3.cf_id) AS 'latest_id' 
            FROM ver_chronoforms_data_followup_vic AS fu3 
            WHERE fu3.date_contract_system_created IS NOT NULL 
            GROUP BY fu3.quoteid 
        ) AS fu4 
            ON cp.clientid = fu4.quoteid 
        LEFT JOIN ver_chronoforms_data_followup_vic AS fu 
            ON fu.cf_id = fu4.latest_id 
        LEFT JOIN ver_chronoforms_data_contract_list_vic AS cl 
            ON fu.projectid = cl.projectid 
        LEFT JOIN ver_chronoforms_data_measurement_vic AS dm 
            ON fu.projectid = dm.projectid 
        LEFT JOIN ver_chronoforms_data_quote_vic dq1 
            ON fu.projectid = dq1.projectid 
        LEFT JOIN ver_chronoforms_data_quote_vic dq2
            ON fu.projectid = dq2.projectid AND dq2.inventoryid = 'IRV3' 
        LEFT JOIN ver_chronoforms_data_quote_vic dq3
            ON fu.projectid = dq3.projectid AND dq3.inventoryid = 'IRV15' 
        LEFT JOIN ver_chronoforms_data_quote_vic dq4
            ON fu.projectid = dq4.projectid AND LOWER(dq4.description) LIKE '%gutter%' 
        LEFT JOIN ver_chronoforms_data_quote_vic dq5
            ON fu.projectid = dq5.projectid AND LOWER(dq5.description) LIKE '%flashing%' 
        LEFT JOIN ( 
            SELECT 
                dm2.projectid, 
                COUNT(*) AS 'total_record' 
            FROM ver_chronoforms_data_measurement_vic dm2 
            WHERE dm2.projectid = '[ENTITY_NAME]' 
            LIMIT 1 
        ) AS dm3 
            ON fu.projectid = dm3.projectid 
        LEFT JOIN (
            SELECT dm2.projectid, SUM(dm2.length) AS 'length', dm2.width AS 'width' 
            FROM ver_chronoforms_data_measurement_vic AS dm2 
            GROUP BY dm2.projectid 
        ) AS dm4 
            ON fu.projectid = dm4.projectid 
    WHERE (
        cp.clientid = '[ENTITY_NAME]' 
        OR 
        fu.projectid = '[ENTITY_NAME]' 
    )
    LIMIT 1;
";





$sql_template_retrieve_template_download_list = "
    SELECT 
        document_handler_entity.id AS 'entity_id', 
        document_handler_entity.name AS 'entity_name', 
        document_handler_folder.id AS 'folder_id', 
        document_handler_folder.name AS 'folder_name', 
        document_handler_file.id AS 'file_id', 
        document_handler_file.name AS 'file_name', 
        document_handler_file.external_ref_name AS 'file_external_ref_name', 
        document_handler_file.date_created AS 'file_date_created', 
        document_handler_file_versionX.id AS 'file_version_id', 
        document_handler_file_versionX.external_ref_name AS 'file_version_external_ref_name', 
        document_handler_file_versionX.date_created AS 'file_version_date_created', 
        document_handler_file_versionX.file_user_name AS 'file_version_user_name' 
    FROM document_handler_entity 
        LEFT JOIN document_handler_entity_folder 
            ON document_handler_entity.id = document_handler_entity_folder.entity_id 
        LEFT JOIN document_handler_folder 
            ON document_handler_entity_folder.folder_id = document_handler_folder.id 
        LEFT JOIN document_handler_folder_file 
            ON document_handler_folder.id = document_handler_folder_file.folder_id 
        LEFT JOIN document_handler_file 
            ON document_handler_folder_file.file_id = document_handler_file.id 
        LEFT JOIN ( 
            SELECT document_handler_file_version1.*, ver_users1.name AS file_user_name 
            FROM document_handler_file_version AS document_handler_file_version1 
                LEFT JOIN ( 
                    SELECT MAX(document_handler_file_version2.id) AS 'latest_id' 
                    FROM document_handler_file_version AS document_handler_file_version2 
                    GROUP BY document_handler_file_version2.file_id 
                ) AS document_handler_file_version3 
                    ON document_handler_file_version1.id = document_handler_file_version3.latest_id 
                LEFT JOIN ver_users ver_users1 
                    ON document_handler_file_version1.user_id = ver_users1.id 
            WHERE document_handler_file_version1.date_deleted IS NULL 
            AND document_handler_file_version3.latest_id IS NOT NULL 
        ) document_handler_file_versionX
            ON document_handler_file.id = document_handler_file_versionX.file_id 
    WHERE document_handler_entity.date_deleted IS NULL 
    AND document_handler_entity_folder.date_deleted IS NULL 
    AND document_handler_folder.date_deleted IS NULL 
    AND document_handler_folder_file.date_deleted IS NULL 
    AND document_handler_file.date_deleted IS NULL 
    AND document_handler_file_versionX.date_created IS NOT NULL 
    AND document_handler_entity.module = '[MODULE]' 
    AND document_handler_entity_folder.module = '[MODULE]' 
    AND document_handler_entity.name = '[ENTITY_NAME]' 
    AND document_handler_folder.name = '[FOLDER_NAME]' 
    AND document_handler_file.content_category = '[CONTENT_CATEGORY]' 
    AND document_handler_file.status = '[STATUS]' 
    GROUP BY document_handler_file.id 
    ORDER BY document_handler_entity.id, document_handler_folder.id, document_handler_file.id 
";




$sql_template_retrieve_template_file_version_list = "
    SELECT 
        document_handler_file_version.external_ref_name AS 'file_version_external_ref_name', 
        document_handler_file_version.date_created AS 'file_version_date_created', 
        ver_users.name AS 'file_version_user_name' 
    FROM document_handler_file 
        LEFT JOIN document_handler_file_version 
            ON document_handler_file.id = document_handler_file_version.file_id 
        LEFT JOIN ver_users 
            ON document_handler_file_version.user_id = ver_users.id 
    WHERE document_handler_file.id = '[FILE_ID]';
";



$sql_template_retrieve_entity_search_list = array();
$sql_template_retrieve_entity_search_list[] = "
    SELECT 
        'Contact' AS 'entity_source_display_name', 
        cp.clientid AS 'entity_id', 
        CONCAT(
            'Contact > ', cp.clientid, ' > ', 
            'Name: ', cp.client_firstname, ' ', cp.client_lastname, '; ', 
            'Address: ', cp.client_address1, ', ', cp.client_address2, ', ', cp.client_suburb, ', ', cp.client_state, ', ', cp.client_postcode, '; ', 
            'Phone: ', cp.client_mobile, '(mobile)', cp.client_hmphone, '(home), ', cp.client_wkphone, '(office); ', 
            'Email: ', cp.client_email, '; '
        ) AS 'entity_info', 
        cp.datelodged AS 'entity_date_created' 
    FROM ver_chronoforms_data_clientpersonal_vic AS cp 
    WHERE LOWER(cp.clientid) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(cp.client_firstname) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(cp.client_lastname) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(cp.client_address1) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(cp.client_address2) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(cp.client_suburb) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(cp.client_state) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(cp.client_postcode) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(cp.client_mobile) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(cp.client_hmphone) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(cp.client_wkphone) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(cp.client_email) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(cp.datelodged) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    GROUP BY cp.clientid 
    ORDER BY entity_source_display_name, entity_id 
    LIMIT 1000;
";
$sql_template_retrieve_entity_search_list[] = "
    SELECT 
        'Quote' AS 'entity_source_display_name', 
        dfu.quoteid AS 'entity_id', 
        CONCAT(
            'Quote > ', dfu.quoteid, ' > ', 
            'Prospect Name: ', cp2.client_firstname, ' ', cp2.client_lastname, '; ', 
            'Project Name: ', dfu.project_name, '; ', 
            'Framework: ', dfu.framework_type, '; ', 
            'Cost: ', dfu.total_rrp_gst, ' (', dfu.total_cost, '+', dfu.total_cost_gst, '); ', 
            'Sales Rep: ', dfu.sales_rep, '; '
        ) AS 'entity_info', 
        dfu.quotedate AS 'entity_date_created' 
    FROM ver_chronoforms_data_followup_vic AS dfu 
        LEFT JOIN ver_chronoforms_data_clientpersonal_vic cp2 
            ON dfu.quoteid = cp2.clientid 
    WHERE LOWER(dfu.quoteid) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(dfu.project_name) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(dfu.framework_type) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(dfu.sales_rep) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(dfu.quotedate) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    GROUP BY dfu.quoteid 
    ORDER BY entity_source_display_name, entity_id 
    LIMIT 1000;
";
$sql_template_retrieve_entity_search_list[] = "
    SELECT 
        'Contract' AS 'entity_source_display_name', 
        dcl.projectid AS 'entity_id', 
        CONCAT(
            'Contract > ', dcl.projectid, ' > ', 
            'Client Name: ', cp3.client_firstname, ' ', cp3.client_lastname, '; ', 
            'Project Name: ', dcl.project_name, '; ', 
            'Framework: ', dcl.framework_type, ', ', dcl.framework, '; ', 
            'Cost: ', dcl.total_rrp_gst, ' (', dcl.total_cost, '+', dcl.total_cost_gst, '); ', 
            'Sales Rep: ', dcl.sales_rep, '; '
        ) AS 'entity_info', 
        dcl.contractdate AS 'entity_date_created' 
    FROM ver_chronoforms_data_contract_list_vic AS dcl 
        LEFT JOIN ver_chronoforms_data_clientpersonal_vic cp3 
            ON dcl.quoteid = cp3.clientid 
    WHERE LOWER(dcl.projectid) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(dcl.project_name) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(dcl.framework_type) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(dcl.framework) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(dcl.sales_rep) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(dcl.contractdate) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    GROUP BY dcl.projectid 
    ORDER BY entity_source_display_name, entity_id 
    LIMIT 1000;
";




$sql_template_retrieve_contact_search_list = array();
$sql_template_retrieve_contact_search_list[] = "
    SELECT 
        'Contact' AS 'entity_source_display_name', 
        CONCAT(cp.client_firstname, ' ', cp.client_lastname, '(', cp.client_email, ')') AS 'entity_id', 
        CONCAT(
            'Contact > ', cp.clientid, ' > ', 
            'Name: ', cp.client_firstname, ' ', cp.client_lastname, '; ', 
            'Address: ', cp.client_address1, ', ', cp.client_address2, ', ', cp.client_suburb, ', ', cp.client_state, ', ', cp.client_postcode, '; ', 
            'Phone: ', cp.client_mobile, '(mobile)', cp.client_hmphone, '(home), ', cp.client_wkphone, '(office); ', 
            'Email: ', cp.client_email, '; '
        ) AS 'entity_info', 
        cp.datelodged AS 'entity_date_created' 
    FROM ver_chronoforms_data_clientpersonal_vic AS cp 
    WHERE LOWER(cp.clientid) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(cp.client_firstname) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(cp.client_lastname) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(cp.client_address1) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(cp.client_address2) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(cp.client_suburb) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(cp.client_state) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(cp.client_postcode) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(cp.client_mobile) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(cp.client_hmphone) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(cp.client_wkphone) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(cp.client_email) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(cp.datelodged) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    ORDER BY entity_source_display_name, entity_id 
    LIMIT 1000;
";
$sql_template_retrieve_contact_search_list[] = "
    SELECT 
        'Team' AS 'entity_source_display_name', 
        CONCAT(IFNULL(ver_users.first_name, ''), ' ', IFNULL(ver_users.last_name, ''), '(', ver_users.email, ')') AS 'entity_id', 
        CONCAT(
            'Team > ', IFNULL(ver_users.username, ''), ' > ', 
            'Name: ', IFNULL(ver_users.first_name, ''), ' ', IFNULL(ver_users.last_name, ''), '; ', 
            'Position: ', REPLACE(IFNULL(ver_usergroups.title, ''), 'Victoria', ''), '; ', 
            'Phone: ', IFNULL(ver_users.mobile, ''), '(mobile)', IFNULL(ver_users.phone, ''), '(home); ', 
            'Email: ', IFNULL(ver_users.email, ''), '; '
        ) AS 'entity_info', 
        ver_users.created_at AS 'entity_date_created' 
    FROM ver_users 
        LEFT JOIN ver_user_usergroup_map 
            ON ver_users.id = ver_user_usergroup_map.user_id 
        LEFT JOIN ver_usergroups 
            ON ver_user_usergroup_map.group_id = ver_usergroups.id 
    WHERE LOWER(ver_users.username) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(ver_users.first_name) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(ver_users.last_name) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(ver_usergroups.title) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(ver_users.mobile) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(ver_users.phone) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(ver_users.email) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    OR LOWER(ver_users.created_at) LIKE '%[ENTITY_SEARCH_KEYWORD]%' 
    ORDER BY entity_source_display_name, entity_id 
    LIMIT 1000;
";





/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- update ???  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_update_document_handler_entity = "
    UPDATE document_handler_entity SET  
        name = '[ENTITY_NAME]', 
        description = '[ENTITY_DESCRIPTION]', 
        summary = '[ENTITY_SUMMARY]', 
        user_id = '[USER_ID]', 
        group_id = '[GROUP_ID]', 
        date_modified = NOW() 
    WHERE id = '[ENTITY_ID]';
";




$sql_template_update_document_handler_folder = "
    UPDATE document_handler_folder SET  
        name = '[FOLDER_NAME]', 
        description = '[FOLDER_DESCRIPTION]', 
        summary = '[FOLDER_SUMMARY]', 
        user_id = '[USER_ID]', 
        group_id = '[GROUP_ID]', 
        date_modified = NOW() 
    WHERE id = '[FOLDER_ID]';
";




$sql_template_update_document_handler_file = "
    UPDATE document_handler_file SET  
        name = '[FILE_NAME]', 
        description = '[FILE_DESCRIPTION]', 
        summary = '[FILE_SUMMARY]', 
        `from` = '[FILE_FROM]', 
        date_received = '[FILE_DATE_RECEIVED]', 
        `to` = '[FILE_TO]', 
        date_sent = '[FILE_DATE_SENT]', 
        content_date = '[FILE_CONTENT_DATE]', 
        content_category = '[FILE_CONTENT_CATEGORY]',  
        original_name = '[FILE_ORIGINAL_NAME]', 
        extension = '[FILE_EXTENSION]', 
        type = '[FILE_TYPE]', 
        size = '[FILE_SIZE]', 
        external_ref_name = '[EXTERNAL_REF_NAME]', 
        status = '[FILE_STATUS]', 
        user_id = '[USER_ID]', 
        group_id = '[GROUP_ID]', 
        date_modified = NOW() 
    WHERE id = '[FILE_ID]';
";








/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- delete ???  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_delete_document_handler_entity_folder = "
    DELETE FROM document_handler_entity_folder 
    WHERE folder_id = '[FOLDER_ID]';
";

$sql_template_delete_document_handler_folder_file = "
    DELETE FROM document_handler_folder_file 
    WHERE file_id = '[FILE_ID]';
";

$sql_template_delete_document_handler_entity_folder_file = "
    DELETE FROM document_handler_entity_folder_file 
    WHERE file_id = '[FILE_ID]';
";





$sql_template_delete_document_handler_entity_folder_records = "
    DELETE FROM document_handler_entity_folder 
    WHERE entity_id = '[ENTITY_ID]';
";

$sql_template_delete_document_handler_entity_folder_records_2 = "
    DELETE FROM document_handler_entity_folder 
    WHERE folder_id = '[FOLDER_ID]';
";

$sql_template_delete_document_handler_folder_record = "
    DELETE FROM document_handler_folder 
    WHERE id = '[FOLDER_ID]';
";

$sql_template_delete_document_handler_entity_record = "
    DELETE FROM document_handler_entity 
    WHERE id = '[ENTITY_ID]';
";

$sql_template_delete_document_handler_folder_file_records = "
    DELETE FROM document_handler_folder_file 
    WHERE folder_id = '[FOLDER_ID]';
";

$sql_template_delete_document_handler_file_record = "
    DELETE FROM document_handler_file 
    WHERE id = '[FILE_ID]';
";

$sql_template_delete_document_handler_folder_file_records_2 = "
    DELETE FROM document_handler_folder_file 
    WHERE file_id = '[FILE_ID]';
";

$sql_template_delete_document_handler_file_version = "
    DELETE FROM document_handler_file_version 
    WHERE file_id = '[FILE_ID]';
";
?>