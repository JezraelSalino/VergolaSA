<?php
/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- insert data quote  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_insert_data_quote = "
    INSERT INTO ver_chronoforms_data_quote_vic 
    (
        quoteid,                        projectid,                  project_name, 
        framework_type,                 framework,                  inventoryid, 
        description,                    webbing,                    colour, 
        finish,                         uom,                        cost, 
        qty,                            length,                
        rrp,                            is_additional, 
        customisation_options,          created_at 
    )
    VALUES 
    (
        '[QUOTE_ID]',                   '[PROJECT_ID]',             '[PROJECT_NAME]', 
        '[VR_FRAMEWORK_TYPE]',          '[VR_TYPE_DISPLAY_NAME]',   '[VR_ITEM_REF_NAME]', 
        '[VR_ITEM_DISPLAY_NAME]',       '[VR_ITEM_WEBBING]',        '[VR_ITEM_COLOUR]', 
        '[VR_ITEM_FINISH]',             '[VR_ITEM_UOM]',            '[VR_ITEM_UNIT_PRICE]', 
        '[VR_ITEM_QTY]',                '[VR_ITEM_LENGTH_METER]',    
        '[VR_ITEM_RRP]',                '[VR_ITEM_ADHOC]', 
        '[CUSTOMISATION_OPTIONS]',      NOW() 
    );
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- insert data followup  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_insert_data_followup = "
    INSERT INTO ver_chronoforms_data_followup_vic 
    (
        quoteid,                                quotedate,                              projectid, 
        project_name,                           rep_id,                                 sales_rep, 
        framework_type,                         default_color,                          sales_comm, 
        sales_comm_cost,                        com_pay1,                               com_pay2, 
        com_final,                              install_comm,                           install_comm_cost, 
        payment_deposit,                        payment_progress,                       payment_final, 
        subtotal_vergola,                       subtotal_disbursement,                  total_cost, 
        total_gst,                              total_cost_gst,                         total_rrp_gst, 
        total_rrp,                              gst_percent,                            comm_percent, 
        is_builder_project,                     status,                                 customisation_options, 
        created_at,                             updated_at 
    )
    VALUES 
    (
        '[QUOTE_ID]',                           '[QUOTE_DATE]',                         '[PROJECT_ID]', 
        '[PROJECT_NAME]',                       '[SALES_REP_ID]',                       '[SALES_REP_NAME]', 
        '[VR_FRAMEWORK_TYPE]',                  '[VR_DEFAULT_COLOUR]',                  '[VR_COMMISSION_SALES_COMMISSION]', 
        '[VR_COMMISSION_SALES_COMMISSION]',     '[VR_COMMISSION_PAY1]',                 '[VR_COMMISSION_PAY2]', 
        '[VR_COMMISSION_FINAL]',                '[VR_COMMISSION_INSTALLER_PAYMENT]',    '[VR_COMMISSION_INSTALLER_PAYMENT]', 
        '[VR_PAYMENT_DEPOSIT]',                 '[VR_PAYMENT_PROGRESS_PAYMENT]',        '[VR_PAYMENT_FINAL_PAYMENT]', 
        '[VR_PAYMENT_VERGOLA]',                 '[VR_PAYMENT_DISBURSEMENT_SUB_TOTAL]',  '[VR_PAYMENT_SUB_TOTAL]', 
        '[VR_PAYMENT_TAX]',                     '[VR_PAYMENT_TAX]',                     '[VR_PAYMENT_TOTAL]', 
        '[TOTAL_RRP]',                          '[GST_PERCENT]',                        '[COMM_PERCENT]', 
        '[IS_BUILDER_PROJECT]',                 'Costed',                               '[CUSTOMISATION_OPTIONS]', 
        NOW(),                                  NOW() 
    );
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- insert data measurement  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_insert_data_measurement = "
    INSERT INTO ver_chronoforms_data_measurement_vic 
    (
        projectid,                  framework_type,         width, 
        length,            
        created_at 
    )
    VALUES 
    (
        '[PROJECT_ID]',             '[VR_FRAMEWORK_TYPE]',  '[VR_WIDTH_METER]', 
        '[VR_LENGTH_METER]',     
        NOW() 
    );
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- insert data letters  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_insert_data_letters = "
    INSERT INTO ver_chronoforms_data_letters_vic 
    (
        clientid,       template_name,      template_content, 
        datecreated 
    )
    VALUES 
    (
        '[CLIENT_ID]',  '[TEMPLATE_NAME]',  '{[TEMPLATE_CONTENT]}', 
        NOW() 
    );
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- insert data contract items  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_insert_data_contract_items = "
    INSERT INTO ver_chronoforms_data_contract_items_vic 
    (
        quoteid,                        projectid,                  project_name, 
        framework_type,                 framework,                  inventoryid, 
        description,                    webbing,                    colour, 
        finish,                         uom,                        cost, 
        qty,                            length,                
        rrp,                            is_additional, 
        customisation_options,          created_at 
    )
    VALUES 
    (
        '[QUOTE_ID]',                   '[PROJECT_ID]',             '[PROJECT_NAME]', 
        '[VR_FRAMEWORK_TYPE]',          '[VR_TYPE_DISPLAY_NAME]',   '[VR_ITEM_REF_NAME]', 
        '[VR_ITEM_DISPLAY_NAME]',       '[VR_ITEM_WEBBING]',        '[VR_ITEM_COLOUR]', 
        '[VR_ITEM_FINISH]',             '[VR_ITEM_UOM]',            '[VR_ITEM_UNIT_PRICE]', 
        '[VR_ITEM_QTY]',                '[VR_ITEM_LENGTH_METER]',    
        '[VR_ITEM_RRP]',                '[VR_ITEM_ADHOC]', 
        '[CUSTOMISATION_OPTIONS]',      NOW() 
    );
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- insert data contract bom meterial  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_insert_data_contract_bom_meterial = "
    INSERT INTO ver_chronoforms_data_contract_bom_meterial_vic 
    ( 
            contract_item_cf_id,        section, 
            projectid,                  inventoryid,            materialid, 
            raw_cost,                   qty,                    length, 
            supplierid 
    ) 
    (
        SELECT  
            '[CONTRACT_ITEM_CF_ID]',    '[VR_SECTION_REF_NAME]', 
            '[PROJECT_ID]',             im.inventoryid,         im.materialid, 
            dm.raw_cost,                '[VR_ITEM_QTY]',        '[LENGTH_METER]', 
            dm.supplierid 
        FROM ver_chronoforms_data_inventory_material_vic AS im 
            JOIN ver_chronoforms_data_materials_vic AS dm ON dm.cf_id = im.materialid 
        WHERE im.inventoryid = '[INVENTORY_ID]' 
    );
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- insert data contract bom  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_insert_data_contract_bom = "
    INSERT INTO ver_chronoforms_data_contract_bom_vic 
    ( 
        orderdate,                          quoteid,                        projectid, 
        framework_type,                     framework,                      description, 
        inventoryid,                        colour,                         finish, 
        uom,                                qty,                            length, 
        cost, 
        rrp,                                contract_item_cf_id,            inventory_section, 
        inventory_category,                 supplierid,                     is_reorder 
    ) 
    VALUES 
    ( 
        NOW(),                              '[QUOTE_ID]',                   '[PROJECT_ID]', 
        '[VR_FRAMEWORK_TYPE]',              '[VR_TYPE_DISPLAY_NAME]',       '[VR_ITEM_DISPLAY_NAME]', 
        '[VR_ITEM_REF_NAME]',               '[VR_ITEM_COLOUR]',             '[VR_ITEM_FINISH]', 
        '[VR_ITEM_UOM]',                    '[VR_ITEM_QTY]',                '[VR_ITEM_LENGTH_METER]', 
        '[VR_ITEM_UNIT_PRICE]', 
        '[VR_ITEM_RRP]',                    '[CONTRACT_ITEM_CF_ID]',        '[VR_SECTION_REF_NAME]', 
        '[VR_SUBSECTION_REF_NAME]',         '[SUPPLIER_ID]',                '[IS_REORDER]'
    );
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- insert data contract item dimensions  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_insert_data_contract_item_dimensions = "
    INSERT INTO ver_chronoforms_data_contract_items_deminsions 
    (
        cf_id,                     quoteid,                    projectid, 
        inventoryid, 
        length,                    
        dimension_a,               
        dimension_b,               
        dimension_c,               
        dimension_d,               
        dimension_e,               
        dimension_f,               
        dimension_g,
        dimension_h,
        dimension_p,               
        girth_side_a,              
        girth_side_b,              
        created_at 
    )
    VALUES 
    (
        '[CF_ID]',                      '[QUOTE_ID]',               '[PROJECT_ID]', 
        '[VR_ITEM_REF_NAME]', 
        '[LENGTH_METER]',                
        '[DIMENSION_A_MM]',             
        '[DIMENSION_B_MM]',             
        '[DIMENSION_C_MM]',             
        '[DIMENSION_D_MM]',             
        '[DIMENSION_E_MM]',             
        '[DIMENSION_F_MM]',             
        '[DIMENSION_G_MM]',
        '[DIMENSION_H_MM]',
        '[DIMENSION_P_MM]',             
        '[GIRTH_SIDE_A_MM]',            
        '[GIRTH_SIDE_B_MM]',            
        NOW() 
    );
