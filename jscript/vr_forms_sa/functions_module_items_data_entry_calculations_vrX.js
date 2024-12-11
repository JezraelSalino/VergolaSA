        function assignVrDimensionsToVrXFormGutterRows() {
            var temp_array = [];
            var vr_lengths_in_value_for_calculation = [];
            var vr_lengths_meter_in_value_for_display = [];
            var total_vr_length_meter_in_value_for_display = '';
            var vr_width_in_value_for_calculation = 0.0;
            var vr_width_meter_in_value_for_display = '';
            var c1 = 0;
            var current_bay_ref_suffix = 0;
            var vr_type_form_query_value = document.getElementById('vr_type_form_query').value;

            temp_array = getVrDimensionsLengthInfo();
            vr_lengths_in_value_for_calculation = temp_array['vr_lengths_in_value_for_calculation'];
            vr_lengths_meter_in_value_for_display = temp_array['vr_lengths_meter_in_value_for_display'];
            total_vr_length_meter_in_value_for_display = temp_array['total_vr_length_meter_in_value_for_display'];

            temp_array = getVrDimensionsWidthInfo();
            vr_width_in_value_for_calculation = temp_array['vr_width_in_value_for_calculation'];
            vr_width_meter_in_value_for_display = temp_array['vr_width_meter_in_value_for_display'];

            setVrFormItemDataEntryRowValuesByInternalRefName(
                'gutter_narrow', 
                [{"form_item_name":"vr_item_data_entry_length_meter", "variable_name":"vr_item_length_meter", "col_value":vr_width_meter_in_value_for_display}]
            );

            setVrFormItemDataEntryRowValuesByInternalRefName(
                'gutter_wide', 
                [{"form_item_name":"vr_item_data_entry_length_meter", "variable_name":"vr_item_length_meter", "col_value":vr_width_meter_in_value_for_display}]
            );

            setVrFormItemDataEntryRowValuesByInternalRefName(
                'gutter_bridge', 
                [{"form_item_name":"vr_item_data_entry_length_meter", "variable_name":"vr_item_length_meter", "col_value":vr_width_meter_in_value_for_display}]
            );

            for (c1 = 0; c1 < vr_lengths_meter_in_value_for_display.length; c1++) {
                current_bay_ref_suffix = '_bay_' + (c1 + 1);

                setVrFormItemDataEntryRowValuesByInternalRefName(
                    'gutter_tapered_narrow_to_wide' + current_bay_ref_suffix, 
                    [{"form_item_name":"vr_item_data_entry_length_meter", "variable_name":"vr_item_length_meter", "col_value":vr_lengths_meter_in_value_for_display[c1]}]
                );

                setVrFormItemDataEntryRowValuesByInternalRefName(
                    'gutter_tapered_wide_to_narrow' + current_bay_ref_suffix, 
                    [{"form_item_name":"vr_item_data_entry_length_meter", "variable_name":"vr_item_length_meter", "col_value":vr_lengths_meter_in_value_for_display[c1]}]
                );

                setVrFormItemDataEntryRowValuesByInternalRefName(
                    'gutter_tapered_narrow_to_bridge' + current_bay_ref_suffix, 
                    [{"form_item_name":"vr_item_data_entry_length_meter", "variable_name":"vr_item_length_meter", "col_value":vr_lengths_meter_in_value_for_display[c1]}]
                );

                setVrFormItemDataEntryRowValuesByInternalRefName(
                    'gutter_tapered_bridge_to_narrow' + current_bay_ref_suffix, 
                    [{"form_item_name":"vr_item_data_entry_length_meter", "variable_name":"vr_item_length_meter", "col_value":vr_lengths_meter_in_value_for_display[c1]}]
                );

                setVrFormItemDataEntryRowValuesByInternalRefName(
                    'gutter_tapered_bridge_to_wide' + current_bay_ref_suffix, 
                    [{"form_item_name":"vr_item_data_entry_length_meter", "variable_name":"vr_item_length_meter", "col_value":vr_lengths_meter_in_value_for_display[c1]}]
                );

                setVrFormItemDataEntryRowValuesByInternalRefName(
                    'gutter_tapered_wide_to_bridge' + current_bay_ref_suffix, 
                    [{"form_item_name":"vr_item_data_entry_length_meter", "variable_name":"vr_item_length_meter", "col_value":vr_lengths_meter_in_value_for_display[c1]}]
                );
            }
        }


        function assignVrDimensionsToVrXFormFlashingRows() {
            var temp_array = [];
            var vr_lengths_in_value_for_calculation = [];
            var vr_lengths_meter_in_value_for_display = [];
            var total_vr_length_meter_in_value_for_display = '';
            var vr_width_in_value_for_calculation = 0.0;
            var vr_width_meter_in_value_for_display = '';
            var c1 = 0;
            var current_bay_ref_suffix = 0;
            var vr_type_form_query_value = document.getElementById('vr_type_form_query').value;

            temp_array = getVrDimensionsLengthInfo();
            vr_lengths_in_value_for_calculation = temp_array['vr_lengths_in_value_for_calculation'];
            vr_lengths_meter_in_value_for_display = temp_array['vr_lengths_meter_in_value_for_display'];
            total_vr_length_meter_in_value_for_display = temp_array['total_vr_length_meter_in_value_for_display'];

            temp_array = getVrDimensionsWidthInfo();
            vr_width_in_value_for_calculation = temp_array['vr_width_in_value_for_calculation'];
            vr_width_meter_in_value_for_display = temp_array['vr_width_meter_in_value_for_display'];

            for (c1 = 0; c1 < vr_lengths_meter_in_value_for_display.length; c1++) {
                current_bay_ref_suffix = '_bay_' + (c1 + 1);

                setVrFormItemDataEntryRowValuesByInternalRefName(
                    'flashing_beam_face_front' + current_bay_ref_suffix, 
                    [{"form_item_name":"vr_item_data_entry_length_meter", "variable_name":"vr_item_length_meter", "col_value":vr_lengths_meter_in_value_for_display[c1]}]
                );

                setVrFormItemDataEntryRowValuesByInternalRefName(
                    'flashing_adaptor_male' + current_bay_ref_suffix, 
                    [{"form_item_name":"vr_item_data_entry_length_meter", "variable_name":"vr_item_length_meter", "col_value":vr_lengths_meter_in_value_for_display[c1]}]
                );

                setVrFormItemDataEntryRowValuesByInternalRefName(
                    'flashing_adaptor_female' + current_bay_ref_suffix, 
                    [{"form_item_name":"vr_item_data_entry_length_meter", "variable_name":"vr_item_length_meter", "col_value":vr_lengths_meter_in_value_for_display[c1]}]
                );
            }

            setVrFormItemDataEntryRowValuesByInternalRefName(
                'flashing_beam_face_left_and_right', 
                [{"form_item_name":"vr_item_data_entry_length_meter", "variable_name":"vr_item_length_meter", "col_value":vr_width_meter_in_value_for_display}]
            );

            setVrFormItemDataEntryRowValuesByInternalRefName(
                'flashing_fascia', 
                [{"form_item_name":"vr_item_data_entry_length_meter", "variable_name":"vr_item_length_meter", "col_value":total_vr_length_meter_in_value_for_display}]
            );

            setVrFormItemDataEntryRowValuesByInternalRefName(
                'flashing_perimeter_front', 
                [{"form_item_name":"vr_item_data_entry_length_meter", "variable_name":"vr_item_length_meter", "col_value":total_vr_length_meter_in_value_for_display}]
            );

            setVrFormItemDataEntryRowValuesByInternalRefName(
                'flashing_perimeter_left_and_right', 
                [{"form_item_name":"vr_item_data_entry_length_meter", "variable_name":"vr_item_length_meter", "col_value":vr_width_meter_in_value_for_display}]
            );

            setVrFormItemDataEntryRowValuesByInternalRefName(
                'flashing_intermediate', 
                [{"form_item_name":"vr_item_data_entry_length_meter", "variable_name":"vr_item_length_meter", "col_value":vr_width_meter_in_value_for_display}]
            );
        }


        function assignVrDimensionsToVrXFormLouvreRows() {
            var temp_array = [];
            var vr_lengths_in_value_for_calculation = [];
            var vr_lengths_meter_in_value_for_display = [];
            var total_vr_length_meter_in_value_for_display = '';
            var vr_width_in_value_for_calculation = 0.0;
            var vr_width_meter_in_value_for_display = '';
            var c1 = 0;
            var current_bay_ref_suffix = 0;
            var minimum_meter_per_louvre = 0.2;
            var total_louvre = 0;
            var total_endcap = 0;
            var grand_total_endcap = 0;
            var total_pivot_strip = 0;
            var total_link_bar = 0;

            temp_array = getVrDimensionsLengthInfo();
            vr_lengths_in_value_for_calculation = temp_array['vr_lengths_in_value_for_calculation'];
            vr_lengths_meter_in_value_for_display = temp_array['vr_lengths_meter_in_value_for_display'];
            total_vr_length_meter_in_value_for_display = temp_array['total_vr_length_meter_in_value_for_display'];

            temp_array = getVrDimensionsWidthInfo();
            vr_width_in_value_for_calculation = temp_array['vr_width_in_value_for_calculation'];
            vr_width_meter_in_value_for_display = temp_array['vr_width_meter_in_value_for_display'];

            for (c1 = 0; c1 < vr_lengths_meter_in_value_for_display.length; c1++) {
                current_bay_ref_suffix = '';
                if (vr_lengths_meter_in_value_for_display.length > 1) {
                    current_bay_ref_suffix = '_bay_' + (c1 + 1);
                }

                total_louvre = Math.floor(vr_width_in_value_for_calculation / minimum_meter_per_louvre);

                setVrFormItemDataEntryRowValuesByInternalRefName(
                    'vergola_system_louvre' + current_bay_ref_suffix, 
                    [{"form_item_name":"vr_item_data_entry_qty", "variable_name":"vr_item_qty", "col_value":total_louvre}]
                );

                setVrFormItemDataEntryRowValuesByInternalRefName(
                    'vergola_system_louvre' + current_bay_ref_suffix, 
                    [{"form_item_name":"vr_item_data_entry_length_meter", "variable_name":"vr_item_length_meter", "col_value":vr_lengths_meter_in_value_for_display[c1]}]
                );
            }
        }


        function assignVrDimensionsToVrXFormRelatedRows() {
            assignVrDimensionsToVrXFormGutterRows();
            assignVrDimensionsToVrXFormFlashingRows();
            assignVrDimensionsToVrXFormLouvreRows();
        }
