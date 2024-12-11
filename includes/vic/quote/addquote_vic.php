<?php
include 'includes/vic/custom_processes_user.php';

$current_signed_in_user_access_profiles = $custom_configs_user['user_access_profiles'][$current_signed_in_user_group_key]['add-quote-vic'];
if (isset($_GET['page_name']) && $_GET['page_name'] == 'quote_edit') {
    $current_signed_in_user_access_profiles = $custom_configs_user['user_access_profiles'][$current_signed_in_user_group_key]['add-quote-vic > quote_edit'];
} elseif (isset($_GET['page_name']) && $_GET['page_name'] == 'quote_details') {
    $current_signed_in_user_access_profiles = $custom_configs_user['user_access_profiles'][$current_signed_in_user_group_key]['add-quote-vic > contract_bom'];
} elseif (isset($_GET['page_name']) && $_GET['page_name'] == 'contract_bom') {
    $current_signed_in_user_access_profiles = $custom_configs_user['user_access_profiles'][$current_signed_in_user_group_key]['add-quote-vic > contract_bom'];
}
?>


<?php
include 'vr_forms_sa/main.php';
?>
