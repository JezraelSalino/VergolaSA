<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>document handler</title>
        <meta charset="UTF-8">
        <script src="<?php echo $config['path']['base_url'] . 'jscript/document_handler/functions_general_ajax_call.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo $config['path']['base_url'] . 'jscript/document_handler/functions_general.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo $config['path']['base_url'] . 'jscript/document_handler/functions_module_document_handler_date_time_selection.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo $config['path']['base_url'] . 'jscript/document_handler/functions_module_document_handler_search.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo $config['path']['base_url'] . 'jscript/document_handler/functions_module_document_handler_crud.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo $config['path']['base_url'] . 'jscript/document_handler/functions_module_document_handler_file.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo $config['path']['base_url'] . 'jscript/document_handler/functions_module_document_handler_folder.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo $config['path']['base_url'] . 'jscript/document_handler/functions_module_document_handler_entity.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo $config['path']['base_url'] . 'jscript/document_handler/functions_module_document_handler.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo $config['path']['base_url'] . 'jscript/document_handler/functions_module_document_handler_custom.js'; ?>" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo $config['path']['base_url'] . 'jscript/document_handler/style_form_document_handler.css'; ?>" />

        <?php
        include 'client_config_general.php';
        include 'client_config_module_document_handler.php';
        ?>
    </head>
    <body onload="initProgram()" onresize="adaptContainerDimensionAsCurrentWindow('document_handler_form_container_area')">
        <div id="document_handler_form_container_area" class="document_handler_form_container_area_1">
            <div id="document_handler_form_entity_area" class="document_handler_form_entity_area_1">
                <table class="document_handler_form_table_1">
                    <tr>
                        <td colspan="2" class="document_handler_form_title_1" id="document_handler_form_entity_area_main_title">SECTIONS</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="document_handler_form_row_separator_1">&nbsp;</td>
                    </tr>
                    <!--
                    /* original document_handler_form_entity_list location */
                    -->
                    <tr>
                        <td colspan="2" class="document_handler_form_row_separator_1">&nbsp;</td>
                    </tr>
                    <tr id="document_handler_form_entity_area_properties_title_row">
                        <td colspan="2" class="document_handler_form_title_2">PROPERTIES</td>
                    </tr>
                    <tr id="document_handler_form_entity_name_row">
                        <td class="document_handler_form_field_name_1">Name: </td>
                        <td class="document_handler_form_field_name_1">
                            <input type="hidden" id="document_handler_form_entity_id" name="document_handler_form_entity_id" value="" />
                            <input type="text" class="document_handler_form_textbox_1" id="document_handler_form_entity_name" name="document_handler_form_entity_name" value="" />
                        </td>
                    </tr>
                    <tr id="document_handler_form_entity_description_row">
                        <td class="document_handler_form_field_name_1">Description: </td>
                        <td class="document_handler_form_field_name_1">
                            <input type="text" class="document_handler_form_textbox_1" id="document_handler_form_entity_description" name="document_handler_form_entity_description" value="" />
                        </td>
                    </tr>
                    <tr id="document_handler_form_entity_summary_row">
                        <td class="document_handler_form_field_name_1">Summary: </td>
                        <td class="document_handler_form_field_name_1">
                            <textarea class="document_handler_form_textarea_1" id="document_handler_form_entity_summary" name="document_handler_form_entity_summary"></textarea>
                        </td>
                    </tr>
                    <tr id="document_handler_form_entity_date_created_row">
                        <td class="document_handler_form_field_name_1">Date Created: </td>
                        <td class="document_handler_form_field_name_1">
                            <input type="text" class="document_handler_form_textbox_1" id="document_handler_form_entity_date_created" name="document_handler_form_entity_date_created" value="" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="document_handler_form_row_separator_1">&nbsp;</td>
                    </tr>
                    <tr id="document_handler_form_entity_area_button_row">
                        <td colspan="2" class="document_handler_form_field_name_1">
                            <input type="button" class="document_handler_form_button_1" id="document_handler_form_entity_button_new" name="document_handler_form_entity_button_new" value="New" onclick="clearEntityPropertiesToFields()" />
                            <input type="button" class="document_handler_form_button_1" id="document_handler_form_entity_button_save" name="document_handler_form_entity_button_save" value="Save" onclick="saveDocumentHandlerFormEntityDataEntry()" />
                            <input type="button" class="document_handler_form_button_1" id="document_handler_form_entity_button_refresh" name="document_handler_form_entity_button_refresh" value="Refresh" onclick="refreshEntityPropertiesToFields()" />
                            <input type="button" class="document_handler_form_button_1" id="document_handler_form_entity_button_delete" name="document_handler_form_entity_button_delete" value="Delete" onclick="deleteDocumentHandlerFormEntityDataEntry()" />
                        </td>
                    </tr>
                </table>
            </div>
            <div id="document_handler_form_folder_area" class="document_handler_form_folder_area_1">
                <table class="document_handler_form_table_1">
                    <tr>
                        <td colspan="2" class="document_handler_form_title_1" id="document_handler_form_folder_area_main_title">CATEGORIES</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="document_handler_form_row_separator_1">&nbsp;</td>
                    </tr>
                    <!--
                    /* original document_handler_form_entity_folder_list location */
                    -->
                    <tr>
                        <td colspan="2" class="document_handler_form_row_separator_1">&nbsp;</td>
                    </tr>
                    <tr id="document_handler_form_folder_area_properties_title_row">
                        <td colspan="2" class="document_handler_form_title_2">PROPERTIES</td>
                    </tr>
                    <tr id="document_handler_form_folder_name_row">
                        <td class="document_handler_form_field_name_1">Name: </td>
                        <td class="document_handler_form_field_name_1">
                            <input type="hidden" id="document_handler_form_folder_id" name="document_handler_form_folder_id" value="" />
                            <input type="text" class="document_handler_form_textbox_1" id="document_handler_form_folder_name" name="document_handler_form_folder_name" value="" />
                        </td>
                    </tr>
                    <tr id="document_handler_form_folder_description_row">
                        <td class="document_handler_form_field_name_1">Description: </td>
                        <td class="document_handler_form_field_name_1">
                            <input type="text" class="document_handler_form_textbox_1" id="document_handler_form_folder_description" name="document_handler_form_folder_description" value="" />
                        </td>
                    </tr>
                    <tr id="document_handler_form_folder_summary_row">
                        <td class="document_handler_form_field_name_1">Summary: </td>
                        <td class="document_handler_form_field_name_1">
                            <textarea class="document_handler_form_textarea_1" id="document_handler_form_folder_summary" name="document_handler_form_folder_summary"></textarea>
                        </td>
                    </tr>
                    <tr id="document_handler_form_folder_entity_divselectbox_row">
                        <td class="document_handler_form_field_name_1">Linked to Section(s): </td>
                        <td class="document_handler_form_field_name_1">
                            <div class="document_handler_form_divselect_1" id="document_handler_form_folder_entity_divselectbox">
                            </div>
                            <input type="hidden" id="document_handler_form_folder_entity_link_count" name="document_handler_form_folder_entity_link_count" value="0" />
                         </td>
                    </tr>
                    <tr id="document_handler_form_folder_date_created_row">
                        <td class="document_handler_form_field_name_1">Date Created: </td>
                        <td class="document_handler_form_field_name_1">
                            <input type="text" class="document_handler_form_textbox_1" id="document_handler_form_folder_date_created" name="document_handler_form_folder_date_created" value="" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="document_handler_form_row_separator_1">&nbsp;</td>
                    </tr>
                    <tr id="document_handler_form_folder_area_button_row">
                        <td colspan="2" class="document_handler_form_field_name_1">
                            <input type="button" class="document_handler_form_button_1" id="document_handler_form_folder_button_new" name="document_handler_form_folder_button_new" value="New" onclick="clearEntityFolderPropertiesToFields()" />
                            <input type="button" class="document_handler_form_button_1" id="document_handler_form_folder_button_save" name="document_handler_form_folder_button_save" value="Save" onclick="saveDocumentHandlerFormFolderDataEntry()" />
                            <input type="button" class="document_handler_form_button_1" id="document_handler_form_folder_button_refresh" name="document_handler_form_folder_button_refresh" value="Refresh" onclick="refreshEntityFolderPropertiesToFields()" />
                            <input type="button" class="document_handler_form_button_1" id="document_handler_form_folder_button_delete" name="document_handler_form_folder_button_delete" value="Delete" onclick="deleteDocumentHandlerFormFolderDataEntry()" />
                        </td>
                    </tr>
                </table>
            </div>
            <div id="document_handler_form_file_area" class="document_handler_form_file_area_1">
                <table class="document_handler_form_table_1">
                    <tr>
                        <td colspan="3" class="document_handler_form_title_1" id="document_handler_form_file_area_main_title">TEMPLATES</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="document_handler_form_row_separator_1" id="document_handler_form_file_area_main_title_separator">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="document_handler_form_row_separator_1">&nbsp;</td>
                    </tr>


                    <!-- entity selection -->
                    <tr id="document_handler_form_entity_list_row">
                        <td class="document_handler_form_field_name_1">Sections: </td>
                        <td class="document_handler_form_field_name_1">
                            <select class="document_handler_form_selectbox_1" id="document_handler_form_entity_list" name="document_handler_form_entity_list" onchange="processEntitySelectionChange()">
                            </select >
                        </td>
                        <td class="document_handler_form_field_name_2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="document_handler_form_row_separator_1" id="document_handler_form_file_area_entity_list_separator">&nbsp;</td>
                    </tr>


                    <!-- folder selection -->
                    <tr id="document_handler_form_folder_list_row">
                        <td class="document_handler_form_field_name_1">Categories: </td>
                        <td class="document_handler_form_field_name_1">
                            <select class="document_handler_form_selectbox_1" id="document_handler_form_entity_folder_list" name="document_handler_form_entity_folder_list" onchange="processEntityFolderSelectionChange()">
                            </select >
                        </td>
                        <td class="document_handler_form_field_name_2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="document_handler_form_row_separator_1" id="document_handler_form_file_area_folder_list_separator">&nbsp;</td>
                    </tr>


                    <!-- template selection -->
                    <tr id="document_handler_form_file_list_row">
                        <td class="document_handler_form_field_name_1">Templates: </td>
                        <td class="document_handler_form_field_name_1">
                            <select multiple size="10" class="document_handler_form_selectbox_1" id="document_handler_form_folder_file_list" name="document_handler_form_folder_file_list" onchange="processEntityFileSelectionChange()">
                            </select >
                        </td>
                        <td class="document_handler_form_field_name_2">&nbsp;</td>
                    </tr>
                    <tr id="document_handler_form_file_area_properties_title_separator_row">
                        <td colspan="3" class="document_handler_form_row_separator_1">&nbsp;</td>
                    </tr>
                    <tr id="document_handler_form_file_area_properties_title_row">
                        <td colspan="3" class="document_handler_form_title_2">PROPERTIES</td>
                    </tr>
                    <tr id="document_handler_form_file_attach_to_row">
                        <td class="document_handler_form_field_name_1">Attach to: </td>
                        <td class="document_handler_form_field_name_1">
                            <div class="document_handler_form_divselect_1" id="document_handler_form_entity_attach_divselectbox">
                            </div>
                            <input type="hidden" id="document_handler_form_entity_attach_link_count" name="document_handler_form_entity_attach_link_count" value="0" />
                         </td>
                        <td class="document_handler_form_field_name_2">
                            <input type="button" class="document_handler_form_button_2" id="document_handler_form_file_button_entity_search" name="document_handler_form_file_button_entity_search" value="Search" onclick="initInputElementsFormEntitySearch('entity_search')" />
                            <br />
                            <input type="button" class="document_handler_form_button_2" id="document_handler_form_file_button_entity_remove" name="document_handler_form_file_button_entity_remove" value="Remove" onclick="removeCurrentEntitySearchAttachItems()" />
                        </td>
                    </tr>
                    <!--                     
                    <tr>
                        <td colspan="3" class="document_handler_form_row_separator_1">&nbsp;</td>
                    </tr>
                    -->
                    <tr id="document_handler_form_document_category_list_row">
                        <td class="document_handler_form_field_name_1">Document Category: </td>
                        <td class="document_handler_form_field_name_1">
                            <select class="document_handler_form_selectbox_2" id="document_handler_form_document_category" name="document_handler_form_document_category" onchange="">
                            </select >
                        </td>
                        <td class="document_handler_form_field_name_2">&nbsp;</td>
                    </tr>
                    <!--                     
                    <tr>
                        <td colspan="3" class="document_handler_form_row_separator_1">&nbsp;</td>
                    </tr>
                    -->
                    <tr id="document_handler_form_file_upload_row">
                        <td class="document_handler_form_field_name_1">File Upload: </td>
                        <td class="document_handler_form_field_name_1">
                            <input type="file" class="document_handler_form_textbox_1" id="document_handler_form_file_info" name="document_handler_form_file_info" value="" onchange="uploadDocumentHandlerFormFileDataEntry()" />
                            <input type="hidden" id="document_handler_form_file_id" name="document_handler_form_file_id" value="" />
                            <input type="hidden" id="document_handler_form_file_original_name" name="document_handler_form_file_original_name" value="" />
                            <input type="hidden" id="document_handler_form_file_extension" name="document_handler_form_file_extension" value="" />
                            <input type="hidden" id="document_handler_form_file_type" name="document_handler_form_file_type" value="" />
                            <input type="hidden" id="document_handler_form_file_size" name="document_handler_form_file_size" value="" />
                            <input type="hidden" id="document_handler_form_file_external_ref_name" name="document_handler_form_file_external_ref_name" value="" />
                            <input type="hidden" id="document_handler_form_current_entity_name" name="document_handler_form_current_entity_name" value="" />
                            <input type="hidden" id="document_handler_form_current_entity_id" name="document_handler_form_current_entity_id" value="" />
                            <input type="hidden" id="document_handler_form_current_folder_name" name="document_handler_form_current_folder_name" value="" />
                            <input type="hidden" id="document_handler_form_current_folder_id" name="document_handler_form_current_folder_id" value="" />
                            <input type="hidden" id="document_handler_form_new_entity_name" name="document_handler_form_new_entity_name" value="" />
                            <input type="hidden" id="document_handler_form_new_entity_id" name="document_handler_form_new_entity_id" value="" />
                            <input type="hidden" id="document_handler_form_new_folder_name" name="document_handler_form_new_folder_name" value="" />
                            <input type="hidden" id="document_handler_form_new_folder_id" name="document_handler_form_new_folder_id" value="" />
                        </td>
                        <td class="document_handler_form_field_name_2">&nbsp;</td>
                    </tr>
                    <tr id="document_handler_form_file_name_row">
                        <td class="document_handler_form_field_name_1">Name: </td>
                        <td class="document_handler_form_field_name_1">
                            <input type="text" class="document_handler_form_textbox_1" id="document_handler_form_file_name" name="document_handler_form_file_name" value="" />
                        </td>
                        <td class="document_handler_form_field_name_2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="document_handler_form_row_separator_1">&nbsp;</td>
                    </tr>
                    <tr id="document_handler_form_file_description_row">
                        <td class="document_handler_form_field_name_1">Description: </td>
                        <td class="document_handler_form_field_name_1">
                            <input type="text" class="document_handler_form_textbox_1" id="document_handler_form_file_description" name="document_handler_form_file_description" value="" />
                        </td>
                        <td class="document_handler_form_field_name_2">&nbsp;</td>
                    </tr>
                    <tr id="document_handler_form_file_summary_row">
                        <td class="document_handler_form_field_name_1">Summary: </td>
                        <td class="document_handler_form_field_name_1">
                            <textarea class="document_handler_form_textarea_1" id="document_handler_form_file_summary" name="document_handler_form_file_summary"></textarea>
                        </td>
                        <td class="document_handler_form_field_name_2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="document_handler_form_row_separator_1">&nbsp;</td>
                    </tr>

                    <tr id="document_handler_form_file_from_row">
                        <td class="document_handler_form_field_name_1">From: </td>
                        <td class="document_handler_form_field_name_1">
                            <input type="text" class="document_handler_form_textbox_1" id="document_handler_form_file_from" name="document_handler_form_file_from" value="" />
                        </td>
                        <td class="document_handler_form_field_name_2">
                            <input type="button" class="document_handler_form_button_2" id="document_handler_form_file_button_entity_search" name="document_handler_form_file_button_entity_search" value="Search" onclick="initInputElementsFormEntitySearch('contact_from_search')" />
                        </td>
                    </tr>
                    <tr id="document_handler_form_file_date_received_row">
                        <td class="document_handler_form_field_name_1">Date Received: </td>
                        <td class="document_handler_form_field_name_1">
                            <input type="text" class="document_handler_form_textbox_1" id="document_handler_form_file_date_received" name="document_handler_form_file_date_received" value="" />
                        </td>
                        <td class="document_handler_form_field_name_2">
                            <input type="button" class="document_handler_form_button_2" id="document_handler_form_file_button_date_time_selection" name="document_handler_form_file_button_date_time_selection" value="Select" onclick="initInputElementsFormDateTimeSelection('contact_date_received')" />
                        </td>
                    </tr>
                    <!--                     
                    <tr>
                        <td colspan="3" class="document_handler_form_row_separator_1">&nbsp;</td>
                    </tr>
                    -->

                    <tr id="document_handler_form_file_to_row">
                        <td class="document_handler_form_field_name_1">To: </td>
                        <td class="document_handler_form_field_name_1">
                            <input type="text" class="document_handler_form_textbox_1" id="document_handler_form_file_to" name="document_handler_form_file_to" value="" />
                        </td>
                        <td class="document_handler_form_field_name_2">
                            <input type="button" class="document_handler_form_button_2" id="document_handler_form_file_button_entity_search" name="document_handler_form_file_button_entity_search" value="Search" onclick="initInputElementsFormEntitySearch('contact_to_search')" />
                        </td>
                    </tr>
                    <tr id="document_handler_form_file_date_sent_row">
                        <td class="document_handler_form_field_name_1">Date Sent: </td>
                        <td class="document_handler_form_field_name_1">
                            <input type="text" class="document_handler_form_textbox_1" id="document_handler_form_file_date_sent" name="document_handler_form_file_date_sent" value="" />
                        </td>
                        <td class="document_handler_form_field_name_2">
                            <input type="button" class="document_handler_form_button_2" id="document_handler_form_file_button_date_time_selection" name="document_handler_form_file_button_date_time_selection" value="Select" onclick="initInputElementsFormDateTimeSelection('contact_date_sent')" />
                        </td>
                    </tr>
                    <!--                     
                    <tr>
                        <td colspan="3" class="document_handler_form_row_separator_1">&nbsp;</td>
                    </tr>
                    -->

                    <tr id="document_handler_form_file_content_date_row">
                        <td class="document_handler_form_field_name_1">Content Date: </td>
                        <td class="document_handler_form_field_name_1">
                            <input type="text" class="document_handler_form_textbox_1" id="document_handler_form_file_content_date" name="document_handler_form_file_content_date" value="" />
                        </td>
                        <td class="document_handler_form_field_name_2">
                            <input type="button" class="document_handler_form_button_2" id="document_handler_form_file_button_date_time_selection" name="document_handler_form_file_button_date_time_selection" value="Select" onclick="initInputElementsFormDateTimeSelection('contact_content_date')" />
                        </td>
                    </tr>
                    <tr id="document_handler_form_file_content_category_row">
                        <td class="document_handler_form_field_name_1">Content Category: </td>
                        <td class="document_handler_form_field_name_1">
                            <select class="document_handler_form_selectbox_2" id="document_handler_form_file_content_category" name="document_handler_form_file_content_category" onchange="">
                            </select >
                        </td>
                        <td class="document_handler_form_field_name_2">&nbsp;</td>
                    </tr>
                    <tr id="document_handler_form_file_folder_divselectbox_row">
                        <td class="document_handler_form_field_name_1">Linked to Category(s): </td>
                        <td class="document_handler_form_field_name_1">
                            <div class="document_handler_form_divselect_1" id="document_handler_form_file_folder_divselectbox">
                            </div>
                            <input type="hidden" id="document_handler_form_file_folder_link_count" name="document_handler_form_file_folder_link_count" value="0" />
                         </td>
                        <td class="document_handler_form_field_name_2">&nbsp;</td>
                    </tr>
                    <!--                     
                    <tr>
                        <td colspan="3" class="document_handler_form_row_separator_1">&nbsp;</td>
                    </tr>
                    -->

                    <tr id="document_handler_form_file_content_category_row">
                        <td class="document_handler_form_field_name_1">Status: </td>
                        <td class="document_handler_form_field_name_1">
                            <select class="document_handler_form_selectbox_2" id="document_handler_form_file_status" name="document_handler_form_file_status" onchange="">
                            </select >
                        </td>
                        <td class="document_handler_form_field_name_2">&nbsp;</td>
                    </tr>
                    <!--                     
                    <tr>
                        <td colspan="3" class="document_handler_form_row_separator_1">&nbsp;</td>
                    </tr>
                    -->

                    <tr id="document_handler_form_file_date_created_row">
                        <td class="document_handler_form_field_name_1">Date Created: </td>
                        <td class="document_handler_form_field_name_1">
                            <input type="text" class="document_handler_form_textbox_1" id="document_handler_form_file_date_created" name="document_handler_form_file_date_created" value="" />
                        </td>
                        <td class="document_handler_form_field_name_2">&nbsp;</td>
                    </tr>
                    <tr id="document_handler_form_file_version_list_row">
                        <td class="document_handler_form_field_name_1">File Version(s): </td>
                        <td class="document_handler_form_field_name_1">
                            <select class="document_handler_form_selectbox_2" id="document_handler_form_file_version_list" name="document_handler_form_file_version_list" onchange="">
                            </select >
                        </td>
                        <td class="document_handler_form_field_name_2">&nbsp;</td>
                    </tr>
                    <tr id="document_handler_form_record_activity_list_row">
                        <td class="document_handler_form_field_name_1">Record Activity(s): </td>
                        <td class="document_handler_form_field_name_1">
                            <select class="document_handler_form_selectbox_2" id="document_handler_form_record_activity_list" name="document_handler_form_record_activity_list" onchange="">
                            </select >
                        </td>
                        <td class="document_handler_form_field_name_2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="document_handler_form_row_separator_1">&nbsp;</td>
                    </tr>

                    <tr>
                        <td colspan="3" class="document_handler_form_field_name_1">
                            <input type="button" class="document_handler_form_button_2" id="document_handler_form_file_button_new" name="document_handler_form_file_button_new" value="New" onclick="clearFolderFilePropertiesToFields()" />
                            <input type="button" class="document_handler_form_button_2" id="document_handler_form_file_button_save" name="document_handler_form_file_button_save" value="Save" onclick="saveDocumentHandlerFormFileDataEntry()" />
                            <input type="button" class="document_handler_form_button_2" id="document_handler_form_file_button_refresh" name="document_handler_form_file_button_refresh" value="Refresh" onclick="refreshEntityFilePropertiesToFields()" />
                            <input type="button" class="document_handler_form_button_2" id="document_handler_form_file_button_download_file" name="document_handler_form_file_button_download_file" value="Edit" onclick="downloadDocumentHandlerFormFile('dl')" />
                            <!-- <input type="button" class="document_handler_form_button_2" id="document_handler_form_file_button_download_file" name="document_handler_form_file_button_download_file" value="Preview with Data Merge" onclick="downloadDocumentHandlerFormFile('dl_dm')" /> -->
                            <input type="button" class="document_handler_form_button_2" id="document_handler_form_file_button_delete" name="document_handler_form_file_button_delete" value="Delete" onclick="deleteDocumentHandlerFormFileDataEntry()" />
                            <input type="button" class="document_handler_form_button_2" id="document_handler_form_file_button_close" name="document_handler_form_file_button_close" value="Close" onclick="closeDocumentHandlerForm()" />
                            <br />
                            <input type="button" class="document_handler_form_button_2" id="document_handler_form_file_button_download_msword_plugin" name="document_handler_form_file_button_download_msword_plugin" value="Download MS-Word Add-in" onclick="downloadDocumentHandlerFormMsWordPlugin()" />
                            <!-- <input type="button" class="document_handler_form_button_2" id="document_handler_form_file_button_download_msoutlook_plugin" name="document_handler_form_file_button_download_msoutlook_plugin" value="Download MS-Outlook Add-in" onclick="downloadDocumentHandlerFormMsOutlookPlugin()" /> -->
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div id="document_handler_form_entity_search_area" class="document_handler_form_entity_search_area_1">
            <table class="document_handler_form_table_2">
                <tr>
                    <td colspan="2" class="document_handler_form_title_1" id="document_handler_form_entity_search_area_main_title">SEARCH</td>
                </tr>
                <tr>
                    <td colspan="2" class="document_handler_form_row_separator_1">&nbsp;</td>
                </tr>
                <tr id="document_handler_form_entity_search_keyword_row">
                    <td class="document_handler_form_field_name_1">Keyword: </td>
                </tr>
                <tr id="document_handler_form_entity_search_keyword_row">
                    <td class="document_handler_form_field_name_1">
                        <input type="text" class="document_handler_form_textbox_2" id="document_handler_form_entity_search_keyword" name="document_handler_form_entity_search_keyword" value="" />
                        <input type="button" class="document_handler_form_button_2" id="document_handler_form_entity_search_button_search" name="document_handler_form_entity_search_button_search" value="Go" onclick="processEntitySearch()" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="document_handler_form_row_separator_1">&nbsp;</td>
                </tr>
                <tr id="document_handler_form_entity_search_divselectbox_row">
                    <td class="document_handler_form_field_name_1">Result: <span id="document_handler_form_entity_search_total_result"></span></td>
                </tr>
                <tr id="document_handler_form_entity_search_divselectbox_row">
                    <td class="document_handler_form_field_name_1">
                        <div class="document_handler_form_divselect_2" id="document_handler_form_entity_search_divselectbox">
                        </div>
                        <input type="hidden" id="document_handler_form_entity_search_link_count" name="document_handler_form_entity_search_link_count" value="0" />
                     </td>
                </tr>
                <tr>
                    <td colspan="2" class="document_handler_form_row_separator_1">&nbsp;</td>
                </tr>
                <tr id="document_handler_form_entity_search_area_button_row">
                    <td colspan="2" class="document_handler_form_field_name_1">
                        <input type="button" class="document_handler_form_button_2" id="document_handler_form_entity_search_button_close" name="document_handler_form_entity_search_button_close" value="Done" onclick="closeEntitySearchForm()" />
                    </td>
                </tr>
            </table>
        </div>

        <div id="document_handler_form_date_time_selection_area" class="document_handler_form_date_time_selection_area_1">
            <table class="document_handler_form_table_2">
                <tr>
                    <td colspan="2" class="document_handler_form_title_1" id="document_handler_form_date_time_selection_area_main_title">DATE/TIME</td>
                </tr>
                <tr>
                    <td colspan="2" class="document_handler_form_row_separator_1">&nbsp;</td>
                </tr>
                <tr id="document_handler_form_date_time_selection_date_row">
                    <td class="document_handler_form_field_name_1">Date: </td>
                </tr>
                <tr id="document_handler_form_date_time_selection_date_row">
                    <td class="document_handler_form_field_name_1">
                        <table class="">
                            <tr>
                                <td class="" id="">
                                    <select class="" id="document_handler_form_date_time_selection_year" name="document_handler_form_date_time_selection_year" onchange="">
                                        <option value="2019">2019</option>
                                    </select >
                                </td>
                                <td class="" id="">&nbsp;-&nbsp;</td>
                                <td class="" id="">
                                    <select class="" id="document_handler_form_date_time_selection_month" name="document_handler_form_date_time_selection_month" onchange="">
                                        <option value="3">March</option>
                                    </select >
                                </td>
                                <td class="" id="">&nbsp;-&nbsp;</td>
                                <td class="" id="">
                                    <select class="" id="document_handler_form_date_time_selection_day" name="document_handler_form_date_time_selection_day" onchange="">
                                        <option value="13">13</option>
                                    </select >
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="document_handler_form_row_separator_1">&nbsp;</td>
                </tr>
                <tr id="document_handler_form_date_time_selection_time_row">
                    <td class="document_handler_form_field_name_1">Time: </td>
                </tr>
                <tr id="document_handler_form_date_time_selection_time_row">
                    <td class="document_handler_form_field_name_1">
                        <table class="">
                            <tr>
                                <td class="" id="">
                                    <select class="" id="document_handler_form_date_time_selection_hour" name="document_handler_form_date_time_selection_hour" onchange="">
                                        <option value="22">22</option>
                                    </select >
                                </td>
                                <td class="" id="">&nbsp;:&nbsp;</td>
                                <td class="" id="">
                                    <select class="" id="document_handler_form_date_time_selection_minute" name="document_handler_form_date_time_selection_minute" onchange="">
                                        <option value="10">10</option>
                                    </select >
                                </td>
                                <td class="" id="">&nbsp;:&nbsp;</td>
                                <td class="" id="">
                                    <select class="" id="document_handler_form_date_time_selection_second" name="document_handler_form_date_time_selection_second" onchange="">
                                        <option value="10">10</option>
                                    </select >
                                </td>
                            </tr>
                        </table>
                     </td>
                </tr>
                <tr>
                    <td colspan="2" class="document_handler_form_row_separator_1">&nbsp;</td>
                </tr>
                <tr id="document_handler_form_date_time_selection_area_button_row">
                    <td colspan="2" class="document_handler_form_field_name_1">
                        <input type="button" class="document_handler_form_button_2" id="document_handler_form_date_time_selection_button_close" name="document_handler_form_date_time_selection_button_close" value="Done" onclick="closeDateTimeSelectionForm()" />
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>
