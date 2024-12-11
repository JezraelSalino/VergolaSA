<?php
/**
 * @package Profiler Fields for Joomla! 2.5
 * @version $Id: field.php 29 2013-04-27 16:51:31Z harold $
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
// No direct access.
defined('_JEXEC') or die;

class PffieldsTableField extends JTable
{
	
	protected $_mysql = array();

	function __construct(&$_db)
	{
		parent::__construct('#__profiler_fields', 'id', $_db);
	}
	
	function bind($array, $ignore = '') {
		if(isset($array["dbtype"])) {
			$ignore = array("dbtype", "dblength", "dbdefaultvalue", "dbdefaultvaluedefined");
			$this->_mysql = array("dbcreate" => $array["dbcreate"], "dbtype" => $array["dbtype"], "dblength" => $array["dblength"], "dbdefaultvalue" => $array["dbdefaultvalue"], "dbdefaultvaluedefined" => $array["dbdefaultvaluedefined"]);
		}
		if(isset($array["valuesimple"]) && $array["valuesimple"]) {
			$array["value"] = $array["valuesimple"];
		}
		$param  = JFactory::getApplication()->input->post->get('param', array(), 'array');
		if (isset($param) && is_array($param))
		{
			if(strpos($array['type'], ".") !== false) {
				$plugintype = explode('.', $array['type']);
				$type = $plugintype[0];
				$plugin = $plugintype[1];
					
				$dispatcher	= JDispatcher::getInstance();
				JPluginHelper::importPlugin('pffields', "field" . $plugin);
				$result = $dispatcher->trigger('validatePffieldsParams', array(&$param));
					
				if($result[0] == true) {
					$registry = new JRegistry;
					$registry->loadArray($param);
					$array['param'] = (string) $registry;
				}
			}
		}
		$return = parent::bind($array, $ignore);
		return $return;
	}

	function check()
	{
		jimport('joomla.filter.output');

		// Set name and extension if new
		if(!$this->id) {
			$name = JFilterInput::getInstance()->clean($this->name, 'cmd');
			if(!$name) {
				$this->setError(JText::_('COM_PFFIELDS_ERROR_FIELDNAME_ERROR'));
				return false;
			}
			
			$this->name = htmlspecialchars_decode("pro_".$name, ENT_QUOTES);
			
			$prefix = JRequest::getCmd('prefix', '');
			$extension = JRequest::getCmd('extension', 'com_pffields') . $prefix;
			$this->extension = $extension;
			
			// check for existing fieldname
			$query = 'SELECT name FROM #__profiler_fields WHERE name = "' . $this->name . '" AND extension = "' . $this->extension . '"';
			$this->_db->setQuery($query);
			$fieldnamesexist = $this->_db->loadAssocList(null, 'name');
			if(in_array($this->name, $fieldnamesexist )) {
				$this->setError(JText::_('COM_PFFIELDS_ERROR_FIELDNAME_EXISTS'));
				return false;
			}
		}
			
		// Set ordering
		if (empty($this->ordering)) {
			// Set ordering to last if ordering was 0
			$this->ordering = self::getNextOrder('`catid`=' . $this->_db->Quote($this->catid));
		}
		

		return true;
	}
	
	function store($updateNulls = false)
	{
		$db = true;
		
		if(strpos($this->type, ".") !== false) {
			$plugintype = explode('.', $this->type);
			$type = $plugintype[0];
			$plugin = $plugintype[1];
		
			$dispatcher	= JDispatcher::getInstance();
			JPluginHelper::importPlugin('pffields', "field" . $plugin);
			$result = $dispatcher->trigger('onPffieldsBevoresave', array(&$this));
			$db = $result[0];
			if(!$db) {
				$this->table = "";
			}
		}
		
		
		if (empty($this->id))
		{
			// Store the row
			if($this->extension == "com_profiler") {
				$table = "#__profiler_users";
			} elseif($this->extension == "com_profiler_groups") {
				$table = "#__profiler_groups";
			} elseif($this->extension == "com_pfevent") {
				$table = "#__profiler_events";
			}
			
			parent::store($updateNulls);
			
			if($db == true) {
				if($this->_mysql["dbcreate"] == "manual") {
					$query = "ALTER TABLE $table " . $this->addsql();
				} else {
					if ($this->type == "calendar" ) {
						$query = "ALTER TABLE $table ADD `".$this->name."` DATETIME NULL";
					} elseif ($this->maxlength > 255 || $this->type == "textarea" || $this->type == "editor") {
						$query = "ALTER TABLE $table ADD `".$this->name."` LONGTEXT NULL";
					} elseif ($this->maxlength == 0) {
						$query = "ALTER TABLE $table ADD `".$this->name."` VARCHAR( 255 ) NULL";
					} else {
						$query = "ALTER TABLE $table ADD `".$this->name."` VARCHAR( ".$this->maxlength." ) NULL";
					}
				}
				$this->_db->setQuery( $query );
				$this->_db->query();
			}
		}
		else
		{
			// Get the old row
			$oldrow = JTable::getInstance('Field', 'PffieldsTable');
			if (!$oldrow->load($this->id) && $oldrow->getError())
			{
				$this->setError($oldrow->getError());
			}

			// Store the new row
			parent::store($updateNulls);

		}
		return count($this->getErrors())==0;
	}
	
	function delete($pk = null) {

		
		$this->_db->setQuery( "select name, `table`, sys, `extension` from #__profiler_fields where id = '$pk' limit 1");
		$result = $this->_db->loadAssoc();

		if ($result['sys'] == 1) {
			$this->setError(JText::_("COM_PFFIELDS_ERROR_FIELD_DELETE_SYSTEMFIELD"));
			return false;
		}
		
		if ($this->_db->getErrorNum()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		
		if($result['extension'] == "com_profiler") {
			$table = "#__profiler_users";
		} elseif($result['extension'] == "com_profiler_groups") {
			$table = "#__profiler_groups";			
		} elseif($result['extension'] == "com_pfevent") {
			$table = "#__profiler_events";
		}
		
		if($result['table']) {
			$this->_db->setQuery( "ALTER TABLE ". $table ." DROP `" . $result['name'] ."`" );
			$this->_db->query();

			if ($this->_db->getErrorNum()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}
				
		$return = parent::delete($pk);
		
		$this->_db->setQuery( "DELETE FROM #__profiler_fieldprofile WHERE `fieldid` = '$pk'" );
		$this->_db->query();
		
		if ($this->_db->getErrorNum()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		return $return;
		
	}
	
	function addsql () {
		$field_attribute = "";
		$field_comments = "";
		$field_extra = "";
		$field_collation = "";
		$field_null = "";
		$i = 0;
		$field_primary = "";
		
		//$this->_mysql = array("dbtype" => $array["dbtype"], "dblength" => $array["dblength"], "dbdefaultvalue" => $array["dbdefaultvalue"], "dbdefaultvaluedefined" => $array["dbdefaultvaluedefined"]);
        
		$definition = ' ADD ' . $this->addsql_fieldspec(
            $this->name,
            $this->_mysql['dbtype'],
            $this->_mysql['dblength'],
            $field_attribute,
            isset($field_collation)
                ? $field_collation
                : '',
            isset($field_null)
                ? $field_null
                : 'NOT NULL',
            $this->_mysql['dbdefaultvalue'],
            $this->_mysql['dbdefaultvaluedefined'],
            isset($field_extra)
                ? $field_extra
                : false,
            isset($field_comments)
                ? $field_comments
                : '',
            $field_primary,
            $i
        );
        return $definition;		
	}
	
	
	//phpmyadmin function generateFieldSpec
	function addsql_fieldspec ($name, $type, $length = '', $attribute = '',
        $collation = '', $null = false, $default_type = 'USER_DEFINED',
        $default_value = '', $extra = '', $comment = '',
        &$field_primary, $index, $default_orig = false) {
        	
        $is_timestamp = strpos(' ' . strtoupper($type), 'TIMESTAMP') == 1;

        /**
         * @todo include db-name
         */
        $query = $this->addsql_backquote($name) . ' ' . $type;

        if ($length != ''
            && !preg_match('@^(DATE|DATETIME|TIME|TINYBLOB|TINYTEXT|BLOB|TEXT|MEDIUMBLOB|MEDIUMTEXT|LONGBLOB|LONGTEXT)$@i', $type)) {
            $query .= '(' . $length . ')';
        }

        if ($attribute != '') {
            $query .= ' ' . $attribute;
        }

 //       if (!empty($collation) && $collation != 'NULL'
 //         && preg_match('@^(TINYTEXT|TEXT|MEDIUMTEXT|LONGTEXT|VARCHAR|CHAR|ENUM|SET)$@i', $type)) {
 //           $query .= PMA_generateCharsetQueryPart($collation);
 //       }

        if ($null !== false) {
            if ($null == 'NULL') {
                $query .= ' NULL';
            } else {
                $query .= ' NOT NULL';
            }
        }

        switch ($default_type) {
            case 'USER_DEFINED' :
                if ($is_timestamp && $default_value === '0') {
                    // a TIMESTAMP does not accept DEFAULT '0'
                    // but DEFAULT 0 works
                    $query .= ' DEFAULT 0';
                } elseif ($type == 'BIT') {
                    $query .= ' DEFAULT b\'' . preg_replace('/[^01]/', '0', $default_value) . '\'';
                } else {
                    $query .= ' DEFAULT \'' . addsql_sqlAddslashes($default_value) . '\'';
                }
                break;
            case 'NULL' :
            case 'CURRENT_TIMESTAMP' :
                $query .= ' DEFAULT ' . $default_type;
                break;
            case 'NONE' :
            default :
                break;
        }

