<?php
$html_template_table_sales_target = '
<table id="tblSalesTarget" class="update-table" style="width:50%; display:inline-block;vertical-align: top; font-size:12px; text-align:center;">
	<tr>
		<th>Month</th>
		<th>Target</th>
		<th width="100">Sales This Year</th>
		<th>Monthly Excess/Difference</th>
		<th>YTD Excess/Difference</th>
	</tr>
	<!-- html_template_data_row_section -->
	<!-- html_template_data_row_begin -->
	<tr>
		<td>[SALES_MONTH_NAME]</td>
		<td>[TARGET_SALES_AMOUNT]</td>
		<td>[SALES_AMOUNT]</td>
		<td>[SALES_PERFORMANCE_MONTHLY_DIFF]</td>
		<td>[SALES_PERFORMANCE_YTD_DIFF]</td>
	</tr>
	<!-- html_template_data_row_end -->
	<tr>
		<td><b>Total</b></td>
		<td><b>[GRAND_TOTAL_TARGET_SALES_AMOUNT]</b></td>
		<td><b>[GRAND_TOTAL_SALES_AMOUNT]</b></td>
		<td></td>
		<td></td>
	</tr>
</table>
';


$html_template_table_sales_activity = '
<ul class="list-table kpi-table" style="margin:0 0; width:[TARGET_WIDTH]; display:inline-block;vertical-align: top; font-size:12px; padding-right: 1%;">
	<li class="li-header">
		<span style=>Month</span>
		<span>Enquiry</span>
		<span>Quote</span>
		<span>Contract</span>
		<span>% Enquiry To Quote</span>
		<span>% Quote To Contract</span>
		<span>% Enquiry to Contract</span>
	</li>
	<!-- html_template_data_row_section -->
	<!-- html_template_data_row_begin -->
	<li class="_li-row-clickable">
		<span>[SALES_MONTH_NAME]</span>
		<span>[ENQUIRIES]</span>
		<span>[QUOTES]</span>
		<span>[CONTRACTS]</span>
		<span>[ENQUIRY_TO_QUOTE]</span>
		<span>[QUOTE_TO_CONTRACT]</span>
		<span>[ENQUIRY_TO_CONTRACT]</span>
	</li>
	<!-- html_template_data_row_end -->
	<li class="li-header" style="border:none;" >
		<span>Total</span>
		<span>[GRAND_TOTAL_ENQUIRIES]</span>
		<span>[GRAND_TOTAL_QUOTES]</span>
		<span>[GRAND_TOTAL_CONTRACTS]</span>
		<span>[GRAND_TOTAL_ENQUIRY_TO_QUOTE]</span>
		<span>[GRAND_TOTAL_QUOTE_TO_CONTRACTS]</span>
		<span>[GRAND_TOTAL_ENQUIRY_TO_CONTRACTS]</span>
	</li>
	<li></li>
</ul>
';


$html_template_table_sales_summary = '
<table id="tblSalesTargetWider" class="update-table" style="width:33%; display:inline-block;vertical-align: top; font-size:12px; text-align:center; margin-left:50px;">
	<tr>
		<th>Month</th>
		<th>Last Year</th>
		<th width="100">This Year</th>
	</tr>
	<!-- html_template_data_row_section -->
	<!-- html_template_data_row_begin -->
	<tr>
		<td>[SALES_MONTH_NAME]</td>
		<td>[SALES_AMOUNT_LAST_YEAR]</td>
		<td>[SALES_AMOUNT_THIS_YEAR]</td>
	</tr>
	<!-- html_template_data_row_end -->
	<tr>
		<td><b>Total</b></td>
		<td><b>[GRAND_TOTAL_SALES_AMOUNT_LAST_YEAR]</b></td>
		<td><b>[GRAND_TOTAL_SALES_AMOUNT_THIS_YEAR]</b></td>
	</tr>
</table>
';


