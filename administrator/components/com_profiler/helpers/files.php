<?php
/**
 * @package Profiler for Joomla! 2.5
 * @version $Id: files.php 31 2013-01-09 22:33:43Z harold $
 * @author Harold Prins
 * @copyright (C) 2011-2013 Harold Prins
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 *  
 * Profiler is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *  
 * You should have received a copy of the GNU General Public License
 * along with Profiler.  If not, see <http://www.gnu.org/licenses/gpl-2.0.html>.
*/
// No direct access
defined('_JEXEC') or die;

class ProfilerHelperFiles {
	
	public $files = array();
	public $dest_folder = null;
	public $maxfilesize = null;
	public $hash = null;
	public $error = array();
	public $mimetypes = array();
	public $extensions = array();
	
	public $defaultimgwidth = null;
	public $defaultimgheight = null;
	
	public function __construct($files, $id) {
		if(!isset($files['name']) || !is_array($files['name'])) {
			return true;
		}
		$config = JComponentHelper::getParams('com_profiler');
		$this->dest_folder = JPATH_ROOT.'/media/com_profiler/'.$config->get('hpdestfolder').'/';
		$this->hash = $config->get('hphash');
		$encrypt = $config->get('usefilenameencryption');
		$this->defaultimgwidth = (int) $config->get('hpimagemaxwidth');
		$this->defaultimgheight = (int) $config->get('hpimagemaxheight');
		$this->maxfilesize = (int) $config->get('hpimagefilesize') * 1024;
		$existsfiles = $this->loadexistingfiles($id, implode(",", array_keys($files['name'])));
		
		foreach($files['name'] as $name => $file) {
		  //import block
		  if(!($name == "file")) {
			if ($files['error'][$name] === UPLOAD_ERR_OK  ) { 
				$savefilename = JFile::makeSafe($file);
				$this->files[$name]['src']['filename'] = $savefilename;
				$this->files[$name]['src']['extension'] = JFile::getExt($savefilename);
				$this->files[$name]['src']['type'] = $files['type'][$name];
				$this->files[$name]['src']['filepath'] = $files['tmp_name'][$name];
				$this->files[$name]['src']['error'] = $files['error'][$name];
				$this->files[$name]['src']['size'] = $files['size'][$name];
				$this->files[$name]['new']['filepath'] = $this->dest_folder.$name.'/';
				if($encrypt == true) {
					$this->files[$name]['new']['filename'] = $id . md5($savefilename . $hash) . "." . $this->files[$name]['src']['extension'];
				} else {
					$this->files[$name]['new']['filename'] = $id . $savefilename . "." . $this->files[$name]['src']['extension'];
				}
				$this->files[$name]['exst']['filename'] = $existsfiles[$name];
				$this->files[$name]['exst']['del'] = true;
			} elseif ($files['error'][$name] === UPLOAD_ERR_NO_FILE) {
				$this->files[$name]['exst']['filename'] = $existsfiles[$name];
				$this->files[$name]['exst']['del'] = false;
			} else {
				$this->error[] = setFileupload_errormessage($files['error'][$name]);
			}
		  }
		
		}
		if(count($this->error))
			return false;

		return true;
		
	}
	
	public function setRemove($name) {
		$this->files[$name]['exst']['del'] = true;
	}
	
	public function isUploadFile($name) {
		return $this->files[$name]['src']['filename'] ? true : false;
	}
	
	public function checkMime($name, $enable) {
		if(!$enable)
			return true;
		
		$list = array();
		$list = explode(",", $enable);
		if (!isset($this->files[$name]['src']['type']) || in_array($this->files[$name]['src']['type'], $list)) {
			return true;
		}
		return false;
	}

	public function checkExtension($name, $enable) {
		if(!$enable)
			return true;
			
		$list = array();
		$list = explode(",", $enable);
		if (!isset($this->files[$name]['src']['extension']) || in_array($this->files[$name]['src']['extension'], $list)) {
			return true;
		}
		return false;
	}
	
	public function checkFilesize($name) {
		if(!$this->maxfilesize)
			return true;
			
		if (!isset($this->files[$name]['src']['size']) || $this->files[$name]['src']['size'] < $this->maxfilesize) {
			return true;
		}
		return false;
	}
	

	public function imageResize($name, $width, $height) {
		if(!$width)
			$width = $this->defaultimgwidth;
		if(!$height)
			$height = $this->defaultimgheight;
			
		
		jimport('joomla.image.image');
		$imageob = new JImage();
		$imageob->loadFile($this->files[$name]['src']['filepath']);
		$newimage = $imageob->resize($width, $height);
		$newimage->toFile($this->files[$name]['src']['filepath']);
			
		return true;
	}


	public function uploadFiles() {
		foreach ($this->files as $field => $file) {
			if ($file['exst']['del'] == true && $file['exst']['filename'] ) {
				if( is_file($this->dest_folder.$field.'/'.$file['exst']['filename'])) {
					JFile::delete($this->dest_folder.$field.'/'.$file['exst']['filename']);
				}
			}
			if (isset($file['src']['filename']) && $file['src']['filename']) {
				if (!JFile::upload($file['src']['filepath'], $file['new']['filepath'].$file['new']['filename']))	{
					$this->error[] = JText::_('COM_PROFILER_ERROR_UNABLE_TO_UPLOAD_FILE');
					return false;
				}
			}
		}
		return true;
	}
	
	public function getErrors () {
		return implode("<br/>", $this->error);
	}
	
	public function getName ($name) {
		return isset($this->files[$name]['new']['filename']) ? $this->files[$name]['new']['filename'] : "";
	}
	
	public function getFilesize($filesize){
   
 	   if(is_numeric($filesize)){
    		$decr = 1024; $step = 0;
    		$prefix = array('Byte','KB','MB','GB','TB','PB');
       
	    	while(($filesize / $decr) > 0.9){
    	    	$filesize = $filesize / $decr;
        		$step++;
    		}
	    	return round($filesize,2).' '.$prefix[$step];
    	} else {
	    	return 'NaN';
    	}
	}
	
	private function loadexistingfiles($id, $fields) {
		$db = JFactory::getDbo();
		$query = 'SELECT ' . $fields . ' FROM #__profiler_users WHERE id = ' . (int) $id;
		$db->setQuery($query);
		return $db->loadAssoc();
	}
	
	private function setFileupload_errormessage($error_code) {
    	switch ($error_code) {
        	case UPLOAD_ERR_INI_SIZE:
            	return 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
        	case UPLOAD_ERR_FORM_SIZE:
            	return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
	        case UPLOAD_ERR_PARTIAL:
    	        return 'The uploaded file was only partially uploaded';
        	case UPLOAD_ERR_NO_FILE:
            	return 'No file was uploaded';
        	case UPLOAD_ERR_NO_TMP_DIR:
            	return 'Missing a temporary folder';
	        case UPLOAD_ERR_CANT_WRITE:
    	        return 'Failed to write file to disk';
        	case UPLOAD_ERR_EXTENSION:
            	return 'File upload stopped by extension';
	        default:
    	        return 'Unknown upload error';
    }
} 
	

	
}
