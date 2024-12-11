<?php
/**
 * @package Profiler for Joomla! 2.5
 * @version $Id: view.html.php 31 2013-01-09 22:33:43Z harold $
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
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class ProfilerViewUser extends JViewLegacy
{
	protected $form;
	protected $item;
	protected $grouplist;
	protected $groups;
	protected $state;
	
	protected $fieldsets;
	
	protected $view_position;
	protected $view_labels;

	public function display($tpl = null)
	{
		$layout   = JRequest::getCmd( 'layout', 'edit' );

		switch ($layout)
		{
			case 'import':
				$return = $this->display_import($tpl);
				break;
			default:
				$return =  $this->display_edit($tpl);
		}
		
		return $return;
		
		
	}
	
	public function display_edit($tpl = null)
	{
		
		$this->form			= $this->get('Form');
		$this->item			= $this->get('Item');
		$this->state		= $this->get('State');
		
		// Check for errors.
		if(!$this->form) {
			JError::raiseError(500, JText::_("COM_PROFILER_NO_ACCESS"));
			return false;
		} elseif (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		
		$this->fieldsets	= $this->form->getFieldsets();
		
		$this->form->setValue('password',		null);
		$this->form->setValue('password2',	null);

		parent::display($tpl);
		$this->addToolbar();
	}

	protected function addToolbar()
	{
		JRequest::setVar('hidemainmenu', 1);

		$user		= JFactory::getUser();
		$isNew		= ($this->item->id == 0);
		$canDo		= ProfilerHelper::getActions();
		
		
		$isNew	= ($this->item->id == 0);
		$isProfile = $this->item->id == $user->id;
		JToolBarHelper::title(JText::_($isNew ? 'COM_PROFILER_VIEW_NEW_USER_TITLE' : ($isProfile ? 'COM_PROFILER_VIEW_EDIT_USER_TITLE' : 'COM_PROFILER_VIEW_EDIT_USER_TITLE')), $isNew ? 'user-add' : 'user-edit');
		if ($canDo->get('core.edit')||$canDo->get('core.edit.own')||$canDo->get('core.create')) {
			JToolBarHelper::apply('user.apply','JTOOLBAR_APPLY');
			JToolBarHelper::save('user.save','JTOOLBAR_SAVE');
		}
		if ($canDo->get('core.create')&&$canDo->get('core.manage')) {			
			JToolBarHelper::custom('user.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
		}
		if (empty($this->item->id))  {
			JToolBarHelper::cancel('user.cancel','JTOOLBAR_CANCEL');
		} else {
			JToolBarHelper::cancel('user.cancel', 'JTOOLBAR_CLOSE');
		}
		
		JToolBarHelper::divider();
		$url = "http://www.haroldprins.nl/wiki/index.php?title=Profiler";
		JToolBarHelper::help("", "", $url);
		

	}
	
	public function loadTemplate($tpl = null, $position = null, $labels = true) {
		
		$this->view_position = $position;
		$this->view_labels = $labels;
		
		return parent::loadTemplate($tpl);		
		
	}
	
	public function display_import($tpl = null)
	{
		$this->form			= $this->get('FormUpload');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		
		parent::display($tpl);
		$this->addToolbarImport();
		
	}
	
	protected function addToolbarImport()
	{
		JRequest::setVar('hidemainmenu', 1);
		$canDo		= ProfilerHelper::getActions();
		
		JToolBarHelper::title(JText::_('COM_PROFILER_VIEW_USERSUPLOAD_TITLE'));
		if ($canDo->get('core.create')&&$canDo->get('core.manage')) {			
			JToolBarHelper::custom('user.upload', 'upload.png', 'save-new_f2.png', 'JTOOLBAR_UPLOAD', false);
			JToolBarHelper::custom('user.saveimport', 'apply.png', 'apply-new_f2.png', 'JTOOLBAR_APPLY', false);
		}
		JToolBarHelper::cancel('user.cancel', 'JTOOLBAR_CLOSE');

		JToolBarHelper::divider();
		$url = "http://www.haroldprins.nl/wiki/index.php?title=Profiler";
		JToolBarHelper::help("", "", $url);
		
	}
	
	protected function showColumnnames() {
		$filter = JFactory::getApplication()->getUserState('com_profiler.import.user.filter', array());
		$db = JFactory::getDbo();
		if($filter) {
			
			$query	= $db->getQuery(true);
			$query->select("i.*");
			$query->from('`#__profiler_import` AS i');
			$query->where($db->quoteName('i.name') . ' = "' . $filter . '"');
			$db->setQuery($query);
			$decodevalue = $db->loadAssoc();
				
			$values = json_decode($decodevalue['params']);
				
		}
		
		
		$columns_user = $db->getTableColumns("#__users");
		$columns_profiler = $db->getTableColumns("#__profiler_users");
		$result = ""; $i = 1;
		
		$result .= "<h3>#__users</h3><table width=\"100%\">";
		foreach($columns_user as $row => $column) {
			if(in_array($row, array("id", "registerDate", "name", "email"))) {
				continue;
			}
			$value = isset($values->renamefield->$row) ? $values->renamefield->$row : ""; 
			$result .= "<tr><td>".$i."</td><td>".$row."</td><td>". $column."</td><td><input type=\"text\" class=\"\" name=\"jform[renamefield][".$row."]\" value=\"".$value."\" /></td></tr>";
			$i++;
		}
		$result .= "</table><h3>#__profiler_users</h3><table width=\"100%\">";
		
		foreach($columns_profiler as $row => $column) {
			$value = isset($values->renamefield->$row) ? $values->renamefield->$row : "";
			$result .= "<tr><td>".$i."</td><td>".$row."</td><td>". $column."</td><td><input type=\"text\" class=\"\" name=\"jform[renamefield][".$row."]\" value=\"".$value."\" /></td></tr>";
			$i++; 
		}
		$result .= "</table>";
		return $result;
	} 
	
	protected function showImports() {
		$filter = JFactory::getApplication()->getUserState('com_profiler.import.user.filter', array());
		
		$options[] = JHtml::_('select.option', '', JText::_('COM_PROFILER_NEW'));
		
		$db = JFactory::getDbo();
		$query	= $db->getQuery(true);
		$query->select("i.*");
		$query->from('`#__profiler_import` AS i');
		$db->setQuery($query);
		$list = $db->loadAssocList();
		
		foreach($list AS $item) {
			
			$options[] = JHtml::_('select.option', $item['name'], $item['name']);
		}
		
		
		$html = JHtml::_('select.genericlist', $options, 'profilerform[save]', 'onchange="javascript:submitform(\'user.import\')"', 'value', 'text', $filter, 'profilerformsave');
		echo $html;
	}
}
