<script>
    var document_handler_form_entity_list = <?php echo $document_handler_form_entity_list; ?>;

    var document_handler_form_entity_data_entry = {
        "document_handler_form_entity_id":"",
        "document_handler_form_entity_name":"",
        "document_handler_form_entity_description":"",
        "document_handler_form_entity_summary":""
    };

    var document_handler_form_folder_data_entry = {
        "document_handler_form_folder_id":"",
        "document_handler_form_folder_name":"",
        "document_handler_form_folder_description":"",
        "document_handler_form_folder_summary":"",
        "document_handler_form_folder_entity_links":[]
    };

    var document_handler_form_file_data_entry = {
        "document_handler_form_file_id":"",
        "document_handler_form_file_name":"",
        "document_handler_form_file_description":"",
        "document_handler_form_file_summary":"",
        "document_handler_form_file_from":"",
        "document_handler_form_file_date_received":"",
        "document_handler_form_file_to":"",
        "document_handler_form_file_date_sent":"",
        "document_handler_form_file_content_date":"",
        "document_handler_form_file_content_category":"",
        "document_handler_form_file_original_name":"",
        "document_handler_form_file_extension":"",
        "document_handler_form_file_type":"",
        "document_handler_form_file_size":"",
        "document_handler_form_file_external_ref_name":"",
        "document_handler_form_file_folder_links":[]
    };

    var login_user_info = <?php echo $login_user_info_in_json; ?>;

    var document_handler_form_system_info = <?php echo $document_handler_form_system_info_in_json; ?>;

    var document_handler_form_entity_folder_list = [];

    var document_handler_form_folder_file_list = [];

    var document_handler_form_entity_search_list = [];
    var document_handler_form_entity_search_keyword = '';

    var document_handler_form_contact_from_search_list = [];
    var document_handler_form_contact_from_search_keyword = '';

    var document_handler_form_contact_to_search_list = [];
    var document_handler_form_contact_to_search_keyword = '';

    var default_entity_id = '<?php echo $default_entity_id; ?>';
    var default_folder_id = '<?php echo $default_folder_id; ?>';
    var default_file_id = '<?php echo $default_file_id; ?>';
    var default_content_category = '<?php echo $default_content_category; ?>';

    var debug_mode_enabled = '<?php echo $debug_mode_enabled; ?>';

    var document_handler_form_current_search_target = '';
    var document_handler_form_current_entity_search_attach_list = [];
    var document_handler_form_current_contact_from_search_attach_list = [];
    var document_handler_form_current_contact_to_search_attach_list = [];

    var document_handler_form_current_date_time_selection_target = '';
</script>
