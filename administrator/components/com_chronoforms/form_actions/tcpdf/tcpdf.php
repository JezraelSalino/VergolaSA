<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionTcpdf{
	var $formname;
	var $formid;
	var $group = array('id' => 'tcpdf', 'title' => 'TCPDF');
	var $details = array('title' => 'TCPDF', 'tooltip' => 'Create a PDF from your form output.');
	function run($form, $actiondata){
		$params = new JParameter($actiondata->params);
		if($params->get('mode', 'view') == 'controller'){
			$CfactionTcpdfHelper = new CfactionTcpdfHelper();
			$CfactionTcpdfHelper->_display($form, $actiondata);
		}
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'content1' => '',
				'pdf_author' => 'PDF Author.',
				'pdf_title' => 'PDF Title Goes Here.',
				'pdf_subject' => 'Powered by Chronoforms + TCPDF',
				'pdf_keywords' => 'Chronoforms, PDF Plugin, TCPDF, PDF',
				'pdf_file_name' => '',
				'pdf_view' => 'I',
				'pdf_save_path' => '',
				'pdf_post_name' => 'cf_pdf_file',
				'pdf_page_orientation' => 'P',
				'pdf_page_format' => 'A4',
				'pdf_header' => 'Powered by Chronoforms + TCPDF',
				'pdf_header_font' => 'helvetica',
				'pdf_header_font_size' => 10,
				'pdf_footer_font' => 'helvetica',
				'pdf_footer_font_size' => 8,
				'pdf_monospaced_font' => 'courier',
				'pdf_margin_left' => 15,
				'pdf_margin_top' => 27,
				'pdf_margin_right' => 15,
				'pdf_margin_header' => 5,
				'pdf_margin_footer' => 10,
				'pdf_margin_bottom' => 25,
				'pdf_image_scale_ratio' => 1.25,
				'pdf_body_font' => 'courier',
				'pdf_body_font_size' => 14,
				'enable_protection' => 0,
				'permissions' => '',
				'user_pass' => '',
				'owner_pass' => '',
				'sec_mode' => 0,
				'mode' => 'view'
			);
		}
		return array('action_params' => $action_params);
	}
}
?>