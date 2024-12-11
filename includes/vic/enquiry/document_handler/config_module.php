<?php
$config['path']['base_url'] = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . '/';
$config['path']['log_folder'] = 'C:\\xampp\htdocs\\VergolaSA_as_live\\logs\\';
$config['path']['script_url'] = substr($config['path']['base_url'], 0, strlen($config['path']['base_url']) - 1) . $_SERVER['REQUEST_URI'];

$config['path']['base_script_url'] = $config['path']['script_url'];
$temp_array = explode('?', $config['path']['base_script_url']);
if (count($temp_array) == 2) {
    $config['path']['base_script_url'] = $temp_array[0];
}

$config['path']['upload_folder'] = 'C:\\xampp\\htdocs\\VergolaSA_as_live\\images\\document_handler\\upload\\';

$config['server']['current_dev_site'] = 'local';
if (strpos($config['path']['base_url'], 'as-live.vglla.knowledgeplus.net.au:5000') !== false || 
    strpos($config['path']['base_url'], 'as-live.vglsa.knowledgeplus.net.au:5000') !== false ||
    strpos($config['path']['base_url'], 'as-live.vglvic.knowledgeplus.net.au:5000') !== false) {
    $config['server']['current_dev_site'] = 'staging';
} elseif (strpos($config['path']['base_url'], 'vglla.vergola.com:9000') !== false || 
    strpos($config['path']['base_url'], 'vglsa.vergola.com:5000') !== false ||
    strpos($config['path']['base_url'], 'vglvic.vergola.com:3000') !== false) {
    $config['server']['current_dev_site'] = 'live';
}

$config['input_data']['php_input'] = stripslashes(trim(file_get_contents('php://input')));
$config['input_data']['php_input'] = str_replace('{"api_data":"', '', $config['input_data']['php_input']);
$config['input_data']['php_input'] = str_replace('"}"}', '"}', $config['input_data']['php_input']);
$config['input_data']['php_input'] = str_replace('api_data={"', '{"', $config['input_data']['php_input']);
$config['input_data']['request'] = json_encode($_REQUEST);

$config['db']['host_name'] = 'localhost';
$config['db']['db_name'] = 'vergola_quotedb_sa_v1_as_live';
$config['db']['user_name'] = 'root';
$config['db']['password'] = 'pass123';

$config['db']['entity_temp_id'] = '-1';
$config['db']['folder_temp_id'] = '-1';

$config['switch']['log_input_data']['php_input'] = 'off';
$config['switch']['log_input_data']['request'] = 'on';

$config['plugin']['msword']['file_extension'] = 'zip';
$config['plugin']['msword']['file_name'] = 'VGL4W_' . $config['server']['current_dev_site'] . '.zip';
$config['plugin']['msword']['folder'] = 'C:\\xampp\\htdocs\\VergolaSA_as_live\\images\\document_handler\\plugin\\';
$config['plugin']['msword']['usage_message'] = "
NOTE:\n\n
1. This MS-Word add-in is for working with Vergola web services only;\n
2. This add-in will only works if you have either MS-Word 2013 or MS-Word 2016 on your machine;\n
3. If you have previous version of this add-in on your machine, please uninstall it before you start;\n
4. After downloading, go to your download folder and extract its contents and then run setup.exe to start the installation process;\n
5. Please contact the administrator if you encounter any issue while using this.\n
";
$config['plugin']['msoutlook']['file_extension'] = 'zip';
$config['plugin']['msoutlook']['file_name'] = 'VGL4O_' . $config['server']['current_dev_site'] . '.zip';
$config['plugin']['msoutlook']['folder'] = 'C:\\xampp\\htdocs\\VergolaSA_as_live\\images\\document_handler\\plugin\\';
$config['plugin']['msoutlook']['usage_message'] = "
NOTE:\n\n
1. This MS-Outlook add-in is for working with Vergola web services only;\n
2. This add-in will only works if you have either MS-Outlook 2013 or MS-Word 2016 on your machine;\n
3. If you have previous version of this add-in on your machine, please uninstall it before you start;\n
4. After downloading, go to your download folder and extract its contents and then run setup.exe to start the installation process;\n
5. Please contact the administrator if you encounter any issue while using this.\n
";

$config['document_handler']['path']['log_folder'] = $config['path']['log_folder'] . 'document_handler\\';
$config['document_handler']['path']['log_file_name'] = 'document_handler.log';
$config['document_handler']['form']['file_name'] = 'client_form_document_handler.php';

include('config_mime_types.php');
?>