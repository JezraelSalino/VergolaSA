<?php
/**
 * @package Profiler for Joomla! 2.5
 * @version $Id: excel.php 31 2013-01-09 22:33:43Z harold $
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

class ProfilerHelperExcel {
	
	private $header = "<?xml version=\"1.0\" encoding=\"%s\"?\>\n<Workbook xmlns=\"urn:schemas-microsoft-com:office:spreadsheet\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\" xmlns:ss=\"urn:schemas-microsoft-com:office:spreadsheet\" xmlns:html=\"http://www.w3.org/TR/REC-html40\">";
    private $footer = "</Workbook>";
    private $lines = array();
    private $sEncoding;
    private $bConvertTypes;
    private $worksheets = array();
    private $allowfields = array();
    
    public function __construct($sEncoding = 'UTF-8', $bConvertTypes = false)
    {
    	$this->bConvertTypes = $bConvertTypes;
        $this->setEncoding($sEncoding);
    } 
    
    public function setEncoding($sEncoding)
    {
     	$this->sEncoding = $sEncoding;
    }
	
    public function setAllowFields($fields) {
    	$this->allowfields = $fields;
    }
    
    public function addWorksheet ($title) {
		$title = preg_replace ("/[\\\|:|\/|\?|\*|\[|\]]/", "", $title);
		$title = substr ($title, 0, 31);
		if(is_array($title)) {
			foreach($title as $t) {
				$this->worksheets[$t] = $t;
			}
		} else {
			$this->worksheets[$title] = $title;
		}
	}

    public function addRow ($row, $worksheet)
    {
    	$cells = "";
    	$array = (array) $row;
        
    	if(count($this->allowfields) > 0 ) {
    		foreach ($this->allowfields as $k) {
                $type = 'String';
                if ($this->bConvertTypes === true && is_numeric($array[$k])):
                	$type = 'Number';
                endif;
    			$v = htmlentities($array[$k], ENT_COMPAT, $this->sEncoding);
    			$cells .= "<Cell><Data ss:Type=\"$type\">" . $v . "</Data></Cell>\n";
    		}
    	
    	} else {  	
    	   	foreach ($array as $k => $v) {
	            $type = 'String';
                if ($this->bConvertTypes === true && is_numeric($v)):
    	            $type = 'Number';
                endif;
                $v = htmlentities($v, ENT_COMPAT, $this->sEncoding);
                $cells .= "<Cell><Data ss:Type=\"$type\">" . $v . "</Data></Cell>\n"; 
            }
    	}
        $this->lines[$worksheet][] = "<Row>\n" . $cells . "</Row>\n";
    }
	
    public function addArray ($array, $worksheet)
    {
            foreach ($array as $k => $v)
                    $this->addRow ($v, $worksheet);
    }
	
	public function generateXML ($filename = 'excel-export')
	{
		// correct/validate filename
		$filename = preg_replace('/[^aA-zZ0-9\_\-]/', '', $filename);
	
		// deliver header (as recommended in php manual)
		//JResponse::setHeader("Content-Type", "application/vnd.ms-excel; charset=" . $this->sEncoding, true);
		//JResponse::setHeader("Content-Disposition", "attachment; filename=\"" . $filename . ".xls\"", true);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="download.xls"');
	
		// print out document to the browser
		// need to use stripslashes for the damn ">"
		echo stripslashes (sprintf($this->header, $this->sEncoding));
		foreach ($this->worksheets as $worksheet) {
			echo "\n<Worksheet ss:Name=\"" . $worksheet . "\">\n<Table>\n";
			foreach ($this->lines[$worksheet] as $line)
				echo $line;
	
			echo "</Table>\n</Worksheet>\n";
		}
		echo $this->footer;
		
		exit;

	}	

}