";










/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- retrieve colour list -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_retrieve_colour_list = "
    SELECT 
        colour AS 'ref_name', 
        colour AS 'display_name', 
        cf_id AS 'display_order' 
    FROM ver_chronoforms_data_colour_vic 
    ORDER BY cf_id 
    LIMIT 1000;
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- retrieve section list -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_retrieve_section_list = "
    SELECT 
        section AS 'ref_name', 
        section_display_name AS 'display_name', 
        section_display_order AS 'display_order' 
    FROM ver_chronoforms_data_section_vic 
    GROUP BY section 
    ORDER BY section_display_order 
    LIMIT 1000;
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- retrieve subsection list -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_retrieve_subsection_list = "
    SELECT 
        section AS 'section_ref_name', 
        section_display_name, 
        section_display_order, 
        category AS 'subsection_ref_name', 
        category AS 'subsection_display_name', 
        subsection_display_order 
    FROM ver_chronoforms_data_section_vic 
    ORDER BY section_display_order, subsection_display_order 
    LIMIT 1000;
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- retrieve item list -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_retrieve_item_list = "
    SELECT 
        ver_chronoforms_data_section_vic.section AS 'section_ref_name', 
        ver_chronoforms_data_section_vic.section_display_name, 
        ver_chronoforms_data_section_vic.section_display_order, 
        ver_chronoforms_data_section_vic.category AS 'subsection_ref_name', 
        ver_chronoforms_data_section_vic.category AS 'subsection_display_name', 
        ver_chronoforms_data_section_vic.subsection_display_order, 
        ver_chronoforms_data_inventory_vic.inventoryid AS 'item_ref_name', 
        ver_chronoforms_data_inventory_vic.description AS 'item_display_name', 
        ver_chronoforms_data_inventory_vic.cf_id AS 'item_display_order', 
        ver_chronoforms_data_inventory_vic.uom AS 'item_uom', 
        ver_chronoforms_data_inventory_vic.rrp AS 'item_unit_price', 
        ver_chronoforms_data_inventory_vic.photo AS 'item_image', 
        IFNULL(ver_chronoforms_data_inventory_vic.customisation_options, '') AS 'item_customisation_options' 
    FROM ver_chronoforms_data_section_vic 
        LEFT JOIN ver_chronoforms_data_inventory_vic 
            ON ver_chronoforms_data_section_vic.section = ver_chronoforms_data_inventory_vic.section 
            AND ver_chronoforms_data_section_vic.category = ver_chronoforms_data_inventory_vic.category 
    ORDER BY 
        ver_chronoforms_data_section_vic.section_display_order, 
        ver_chronoforms_data_section_vic.subsection_display_order, 
        ver_chronoforms_data_inventory_vic.cf_id 
    LIMIT 1000;
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- retrieve item list hide costing-----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_retrieve_item_list_hide_costing = "
    SELECT 
        ver_chronoforms_data_section_vic.section AS 'section_ref_name', 
        ver_chronoforms_data_section_vic.section_display_name, 
        ver_chronoforms_data_section_vic.section_display_order, 
        ver_chronoforms_data_section_vic.category AS 'subsection_ref_name', 
        ver_chronoforms_data_section_vic.category AS 'subsection_display_name', 
        ver_chronoforms_data_section_vic.subsection_display_order, 
        ver_chronoforms_data_inventory_vic.inventoryid AS 'item_ref_name', 
        ver_chronoforms_data_inventory_vic.description AS 'item_display_name', 
        ver_chronoforms_data_inventory_vic.cf_id AS 'item_display_order', 
        ver_chronoforms_data_inventory_vic.uom AS 'item_uom', 
        ver_chronoforms_data_inventory_vic.rrp AS 'item_unit_price', 
        ver_chronoforms_data_inventory_vic.photo AS 'item_image', 
        IFNULL(ver_chronoforms_data_inventory_vic.customisation_options, '') AS 'item_customisation_options' 
        ,ver_chronoforms_data_inventory_vic.hide_from_costing AS 'item_hide_costing'
    FROM ver_chronoforms_data_section_vic 
        LEFT JOIN ver_chronoforms_data_inventory_vic 
            ON ver_chronoforms_data_section_vic.section = ver_chronoforms_data_inventory_vic.section 
            AND ver_chronoforms_data_section_vic.category = ver_chronoforms_data_inventory_vic.category 
    WHERE
        ver_chronoforms_data_inventory_vic.hide_from_costing <> 1
    ORDER BY 
        ver_chronoforms_data_section_vic.section_display_order, 
        ver_chronoforms_data_section_vic.subsection_display_order, 
        ver_chronoforms_data_inventory_vic.cf_id 
    LIMIT 1000;
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- retrieve vr form items config list -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_retrieve_vr_form_items_config_list = "
    SELECT 
        ic.vr_type_ref_name, 
        ic.vr_type_display_name, 
        ic.vr_section_ref_name, 
        ic.vr_section_display_name, 
        ic.vr_subsection_ref_name, 
        ic.vr_subsection_display_name, 
        ic.vr_item_ref_name, 
        iv.description AS 'vr_item_display_name', 
        ic.vr_item_display_name_input_type, 
        ic.vr_item_webbing, 
        ic.vr_item_webbing_input_type, 
        ic.vr_item_colour, 
        ic.vr_item_colour_input_type, 
        ic.vr_item_finish, 
        ic.vr_item_finish_input_type, 
        iv.uom AS 'vr_item_uom', 
        ic.vr_item_uom_input_type, 
        iv.rrp AS 'vr_item_unit_price', 
        ic.vr_item_unit_price_input_type, 
        ic.vr_item_qty, 
        ic.vr_item_qty_input_type, 
        ic.vr_item_length AS 'vr_item_length_meter', 
        ic.vr_item_length_input_type AS 'vr_item_length_meter_input_type', 
        ic.vr_item_rrp, 
        ic.vr_item_rrp_input_type, 
        iv.photo AS 'vr_item_image', 
        ic.vr_item_image_input_type, 
        ic.vr_item_config_internal_ref_name, 
        ic.vr_item_adhoc, 
        ic.vr_record_index, 
        ic.status 
        ,iv.hide_from_costing AS 'vr_item_hide_costing'
    FROM tblvrformitemsconfig ic 
        LEFT JOIN ver_chronoforms_data_inventory_vic iv 
            ON ic.vr_item_ref_name = iv.inventoryid COLLATE utf8_unicode_ci 
    WHERE ic.vr_type_ref_name = '[VR_TYPE_REF_NAME]' 
    AND ic.status IN ('active', 'hidden') 
    ORDER BY ic.display_order 
    LIMIT 1000;
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- retrieve vr form items config list by item info -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_retrieve_vr_form_items_config_list_by_item_info = "
    SELECT 
        vr_type_ref_name, 
        vr_section_display_name, 
        vr_section_ref_name, 
        vr_subsection_display_name, 
        vr_subsection_ref_name, 
        vr_item_display_name_input_type, 
        vr_item_webbing_input_type, 
        vr_item_colour_input_type, 
        vr_item_finish_input_type, 
        vr_item_uom_input_type, 
        vr_item_unit_price_input_type, 
        vr_item_qty_input_type, 
        vr_item_length_input_type, 
        vr_item_rrp_input_type, 
        vr_item_image, 
        vr_item_image_input_type, 
        vr_item_config_internal_ref_name 
    FROM tblvrformitemsconfig 
    WHERE vr_type_ref_name = '[VR_TYPE_REF_NAME]' 
    AND vr_item_ref_name = '[VR_ITEM_REF_NAME]' 
    ORDER BY id 
    [LIMIT_CONDITION]; 
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- retrieve vr form items config list by section info -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_retrieve_vr_form_items_config_list_by_section_info = "
    SELECT 
        vr_type_ref_name, 
        vr_section_display_name, 
        vr_section_ref_name, 
        vr_subsection_display_name, 
        vr_subsection_ref_name, 
        vr_item_display_name_input_type, 
        vr_item_webbing_input_type, 
        vr_item_colour_input_type, 
        vr_item_finish_input_type, 
        vr_item_uom_input_type, 
        vr_item_unit_price_input_type, 
        vr_item_qty_input_type, 
        vr_item_length_input_type, 
        vr_item_rrp_input_type, 
        vr_item_image, 
        vr_item_image_input_type, 
        vr_item_config_internal_ref_name 
    FROM tblvrformitemsconfig 
    WHERE vr_section_ref_name = '[VR_SECTION_REF_NAME]' 
    AND vr_subsection_ref_name = '[VR_SUBSECTION_REF_NAME]' 
    ORDER BY id 
    LIMIT 1; 
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- retrieve total process order items by section info -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_retrieve_total_process_order_items_by_section_info = "
    SELECT 
        ds.section AS 'ref_name', 
        ds.section_display_name AS 'display_name', 
        ds.section_display_order AS 'display_order', 
        ( 
            SELECT COUNT(*) 
            FROM ver_chronoforms_data_contract_bom_vic dcb 
            WHERE dcb.projectid = '[PROJECT_ID]' 
            AND dcb.quoteid = '[QUOTE_ID]' 
            AND dcb.inventory_section = ds.section 
        ) AS 'total_process_order_items' 
    FROM ver_chronoforms_data_section_vic ds 
    GROUP BY ds.section 
    ORDER BY ds.section_display_order 
    LIMIT 1000;
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- retrieve data quote  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_retrieve_data_quote = "
    SELECT 
        dq.cf_id, 
        dq.framework_type, 
        dq.framework, 
        dq.inventoryid, 
        dq.description, 
        dq.webbing, 
        dq.colour, 
        dq.finish, 
        dq.uom, 
        iv.rrp AS 'cost', 
        dq.qty, 
        dq.length, 
        dq.rrp, 
        dq.is_additional, 
        iv.section, 
        iv.category, 
        iv.photo 
        ,iv.hide_from_costing AS 'hide_costing'
    FROM ver_chronoforms_data_quote_vic dq 
        LEFT JOIN ver_chronoforms_data_inventory_vic iv 
            ON dq.inventoryid = iv.inventoryid 
        LEFT JOIN ver_chronoforms_data_section_vic ds 
            ON iv.section = ds.section 
            AND iv.category = ds.category 
    WHERE dq.projectid = '[PROJECT_ID]' 
    ORDER BY ds.section_display_order, dq.cf_id; 