$html_template_table_client_listing = '
<table class="listing-table table-bordered" style="font-size: 10pt;">
	<tr>
		<th width="3%">ID</th>
		<th width="10%">Customer Name</th>
		<th width="12%">Site Address</th>
		<th width="6%">Site Suburb</th>
		<th width="6%">Home Phone</th>
		<th width="6%">Mobile</th>
		<th class="[CONSULTANT_NAME_CSS]" width="10%">Consultant</th>
		<th width="6%">Lead Type</th>
		<th width="6%">Date of Enquiry</th>
		<th width="8%">Appointment Date</th>
		<th width="6%">Quote Value</th>
		<th width="6%">Quote Delivered</th>
		<th width="6%">Follow Up</th>
		<th width="3%">Status</th>
		<th>Note</th>
	</tr>
	<!-- html_template_data_row_section -->
	<!-- html_template_data_row_begin -->
	<tr class="pointer" [TARGET_CLICK_URL_ATTR]>
		<td [TD_STYLE]>[CLIENT_ID]</td>
		<td [TD_STYLE]>[CUSTOMER_NAME]</td>
		<td [TD_STYLE]>[SITE_ADDRESS1]</td>
		<td [TD_STYLE]>[SITE_SUBURB]</td>
		<td [TD_STYLE]>[CUSTOMER_HOME_PHONE]</td>
		<td [TD_STYLE]>[CUSTOMER_MOBILE_PHONE]</td>
		<td [TD_STYLE] class="[CONSULTANT_NAME_CSS]">[CONSULTANT_NAME]</td>
		<td [TD_STYLE]>[LEAD_TYPE]</td>
		<td [TD_STYLE]>[ENQUIRY_DATE]</td>
	    <td [TD_STYLE]>[APPOINTMENT_DATE]</td>
    	<td [TD_STYLE]>[QUOTE_VALUE]</td>
		<td [TD_STYLE]>[QUOTE_DELIVERED]</td>
		<td [TD_STYLE]>[FOLLOW_UP_DATE]</td>
	    <td [TD_STYLE]>[FOLLOW_UP_STATUS]</td>
	    <td [TD_STYLE]>[RECORD_NOTE]</td>
	</tr>
	<!-- html_template_data_row_end -->
</table>
';


$html_template_pdf_client_listing = '
<table border="1" cellpadding="2" BORDERCOLOR="GREY">
    <tr>
        <th width="60" [TD_STYLE]>&nbsp;<b>ID</b></th>
        <th width="120" [TD_STYLE]>&nbsp;<b>Customer Name</b></th>
        <th width="150" [TD_STYLE]>&nbsp;<b>Site Address</b></th>
        <th width="80" [TD_STYLE]>&nbsp;<b>Site Suburb</b></th>
        <th width="80" [TD_STYLE]>&nbsp;<b>Home Phone</b></th>
        <th width="90" [TD_STYLE]>&nbsp;<b>Mobile</b></th>
        <th width="120" [TD_STYLE]>&nbsp;<b>Consultant</b></th>
        <th width="80" [TD_STYLE]>&nbsp;<b>Lead Type</b></th>
        <th width="80" [TD_STYLE]>&nbsp;<b>Enquiry</b></th>
        <th width="80" [TD_STYLE]>&nbsp;<b>Appointment</b></th>
        <th width="80" [TD_STYLE]>&nbsp;<b>Quote Value</b></th>
        <th width="80" [TD_STYLE]>&nbsp;<b>Delivered</b></th>
        <th width="80" [TD_STYLE]>&nbsp;<b>Follow Up</b></th>
        <th width="70" [TD_STYLE]>&nbsp;<b>Status</b></th>
        <th width="200" [TD_STYLE]>&nbsp;<b>Note</b></th>
    </tr>
	<!-- html_template_data_row_section -->
	<!-- html_template_data_row_begin -->
	<tr class="pointer" [TARGET_CLICK_URL_ATTR]>
		<td [TD_STYLE]>[CLIENT_ID]</td>
		<td [TD_STYLE]>[CUSTOMER_NAME]</td>
		<td [TD_STYLE]>[SITE_ADDRESS1]</td>
		<td [TD_STYLE]>[SITE_SUBURB]</td>
		<td [TD_STYLE]>[CUSTOMER_HOME_PHONE]</td>
		<td [TD_STYLE]>[CUSTOMER_MOBILE_PHONE]</td>
		<td [TD_STYLE] class="[CONSULTANT_NAME_CSS]">[CONSULTANT_NAME]</td>
		<td [TD_STYLE]>[LEAD_TYPE]</td>
		<td [TD_STYLE]>[ENQUIRY_DATE]</td>
	    <td [TD_STYLE]>[APPOINTMENT_DATE]</td>
    	<td [TD_STYLE]>[QUOTE_VALUE]</td>
		<td [TD_STYLE]>[QUOTE_DELIVERED]</td>
		<td [TD_STYLE]>[FOLLOW_UP_DATE]</td>
	    <td [TD_STYLE]>[FOLLOW_UP_STATUS]</td>
	    <td [TD_STYLE]>[RECORD_NOTE]</td>
	</tr>
	<!-- html_template_data_row_end -->
</table>
';
?>