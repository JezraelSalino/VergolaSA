<?php  
$id =$_REQUEST['pid'];

$result = mysql_query("SELECT * FROM ver_chronoforms_data_letters_vic WHERE cf_id  = '$id'");
$retrieve = mysql_fetch_array($result);
if (!$result) 
		{
		die("Error: Data not found..");
		}
	//$title=$retrieve['title'];
	$cf_id=$retrieve['cf_id'];
	$htmlcontent=$retrieve['template_content'] ;

				

if(isset($_POST['save']))
{	
	//$template_title = $_POST['title'];
	$template_content = addslashes($_POST['htmlcontent']);
	$cf_id = $_POST['cf_id'];
    

	mysql_query("UPDATE ver_chronoforms_data_letters_vic SET  template_content ='$template_content' WHERE cf_id = '$cf_id'")
				or die(mysql_error()); 
	echo "Saved!";
	
	//header("Location: index.php");	
   echo('<script language="Javascript">opener.window.location.reload(false); window.close();</script>');
}

if(isset($_POST['delete']))
{	

	mysql_query("DELETE from ver_chronoforms_data_letters_vic WHERE cf_id = '$id'")
				or die(mysql_error()); 
	echo "Deleted";
	
	//header("Location: index.php");	
   echo('<script language="Javascript">opener.window.location.reload(false); window.close();</script>');	
}

if(isset($_POST['cancel']))
{	
	//header("Location: index.php");			
}

?>


<script src="<?php echo JURI::base().'media/editors/tinymce/jscripts/tiny_mce/tiny_mce.js'; ?>" type="text/javascript"></script>
<script type="text/javascript">
				tinyMCE.init({
					// General
					dialog_type : "modal",
					directionality: "ltr",
					editor_selector : "mce_editable",
					language : "en",
					mode : "specific_textareas",
					plugins : "paste,searchreplace,insertdatetime,table,emotions,media,advhr,directionality,fullscreen,layer,style,xhtmlxtras,visualchars,visualblocks,nonbreaking,wordcount,template,advimage,advlink,advlist,autosave,contextmenu,inlinepopups",
					skin : "default",
					theme : "advanced",
					// Cleanup/Output
					inline_styles : true,
					gecko_spellcheck : true,
					entity_encoding : "raw",
					extended_valid_elements : "hr[id|title|alt|class|width|size|noshade|style],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name|style],a[id|class|name|href|hreflang|target|title|onclick|rel|style]",
					force_br_newlines : false, force_p_newlines : true, forced_root_block : 'p',
					invalid_elements : "script,applet",
					// URL
					relative_urls : true,
					remove_script_host : false,
					document_base_url : "<?php echo JURI::base(); ?>",
					//Templates
					template_external_list_url : "<?php echo JURI::base().'media/editors/tinymce/templates/template_list.js'; ?>",
					// Layout
					content_css : "<?php echo JURI::base().'templates/system/css/editor.css'; ?>",
					// Advanced theme
					theme_advanced_toolbar_location : "top",
					theme_advanced_toolbar_align : "left",
					theme_advanced_source_editor_height : "550",
					theme_advanced_source_editor_width : "750",
					theme_advanced_resizing : true,
					theme_advanced_resize_horizontal : false,
					theme_advanced_statusbar_location : "bottom", theme_advanced_path : true,
					theme_advanced_buttons1_add_before : "",
					theme_advanced_buttons2_add_before : "search,replace,|",
					theme_advanced_buttons3_add_before : "tablecontrols",
					theme_advanced_buttons1_add : "fontselect,fontsizeselect",
					theme_advanced_buttons2_add : "insertdate,inserttime,forecolor,backcolor,fullscreen",
					theme_advanced_buttons3_add : "emotions,media,advhr,ltr,rtl",
					theme_advanced_buttons4 : "cut,copy,paste,pastetext,pasteword,selectall,|,insertlayer,moveforward,movebackward,absolute,styleprops,cite,abbr,acronym,ins,del,attribs,visualchars,visualblocks,nonbreaking,blockquote,template",
					plugin_insertdate_dateFormat : "%Y-%m-%d",
					plugin_insertdate_timeFormat : "%H:%M:%S",
					fullscreen_settings : {
						theme_advanced_path_location : "top"
					}
				});
				</script>

<style>
.update-btn {background-color: #4285F4;
    border: 1px solid #026695;
    color: #FFFFFF;
    cursor: pointer;
    margin: 5px 0;
    padding: 2px;
    width: 190px;}
</style>
				

<form method="post">
<input name="cf_id" id="cf_id" value="<?php echo $cf_id; ?>" type="hidden" />
<textarea name="htmlcontent" id="htmlcontent" class="mce_editable" style="width:100%;height:100%;"><?php echo $htmlcontent; ?></textarea>
<input type="submit" name="save" value="Save" class="update-btn"  /> <input type="submit" name="delete" value="Delete" class="update-btn" /> <input type="submit" name="cancel" value="Cancel" class="update-btn" onclick="window.opener=null; window.close(); return false;"/>
</form>