";



/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- retrieve data followup  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_retrieve_data_followup = "
    SELECT * FROM ver_chronoforms_data_followup_vic WHERE projectid = '[PROJECT_ID]';
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- retrieve data measurement  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_retrieve_data_measurement = "
    SELECT * FROM ver_chronoforms_data_measurement_vic WHERE projectid = '[PROJECT_ID]';
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- retrieve data client info  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_retrieve_data_clientpersonal = "
    SELECT * FROM ver_chronoforms_data_clientpersonal_vic WHERE clientid = '[QUOTE_ID]';
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- retrieve data systable  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_retrieve_data_systable = "
    SELECT * FROM ver_chronoforms_data_systable_vic WHERE cf_id  = '1';
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- retrieve status data followup  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_retrieve_status_data_followup = "
    SHOW TABLE STATUS LIKE 'ver_chronoforms_data_followup_vic';
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- retrieve data contract items  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_retrieve_data_contract_items = "
    SELECT 
        dci.cf_id, 
        dci.framework_type, 
        dci.framework, 
        dci.inventoryid, 
        dci.description, 
        dci.webbing, 
        dci.colour, 
        dci.finish, 
        dci.uom, 
        dci.cost, 
        dci.qty, 
        dci.length, 
        dci.rrp, 
        dci.is_additional, 
        iv.section, 
        iv.category, 
        iv.photo 
        ,iv.hide_from_costing AS 'hide_costing'
    FROM ver_chronoforms_data_section_vic ds 
        LEFT JOIN ver_chronoforms_data_inventory_vic iv 
            ON ds.section = iv.section AND ds.category = iv.category 
        LEFT JOIN ver_chronoforms_data_contract_items_vic dci 
            ON iv.inventoryid = dci.inventoryid 
    WHERE dci.projectid = '[PROJECT_ID]' 
    ORDER BY ds.section_display_order, dci.quoteid, dci.projectid, dci.cf_id;
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- retrieve data contract item default dimensions  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_retrieve_data_contract_items_default_deminsions = "
    SELECT * FROM ver_chronoforms_data_contract_items_default_deminsions;
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- retrieve data contract item dimensions  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_retrieve_data_contract_item_dimensions = "
    SELECT * FROM ver_chronoforms_data_contract_items_deminsions 
    WHERE cf_id = '[CF_ID]' 
    AND projectid = '[PROJECT_ID]' 
    AND inventoryid = '[INVENTORY_ID]' 
    LIMIT 1;
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- retrieve last insert id  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_retrieve_last_insert_id = "
    SELECT LAST_INSERT_ID() AS 'last_insert_id';
