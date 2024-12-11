        function blockPageInputWhileAjaxCall() {
            ajax_call_state = 'active';
            document.getElementById('page_input_blocker').style.width = document.body.scrollWidth + 'px';
            document.getElementById('page_input_blocker').style.height = document.body.scrollHeight + 'px';
            document.getElementById('page_input_blocker').style.visibility = 'visible';
            document.getElementById('page_input_blocker_message').innerHTML = ajax_call_message_active;
        }


        function unblockPageInputAfterAjaxCall(ajax_call_handler_index) {
            ajax_call_state = 'stop';
            clearTimeout(ajax_call_timer[ajax_call_handler_index]);
            document.getElementById('page_input_blocker').style.width = '0px';
            document.getElementById('page_input_blocker').style.height = '0px';
            document.getElementById('page_input_blocker').style.visibility = 'hidden';
            document.getElementById('page_input_blocker_message').innerHTML = '';
        }


        function resumePageInputWhenAjaxCallFailed(ajax_call_handler_index) {
            if (ajax_call_state == 'active') {
                ajax_call_state = 'stop';
                clearTimeout(ajax_call_timer[ajax_call_handler_index]);
                ajax_call_handler[ajax_call_handler_index].abort();
                document.getElementById('page_input_blocker_message').innerHTML = ajax_call_message_time_out;
                window.setTimeout(unblockPageInputAfterAjaxCall, ajax_call_message_display_time_in_seconds);
            } 
        }


        function initPageInputBlocker() {
            if (! document.getElementById('page_input_blocker')) {
                document.body.innerHTML = document.body.innerHTML + 
                                            '<div style="visibility: hidden;" id="page_input_blocker">' + 
                                                    '<span id="page_input_blocker_message"></span>' + 
                                            '</div>';

                document.getElementById('page_input_blocker').style.visibility = 'hidden';
                document.getElementById('page_input_blocker').style.position = 'absolute';
                document.getElementById('page_input_blocker').style.top = '0px';
                document.getElementById('page_input_blocker').style.left = '0px';
                document.getElementById('page_input_blocker').style.width = '0px';
                document.getElementById('page_input_blocker').style.height = '0px';
                document.getElementById('page_input_blocker').style.border = '1px solid #cccccc';
                document.getElementById('page_input_blocker').style.backgroundColor = 'rgba(63, 63, 63, .5)';
                document.getElementById('page_input_blocker').style.textAlign = 'left';
                document.getElementById('page_input_blocker').style.verticalAlign = 'middle';
                document.getElementById('page_input_blocker').style.color = '#000000';
                document.getElementById('page_input_blocker').style.fontSize = '16pt';
                document.getElementById('page_input_blocker').style.fontWeight = 'bold';

                document.getElementById('page_input_blocker_message').style.position = 'relative';
                document.getElementById('page_input_blocker_message').style.top = parseInt(window.innerHeight / 2) + 'px';
                document.getElementById('page_input_blocker_message').style.left = (parseInt(window.innerWidth / 2) - 100) + 'px';
                document.getElementById('page_input_blocker_message').innerHTML = '';
            }
        }


        function respondAjaxCall(ajax_call_handler_index, respond_type, data, respond_method_name) {
            var data_in_string = data;
            var data_in_json;
            var blank_data_in_json = {};
            var respond_function_call = '';

            switch (respond_type) {
                case 'success':
                    if (eval("(" + data + ")")) {
                        data_in_json = eval("(" + data + ")");
                        var respond_function_call = respond_method_name + "(data_in_json)";

                        if (data_in_json['error'] != 'null') {
                            document.getElementById('page_input_blocker_message').innerHTML = ajax_call_message_error;
                            window.setTimeout(
                                function() {
                                    unblockPageInputAfterAjaxCall(ajax_call_handler_index)
                                }, 
                                ajax_call_message_display_time_in_seconds
                            );
                        } else {
                            unblockPageInputAfterAjaxCall(ajax_call_handler_index);
                        }
                    } else {
                        var respond_function_call = respond_method_name + "(data_in_string)";
                        unblockPageInputAfterAjaxCall(ajax_call_handler_index);
                    }

                    eval("(" + respond_function_call + ")");
                    break;
                case 'abort':
                    var respond_function_call = respond_method_name + "(blank_data_in_json)";

                    eval("(" + respond_function_call + ")");
                    break;
            }
        }


        function requestAjaxCall(url, data, respond_method_name) {
            var ajax_call_handler_new_index = ajax_call_handler.length;
            var temp_text1 = '';
            var temp_text2 = '';
            var data_in_text = '';

            initPageInputBlocker();

            ajax_call_handler[ajax_call_handler_new_index] = new XMLHttpRequest();
            ajax_call_handler[ajax_call_handler_new_index].onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    respondAjaxCall(ajax_call_handler_new_index, 'success', this.responseText, respond_method_name);
                } else if (this.readyState == 4 && this.status == 0) {
                    respondAjaxCall(ajax_call_handler_new_index, 'abort', '', respond_method_name);
                }
            }
            ajax_call_handler[ajax_call_handler_new_index].open('POST', url, true);
            ajax_call_handler[ajax_call_handler_new_index].setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            temp_text1 = JSON.stringify(data);
            temp_text2 = temp_text1.replace('&', '[AMPERSAND]');
            data_in_text = temp_text2;
            ajax_call_handler[ajax_call_handler_new_index].send('api_data=' + data_in_text);

            ajax_call_timer[ajax_call_handler_new_index] = window.setTimeout(
                function() {
                    resumePageInputWhenAjaxCallFailed(ajax_call_handler_new_index)
                }, 
                ajax_call_max_wait_time_in_seconds
            );

            blockPageInputWhileAjaxCall();
        }


        var ajax_call_handler = [];
        var ajax_call_timer = [];
        var ajax_call_state = '';
        var ajax_call_max_wait_time_in_seconds = 60000;
        var ajax_call_message_display_time_in_seconds = 5000;
        var ajax_call_message_active = 'L o a d i n g . . .';
        var ajax_call_message_time_out = 'Connection time out.<br /><br />Please try again later.';
        var ajax_call_message_error = 'Operation failed.<br /><br />Please try again later,<br />or contact the administrator.';