/*        if (!empty($extra)) {
            $query .= ' ' . $extra;
            // Force an auto_increment field to be part of the primary key
            // even if user did not tick the PK box;
            if ($extra == 'AUTO_INCREMENT') {
                $primary_cnt = count($field_primary);
                if (1 == $primary_cnt) {
                    for ($j = 0; $j < $primary_cnt && $field_primary[$j] != $index; $j++) {
                        //void
                    }
                    if (isset($field_primary[$j]) && $field_primary[$j] == $index) {
                        $query .= ' PRIMARY KEY';
                        unset($field_primary[$j]);
                    }
                // but the PK could contain other columns so do not append
                // a PRIMARY KEY clause, just add a member to $field_primary
                } else {
                    $found_in_pk = false;
                    for ($j = 0; $j < $primary_cnt; $j++) {
                        if ($field_primary[$j] == $index) {
                            $found_in_pk = true;
                            break;
                        }
                    } // end for
                    if (! $found_in_pk) {
                        $field_primary[] = $index;
                    }
                }
            } // end if (auto_increment) 
        } 
        if (!empty($comment)) {
            $query .= " COMMENT '" . addsql_sqlAddslashes($comment) . "'";
        }*/
        return $query;      	
		
	}

	
	function addsql_backquote($a_name)
	{
   		if (strlen($a_name) && $a_name !== '*') {
        	return '`' . str_replace('`', '``', $a_name) . '`';
    	} else {
        	return $a_name;
    	}
	}
	
	function addsql_sqlAddslashes($a_string = '')
	{
        $a_string = str_replace('\\', '\\\\', $a_string);
        $a_string = str_replace('\'', '\'\'', $a_string);
	    return $a_string;
}
	
}