";










/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- update data quote  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_update_data_quote = "
    UPDATE ver_chronoforms_data_quote_vic SET  
        project_name = '[PROJECT_NAME]',                    framework_type = '[VR_FRAMEWORK_TYPE]', 
        framework = '[VR_TYPE_DISPLAY_NAME]',               inventoryid = '[VR_ITEM_REF_NAME]', 
        description = '[VR_ITEM_DISPLAY_NAME]',             webbing = '[VR_ITEM_WEBBING]', 
        colour = '[VR_ITEM_COLOUR]',                        finish = '[VR_ITEM_FINISH]', 
        uom = '[VR_ITEM_UOM]',                              cost = '[VR_ITEM_UNIT_PRICE]', 
        qty = '[VR_ITEM_QTY]',                              length = '[VR_ITEM_LENGTH_METER]', 
        rrp = '[VR_ITEM_RRP]',                              is_additional = '[VR_ITEM_ADHOC]', 
        customisation_options = '[CUSTOMISATION_OPTIONS]',  updated_at = NOW() 
    WHERE projectid = '[PROJECT_ID]' 
    AND cf_id = [VR_RECORD_INDEX];
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- update data followup  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_update_data_followup = "
    UPDATE ver_chronoforms_data_followup_vic SET  
        project_name = '[PROJECT_NAME]',                                framework_type = '[VR_FRAMEWORK_TYPE]', 
        default_color = '[VR_DEFAULT_COLOUR]',                          sales_comm = '[VR_COMMISSION_SALES_COMMISSION]', 
        sales_comm_cost = '[VR_COMMISSION_SALES_COMMISSION]',           com_pay1 = '[VR_COMMISSION_PAY1]', 
        com_pay2 = '[VR_COMMISSION_PAY2]',                              com_final = '[VR_COMMISSION_FINAL]', 
        install_comm = '[VR_COMMISSION_INSTALLER_PAYMENT]',             install_comm_cost = '[VR_COMMISSION_INSTALLER_PAYMENT]', 
        payment_deposit = '[VR_PAYMENT_DEPOSIT]',                       payment_progress = '[VR_PAYMENT_PROGRESS_PAYMENT]', 
        payment_final = '[VR_PAYMENT_FINAL_PAYMENT]',                   subtotal_vergola = '[VR_PAYMENT_VERGOLA]', 
        subtotal_disbursement = '[VR_PAYMENT_DISBURSEMENT_SUB_TOTAL]',  total_cost = '[VR_PAYMENT_SUB_TOTAL]', 
        total_gst = '[VR_PAYMENT_TAX]',                                 total_cost_gst = '[VR_PAYMENT_TAX]', 
        total_rrp_gst = '[VR_PAYMENT_TOTAL]',                           total_rrp ='[TOTAL_RRP]', 
        gst_percent = '[GST_PERCENT]',                                  comm_percent = '[COMM_PERCENT]', 
        customisation_options = '[CUSTOMISATION_OPTIONS]',              updated_at = NOW() 
    WHERE projectid = '[PROJECT_ID]' 
    AND cf_id = [VR_RECORD_INDEX];
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- update data measurement  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_update_data_measurement = "
    UPDATE ver_chronoforms_data_measurement_vic SET  
        framework_type = '[VR_FRAMEWORK_TYPE]',     width = '[VR_WIDTH_METER]', 
        length = '[VR_LENGTH_METER]', 
        updated_at = NOW() 
    WHERE projectid = '[PROJECT_ID]' 
    AND cf_id = [VR_RECORD_INDEX];
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- update data letters  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_update_data_letters = "
    UPDATE ver_chronoforms_data_letters_vic SET  
        template_content = '{[TEMPLATE_CONTENT]}',  dateupdated = NOW() 
    WHERE clientid = '[CLIENT_ID]' 
    AND template_name = '[TEMPLATE_NAME]';
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- update data contract items  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_update_data_contract_items = "
    UPDATE ver_chronoforms_data_contract_items_vic SET  
        project_name = '[PROJECT_NAME]',                    framework_type = '[VR_FRAMEWORK_TYPE]', 
        framework = '[VR_TYPE_DISPLAY_NAME]',               inventoryid = '[VR_ITEM_REF_NAME]', 
        description = '[VR_ITEM_DISPLAY_NAME]',             webbing = '[VR_ITEM_WEBBING]', 
        colour = '[VR_ITEM_COLOUR]',                        finish = '[VR_ITEM_FINISH]', 
        uom = '[VR_ITEM_UOM]',                              cost = '[VR_ITEM_UNIT_PRICE]', 
        qty = '[VR_ITEM_QTY]',                              length = '[VR_ITEM_LENGTH_METER]', 
        rrp = '[VR_ITEM_RRP]',                              is_additional = '[VR_ITEM_ADHOC]', 
        customisation_options = '[CUSTOMISATION_OPTIONS]',  updated_at = NOW() 
    WHERE projectid = '[PROJECT_ID]' 
    AND cf_id = [VR_RECORD_INDEX];
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- update data contract item dimensions  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_update_data_contract_item_dimensions = "
    UPDATE ver_chronoforms_data_contract_items_deminsions SET  
        inventoryid = '[VR_ITEM_REF_NAME]', 
        length = '[LENGTH_METER]', 
        dimension_a = '[DIMENSION_A_MM]', 
        dimension_b = '[DIMENSION_B_MM]', 
        dimension_c = '[DIMENSION_C_MM]', 
        dimension_d = '[DIMENSION_D_MM]', 
        dimension_e = '[DIMENSION_E_MM]', 
        dimension_f = '[DIMENSION_F_MM]', 
        dimension_g = '[DIMENSION_G_MM]',
        dimension_h = '[DIMENSION_H_MM]',
        dimension_p = '[DIMENSION_P_MM]', 
        girth_side_a = '[GIRTH_SIDE_A_MM]', 
        girth_side_b = '[GIRTH_SIDE_B_MM]', 
        updated_at = NOW() 
    WHERE projectid = '[PROJECT_ID]' 
    AND id = [VR_RECORD_INDEX];
