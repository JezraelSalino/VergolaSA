<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>vr_forms_sa</title>
        <meta charset="UTF-8">
        <script src="<?php echo JURI::base().'jscript/vr_forms_sa/functions_general.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo JURI::base().'jscript/vr_forms_sa/functions_general_ajax_call.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo JURI::base().'jscript/vr_forms_sa/functions_module_items_data_entry.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo JURI::base().'jscript/vr_forms_sa/functions_module_items_data_entry_crud.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo JURI::base().'jscript/vr_forms_sa/functions_module_items_data_entry_report.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo JURI::base().'jscript/vr_forms_sa/functions_module_items_data_entry_form_queries.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo JURI::base().'jscript/vr_forms_sa/functions_module_items_data_entry_form_bom.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo JURI::base().'jscript/vr_forms_sa/functions_module_items_data_entry_formulas.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo JURI::base().'jscript/vr_forms_sa/functions_module_items_data_entry_calculations.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo JURI::base().'jscript/vr_forms_sa/functions_module_items_data_entry_calculations_vr.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo JURI::base().'jscript/vr_forms_sa/functions_module_items_data_entry_calculations_vrY.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo JURI::base().'jscript/vr_forms_sa/functions_module_items_data_entry_calculations_vrX.js'; ?>" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo JURI::base().'jscript/vr_forms_sa/style_form_items_data_entry.css'; ?>" />

        <?php
        include 'config_general.php';
        include 'config_module_items_data_entry.php';
        ?>
	</head>
	<body onload="initProgram()">
        <div id="vr_form_intro_table_area">
        </div>

        <div id="bom_form_buttons_area_1" style="display: none;">
            <input type="button" class="bom_form_field_button_1" id="button_contract_details_form_bom_1" name="button_contract_details_form_bom_1" value="Contract Details" onclick="loadContractRelatedPage('contract_details')" />
            <input type="button" class="bom_form_field_button_1" id="button_quote_details_form_bom_1" name="button_quote_details_form_bom_1" value="Quote Details" onclick="loadContractRelatedPage('quote_details')" />
            <input type="button" class="bom_form_field_button_1" id="button_bom_form_bom_1" name="button_bom_form_bom_1" value="BOM" onclick="loadContractRelatedPage('bom')" />
            <input type="button" class="bom_form_field_button_1" id="button_po_form_bom_1" name="button_po_form_bom_1" value="PO" onclick="loadContractRelatedPage('po')" />
            <input type="button" class="bom_form_field_button_1" id="button_po_summary_form_bom_1" name="button_po_summary_form_bom_1" value="PO Summary" onclick="loadContractRelatedPage('po_summary')" />
            <input type="button" class="bom_form_field_button_1" id="button_check_list_form_bom_1" name="button_check_list_form_bom_1" value="Check List" onclick="loadContractRelatedPage('check_list')" />
            <br />
            <br />
        </div>

        <div id="bom_form_queries_table_area" style="display: none;">
            <table class="bom_table_1" id="bom_form_queries_table">
                <tr>
                    <td colspan="5" class="bom_table_body_1">Project Name: <span id="project_name_form_bom"></span>&nbsp;&nbsp;&nbsp;&nbsp;Contract ID: <span id="contract_id_form_bom"></span></td>
                </tr>
                <!--
                <tr>
                    <td class="bom_table_body_1"><select class="bom_form_field_selectbox_1" id="vr_item_ref_name_form_bom" name="vr_item_ref_name_form_bom" onchange=""></select></td>
                    <td class="bom_table_body_1"><input type="text" class="bom_form_field_textbox_1" id="vr_item_qty_form_bom" name="vr_item_qty_form_bom" value="" /></td>
                    <td class="bom_table_body_1"><input type="text" class="bom_form_field_textbox_1" id="vr_item_length_form_bom" name="vr_item_length_form_bom" value="" /></td>
                    <td class="bom_table_body_1"><select class="bom_form_field_selectbox_1" id="vr_default_colour_form_bom" name="vr_default_colour_form_bom" onchange=""></select></td>
                    <td class="bom_table_body_1"><input type="button" class="bom_form_field_button_1" id="button_add_product_form_bom" name="button_add_product_form_bom" value="Add Product" onclick="" /></td>
                </tr>
                -->
            </table>
            <br />
        </div>

        <div id="vr_form_queries_table_area" style="display: none;">
            <table class="vr_table_1" id="vr_form_queries_table">
                <tr>
                    <td class="vr_table_head_3">Framework Type</td>
                    <td class="vr_table_head_3">VR Type</td>
                    <td class="vr_table_head_3">Project Name</td>
                    <td class="vr_table_head_3">Default Colour</td>
                </tr>
                <tr>
                    <td class="vr_table_body_3"><select class="vr_form_field_selectbox_2" id="vr_framework_type_form_query" name="vr_framework_type_form_query" onchange="processVrFrameworkTypeFormQueries(1)"></select></td>
                    <td class="vr_table_body_3"><select class="vr_form_field_selectbox_2" id="vr_type_form_query" name="vr_type_form_query" onchange="processVrDimensionFormQueries(1)"></select></td>
                    <td class="vr_table_body_3"><input type="text" class="vr_form_field_textbox_1" id="vr_project_name_form_query" name="vr_project_name_form_query" value="" /></td>
                    <td class="vr_table_body_3"><select class="vr_form_field_selectbox_2" id="vr_default_colour_form_query" name="vr_default_colour_form_query" onchange="setVrFormItemsDataEntryColourByDefaultValue()"></select></td>
                </tr>
            </table>
            <br />
        </div>

        <div id="vr_form_queries_button_area_1" style="display: none;">
            <input type="button" class="vr_form_field_button_1" id="button_cancel_vr_form_items_data_entry" name="button_cancel_vr_form_items_data_entry" value="Cancel" onclick="cancelVrFormData()" />
            <br />
            <br />
        </div>
        <div id="vr_form_queries_button_area_21" style="display: none;">
            <input type="button" class="vr_form_field_button_1" id="button_save_vr_form_items_data_entry" name="button_save_vr_form_items_data_entry" value="Save" onclick="saveVrFormData('')" />
            <input type="button" class="vr_form_field_button_1" id="button_save_and_exit_vr_form_items_data_entry" name="button_save_and_exit_vr_form_items_data_entry" value="Save & Close" onclick="saveVrFormData('save_and_exit')" />
            <input type="button" class="vr_form_field_button_1" id="button_cancel_vr_form_items_data_entry" name="button_cancel_vr_form_items_data_entry" value="Cancel" onclick="cancelVrFormData()" />
            <br />
            <br />
        </div>
        <div id="vr_form_queries_button_area_31" style="display: none;">
            <input type="button" class="vr_form_field_button_1" id="button_save_vr_form_items_data_entry" name="button_save_vr_form_items_data_entry" value="Save" onclick="saveVrFormData('')" />
            <input type="button" class="vr_form_field_button_1" id="button_save_and_exit_vr_form_items_data_entry" name="button_save_and_exit_vr_form_items_data_entry" value="Save & Close" onclick="saveVrFormData('save_and_exit')" />
            <input type="button" class="vr_form_field_button_1" id="button_cancel_vr_form_items_data_entry" name="button_cancel_vr_form_items_data_entry" value="Cancel" onclick="cancelVrFormData()" />
            <input type="button" class="vr_form_field_button_1" id="button_delete_vr_form_items_data_entry" name="button_delete_vr_form_items_data_entry" value="Delete" onclick="deleteVrFormData()" />
            <input type="button" class="vr_form_field_button_1" id="button_download_vr_form_items_data_entry" name="button_download_vr_form_items_data_entry" value="Download PDF" onclick="downloadVrFormData()" />
            <input type="button" class="vr_form_field_button_1" id="button_duplicate_vr_form_items_data_entry" name="button_duplicate_vr_form_items_data_entry" value="Duplicate" onclick="saveVrFormData('duplicate')" />
            <br />
            <br />
        </div>
        <div id="vr_form_queries_button_area_41" style="display: none;">
            <input type="button" class="vr_form_field_button_1" id="button_download_vr_form_items_data_entry" name="button_download_vr_form_items_data_entry" value="Download PDF" onclick="downloadVrFormData()" />
            <br />
            <br />
        </div>

        <div id="vr_form_items_data_entry_table_area">
            <table class="vr_table_2" id="vr_form_items_data_entry_table"></table>
            <br />
            <br />
        </div>

        <div id="vr_form_billing_table_area" style="display: none;">
            <table class="vr_table_1" id="vr_form_billing_table">
                <tr>
                    <td class="vr_table_body_3 vr_form_sub_table_1">
                        <table class="vr_table_1" id="vr_form_commission_table">
                            <tr>
                                <td colspan="3" class="vr_table_head_1">Commission</td>
                            </tr>
                            <tr>
                                <td class="vr_table_body_1 vr_form_field_name_1">Sales Commission</td>
                                <td class="vr_table_body_1 vr_form_field_name_2">$</td>
                                <td class="vr_table_body_1"><input type="text" class="vr_form_field_textbox_1" id="vr_commission_sales_commission_form_billing" name="vr_commission_sales_commission_form_billing" value="" /></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="vr_table_head_1"><br />Sales Commission Payment Schedule</td>
                            </tr>
                            <tr>
                                <td class="vr_table_body_1 vr_form_field_name_1">Pay 1</td>
                                <td class="vr_table_body_1 vr_form_field_name_2">$</td>
                                <td class="vr_table_body_1"><input type="text" class="vr_form_field_textbox_1" id="vr_commission_pay1_form_billing" name="vr_commission_pay1_form_billing" value="" /></td>
                            </tr>
                            <tr>
                                <td class="vr_table_body_1 vr_form_field_name_1">Pay 2</td>
                                <td class="vr_table_body_1 vr_form_field_name_2">$</td>
                                <td class="vr_table_body_1"><input type="text" class="vr_form_field_textbox_1" id="vr_commission_pay2_form_billing" name="vr_commission_pay2_form_billing" value="" /></td>
                            </tr>
                            <tr>
                                <td class="vr_table_body_1 vr_form_field_name_1">Final</td>
                                <td class="vr_table_body_1 vr_form_field_name_2">$</td>
                                <td class="vr_table_body_1"><input type="text" class="vr_form_field_textbox_1" id="vr_commission_final_form_billing" name="vr_commission_final_form_billing" value="" /></td>
                            </tr>
                            <tr>
                                <td class="vr_table_body_1 vr_form_field_name_1">Installer Payment</td>
                                <td class="vr_table_body_1 vr_form_field_name_2">$</td>
                                <td class="vr_table_body_1"><input type="text" class="vr_form_field_textbox_1" id="vr_commission_installer_payment_form_billing" name="vr_commission_installer_payment_form_billing" value="" /></td>
                            </tr>
                        </table>
                    </td>
                    <td class="vr_table_body_3 vr_form_sub_table_1">
                        <table class="vr_table_1" id="vr_form_payment_table">
                            <tr>
                                <td colspan="3" class="vr_table_head_1">Payment</td>
                            </tr>
                            <tr>
                                <td class="vr_table_body_1 vr_form_field_name_1">Deposit</td>
                                <td class="vr_table_body_1 vr_form_field_name_2">$</td>
                                <td class="vr_table_body_1"><input type="text" class="vr_form_field_textbox_1" id="vr_payment_deposit_form_billing" name="vr_payment_deposit_form_billing" value="" /></td>
                            </tr>
                            <tr>
                                <td class="vr_table_body_1 vr_form_field_name_1">Progress Payment</td>
                                <td class="vr_table_body_1 vr_form_field_name_2">$</td>
                                <td class="vr_table_body_1"><input type="text" class="vr_form_field_textbox_1" id="vr_payment_progress_payment_form_billing" name="vr_payment_progress_payment_form_billing" value="" /></td>
                            </tr>
                            <tr>
                                <td class="vr_table_body_1 vr_form_field_name_1">Final Payment</td>
                                <td class="vr_table_body_1 vr_form_field_name_2">$</td>
                                <td class="vr_table_body_1"><input type="text" class="vr_form_field_textbox_1" id="vr_payment_final_payment_form_billing" name="vr_payment_final_payment_form_billing" value="" /></td>
                            </tr>
                        </table>
                    </td>
                    <td class="vr_table_body_3 vr_form_sub_table_1">
                        <table class="vr_table_1" id="vr_form_payment_table">
                            <tr>
                                <td colspan="3" class="vr_table_head_1">Total</td>
                            </tr>
                            <tr>
                                <td class="vr_table_body_1 vr_form_field_name_1">Vergola</td>
                                <td class="vr_table_body_1 vr_form_field_name_2">$</td>
                                <td class="vr_table_body_1">
                                    <input type="text" class="vr_form_field_textbox_1" id="vr_payment_vergola_form_billing" name="vr_payment_vergola_form_billing" value="" />
                                    <input type="hidden" id="vr_payment_vr_items_rrp_form_billing" name="vr_payment_vr_items_rrp_form_billing" value="" />
                                </td>
                            </tr>
                            <tr>
                                <td class="vr_table_body_1 vr_form_field_name_1">Disbursement Sub Total</td>
                                <td class="vr_table_body_1 vr_form_field_name_2">$</td>
                                <td class="vr_table_body_1"><input type="text" class="vr_form_field_textbox_1" id="vr_payment_disbursement_sub_total_form_billing" name="vr_payment_disbursement_sub_total_form_billing" value="" /></td>
                            </tr>
                            <tr>
                                <td class="vr_table_body_1 vr_form_field_name_1">Sub Total</td>
                                <td class="vr_table_body_1 vr_form_field_name_2">$</td>
                                <td class="vr_table_body_1"><input type="text" class="vr_form_field_textbox_1" id="vr_payment_sub_total_form_billing" name="vr_payment_sub_total_form_billing" value="" /></td>
                            </tr>
                            <tr>
                                <td class="vr_table_body_1 vr_form_field_name_1"></td>
                                <td class="vr_table_body_1 vr_form_field_name_2">$</td>
                                <td class="vr_table_body_1"><input type="text" class="vr_form_field_textbox_1" id="vr_payment_tax_form_billing" name="vr_payment_tax_form_billing" value="" onchange="adjustPaymentTaxManually()"/></td>
                            </tr>
                            <tr>
                                <td class="vr_table_body_1 vr_form_field_name_1">Total</td>
                                <td class="vr_table_body_1 vr_form_field_name_2">$</td>
                                <td class="vr_table_body_1"><input type="text" class="vr_form_field_textbox_1" id="vr_payment_total_form_billing" name="vr_payment_total_form_billing" value="" /></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <br />
            <br />
        </div>

        <div id="vr_form_queries_button_area_22" style="display: none;">
            <input type="button" class="vr_form_field_button_1" id="button_save_vr_form_items_data_entry" name="button_save_vr_form_items_data_entry" value="Save" onclick="saveVrFormData('')" />
            <input type="button" class="vr_form_field_button_1" id="button_save_and_exit_vr_form_items_data_entry" name="button_save_and_exit_vr_form_items_data_entry" value="Save & Close" onclick="saveVrFormData('save_and_exit')" />
            <input type="button" class="vr_form_field_button_1" id="button_cancel_vr_form_items_data_entry" name="button_cancel_vr_form_items_data_entry" value="Cancel" onclick="cancelVrFormData()" />
            <br />
            <br />
        </div>
        <div id="vr_form_queries_button_area_32" style="display: none;">
            <input type="button" class="vr_form_field_button_1" id="button_save_vr_form_items_data_entry" name="button_save_vr_form_items_data_entry" value="Save" onclick="saveVrFormData('')" />
            <input type="button" class="vr_form_field_button_1" id="button_save_and_exit_vr_form_items_data_entry" name="button_save_and_exit_vr_form_items_data_entry" value="Save & Close" onclick="saveVrFormData('save_and_exit')" />
            <input type="button" class="vr_form_field_button_1" id="button_cancel_vr_form_items_data_entry" name="button_cancel_vr_form_items_data_entry" value="Cancel" onclick="cancelVrFormData()" />
            <input type="button" class="vr_form_field_button_1" id="button_delete_vr_form_items_data_entry" name="button_delete_vr_form_items_data_entry" value="Delete" onclick="deleteVrFormData()" />
            <input type="button" class="vr_form_field_button_1" id="button_download_vr_form_items_data_entry" name="button_download_vr_form_items_data_entry" value="Download PDF" onclick="downloadVrFormData()" />
            <input type="button" class="vr_form_field_button_1" id="button_duplicate_vr_form_items_data_entry" name="button_duplicate_vr_form_items_data_entry" value="Duplicate" onclick="saveVrFormData('duplicate')" />
            <br />
            <br />
        </div>
        <div id="vr_form_queries_button_area_42" style="display: none;">
            <input type="button" class="vr_form_field_button_1" id="button_download_vr_form_items_data_entry" name="button_download_vr_form_items_data_entry" value="Download PDF" onclick="downloadVrFormData()" />
            <br />
            <br />
        </div>

        <div id="bom_form_buttons_area_2" style="display: none;">
            <input type="button" class="bom_form_field_button_1" id="button_contract_details_form_bom_2" name="button_contract_details_form_bom_2" value="Contract Details" onclick="loadContractRelatedPage('contract_details')" />
            <input type="button" class="bom_form_field_button_1" id="button_quote_details_form_bom_2" name="button_quote_details_form_bom_2" value="Quote Details" onclick="loadContractRelatedPage('quote_details')" />
            <input type="button" class="bom_form_field_button_1" id="button_bom_form_bom_2" name="button_bom_form_bom_2" value="BOM" onclick="loadContractRelatedPage('bom')" />
            <input type="button" class="bom_form_field_button_1" id="button_po_form_bom_2" name="button_po_form_bom_2" value="PO" onclick="loadContractRelatedPage('po')" />
            <input type="button" class="bom_form_field_button_1" id="button_po_summary_form_bom_2" name="button_po_summary_form_bom_2" value="PO Summary" onclick="loadContractRelatedPage('po_summary')" />
            <input type="button" class="bom_form_field_button_1" id="button_check_list_form_bom_2" name="button_check_list_form_bom_2" value="Check List" onclick="loadContractRelatedPage('check_list')" />
            <br />
            <br />
        </div>

        <div id="bom_form_item_dimension_data_entry_table_area" style="display: none;">
            <table class="bom_table_1 bom_form_item_dimension_data_entry_table" id="bom_form_item_dimension_data_entry_table">
                <tr>
                    <td class="bom_table_head_1 bom_table_image_side_1">
                        <img class="bom_form_field_image_2" id="item_image_form_bom" src="" />
                    </td>
                    <td class="bom_table_head_2 bom_table_dimension_side_1">
                        <table class="bom_table_1" id="bom_form_item_dimension_data_entry_table">
                            <tr>
                                <td colspan="2" class="bom_table_head_1"><span id="item_dimension_title_form_bom"></span></td>
                            <tr>
                            <tr>
                                <td colspan="2" class="bom_table_head_1">Dimensions in mm</td>
                            <tr>
                            <tr>
                                <td class="bom_table_head_1">A:</td>
                                <td class="bom_table_head_1">
                                    <input type="text" class="vr_form_field_textbox_mm_1" id="item_dimension_a_mm_form_bom" name="item_dimension_a_mm_form_bom" placeholder="mm" value="" onchange="calculateBomFormGirthValues()" />
                                </td>
                            <tr>
                            <tr>
                                <td class="bom_table_head_1">B:</td>
                                <td class="bom_table_head_1">
                                    <input type="text" class="vr_form_field_textbox_mm_1" id="item_dimension_b_mm_form_bom" name="item_dimension_b_mm_form_bom" placeholder="mm" value="" onchange="calculateBomFormGirthValues()" />
                                </td>
                            <tr>
                            <tr>
                                <td class="bom_table_head_1">C:</td>
                                <td class="bom_table_head_1">
                                    <input type="text" class="vr_form_field_textbox_mm_1" id="item_dimension_c_mm_form_bom" name="item_dimension_c_mm_form_bom" placeholder="mm" value="" onchange="calculateBomFormGirthValues()" />
                                </td>
                            <tr>
                            <tr>
                                <td class="bom_table_head_1">D:</td>
                                <td class="bom_table_head_1">
                                    <input type="text" class="vr_form_field_textbox_mm_1" id="item_dimension_d_mm_form_bom" name="item_dimension_d_mm_form_bom" placeholder="mm" value="" onchange="calculateBomFormGirthValues()" />
                                </td>
                            <tr>
                            <tr>
                                <td class="bom_table_head_1">E:</td>
                                <td class="bom_table_head_1">
                                    <input type="text" class="vr_form_field_textbox_mm_1" id="item_dimension_e_mm_form_bom" name="item_dimension_e_mm_form_bom" placeholder="mm" value="" onchange="calculateBomFormGirthValues()" />
                                </td>
                            <tr>
                            <tr>
                                <td class="bom_table_head_1">F:</td>
                                <td class="bom_table_head_1">
                                    <input type="text" class="vr_form_field_textbox_mm_1" id="item_dimension_f_mm_form_bom" name="item_dimension_f_mm_form_bom" placeholder="mm" value="" onchange="calculateBomFormGirthValues()" />
                                </td>
                            <tr>
                            <tr>
                                <td class="bom_table_head_1">G:</td>
                                <td class="bom_table_head_1">
                                    <input type="text" class="vr_form_field_textbox_mm_1" id="item_dimension_g_mm_form_bom" name="item_dimension_g_mm_form_bom" placeholder="mm" value="" onchange="calculateBomFormGirthValues()" />
                                </td>
                            <tr>
                            <tr>
                                <td class="bom_table_head_1">H:</td>
                                <td class="bom_table_head_1">
                                    <input type="text" class="vr_form_field_textbox_mm_1" id="item_dimension_h_mm_form_bom" name="item_dimension_h_mm_form_bom" placeholder="mm" value="" onchange="calculateBomFormGirthValues()" />
                                </td>
                            <tr>                                
                            <tr>                                
                                <td class="bom_table_head_1">P:</td>
                                <td class="bom_table_head_1">
                                    <input type="text" class="vr_form_field_textbox_mm_1" id="item_dimension_p_mm_form_bom" name="item_dimension_p_mm_form_bom" placeholder="mm" value="" onchange="calculateBomFormGirthValues()" />
                                </td>
                            <tr>
                            <tr>
                                <td class="bom_table_head_1">Girth:</td>
                                <td class="bom_table_head_1">
                                    <div id="item_dimension_length_info_form_bom_area" style="display: none;">
                                        <input type="text" class="vr_form_field_textbox_meter_1" id="item_dimension_length_meter_form_bom" name="item_dimension_length_meter_form_bom" placeholder="Meter" value="" />
                                    </div>
                                    <br />
                                    <br />
                                    <div id="item_dimension_girth_side_a_info_form_bom_area" style="display: inline-block;">
                                        Side A:&nbsp;
                                        <input type="text" class="vr_form_field_textbox_mm_1" id="item_dimension_girth_side_a_mm_form_bom" name="item_dimension_girth_side_a_mm_form_bom" placeholder="mm" value="" />
                                        <span class="bom_form_field_text_1" id="item_dimension_girth_side_a_sum_method_form_bom_area"></span>
                                    </div>
                                    <div id="item_dimension_girth_side_b_info_form_bom_area" style="display: inline-block;">
                                        Side B:&nbsp;
                                        <input type="text" class="vr_form_field_textbox_mm_1" id="item_dimension_girth_side_b_mm_form_bom" name="item_dimension_girth_side_b_mm_form_bom" placeholder="mm" value="" />
                                        <span class="bom_form_field_text_1" id="item_dimension_girth_side_b_sum_method_form_bom_area"></span>
                                    </div>
                                </td>
                            <tr>
                        </table>
                        <div id="bom_form_item_dimension_button_area" style="display: none;">
                            <br />
                            <br />
                            <input type="hidden" id="item_dimension_record_index_form_bom" name="item_dimension_record_index_form_bom" value="" />
                            <input type="button" class="bom_form_field_button_1" id="button_save_item_dimension_popup_form_bom_1" name="button_save_item_dimension_popup_form_bom_1" value="Save" onclick="saveBomFormItemDimensionData()" />
                            <input type="button" class="bom_form_field_button_1" id="button_close_item_dimension_popup_form_bom_1" name="button_close_item_dimension_popup_form_bom_1" value="Close" onclick="hideBomFormItemDimensionPopup()" />
                        </div>
                    </td>
                </tr>
                <!--
                <tr>
                    <td class="bom_table_head_2">
                    </td>
                    <td class="bom_table_head_2">
                    </td>
                </tr>
                -->
            </table>
        </div>
        <div id="vr_form_log_area" style="display: none;"></div>
	</body>
</html>
