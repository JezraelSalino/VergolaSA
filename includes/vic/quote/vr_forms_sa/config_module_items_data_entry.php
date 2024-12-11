<script>
        var vr_item_config_list = {
            "VR0":<?php echo getResultsetInJson(str_replace(array('[VR_TYPE_REF_NAME]'), array('VR0'), $sql_template_retrieve_vr_form_items_config_list)); ?>, 
            "VR1":<?php echo getResultsetInJson(str_replace(array('[VR_TYPE_REF_NAME]'), array('VR1'), $sql_template_retrieve_vr_form_items_config_list)); ?>, 
            "VR2":<?php echo getResultsetInJson(str_replace(array('[VR_TYPE_REF_NAME]'), array('VR2'), $sql_template_retrieve_vr_form_items_config_list)); ?>, 
            "VR3":<?php echo getResultsetInJson(str_replace(array('[VR_TYPE_REF_NAME]'), array('VR3'), $sql_template_retrieve_vr_form_items_config_list)); ?>, 
            "VR3G":<?php echo getResultsetInJson(str_replace(array('[VR_TYPE_REF_NAME]'), array('VR3G'), $sql_template_retrieve_vr_form_items_config_list)); ?>, 
            "VR4":<?php echo getResultsetInJson(str_replace(array('[VR_TYPE_REF_NAME]'), array('VR4'), $sql_template_retrieve_vr_form_items_config_list)); ?>, 
            "VR5":<?php echo getResultsetInJson(str_replace(array('[VR_TYPE_REF_NAME]'), array('VR5'), $sql_template_retrieve_vr_form_items_config_list)); ?>, 
            "VR6":<?php echo getResultsetInJson(str_replace(array('[VR_TYPE_REF_NAME]'), array('VR6'), $sql_template_retrieve_vr_form_items_config_list)); ?>, 
            "VR7":<?php echo getResultsetInJson(str_replace(array('[VR_TYPE_REF_NAME]'), array('VR7'), $sql_template_retrieve_vr_form_items_config_list)); ?>, 
            "VR8":<?php echo getResultsetInJson(str_replace(array('[VR_TYPE_REF_NAME]'), array('VR8'), $sql_template_retrieve_vr_form_items_config_list)); ?>, 
            "VR9":<?php echo getResultsetInJson(str_replace(array('[VR_TYPE_REF_NAME]'), array('VR9'), $sql_template_retrieve_vr_form_items_config_list)); ?>
        };


        var vr_item_config_saved_data_list = {
            "VR0":[],
            "VR1":[],
            "VR2":[],
            "VR3":[],
            "VR3G":[],
            "VR4":[],
            "VR5":[],
            "VR6":[],
            "VR7":[],
            "VR8":[],
            "VR9":[],
        };


        var vr_form_items_data_entry = [];
        var vr_form_items_data_entry_in_string = '';
        var vr_form_item_data_entry_property_names = [];
        var enable_vr_form_item_calculation_log = false;
        var vr_form_system_info = <?php echo $vr_form_system_info_in_json; ?>;
        var vr_form_url_info = <?php echo $vr_form_url_info_in_json; ?>;
        var vr_form_system_info_in_string = '';

        var vr_form_queries_info = {
            "vr_framework_type":"",
            "vr_type":"",
            "vr_project_name":"",
            "vr_default_colour":"",
            "vr_run_meter":"",
            "vr_rise_meter":"",
            "vr_length_info":{
                "vr_record_indexes":[],
                "vr_lengths_meter":[]
            }, 
            "vr_width_meter":"",
            "vr_number_of_bay":""
        };

        var vr_form_billing_info = {
            "vr_record_index":"",
            "vr_commission_sales_commission":"",
            "vr_commission_pay1":"",
            "vr_commission_pay2":"",
            "vr_commission_final":"",
            "vr_commission_installer_payment":"",
            "vr_payment_deposit":"",
            "vr_payment_progress_payment":"",
            "vr_payment_final_payment":"",
            "vr_payment_vergola":"",
            "vr_payment_disbursement_sub_total":"",
            "vr_payment_sub_total":"",
            "vr_payment_tax":"",
            "vr_payment_total":"",
            "vr_payment_vr_items_rrp":""
        };

        var vr_form_data = {};

        var vr_form_item_table_column_config = {
            "quote":[
                {"ref_name":"item_display_name", "display_name":"Description", "visible":"y"}, 
                {"ref_name":"webbing", "display_name":"Webbing", "visible":"y"}, 
                {"ref_name":"colour", "display_name":"Colour", "visible":"y"}, 
                {"ref_name":"finish", "display_name":"Finish", "visible":"y"}, 
                {"ref_name":"uom", "display_name":"UOM", "visible":"y"}, 
                {"ref_name":"qty", "display_name":"QTY", "visible":"y"}, 
                {"ref_name":"length", "display_name":"Length", "visible":"y"}, 
                {"ref_name":"rrp", "display_name":"RRP", "visible":"y"}, 
                {"ref_name":"image", "display_name":"Dimensions", "visible":"n"}, 
                {"ref_name":"action", "display_name":"", "visible":"y"} /* limit to last position with visibility always on */
            ], 
            "bom":[
                {"ref_name":"item_display_name", "display_name":"Description", "visible":"y"}, 
                {"ref_name":"uom", "display_name":"UOM", "visible":"y"}, 
                {"ref_name":"qty", "display_name":"QTY", "visible":"y"}, 
                {"ref_name":"length", "display_name":"Length", "visible":"y"}, 
                {"ref_name":"colour", "display_name":"Colour", "visible":"y"}, 
                {"ref_name":"finish", "display_name":"Finish", "visible":"y"}, 
                {"ref_name":"image", "display_name":"Dimensions<br />(click to edit)", "visible":"y"}, 
                {"ref_name":"webbing", "display_name":"Webbing", "visible":"n"}, 
                {"ref_name":"rrp", "display_name":"RRP", "visible":"n"}, 
                {"ref_name":"action", "display_name":"", "visible":"y"} /* limit to last position with visibility always on */
            ], 
            "report":[
                {"ref_name":"item_display_name", "display_name":"Description", "visible":"y"}, 
                {"ref_name":"webbing", "display_name":"Webbing", "visible":"y"}, 
                {"ref_name":"colour", "display_name":"Colour", "visible":"y"}, 
                {"ref_name":"finish", "display_name":"Finish", "visible":"y"}, 
                {"ref_name":"uom", "display_name":"UOM", "visible":"y"}, 
                {"ref_name":"qty", "display_name":"QTY", "visible":"y"}, 
                {"ref_name":"length", "display_name":"Length", "visible":"y"}, 
                {"ref_name":"rrp", "display_name":"RRP", "visible":"y"}
            ]
        };

        var bom_form_item_dimension_current_popup_index = -1;
        var bom_form_item_dimensions_info = {
            "item_dimension_record_index":"", 
            "item_dimension_length_meter":"", 
            "item_dimension_a_mm":"", 
            "item_dimension_b_mm":"", 
            "item_dimension_c_mm":"", 
            "item_dimension_d_mm":"", 
            "item_dimension_e_mm":"", 
            "item_dimension_f_mm":"", 
            "item_dimension_g_mm":"", 
            "item_dimension_h_mm":"", 
            "item_dimension_p_mm":"", 
            "item_dimension_girth_side_a_mm":"", 
            "item_dimension_girth_side_b_mm":""
        };

        var vr_form_report_info = '';

        var total_calculation_process_done = 0;

        var current_process_order_by_vr_section_display_name = '';
</script>