";










/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- delete data quote  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_delete_data_quote = "
    DELETE FROM ver_chronoforms_data_quote_vic 
    WHERE projectid = '[PROJECT_ID]';
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- delete data quote by record index  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_delete_data_quote_by_record_index = "
    DELETE FROM ver_chronoforms_data_quote_vic 
    WHERE projectid = '[PROJECT_ID]' 
    AND cf_id = '[CF_ID]';
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- delete data followup  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_delete_data_followup = "
    DELETE FROM ver_chronoforms_data_followup_vic 
    WHERE projectid = '[PROJECT_ID]';
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- delete data measurement  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_delete_data_measurement = "
    DELETE FROM ver_chronoforms_data_measurement_vic 
    WHERE projectid = '[PROJECT_ID]';
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- delete data letters  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_delete_data_letters = "
    DELETE FROM ver_chronoforms_data_letters_vic 
    WHERE clientid = '[CLIENT_ID]' 
    AND template_name = '[TEMPLATE_NAME]';
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- delete data contract items by record index -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_delete_data_contract_items_by_record_index = "
    DELETE FROM ver_chronoforms_data_contract_items_vic 
    WHERE projectid = '[PROJECT_ID]' 
    AND cf_id = '[CF_ID]';
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- delete data contract bom meterial  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_delete_data_contract_bom_meterial = "
    DELETE FROM ver_chronoforms_data_contract_bom_meterial_vic 
    WHERE projectid = '[PROJECT_ID]' 
    AND section = '[VR_SECTION_REF_NAME]';
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- delete data contract bom  -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_delete_data_contract_bom = "
    DELETE FROM ver_chronoforms_data_contract_bom_vic 
    WHERE projectid = '[PROJECT_ID]' 
    AND inventory_section = '[VR_SECTION_REF_NAME]';
";
?>