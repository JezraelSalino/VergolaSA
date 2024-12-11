<?php
/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- configurations -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$config = array(
    'vergola_server' => array(
        'la' => array(
            'local' => array(
                array('name' => 'la.vergola.com', 'port' => '80'), 
                array('name' => 'as-live.la.vergola.com', 'port' => '80')
            ), 
            'preproduction' => array(
                array('ip' => '192.168.0.5'), 
                array('name' => 'vglla.knowledgeplus.net.au', 'port' => '5000'), 
                array('name' => 'as-live.vglla.knowledgeplus.net.au', 'port' => '5000')
            ), 
            'live' => array(
                array('ip' => '192.168.0.14'), 
                array('name' => 'vglla.vergola.com'), 
                array('name' => 'vglla.vergola.com', 'port' => '9000') 
            ) 
        ), 
        'sa' => array(
            'local' => array(
                array('name' => 'sa.vergola.com', 'port' => '80'), 
                array('name' => 'as-live.sa.vergola.com', 'port' => '80')
            ), 
            'preproduction' => array(
                array('ip' => '192.168.0.5'), 
                array('name' => 'vglsa.knowledgeplus.net.au', 'port' => '5000'), 
                array('name' => 'as-live.vglsa.knowledgeplus.net.au', 'port' => '5000')
            ), 
            'live' => array(
                array('ip' => '192.168.0.7'), 
                array('name' => 'vglsa.vergola.com'), 
                array('name' => 'vglsa.vergola.com', 'port' => '5000') 
            ) 
        ), 
        'vic' => array(
            'local' => array(
                array('name' => 'victoria.vergola.com', 'port' => '80'), 
                array('name' => 'as-live.victoria.vergola.com', 'port' => '80') 
            ), 
            'preproduction' => array(
                array('ip' => '192.168.0.5'), 
                array('name' => 'vglvic.knowledgeplus.net.au', 'port' => '5000'), 
                array('name' => 'as-live.vglvic.knowledgeplus.net.au', 'port' => '5000')
            ), 
            'live' => array(
                array('ip' => '192.168.0.12'), 
                array('name' => 'vglvic.vergola.com'), 
                array('name' => 'vglvic.vergola.com', 'port' => '3000') 
            ) 
        )
    ), 
    'path' => array(
        'app_folder' => '', 
        'log_folder' => '', 
        'log_file_name' => array(
            'agent_summary_daily_sales_info' => 'agent_summary_daily_sales_info.log', 
            'agent_summary_daily_sales_info_temp' => 'agent_summary_daily_sales_info_temp.log' 
        )
    ), 
    'db' => array(
        'host_name' => '', 
        'db_name' => '', 
        'user_name' => '', 
        'password' => '', 
        'enable_create_table' => false 
    ), 
    'date_time' => array(
        'project_begin_date' => '2015-01-01', 
        'current_date' => date('Y-m-d'), 
        'current_date_time' => date('Y-m-d H:i:s'), 
        'next_year_end_date' => addDateTime(date('Y-m-d'), 'Y', 'year', 1) . '-12-31' 
    ), 
    'interval' => array(
        'db_transaction' => array(
            'very_fast' => 0, 
            'fast' => 1, 
            'normal' => 5, 
            'slow' => 10, 
            'very_slow' => 15 
        ), 
        'update_schedule' => 3600
    ), 
    'access_method' => '', 
    'input_data' => array() 
);


// --- get access info to determine processing condition --- //
if (isset($_SERVER['SERVER_NAME'])) {
    // --- when http call --- //
    $config['access_method'] = 'http';

    $is_server_mode_local = false;
    $server_mode_local_region_name = '';
    foreach ($config['vergola_server'] as $region_name => $server_info) {
        foreach ($server_info as $server_mode_name => $reference_info) {
            foreach ($reference_info as $ref_key => $ref_values) {
                if (strtolower($_SERVER['SERVER_NAME']) == strtolower($ref_values['name'])) {
                    if ($server_mode_name == 'local') {
                        $is_server_mode_local = true;
                        $server_mode_local_region_name = $region_name;
                    }
                }
            }
        }
    }

    if ($is_server_mode_local == true) {
        $input_data['server_mode'] = 'local';
        $input_data['vergola_region'] = $server_mode_local_region_name;
    } else {
        $server_config_info_found = false;
        foreach ($config['vergola_server'] as $region_name => $server_info) {
            foreach ($server_info as $server_mode_name => $reference_info) {
                foreach ($reference_info as $ref_key => $ref_values) {
                    if (isset($ref_values['name']) && isset($ref_values['port'])) {
                        if ($ref_values['name'] == strtolower($_SERVER['SERVER_NAME']) && $ref_values['port'] == $_SERVER['SERVER_PORT']) {
                            $server_config_info_found = true;
                        }
                    }
                    if (isset($ref_values['name']) && !isset($ref_values['port'])) {
                        if ($ref_values['name'] == strtolower($_SERVER['SERVER_NAME'])) {
                            $server_config_info_found = true;
                        }
                    }
                    if (isset($ref_values['ip'])) {
                        if ($ref_values['ip'] == $_SERVER['SERVER_ADDR']) {
                            $server_config_info_found = true;
                        }
                    }
                    if ($server_config_info_found) {
                        $input_data['server_mode'] = $server_mode_name;
                        $input_data['vergola_region'] = $region_name;
                        break(3);
                    }
                }
            }
        }
    }
} else {
    // --- when cli call --- //
    $config['access_method'] = 'cli';
    $input_data = '{}';
    if (isset($_SERVER['argv'][1]) && 
        strpos($_SERVER['argv'][1], 'data=') !== false) {
        list($param_name, $input_data) = explode('=', $_SERVER['argv'][1]);
    }
    $input_data = json_decode($input_data, true);
}
if (is_array($input_data)) {
    $config['input_data'] = $input_data;
}
if (!(isset($input_data['server_mode']) && isset($input_data['vergola_region']))) {
    echo "\n";
    echo "\n";
    echo 'Missing server/region info. Program aborted.';
    echo "\n";
    echo "\n";
    exit;
}


// --- get script folder info --- //
$script_file_path = $_SERVER['SCRIPT_FILENAME'];
$is_windows_server = false;
if (substr(strtolower($script_file_path), 0, 1) == 'c') {
    $is_windows_server = true;
}
if ($is_windows_server) {
    $script_file_path = str_replace('\\', '/', $script_file_path);
}
$script_folders = explode('/', $script_file_path);
$script_root_folder_total_level = 4;
$script_root_folder_path = '';
foreach ($script_folders as $key1 => $value1) {
    if (intval($key1) < $script_root_folder_total_level) {
        $script_root_folder_path .= $value1 . '/';
    }
}
if ($is_windows_server) {
    $script_root_folder_path = str_replace('/', '\\', $script_root_folder_path);
}
$config['path']['app_folder'] = $script_root_folder_path;


// --- get general configuration info from external system configuration file --- //
$system_config_file_path = $config['path']['app_folder'] . 'configuration.php';
if (file_exists($system_config_file_path)) {
    if ($config['access_method'] == 'cli') {
        include($system_config_file_path);
    }
    $system_config = new JConfig();
    $config['db']['host_name'] = $system_config->host;
    $config['db']['db_name'] = $system_config->db;
    $config['db']['user_name'] = $system_config->user;
    $config['db']['password'] = $system_config->password;
    $config['path']['log_folder'] = $system_config->log_path . '\\';
} else {
    echo "\n";
    echo "\n";
    echo 'Missing configuration info. Program aborted.';
    echo "\n";
    echo "\n";
    exit;
}
?>