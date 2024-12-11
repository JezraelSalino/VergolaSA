<div class="dragable" id="cfaction_tcpdf">HTML to PDF</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_tcpdf_element">
	<label class="action_label" style="display: block; float:none!important;">HTML to PDF</label>
	<textarea name="chronoaction[{n}][action_tcpdf_{n}_content1]" id="action_tcpdf_{n}_content1" style="display:none"><?php echo $action_params['content1']; ?></textarea>
    <input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_mode]" id="action_tcpdf_{n}_mode" value="<?php echo $action_params['mode']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_pdf_author]" id="action_tcpdf_{n}_pdf_author" value="<?php echo $action_params['pdf_author']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_pdf_title]" id="action_tcpdf_{n}_pdf_title" value="<?php echo $action_params['pdf_title']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_pdf_subject]" id="action_tcpdf_{n}_pdf_subject" value="<?php echo $action_params['pdf_subject']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_pdf_keywords]" id="action_tcpdf_{n}_pdf_keywords" value="<?php echo $action_params['pdf_keywords']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_pdf_file_name]" id="action_tcpdf_{n}_pdf_file_name" value="<?php echo $action_params['pdf_file_name']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_pdf_view]" id="action_tcpdf_{n}_pdf_view" value="<?php echo $action_params['pdf_view']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_pdf_save_path]" id="action_tcpdf_{n}_pdf_save_path" value="<?php echo $action_params['pdf_save_path']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_pdf_post_name]" id="action_tcpdf_{n}_pdf_post_name" value="<?php echo $action_params['pdf_post_name']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_pdf_page_orientation]" id="action_tcpdf_{n}_pdf_page_orientation" value="<?php echo $action_params['pdf_page_orientation']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_pdf_page_format]" id="action_tcpdf_{n}_pdf_page_format" value="<?php echo $action_params['pdf_page_format']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_pdf_header]" id="action_tcpdf_{n}_pdf_header" value="<?php echo $action_params['pdf_header']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_pdf_body_font]" id="action_tcpdf_{n}_pdf_body_font" value="<?php echo $action_params['pdf_body_font']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_pdf_body_font_size]" id="action_tcpdf_{n}_pdf_body_font_size" value="<?php echo $action_params['pdf_body_font_size']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_pdf_header_font]" id="action_tcpdf_{n}_pdf_header_font" value="<?php echo $action_params['pdf_header_font']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_pdf_header_font_size]" id="action_tcpdf_{n}_pdf_header_font_size" value="<?php echo $action_params['pdf_header_font_size']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_pdf_footer_font]" id="action_tcpdf_{n}_pdf_footer_font" value="<?php echo $action_params['pdf_footer_font']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_pdf_footer_font_size]" id="action_tcpdf_{n}_pdf_footer_font_size" value="<?php echo $action_params['pdf_footer_font_size']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_pdf_monospaced_font]" id="action_tcpdf_{n}_pdf_monospaced_font" value="<?php echo $action_params['pdf_monospaced_font']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_pdf_margin_left]" id="action_tcpdf_{n}_pdf_margin_left" value="<?php echo $action_params['pdf_margin_left']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_pdf_margin_top]" id="action_tcpdf_{n}_pdf_margin_top" value="<?php echo $action_params['pdf_margin_top']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_pdf_margin_right]" id="action_tcpdf_{n}_pdf_margin_right" value="<?php echo $action_params['pdf_margin_right']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_pdf_margin_header]" id="action_tcpdf_{n}_pdf_margin_header" value="<?php echo $action_params['pdf_margin_header']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_pdf_margin_footer]" id="action_tcpdf_{n}_pdf_margin_footer" value="<?php echo $action_params['pdf_margin_footer']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_pdf_margin_bottom]" id="action_tcpdf_{n}_pdf_margin_bottom" value="<?php echo $action_params['pdf_margin_bottom']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_pdf_image_scale_ratio]" id="action_tcpdf_{n}_pdf_image_scale_ratio" value="<?php echo $action_params['pdf_image_scale_ratio']; ?>" />
	
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_enable_protection]" id="action_tcpdf_{n}_enable_protection" value="<?php echo $action_params['enable_protection']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_permissions]" id="action_tcpdf_{n}_permissions" value="<?php echo $action_params['permissions']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_user_pass]" id="action_tcpdf_{n}_user_pass" value="<?php echo $action_params['user_pass']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_owner_pass]" id="action_tcpdf_{n}_owner_pass" value="<?php echo $action_params['owner_pass']; ?>" />
	<input type="hidden" name="chronoaction[{n}][action_tcpdf_{n}_sec_mode]" id="action_tcpdf_{n}_sec_mode" value="<?php echo $action_params['sec_mode']; ?>" />
	
	
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="tcpdf" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_tcpdf_element_config">
	<?php
		$fonts = array('courier' => 'courier', 'helvetica' => 'helvetica', 'times' => 'times');
	?>
	<?php echo $PluginTabsHelper->Header(array('settings' => 'Settings', 'contents' => 'Contents', 'constants' => 'Constants', 'protection' => 'Protection', 'help' => 'Help'), 'tcpdf_config_{n}'); ?>
	<?php echo $PluginTabsHelper->tabStart('settings'); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_mode_config', array('type' => 'select', 'label' => 'Mode', 'options' => array('controller' => 'Controller', 'view' => 'View'), 'smalldesc' => 'When should this action run ? during the controller code processing (early) or later when the ouput is viewed.')); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_pdf_author_config', array('type' => 'text', 'label' => "Document Author", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "")); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_pdf_title_config', array('type' => 'text', 'label' => "Document Title", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "")); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_pdf_header_config', array('type' => 'text', 'label' => "Document Header", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "")); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_pdf_subject_config', array('type' => 'text', 'label' => "Document Subject", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "")); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_pdf_keywords_config', array('type' => 'text', 'label' => "Document Keywords", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "")); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_pdf_file_name_config', array('type' => 'text', 'label' => "Document/File Name", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "As it will appear for the user downloading/viewing it.")); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_pdf_view_config', array('type' => 'select', 'label' => "View", 'options' => array('I' => 'Display inline', 'F' => 'Save to server', 'D' => 'Download', 'FI' => 'Save + Display inline', 'FD' => 'Save + Download', 'S' => 'String'), 'smalldesc' => "")); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_pdf_save_path_config', array('type' => 'text', 'label' => "Document Save path", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "The path where the file will be saved (in case the view is configured to save the file), if no path is provided then it will be saved under this path:<br />JOOMLA_PATH/components/com_chronoforms/pdf/FORM_NAME/")); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_pdf_post_name_config', array('type' => 'text', 'label' => "File name in Data/Files array", 'class' => 'medium_input', 'value' => '', 'smalldesc' => "The name of the file in the data or the files array, this will be used in case you need to attach the file to an email or so.")); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_pdf_page_orientation_config', array('type' => 'select', 'label' => 'Page Orientation', 'options' => array('P' => 'Portrait', 'L' => 'Landscape'), 'smalldesc' => '')); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_pdf_page_format_config', array('type' => 'text', 'label' => "Page Format", 'class' => 'small_input', 'smalldesc' => "A4..etc")); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('contents'); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_content1_config', array('type' => 'textarea', 'label' => "Content", 'rows' => 20, 'cols' => 70, 'smalldesc' => 'any code can be placed here, any PHP code should include the PHP tags.<br />if left empty, then the form view output will be used in the PDF instead.')); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('constants'); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_pdf_body_font_config', array('type' => 'select', 'label' => 'Body Font', 'options' => $fonts, 'smalldesc' => '')); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_pdf_body_font_size_config', array('type' => 'text', 'label' => "Body Font Size", 'class' => 'small_input', 'smalldesc' => "")); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_pdf_header_font_config', array('type' => 'select', 'label' => 'Header Font', 'options' => $fonts, 'smalldesc' => '')); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_pdf_header_font_size_config', array('type' => 'text', 'label' => "Header Font Size", 'class' => 'small_input', 'smalldesc' => "")); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_pdf_footer_font_config', array('type' => 'select', 'label' => 'Footer Font', 'options' => $fonts, 'smalldesc' => '')); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_pdf_footer_font_size_config', array('type' => 'text', 'label' => "Footer Font Size", 'class' => 'small_input', 'smalldesc' => "")); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_pdf_monospaced_font_config', array('type' => 'select', 'label' => 'Monospaced Font', 'options' => $fonts, 'smalldesc' => '')); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_pdf_margin_left_config', array('type' => 'text', 'label' => "Margin Left", 'class' => 'small_input', 'smalldesc' => "")); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_pdf_margin_top_config', array('type' => 'text', 'label' => "Margin Top", 'class' => 'small_input', 'smalldesc' => "")); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_pdf_margin_right_config', array('type' => 'text', 'label' => "Margin Right", 'class' => 'small_input', 'smalldesc' => "")); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_pdf_margin_header_config', array('type' => 'text', 'label' => "Margin Header", 'class' => 'small_input', 'smalldesc' => "")); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_pdf_margin_footer_config', array('type' => 'text', 'label' => "Margin Footer", 'class' => 'small_input', 'smalldesc' => "")); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_pdf_margin_bottom_config', array('type' => 'text', 'label' => "Margin Bottom", 'class' => 'small_input', 'smalldesc' => "")); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_pdf_image_scale_ratio_config', array('type' => 'text', 'label' => "Image scale ratio", 'class' => 'small_input', 'smalldesc' => "ratio used to adjust the conversion of pixels to user units")); ?>
		
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('protection'); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_enable_protection_config', array('type' => 'select', 'label' => 'Enable', 'options' => array(0 => "No", 1 => "Yes"), 'smalldesc' => 'Enable protection mode ?')); ?>
		
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_permissions_config', array('type' => 'select', 'label' => 'Permissions', "size" => 8, 'options' => array("print" => "print", "modify" => "modify", "copy" => "copy", "extract" => "extract", "assemble" => "assemble", "fill-forms" => "fill-forms"), 'multiple' => 'multiple', 'rule' => "split", 'splitter' => ",", 'smalldesc' => 'Permissions given upon entering the user password.')); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_user_pass_config', array('type' => 'text', 'label' => "User Password", 'class' => 'small_input', 'smalldesc' => "The password required by the user to gain the permissions selected above.")); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_sec_mode_config', array('type' => 'select', 'label' => 'Encryption', 'options' => array("RSA 40 Bit", "RSA 128 Bit", "AES 128 Bit", "AES 256 Bit"), 'smalldesc' => 'The encryption used to protect the document.')); ?>
		<?php echo $HtmlHelper->input('action_tcpdf_{n}_owner_pass_config', array('type' => 'text', 'label' => "Owner Password", 'class' => 'small_input', 'smalldesc' => "The password required to gain FULL permissions.")); ?>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
	<?php echo $PluginTabsHelper->tabStart('help'); ?>
		<p>
			<ul>
				<li>You may use PHP code with php tags.</li>
				<li>Curly brackets formula is supported.</li>
				<li>If the content box is left empty then the form output will be used as the PDF file content.</li>
			</ul>
		</p>
	<?php echo $PluginTabsHelper->tabEnd(); ?>
</div>