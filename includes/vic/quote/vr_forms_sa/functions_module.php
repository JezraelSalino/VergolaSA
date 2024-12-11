<?php
function getVrLengths($api_data) {
    $vr_lengths = array();

    $number_of_bay = intval($api_data['vr_form_queries_info']['vr_number_of_bay']);

    for ($c1 = 0; $c1 < $number_of_bay; $c1++) {
        $vr_lengths[] = $api_data['vr_form_queries_info']['vr_length_' . $c1];
    }

    return $vr_lengths;
}


function getVrItemInputTypeInString($vr_item_row_data) {
    $result = '';

    $template_vr_item_input_type = '{
        "vr_item_input_type":[
            {"vr_item_display_name_input_type":"[VR_ITEM_DISPLAY_name_INPUT_TYPE]"}, 
            {"vr_item_webbing_input_type":"[VR_ITEM_WEBBING_INPUT_TYPE]"}, 
            {"vr_item_colour_input_type":"[VR_ITEM_COLOUR_INPUT_TYPE]"}, 
            {"vr_item_finish_input_type":"[VR_ITEM_FINISH_INPUT_TYPE]"}, 
            {"vr_item_uom_input_type":"[VR_ITEM_UOM_INPUT_TYPE]"}, 
            {"vr_item_qty_input_type":"[VR_ITEM_QTY_INPUT_TYPE]"}, 
            {"vr_item_length_input_type":"[VR_ITEM_LENGTH_INPUT_TYPE]"}, 
            {"vr_item_rrp_input_type":"[VR_ITEM_RRP_INPUT_TYPE]"}
        ]
    }';
    $vr_item_input_type_in_json = json_decode($template_vr_item_input_type, true);
    $temp_array = array();
    $current_temp_array_index = null;

    foreach ($vr_item_input_type_in_json['vr_item_input_type'] as $key1 => $input_type_ref_names) {
        $current_temp_array_index = count($temp_array);
        $temp_array[$current_temp_array_index] = array();
        foreach ($input_type_ref_names as $input_type_ref_name => $input_type_ref_value) {
            $temp_array[$current_temp_array_index][$input_type_ref_name] = $vr_item_row_data[$input_type_ref_name];
        }
    }

    $result = json_encode(array('vr_item_input_type' => $temp_array));

    return $result;
}
?>