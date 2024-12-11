$(document).ready(function() {
    initialiseDateFieldsAsDatePicker(target_date_fields_11);
});


function initialiseDateFieldsAsDatePicker(target_date_fields) {
    var c1 = 0;
    var c2 = 0;
    var temp_array = [];
    var temp_date = null;

    for (c1 = 0; c1 < target_date_fields.length; c1++) {
        $('#' + target_date_fields[c1]['date_enabler']['field_id']).val(target_date_fields[c1]['date_enabler']['field_value']);
        for (c2 = 0; c2 < target_date_fields[c1]['date_fields'].length; c2++) {
            temp_array = [];
            temp_date = null;
            if (target_date_fields[c1]['date_fields'][c2]['field_value'].length > 0) {
                temp_array = target_date_fields[c1]['date_fields'][c2]['field_value'].split('-');
                temp_date = new Date(temp_array[0], parseInt(temp_array[1]) - 1, temp_array[2]);
            }

            $('#' + target_date_fields[c1]['date_fields'][c2]['field_id']).addClass('hasDatePicker').datepicker({
                dateFormat: 'd-M-yy'
            });

            if (target_date_fields[c1]['date_fields'][c2]['field_value'].length > 0 && temp_date != null) {
                $('#' + target_date_fields[c1]['date_fields'][c2]['field_id']).datepicker('setDate', temp_date);
            }

            if (target_date_fields[c1]['date_enabler']['field_value'] == 'Yes') {
            } else if (target_date_fields[c1]['date_enabler']['field_value'] == 'No') {
                $('#' + target_date_fields[c1]['date_fields'][c2]['field_id']).prop('disabled', true);
            }
        }
    }

    $('#ui-datepicker-div').hide();
}


function switchDateFieldEntryStatus(target_date_fields, date_field_id, is_enabled) {
    var c1 = 0;
    var c2 = 0;
    var temp_date = null;
    var temp_array = [];

    for (c1 = 0; c1 < target_date_fields.length; c1++) {
        if (target_date_fields[c1]['date_enabler']['field_id'] == date_field_id) {
            console.log('date_field_id found: ' + date_field_id);
            for (c2 = 0; c2 < target_date_fields[c1]['date_fields'].length; c2++) {
                if (is_enabled == 'Yes') {
                    $('#' + target_date_fields[c1]['date_fields'][c2]['field_id']).prop('disabled', false);
                } else if (is_enabled == 'No') {
                    $('#' + target_date_fields[c1]['date_fields'][c2]['field_id']).prop('disabled', true);
                }
            }
        }
    }
}
