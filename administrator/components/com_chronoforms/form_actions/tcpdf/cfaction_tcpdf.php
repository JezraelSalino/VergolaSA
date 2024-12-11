<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionTcpdfHelper{
	function show($form, $actiondata){
		$params = new JParameter($actiondata->params);		
		if($params->get('mode', 'view') == 'view'){
			$this->_display($form, $actiondata);
		}
    }
	
	function _display($form, $actiondata, $output = ''){
		$content = $actiondata->content1;
		ob_start();
		eval('?>'.$content);
		$output = ob_get_clean();
		//if the content box was empty, display the form output
		if(empty($output)){
			$output = $form->form_output;
		}
		$output = $form->curly_replacer($output, $form->data);
		$params = new JParameter($actiondata->params);
		//begin tcpdf code
		require_once('tcpdf/config/lang/eng.php');
		require_once('tcpdf/tcpdf.php');
						
		// create new PDF document
		$pdf = new TCPDF($params->get('pdf_page_orientation', 'P'), PDF_UNIT, $params->get('pdf_page_format', 'A4'), true, 'UTF-8', false);
		
		//set protection if enabled
		if((bool)$params->get('enable_protection', 0) === true){
			$owner_pass = ($params->get('owner_pass', "") ? $params->get('owner_pass', "") : null);
			$perms = (strlen($params->get('permissions', "")) > 0) ? explode(",", $params->get('permissions', "")) : array();
			$pdf->SetProtection($perms, $params->get('user_pass', ""), $owner_pass, $params->get('sec_mode', ""), $pubkeys=null);
		}

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor($params->get('pdf_author', 'PDF Author.'));
		$pdf->SetTitle($params->get('pdf_title', 'PDF Title Goes Here.'));
		$pdf->SetSubject($params->get('pdf_subject', 'Powered by Chronoforms + TCPDF'));
		$pdf->SetKeywords($params->get('pdf_keywords', 'Chronoforms, PDF Plugin, TCPDF, PDF, '.$form->form_name));
		// set default header data'
		if(strlen($params->get('pdf_title')) OR strlen($params->get('pdf_header'))){
			$pdf->SetHeaderData(false, 0, $params->get('pdf_title', 'PDF Title Goes Here.'), $params->get('pdf_header', 'Powered by Chronoforms + TCPDF'));
		}

		// set header and footer fonts
		$pdf->setHeaderFont(Array($params->get('pdf_header_font', 'helvetica'), '', (int)$params->get('pdf_header_font_size', 10)));
		$pdf->setFooterFont(Array($params->get('pdf_footer_font', 'helvetica'), '', (int)$params->get('pdf_footer_font_size', 8)));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont($params->get('pdf_monospaced_font', 'courier'));

		//set margins
		// $pdf->SetMargins($params->get('pdf_margin_left', 15), $params->get('pdf_margin_top', 27), $params->get('pdf_margin_right', 15));
		$pdf->SetMargins(5,15,5,false);
		$pdf->SetHeaderMargin($params->get('pdf_margin_header', 5));
		$pdf->SetFooterMargin($params->get('pdf_margin_footer', 10));

		//set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, $params->get('pdf_margin_bottom', 25));

		//set image scale factor
		$pdf->setImageScale($params->get('pdf_image_scale_ratio', 1.25));

		//set some language-dependent strings
		$pdf->setLanguageArray($l);

		// ---------------------------------------------------------

		// set font
		$pdf->SetFont($params->get('pdf_body_font', 'courier'), '', (int)$params->get('pdf_body_font_size', 14));

		// add a page
		$pdf->AddPage();
		// create some HTML content
		//load the CSS if any
		$document =& JFactory::getDocument();
		$headData = $document->getHeadData();
		$css = "";
		if(isset($headData['style']['text/css'])){
			$css = $headData['style']['text/css'];
		}
		$output = $css.$output;
		$html = $output;
		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');
		// reset pointer to the last page
		$pdf->lastPage();
		//Close and output PDF document
		if(isset($form->data['pdf_file_name']) && !empty($form->data['pdf_file_name'])){
			$PDF_file_name = $form->data['pdf_file_name'];
		}else{
			if(strlen(trim($params->get('pdf_file_name', ''))) > 0){
				$PDF_file_name = trim($params->get('pdf_file_name', ''))."_".date('YmdHis');
			}else{
				$PDF_file_name = $form->form_name."_".date('YmdHis');
			}
		}
		$PDF_view = $params->get('pdf_view', 'I');
		if(($PDF_view == 'F') || ($PDF_view == 'FI') || ($PDF_view == 'FD')){
			jimport('joomla.utilities.error');
			jimport('joomla.filesystem.file');
			jimport('joomla.filesystem.folder');
			$upload_path = $params->get('pdf_save_path');
			if(!empty($upload_path)){
				$upload_path = str_replace(array("/", "\\"), DS, $upload_path);
				if(substr($upload_path, -1) == DS){
					$upload_path = substr_replace($upload_path, '', -1);
				}
				$upload_path = $upload_path.DS;
				$params->set('pdf_save_path', $upload_path);
			}else{
				$upload_path = JPATH_SITE.DS.'components'.DS.'com_chronoforms'.DS.'pdf'.DS.$form->form_details->name.DS;
			}
			//check the save files path is ok
			if(!JFile::exists($upload_path.DS.'index.html')){
				if(!JFolder::create($upload_path)){
					JError::raiseWarning(100, 'Couldn\'t create the save directroy.');
				}
				$dummy_c = '<html><body bgcolor="#ffffff"></body></html>';
				if(!JFile::write($upload_path.DS.'index.html', $dummy_c)){
					JError::raiseWarning(100, 'Couldn\'t write to the save directroy.');
				}
			}
			$PDF_file_path = $upload_path.$PDF_file_name.".pdf";
			$pdf->Output($PDF_file_path, $PDF_view);
			
			if(strlen(trim($params->get('pdf_post_name', ''))) > 0){
				$form->files[trim($params->get('pdf_post_name', ''))] = array('name' => $PDF_file_name.".pdf", 'path' => $PDF_file_path, 'size' => 0);
				$form->files[trim($params->get('pdf_post_name', ''))]['link'] = JURI::Base().'components/com_chronoforms/pdf/'.$form->form_details->name.'/'.$PDF_file_name.".pdf";
				$form->data[trim($params->get('pdf_post_name', ''))] = $PDF_file_name.".pdf";
				$form->debug[] = $PDF_file_path.' has been uploaded OK.';
			}
		}else{
			$pdf->Output($PDF_file_name.".pdf", 'D');
		}
		if($PDF_view != 'F'){
			if ( $PDF_view == 'I' || $PDF_view == 'FI' ) {
			  $mainframe =& JFactory::getApplication();
			  $mainframe->close();
			}
		}
	}
}
?>